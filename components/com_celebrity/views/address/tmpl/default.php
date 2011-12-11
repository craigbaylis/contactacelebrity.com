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

?>
<div id="step_container" class="wizard-page">
  <div class="step_header"><span><?php echo JText::_('ADDRESSSTEP1') ?> <span class="small-text"><?php echo JText::_('CHECKDUPLICATES') ?></span></span></div>
  <div class="step_body">
    <div class="add-address-msg1"><?php echo JText::_('FIRSTCHECKDB') ?></div>
    <div class="add-address-msg2">
      <h4><?php echo JText::_('CURRENTADDRESSES') ?></h4>
    </div>
    <h2 class="add-address-celeb-name"><?php echo $this->celebName ?></h2>
    <?php if($this->found) : ?>
    <div>
    <div id="mailing-address" class="add-address">
      <h4 class="address-type"><?php echo JText::_('MAILINGADDRESS') ?></h4>
      <ul class="address-list">
        <?php foreach($this->mailingAddresses as $mailingAddress) : ?>
        <li>
          <div><?php echo $mailingAddress->company ?></div>
          <div>
            <?php
                echo $mailingAddress->line_1;
                if($mailingAddress->line_2) echo ', '.$mailingAddress->line_2;
                echo ' - '.$mailingAddress->city;
                echo ', '.$mailingAddress->state;
                if($mailingAddress->zipcode) echo ' '.$mailingAddress->zipcode;
                echo ' * '.$mailingAddress->country;
            ?>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div id="email-address" class="add-address">
      <h4 class="address-type"><?php echo JText::_('EMAILADDRESS') ?></h4>
      <ul class="address-list">
        <?php foreach($this->emailAddresses as $emailAddress) : ?> 
        <li><?php echo $emailAddress->email ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div id="website-address" class="add-address">
      <h4 class="address-type"><?php echo JText::_('WEBSITEADDRESS') ?></h4>
      <ul class="address-list">
        <?php foreach($this->websiteAddresses as $websiteAddress) : ?>
        <li><?php echo $websiteAddress->url ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="add-address-msg3"><?php echo JText::_('IFNOTONEOF') ?></div>
  </div>
  </div>
  <?php else : ?>
  <div>
    <h3 style="text-align:center"><?php echo JText::_('NOADDRESSES') ?></h3>
  </div>
  <?php endif; ?>
  <div class="step_controls">
  <form action="index.php?option=com_celebrity&task=add&cid=<?php echo $this->cid ?>" method="post">
    <button><?php echo JText::_('CONTINUE') ?></button>
    <input type="hidden" name="layout" value="form" />
    <input type="hidden" name="celebName" value="<?php echo $this->celebName ?>" />
    <input type="hidden" name="controller" value="address" />
    <input type="hidden" name="created_by_uid" value="<?php echo $this->created_by_uid ?>" />
  </form>
  </div>
</div>
</div>