<?php if (!defined('APPLICATION')) exit();
class ForumIASFootModule extends Gdn_Module {
    
    protected $filterCats = array();
    
    public function __construct($Sender = '') {
        parent::__construct($Sender);
    }
    
    public function assetTarget() {
        return 'Foot';
    }
    
    public function toString() {
        return parent::ToString();
    }
    
}
    
