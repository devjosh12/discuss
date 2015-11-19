<?php if (!defined('APPLICATION')) exit();

/**
 *  @@ MyGroupsUIDomain @@
 *
 *  Links UI Worker to the worker collection
 *  and retrieves it. Auto initialising.
 *
 *  Provides a simple way for other workers, or
 *  the plugin file to call it method and access its
 *  properties.
 *
 *  A worker will reference the UI work like so:
 *  $this->plgn->ui()
 *
 *  The plugin file can access it like so:
 *  $this->ui()
 *
 *  @abstract
 */

abstract class MyGroupsUIDomain extends MyGroupsSettingsDomain {

/**
 * The unique identifier to look up Worker
 * @var string $WorkerName
 */

  private $workerName = 'ui';

  /**
   *  @@ ui @@
   *
   *  UI Worker Domain address , 
   *  links and retrieves
   *
   *  @return void
   */

  public function ui(){
    $workerName = $this->workerName;
    $workerClass = $this->getPluginIndex() . $workerName;
    return $this->LinkWorker($workerName , $workerClass);
  }

}

/**
 *  @@ MyGroupsUI @@
 *
 *  The worker used to handle the main
 *  interactions.
 *
 */

class MyGroupsUI {
    
  /**
   *  @@ groupsController @@
   *
   *  List groups
   *
   *  @return void
   */
    
    public function groupsController($sender) {
        $this->myGroupsModel = new MyGroupsModel();
        $this->plgn->utility()->miniDispatcher($sender, 'ui', 'groups', 'groups');
    }
    
    public function groupsController_index($sender) {
        $sender->setData('Title', t('Available Groups'));
        $sender->setData('Breadcrumbs', array(array('Name'=> t('Groups'), 'Url' => 'groups')));
        $sender->setData('Groups', Gdn::session()->IsValid() ? $this->myGroupsModel->getGroupsAvailable(Gdn::session()->User->UserID) : $this->myGroupsModel->getGroups());
        $sender->CssClass = 'NoPanel';

        $sender->setData('Active', 'Available');
        $sender->View = $this->plgn->utility()->themeView('groups');
        $sender->render();
    }
    
    public function groupsController_mine($sender) {
        if (Gdn::session()->IsValid()) {
            $sender->setData('Title', t('My Groups'));
            $sender->setData('Breadcrumbs', array(array('Name'=> t('My Groups'), 'Url' => 'groups/mine')));
            $sender->setData('Groups', Gdn::session()->IsValid() ? $this->myGroupsModel->getGroupsByUserID(Gdn::session()->User->UserID) : $this->myGroupsModel->getGroups());
            $sender->CssClass = 'NoPanel';

            $sender->setData('Active', 'Mine');
            $sender->View = $this->plgn->utility()->themeView('groups');
            $sender->render();
        } else {
            redirect(signInUrl());
        }
    }
    
    protected function groupPanel($sender){
        unset($sender->Assets['Panel']);

        $sender->addModule('GroupTabsModule', 'Content');
        $sender->addModule('NewDiscussionModule', 'Panel');
        $modules = c('Modules.Vanilla.Content', array());
        array_unshift($modules, 'GroupTabsModule');
        saveToConfig('Modules.Vanilla.Content', $modules, false);
    }
    
  /**
   *  @@ groupsController @@
   *
   *  Group tabs
   *
   *  @return void
   */
    
