<?php

/**
* @version		$Id: mod_feed.php 10396 2009 design4now $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

//check if cache diretory is writable as cache files will be created for the feed
$cacheDir = JPATH_BASE.DS.'cache';
if (!is_writable($cacheDir))
{
	echo '<div>';
	echo JText::_('Please make cache directory writable.');
	echo '</div>';
	return;
}

$feedtotal = array();

$picture =  $params->get('picture', '1');
$feed = modMyEbay_SearchHelper::getMyEbay_Search($params);
for ($a=0; $a<count($feed->items); $a++) {
	$feedtotal[$a]["date"] = $feed->items[$a]->get_date('H:i');
	$feedtotal[$a]["dateU"] = $feed->items[$a]->get_date('U');
	$feedtotal[$a]["feedtitle"] = ''; //$params->get('rsstitle'.$total, '');
	$feedtotal[$a]["url"] = $feed->items[$a]->get_link();
	$feedtotal[$a]["title"] = $feed->items[$a]->get_title();
	$feedtotal[$a]["description"] = $feed->items[$a]->get_description();
			
	if (!$picture){
		// remove pictures from description
		$feedtotal[$a]["description"] = preg_replace('#(<[/]?img.*>)#U', '', $feedtotal[$a]["description"]);
		
		// define only price on listed items & erase description
		$temp = explode ("<strong>", $feed->items[$a]->get_description());
		$temp2 = explode ("</strong>",$temp[1]);
		$feedtotal[$a]["price"] = $temp2[0];
		$feedtotal[$a]["description"] = "";
	}
}
require(JModuleHelper::getLayoutPath('mod_MyEbay_Search'));
?>