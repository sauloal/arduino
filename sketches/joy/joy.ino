#include <Max3421e.h>
#include <Usb.h>
//http://www.arduino.cc/cgi-bin/yabb2/YaBB.pl?num=1291962130


#define joy_Addr      0x01
#define joy_outAddr   0x01
#define EP_MaxPktSize 0x08
#define EP_POLL       0x0A
#define joy_inAddr    0x01
#define joy_NUM_EP    0x02

#define joy_DESCR_LEN  0x8B
#define joy_VID_LO     0x6D
#define joy_VID_HI     0x04
#define joy_PID_LO     0x86
#define joy_PID_HI     0xC2
#define joy_CONFIG     0x01
#define joy_Report_len 0x07

#define CONTROL_EP     0x00
#define OUTPUT_EP      0x01
#define INPUT_EP       0x81

#define EP_INTERRUPT   0x03


EP_RECORD ep_record[ joy_NUM_EP ];

char descrBuf[ 0x12 ] = {
  0 };
char buf[ 4 ] = {
  0 };
char oldBuf[ 4 ] = {
  0 };


MAX3421E Max;
USB Usb;

void setup(){
  Serial.begin( 115200 ); // begin serial with baud of 115200
  Max.powerOn();
  delay(200);

  Serial.print( "Start" );

  delay(200);
}

void loop(){
  
  byte temp;
  byte rcode;
  
  Max.Task();
  Usb.Task();
  
  Serial.print( "\n State: " );
  
  temp = Usb.getUsbTaskState();   //for testing
  
  Serial.print( temp, HEX );   //for testing
  
  if (Usb.getUsbTaskState()   != USB_STATE_CONFIGURING ){

  delay(200);
    
    
}
  
 // Usb.setUsbTaskState(0x70);
  
  //joy_init();
  
  if( Usb.getUsbTaskState() == USB_STATE_CONFIGURING ) {  //wait for addressing state
    joy_init();
    Usb.setUsbTaskState( USB_STATE_RUNNING );
    
    Serial.print( " configuring done " );
  }
  if( Usb.getUsbTaskState() == USB_STATE_RUNNING ) {  //poll the joystick
    joy_poll();
    
    Serial.print( " running " );
  }  
  
  delay(200);
}  


void joy_init( void ){
  
  
  byte rcode = 0;  //retrun code
  byte i;
  
  ep_record[ CONTROL_EP ]            = *( Usb.getDevTableEntry( 0,0 ));
  ep_record[ OUTPUT_EP  ].epAddr     = joy_outAddr;
  ep_record[ OUTPUT_EP  ].Attr       = EP_INTERRUPT;    
  ep_record[ OUTPUT_EP  ].MaxPktSize = EP_MaxPktSize;  
  ep_record[ OUTPUT_EP  ].Interval   = EP_POLL;        
  ep_record[ OUTPUT_EP  ].sndToggle  = bmSNDTOG0;
  ep_record[ OUTPUT_EP  ].rcvToggle  = bmRCVTOG0;
  
  ep_record[ INPUT_EP   ].epAddr     = joy_inAddr;
  ep_record[ INPUT_EP   ].Attr       = EP_INTERRUPT;
  ep_record[ INPUT_EP   ].MaxPktSize = EP_MaxPktSize;
  ep_record[ INPUT_EP   ].Interval   = EP_POLL;
  ep_record[ OUTPUT_EP  ].sndToggle  = bmSNDTOG0;
  ep_record[ OUTPUT_EP  ].rcvToggle  = bmRCVTOG0;
  

  Usb.setDevTableEntry( joy_Addr, ep_record );

   Serial.print( "\n init" );
  
  rcode = Usb.getDevDescr( joy_Addr, ep_record[ CONTROL_EP ].epAddr, joy_DESCR_LEN, descrBuf );
  if( rcode ) {
    Serial.print("Error attempting read device descriptor. Return code :");
    Serial.println( rcode, HEX );
    while(1);  //stop
  }

//  if((descrBuf[ 8 ] != joy_VID_LO) || (descrBuf[ 9 ] != joy_VID_HI) || (descrBuf[ 10 ] != joy_PID_LO) || (descrBuf[ 11 ] != joy_PID_HI) ){
//    Serial.print("Unsupported USB Device");
//   while(1);  //stop
//  }  
  
//  rcode = Usb.setConf( joy_Addr, ep_record[ CONTROL_EP ].epAddr, joy_CONFIG );                    
//  if( rcode ) {
//    Serial.print("Error attempting to configure Logitech Force 3d Pro. Return code :");
//    Serial.println( rcode, HEX );
//    while(1);  //stop
  
//  Serial.println("Logitech Force 3d Pro initialized");
//  Serial.println("");
//  Serial.println("");
//  Serial.println("");
//  delay(200);
  
  }
}

void joy_poll( void ){

  byte rcode = 0;

  rcode = Usb.inTransfer( joy_Addr, ep_record[ INPUT_EP ].epAddr, joy_Report_len, buf);
  
  if( rcode != 0 ) {
    
    
    Serial.println( buf[ 0 ], DEC);
    Serial.println( buf[ 1 ], DEC);
    Serial.println( buf[ 2 ], DEC);
    Serial.println( buf[ 3 ], DEC);
    
    return;
  }

  return;
  
}

void joy_test( void ){
  
  byte rcode;
  
   rcode = Usb.getDevDescr( joy_Addr, 0x00 , joy_DESCR_LEN, descrBuf );
  if( rcode ) {
    Serial.print("Error attempting read device descriptor. Return code :");
    Serial.println( rcode, HEX );
    while(1);  //stop
  }
   return;
  
  
}   

