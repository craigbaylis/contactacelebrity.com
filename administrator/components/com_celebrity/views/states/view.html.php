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
* States class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewStates extends JView
{

    public function display($tpl = null)
    {
        //determine type of view/task to choose the right layout and set the right variables
        $view = JRequest::getWord('view','display');
        
        //determine which layout to use and assign the correct variables
        switch($view)
        {
            
            default:
                JToolBarHelper::title(JText::_('STATES'),'generic.png');
                //JToolBarHelper::deleteList();
                //JToolBarHelper::editList();
                //JToolBarHelper::addNewX();
                JToolBarHelper::back(JText::_('DASHBOARD'),'index.php?option=com_celebrity');
                JSubMenuHelper::addEntry(JText::_('DASHBOARD'),'index.php?option=com_celebrity&view=dashboard');
                JSubMenuHelper::addEntry(JText::_('ADDRESSES'),'index.php?option=com_celebrity&view=addresses');
                JSubMenuHelper::addEntry(JText::_('STATES'),'index.php?option=com_celebrity&view=states',true);
                JSubMenuHelper::addEntry(JText::_('COUNTRIES'),'index.php?option=com_celebrity&view=countries');
                JSubMenuHelper::addEntry(JText::_('TYPES'),'index.php?option=com_celebrity&view=addresstypes');
                JSubMenuHelper::addEntry(JText::_('DECEASEDCOMMENTS'),'index.php?option=com_celebrity&view=deceasedcomments');
        
                //Get the addresses from the model
                $model =& $this->getModel('states');
                $states = $model->getStates();
        
                $this->assignRef('states', $states);
        }        
        
        // display template
        parent::display($tpl);
    }
}

?>