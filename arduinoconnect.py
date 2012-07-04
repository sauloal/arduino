#!/usr/bin/python
import random
from multiprocessing import Process, Manager, Pool


#baud=9600
#baud=57600
baud=115200
tty=None



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
MAXNUMFUNC    =  MAXVAL - MINVAL# max number of registered functions
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


#easy_install --user pyserial
#http://arduino.cc/playground/Interfacing/Python
#http://www.gpsbabel.org/os/Linux_Hotplug.html


class arduinoconnect(object):
    def init(self):
        try:
            serR = serial.Serial(tty, baud)
            print "Serial port " + tty + " open"
        except serial.SerialException:
            print "Serial port " + tty + " closed"
            exit(1)
        time.sleep(1)
        
        toWrite =   [
                        message,
                        message,
                        message
                    ]
    
        manager   = Manager()
        messagesQ = manager.Queue()
        responseQ = manager.Queue()
        pool      = Pool(processes=1)                                            # start 4 worker processes
        result    = pool.apply_async(serialFunction, [[messagesQ, responseQ]]) # evaluate "f(10)" asynchronously   
            
        for msg in toWrite:
            print "passing",msg
            messagesQ.put(msg)
            time.sleep(2)
        
        print "finished passing"
        while True:
            #print "EMPTY",responseQ.empty()
            if not responseQ.empty():
                line  = responseQ.get()
                print "GOT THIS LINE OUTSIDE:",line
            else:
                #print "NO NEW OUT",responseQ.qsize()
                time.sleep(2)
        
        print "JOINING"
        print result.get(timeout=1)           # prints "100" unless your computer is *very* slow
        print "JOINED"
        


    def serialFunction(args):
        messagesQ = args[0]
        responseQ = args[1]
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
                        #parseLine(line)
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
            print "Serial port " + tty + " closed"
            exit(1)
    
    def genVal(val, pos=0):
        maxVal = MAXVAL - MINVAL
        print "POS ",pos,"VAL",val,"MAX",maxVal
        
        multiplier = val / maxVal
        remainder  = val - (multiplier * maxVal)
        res        = chr(MINVAL + multiplier) + chr(MINVAL + remainder)
    
        return res
    
    def splitLine(line):
        for c in line:
            print "'" + c + "' (" + str(ord(c)) + ") ",
    
    def parseLine(line):
        
        begin   = line.find(INCOMINGSTART, 0)
        parts   = []
        print "FIRST",begin,'LINE',line.strip()
        while begin != -1:
            print "  BEGIN",begin
            end = line.find(INCOMINGEND, begin)
            print "  END",end
            if end != -1:
                piece   = line[begin+1:end]
                begin = line.find(INCOMINGSTART, end)
                print "    PIECE",piece
                parts.append(piece)
    
        print parts
        
    message1 = writeDigitalPort(arduinoid=arduinoId, port=portNum, value=val)
    message2 = writeAnalogPort( arduinoid=arduinoId, port=portNum, value=val)
    message3 = ReadDigitalPort( arduinoid=arduinoId, port=portNum, value=val)
    message4 = ReadAnalogPort(  arduinoid=arduinoId, port=portNum, value=val)
    
    msgIdVal     = chr(MINVAL + msgId)
    arduinoIdVal = chr(MINVAL + arduinoId)
    portNumVal   = chr(MINVAL + portNum)
    
    try:
        valVal       = genVal(val)
    except ValueError:
        sys.stderr.write("ERROR. value "+str(val)+" too big. MAX VALUE IS " + str((MAXVAL-MINVAL) * PORTLEN)+"\n")
        
        sys.exit(1)
        
    print "INCOMING START",INCOMINGSTART
    print "ARDUINO ID"    ,arduinoId, "VAL", arduinoIdVal
    print "PORT NUM"      ,portNum  , "VAL", portNumVal
    print "VAL"           ,val      , "NUM", valVal
    print "INCOMING END"  ,INCOMINGEND
    
    #message  = genMessagePor(arduinoid=arduinoId,port=portNum, value=val, rw)
    #message  = arduinoIdVal + msgIdVal + DIRECTIN + TYPEPORT + portNumVal + RWWRITE + DADIGITAL + valVal + arduinoIdVal
    #              arduino id     msgid      direction  type       port         RW        DA          val      arduinoid
