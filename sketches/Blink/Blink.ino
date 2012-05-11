/*
  Blink
  Turns on an LED on for one second, then off for one second, repeatedly.
 
  This example code is in the public domain.
 */

  //http://arduino.cc/playground/Main/ShieldPinUsage
  //ALL                            00 01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 36 36 37 38 39 40 41 42 43 44 45 46 47 48 49 50 51 52 53
  //RX                             00                                           15    17    19 
  //TX                                01                                     14    16    18
  //                               SER0                                      SER1  SER2  SER3
  //LED                                                                   13
  //INTERUPT                             02 03                                           18 19 20 21
  //                                     I0 I1                                           I5 I4 I3 I2
  //PWM                            |--------------**-**--------------------|
  //I2C                                                                                        20 21
  //                                                                                           SDASCL
  //SPI                                                                                                                                                                                  50 51 52 53
  //                                                                                                                                                                                     MISSO SCK
  //                                                                                                                                                                                        MOSI  SS
  //ALL                            00 01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 36 36 37 38 39 40 41 42 43 44 45 46 47 48 49 50 51 52 53
  //SD   (LIBRARY NORMALLY USE 10)                         08       11 12 13 
  //LCD  (CHANGEBLE)                     02 03 04 05                11 12    
  //                                                    07 08 09 10 11 12
  //WISHIELD                             02             07 08 09 10 11 12 13

//#include <avr/pgmspace.h>


//////////////////////
//// RTC
//////////////////////
#include <RTClib.h>

//////////////////////
//// PIR
//////////////////////
const int pirLedPin   = 13; // choose the pin for the LED
const int pirInputPin =  2; // choose the input pin (for PIR sensor)
      int pirVal;           // variable for reading the pin status
      int pirState;         // we start, assuming no motion detected
      boolean pirNeedInit;
      
const int calibrationTime = 30;        
//the time when the sensor outputs a low impulse
      long unsigned int lowIn;         
//the amount of milliseconds the sensor has to be low 
//before we assume all motion has stopped
const long unsigned int pause = 5000;  
boolean lockLow = true;
boolean takeLowTime;  
      

//////////////////////
//// LCD
//////////////////////
// include the library code:
#include <LiquidCrystal.h>
// these constants won't change.  But you can change the size of
// your LCD using them:
const int     LCDnumRows =  2;
const int     LCDnumCols = 16;
// initialize the library with the numbers of the interface pins
//LiquidCrystal lcd( 7,  8,  9, 10, 11, 12);
LiquidCrystal lcd(49, 48, 47, 46, 45, 44);
// LCD 01  02  03  04  05  06  07  08  09  10  11  12  13  14  15  16
//                 RS  RW  EN                  DB4 DB5 DB6 DB7        
//     LED LED BACK LIGHT                                      PWR PWR
// LCD 01  02  03  04  05  06  07  08  09  10  11  12  13  14  15  16
// STD GRD +5  +5* 12  GRD 11                  05  04  03  02  +5  GRD
// WEB GRD +5  +5* 07  GRD 08                  09  10  11  12  +5  GRD
// MOD GRD +5  +5* 49  GRD 48                  47  46  45  44  +5  GRD
// +5* = can use varistor for brightness


//////////////////////
//// GLOBAL
//////////////////////
boolean needInit;

typedef struct {
  int     pin;         // PIN NUMBER
  byte    type;        // PORT TYPE: 0=BLOCKED (NOT ALLOWED TO CHANGE METHOD) p=PWD/DIGITAL d=DIGITAL a=ANALOG
  boolean use;         // USE OR NOT THIS PORT
  boolean showDisplay; // SHOW ON DISPLAY OR NOT
  int     method;      // INPUT or OUPUT or PROG
  String  name;        // NAME
  String  LCDName;     // LCD Name
} portStruc;

