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

defined('_JEXEC') or die('Restricted access');
if (!defined ('_GK_DROPLINE_MENU_CLASS')) {
	define ('_GK_DROPLINE_MENU_CLASS', 1);
	require_once (dirname(__FILE__).DS."base.class.php");

	class GKMenuDropline extends GKMenuBase{
		function __construct ($params) {
			parent::__construct($params);

			//To show sub menu on a separated place
			$this->showSeparatedSub = true;
		}

	    function genMenu($startlevel=0, $endlevel = 10){
			if ($startlevel == 0) parent::genMenu(0,0);
			else {
				$this->setParam('startlevel', $startlevel);
				$this->setParam('endlevel', $endlevel);
				$this->beginMenu($startlevel, $endlevel);
				//Sub level
				$pid = $this->getParentId($startlevel - 1);
				if (@$this->children[$pid]) {
					foreach ($this->children[$pid] as $row) {
						if (@$this->children[$row->id]) {
							$this->genMenuItems ($row->id, $startlevel);
						} else {
							echo "<ul id=\"gksdl-subnav{$row->id}\"><li class=\"empty\">&nbsp;</li></ul>";
						}
					}
				}
				$this->endMenu($startlevel, $endlevel);
			}
		}
		
		function genMenuItems1($pid, $level) {
			if (@$this->children[$pid]) {
				$this->beginMenuItems($pid, $level);
				$i = 0;
				foreach ($this->children[$pid] as $row) {
					$pos = ($i == 0 ) ? 'first' : (($i == count($this->children[$pid])-1) ? 'last' :'');

					$this->beginMenuItem($row, $level, $pos);
					$this->genMenuItem( $row, $level, $pos);

					// show menu with menu expanded - submenus visible
					if ($level < $this->getParam('endlevel')) $this->genMenuItems( $row->id, $level+1 );
					$i++;

					if ($level == 0 && $pos == 'last' && in_array($row->id, $this->open)) {
						global $jaMainmenuLastItemActive;
						$jaMainmenuLastItemActive = true;
					}
					$this->endMenuItem($row, $level, $pos);
				}
				$this->endMenuItems($pid, $level);
			} else if ($level==1){
				echo "<ul id=\"gksdl-subnav$pid\"><li>&nbsp;</li></ul>";
			}
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
		
        function beginMenuItems($pid=0, $level=0){
            if(!$level) echo "<ul id=\"gk-menu\" class=\"level0\">";
			else echo "<ul id=\"gksdl-subnav$pid\">";
        }

        function beginMenuItem($mitem=null, $level = 0, $pos = ''){
			$active = $this->genClass ($mitem, $level, $pos);
            if(!$level) echo "<li id=\"gksdl-mainnav{$mitem->id}\" $active>";
			else echo "<li id=\"gksdl-subnavitem{$mitem->id}\" $active>";
        }

        function beginMenu($startlevel=0, $endlevel = 10){
            if(!$startlevel) echo "<div id=\"gksdl-mainnav\" class=\"gk-menu\">";
            else echo "<div id=\"gksdl-subnav\">";			
        }

		function endMenu($startlevel=0, $endlevel = 10){
			echo "</div>";
			if(!$startlevel) {
				echo "
				<script type=\"text/javascript\">
					var gksdl_activemenu = new Array(". ( (count($this->open) == 1) ? "\"".$this->open[0]."\"" : implode(",", array_reverse($this->open)) ) .");
				</script>
				";
			}
		}

		function hasSubMenu($level) {
			return true;
		}
	}
}
?>
