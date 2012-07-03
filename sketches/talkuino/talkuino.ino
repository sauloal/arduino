#include <Base64.h>

void SerialPrint(String text){
  Serial.flush();
  Serial.print(text);
}

void SerialPrintLn(String text){
  SerialPrint(text + "\n");
}



//global
#define DEBUG       False // print debuf information
#define ARDUINOID       1 // id for this particular ID
#define MAXSIZE       128 // max size before flushing
#define MAXFUNCSIZE  8352 // max size of data to be passed to function
#define MAXNUMFUNC     95 // max number of registered functions

//control
#define MINVAL         33 // !
#define MAXVAL        126 // ~

#define INCOMINGSTART  30 //  RS (record separator)
#define INCOMINGEND    31 //  US (unit separator)

#define DIRECTIN       40 // ( IN  TO   ARD
#define DIRECTOU       41 // ) OUT FROM ARD

#define TYPEPORT       80 // P PORT
#define TYPEFUNC       70 // F FUNCTION

//port
#define RWREAD         82 // R READ  PORT
#define RWWRITE        87 // W WRITE PORT

#define DADIGITAL      68 // D DIGITAL
#define DAANALOG       65 // A ANALOGIC

#define PORTLEN         2 // number of chars to
                          // describe port values

//function
#define DATABEG         2 // STX BEGIN FUNCTION DATA
#define DATAEND         3 // EXT END   FUNCTION DATA

#define PARTONLYONE    33 // ! Only one data. do not expect more pieces
#define PARTLASTPIECE 126 // ~ Last piece marker
#define PARTMAXVAL    125 // | maximum number of pieces

int                     buffer[MAXSIZE];
char                    functionBuffer[MAXFUNCSIZE];
int                     functionBufferPos;
typedef void (*pt2Function) (char *);
pt2Function             functions[MAXNUMFUNC];

//char                    incomingByte;
int                     currPos;
int                     beginPos;
int                     endPos;
int                     maxVar;

void LCDPrint64(char * input){
  #ifdef DEBUG
    Serial.println("LCDPrint64 INPUT "+String(input));
  #endif
  
  char * text;
  int len;
  base64_decode(text, input, len);
  
  #ifdef DEBUG
    Serial.println("LCDPrint64 DECODED "+String(text));
  #endif
  
  //LCDPrint(String(text));
}

void SerialPrint64(char * input){
  #ifdef DEBUG
    Serial.println("SerialPrint64 INPUT "+String(input));
  #endif
  
  char * text;
  int len;
  base64_decode(text, input, len);
  
  #ifdef DEBUG
    Serial.println("SerialPrint64 DECODED "+String(text));
  #endif
  
  SerialPrint(String(text));
}


int parseIntPort( int val[] ){
  #ifdef DEBUG
    Serial.print("parseIntPort INPUT ");
    printArrayInt(val, PORTLEN - 1);
  #endif
  
  int res = 0;
  int multiplier = val[0] - MINVAL;
  int remainder  = val[1] - MINVAL;
  res = (multiplier * maxVar) + remainder;
  
  #ifdef DEBUG
    Serial.println("parseIntPort RES "+String(res));
  #endif
  
  return res;
}

void makeIntPort( int value, char res[] ){
  #ifdef DEBUG
    Serial.println("makeIntPort INPUT "+String(value));
  #endif
  
  int multiplier = value / maxVar;
  int remainder  = value - (multiplier * maxVar);
  res[0] = char(MINVAL + multiplier);
  res[1] = char(MINVAL + remainder);

  #ifdef DEBUG
    Serial.print("makeIntPort multiplier " + String(multiplier) + " REMAINDER " + String(remainder) + " RES ");
    printArrayChar(res, PORTLEN - 1);    
  #endif
}

