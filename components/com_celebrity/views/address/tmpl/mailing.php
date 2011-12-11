<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<form id="mailingForm" name="mailingForm" method="post" action="index.php?option=com_celebrity&task=save" style="background-color: #fff;">
  <label for="addCompany" class="label addressLabel" style="width:150px"><?php echo JText::_('COMPANY') ?>:</label>
  <input type="text" name="company" id="addCompany" tabindex="1" />
  <br />
  <label for="addline1" class="label addressLabel"><?php echo JText::_('ADDRESSLINE1') ?>:</label>
  <input type="text" name="line_1" id="addline1" tabindex="2" class="validate['required']" /><span class="required">*</span>
  <br />
  <label for="addline2" class="label addressLabel"><?php echo JText::_('ADDRESSLINE2') ?>:</label>
  <input type="text" name="line_2" id="addline2" tabindex="3" />
  <br />
  <label for="addCity" class="label addressLabel"><?php echo JText::_('CITYTOWN') ?>:</label>
  <input type="text" name="city" id="addCity" tabindex="4" class="validate['required']" /><span class="required">*</span>
  <br />
  <label for="country_id" class="label addressLabel"><?php echo JText::_('COUNTRY') ?>:</label>
  <?php echo $this->countryDropdown ?>
  <br />
  <label for="addState" class="label addressLabel"><?php echo JText::_('STATEPROVINCE') ?>:</label>
  <select name="state_id" id="addState" tabindex="7" class="validate['required']">
    <?php echo $this->stateOptions ?>
  </select><span class="required">*</span>
  <span id="loadingStates" class="loading" style="visibility: hidden;"><img src="<?php echo JURI::base().'components/com_celebrity/assets/images/spacer.gif' ?>" height="15px" width="15px" /></span>
  <br />
  <label for="addZip" class="label addressLabel"><?php echo JText::_('ZIPCODE') ?>:</label>
  <input type="text" name="zipcode" id="addZip" tabindex="7" class="validate['required']" /><span class="required">*</span><span style="font-size:12px;margin-left:5px;"><?php echo JText::_('USONLY') ?></span>
  <div class="addTemp" id="addTemp">
    <p>
      <label for="addTempVenue" class="label addressLabel"><?php echo JText::_('TEMPVENUE') ?></label>
      <select name="addTempVenue" id="addTempVenue" tabindex="8">
        <option value="<?php echo JText::_('CNO') ?>" selected="selected"><?php echo JText::_('CNO') ?></option>
        <option value="<?php echo JText::_('CYES') ?>"><?php echo JText::_('CYES') ?></option>
      </select>
    </p>
    <p class="add-address-msg3"><?php echo JText::_('TEMPVENUTEXT') ?>:</p>
    <p>
      <label for="addVenueStart" class="label addressLabel"><?php echo JText::_('VENUESTARTDATE') ?>:</label>
      <?php echo $this->startDate ?>
      <br />
      <label for="addVenueEnd" class="label addressLabel"><?php echo JText::_('VENUEENDDATE') ?>:</label>
      <?php echo $this->endDate ?><br />
    </p>
  </div>
  <input type="hidden" name="controller" value="address"/>
  <input type="hidden" name="formSubmitted" value="mailing"/>
  <input type="hidden" name="cid" value="<?php echo JRequest::getInt('cid') ?>" />
  <input type="hidden" id="celebName" name="celebName" value="<?php echo JRequest::getVar('celebName') ?>"/>
  <input type="hidden" name="created_by_uid" value="<?php echo $this->created_by_uid ?>" />
  <input type="submit" name="Submit" id="Submit" value="<?php echo JText::_('SUBMIT') ?>" tabindex="11" style="margin-bottom: 10px;" />
  
</form>