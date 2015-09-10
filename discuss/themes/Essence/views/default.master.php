<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
   <?php $this->RenderAsset('Head'); ?>
<script type="text/javascript" src="<?php echo Url('/'); ?>themes/Essence/js/styleswitcher.js"></script>
<script type="text/javascript" src="<?php echo Url('/'); ?>themes/Essence/js/quote-ticker.js"></script>
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/blue.css" title="blue"/>
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/green.css" title="green"/>
<link rel="alternate stylesheet" href="<?php echo Url('/'); ?>themes/Essence/design/red.css" title="red"/>
<meta name="Description" Content="Knowledge Sharing network for UPSC Civil Services Preparation with tips from toppers from various cadres about civil services prelims , mains and upsc interview for final selection as ias, ips, ifs, irts">
<META Name="keywords" Content="pattern change, UPSC, IAS, preparation, prelims, cut off, Mains, 2013, Selection, Optionals, Pub Ad, GS, philosophy, socio, Vajiram Ravi, Synergy, Mohanty, CSAT">
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
<?php include_once("analyticstracking.php") ?>
   <div id="Frame">
      <div id="Head">
      	<ul class="colorchanger">
      		<li><a class="blue" href="#" onclick="setActiveStyleSheet('blue'); return false;"></a></li>
			<li><a class="green" href="#" onclick="setActiveStyleSheet('green'); return false;"></a></li>
			<li><a class="red" href="#" onclick="setActiveStyleSheet('red'); return false;"></a></li>
		</ul>
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
			?>  
			<script type=text/javascript>  
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
second last div
    </div>
last div
   </div>
	<?php $this->FireEvent('AfterBody'); ?>
</body>
</html>
