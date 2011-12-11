<?php

/*
#------------------------------------------------------------------------
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

defined( '_VALID_MOS' ) or defined('_JEXEC') or die('Restricted access');
if (!defined ('_GK_SPLIT_MENU_CLASS')) {
	define ('_GK_SPLIT_MENU_CLASS', 1);
	require_once (dirname(__FILE__).DS."base.class.php");

	class GKMenuSplit extends GKMenuBase{

		function __construct (&$params) {
			parent::__construct($params);

			//To show sub menu on a separated place
			$this->showSeparatedSub = true;
		}

		function beginMenu($startlevel=0, $endlevel = 10){
			if ($startlevel == 0) {
				echo "<div id=\"gksdl-mainnav\" class=\"gk-menu mainlevel clearfix\">\n";
			} else {
				echo "<div class=\"gksdl-subnav\">\n";
			}
		}
		function endMenu($startlevel=0, $endlevel = 10){
			echo "\n</div>";
		}
		function beginMenuItems($pid=0, $level=0){
			if ($level == 1)
				echo "<ul class=\"active\">";
			else
				echo "<ul class=\"level0\">";
		}
		function genMenu($startlevel=0, $endlevel = 10){
			if ($startlevel == 0) parent::genMenu(0,0);
			else parent::genMenu($startlevel, $endlevel);
		}


		function genClass ($mitem, $level, $pos) {
			$iParams = new JParameter ( $mitem->params );
			$active = in_array($mitem->id, $this->open);
			$cls = "mega".($active?" active":"").($pos?" $pos":"");
			if (@$this->children[$mitem->id] || (isset($mitem->content) && $mitem->content)) {
				if ($mitem->megaparams->get('group')) $cls .= " group";
				else if ($level < $this->getParam('endlevel')) $cls .= " haschild";
			}
			if ($mitem->megaparams->get('class')) $cls .= " ".$mitem->megaparams->get('class');
			return $cls?"class=\"$cls\"":"";
		}

		function beginMenuItem($mitem=null, $level = 0, $pos = ''){
			$active = $this->genClass ($mitem, $level, $pos);
			echo "<li ".$active.">";
		}

	}
}
?>
