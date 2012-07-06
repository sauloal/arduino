#!/usr/bin/python
import serial
import sys
import os
import time
import random
import pprint
import multiprocessing
import traceback

from multiprocessing import Process, Manager, Pool


#baud=9600
#baud=57600
baud             = 115200
waitbetweenloops = .02
debug            = False

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


def genVal(val, pos=0):
    maxVal     = MAXVAL - MINVAL
    multiplier = val / maxVal
    remainder  = val - (multiplier * maxVal)
    res        = chr(MINVAL + multiplier) + chr(MINVAL + remainder)
    if debug: print "POS %4d VAL %s MAX %d MULTIPLIER %d REMAINDER %d RES %d" % (pos, val, maxVal, multiplier, remainder, remainder)
    return res

def parseVal(val, pos=0):
    maxVal     = MAXVAL - MINVAL
    multiplier = ord(val[0]) - MINVAL
    remainder  = ord(val[1]) - MINVAL
    res        =(  multiplier * maxVal ) + remainder
    return res

class arduinomessage(object):
    def __init__(self, arduinoid, port, value, cmdType, rw, da, msgIdVal=None):
        if msgIdVal is None:
            msgIdVal     = chr(random.randrange(MINVAL, MAXVAL, 1))

        arduinoIdVal = chr( MINVAL + arduinoid )
        portNumVal   = chr( MINVAL + port      )
    
        try:
            valVal       = genVal(value)
        except ValueError:
            sys.stderr.write("ERROR. value "+str(value)+" too big. MAX VALUE IS " + str((MAXVAL-MINVAL) * PORTLEN)+"\n")
            sys.exit(1)
        
        if debug: print "ARDUINO ID %4d VAL %s"     % ( arduinoid, arduinoIdVal)
        if debug: print "PORT NUM   %4d VAL %s"     % ( port     , portNumVal  )
        if debug: print "VAL        %4d NUM %s\n\n" % ( value    , valVal      )
    
        self.arduinoid    = arduinoid
        self.arduinoIdVal = arduinoIdVal
        self.port         = port
        self.portNumVal   = portNumVal
        self.value        = value
        self.valVal       = valVal
        self.cmdType      = cmdType
        self.rw           = rw
        self.da           = da
        self.msgIdVal     = msgIdVal

    @classmethod
    def fromString(cls, response):
        if debug: print "LOADING FROM RESPONSE %s (%d)" % (response, len(response))
        arduinoIdVal = response[0]
        arduinoId    = ord(arduinoIdVal) - MINVAL
        msgId        = response[1]
        msgIdVal     = ord(msgId) - MINVAL
        direction    = response[2]
        cmdType      = response[3]
        portNumVal   = response[4]
        portNum      = ord(portNumVal) - MINVAL
        rw           = response[5]
        da           = response[6]
        valVal       = response[7:9]
        val          = parseVal(valVal)
        
        if debug: print "ARDUINO ID %d (%s) MSGID %d (%s) DIRECTION %s CMD TYPE %s PORT NUM VAL %d (%s) RW %s DA %s VAL %d (%s)" % \
        (arduinoId, arduinoIdVal, msgIdVal, msgId, direction, cmdType, portNum, portNumVal, rw, da, val, valVal)
        #print "ARDUINO ID %d (%s) MSGID %d (%s) DIRECTION %s CMD TYPE %s PORT NUM VAL %d (%s) RW %s DA %s VAL %d (%s)" % \
                          #(arduinoIdVal, arduinoId, msgIdVal, msgId, direction, cmdType, portNum, portNumVal, rw, da, valVal, val)
        return cls(arduinoId, portNum, val, cmdType, rw, da, msgIdVal=msgId)

    def __str__(self):
        #          arduino id          msgid           direction  type           port              RW        DA        val           arduinoid
        message  = self.arduinoIdVal + self.msgIdVal + DIRECTIN + self.cmdType + self.portNumVal + self.rw + self.da + self.valVal + self.arduinoIdVal
        return message

    def getMessage(self):
        return str(self)

    def __repr__(self): return str(self)
    
    def __cmp__(self, obj2):
        try:
            #print "COMPARING "
            #print "  ARDUINOID %s vs %s" % (self.arduinoid, obj2.arduinoid)
            #print "  PORT      %d vs %d" % (self.port     , obj2.port     )
            #print "  CMD TYPE  %s vs %s" % (self.cmdType  , obj2.cmdType  )
            #print "  RW        %s vs %s" % (self.rw       , obj2.rw       )
            #print "  DA        %s vs %s" % (self.da       , obj2.da       )
            #print "  MSG ID    %s vs %s" % (self.msgIdVal , obj2.msgIdVal )
            
            if  self.arduinoid == obj2.arduinoid and \
                self.port      == obj2.port      and \
                self.cmdType   == obj2.cmdType   and \
                self.rw        == obj2.rw        and \
                self.da        == obj2.da        and \
                self.msgIdVal  == obj2.msgIdVal:
                #print "all equal"
                return 0
            else:
                #print "some unequal"
                return -1
        except:
            print "error"
            #traceback.print_exception()
            traceback.print_exc()
            traceback.print_stack()
            return 1
        
    
    def __eq__(self, obj2):
        if self.__cmp__(obj2) == 0:
            return True
        else:
            return False


