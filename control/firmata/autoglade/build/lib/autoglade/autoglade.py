#! /usr/bin/env python
# -*- coding: utf-8 -*-
"""
$Id: autoglade.py 88 2009-02-03 15:35:03Z dtmilano $
"""

__license__ = """

Copyright (C) 2007-2009 Diego Torres Milano <diego@codtech.com>


This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
USA
"""

__version__ = '0.5'
__rev__ = '$Rev: 88 $'

"""
AutoGlade

@var AUTO_INVOKE_RE: Default regular expression to map Glade widget names
@type AUTO_INVOKE_RE: str

@var AUTO_RADIOBUTTON_NAME_RE: Default regular expression to obtain the 
		main radio button name from the full name
@type AUTO_RADIOBUTTON_NAME_RE: str

@var AUTO_INVOKE_WIDGET: Default position of the widget name group in L{AUTO_INVOKE_RE}
@type AUTO_INVOKE_WIDGET: int

@var AUTO_INVOKE_METHOD: Default position of the group indicating the method name to invoke
@type AUTO_INVOKE_METHOD: int

@var AGO_POSTPONED: Constant to indicate that some initialization is
	deferred because the value is not yet available.
	Used in L{AUtoGladeObject}.
@type AGO_POSTPONED: int
"""


AUTO_DELIMITER = ':'

# greedy
#AUTO_INVOKE_RE = '(.*)' + AUTO_DELIMITER + 'auto' + AUTO_DELIMITER + \
#	'([^' + AUTO_DELIMITER + ']*)(' + AUTO_DELIMITER +'(.+))?'
# non greedy
# to allow more than one 'auto' in name
AUTO_INVOKE_RE = '(.*?)' + AUTO_DELIMITER + 'auto' + AUTO_DELIMITER + \
	'([^' + AUTO_DELIMITER + ']*)(' + AUTO_DELIMITER +'(.+))?'

AUTO_INVOKE_WIDGET = 1 	# the position containing widget name
# FIXME:
# this was AUTO_INVOKE_OBJECT, and perhaps it's a better name, because it's
# possible that objects being passed insted of methods.
# Verify its usage.
AUTO_INVOKE_METHOD = 2 	# the position of the group inside the re containing method name
AUTO_INVOKE_HASARGS = 3 	# the position of the group inside the re containing method args
AUTO_INVOKE_ARGS = 4 	# the position of the group inside the re containing the arg

AUTO_TREEVIEW_SET_CELL_RE = 'setTreeview(.+)Cell(\d+)'

AUTO_RADIOBUTTON_NAME_RE = '(.+\D)\d+$'

AGO_POSTPONED = -2		# AutoGladeObject POSTPONED

AGO_DIALOG_PREFERENCES = 'dialogPreferences'
AGO_BUTTON_PREFERENCES = 'buttonPreferences'
AGO_MENU_ITEM_PREFERENCES = 'menuItemPreferences'
AGO_TOOL_BUTTON_PREFERENCES = 'toolButtonPreferences'

AGO_BUTTON_NEW = 'buttonNew'
AGO_MENU_ITEM_NEW = 'menuItemNew'
AGO_TOOL_BUTTON_NEW = 'toolButtonNew'

AGO_BUTTON_OPEN = 'buttonOpen'
AGO_MENU_ITEM_OPEN = 'menuItemOpen'
AGO_TOOL_BUTTON_OPEN = 'toolButtonOpen'

AGO_BUTTON_CLOSE = 'buttonClose'
AGO_MENU_ITEM_CLOSE = 'menuItemClose'
AGO_TOOL_BUTTON_CLOSE = 'toolButtonClose'

AGO_BUTTON_SAVE = 'buttonSave'
AGO_MENU_ITEM_SAVE = 'menuItemSave'
AGO_TOOL_BUTTON_SAVE = 'toolButtonSave'

AGO_MENU_ITEM_SAVE_AS = 'menuItemSaveas' # should be SaveAs, but...

AGO_BUTTON_COPY = 'buttonCopy'
AGO_MENU_ITEM_COPY = 'menuItemCopy'
AGO_TOOL_BUTTON_COPY = 'toolButtonCopy'

AGO_BUTTON_CUT = 'buttonCut'
AGO_MENU_ITEM_CUT = 'menuItemCut'
AGO_TOOL_BUTTON_CUT = 'toolButtonCut'

AGO_BUTTON_PASTE = 'buttonPaste'
AGO_MENU_ITEM_PASTE = 'menuItemPaste'
AGO_TOOL_BUTTON_PASTE = 'toolButtonPaste'

AGO_BUTTON_DELETE = 'buttonDelete'
AGO_MENU_ITEM_DELETE = 'menuItemDelete'
AGO_TOOL_BUTTON_DELETE = 'toolButtonDelete'

AGO_BUTTON_QUIT = 'buttonQuit'
AGO_MENU_ITEM_QUIT = 'menuItemQuit'
AGO_TOOL_BUTTON_QUIT = 'toolButtonQuit'

AGO_DIALOG_ABOUT = 'dialogAbout'
AGO_BUTTON_ABOUT = 'buttonAbout'
AGO_MENU_ITEM_ABOUT = 'menuItemAbout'
AGO_TOOL_BUTTON_ABOUT = 'toolButtonAbout'

AGOS = [
	# file
	AGO_BUTTON_NEW,
	AGO_MENU_ITEM_NEW,
	AGO_TOOL_BUTTON_NEW,
	AGO_BUTTON_OPEN,
	AGO_MENU_ITEM_OPEN,
	AGO_TOOL_BUTTON_OPEN,
	AGO_BUTTON_CLOSE,
	AGO_MENU_ITEM_CLOSE,
	AGO_TOOL_BUTTON_CLOSE,
	AGO_BUTTON_SAVE,
	AGO_MENU_ITEM_SAVE,
	AGO_TOOL_BUTTON_SAVE,
	AGO_MENU_ITEM_SAVE_AS,
	# clipboard
	AGO_BUTTON_COPY,
	AGO_MENU_ITEM_COPY,
	AGO_TOOL_BUTTON_COPY,
	AGO_BUTTON_CUT,
	AGO_MENU_ITEM_CUT,
	AGO_TOOL_BUTTON_CUT,
	AGO_BUTTON_PASTE,
	AGO_MENU_ITEM_PASTE,
	AGO_TOOL_BUTTON_PASTE,
	AGO_BUTTON_DELETE,
	AGO_MENU_ITEM_DELETE,
	AGO_TOOL_BUTTON_DELETE,
	# actions
	AGO_BUTTON_QUIT,
	AGO_MENU_ITEM_QUIT,
	AGO_TOOL_BUTTON_QUIT,
	# dialogs
	AGO_DIALOG_ABOUT,
	AGO_BUTTON_ABOUT,
	AGO_MENU_ITEM_ABOUT,
	AGO_TOOL_BUTTON_ABOUT,
	AGO_DIALOG_PREFERENCES,
	AGO_BUTTON_PREFERENCES,
	AGO_MENU_ITEM_PREFERENCES,
	AGO_TOOL_BUTTON_PREFERENCES,
]

ASI_STOCK = 0
ASI_GTKCLASS = 1

import sys
import os
import re
import gobject
import gtk.glade
try:
	import gconf
except:
	pass
import warnings
import traceback
from optparse import OptionParser
from xml.dom import minidom

prog = os.path.basename(sys.argv[0])
version = __version__
revision = __rev__
#DEBUG = None
DEBUG = [ '__map.*' ]
#DEBUG = [ '__map.*', '__autoConnect.*' ]
#DEBUG = [ '__autoConnectAGO' ]
#DEBUG = [ '__autoConnect', 'autoCopy', 'autoOpen', 'open', 'autoNew',
#	'autoSaveas', 'save']
#WARNING = [ '__autoConnect' ]
WARNING = None

colors = {"default":"",
	"blue":   "\x1b[01;34m",
	"cyan":   "\x1b[01;36m",
	"green":  "\x1b[01;32m",
	"red":	"\x1b[01;05;37;41m",
	"magenta":	"\x1b[01;35m",
	"sgr0":	 "\x1b[m\x1b(B"
	}

CYAN = colors['cyan']
RED = colors['red']
BLUE = colors['blue']
GREEN = colors['green']
MAGENTA = colors['magenta']
SGR0 = colors['sgr0']

def FN():
	"""
	Get the function name from the previous (calling) frame
	"""

	return sys._getframe(1).f_code.co_name

def warning(str, *cond):
	if WARNING:
		if cond:
			for c in cond:
				if c in WARNING:
					break
			return

		warnings.warn(str, RuntimeWarning)

#def debug(__str, cond=FN()):
def debug(__str, cond=True):
	DEBUGDEBUG = False

	if DEBUGDEBUG:
		print >>sys.stderr, "debug(%s, %s)" % (__str, cond)

	if DEBUG:
		if cond:
			found = False
			if isinstance(cond, str):
				# don't iterate over str (would get chars)
				cond = [ cond ]

			try:
				for c in cond:
					if DEBUGDEBUG:
						print >>sys.stderr, "&&& debug: testing %s in %s" % (c, DEBUG)
					if c in DEBUG:
						if DEBUGDEBUG:
							print >>sys.stderr, "&&& debug: true"
						found = True
						break
					for d in DEBUG:
						if DEBUGDEBUG:
							print >>sys.stderr, "&&& debug: testing %s match re %s" % (c, d)
						if re.compile(d).match(c):
							if DEBUGDEBUG:
								print >>sys.stderr, "&&& debug: true"
							found = True
							break
				if not found:
					return
				cond = " ".join(cond)
			except TypeError:
				# not iterable, should be a bool (True)
				pass

			print >>sys.stderr, "%s: %s" % (cond, __str)


EMPTY_GLADE = """<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<!DOCTYPE glade-interface SYSTEM "glade-2.0.dtd">
<!--Generated with glade3 3.2.0 on Tue Sep 25 21:27:17 2007 by diego@bruce-->
<glade-interface>
</glade-interface>
"""

INPUT_CLASS = ['GtkRadioButton', 'GtkCheckButton',
			'GtkToggleButton', 'GtkEntry', 'GtkHScale', 'GtkVScale',
			'GtkSpinButton', 'GtkComboBox', 'GtkFileChooserButton',
			'GtkFontButton', 'GtkColorButton', 'GtkCalendar',
			'GtkCurve', 'GtkGammaCurve',
			'GtkTreeView',
			]

class AutoGladeAttributeError(AttributeError):
	"""
	AutoGladeAttributeError is an identificable AttributeError
	"""
	
	def __init__(self, key):
		"""
		Constructor
		
		@param key: key not found
		@type key: str
		"""
		
		AttributeError.__init__(self, key)
		
class AutoGladeRuntimeError(RuntimeError):
	"""
	AutoGladeRuntimeError
	"""
	
	def __init__(self, msg):
		RuntimeError.__init__(self, msg)


class AutoGladeItemNotFoundException(Exception):
	"""
	AutoGladeItemNotFoundException
	"""

	def __init__(self, msg):
		Exception.__init__(self, msg)


