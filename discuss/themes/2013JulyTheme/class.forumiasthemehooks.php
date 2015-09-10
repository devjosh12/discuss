<?php if (!defined('APPLICATION')) exit();

class ForumIASThemeHooks extends Gdn_Plugin {

    public function Gdn_Dispatcher_AfterControllerInit_Handler($Sender, $Args) {
        if (Gdn::Session()->IsValid() && isset($Args['Controller']) && $Args['Controller']->DeliveryMethod() == DELIVERY_METHOD_XHTML && strpos(Gdn::Session()->User->Name, '_temp_username_')===0) {
               Redirect('/portal/wp-admin/profile.php?page=forumias-display-name&return_to=' . Gdn_Format::Url(Url('',true)));
        }
    }

    public function Base_Render_Before($Sender) {
       if (Gdn::Session()->IsValid() || $Sender->ControllerName == 'entrycontroller') {
           return;
       }
       $Sender->AddCssFile('featherlight.css');
       $Sender->AddJsFile('featherlight.js');
       $Sender->AddJsFile('join_popup.js');
       $Sender->AddDefinition('joinPopup', file_get_contents("/home/forumias/www/join_popup.html"));
    }
}


