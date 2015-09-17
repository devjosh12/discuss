<?php 
if (!defined('APPLICATION')) exit();
$PluginInfo['DiscussionsExcludeCategory'] = array(
    'Name' => 'Discussions Exclude Category',
    'Description' => 'Exclude categories from discussions list, and add a link to the discussions filter menu.',
    'SettingsPermission' => 'Garden.Settings.Manage',
    'RequiredApplications' => array(
        'Vanilla' => '2.1'
    ) ,
    'Version' => '0.1b',
    'Author' => "Paul Thomas",
    'AuthorEmail' => 'dt01pqt_pt@yahoo.com'
);

class DiscussionsExcludeCategory extends Gdn_Plugin {
    
    public function CategoryExcludeJson() {
        $cats = array();
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getFull();
        
        $excludeCategories  = c('Plugins.DiscussionsExcludeCategory.Categories', array());
        
        foreach($categories As $cat) {
            $cats[$cat->CategoryID] = array('exclude' => in_array($cat->CategoryID, $excludeCategories));
        }
            
        return json_encode($cats);
    }
    
    public function SettingsController_Render_Before($sender){
        if (strtolower($sender->RequestMethod) == 'managecategories') {
        
            $sender->addDefinition('DiscussionsExcludeLabel', T('exclude from /discussions'));
            
            $sender->addJsFile('catexclude.js','plugins/DiscussionsExcludeCategory');
            $sender->addDefinition('DiscussionsExcludeCategories', $this->CategoryExcludeJson());
            
        }
        
    }
    
    public function settingsController_discussionsExcludeCategory_create($sender,$args){
        $sender->permission('Garden.Settings.Manage');
        $id = val(0, $args);
        
        $on = val(1, $args) ? 1 : 0;
        
        if (!ctype_digit($id) || $id < 1){
            die(json_encode(FALSE));
        }
        
        $excludeCategories  = c('Plugins.DiscussionsExcludeCategory.Categories', array());
        
        if ($on) {
            $excludeCategories[] = $id;
        } else {
            $excludeCategories = array_diff($excludeCategories,  array($id));
        }
        
        saveToConfig('Plugins.DiscussionsExcludeCategory.Categories', array_unique($excludeCategories));
        
        die(json_encode(TRUE));
    }
    
    
    public function discussionModel_beforeGet_handler($sender, &$args) {
        if (strtolower(Gdn::controller()->pageName()) == 'discussions' && !empty(c('Plugins.DiscussionsExcludeCategory.Categories'))) {
            $sender->SQL->whereNotIn('d.CategoryID', c('Plugins.DiscussionsExcludeCategory.Categories'));
        }
    }
    
    protected function addTabs($sender) {
        
        $sender->addModule('CategoryExcludedModule', 'Content');
    }
    
    public function discussionsController_render_before($sender) {
        $sender->addCssFile('tabs.css','plugins/DiscussionsExcludeCategory');
        $this->addTabs($sender);
    }
    
    public function categoriesController_render_before($sender) {
         $this->addTabs($sender);
    }
    
    public function setup() {
        $this->structure();
    }
    
    public function base_beforeDispatch_handler($sender) {
        if (c('Plugins.DiscussionsExcludeCategory.Version') != $this->PluginInfo['Version']) {
            $this->structure();
        }
    }
    
    public function structure() {
        //Save Version for hot update
        saveToConfig('Plugins.DiscussionsExcludeCategory.Version', $this->PluginInfo['Version']);
    }
}
