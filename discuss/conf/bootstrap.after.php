<?php
if (!function_exists('AdminCheck')) {
    function adminCheck($Discussion = null, $Wrap = FALSE) {
        static $UseAdminChecks = NULL;
        if ($UseAdminChecks === null)
            $UseAdminChecks = c('Vanilla.AdminCheckboxes.Use') && Gdn::session()->checkPermission('Garden.Moderation.Manage');
        if (!$UseAdminChecks)
            return '';
        static $CanEdits = array(), $Checked = NULL;
        $Result = '';
        if ($Discussion) {
            if (!isset($CanEdits[$Discussion->CategoryID]))
                $CanEdits[$Discussion->CategoryID] = val('PermsDiscussionsEdit', CategoryModel::categories($Discussion->CategoryID));
            if ($CanEdits[$Discussion->CategoryID]) {
                // Grab the list of currently checked discussions.
                if ($Checked === null) {
                    $Checked = (array)Gdn::session()->getAttribute('CheckedDiscussions', array());
                    if (!is_array($Checked))
                        $Checked = array();
                }
                if (in_array($Discussion->DiscussionID, $Checked))
                    $ItemSelected = ' checked="checked"';
                else
                    $ItemSelected = '';
                $Result = <<<EOT
<span class="AdminCheck"><input type="checkbox" name="DiscussionID[]" value="{$Discussion->DiscussionID}" $ItemSelected /></span>
EOT;
            }
        } else {
            $Result = '<span class="AdminCheck"><input type="checkbox" name="Toggle" /></span>';
        }
        if ($Wrap) {
            $Result = $Wrap[0].$Result.$Wrap[1];
        }
        return $Result;
    }
}


if (!function_exists('socialSignInButton')) {
    function socialSignInButton($Name, $Url, $Type = 'button', $Attributes = array()) {
        TouchValue('title', $Attributes, sprintf(T('Sign In with %s'), $Name));
        $Title = $Attributes['title'];
        $Class = val('class', $Attributes, '');
        switch ($Type) {
            case 'icon':
                $Result = Anchor(
                    '<span class="Icon"></span>',
                    $Url,
                    'SocialIcon SocialIcon-'.$Name.' '.$Class,
                    $Attributes
                );
                break;
            case 'button':
            default:
                $Result = Anchor(
                    '<span class="Icon"></span><span class="Text">'.$Title.'</span>',
                    $Url,
                    'SocialIcon SocialIcon-'.$Name.' HasText '.$Class,
                    $Attributes
                );
                break;
        }
        return $Result;
    }
}