class AutoGladeObject:
	"""
	AutoGladeObject is an utility class that relates together the Glade
	widget, its name and the XML element in a particular autoglade instance.

	FIXME:
	Composite pattern should be applied to be able to handle a widget or
	a list of widgets, when there's more than one.
	This could be when there's more than one stock item
	(see tests/new-double.glade)
	"""
	
	DEBUG = None
	__autoglade = None
	__name = None
	__widget = None
	__element = None
	
	def __init__(self, autoglade, name=None, widget=None, element=None):
		"""
		Constructor

		@param autoglade: Autoglade objet to which object is related to
		@type autoglade: AutoGlade.AutoGlade

		@param name: Name of the AutoGladeObject
		@type name: str

		@param widget: Widget of the AutoGladeObject. This accepts the
			special value L{autoglade.AGO_POSTPONED} to defer the
			initialization of the widget until some conditions are met.
		@type widget: L{gtk.Widget}

		@param element: Element of the AutoGladeObject
		@type element: str

		@raise AutoGladeRuntimeError: If the AutoGladeObject cannot be
			initialized because some values are missing this L{Exception}
			is raised.
		"""

		cond = FN()
		debug("%s: AutoGladeObject(autoglade=%s, name=%s, " \
				"element=%s, widget=%s)" % \
				(cond, autoglade, name, element, widget), cond)
		
		self.__autoglade = None
		self.__name = None
		self.__widget = None
		self.__element = None
		
		self.__autoglade = autoglade
		if name:
			self.__name = name
		if widget:
			self.__widget = widget
		if element:
			self.__element = element
			
		if not self.__element:
			if not self.__name:
				if self.__widget:
					self.__name = self.__widget.get_name()
					if not self.__name:
						raise AutoGladeRuntimeError("Cannot get widget name for widget=%s" % self.__widget)
				else:
					raise AutoGladeRuntimeError("Cannot determine element unless name or widget are specified.")
			self.__element = self.__getElementByName(self.__name)
			
		if not self.__widget:
			if not self.__name:
				self.__name = self.__element.getAttribute('id')
			else:
				self.__widget = self.__autoglade.__getattr__(self.__name)
			
		if not (self.__name and self.__widget and self.__element):
			raise AutoGladeRuntimeError("One attribute is missing (name=%s, element=%s, widget=%s)" %
					(self.__name, self.__element, self.__widget))
	
	def getName(self):
		return self.__name
	
	def getWidget(self):
		debug("AutoGladeObject::getWidget()\n" +
			"\t__widget = %s\n" % self.__widget +
			"\t__name = %s" % self.__name,
			FN())

		if self.__widget != AGO_POSTPONED:
			return self.__widget
		else:
			self.__widget = self.__autoglade.__getattr__(self.__name)
			return self.__widget
	
	def getElement(self):
		return self.__element
	
	def __getElementByName(self, name):
		"""
		Get the DOM element by name.

		@param name: Element name to find
		@type name: str

		@raise AutoGladeRuntimeError: If there's no element matching name
		"""
		
		cond = FN()

		for element in self.__autoglade.getGladeInterface().getElementsByTagName('widget'):
			debug("__getElementByName::Looking for %s found %s" % (name,
				element.getAttribute('id')), cond)
			if element.getAttribute('id') == name:
				return element

		debug("\tNOT FOUND !", cond);
		raise AutoGladeRuntimeError("Couldn't find element for name=%s" %
			name)
			
	def connectIfNotConnected(self, signal, handler, *args):
		"""
		Connect the specified signal with handler if there's no another
		handler defined.

		@param signal: Signal name
		@type signal: str

		@param handler: Signal handler
		@type handler: Callable

		@param args: Extra arguments
		@type args: List
		"""
		
		cond = FN()

		debug("%s(signal=%s, handler=%s)" % (cond, signal, handler), cond)
		debug("\telement = %s" % self.__element, cond)
		debug("\tsignal = %s" % self.__element.getElementsByTagName('signal'), cond)
		debug("\tname = %s" % self.getName(), cond)

		# check for signals handlers defined in glade XML file
		for child in self.__element.childNodes:
			if child.localName == 'signal' and child.attributes['name'] == signal :
				return
			
		debug("\tconnecting signal " + signal + " to auto handler", cond)
		debug("\twidget %s" % self.getWidget(), cond)
		debug("\thandler %s" % handler, cond)

		if args:
			self.getWidget().connect(signal, handler, args[0])
		else:
			self.getWidget().connect(signal, handler)
	
class AutoTreeviewSetCell:
	"""
	AutoTreeviewSetCell helper class.
	
	This is a helper class to set cells in L{gtk.Treeview}.
	Usually, to set cell properties the call used is as:
	
	C{cell.set_property('pixbuf', treeModel.get_value(iter, B{0}))}
	 
	But to avoid the problem of having to hardcode the cell index, 0 in this
	case, this helper class is used.
	This is used in conjuntion with L{AutoGlade.__getitem__} which returns
	and instance of L{AutoTreeviewSetCell} if C{key} matches the
	C{AUTO_TREEVIEW_SET_CELL_RE}.
	It's used, most frequently in initialization funtions
	(see L{AutoGlade.autoInit}) like this

	C{tvcolumn.set_cell_data_func(cellPixbuf, self.setTreeviewPixbufCell0)}

	or

	C{tvcolumn.set_cell_data_func(cellText, self.setTreeviewTextCell1)}
	"""
	
	DEBUG = False

	def __init__(self, cellType, cellIndex):
		"""
		Constructor
		
		@param cellType: the cell type (i.e.: text, pixbuf, activatable)
		@type cellType: str
		
		@param cellIndex: the cell (column) index inside the Treeview
		@type cellIndex: int
		"""
		
		debug("AutoTreeviewSetCell::__init__(cellType=%s, cellIndex=%s)" % (
			cellType, cellIndex))

		if cellType == 'toggle':
			cellType = 'active'
		self.__cellType = cellType
		self.__cellIndex = int(cellIndex)

	def __call__(self, column, cell, treeModel, iter, *data):
		debug("AutoTreeviewSetCell::__call__(column=%s, cell=%s, treeModel=%s, iter=%s)%s" % (column, cell, treeModel, iter))
		cell.set_property(self.__cellType, treeModel.get_value(iter,
			self.__cellIndex))
		return

