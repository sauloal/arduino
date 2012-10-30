#!/usr/bin/python
import serial
import sys
import os.path
import csv

#baud=9600
#baud=57600
baud=115200
tty=None


machineName = 'MegaAdk'
sensorName  = 'PIR'
date        = 'curDate'
value       = 120

import csv
CSV_FILE = 'connect.csv'


#>>> spamReader = csv.reader(open('eggs.csv', 'rb'), delimiter=' ', quotechar='|')
#>>> for row in spamReader:
#...     print ', '.join(row)

csvw = csv.writer(open(CSV_FILE, 'ab'), delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
csvw.writerow([machineName, sensorName, date, value])



#exit(0)



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

STX='\x02'
ETX='\x03'



if not os.path.lexists(tty):
	print "Serial port " + tty + " does not exists"
	exit(1)
else:
	print "Serial port " + tty + " exists"



import time

try:
	serR = serial.Serial(tty, baud)
	#serR.timeout = 0
	print "Serial port " + tty + " open"

	while not serR.isOpen() or not serR.readable() or not serR.writable():
		#print "sleeping. waiting %d" % serR.inWaiting()
		time.sleep(.1)

	print "sleeping. waiting %d" % serR.inWaiting()

	buffer = ''

	if len(sys.argv) > 1:
		message = " ".join(sys.argv[1:])
		print "MESSAGE " + message
		serR.write(message)
	else:
		#print "READING"
		try:
			while True:
				#print "reading line"
				#print "waiting %d" % serR.inWaiting()
				buffer = buffer + serR.read(serR.inWaiting())
				print "buffer '"+buffer+"'"
				
				if '\n' in buffer:
					#print "  inside"
					lines = buffer.split('\n')
					buffer = buffer[buffer.rindex('\n')]
					if buffer == '\n': buffer = ''
					
					#line = serR.read(serR.inWaiting())
					for line in lines:
						#print "  got line '"+line+"'"
						line = line.rstrip()
						line = line.replace(STX, '')
						line = line.replace(ETX, '')
						print str(line)
						#print "RFID NUM: " + str(line)
						#for c in line:
						#	print "C : " + str(c) + " " + str(ord(c))
				time.sleep(0.2)
			print "False"

		except serial.SerialException:
			print "Serial port " + tty + " closed"
			exit(1)
		except KeyboardInterrupt:
			print "pressed ctrl+c"
			serR.close()
			exit(0)

except serial.SerialException:
	print "Serial port " + tty + " closed"
	exit(1)



print "out of the loop"
#serW = serial.Serial('/dev/'+tty, baud
#serW.write('5')
