#!/usr/bin/python
import os,sys
import time
import pprint

from   pyfirmata import ArduinoMega, util
import pyfirmata
from   pyfirmata.boards import BOARDS

#http://python-gtk-3-tutorial.readthedocs.org/en/latest/objects.html

#import pygtk
#pygtk.require("2.0")
#import gtk
#import gtk.glade
#import gobject
#import commands

from gi.repository import Gtk, GObject

glade_file = "mega.glade"
tty        = '/dev/ttyACM0'
updateRate = 3000 #ms

IOBLOCKED  = None
IOINPUT    = 'I'
IOOUTPUT   = 'O'
MEBLOCKED  = None
MEDIGITAL  = 'D'
MEANALOG   = 'A'
MEPWM      = 'P'
DON        = True
DOF        = False
ioid       = [IOINPUT, IOOUTPUT]
meid       = [MEANALOG, MEDIGITAL, MEPWM]


#portSettings = {}
portSettings = {
	MEDIGITAL   : 	{
						'13': [IOOUTPUT, DON]
					},
	MEPWM       : {},
	MEANALOG    : {},
	MEBLOCKED   : {} # Rx, Tx, Crystal
}

#	arduino_mega' : {
#        'digital' : tuple(x for x in range(54)),
#        'analog' : tuple(x for x in range(16)),
#        'pwm' : tuple(x for x in range(2,14)),
#        'use_ports' : True,
#        'disabled' : (0, 1) # Rx, Tx, Crystal
#    }


def doYourStuff(args):
	#print "doing my stuff on",mach
	mach = args[0]
	mach.update()
	return True
	

class AppUI(object):
	def __init__(self, board):
		self.builder = Gtk.Builder()
		self.builder.add_from_file(glade_file)
		self.builder.connect_signals(self)
		
		#objs = self.buider.get_objects()
		#print "OBJS",objs
		#io = self.buider.get_object("IO13")
		#print io.set_active_id("1")
		
		self.board = board
		self.mach  = machine(self, board, predef=portSettings)
		#pprint.pprint(mach)
		
		GObject.timeout_add(updateRate, doYourStuff, [self.mach])
		
		try:
			window = self.builder.get_object("window1")
			window.show_all()
			self.mach.update()
		except KeyboardInterrupt:
			print "crtl+c"
			Gtk.main_quit()
			sys.exit(0)

	def on_window_destroy(window, self):
		Gtk.main_quit()

	def onScChange(self, widget):
		name  = Gtk.Buildable.get_name(widget)
		value = int(widget.get_value())
		#print "WIDGET",widget,
		#print "NAME"  ,name,
		#print "ENUM"  ,enum,
		#print "VALUE" ,value,"\n"
		#scale13
		scChange(self, name, value)

	def onIoChange(self, widget):
		name  = Gtk.Buildable.get_name(widget)
		value = widget.get_active_text()
		#print "NAME", name,
		#print "VALUE",value,"\n"
		#IO13
		ioChange(self, name, value)

	def onMEChange(self, widget):
		name  = Gtk.Buildable.get_name(widget)
		value = widget.get_active_text()
		#print "NAME", name,
		#print "VALUE",value,"\n"
		#ME13
		meChange(self, name, value)

	def onBtnClick(self, widget):
		name  = Gtk.Buildable.get_name(widget)
		#value = widget.get_active_text()
		#print "NAME", name,
		#print "VALUE",value,"\n"
		#ME13
		btnChange(self, name)


def scChange(gtk, name, value):
	portNum    = int(name[-2:])
	portNumStr = "%02d" % portNum
	machine    = gtk.mach
	io         = gtk.builder.get_object("IO" + portNumStr)
	me         = gtk.builder.get_object("ME" + portNumStr)
	ioVal      = io.get_active_text()
	meVal      = me.get_active_text()
	print "SC CHANGE %s V %s ID %s IO %s ME %s" % (name, value, portNumStr, ioVal, meVal)


def ioChange(gtk, name, value):
	portNum    = int(name[-2:])
	portNumStr = "%02d" % portNum
	io         = gtk.builder.get_object("IO" + portNumStr)
	me         = gtk.builder.get_object("ME" + portNumStr)
	ioVal      = io.get_active_text()
	meVal      = me.get_active_text()
	print "IO  CHANGE %s V %s ID %s IO %s ME %s" % (name, value, portNumStr, ioVal, meVal)


