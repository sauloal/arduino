#!/usr/bin/python
import serial
import sys
import os
import time
import arduinoconnect




def main():
    arduinoId    =   1
    portNum      =  13
    val          = 330
    msgId        =  12

    message1 = writeDigitalPort(arduinoid=arduinoId, port=portNum, value=val)
    message2 = writeAnalogPort( arduinoid=arduinoId, port=portNum, value=val)
    message3 = ReadDigitalPort( arduinoid=arduinoId, port=portNum, value=val)
    message4 = ReadAnalogPort(  arduinoid=arduinoId, port=portNum, value=val)
    print "SENDING MESSAGE 1",message1
    print "SENDING MESSAGE 2",message2
    print "SENDING MESSAGE 3",message3
    print "SENDING MESSAGE 4",message4
    

    
    print "out of the loop"
    #serW = serial.Serial('/dev/'+tty, baud
    #serW.write('5')

if __name__ == '__main__': main()