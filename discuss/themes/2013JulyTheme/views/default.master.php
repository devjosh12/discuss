<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <?php $this->RenderAsset('Head'); ?>
</head>
<body id="<?php echo $BodyIdentifier; ?>" class="<?php echo $this->CssClass; ?>">
    <div id="Frame">
        <div id="Head">                 
            <div class="wrapper">
                <div class="logo">
                    <a href="<?php echo Url('/'); ?>"><?php echo Gdn_Theme::Logo(); ?></a>
                </div>
            </div>
        </div>
        <div id="scrollerHead" class="menuwrapper">
            <img class= "menuicon" src="http://i.imgur.com/PMEdOhG.png">
            <div class="Menu">
            <?php
                    $Session = Gdn::Session();
                    if ($this->Menu) {
                        $this->Menu->AddLink('Dashboard', T('Dashboard'), '/dashboard/settings', array('Garden.Settings.Manage'));
                        // $this->Menu->AddLink('Dashboard', T('Users'), '/user/browse', array('Garden.Users.Add', 'Garden.Users.Edit', 'Garden.Users.Delete'));
                        // $this->Menu->AddLink('Activity', T('Timeline'), '/activity');
                        
                        if ($Session->IsValid()) {
                            $Name = $Session->User->Name;
                            $CountNotifications = $Session->User->CountNotifications;
                            if (is_numeric($CountNotifications) && $CountNotifications > 0)
                                $Name .= ' <span class="Alert">'.$CountNotifications.'</span>';

                            if (urlencode($Session->User->Name) == $Session->User->Name) {
                                $ProfileSlug = $Session->User->Name;
                            } else {
                                $ProfileSlug = $Session->UserID.'/'.urlencode($Session->User->Name);
                                    $this->Menu->AddLink('User', $Name, '/profile/'.$ProfileSlug, array('Garden.SignIn.Allow'), array('class' => 'UserNotifications'));
                                    $this->Menu->AddLink('SignOut', T('Sign Out'), SignOutUrl(), FALSE, array('class' => 'NonTab SignOut'));
                            }
                        } else {
                            $Attribs = array();
                            if (SignInPopup() && strpos(Gdn::Request()->Url(), 'entry') === FALSE) {
                                $Attribs['class'] = 'SignInPopup';
                            }
                                
                            $this->Menu->AddLink('Entry', T('Sign In'), SignInUrl($this->SelfUrl), FALSE, array('class' => 'NonTab'), $Attribs);
                        }
                        //$this->Menu->Addlink('Home',T('My•ForumIAS'),'http://my.forumias.com/');                         
                        //$this->Menu->Addlink('Home',T('<b>Interview 2015</b>'),'http://is.gd/int_f');
                        echo $this->Menu->ToString();
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="Body">
        <div id="Content"><?php $this->RenderAsset('Content'); ?></div>
        <div id="Panel">
            <?php $this->RenderAsset('Panel'); ?></div>
        </div>
        <div id="Foot">
            <?php
                $this->RenderAsset('Foot');
            ?>
        </div>
        <?php $this->FireEvent('AfterBody'); ?>
    </div>
</body>
</html>