class AutoGlade:
	"""
	AutoGlade main class.
	
	This is the main AutoGlade class.
	
	Conventions
	===========
		These are the conventions used to relate Glade files.
		* The glade definition file should have the same name as the parent
		  class	or should be specified by C{glade=filename} parameter
		* Signal handler names must start with C{'on_'} @see{__getitem__}
		* For C{on_automenuitem_activate} to work, in the Glade interface
		  designer the signal handler for this menu item should be
		  C{on_menuitem_activate} and user data must be the name of the
		  widget to call (.i.e: dialog)
		
	@cvar DEBUG: Set debugging output
	@type DEBUG: bool
	
	@ivar __reAutoInvoke: The regular expression to parse the Glade widget name
	@type __reAutoInvoke: str


	@ivar __menuItemAbout: Stock menu item about
	@type __menuItemAbout: L{gtk.Widget}

	@ivar __menuItemQuit: Stock menu item quit
	@type __menuItemQuit: L{gtk.Widget}

	@ivar __menuItemPreferences: Stock menu item preferences
	@type __menuItemPreferences: L{gtk.Widget}
	"""
	
	DEBUG = False
	__reAutoInvoke = re.compile(AUTO_INVOKE_RE)
	__reSetTreeviewCell = re.compile(AUTO_TREEVIEW_SET_CELL_RE)
	__reRadioButtonName = re.compile(AUTO_RADIOBUTTON_NAME_RE)
	
	__topLevelWidgetNames = []
	__mainTopLevelWidget = None			# AutoGladeObject
	__autoGladeObjects = {}					# AutoGladeObjetcs
	for ago in AGOS:
		__autoGladeObjects[ago] = None
	__topLevelWidgets = {}
	__signalHandlers = {}
	__autoDumpMap = {}
	__gconf = None
	__dump = {}
	__autoArgs = ''
	__autoProperties = {}
	__autoStockItems = {}

	__autoStockItems[AGO_BUTTON_PREFERENCES] = ['gtk-preferences', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_PREFERENCES] = ['gtk-preferences', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_PREFERENCES] = ['gtk-preferences', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_NEW] = ['gtk-new', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_NEW] = ['gtk-new', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_NEW] = ['gtk-new', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_OPEN] = ['gtk-open', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_OPEN] = ['gtk-open', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_OPEN] = ['gtk-open', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_SAVE] = ['gtk-save', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_SAVE] = ['gtk-save', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_SAVE] = ['gtk-save', gtk.ToolButton]

	__autoStockItems[AGO_MENU_ITEM_SAVE_AS] = ['gtk-save-as', gtk.MenuItem]

	__autoStockItems[AGO_BUTTON_COPY] = ['gtk-copy', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_COPY] = ['gtk-copy', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_COPY] = ['gtk-copy', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_CUT] = ['gtk-cut', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_CUT] = ['gtk-cut', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_CUT] = ['gtk-cut', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_PASTE] = ['gtk-paste', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_PASTE] = ['gtk-paste', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_PASTE] = ['gtk-paste', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_DELETE] = ['gtk-delete', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_DELETE] = ['gtk-delete', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_DELETE] = ['gtk-delete', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_QUIT] = ['gtk-quit', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_QUIT] = ['gtk-quit', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_QUIT] = ['gtk-quit', gtk.ToolButton]

	__autoStockItems[AGO_BUTTON_ABOUT] = ['gtk-about', gtk.Button]
	__autoStockItems[AGO_MENU_ITEM_ABOUT] = ['gtk-about', gtk.MenuItem]
	__autoStockItems[AGO_TOOL_BUTTON_ABOUT] = ['gtk-about', gtk.ToolButton]

	cellText = gtk.CellRendererText()
	cellPixbuf = gtk.CellRendererPixbuf()
	cellToggle = gtk.CellRendererToggle()
	
	# FIXME
	# WARNING
	# autorun default value changed from False to True
	def __init__(self, glade=None, root=None, autorun=True, autoinit=None,
			autoinitSplit=':', autodump='text'):
		"""
		Constructor
		
		Constructs the AutoGlade object based on the arguments passed.
		
		@param glade: The glade filename, defaults to the name of the class.
			Default C{None}
		@type glade: str
		
		@param root: The root widget name. Default C{None}.
		@type root: str

		@param autorun: Will autoglade auto run the GUI ?
		@type autorun: boolean

		@param autoinit: Autoinit initialization string
		@type autoinit: str

		@param autodump: Autodump type output format (i.e.: text, shell)
		@type autodump: str
		"""
		
		debug("AutoGlade::__init__(glade=%s, root=%s, autorun=%s, autoinit=%s, autodump=%s)" % (glade, root, autorun, autoinit, autodump))

		cn = self.__class__.__name__
		if not glade :
			if cn != 'AutoGlade':
				glade = cn + '.glade'
			#else:
			#	raise RuntimeError('Parameter glade is not set and no class name to obtain galde file.')

		debug('Should open %s' % glade)
		debug('\tworking directory: %s' % os.getcwdu())

		self.__glade = glade

		# FIXME
		# perhaps the program name should come from somewhere
		# an extra argument for programs
		# the name of the main widget for autorun
		self.__programName = cn
		self.__autoDump = autodump
		self.__autoDumpMap = {
			"text": self.autoDumpText,
			"shell": self.autoDumpShell,
			}
	
		if self.__glade:
			self.__dom = minidom.parse(self.__glade)
		else:
			self.__dom = minidom.parseString(EMPTY_GLADE)
		self.__gladeInterface = self.__dom.documentElement

		try:
			self.__gconf = gconf.client_get_default()
		except NameError:
			self.__gconf = None
		
		self.abbreviations()

		if autorun:
			try:
				import gnome

				properties = {gnome.PARAM_APP_DATADIR : '/usr/share'}
				# FIXME
				# perhaps, gnome.program_init should be invoked with the
				# main top level widget (__mainTopLevelWidget) name as its
				# first arg
				# FIXME
				# version is constant
				gnome.program_init(self.__programName, 'version',
					properties=properties)
			except:
				pass
		
		if root:
			self.__topLevelWidgetNames = [root]
		else:
			self.__getTopLevelWidgetNames()
						
		self.__getTopLevelWidgets()
		self.__mapAutoInvokeWidgetNames()
		self.__getSignalHandlers()
		self.__getStockItems()
		self.__fixComboBoxNotShowingActiveItem()
		
		self.__autoConnect()
		
		self.__autoinitSplit = autoinitSplit

		exitval = 0
		# FIXME
		# the try except block here is to support methods that don't return
		# an integer value
		try:
			exitval = self.autoInit(autoinit)
		except Exception, ex:
			print >>sys.stderr, "Exception: ", ex
			print >>sys.stderr, sys.exc_info()[0]
			print >>sys.stderr, sys.exc_info()[1]
			print >>sys.stderr, sys.exc_info()[2]
			print >>sys.stderr, ''.join(traceback.format_exception(
				*sys.exc_info())[-2:]).strip().replace('\n',': ')
		except:
			print >>sys.stderr, "Unexpected error in autoInit:", \
				sys.exc_info()[0]
			pass
		
		if autorun:
			debug("autorun")
			# now exitval holds the return value of self.autoInit, which
			# was called before. See comments in autoInit
			#exitval = 0

			# FIXME
			# TEST ONLY
			# this function, should be added in some way in autoinit
			# the name of the progress bar should be specified somewhere
			# maybe stting a class attribute in autoinit
			#self.__timerId = gobject.timeout_add(1000, self.autoProgressBar)
			#self.__timerId = gobject.timeout_add(1000, self.autoProgressBar, ['progressbar1'])

			resp = self.autoRun()
			debug("autorun resp=%s" % resp)
			if resp:
				debug("autorun exitval=%s" % exitval)
				if resp == gtk.RESPONSE_OK:
					self.autoDumpValues(None)
				else:
					exitval = -resp
			debug("autorun exit=%s" % exitval)
			sys.exit(exitval)

	# Provides self['name'].method()
	def __getitem__(self, key):
		"""
		__getitem__
		
		Provides B{self['name'].method()} access.
		If the C{key} starts with C{on_} then the corresponding method is
		executed instead of returning the attribute value.
		
		@param key: The key to search
		@type key: str
		
		
		@return: if key starts with 'on_' returns the value of the execution
		of B{self.key}, if key matches C{AUTO_TREEVIEW_SET_CELL_RE} (or
		whatever C{self.__reSetTreeviewCell} has compiled in) then returns an
		instance of L{AutoTreeviewSetCell} or returns the corresponding
		widget if exists, otherwise raise an L{AutoGladeAttributeError}.
		
		@raise AutoGladeAttributeError: If the key is not found
		"""
		
		cond = FN()
		debug('__getitem__(%s, %s)' % (self.__class__.__name__, key.__str__()), cond)
		
		if key:
			if key[0:3] == 'on_':
				try:
					exec 'return self.' + key
				except SyntaxError:
					raise AutoGladeAttributeError("method " + key +
						" not defined")
			else:
				debug("\tchecking if key=%s matches reSetTreeviewCell RE" % key, cond)
				mo = self.__reSetTreeviewCell.match(key)
				if mo:
					return AutoTreeviewSetCell(mo.group(1).lower(), mo.group(2))

				w = None
				for g in self.__topLevelWidgets.itervalues():
					w = g.get_widget(key)
					if w:
						"""
						This was taken from Mitch Chapman's article in LJ
						Cache the widget to speed up future lookups.  If multiple
						widgets in a hierarchy have the same name, the lookup
						behavior is non-deterministic just as for libglade.
						"""
						setattr(self, key, w)
						debug("__getitem__: FOUND", cond)
						return w

				raise AutoGladeAttributeError(key)

	# Provides self.name.method()
	def __getattr__(self, name):
		"""
		__getattr__
		
		Provides B{self.name.method()} access
		
		@param name: Item name
		@type name: L{str}
		
		@return: Returns L{__getitem__}C{(name)}
		"""
		
		return self.__getitem__(name)

	def __call__(args):
		warning("__call__(%s)")

	# Misc method
	def __getTopLevelWidgetNames(self):
		"""
		Get the top level widget names.

		IMPORTANT: Glade XML files have not been parsed yet.
		"""

		cond = FN()
		debug("start", cond)

		first = True
		for element in self.__gladeInterface.getElementsByTagName('widget'):
			debug("\twidget:%s" % element.getAttribute('id'), cond)
			if element.parentNode == self.__gladeInterface:
				name = element.getAttribute('id')
				self.__topLevelWidgetNames.append(name)
				debug("\tappending " + name, cond)
				if first:
					debug("\t\tfirst", cond)
					self.__mainTopLevelWidget = \
						AutoGladeObject(self, name=name, widget=AGO_POSTPONED)
					first = False
				debug("\ttop level name: %s" % element.getAttribute('id'), cond)

		debug("finish", cond)
	
	def __getSignalHandlers(self):
		"""
		Get signal handlers from Galde XML file

		C{self.__signalHandlers} dictionary is filled with signal handlers
		found, using the handler name as key and a tuple containing the
		signal name and widget name as value.
		"""

		for element in self.__gladeInterface.getElementsByTagName('signal'):
			self.__signalHandlers[element.getAttribute('handler')] = (
				element.getAttribute('name'), 
				element.parentNode.getAttribute('id')
				)
			#debug("signal handler: %s" % element.getAttribute('handler'))
		
	def __getSignalHandlerFromAGOKey(self, agokey):
		"""
		Get signal handler from Auto Glade Object key

		This method obtains the signal handler from the Auto Galde Object
		key in X{camel case}, assuming the handler method named is formed by
		the last component of the camel case key, capitalized and with the
		prefix C{auto} prepended.

		Examples::
			agokey = menuItemOpen
			method = autoOpen

			agokey = toolButtonSaveas # note the lowercase in as
			method = autoSaveas

		@param agokey: The Auto Glade Object key
		@type agokey: str
		
		@return: The signal handler method instance or None if there's no
		         match
		"""

		handler = None
		m = re.compile('(.*)([A-Z][a-z0-9]*)').match(agokey)
		if m:
			if m.group(1) == 'dialog':
				method = 'autoDialog'
			else:
				method = 'auto' + m.group(2)
			handler = getattr(self, method)

		return handler
		
	def __autoConnectAGO(self, agokey, handler='auto', signal='auto'):
		cond = FN()
		debug("\n%s(%s, %s, %s) start" % (cond, agokey, handler, signal),
			cond)

		try:
			ago = self.__autoGladeObjects[agokey]
			#print ">>>>>>> ago[%s]=%s" % (agokey, ago)
			if not ago:
				# None because this specific AGO key was not found in the
				# Glade definition file (.i.e: there's no preferences button)
				return
		except Exception, ex:
			# FIXME
			print >>sys.stderr, "\n"
			print >>sys.stderr, "*" * 70
			print >>sys.stderr, "Unhundled exception in %s" % FN()
			print >>sys.stderr, "Exception: ", ex
			print >>sys.stderr, sys.exc_info()[0]
			print >>sys.stderr, sys.exc_info()[1]
			print >>sys.stderr, sys.exc_info()[2]
			print >>sys.stderr, ''.join(traceback.format_exception(
				*sys.exc_info())[-2:]).strip().replace('\n',': ')
			print >>sys.stderr, "*" * 70
			print >>sys.stderr, "\n"
			return
		except:
			print >>sys.stderr, "\n"
			print >>sys.stderr, "*" * 70
			print >>sys.stderr, "Unexpected error in %s: %s" % (FN(),
				sys.exc_info()[0])
			print >>sys.stderr, "*" * 70
			print >>sys.stderr, "\n"
			return

		if handler == 'auto':
			handler = self.__getSignalHandlerFromAGOKey(agokey)
			debug("%s: handler=%s" % (cond, handler), cond)
			
		if signal == 'auto':
			widget = ago.getWidget()
			if isinstance(widget, gtk.Button) or isinstance(widget, gtk.ToolButton):
				signal = 'clicked'
			elif isinstance(widget, gtk.MenuItem):
				signal = 'activate'
			elif isinstance(widget, gtk.Dialog):
				signal = 'response'
			else:
				print >>sys.stderr, ">>>>>> NOT IMPLEMENTED: %s" % widget
				signal = None
			debug("%s: signal=%s" % (cond, signal), cond)
		
		if signal:
			debug("%s: autoconnecting" % cond, cond)
			ago.connectIfNotConnected(signal, handler)

		debug("%s finish" % (cond), cond)

	def __autoConnect(self):
		cond = FN()
		debug("__autoConnect start", cond)

		for tlwn,tlw in self.__topLevelWidgets.iteritems():
			debug("\tautoConnecting top level: " + tlwn, cond)
			tlw.signal_autoconnect(self)

		# connect quit to destory of main widget
		# there's a special case where there's no top level widget when the
		# interface is empty
		if self.__mainTopLevelWidget:
			debug("\tautoConnecting 'destroy' if not connected", cond)
			self.__mainTopLevelWidget.connectIfNotConnected('destroy',
				self.autoQuit)
		
		for agokey in AGOS:
			self.__autoConnectAGO(agokey)

		debug("__autoConnect finish")


	def __getTopLevelWidgets(self):
		"""
		Get the top level widgets parsing the glade XML file.

		The widget trees (one for every top level widget) are also created
		in this operation.
		"""
		
		cond = FN()
		debug("start", cond)

		for tl in self.__topLevelWidgetNames:
			debug('toplevel=%s' % tl, cond)
			w = gtk.glade.XML(self.__glade, tl)
			self.__topLevelWidgets[tl] = w
			debug("\tw=%s tlw=%s" % (w, self.__topLevelWidgets), cond)

		debug("finish", cond)
			
	def __mapAutoInvokeWidgetNames(self):
		"""
		Map the autoInvoke names (widget:auto:method) to its plain form
		(widget).
		Invoke 'auto:init' method if present.
		Connect 'auto:sensitize' signals.
		Connect signal for menu items (and tool buttons ?) if not connected
		"""

		cond = FN()
		debug("start", cond)

		# in normal situations initMethod is initialized below in this
		# method, so this copes with some missing cases
		initMethod = None

		#!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		# FIXME
		# this should involve root (top level widgets)
		#!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		for element in self.__gladeInterface.getElementsByTagName('widget'):
			debug("widget:%s" % (element.getAttribute('id')), cond)
			name = element.getAttribute('id')
			widgetClass = element.getAttribute('class')
			tail = name
			while tail:
				debug("%%%% tail:%s %%%%" % (tail), cond)
				m = self.__reAutoInvoke.match(tail)
				# FIXME
				# tail is set in every case to contains the tail of the list
				# of :auto: commands and args
				tail = None
				debug("widget:%s matches auto invoke:%s" % (name, m), cond)
				if m:
					# this is the case of one widget named as the autoInvoke
					# convention widget:auto:method
					# because of this name it cannot be invoked as self.name
					# so a workaround should be used
					# another alternative would be to use a '_' instead of ':'

					# get the widget
					widget = self.__getitem__(name)

					# n is the 'real' widget name, the first part of the mapped
					# name widget:auto:method
					n = m.group(AUTO_INVOKE_WIDGET)
					setattr(self, n, self.__getitem__(name))
					method = m.group(AUTO_INVOKE_METHOD)
					args = m.group(AUTO_INVOKE_ARGS)
					debug("\tname:%s" % (n), cond)
					debug("\tmethod:%s" % (method), cond)
					debug("\targs:%s" % (args), cond)
					m = self.__reAutoInvoke.match(args or "")
					if m:
						args = m.group(AUTO_INVOKE_WIDGET)
						debug("\targs:%s #####" % (args), cond)
						tail = n + ':auto:' + m.group(AUTO_INVOKE_METHOD) + ':' + m.group(AUTO_INVOKE_ARGS)
						debug("\ttail:%s #####" % (tail), cond)

					# special methods handling
					if method == 'init':
						val = None
						if args == 'env':
							# widgetname:auto:init:env will initialize the widget
							# value from environment variable 'widgetname'
							# if 'widgetname' does not exist with an empty value.
							try:
								val = os.environ[n]
							except KeyError:
								debug("**** looking for '%s' in environ, but not found ****" % (n))
								# FIXME
								# there's a special case handled in the if widgetClass
								# section below, because for example for radio buttons
								# we have to strip the last number to find the variable
								# name
								val = None

							# FIXME
							# this is (was ?) the same as in 'gconf'
							if widgetClass in ['GtkFileChooser',
									'GtkFileChooserButton']:
								initMethod = self[name].set_filename
							elif widgetClass in ['GtkHScale', 'GtkVScale',
									'GtkSpinButton']:
								initMethod = self[name].set_value
								# thanks to python for this dynamic typing
								val = float(val and val or 0)
							elif widgetClass  == 'GtkLabel':
								# FIXME
								# overwrites previous markup, which could not be
								# the intention
								initMethod = self[name].set_markup
								if not val:
									val = ""
							elif widgetClass == 'GtkEntry':
								initMethod = self[name].set_text
								if not val:
									val = ""
							elif widgetClass == 'GtkCheckButton':
								# if val = 'True' (str) active, inactive otherwise
								initMethod = self[name].set_active
								val = int((val == 'True') or 0)
							elif widgetClass == 'GtkRadioButton':
								initMethod = self[name].set_active
								nnn = self.__reRadioButtonName.match(n).group(1)
								debug("GtkRadioButton: name=%s n=%s nnn=%s val=%s" % (
									name, n, nnn, val))
								try:
									debug("GtkRadioButton: name=%s val=%s nnn=%s label=%s" % (name, val, nnn, self[name].get_label()))
									debug("GtkRadioButton: env[%s]=%s" % (nnn, os.environ[nnn]))
									val = (self[name].get_label() == os.environ[nnn])
									debug("GtkRadioButton: val=%s" % (val))
								except KeyError:
									# not in environment, we can't do anything
									# just don't set it as active
									val = False

								debug("GtkRadioButton: (final) name=%s val=%s nnn=%s label=%s" % (name, val, nnn, self[name].get_label()))
							elif widgetClass == 'GtkComboBox':
								initMethod = self[name].set_active
								model = self[name].get_model()
								try:
									val = [ item[0] for item in model ].index(val)
								except ValueError:
									# not in environment, we can't do anything
									# just set first as active
									val = 0
								except TypeError:
									# combobox model not defined
									val = 0
							elif widgetClass == 'GtkCurve':
								# FIXME
								# test only
								initMethod = self[name].set_vector
								#initMethod = self[name].set_gamma
								if val:
									val = [float(x) for x in re.split("[,() ]+", val)[1:-1]]
									val = tuple(val)
									#val = float(val)
								else:
									val = ()
									#val = float(1)
							elif widgetClass == 'GtkGammaCurve':
								initMethod = self[name].curve.set_vector
								if val:
									val = [float(x) for x in re.split("[,() ]+", val)[1:-1]]
									val = tuple(val)
								else:
									val = ()
							elif widgetClass == 'GtkImage':
								initMethod = self[name].set_from_file
							elif widgetClass == 'GtkColorButton':
								initMethod = self[name].set_color
								if not val:
									val = "#000"
								val = gtk.gdk.color_parse(val)
							elif widgetClass == 'GtkTreeView':
								initMethod = self[name].set_model
								splitter = re.compile('" ?"?')
								# strip parenthesis, and then empty strings
								list = splitter.split(val[1:-1])[1:-1]
								# header is the first element
								header = list.pop(0)
								debug("list=%s" % list)
								tvcs = []
								i = 0
								cmd = "model = gtk.ListStore("
								first = True
								# FIXME: [0] constant, means only 1 column
								# there should be a way to specify more columns
								# perhpas nested parens ( ("a" "b") ("c" "d" )
								for l in [0]:
									if not first:
										cmd += ","
									else:
										first = False
									cmd += "gobject.TYPE_STRING"
									tvcs.append(gtk.TreeViewColumn(header,
										gtk.CellRendererText(), text=i))
								cmd += ")"
								debug("cmd=%s" % cmd)
								exec cmd

								for tvc in tvcs:
									self[name].append_column(tvc)

								for s in list:
									model.append([s])

								val = model
							else:
								debug("**** No initMethod defined to initialize from environment for this widget class: %s (%s) ****" % (widgetClass, type(self[name])))
								initMethod = None

						elif args == 'gconf':
							baseKey = '/apps/%s/autoglade/init/%s' % (self.__topLevelWidgetNames[0], n)
							if self.DEBUG:
								print >>sys.stderr, '@' * 50
								print >>sys.stderr, '@' + ' should initialize the widget %s using method %s with args %s' % (n, method, args)
								print >>sys.stderr, '@' + ' gconf baseKey: %s' % baseKey

							key = baseKey + '/'
							# FIXME
							# this is the same as in 'env'
							if widgetClass in ['GtkFileChooser',
									'GtkFileChooserButton']:
								key += 'filename'
								initMethod = self[name].set_filename
							val = self.__gconf.get_string(key)
						elif re.match('cmdlineargs\[(\d+)\]', args):
							m2 = re.match('cmdlineargs\[(\d+)\]', args)
							n2 = int(m2.group(1))
							if widgetClass in ['GtkTextView']:
								self[name].get_buffer().set_text(open(cmdlineargs[n2]).read())
						#if val and initMethod:
						# perhaps I want to set val=False or val=None
						if initMethod:
							debug("\n\n**** initMethod=%s val=%s (%s) ****\n\n" % (initMethod, val, type(val)))
							initMethod(val)
							# FIXME
							# debug only
							if n == 'curve1':
								debug("\n\n**** after init=%s val=%s ****\n\n" % (name, self[name].get_vector(-1)))
								#self[name].reset()
							# FIXME
							# debug only
							elif n == 'gammacurve1':
								self[name].curve.reset()
								self[name].curve.set_gamma(1.5)
					elif method in ['show', 'sensitize' ]:
						debug("show/sensitize: widget%s %s method=%s args=%s" % (widget, widgetClass, method, args), cond)
						if args:
							h = getattr(self, 'on_auto' + method)
							if isinstance(widget, gtk.ToggleButton) or isinstance(widget, gtk.CheckMenuItem):
								for targetWidget in args.split(AUTO_DELIMITER):
									debug('Connecting %s' % (targetWidget), cond)
									try:
										widget.connect('toggled', h,
											self.__getitem__(targetWidget))
									except AutoGladeAttributeError:
										# I should use the long name !!!
										# see an example in tests/chain
										# FIXME
										# this is the second time in this method that
										# we iterate over the interface elements
										# it should be cached
										for element in self.__gladeInterface.getElementsByTagName('widget'):
											__twln = element.getAttribute('id')
											if __twln.startswith(targetWidget):
												widget.connect('toggled', h,
													self.__getitem__(__twln))
												
					elif method == 'dump':
						self.__dump[n] = args
					elif method == 'property':
						val = "?"
						nnn = self.__reRadioButtonName.match(n).group(1)
						debug("\n\n!!!!!!!!!!!!!!!!!!!!! property not implemented: %s = %s => %s !!!!!!!!!!!!\n\n" % (nnn, val, args))
						if widgetClass in ['GtkRadioButton']:
							#val = self[name].get_label()
							property = nnn
							(target, val) = args.split(AUTO_DELIMITER)
							AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('toggled', self.autoProperty, (property, val, target))
						else:
							debug("!!!!! NOT IMPLEMENTED !!!!")
					elif method == 'exec':
						if isinstance(widget, gtk.Button):
							AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('clicked', self.autoExec, args)
					else:
						############################################################
						# FIXME
						# This is not working as intended becasue
						# connectIfNotConnected
						# in next statement is called BEFORE __autoConnect is called
						# so no signals are connected yet
						# It must be tested what happens if the call to this method
						# is positioned after __autoConnect
						############################################################
						# FIXME
						# Connect the signal for menu items, tool buttons.
						# Don't know what to do with other classes yet
						############################################################
						if widgetClass in ['GtkMenuItem', 'GtkImageMenuItem',
								'GtkCheckMenuItem']:
							AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('activate', self.on_automenuitem_activate, args)
						# FIXME
						# Analyze the case for GtkToolButton, should it connect
						# on_automenuitem_activate or on_autobutton_clicked ?
						elif widgetClass == 'GtkToolButton':
							AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('clicked', self.on_automenuitem_activate, args)
						elif widgetClass == 'GtkFontButton':
							AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('font-set', self.on_autofontbutton_font_set, method)
						# FIXME
						# When is more convenient to use gtk classes like here
						# gtk.Button or string class names 'GtkButton' ?
						# Using gtk classes we have inheritance.
						elif isinstance(widget, gtk.Button):
							if self.DEBUG:
								print >>sys.stderr, "Button %s" % name
								print >>sys.stderr, "args %s" % args
								print >>sys.stderr, "type %s" % args.__class__.__name__
							# FIXME
							# perhaps this should be applied to every other case
							if isinstance(args, str) or isinstance(args, unicode):
								if self.DEBUG:
									print >>sys.stderr, "Splitting args=%s" % args
								args = tuple(args.split(AUTO_DELIMITER))
								if self.DEBUG:
									print >>sys.stderr, "args=%s" % args
							AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('clicked', self.on_autobutton_clicked, args)
						elif isinstance(widget, gtk.ProgressBar):
							if self.DEBUG:
								print >>sys.stderr, "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%"
								print >>sys.stderr, "ProgressBar %s" % name
								print >>sys.stderr, "args %s" % args
								print >>sys.stderr, "type %s" % args.__class__.__name__
							arglist = [name]
							if args:
								for arg in args.split(':'):
									arglist.append(arg)
							self.__timerId = gobject.timeout_add(1000, self.autoProgressBar, arglist)

	def __expandAutoProperties(self):
		"""
		Expand properties values (property:auto:method) to its
		corresponding value.
		"""

		#################################################################
		# under construction
		#
		#
		#
		cond = FN()
		debug("%s() start" % cond, cond)