void returnPortRes(int rndId, int port, int rw, int da, char res []){
  #ifdef DEBUG
    //Serial.println("MSGID " + String(char(rndId)));
    Serial.print("returnPortRes RNDID " + String(char(rndId)));
    //Serial.print(rndId, DEC);
    Serial.print(" PORT " + String(port) + " ");
    //Serial.print(port, DEC);
    Serial.print(" RW " + String(char(rw)) + " ");
    //Serial.print(rw, DEC);
    Serial.print(" DA " + String(char(da)) + " ");
    //Serial.print(da, DEC);
    Serial.print(" VAL ");
    printArrayChar(res, PORTLEN - 1);
  #endif

  int responseLength = 7 + PORTLEN + 1;
  char response[responseLength];
  int valSize = sizeof(response)/sizeof(char);
  Serial.println("(" + String(valSize) + ") ");
  
  response[0] = char(ARDUINOID + MINVAL);
  response[1] = char(rndId);
  response[2] = char(DIRECTOU);
  response[3] = char(TYPEPORT);
  response[4] = char(port + MINVAL);
  response[5] = char(rw);
  response[6] = char(da);
  for (int pos = 0; pos < PORTLEN; pos++) {
    #ifdef DEBUG
      Serial.println(" returnPortRes POS " + String(pos) + " " + String(7 + pos) + " VAL " + char(res[pos]) + " MAX " + PORTLEN);
      //Serial.flush();
    #endif  
    response[7 + pos] = res[pos];
  }
  
  Serial.println(" returnPortRes POS " + String(7 + PORTLEN) + " VAL " + char(ARDUINOID + MINVAL) + " MAX " + String(responseLength));
  response[7 + PORTLEN] = char(ARDUINOID + MINVAL);
  response[8 + PORTLEN] = char(0);
  
  #ifdef DEBUG
    Serial.print("returnPortRes RESPONSE ");
    Serial.print("(" + String(valSize) + ") ");

    printArrayChar(response, responseLength - 1);

    Serial.print("'");
    Serial.print(response);
    Serial.println("'");
  #endif
  
  Serial.flush();
  Serial.println(char(INCOMINGSTART) + String(response) + char(INCOMINGEND));
  Serial.flush();
}

void portParser(int rndId, int port, int rw, int da, int value){
  #ifdef DEBUG
    //Serial.println("MSGID " + String(char(rndId)));
    Serial.print("portParser RNDID " + String(char(rndId)));
    //Serial.print(rndId, DEC);
    Serial.print(" PORT " + String(port) + " ");
    //Serial.print(port, DEC);
    Serial.print(" RW " + String(char(rw)) + " ");
    //Serial.print(rw, DEC);
    Serial.print(" DA " + String(char(da)) + " ");
    //Serial.print(da, DEC);
    Serial.print(" VAL ");
    Serial.println(value, DEC);
  #endif

  int out   = 0;
  switch (rw) {
    case RWREAD:
      switch (da) {
        case DADIGITAL:
          out = digitalRead(port);
          break;
        case DAANALOG:
          out = analogRead(port);
          break;
      }// end switch da
    case RWWRITE:
      switch (da) {
        case DADIGITAL:
          digitalWrite(port, value);
          break;
        case DAANALOG:
          analogWrite(port, value);
          break;
      }// end switch da
  } // end switch rw

  char res[PORTLEN];
  makeIntPort(out, &res[0]);

  #ifdef DEBUG
    Serial.print("portParser RESPONSE RAW ");
    Serial.print(out, DEC);
    Serial.print(" VAL ");
    printArrayChar(res, PORTLEN -1);
  #endif
  
  returnPortRes(rndId, port, rw, da, res);
}



void functionParser(int rndId, int part, int funcId, int * val){
  int valSize = sizeof(val)/sizeof(int);
  #ifdef DEBUG
    Serial.print("functionParser RNDID " + String(char(rndId)) + " ");
    //Serial.print(rndId, DEC);
    Serial.print(" PART " + String(char(part + MINVAL)) + " ");
    //Serial.print(part, DEC);
    Serial.print(" FUNCID " + String(char(funcId + MINVAL)) + " ");
    Serial.print(funcId, DEC);
    //Serial.print(" VAL ");
    printArrayInt(val, valSize);
  #endif

  for ( int s = 0; s < valSize; s++ ) {
    functionBuffer[functionBufferPos + s]  = val[s];
    functionBufferPos                     += 1;
  }
  
  //TODO: INCOMPLETE
  if ( part == PARTONLYONE ) {
    functionBufferPos = 0;
  } else {
    
  }
}


