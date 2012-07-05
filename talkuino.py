#!/usr/bin/python
import arduinoconnect
import sys
import time


def main():
    arduinoId =   1
    portNum   =  13
    val       = 330
    msgId     =  12
    arduino   = arduinoconnect.arduinoconnect()

    if True:
        message1 = arduino.writeDigitalPort(arduinoid=arduinoId, port=portNum, value=val)
        print "SENDING MESSAGE 1",message1
        
        message2 = arduino.writeAnalogPort( arduinoid=arduinoId, port=portNum, value=val)
        print "SENDING MESSAGE 2",message2
        
        message3 = arduino.ReadDigitalPort( arduinoid=arduinoId, port=portNum, value=val)
        print "SENDING MESSAGE 3",message3
        
        message4 = arduino.ReadAnalogPort(  arduinoid=arduinoId, port=portNum, value=val)
        print "SENDING MESSAGE 4",message4
        
        time.sleep(5)
        
        ans1 = arduino.getAnswer(message1)
        print "ANSWER 1:",ans1.value
        
        ans2 = arduino.getAnswer(message2)
        print "ANSWER 2:",ans2.value
        
        ans3 = arduino.getAnswer(message3)
        print "ANSWER 3:",ans3.value
        
        ans4 = arduino.getAnswer(message4)
        print "ANSWER 4:",ans4.value
    
    time.sleep(2)

    arduino.close()

    print "out of the loop"

if __name__ == '__main__': main()
