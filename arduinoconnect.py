#!/usr/bin/python
import serial
import sys
import os
import time
import random
import pprint
import multiprocessing
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
        self.manager   = Manager()
        self.messagesQ = self.manager.Queue()
        self.responseQ = self.manager.Queue()
        self.pool      = Pool(processes=1)                                            # start 4 worker processes
        self.reader    = self.pool.apply_async(serialFunction, [[self.messagesQ, self.responseQ]]) # read and write serial assync
        #reader    = pool.apply_async(serialFunction, [[messagesQ, responseQ]]) # read and write serial assync    
        print "finished passing\n\n"
    
    def close(self):
        print "closing"
        self.messagesQ.put(None)

        print "JOINING"
        try:
            self.reader.get(timeout=5)
        except multiprocessing.TimeoutError:
            print "ERROR CLOSING THREAD. POSSIBLE LOSS OF DATA"
        print "JOINED"

        print "waiting to send all messages"
        self.messagesQ.join()
        
        print "waiting to receive all messages"
        if self.responseQ.empty():
            self.responseQ.join()
        else:
            print "you are quitting with messages to be read"
        
        print "queues empty"



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

        print "passing",message,"\n\n"
        #print "INCOMING START",INCOMINGSTART
        #print "INCOMING END"  ,INCOMINGEND

        self.messagesQ.put(message)

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
        print "PORT NUM  "    ,port     , "VAL", portNumVal
        print "VAL       "    ,value    , "NUM", valVal
    
        message  = arduinoIdVal + msgIdVal + DIRECTIN + cmdType + portNumVal + rw + da + valVal + arduinoIdVal
        #          arduino id     msgid      direction  type      port         RW   DA   val      arduinoid
        return message


def initPort():
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
    
    while not serR.isOpen() or not serR.inWaiting() or not serR.readable() or not serR.writable():
        #print "sleeping"
        time.sleep(.1)
        
    return serR

def serialFunction(args):
    messagesQ    = args[0]
    responseQ    = args[1]
    serR         = initPort()
    continueLoop = True
    
    try:
        print "WAITING FOR LINE"
        try:
            while continueLoop:
                if serR.inWaiting() > 0:
                    print "reading line", serR.inWaiting()
                    line  = serR.readline()
                    #print line
                    
                    lineP = line.strip()
                    lineP = lineP.replace(INCOMINGSTART, '')
                    lineP = lineP.replace(INCOMINGEND  , '')
                    lineP = lineP.replace(CR           , '')
                    print "READ  '"+line.strip()+"' > '"+lineP.strip()+"'"
                    responseQ.put(lineP)
                    #self.parseLine(line)
                    print "READ\n"
                
                elif not messagesQ.empty():
                    print "has message",messagesQ.qsize()
                    msgs = []
                    while messagesQ.qsize() > 0 or not messagesQ.empty():
                        msg   = messagesQ.get()
                        print "MSG",msg
                        
                        if msg is None:
                            print "received NONE. quiting"
                            messagesQ.task_done()
                            continueLoop = False
                            break
                        else:
                            msg  = msg[:1] + chr(random.randrange(MINVAL, MAXVAL, 1)) + msg[2:] # add random identifier
                            msg2 = INCOMINGSTART + msg + INCOMINGEND
                            print "WRITE '"+msg+"' > '" + msg2 + "'"
                            
                            if len(msgs) == 0:
                                msgs.append(msg2)
                            elif len(msgs[-1]) < MAXSIZE:
                                msgs[-1] += msg2
                            else:
                                msgs.append(msg2)
                                
                        messagesQ.task_done()
                    
                    for msg in msgs:
                        serR.write(msg)
                        print "WROTE",msg,"\n"

                else:
                    #print "nothing to do"
                    pass
        except KeyboardInterrupt:
            print "pressed ctrl+c"
            pass
    except serial.SerialException:
        print "Serial error. port closed"
        exit(1)
    
    print "Serial port closed"
    serR.close()