    public function groupController($sender) {
        $this->myGroupsModel = new MyGroupsModel();
        $this->myGroupsResourceModel = new MyGroupsResourceModel();
        $sender->setData('Group', $this->myGroupsModel->getGroupBySlug(val(0, $sender->RequestArgs)));
        $sender->setData('GroupMsg', Gdn::session()->stash('MyGroupMsg'));
        if (!$sender->data('Group.MyGroupID')) {
            throw notFoundException();
        }
        
        if (Gdn::session()->IsValid()) {
            $sender->setData('Owner', $this->myGroupsModel->isOwner(Gdn::session()->User->UserID, $sender->data('Group.MyGroupID')));
            $sender->setData('Member', $this->myGroupsModel->isMember(Gdn::session()->User->UserID, $sender->data('Group.MyGroupID')));
            $sender->setData('Applicant', $this->myGroupsModel->isApplicant(Gdn::session()->User->UserID, $sender->data('Group.MyGroupID')));
        }
        
        $sender->setData('memberCount', $this->myGroupsModel->getGroupMemberCount($sender->data('Group.MyGroupID')));
        $sender->setData('ownerCount', $this->myGroupsModel->getGroupOwnerCount($sender->data('Group.MyGroupID')));
        $sender->setData('applicantCount', $this->myGroupsModel->getGroupApplicantCount($sender->data('Group.MyGroupID')));
        $sender->setData('discussionCount', $this->myGroupsModel->groupCategoryById($sender->data('Group.CategoryID'))->CountDiscussions);
        
        if (class_exists('MediaModel')) {
            $sender->setData('HasResources', false);
            $sender->setData('resourceCount', $this->myGroupsModel->groupCategoryById($sender->data('Group.CategoryID'))->ResourceCount);
        }
        
        $tabslug = val(1, $sender->RequestArgs, 'about');
        $tab = ucwords($tabslug);
        $sender->setData('Active', $tab);
        $method = 'group' . $tab;
        
        $sender->setData('Title', ucwords($sender->data('Group.Name')));
    
        $slug = Gdn_Format::url($sender->data('Group.Name'));
        
        $sender->setData('Category', $sender->data('Category', array('UrlCode' => $slug)));
        
        $sender->setData('Breadcrumbs', 
            array_merge(
                array(
                    array('Name' => t('My Groups'), 'Url' => 'groups/mine'),
                    array('Name' => $sender->data('Group.Name'), 'Url' => "group/{$slug}")
                ),
                ($tab != 'About' ? array(array('Name' => t($tab), 'Url' => "group/{$slug}/{$tabslug}")) : array())
            )
        );
        $sender->CssClass = 'Group';
        
        $sender->Form = new Gdn_Form();
        
        $this->groupPanel($sender);
        
        if (method_exists($this, $method)) {
            $this->$method($sender);
        } else {
            throw notFoundException();
        }
    }
    
    protected function groupAbout($sender) {
        $sender->View = $this->plgn->utility()->themeView('group');
        $sender->render();
    }
    
    public function groupDiscussionsPermission($sender) {
        if (Gdn::session()->isValid()) {
            
            $this->myGroupsModel = new MyGroupsModel();
            $groups = $this->myGroupsModel->getGroupsByUserID(Gdn::session()->User->UserID);
            
            if ($this->myGroupsModel->rootCategory()) {
                $this->plgn->api()->setPermissions(array('Vanilla.Discussions.View'), $this->myGroupsModel->rootCategory()->CategoryID);
            }
            
            if ($groups) {
                
                foreach($groups as $group) {

                    $permissions = array(
                        'Vanilla.Discussions.View',
                        'Vanilla.Discussions.Add',
                        'Vanilla.Comments.Add'
                    );
                    
                    $slug = Gdn_Format::url($group->Name);
                    
                    $isActivityComment = Gdn::request()->path() == 'dashboard/activity/comment' && Gdn::request()->GetValueFrom('post', 'Return') == "vanilla/group/{$slug}/activity";
                    
                    $activityValid = false;
                    $activity = false;
                    
                    if ($isActivityComment) {
                        $activity = Gdn::sql()->select('a.*')->from('Activity a')->where('a.ActivityID', Gdn::request()->GetValueFrom('post', 'ActivityID'))->get()->firstRow();
                    }
                    
                    // can submit activity comments?
                    if (($activity && $activity->GroupID == $group->MyGroupID) || (in_array(Gdn::request()->path(), array("group/{$slug}/activity", "vanilla/group/{$slug}/activity", "activity/post/group/{$slug}", "group/{$slug}/activitypost")))) {
                        $permissions[] = 'Garden.Profiles.Edit';
                    }
                    
                    if ($group->Owner) {
                        $permissions[] = 'Vanilla.Discussions.Announce';
                        $permissions[] = 'Vanilla.Discussions.Close';
                        $permissions[] = 'Vanilla.Discussions.Edit';
                        $permissions[] = 'Vanilla.Comments.Edit';
                        $permissions[] = 'Vanilla.Discussions.Delete';
                        $permissions[] = 'Vanilla.Comments.Delete';
                        $permissions[] = 'Vanilla.Discussions.Sink';
                    }
                    
                    $this->plgn->api()->setPermissions($permissions, $group->CategoryID);
                }
            }
        }
    }
    
