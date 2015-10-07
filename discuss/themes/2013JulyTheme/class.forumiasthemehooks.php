<?php if (!defined('APPLICATION')) exit();

class ForumIASThemeHooks extends Gdn_Plugin {

    public function Gdn_Dispatcher_AfterControllerInit_Handler($Sender, $Args) {
        // redirect those without display name to choose one. 
        if (Gdn::Session()->IsValid() && isset($Args['Controller']) && $Args['Controller']->DeliveryMethod() == DELIVERY_METHOD_XHTML && strpos(Gdn::Session()->User->Name, '_temp_username_')===0) {
            Redirect('/portal/wp-admin/profile.php?page=forumias-display-name&return_to=' . Gdn_Format::Url(Url('',true)));
        }
    }

    public function Base_Render_Before($Sender) {
        
        // set favicon
        $Sender->Head->SetFavIcon($this->GetResource("/design/images/favicon.ico", FALSE, FALSE));
        
        // site meta description
        $Sender->Description("Knowledge Sharing network for UPSC, IAS Preparation, IAS prelims, IAS mains, IAS Interview, IPS Topper, IAS topper interview, IAS Test Series, IAS Coaching, IAS Notes, IAS Books, IAS CSAT Preparation");
    
        // join popup
        if (!(Gdn::Session()->IsValid() || $Sender->ControllerName == 'entrycontroller')) {
            $Sender->AddCssFile('featherlight.css');
            $Sender->AddJsFile('featherlight.js');
            $Sender->AddJsFile('join_popup.js');
            $Sender->AddDefinition('joinPopup', file_get_contents("/home/forumias/www/join_popup.html"));
        }
        
        
        if (in_array(Gdn::Dispatcher()->Application(), array('vanilla', 'conversations'))) {
            // footer links module
            include dirname(__FILE__) . '/class.forumiasfootmodule.php';
            $Sender->AddModule('ForumIASFootModule');
        }
    }
}


