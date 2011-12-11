<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
* Address class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewAddress extends JView
{

    public function display($tpl = null)
    {             
        // display template
        $layout = JRequest::getWord('layout');
        $model = $this->getModel();
        
        //we have a logged in user to so pass along his id
        $user = JFactory::getUser();
        $uid = $user->get('id');
        $this->assignRef('created_by_uid',$uid);
        
        switch ($layout)
        {
            case 'states':
            //Build state dropdown list based on country selected
            $country_id = JRequest::getInt('country_id', 1);
            $states = $model->getStates($country_id);
            $stateOption = array();
            if ($states) {
                $stateOption[] = JHTML::_('select.option', 0, '- '.JText::_('SELECTSTATE').' -');
                $stateOption[] = JHTML::_('select.option', 'other', 'Enter a State >>');
                foreach ($states as $state) {
                   $stateOption[] = JHTML::_('select.option', $state->id, $state->name); 
                }
                $stateOptions = JHTML::_('select.options', $stateOption, 'value', 'text', 0);
                
            } else {
                $stateOption[] = JHTML::_('select.option', '0', JText::_('ENTERSTATE').' >>', 'value','text',true);
                $stateOption[] = JHTML::_('select.option', 'other', JText::_('ENTERSTATE').' >>');
                $stateOptions = JHTML::_('select.options', $stateOption, 'value', 'text', 'other');
            }
            
            $this->assignRef('stateOptions', $stateOptions);
            break;
             
            default:
            include_once('components'.DS.'com_celebrity'.DS.'helpers'.DS.'mailingAddressForm.php');
        }
        
        
        parent::display($tpl);
    }
}

?>