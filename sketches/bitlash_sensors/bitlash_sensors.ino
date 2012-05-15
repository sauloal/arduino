/*
BITLASH SENSORS
- ADD FUNCTION TO SETUP AND CONNECT TO LCD, REGISTERING IT ON BITLASH
- AUTO LOAD PIR

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



         [------------------------] 
         [                    RED ] +5
         [  PIR (INPUT PIN) BROWN ] 02
         [                  BLACK ] GND
         [------------------------]

         [----------------] MOD          STANDART WEB
         [         LED 01 ] GND
         [         LED 02 ] +5
         [  BACK LIGHT 03 ] 05/VARISTOR +5
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
         [         PWD 14 ] 06/+5
         [         PWR 16 ] GND
         [----------------]
         RS  EN  DB4  DB5  DB6  DB7
         49, 48, 47,  46,  45,  44

         [--------------]
         [            3 ] GND
         [ VARISTOR  -> ] LCD 03 (BACK LIGHT) [CONSIDER CHANGING TO PWM]
         [            1 ] +5
         [--------------]

         [--------------]
         [            3 ] GND
         [ TMP       -> ] A0
         [            1 ] +5
         [--------------]

         [--------------]
         [              ] 08
         [ SD           ] 11
         [              ] 12
         [              ] 13
         [--------------]      
         (LIBRARY NORMALLY USE 10)

         [--------------]
         [              ] 02
         [ WISHIELD     ] 07
         [              ] 08
         [              ] 09
         [              ] 10
         [              ] 11
         [              ] 12
         [              ] 13
         [--------------]      

         
      ,-------------------------------------------------------------------------- PWM 13 - OUTPUT - INTERNAL LED | LIB - SD | LIB - WISHIELD
      |  ,----------------------------------------------------------------------- PWM 12 -                         LIB - SD | LIB - WISHIELD
      |  |  ,-------------------------------------------------------------------- PWM 11 -                         LIB - SD | LIB - WISHIELD
      |  |  |  ,----------------------------------------------------------------- PWM 10 -                                    LIB - WISHIELD
      |  |  |  |  ,-------------------------------------------------------------- PWM 09 -                                    LIB - WISHIELD
      |  |  |  |  |  ,----------------------------------------------------------- PWM 08 -                         LIB - SD | LIB - WISHIELD
      |  |  |  |  |  |
      |  |  |  |  |  |    ,------------------------------------------------------ PWM 07 -                                  | LIB - WISHIELD
      |  |  |  |  |  |    |  ,--------------------------------------------------- PWM 06 -
      |  |  |  |  |  |    |  |  ,------------------------------------------------ PWM 05 - OUTPUT - LCD 3 (BACKLIGHT)
      |  |  |  |  |  |    |  |  |  ,--------------------------------------------- PWM 04 -
      |  |  |  |  |  |    |  |  |  |  ,------------------------------------- INT1 PWM 03 -
      |  |  |  |  |  |    |  |  |  |  |  ,---------------------------------- INT0 PWM 02 - INPUT - PIR BROWN (INPUT)        | LIB - WISHIELD
      |  |  |  |  |  |    |  |  |  |  |  |  ,------------------------------------ TX0 01 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  ,--------------------------------- RX0 00 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    ,---------------------------- TX3 14 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  ,------------------------- RX3 15 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  ,---------------------- TX2 16 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  ,------------------- RX2 17 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  |  ,----------- INT5 TX1 18 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  |  |  ,-------- INT4 RX1 19 -
      |  |  |  |  |  |    |  |  |  |  |  |  |  |    |  |  |  |  |  |  ,----- INT3 SDA 20 -  
 A  G 13 12 11 10 09 08 | 07 06 05 04 03 02 01 00 | 14 15 16 17 18 19 20 21- INT2 SCL 21 -
 R  N [------------- PWM -----------------] T  R  | T  R  T  R  T  R  S  S            22 -
 E  D                                       X  X  | X  X  X  X  X  X  D  C            23 -
 F                                          0  0  | 3  3  2  2  1  1  A  L            24 -
                                            [------- COMMUNICATION -------]           25 -
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
                                                                                SPI MISO - 
         R                                                                      SPI MOSI - 
         E  3                                                                   SPI  SCK - 
         S  .     G  G  V | [------------------- ANALOG --------------------]   SPI   SS - 
         E  3  5  N  N  I | A  A  A  A  A  A  A  A  | A  A  A  A  A  A  A  A         GND - 
         T  V  V  D  D  N | 00 01 02 03 04 05 06 07 | 08 09 10 11 12 13 14 15        GND - 
                            |  |  |  |  |  |  |  |    |  |  |  |  |  |  |  '--------A 15 - 
                            |  |  |  |  |  |  |  |    |  |  |  |  |  |  '-----------A 14 - 
                            |  |  |  |  |  |  |  |    |  |  |  |  |  '--------------A 13 - 
                            |  |  |  |  |  |  |  |    |  |  |  |  '-----------------A 12 - 
                            |  |  |  |  |  |  |  |    |  |  |  '--------------------A 11 - 
                            |  |  |  |  |  |  |  |    |  |  '-----------------------A 10 - 
                            |  |  |  |  |  |  |  |    |  '--------------------------A 09 - 
                            |  |  |  |  |  |  |  |    '-----------------------------A 08 - 
                            |  |  |  |  |  |  |  |
                            |  |  |  |  |  |  |  '----------------------------------A 07 - 
                            |  |  |  |  |  |  '-------------------------------------A 06 - 
                            |  |  |  |  |  '----------------------------------------A 05 - 
                            |  |  |  |  '-------------------------------------------A 04 - 
                            |  |  |  '----------------------------------------------A 03 - 
                            |  |  '-------------------------------------------------A 02 - 
                            |  '----------------------------------------------------A 01 - INPUT - LIGHT
                            '-------------------------------------------------------A 00 - INPUT - TEMP

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
// This is the simplest bitlash integration.
#if defined(ARDUINO) && ARDUINO >= 100
  #include "Arduino.h"
#else
  #include "WProgram.h"
#endif
#include "bitlash.h"


//////////////////////
//// RTC
//////////////////////
//#include <RTClib.h>

//////////////////////
//// PIR
//////////////////////
short unsigned int pirLedPin       = 13; // choose the pin for the LED
short unsigned int pirInputPin     =  2; // choose the input pin (for PIR sensor)
short unsigned int calibrationTime = 30; //the time when the sensor outputs a low impulse
short unsigned int pause           = 5000;  
boolean            lockLow         = true;
boolean            pirNeedInit;
boolean            takeLowTime;  
short unsigned int pirVal;               // variable for reading the pin status
short unsigned int pirState;             // we start, assuming no motion detected
short unsigned int lowIn;
//the amount of milliseconds the sensor has to be low 
//before we assume all motion has stopped





//////////////////////
//// LCD
//////////////////////
// include the library code:
#include <LiquidCrystal.h>

// these constants won't change.  But you can change the size of
// your LCD using them:
//int LCDnumCols = 16;
//int LCDnumRows = 2;


//initialize the library with the numbers of the interface pins
//LiquidCrystal lcd( 7,  8,  9, 10, 11, 12);
//LiquidCrystal lcd(0, 0, 0, 0, 0, 0);
//LiquidCrystal lcd(12, 11, 7, 8, 9, 10);
//boolean lcdNeedInit = true;

// LCD 01  02  03  04  05  06  07  08  09  10  11  12  13  14  15  16
//                 RS  RW  EN                  DB4 DB5 DB6 DB7        
//     LED LED BACK LIGHT                                      PWR PWR
// LCD 01  02  03  04  05  06  07  08  09  10  11  12  13  14  15  16
// STD GRD +5  +5* 12  GRD 11                  05  04  03  02  +5  GRD
// WEB GRD +5  +5* 07  GRD 08                  09  10  11  12  +5  GRD
// MOD GRD +5  +5* 49  GRD 48                  47  46  45  44  +5  GRD
// +5* = can use varistor/pwm for brightness



void SerialPrint(String text){
  //Serial.flush();
  //Serial.print(text);
  Serial.println(text);
  //char textchar[100]; // Or something long enough to hold the longest file name you will ever use.
  //text.toCharArray(textchar, sizeof(text));
  //print textchar;
}

void SerialPrintLn(String text){
  SerialPrint(text + "\n");
}



numvar func_printargs(void){
  int i=0;
  while ( ++i <= getarg(0) ) {
    Serial.print((char *) getarg(i));
  }
  return 0;
}


void LCDprint(short unsigned int cols,
              short unsigned int rows,
              short unsigned int num1, 
              short unsigned int num2, 
              short unsigned int num3, 
              short unsigned int num4, 
              short unsigned int num5, 
              short unsigned int num6,
              String text) {
    LiquidCrystal lcd(num1, num2, num3, num4, num5, num6);
    SerialPrintLn("LCDINIT COLS  "+String(cols)+" ROWS "+String(rows));
    SerialPrintLn("LCDINIT PORTS "+String(num1)+" "+String(num2)+" "+String(num3)+" "+String(num4)+" "+String(num5)+" "+String(num6)+" ");
    lcd.begin(cols, rows);
    lcd.clear();
    // set the cursor to column 0, line 1
    // (note: line 1 is the second row, since counting begins with 0):
      
    // print the number of seconds since reset:
      
    short unsigned int textLenght = (short unsigned int) text.length();
    SerialPrintLn("LCD " + text + " [LENGTH: " + String(textLenght) + "]");
      
    if ( textLenght > cols ) {
      for (short unsigned int p = 0; p < rows; p++ )
      {
        lcd.setCursor(0, p);
        short unsigned int start  = p     * cols;
        short unsigned int finish = start + cols;
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


numvar func_lcdprint(void){
  if (getarg(0) == 9) {
    short unsigned int cols = getarg(1);
    short unsigned int rows = getarg(2);
    short unsigned int num1 = getarg(3);
    short unsigned int num2 = getarg(4);
    short unsigned int num3 = getarg(5);
    short unsigned int num4 = getarg(6);
    short unsigned int num5 = getarg(7);
    short unsigned int num6 = getarg(8);
    char * textc = (char *) getarg(9);
    String text  = String(textc);
    LCDprint(cols, rows, num1, num2, num3, num4, num5, num6, text);
  } else {
    SerialPrintLn("LCD: NOT ENOUGHT ARGUMENTS");
  }
  return 0;
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
  //Serial.begin(115200);

  // initialize bitlash and set primary serial port baud
  // print startup banner and run the startup macro
  initBitlash(115200);

  // you can execute commands here to set up initial state
  // bear in mind these execute after the startup macro
  // doCommand("print(1+1)");
  
  // initialize the digital pin as an output.
  // Pin 13 has an LED connected on most Arduino boards:

  //pirNeedInit = true;
  //lcdNeedInit = true;
  addBitlashFunction("tone",     (bitlash_function) func_tone);
  addBitlashFunction("notone",   (bitlash_function) func_notone);
  addBitlashFunction("lcdprint", (bitlash_function) func_lcdprint);
  addBitlashFunction("printargs",(bitlash_function) func_printargs);
}


void loop(void) {
  runBitlash();
}



/*
function toggle13  { pinmode(13,1); d13 = !d13;}
function readtemp  { pinmode(a0,0); print "temp",a0; }
function readlight { pinmode(a1,0); print "light",a1; }
function lcdbacklight { pinmode(a43,1); pinmode(a42,1); a43 = 1; a42 = 200;  }
lcdprint(16, 2, 49, 48, 44, 45, 46, 47, "hello world 49 48 44 45 46 47")

#function lcdoff       { lcd.noDisplay() }
boot
#function startup {run toggle13,1000; run readtemp,1000; run readlight,1000}
*/
