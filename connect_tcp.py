#!/usr/bin/python
from socket import *
import time
s=socket(AF_INET, SOCK_STREAM)
s.connect(('127.0.0.1',6666))

print "on"
s.send(chr(0x91)+chr(0x20)+chr(0))
time.sleep(2)

print "off"
s.send(chr(0x91)+chr(0x00)+chr(0))
s.close()
