var zoomy = "<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/pirsensor.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/pirsensor.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=9fe96b&amp;w=500&amp;h=300&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirsensor_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"300\" /></a> \n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/pirlens.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/pirlens.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=6acf85&amp;w=500&amp;h=269&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirlens_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"269\" /></a> <img src=\"/wiki/lib/exe/fetch.php?hash=89005e&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpiranno.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" />\n\
</p>\n\
\n\
</div>\n\
\n\
<h3 class=\"sectionedit1\"><a name=\"what_is_a_pir_sensor\" id=\"what_is_a_pir_sensor\">What is a PIR sensor?</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
PIR sensors allow you to sense motion, almost always used to detect whether a human has moved in or out of the sensors range. They are small, inexpensive, low-power, easy to use and don&#039;t wear out. For that reason they are commonly found in appliances and gadgets used in homes or businesses. They are often referred to as PIR, &quot;Passive Infrared&quot;, &quot;Pyroelectric&quot;, or &quot;IR motion&quot; sensors. \n\
</p>\n\
\n\
<p>\n\
PIRs are basically made of a <a href=\"http://en.wikipedia.org/wiki/Pyroelectric\" class=\"urlextern\" title=\"http://en.wikipedia.org/wiki/Pyroelectric\"  rel=\"nofollow\">pyroelectric sensor</a>  (which you can see above as the round metal can with a rectangular crystal in the center), which can detect levels of infrared radiation. Everything emits some low level radiation, and the hotter something is, the more radiation is emitted. The sensor in a motion detector is actually split in two halves. The reason for that is that we are looking to detect motion (change) not average IR levels. The two halves are wired up so that they cancel each other out. If one half sees more or less IR radiation than the other, the output will swing high or low.\n\
</p>\n\
\n\
<p>\n\
Along with the pyroelectic sensor is a bunch of supporting circuitry, resistors and capacitors. It seems that most small hobbyist sensors use the <a href=\"http://www.ladyada.net/media/sensors/BISS0001.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/BISS0001.pdf\"  rel=\"nofollow\">BISS0001 (&quot;Micro Power PIR Motion Detector IC&quot;)</a> , undoubtedly a very inexpensive chip. This chip takes the output of the sensor and does some minor processing on it to emit a digital output pulse from the analog sensor.\n\
</p>\n\
\n\
<p>\n\
For many basic projects or products that need to detect when a person has left or entered the area, or has approached, PIR sensors are great. They are low power and low cost, pretty rugged, have a wide lens range, and are easy to interface with. Note that PIRs won&#039;t tell you how many people are around or how close they are to the sensor, the lens is often fixed to a certain sweep and distance (although it can be hacked somewhere) and they are also sometimes set off by housepets. Experimentation is key!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT1 SECTION \"What is a PIR sensor?\" [360-2372] -->\n\
<h3 class=\"sectionedit2\"><a name=\"some_basic_stats\" id=\"some_basic_stats\">Some basic stats</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
These stats are for the PIR sensor in the Adafruit shop which is very much <a href=\"http://www.parallax.com/Store/Sensors/ObjectDetection/tabid/176/ProductID/83/List/0/Default.aspx?SortField=ProductName,ProductName\" class=\"urlextern\" title=\"http://www.parallax.com/Store/Sensors/ObjectDetection/tabid/176/ProductID/83/List/0/Default.aspx?SortField=ProductName,ProductName\"  rel=\"nofollow\">like the Parallax one</a> . Nearly all PIRs will have slightly different specifications, although they all pretty much work the same. If there&#039;s a datasheet, you&#039;ll want to refer to it\n\
</p>\n\
<ul>\n\
<li class=\"level1\"><div class=\"li\"><strong>Size:</strong> Rectangular</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Price:</strong> <a href=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=35&amp;products_id=189\" class=\"urlextern\" title=\"http://www.adafruit.com/index.php?main_page=product_info&amp;cPath=35&amp;products_id=189\"  rel=\"nofollow\">$10.00 at the Adafruit shop</a> </div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Output: </strong>Digital pulse high (3V) when triggered (motion detected) digital low when idle (no motion detected). Pulse lengths are determined by resistors and capacitors on the PCB and differ from sensor to sensor.</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Sensitivity range:</strong> up to 20 feet (6 meters) 110° x 70° detection range</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong>Power supply:</strong> 5V-9V input voltage, </div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong><a href=\"http://www.ladyada.net/media/sensors/BISS0001.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/BISS0001.pdf\"  rel=\"nofollow\">BIS0001 Datasheet </a> </strong>(the decoder chip used)</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong><a href=\"http://www.ladyada.net/media/sensors/RE200B.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/RE200B.pdf\"  rel=\"nofollow\">RE200B datasheet</a> </strong> (most likely the PIR sensing element used)</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong><a href=\"http://www.ladyada.net/media/sensors/NL11NH.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/NL11NH.pdf\"  rel=\"nofollow\"> NL11NH datasheet</a> </strong> (equivalent lens used)</div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong><a href=\"http://www.ladyada.net/media/sensors/PIRSensor-V1.2.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/PIRSensor-V1.2.pdf\"  rel=\"nofollow\">Parallax Datasheet on their version of the sensor</a> </strong></div>\n\
</li>\n\
</ul>\n\
\n\
<p>\n\
More links!\n\
</p>\n\
<ul>\n\
<li class=\"level1\"><div class=\"li\"><a href=\"http://www.glolab.com/pirparts/infrared.html\" class=\"urlextern\" title=\"http://www.glolab.com/pirparts/infrared.html\"  rel=\"nofollow\">A great page on PIR sensors from GLOLAB \\\\ </a> </div>\n\
</li>\n\
<li class=\"level1\"><div class=\"li\"><strong><a href=\"http://tinyurl.com/3y39hks\" class=\"urlextern\" title=\"http://tinyurl.com/3y39hks\"  rel=\"nofollow\">NYU sensor report</a> </strong> </div>\n\
</li>\n\
</ul>\n\
\n\
</div>\n\
<!-- EDIT2 SECTION \"Some basic stats\" [2373-3895] -->\n\
<h3 class=\"sectionedit3\"><a name=\"how_does_it_work\" id=\"how_does_it_work\">How does it work?</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
PIR sensors are more complicated than many of the other sensors explained in these tutorials (like photocells, FSRs and tilt switches) because there are multiple variables that affect the sensors input and output. To begin explaining how a basic sensor works, we&#039;ll use this rather nice diagram (if anyone knows where it originates plz let me know). \n\
</p>\n\
\n\
<p>\n\
The PIR sensor itself has two slots in it, each slot is made of a special material that is sensitive to IR. The lens used here is not really doing much and so we see that the two slots can &#039;see&#039; out past some distance (basically the sensitivity of the sensor). When the sensor is idle, both slots detect the same amount of IR, the ambient amount radiated from the room or walls or outdoors. When a warm body like a human or animal passes by, it first intercepts one half of the PIR sensor, which causes a<em> positive differential</em> change between the two halves. When the warm body leaves the sensing area, the reverse happens, whereby the sensor generates a negative differential change. These change pulses are what is detected.\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=d68876&amp;w=450&amp;h=411&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirdiagram.jpg\" class=\"mediacenter\" alt=\"\" width=\"450\" height=\"411\" /> <br/>\n\
<em>[Citation needed]</em>\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT3 SECTION \"How does it work?\" [3896-5111] -->\n\
<h3 class=\"sectionedit4\"><a name=\"the_pir_sensor_itself\" id=\"the_pir_sensor_itself\">The PIR sensor itself</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=3332cd&amp;w=429&amp;h=254&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpyrosensor.gif\" class=\"mediacenter\" alt=\"\" width=\"429\" height=\"254\" /> <br/>\n\
<a href=\"http://www.ladyada.net/media/sensors/pyroelectrics21e.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/pyroelectrics21e.pdf\"  rel=\"nofollow\">Left image from Murata datasheet</a> \n\
</p>\n\
\n\
<p>\n\
The IR sensor itself is housed in a hermetically sealed metal can to improve noise/temperature/humidity immunity. There is a window made of IR-transmissive material (typically coated silicon since that is very easy to come by) that protects the sensing element. Behind the window are the two balanced sensors.\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=9f6fbd&amp;w=500&amp;h=265&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpyrodiagram.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"265\" /> <br/>\n\
<a href=\"http://www.ladyada.net/media/sensors/RE200B.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/RE200B.pdf\"  rel=\"nofollow\">Image from RE200B datasheet</a> \n\
</p>\n\
\n\
<p>\n\
You can see above the diagram showing the element window, the two pieces of sensing material\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=24f43f&amp;w=500&amp;h=162&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirinternalschem.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"162\" /> <br/>\n\
<a href=\"http://www.ladyada.net/media/sensors/RE200B.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/RE200B.pdf\"  rel=\"nofollow\">Image from RE200B datasheet</a> \n\
</p>\n\
\n\
<p>\n\
This image shows the internal schematic. There is actually a JFET inside (a type of transistor) which is very low-noise and buffers the extremely high impedence of the sensors into something a low-cost chip (like the BIS0001) can sense.\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT4 SECTION \"The PIR sensor itself\" [5112-6295] -->\n\
<h3 class=\"sectionedit5\"><a name=\"lenses\" id=\"lenses\">Lenses</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
PIR sensors are rather generic and for the most part vary only in price and sensitivity. Most of the real magic happens with the optics. This is a pretty good idea for manufacturing: the PIR sensor and circuitry is fixed and costs a few dollars. The lens costs only a few cents and can change the breadth, range, sensing pattern, very easily.\n\
</p>\n\
\n\
<p>\n\
In the diagram up top, the lens is just a piece of plastic, but that means that the detection area is just two rectangles. Usually we&#039;d like to have a detection area that is much larger. To do that, we use <a href=\"http://en.wikipedia.org/wiki/Lens_%28optics%29\" class=\"urlextern\" title=\"http://en.wikipedia.org/wiki/Lens_%28optics%29\"  rel=\"nofollow\">a simple lens</a>  such as those found in a camera: they condenses a large area (such as a landscape) into a small one (on film or a CCD sensor). For reasons that will be apparent soon, we would like to make the PIR lenses small and thin and moldable from cheap plastic, even though it may add distortion. For this reason the sensors are actually <a href=\"http://en.wikipedia.org/wiki/Fresnel_lens\" class=\"urlextern\" title=\"http://en.wikipedia.org/wiki/Fresnel_lens\"  rel=\"nofollow\">Fresnel lenses</a> :\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=5123bf&amp;w=270&amp;h=242&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fsensorsmagfresnel.gif\" class=\"mediacenter\" alt=\"\" width=\"270\" height=\"242\" /> <br/>\n\
<a href=\"http://www.sensorsmag.com/articles/0403/35/main.shtml\" class=\"urlextern\" title=\"http://www.sensorsmag.com/articles/0403/35/main.shtml\"  rel=\"nofollow\">Image from Sensors Magazine</a> \n\
</p>\n\
\n\
<p>\n\
The Fresnel lens condenses light, providing a larger range of IR to the sensor.\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=8517f8&amp;w=580&amp;h=185&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Flinearfresnel.gif\" class=\"mediacenter\" alt=\"\" width=\"580\" height=\"185\" /> <br/>\n\
<a href=\"http://www.bhlens.com/linear_fresnel_lens.aspx\" class=\"urlextern\" title=\"http://www.bhlens.com/linear_fresnel_lens.aspx\"  rel=\"nofollow\">Image from BHlens.com</a> \n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=d21ad7&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirfocal.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" /> <br/>\n\
<a href=\"http://www.ladyada.net/media/sensors/an2105.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/an2105.pdf\"  rel=\"nofollow\">Image from Cypress appnote 2105</a> \n\
</p>\n\
\n\
<p>\n\
OK, so now we have a much larger range. However, remember that we actually have two sensors, and more importantly we dont want two really big sensing-area rectangles, but rather a scattering of multiple small areas. So what we do is split up the lens into multiple section, each section of which is a fresnel lens\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/frenelled.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/frenelled.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=886cc2&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Ffrenelled_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" /></a>  <br/>\n\
<em>Here you can see the multiple facet-sections</em>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/frenelling.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/frenelling.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=248d01&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Ffrenelling_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" /></a>  <br/>\n\
<em>This macro shot shows the different Frenel lenses in each facet!</em>\n\
</p>\n\
\n\
<p>\n\
The different faceting and sub-lenses create a range of detection areas, interleaved with each other. Thats why the lens centers in the facets above are &#039;inconsistant&#039; - every other one points to a different half of the PIR sensing element\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=7200e1&amp;w=500&amp;h=336&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FNL11NH.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"336\" /> <br/>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=d79c97&amp;w=500&amp;h=268&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FNL11NH-side.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"268\" /> <br/>\n\
<a href=\"http://www.ladyada.net/media/sensors/NL11NH.pdf\" class=\"urlextern\" title=\"http://www.ladyada.net/media/sensors/NL11NH.pdf\"  rel=\"nofollow\">Images from NL11NH datasheet</a> \n\
</p>\n\
\n\
<p>\n\
Here is another image, more qualitative but not as quantitative. (Note that the sensor in the Adafruit shop is 110° not 90°)\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=0c067b&amp;w=470&amp;h=329&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Frounddetectlens.gif\" class=\"mediacenter\" alt=\"\" width=\"470\" height=\"329\" /> <br/>\n\
<a href=\"http://www.irtec.com/ms-360.htm\" class=\"urlextern\" title=\"http://www.irtec.com/ms-360.htm\"  rel=\"nofollow\">Image from IR-TEC</a>  <br/>\n\
\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT5 SECTION \"Lenses\" [6296-9363] -->\n\
<h3 class=\"sectionedit6\"><a name=\"connecting_to_your_pir\" id=\"connecting_to_your_pir\">Connecting to your PIR</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Most PIR modules have a 3-pin connection at the side or bottom. The pinout may vary between modules so triple-check the pinout! It&#039;s often silkscreened on right next to the connection. One pin will be ground, another will be signal and the final one will be power. Power is usually 3-5VDC input but may be as high as 12V. Sometimes larger modules dont have direct output and instead just operate a relay in which case there is ground, power and the two switch connections. \n\
</p>\n\
\n\
<p>\n\
The output of some relays may be &#039;open collector&#039; - that means it requires a pullup resistor. If you&#039;re not getting a variable output be sure to try attaching a 10K pullup between the signal and power pins.\n\
</p>\n\
\n\
<p>\n\
An easy way of prototyping with PIR sensors is to connect it to a breadboard since the connection port is 0.1&quot; spacing. Some PIRs come with header on them already, the ones from Adafruit don&#039;t as usually the header is useless to plug into a breadboard. \n\
</p>\n\
\n\
<p>\n\
By soldering in 0.1&quot; right angle header, a PIR is easily installed into a breadboard!\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/pirbbback.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/pirbbback.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=f492eb&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirbbback_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" /></a> \n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/pirbbfront.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/pirbbfront.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e23296&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirbbfront_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" /></a> \n\
</p>\n\
\n\
<p>\n\
Most people want to position PIRs in a particular location and often times thats far from the other electronics, in which case wires will work just fine.\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/wiredpir.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/wiredpir.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=cdd983&amp;w=500&amp;h=293&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fwiredpir_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"293\" /></a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT6 SECTION \"Connecting to your PIR\" [9364-10991] -->\n\
<h3 class=\"sectionedit7\"><a name=\"testing_your_pir\" id=\"testing_your_pir\">Testing your PIR</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Once you have your PIR wired up its a good idea to do a simple test to verify that it works the way you expect. This test is also good for range testing. Simply connect 3-4 alkaline batteries (make sure you have more than 3.5VDC out but less than 6V by checking with your multimeter!) and connect <strong>ground</strong> to the - pin on your PIR. <strong>Power</strong> goes to the <strong>+</strong> pin. Then connect a basic red LED (red LEDs have lower forward voltages than green or blue so they work better with only the 3.3v output) and a 220Ω resistor (any value from 100Ω to 1.0KΩ will do fine) to the <strong>out</strong> pin as shown. Of course, the LED and resistor can swap locations as long as the LED is oriented connection and connects between <strong>out</strong> and <strong>ground</strong>\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=e8c1e8&amp;w=500&amp;h=292&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirtestsch.gif\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"292\" />\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=a97008&amp;w=600&amp;h=335&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirtestbb.gif\" class=\"mediacenter\" alt=\"\" width=\"600\" height=\"335\" />\n\
</p>\n\
\n\
<p>\n\
Now when the PIR detects motion, the output pin will go &quot;high&quot; to 3.3V and light up the LED!\n\
</p>\n\
\n\
<p>\n\
Once you have the breadboard wired up, insert batteries and wait 30-60 seconds for the PIR to &#039;stabilize&#039;. During that time the LED may blink a little. Wait until the LED is off and then move around in front of it, waving a hand, etc, to see the LED light up!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT7 SECTION \"Testing your PIR\" [10992-12274] -->\n\
<h3 class=\"sectionedit8\"><a name=\"retriggering\" id=\"retriggering\">Retriggering</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<a href=\"http://www.ladyada.net/images/sensors/pirback.jpg\" class=\"media\" title=\"http://www.ladyada.net/images/sensors/pirback.jpg\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=904525&amp;w=500&amp;h=350&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirback_t.jpg\" class=\"mediacenter\" alt=\"\" width=\"500\" height=\"350\" /></a> \n\
</p>\n\
\n\
<p>\n\
Once you have the LED blinking, look on the back of the PIR sensor and make sure that the jumper is placed in the <strong>L</strong> position as shown above.\n\
</p>\n\
\n\
<p>\n\
Now set up the testing board again. You may notice that when connecting up the PIR sensor as above, the LED does not stay on when moving in front of it but actually turns on and off every second or so. That is called &quot;non-retriggering&quot;.\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=c4ec55&amp;w=550&amp;h=230&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fnon-retriggerable.gif\" class=\"mediacenter\" alt=\"\" width=\"550\" height=\"230\" />\n\
</p>\n\
\n\
<p>\n\
Now change the jumper so that it is in the<strong> H </strong>position. If you set up the test, you will notice that now the LED <em>does</em> stay on the entire time that something is moving. That is called &quot;retriggering&quot;\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=68a81d&amp;w=550&amp;h=219&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fretriggerable.gif\" class=\"mediacenter\" alt=\"\" width=\"550\" height=\"219\" />\n\
</p>\n\
\n\
<p>\n\
(The graphs above are from the BISS0001 datasheet, they kinda suck)\n\
</p>\n\
\n\
<p>\n\
For most applications, &quot;retriggering&quot; (jumper in H position) mode is a little nicer. If you need to connect the sensor to something edge-triggered, you&#039;ll want to set it to &quot;non-retriggering&quot; (jumper in L position).\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT8 SECTION \"Retriggering\" [12275-13478] -->\n\
<h3 class=\"sectionedit9\"><a name=\"changing_pulse_time_and_timeout_length\" id=\"changing_pulse_time_and_timeout_length\">Changing pulse time and timeout length</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
There are two &#039;timeouts&#039; associated with the PIR sensor. One is the &quot;<strong>Tx</strong>&quot; timeout: how long the LED is lit after it detects movement. The second is the &quot;<strong>Ti</strong>&quot; timeout which is how long the LED is guaranteed to be off when there is no movement. These are not<em> easily</em> changed but if you&#039;re handy with a soldering iron it is within reason.\n\
</p>\n\
\n\
<p>\n\
First, lets take a look at the BISS datasheet again\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=85a6eb&amp;w=700&amp;h=92&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Ftitx.gif\" class=\"mediacenter\" alt=\"\" width=\"700\" height=\"92\" />\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=e5c06c&amp;w=650&amp;h=419&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirtitx.gif\" class=\"mediacenter\" alt=\"\" width=\"650\" height=\"419\" />\n\
</p>\n\
\n\
<p>\n\
Determining R10 and R9 isnt too tough. Unfortunately this PIR sensor is mislabeled (it looks like they swapped R9 R17). You can trace the pins by looking at the BISS001 datasheet and figuring out what pins they are - R10 connects to pin 3 and R9 connects to pin 7. the capacitors are a little tougher to determine, but you can &#039;reverse engineer&#039; them from timing the sensor and solving!\n\
</p>\n\
\n\
<p>\n\
For the sensor in the Adafruit shop:\n\
</p>\n\
\n\
<p>\n\
<strong>Tx is = 24576 * R10 * C6 = ~1.2 seconds</strong> <br/>\n\
<strong>R10 </strong>= 4.7K and <strong>C6</strong> = 10nF\n\
</p>\n\
\n\
<p>\n\
Likewise,\n\
</p>\n\
\n\
<p>\n\
<strong>Ti = 24 * R9 * C7 = ~1.2 seconds</strong> <br/>\n\
<strong>R9</strong> = 470K and<strong> C7</strong> = 0.1uF\n\
</p>\n\
\n\
<p>\n\
You can change the timing by swapping different resistors or capacitors. For a nice tutorial on this, see <a href=\"http://www.neufeld.newton.ks.us/electronics/?p=208\" class=\"urlextern\" title=\"http://www.neufeld.newton.ks.us/electronics/?p=208\"  rel=\"nofollow\">Keith&#039;s PIR hacking page</a> \n\
</p>\n\
\n\
</div>\n\
<!-- EDIT9 SECTION \"Changing pulse time and timeout length\" [13479-14861] -->\n\
<h3 class=\"sectionedit10\"><a name=\"project_examples\" id=\"project_examples\">Project examples</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/cofqYukXTow\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/cofqYukXTow\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
<em> A simple room greeter that plays the super mario brothers theme music when triggered by a PIR in a hacked airwick freshener unit.</em>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://jarv.org/mario.shtml\" class=\"media\" title=\"http://jarv.org/mario.shtml\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=7b7af6&amp;w=490&amp;h=397&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fmario.jpg\" class=\"mediacenter\" alt=\"\" width=\"490\" height=\"397\" /></a>  <br/>\n\
<em><a href=\"http://jarv.org/mario.shtml\" class=\"urlextern\" title=\"http://jarv.org/mario.shtml\"  rel=\"nofollow\">A USB-powered singing and blinking Mario mushroom (there&#039;s a video on the site!)</a> </em>\n\
</p>\n\
\n\
<p>\n\
<a href=\"http://coopy.sproutlab.com/projects/rain-umbrellas/\" class=\"media\" title=\"http://coopy.sproutlab.com/projects/rain-umbrellas/\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=e57100&amp;w=400&amp;h=490&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fumbrella-prototype-1.jpg\" class=\"mediacenter\" alt=\"\" width=\"400\" height=\"490\" /></a> <div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/6PsnVZ3QstM\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/6PsnVZ3QstM\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div><br/>\n\
<a href=\"http://coopy.sproutlab.com/projects/rain-umbrellas/\" class=\"urlextern\" title=\"http://coopy.sproutlab.com/projects/rain-umbrellas/\"  rel=\"nofollow\">Rain Umbrellas</a> \n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/9D52JIMADD0\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/9D52JIMADD0\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
<em> Testing a PIR sensor for interfacing to Max/MSP for an interactive garden</em>\n\
</p>\n\
\n\
<p>\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/9zIluzWJQPs\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/9zIluzWJQPs\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
A home-made security system using PIR sensors (which is built into a Start Trek panel!)<em>\n\
\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/5N7XX-420Rk\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/5N7XX-420Rk\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
</em>PIR sensor + Arduino + Servo = automatic cat door!<em>\n\
\n\
<a href=\"http://luckylarry.co.uk/2009/07/arduino-very-basic-motion-tracking-with-2-pir-sensors/\" class=\"media\" title=\"http://luckylarry.co.uk/2009/07/arduino-very-basic-motion-tracking-with-2-pir-sensors/\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=d1b672&amp;w=604&amp;h=453&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2FArduino-2PIR-motion-tracker.jpg\" class=\"mediacenter\" alt=\"\" width=\"604\" height=\"453\" /></a>  <br/>\n\
<a href=\"http://luckylarry.co.uk/2009/07/arduino-very-basic-motion-tracking-with-2-pir-sensors/\" class=\"urlextern\" title=\"http://luckylarry.co.uk/2009/07/arduino-very-basic-motion-tracking-with-2-pir-sensors/\"  rel=\"nofollow\">A 2-PIR motion tracker</a> </em> by Lucky Larry<em>\n\
\n\
<a href=\"http://luckylarry.co.uk/2009/07/arduino-motion-triggered-camera/\" class=\"media\" title=\"http://luckylarry.co.uk/2009/07/arduino-motion-triggered-camera/\"  rel=\"nofollow\"><img src=\"/wiki/lib/exe/fetch.php?hash=30fe15&amp;media=http%3A%2F%2Ffarm3.static.flickr.com%2F2369%2F3740684758_a97d1a1bee_m.jpg\" class=\"mediacenter\" title=\"3740684758_a97d1a1bee_m.jpg\" alt=\"3740684758_a97d1a1bee_m.jpg\" /></a> \n\
 <a href=\"http://luckylarry.co.uk/2009/07/arduino-motion-triggered-camera/\" class=\"urlextern\" title=\"http://luckylarry.co.uk/2009/07/arduino-motion-triggered-camera/\"  rel=\"nofollow\">A PIR-based remote camera trigger (also by Lucky Larry!)</a>  <br/>\n\
\n\
\n\
<div class=\"vshare__center\"><!--[if !IE]> -->\n\
<object width=\"425\" height=\"350\" type=\"application/x-shockwave-flash\" data=\"http://www.youtube.com/v/dGOgCnlizgU\">\n\
<!-- <![endif]-->\n\
<!--[if IE]>\n\
<object width=\"425\" height=\"350\" classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">\n\
    <param name=\"movie\" value=\"http://www.youtube.com/v/dGOgCnlizgU\" />\n\
<!--><!-- -->\n\
  <param name=\"FlashVars\" value=\"\" />\n\
The <a href=\"http://www.adobe.com/products/flashplayer/\">Adobe Flash Plugin</a>  is needed to display this content.\n\
</object>\n\
<!-- <![endif]-->\n\
</div>\n\
</em>An interesting hack whereby the PIR sensor is used &#039;raw&#039; to track movement\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT10 SECTION \"Project examples\" [14862-16521] -->\n\
<h3 class=\"sectionedit11\"><a name=\"reading_pir_sensors\" id=\"reading_pir_sensors\">Reading PIR sensors</a> </h3>\n\
<div class=\"level3\">\n\
\n\
<p>\n\
Connecting PIR sensors to a microcontroller is really simple. The PIR acts as a digital output so all you need to do is listen for the pin to flip high (detected) or low (not detected).\n\
</p>\n\
\n\
<p>\n\
Its likely that you&#039;ll want reriggering, so be sure to put the jumper in the <strong>H</strong> position!\n\
</p>\n\
\n\
<p>\n\
Power the PIR with 5V and connect ground to ground. Then connect the output to a digital pin. In this example we&#039;ll use pin 2.\n\
</p>\n\
\n\
<p>\n\
<img src=\"/wiki/lib/exe/fetch.php?hash=018335&amp;w=600&amp;h=356&amp;media=http%3A%2F%2Fwww.ladyada.net%2Fimages%2Fsensors%2Fpirardbb.gif\" class=\"mediacenter\" alt=\"\" width=\"600\" height=\"356\" />\n\
</p>\n\
\n\
<p>\n\
The code is very simple, and is basically just keeps track of whether the input to pin 2 is high or low. It also tracks the <em>state</em> of the pin, so that it prints out a message when motion has started and stopped.\n\
</p>\n\
<pre class=\"code C\">&nbsp;\n\
<span class=\"coMULTI\">/*\n\
 * PIR sensor tester\n\
 */</span>\n\
&nbsp;\n\
<span class=\"kw4\">int</span> ledPin <span class=\"sy0\">=</span> <span class=\"nu0\">13</span><span class=\"sy0\">;</span>                <span class=\"co1\">// choose the pin for the LED</span>\n\
<span class=\"kw4\">int</span> inputPin <span class=\"sy0\">=</span> <span class=\"nu0\">2</span><span class=\"sy0\">;</span>               <span class=\"co1\">// choose the input pin (for PIR sensor)</span>\n\
<span class=\"kw4\">int</span> pirState <span class=\"sy0\">=</span> LOW<span class=\"sy0\">;</span>             <span class=\"co1\">// we start, assuming no motion detected</span>\n\
<span class=\"kw4\">int</span> val <span class=\"sy0\">=</span> <span class=\"nu0\">0</span><span class=\"sy0\">;</span>                    <span class=\"co1\">// variable for reading the pin status</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> setup<span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
  pinMode<span class=\"br0\">&#40;</span>ledPin<span class=\"sy0\">,</span> OUTPUT<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>      <span class=\"co1\">// declare LED as output</span>\n\
  pinMode<span class=\"br0\">&#40;</span>inputPin<span class=\"sy0\">,</span> INPUT<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>     <span class=\"co1\">// declare sensor as input</span>\n\
&nbsp;\n\
  Serial.<span class=\"me1\">begin</span><span class=\"br0\">&#40;</span><span class=\"nu0\">9600</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
