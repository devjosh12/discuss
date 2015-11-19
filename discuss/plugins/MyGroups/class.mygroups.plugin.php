<?php if (!defined('APPLICATION')) exit();

$PluginInfo['MyGroups'] = array(
    'Name' => 'My Groups' , 
    'Description' => 'Sets up private groups with ownership, applicants and members' , 
    'RequiredApplications' => array('Vanilla' => '2.1') , 
    'SettingsPermission' => 'Garden.Settings.Manage' , 
    'RegisterPermissions' => array('Plugins.MyGroups.Manage'),
    'Version' => '0.1.10b' , 
    'Author' => "Paul Thomas" , 
    'AuthorEmail' => 'dt01pqt_pt@yahoo.com'
);

/**
 *  @@ myGroupsLoad function @@
 *
 *  A callback for spl_autoload_register
 *
 *  Will load class.[name].php for MyGroups[Name]
 *  or MyGroups[Name]Domain
 *
 *  @param string $Class class name to be matched
 *
 *  @return void
 */

function myGroupsLoad($class){
    $match = array();
    if (preg_match('`^MyGroups(.*)`' , $class , $match)) {
        $file = strtolower(preg_replace('`Domain$`', '', $match[1]));
        if (file_exists(PATH_PLUGINS . DS . 'MyGroups' . DS . 'class.' . $file . '.php')) {
            include_once(PATH_PLUGINS . DS . 'MyGroups' . DS . 'class.' . $file . '.php');
        }
    }
}

// auto load worker/domain classes.
spl_autoload_register('myGroupsLoad');

// Initialise loader to be use by various libraries an architecture
MyGroupsUtility::initLoad();

MarketPlaceUtility::registerLoadMap('`^MyGroups[A-Za-z]+Model$`','','class.{$Matches[0]}.php', false);

//<<<< must be flush no indentation !!!!
class MyGroups extends MyGroupsUIDomain {
    
    public function base_getAppSettingsMenuItems_handler($sender){
        $this->settings()->settingsMenuItems($sender);
    }
    
    public function settingsController_myGroups_create($sender, $args) {
        $this->settings()->settingsController($sender);
    }
    
    public function assetModel_styleCss_handler($sender) {
        $sender->addCssFile('groups.css', 'plugins/MyGroups');
    }
    
    public function vanillaController_groups_create($sender, $args) {
        $this->ui()->groupsController($sender);
    }
    
    public function vanillaController_group_create($sender, $args) {
        $this->ui()->groupController($sender);
    }
    
    public function categoriesController_beforeCategoriesRender_handler($sender, $args) {
        $this->ui()->groupDiscussionsPrep($sender);
    }
    
    public function discussionController_beforeDiscussionRender_handler($sender, $args) {
        $this->ui()->groupDiscussionsPrep($sender);
    }
    
    public function postController_beforeDiscussionRender_handler($sender, $args) {
        $this->ui()->groupDiscussionsPrep($sender);
    }
    
    public function base_afterGetSession_handler($sender, $args) {
        $this->ui()->groupDiscussionsPermission($sender);
    }
    
    public function base_render_before($sender, $args) {
        $this->api()->groupsLink($sender);
    }
    
    public function postController_afterDiscussionSave_handler($sender, $args) {
        $this->api()->linkResources($sender, 'discussion');
    }
    
    public function postController_afterCommentSave_handler($sender, $args) {
        $this->api()->linkResources($sender, 'comment');
    }
    
    public function categoriesController_beforeDiscussionMeta_handler($sender, $args) {
        $this->ui()->listResources($sender);
    }
    
    public function activityController_afterActivityBody_handler($sender, $args) {
        $this->ui()->activtyAttachments($sender);
    }
    
    public function base_beforeDispatch_handler($sender) {
        $this->utility()->hotLoad();
    }
    
    public function base_beforeLoadRoutes_handler($sender, &$args) {
        $myGroupModel = new MyGroupsModel();
        $groups = $myGroupModel->getGroups();
        foreach($groups as $group) {
            $this->utility()->dynamicRoute($args['Routes'], '^group/' . Gdn_Format::url($group->Name) . '/resources(/p[0-9]+)?$', 'categories/' . Gdn_Format::url($group->Name) . '$1/resources', 'Internal');
            $this->utility()->dynamicRoute($args['Routes'], '^group/' . Gdn_Format::url($group->Name) . '/discussions(/p[0-9]+)?$', 'categories/' . Gdn_Format::url($group->Name) . '$1', 'Internal');
            $this->utility()->dynamicRoute($args['Routes'], '^activity/post/group/' . Gdn_Format::url($group->Name) . '/?$', 'vanilla/group/' . Gdn_Format::url($group->Name) . '/activity', 'Internal');
            
            $this->utility()->dynamicRoute($args['Routes'], '^categories/' . Gdn_Format::url($group->Name) . '(/p[0-9]+)?/?$', 'group/' . Gdn_Format::url($group->Name).'/discussions$1', 'Temporary');
        }
        
        $this->utility()->dynamicRoute($args['Routes'], '^categories/groups-root/?', 'groups', 'Temporary');
        
        $this->utility()->dynamicRoute($args['Routes'], '^group(s)?(/.*)?$', 'vanilla/group$1$2', 'Internal');
    }

    public function setup() {
        $this->utility()->hotLoad(true);
    }

    public function pluginSetup(){
        
        Gdn::structure()
            ->table('MyGroup')
            ->primaryKey('MyGroupID')
            ->column('CategoryID', 'int(11)', false, array('key' , 'unique'))
            ->column('Name', 'varchar(255)')
            ->column('Description', 'text')
            ->column('Picture', 'varchar(255)')
            ->column('ResourceCount', 'int(11)', 0)
            ->set();
            
        Gdn::structure()
            ->table('MyGroupMember')
            ->primaryKey('MyGroupMemberID')
            ->column('MyGroupID', 'int(11)', false, array('unique.1'))
            ->column('MyGroupUserID', 'int(11)', false, array('unique.1'))
            ->column('Applicant', 'int(4)', 1)
            ->column('Owner', 'int(4)', 0)
            ->set();
            
        Gdn::structure()
            ->table('Activity')
            ->column('GroupID', 'int(11)', 0)
            ->set();
            
        Gdn::structure()
            ->table('Media')
            ->column('GroupID', 'int(11)', 0)
            ->set();            
            
        
        // parent category for groups
        $myGroupModel = new MyGroupsModel();
        $myGroupModel->groupCategory('Groups', 'Parent Category of Groups', true);
        
    }

}
