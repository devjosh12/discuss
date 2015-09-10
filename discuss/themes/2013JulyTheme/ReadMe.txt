Essence is a clean Vanilla theme. It features a color switcher, with three colors to choose from by default, modern CSS3 effects such as transitions, and it's super fast.

By Luke Harris. http://lucasbytegeni.us

== Uploading ==

Upload the folder Essence to Vanilla folder/themes/. For example, if your forum is located at http://domain.com/vanilla/, upload the folder to /vanilla/themes/.

Upload the js folder to your forum root. This is necessary for the color changer.

You can then install it from the Vanilla Dashboard under the Themes area.

== Changing the default color ==

If you'd like to set a color as the default, open up /themes/Essence/design/styles.css, and find this line (near the top): @import url(blue.css);
Change the word "blue" to the name of another stylesheet. By default there's blue, red, and green.

When you're done editing, save your changes.

== Adding colors ==

If you wish to add some colors, make a copy of any of the color CSS files, such as blue.css, and rename that copy to something else. You can then edit the colors for each element there.

After you're done editing the stylesheet, open up /themes/Essence/views/default.master.php, and find this line:
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/red.css" title="red"/>

Add below:

<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/color.css" title="color"/>

Replace "color" with the name of the stylehsheet.

Then find this line: 
<li><a class="red" href="#" onclick="setActiveStyleSheet('red'); return false;"></a></li>

Add below:
<li><a class="color" href="#" onclick="setActiveStyleSheet('color'); return false;"></a></li>

Replace "color" with the name of the stylesheet.

Then open up style.css and find this line:
.red {
background: #D13131;
}

Add below:
.color {
background: #00000;
}

Replace "color" with the name of your stylesheet. Replace "#00000" with the hex or rgb color used in your stylesheet.

Done!

== Support ==

If you have any problems let me know. I can reached via email at lucasbytegenius@gmail.com