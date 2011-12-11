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
* Addresses class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewAddresses extends JView
{

    public function display($tpl = null)
    {
        //determine type of task to choose the right layout and set the right variables
        $task = JRequest::getWord('task','display');
        
        //determine which layout to use and assign the correct variables
        switch($task)
        {
            
            default:
                JToolBarHelper::title(JText::_('ADDRESSMANAGEMENT'),'generic.png');
               // JToolBarHelper::deleteList();
               // JToolBarHelper::editList();
               // JToolBarHelper::addNewX();
                JToolBarHelper::back(JText::_('DASHBOARD'),'index.php?option=com_celebrity');
                JSubMenuHelper::addEntry(JText::_('DASHBOARD'),'index.php?option=com_celebrity&view=dashboard');
                JSubMenuHelper::addEntry(JText::_('ADDRESSES'),'index.php?option=com_celebrity&view=addresses',true);
                JSubMenuHelper::addEntry(JText::_('STATES'),'index.php?option=com_celebrity&view=states');
                JSubMenuHelper::addEntry(JText::_('COUNTRIES'),'index.php?option=com_celebrity&view=countries');
                JSubMenuHelper::addEntry(JText::_('TYPES'),'index.php?option=com_celebrity&view=addresstypes');
                JSubMenuHelper::addEntry(JText::_('DECEASEDCOMMENTS'),'index.php?option=com_celebrity&view=deceasedcomments');
        
                //Get the addresses from the model
                $model =& $this->getModel('Addresses');
                $addresses = $model->getAddresses();
        
                $this->assignRef('addresses', $addresses);
        }        
        
        // display template
        parent::display($tpl);
    }
}

?>