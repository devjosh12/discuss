<?php if (!defined('APPLICATION')) exit();

/**
 *  @@ MyGroupsAPIDomain @@
 *
 *  Links API Worker to the worker collection
 *  and retrieves it. Auto initialising.
 *
 *  Provides a simple way for other workers, or
 *  the plugin file to call it method and access its
 *  properties.
 *
 *  A worker will reference the API work like so:
 *  $this->plgn->api()
 *
 *  The plugin file can access it like so:
 *  $this->api()
 *
 *  @abstract
 */

abstract class MyGroupsAPIDomain extends MyGroupsUtilityDomain {

/**
 * The unique identifier to look up Worker
 * @var string $workerName
 */

  private $workerName = 'api';

  /**
   *  @@ api @@
   *
   *  API Worker Domain address , 
   *  links and retrieves
   *
   *  @return void
   */

  public function api(){
    $workerName = $this->workerName;
    $workerClass = $this->getPluginIndex() . $workerName;
    return $this->linkWorker($workerName , $workerClass);
  }

}

/**
 *  @@ MyGroupsAPI @@
 *
 *  The worker used for the internals
 *
 *  Also can be access by other plugin by
 *  hooking MyGroups_Loaded_Handler
 *  and accessing $sender->Plgn->aPI();
 *
 */

class MyGroupsAPI {
    
    public static $cache = array();

    public function groupsLink($sender) {
        if ($sender->Menu) {
            $sender->Menu->addLink('MyGroups', t('Groups'), '/groups');
        }
    }
    
    public function setPermissions($permissions, $categoryID) {
        if (Gdn::session()->isValid()) {
            $perms = &Gdn::session()->User->Permissions;
            $perms = Gdn_Format::unserialize($perms);
            foreach($permissions as $permissionKey) {
                if (!isset($perms[$permissionKey])) {
                    $perms[$permissionKey] = array(-1);
                }
                $perms[$permissionKey][] = $categoryID;
            }
        }
    }
    
    public function linkResources($sender, $type) {
        $myGroupsResourceModel = new MyGroupsResourceModel();
        
        $categoryID = getValueR('Discussion.CategoryID', $sender->EventArguments);
        
        if ($categoryID) {
            $group = $myGroupsModel->getGroupByCategoryID($categoryID);
            $groupID = val('MyGroupID', $group);
            $myGroupsModel = new MyGroupsModel();
            
            if ($type == 'comment') {
                $foreignID = getValueR('Comment.CommentID', $sender->EventArguments);
            } else {
                $foreignID = getValueR('Discussion.DiscussionID', $sender->EventArguments);
            }
            
        }
        
        if ($groupID) {
            $myGroupsResourceModel->saveResources($foreignID, $groupID, $type);
        }
    }
    
    public function attachFile($sender) {
        $fileUpload = Gdn::pluginManager()->getPluginInstance('FileUploadPlugin');
        if ($fileUpload  && Gdn::session()->checkPermission('Plugins.Attachments.Upload.Allow', FALSE)) {
            return $sender->FetchView('attach_file', '', 'plugins/FileUpload');
        }
        return '';
    }
    
    protected function removeFile($mediaID) {
        $fileUpload = Gdn::pluginManager()->getPluginInstance('FileUploadPlugin');
        $media = $fileUpload->mediaModel()->getID($mediaID);

        if ($media) {
            $fileUpload->mediaModel()->delete($media);
            $removed = false;
            
            $this->EventArguments['Parsed'] = Gdn_Upload::parse($media->Path);
            $this->EventArguments['Handled'] =& $removed; 
            $fileUpload->fireEvent('TrashFile');

            if (!$removed) {
                $path = MediaModel::pathUploads() . DS .$media->Path;
                if (file_exists($path)) {
                   $removed = @unlink($path);
               }
            }

            if (!$removed) {
                $path = FileUploadPlugin::findLocalMedia($media, true, true);
                if (file_exists($path)){
                   $removed = @unlink($path);
                }
            }

        }
    }
    
    protected function saveAttachFile($uploadID, $foreignID, $foreignType, $groupID) {
        $fileUpload = Gdn::pluginManager()->getPluginInstance('FileUploadPlugin');
        $media = $fileUpload->mediaModel()->getID($uploadID);
        if ($media) {
            $media->ForeignID = $foreignID;
            $media->ForeignTable = $foreignType;
            $media->GroupID = $groupID;
            try {
                $fileUpload->mediaModel()->save($media);
                $myGroupsResourceModel = new MyGroupsResourceModel();
                $myGroupsResourceModel->saveResources($foreignID, $groupID, $foreignType);
            } catch (Exception $e) {
                die($e->getMessage());
                return false;
            }
            return true;
        }
        return false;
   }
    
    public function saveAttachments($foreignID, $foreignType, $groupID) {
        $fileUpload = Gdn::pluginManager()->getPluginInstance('FileUploadPlugin');
        if ($fileUpload  && Gdn::session()->checkPermission('Plugins.Attachments.Upload.Allow', FALSE)) {
            $attachedUploads = Gdn::request()->getValue('AttachedUploads');
            $allUploads = Gdn::request()->getValue('AllUploads');
            if (!$attachedUploads) {
                return;
            }

            $attached = array();
            foreach ($attachedUploads as $uploadID) {
                $attach = $this->saveAttachFile($uploadID, $foreignID, $foreignType, $groupID);
                if ($attach) {
                    $attached[] = $uploadID;
                }
            }

            $deleteIDs = array_diff($allUploads, $attached);
            
            foreach ($deleteIDs as $deleteID) {
                $this->removeFile($deleteID);
            }
        }
    }
    
    public function attachmentCache($foreignIDs, $foreignType) {
        
        if (!isset(self::$cache[$foreignType])) {
            self::$cache[$foreignType] = array();
        }
        
        $foreignIDs = array_diff($foreignIDs, array_keys(self::$cache[$foreignType]));
        
        if (empty($foreignIDs)) {
            return self::$cache[$foreignType];
        }
        
        $attachments = Gdn::SQL()
            ->select('m.*')
            ->from('Media m')
            ->where('m.ForeignID', $foreignIDs)
            ->where('m.ForeignTable', $foreignType)
            ->get()
            ->result();

        foreach($attachments as $attachment) {
            if (!isset(self::$cache[$foreignType][$attachment->ForeignID])) {
                self::$cache[$foreignType][$attachment->ForeignID] = array();
            }
            self::$cache[$foreignType][$attachment->ForeignID][] = $attachment;
        }
        
        return self::$cache[$foreignType];
    }
    
    public function attachmentsZip(&$rows, $table, $joinFeild) {
        $tableIDs = array();
        
        foreach ($rows as $row) {
            $tableIDs[] = val($joinFeild, $row);
        }
        
        $attachments = $this->attachmentCache($tableIDs, $table);
        
        foreach ($rows as &$row) {
            $attach = isset($attachments[val($joinFeild, $row)]) ? $attachments[val($joinFeild, $row)] : array();
            
            
            if (is_array($row)) {
                $row['Attachments'] = $attach;
            } else {
                $row->Attachments = $attach;
            }
        }
    }

}
