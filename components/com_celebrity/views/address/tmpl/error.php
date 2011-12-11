<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$celebrityCss   = JURI::base().'components/com_celebrity/assets/css/celebrity.css';
$document = JFactory::getDocument();
$document->addStyleSheet($celebrityCss);
?>
<div id="step_container" class="wizard-page">
    <div class="step_header"><span><?php echo $this->errorType ?></span></div>
    <div class="step_body" style="height: 520px;">
        <div class="typesContainer">
            <div class="error"><?php echo $this->error; ?></div>     
        </div>
        <div class="step_controls">
            <form action="index.php?option=com_celebrity&task=add&id=<?php echo $this->id ?>" method="post">
                <button><?php echo JText::_('BACKWARD') ?></button>
                <input type="hidden" name="layout" value="form" />
                <input type="hidden" name="celebName" value="<?php echo $this->celebName ?>" />
                <input type="hidden" name="controller" value="address" />
            </form>
        </div>
    </div>
</div>