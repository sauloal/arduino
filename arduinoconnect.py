#!/usr/bin/python
import serial
import sys
import os
import time
import random
import pprint
from multiprocessing import Process, Manager, Pool


#baud=9600
#baud=57600
baud=115200


SOH='\x01'
STX='\x02'
ETX='\x03'
TAB='\x09'
VT ='\x11'
CR ='\x0D'
ETB='\x17'
RS ='\x1E'
US ='\x1F'


#ARDUINOID         0 # id for this particular ID
MAXSIZE       =  128 # max size before flushing
MAXFUNCSIZE   = 8352 # max size of data to be passed to function

#control
MINVAL        =   33 # !
MAXVAL        =  126 # ~
MAXNUMFUNC    =  MAXVAL - MINVAL # max number of registered functions
PORTLEN       =    2 # number of chars to
                     # describe port values

INCOMINGSTART = RS  # RS - record separator
INCOMINGEND   = US  # US - unit separator

DIRECTIN      = "("  # ( IN  TO   ARD
DIRECTOU      = ")"  # ) OUT FROM ARD

TYPEPORT      = 'P'  # P PORT
TYPEFUNC      = 'F'  # F FUNCTION

#port
RWREAD        = "R"  # R READ  PORT
RWWRITE       = "W"  # W WRITE PORT

DADIGITAL     = "D"  # D DIGITAL
DAANALOG      = "A"  # A ANALOGIC

#function
DATABEG       = STX  # STX BEGIN FUNCTION DATA
DATAEND       = ETX  # EXT END   FUNCTION DATA

PARTONLYONE   = '!'  # ! Only one data. do not expect more pieces
PARTLASTPIECE = '~'  # ~ Last piece marker
PARTMAXVAL    = '|'  # | maximum number of pieces


#easy_install --user pyserial
#http://arduino.cc/playground/Interfacing/Python
#http://www.gpsbabel.org/os/Linux_Hotplug.html