class arduinoconnect(object):
    def __init__(self):
        self.manager   = Manager()
        self.messagesQ = self.manager.Queue()
        self.responseQ = self.manager.Queue()
        self.pool      = Pool(processes=1)                                            # start 4 worker processes
        self.reader    = self.pool.apply_async(serialFunction, [[self.messagesQ, self.responseQ]]) # read and write serial assync
        self.responses = {}
        #reader    = pool.apply_async(serialFunction, [[messagesQ, responseQ]]) # read and write serial assync    
        if debug: print "finished passing\n\n"
    
    def close(self):
        print "closing"
        self.messagesQ.put(None)

        if debug: print "JOINING"
        try:
            self.reader.get(timeout=5)
        except multiprocessing.TimeoutError:
            print "ERROR CLOSING THREAD. POSSIBLE LOSS OF DATA"
        if debug: print "JOINED"

        print "waiting to send all messages"
        self.messagesQ.join()
        
        print "waiting to receive all messages"
        if self.responseQ.empty():
            self.responseQ.join()
        else:
            print "you are quitting with messages to be read"
        
        print "queues empty"



    def getAnswer(self, query):
        if debug: print "getting query {%s}" % query
        if self.hasAnswer(query):
            if debug: print "  already here"
            return self.responses.pop(str(query))
        else:
            if debug: print "  not here"
            return None
    
    def hasAnswer(self, query):
        if not self.responseQ.empty():
            if debug: print "response not empty"
            while not self.responseQ.empty():
                if debug: print "  getting response"
                q,a  = self.responseQ.get()
                if debug: print "    {%s} > {%s}" % (q, a)
                self.responses[str(q)] = a
                self.responseQ.task_done()
        else:
            if debug: print "response empty"
            pass

        return self.responses.has_key(str(query))

    def splitLine(self, line):
        for c in line:
            print "'" + c + "' (" + str(ord(c)) + ") ",
    
    def parseLine(self, line):
        begin   = line.find(INCOMINGSTART, 0)
        parts   = []
        if debug: print "FIRST",begin,'LINE',line.strip()
        while begin != -1:
            if debug: print "  BEGIN",begin
            end = line.find(INCOMINGEND, begin)
            if debug: print "  END",end
            if end != -1:
                piece = line[begin+1:end]
                begin = line.find(INCOMINGSTART, end)
                if debug: print "    PIECE",piece
                parts.append(piece)
    
        print parts
        
    def writeDigitalPort(self, arduinoid=None, port=None, value=None): 
        return self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWWRITE, da=DADIGITAL )

    def writeAnalogPort(self,  arduinoid=None, port=None, value=None): 
        return self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWWRITE, da=DAANALOG  )

    def ReadDigitalPort(self,  arduinoid=None, port=None, value=None):
        return self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWREAD, da=DADIGITAL )

    def ReadAnalogPort(self,   arduinoid=None, port=None, value=None):     
        return self.sendMessage( arduinoid=arduinoid, port=port, value=value, cmdType=TYPEPORT, rw=RWREAD, da=DAANALOG  )

    def sendMessage(   self,   arduinoid=None, port=None, value=None, cmdType=None, rw=None, da=None ):
        #TODO: skip if any is none
        message = arduinomessage( arduinoid, port, value, cmdType, rw, da )

        if debug: print "passing",str(message),"\n\n"
        #print "INCOMING START",INCOMINGSTART
        #print "INCOMING END"  ,INCOMINGEND

        self.messagesQ.put(message)
        return message


def checkdb(response, queriesDb, queueObj):
    if response in queriesDb:
        #print "RESPONSE FOUND"
        query     = queriesDb[queriesDb.index(response)]
        queriesDb.remove(query)
        queueObj.put([query, response])
    else:
        if debug: print "RESPONSE TO NO QUERY"

def gendb(msgSent, queriesDb):
    #print "  GENDB",str(msgSent)
    queriesDb.append(msgSent)

def initPort():
    tty=None

    for i in range(9):
        if not tty is None:
            if debug: print "found already"
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
        if debug: print "Serial port " + tty + " exists"


    try:
        serR = serial.Serial(tty, baud)
        if debug: print "Serial port " + tty + " open"
    except serial.SerialException:
        print "Serial port " + tty + " closed"
        exit(1)
    
    while not serR.isOpen() or not serR.inWaiting() or not serR.readable() or not serR.writable():
        #print "sleeping"
        time.sleep(.1)
    
    return serR

