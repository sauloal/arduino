var zoomy = "<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/cds_LRG.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/cds_LRG.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=9f61f4&amp;w=500&amp;h=376&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcds_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"376\" /></a> \n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=01cb3f&amp;w=486&amp;h=139&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FLDR.jpg\" class=\"mediacenter\" alt=\"\" width=\"486\" height=\"139\" />\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=fcd0b2&amp;w=500&amp;h=463&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsconstruction.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"463\" />\n\
</p>\n\
\n\
</div>\n\
\n\
<h3 class=\"sectionedit1\"><a name=\"what_is_a_photocell\" id=\"what_is_a_photocell\">What is a photocell?</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Photocells are sensors that allow you to detect light. They are small, inexpensive, low-power, easy to use and don&#039;t wear out. For that reason they often appear in toys, gadgets and appliances. Theys are are often referred to as CdS cells (they are made of Cadmium-Sulfide), light-dependent resistors (LDR), and photoresistors. \n\
</p>\n\
\n\
<p>\n\
Photocells are basically a resistor that changes its resistive value (in ohms Ω) depending on how much light is shining onto the squiggly face. They are very low cost, easy to get in many sizes and specifications, but are very innacurate. Each photocell sensor will act a little differently than the other, even if they are from the same batch. The variations can be really large, 50% or higher! For this reason, they shouldn&#039;t be used to try to determine precise light levels in lux or millicandela. Instead, you can expect to only be able to determine basic light changes\n\
</p>\n\
\n\
<p>\n\
For most light-sentsitive applications like &quot;is it light or dark out&quot;, &quot;is there something in front of the sensor (that would block light)&quot;, &quot;is there something interrupting a laser beam&quot; (break-beam sensors), or &quot;which of multiple sensors has the most light hitting it&quot;, photocells can be a good choice!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT1 SECTION \"What is a photocell?\" [294-1547] -->\n\
<h3 class=\"sectionedit2\"><a name=\"some_basic_stats\" id=\"some_basic_stats\">Some basic stats</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
These stats are for the photocell in the Adafruit shop which is very much like the <a href=\"http://www.ladyada.net/media/sensors/PDV-P8001.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/PDV-P8001.pdf\"  rel=\"nofollow\">PDV-P8001</a> . Nearly all photocells will have slightly different specifications, although they all pretty much work the same. If there&#039;s a datasheet, you&#039;ll want to refer to it\n\
</p>\n\
<ul>\n\
<li class=\"level1\"><div class=\"li\"><strong>Size: </strong>Round, 5mm (0.2&quot;) diameter. (Other photocells can get up to 12mm/0.4&quot; diameter!)</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Price:</strong> <a href=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=35&amp;products_id=161\" class=\"urlextern\" title=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=35&amp;products_id=161\"  rel=\"nofollow\">$1.00 at the Adafruit shop</a> </div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Resistance range: </strong>200K Ω (dark) to 10KΩ (10 lux brightness)</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Sensitivity range:</strong> CdS cells respond to light between 400nm (violet) and 600nm (orange) wavelengths, peaking at about 520nm (green).</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Power supply:</strong> pretty much anything up to 100V, uses less than 1mA of current on average (depends on power supply voltage)</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong><a href=\"http://www.ladyada.net/media/sensors/PDV-P8001.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/PDV-P8001.pdf\"  rel=\"nofollow\">Datasheet</a> </strong> and another <strong><a href=\"http://www.ladyada.net/media/sensors/DTS_A9950_A7060_B9060.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/DTS_A9950_A7060_B9060.pdf\"  rel=\"nofollow\">Datasheet</a> </strong></div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\">Two<strong><a href=\"http://www.ladyada.net/media/sensors/APP_PhotocellIntroduction.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/APP_PhotocellIntroduction.pdf\"  rel=\"nofollow\">application notes on using</a> </strong> and <strong><a href=\"http://www.ladyada.net/media/sensors/gde_photocellselecting.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/gde_photocellselecting.pdf\"  rel=\"nofollow\">selecting photocells</a> </strong> where nearly all of these graphs are taken from </div>\n\
</li>\n\
</ul>\n\
\n\
</div>\n\
<!-- EDIT2 SECTION \"Some basic stats\" [1548-2870] -->\n\
<h3 class=\"sectionedit3\"><a name=\"problems_you_may_encounter_with_multiple_sensors\" id=\"problems_you_may_encounter_with_multiple_sensors\">Problems you may encounter with multiple sensors...</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
If, when adding more sensors, you find that the temperature is inconsistant, this indicates that the sensors are interfering with each other when switching the analog reading circuit from one pin to the other. You can fix this by doing two delayed readings and tossing out the first one\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.adafruit.com/blog/2010/01/29/how-to-multiplex-analog-readings-what-can-go-wrong-with-high-impedance-sensors-and-how-to-fix-it/\" class=\"urlextern\" title=\"http://www.adafruit.com/blog/2010/01/29/how-to-multiplex-analog-readings-what-can-go-wrong-with-high-impedance-sensors-and-how-to-fix-it/\"  rel=\"nofollow\">See this post for more information</a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT3 SECTION \"Problems you may encounter with multiple sensors...\" [2871-3404] -->\n\
<h3 class=\"sectionedit4\"><a name=\"how_to_measure_light_using_a_photocell\" id=\"how_to_measure_light_using_a_photocell\">How to measure light using a photocell</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
As we&#039;ve said, a photocell&#039;s resistance changes as the face is exposed to more light. When its dark, the sensor looks like an large  resistor up to 10MΩ, as the light level increases, the resistance goes  down. This graph indicates approximately the resistance of the sensor  at different light levels. Remember each photocell will be a little different so use this as a guide only!\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=662df0&amp;w=500&amp;h=351&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fgraph.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"351\" />\n\
</p>\n\
\n\
<p>\n\
Note that the graph is not linear, its a log-log graph!\n\
</p>\n\
\n\
<p>\n\
Photocells, particularly the common CdS cells that you&#039;re likely to find, are not sensitive to all light. In particular they tend to be sensitive to light between 700nm (red) and 500nm (green) light.\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=1dca01&amp;w=516&amp;h=389&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsspectrum.gif\" class=\"mediacenter\" alt=\"\" width=\"516\" height=\"389\" />\n\
</p>\n\
\n\
<p>\n\
Basically, blue light wont be nearly as effective at triggering the sensor as green/yellow light!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT4 SECTION \"How to measure light using a photocell\" [3405-4357] -->\n\
<h3 class=\"sectionedit5\"><a name=\"what_the_heck_is_lux\" id=\"what_the_heck_is_lux\">What the heck is lux?</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Most datasheets use <a href=\"http://en.wikipedia.org/wiki/Lux\" class=\"urlextern\" title=\"http://en.wikipedia.org/wiki/Lux\"  rel=\"nofollow\">lux</a>  to indicate the resistance at certain light levels. But what is <a href=\"http://en.wikipedia.org/wiki/Lux\" class=\"urlextern\" title=\"http://en.wikipedia.org/wiki/Lux\"  rel=\"nofollow\">lux</a> ? Its not a method we tend to use to describe brightness so its tough to gauge. Here is a table <a href=\"http://en.wikipedia.org/wiki/Lux\" class=\"urlextern\" title=\"http://en.wikipedia.org/wiki/Lux\"  rel=\"nofollow\">adapted from a Wikipedia article on the topic!</a> \n\
</p>\n\
<div class=\"table sectionedit6\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<th class=\"col0\">Illuminance</th><th class=\"col1\">Example</th>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<td class=\"col0\"><strong>0.002 lux</strong></td><td class=\"col1\">Moonless clear night sky </td>\n\
	</tr>\n\
	<tr class=\"row2\">\n\
		<td class=\"col0\"><strong>0.2 lux</strong></td><td class=\"col1\">Design minimum for emergency lighting (AS2293).</td>\n\
	</tr>\n\
	<tr class=\"row3\">\n\
		<td class=\"col0\"><strong>0.27 - 1 lux</strong></td><td class=\"col1\">Full moon on a clear night</td>\n\
	</tr>\n\
	<tr class=\"row4\">\n\
		<td class=\"col0\"><strong>3.4 lux</strong></td><td class=\"col1\">Dark limit of civil twilight under a clear sky</td>\n\
	</tr>\n\
	<tr class=\"row5\">\n\
		<td class=\"col0\"><strong>50 lux</strong></td><td class=\"col1\">Family living room</td>\n\
	</tr>\n\
	<tr class=\"row6\">\n\
		<td class=\"col0\"><strong>80 lux</strong></td><td class=\"col1\">Hallway/toilet</td>\n\
	</tr>\n\
	<tr class=\"row7\">\n\
		<td class=\"col0\"><strong>100 lux</strong></td><td class=\"col1\">Very dark overcast day</td>\n\
	</tr>\n\
	<tr class=\"row8\">\n\
		<td class=\"col0\"><strong>300 - 500 lux</strong></td><td class=\"col1\">Sunrise or sunset on a clear day. Well-lit office area.</td>\n\
	</tr>\n\
	<tr class=\"row9\">\n\
		<td class=\"col0\"><strong>1,000 lux</strong></td><td class=\"col1\">Overcast day; typical TV studio lighting</td>\n\
	</tr>\n\
	<tr class=\"row10\">\n\
		<td class=\"col0\"><strong>10,000 - 25,000 lux</strong></td><td class=\"col1\">Full daylight (not direct sun)</td>\n\
	</tr>\n\
	<tr class=\"row11\">\n\
		<td class=\"col0\"><strong>32,000 - 130,000 lux</strong></td><td class=\"col1\">Direct sunlight</td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT6 TABLE [4740-5302] -->\n\
</div>\n\
<!-- EDIT5 SECTION \"What the heck is lux?\" [4358-5303] -->\n\
<h3 class=\"sectionedit7\"><a name=\"testing_your_photocell\" id=\"testing_your_photocell\">Testing your photocell</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
The easiest way to determine how your photocell works is to<a href=\"http://www.ladyada.net/learn/multimeter/\" class=\"urlextern\" title=\"http://www.ladyada.net/learn/multimeter/\"  rel=\"nofollow\"> connect a multimeter in resistance-measurement mode</a>  to the two leads and see how the resistance changes when shading the sensor with your hand, turning off lights, etc.  Because the resistance changes a lot, an auto-ranging meter works well  here. Otherwise, just make sure you try different ranges, between 1MΩ and 1KΩ before &#039;giving up&#039;\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/cdslitmm.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/cdslitmm.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=444e73&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdslitmm_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/cdscovered.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/cdscovered.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=c577a5&amp;w=500&amp;h=375&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdscovered_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"375\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT7 SECTION \"Testing your photocell\" [5304-6057] -->\n\
<h3 class=\"sectionedit8\"><a name=\"connecting_to_your_photocell\" id=\"connecting_to_your_photocell\">Connecting to your photocell</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Because photocells are basically resistors, they are non-polarized. That means you can connect them up &#039;either way&#039; and they&#039;ll work just fine!\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/cdsbb.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/cdsbb.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=dcba92&amp;w=500&amp;h=376&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsbb_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"376\" /></a> \n\
</p>\n\
\n\
<p>\n\
Photocells are pretty hardy, you can easily solder to them, clip the leads, plug them into breadboards, use alligator clips, etc. The only care you should take is to avoid bending the leads right at the epoxied sensor, as they could break off if flexed too often.\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/cdswired.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/cdswired.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=543b71&amp;w=500&amp;h=376&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdswired_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"376\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT8 SECTION \"Connecting to your photocell\" [6058-6772] -->\n\
<h3 class=\"sectionedit9\"><a name=\"project_examples\" id=\"project_examples\">Project examples</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"/wiki/_media/tutorials/learn/sensors/blip_2135323\" class=\"media mediafile mf_ wikilink2\" title=\"tutorials:learn:sensors:blip_2135323\"> </a> \n\
 <a href=\"http://www.adafruit.com/blog/2009/05/19/piezo-with-an-arduino-photoresistor/\" class=\"urlextern\" title=\"http://www.adafruit.com/blog/2009/05/19/piezo-with-an-arduino-photoresistor/\"  rel=\"nofollow\">Noisemaker that changes frequency based on light level.    </a> \n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/t5IS33X6Dm8\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/t5IS33X6Dm8\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
 Motor value and directional control with photoresistors and microcontroller\n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/jbJu1xQ4rRk\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/jbJu1xQ4rRk\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