#ifdef DEBUG
  void printArrayInt(int seq[], int posEnd) {
    int valSize = sizeof(seq)/sizeof(int);
    //Serial.println("SIZE "+String(valSize) + " ");
    
    for ( int s = 0; s <= posEnd; s++ ) {
      //Serial.println("S "+String(s) + " ");
      int  num = seq[s];
      //Serial.println("N "+String(num)+" ");
      char val = char(seq[s]);
      //Serial.println("V "+String(val));
      Serial.print("'" + String(val) + "'");
      Serial.print(" ");
    }
    Serial.println("");
  }
  
  
  void printArrayChar(char seq[], int posEnd) {
    int valSize = sizeof(seq)/sizeof(char);
    //Serial.println("SIZE "+String(valSize) + " ");
    Serial.println("SIZE "+String(posEnd) + " ");
    
    for ( int s = 0; s <= posEnd; s++ ) {
      Serial.print("S "+String(s) + " ");
      int  num = seq[s];
      Serial.print("N "+String(num)+" ");
      char val = seq[s];
      Serial.print("V " +String(val));
      Serial.print(" '" + String(val) + "'");
      Serial.print(" ");
    }
    Serial.println("");
  }
#endif


void parseVal(int seq[], int posBegin, int posEnd) {
  #ifdef DEBUG
    Serial.print("parseVal SEQ POSBEGIN ");
    Serial.print(posBegin, DEC);
    Serial.print(" POSEND ");
    Serial.println(posEnd, DEC);
    printArrayInt(seq, posEnd);
  #endif

  int id1 = seq[posBegin];
  int id2 = seq[posEnd  ];
  int ardiunoIdVal = ARDUINOID+MINVAL;
    
  if ( id1 == id2 ) {
    #ifdef DEBUG
      Serial.println("ID1 " + String(char(id1)) + " ID2 " + String(char(id2)) + " CURR ARDUINO ID " + String(char(ardiunoIdVal)));
    #endif
    
    if ( id1 == ardiunoIdVal ) { // message for/from me
      int rndId  = seq[posBegin+1];   // random identifier of message
      int direct = seq[posBegin+2];   
      #ifdef DEBUG
        Serial.println("MSGID " + String(char(rndId)) + " DIRECT " + String(char(direct)));;
      #endif

      if (direct == DIRECTIN) {       //IN
        int type   = seq[posBegin+3];

        if (type == TYPEPORT) {  //port
          int port   = seq[posBegin+4] - MINVAL;
          int rw     = seq[posBegin+5];
          int da     = seq[posBegin+6];

          #ifdef DEBUG
            Serial.println("TYPE " + String(char(type)) + " PORT " + String(port) + " RW " + String(char(rw)) + " DA " + String(char(da)));
          #endif

          int val[PORTLEN];
          for ( int i = 0; i < PORTLEN; i++ ){ // extract value
            val[i] = seq[posBegin+7+i];
            #ifdef DEBUG
              Serial.println("  POS " + String(posBegin+7+i) + " VAL " + String(seq[posBegin+7+i]) + " CHAR " + String(char(seq[posBegin+7+i])));
            #endif

          }

          int dataEnd = posBegin + 7 + PORTLEN;
          int value   = parseIntPort(val);          
          if ( dataEnd == posEnd) { // check boundaries
            portParser(rndId, port, rw, da, value);
          } else {
            #ifdef DEBUG
              Serial.println("WEIRD BOUNDARIES. END OF DATA (" + String(dataEnd) + ") DOES NOT MATCHES END OF STRING (" + String(posEnd) + ")");
            #endif
          }
        }
        else if (type == TYPEFUNC) {  // function
          int part    = seq[posBegin+4] - MINVAL;
          int funcId  = seq[posBegin+5] - MINVAL;
          int dataBeg = seq[posBegin+6];
          int dataEnd = seq[posEnd  -2];
          #ifdef DEBUG
            Serial.println("TYPE " + String(type) + " PART " + String(part) + " FUNCID " + String(funcId) + " DATA BEGIN " + String(dataBeg) + " DATA END " + String(dataEnd));
          #endif

//          if ( dataBeg == DATABEG && dataEnd == DATAEND ){
//            int datalen = posBegin + 7 - posEnd -2;
//            if ( datalen >= 1) {
//              int val[datalen];
//              for (int pos = posBegin + 8; pos < posEnd -2; pos++)  {
//                val[pos-posBegin] = seq[pos];
//              }
//              functionParser(rndId, part, funcId, val);
//            } else {
//              //ERROR. NO DATA
//            }
//          } else {
//            // ERROR
//          }
        } else { // end id type
          #ifdef DEBUG
            Serial.println("UNKNOWN TYPE" + String(char(type)));
          #endif 
        }
      } // end direct in
      else if (direct == DIRECTOU) { //OUT
        #ifdef DEBUG
          Serial.println("DIRECTION OUT. IGNORE.");
        #endif 
      } // end direct out
    } else { // arduinoid == id
      #ifdef DEBUG
        Serial.println("NOT ID OF THIS ARDUINO: ID1 " + String(char(id1)) + " ID2 " + String(char(id2)));
      #endif 
    }
  } else { // end id1 == id2
    #ifdef DEBUG
      Serial.println("NON MATCHING IDs: ID1 " + String(char(id1)) + " ID2 " + String(char(id2)) + " CURR ARDUINO ID " + String(char(ardiunoIdVal)));
    #endif 
  }
}


