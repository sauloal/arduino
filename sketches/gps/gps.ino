/* USB Host to PL2303-based USB GPS unit interface */
/* Navibee GM720 receiver - Sirf Star III */
/* USB support */
/*https://github.com/felis/USB_Host_Shield_2.0/blob/master/examples/pl2303/pl2303_gps/pl2303_gps.pde*/
#include <Max3421e.h>
#include <Usb.h>
/* Debug support */




USB     Usb;
uint32_t read_delay;
#define READ_DELAY 100

void setup()
{
  Serial.begin( 115200 );
  Serial.println("Start");

  if (Usb.Init() == -1) {
      Serial.println("OSCOKIRQ failed to assert");
  }
      
  delay( 200 ); 
}

void loop()
{
uint8_t rcode;
uint8_t  buf[64];    //serial buffer equals Max.packet size of bulk-IN endpoint           
uint16_t rcvd = 64;   

  Usb.Task();
    
    if( Pl.isReady()) {  
       /* reading the GPS */
       if( read_delay < millis() ){
       read_delay += READ_DELAY;  
       rcode = Pl.RcvData(&rcvd, buf);
        if ( rcode && rcode != hrNAK )
           ErrorMessage<uint8_t>(PSTR("Ret"), rcode);            
            if( rcvd ) { //more than zero bytes received
              for( uint16_t i=0; i < rcvd; i++ ) {
                  Serial.print((char)buf[i]); //printing on the screen
              }//for( uint16_t i=0; i < rcvd; i++...              
            }//if( rcvd
       }//if( read_delay > millis()...            
    }//if( Usb.getUsbTaskState() == USB_STATE_RUNNING..    
}
