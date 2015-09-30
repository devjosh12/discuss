<?php if (!defined('APPLICATION')) exit();

$PluginInfo['VerifiedPlus'] = array(
    'Name' => 'Verified Plus',
    'Description' => 'Class and tool tip for verified users',
    'RequiredApplications' => array('Vanilla' => '2.1'),
    'Version' => '0.1b',
    'Author' => "Paul Thomas",
    'AuthorEmail' => 'dt01pqt_pt@yahoo.com'
);

class VerifiedPlus extends Gdn_Plugin  {
    
    public function assetModel_styleCss_handler($sender) {
        $sender->addCssFile('verified.css', 'plugins/VerifiedPlus');
    }
    
    public function base_render_before($sender) {
        $sender->addJsFile('verifiedtip.js', 'plugins/VerifiedPlus');
    }
    
    protected function verifyUser($user) {
        error_log(val('Verified', $user));
        if(val('Verified', $user)) {
            setValue('_CssClass', $user, (val('_CssClass', $user) ? ' ' : '') . 'Verified');
        }
    }
    
    public function userModel_setCalculatedFields_handler($sender, &$args) {
        $user = &$args['User'];
        $this->verifyUser($user);
    }
    
    public function userModel_AfterGetIDs_handler($sender, $args) {
        $users = &$args['LoadedUsers'];
        foreach($users as $user) {
            $this->verifyUser($user);
        }
    }
    
    public function userModel_AfterGetID_handler($sender, $args) {
        $users = &$args['LoadedUser'];
        $this->verifyUser($user);
    }

}
