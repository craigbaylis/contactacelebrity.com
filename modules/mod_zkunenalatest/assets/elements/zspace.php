<?php
/**
 * @version		0.40
 * @package		zKunenaLatest
 * @author		Aaron Gilbert {@link http://www.nzambi.braineater.ca}
 * @author		Created on 22-Dec-2010
 * @copyright	Copyright (C) 2009 - 2010 Aaron Gilbert. All rights reserved.
 * @license		GNU/GPL, see http://www.gnu.org/licenses/gpl-2.0.html
 *
 */
//-- No direct access
defined('_JEXEC') or die('Restricted access');

class JElementZspace extends JElement {
	
	function fetchElement($name, $value, &$node, $control_name){
		JHTML::stylesheet('params.css','modules/mod_zkunenalatest/assets/');
		$attributes = $node->attributes();
		$string = "";
		$string .= '<div class="zKparamSpace" >'. JText::_($attributes['title']). '</div>';
		return $string;
	}
	
} // class
?>