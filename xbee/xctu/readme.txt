The Linux FTDI USB driver provided is version 1.2.1.  More information on the driver, 
including updated versions can be found at http://ftdi-usb-sio.sourceforge.net/.  The driver 
should be compiled either as a loadable module or into a kernel.  The PID should be changed in the header file to "0xEE18" which corresponds to the PID used 
on FTDI USB Converter in the MaxStream PKG-U.  