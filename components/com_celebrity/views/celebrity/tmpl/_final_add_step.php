<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

//add CSS
$celebrityCss   = JURI::base().'components/com_celebrity/assets/css/celebrity.css'; 
$document       =& JFactory::getDocument();
$document->addStyleSheet($celebrityCss);

?>
<div id="step_container" class="wizard-page">
    <div class="step_header"><span><?php echo JText::_('STEP3TITLE') ?></span></div>
    <div class="step_body">
        <div class="step_message1"><span><?php echo JText::sprintf('THANKS4ADDING',$this->first_name,$this->last_name) ?></span></div>
        <div class="step_message2"><span><?php echo JText::_('WHATNEXT') ?></span></div>
        <ul class="step_list">
        <li><a href="index.php"><?php echo JText::sprintf('RECEIVEALERT',$this->first_name,$this->last_name) ?></a></li>
        <li><a href="<?php echo $this->addAddressLink ?>"><?php echo JText::sprintf('ADDADDRESS',$this->first_name,$this->last_name)?></a></li>
        <li><a href="<?php echo $this->addMoreLink ?>"><?php echo JText::_('SEARCH4MORE') ?></a></li>
        </ul>
    </div>
</div>