Line-following robot that uses photocells to detect the light bouncing off of white/black stripes \n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.vimeo.com/moogaloop.swf?clip_id=4212409\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.vimeo.com/moogaloop.swf?clip_id=4212409\" />\n\
<!--><!-- -->\n\
  <param name=\"clip_id\" value=\"4212409\" />\n\
  <param name=\"FlashVars\" value=\"clip_id=4212409\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
<a href=\"http://tinkerlog.com/2009/04/18/arduino-powered-braitenberg-vehicle/\" class=\"urlextern\" title=\"http://tinkerlog.com/2009/04/18/arduino-powered-braitenberg-vehicle/\"  rel=\"nofollow\">Another robot, this one has two sensors and moves towards light</a>  (they&#039;re called Braitenberg vehicles)\n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/EW3nTjMCdcg\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/EW3nTjMCdcg\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
<a href=\"http://www.instructables.com/id/Another_Arduino_Laser_Tripwire/\" class=\"urlextern\" title=\"http://www.instructables.com/id/Another_Arduino_Laser_Tripwire/\"  rel=\"nofollow\">Using a photocell and pocket laser pointer to create a breakbeam sensor</a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT9 SECTION \"Project examples\" [6773-7565] -->\n\
<h3 class=\"sectionedit10\"><a name=\"analog_voltage_reading_method\" id=\"analog_voltage_reading_method\">Analog voltage reading method</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
The easiest way to measure a resistive sensor is to connect one end to Power and the other to a <strong>pull-down</strong> resistor to ground. Then the point between the fixed pulldown resistor and the variable photocell resistor is connected to the analog input of a microcontroller such as an Arduino (shown)\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=988108&amp;w=162&amp;h=322&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsanasch.gif\" class=\"mediacenter\" alt=\"\" width=\"162\" height=\"322\" /><img src=\"/wiki/lib/exe/fetch.php?hash=5bac94&amp;w=604&amp;h=362&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdspulldowndiag.gif\" class=\"mediacenter\" alt=\"\" width=\"604\" height=\"362\" />\n\
</p>\n\
\n\
<p>\n\
For this example I&#039;m showing it with a 5V supply but note that you can use this with a 3.3v supply just as easily. In this configuration the analog voltage reading ranges from 0V (ground) to about 5V (or about the same as the power supply voltage).\n\
</p>\n\
\n\
<p>\n\
The way this works is that as the resistance of the photocell decreases, the total resistance of the photocell and the pulldown resistor decreases from over 600KΩ to 10KΩ. That means that the current flowing through both resistors <em>increases</em> which in turn causes the voltage across the fixed 10KΩ resistor to increase. Its quite a trick!\n\
</p>\n\
<div class=\"table sectionedit11\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<th class=\"col0\">Ambient light like…</th><th class=\"col1\">Ambient light (lux)</th><th class=\"col2\">Photocell resistance (Ω)</th><th class=\"col3\">LDR + R (Ω)</th><th class=\"col4\">Current thru LDR +R</th><th class=\"col5\">Voltage across R</th>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<th class=\"col0\">Dim hallway</th><th class=\"col1\">0.1 lux</th><td class=\"col2\">600KΩ</td><td class=\"col3\">610 KΩ</td><td class=\"col4\">0.008 mA</td><td class=\"col5\">0.1 V</td>\n\
	</tr>\n\
	<tr class=\"row2\">\n\
		<th class=\"col0\">Moonlit night</th><th class=\"col1\">1 lux</th><td class=\"col2\">70 KΩ</td><td class=\"col3\">80 KΩ</td><td class=\"col4\">0.07 mA</td><td class=\"col5\">0.6 V</td>\n\
	</tr>\n\
	<tr class=\"row3\">\n\
		<th class=\"col0\">Dark room</th><th class=\"col1\">10 lux</th><td class=\"col2\">10 KΩ</td><td class=\"col3\">20 KΩ</td><td class=\"col4\">0.25 mA</td><td class=\"col5\">2.5 V</td>\n\
	</tr>\n\
	<tr class=\"row4\">\n\
		<th class=\"col0\">Dark overcast day / Bright room</th><th class=\"col1\">100 lux</th><td class=\"col2\">1.5 KΩ</td><td class=\"col3\">11.5 KΩ</td><td class=\"col4\">0.43 mA</td><td class=\"col5\">4.3 V</td>\n\
	</tr>\n\
	<tr class=\"row5\">\n\
		<th class=\"col0\">Overcast day</th><th class=\"col1\">1000 lux</th><td class=\"col2\">300 Ω</td><td class=\"col3\">10.03 KΩ</td><td class=\"col4\">0.5 mA</td><td class=\"col5\">5V</td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT11 TABLE [8664-9056] -->\n\
<p>\n\
<em>This table indicates the approximate analog voltage based on the sensor light/resistance w/a 5V supply and 10KΩ pulldown resistor</em>\n\
</p>\n\
\n\
<p>\n\
If you&#039;re planning to have the sensor in a bright area and use a 10KΩ pulldown, it will quickly <em>saturate</em>. That means that it will hit the &#039;ceiling&#039; of 5V and not be able to differentiate between kinda bright and really bright. In that case, you should replace the 10KΩ pulldown with a 1KΩ pulldown. In that case, it will not be able to detect dark level differences as well but it will be able to detect bright light differences better. This is a tradeoff that you will have to decide upon!\n\
</p>\n\
<div class=\"table sectionedit12\"><table class=\"inline\">\n\
	<tr class=\"row0\">\n\
		<th class=\"col0\">Ambient light like…</th><th class=\"col1\">Ambient light (lux)</th><th class=\"col2\">Photocell resistance (Ω)</th><th class=\"col3\">LDR + R (Ω)</th><th class=\"col4\">Current thru LDR+R</th><th class=\"col5\">Voltage across R</th>\n\
	</tr>\n\
	<tr class=\"row1\">\n\
		<th class=\"col0\">Moonlit night</th><th class=\"col1\">1 lux</th><td class=\"col2\">70 KΩ</td><td class=\"col3\">71 KΩ</td><td class=\"col4\">0.07 mA</td><td class=\"col5\">0.1 V</td>\n\
	</tr>\n\
	<tr class=\"row2\">\n\
		<th class=\"col0\">Dark room</th><th class=\"col1\">10 lux</th><td class=\"col2\">10 KΩ</td><td class=\"col3\">11 KΩ</td><td class=\"col4\">0.45 mA</td><td class=\"col5\">0.5 V</td>\n\
	</tr>\n\
	<tr class=\"row3\">\n\
		<th class=\"col0\">Dark overcast day / Bright room</th><th class=\"col1\">100 lux</th><td class=\"col2\">1.5 KΩ</td><td class=\"col3\">2.5 KΩ</td><td class=\"col4\">2 mA</td><td class=\"col5\">2.0 V</td>\n\
	</tr>\n\
	<tr class=\"row4\">\n\
		<th class=\"col0\">Overcast day</th><th class=\"col1\">1000 lux</th><td class=\"col2\">300 Ω</td><td class=\"col3\">1.3 KΩ</td><td class=\"col4\">3.8 mA</td><td class=\"col5\">3.8 V</td>\n\
	</tr>\n\
	<tr class=\"row5\">\n\
		<th class=\"col0\">Full daylight</th><th class=\"col1\">10,000 lux</th><td class=\"col2\">100 Ω</td><td class=\"col3\">1.1 KΩ</td><td class=\"col4\">4.5 mA</td><td class=\"col5\">4.5 V</td>\n\
	</tr>\n\
</table></div>\n\
<!-- EDIT12 TABLE [9697-10088] -->\n\
<p>\n\
<em>This table indicates the approximate analog voltage based on the sensor light/resistance w/a 5V supply and 1K pulldown resistor</em>\n\
</p>\n\
\n\
<p>\n\
Note that our method does not provide linear voltage with respect to brightness! Also, each sensor will be different. As the light level increases, the analog voltage goes up even though the resistance goes down:\n\
</p>\n\
<pre class=\"code\">Vo = Vcc ( R / (R + Photocell) )</pre>\n\
\n\
<p>\n\
That is, the voltage is proportional to the <strong>inverse</strong> of the photocell resistance which is, in turn, inversely proportional to light levels\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT10 SECTION \"Analog voltage reading method\" [7566-10626] -->\n\
<h3 class=\"sectionedit13\"><a name=\"simple_demonstration_of_use\" id=\"simple_demonstration_of_use\">Simple demonstration of use</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=e9ad0c&amp;w=628&amp;h=394&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdslitetestdiag.gif\" class=\"mediacenter\" alt=\"\" width=\"628\" height=\"394\" /><img src=\"/wiki/lib/exe/fetch.php?hash=a089b2&amp;w=286&amp;h=357&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsliteschem.gif\" class=\"mediacenter\" alt=\"\" width=\"286\" height=\"357\" />\n\
</p>\n\
\n\
<p>\n\
This sketch will take the analog voltage reading and use that to determine how bright the red LED is. The darker it is, the brighter the LED will be! Remember that the LED has to be connected to a PWM pin for this to work, I use pin 11 in this example. \n\
</p>\n\
\n\
<p>\n\
These examples assume you know some basic Arduino programming. If you don&#039;t, <a href=\"http://www.ladyada.net/learn/arduino/index.html\" class=\"urlextern\" title=\"http://www.ladyada.net/learn/arduino/index.html\"  rel=\"nofollow\">maybe spend some time reviewing the basics at the Arduino tutorial?</a> \n\
</p>\n\
<pre class=\"code C\"><span class=\"coMULTI\">/* Photocell simple testing sketch. \n\
&nbsp;\n\
Connect one end of the photocell to 5V, the other end to Analog 0.\n\
Then connect one end of a 10K resistor from Analog 0 to ground \n\
Connect LED from pin 11 through a resistor to ground \n\
For more information see www.ladyada.net/learn/sensors/cds.html */</span>\n\
&nbsp;\n\
<span class=\"kw4\">int</span> photocellPin <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span>     <span class=\"co1\">// the cell and 10K pulldown are connected to a0</span>\n\
<span class=\"kw4\">int</span> photocellReading<span class=\"sy0\">;</span>     <span class=\"co1\">// the analog reading from the sensor divider</span>\n\
<span class=\"kw4\">int</span> LEDpin <span class=\"sy0\">=</span> <span class=\"nu0\">11</span><span class=\"sy0\">;</span>          <span class=\"co1\">// connect Red LED to pin 11 (PWM pin)</span>\n\
<span class=\"kw4\">int</span> LEDbrightness<span class=\"sy0\">;</span>        <span class=\"co1\">// </span>\n\
<span class=\"kw4\">void</span> setup<span class=\"br0\">&#40;</span><span class=\"kw4\">void</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"co1\">// We\'ll send debugging information via the Serial monitor</span>\n\
  Serial.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"nu0\">9600</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>   \n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> loop<span class=\"br0\">&#40;</span><span class=\"kw4\">void</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  photocellReading <span class=\"sy0\">=</span> analogRead<span class=\"br0\">&#40;</span>photocellPin<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>  \n\
&nbsp;\n\
  Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;Analog reading = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span>photocellReading<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>     <span class=\"co1\">// the raw analog reading</span>\n\
&nbsp;\n\
  <span class=\"co1\">// LED gets brighter the darker it is at the sensor</span>\n\
  <span class=\"co1\">// that means we have to -invert- the reading from 0-1023 back to 1023-0</span>\n\
  photocellReading <span class=\"sy0\">=</span> <span class=\"nu0\">1023</span> <span class=\"sy0\">-</span> photocellReading<span class=\"sy0\">;</span>\n\
  <span class=\"co1\">//now we have to map 0-1023 to 0-255 since thats the range analogWrite uses</span>\n\
  LEDbrightness <span class=\"sy0\">=</span> map<span class=\"br0\">&#40;</span>photocellReading<span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">1023</span><span class=\"sy0\">,</span> <span class=\"nu0\">0</span><span class=\"sy0\">,</span> <span class=\"nu0\">255</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  analogWrite<span class=\"br0\">&#40;</span>LEDpin<span class=\"sy0\">,</span> LEDbrightness<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  delay<span class=\"br0\">&#40;</span><span class=\"nu0\">100</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span></pre>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=b0bb0f&amp;w=500&amp;h=357&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdslitetestout.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"357\" />\n\
</p>\n\
\n\
<p>\n\
You may want to try different pulldown resistors depending on the light level range you want to detect!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT13 SECTION \"Simple demonstration of use\" [10627-12666] -->\n\
<h3 class=\"sectionedit14\"><a name=\"simple_code_for_analog_light_measurements\" id=\"simple_code_for_analog_light_measurements\">Simple code for analog light measurements</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
This code doesn&#039;t do any calculations, it just prints out what it interprets as the amount of light in a qualitative manner. For most projects, this is pretty much all thats needed!\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=5bac94&amp;w=604&amp;h=362&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdspulldowndiag.gif\" class=\"mediacenter\" alt=\"\" width=\"604\" height=\"362\" /><img src=\"/wiki/lib/exe/fetch.php?hash=988108&amp;w=162&amp;h=322&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsanasch.gif\" class=\"mediacenter\" alt=\"\" width=\"162\" height=\"322\" />\n\
</p>\n\
<pre class=\"code C\"><span class=\"coMULTI\">/* Photocell simple testing sketch. \n\
&nbsp;\n\
Connect one end of the photocell to 5V, the other end to Analog 0.\n\
Then connect one end of a 10K resistor from Analog 0 to ground\n\
&nbsp;\n\
For more information see www.ladyada.net/learn/sensors/cds.html */</span>\n\
&nbsp;\n\
<span class=\"kw4\">int</span> photocellPin <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span>     <span class=\"co1\">// the cell and 10K pulldown are connected to a0</span>\n\
<span class=\"kw4\">int</span> photocellReading<span class=\"sy0\">;</span>     <span class=\"co1\">// the analog reading from the analog resistor divider</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> setup<span class=\"br0\">&#40;</span><span class=\"kw4\">void</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"co1\">// We\'ll send debugging information via the Serial monitor</span>\n\
  Serial.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"nu0\">9600</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>   \n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> loop<span class=\"br0\">&#40;</span><span class=\"kw4\">void</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  photocellReading <span class=\"sy0\">=</span> analogRead<span class=\"br0\">&#40;</span>photocellPin<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>  \n\
&nbsp;\n\
  Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;Analog reading = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span>photocellReading<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>     <span class=\"co1\">// the raw analog reading</span>\n\
&nbsp;\n\
  <span class=\"co1\">// We\'ll have a few threshholds, qualitatively determined</span>\n\
  <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>photocellReading <span class=\"sy0\">&lt;</span> <span class=\"nu0\">10</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; - Dark&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span> <span class=\"kw1\">else</span> <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>photocellReading <span class=\"sy0\">&lt;</span> <span class=\"nu0\">200</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; - Dim&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span> <span class=\"kw1\">else</span> <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>photocellReading <span class=\"sy0\">&lt;</span> <span class=\"nu0\">500</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; - Light&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span> <span class=\"kw1\">else</span> <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>photocellReading <span class=\"sy0\">&lt;</span> <span class=\"nu0\">800</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; - Bright&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span> <span class=\"kw1\">else</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot; - Very bright&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
  delay<span class=\"br0\">&#40;</span><span class=\"nu0\">1000</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span></pre>\n\
\n\
<p>\n\
To test it, I started in a sunlit (but shaded) room and covered the sensor with my hand, then covered it with a piece of blackout fabric.<img src=\"/wiki/lib/exe/fetch.php?hash=9c634a&amp;w=508&amp;h=316&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdssimpletestout.gif\" class=\"mediacenter\" alt=\"\" width=\"508\" height=\"316\" />\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT14 SECTION \"Simple code for analog light measurements\" [12667-14376] -->\n\
<h3 class=\"sectionedit15\"><a name=\"bonus_reading_photocells_without_analog_pins\" id=\"bonus_reading_photocells_without_analog_pins\">BONUS! Reading photocells without analog pins</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Because photocells are basically resistors, its possible to use them even if you don&#039;t have any analog pins on your microcontroller (or if say you want to connect more than you have analog input pins). The way we do this is by taking advantage of a basic electronic property of resistors and capacitors. It turns out that if you take a capacitor that is initially storing no voltage, and then connect it to power (like 5V) through a resistor, it will charge up to the power voltage slowly. The bigger the resistor, the slower it is. \n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=560967&amp;w=640&amp;h=480&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FRCtimecapture.jpg\" class=\"mediacenter\" alt=\"\" width=\"640\" height=\"480\" /> <br/>\n\
<em>This capture from an oscilloscope shows whats happening on the digital pin (yellow). The blue line indicates when the sketch starts counting and when the couting is complete, about 1.2ms later.</em>\n\
</p>\n\
\n\
<p>\n\
This is because the capacitor acts like a bucket and the resistor is like a thin pipe. To fill a bucket up with a very thin pipe takes enough time that you can figure out how wide the pipe is by timing how long it takes to fill the bucket up halfway. \n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=fa5bd2&amp;w=598&amp;h=379&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FCdSRCtimediag.gif\" class=\"mediacenter\" alt=\"\" width=\"598\" height=\"379\" /><img src=\"/wiki/lib/exe/fetch.php?hash=96e62f&amp;w=182&amp;h=345&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FcdsRCschm.gif\" class=\"mediacenter\" alt=\"\" width=\"182\" height=\"345\" />\n\
</p>\n\
\n\
<p>\n\
In this case, our &#039;bucket&#039; is a 0.1uF ceramic capacitor. You can change the capacitor nearly any way you want but the timing values will also change. 0.1uF seems to be an OK place to start for these photocells. If you want to measure brighter ranges, use a 1uF capacitor. If you want to measure darker ranges, go down to 0.01uF.\n\
</p>\n\
<pre class=\"code C\"><span class=\"coMULTI\">/* Photocell simple testing sketch. \n\
Connect one end of photocell to power, the other end to pin 2.\n\
Then connect one end of a 0.1uF capacitor from pin 2 to ground \n\
For more information see www.ladyada.net/learn/sensors/cds.html */</span>\n\
&nbsp;\n\
<span class=\"kw4\">int</span> photocellPin <span class=\"sy0\">=</span> <span class=\"nu0\">2</span><span class=\"sy0\">;</span>     <span class=\"co1\">// the LDR and cap are connected to pin2</span>\n\
<span class=\"kw4\">int</span> photocellReading<span class=\"sy0\">;</span>     <span class=\"co1\">// the digital reading</span>\n\
<span class=\"kw4\">int</span> ledPin <span class=\"sy0\">=</span> <span class=\"nu0\">13</span><span class=\"sy0\">;</span>    <span class=\"co1\">// you can just use the \'built in\' LED</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> setup<span class=\"br0\">&#40;</span><span class=\"kw4\">void</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"co1\">// We\'ll send debugging information via the Serial monitor</span>\n\
  Serial.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"nu0\">9600</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>   \n\
  pinMode<span class=\"br0\">&#40;</span>ledPin<span class=\"sy0\">,</span> OUTPUT<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>  <span class=\"co1\">// have an LED for output </span>\n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> loop<span class=\"br0\">&#40;</span><span class=\"kw4\">void</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"co1\">// read the resistor using the RCtime technique</span>\n\
  photocellReading <span class=\"sy0\">=</span> RCtime<span class=\"br0\">&#40;</span>photocellPin<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>photocellReading <span class=\"sy0\">==</span> <span class=\"nu0\">30000</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
    <span class=\"co1\">// if we got 30000 that means we \'timed out\'</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;Nothing connected!&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span> <span class=\"kw1\">else</span> <span class=\"br0\">&#123;</span>\n\
    Serial.<span class=\"me1\">print</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;RCtime reading = &quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span>photocellReading<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>     <span class=\"co1\">// the raw analog reading</span>\n\
&nbsp;\n\
    <span class=\"co1\">// The brighter it is, the faster it blinks!</span>\n\
    digitalWrite<span class=\"br0\">&#40;</span>ledPin<span class=\"sy0\">,</span> HIGH<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    delay<span class=\"br0\">&#40;</span>photocellReading<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    digitalWrite<span class=\"br0\">&#40;</span>ledPin<span class=\"sy0\">,</span> LOW<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
    delay<span class=\"br0\">&#40;</span>photocellReading<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
  delay<span class=\"br0\">&#40;</span><span class=\"nu0\">100</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"co1\">// Uses a digital pin to measure a resistor (like an FSR or photocell!)</span>\n\
<span class=\"co1\">// We do this by having the resistor feed current into a capacitor and</span>\n\
<span class=\"co1\">// counting how long it takes to get to Vcc/2 (for most arduinos, thats 2.5V)</span>\n\
<span class=\"kw4\">int</span> RCtime<span class=\"br0\">&#40;</span><span class=\"kw4\">int</span> RCpin<span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  <span class=\"kw4\">int</span> reading <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span>  <span class=\"co1\">// start with 0</span>\n\
&nbsp;\n\
  <span class=\"co1\">// set the pin to an output and pull to LOW (ground)</span>\n\
  pinMode<span class=\"br0\">&#40;</span>RCpin<span class=\"sy0\">,</span> OUTPUT<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  digitalWrite<span class=\"br0\">&#40;</span>RCpin<span class=\"sy0\">,</span> LOW<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