def serialFunction(args):
    messagesQ      = args[0]
    responseQ      = args[1]
    serR           = initPort()
    continueLoop   = True
    msgandresponse = []
    availableNodes = []
    waitinglist    = []
    buffer         = ''
    try:
        if debug: print "WAITING FOR LINE"
        try:
            while continueLoop:
                msgs    = []
                hasNone = False
                buffer = buffer + serR.read(serR.inWaiting())
                #print "buffer '"+buffer+"'"

                lines = []
                if '\n' in buffer:
                    #print "  inside"
                    if debug: print "buffer '"+buffer+"'\n\n"
                    lines = buffer.split('\n')
                    buffer = buffer[buffer.rindex('\n')]
                    if buffer in ['\n', '\r']: buffer = ''

                if len(lines) > 0:
                    while len(lines) > 0:
                        #print "reading line. size", len(lines)
                        line  = lines.pop(0)
                        lineP = line.strip()
                        if debug: print "  LINE '%s' (%d)\n" % (line, len(line))
                        if len(line) == 1 and line in ['\n', '\r']: continue
                        if len(line) == 0: continue
                        
                        if lineP[0] == INCOMINGSTART and lineP[-1] == INCOMINGEND:
                            
                            lineP = lineP.replace(INCOMINGSTART, '')
                            lineP = lineP.replace(INCOMINGEND  , '')
                            lineP = lineP.replace(CR           , '')
                            if debug: print "READ  '"+line.strip()+"' > '"+lineP.strip()+"'"
                            response = arduinomessage.fromString(lineP)
                            checkdb(response, msgandresponse, responseQ)
                            #responseQ.put(lineP)
                            #self.parseLine(line)
                            #print "READ\n"
                            
                        elif len(lineP) == 19 or line[0:18] == "SETUP ARDUINO ID: ":
                            arduinoid = line[18]
                            print "ADDING AVAILABLE NODE:",arduinoid
                            availableNodes.append(arduinoid)
                        
                        else:
                            #TODO: RETURN INVALID LINES
                            if debug: print "READ INVALID LINE",line
                elif not continueLoop:
                    break
                
                elif not messagesQ.empty() and continueLoop:
                    if debug: print "has %d messages to write" % messagesQ.qsize()
                    
                    while messagesQ.qsize() > 0 or not messagesQ.empty():
                        msg   = messagesQ.get()
                        if debug: print "  MSG",msg
                        
                        if msg is not None:
                            msg2 = INCOMINGSTART + str(msg) + INCOMINGEND
                            
                            if str(msg)[1] not in availableNodes:
                                waitinglist.append([msg, msg2])
                                messagesQ.task_done()
                                if debug: print "arduino %s not ready (waiting list [%d])\n" % (str(msg)[0], len(waitinglist))
                                continue

                            if debug: print "WRITING ON SERIAL '" + str(msg) + "' > '" + msg2 + "'"
                            
                            gendb(msg, msgandresponse)
                            
                            if len(msgs) == 0:
                                msgs.append(msg2)
                            elif (len(msgs[-1]) + len(msg2)) <= MAXSIZE:
                                msgs[-1] += msg2
                            else:
                                msgs.append(msg2)
                        else:
                            print "MESSAGE IS NONE"
                            hasNone = True

                        messagesQ.task_done()

                elif len(waitinglist) > 0:
                    for pair in waitinglist:
                        msg, msg2 = pair
                        if str(msg)[0] in availableNodes:
                            waitinglist.remove(pair)
                            
                            if debug: print "WRITING ON SERIAL DELAYED'" + str(msg) + "' > '" + msg2 + "'"
                            
                            gendb(msg, msgandresponse)
                            
                            if len(msgs) == 0:
                                msgs.append(msg2)
                            elif (len(msgs[-1]) + len(msg2)) <= MAXSIZE:
                                msgs[-1] += msg2
                            else:
                                msgs.append(msg2)
                                
                        else:
                            if debug: print "MESSAGE '%s [%s]' NOT READY TO ME SENT BECAUSE NODE %s NOT PRESENT [%s]" % (msg, msg2, str(msg)[0], ', '.join(availableNodes))

                else:
                    #print "nothing to do"
                    pass
                
                msgPos = 1
                for msg in msgs:
                    serR.write(msg)
                    print "WROTE ON SERIAL #%d '%s'\n" % (msgPos, msg)
                    msgPos += 1
                
                #if len(msgs) == 0:
                #    print "NOTHING TO WRITE"

                if hasNone:
                    print "received NONE. quiting"
                    #messagesQ.task_done()
                    continueLoop = False
                    
                time.sleep(waitbetweenloops)
        except KeyboardInterrupt:
            print "pressed ctrl+c"
            pass
    except serial.SerialException:
        print "Serial error. port closed"
        traceback.print_exc()
        traceback.print_stack()
        exit(1)
    except:
        print "error"
        traceback.print_exc()
        traceback.print_stack()
    
    print "Serial port closed"
    serR.close()
