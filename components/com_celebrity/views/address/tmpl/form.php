<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

//include form validation code
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'loadformvalidation.php');

$celebrityCss   = JURI::base().'components/com_celebrity/assets/css/celebrity.css';
$addressJS      = JURI::base().'components/com_celebrity/js/address.js';
$document->addStyleSheet($celebrityCss);
$document->addScript($addressJS);

?>
<div id="step_container" class="wizard-page">
  <div class="step_header"><span><?php echo JText::_('ADDRESSSTEP2') ?></span></div>
  <div class="step_body" style="height: 520px;">
    <div class="add-address-msg1">
        <?php echo JText::_('NEWADDESSFOR').' "'.$this->celebName.'"' ?>
    </div>
    <div style="float: right; color: #FF0000;">
        <?php echo JText::_('*Required') ?>
    </div>
    <div class="typesContainer">
  <span style="float:left"><?php echo JText::_('ADDRESS') ?>: </span>
  <div class="addressTypes">
    <input type="radio" name="addressType" value="1" id="mailing" checked="checked" />
    <label><?php echo JText::_('MAILINGADDRESS') ?></label>
    <br />
    <input type="radio" name="addressType" value="2" id="email" />
    <label><?php echo JText::_('EMAILADDRESS') ?></label>
    <br />
    <input type="radio" name="addressType" value="3" id="website" />
    <label><?php echo JText::_('WEBSITEADDRESS') ?></label>
    <br />
  </div>     
    </div>
    <div class="typeSeparator"></div>
    <div id="addressForm" style="height: 414px;">
    <?php
        $this->setLayout('mailing');
        echo $this->loadTemplate();
     ?>
    </div>
</div>
</div>