&nbsp;\n\
  <span class=\"co1\">// Now set the pin to an input and...</span>\n\
  pinMode<span class=\"br0\">&#40;</span>RCpin<span class=\"sy0\">,</span> INPUT<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
  <span class=\"kw1\">while</span> <span class=\"br0\">&#40;</span>digitalRead<span class=\"br0\">&#40;</span>RCpin<span class=\"br0\">&#41;</span> <span class=\"sy0\">==</span> LOW<span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span> <span class=\"co1\">// count how long it takes to rise up to HIGH</span>\n\
    reading<span class=\"sy0\">++;</span>      <span class=\"co1\">// increment to keep track of time </span>\n\
&nbsp;\n\
    <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>reading <span class=\"sy0\">==</span> <span class=\"nu0\">30000</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
      <span class=\"co1\">// if we got this far, the resistance is so high</span>\n\
      <span class=\"co1\">// its likely that nothing is connected! </span>\n\
      <span class=\"kw2\">break</span><span class=\"sy0\">;</span>           <span class=\"co1\">// leave the loop</span>\n\
    <span class=\"br0\">&#125;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
  <span class=\"co1\">// OK either we maxed out at 30000 or hopefully got a reading, return the count</span>\n\
&nbsp;\n\
  <span class=\"kw1\">return</span> reading<span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span></pre>\n\
\n\
<p>\n\
  <img src=\"/wiki/lib/exe/fetch.php?hash=45a2e2&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fcdsrctimeout.gif\" class=\"mediacenter\" alt=\"\" />\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT15 SECTION \"BONUS! Reading photocells without analog pins\" [14377-] -->";document.write(zoomy);document.write("<hr /><br /><em>This page was autogenerated from <a href=\"http://www.ladyada.net/wiki/tutorials/learn/sensors/cds.html\" target=\"_blank\">http://www.ladyada.net/wiki/tutorials/learn/sensors/cds.html</a> <br />Please edit the wiki to contribute any updates or corrections.</em>")