    public function groupDiscussionsPrep($sender) {
        if (Gdn::session()->IsValid()) {
            $this->myGroupsModel = new MyGroupsModel();
            $this->myGroupsResourceModel = new MyGroupsResourceModel();
            $slug = $sender->data('Discussion.CategoryUrlCode', val(0, $sender->RequestArgs));
            $sender->setData('Group', $this->myGroupsModel->getGroupBySlug($slug));
            
            if ($sender->data('Group')) {
                
                $sender->setData('Member', $this->myGroupsModel->isMember(Gdn::session()->User->UserID, $sender->data('Group.MyGroupID')));
                
                if ($sender->data('Member')) {
                    $sender->setData('Category', $sender->data('Category', array('UrlCode' => $slug)));
                    $sender->setData('Owner', $this->myGroupsModel->isOwner(Gdn::session()->User->UserID, $sender->data('Group.MyGroupID')));
                    

                    $tabslug = val(1, $sender->RequestArgs, 'about');
                    $tab = ucwords($tabslug);
                    $sender->setData('Active', $tab);
                    $slug = Gdn_Format::url($sender->data('Group.Name'));
                    $sender->setData('Breadcrumbs', 
                        array_merge(
                            array(
                                array('Name' => t('My Groups'), 'Url' => 'groups/mine'),
                                array('Name' => $sender->data('Group.Name'), 'Url' => "group/{$slug}")
                            ),
                            ($tab != 'About' ? array(array('Name' => t($tab), 'Url' => "group/{$slug}/{$tabslug}")) : array())
                        )
                    );
                    
                    $sender->setData('memberCount', $this->myGroupsModel->getGroupMemberCount($sender->data('Group.MyGroupID')));
                    $sender->setData('ownerCount', $this->myGroupsModel->getGroupOwnerCount($sender->data('Group.MyGroupID')));
                    $sender->setData('applicantCount', $this->myGroupsModel->getGroupApplicantCount($sender->data('Group.MyGroupID')));
                    $sender->setData('discussionCount', $this->myGroupsModel->groupCategoryById($sender->data('Group.CategoryID'))->CountDiscussions);
                    
                    if (class_exists('MediaModel')) {
                        $sender->setData('HasResources', false);
                        $sender->setData('resourceCount', $this->myGroupsModel->groupCategoryById($sender->data('Group.CategoryID'))->ResourceCount);
                    }
                    
                    $sender->setData('Active', ucwords(val(1, $sender->RequestArgs, 'Discussions')));
                    $sender->CssClass = 'Group';
                    $this->groupPanel($sender);
                }
            }
        }
    }
    
    public function listResources($sender) {
        $discussion = val('Discussion', $sender->EventArguments);
        if ($discussion) {
            $resources = val('Resources', $discussion, array());
            $resourcesOutput = '';
            foreach ($resources as $resource) {
                $resourcesOutput .= wrap(
                    anchor($resource->Name, 'uploads/' . $resource->Path, array('target' => '_blank')).
                    wrap(Gdn_Format::bigNumber($resource->Size), 'span class="ResourceSize"'),
                    'li class="Resource"'
                );
            }
            
            echo wrap($resourcesOutput,'ul class="Resources"');
        }
    }
    
