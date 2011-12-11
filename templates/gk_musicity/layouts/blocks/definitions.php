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

$user =& JFactory::getUser();
// getting User ID
$userID = $user->get('id');
// getting page configuration
$config = new JConfig();
// defines if Twitter icon is active
define('GK_TWITTER', $this->_tpl->params->get("twitter_button",1));
define('GK_TWITTER_URL', $this->_tpl->params->get("twitter_url",''));
// defines if Facebook icon is active
define('GK_FB', $this->_tpl->params->get("fb_button",1));
define('GK_FB_URL', $this->_tpl->params->get("fb_url",''));
// defines logo
define('GK_LOGO',(trim($this->getParam('logoType-text-logoText'))=='') ? $config->sitename : $this->getParam('logoType-text-logoText'));
// defines slogan
define('GK_SLOGAN',(trim($this->getParam('logoType-text-sloganText'))=='') ? JText::_('SITE SLOGAN') : $this->getParam('logoType-text-sloganText'));

?>