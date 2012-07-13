#!/usr/bin/python
import os,sys
import time
import pprint
import pickle

from   pyfirmata import ArduinoMega, util
import pyfirmata

#http://python-gtk-3-tutorial.readthedocs.org/en/latest/objects.html

#import pygtk
#pygtk.require("2.0")
#import gtk
#import gtk.glade
#import gobject
#import commands

from gi.repository import Gtk

glade_file = "mega.glade"
tty        = '/dev/ttyACM0'

class AppUI(object):
	def __init__(self):
		self.builder = Gtk.Builder()
		self.builder.add_from_file(glade_file)
		self.builder.connect_signals(self)
		
		#objs = self.buider.get_objects()
		#print "OBJS",objs
		#io = self.buider.get_object("IO13")
		#print io.set_active_id("1")
		
		try:
			window = self.builder.get_object("window1")
			window.show_all()
		except KeyboardInterrupt:
			print "crtl+c"
			Gtk.main_quit()
			sys.exit(0)

	def on_window_destroy(window, self):
		Gtk.main_quit()

	#def onScChange(self, widget, enum, value):
	#	name = Gtk.Buildable.get_name(widget)
	#	#print "WIDGET",widget,
	#	#print "NAME"  ,name,
	#	#print "ENUM"  ,enum,
	#	#print "VALUE" ,value,"\n"
	#	#scale13
	#	scChange(self, name, value)

	def onScChange(self, widget):
		name  = Gtk.Buildable.get_name(widget)
		value = int(widget.get_value())
		print "WIDGET",widget,
		print "NAME"  ,name,
		#print "ENUM"  ,enum,
		print "VALUE" ,value,"\n"
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


def scChange(gtk, name, value):
	scId  = int(name[-2:])
	io    = gtk.builder.get_object("IO%02d" % scId)
	me    = gtk.builder.get_object("ME%02d" % scId)
	ioVal = io.get_active_text()
	meVal = me.get_active_text()
	print "SC CHANGE %s V %s ID %s IO %s ME %s" % (name, value, scId, ioVal, meVal)
	#print io.set_active_id("1")
	pass

def ioChange(gtk, name, value):
	pass

def meChange(gtk, name, value):
	pass


def main():
	print "opening"
	if os.path.exists(tty):
		board = ArduinoMega(tty, baudrate=115200)
		
		print "VERSION",board.get_firmata_version()
		
		# Prints some details to STDOUT
		print "pyFirmata version:\t%s"     % pyfirmata.__version__
		print "Hardware:\t\t%s"            % board.__str__()
		#print "Firmata firmware name:  %s" % board.get_firmware()
		#print "Firmata firmware:\t%i.%i"   % (board.get_firmata_version()[0], board.get_firmata_version()[1])
		
		#while True:
		#	print "on"
		#	board.digital[13].write(1)
		#	time.sleep(1)
		#	print "off"
		#	board.digital[13].write(0)
		#	time.sleep(2)

	try:
		app = AppUI()
		Gtk.main()
	except KeyboardInterrupt:
		print "crtl+c"
		Gtk.main_quit()
		sys.exit(0)


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