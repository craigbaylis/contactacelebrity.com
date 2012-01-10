<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
$css = JURI::base().'components/com_celebrity/assets/css/celebrity.css';
$resultsform = JURI::base().'components/com_celebrity/js/resultsform.js';

$phpjsvariables = "
 var othersuccesses = '$this->otherSuccesses';
 var max_image_uploads = '$this->max_image_uploads';
 
";
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'loadformvalidation.php');
$document->addScriptDeclaration($phpjsvariables);
$document->addScript($resultsform);
$document->addStyleSheet($css);
?>
<style>
#photo {
	text-align: center;
	width:0px;
	float:none;
}
</style>
<div id="addresult">
  <h1 class="componentheading" style="text-align: center;"><?php echo JText::_('My Mail Results for ') ?><span class="celebrity-name"><?php echo $this->celebrity->first_name.' '.$this->celebrity->last_name ?></span></h1>
  <p><?php echo JText::_('If you\'ve sent something to ') ?><span class="celebrityname"><?php echo $this->celebrity->first_name.' '.$this->celebrity->last_name ?></span><?php echo JText::_(' at the address below, please share your results with our Community!') ?></p>
  <form id="result" name="result" method="post" action="index.php?option=com_celebrity" enctype="multipart/form-data">
  <div style="margin-top:10px;">
      <label for="address" class="normal-label"><?php echo JText::_('Where I sent it') ?></label>
    <input type="checkbox" class="validate['required']" name="address" value="confirmed" id="address" tabindex="1" style="vertical-align:top" />
    <div class="confirm-address">
        <?php if($this->address->company) echo $this->address->company.'<br />' ?>
        <?php if($this->address->line_1) echo $this->address->line_1.'<br />' ?>
        <?php if($this->address->line_2) echo $this->address->line_2.'<br />' ?>
        <?php if($this->address->city) echo $this->address->city.', '; if($this->address->state) echo $this->address->state; if($this->address->zipcode) echo ' '.$this->address->zipcode; ?><br />
        <?php if($this->address->country) echo $this->address->country ?> 
    </div>
  </div>
  
  <div>
      <label for="date_sent" class="normal-label"><?php echo JText::_('When I sent it') ?></label>
    <?php echo $this->date_sent ?>
  </div> 
    
  <fieldset>
    <legend><?php echo JText::_('What I sent <span style="font-style: italic;">(check all that apply)</span>') ?></legend>
    <?php foreach($this->resultsenttypes AS $resultsenttype) : ?>
    <input id="<?php echo $resultsenttype->name ?>" class="sent-item validate['checkboxes_group[1]']" name="sent_types['<?php echo $resultsenttype->name ?>']" type="checkbox" value="<?php echo $resultsenttype->id ?>" /><label for="<?php echo $resultsenttype->name ?>"><?php echo $resultsenttype->label ?></label>
    <?php endforeach; ?>
  </fieldset>

  <fieldset>
    <legend><?php echo JText::_('My Result') ?></legend>
    <?php foreach($this->resultreceivedtypes AS $resultreceivedtype): ?>
    <input id="<?php echo $resultreceivedtype->name ?>" class="radio validate['radio']" name="received_type_id" type="radio" value="<?php echo $resultreceivedtype->id ?>" /><label for="<?php echo $resultreceivedtype->name ?>"><?php echo $resultreceivedtype->label ?></label>
    <?php endforeach; ?>
  </fieldset>

  <div>
      <label for="quality" class="normal-label"><?php echo JText::_('Quality') ?></label>
      <?php echo $this->qualitytypedropdown ?>
  </div>
  
  <div>
  
  <div>
      <label for="date_received" class="normal-label"><?php echo JText::_('When I received it') ?></label>
    <?php echo $this->date_received ?>
  </div> 
 <?php if($this->max_image_uploads) : ?>  
  <div>
  <fieldset>
      <legend><span style="float: left;"><?php echo JText::_('Look what I got') ?></span><button id="addButton" type="button" style="float: right; padding-top: 0;padding-bottom: 0;"><?php echo JText::_('Add Extra Image') ?></button></legend>
      <div id="imagegroup1" class="imagegroup">
          <div>
            <label for="scannedimage1" class="normal-label"><?php echo JText::_('Upload Image') ?></label>
            <input id="scannedimage1" type="file" name="scannedimage1" />
          </div>
          <div>
            <label for="imagetitle1" class="normal-label"><?php echo JText::_('Image Title') ?></label>
            <input id="imagetitle1" type="text" name="imagetitle1" disabled="disabled" class="validate['required','length[2,50]']" />
          </div>
          <div>
            <label for="caption1" class="wide-label"><?php echo JText::_('Image Caption (for premium members, this will show up in your Autograph Gallery)') ?></label>
            <textarea id="caption1" name="caption1" class="caption validate['required']" disabled="disabled"></textarea>
          </div>
      </div>
                 
   </fieldset>
  </div>
  <?php endif; ?>
  <label for="comments" class="wide-label">Comments about your celebrity or experience</label>
  <textarea id="comments" name="comments" class="comments"></textarea>  
</div>
    <input type="submit" value="submit" />
    <input type="hidden" name="cid" value="<?php echo $this->celebrity->id ?>" />    
    <input type="hidden" name="address_id" value="<?php echo $this->address->id ?>" />
    <input type="hidden" name="controller" value="result" />
    <input type="hidden" name="task" value="save" />
    <input type="hidden" name="itemid" value="<?php echo JRequest::getInt('Itemid') ?>"/>
    <?php echo JHTML::_('form.token'); ?> 
    <input type="hidden" name="anumber" value="<?php echo JRequest::getcmd('anumber');?>" />
    <input type="hidden" name="type" value="<?php echo JRequest::getcmd('type');?>" />
    </form>
</div>