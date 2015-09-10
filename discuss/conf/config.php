<?php if (!defined('APPLICATION')) exit();

// Cache
$Configuration['Cache']['Enabled'] = TRUE;
$Configuration['Cache']['Method'] = 'memcache';

// Database
$Configuration['Database']['Name'] = 'discuss';
$Configuration['Database']['Host'] = 'localhost';
$Configuration['Database']['User'] = 'forumias_user';
$Configuration['Database']['Password'] = 'gs6t670kn082';
$Configuration['Debug'] = FALSE;

// DiscussionExcerpt2
$Configuration['DiscussionExcerpt2']['Number_of_words'] = '0';
$Configuration['DiscussionExcerpt2']['Show_announcements'] = FALSE;
$Configuration['DiscussionExcerpt2']['Show_images'] = FALSE;

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['CustomPages'] = TRUE;
$Configuration['EnabledPlugins']['Pockets'] = TRUE;
$Configuration['EnabledPlugins']['VanillaSEO'] = TRUE;
$Configuration['EnabledPlugins']['Voting 2'] = TRUE;
$Configuration['EnabledPlugins']['LikeThis'] = TRUE;
$Configuration['EnabledPlugins']['FileUpload'] = TRUE;
$Configuration['EnabledPlugins']['MentionsLookup'] = TRUE;
$Configuration['EnabledPlugins']['Flagging'] = TRUE;
$Configuration['EnabledPlugins']['StopAutoDraft'] = TRUE;
$Configuration['EnabledPlugins']['ThankfulPeople2'] = TRUE;
$Configuration['EnabledPlugins']['IndexPhotos'] = TRUE;
$Configuration['EnabledPlugins']['vanillicon'] = TRUE;
$Configuration['EnabledPlugins']['ButtonBar'] = TRUE;
$Configuration['EnabledPlugins']['Emotify'] = TRUE;
$Configuration['EnabledPlugins']['Tagging'] = TRUE;
$Configuration['EnabledPlugins']['CloudflareSupport'] = TRUE;
$Configuration['EnabledPlugins']['Timeago'] = TRUE;
$Configuration['EnabledPlugins']['Sprites'] = TRUE;
$Configuration['EnabledPlugins']['Signatures'] = TRUE;
$Configuration['EnabledPlugins']['Quotes'] = TRUE;
$Configuration['EnabledPlugins']['Consolidate'] = TRUE;
$Configuration['EnabledPlugins']['jsConnect'] = TRUE;
$Configuration['EnabledPlugins']['jsconnect'] = TRUE;
$Configuration['EnabledPlugins']['jsconnectAutoSignIn'] = TRUE;

