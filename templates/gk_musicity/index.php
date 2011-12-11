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

include_once (dirname(__FILE__).DS.'libs'.DS.'gk.template.helper.php');

$tmpl = GKTemplateHelper::getInstance($this, array('ui', GK_TOOL_SCREEN, GK_TOOL_MENU, 'main_layout', 'direction'));

//Calculate the width of template
$tmplWidth = '';
$tmplWrapMin = '100%';
switch ($tmpl->getParam(GK_TOOL_SCREEN)){
	case 'auto':
		$tmplWidth = '97%';
		break;
	case 'fluid':
		$tmplWidth = intval($tmpl->getParam('gk_screen-fluid-fix-gk_screen_width'));
		$tmplWidth = $tmplWidth ? $tmplWidth.'%' : '90%';
		break;
	case 'fix':
		$tmplWidth = intval($tmpl->getParam('gk_screen-fluid-fix-gk_screen_width'));
		$tmplWrapMin = $tmplWidth ? ($tmplWidth+1).'px' : '1003px';
		$tmplWidth = $tmplWidth ? $tmplWidth.'px' : '1002px';
		break;
	default:
		$tmplWidth = intval($tmpl->getParam(GK_TOOL_SCREEN));
		$tmplWrapMin = $tmplWidth ? ($tmplWidth+1).'px' : '1003px';
		$tmplWidth = $tmplWidth ? $tmplWidth.'px' : '1002px';
		break;
}

$tmpl->setParam ('tmplWidth', $tmplWidth);
$tmpl->setParam ('tmplWrapMin', $tmplWrapMin);

//Main navigation
$gk_menutype = $tmpl->getMenuType();
$gkmenu = null;
if ($gk_menutype && $gk_menutype != 'none') {
	$gkparams = new JParameter('');
	$gkparams->set( 'menutype', $tmpl->getParam('menutype', 'mainmenu') );
	$gkparams->set( 'menu_images_align', 'left' );
	$gkparams->set( 'menupath', $tmpl->templateurl() .'/gk_menus');
	$gkparams->set('menu_images', 1); //0: not show image, 1: show image which set in menu item
	$gkparams->set('menu_background', 1); //0: image, 1: background
	$gkparams->set('mega-colwidth', 200); //Megamenu only: Default column width
	$gkparams->set('mega-style', 1); //Megamenu only: Menu style. 
	$gkparams->set('rtl',($tmpl->getParam('direction')=='rtl' || $tmpl->direction == 'rtl'));
	$gkmenu = $tmpl->loadMenu($gkparams, $gk_menutype); 
}	
//End for main navigation

$layout = $tmpl->getLayout ();

if ($layout) {
	$tmpl->display($layout);
}