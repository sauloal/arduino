/* MAX3421E USB Host controller get device descriptor */
/* #include <spi.h> */
/*http://www.circuitsathome.com/mcu/arduino-usb-host-part-3-descriptors*/
#include <Max3421e.h>
#include <Usb.h>

#define LOBYTE(x) ((char*)(&(x)))[0]
#define HIBYTE(x) ((char*)(&(x)))[1]
#define BUFSIZE 256    //buffer size
 
void setup();
void loop();
 
MAX3421E Max;
USB Usb;
 
void setup()
{
  byte tmpdata = 0;
  Serial.begin( 115200 );
  Serial.println("Start");
  Max.powerOn();
  delay( 200 );
}
 
void loop()
{
  byte devD;
  byte strD;
  byte confD;
  Max.Task();
  Usb.Task();
  if( Usb.getUsbTaskState() >= 0x80 ) {  //state configuring or higher
    Serial.print("\r\nGETTING DEVICE DESCRIPTOR\n");
    devD = getdevdescr( 1 );                    //hardcoded device address
    if( devD ) {
      Serial.print("\r\nRequest DEV error. Error code:\t");
      print_hex( devD, 8 );
    } else {
      Serial.print("\r\nSUCCESS GETTING DEVICE DESCRIPTOR\n");
      Serial.print("\r\nGETTING STRING DESCRIPTOR\n");
      strD = getstrdescr( 1, 1 );                 //get string descriptor
      if( strD ) {
        Serial.print("\r\nRequest STR error. Error code:\t");
        print_hex( strD, 8 );
      } else {
        Serial.print("\r\nSUCCESS GETTING STRING DESCRIPTOR\n");
        Serial.print("\r\nGETTING CONFIGURATION DESCRIPTOR\n");
        confD = getconfdescr( 1, 0 );                 //get configuration descriptor
        if( confD ) {
          Serial.print("\r\nRequest CNF error. Error code:\t");
          print_hex( confD, 8 );
        } else {
          Serial.print("\r\nSUCCESS GETTING CONFIGURATION DESCRIPTOR\n");
        }
      }
    }
    while( 1 );                          //stop
  }
}
 
byte getdevdescr( byte addr )
{
  USB_DEVICE_DESCRIPTOR buf;
  byte rcode;
  rcode = Usb.getDevDescr( addr, 0, 0x12, ( char *)&buf );
  if( rcode ) {
    return( rcode );
  }
  Serial.println("Device descriptor: ");
  Serial.print("Descriptor Length:\t");
  print_hex( buf.bLength, 8 );
  Serial.print("\r\nDescriptor type:\t");
  print_hex( buf.bDescriptorType, 8 );
  Serial.print("\r\nUSB version:\t");
  print_hex( buf.bcdUSB, 16 );
  Serial.print("\r\nDevice class:\t");
  print_hex( buf.bDeviceClass, 8 );
  Serial.print("\r\nDevice Subclass:\t");
  print_hex( buf.bDeviceSubClass, 8 );
  Serial.print("\r\nDevice Protocol:\t");
  print_hex( buf.bDeviceProtocol, 8 );
  Serial.print("\r\nMax.packet size:\t");
  print_hex( buf.bMaxPacketSize0, 8 );
  Serial.print("\r\nVendor  ID:\t");
  print_hex( buf.idVendor, 16 );
  Serial.print("\r\nProduct ID:\t");
  print_hex( buf.idProduct, 16 );
  Serial.print("\r\nRevision ID:\t");
  print_hex( buf.bcdDevice, 16 );
  Serial.print("\r\nMfg.string index:\t");
  print_hex( buf.iManufacturer, 8 );
  Serial.print("\r\nProd.string index:\t");
  print_hex( buf.iProduct, 8 );
  Serial.print("\r\nSerial number index:\t");
  print_hex( buf.iSerialNumber, 8 );
  Serial.print("\r\nNumber of conf.:\t");
  print_hex( buf.bNumConfigurations, 8 );
  return( 0 );
}


byte getstrdescr( byte addr, byte idx )
{
  char buf[ 66 ];
  byte rcode;
  byte length;
  byte i;
  unsigned int langid;
  rcode = Usb.getStrDescr( addr, 0, 1, 0, 0, buf );  //get language table length
  if( rcode ) {
    Serial.println("Error retrieving LangID table length");
    return( rcode );
  }
  length = buf[ 0 ];      //length is the first byte
  rcode = Usb.getStrDescr( addr, 0, length, 0, 0, buf );  //get language table
  if( rcode ) {
    Serial.println("Error retrieving LangID table");
    return( rcode );
  }
  HIBYTE( langid ) = buf[ 3 ];                            //get first langid
  LOBYTE( langid ) = buf[ 2 ];
  rcode = Usb.getStrDescr( addr, 0, 1, idx, langid, buf );
  if( rcode ) {
    Serial.println("Error retrieving string length");
    return( rcode );
  }
  length = buf[ 0 ];
  rcode = Usb.getStrDescr( addr, 0, length, idx, langid, buf );
  if( rcode ) {
    Serial.println("Error retrieving string");
    return( rcode );
  }
  for( i = 2; i < length; i+=2 ) {
    Serial.print( buf[ i ] );
  }
  return( rcode );
}