// Garden
$Configuration['Garden']['GuestTimeZone'] = 'IST';
$Configuration['Garden']['Title'] = 'Forum for UPSC Preparation';
$Configuration['Garden']['Cookie']['Salt'] = '2BFLB4EEY579';
$Configuration['Garden']['Cookie']['Domain'] = '.forumias.com';
$Configuration['Garden']['Cookie']['Path'] = '/';
$Configuration['Garden']['Cookie']['Name'] = 'forumias2';
$Configuration['Garden']['Registration']['ConfirmEmail'] = '1';
$Configuration['Garden']['Registration']['DefaultRoles'] = 'a:1:{i:0;s:1:"8";}';
$Configuration['Garden']['Registration']['ApplicantRoleID'] = '4';
$Configuration['Garden']['Registration']['Method'] = 'Connect';
$Configuration['Garden']['Registration']['ConfirmEmailRole'] = '8';
$Configuration['Garden']['Registration']['CaptchaPrivateKey'] = '6LeO0u0SAAAAAI9MERzFjDzbbSJOWGu4J6Wgnt5j';
$Configuration['Garden']['Registration']['CaptchaPublicKey'] = '6LeO0u0SAAAAAPnuYLN5T9jaNpWxZJWUvpT9a_LU';
$Configuration['Garden']['Registration']['InviteExpiration'] = '-1 week';
$Configuration['Garden']['Registration']['InviteRoles']['8'] = '1';
$Configuration['Garden']['Registration']['InviteRoles']['16'] = '-1';
$Configuration['Garden']['Registration']['InviteRoles']['33'] = '-1';
$Configuration['Garden']['Registration']['SendConnectEmail'] = '1';
$Configuration['Garden']['Registration']['AutoConnect'] = TRUE;
$Configuration['Garden']['Email']['SupportName'] = 'ForumIAS';
$Configuration['Garden']['Email']['SupportAddress'] = 'help@forumias.com';
$Configuration['Garden']['Email']['UseSmtp'] = FALSE;
$Configuration['Garden']['Email']['SmtpHost'] = '64.64.22.35';
$Configuration['Garden']['Email']['SmtpUser'] = 'forumias';
$Configuration['Garden']['Email']['SmtpPassword'] = 'tuhana)uza>u';
$Configuration['Garden']['Email']['SmtpPort'] = '25';
$Configuration['Garden']['Email']['SmtpSecurity'] = '';
$Configuration['Garden']['RewriteUrls'] = TRUE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['InstallationID'] = '94FD-DF195F72-5CC6B26D';
$Configuration['Garden']['InstallationSecret'] = '96c02dd627fe3a7df5bfe01b8e899f507f3f208b';
$Configuration['Garden']['Theme'] = '2013JulyTheme';
$Configuration['Garden']['MobileTheme'] = 'forumiasmobile';
$Configuration['Garden']['Format']['Hashtags'] = FALSE;
$Configuration['Garden']['Messages']['Cache'] = array('[Base]', 'Vanilla/Discussion/Index');
$Configuration['Garden']['EditContentTimeout'] = '350';
$Configuration['Garden']['SystemUserID'] = '5134';
$Configuration['Garden']['InputFormatter'] = 'Html';
$Configuration['Garden']['Version'] = '2.1.11';
$Configuration['Garden']['HomepageTitle'] = 'Forum for UPSC Preparation';
$Configuration['Garden']['Description'] = '';
$Configuration['Garden']['ShareImage'] = 'AGCTP8VYMAAQ.png';
$Configuration['Garden']['Html']['SafeStyles'] = FALSE;
$Configuration['Garden']['Authenticator']['SignOutUrl'] = '/entry/signout/{Session_TransientKey}?Target=http://forumias.com/portal/wp-login.php?action=logout';
$Configuration['Garden']['Authenticator']['SignInUrl'] = 'http://forumias.com/portal/wp-login.php?redirect_to=%s';
$Configuration['Garden']['SignIn']['Popup'] = FALSE;
$Configuration['Garden']['Upload']['MaxFileSize'] = '20M';
$Configuration['Garden']['FavIcon'] = 'favicon_ea6b2c6e76a95877.ico';
$Configuration['Garden']['Profile']['EditUsernames'] = FALSE;
$Configuration['Garden']['Profile']['EditEmails'] = FALSE;

// Modules
$Configuration['Modules']['Vanilla']['Content'] = 'a:6:{i:0;s:13:"MessageModule";i:1;s:7:"Notices";i:2;s:21:"NewConversationModule";i:3;s:19:"NewDiscussionModule";i:4;s:7:"Content";i:5;s:3:"Ads";}';
$Configuration['Modules']['Conversations']['Content'] = 'a:6:{i:0;s:13:"MessageModule";i:1;s:7:"Notices";i:2;s:21:"NewConversationModule";i:3;s:19:"NewDiscussionModule";i:4;s:7:"Content";i:5;s:3:"Ads";}';