    protected function groupMembers($sender) {
        if ($sender->data('Member')) {
            if ($sender->Form->isPostBack() != false && $sender->Form->getValue('AddMembers')) {
                $userNames = preg_split('`\s*,\s*`', trim($sender->Form->getValue('AddMembers'), ' ,'));
                $slug = Gdn_Format::url($sender->data('Group.Name'));
                foreach($userNames as $userName) {
                    $user = Gdn::userModel()->getByUsername($userName);
                    if ($user) {
                        $this->myGroupsModel->saveGroupMember($user->UserID, $sender->data('Group.MyGroupID'), array('Applicant' => false)); 
                        $email = new Gdn_Email();
                        $email->to($user)
                            ->subject(formatString(t('[{Site}] {Group} Group Membership Given'), array(
                                'Site' => c('Garden.Title'), 
                                'Group' => Gdn_Format::text($sender->data('Group.Name')))
                            ))
                            ->message(formatString(t("Hi {Name},\n\nYou have been added to {Group}\n\nView the group here:\n{Link}\n\n Regards,\n\n{Group} Owners"), array(
                                'Group' => Gdn_Format::text($sender->data('Group.Name')),
                                'Name' => Gdn_Format::text(Gdn::session()->User->Name),
                                'Link' => url("group/{$slug}", true))
                            ))
                            ->send();
                    }
                }
                
                redirect('group/' . $slug . '/members' );
            }
            
            list($offset, $limit) = offsetLimit(val(2, $sender->RequestArgs, 0), c('Plugins.MyGroups.PageLimit', 30) );
            
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            
            $pagerFactory = new Gdn_PagerFactory();
            $sender->Pager = $pagerFactory->getPager('Pager', $sender);
            $sender->Pager->ClientID = 'Pager';
            $sender->Pager->configure(
                $offset,
                $limit,
                $this->myGroupsModel->getGroupMemberCount($sender->data('Group.MyGroupID')),
                "group/{$slug}/members/{Page}"
            );
            $sender->setData('Members', $this->myGroupsModel->getGroupMembers($sender->data('Group.MyGroupID'), $offset));
            $sender->addJsFile('jquery.autocomplete.js');
            $sender->addJsFile('members.js', 'plugins/MyGroups');
            $sender->View = $this->plgn->utility()->themeView('members');
            $sender->render();
        } else {
            throw notFoundException();
        }
    }
    
    protected function groupMember($sender) {
        $op = 'member' . ucwords(val(2, $sender->RequestArgs));
        if ($op && method_exists($this, $op)) {
            $this->$op($sender);
        } else {
            throw notFoundException();
        }
    }
    
    protected function groupOwners($sender) {
        if ($sender->data('Member')) {
            
            list($offset, $limit) = offsetLimit(val(2, $sender->RequestArgs, 0), c('Plugins.MyGroups.PageLimit', 30) );
            
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            
            $pagerFactory = new Gdn_PagerFactory();
            $sender->Pager = $pagerFactory->getPager('Pager', $sender);
            $sender->Pager->ClientID = 'Pager';
            $sender->Pager->configure(
                $offset,
                $limit,
                $this->myGroupsModel->getGroupMemberCount($sender->data('Group.MyGroupID')),
                "group/{$slug}/owners/{Page}"
            );
            
            
            $sender->setData('Owners', $this->myGroupsModel->getGroupOwners($sender->data('Group.MyGroupID'), $offset));
            $sender->View = $this->plgn->utility()->themeView('owners');
            $sender->render();
        } else {
            throw notFoundException();
        }
    }
    
    protected function groupOwner($sender) {
        $op = 'owner' . ucwords(val(2, $sender->RequestArgs));
        if ($op && method_exists($this, $op)) {
            $this->$op($sender);
        } else {
            throw notFoundException();
        }
    }
    