def meChange(gtk, name, value):
	portNum    = int(name[-2:])
	portNumStr = "%02d" % portNum
	io         = gtk.builder.get_object("IO" + portNumStr)
	me         = gtk.builder.get_object("ME" + portNumStr)
	ioVal      = io.get_active_text()
	meVal      = me.get_active_text()
	print "ME  CHANGE %s V %s ID %s IO %s ME %s" % (name, value, portNumStr, ioVal, meVal)


def btnChange(gtk, name):
	portNum    = int(name[-2:])
	portNumStr = "%02d" % portNum
	io         = gtk.builder.get_object("IO" + portNumStr)
	me         = gtk.builder.get_object("ME" + portNumStr)
	ioVal      = io.get_active_text()
	meVal      = me.get_active_text()
	print "BTN CHANGE %s ID %s IO %s ME %s" % (name, portNum, ioVal, meVal)


class port(object):
	def __init__(self, portNum, portIO, portMethod, portDisplay, portValue=None):
		self.num     = portNum
		self.io      = portIO
		self.method  = portMethod
		self.display = portDisplay
		
		if portValue is not None:
			self.value = portValue
		else:
			self.value = 0
		self.updateDisplay()
		self.updatePort()

	def updateDisplay(self):
		self.display.update()
		
	def updatePort(self):
		pass
	
	def __repr__(self):
		return "<PORT OBJECT NUM '%d' IO '%s' METHOD '%s' VALUE '%d' DISPLAY '%s'>" % (self.num, self.io, self.method, self.value, self.display)


class display(object):
	def __init__(self, app, portNum, io, me, value, valid):
		self.valid  = False
		self.app    = None
		self.num    = None
		self.numStr = None
		
		self.sf     = None
		self.io     = None
		self.me     = None
		self.sc     = None
		self.le     = None
		self.sp     = None
		self.on     = None
		self.of     = None

		self.app    = app
		self.num    = portNum
		self.numStr = "%02d" % portNum

		if valid:
			self.sf = app.builder.get_object( "scaffold" + self.numStr ) # scaffold gtk layout
			self.io = app.builder.get_object( "IO"       + self.numStr ) # io combo box
			self.me = app.builder.get_object( "ME"       + self.numStr ) # me combo box
			self.sc = app.builder.get_object( "SC"       + self.numStr ) # value scale
			self.le = app.builder.get_object( "lbl"      + self.numStr ) # label
			self.sp = app.builder.get_object( "SP"       + self.numStr ) # value spin button
			self.on = app.builder.get_object( "ON"       + self.numStr ) # on  light button
			self.of = app.builder.get_object( "OF"       + self.numStr ) # off light button

			if 	self.sf is not None and \
				self.io is not None and \
				self.me is not None and \
				self.sc is not None and \
				self.le is not None and \
				self.sp is not None and \
				self.on is not None and \
				self.of is not None:
				self.valid = True
				
				self.stateIo  = io
				self.stateMe  = me
				self.stateVal = value
				self.update(portIO=io, portMethod=me, value=value)
				
		else:
			self.hide()

	def hide(self):
		self.sf = self.app.builder.get_object( "scaffold" + self.numStr ) # scaffold gtk layout
		if self.sf is not None:
			self.sf.set_visibility(False)

	def isValid(self):
		return self.valid

	def update(self, portIO=None, portMethod=None, value=None):
		if self.valid:
			print "UPDATING PORT %s METHOD %s VALUE %s" % (portIO, portMethod, str(value))
			iostate = self.io.get_active_text()
			mestate = self.me.get_active_text()
			scvalue = int(self.sc.get_value())
			
			ioCmp = self.stateIo
			if portIO is not None:
				ioCmp        = portIO
				self.stateIo = portIO
				
			if iostate != ioCmp:
				ioIndex = ioid.index(ioCmp)
				print "  UPDATING IO FROM %s TO %s INDEX %d" % (iostate, ioCmp, ioIndex)
				self.io.set_active(ioIndex)


			meCmp = self.stateMe
			if portMethod is not None:
				meCmp        = portMethod
				self.stateMe = portMethod
			
			if mestate != meCmp:
				meIndex = meid.index(meCmp)
				print "  UPDATING ME FROM %s TO %s INDEX %d" % (mestate, meCmp, meIndex)
				self.me.set_active(meIndex)


			if  meCmp is not None:
				if   meCmp == MEDIGITAL:
					self.showLed()
					self.hideScroll()
					print "  SET DIGITAL VALUE %s" % (str(value))
					if portIO == IOOUTPUT:
						self.setLed(value)
				
				elif meCmp == MEANALOG:
					self.showScroll()
					self.hideLed()
					self.setLed('NONE')
					print "  SET ANALOG VALUE %s" % (str(value))
					if portIO == IOOUTPUT:
						self.sc.set_value(value)
				
				elif meCmp == MEPWM:
					self.showScroll()
					self.hideLed()
					self.setLed('NONE')
					print "  SET PWM VALUE %s" % (str(value))
					if portIO == IOOUTPUT:
						self.sc.set_value(value)

	def setLed(self, state):
		print "    SETTING LED %s" % str(state)
		#print "\n".join(dir(self.on))
		if   state == DON:
			self.on.set_image(self.app.builder.get_object("ONON"))
			self.of.set_image(self.app.builder.get_object("OFOF"))
			
		elif state == DOF:
			self.on.set_image(self.app.builder.get_object("ONOF"))
			self.of.set_image(self.app.builder.get_object("OFON"))
			
		#elif state == 'NONE':
		#	self.on.set_from_file("ONOF")
		#	self.of.set_from_file("OFOF")

	def hideScroll(self):
		print "    HIDDING SCROLL"
		#print "\n".join(dir(self.sc))
		self.sc.set_visible(False)
		self.sp.set_visible(False)
	
	def showScroll(self):
		print "    SHOWING SCROLL"
		self.sc.set_visible(True)
		self.sp.set_visible(True)

	def hideLed(self):
		print "    HIDDING LED"
		self.on.hide()
		self.of.hide()

	def showLed(self):
		print "    SHOWING LED"
		self.on.show()
		self.of.show()


	def __repr__(self):
		return "<DISPLAY OBJECT SF '%s' IO '%s' ME '%s' SC '%s' LE '%s' SP '%s' ON '%s' OF '%s'>" % \
		(self.sf, self.io, self.me, self.sc, self.le, self.sp, self.on, self.of)


