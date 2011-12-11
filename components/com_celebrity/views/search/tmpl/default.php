<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$css = JURI::base().'components/com_celebrity/assets/css/celebrity.css';
$document = JFactory::getDocument();
$document->addStyleSheet($css);
$letter = JRequest::getCmd('letter');
$component_header_txt = JText::_('MATCHESFOR'); 
$js = <<<SCRIPT
window.addEvent('domready',function(){
    if ($$('.search-letter')) $$('.search-letter').removeClass('active-letter');
    if ($('letter$letter')) $('letter$letter').addClass('active-letter');
    if ($('component-header')) {
        $('component-header').set('html','$component_header_txt');
        $('component-header').addClass('component-header');
    } 
});
SCRIPT;
$document->addScriptDeclaration($js);
?>
<?php 
if (!empty($this->celebrities)) {
   echo $this->loadTemplate('search');
} else {
   echo $this->loadTemplate('noresults');
}
?>