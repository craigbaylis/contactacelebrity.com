<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<form id="websiteForm" name="websiteForm" method="post" action="index.php?option=com_celebrity&task=save">
  <label for="websiteAddress">Website Address</label>
  <input type="text" name="websiteAddress" id="websiteAddress" class="validate['required','url']" />
  <input type="hidden" name="controller" value="address"/>
  <input type="hidden" name="formSubmitted" value="website"/>
  <input type="hidden" name="cid" value="<?php echo JRequest::getInt('cid') ?>" />
  <input type="hidden" id="celebName" name="celebName" value="<?php echo JRequest::getVar('celebName') ?>"/>
  <input type="hidden" name="created_by_uid" value="<?php echo $this->created_by_uid ?>" />
  <input type="submit" name="Submit" id="Submit" value="<?php echo JText::_('SUBMIT') ?>" />
</form>