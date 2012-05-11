var zoomy = "\n\
<h3 class=\"sectionedit1\"><a name=\"introduction\" id=\"introduction\">Introduction</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
This is a bit of a side note, there&#039;s no LCD included with the Arduino starter pack, but I figure its a popular request, so here we go! \n\
</p>\n\
\n\
<p>\n\
The LCDs we sell at Adafruit have a low power LED backlight, run on +5v and require only 6 data pins to talk to. You can use <strong>any</strong> data pins you want!\n\
</p>\n\
\n\
<p>\n\
This tutorial will cover character LCDs\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT1 SECTION \"Introduction\" [1-364] -->\n\
<h3 class=\"sectionedit2\"><a name=\"what_you_ll_need\" id=\"what_you_ll_need\">What you&#039;ll need</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<div class=\"table\">\n\
<div class=\"table sectionedit3\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/attiny2313dip.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/attiny2313dip.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=af511d&amp;w=230&amp;h=172&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Fdiecimilla.jpg\" class=\"mediacenter\" alt=\"\" width=\"230\" height=\"172\" /></a> </td><td class=\"col1\">Assembled Arduino board, preferrably a Duemilanove, or Diecimila (or whatever the latest version is) but NG is OK too </td><td class=\"col2\"><a href=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=17&amp;products_id=50\" class=\"urlextern\" title=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=17&amp;products_id=50\"  rel=\"nofollow\">Adafruit</a>   <br/>\n\
$30</td>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/10MHzcermosc.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/10MHzcermosc.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=cecf59&amp;w=232&amp;h=174&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Fusbcable.jpg\" class=\"mediacenter\" alt=\"\" width=\"232\" height=\"174\" /></a> </td><td class=\"col1\">USB Cable. Standard A-B cable is required. Any length is OK. </td><td class=\"col2\"><a href=\"http://www.adafruit.com/index.php?main_page=product_info&amp;products_id=62\" class=\"urlextern\" title=\"http://www.adafruit.com/index.php?main_page=product_info&amp;products_id=62\"  rel=\"nofollow\">Adafruit</a>  <br/>\n\
Or any computer supply store  <br/>\n\
$4</td>\n\
	</tr>\n\
	<tr class=\"row2\">\n\
		<td class=\"col0\"><img src=\"/wiki/lib/exe/fetch.php?hash=6faeea&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fparts_t.jpg\" class=\"mediacenter\" alt=\"\" /></td><td class=\"col1\">Character LCD with parallel interface <br/>\n\
The one from Adafruit comes with extra parts below</td><td class=\"col2\"><a href=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=37&amp;products_id=181\" class=\"urlextern\" title=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=37&amp;products_id=181\"  rel=\"nofollow\">Adafruit</a>  <br/>\n\
$12</td>\n\
	</tr>\n\
	<tr class=\"row3\">\n\
		<td class=\"col0\"><img src=\"/wiki/lib/exe/fetch.php?hash=9ed35b&amp;w=200&amp;h=84&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fheaderm36_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"200\" height=\"84\" /></td><td class=\"col1\">Strip of 0.1&quot; header - at least 16 pins long <br/>\n\
This comes with the Adafruit LCD&#039;s but if you got some elsewhere you&#039;ll want to buy some</td><td class=\"col2\"><a href=\"http://www.ladyada.net/wiki/partselector/header#male_header\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/header#male_header\"  rel=\"nofollow\">Generic</a> </td>\n\
	</tr>\n\
	<tr class=\"row4\">\n\
		<td class=\"col0\"><img src=\"/wiki/lib/exe/fetch.php?hash=5ca666&amp;w=151&amp;h=120&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fbbpot_t.gif\" class=\"mediacenter\" alt=\"\" width=\"151\" height=\"120\" /></td><td class=\"col1\">10K linear potentiometer <br/>\n\
The one that comes with the Adafruit kit is perfect, but you can use any 10K potentiometer or trimmer</td><td class=\"col2\"><a href=\"http://www.ladyada.net/wiki/partselector/pots\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/pots\"  rel=\"nofollow\">Generic</a> </td>\n\
	</tr>\n\
	<tr class=\"row5\">\n\
		<td class=\"col0\"><img src=\"/wiki/lib/exe/fetch.php?hash=fecc91&amp;w=150&amp;h=150&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Ftools%2F100ftsolid_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"150\" height=\"150\" /></td><td class=\"col1\">Hookup Wire <br/>\n\
Make sure its <em>not</em> stranded wire!</td><td class=\"col2\"> Any hardware store </td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT3 TABLE [408-2052] -->\n\
</div>\n\
\n\
</div>\n\
<!-- EDIT2 SECTION \"What you\'ll need\" [365-2063] -->\n\
<h3 class=\"sectionedit4\"><a name=\"character_v_graphical_lcds\" id=\"character_v_graphical_lcds\">Character v. Graphical LCDs</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
There are hundreds of different kinds of LCDs, the ones we&#039;ll be covering here are <strong>character</strong> LCDs. Character LCDs are ideal for displaying text. They can also be configured to display small icons but the icons must be only 5x7 pixels or so (very small!)\n\
</p>\n\
\n\
<p>\n\
Here is an example of a character LCD, 16 characters by 2 lines:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/LCDblue162ard.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/LCDblue162ard.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=03ad72&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2FLCDblue162ard_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
If you look closely you can see the little rectangles where the characters are displayed. Each rectangle is a grid of pixels. Compare this to a graphical LCD such as the following:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/graphiclcd.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/graphiclcd.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=2a90e5&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fgraphiclcd_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
The graphical LCD has one big grid of pixels (in this case 128x64 of them) - It can display text but its best at displaying images. Graphical LCDs tend to be larger, more expensive, difficult to use and need many more pins because of the complexity added.\n\
</p>\n\
\n\
<p>\n\
<strong>This tutorial isn&#039;t about graphical LCDs. Its only about text/character LCDs!</strong>\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT4 SECTION \"Character v. Graphical LCDs\" [2064-3264] -->\n\
<h3 class=\"sectionedit5\"><a name=\"all_kinds\" id=\"all_kinds\">All kinds!</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
OK now that we&#039;re clear about what type of LCD we&#039;re talking about, its time to also look at the different shapes they come in\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/variety.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/variety.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=2346d6&amp;w=500&amp;h=284&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fvariety_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"284\" /></a> \n\
</p>\n\
\n\
<p>\n\
Although they display only text, they do some in many shapes: from top left we have a 20x4 with white text on blue background, a 16x4 with black text on green, 16x2 with white text on blue and a 16x1 with black text on gray.\n\
</p>\n\
\n\
<p>\n\
The good news is that all of these displays are &#039;swappable&#039; - if you build your project with one you can unplug it and use another size. Your code may have to adjust to the larger size but at least the wiring is the same!\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/lcdback_t.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/lcdback_t.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=3cdbc8&amp;w=500&amp;h=230&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flcdback_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"230\" /></a> \n\
</p>\n\
\n\
<p>\n\
For this part of the tutorial, we&#039;ll be using LCDs with a single strip of 16 pins as shown above. There are <em>also</em> some with 2 lines of 8 pins like so:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/lcd.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/lcd.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=073a83&amp;w=500&amp;h=195&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flcd_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"195\" /></a> \n\
</p>\n\
\n\
<p>\n\
These are much harder to breadboard. If you want some help in wiring these up, <a href=\"http://www.ladyada.net/learn/lcd/lcdshield.html\" class=\"urlextern\" title=\"http://www.ladyada.net/learn/lcd/lcdshield.html\"  rel=\"nofollow\">check out this page</a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT5 SECTION \"All kinds!\" [3265-4602] -->\n\
<h3 class=\"sectionedit6\"><a name=\"get_ready\" id=\"get_ready\">Get ready!</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/parts.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/parts.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=6faeea&amp;w=500&amp;h=309&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fparts_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"309\" /></a> \n\
</p>\n\
\n\
<p>\n\
OK now you&#039;ve got your LCD, you&#039;ll also need a couple other things. First is a 10K potentiometer. This will let you adjust the contrast. Each LCD will have slightly different contrast settings so you should try to get some sort of trimmer. You&#039;ll also need some 0.1&quot; header - 16 pins long\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/headersize.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/headersize.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=c06d71&amp;w=500&amp;h=303&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fheadersize_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"303\" /></a> \n\
</p>\n\
\n\
<p>\n\
If the header is too long, just cut/snap it short!\n\
</p>\n\
\n\
<p>\n\
Next you&#039;ll need to solder the header to the LCD.<strong>You must do this, it is not OK to just try to &#039;press fit&#039; the LCD!</strong>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/lcdbb.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/lcdbb.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=3973e1&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flcdbb_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
The easiest way we know of doing this is sticking the header into a breadboard and then sitting the LCD on top while soldering. this keeps it steady.\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT6 SECTION \"Get ready!\" [4603-5674] -->\n\
<h3 class=\"sectionedit7\"><a name=\"power_and_backlight\" id=\"power_and_backlight\">Power and backlight</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
OK now we&#039;re onto the interesting stuff! Get your LCD plugged into the breadboard\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/lcdbb2.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/lcdbb2.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=723b3c&amp;w=500&amp;h=448&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flcdbb2_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"448\" /></a> \n\
</p>\n\
\n\
<p>\n\
Now we&#039;ll provide power to the breadboard. Connect +5V to the red rail, and Ground to the blue rail.\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/bbpower.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/bbpower.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=7867f5&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fbbpower_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Next we&#039;ll connect up the backlight for the LCD. Connect pin 16 to ground and pin 15 to +5V through a series resistor. To calculate the value of the series resistor, look up the maximum backlight current and the typical backlight voltage drop from the data sheet. Subtract the voltage drop from 5 volts, then divide by the maximum current, then round up to the next standard resistor value. For example, if the backlight voltage drop is 3.5v typical and the rated current is 16mA, then the resistor should be (5 - 3.5)/0.016 = 93.75 ohms, or 100 ohms when rounded up to a standard value. If you can&#039;t find the data sheet, then it should be safe to use a 220 ohm resistor, although a value this high may make the backlight rather dim.\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/backlitepower.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/backlitepower.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=7fb7b2&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fbacklitepower_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Connect the Arduino up to power, you&#039;ll notice the backlight lights up\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/backlitetest.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/backlitetest.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=88c452&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fbacklitetest_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Note that some low-cost LCDs dont come with a backlight. Obviously in this case you should just keep going.\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT7 SECTION \"Power and backlight\" [5675-7409] -->\n\
<h3 class=\"sectionedit8\"><a name=\"contrast_circuit\" id=\"contrast_circuit\">Contrast circuit</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Next, lets place the contrast pot, it goes on the side near pin 1\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/potplace.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/potplace.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=529647&amp;w=500&amp;h=382&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fpotplace_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"382\" /></a> \n\
</p>\n\
\n\
<p>\n\
Connect one side of the pot to +5V and the other to Ground (it doesn&#039;t matter which goes on what side). The middle of the pot (wiper) connects to pin 3\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/potwire.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/potwire.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=b2c521&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fpotwire_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Now we&#039;ll wire up the logic of the LCD - this is seperate from the backlight! Pin 1 is ground and pin 2 is +5V\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/lcdpower.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/lcdpower.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=f7fe64&amp;w=500&amp;h=363&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flcdpower_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"363\" /></a> \n\
</p>\n\
\n\
<p>\n\
Now turn on the Arduino, you&#039;ll see the backlight light up (if there is one), and you can also twist the pot to see the first line of rectangles appear.\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/contrasttest1.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/contrasttest1.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=0f3f16&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fcontrasttest1_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/contrasttest.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/contrasttest.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=4c9fcf&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fcontrasttest_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
This means you&#039;ve got the logic, backlight and contrast all worked out. Don&#039;t keep going unless you&#039;ve got this figured out!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT8 SECTION \"Contrast circuit\" [7410-8809] -->\n\
<h3 class=\"sectionedit9\"><a name=\"bus_wiring\" id=\"bus_wiring\">Bus wiring</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Now we&#039;ll finish up the wiring by connecting the data lines. There are 11 bus lines: <strong>D0</strong> through <strong>D7</strong> (8 data lines) and <strong>RS</strong>, <strong>EN</strong>, and <strong>RW</strong>. D0-D7 are the pins that have the raw data we send to the display. The<strong> RS</strong> pin lets the microcontroller tell the LCD whether it wants to display that data (as in, an <acronym title=\"American Standard Code for Information Interchange\">ASCII</acronym> character) or whether it is a command byte (like, change posistion of the cursor). The <strong>EN</strong> pin is the &#039;enable&#039; line we use this to tell the LCD when data is ready for reading. The <strong>RW</strong> pin is used to set the direction - whether we want to write to the display (common) or read from it (less common)\n\
</p>\n\
\n\
<p>\n\
The good news is that not all these pins are necessary for us to connect to the microcontroller (Arduino). <strong>RW</strong> for example, is not needed if we&#039;re only writing to the display (which is the most common thing to do anyways) so we can &#039;tie&#039; it to ground. There is also a way to talk to the LCD using only 4 data pins instead of 8. This saves us 4 pins! Why would you ever want to use 8 when you could use 4? We&#039;re not 100% sure but we think that in some cases its faster to use 8 - it takes twice as long to use 4 - and that speed is important. For us, the speed isn&#039;t so important so we&#039;ll save some pins!\n\
</p>\n\
\n\
<p>\n\
So to recap, we need 6 pins: <strong>RS, EN, D7, D6, D5, </strong>and <strong>D4</strong> to talk to the LCD. \n\
</p>\n\
\n\
<p>\n\
We&#039;ll be using the <strong>LiquidCrystal</strong> library to talk to the LCD so a lot of the annoying work of setting pins and such is taken care of. Another nice thing about this library is that you can use <strong>any</strong> Arduino pin to connect to the LCD pins. So after you go through this guide, you&#039;ll find it easy to swap around the pins if necessary\n\
</p>\n\
\n\
<p>\n\
As mentioned, we&#039;ll not be using the <strong>RW</strong> pin, so we can tie it go ground. That&#039;s pin 5 as shown bere:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/rwpin.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/rwpin.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e72318&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Frwpin_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Next is the <strong>RS</strong> pin #4. We&#039;ll use a brown wire to connect it to Arduino&#039;s digital pin #<strong>7</strong>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/rspin.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/rspin.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=7b25f0&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Frspin_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Next is the <strong>EN</strong> pin #6, we&#039;ll use a white wire to connect it to Arduino digital #<strong>8</strong>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/enpin.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/enpin.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=3f930f&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fenpin_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Now we will wire up the data pins. <strong>DB7</strong> is pin #14 on the LCD, and it connects with an orange wire to Arduino #<strong>12</strong>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/db7pin.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/db7pin.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=2295fc&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fdb7pin_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Next are the remaining 3 data lines, <strong>DB6</strong> (yellow) <strong>DB5</strong> (green) and <strong>DB4</strong> (blue) which we connect to Arduino #<strong>11, 10</strong> and <strong>9</strong>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/datapins.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/datapins.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=53b89f&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fdatapins_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
This is what you&#039;ll have on your desk:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/bigpicture.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/bigpicture.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=bdc5df&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fbigpicture_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT9 SECTION \"Bus wiring\" [8810-11974] -->\n\
<h3 class=\"sectionedit10\"><a name=\"sketch_time\" id=\"sketch_time\">Sketch time</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Now we must upload some sketch to the Arduino to talk to the LCD. Luckily the <strong>LiquidCrystal</strong> library is already built in. So we just need to load one of the examples and modify it for the pins we used\n\
</p>\n\
\n\
<p>\n\
If you&#039;ve changed the pins, you&#039;ll want to make a handy table so you can update the sketch properly\n\
</p>\n\
<div class=\"table sectionedit11\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<td class=\"col0\"><strong>LCD pin name</strong></td><td class=\"col1\">RS</td><td class=\"col2\">EN</td><td class=\"col3\">DB4</td><td class=\"col4\">DB5</td><td class=\"col5\">DB6</td><td class=\"col6\">DB7</td>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<td class=\"col0\"><strong>Arduino pin #</strong></td><td class=\"col1\">7</td><td class=\"col2\">8</td><td class=\"col3\">9</td><td class=\"col4\">10</td><td class=\"col5\">11</td><td class=\"col6\">12</td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT11 TABLE [12309-12384] -->\n\
<p>\n\
Open up the<strong> File→Examples→LiquidCrystal→HelloWorld </strong>example sketch\n\
</p>\n\
\n\
<p>\n\
Now we&#039;ll need to update the pins. Look for this line:\n\
</p>\n\
<pre class=\"code C\">LiquidCrystal lcd<span class=\"br0\">&#40;</span><span class=\"nu0\">12</span><span class=\"sy0\">,</span> <span class=\"nu0\">11</span><span class=\"sy0\">,</span> <span class=\"nu0\">5</span><span class=\"sy0\">,</span> <span class=\"nu0\">4</span><span class=\"sy0\">,</span> <span class=\"nu0\">3</span><span class=\"sy0\">,</span> <span class=\"nu0\">2</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span></pre>\n\
\n\
<p>\n\
And change it to:   \n\
</p>\n\
<pre class=\"code C\">LiquidCrystal lcd<span class=\"br0\">&#40;</span><span class=\"nu0\">7</span><span class=\"sy0\">,</span> <span class=\"nu0\">8</span><span class=\"sy0\">,</span> <span class=\"nu0\">9</span><span class=\"sy0\">,</span> <span class=\"nu0\">10</span><span class=\"sy0\">,</span> <span class=\"nu0\">11</span><span class=\"sy0\">,</span> <span class=\"nu0\">12</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span></pre>\n\
\n\
<p>\n\
To match the pin table we just made.\n\
</p>\n\
\n\
<p>\n\
Now you can compile and upload the sketch\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/test.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/test.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=38c9c4&amp;w=500&amp;h=481&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Ftest_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"481\" /></a> \n\
</p>\n\
\n\
<p>\n\
Adjust the contrast if necessary\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/test2.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/test2.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=bb3da1&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Ftest2_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
You can of course use any size or color LCD, such as a 20x4 LCD:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/204test.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/204test.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=92f8dd&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2F204test_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
Or a black on green:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/greentest.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/greentest.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=17e43b&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fgreentest_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
The nice thing about the black on green ones is you can remove the backlight. Sometimes they dont come with one!\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/greentest2.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/greentest2.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=b3e223&amp;w=500&amp;h=479&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Fgreentest2_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"479\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT10 SECTION \"Sketch time\" [11975-13707] -->\n\
<h3 class=\"sectionedit12\"><a name=\"multiple_lines\" id=\"multiple_lines\">Multiple lines</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
One thing you&#039;ll want to watch for is how the LCD handles large messages and multiple lines. For example if you changed this line\n\
</p>\n\
<pre class=\"code C\">  lcd.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;hello, world!&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span></pre>\n\
\n\
<p>\n\
To this:\n\
</p>\n\
<pre class=\"code C\">  lcd.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;hello, world! this is a long long message&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span></pre>\n\
\n\
<p>\n\
The 16x2 LCD will cut off anything past the 16th character:\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/longmessage.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/longmessage.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=23b206&amp;w=500&amp;h=490&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flongmessage_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"490\" /></a> \n\
</p>\n\
\n\
<p>\n\
But the 20x4 LCD will &#039;wrap&#039; the first line to the <strong>third</strong> line! (Likewise the 2nd line runs into the 4th) This seems really bizarre but its how the LCD memory configured on the inside. This probably should have been done differently but hey that&#039;s what we have to live with. Hopefully we&#039;ll have a future LCD library that is very smart and wraps lines but for now we are stuck. So when writing long lines to the LCD count your characters and make sure that you dont accidentally overrun the lines!\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/arduino/lcdtut/longmessage2.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/arduino/lcdtut/longmessage2.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=7928c9&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Farduino%2Flcdtut%2Flongmessage2_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT12 SECTION \"Multiple lines\" [13708-14870] -->\n\
<h3 class=\"sectionedit13\"><a name=\"rgb_backlight_lcds\" id=\"rgb_backlight_lcds\">RGB backlight LCDs</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"http://www.adafruit.com/category/63\" class=\"urlextern\" title=\"http://www.adafruit.com/category/63\"  rel=\"nofollow\">We now stock a few different RGB backlight LCDs</a> . These LCDs work just like the normal character type, but the backlight has three LEDS (red/green/blue) so you can generate any color you&#039;d like. Very handy when you want to have some ambient information conveyed.\n\
</p>\n\
\n\
<p>\n\
After you&#039;ve wired up the LCD and tested it as above, you can connect the LEDs to the PWM analog out pins of the Arduino to precisely set the color. The PWM pins are fixed in hardware and there&#039;s 6 of them but three are already used so we&#039;ll use the remaining three PWM pins. Connect the red LED pin to Digital 3, the green LED pin (pin 17 of the LCD) to digital 5 and the blue LED pin (pin 18 of the LCD) to digital 6. You do not need any resistors between the LED pins and the arduino pins because resistors are already soldered onto the character LCD for you!\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=add30a&amp;w=500&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Flcd%2Frgblcdtest_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" />\n\
</p>\n\
\n\
<p>\n\
Now upload this code to your Arduino to see the LCD background light swirl! (<a href=\"http://www.flickr.com/photos/adafruit/6002862732/\" class=\"urlextern\" title=\"http://www.flickr.com/photos/adafruit/6002862732/\"  rel=\"nofollow\">Click here to see what it looks like in action</a> )\n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.flickr.com/apps/video/stewart.swf?photo_id=6002862732\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.flickr.com/apps/video/stewart.swf?photo_id=6002862732\" />\n\
<!--><!-- -->\n\
  <param name=\"photo_id\" value=\"6002862732\" />\n\
  <param name=\"FlashVars\" value=\"photo_id=6002862732\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
</p>\n\
<pre class=\"code C\"><span class=\"co1\">// include the library code:</span>\n\
<span class=\"co2\">#include &lt;LiquidCrystal.h&gt;</span>\n\
<span class=\"co2\">#include &lt;Wire.h&gt; </span>\n\
&nbsp;\n\
<span class=\"co2\">#define REDLITE 3</span>\n\
<span class=\"co2\">#define GREENLITE 5</span>\n\
<span class=\"co2\">#define BLUELITE 6</span>\n\
&nbsp;\n\
<span class=\"co1\">// initialize the library with the numbers of the interface pins</span>\n\
LiquidCrystal lcd<span class=\"br0\">&#40;</span><span class=\"nu0\">7</span><span class=\"sy0\">,</span> <span class=\"nu0\">8</span><span class=\"sy0\">,</span> <span class=\"nu0\">9</span><span class=\"sy0\">,</span> <span class=\"nu0\">10</span><span class=\"sy0\">,</span> <span class=\"nu0\">11</span><span class=\"sy0\">,</span> <span class=\"nu0\">12</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
<span class=\"co1\">// you can change the overall brightness by range 0 -&gt; 255</span>\n\
<span class=\"kw4\">int</span> brightness <span class=\"sy0\">=</span> <span class=\"nu0\">255</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> setup<span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"co1\">// set up the LCD\'s number of rows and columns: </span>\n\
  lcd.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"nu0\">16</span><span class=\"sy0\">,</span> <span class=\"nu0\">2</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"co1\">// Print a message to the LCD.</span>\n\
  lcd.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;RGB 16x2 Display  &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  lcd.<span class=\"me1\">setCursor</span><span class=\"br0\">&#40;</span><span class=\"nu0\">0</span><span class=\"sy0\">,</span><span class=\"nu0\">1</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  lcd.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; Multicolor LCD &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  brightness <span class=\"sy0\">=</span> <span class=\"nu0\">100</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
&nbsp;\n\
<span class=\"kw4\">void</span> loop<span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"kw1\">for</span> <span class=\"br0\">&#40;</span><span class=\"kw4\">int</span> i <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span> i <span class=\"sy0\">&lt;</span> <span class=\"nu0\">255</span><span class=\"sy0\">;</span> i<span class=\"sy0\">++</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    setBacklight<span class=\"br0\">&#40;</span>i<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">-</span>i<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    delay<span class=\"br0\">&#40;</span><span class=\"nu0\">5</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
  <span class=\"kw1\">for</span> <span class=\"br0\">&#40;</span><span class=\"kw4\">int</span> i <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span> i <span class=\"sy0\">&lt;</span> <span class=\"nu0\">255</span><span class=\"sy0\">;</span> i<span class=\"sy0\">++</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    setBacklight<span class=\"br0\">&#40;</span><span class=\"nu0\">255</span><span class=\"sy0\">-</span>i<span class=\"sy0\">,</span> i<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    delay<span class=\"br0\">&#40;</span><span class=\"nu0\">5</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
  <span class=\"kw1\">for</span> <span class=\"br0\">&#40;</span><span class=\"kw4\">int</span> i <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span> i <span class=\"sy0\">&lt;</span> <span class=\"nu0\">255</span><span class=\"sy0\">;</span> i<span class=\"sy0\">++</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    setBacklight<span class=\"br0\">&#40;</span><span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">-</span>i<span class=\"sy0\">,</span> i<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    delay<span class=\"br0\">&#40;</span><span class=\"nu0\">5</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
&nbsp;\n\
&nbsp;\n\
<span class=\"kw4\">void</span> setBacklight<span class=\"br0\">&#40;</span><span class=\"kw4\">uint8_t</span> r<span class=\"sy0\">,</span> <span class=\"kw4\">uint8_t</span> g<span class=\"sy0\">,</span> <span class=\"kw4\">uint8_t</span> b<span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"co1\">// normalize the red LED - its brighter than the rest!</span>\n\
  r <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>r<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">100</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  g <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>g<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">150</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  r <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>r<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> brightness<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  g <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>g<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> brightness<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  b <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>b<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> brightness<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  <span class=\"co1\">// common anode so invert!</span>\n\
  r <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>r<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  g <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>g<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  b <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>b<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;R = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span> Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>r<span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; G = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span> Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>g<span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; B = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span> Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span>b<span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  analogWrite<span class=\"br0\">&#40;</span>REDLITE<span class=\"sy0\">,</span> r<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  analogWrite<span class=\"br0\">&#40;</span>GREENLITE<span class=\"sy0\">,</span> g<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  analogWrite<span class=\"br0\">&#40;</span>BLUELITE<span class=\"sy0\">,</span> b<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span></pre>\n\
\n\
</div>\n\
<!-- EDIT13 SECTION \"RGB backlight LCDs\" [14871-17520] -->\n\
<h3 class=\"sectionedit14\"><a name=\"bonus_making_your_own_character\" id=\"bonus_making_your_own_character\">BONUS! making your OWN character</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
You may want to have special characters, for example in this temperature sensor, we created a &#039;degree&#039; symbol (°) \n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=918c21&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fthermocouple%2Fthermolcd_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" />\n\
</p>\n\
\n\
<p>\n\
You can do that with the <strong>createChar</strong> command, and to help you out <a href=\"http://www.quinapalus.com/hd44780udg.html\" class=\"urlextern\" title=\"http://www.quinapalus.com/hd44780udg.html\"  rel=\"nofollow\">we&#039;re going to point you to this really great website that does the hard work for you!</a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT14 SECTION \"BONUS! making your OWN character\" [17521-] -->";document.write(zoomy);document.write("<hr /><br /><em>This page was autogenerated from <a href=\"http://www.ladyada.net/wiki//tutorials/learn/lcd/charlcd.html\" target=\"_blank\">http://www.ladyada.net/wiki//tutorials/learn/lcd/charlcd.html</a> <br />Please edit the wiki to contribute any updates or corrections.</em>")