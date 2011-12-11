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
$wizard             = JURI::base().'components/com_celebrity/js/FormWizard.js';
$addCelebrityJs     = JURI::base().'components/com_celebrity/js/addCelebrity.js';  

$initialize = "
function almostOne(el){
if(\$('first_name_search').value == '' && \$('last_name_search').value == '')
    {
        el.errors.push('Please enter at least one name');
        return false;
    } else {
        return true;
    }
}
function newText(el){
    var biographyDefaultText = '".JText::_('JUSTONEORTWOSENTENCES',true)."';
    if(\$('biography').value == biographyDefaultText) {
        el.errors.push('Please enter a short bio');
        return false;
    } else {
        return true;
    }
}

window.addEvent('domready',function(){

   var myCelebrityForm = new FormCheck('celebrity'); 
 
    //make sure all fields are enabled after a page refresh
    \$('first_name_search').erase('disabled');
    \$('last_name_search').erase('disabled');
    
    var myform = new FormWizard(
        'celebrity',
        {showControlCaptions: false, wizardControls: [\"forward\",\"backward\",\"submit\"]},
        {
            'Step1':{
                onEnter: function(){
                //make sure any results from step 2 are erased
                \$('search_results').set('html','');
                
                //make sure all fields are enabled for this step
                \$('first_name_search').erase('disabled');
                \$('last_name_search').erase('disabled');
                
                //make sure all fields are disabled for other steps
                \$('first_name').set('disabled',true);
                \$('last_name').set('disabled',true);
                \$('profession').set('disabled',true);
                \$('bmonth').set('disabled',true);
                \$('bday').set('disabled',true);
                \$('byear').set('disabled',true);
                \$('male').set('disabled',true);
                \$('female').set('disabled',true);
                \$('famous_for').set('disabled',true);
                \$('biography').set('disabled',true);
                \$('celebrity_photo').set('disabled',true);
                \$('image_title').set('disabled',true);                
                
                //clear any previous search results from step 3 
                \$('celebrity').reset();
                return true;
                },
                onExit: function(){
                //check field requirements
                var valid = myCelebrityForm.onSubmit();
                if (!valid) return false;
                
                //disable fields that no longer need to be validated
                \$('first_name_search').set('disabled',true);
                \$('last_name_search').set('disabled',true);
                //set previous step
                previous_step = '1';
                \$('search_results').addClass('loader');
                return true;
            }},
                                                                                                                                                                 
            'Step2':{
                onEnter: function(){
                //search for celebrity
                if(previous_step == '1')
                celebSearch();
                
                //clear and errors messages from previous step
                \$\$('#celebrity input').each(function(item, index){
                    myCelebrityForm.removeError(item);
                }); 
                
                //set the name in the next form
                \$('first_name').value = \$('first_name_search').value;
                \$('last_name').value = \$('last_name_search').value;
                
                //enable required fields for next step
                \$('first_name').erase('disabled');
                \$('last_name').erase('disabled');
                \$('profession').erase('disabled');
                \$('bmonth').erase('disabled');
                \$('bday').erase('disabled');
                \$('byear').erase('disabled');
                \$('male').erase('disabled');
                \$('female').erase('disabled');
                \$('famous_for').erase('disabled');
                \$('biography').erase('disabled');
                \$('celebrity_photo').erase('disabled');
                \$('image_title').erase('disabled');
                
                return true;
            },
                onExit: function(){
                //set previous step
                previous_step = '2';
                return true;
            }},
            'Step3':{
                onExit: function(){               
                //set the previous step
                previous_step = '3';
                return true;
            }}
        }
    );
    \$('biography').addEvent('focus',function(){
        this.value = '';
    });  
});";

$celebrityCss = JURI::base().'components/com_celebrity/assets/css/celebrity.css';

//include form validation code
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'loadformvalidation.php');

//add scripts & css
$document->addScript($more);
$document->addScript($wizard);
$document->addScript($addCelebrityJs);
$document->addScriptDeclaration($initialize);
$document->addStyleSheet($celebrityCss);

?>
<div id="formLeft" class="formLeft">
<form id="celebrity" name="celebrity" method="post" action="index.php?option=com_celebrity&amp;view=celebrity&amp;task=save" enctype="multipart/form-data">
    
    <fieldset id="Step1" class="wizard-page">
        <div class="step_header"><span><?php echo JText::_('STEP1TITLE') ?></span></div>
        <div class="step_body">
        <div class="step_message1"><span><?php echo JText::_('STEP1DESC') ?></span><span class="required">*</span></div>
            <div class="field">
                <label for="first_name_search" class="label"><?php echo JText::_('CELEBFIRSTNAME');?></label>
                <input id="first_name_search" class="validate['%almostOne']" type="text" name="first_name_search" value="<?php echo $this->celebrity['first_name_search'] ?>" />
            </div>
            <div class="field">
                <label for="last_name_search" class="label"><?php echo JText::_('CELEBLASTNAME');?></label>
                <input id="last_name_search" type="text" name="last_name_search" value="<?php echo $this->celebrity['last_name_search'] ?>" />
            </div>
        <div>
            <span class="required">*<?php echo JText::_('You must enter at least the celebrity\'s first name or last name' ) ?></span>
        </div>            
        </div>
        <div class="step_controls">
            <button class="wizard-control-forward wizard-button"><?php echo JText::_('CONTINUE') ?></button>
        </div>
    </fieldset>

    <fieldset id="Step2" class="wizard-page"><div class="step_header"><span><?php echo JText::_('STEP1TITLE') ?></span></div>
        <div id="search_results"></div>
        <div class="step_controls">
        <button class="wizard-control-backward wizard-button"><?php echo JText::_('BACKWARD') ?></button>
        <button class="wizard-control-forward wizard-button"><?php echo JText::_('CONTINUE') ?></button>
        </div>
    </fieldset>
    
    <fieldset id="Step3" class="wizard-page">
        <div class="step_header"><span><?php echo JText::_('STEP2TITLE') ?></span></div>
        <div class="step_body">
        <div class="step_message2"><span><?php echo JText::_('STEP2DESC') ?></span><span class="required" style="float: right;"><?php echo JText::_('REQUIRED') ?></span></div>
             
             <div class="field">
                <label for="first_name" class="label"><?php echo JText::_('CELEBFIRSTNAME');?></label>
                <input id="first_name" disabled="disabled" class="validate['required']" type="text" name="first_name" value="<?php echo $this->celebrity['first_name'] ?>" />
                <span class="required">*</span>
            </div>
            <div class="field">
                <label for="middle_name" class="label"><?php echo JText::_('CELEBMIDDLENAME');?></label>
                <input id="middle_name" type="text" name="middle_name" value="<?php echo $this->celebrity['middle_name'] ?>" />
            </div>
            <div class="field">
                <label for="last_name" class="label"><?php echo JText::_('CELEBLASTNAME');?></label>
                <input id="last_name" disabled="disabled" class="validate['required']" type="text" name="last_name" value="<?php echo $this->celebrity['last_name'] ?>" />
                <span class="required">*</span>
            </div>
            <div class="field">
                <label for="alias" class="label"><?php echo JText::_('ALSOKNOWNAS');?></label>
                <input id="alias" type="text" name="alias" value="<?php echo $this->celebrity['alias'] ?>" />
            </div>
            <div class="field">
                <label for="profession" class="label"><?php echo JText::_('PROFESSION');?></label>
                <?php echo $this->professions ?><span class="required">*</span>
            </div>
            <div class="field">
                <label for="birthdate" class="label"><?php echo JText::_('BIRTHDATE');?><span class="required">*</span></label>
                <select id="bmonth" class="validate['required'] bmonth" disabled="disabled" name="bmonth">
                    <option value="0" selected><?php echo JText::_('MONTH')?></option>
                    <option value="1">Jan</option>
                    <option value="2">Feb</option>
                    <option value="3">Mar</option>
                    <option value="4">Apr</option>
                    <option value="5">May</option>
                    <option value="6">Jun</option>
                    <option value="7">Jul</option>
                    <option value="8">Aug</option>
                    <option value="9">Sep</option>
                    <option value="10">Oct</option>
                    <option value="11">Nov</option>
                    <option value="12">Dec</option>
                </select>
                <select id="bday" class="validate['required'] bday" disabled="disabled" name="bday">
                    <option value="0"><?php echo JText::_('DAY') ?></option>
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select id="byear" class="validate['required'] byear" disabled="disabled" name="byear">
                    <?php echo $this->byear ?>
                </select>
                <span class="required">*</span>
            </div>
            <div class="field">
                <label for="birth_place" class="label"><?php echo JText::_('PLACEOFBIRTH');?></label>
                <input id="birth_place" type="text" name="birth_place" value="<?php echo $this->celebrity['birth_place'] ?>" />
            </div>
        <div class="field">
            <label for="hair_color" class="label"><?php echo JText::_('NATURALHAIRCOLOR');?></label>
            <select id="hair_color" class="hair_color" name="hair_color">
                <option value="0" selected><?php echo JText::_('COLOR')?></option>
                <option value="Black">Black</option>
                <option value="Blonde">Blonde</option>
                <option value="Brown">Brown</option>
                <option value="Gray">Gray</option>
                <option value="Red">Red</option>
                <option value="White">White</option>
            </select>
        </div>
        <div class="field">
            <label for="eye_color" class="label"><?php echo JText::_('EYECOLOR');?></label>
            <select id="eye_color" class="eye_color" name="eye_color" >
                <option value="0" selected><?php echo JText::_('COLOR')?></option>
                <option value="Black">Black</option>
                <option value="Brown">Brown</option>
                <option value="Light Brown">Light Brown</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
                <option value="White">White</option>
            </select>
        </div>
        <div class="field">
            <label class="label"><?php echo JText::_('GENDER') ?></label>
        <div style="display: inline-block;">
            <label for="male" class="label" style="float: none; width: auto;"><?php echo JText::_('MALE') ?></label>
            <input type="radio" class="validate['required']" disabled="disabled" name="gender" value="Male" id="male" style="vertical-align: baseline;" />
            <label for="female" class="label" style="float: none; width: auto;"><?php echo JText::_('FEMALE') ?></label>
            <input type="radio" disabled="disabled" name="gender" value="Female" id="female" style="vertical-align: baseline;" />
            <span class="required">*</span>
        </div>
        </div>
        <div class="field">
            <label for="famous_for" class="label"><?php echo JText::_('MOSTFAMOUSFOR') ?></label>
            <input id="famous_for" disabled="disabled" class="validate['required']" name="famous_for" type="text" />
            <span class="required">*</span>
        </div>
        <div class="field">
            <label for="biography" class="label"><?php echo JText::_('MINIBIOGRAPHY');?></label>
            <textarea id="biography" class="validate['required','%newText']" disabled="disabled" name="biography" cols="50" rows="5"><?php echo JText::_('JUSTONEORTWOSENTENCES') ?></textarea>
            <span class="required">*</span>
        </div>
        <div id="photo_upload" class="field">
            <label for="celebrity_photo" class="label"><?php echo JText::_('UPLOADIMAGE') ?></label>
            <input id="celebrity_photo" disabled="disabled" class="validate['required']" type="file" name="celebrity_photo" value="<?php echo JText::_('UPLOADIMAGE') ?>"/>
            <span class="required">*</span>
        </div>
        <div id="image_title_container" class="field">
            <label for="image_title" class="label"><?php echo JText::_('IMAGETITLE') ?></label>
            <input type="text" disabled="disabled" class="validate['required']" name="image_title" id="image_title">
            <span class="required">*</span>
        </div>
        </div>
       <div class="step_controls">
        <button class="wizard-control-backward wizard-button"><?php echo JText::_('BACKWARD') ?></button>
        <button class="wizard-control-submit wizard-button" type="submit"><?php echo JText::_('SAVE')?></button>
       </div>
    </fieldset>
    <input type="hidden" name="is_deceased" value="0" />
    <input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
    <input type="hidden" name="controller" value="celebrity" />
</form>
</div>