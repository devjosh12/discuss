<?php if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start(); ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
<meta name="google-site-verification" content="b8llfHGWLTvS2_5i-DyLetoYBRmeiji56n1BjF6hDy4" />
<!--
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Bitter:400,400italic,700:latin' ] }
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
-->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29060650-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

   <?php $this->RenderAsset('Head'); ?>
<?php /******** CODE FOR NEWS FEEDS ************
//assign file name
$feedLocalFile = "pibFeeds.xml";
//time limit for cache
$cacheLimits = 30;
if (!file_exists($feedLocalFile) || ((time()-filemtime($feedLocalFile))/60 >30)) {
// create a new curl resource
$ch = curl_init();
// set URL and other appropriate options
//pib URL http://pib.nic.in/newsite/rssenglish.aspx
// DD News URL http://www.ddinews.gov.in/rssCMS/
// Hindu Interntional News URL http://www.thehindu.com/news/international/?service=rss
//hindu stories http://www.thehindu.com/?service=rss
curl_setopt($ch, CURLOPT_URL, "http://pib.nic.in/newsite/rssenglish.aspx");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// grab URL, and return output
$output = curl_exec($ch);
// this is the magic bit
$fp = fopen($feedLocalFile, "w");
fwrite($fp,$output);
//close file
fclose($fp);
// close curl resource, and free up system resources
curl_close($ch);
} ******* CODE ENDS HERE ********  */
?>
<meta name="Description" Content="UPSC preparation community forum with tips from toppers from various cadres about civil services prelims , mains and upsc interview for final selection as ias, ips, ifs">
<META Name="keywords" Content="UPSC, IAS, preparation, prelims, cut off, Mains, 2012, Selection, Optionals, Pub Ad, GS, philosophy, socio, Vajiram Ravi, Synergy, Mohanty, CSAT">
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
<SCRIPT>
$(document).ready(function() {

	var div = $('#Head');
	var start = $(div).offset().top;
	$(div).css('z-index','1030');

	$.event.add(window, "scroll", function() {
		var p = $(window).scrollTop();
		$(div).css('position',((p)>start) ? 'fixed' : 'static');
		$(div).css('top',((p)>start) ? '0px' : '');
	});

});
</SCRIPT>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=345229432166669";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

   <div id="Frame">
      <div id="Head">
      	<h1><a class="Title" href="<?php echo Url('/'); ?>"><span><?php echo Gdn_Theme::Logo(); ?></span></a></h1>
         <div class="Menu">
         <!--   <h1><a class="Title" href="<?php echo Url('/'); ?>"><span><?php echo Gdn_Theme::Logo(); ?></span></a></h1> -->
            <?php
			      $Session = Gdn::Session();
					if ($this->Menu) {
						$this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
						// added by Ayush to activate Rajya Sabha TV
						// $this->Menu->AddLink('TV', T('Budget Speech'), '/plugin/page/default.php');
						//ends here
					       // $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'));
					//commenting to remove Activity by Ayush
					//	$this->Menu->AddLink('Activity', T('Wall'), '/activity');
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
         </div>
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