#_#		# in normal situations initMethod is initialized below in this
#_#		# method, so this copes with some missing cases
#_#		initMethod = None
#_#
#_#		for element in self.__gladeInterface.getElementsByTagName('property'):
#_#			debug("\tproperty:%s" % element.getAttribute('name'), cond)
#_#			name = element.getAttribute('name')
#_#			parent = element.parentNode
#_#			parentName = parent.getAttribute('id')
#_#			m = self.__reAutoInvoke.match(name)
#_#			if m:
#_#				# this is the case of one property named as the autoInvoke
#_#				# convention 'auto:method'
#_#
#_#				n = m.group(AUTO_INVOKE_WIDGET)
#_#				method = m.group(AUTO_INVOKE_METHOD)
#_#				args = m.group(AUTO_INVOKE_ARGS)
#_#				debug("\tmethod:%s" % method, cond)
#_#				# special methods handling
#_#				if method == 'init':
#_#					val = None
#_#					if args == 'env':
#_#						# property:auto:init:env will initialize the property
#_#						# value from environment variable 'widgetname'
#_#						# if 'widgetname' does not exist with an empty value.
#_#						try:
#_#							val = os.environ[n]
#_#						except KeyError:
#_#							debug("**** looking for '%s' in environ, but not found ****" % n)
#_#							# FIXME
#_#							# there's a special case handled in the if widgetClass
#_#							# section below, because for example for radio buttons
#_#							# we have to strip the last number to find the variable
#_#							# name
#_#							val = None
#_#
#_#						# FIXME
#_#						# this is the same as in 'gconf'
#_#						if widgetClass in ['GtkFileChooser',
#_#								'GtkFileChooserButton']:
#_#							initMethod = self[name].set_filename
#_#						elif widgetClass in ['GtkHScale', 'GtkVScale']:
#_#							initMethod = self[name].set_value
#_#							# thanks to python for this dynamic typing
#_#							val = float(val and val or 0)
#_#						elif widgetClass in ['GtkLabel']:
#_#							# FIXME
#_#							# overwrites previous markup, which could not be
#_#							# the intention
#_#							initMethod = self[name].set_markup
#_#							if not val:
#_#								val = ""
#_#						elif widgetClass in ['GtkEntry']:
#_#							initMethod = self[name].set_text
#_#						elif widgetClass in ['GtkRadioButton']:
#_#							initMethod = self[name].set_active
#_#							# this is also close to line 1650
#_#							debug("**** name=%s n=%s val=%s ****" % (name, n, val))
#_#							nnn = re.match('(.+\D)\d+$', n).group(1)
#_#							try:
#_#								debug("**** &&& name=%s val=%s nnn=%s label=%s ****" % (name, val, nnn, self[name].get_label()))
#_#								debug("**** env[%s]=%s ****" % (nnn, os.environ[nnn]))
#_#								val = (self[name].get_label() == os.environ[nnn])
#_#							except KeyError:
#_#								# not in environment, use first radio as default
#_#								# we don't know if there's more than one
#_#								val = 1
#_#
#_#							debug("**** name=%s val=%s nnn=%s label=%s ****" % (name, val, nnn, self[name].get_label()))
#_#						else:
#_#							debug("**** No initMethod defined to initialize from environment for this widget class: %s (%s) ****" % (widgetClass, type(self[name])))
#_#
#_#					elif args == 'gconf':
#_#						baseKey = '/apps/%s/autoglade/init/%s' % (self.__topLevelWidgetNames[0], n)
#_#						if self.DEBUG:
#_#							print >>sys.stderr, '@' * 50
#_#							print >>sys.stderr, '@' + ' should initialize the widget %s using method %s with args %s' % (n, method, args)
#_#							print >>sys.stderr, '@' + ' gconf baseKey: %s' % baseKey
#_#
#_#						key = baseKey + '/'
#_#						# FIXME
#_#						# this is the same as in 'env'
#_#						if widgetClass in ['GtkFileChooser',
#_#								'GtkFileChooserButton']:
#_#							key += 'filename'
#_#							initMethod = self[name].set_filename
#_#						val = self.__gconf.get_string(key)
#_#
#_#					#if val and initMethod:
#_#					# perhaps I want to set val=False or val=None
#_#					if initMethod:
#_#						if self.DEBUG:
#_#							print >>sys.stderr, "\n\n**** initMethod=%s val=%s ****" % (initMethod, val)
#_#						initMethod(val)
#_#				elif method in ['show', 'sensitize' ]:
#_#					if self.DEBUG:
#_#						print >>sys.stderr, MAGENTA + "show/sensitize: widget%s %s method=%s args=%s" % (widget, widgetClass, method, args) + SGR0
#_#					if args:
#_#						h = getattr(self, 'on_auto' + method)
#_#						if isinstance(widget, gtk.ToggleButton) or isinstance(widget, gtk.CheckMenuItem):
#_#							for targetWidget in args.split(AUTO_DELIMITER):
#_#								if self.DEBUG:
#_#									print >>sys.stderr, 'Connecting'
#_#								widget.connect('toggled', h,
#_#									self.__getitem__(targetWidget))
#_#				elif method == 'dump':
#_#					self.__dump[n] = args
#_#				else:
#_#					############################################################
#_#					# FIXME
#_#					# This is not working as intended becasue
#_#					# connectIfNotConnected
#_#					# in next statement is called BEFORE __autoConnect is called
#_#					# so no signals are connected yet
#_#					# It must be tested what happens if the call to this method
#_#					# is positioned after __autoConnect
#_#					############################################################
#_#					# FIXME
#_#					# Connect the signal for menu items.
#_#					# Don't know what to do with other classes yet
#_#					############################################################
#_#					if widgetClass in ['GtkMenuItem', 'GtkImageMenuItem',
#_#							'GtkCheckMenuItem']:
#_#						AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('activate', self.on_automenuitem_activate, args)
#_#					# FIXME
#_#					# Analyze the case for GtkTookButton, should it connect
#_#					# on_automenuitem_activate or on_autobutton_clicked ?
#_#					elif widgetClass == 'GtkToolButton':
#_#						AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('clicked', self.on_automenuitem_activate, args)
#_#					# FIXME
#_#					# When is more convenient to use gtk classes like here
#_#					# gtk.Button or string class names 'GtkButton' ?
#_#					# Using gtk classes we have inheritance.
#_#					elif isinstance(widget, gtk.Button):
#_#						if self.DEBUG:
#_#							print >>sys.stderr, "Button %s" % name
#_#							print >>sys.stderr, "args %s" % args
#_#							print >>sys.stderr, "type %s" % args.__class__.__name__
#_#						# FIXME
#_#						# perhaps this should be applied to every other case
#_#						if isinstance(args, str) or isinstance(args, unicode):
#_#							if self.DEBUG:
#_#								print >>sys.stderr, "Splitting args=%s" % args
#_#							args = tuple(args.split(AUTO_DELIMITER))
#_#							if self.DEBUG:
#_#								print >>sys.stderr, "args=%s" % args
#_#						AutoGladeObject(self, name=name, widget=widget).connectIfNotConnected('clicked', self.on_autobutton_clicked, args)

	def __fixComboBoxNotShowingActiveItem(self):
		"""
		Fix a problem found with Combo Box widgets.

		Is this a libglade bug ?
		"""

		warning("FIXING COMBOBOX PROBLEM")
		for element in self.__gladeInterface.getElementsByTagName('widget'):
			if element.getAttribute('class') == 'GtkComboBox':
				name = element.getAttribute('id')
				a = -1
				for property in element.getElementsByTagName('property'):
					if property.getAttribute('name') == 'active':
						for node in property.childNodes:
							if node.nodeType == node.TEXT_NODE:
								a = int(node.data)
				# get the widget
				widget = self.__getitem__(name)
				if widget.get_active() == -1:
					if a != -1:
						widget.set_active(a)

	def __getAboutDialog(self):
		"""
		Get the about dialog from the internal list of top level widgets
		and set the L{AutoGladeObject} accordingly.
		"""
		
		for n,g in self.__topLevelWidgets.iteritems():
			w = self.__getattr__(n)
			if isinstance(w, gtk.AboutDialog):
				"""
				In the special case of gtk.AboutDialog, get_name() doesn't
				return the widget name but the application name set by gnome
				application.
				What the developers were thinking ?
				So, to compensate from this unusual an not orthogonal behavior
				next AutoGladeObject creation includes the name too.
				"""
				self.__autoGladeObjects[AGO_DIALOG_ABOUT] = \
					AutoGladeObject(self, widget=w, name=n)
				return

		warning("About dialog not found")
			
	def __getPreferencesDialog(self):
		"""
		Get the preferences dialog from the internal list of top level
		widgets and set the L{AutoGladeObject} accordingly.

		To find it, widget name is matched against 'preferences' ignoring
		case.
		"""
		
		for n,g in self.__topLevelWidgets.iteritems():
			w = self.__getattr__(n)
			if isinstance(w, gtk.Dialog) and \
					re.search('preferences', n, re.IGNORECASE):
				debug("Setting preferences dialog to '%s': %s" % (n, w))
				self.__autoGladeObjects[AGO_DIALOG_PREFERENCES] = \
					AutoGladeObject(self, widget=w, name=n)
				return

		warning("Preferences dialog not found")

	def __getStockItem(self, agokey, stock, gtkClass=gtk.Widget):
		try:
			self.__autoGladeObjects[agokey] = self.__findStockItem(stock, gtkClass)
		except AutoGladeItemNotFoundException:
			warning("Stock item not found: ago=%s stock=%s gtkClass=%s" % (
				agokey, stock, gtkClass))
			self.__autoGladeObjects[agokey] = None

	def __getStockItems(self):
		"""
		Get stock items.
		"""

		# special cases
		self.__getAboutDialog()
		self.__getPreferencesDialog()

		# generic cases
		for asi in self.__autoStockItems:
			self.__getStockItem(asi, self.__autoStockItems[asi][ASI_STOCK],
				self.__autoStockItems[asi][ASI_GTKCLASS])
		
	def __findStockItem(self, stock, gtkClass=gtk.Widget):
		"""
		Find a stock item in the elements tree.

		WARNING: Right now only find the first widget if more than one
		satisfies the conditions

		@param stock: The stock item to find
		@type stock: str
		"""

		cond = FN()
		debug("%s(%s, %s) start" % (cond, stock, gtkClass), cond)

		# a bit too much: all the properties in the glade file !
		for element in self.__gladeInterface.getElementsByTagName('property'):
			if element.getAttribute('name') == 'stock_id' and \
					element.childNodes[0].nodeValue == stock:
				debug("%s: value=%s" % (cond, element.childNodes[0].nodeValue),
					cond)
				parent = element.parentNode
				name = parent.getAttribute('id')
				widget = self.__getattr__(name)
				debug("%s: testing if %s (%s) is an instance of %s" % (cond,
					name, widget, gtkClass), cond)
				if isinstance(widget, gtkClass):
					debug("%s: FOUND", cond)
					return AutoGladeObject(self, name=name, element=element,
						widget=widget)
			elif element.getAttribute('name') == 'label':
				for node in element.childNodes:
					if node.nodeType == node.TEXT_NODE:
						if node.data == stock:
							parent = element.parentNode
							debug("%s: parent = %s" % (cond, parent), cond)
							if parent.tagName != 'widget':
								raise RuntimeError('Parent is not widget')
							name = parent.getAttribute('id')
							element = parent
							widget = self.__getattr__(name)
							if isinstance(widget, gtkClass):
								debug("%s: FOUND %s" % (cond, name), cond)
								return AutoGladeObject(self, name=name,
									element=element, widget=widget)
		raise AutoGladeItemNotFoundException("Stock item %s not found" % stock)
		
	# Getters and setters
	def getGladeInterface(self):
		return self.__gladeInterface
	
	def getDom(self):
		return self.__dom
	
	def getTopLevelWidgets(self):
		return self.__topLevelWidgets
	
	def getSignalHandlers(self):
		#return self.__signalHandlers.keys()
		return self.__signalHandlers
	
	def getWidgetNames(self, widgetClassFilter=None,
			widgetCanonicalNames=False):
		"""
		List the widget names possible filtered.

		This method was an idea suggested by Charles Edward Pax and
		Christopher Pax from Gladex project (http://www.openphysics.org/~gladex/)
		"""

		wn = []
		wcf = None

		if widgetClassFilter:
			if isinstance(widgetClassFilter, str):
				if widgetClassFilter == 'input':
					wcf = INPUT_CLASS
				else:
					wcf = [ widgetClassFilter ]
			elif isinstance(widgetClassFilter, list):
				wcf = widgetClassFilter
			else:
				raise TypeError('Invalid widget class filter')

		for element in self.__gladeInterface.getElementsByTagName('widget'):
			if wcf:
				widgetClass = element.getAttribute('class')
				if not widgetClass in wcf:
					continue
			name = element.getAttribute('id')
			if widgetCanonicalNames:
				m = self.__reAutoInvoke.match(name)
				if m:
					name = m.group(AUTO_INVOKE_WIDGET)
			wn.append(name)
		return wn

	# Methods
	def autoInit(self, autoinit=None):
		"""
		Default autoInit method, can be overriden by children.
		
		@param autoinit: The string containing autoinit commands
		@type autoinit: L{str}
		"""

		retval = 0

		if autoinit:
			if self.DEBUG:
				print >>sys.stderr, '$$$$ executing: self.' + autoinit
			# FIXME
			# here ':' is used as a separator between autoinit statements
			# but trere would be a possibility that something is intended
			# with a widget that conains ':' in its name
			if self.__autoinitSplit != 'NONE':
				for init in autoinit.split(self.__autoinitSplit):
					# FIXME
					# this is a little tricky. To obtain the return value of
					# multiple autoinits sequences we are substracting the values
					# because return values are mostly negatives from gtk.RESPONSE
					# values. This is mainly to obtain the response from an
					# autoinit question dialog, for example.
					# FIXME
					# If autoinit calls a method that has a different return type
					# it its used in this operation and raises an exception
					exec 'retval -= self.' + init
			else:
				exec 'retval -= self.' + autoinit

		return retval

	# Default handlers
	def on_cancelbutton_clicked(self, widget):
		"""
		Default handler for B{Cancel} buttons C{clicked} signal.
		
		@param widget: The widget receiving the signal
		@type widget: L{gtk.Widget}
		"""
		
		if self.DEBUG:
			print >>sys.stderr, BLUE + "on_cancelbutton_clicked" + SGR0
		gtk.main_quit()

	def on_autosensitize(self, widget, targetWidget):
		"""
		Toggle the 'sensitive' property on a target widget
		"""

		# Please !!!!
		# Tell me why there's no get_sensitive !!!!
		#s = targetWidget.get_sensitive()
		s = targetWidget.get_property('sensitive')
		targetWidget.set_sensitive(not s)

	def on_autoshow(self, widget, targetWidget):
		"""
		Toggle the 'visible' property on a target widget
		"""

		cond = FN()
		debug("%s(%s, %s)" % (cond, widget, targetWidget), cond)

		if targetWidget.get_property('visible'):
			targetWidget.hide()
		else:
			targetWidget.show()

		# FIXME
		# This is perhaps not true, but it's a good assumption,
		# if widgets were showed or hidden it's a good opportunity to
		# resize
		# Actually it seems to be false, when resized the window returns
		# to its original size, not its current size if it was resized
		self.__mainTopLevelWidget.getWidget().resize(1,1)

	def on_automenuitem_activate(self, widget, *args):
		"""
		Default handler for menu items C{activate} signal
		
		This is a handler method intended to be a simple menu item handler.
		The idea is to simplify handling menu items usually connected to
		dialog boxes.
		activate signal on the menu item object must point to this function
		and user data parameter of this signal must point to the object to
		call.
		In the case of a dialog, user data parameter is the dialog object
		which this method will run.
		
		This can also be used (and it's used by autoInvoke) in
		L{gtk.ToolButton} objects.

		@param widget: The widget receiving the signal
		@type widget: L{gtk.Widget}
		"""
		
		cond = FN()
		debug("%s(%s, %s)" % (cond, widget, args), cond)

		if isinstance(widget, gtk.MenuItem):
			self.autoInvoke(widget)
		elif isinstance(widget, gtk.ToolButton):
			self.autoInvoke(widget)
		elif isinstance(widget, gtk.Dialog):
			widget.run()
		else:
			warning("Not implemented yet: %s" % widget)
			
	def on_autobutton_clicked(self, widget, *args):
		"""
		on_autobutton_clicked
		
		@param widget: The widget receiving the signal
		@type widget: L{gtk.Widget}
		"""
		
		cond = FN()
		debug("%s(%s, %s)" % (cond, widget, args), cond)

		if isinstance(widget, gtk.Button):
			if args:
				self.autoInvoke(widget, args[0])
			else:
				self.autoInvoke(widget)
		elif isinstance(widget, gtk.ToolButton):
			self.autoInvoke(widget)
		elif isinstance(widget, gtk.Dialog):
			widget.run()
		else:
			warning("%s: Not implemented yet: %s" % (cond, widget))

	def on_autotoolbutton_clicked(self, widget):
		"""
		on_autotoolbutton_clicked
		
		@param widget: The widget receiving the signal
		@type widget: L{gtk.Widget}
		"""
		
		return self.on_autobutton_clicked(widget)

	def on_autofontbutton_font_set(self, widget, *args):
		"""
		on_autofontbutton_font_set
		"""

		cond = FN()
		debug("%s(%s, %s)" % (cond, widget, args), cond)
		fontButton = widget
		targetWidget = self[args[0]]
		fontName = fontButton.get_font_name()
		try:
			import pango
			pangoFont = pango.FontDescription(fontName)
		except:
			pangoFont = None
		targetWidget.modify_font(pangoFont)


	def autoInvoke(self, widget, *args):
		"""
		Auto invoke the method codified in widget name
		
		Auto invoke the method codified and described in the Glade widget name.
		The pattern string is described by the regular expression in X{self.__reAutoInvoke}
		which typically is '(.*):auto:(.*)' or everything before ':auto:' is the
		standard widget name, and everything after is the method name or widget (in
		the case of L{gtk.Dialog}) to be invoked.
		
		The methods C{name}Pre, C{name} and C{name}Post are invoked in order (if exist)
		and if and only if the predecesor returns C{True}.
		
		@param widget: The widget receiving the signal
		@type widget: L{gtk.Widget}
		"""
		
		cond = FN()
		debug("%s start" % cond, cond)

		name = widget.get_name()
		m = self.__reAutoInvoke.match(name)
		if m:
			f = m.group(AUTO_INVOKE_METHOD)
			debug("%s: should invoke method '%s' with args %s" % (cond, f,
				args), cond)

			# Pre
			pre = True
			try:
				pre = getattr(self, f + 'Pre')(args)
			except AutoGladeAttributeError, ex:
				if self.DEBUG:
					print >>sys.stderr, 50*'@'
					print >>sys.stderr, 'Not raising exception because should correspond to a' \
						'not yet implemented method self.' + f + 'Pre.'
					print >>sys.stderr, f + "Pre() undefined. ex=%s pre=%s" % (ex, pre)
					print >>sys.stderr, ex.__str__()
					print >>sys.stderr, 50*'@'
			# FIXME !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			#except FuckingAttributeError, ex:
			#	# FIXME
			#	# For some reason self. is removed from the method name when
			#	# the exception is raised
			#	if 'self.' + ex.__str__() == method:
			#		if self.DEBUG:
			#			print >>sys.stderr, 50*'@'
			#			print >>sys.stderr, 'Not raising exception because should correspond to a' \
			#				'not yet implemented method self.' + method
			#			print >>sys.stderr, f + "Pre() undefined. ex=%s pre=%s" % (ex, pre)
			#			print >>sys.stderr, ex.__str__()
			#			print >>sys.stderr, 50*'@'
			#	else:
			#		if self.DEBUG:
			#			print >>sys.stderr, 50*'@'
			#			print >>sys.stderr, 'Raisin exception'
			#			print >>sys.stderr, 50*'@'
			#		raise ex
			except NameError, ex:
				if self.DEBUG:
					print >>sys.stderr, 50*'@'
					print >>sys.stderr, 'Not raising exception because should correspond to a' \
						'not yet implemented method self.' + method
					print >>sys.stderr, f + "Pre() undefined. ex=%s pre=%s" % (ex, pre)
					print >>sys.stderr, ex.__str__()
					print >>sys.stderr, 50*'@'
			except Exception, ex:
				raise ex
			
			post = False
			# Method
			if pre:
				try:
					# try to find 'f' as an attribute
					obj = getattr(self, f)
					debug("%s: obj=%s class=%s" % (cond, obj,
						obj.__class__.__name__), cond)

					if callable(obj):
						post = obj(args)
					elif isinstance(obj, gtk.Dialog):
						# FIXME:
						# I'm not sure that post should be assigned here and that
						# it receives the correct value after assignement
						resp = obj.run()
						debug("%s: resp=%s" % (cond, resp), cond)
						# FIXME:
						# Not sure about this hide
						obj.hide()
				#except:
					#try:
					#	# if 'f' was not an attribute, then call it
					#	# FIXME:
					#	# perhpas self. should not be imposed
					#	#post = eval('self.' + f + '(%s)' % args)
					#	#method = self.__getattr__(f)
					#	method = getattr(self, f)
					#	post = method(args)
					#except AutoGladeAttributeError, ex:
					#	raise RuntimeError("Method '%s' not implemented yet or attribute not found exception inside this method: %s" % (f, ex))
				except AutoGladeAttributeError, ex:
					raise RuntimeError("Method '%s' not implemented yet or 'attribute not found exception' inside this method: %s" % (f, ex))
				except Exception, ex:
					raise ex
			
			# Post
			if post:
				try:
					getattr(self, f + 'Post')(args)
				except:
					pass
		else:
			"""
			Sometimes C{aboutdialog} is not added as C{user data} parameter to
			the C{on_automenuitem_activate} handler, so here is a fallback.
			Is this a libglade or gtk.Glade bug ?
			"""
			debug("%s: autoInvoke: NO MATCH" % cond, cond)
			if len(args) >= 1 and isinstance(args[0], gtk.Dialog):
				# FIXME
				# realy goes here ?
				debug("%s: fallback running dialog %s (%s)"% (cond, name,
					args[0]))
				return args[0].run()
	
	def on_autodialog_response(self, widget, response, *args):
		"""
		Default handler for L{gtk.Dialog} C{response} signal
		
		This is a handler method intended to be a simple dialog handler.
		response signal of widget must be connected to this method and the
		user data parameter must be left untouched (as of Glade 3.0 and
		libglade 2).
		
		Note:
		Perhaps this method should set a Singleton object value to the response
		received
		
		gtk response values
		===================
		These are the response values::

			gtk.RESPONSE_NONE=-1
			gtk.RESPONSE_REJECT=-2
			gtk.RESPONSE_ACCEPT=-3
			gtk.RESPONSE_DELETE_EVENT=-4
			gtk.RESPONSE_OK=-5
			gtk.RESPONSE_CANCEL=-6
			gtk.RESPONSE_CLOSE=-7
			gtk.RESPONSE_YES=-8
			gtk.RESPONSE_NO=-9
			gtk.RESPONSE_APPLY=-10
			gtk.RESPONSE_HELP=-11
		
		@param widget: The widget receiving the signal
		@type widget: L{gtk.Widget}
		
		@param response: The dialog response (i.e.: button pressed)
		@type response: int
		"""
		
		cond = FN()
		debug("%s(%s, %s, %s)" % (cond, widget, response, args), cond)

		if response in [gtk.RESPONSE_CLOSE, gtk.RESPONSE_OK,
				gtk.RESPONSE_CANCEL,
				gtk.RESPONSE_ACCEPT, gtk.RESPONSE_REJECT,
				gtk.RESPONSE_DELETE_EVENT, gtk.RESPONSE_NONE]:
			debug('\thiding widget=%s' % widget)
			widget.hide()

	def on_autobuttonexpandall_clicked(self, widget):
		cond = FN()
		debug('%s' % cond, cond)
		widget.expand_all()
		
	def on_autobuttoncollapseall_clicked(self, widget):
		cond = FN()
		debug('%s' % cond, cond)
		widget.collapse_all()
		
	def autoRun(self):
		"""
		auto run the graphical user interface

		Runs the graphical user interface automatically.
		There ase some special cases contempled.

			1. If there's no L{__mainTopLevelWidget} then it does nothing

			2. If the L{__mainTopLevelWidget} is a L{gtk.Dialog} then the
			dialog box is run. Loops forever until one of the values of a
			valid response is received, then return this value

			3. if the L{__mainTopLevelWidget} is not a L{gtk.Dialog} then the
			main GTK loop is entered
		"""

		if self.__mainTopLevelWidget:
			if self.DEBUG:
				print >>sys.stderr, "main widget: %s" % \
					self.__mainTopLevelWidget.getName()
			mw = self.__mainTopLevelWidget.getWidget()
			mw.show()

			if isinstance(mw, gtk.Dialog):
				if self.DEBUG:
					print >>sys.stderr, "It's a dialog instance, running it until one of the valid responses is received..."
				while True:
					# we could have been done this if gtk.Dialog implements
					# __call__(self):
					#   self.run()
					#resp = mw()
					resp = mw.run()
					if self.DEBUG:
						print >>sys.stderr, "\tresp=", resp
					if resp in [gtk.RESPONSE_CLOSE, gtk.RESPONSE_OK,
							gtk.RESPONSE_CANCEL,
							gtk.RESPONSE_DELETE_EVENT, gtk.RESPONSE_NONE]:
						return resp
					elif resp == gtk.RESPONSE_HELP:
						self.autoHelp()
			else:
				gtk.main()

	def autoProperty(self, widget, args):
		debug("autoProperty(%s, %s)" % (widget, args))
		property = args[0]
		val = args[1]
		target = args[2]
		targetWidget = self[target]
		method = getattr(targetWidget, 'set_' + property)
		debug("autoProperty: method=%s val=%s (%s)" % (method, int(val), type(val)))
		method(int(val))

	def autoExec(self, widget, args):
		debug("autoExec(%s, %s)" % (widget, args))

	def autoErrorDialog(self, ex):
		m = gtk.MessageDialog(type=gtk.MESSAGE_ERROR,
			buttons=gtk.BUTTONS_OK, message_format=None)
		m.set_title("Error")
		m.set_markup(ex.__str__())
		m.run()
		m.hide()

	def autoWarningDialog(self, msg, message_format=None):
		w = gtk.MessageDialog(type=gtk.MESSAGE_WARNING,
			buttons=gtk.BUTTONS_OK, message_format=message_format)
		w.set_title("Warning")
		w.set_markup(msg)
		w.run()
		w.hide()

	def autoQuestionDialog(self, msg, buttons=gtk.BUTTONS_YES_NO):
		if self.DEBUG:
			print >>sys.stderr, "autoQuestionDialog(%s)" % msg
		q = gtk.MessageDialog(type=gtk.MESSAGE_QUESTION,
			buttons=buttons, message_format=None)
		q.set_title("Question")
		q.set_markup(msg)
		resp = q.run()
		if self.DEBUG:
			print >>sys.stderr, "\tresp=%s" % resp
		q.hide()
		return resp

	def autoInfoDialog(self, msg="No message", message_format=None):
		i = gtk.MessageDialog(type=gtk.MESSAGE_INFO,
			buttons=gtk.BUTTONS_OK, message_format=message_format)
		i.set_title("Info")
		# msg must be flattened
		if isinstance(msg, tuple):
			msg = msg[0]
		i.set_markup(msg)
		resp = i.run()
		if self.DEBUG:
			print >>sys.stderr, "**** autoInfoDialog: resp=%s" % resp
		i.hide()
		return resp

	def autoAddTimeout(self, msecs=1000, method=None, *args):
		if isinstance(method, str):
			method = getattr(self, method)
		self.__timerId = gobject.timeout_add(msecs, method, args)

	def autoProgressBar(self, args):
		if self.DEBUG:
			print >>sys.stderr, ">>>> autoProgressBar (BEGIN) args='%s'" % args
		# flatten args
		if not args:
			return False

		name = args[0]

		if len(args) > 1:
			okButton = args[1]
		else:
			okButton = None

		if len(args) > 2:
			cancelButton = args[2]
		else:
			cancelButton = None

		line = sys.stdin.readline()
		if not line:
			return False
		if self.DEBUG:
			print >>sys.stderr, "\tline='%s'" % line
		n = 0
		try:
			n = int(line)
		except:
			pass
		v = n/100.0
		if self.DEBUG:
			print >>sys.stderr, "\tupdating n=%s %s" % (n, v)
		self[name].set_fraction(v)
		self[name].set_text("%s %%" % n)
		if v >= 1.0:
			if okButton:
				if self.DEBUG:
					print >>sys.stderr, "\tsetting sensitive on %s" % (okButton)
				self[okButton].set_sensitive(True)
			if cancelButton:
				if self.DEBUG:
					print >>sys.stderr, "\tsetting sensitive on %s" % (cancelButton)
				self[cancelButton].set_sensitive(False)
			return False
		if self.DEBUG:
			print >>sys.stderr, ">>>> autoProgressBar (END)"
		return True

	def isInputClass(self, widgetClass):
		return widgetClass in INPUT_CLASS

	def autoDumpText(self, var, val):
		print "%s:%s" % (var, val)
		
	def autoDumpShell(self, var, val):
		if var != 'autoargs':
			if self.__autoArgs:
				self.__autoArgs += ' '
			self.__autoArgs += '$' + var

		# FIXME
		# special charcters in var should be mapped
		# single quotes in val should be mapped or escaped
		print "%s='%s'" % (var, val)

	def autoDumpValues(self, dummy):
		# if autoDumpValues is used in a widget as widget:auto:autoDumpValues
		# then a None value is added because there's no parameters
		# specified, that's why a 'dummy' is needed here
		cond = FN()
		debug("autoDumpValues(%s)" % (dummy), cond)
		
		# FIXME
		# this may not be needed
		self.__autoArgs = ''

		for element in self.__gladeInterface.getElementsByTagName('widget'):
			widgetClass = element.getAttribute('class')
			if self.isInputClass(widgetClass):
				name = element.getAttribute('id')
				m = self.__reAutoInvoke.match(name)
				if m:
					# this is the case of one widget named as the autoInvoke
					# convention widget:auto:method
					# because of this name it cannot be invoked as self.name
					# so a workaround should be used
					# another alternative would be to use a '_' instead of ':'
	
					# n is the 'real' widget name, the first part of the mapped
					# name widget:auto:method
					n = m.group(AUTO_INVOKE_WIDGET)
				else:
					n = name
				if self.DEBUG:
					print >>sys.stderr, '%s\tshould dump %s (%s)%s' % (RED, n, name, SGR0)
				if widgetClass == 'GtkRadioButton':
					# it seems that there's no group leader, or even there's no
					# such concept in glade, and we don't have a way to obtain
					# the group leader to obtain its name and use it to
					# print the values (label values)
					# to solve this a convention is used, all of the
					# radiobuttons must be named name<n> and the number is
					# stripped when printed
					for rb in self[name].get_group():
						if self.DEBUG:
							print >>sys.stderr, "group contains rb: %s %s" % (
								rb.get_name(), rb.get_active())
						n = rb.get_name()
						if n == name and rb.get_active():
							if self.DEBUG:
								print >>sys.stderr, "rb %s is active" % n
							# remove the last number from widget name (group)
							m = self.__reAutoInvoke.match(n)
							if m:
								n = m.group(AUTO_INVOKE_WIDGET)
							nnn = re.match('(.+\D)\d+$', n).group(1)
							debug("**** n=%s" % n)
							debug("***** nnn=%s" % nnn)
							debug("***** name=%s" % name)
							v = None
							try:
								v = self.__dump[n]
							except:
								v = rb.get_label().replace('_','')
							self.__autoDumpMap[self.__autoDump](nnn, v)
							#	rb.get_label().replace('_',''))
				elif widgetClass in ['GtkCheckButton', 'GtkToggleButton']:
					v = self[name].get_active()
					d = None
					try:
						d = self.__dump[n]
					except:
						pass

					if v:
						if d:
							v = d
					else:
						if d:
							v = ''

					self.__autoDumpMap[self.__autoDump](n, v)
				elif widgetClass == 'GtkEntry':
					w = self[name]
					if isinstance(self[name], gtk.ComboBoxEntry):
						w = w.child
					self.__autoDumpMap[self.__autoDump](n, w.get_text())
				elif widgetClass == 'GtkComboBox':
					self.__autoDumpMap[self.__autoDump](n, self[name].get_active_text())
				elif widgetClass in ['GtkHScale','GtkVscale','GtkSpinButton']:
					fmt = "%d"
					if self[name].get_digits() > 0:
						fmt = "%f"
					self.__autoDumpMap[self.__autoDump](n, fmt % self[name].get_value())
				elif widgetClass == 'GtkFileChooserButton':
					self.__autoDumpMap[self.__autoDump](n, self[name].get_filename())
				elif widgetClass == 'GtkColorButton':
					color = self[name].get_color()
					self.__autoDumpMap[self.__autoDump](n,
						"#%04x%04x%04x" % (color.red, color.green, color.blue))
				elif widgetClass == 'GtkFontButton':
					self.__autoDumpMap[self.__autoDump](n, self[name].get_font_name())
				elif widgetClass == 'GtkCalendar':
					self.__autoDumpMap[self.__autoDump](n, self[name].get_date())
				elif widgetClass == 'GtkCurve':
					self.__autoDumpMap[self.__autoDump](n, self[name].get_vector(size=-1))
				elif widgetClass == 'GtkGammaCurve':
					self.__autoDumpMap[self.__autoDump](n, self[name].curve.get_vector(size=-1))
				elif widgetClass == 'GtkTreeView':
					(model, paths) = self[name].get_selection().get_selected_rows()
					s = "("
					for path in paths:
						first = True
						for c in model[path]:
							if not first:
								s += " "
							else:
								first = False
							s += '"' + c + '"'
					s += ")"
					self.__autoDumpMap[self.__autoDump](n, s)
				else:
					print >>sys.stderr, "autoDumpValues: Not implemented: %s" % widgetClass

		self.__autoDumpMap[self.__autoDump]('autoargs', self.__autoArgs)

	def autoDialog(self, widget, *args):
		cond = FN()
		debug("%s: widget=%s args=%s" % (cond, widget, args), cond)
		self.on_autodialog_response(widget, *args)

	def autoHelp(self):
		if self.DEBUG:
			print >>sys.stderr, "=================================="
			print >>sys.stderr, "HELP"
			print >>sys.stderr, "=================================="
		try:
			import gnome
			gnome.help_display(self.__programName)
		except:
			pass

	def autoQuit(self, widget, *args):
		gtk.main_quit()

	def autoAbout(self, widget, *args):
		cond = FN()
		debug("%s: widget=%s args=%s" % (cond, widget, args), cond)
		ago = self.__autoGladeObjects[AGO_DIALOG_ABOUT]
		if ago:
			dialog = ago.getWidget()
			if dialog:
				dialog.run()

	def autoNew(self, widget, *args):
		cond = FN()
		debug("%s: widget=%s args=%s" % (cond, widget, args), cond)
		autoNewMethod = None
		methodOrWidgetName = None

		name = widget.get_name()
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			methodOrWidget = getattr(self, methodOrWidgetName)
			if isinstance(methodOrWidget, gtk.TextView):
				tv = methodOrWidget
				widget = tv
				if tv.get_buffer().get_modified():
					debug("autoNew: buffer was modified, should save !", cond)
					# FIXME
					# this is copied from autoOpen (refactor!) 
					try:
						filename = self.__autoProperties[methodOrWidgetName]['filename']
						message_format = "Do you want to save changes to %s ?" % \
							filename
					except:
						filename = None
						message_format = "Do you want to save changes ?"

					dialog = gtk.MessageDialog(parent=None,
						type=gtk.MESSAGE_QUESTION,
						buttons=gtk.BUTTONS_YES_NO,
						message_format=message_format)
					resp = dialog.run()
					debug("%s: resp=%s" % (cond, resp), cond)
					dialog.hide()
					if resp == gtk.RESPONSE_ACCEPT:
						self.autoSave(tv, args)
		
		debug("%s: new(%s)" % (cond, widget), cond)
		self.new(widget)
		try:
			del self.__autoProperties[methodOrWidgetName]['filename']
			debug("%s: deleting property filename for %s" % (cond, methodOrWidgetName), cond)
		except Exception, ex:
			# if it wasn't the property not found because it was never set
			if ex.message != methodOrWidgetName:
				raise Exception(ex)

	def autoOpen(self, widget, *args):
		cond = FN()
		autoOpenMethod = None

		name = widget.get_name()
		debug("%s: name: %s" % (cond, name), cond)
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			methodOrWidget = getattr(self, methodOrWidgetName)
			debug("%s: method or widget: %s" % (cond, methodOrWidget), cond)
			if isinstance(methodOrWidget, gtk.TextView):
				widget = methodOrWidget
				if widget.get_buffer().get_modified():
					debug("%s: buffer was modified, should save !" % cond, cond)
					# The Buttons Type constants specify the pre-defined sets of buttons for the dialog. If none of these choices are appropriate, simply use gtk.BUTTONS_NONE then call the add_buttons() method.
					try:
						filename = self.__autoProperties[methodOrWidgetName]['filename']
						message_format = "Do you want to save changes to %s ?" % \
							filename
					except:
						filename = None
						message_format = "Do you want to save changes ?"

					dialog = gtk.MessageDialog(parent=None,
						type=gtk.MESSAGE_QUESTION,
						buttons=gtk.BUTTONS_YES_NO,
						message_format=message_format)
					resp = dialog.run()
					debug("%s: resp=%s" % (cond, resp), cond)
					dialog.hide()
					if resp == gtk.RESPONSE_ACCEPT:
						self.autoSave(widget, args)

		fcd = gtk.FileChooserDialog(parent=None,
			buttons=(gtk.STOCK_CANCEL, gtk.RESPONSE_REJECT,
				gtk.STOCK_OPEN, gtk.RESPONSE_ACCEPT))
		# FIXME
		# why multiple selection when then is discarded in self.open() bellow ?
		#fcd.set_select_multiple(True)
		fcd.set_select_multiple(False)
		resp = fcd.run()
		fcd.hide()
		if resp == gtk.RESPONSE_ACCEPT:
			self.open(fcd.get_filenames()[0], widget)

	def autoSaveas(self, widget, *args):
		cond = FN()
		autoOpenMethod = None

		name = widget.get_name()
		debug("%s: name: %s" % (cond, name), cond)
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)

		fcd = gtk.FileChooserDialog(parent=None,
			action=gtk.FILE_CHOOSER_ACTION_SAVE,
			buttons=(gtk.STOCK_CANCEL, gtk.RESPONSE_REJECT,
				gtk.STOCK_SAVE, gtk.RESPONSE_ACCEPT))
		fcd.set_select_multiple(False)
		try:
			fcd.set_filename(self.__autoProperties[methodOrWidgetName]['filename'])
		except:
			pass
		resp = fcd.run()
		fcd.hide()
		if resp == gtk.RESPONSE_ACCEPT:
			if m:
				methodOrWidget = getattr(self, methodOrWidgetName)
				debug("autoOpen: method or widget: %s" % methodOrWidget, cond)
				if isinstance(methodOrWidget, gtk.TextView):
					widget = methodOrWidget
					name = methodOrWidgetName

			filename = fcd.get_filenames()[0]
			self.save(filename, widget)
			self.__autoProperties.setdefault(methodOrWidgetName, {}).update(
					{'filename':filename})

	def autoSave(self, widget, *args):
		cond = FN()
		autoOpenMethod = None

		name = widget.get_name()
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			try:
				filename = self.__autoProperties[methodOrWidgetName]['filename']
			except:
				return self.autoSaveas(widget, args)
			methodOrWidget = getattr(self, methodOrWidgetName)
			debug("%s: method or widget: %s" % (cond, methodOrWidget), cond)
			if isinstance(methodOrWidget, gtk.TextView):
				widget = methodOrWidget

			self.save(filename, widget)

	def autoCopy(self, widget, *args):
		cond = FN()
		name = widget.get_name()
		debug("autoCopy: name: %s" % name, cond)
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			methodOrWidget = getattr(self, methodOrWidgetName)
			debug("autoCopy: method: %s" % methodOrWidget, cond)
			if isinstance(methodOrWidget, gtk.TextView):
				tv = methodOrWidget
				tv.get_buffer().copy_clipboard(gtk.Clipboard())

	def autoCut(self, widget, *args):
		cond = FN()
		name = widget.get_name()
		debug("autoCut: name: %s" % name, cond)
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			methodOrWidget = getattr(self, methodOrWidgetName)
			debug("autoCut: method: %s" % methodOrWidget, cond)
			if isinstance(methodOrWidget, gtk.TextView):
				tv = methodOrWidget
				tv.get_buffer().cut_clipboard(gtk.Clipboard(), tv.get_editable())

	def autoPaste(self, widget, *args):
		cond = FN()
		name = widget.get_name()
		debug("autoCopy: name: %s" % name, cond)
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			methodOrWidget = getattr(self, methodOrWidgetName)
			debug("autoCopy: method: %s" % methodOrWidget, cond)
			if isinstance(methodOrWidget, gtk.TextView):
				tv = methodOrWidget
				tv.get_buffer().paste_clipboard(gtk.Clipboard(), None,
					tv.get_editable())

	def autoDelete(self, widget, *args):
		cond = FN()
		name = widget.get_name()
		debug("autoCopy: name: %s" % name, cond)
		m = self.__reAutoInvoke.match(name)
		if m:
			methodOrWidgetName = m.group(AUTO_INVOKE_METHOD)
			methodOrWidget = getattr(self, methodOrWidgetName)
			debug("autoCopy: method: %s" % methodOrWidget, cond)
			if isinstance(methodOrWidget, gtk.TextView):
				tv = methodOrWidget
				tv.get_buffer().delete_selection(True, tv.get_editable())

		
	def autoPreferences(self, widget, *args):
		if self.DEBUG:
			print >>sys.stderr, "autoPreferences: name: %s" % self.__menuItemPreferences.getName()
		print >>sys.stderr, "autoPreferences: ***** SEMI IMPLEMENTED *****"
		# do something with preferences values
		# FIXME
		# this code is copied form autoRun
		# needs to be refactored
		#resp = self.__preferencesDialog.getWidget().run()
		ago = self.__autoGladeObjects[AGO_DIALOG_PREFERENCES]
		if ago:
			dialog = ago.getWidget()
			resp = dialog.run()
			if self.DEBUG:
				print >>sys.stderr, "\tresp=", resp
			if resp in [gtk.RESPONSE_CLOSE, gtk.RESPONSE_OK,
					gtk.RESPONSE_CANCEL,
					gtk.RESPONSE_DELETE_EVENT, gtk.RESPONSE_NONE]:
				dialog.hide()
				return resp
			elif resp == gtk.RESPONSE_HELP:
				self.autoHelp()


	def printval(self, *args):
		str = "No value"
		exitval = -1

		if self.DEBUG:
			print "1) printval: args=%s len=%d" % (args, len(args))
		
		# msg must be flattened
		if isinstance(args, tuple):
			args = args[0]
			if isinstance(args, tuple):
				args = args[0]

		if args and len(args) > 0:
			str = args[0]
		if args and len(args) > 1:
			exitval = int(args[1])
		
		# print the str
		print str
		if exitval >= 0:
			sys.exit(exitval)

	def new(self, widget):
		if widget:
			if isinstance(widget, gtk.TextView):
				tv = widget
				tv.get_buffer().set_text("")
				tv.get_buffer().set_modified(False)
			
	def open(self, filename, widget):
		cond = FN()
		debug("%s: open filename=%s" % (cond, filename), cond)
		if widget:
			name = widget.get_name()
			debug("%s: and set %s" % (cond, name), cond)
			if isinstance(widget, gtk.TextView):
				tv = widget
				f = open(filename)
				tv.get_buffer().set_text(f.read())
				f.close()
				tv.get_buffer().set_modified(False)
				self.__autoProperties.setdefault(name, {}).update(
					{'filename':filename})

	def save(self, filename, widget):
		cond = FN()
		debug("%s: save filename=%s" % (cond, filename), cond)
		if widget:
			debug("%s: from %s" % (cond, widget.get_name()), cond)
			if isinstance(widget, gtk.TextView):
				tv = widget
				f = open(filename, "w")
				buf = tv.get_buffer()
				(start, end) = buf.get_bounds()
				f.write(buf.get_text(start, end))
				f.close()
				tv.get_buffer().set_modified(False)

	def abbreviations(self):
		self.aed = self.autoErrorDialog
		self.aid = self.autoInfoDialog
		self.aqd = self.autoQuestionDialog
		self.awd = self.autoWarningDialog
		self.apb = self.autoProgressBar
		self.aat = self.autoAddTimeout