    protected function ownerMake($sender) {
        if ($sender->data('Owner')) {
            $user = Gdn::userModel()->getID(val(3, $sender->RequestArgs));
            if ($user) {
                $this->myGroupsModel->saveGroupMember($user->UserID, $sender->data('Group.MyGroupID'), array('Owner' => true));
            }
            redirect('group/' . Gdn_Format::url($sender->data('Group.Name')) . '/owners' );
        } else {
            throw permissionException();
        }
    }
    
    protected function ownerRevoke($sender) {
        if ($sender->data('Owner')) {
            $user = Gdn::userModel()->getID(val(3, $sender->RequestArgs));
            if ($user) {
                $this->myGroupsModel->saveGroupMember($user->UserID, $sender->data('Group.MyGroupID'), array('Owner' => false));
            }
            redirect('group/' . Gdn_Format::url($sender->data('Group.Name')) . '/members' );
        } else {
            throw permissionException();
        }
    }
    
    protected function groupApplicants($sender) {
        if ($sender->data('Owner')) {
            
            list($offset, $limit) = offsetLimit(val(2, $sender->RequestArgs, 0), c('Plugins.MyGroups.PageLimit', 30) );
            
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            
            $pagerFactory = new Gdn_PagerFactory();
            $sender->Pager = $pagerFactory->getPager('Pager', $sender);
            $sender->Pager->ClientID = 'Pager';
            $sender->Pager->configure(
                $offset,
                $limit,
                $this->myGroupsModel->getGroupMemberCount($sender->data('Group.MyGroupID')),
                "group/{$slug}/applicants/{Page}"
            );
            
            $sender->setData('Applicants', $this->myGroupsModel->getGroupApplicants($sender->data('Group.MyGroupID'), $offset));
            $sender->View = $this->plgn->utility()->themeView('applicants');
            $sender->render();
        } else {
            throw notFoundException();
        }
    }
    
    protected function groupApplicant($sender) {
        $op = 'applicant' . ucwords(val(2, $sender->RequestArgs));
        if ($op && method_exists($this, $op)) {
            $this->$op($sender);
        } else {
            throw notFoundException();
        }
        
    }
    