// Plugin
$Configuration['Plugin']['Signatures']['Format'] = 'Html';
$Configuration['Plugin']['SphinxSearch']['ManualDetected'] = FALSE;

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';
$Configuration['Plugins']['GettingStarted']['Registration'] = '1';
$Configuration['Plugins']['GettingStarted']['Discussion'] = '1';
$Configuration['Plugins']['GettingStarted']['Profile'] = '1';
$Configuration['Plugins']['GettingStarted']['Categories'] = '1';
$Configuration['Plugins']['Signatures']['Enabled'] = TRUE;
$Configuration['Plugins']['Signatures']['MaxNumberImages'] = 'None';
$Configuration['Plugins']['Signatures']['MaxLength'] = '';
$Configuration['Plugins']['Signatures']['HideGuest'] = '';
$Configuration['Plugins']['Signatures']['HideEmbed'] = '';
$Configuration['Plugins']['Signatures']['HideMobile'] = '';
$Configuration['Plugins']['Signatures']['AllowEmbeds'] = '';
$Configuration['Plugins']['Signatures']['Default']['MaxNumberImages'] = 'None';
$Configuration['Plugins']['Signatures']['Default']['MaxLength'] = '';
$Configuration['Plugins']['Signatures']['MaxImageHeight'] = '';
$Configuration['Plugins']['SEO']['DynamicTitles']['categories_all'] = 'UPSC related discussions on %garden%';
$Configuration['Plugins']['SEO']['DynamicTitles']['category_single'] = '%category% Discussions on %garden%';
$Configuration['Plugins']['SEO']['DynamicTitles']['category_discussions'] = 'View Discussions and Categories on %garden%';
$Configuration['Plugins']['SEO']['DynamicTitles']['activity'] = 'Recent Activity on %garden%';
$Configuration['Plugins']['SEO']['DynamicTitles']['discussions'] = 'ForumIAS.com - The Knowledge Network for Civil Services Preparation';
$Configuration['Plugins']['SEO']['DynamicTitles']['discussion_single'] = '%title% - %category% - UPSC 2014 & 2015';
$Configuration['Plugins']['SEO']['DynamicTitles']['search_results'] = '%search% - Search Results on %garden%';
$Configuration['Plugins']['Tagging']['Enabled'] = TRUE;
$Configuration['Plugins']['EmbedVanilla']['RemoteUrl'] = 'https://admin.statichtmlapp.com/tab/1/admin';
$Configuration['Plugins']['EmbedVanilla']['ForceRemoteUrl'] = FALSE;
$Configuration['Plugins']['EmbedVanilla']['EmbedDashboard'] = FALSE;
$Configuration['Plugins']['FileUpload']['Enabled'] = TRUE;
$Configuration['Plugins']['Flagging']['Enabled'] = TRUE;
$Configuration['Plugins']['Flagging']['NotifyUsers'] = array('1501', '1735', '1058', '96', '1798', '1819', '2302', '2416', '1967', '3060', '1172', '2688', '3237', '2943', '3505', '3516', '1354', '3805', '4070', '1815', '4238', '899', '4580', '1752', '4898', '3640', '5052', '5206', '5294', '5305', '5477', '5179', '2610', '4818', '5910', '5607', '1474', '5887', '636', '1482', '5211', '6632', '6709', '2100', '7018', '6980', '7109', '4828', '7171', '7187', '7286', '1179', '5398', '1713', '6447', '1536', '8448', '8726', '9014', '11032', '989', '2230', '12863', '3246', '7586', '1585', '4703', '16905', '16832', '17804', '4545', '17708', '18277', '18383', '18891', '3578', '8063', '19370', '19810', '19629', '1335', '19651', '8817', '21170', '15508', '16574', '21425', '20474', '7034', '21550', '20810', '21207', '21197', '21097', '21577', '21569', '21087', '19057', '3462', '21590', '21098', '19918', '21678', '21759', '21764', '21856', '22059', '8471', '22222', '7596', '22588', '21535', '1896', '22901', '22986', '22997', '18422', '4396', '768', '21056', '23377', '21609', '21567', '23965', '24056', '24067', '24082', '22841', '24271', '5240', '21689', '24537', '24527', '24040', '6599', '25025', '24968', '17745', '24792', '25267', '21875', '19868', '8639', '20743', '25422', '21431', '5610', '8035', '19171', '25471', '12309', '20839', '25507', '5494', '25937', '25748', '25823', '26356', '20871', '26439', '19078', '7196', '3996', '26572', '24306', '3857', '26997', '4005', '27329', '26902', '21295', '29', '4059', '21553', '27164', '15079', '28008', '25900', '28552', '24955', '28788', '24541', '29378', '29629', '29720', '7674', '29945', '30537', '24202', '30611', '30143', '28775', '24170', '32114', '32344', '32131', '32947', '32961', '30998', '18385', '2565', '36049', '36332', '33462', '39561', '38460', '26725', '39777');
$Configuration['Plugins']['Voting']['ModThreshold1'] = '-10';
$Configuration['Plugins']['Voting']['ModThreshold2'] = '-20';
$Configuration['Plugins']['Kudos']['Enabled'] = TRUE;
$Configuration['Plugins']['Kudos']['Delete'] = TRUE;
$Configuration['Plugins']['Kudos']['DeleteNumber'] = '20';
$Configuration['Plugins']['Vanoogle']['CSE'] = '011248889060662389770:9gai3ev9lny';
$Configuration['Plugins']['Facebook']['ApplicationID'] = '345229432166669';
$Configuration['Plugins']['Facebook']['Secret'] = 'a34e959bfa5df17559a065282713c910';
$Configuration['Plugins']['Facebook']['UseFacebookNames'] = FALSE;
$Configuration['Plugins']['Facebook']['SocialReactions'] = '1';
$Configuration['Plugins']['Facebook']['SocialSharing'] = '1';
$Configuration['Plugins']['GooglePlus']['ClientID'] = '80973107817-2q3a9vrtbf6mo1s1nefd04rnm3mcssim.apps.googleusercontent.com';
$Configuration['Plugins']['GooglePlus']['Secret'] = '8gseB9g1gTx3iWoQ4WA-6Zf7';
$Configuration['Plugins']['GooglePlus']['SocialReactions'] = '1';
$Configuration['Plugins']['GooglePlus']['SocialSharing'] = '1';
$Configuration['Plugins']['GooglePlus']['UseAvatars'] = '1';
$Configuration['Plugins']['GooglePlus']['Default'] = '';
$Configuration['Plugins']['Consolidate']['ExpireLast'] = 1438276388;
$Configuration['Plugins']['jsconnectAutoSignIn']['HideConnectButton'] = TRUE;

