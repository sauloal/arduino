/*
  Blink
  Turns on an LED on for one second, then off for one second, repeatedly.
 
  This example code is in the public domain.
*/


/*
////////////////////
// SHIELD PINS
////////////////////
http://arduino.cc/playground/Main/ShieldPinUsage
ALL                            00 01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 36 36 37 38 39 40 41 42 43 44 45 46 47 48 49 50 51 52 53
RX                             00                                           15    17    19 
TX                                01                                     14    16    18
                               SER0                                      SER1  SER2  SER3
LED                                                                   13
INTERUPT                             02 03                                           18 19 20 21
                                     I0 I1                                           I5 I4 I3 I2
ALL                            00 01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 36 36 37 38 39 40 41 42 43 44 45 46 47 48 49 50 51 52 53
PWM                            |--------------**-**--------------------|
I2C                                                                                        20 21
                                                                                           SDASCL
SPI                                                                                                                                                                                  50 51 52 53
                                                                                                                                                                                     MISSO SCK
                                                                                                                                                                                        MOSI  SS
ALL                            00 01 02 03 04 05 06 07 08 09 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 36 36 37 38 39 40 41 42 43 44 45 46 47 48 49 50 51 52 53
SD   (LIBRARY NORMALLY USE 10)                         08       11 12 13 
LCD  (CHANGEBLE)                     02 03 04 05                11 12    
                                                    07 08 09 10 11 12
WISHIELD                             02             07 08 09 10 11 12 13
*/



/*
         [------------------------] 
         [                    RED ] +5
         [  PIR (INPUT PIN) BROWN ] 02
         [                  BLACK ] GND
         [------------------------]

         [----------------] MOD          STANDART WEB
         [         LED 01 ] GND
         [         LED 02 ] +5
         [  BACK LIGHT 03 ] VARISTOR +5
         [          RS 04 ] 49           12       07
         [          RW 05 ] GND
         [          EN 06 ] 48           11       08
         [             07 ]
         [ LCD         08 ]
         [             09 ]
         [             10 ]
         [         DB4 11 ] 47           05       09
         [         DB5 12 ] 46           04       10
         [         DB6 13 ] 45           03       11
         [         DB7 14 ] 44           02       12
         [         PWD 14 ] +5
         [         PWR 16 ] GND
         [----------------]

         [--------------]
         [            3 ] GND
         [ VARISTOR  -> ] LCD 03 (BACK LIGHT) [CONSIDER CHANGING TO PWM]
         [            1 ] +5
         [--------------]

         [--------------]
         [            3 ] GND
         [ TMP       -> ] LCD 03 (BACK LIGHT) [CONSIDER CHANGING TO PWM]
         [            1 ] +5
         [--------------]
      
      ,------------------------------------------------------------------------PWM13 - OUTPUT - INTERNAL LED
      |  ,---------------------------------------------------------------------PWM12 -
      |  |  ,------------------------------------------------------------------PWM11 -
      |  |  |  ,---------------------------------------------------------------PWM10 -
      |  |  |  |  ,------------------------------------------------------------PWM09 -
      |  |  |  |  |  ,---------------------------------------------------------PWM08 -
      |  |  |  |  |  |
      |  |  |  |  |  |    ,----------------------------------------------------PWM07 -
      |  |  |  |  |  |    |  ,-------------------------------------------------PWM06 -
      |  |  |  |  |  |    |  |  ,----------------------------------------------PWM05 -
      |  |  |  |  |  |    |  |  |  ,-------------------------------------------PWM04 -
      |  |  |  |  |  |    |  |  |  |  ,----------------------------------------PWM03 -
      |  |  |  |  |  |    |  |  |  |  |  ,-------------------------------------PWM02 - INPUT - PIR BROWN (INPUT)
      |  |  |  |  |  |    |  |  |  |  |  |  ,---------------------------------TX0_01 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  ,------------------------------RX0_00 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    ,-------------------------TX3_14 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  ,----------------------RX3_15 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  ,-------------------TX2_16 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  ,----------------RX2_17 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  |  ,-------------TX1_18 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  |  |  ,----------RX1_19 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  |  |  |  ,-------TX0_20 -  
 A  G 13 12 11 10 09 08 | 07 06 05 04 03 02 01 00 | 14 15 16 17 18 19 20 21---RX0_21 -
 R  N [------------- PWM -----------------] T  R  | T  R  T  R  T  R  S  S        22 -
 E  D                                       X  X  | X  X  X  X  X  X  D  C        23 -
 F                                          0  0  | 3  3  2  2  1  1  A  L        24 -
                                            [------- COMMUNICATION -------]       25 -
                                                                                  26 -
                                                                                  27 -
                                                                                  28 -
                                                                                  29 -
                                                                                  30 -
                                                                                  31 -
                                                                                  32 -
                                                                                  33 -
                                                                                  34 -
                                                                                  35 -
                                                                                  36 -
                                                                                  37 -
                                                                                  38 -
                                                                                  39 -
                                                                                  40 -
                                                                                  41 -
                                                                                  42 -
                                                                                  43 -
                                                                                  44 - LIB - LCD 14 (DB7)
                                                                                  45 - LIB - LCD 13 (DB6)
                                                                                  46 - LIB - LCD 12 (DB5)
                                                                                  47 - LIB - LCD 11 (DB4)
                                                                                  48 - LIB - LCD 06 (EN)
                                                                                  49 - LIB - LCD 04 (RS)
                                                                                MISO - 
         R                                                                      MOSI - 
         E  3                                                                    SCK - 
         S  .     G  G  V | [------------------- ANALOG --------------------]     SS - 
         E  3  5  N  N  I | A  A  A  A  A  A  A  A  | A  A  A  A  A  A  A  A     GND - 
         T  V  V  D  D  N | 00 01 02 03 04 05 06 07 | 08 09 10 11 12 13 14 15    GND - 
                            |  |  |  |  |  |  |  |    |  |  |  |  |  |  |  '-----A15 - 
                            |  |  |  |  |  |  |  |    |  |  |  |  |  |  '--------A14 - 
                            |  |  |  |  |  |  |  |    |  |  |  |  |  '-----------A13 - 
                            |  |  |  |  |  |  |  |    |  |  |  |  '--------------A12 - 
                            |  |  |  |  |  |  |  |    |  |  |  '-----------------A11 - 
                            |  |  |  |  |  |  |  |    |  |  '--------------------A10 - 
                            |  |  |  |  |  |  |  |    |  '-----------------------A09 - 
                            |  |  |  |  |  |  |  |    '--------------------------A08 - 
                            |  |  |  |  |  |  |  |
                            |  |  |  |  |  |  |  '-------------------------------A07 - 
                            |  |  |  |  |  |  '----------------------------------A06 - 
                            |  |  |  |  |  '-------------------------------------A05 - 
                            |  |  |  |  '----------------------------------------A04 - 
                            |  |  |  '-------------------------------------------A03 - 
                            |  |  '----------------------------------------------A02 - 
                            |  '-------------------------------------------------A01 - INPUT - LIGHT
                            '----------------------------------------------------A00 - INPUT - TEMP
    (portStruc) {  A0, 'a',  true,  true,  INPUT,  "TEMP", "T" }, (portStruc) {  A1, 'a',  true,  true,  INPUT, "LIGHT", "L" },
    [----------------]
    [  TEMP          ]
    [  36GZ      EMI ] GND
    [  #008     BASE ] A00
    [  797884    COL ] +5
    [----------------]

    [----------------]
    [  LIGHT     IN  ] +5
    [           OUT  ] A01
    [----------------]

*/

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