    protected function groupActivity($sender) {
        if ($sender->data('Member')) {
            $sender->ApplicationFolder = 'Dashboard';
            $sender->ControllerName = 'Activity';
            $sender->addJsFile('activity.js', 'dashboard');
            $sender->View = 'all';
            
            $fileUpload = Gdn::pluginManager()->getPluginInstance('FileUploadPlugin');
            if ($fileUpload) {
                $fileUpload->postController_render_before($sender);
                $sender->addJsFile('activity.js', 'plugins/MyGroups');
            }
            
            $sender->ActivityModel = $activityModel = new ActivityModel();
            $this->groupActivityPost($sender);
            
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            
            $this->activityModel = new ActivityModel();
            
            list($offset, $limit) = offsetLimit(val(2, $sender->RequestArgs, 0), c('Plugins.MyGroups.PageLimit', 30) );
        
            $comment = $sender->Form->GetFormValue('Comment');
            $activities = $this->activityModel->getWhere(
                    array(
                        'NotifyUserID' => -1004,
                        'GroupID'     =>  $sender->data('Group.MyGroupID')
                    ), 
                    $offset, 
                    $limit
                )
                ->resultArray();
            foreach ($activities as $activty) {
                if ($activty['NotifyUserID'] == -1004) {
                    $activty['RegardingUserID'] = -1;
                }
            }
            $this->activityModel->joinComments($activities);
            $this->plgn->api()->attachmentsZip($activities, 'activity', 'ActivityID');
            $sender->addDefinition('AttachFile', $this->plgn->api()->attachFile($sender));
            $sender->setData('Activities', $activities);
            $sender->setData('Filter', "group/{$slug}");
            $sender->render('all', 'Activity', 'Dashboard');
        } else {
            throw notFoundException();
        }
            
    }
    
    
    protected function groupActivityPost($sender) {
        if ($sender->data('Member')) {
            if ($sender->Form->authenticatedPostBack()) {
                $slug = Gdn_Format::url($sender->data('Group.Name'));
                $userID = Gdn::session()->UserID;
                $notifyUserID = -1004;
                $activities = array();
                
                $sender->ActivityModel = $activityModel = new ActivityModel();
                
                $data = $sender->Form->formValues();
                $data = $activityModel->filterForm($data);
                if (!isset($data['Format']) || strcasecmp($data['Format'], 'Raw') == 0) {
                    $data['Format'] = C('Garden.InputFormatter');
                }
                
                $activity = array(
                    'ActivityType'      => 'GroupPost',
                    'NotifyUserID'      => $notifyUserID,
                    'ActivityUserID'    => $userID,
                    'RegardingUserID'   => $userID,
                    'HeadlineFormat'    => t('HeadlineFormat.GroupPost', '{RegardingUserID,you}'),
                    'Story'             => $data['Comment'],
                    'Format'            => $data['Format'],
                    'GroupID'           => $sender->data('Group.MyGroupID')
                );
             
                $activity = $activityModel->save($activity, false, array('CheckSpam' => true));
                if ($activity == SPAM || $activity == UNAPPROVED) {
                    $sender->StatusMessage = T('ActivityRequiresApproval', 'Your post will appear after it is approved.');
                    $sender->render('Blank', 'Utility', 'Dashboard');
                    return;
                }
                
                if ($activity) {
                    $this->plgn->api()->saveAttachments($activity['ActivityID'], 'activity', $sender->data('Group.MyGroupID'));
                    $activity['AllowComments'] = true;
                    if ($userID == Gdn::session()->UserID && $notifyUserID == ActivityModel::NOTIFY_PUBLIC) {
                        Gdn::userModel()->setField(Gdn::session()->UserID, 'About', Gdn_Format::plainText($activity['Story'], $activity['Format']));
                    }
                    
                    $activities = array($activity);
                    ActivityModel::joinUsers($activities);
                    $activityModel->calculateData($activities);
                } else {
                    $sender->Form->setValidationResults($activityModel->validationResults());
                
                    $sender->StatusMessage = $activityModel->Validation->resultsText();
                }
                if ($sender->deliveryType() == DELIVERY_TYPE_ALL) {
                    redirect("group/{$slug}/activity");
                }
                $this->plgn->api()->attachmentsZip($activities, 'activity', 'ActivityID');
                $sender->setData('Activities', $activities);
                $sender->render('Activities', 'Activity', 'Dashboard');
            }
        } else {
            throw notFoundException();
        }
    }
    
    public function activtyAttachments($sender) {
    
        $fileUpload = Gdn::pluginManager()->getPluginInstance('FileUploadPlugin');
        if ($fileUpload) {
            $attachments = getValueR('Activity.Attachments', $sender->EventArguments);
            if ($attachments) {
                include_once $sender->FetchViewLocation('fileupload_functions', '', 'plugins/FileUpload');

                $sender->setData('CommentMediaList', $attachments);
                $sender->setData('GearImage', $fileUpload->getWebResource('images/gear.png'));
                $sender->setData('Garbage', $fileUpload->getWebResource('images/trash.png'));
                $sender->setData('CanDownload', Gdn::session()->checkPermission('Plugins.Attachments.Download.Allow', false));
                echo $sender->FetchView('link_files', '', 'plugins/FileUpload');
            }
        }
    }
    
