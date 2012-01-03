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
//get user details
$user =& JFactory::getUser();
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
.pdeceased{
margin:8px;	
}
textarea{
	width:auto;
}
#bg{
background:none;	
}
</style>
<div id="formLeft" class="formLeft">
<form id="celebrity" name="celebrity" method="post" action="index.php?option=com_celebrity&task=deceasedsave&controller=deceased" target="_parent" enctype="multipart/form-data">
    
    <fieldset id="Step3" class="wizard-page">
<div class="step_header"><span><?php echo $this->celebname[0]->full_name;?> - <?php echo JText::_('Report Deceased');?></span></div>

<p class="pdeceased">Please ONLY use this page if you're reporting that <?php echo $this->celebname[0]->full_name;?> is now deceased and you're 100% sure.This page is not used to send message to celebrities!.</p>
<p class="pdeceased">if you incorrectly maliciously report celebrities as deceased. your membership will be revoked and banned</p>
  <div id="photo_upload" class="field">
            <label for="celebrity_photo" class="label"><?php echo JText::_('Date Deceased') ?></label>           <select class="validate['required']" name="desdate" id="desdate">
            <!--date-->
		<option value=""><?php echo JText::_('Date');?></option>
        <?php for($d=1;$d<=31;$d++){?>
   		<option value="<?php echo $d;?>"><?php echo $d;?></option>
        <?php }?>
           </select>  
          <!--date-->
          <!--month-->
             <select class="validate['required']" name="desmonth" id="desmonth">
		<option value=""><?php echo JText::_('Month');?></option>
         <?php
		 $month = array(1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");
		  foreach($month as $key=>$value){?>
   		<option value="<?php echo $key;?>"><?php echo $value;?></option>
        <?php }?>
           </select>
          <!--Year-->
               <select class="validate['required']" name="desyear" id="desyear">
		<option value=""><?php echo JText::_('Year');?></option>
          <?php for($y=date('Y');$y>=1900;$y--){?>
   		<option value="<?php echo $y;?>"><?php echo $y;?></option>
        <?php }?>
           </select>
           <!--Year-->
            <span class="required">*</span>
        </div>
          <div id="photo_upload" class="field">
            <label for="celebrity_photo" class="label"><?php echo JText::_('Input News Link') ?></label>         <input type="text" name="news_link"  id="news_link"  class="validate['required','url']" />
           <!--Year-->
            <span class="required">*</span>
        </div>
        <div id="image_title_container" class="field">
            <label for="offercondolences" class="label"><?php echo JText::_('Cause of death') ?></label>
            <textarea  class="validate['required']" name="comment" id="comment"></textarea>
            <span class="required">*</span>
        </div>     
      <div id="image_title_container" class="field">
           <label for="offercondolences" class="label"><?php echo JText::_('Offer condolences') ?></label>
            <textarea class="validate['required']" name="offer_cond" id="offer_cond"></textarea>
            <span class="required">*</span>
        </div> 
    <div  class="field" style="float:right">
     <input type="checkbox" name="confirmreport"  id="confirmreport"  class="validate['required']" value="1" />
           <label for="offercondolences" ><?php echo JText::_('I confirm that '.$this->celebname[0]->full_name.' is deceased') ?></label>
            <span class="required">*</span>
        </div>              


 <div class="step_controls">
<button class="wizard-control-submit wizard-button" type="submit"><?php echo JText::_('SAVE')?></button>
       </div>
    </fieldset>
    <input type="hidden" name="celebrity_name" value="<?php echo $this->celebname[0]->full_name;?>" />
    <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
    <input type="hidden" name="cid" value="<?php echo Jrequest::getcmd("cid");?>" />

</form>