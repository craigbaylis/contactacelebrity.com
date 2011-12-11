<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$celebrityCss = JURI::base().'components/com_celebrity/assets/css/celebrity.css';
$document   = JFactory::getDocument();

//add CSS
$document->addStyleSheet($celebrityCss);

//add redirect back to celebrity page after 2 seconds
$document->setMetaData('REFRESH','2; url='.JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$this->cid.'&Itemid='.$this->itemid),true);

?>
<div id="step_container" class="wizard-page">
    <div class="step_header">
        <span><?php echo JText::_('ADDRESSTHANKSSTEP') ?></span>
    </div>
    <div class="step_body">
        <div class="add-address-msg1"><?php echo JText::_('ADDRESSTHANKYOU') ?></div>
    </div>
</div>