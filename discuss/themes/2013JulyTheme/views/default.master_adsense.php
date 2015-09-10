<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="/themes/2013JulyTheme/design/images/favicon.png">
   <?php $this->RenderAsset('Head'); ?>
<link rel="stylesheet" href="<?php echo Url('/'); ?>themes/2013JulyTheme/design/buttons.css"/>
<meta name="Description" Content="Knowledge Sharing network for UPSC Civil Services Preparation with tips from toppers from various cadres about civil services prelims , mains and upsc interview for final selection as ias, ips, ifs, irts">
<META Name="keywords" Content="pattern change, UPSC, IAS, preparation, prelims, cut off, Mains, 2013, Selection, Optionals, Pub Ad, GS, philosophy, socio, Vajiram Ravi, Synergy, Mohanty, CSAT">
<link rel="stylesheet" type="text/css" href="/engine11/style.css" />
<script type="text/javascript" src="engine11/jquery.js"></script>
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
<!-- AddThis Welcome BEGIN -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52551d964d3f9719"></script>
<script type='text/javascript'>
addthis.bar.initialize({'default':{"backgroundColor":"#FF0000","buttonColor":"#098DF4","textColor":"#fff","buttonTextColor":"#FFFFFF","hideAfter":30},rules:[{"name":"AnyOther","message":"Appearing for Prelims 2014? Join ForumIAS+ Online Test Series. Compete with the Best","action":{"type":"button","text":"CLICK HERE","verb":"link","url":"http://prelims.forumias.com"}},{"name":"Twitter","match":{"referringService":"twitter"},"message":"Appearing for Prelims 2014? Join ForumIAS+ Online Test Series. Compete with the Best","action":{"type":"button","text":"Learn more","verb":"link","url":"http://prelims.forumias.com"}},{"name":"Facebook","match":{"referringService":"facebook"},"message":"Appearing for Prelims 2014? Join ForumIAS+ Online Test Series. Compete with the Best","action":{"type":"button","text":"Learn more","verb":"link","url":"http://prelims.forumias.com"}},{"name":"Google","match":{"referrer":"google.com"},"message":"Appearing for Prelims 2014? Join ForumIAS+ Online Test Series. Compete with the Best","action":{"type":"button","text":"Learn More","verb":"link","url":"http://prelims.forumias.com"}}]});
</script>
<!-- AddThis Welcome END -->
<?php include_once("analyticstracking.php") ?>
   <div id="Frame">
      <div id="Head"> 				
      	<div class="wrapper"><div class="logo" width="20%"><a href="<?php echo Url('/'); ?>"><?php echo Gdn_Theme::Logo(); ?></a>
     
      	<div style="float:right; margin-top:-5px;">
      	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Top Banner Discussiona Page 728x90 - 1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-1140293958287456"
     data-ad-slot="9143405904"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
      	</div>
      	
      	
      	</div></div>
      	<div id="scrollerHead" class="menuwrapper">
         <div class="Menu">
            <?php
			     
$Session = Gdn::Session();
					if ($this->Menu) {
						$this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
						// $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'));
						// $this->Menu->AddLink('Activity', T('Timeline'), '/activity');
						
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
$this->Menu->Addlink('Home',T('My•ForumIAS'),'http://my.forumias.com/');	 					
 //$this->Menu->Addlink('Home',T('Test Series'),'http://prelims.forumias.com/');
echo $this->Menu->ToString();
					}
				?>
				
				
           
         </div></div>
      </div>
      <div id="Body">
         <div id="Content"><?php $this->RenderAsset('Content'); ?></div>
         <div id="Panel">
         <div id="Gsearch">
<script>
  (function() {
    var cx = '003139128122751677825:tfiuwrogjao';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>	</div>
         <?php $this->RenderAsset('Panel'); ?></div>
      </div>
      <div id="Foot">
			<?php
				$this->RenderAsset('Foot');
				echo Wrap(Anchor(T('&copy; ForumIAS.com Beta'), C('http://forumias.com')), 'div');
			?>
	
    <div id="themeCredit" align:"centre"> 
    <a href="http://forumIAS.com">Home</a>
    |
    Opinions belong to Individual Users
    |
    <a href="/discussion/381/rules-of-posting-in-the-forum-best-practice">Posting Rules</a>
    |
    <a href="mailto:forumias@gmail.com">Send us an email</a>
    |
    <a href="/gyan/prelims-book-list">Prelims 2014 Book List</a>
    |
    <a href="/categories/current-affairs">Current Affairs</a>
    | 
    <a href="/categories/pub-ad">Public Administration</a>
    |
    <a href="/categories/economics">Economy</a>
    | 
    <a href="/categories/polity">Polity</a>
    |
    <a href="/categories/environment">Environment</a>
    | 
    <a href="/categories/essay">Essay</a>
    |
    <a href="/categories/international">International Relations</a>
    |
    <a href="/categories/interview-preparation">Interview Preparation</a>
    |
<a href="http://prelims.forumias.com">ForumIAS+ Online Test Series</a>
    |
    <a href="/discussion/1306/terms-conditions-privacy-policy-and-disclaimer#Item_1">Terms & Conditions, Disclaimer, Privacy Policy</a>
    |
<a href="http://prelims.forumias.com/terms-condition">Terms & Condition of ForumIAS+ Test Series</a>
    |
<a href="http://prelims.forumias.com/refund-rules">ForumIAS+ Refund Rules</a>
    |
<a href="http://prelims.forumias.com/about-us">About Us</a>
    |

    <a href="https://docs.google.com/forms/d/1yZ3N3mqhPeap6pQV3RmVQFg2rPJ5qMXmRcOdUDbBii4/viewform"><b>Work With Us</b></a>
    |
    <a href="http://prelims.forumias.com/contact-us" target="_blank">Contact Us</a>
   <a href="https://plus.google.com/116289206238952936348?rel=author">|</a>
    <a href="https://docs.google.com/forms/d/1TdmEYhLI9CBy4nej57fi6HeppBiQV_2VjxO_3Q4PFsM/viewform" target="_blank">Send us a message</a>
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
     
    </div>

   </div>
	<?php $this->FireEvent('AfterBody'); ?>

</body>
</html>