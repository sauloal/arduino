var zoomy = "\n\
<h3 class=\"sectionedit1\"><a name=\"what_is_an_rtc\" id=\"what_is_an_rtc\">What is an RTC?</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
A real time clock is basically just like a watch - it runs on a battery and keeps time for you even when there is a power outage! Using an RTC, you can keep track of long timelines, even if you reprogram your microcontroller or disconnect it from USB or a power plug.\n\
</p>\n\
\n\
<p>\n\
Most microcontrollers, including the Arduino,  have a built-in timekeeper called<strong> millis()</strong> and there are also timers built into the chip that can keep track of longer time periods like minutes or days. So why would you want to have a seperate RTC chip? Well, the biggest reason is that <strong>millis()</strong> only keeps track of time <em>since the Arduino was last powered<strong> - </strong></em>. That means that when the power is turned on, the millisecond timer is set back to 0. The Arduino doesn&#039;t know that it&#039;s &#039;Tuesday&#039; or &#039;March 8th&#039;, all it can tell is &#039;It&#039;s been 14,000 milliseconds since I was last turned on&#039;. \n\
</p>\n\
\n\
<p>\n\
OK so what if you wanted to set the time on the Arduino? You&#039;d have to program in the date and time and you could have it count from that point on. But if it lost power, you&#039;d have to reset the time. Much like very cheap alarm clocks: every time they lose power they blink <strong>12:00</strong>\n\
</p>\n\
\n\
<p>\n\
While this sort of basic timekeeping is OK for some projects, some projects such as data-loggers, clocks, etc will need to have <strong>consistent timekeeping that doesn&#039;t reset when the Arduino battery dies or is reprogrammed</strong>. Thus, we include a seperate RTC! The RTC chip is a specialized chip that just keeps track of time. It can count leap-years and knows how many days are in a month, but it doesn&#039;t take care of Daylight Savings Time (because it changes from place to place)\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://en.wikipedia.org/wiki/File:Realtimeclock_Motherboard_Baby_AT_crop.jpg\" class=\"media\" title=\"http://en.wikipedia.org/wiki/File:Realtimeclock_Motherboard_Baby_AT_crop.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=c7e332&amp;w=314&amp;h=241&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Flogshield%2FRealtimeclock_Motherboard_Baby_AT_crop.jpg\" class=\"mediacenter\" alt=\"\" width=\"314\" height=\"241\" /></a> \n\
</p><div class=\"center\"><p> <em>This image shows a computer motherboard with a Real Time Clock called the <a href=\"http://www.maxim-ic.com/app-notes/index.mvp/id/503\" class=\"urlextern\" title=\"http://www.maxim-ic.com/app-notes/index.mvp/id/503\"  rel=\"nofollow\">DS1387</a> . There&#039;s a lithium battery in there which is why it&#039;s so big.</em></p></div>\n\
\n\
<p>\n\
The RTC we&#039;ll be using is the<a href=\"http://www.ladyada.net/wiki/partselector/ic#rtc\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/ic#rtc\"  rel=\"nofollow\"> DS1307</a> . It&#039;s low cost, easy to solder, and can run for years on a very small coin cell.\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/parts/ds1307.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/ds1307.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e84584&amp;w=150&amp;h=120&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fds1307_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"150\" height=\"120\" /></a> \n\
</p>\n\
\n\
<p>\n\
As long as it has a coin cell to run it, the DS1307 will merrily tick along for a long time, even when the Arduino loses power, or is reprogrammed. \n\
</p>\n\
\n\
<div class=\"warning\"><p>\n\
<strong>You MUST have a coin cell installed for the RTC to work, if there is no coin cell, you should pull the battery pin low.</strong>\n\
</p></div>\n\
\n\
</div>\n\
<!-- EDIT1 SECTION \"What is an RTC?\" [1-2681] -->\n\
<h3 class=\"sectionedit2\"><a name=\"files\" id=\"files\">Files</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"http://github.com/adafruit/DS1307-breakout-board\" class=\"urlextern\" title=\"http://github.com/adafruit/DS1307-breakout-board\"  rel=\"nofollow\">Schematic and layout files can be found at GitHub - click Download Source to get the zip!</a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT2 SECTION \"Files\" [2682-2845] -->\n\
<h3 class=\"sectionedit3\"><a name=\"parts\" id=\"parts\">Parts</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<div class=\"table\">\n\
<div class=\"table sectionedit4\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<th class=\"col0\">Image</th><th class=\"col1\">Name</th><th class=\"col2\">Description</th><th class=\"col3\">Part information</th><th class=\"col4\">Qty</th>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/ds1307.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/ds1307.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e84584&amp;w=150&amp;h=120&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fds1307_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"150\" height=\"120\" /></a> </td><td class=\"col1\"><strong>IC2</strong></td><td class=\"col2\"> Real time clock</td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/ic?s[]=ds1307#rtc\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/ic?s[]=ds1307#rtc\"  rel=\"nofollow\">DS1307</a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
	<tr class=\"row2\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/crystalcyl.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/crystalcyl.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=b29998&amp;w=199&amp;h=130&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fcrystalcyl_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"199\" height=\"130\" /></a> </td><td class=\"col1\"><strong>Q1</strong></td><td class=\"col2\">32.768 KHz, 12.5 pF watch crystal</td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/crystals?s[]=32.768 khz#crystals\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/crystals?s[]=32.768 khz#crystals\"  rel=\"nofollow\">Generic 32.768KHz crystal</a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
	<tr class=\"row3\">\n\
		<td class=\"col0\"><img src=\"/wiki/lib/exe/fetch.php?hash=05c151&amp;w=61&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fresleft_t.gif\" class=\"mediacenter\" alt=\"\" width=\"61\" height=\"87\" /><img src=\"/wiki/lib/exe/fetch.php?hash=47f642&amp;w=10&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2FrRed_t.gif\" class=\"mediacenter\" alt=\"\" width=\"10\" height=\"87\" /><img src=\"/wiki/lib/exe/fetch.php?hash=47f642&amp;w=10&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2FrRed_t.gif\" class=\"mediacenter\" alt=\"\" width=\"10\" height=\"87\" /><img src=\"/wiki/lib/exe/fetch.php?hash=47f642&amp;w=10&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2FrRed_t.gif\" class=\"mediacenter\" alt=\"\" width=\"10\" height=\"87\" /><img src=\"/wiki/lib/exe/fetch.php?hash=6adc53&amp;w=8&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fspacer_t.gif\" class=\"mediacenter\" alt=\"\" width=\"8\" height=\"87\" /><img src=\"/wiki/lib/exe/fetch.php?hash=2c4202&amp;w=10&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2FrGold_t.gif\" class=\"mediacenter\" alt=\"\" width=\"10\" height=\"87\" /><img src=\"/wiki/lib/exe/fetch.php?hash=620bcf&amp;w=66&amp;h=87&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fresright_t.gif\" class=\"mediacenter\" alt=\"\" width=\"66\" height=\"87\" /></td><td class=\"col1\"><strong>R1, R2</strong></td><td class=\"col2\">1/4W 5% 2.2K resistor <br/>\n\
Red, Red, Red, Gold </td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/resistors#w_5_carbon\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/resistors#w_5_carbon\"  rel=\"nofollow\">Generic</a> </td><td class=\"col4\">2</td>\n\
	</tr>\n\
	<tr class=\"row4\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/104cerm.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/104cerm.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=739ce2&amp;w=154&amp;h=200&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2F104cerm_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"154\" height=\"200\" /></a> </td><td class=\"col1\"><strong>C1</strong></td><td class=\"col2\">0.1uF ceramic capacitor (104) </td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/caps?s[]=0.1uf%20%2F%2050v#ceramic_capacitors\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/caps?s[]=0.1uf%20%2F%2050v#ceramic_capacitors\"  rel=\"nofollow\">Generic</a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
	<tr class=\"row5\">\n\
		<td class=\"col0\" colspan=\"2\"><a href=\"http://www.ladyada.net/images/parts/headerm36.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/headerm36.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=9ed35b&amp;w=200&amp;h=84&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fheaderm36_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"200\" height=\"84\" /></a> </td><td class=\"col2\">5 pin male header (1x5) </td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/header#male_header\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/header#male_header\"  rel=\"nofollow\">Generic</a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
	<tr class=\"row6\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/CR2032.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/CR2032.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=60188f&amp;w=150&amp;h=79&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2FCR2032_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"150\" height=\"79\" /></a> </td><td class=\"col1\"><strong>BATT</strong></td><td class=\"col2\">12mm 3V lithium coin cell</td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/batteries#coin\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/batteries#coin\"  rel=\"nofollow\"> CR1220</a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
	<tr class=\"row7\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/parts/cr1220thm.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/parts/cr1220thm.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=94d4fd&amp;w=130&amp;h=105&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fparts%2Fcr1220thm_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"130\" height=\"105\" /></a> </td><td class=\"col1\"><strong>BATT&#039;</strong></td><td class=\"col2\">12mm coin cell holder</td><td class=\"col3\"><a href=\"http://www.ladyada.net/wiki/partselector/powerconn#battery_holders\" class=\"urlextern\" title=\"http://www.ladyada.net/wiki/partselector/powerconn#battery_holders\"  rel=\"nofollow\">Keystone 3001</a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
	<tr class=\"row8\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/ds1307bb.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/ds1307bb.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=f303dc&amp;w=169&amp;h=130&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fds1307bb_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"169\" height=\"130\" /></a> </td><td class=\"col1\"><strong>PCB</strong></td><td class=\"col2\">Circuit board</td><td class=\"col3\"><a href=\"http://www.adafruit.com\" class=\"urlextern\" title=\"http://www.adafruit.com\"  rel=\"nofollow\">Adafruit Industries </a> </td><td class=\"col4\">1</td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT4 TABLE [2877-5217] -->\n\
</div>\n\
\n\
</div>\n\
<!-- EDIT3 SECTION \"Parts\" [2846-5229] -->\n\
<h3 class=\"sectionedit5\"><a name=\"assemble\" id=\"assemble\">Assemble!</a> </h3>\n\
<div class=\"level3\">\n\
<div class=\"table sectionedit6\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/ready.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/ready.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=b1212c&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fready_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> </td><td class=\"col1\">Prepare to assemble the kit by checking the parts list and verifying you have everything! <br/>\n\
Next, heat up your soldering iron and clear off your desk. <br/>\n\
Place the circuit board in a vise so that you can easily work on it</td>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/bumpsolder.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/bumpsolder.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=95a9c6&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fbumpsolder_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/bumped.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/bumped.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=621a8f&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fbumped_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> </td><td class=\"col1\">Begin by soldering a small bump onto the negative pad of the battery: this will make better contact!</td>\n\
	</tr>\n\
	<tr class=\"row2\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/resplace.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/resplace.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=4717f3&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fresplace_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/allpalce.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/allpalce.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=3bd0a1&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fallpalce_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> </td><td class=\"col1\">place the two 2.2K resistors, and the ceramic capacitor. They are symmetric so no need to worry about direction. <br/>\n\
Then place the crystal (also symmetric), the battery holder (goes on so that the battery can slip in the side) and the RTC chip.  <br/>\n\
The RTC chip must be placed so that the notch/dot on the end match the silkscreen. Look at the photo on the left, the notch is pointing down. Double check this before soldering in the chip because its quite hard to undo!</td>\n\
	</tr>\n\
	<tr class=\"row3\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/tack.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/tack.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=2af602&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Ftack_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/flip.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/flip.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=56e0df&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fflip_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/solder.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/solder.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=fc8fcd&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fsolder_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/soldered.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/soldered.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=53b549&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fsoldered_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> </td><td class=\"col1\">To keep the battery holder from falling out, you may want to &#039;tack&#039; solder it from the top <br/>\n\
Then flip over the board and solder all the pins.</td>\n\
	</tr>\n\
	<tr class=\"row4\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/clip.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/clip.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=5fe6b4&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fclip_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/clipped.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/clipped.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e7a66a&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fclipped_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> </td><td class=\"col1\">Clip the leads of the resistors, crystal and capacitor short.</td>\n\
	</tr>\n\
	<tr class=\"row5\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/header.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/header.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=959f6b&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fheader_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  <br/>\n\
<a href=\"http://www.ladyada.net/images/ds1307/headered.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/headered.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e6f5a5&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fheadered_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a>  </td><td class=\"col1\">If you&#039;d like to use the header to plug the breakout board into something, place the header in a breadboard, long side down and place the board so that the short pins stick thru the pads. <br/>\n\
Solder them in place.</td>\n\
	</tr>\n\
	<tr class=\"row6\">\n\
		<td class=\"col0\"><a href=\"http://www.ladyada.net/images/ds1307/batt.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/batt.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=4d1ec3&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fbatt_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> </td><td class=\"col1\">Insert the battery so that the flat + side is UP. <em> The battery will last for many years, 5 or more, so no need to ever remove or replace it. </em> <strong>You MUST have a coin cell installed for the RTC to work, if there is no coin cell, it will act strangly and possibly hang the Arduino so ALWAYS make SURE there&#039;s a battery installed, even if its a dead battery.</strong></td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT6 TABLE [5252-8617] -->\n\
</div>\n\
<!-- EDIT5 SECTION \"Assemble!\" [5230-8618] -->\n\
<h3 class=\"sectionedit7\"><a name=\"arduino_library\" id=\"arduino_library\">Arduino library</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Any 5V microcontroller with I2C built-in can easily use the DS1307. We will demonstrate how to use it with an Arduino since it is a popular microcontroller platform. \n\
</p>\n\
\n\
<p>\n\
For the RTC library, we&#039;ll be using a fork of JeeLab&#039;s excellent RTC library <a href=\"http://github.com/adafruit/RTClib\" class=\"urlextern\" title=\"http://github.com/adafruit/RTClib\"  rel=\"nofollow\">RTClib </a> - a library for getting and setting time from a DS1307 (originally written by JeeLab, our version is slightly different so please <strong>only use ours </strong>to make sure its compatible!) - download the .zip by clicking on <strong>Download Source</strong> (top right) and rename the uncompressed folder RTClib <a href=\"http://www.ladyada.net/library/arduino/libraries.html\" class=\"urlextern\" title=\"http://www.ladyada.net/library/arduino/libraries.html\"  rel=\"nofollow\">Then install it in your Arduino directory</a>  in a folder called <strong>RTClib</strong>\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT7 SECTION \"Arduino library\" [8619-9354] -->\n\
<h3 class=\"sectionedit8\"><a name=\"wiring_it_up\" id=\"wiring_it_up\">Wiring it up!</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
There are only 5 pins: <strong>5V GND SCL SDA SQW</strong>. \n\
</p>\n\
<ul>\n\
<li class=\"level1\"><div class=\"li\"><strong>5V </strong>is used to power to the RTC chip when you want to query it for the time. If there is no 5V signal, the chip goes to sleep using the coin cell for backup. </div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>GND</strong> is common ground and is required</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>SCL </strong>is the i2c clock pin - its required to talk to the RTC</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>SDA</strong> is the i2c data pin - its required to talk to the RTC</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>SQW</strong> is the optional square-wave output you can get from the RTC if you have configured it to do so. Most people don&#039;t need or use this pin<a href=\"http://www.ladyada.net/images/ds1307/breadboard.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/breadboard.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=20f334&amp;w=500&amp;h=389&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fbreadboard_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"389\" /></a> </div>\n\
</li>\n\
</ul>\n\
\n\
<p>\n\
If you set analog pin 3 (digital 17) to an OUTPUT and HIGH and analog pin 2 (digital 16) to an OUTPUT and LOW you can power the RTC directly from the pins!\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/ds1307/quickplug.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/ds1307/quickplug.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=15f8a0&amp;w=500&amp;h=385&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fds1307%2Fquickplug_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"385\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT8 SECTION \"Wiring it up!\" [9355-10340] -->\n\
<h3 class=\"sectionedit9\"><a name=\"first_rtc_test\" id=\"first_rtc_test\">First RTC test</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
The first thing we&#039;ll demonstrate is a test sketch that will read the time from the RTC once a second. We&#039;ll also show what happens if you remove the battery and replace it since that causes the RTC to halt. So to start, remove the battery from the holder while the Arduino is not powered or plugged into USB. Wait 3 seconds and then replace the battery. This resets the RTC chip. Now load up the following sketch (which is also found in<strong> Examples→RTClib→ds1307</strong>) and upload it to your Arduino with the datalogger shield on!\n\
</p>\n\
<pre class=\"code C\"><span class=\"co1\">// Date and time functions using a DS1307 RTC connected via I2C and Wire lib</span>\n\
&nbsp;\n\
<span class=\"co2\">#include &lt;Wire.h&gt;</span>\n\
<span class=\"co2\">#include &quot;RTClib.h&quot;</span>\n\
&nbsp;\n\
RTC_DS1307 RTC<span class=\"sy0\">;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> setup <span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"nu0\">57600</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Wire.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    RTC.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span><span class=\"sy0\">!</span> RTC.<span class=\"me1\">isrunning</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;RTC is NOT running!&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    <span class=\"co1\">// following line sets the RTC to the date &amp; time this sketch was compiled</span>\n\
    <span class=\"co1\">//RTC.adjust(DateTime(__DATE__, __TIME__));</span>\n\
  <span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> loop <span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    DateTime now <span class=\"sy0\">=</span> RTC.<span class=\"me1\">now</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">year</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\'/\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">month</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\'/\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">day</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\' \'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">hour</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\':\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">minute</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\':\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">second</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; since 1970 = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">unixtime</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;s = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">unixtime</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"sy0\">/</span> <span class=\"nu0\">86400L</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;d&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
    <span class=\"co1\">// calculate a date which is 7 days and 30 seconds into the future</span>\n\
    DateTime future <span class=\"br0\">&#40;</span>now.<span class=\"me1\">unixtime</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"sy0\">+</span> <span class=\"nu0\">7</span> <span class=\"sy0\">*</span> <span class=\"nu0\">86400L</span> <span class=\"sy0\">+</span> <span class=\"nu0\">30</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; now + 7d + 30s: &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>future.<span class=\"me1\">year</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\'/\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>future.<span class=\"me1\">month</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\'/\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>future.<span class=\"me1\">day</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\' \'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>future.<span class=\"me1\">hour</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\':\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>future.<span class=\"me1\">minute</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\':\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>future.<span class=\"me1\">second</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    delay<span class=\"br0\">&#40;</span><span class=\"nu0\">3000</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span></pre>\n\
\n\
<p>\n\
Now run the Serial terminal and make sure the baud rate is set correctly at 57600 bps\n\
</p>\n\
\n\
<p>\n\
you should see the following:<img src=\"/wiki/lib/exe/fetch.php?hash=f6a7fa&amp;w=454&amp;h=389&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Flogshield%2FRTCnotrun.gif\" class=\"mediacenter\" alt=\"\" width=\"454\" height=\"389\" />\n\
</p>\n\
\n\
<p>\n\
Whenever the RTC chip loses all power (including the backup battery) it will report the time as 0:0:0 and it won&#039;t count seconds (its stopped). Whenever you set the time, this will kick start the clock ticking. So basically the upshot here is that you should never ever remove the battery once you&#039;ve set the time. You shouldn&#039;t have to and the battery holder is very snug so unless the board is crushed, the battery wont &#039;fall out&#039;\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT9 SECTION \"First RTC test\" [10341-13123] -->\n\
<h3 class=\"sectionedit10\"><a name=\"setting_the_time\" id=\"setting_the_time\">Setting the time</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
With the same sketch loaded, uncomment the line that starts with <strong>RTC.adjust</strong> like so:\n\
</p>\n\
<pre class=\"code C\">  <span class=\"co1\">// following line sets the RTC to the date &amp; time this sketch was compiled</span>\n\
  RTC.<span class=\"me1\">adjust</span><span class=\"br0\">&#40;</span>DateTime<span class=\"br0\">&#40;</span>__DATE__<span class=\"sy0\">,</span> __TIME__<span class=\"br0\">&#41;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;</pre>\n\
\n\
<p>\n\
Thisline is very cute, what it does is take the Date and Time according the computer you&#039;re using (right when you compile the code) and uses that to program the RTC. If your computer time is not set right you should fix that first. Then you must press the <strong>Upload</strong> button to compile and then immediately upload. If you compile and then upload later, the clock will be off by that amount of time.\n\
</p>\n\
\n\
<p>\n\
Then open up the Serial monitor window to show that the time has been set    <img src=\"/wiki/lib/exe/fetch.php?hash=6b1e8c&amp;w=459&amp;h=398&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Flogshield%2FRTCsettimegif.gif\" class=\"mediacenter\" alt=\"\" width=\"459\" height=\"398\" />From now on, you wont have to ever set the time again: the battery will last 5 or more years \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT10 SECTION \"Setting the time\" [13124-14037] -->\n\
<h3 class=\"sectionedit11\"><a name=\"reading_the_time\" id=\"reading_the_time\">Reading the time</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Now that the RTC is merrily ticking away, we&#039;ll want to query it for the time. Lets look at the sketch again to see how this is done\n\
</p>\n\
<pre class=\"code C\">&nbsp;\n\
<span class=\"kw4\">void</span> loop <span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    DateTime now <span class=\"sy0\">=</span> RTC.<span class=\"me1\">now</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">year</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\'/\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">month</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\'/\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">day</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\' \'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">hour</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\':\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">minute</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">\':\'</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">second</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">,</span> DEC<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;</pre>\n\
\n\
<p>\n\
There&#039;s pretty much only one way to get the time using the RTClib, which is to call <strong>now()</strong>, a function that returns a DateTime object that describes the year, month, day, hour, minute and second when you called <strong>now()</strong>. \n\
</p>\n\
\n\
<p>\n\
There are some RTC libraries that instead have you call something like <strong>RTC.year()</strong> and <strong>RTC.hour()</strong> to get the current year and hour. However, there&#039;s one problem where if you happen to ask for the minute right at <strong>3:14:59</strong> just before the next minute rolls over, and then the second right after the minute rolls over (so at <strong>3:15:00</strong>) you&#039;ll see the time as <strong>3:14:00 </strong>which is a minute off. If you did it the other way around you could get <strong>3:15:59</strong> - so one minute off in the other direction. \n\
</p>\n\
\n\
<p>\n\
Because this is not an especially unlikely occurrence - particularly if you&#039;re querying the time pretty often - we take a &#039;snapshot&#039; of the time from the RTC all at once and then we can pull it apart into <strong>day()</strong> or <strong>second()</strong> as seen above. Its a tiny bit more effort but we think its worth it to avoid mistakes!\n\
</p>\n\
\n\
<p>\n\
We can also get a &#039;timestamp&#039; out of the DateTime object by calling <strong>unixtime</strong> which counts the number of seconds (not counting leapseconds) since midnight, January 1st 1970\n\
</p>\n\
<pre class=\"code C\">    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; since 1970 = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">unixtime</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;s = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>now.<span class=\"me1\">unixtime</span><span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"sy0\">/</span> <span class=\"nu0\">86400L</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;d&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;</pre>\n\
\n\
<p>\n\
Since there are 60*60*24 = 86400 seconds in a day, we can easily count days since then as well. This might be useful when you want to keep track of how much time has passed since the last query, making some math a lot easier (like checking if its been 5 minutes later, just see if <strong>unixtime()</strong> has increased by 300, you dont have to worry about hour changes)\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT11 SECTION \"Reading the time\" [14038-] -->";document.write(zoomy);document.write("<hr /><br /><em>This page was autogenerated from <a href=\"http://www.ladyada.net/wiki/tutorials/learn/breakoutplus/ds1307rtc.html\" target=\"_blank\">http://www.ladyada.net/wiki/tutorials/learn/breakoutplus/ds1307rtc.html</a> <br />Please edit the wiki to contribute any updates or corrections.</em>")