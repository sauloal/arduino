#!/usr/bin/python


class test():
	def __init__(self, name):
		self.name = name

	def printName (self):
		print self.name

tst = test('test1')
tst.printName()


from Sirius import serialize, deserialize

print serialize(tst)