<span class=\"br0\">&#125;</span>\n\
&nbsp;\n\
<span class=\"kw4\">void</span> loop<span class=\"br0\">&#40;</span><span class=\"br0\">&#41;</span><span class=\"br0\">&#123;</span>\n\
  val <span class=\"sy0\">=</span> digitalRead<span class=\"br0\">&#40;</span>inputPin<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>  <span class=\"co1\">// read input value</span>\n\
  <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>val <span class=\"sy0\">==</span> HIGH<span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>            <span class=\"co1\">// check if the input is HIGH</span>\n\
    digitalWrite<span class=\"br0\">&#40;</span>ledPin<span class=\"sy0\">,</span> HIGH<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>  <span class=\"co1\">// turn LED ON</span>\n\
    <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>pirState <span class=\"sy0\">==</span> LOW<span class=\"br0\">&#41;</span> <span class=\"br0\">&#123;</span>\n\
      <span class=\"co1\">// we have just turned on</span>\n\
      Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;Motion detected!&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
      <span class=\"co1\">// We only want to print on the output change, not state</span>\n\
      pirState <span class=\"sy0\">=</span> HIGH<span class=\"sy0\">;</span>\n\
    <span class=\"br0\">&#125;</span>\n\
  <span class=\"br0\">&#125;</span> <span class=\"kw1\">else</span> <span class=\"br0\">&#123;</span>\n\
    digitalWrite<span class=\"br0\">&#40;</span>ledPin<span class=\"sy0\">,</span> LOW<span class=\"br0\">&#41;</span><span class=\"sy0\">;</span> <span class=\"co1\">// turn LED OFF</span>\n\
    <span class=\"kw1\">if</span> <span class=\"br0\">&#40;</span>pirState <span class=\"sy0\">==</span> HIGH<span class=\"br0\">&#41;</span><span class=\"br0\">&#123;</span>\n\
      <span class=\"co1\">// we have just turned of</span>\n\
      Serial.<span class=\"me1\">println</span><span class=\"br0\">&#40;</span><span class=\"st0\">&quot;Motion ended!&quot;</span><span class=\"br0\">&#41;</span><span class=\"sy0\">;</span>\n\
      <span class=\"co1\">// We only want to print on the output change, not state</span>\n\
      pirState <span class=\"sy0\">=</span> LOW<span class=\"sy0\">;</span>\n\
    <span class=\"br0\">&#125;</span>\n\
  <span class=\"br0\">&#125;</span>\n\
<span class=\"br0\">&#125;</span></pre>\n\
\n\
<p>\n\
Don&#039;t forget that there are some times when you don&#039;t need a microcontroller. A PIR sensor can be connected to a relay (perhaps with a transistor buffer) without a micro!\n\
</p>\n\
\n\
</div>\n\
<!-- EDIT11 SECTION \"Reading PIR sensors\" [16522-] -->";document.write(zoomy);document.write("<hr /><br /><em>This page was autogenerated from <a href=\"http://www.ladyada.net/wiki/tutorials/learn/sensors/pir.html\" target=\"_blank\">http://www.ladyada.net/wiki/tutorials/learn/sensors/pir.html</a> <br />Please edit the wiki to contribute any updates or corrections.</em>")