<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$model =& $this->getModel();

//DB id of default country
$default_country = 191;

//Build county dropdown lists
$countries = $model->getCountries();
$countryOptions = array();
foreach ($countries as $country) {
   $countryOptions[] = JHTML::_('select.option', $country->id, $country->name); 
}
$countryDropdown = JHTML::_('select.genericlist', $countryOptions, 'country_id',null, 'value', 'text', $default_country);
$this->assignRef('countryDropdown', $countryDropdown);

//Build state dropdown list for default selected country
$states = $model->getStates($default_country);
$stateOption = array();
$stateOption[] = JHTML::_('select.option', 0, '- '.JText::_('SELECTSTATE').' -');

foreach ($states as $state) {
   $stateOption[] = JHTML::_('select.option', $state->id, $state->name); 
}
$stateOptions = JHTML::_('select.options', $stateOption, 'value', 'text', 'value', 0);
$this->assignRef('stateOptions', $stateOptions);

$celebName = JRequest::getVar('celebName','default','POST','STRING');
if (!$celebName) {
   JError::raiseError(500, 'No Celebrity Chosen'); 
}
$this->assignRef('celebName', $celebName);

//Build Date Selectors
$startDate = JHTML::_('calendar', '','start', 'addVenueStart', '%m/%d/%Y', array('size'=>'10', 'maxlength'=>'15', 'readonly'=>'readonly'));
$endDate = JHTML::_('calendar', '','end', 'addVenueEnd', '%m/%d/%Y', array('size'=>'10', 'maxlength'=>'15', 'readonly'=>'readonly'));
$this->assignRef('startDate',$startDate);
$this->assignRef('endDate',$endDate);
?>