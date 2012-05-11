#include <max3421e.h>
#include <Usb.h>
//https://github.com/felis/USB_Host_Shield_2.0/blob/master/examples/adk/term_test/term_test.pde


USB Usb;
//USBHub     Hub(&Usb);

void setup()
{
	Serial.begin(115200);
	Serial.println("\r\nADK demo start");
        
        if (Usb.Init() == -1) {
          Serial.println("OSCOKIRQ failed to assert");
        while(1); //halt
        }//if (Usb.Init() == -1...
}

void loop()
{
  uint8_t rcode;
  uint8_t msg[64] = { 0x00 };
  const char* recv = "Received: "; 
   
   Usb.Task();
   
   if( adk.isReady() == false ) {
     return;
   }
   uint16_t len = 64;
   
   rcode = adk.RcvData(&len, msg);
   if( rcode & ( rcode != hrNAK )) {
     USBTRACE2("Data rcv. :", rcode );
   } 
   if(len > 0) {
     USBTRACE("\r\nData Packet.");

    for( uint8_t i = 0; i < len; i++ ) {
      Serial.print((char)msg[i]);
    }
    /* sending back what was received */    
    rcode = adk.SndData( strlen( recv ), (uint8_t *)recv );    
    rcode = adk.SndData( strlen(( char * )msg ), msg );

   }//if( len > 0 )...

   delay( 1000 );       
}

