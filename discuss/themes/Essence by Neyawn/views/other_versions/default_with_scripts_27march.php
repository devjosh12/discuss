<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
   <?php $this->RenderAsset('Head'); ?>

<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/blue.css" title="blue"/>
<link rel="stylesheet" href="<?php echo Url('/'); ?>themes/Essence by Neyawn/design/buttons.css"/>
<meta name="Description" Content="Knowledge Sharing network for UPSC Civil Services Preparation with tips from toppers from various cadres about civil services prelims , mains and upsc interview for final selection as ias, ips, ifs, irts">
<META Name="keywords" Content="pattern change, UPSC, IAS, preparation, prelims, cut off, Mains, 2013, Selection, Optionals, Pub Ad, GS, philosophy, socio, Vajiram Ravi, Synergy, Mohanty, CSAT">
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
<?php include_once("analyticstracking.php") ?>
   <div id="Frame">
      <div id="Head">
      	
      	<div class="wrapper"><div class="logo" width="60%"><a href="<?php echo Url('/'); ?>"><?php echo Gdn_Theme::Logo(); ?></a></div></div>
      	<div id="scrollerHead" class="menuwrapper">
         <div class="Menu">
            <?php
			      $Session = Gdn::Session();
					if ($this->Menu) {
						$this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
						// $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'));
						$this->Menu->AddLink('Activity', T('Timeline'), '/activity');
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
<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>
<script type="text/javascript">
var sc_project=8059749; 
var sc_invisible=0; 
var sc_security="5b9d77dc"; 
var sc_text=2; 
</script>
<SCRIPT>
$(document).ready(function() {

	var div = $('#scrollerHead');
	var start = $(div).offset().top;
	$(div).css('z-index','1030');

	$.event.add(window, "scroll", function() {
		var p = $(window).scrollTop();
		$(div).css('position',((p)>start) ? 'fixed' : 'static');
		$(div).css('top',((p)>start) ? '0px' : '');
	});

});
</SCRIPT>
<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script>
<noscript><div class="statcounter"><a title="web counter"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/8059749/0/5b9d77dc/0/"
alt="web counter"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
<?php echo "Hits" ?>
    
     
    </div>

   </div>
	<?php $this->FireEvent('AfterBody'); ?>
</body>
</html>
