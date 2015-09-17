<?php if (!defined('APPLICATION')) exit();

$PluginInfo['VerifiedPlus'] = array(
    'Name' => 'Verfied Plus',
    'Description' => 'Verfied Plus',
    'RequiredApplications' => array('Vanilla' => '2.1'),
    'Version' => '0.1b',
    'Author' => "Paul Thomas",
    'AuthorEmail' => 'dt01pqt_pt@yahoo.com'
);

class VerifiedPlus extends Gdn_Plugin  {
    
    public function userModel_setCalculatedFields_handler($sender, &$args) {
        $user = &$args['User'];
        if(val('Verified', $user)) {
            setValue('_CssClass', $user, (val('_CssClass', $user) ? ' ' : '') . 'Verified');
        }
    }

}
