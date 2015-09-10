<!DOCTYPE html>
<html lang="en">
<head>
	{asset name='Head'}
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	
	<!-- LESS CSS and Prettify
	================================================== -->
 	
 	<link rel="stylesheet/less" type="text/css" href="/themes/VanillaBootstrap/design/less/main.less">
 	<link rel="stylesheet" type="text/css" href="/themes/VanillaBootstrap/design/prettify/prettify.css">
	
	<!-- Javascript
	================================================== -->
	
	<script type="text/javascript" src="/themes/VanillaBootstrap/js/bootstrap.less.js"></script>
	<script type="text/javascript" src="/themes/VanillaBootstrap/js/bootstrap.main.js"></script>
	<!-- @neyawn autosize called off to restore the text area size
	<script type="text/javascript" src="/themes/VanillaBootstrap/js/plugin.autosize.js"></script>
	-->
	<script type="text/javascript" src="/themes/VanillaBootstrap/js/vanilla.main.js"></script>
	
	<!-- Google Prettify
	================================================== -->
	
	<script type="text/javascript" src="/themes/VanillaBootstrap/design/prettify/prettify.js"></script>
	<!-- TEST Code for fb -->
	
	<!--  END -->
	
</head>
<body id="{$BodyID}" class="{$BodyClass}" onload="prettyPrint()">
	
	<!-- Navbar
	================================================== -->

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</a>
				<a class="brand" href="{link path="/"}">{logo}</a>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="DiscussionsLink"><a href="{link path="/discussions"}"><i class="icon-comments"></i> Discussions</a></li>
						<li class="ActivityLink"><a href="{link path="/activity"}"><i class="icon-th icon-white"></i> People</a></li>
						{if $User.SignedIn}	
						<li>
							<a href="{link path="messages/inbox"}"><i class="icon-inbox"></i> Inbox
							{if $User.CountUnreadConversations} <span>{$User.CountUnreadConversations}</span>{/if}</a>
						</li>
						<li>
							<a href="{link path="/profile/notifications"}"><i class="icon-info-sign"></i>Notifications</a>
						</li>
						
						{/if}
						{custom_menu}
					</ul>
					
					<ul class="nav pull-right">
						{if $User.SignedIn}						
						<li class="divider-vertical"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle signOut" data-toggle="dropdown"><i class="icon-user"></i> {$User.Name}
							{if $User.CountNotifications} <span>{$User.CountNotifications}</span>{/if} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li class="nav-header">Welcome!</li>
								<li>
									<a href="{link path="profile"}">Profile
									{if $User.CountNotifications} <span>{$User.CountNotifications}</span>{/if}</a>
								</li>
								{if CheckPermission('Garden.Settings.Manage')}
									<li><a href="{link path="dashboard/settings"}">Dashboard</a></li>
								{/if}
								<li class="divider"></li>
								<li>
									{link path="signinout"}
								</li>
							</ul>
						</li>
						{/if}
						{if !$User.SignedIn}						
				<!--		<li>
							<a href="{link path="/entry/signin"}"> 
								<i class="icon-edit"></i> <b>Login with your Google/FB Account</b>
							</a>
						</li>  -->
						<li class="divider-vertical"></li>
						<li><!-- @neyawn hardcoded  /?Traget -->
							<a href="{link path="/entry/signin?Target=discussions"}" class="SignInPopup">Login with  Google/FB Account							<i class="icon-signin"></i> <b>Sign in</b>
							</a>
						</li>
						{/if}
					</ul>
				</div>
			</div>
		</div>
	</div>		

	<!-- Container
	================================================== -->

    <!-- Code ends @neyawn -->	
	
	    <div class="row-fluid">		
			<div class="Content span8">
				{asset name="Content"}
			</div>
			<div class="Panel span4">
			        
				<div class="Box BoxSearch">{searchbox}</div>
				{asset name="Panel"}
				<div class="credits well">
					Powered by <a targt="_blank" href="http://lmgtfy.com/?q=html+5">HTML 5</a>
					
					<!-- Feel free to delete my name from the list, but please keep both the Vanilla and Bootstrap notices -->
				</div>
				
			</div>
		</div>
		
		{asset name="Foot"}
		
	</div>
	<!-- @neyawn Foter Code -->
	<div class="Content span 12">
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
Hits and still counting
    
     
    </div>

   </div>
	
	<!-- @neyawn Footer Code Ends -->
	
	
</body>
</html>