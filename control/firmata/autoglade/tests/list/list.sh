#! /bin/sh
# $Id: list.sh 71 2008-09-02 21:47:31Z dtmilano $

# for example:
# header is the first element
export treeview1='("Fruits" "Apples" "Bananas" "Hedge aple" "Kiwifruits" "Melons" "Oranges" "Pineapples" "Strawberries" )'

${AUTOGLADE:-autoglade} ${0%.sh}.glade
