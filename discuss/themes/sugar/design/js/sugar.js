/* On load
 ------------------------------------------------------------ */
if(jQuery) {
	$(function() {
	// add IE fixes
		if($.browser.msie && $.browser.version <= 7) {
			fixIE7();
		}
		
	});		
}

/* Functions
 ------------------------------------------------------------ */
// Fix IE7
function fixIE7() {
	$("body #Head h1").css({"zoom":"1", "display":"inline"});
	$("ul.DataList .Options, ul.MessageList .Options").addClass("ie7");	
}