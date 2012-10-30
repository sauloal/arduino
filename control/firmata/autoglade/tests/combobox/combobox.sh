#! /bin/sh
# $Id: combobox.sh 64 2008-08-31 20:17:37Z dtmilano $

export combobox1='Item 3'
export combobox2='2'
export combobox3='not in list'
${AUTOGLADE:-autoglade} ${0%.sh}.glade
