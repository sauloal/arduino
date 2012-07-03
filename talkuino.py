#!/usr/bin/python
import serial
import sys
import os
import time

#baud=9600
#baud=57600
baud=115200
tty=None



for i in range(9):
	if not tty is None:
		print "found already"
		break

	for type in ['ACM', 'USB']:
		ttyL = '/dev/tty' + type + str(i)
		if os.path.lexists(ttyL):
			print "Serial port " + ttyL + " exists"
			tty = ttyL
			break
		else:
			print "Serial port " + ttyL + " does not exists"

if tty is None:
	print "NO TTY FOUND"
	exit(1)



#easy_install --user pyserial
#http://arduino.cc/playground/Interfacing/Python
#http://www.gpsbabel.org/os/Linux_Hotplug.html

SOH='\x01'
STX='\x02'
ETX='\x03'
ETB='\x17'


#ARDUINOID         0 # id for this particular ID
MAXSIZE       =  128 # max size before flushing
MAXFUNCSIZE   = 8352 # max size of data to be passed to function

#control
MINVAL        =   33 # !
MAXVAL        =  126 # ~
MAXNUMFUNC    =  MAXVAL - MINVAL# max number of registered functions
PORTLEN       =    2 # number of chars to
					 # describe port values

INCOMINGSTART = SOH  # SOH
INCOMINGEND   = ETB  # ETB

DIRECTIN      = "("  # ( IN  TO   ARD
DIRECTOU      = ")"  # ) OUT FROM ARD

TYPEPORT      = 'P'  # P PORT
TYPEFUNC      = 'F'  # F FUNCTION

#port
RWREAD        = "R"  # R READ  PORT
RWWRITE       = "W"  # W WRITE PORT

DADIGITAL     = "D"  # D DIGITAL
DAANALOG      = "A"  # A ANALOGIC

#function
DATABEG       = STX  # STX BEGIN FUNCTION DATA
DATAEND       = ETX  # EXT END   FUNCTION DATA

PARTONLYONE   = '!'  # ! Only one data. do not expect more pieces
PARTLASTPIECE = '~'  # ~ Last piece marker
PARTMAXVAL    = '|'  # | maximum number of pieces



if not os.path.lexists(tty):
	print "Serial port " + tty + " does not exists"
	exit(1)
else:
	print "Serial port " + tty + " exists"





try:
	serR = serial.Serial(tty, baud)
	print "Serial port " + tty + " open"
except serial.SerialException:
	print "Serial port " + tty + " closed"
	exit(1)
time.sleep(1)


def genVal(val, pos=0):
	maxVal = MAXVAL - MINVAL
	print "POS ",pos,"VAL",val,"MAX",maxVal
	
	multiplier = val / maxVal
	remainder  = val - (multiplier * maxVal)
	res        = chr(MINVAL + multiplier) + chr(MINVAL + remainder)

	return res

def splitLine(line):
	for c in line:
		print "'" + c + "' (" + str(ord(c)) + ") ",


def main():
	arduinoId    =  1
	portNum      = 13
	val          = 330
	msgId        = 12
	msgIdVal     = chr(MINVAL + msgId)
	arduinoIdVal = chr(MINVAL + arduinoId)
	portNumVal   = chr(MINVAL + portNum)
	
	try:
		valVal       = genVal(val)
	except ValueError:
		sys.stderr.write("ERROR. value "+str(val)+" too big. MAX VALUE IS " + str((MAXVAL-MINVAL) * PORTLEN)+"\n")
		
		sys.exit(1)
		
	print "INCOMING START",INCOMINGSTART
	print "ARDUINO ID"    ,arduinoId, "VAL", arduinoIdVal
	print "PORT NUM"      ,portNum  , "VAL", portNumVal
	print "VAL"           ,val      , "NUM", valVal
	print "INCOMING END"  ,INCOMINGEND

	message      = arduinoIdVal + msgIdVal + DIRECTIN + TYPEPORT + portNumVal + RWWRITE + DADIGITAL + valVal + arduinoIdVal
	#              arduino id     msgid      direction  type       port         RW        DA          val      arduinoid
	print "SENDING MESSAGE",message
	
	try:
		print "WAITING FOR LINE"
		i = 0
		while i < 1:
			#print "reading line ",
			line  = serR.readline().strip()
			print "READ '",line,"'"
			splitLine(line)
			print ""
			i    += 1
	except serial.SerialException:
		print "Serial port " + tty + " closed"
		exit(1)
	
	
	print "MESSAGE: '"+message+"'"
	try:
		serR.write(INCOMINGSTART + message + INCOMINGEND)
	except serial.SerialException:
		print "Serial port " + tty + " closed"
		exit(1)
	
	
	
	try:
		print "WAITING FOR LINE"
		while True:
			#print "reading line"
			line  = serR.readline()
			line  = line.strip()
			#line = line.replace(STX, '')
			#line = line.replace(ETX, '')
			print "READ '"+line+"'"
			splitLine(line)
			print ""
			#print "RFID NUM: " + str(line)
			#for c in line:
			#	print "C : " + str(c) + " " + str(ord(c))
			#print "False"
	
	except serial.SerialException:
		print "Serial port " + tty + " closed"
		exit(1)
	
	#if len(sys.argv) > 1:
	#	message = " ".join(sys.argv[1:])
	#	print "MESSAGE " + message
	#	try:
	#		serR.write(message)
	#	except serial.SerialException:
	#		print "Serial port " + tty + " closed"
	#		exit(1)
	#
	#else:
	#	print "READING"
	#	try:
	#		while True:
	#			#print "reading line"
	#			line = serR.readline()
	#			line = line.rstrip()
	#			line = line.replace(STX, '')
	#			line = line.replace(ETX, '')
	#			print str(line)
	#			#print "RFID NUM: " + str(line)
	#			#for c in line:
	#			#	print "C : " + str(c) + " " + str(ord(c))
	#		print "False"
	#
	#	except serial.SerialException:
	#		print "Serial port " + tty + " closed"
	#		exit(1)
	
	
	
	print "out of the loop"
	#serW = serial.Serial('/dev/'+tty, baud
	#serW.write('5')

if __name__ == '__main__': main()