portStruc ports[] = {
    (portStruc) {   0, '0', false, false,     -1, "rx"   , ""  }, (portStruc) {   1, '0', false, false,     -1, "tx"   , ""  },
    (portStruc) {   2, '0', false, false,     -1, "WIFI" , ""  }, (portStruc) {   3, '0', false, false,     -1, "EMPTY", ""  },
    (portStruc) {   4, 'p', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {   5, 'p', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {   6, 'p', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {   7, 'p', false, false,     -1, "WIFI" , ""  },
    (portStruc) {   8, 'p', false, false,     -1, "WIFI" , ""  }, (portStruc) {   9, 'p', false, false,     -1, "WIFI" , ""  },
    (portStruc) {  10, 'p', false, false,     -1, "WIFI" , ""  }, (portStruc) {  11, 'p', false, false,     -1, "WIFI" , ""  },
    (portStruc) {  12, 'p', false, false,     -1, "WIFI" , ""  }, (portStruc) {  13, 'p',  true, false, OUTPUT, "LED"  , ""  },
    (portStruc) {  14, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  15, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  16, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  17, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  18, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  19, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  20, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  21, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  22, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  23, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  24, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  25, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  26, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  27, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  28, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  29, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  30, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  31, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  32, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  33, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  34, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  35, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  36, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  37, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  38, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  39, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  40, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  41, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  42, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  43, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  44, 'd', false, false,     -1,   "LCD", ""  }, (portStruc) {  45, 'd', false, false,     -1,   "LCD", ""  },
    (portStruc) {  46, 'd', false, false,     -1,   "LCD", ""  }, (portStruc) {  47, 'd', false, false,     -1,   "LCD", ""  },
    (portStruc) {  48, 'd', false, false,     -1,   "LCD", ""  }, (portStruc) {  49, 'd', false, false,     -1,   "LCD", ""  },
    (portStruc) {  50, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  51, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  52, 'd', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  53, 'd', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  A0, 'a',  true,  true,  INPUT,  "TEMP", "T" }, (portStruc) {  A1, 'a',  true,  true,  INPUT, "LIGHT", "L" },
    (portStruc) {  A2, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  A3, 'a', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  A4, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  A5, 'a', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  A6, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  A7, 'a', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) {  A8, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) {  A9, 'a', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) { A10, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) { A11, 'a', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) { A12, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) { A13, 'a', false, false,  INPUT, "EMPTY", ""  },
    (portStruc) { A14, 'a', false, false,  INPUT, "EMPTY", ""  }, (portStruc) { A15, 'a', false, false,  INPUT, "EMPTY" } 
  };

const int arrSize = sizeof(ports)/sizeof(*ports);






void SerialPrint(String text){
  Serial.flush();
  Serial.print(text);
}

void SerialPrintLn(String text){
  SerialPrint(text + "\n");
}

void LCDPrint(String text){
  lcd.clear();
  // set the cursor to column 0, line 1
  // (note: line 1 is the second row, since counting begins with 0):

  // print the number of seconds since reset:

  int textLenght = (int) text.length();
  SerialPrintLn("LCD " + text + " [LENGTH: " + String(textLenght) + "]");

  if ( textLenght > LCDnumCols ) {
    for (int p = 0; p < LCDnumRows; p++ )
    {
      lcd.setCursor(0, p);
      int start  = p     * LCDnumCols;
      int finish = start + LCDnumCols;
      //if ( finish > textLenght ) {
      //  finish = textLenght;
      //}
      String substr = text.substring(start, finish);
      lcd.print(substr);
      SerialPrintLn("LCD P " + String(p) + " START " + String(start) + " END " + String(finish) + " SUBSTR " + substr);
    }
  } else {
    lcd.setCursor(0, 0);
    lcd.print(text);
  }
}

void initPorts() {
  if ( needInit ) {
    SerialPrintLn("  INITING " + String(needInit) + " NUM PORTS: " + arrSize );
    for (int i = 0; i < arrSize; i++)
    {
      portStruc & lPort       = ports[i];
      int         pin         = lPort.pin;         // pin number
      byte        type        = lPort.type;        // 0=BLOCKED p=pwd/dig d=dig a=analog
      boolean     use         = lPort.use;         // 0=no 1=yes
      //boolean     showDisplay = lPort.showDisplay; // 0=no 1=yes
      int         method      = lPort.method;      // INPUT or OUPUT or PROG
      String      name        = lPort.name;        // NAME
  
      SerialPrintLn("    INIT :: PORT " + String(pin) + " NAME " + String(name) + " TYPE " + char(type) + " METHOD " + String(method));    
      if ( ( type != 0 ) && ( use == 1 ) ) { // in use
          SerialPrintLn("  INITIALIZING");
          if ( method == INPUT ) {
            pinMode(pin,  INPUT);
          } 
          else if ( method == OUTPUT ) {
            pinMode(pin, OUTPUT);
          } else {
            SerialPrintLn("  ALREADY INITIALIZED");
          }
      } //end if type
    } //end for
  } else {
    SerialPrintLn("  ALREADY INITIALIZED");
  }
  needInit = false;
}

void processPorts() {
  String res    = "";
  String LCDres = "";  
  for (int i = 0; i < arrSize; i++)
  {
    portStruc & lPort       = ports[i];
    int         pin         = lPort.pin;         // PIN NUMBER
    byte        type        = lPort.type;        // PORT TYPE: 0=BLOCKED (NOT ALLOWED TO CHANGE METHOD) p=PWD/DIGITAL d=DIGITAL a=ANALOG
    boolean     use         = lPort.use;         // USE OR NOT THIS PORT
    boolean     showDisplay = lPort.showDisplay; // SHOW ON DISPLAY OR NOT
    int         method      = lPort.method;      // INPUT or OUPUT or PROG
    String      name        = lPort.name;        // NAME
    String      LCDName     = lPort.LCDName;     // LCD Name

    if (( type != 0 ) && ( use == 1 )) { // in use
      if ( method == INPUT ) {
        String lRes = "READING PIN " + String(pin) + " NAME " + name + " TYPE " + char(type) + " SHOW " + String(showDisplay) + " TYPE " + String(char(type));
        int    out  = -1;
        
        switch (type) {
          case 'p':
            out = digitalRead(pin);
            break;
          case 'd':
            out = digitalRead(pin);
            break;
          case 'a':
            out = analogRead(pin);
            break;
        } // end switch
        
        if ( sizeof(out) != 0 ) {
          lRes += " RES " + String(out);
          res  += lRes + "\n";

          if ( showDisplay ) {
            if ( LCDres.length() != 0 ) {
              LCDres += " ";
            }
            
            if ( LCDName.length() != 0 ) { 
              LCDres += LCDName + ": " + String(out);
            } else {
              LCDres += name   + ": " + String(out);
            }
          }
        }
      } //end method
    } //end if type and use
  } //end for
  SerialPrintLn(res);
  LCDPrint(LCDres);
}

void pir() {
  if (pirNeedInit) {
    pirVal      =  0;              // variable for reading the pin status
    pirState    = LOW;             // we start, assuming no motion detected
    pirNeedInit = false;
  }
  
  pirVal = digitalRead(pirInputPin);   // read input value
  if (pirVal == HIGH) {                // check if the input is HIGH
    digitalWrite(pirLedPin, HIGH);     // turn LED ON
    if ( pirState == LOW ) {
      // we have just turned on
      SerialPrintLn("Motion detected!");
      // We only want to print on the output change, not state
      pirState = HIGH;
    }
  } else {
    digitalWrite(pirLedPin, LOW); // turn LED OFF
    if ( pirState == HIGH ) {
      // we have just turned of
      SerialPrintLn("Motion ended!");
      // We only want to print on the output change, not state
      pirState = LOW;
    }
  }
}

void pir2() {
  if (pirNeedInit) {
    LCDPrint("Initializing PIR... please wait");
    pirVal      =  0;              // variable for reading the pin status
    pirState    = LOW;             // we start, assuming no motion detected
    digitalWrite(pirInputPin, LOW);
    SerialPrint("calibrating sensor ");
    for(int i = 0; i < calibrationTime; i++){
      Serial.print(".");
      delay(1000);
    }
    SerialPrintLn(" done");
    SerialPrintLn("SENSOR ACTIVE");
    delay(50);
    pirNeedInit = false;
  }
  
  //http://www.arduino.cc/playground/Code/PIRsense
  if(digitalRead(pirInputPin) == HIGH){
    digitalWrite(pirLedPin, HIGH);   //the led visualizes the sensors output pin state
    if(lockLow){  
      //makes sure we wait for a transition to LOW before any further output is made:
      lockLow = false;            
      Serial.println("---");
      Serial.print("motion detected at ");
      Serial.print(millis()/1000);
      Serial.println(" sec"); 
      delay(50);
    }         
    takeLowTime = true;
  }
  
  if(digitalRead(pirInputPin) == LOW){       
    digitalWrite(pirLedPin, LOW);  //the led visualizes the sensors output pin state
    
    if(takeLowTime){
      lowIn       = millis();          //save the time of the transition from high to LOW
      takeLowTime = false;       //make sure this is only done at the start of a LOW phase
    }
    //if the sensor is low for more than the given pause, 
    //we assume that no more motion is going to happen
    if(!lockLow && millis() - lowIn > pause){  
      //makes sure this block of code is only executed again after 
      //a new motion sequence has been detected
      lockLow = true;                        
      Serial.print("motion ended at ");      //output
      Serial.print((millis() - pause)/1000);
      Serial.println(" sec");
      delay(50);
    }
  }
}






void setup() {
  //Serial.begin(9600);
  Serial.begin(115200);

  //pinMode(13, OUTPUT);

  // set up the LCD's number of columns and rows: 
  lcd.begin(LCDnumCols,LCDnumRows);
  lcd.clear();
  LCDPrint("Initializing... please wait");
  
  // initialize the digital pin as an output.
  // Pin 13 has an LED connected on most Arduino boards:

  needInit    = true;
  pirNeedInit = true;
  initPorts();
}


void loop() {

  processPorts();
  //pir();
  pir2();
  
  SerialPrintLn("High");
  digitalWrite(13, HIGH);   // set the LED on
  delay(1000);     // wait for a second
  
  processPorts();
  SerialPrintLn("Low");
  digitalWrite(13, LOW);    // set the LED off
  delay(1000);              // wait for a second
}

