<?php if (!defined('APPLICATION')) exit();
class CategoryExcludedModule extends Gdn_Module {
    
    protected $filterCats = array();
    
    public function __construct($Sender = '') {
        parent::__construct($Sender);
    }
    
    public function getData() {
        $catModel = new CategoryModel();
        $categories = $catModel->getFull();
        
        $excludeCategories  = c('Plugins.DiscussionsExcludeCategory.Categories', array());

        foreach($categories As $cat) {
            if(in_array($cat->CategoryID, $excludeCategories)){
                $this->filterCats[$cat->CategoryID] = $cat;
            }
        }
    }

    public function assetTarget() {
        return 'Content';
    }
   
    public function toString() {
        $this->getData();
        $count = count($this->filterCats);
        $catID = isset($this->_Sender->CategoryID) ? $this->_Sender->CategoryID : '';
        $activeCats = isset($this->filterCats[$catID]);
        
        if (!empty($this->filterCats)) {
   ?>
<div class="CategoryExcluded">
    <ul class="Tabs CategoryExcludedTabs">
       <?php
            if (c('Plugins.DiscussionsExcludeCategory.DefaultTab', true)) {
                echo wrap(anchor(t('DiscussionsExcludeCategory.DefaultTab', 'Recent'), '/discussions', 'CategoryExcludedLink'. (!$activeCats ?  ' Active' : '')), 'li');
            }
            
            foreach($this->filterCats as $cat) {
                echo wrap(anchor(htmlspecialchars($cat->Name), categoryUrl($cat), 'CategoryExcludedLink'. ($this->_Sender->CategoryID == $cat->CategoryID ?  ' Active' : '')), 'li');
            }
       ?>
    </ul>
</div>
   <?php
        }
    }
}