// Routes
$Configuration['Routes']['DefaultController'] = array('discussions', 'Internal');
$Configuration['Routes']['ZW50cnkvc2lnbmluKFw_VGFyZ2V0PSguKikpPw=='] = array('http://discuss.forumias.com/portal/wp-login.php?redirect_to=http%3A%2F%2Fdiscuss.forumias.com%2F$2', 'Permanent');

// TopPosters
$Configuration['TopPosters']['Limit'] = '10';
$Configuration['TopPosters']['Location']['Show'] = 'discussion';
$Configuration['TopPosters']['Excluded'] = FALSE;
$Configuration['TopPosters']['Show']['Medal'] = 'both';

// Vanilla
$Configuration['Vanilla']['Comments']['AutoOffset'] = TRUE;
$Configuration['Vanilla']['Comments']['AutoRefresh'] = '5';
$Configuration['Vanilla']['Comments']['PerPage'] = '20';
$Configuration['Vanilla']['Discussions']['PerPage'] = '50';
$Configuration['Vanilla']['Discussions']['Layout'] = 'modern';
$Configuration['Vanilla']['Archive']['Date'] = '';
$Configuration['Vanilla']['Archive']['Exclude'] = FALSE;
$Configuration['Vanilla']['AdminCheckboxes']['Use'] = TRUE;
$Configuration['Vanilla']['Discussion']['SpamCount'] = '1';
$Configuration['Vanilla']['Discussion']['SpamTime'] = '240';
$Configuration['Vanilla']['Discussion']['SpamLock'] = '600';
$Configuration['Vanilla']['Comment']['SpamCount'] = '1';
$Configuration['Vanilla']['Comment']['SpamTime'] = '30';
$Configuration['Vanilla']['Comment']['SpamLock'] = '60';
$Configuration['Vanilla']['Comment']['MaxLength'] = '8900';
$Configuration['Vanilla']['Categories']['MaxDisplayDepth'] = '3';
$Configuration['Vanilla']['Categories']['DoHeadings'] = FALSE;
$Configuration['Vanilla']['Categories']['HideModule'] = FALSE;
$Configuration['Vanilla']['Categories']['Layout'] = 'table';

// Last edited by Neyawn (120.56.223.22)2015-09-10 11:09:11