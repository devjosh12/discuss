<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhteme/views/default.master.phpml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="/themes/2013JulyTheme/design/images/favicon.png">
   <?php $this->RenderAsset('Head'); ?>
<meta name="description" content="Knowledge Sharing network for UPSC, IAS Preparation, IAS prelims, IAS mains, IAS Interview, IPS Topper, IAS topper interview, IAS Test Series, IAS Coaching, IAS Notes, IAS Books, IAS CSAT Preparation">
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Roboto:400,400italic,500,500italic,700,700italic:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
   <div id="Frame">
      <div id="Head"> 				
      	<div class="wrapper"><div class="logo"><a href="<?php echo Url('/'); ?>"><?php echo Gdn_Theme::Logo(); ?></a>

      	</div>
      	</div></div>
      	<div id="scrollerHead" class="menuwrapper">
<img style="float:left;padding-top:8px;margin:0px 30px 0px 90px;" src="http://i.imgur.com/PMEdOhG.png">
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
//$this->Menu->Addlink('Home',T('My•ForumIAS'),'http://my.forumias.com/');	 					
 //$this->Menu->Addlink('Home',T('<b>Interview 2015</b>'),'http://is.gd/int_f');
echo $this->Menu->ToString();
					}
				?>
				
				
           
         </div></div>
      </div>
      <div id="Body">
         <div id="Content"><?php $this->RenderAsset('Content'); ?></div>
         <div id="Panel">
         
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
    | <a href="https://sales.forumias.com" target="_blank"><b>Advertise With Us</b></a>
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

<script type="text/javascript">
var clicky_site_ids = clicky_site_ids || [];
clicky_site_ids.push(100787357);
(function() {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  s.async = true;
  s.src = '//static.getclicky.com/js';
  ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild( s );
})();
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-29060650-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
