#!/usr/bin/env python
#https://bitbucket.org/devries/arduino-comm-example/raw/23e098b8a6a6/python-ui.py
#https://bitbucket.org/devries/arduino-comm-example/src

import sys
import Tkinter
import threading
import Queue
import serial

def main(argv=None):
    if argv is None:
        argv = sys.argv
    
    inputQ = Queue.Queue()
    outputQ = Queue.Queue()
    manager = CommunicationManager(inputQ,outputQ)
    gui = GuiClass(inputQ,outputQ,manager)

    gui.go()

    return 0

class GuiClass(object):
    def __init__(self,inputQ,outputQ,commManager):
        self.inputQ=inputQ
        self.outputQ=outputQ
        self.manager=commManager

        self.root = Tkinter.Tk()
        
        text_frame = Tkinter.Frame(self.root)
        entry_frame = Tkinter.Frame(self.root)
        
        scrollbar = Tkinter.Scrollbar(text_frame)
        self.text = Tkinter.Text(text_frame,height=5,width=80,wrap=Tkinter.WORD,yscrollcommand=scrollbar.set)
        scrollbar.pack(side=Tkinter.RIGHT,fill=Tkinter.Y)
        self.text.pack(fill=Tkinter.BOTH,expand=True)
        scrollbar.config(command=self.text.yview)

        portLabel = Tkinter.Label(entry_frame, text="Arduino Port: ")
        self.arduinoFile = Tkinter.StringVar()
        portEntry = Tkinter.Entry(entry_frame, textvariable=self.arduinoFile)
        portButton = Tkinter.Button(entry_frame, text="Connect", command=self.connect)
        portLabel.pack(side=Tkinter.LEFT)
        portEntry.pack(side=Tkinter.LEFT,fill=Tkinter.X,expand=True)
        portButton.pack(side=Tkinter.LEFT)

        queryButton = Tkinter.Button(self.root,text="Query",command=self.query)
        quitButton = Tkinter.Button(self.root,text="Quit",command=self.root.quit)
        entry_frame.pack(fill=Tkinter.X)
        text_frame.pack(fill=Tkinter.BOTH,expand=True)
        queryButton.pack(fill=Tkinter.X)
        quitButton.pack(fill=Tkinter.X)
        self.text.configure(state=Tkinter.DISABLED)
        self.firstline=True

        # Menubar
        menubar = Tkinter.Menu(self.root)
        filemenu = Tkinter.Menu(menubar,tearoff=False)
        #filemenu.add_command(label="Open...",command=self.openport)
        filemenu.add_separator()
        filemenu.add_command(label="Quit",command=self.root.quit)
        menubar.add_cascade(label="File",menu=filemenu)
        self.root.config(menu=menubar)
        self.root.title("Python UI")

    def go(self):
        self.root.after(100, self.periodic_check)
        self.root.mainloop()

    def connect(self):
        filename = self.arduinoFile.get()
        self.manager.connect(filename)
        self.root.after(2000,self.check_connection)

    def check_connection(self):
        self.outputQ.put("CHECK")

    def periodic_check(self):
        try:
            inp = self.inputQ.get_nowait()
            tokens = inp.split()
            if len(tokens)>=1:
                if tokens[0]=="CONNECT":
                    self.writeline("Arduino Connected")
                elif tokens[0]=="HIGH":
                    self.writeline("LED is On")
                elif tokens[0]=="LOW":
                    self.writeline("LED is Off")
                elif tokens[0]=="ERROR":
                    self.writeline("Error: "+' '.join(tokens[1:]))
                else:
                    self.writeline("Unrecognized response:")
                    self.writeline(inp)
        except Queue.Empty:
            pass
            # self.writeline("No Data")
        self.root.after(100, self.periodic_check)

    def writeline(self,text):
        self.text.configure(state=Tkinter.NORMAL)
        if self.firstline:
            self.firstline=False
        else:
            self.text.insert(Tkinter.END,"\n")

        self.text.insert(Tkinter.END,text)
        self.text.yview(Tkinter.END)
        self.text.configure(state=Tkinter.DISABLED)
    
    def query(self):
        self.outputQ.put("QUERY")

class CommunicationManager(object):
    def __init__(self,inputQ,outputQ):
        self.inputQ=inputQ
        self.outputQ=outputQ
        self.serialPort=None
        self.inputThread = None
        self.outputThread = None
        self.keepRunning = True
        self.activeConnection = False

    def runInput(self):
        while self.keepRunning:
            try:
                inputline = self.serialPort.readline()
                self.inputQ.put(inputline.rstrip())
            except:
                # This area is reached on connection closing
                pass
        return

    def runOutput(self):
        while self.keepRunning:
            try:
                outputline = self.outputQ.get()
                self.serialPort.write("%s\n"%outputline)
            except:
                # This area is reached on connection closing
                pass

        return

    def connect(self,filename):
        if self.activeConnection:
            self.close()
            self.activeConnection = False
        try:
            self.serialPort = serial.Serial(filename,9600)
        except serial.SerialException:
            self.inputQ.put("ERROR Unable to Connect to Serial Port")
            return
        self.keepRunning=True
        self.inputThread = threading.Thread(target=self.runInput)
        self.inputThread.daemon=True
        self.inputThread.start()
        self.outputThread = threading.Thread(target=self.runOutput)
        self.outputThread.daemon=True
        self.outputThread.start()
        self.activeConnection = True

    def close(self):
        self.keepRunning=False;
        self.serialPort.close()
        self.outputQ.put("TERMINATE") # This does not get sent, but stops the outputQ from blocking.
        self.inputThread.join()
        self.outputThread.join()
        self.inputQ.put("All IO Threads stopped")

if __name__ == "__main__":
    sys.exit(main())
