#!/usr/bin/python
import arduinoconnect
import sys



def main():
    arduinoId =   1
    portNum   =  13
    val       = 330
    msgId     =  12
    arduino   = arduinoconnect.arduinoconnect()
    #sys.exit(0)

    #if False:
    if True:
      message1 = arduino.writeDigitalPort(arduinoid=arduinoId, port=portNum, value=val)
      print "SENDING MESSAGE 1",message1

      message2 = arduino.writeAnalogPort( arduinoid=arduinoId, port=portNum, value=val)
      print "SENDING MESSAGE 2",message2

      message3 = arduino.ReadDigitalPort( arduinoid=arduinoId, port=portNum, value=val)
      print "SENDING MESSAGE 3",message3

      message4 = arduino.ReadAnalogPort(  arduinoid=arduinoId, port=portNum, value=val)
      print "SENDING MESSAGE 4",message4 
    
    print "out of the loop"

if __name__ == '__main__': main()