class arduinoconnect(object):
    def __init__(self):
	tty=None

	for i in range(9):
	    if not tty is None:
        	print "found already"
	        break

	    for type in ['ACM', 'USB']:
        	ttyL = '/dev/tty' + type + str(i)
	        if os.path.lexists(ttyL):
        	    print "Serial port " + ttyL + " exists"
	            tty = ttyL
	            break
        	else:
	            print "Serial port " + ttyL + " does not exists"

	if tty is None:
	    print "NO TTY FOUND"
	    exit(1)

	if not os.path.lexists(tty):
	    print "Serial port " + tty + " does not exists"
	    exit(1)
	else:
	    print "Serial port " + tty + " exists"


        try:
            serR = serial.Serial(tty, baud)
            print "Serial port " + tty + " open"
        except serial.SerialException:
            print "Serial port " + tty + " closed"
            exit(1)
        time.sleep(1)
            
        manager   = Manager()
        messagesQ = manager.Queue()
        responseQ = manager.Queue()
        pool      = Pool(processes=1)                                            # start 4 worker processes
        reader    = pool.apply_async(serialFunction, [[messagesQ, responseQ, serR]]) # read and write serial assync
        #reader    = pool.apply_async(serialFunction, [[messagesQ, responseQ]]) # read and write serial assync    

	self.tty       = tty
	self.serR      = serR
	self.manager   = manager
	self.messagesQ = messagesQ
	self.responseQ = responseQ
	self.pool      = pool
	self.reader    = reader
        print "finished passing"
	pprint.pprint(self.__dict__)
    
    def close(self):
	self.messagesQ.close()
	self.responseQ.close()

        print "JOINING"
	self.reader.get(timeout=1)
        print "JOINED"

    def getAnswer(self):
        res = []
        if not self.responseQ.empty():
           while not self.responseQ.empty():
               line  = self.responseQ.get()
               res.append(line)
               print "GOT THIS LINE OUTSIDE:",line       
        else:
           pass
           #print "NO NEW OUT",self.responseQ.qsize()
           #time.sleep(2)
        return res        
            
    def genVal(self, val, pos=0):
        maxVal = MAXVAL - MINVAL
        print "POS ",pos,"VAL",val,"MAX",maxVal
        
        multiplier = val / maxVal
        remainder  = val - (multiplier * maxVal)
        res        = chr(MINVAL + multiplier) + chr(MINVAL + remainder)
    
        return res
    
    def splitLine(self, line):
        for c in line:
            print "'" + c + "' (" + str(ord(c)) + ") ",
    
    def parseLine(self, line):
        begin   = line.find(INCOMINGSTART, 0)
        parts   = []
        print "FIRST",begin,'LINE',line.strip()
        while begin != -1:
            print "  BEGIN",begin
            end = line.find(INCOMINGEND, begin)
            print "  END",end
            if end != -1:
                piece = line[begin+1:end]
                begin = line.find(INCOMINGSTART, end)
                print "    PIECE",piece
                parts.append(piece)
    
        print parts
        
    def writeDigitalPort(self, arduinoid=None, port=None, value=None): 
        self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWWRITE, da=DADIGITAL )

    def writeAnalogPort(self,  arduinoid=None, port=None, value=None): 
        self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWWRITE, da=DAANALOG  )

    def ReadDigitalPort(self,  arduinoid=None, port=None, value=None):
        self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWREAD, da=DADIGITAL )

    def ReadAnalogPort(self,   arduinoid=None, port=None, value=None):     
        self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWREAD, da=DAANALOG  )

    def sendMessage(   self,   arduinoid=None, port=None, value=None, cmdType=None, rw=None, da=None ):
        #TODO: skip if any is none
	message = self.genMessage( arduinoid, port, value, cmdType, rw, da)

        print "passing",message
        print "INCOMING START",INCOMINGSTART
        print "INCOMING END"  ,INCOMINGEND

        self.messagesQ.put(INCOMINGSTART + message , INCOMINGEND)

    def genMessage(self, arduinoid, port, value, cmdType, rw, da):
        msgIdVal     = chr( MINVAL + 0         )
        arduinoIdVal = chr( MINVAL + arduinoid )
        portNumVal   = chr( MINVAL + port      )
    
        try:
            valVal       = self.genVal(value)
        except ValueError:
            sys.stderr.write("ERROR. value "+str(value)+" too big. MAX VALUE IS " + str((MAXVAL-MINVAL) * PORTLEN)+"\n")
            sys.exit(1)
        
        print "ARDUINO ID"    ,arduinoid, "VAL", arduinoIdVal
        print "PORT NUM"      ,port     , "VAL", portNumVal
        print "VAL"           ,value    , "NUM", valVal
    
        message  = arduinoIdVal + msgIdVal + DIRECTIN + cmdType + portNumVal + rw + da + valVal + arduinoIdVal
        #          arduino id     msgid      direction  type      port         RW   DA   val      arduinoid
        return message


def serialFunction(args):
    messagesQ = args[0]
    responseQ = args[1]
    serR      = args[2]
    try:
	print "WAITING FOR LINE"
	try:
	    while True:
		#print "reading line"
		if serR.inWaiting() > 0:
		    line  = serR.readline()
		    lineP = line.strip()
		    lineP = lineP.replace(INCOMINGSTART, '')
		    lineP = lineP.replace(INCOMINGEND  , '')
		    lineP = lineP.replace(CR           , '')
		    print "READ  '"+line.strip()+"' > '"+lineP.strip()+"'"
		    responseQ.put(lineP)
		    #self.parseLine(line)
		    print "READ\n"
		    
		else: # nothing to read
		    if not messagesQ.empty():
			line  = INCOMINGSTART + messagesQ.get() + INCOMINGEND
			line  = line[:2] + chr(random.randrange(MINVAL, MAXVAL, 1)) + line[3:]
			lineP = line.strip()
			lineP = lineP.replace(INCOMINGSTART, '')
			lineP = lineP.replace(INCOMINGEND  , '')
			lineP = lineP.replace(CR           , '')
			print "WRITE '"+line.strip()+"' > '"+lineP.strip()+"'"
			serR.write(line)
			print "WROTE\n"
	except KeyboardInterrupt:
	    print "pressed ctrl+c"
	    pass
    except serial.SerialException:
	print "Serial port closed"
	exit(1)
