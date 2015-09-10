<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
   <?php $this->RenderAsset('Head'); ?>
<script type="text/javascript" src="<?php echo Url('/'); ?>themes/Essence/js/styleswitcher.js"></script>
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/blue.css" title="blue"/>
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/green.css" title="green"/>
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/red.css" title="red"/>
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
   <div id="Frame">
      <div id="Head">
      	<ul class="colorchanger">
      		<li><a class="blue" href="#" onclick="setActiveStyleSheet('blue'); return false;"></a></li>
			<li><a class="green" href="#" onclick="setActiveStyleSheet('green'); return false;"></a></li>
			<li><a class="red" href="#" onclick="setActiveStyleSheet('red'); return false;"></a></li>
		</ul>
      	<div class="wrapper"><div class="logo"><a href="<?php echo Url('/'); ?>"><?php echo Gdn_Theme::Logo(); ?></a></div></div>
      	<div id="scrollingHead" class="menuwrapper">
         <div class="Menu">
            <?php
			      $Session = Gdn::Session();
					if ($this->Menu) {
						$this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
						// $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'));
						$this->Menu->AddLink('Activity', T('Activity'), '/activity');
						if ($Session->IsValid()) {
							$Name = $Session->User->Name;
							$CountNotifications = $Session->User->CountNotifications;
							if (is_numeric($CountNotifications) && $CountNotifications > 0)
								$Name .= ' <span class="Alert">'.$CountNotifications.'</span>';

                     if (urlencode($Session->User->Name) == $Session->User->Name)
                        $ProfileSlug = $Session->User->Name;
                     else
                        $ProfileSlug = $Session->UserID.'/'.urlencode($Session->User->Name);
							$this->Menu->AddLink('User', $Name, '/profile/'.$ProfileSlug, array('Garden.SignIn.Allow'), array('class' => 'UserNotifications'));
							$this->Menu->AddLink('SignOut', T('Sign Out'), SignOutUrl(), FALSE, array('class' => 'NonTab SignOut'));
						} else {
							$Attribs = array();
							if (SignInPopup() && strpos(Gdn::Request()->Url(), 'entry') === FALSE)
								$Attribs['class'] = 'SignInPopup';
								
							$this->Menu->AddLink('Entry', T('Sign In'), SignInUrl($this->SelfUrl), FALSE, array('class' => 'NonTab'), $Attribs);
						}
						echo $this->Menu->ToString();
					}
				?>
            <div class="Search"><?php
					$Form = Gdn::Factory('Form');
					$Form->InputPrefix = '';
					echo 
						$Form->Open(array('action' => Url('/search'), 'method' => 'get')),
						$Form->TextBox('Search'),
						$Form->Button('Go', array('Name' => '')),
						$Form->Close();
				?></div>
         </div></div>
      </div>
      <div id="Body">
         <div id="Content"><?php $this->RenderAsset('Content'); ?></div>
         <div id="Panel"><?php $this->RenderAsset('Panel'); ?></div>
      </div>
      <div id="Foot">
			<?php
				$this->RenderAsset('Foot');
				echo Wrap(Anchor(T('&copy; ForumIAS.com Beta'), C('http://forumias.com')), 'div');
			?>
	<div id="statCounter">
	<script>var _wau = _wau || []; _wau.push(["tab", "hsj5jrrn0ntk", "fst", "left-middle"]);(function() { var s=document.createElement("script"); s.async=true; s.src="http://widgets.amung.us/tab.js";document.getElementsByTagName("head")[0].appendChild(s);})();</script>
	</div>
    <div id="themeCredit" align:"centre"> 
    <a href="http://forumIAS.com">Home</a>
    |
    Opinions belong to Individual Users
    |
    <a href="/discussion/381/rules-of-posting-in-the-forum-best-practice">Posting Rules</a>
    |
    <a href="mailto:forumias@gmail.com">Contact</a>
    |
    <!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=8059749; 
var sc_invisible=0; 
var sc_security="5b9d77dc"; 
var sc_text=2; 
</script>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<SCRIPT>
$(document).ready(function() {

	var div = $('#scrollingHead');
	var start = $(div).offset().top;
	$(div).css('z-index','1030');

	$.event.add(window, "scroll", function() {
		var p = $(window).scrollTop();
		$(div).css('position',((p)>start) ? 'fixed' : 'static');
		$(div).css('top',((p)>start) ? '0px' : '');
	});

});
</script>

<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script>
<noscript><div class="statcounter"><a title="web counter"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/8059749/0/5b9d77dc/0/"
alt="web counter"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
<?php echo "Hits" ?>
<script type="text/javascript" src="jquery.js"></script>
<script language="javascript">$(document).ready(function () {
	createTicker();
});

function createTicker(){
	//set the quotes array
	tickerItems = new Array(
	'"There are no great men, only great challenges that ordinary men are forced by circumstances to meet."<br/><b>William F. Halsey</b>',
	'"Man is only truly great when he acts from his passions."<br/><b>Benjamin Disreali</b>',
	'"The price of greatness is responsibility."<br/><b>Winston Churchill</b>',
	'"To achieve great things we must live as if we were never going to die."<br/><b>Marquis de Vauvenargues</b>'
	);
	i = 0;
	tickerIt();
}

function tickerIt(){
	if( i == tickerItems.length ){
		i = 0;
	}
	//change without effect
	//$('#ticker').html(tickerItems[i]);

	//change with effect
	$('#ticker').fadeOut("slow", function(){
		$(this).html(tickerItems[i]).fadeIn("slow");
		i++;
	});

	//repeat
	setTimeout("tickerIt()", 5000);
}
</script>
    
     
    </div>

   </div>
	<?php $this->FireEvent('AfterBody'); ?>
</body>
</html>