byte getconfdescr( byte addr, byte conf )
{
  char buf[ BUFSIZE ];
  char* buf_ptr = buf;
  byte rcode;
  byte descr_length;
  byte descr_type;
  unsigned int total_length;
  rcode = Usb.getConfDescr( addr, 0, 4, conf, buf );  //get total length
  LOBYTE( total_length ) = buf[ 2 ];
  HIBYTE( total_length ) = buf[ 3 ];
  if( total_length > 256 ) {    //check if total length is larger than buffer
    Serial.println("Total length truncated to 256 bytes");
    total_length = 256;
  }
  rcode = Usb.getConfDescr( addr, 0, total_length, conf, buf ); //get the whole descriptor
  while( buf_ptr < buf + total_length ) {  //parsing descriptors
    descr_length = *( buf_ptr );
    descr_type = *( buf_ptr + 1 );
    switch( descr_type ) {
      case( USB_DESCRIPTOR_CONFIGURATION ):
        printconfdescr( buf_ptr );
        break;
      case( USB_DESCRIPTOR_INTERFACE ):
        printintfdescr( buf_ptr );
        break;
      case( USB_DESCRIPTOR_ENDPOINT ):
        printepdescr( buf_ptr );
        break;
      default:
        printunkdescr( buf_ptr );
        break;
        }//switch( descr_type
    buf_ptr = ( buf_ptr + descr_length );    //advance buffer pointer
  }//while( buf_ptr <=...
  return( 0 );
}


/* function to print configuration descriptor */
void printconfdescr( char* descr_ptr )
{
 USB_CONFIGURATION_DESCRIPTOR* conf_ptr = ( USB_CONFIGURATION_DESCRIPTOR* )descr_ptr;
  Serial.println("Configuration descriptor:");
  Serial.print("Total length:\t");
  print_hex( conf_ptr->wTotalLength, 16 );
  Serial.print("\r\nNum.intf:\t\t");
  print_hex( conf_ptr->bNumInterfaces, 8 );
  Serial.print("\r\nConf.value:\t");
  print_hex( conf_ptr->bConfigurationValue, 8 );
  Serial.print("\r\nConf.string:\t");
  print_hex( conf_ptr->iConfiguration, 8 );
  Serial.print("\r\nAttr.:\t\t");
  print_hex( conf_ptr->bmAttributes, 8 );
  Serial.print("\r\nMax.pwr:\t\t");
  print_hex( conf_ptr->bMaxPower, 8 );
  return;
}
/* function to print interface descriptor */
void printintfdescr( char* descr_ptr )
{
 USB_INTERFACE_DESCRIPTOR* intf_ptr = ( USB_INTERFACE_DESCRIPTOR* )descr_ptr;
  Serial.println("\r\nInterface descriptor:");
  Serial.print("Intf.number:\t");
  print_hex( intf_ptr->bInterfaceNumber, 8 );
  Serial.print("\r\nAlt.:\t\t");
  print_hex( intf_ptr->bAlternateSetting, 8 );
  Serial.print("\r\nEndpoints:\t\t");
  print_hex( intf_ptr->bNumEndpoints, 8 );
  Serial.print("\r\nClass:\t\t");
  print_hex( intf_ptr->bInterfaceClass, 8 );
  Serial.print("\r\nSubclass:\t\t");
  print_hex( intf_ptr->bInterfaceSubClass, 8 );
  Serial.print("\r\nProtocol:\t\t");
  print_hex( intf_ptr->bInterfaceProtocol, 8 );
  Serial.print("\r\nIntf.string:\t");
  print_hex( intf_ptr->iInterface, 8 );
  return;
}
/* function to print endpoint descriptor */
void printepdescr( char* descr_ptr )
{
 USB_ENDPOINT_DESCRIPTOR* ep_ptr = ( USB_ENDPOINT_DESCRIPTOR* )descr_ptr;
  Serial.println("\r\nEndpoint descriptor:");
  Serial.print("Endpoint address:\t");
  print_hex( ep_ptr->bEndpointAddress, 8 );
  Serial.print("\r\nAttr.:\t\t");
  print_hex( ep_ptr->bmAttributes, 8 );
  Serial.print("\r\nMax.pkt size:\t");
  print_hex( ep_ptr->wMaxPacketSize, 16 );
  Serial.print("\r\nPolling interval:\t");
  print_hex( ep_ptr->bInterval, 8 );
  return;
}
/*function to print unknown descriptor */
void printunkdescr( char* descr_ptr )
{
  byte length = *descr_ptr;
  byte i;
  Serial.println("\r\nUnknown descriptor:");
  Serial. print("Length:\t\t");
  print_hex( *descr_ptr, 8 );
  Serial.print("\r\nType:\t\t");
  print_hex( *(descr_ptr + 1 ), 8 );
  Serial.print("\r\nContents:\t");
  descr_ptr += 2;
  for( i = 0; i < length; i++ ) {
    print_hex( *descr_ptr, 8 );
    descr_ptr++;
  }
}

 
/* prints hex numbers with leading zeroes */
// copyright, Peter H Anderson, Baltimore, MD, Nov, '07
// source: http://www.phanderson.com/arduino/arduino_display.html
void print_hex(int v, int num_places)
{
  int mask=0, n, num_nibbles, digit;
 
  for (n=1; n<=num_places; n++)
  {
    mask = (mask << 1) | 0x0001;
  }
  v = v & mask; // truncate v to specified number of places
 
  num_nibbles = num_places / 4;
  if ((num_places % 4) != 0)
  {
    ++num_nibbles;
  }
 
  do
  {
    digit = ((v >> (num_nibbles-1) * 4)) & 0x0f;
    Serial.print(digit, HEX);
  }
  while(--num_nibbles);
 
}


