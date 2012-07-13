#! /bin/sh
# $Id$

export enable='True'

${AUTOGLADE:-autoglade} ${0%.sh}.glade