void setup() {
  //Serial.begin(9600);
  Serial.begin(115200);

  Serial.println("SETUP");
  //pinMode(13, OUTPUT);

  // set up the LCD's number of columns and rows: 
  //  lcd.begin(LCDnumCols,LCDnumRows);
  //  lcd.clear();
  //  LCDPrint("Initializing... please wait");
  
  // initialize the digital pin as an output.
  // Pin 13 has an LED connected on most Arduino boards:

  //needInit    = true;
  //pirNeedInit = true;
  //initPorts();
  currPos           =  0;
  beginPos          = -1;
  endPos            = -1;
  functionBufferPos = 0;
  functions[0]      = &LCDPrint64;
  functions[1]      = &SerialPrint64;
  maxVar            = MAXVAL - MINVAL;
  //Serial.println("SETUP2");
}



void loop(){
// send data only when you receive data:
  if (Serial.available() > 0) {
    // read the incoming byte:
    char incomingByte = Serial.read();
    //if ( incomingByte )

    #ifdef DEBUG
    Serial.print("I received: ");
    Serial.print(incomingByte);
    Serial.print(" ");
    Serial.print(incomingByte, DEC);
    Serial.print(" POS ");
    Serial.println(currPos, DEC);
    #endif

    if (incomingByte == INCOMINGSTART) {
      #ifdef DEBUG
        Serial.println(" RECOGNIZED BEGIN");
      #endif
      
      if (beginPos == -1) {
        #ifdef DEBUG
          Serial.println("   NEW BEGIN");
        #endif
        currPos  = 0;
        beginPos = currPos;
        
      } else {
        #ifdef DEBUG
          Serial.println("   BEGIN ELREADY OPEN. ERROR. RESETING");
        #endif
        
        //ERROR
        beginPos = -1;
        endPos   = -1;
        currPos  =  0;
      }
    }
    else if (incomingByte == INCOMINGEND) {
      #ifdef DEBUG
        Serial.println(" RECOGNIZED END");
      #endif
      
      if (endPos == -1) {
        #ifdef DEBUG
          Serial.println("   NEW END");
        #endif
        
        endPos = currPos;
        if (beginPos != -1) {
          //SEND
          #ifdef DEBUG
            Serial.println("     SENDING");
          #endif
          
          parseVal(buffer, beginPos, endPos - 1);
          beginPos = -1;
          endPos   = -1;
          currPos  =  0;
        } else { // end beginpos != -1
          #ifdef DEBUG
            Serial.println("   END FOUND WITHOUT A BEGIN. ERROR. RESETING");
          #endif
          
          beginPos = -1;
          endPos   = -1;
          currPos  =  0;
          //ERROR
        }
      } else { // else endpos == -1
        //ERROR
        #ifdef DEBUG
          Serial.println("   END ELREADY OPEN. ERROR. RESETING");
        #endif
        
        beginPos = -1;
        endPos   = -1;
        currPos  =  0;
      } // end else endpos == -1
    }// end elsif incoming end
    else // else not begin or end
    {
      if ( beginPos != -1 ) {
        buffer[currPos]  = incomingByte;
        
        #ifdef DEBUG
          Serial.println("     ADDING " + String(char(incomingByte)));
          Serial.println(incomingByte, DEC);
        printArrayInt(buffer, currPos);
        #endif

        currPos += 1;
      } // end beginpoe != -1
    } // end else not begin or end
  } // end serial available
} // end loop

//void loop() {

//  processPorts();
//  //pir();
//  pir2();
  
//  SerialPrintLn("High");
//  digitalWrite(13, HIGH);   // set the LED on
//  delay(1000);     // wait for a second
  
//  processPorts();
//  SerialPrintLn("Low");
//  digitalWrite(13, LOW);    // set the LED off
//  delay(1000);              // wait for a second
//}

