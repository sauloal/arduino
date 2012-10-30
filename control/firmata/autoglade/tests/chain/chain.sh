#! /bin/sh
# $Id: chain.sh 75 2008-09-28 21:23:57Z dtmilano $

export combobox1='Item 2'

${AUTOGLADE:-autoglade} ${0%.sh}.glade
