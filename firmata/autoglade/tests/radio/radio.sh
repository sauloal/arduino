#! /bin/sh
# $Id: radio.sh 89 2009-02-11 17:20:43Z dtmilano $

# to select the active radio button set the variable whose name is the
# same as the group with the number removed
# for example:
#export radiobuttonopt='Option 1'
#export radiobuttonopt='Option 2'
#export radiobuttonopt='Option 3'

for i in 1 2 3
do
	radiobuttonopt="Option $i" ${AUTOGLADE:-autoglade} --autoinit="aid('Option $i should be selected by default in next dialog')" ${0%.sh}.glade
	[ "$?" -eq 6 ] && break
done
