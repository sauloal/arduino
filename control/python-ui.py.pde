/*****************************************************************************
comm_example.pde

This Arduino Sketch is an example of how to handle communication while the
Arduino is also engaged in monitoring and/or doing other tasks. In this
example the Arduino continues to blink the LED connected to Pin 13 on then off
each second as it also reads bytes from the serial port. Upon receiving a
command from the serial port (indicated by a Newline character) the Arduino
executes the command.

In this case the commands are few and documented below:

Input Command: CHECK
This command checks for an active connection. The response the Arduino sends
when receiving this command is

CONNECT

Input Command: QUERY
This command is to query the current state of the LED. There are two possible
responses:

LOW

The LOW response indicates that the LED is currently off.

HIGH

The High response indicates that the LED is currently on.

We also have the Arduino send an alert through the serial port every time it
cycles on a multiple of 10 times. We do this through the CYCLE output command.

For example, on the 10th time it flashes on, the Arduino sends the command

CYCLE 10

On the 20th it sends the command:

CYCLE 20

and so on (until the limit of unsigned int is reached).

Copyright 2011 Christopher De Vries
This program is distributed under the Artistic License 2.0, a copy of which
is included in the file LICENSE.txt
*****************************************************************************/

unsigned long nextStateChange;
int ledState = LOW;
unsigned int cycle_number=0;

void setup() {
  pinMode(13,OUTPUT);
  Serial.begin(9600);
}

/* The loop is set up in two parts. Firs the Arduino does the work it needs to
 * do for every loop, next is runs the checkInput() routine to check and act on
 * any input from the serial connection.
 */
void loop() {
  long int currentTime;
  int inbyte;
  
  // Perform work to be done
  currentTime = millis();
  if(currentTime>=nextStateChange) {
    changeLEDState();
    nextStateChange = currentTime+1000l;
  }
  
  // Accept and parse input
  checkInput();
}
  
void changeLEDState() {
  if(ledState==LOW) {
    ledState = HIGH;
    digitalWrite(13,HIGH);
    cycle_number++;
    if(cycle_number%10==0) {
      Serial.print("CYCLE ");
      Serial.println(cycle_number);
    }
  }
  else {
    ledState = LOW;
    digitalWrite(13,LOW);
  }
}

/* This routine checks for any input waiting on the serial line. If any is
 * available it is read in and added to a 128 character buffer. It sends back
 * an error should the buffer overflow, and starts overwriting the buffer
 * at that point. It only reads one character per call. If it receives a
 * newline character is then runs the parseAndExecuteCommand() routine.
 */
void checkInput() {
  int inbyte;
  static char incomingBuffer[128];
  static char bufPosition=0;
  
  if(Serial.available()>0) {
    // Read only one character per call
    inbyte = Serial.read();
    if(inbyte==10) {
      // Newline detected
      incomingBuffer[bufPosition]='\0'; // NULL terminate the string
      bufPosition=0; // Prepare for next command
      
      // Supply a separate routine for parsing the command. This will
      // vary depending on the task.
      parseAndExecuteCommand(String(incomingBuffer));
    }
    else {
      incomingBuffer[bufPosition]=(char)inbyte;
      bufPosition++;
      if(bufPosition==128) {
        Serial.println("ERROR Command Overflow");
        bufPosition=0;
      }
    }
  }
}

/* This routine parses and executes any command received. It will have to be
 * rewritten for any sketch to use the appropriate commands and arguments for
 * the program you design. I find it easier to separate the input assembly
 * from parsing so that I only have to modify this function and can keep the
 * checkInput() function the same in each sketch.
 */
void parseAndExecuteCommand(String command) {
  if(command.equals(String("CHECK"))) {
    // Check connection, respond with CONNECT
    Serial.println("CONNECT");
  }
  else if(command.equals(String("QUERY"))) {
    // Query state of the LED
    if(ledState==LOW) {
      Serial.println("LOW");
    }
    else {
      Serial.println("HIGH");
    }
  }
  else {
    // Unrecognized command
    Serial.println("ERROR Unrecognized Command");
  }
}

