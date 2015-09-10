<?php if (!defined('APPLICATION')) exit();
     function SignOutUrl($Target = '') {
        $SignOutUrl = C('Garden.Authenticator.SignOutUrl','/signout/{Session_TransientKey}?Target=%2$s');
        $SignOutUrl = FormatString($SignOutUrl,array('Session_TransientKey'=>Gdn::Session()->TransientKey()));
        $SignOutUrl = sprintf($SignOutUrl,($Target ? '&Target='.urlencode($Target) : ''));
        return $SignOutUrl;
     }

if (!function_exists('RegisterUrl')) {
   function RegisterUrl($Target = '') {
      return '/entry/register'.($Target ? '?Target='.urlencode($Target) : '');
   }
}

if (!function_exists('SignInUrl')) {
   function SignInUrl($Target = '') {
        $SignInUrl = C('Garden.Authenticator.SignInUrl','/entry/signin?Target=%2$s');
	$Target = Url($Target ? $Target : '/discussions', true);
	$Target .= (parse_url($Target, PHP_URL_QUERY) ? '&' : '?') . 'connecting=1';
        $SignInUrl = sprintf($SignInUrl,$Target);
	return $SignInUrl;
   }
}

