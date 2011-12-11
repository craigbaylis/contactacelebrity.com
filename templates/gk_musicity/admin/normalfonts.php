<?php

// access denied
defined('JPATH_BASE') or die();
 
class JElementNormalFonts extends JElement
{
	// name of element
	var $_name = 'NormalFonts';
	// Construct an array of the HTML OPTION statements.
	var $_options = array();
	// function to create an element
	function fetchElement($name, $value, &$node, $control_name)
	{
        // Base name of the HTML control.
        $ctrl  = $control_name .'['. $name .']';
		// iterating
		$temp_options = array(
            array('1','Verdana'),
            array('2','Georgia'),
            array('3','Arial'),
            array('4','Impact'),
            array('5','Tahoma'),
            array('6','Trebuchet MS'),
            array('7','Arial Black'),
            array('8','Times New Roman'),
            array('9','Palatino Linotype'),
            array('10','Lucida Sans Unicode'),
            array('11','MS Serif'),
            array('12','Comic Sans MS'),
            array('13','Courier New'),
            array('14','Lucida Console')
        );
		
		foreach ($temp_options as $option) {
    	   $this->_options[] = JHTML::_('select.option', $option[0], JText::_($option[1]));
    	}		
		// Construct the various argument calls that are supported.
        $attribs = ' ';
        if ($v = $node->attributes( 'size' )) $attribs .= 'size="'.$v.'"';
        if ($v = $node->attributes( 'class' )) $attribs .= 'class="'.$v.'"';
        else $attribs .= 'class="inputbox"';
        // Render the HTML SELECT list.
        return JHTML::_('select.genericlist', $this->_options, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name );	
	}
}