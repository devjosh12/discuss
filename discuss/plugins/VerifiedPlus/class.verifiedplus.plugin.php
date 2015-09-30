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
    
    public function userModel_setCalculatedFields_handler($sender, &$args) {
        $user = &$args['User'];
        echo "<!--".var_export($user)."-->";
        if(val('Verified', $user)) {
            setValue('_CssClass', $user, (val('_CssClass', $user) ? ' ' : '') . 'Verified');
        }
    }

}