// function handler for "tone()" bitlash function
//
//	arg 1: pin
//	arg 2: frequency
//	arg 3: duration (optional)
//
numvar func_tone(void) {
	if (getarg(0) == 2) tone(getarg(1), getarg(2));
	else tone(getarg(1), getarg(2), getarg(3));
	return 0;
}

numvar func_notone(void) {
	noTone(getarg(1));
	return 0;
}


//Printing from a user function using the Arduino Serial.print() function works as usual: it goes to the console as you would expect.
//You can also print through Bitlash using the Bitlash printing primitives: sp(), spb(), and speol(), about which you will find more 
//in bitlash-serial.c. If you use the Bitlash printing primitives, you will gain the benefit that any serial output redirection that 
//is in effect when your function is called will be applied to your printed output. In other words, your function can automatically 
//print to whatever pin Bitlash has selected as the output pin.




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










/***
	bitlash-demo.pde

	Bitlash is a tiny language interpreter that provides a serial port shell environment
	for bit banging and hardware hacking.

	This is an example demonstrating how to use the Bitlash2 library for Arduino 0015.

	Bitlash lives at: http://bitlash.net
	The author can be reached at: bill@bitlash.net

	Copyright (C) 2008-2011 Bill Roy

    This library is free software; you can redistribute it and/or
    modify it under the terms of the GNU Lesser General Public
    License as published by the Free Software Foundation; either
    version 2.1 of the License, or (at your option) any later version.

    This library is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
    Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public
    License along with this library; if not, write to the Free Software
    Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
***/

// This is the simplest bitlash integration.

#include "bitlash.h"

void setup(void) {

	// initialize bitlash and set primary serial port baud
	// print startup banner and run the startup macro
	initBitlash(57600);

	// you can execute commands here to set up initial state
	// bear in mind these execute after the startup macro
	// doCommand("print(1+1)");
}

void loop(void) {
	runBitlash();
}