class machine(object):
	def __init__(self, app, board, predef=None):
		self.ports        = {
								MEDIGITAL: [],
								MEANALOG : [],
								MEPWM    : []
							}
		self.app = app

		digitals = board.layout['digital' ]
		analogs  = board.layout['analog'  ]
		pwms     = board.layout['pwm'     ]
		disabled = board.layout['disabled']
		
		
		for pair in [[digitals, MEDIGITAL],[analogs, MEANALOG],[pwms, MEPWM]]:
			lib    = pair[0]
			portMe = pair[1]
			
			for portNum in lib:
				valid = True
				if portNum in disabled:
					valid = False

				while len(self.ports[portMe]) <= portNum:
					self.ports[portMe].append(None)

				if predef is not None and predef.has_key(portMe) and predef[portMe].has_key(str(portNum)):
					io, val = predef[portMe][str(portNum)]
					portDisplay = display(app, portNum, io,      portMe, val, valid)
					self.ports[portMe][portNum] = port(portNum, io,      portMe, portDisplay, portValue=val)
				else:
					portDisplay = display(app, portNum, IOINPUT, portMe, 0,   valid)
					self.ports[portMe][portNum] = port(portNum, IOINPUT, portMe, portDisplay)

				
				
				

	def update(self):
		print "UPDATING MACHINE STATE"
		for portMe in self.ports.keys():
			for portObj in self.ports[portMe]:
				#portObj = self.ports[portMe][portNum]
				if portObj is not None:
					portObj.updateDisplay()

	def updatePort(self):
		pass

	def __repr__(self):
		return pprint.pformat(self.ports)


