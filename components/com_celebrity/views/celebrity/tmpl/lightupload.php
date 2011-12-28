<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();

$more               = JURI::base().'components/com_celebrity/js/mootools-1.2.5.1-more.js';
$initialize = "
window.addEvent('domready',function(){

   var myCelebrityForm = new FormCheck('celebrity'); 
});";

$celebrityCss = JURI::base().'components/com_celebrity/assets/css/celebrity.css';

//include form validation code
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'loadformvalidation.php');

//add scripts & css
$document->addScript($more);
$document->addScriptDeclaration($initialize);
$document->addStyleSheet($celebrityCss);
?>
<script>
window.onload = function (){document.getElementById("gk-top").style.display = 'none';document.getElementById("gk-bottom-wrap").style.display = 'none'; }
</script>
<style>
#mainPage{
width:522px;
margin-left:-14px;	
margin-top:-20px
}
</style>
<div id="formLeft" class="formLeft">
<form id="celebrity" name="celebrity" method="post" action="index.php?option=com_celebrity&task=lightuploadsave&controller=celebrity" target="_parent" enctype="multipart/form-data">
    
    <fieldset id="Step3" class="wizard-page">
<div class="step_header"><span>Upload a photo -  <?php echo $this->celebname[0]->full_name;?></span></div>

  <div id="photo_upload" class="field">
            <label for="celebrity_photo" class="label"><?php echo JText::_('UPLOADIMAGE') ?></label>
            <input id="celebrity_photo" class="validate['required']" type="file" name="celebrity_photo" value="<?php echo JText::_('UPLOADIMAGE') ?>"/>
            <span class="required">*</span>
        </div>
        <div id="image_title_container" class="field">
            <label for="image_title" class="label"><?php echo JText::_('IMAGETITLE') ?></label>
            <input type="text"  class="validate['required']" name="image_title" id="image_title">
            <span class="required">*</span>
        </div>

 <div class="step_controls">
<?php /*?>        <button class="wizard-button" onclick="go.history(-1)"><?php echo JText::_('BACKWARD') ?></button>
<?php */?>        <button class="wizard-control-submit wizard-button" type="submit"><?php echo JText::_('SAVE')?></button>
       </div>
    </fieldset>
     <input type="hidden" name="album_id" value="<?php echo Jrequest::getcmd("album_id");?>" />    
    <input type="hidden" name="celebrity_name" value="<?php echo $this->celebname[0]->full_name;?>" />
    <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
    <input type="hidden" name="cid" value="<?php echo Jrequest::getcmd("cid");?>" />

</form>