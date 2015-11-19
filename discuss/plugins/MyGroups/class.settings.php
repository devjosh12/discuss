<?php if (!defined('APPLICATION')) exit();

/**
 *  @@ MyGroupsSettingsDomain @@
 *
 *  Links Settings Worker to the worker collection
 *  and retrieves it. Auto initialising.
 *
 *  Provides a simple way for other workers, or
 *  the plugin file to call it method and access its
 *  properties.
 *
 *  A worker will reference the Settings work like so:
 *  $this->plgn->settings()
 *
 *  The plugin file can access it like so:
 *  $this->settings()
 *
 *  @abstract
 */

abstract class MyGroupsSettingsDomain extends MyGroupsAPIDomain {

/**
 * The unique identifier to look up Worker
 * @var string $workerName
 */

  private $workerName = 'settings';

  /**
   *  @@ settings @@
   *
   *  Settings Worker Domain address, 
   *  links and retrieves
   *
   *  @return void
   */

  public function settings(){
    $workerName = $this->workerName;
    $workerClass = $this->getPluginIndex() . $workerName;
    return $this->linkWorker($workerName, $workerClass);
  }
}

/**
 *  @@ MyGroupsSettings @@
 *
 *  The worker used to handle the backend
 *  settings interactions.
 *
 */

class MyGroupsSettings {
    
    protected $myGroupsModel = null;
    
  /**
    *  @@ settingsMenuItems @@
    *
    *  Basic settings menu item and link
    *
    *  @param Gdn_Controller $Sender
    *
    *  @return void
    */

    public function settingsMenuItems($sender) {
        $menu = $sender->EventArguments['SideMenu'];
        $menu->addLink('Forum', t('Groups'), 'settings/mygroups', 'Garden.Settings.Manage');
    }
    
  /**
   *  @@ settingsController @@
   *
   *  Used to manage groups
   *  @param Gdn_Controller $sender
   *
   *  @return void
   */
    
    public function settingsController($sender) {
        if (Gdn::session()->checkPermission('Garden.Settings.Manage') || Gdn::session()->checkPermission('Plugins.MyGroups.Manage')) {
            $sender->addSideMenu();
            $this->myGroupsModel = new MyGroupsModel();
            $this->plgn->utility()->miniDispatcher($sender, 'settings');
        } else {
            throw permissionException();
        }
    }
    
    public function settingsController_index($sender) {
        $sender->setData('Title', t('Groups'));
        $sender->setData('groups', $this->myGroupsModel->getGroups());
        $sender->View = $this->plgn->utility()->themeView('settingsgroups');
        $sender->render();
    }
    
    protected function groupSave($sender){
        if ($sender->Form->isPostBack() != false) {
            $formValues = $sender->Form->formValues();
            
            $upload = new Gdn_Upload();
            try {
                $temp = $upload->validateUpload($sender->Form->escapeFieldName('ImgFile'), true);
                if($temp){
                    if (!file_exists(PATH_ROOT . DS . 'uploads' . DS . 'mygroups')) {
                        mkdir(PATH_ROOT . DS . 'uploads' . DS . 'mygroups');
                    }
                    if (!is_writable(PATH_ROOT . DS . 'uploads' . DS . 'mygroups')) {
                        throw new exception(t('uploads/mygroups is not writable, please ensure that it exists and the web user has permission to save to this folder'));
                    }
                        
                    $img = $upload->generateTargetName(PATH_ROOT . DS . 'uploads' . DS . 'mygroups');

                    $uploadImg = $upload->saveAs(
                        $temp,
                        'mygroups' . DS . pathinfo($img, PATHINFO_BASENAME)
                    );
                    $savedImg = pathinfo($uploadImg['SaveName'], PATHINFO_BASENAME);
                    $formValues['Picture'] = $savedImg;
                }
            } catch(Exception $ex) {
                if($ex->getCode() != 400) {
                    $sender->Form->addError($ex->getMessage());
                }
            }
            
            if (!isset($formValues['Picture']) || !$formValues['Picture']) {
                $sender->Form->addError('Image Required');
            }
            
            $this->myGroupsModel->defineSchema();
            $this->myGroupsModel->Validation->validate($formValues);
            $sender->Form->setValidationResults($this->myGroupsModel->Validation->results());
            if ($sender->Form->errorCount() == 0) {
                $groupID = $this->myGroupsModel->saveGroup($formValues);
                
                if ($groupID) {
                    $this->myGroupsModel->saveGroupMember(Gdn::session()->User->UserID, $groupID, array('Owner' => true));
                }
                
                redirect('settings/mygroups');
            }
        }
    }
    
    public function settingsController_add($sender) {
        $sender->setData('Title', t('Add Group'));
        $this->groupSave($sender);
        $sender->View = $this->plgn->utility()->themeView('settingsgroup');
        $sender->render();
    }
    
    public function settingsController_edit($sender) {
        $groupID = val(1, $sender->RequestArgs);
        if ($groupID && ctype_digit($groupID)) {
            $group = $this->myGroupsModel->getGroup($groupID);
            if ($group) {
                $sender->setData('Title', t('Add Group'));
                $this->groupSave($sender);
                $sender->setData('group', $group);
                $sender->Form->setData($group);
                $sender->View = $this->plgn->utility()->themeView('settingsgroup');
                $sender->render();
                return;
            }
        }
        
        throw notFoundException();
    }
    
    public function settingsController_delete($sender) {
        $groupID = val(1, $sender->RequestArgs);
        if ($groupID && ctype_digit($groupID)) {
            if ($this->myGroupsModel->getGroup($groupID)) {
                $this->myGroupsModel->deleteGroup($groupID);
                redirect('settings/mygroups');
            }
        }
        
        throw notFoundException();
    }
}
