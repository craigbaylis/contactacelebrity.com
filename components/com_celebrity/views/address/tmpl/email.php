<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<form id="emailForm" name="emailForm" method="post" action="index.php?option=com_celebrity&task=save">
  <label for="emailAddress">Email Address</label>
  <input type="text" name="emailAddress" id="emailAddress" class="validate['required','email']" />
  <input type="hidden" name="controller" value="address"/>
  <input type="hidden" name="formSubmitted" value="email"/>
  <input type="hidden" name="cid" value="<?php echo JRequest::getInt('cid') ?>" />
  <input type="hidden" id="celebName" name="celebName" value="<?php echo JRequest::getVar('celebName') ?>"/>
  <input type="hidden" name="created_by_uid" value="<?php echo $this->created_by_uid ?>" />  
  <input type="submit" name="Submit" id="Submit" value="<?php echo JText::_('SUBMIT') ?>" />
</form>