    protected function applicantJoin($sender) {
        if (Gdn::session()->isValid()) {
            $this->myGroupsModel->saveGroupMember(Gdn::session()->User->UserID, $sender->data('Group.MyGroupID'), array('Applicant' => true));
            Gdn::session()->stash('MyGroupMsg', t('We are processing your application, and will contact you though email. Thank you for your patience.'));
            
            $owners = $this->myGroupsModel->getGroupOwners($sender->data('Group.MyGroupID'));
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            foreach ($owners as $owner) {
                $email = new Gdn_Email();
                $email->to($owner)
                    ->subject(formatString(t('[{Site}] {Group} Group Applicant'), array(
                        'Site' => c('Garden.Title'), 
                        'Group' => Gdn_Format::text($sender->data('Group.Name')))
                    ))
                    ->message(formatString(t("You have a new applicant {Name} to {Group} group\n\nView applicants here:\n{Link}"), array(
                        'Group' => Gdn_Format::text($sender->data('Group.Name')),
                        'Name' => Gdn_Format::text(Gdn::session()->User->Name),
                        'Link' => url("group/{$slug}/applicants", true))
                    ))
                    ->send();
            }
            redirect('group/' . $slug);
        } else {
            redirect(signInUrl());
        }
    }
    
    protected function applicantApprove($sender) {
        if ($sender->data('Owner')) {
            $user = Gdn::userModel()->getID(val(3, $sender->RequestArgs));
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            if ($user) {
                $this->myGroupsModel->saveGroupMember($user->UserID, $sender->data('Group.MyGroupID'), array('Applicant' => false));
                $email = new Gdn_Email();
                $email->to($user)
                    ->subject(formatString(t('[{Site}] {Group} Group Membership Approved!'), array(
                        'Site' => c('Garden.Title'), 
                        'Group' => Gdn_Format::text($sender->data('Group.Name')))
                    ))
                    ->message(formatString(t("Hi {Name},\n\nYour application to join {Group} is approved\n\nView the group here:\n{Link}\n\n Regards,\n\n{Group} Owners"), array(
                        'Group' => Gdn_Format::text($sender->data('Group.Name')),
                        'Name' => Gdn_Format::text(Gdn::session()->User->Name),
                        'Link' => url("group/{$slug}", true))
                    ))
                    ->send();
            }
            redirect('group/' . $slug . '/members' );
        } else {
            throw permissionException();
        }
    }
    
    public function applicantDeny($sender) {
        if ($sender->data('Owner')) {
            $user = Gdn::userModel()->getID(val(3, $sender->RequestArgs));
            $slug = Gdn_Format::url($sender->data('Group.Name'));
            if ($user) {
                $this->myGroupsModel->deleteGroupApplicant($user->UserID, $sender->data('Group.MyGroupID'));
                $email = new Gdn_Email();
                $email->to($user)
                    ->subject(formatString(t('[{Site}] {Group} Group Membership Given'), array(
                        'Site' => c('Garden.Title'), 
                        'Group' => Gdn_Format::text($sender->data('Group.Name')))
                    ))
                    ->message(formatString(t("Hi {Name},\n\nYou have been added to {Group}\n\nView the group here:\n{Link}\n\n Regards,\n\n{Group} Owners"), array(
                        'Group' => Gdn_Format::text($sender->data('Group.Name')),
                        'Name' => Gdn_Format::text(Gdn::session()->User->Name),
                        'Link' => url("group/{$slug}", true))
                    ))
                    ->send();
            }
            redirect('group/' . $slug . '/members' );
        } else {
            throw permissionException();
        }
    }
    
    protected function memberAdd($sender) {
        if ($sender->data('Owner')) {
            $user = Gdn::userModel()->getID(val(3, $sender->RequestArgs));
            if ($user) {
                $this->myGroupsModel->saveGroupMember($user->UserID, $sender->data('Group.MyGroupID'), array('Applicant' => false));
            } 
            redirect('group/' . Gdn_Format::url($sender->data('Group.Name')) . '/members' );
        } else {
            throw permissionException();
        }
    }
    
    public function memberRemove($sender) {
        if ($sender->data('Owner')) {
            $user = Gdn::userModel()->getID(val(3, $sender->RequestArgs));
            if ($user) {
                $this->myGroupsModel->deleteGroupMember($user->UserID, $sender->data('Group.MyGroupID'));
            }
            redirect('group/' . Gdn_Format::url($sender->data('Group.Name')) . '/members' );
        } else {
            throw permissionException();
        }
    }
}