# Utility methods
# not AutoGlade class members
def treeview_toogle_expansion(treeview, path):
	if treeview.row_expanded(path):
		treeview.collapse_row(path)
	else:
		treeview.expand_row(path, open_all=False)


usage = "usage: autoglade [options] [file.glade]"
	
if __name__ == "__main__":
	autorun = True

	parser = OptionParser(usage=usage,
		version = "%s version %s (%s)" % (prog, version, revision))
	parser.add_option("-?", action="help",
		help="show this help message and exit")
	parser.add_option("-V", "--long-version", action="store_true",
		dest="longversion", help="Get the long version message")
	parser.add_option("-i", "--autoinit", type="string",
		dest="autoinit",
		help="Pass an autoinit sequence")
	parser.add_option("", "--autoinit-split", type="string",
		dest="autoinitSplit", default=':',
		help="Split autoinit sequence at specified delimiter (NONE to avoid splitting")
	parser.add_option("-d", "--autodump", type="string",
		dest="autodump", default='shell',
		help="Use the specified syntax type for autodump (shell, text)")
	parser.add_option("", "--get-widget-names", action="store_true",
		dest="getWidgetNames", default=False,
		help="Get the list of widget names in the glade file")
	parser.add_option("", "--get-signal-handlers", action="store_true",
		dest="getSignalHandlers", default=False,
		help="Get the list of signal handlers in the glade file")
	parser.add_option("", "--widget-class-filter", type="string",
		dest="widgetClassFilter", default=None,
		help="Specifies a widget class filter for some operations")
	parser.add_option("", "--widget-canonical-names", action="store_true",
		dest="widgetCanonicalNames", default=False,
		help="Widget's canonical names instead of autoglade full names")
	parser.add_option("-r", "--root", type="string",
		dest="root", default=None,
		help="Name of the root widget")
	parser.add_option("-x", "--debug", type="string",
		dest="debug", help="Print debug messages", default=DEBUG)
	
	(options, args) = parser.parse_args()

	DEBUG.append(options.debug)

	if options.longversion:
		print "autoglade version %s (%s)" % (version, revision)
		print __license__
		sys.exit(0)

	l = len(args)
	if l >= 1:
		glade = args[0]
		cmdlineargs = args
	elif l == 0:
		glade = None
		cmdlineargs = None
		if options.getWidgetNames or options.getSignalHandlers:
			print >>sys.stderr, "ERROR: to obtain the list of widget names or signal handlers a glade file must be specified"
			sys.exit(1)
		if not options.autoinit:
			print >>sys.stderr, "WARNING: autoinit is empty and no glade file specified."
	else:
		print >>sys.stderr, usage
		sys.exit(1)

	debug("root=%s" % options.root, True)
	debug("autoinit=%s" % options.autoinit)
	debug("autonitsplit=%s" % options.autoinitSplit)
	debug("autodump=%s" % options.autodump)

	if options.getWidgetNames or options.getSignalHandlers:
		autorun = False

	ag = AutoGlade(glade, autorun=autorun, root=options.root, 
		autoinit=options.autoinit, autoinitSplit=options.autoinitSplit,
		autodump=options.autodump)

	if not autorun:
		if options.getWidgetNames:
			for wn in ag.getWidgetNames(options.widgetClassFilter,
					options.widgetCanonicalNames):
				print wn
		elif options.getSignalHandlers:
			for (sh, s) in ag.getSignalHandlers().iteritems():
				print "%s: %s %s" % (sh, s[1], s[0])