def main():
	print "opening"
	#board = BOARDS['arduino_mega']

	if os.path.exists(tty):
		board = ArduinoMega(tty, baudrate=57600)#, target=0)
		#time.sleep(3)
		
		#print "VERSION",board.get_firmata_version()
		## Prints some details to STDOUT
		#print "pyFirmata version:  %s"      % str(pyfirmata.__version__ )
		#print "Hardware:           %s"      % str(board                 )
		#print "Firmata version:    %s"      % str(board.firmata_version )
		#print "Firmware:           %s"      % str(board.firmware        )
		#print "Firmware version:   %s"      % str(board.firmware_version)
		#time.sleep(3)
		board.string_write("1234567890123567890")#from python. please echo")
		#board.string_write("abcdefghijklmn")#from python. please echo")
		#print "Firmata firmware name:  %s" % board.get_firmware()
		#print "Firmata firmware:\t%i.%i"   % (board.get_firmata_version()[0], board.get_firmata_version()[1])
		#time.sleep(10)
		
		try:
			while True:
				while board.sp.inWaiting() > 0:
					board.iterate()
				#print "sleeping"
				time.sleep(.5)
		except KeyboardInterrupt:
			sys.exit(0)
		except:
			sys.exit(1)
		
		#print "out"
		#	print "on"
		#	board.digital[13].write(1)
		#	time.sleep(1)
		#	print "off"
		#	board.digital[13].write(0)
		#	time.sleep(2)


		#try:
		#	app  = AppUI(board)
		#	Gtk.main()
		#	
		#except KeyboardInterrupt:
		#	print "crtl+c"
		#	Gtk.main_quit()
		#	sys.exit(0)


if __name__ == '__main__': main()



#tries = [
#			value.get_accessible, value.get_active, value.get_active_id, value.get_active_iter, value.get_active_text, value.get_add_tearoffs, value.get_allocated_height, value.get_allocated_width, value.get_allocation,
#			##value.get_ancestor,
#			value.get_app_paintable, value.get_area, value.get_border_width, value.get_button_sensitivity, value.get_can_default,
#			value.get_can_focus, value.get_cells, value.get_child, value.get_child_requisition, value.get_child_visible,value.get_children,
#			##value.get_clipboard,
#			value.get_column_span_column, value.get_composite_name,
#			##value.get_data,
#			value.get_default_direction, value.get_default_style,
#			##value.get_device_enabled,
#			##value.get_device_events,
#			value.get_direction, value.get_display, value.get_double_buffered, value.get_entry_text_column, value.get_events,
#			value.get_focus_chain, value.get_focus_child, value.get_focus_hadjustment, value.get_focus_on_click,
#			value.get_focus_vadjustment, value.get_halign, value.get_has_entry, value.get_has_tooltip, value.get_has_window,
#			value.get_hexpand, value.get_hexpand_set, value.get_id_column,
#			##value.get_internal_child,
#			value.get_mapped,
#			value.get_margin_bottom, value.get_margin_left, value.get_margin_right, value.get_margin_top, value.get_model,
#			##value.get_modifier_mask,
#			value.get_modifier_style, value.get_name, value.get_no_show_all, value.get_pango_context,
#			value.get_parent, value.get_parent_window, value.get_path,
#			##value.get_path_for_child,
#			value.get_pointer,
#			value.get_popup_accessible, value.get_popup_fixed_width, value.get_preferred_height,
#			##value.get_preferred_height_for_width,
#			value.get_preferred_size, value.get_preferred_width,
#			##value.get_preferred_width_for_height,
#			##value.get_properties,
#			##value.get_property,
#			value.get_realized, value.get_receives_default, value.get_request_mode, value.get_requisition,
#			value.get_resize_mode, value.get_root_window, value.get_row_span_column, value.get_screen, value.get_sensitive,
#			##value.get_settings,
#			value.get_size_request, value.get_state, value.get_state_flags, value.get_style, value.get_style_context,
#			value.get_support_multidevice, value.get_title, value.get_tooltip_markup, value.get_tooltip_text, value.get_tooltip_window,
#			value.get_toplevel, value.get_valign, value.get_vexpand, value.get_vexpand_set, value.get_visible, value.get_visual,
#			value.get_window, value.get_wrap_width
#		]
#for tri in tries:
#	print tri()

#print "ACTIVE"         ,value.get_active()
#print "ACTIVE ID"      ,value.get_active_id()
#print "COMPOSITE NAME" ,value.get_composite_name()
##print "DATA"           ,value.get_data()
#print "ID COLUMN"      ,value.get_id_column()
#print "NAME"           ,value.get_name()
##print "PROPERTIES"     ,value.get_properties()
#print "TITLE"          ,value.get_title()
#modify_text
#set_active
#set_active_id