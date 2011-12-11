<?php
/*
#------------------------------------------------------------------------
# Musicity - #2 2011 template (for Joomla 1.5)
#
# Copyright (C) 2007-2010 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com   
#------------------------------------------------------------------------ 
# Based on T3 Framework
#------------------------------------------------------------------------
# Copyright (C) 2004-2009 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - GNU/GPL, http://www.gnu.org/copyleft/gpl.html
# Author: J.O.O.M Solutions Co., Ltd
# Websites: http://www.joomlart.com - http://www.joomlancers.com
#------------------------------------------------------------------------
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/gk_musicity/css/system/offline.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/gk_musicity/fonts/WinterthurCondensed/stylesheet.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<!--[if IE 7.0]>
<style type="text/css">
p.username { float:left;  }
p.password  {float:right!important; margin-left:0!important; }
p.remember { width:300px!important; clear:both; float:left; }
input[type="submit"] { padding-bottom:3px!important; }
</style>
<![endif]-->
</head>
<body>
<div id="wrapper">

    <div id="gk-top">
        <h1 class="logo">
              <a href="index.php"><?php echo $mainframe->getCfg('offline_message'); ?></a>
        </h1>
    </div>
    
    <div id="frame">
       <div id="outline">
       <jdoc:include type="message" />
            <h2><?php echo $mainframe->getCfg('offline_message'); ?></h2>
            <?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
            <?php JHTML::_('script', 'openid.js'); ?>
            <?php endif; ?>
            <form action="index.php" method="post" name="login" id="form-login">
                 <fieldset class="input">
                      <p class="username">
                           <label for="username"> <?php echo JText::_('Username') ?> </label>
                           <br />
                           <input name="username" id="username" type="text" class="inputbox" alt="<?php echo JText::_('Username') ?>" size="18" />
                      </p>
                      <p class="password">
                           <label for="passwd"> <?php echo JText::_('Password') ?> </label>
                           <br />
                           <input type="password" name="passwd" class="inputbox" size="18" alt="<?php echo JText::_('Password') ?>" id="passwd" />
                      </p>
                      <p class="remember">
                           <label for="remember"> <?php echo JText::_('Remember me') ?> </label>
                           <input type="checkbox" name="remember" class="inputbox" value="yes" alt="<?php echo JText::_('Remember me') ?>" id="remember" />
                      </p>
                      <div class="buttons">
                           <input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />
                      </div>
                 </fieldset>
                 <input type="hidden" name="option" value="com_user" />
                 <input type="hidden" name="task" value="login" />
                 <input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()) ?>" />
                 <?php echo JHTML::_( 'form.token' ); ?>
            </form>
       </div>
    </div>
</div>
</body>
</html>