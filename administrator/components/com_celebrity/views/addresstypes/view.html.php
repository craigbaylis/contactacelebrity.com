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
* AddressTypes class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewAddresstypes extends JView
{

    public function display($tpl = null)
    {
        //determine type of view/task to choose the right layout and set the right variables
        $view = JRequest::getWord('view','display');
        
        //determine which layout to use and assign the correct variables
        switch($view)
        {
            
            default:
                JToolBarHelper::title(JText::_('ADDRESSTYPES'),'generic.png');
                //JToolBarHelper::deleteList();
                //JToolBarHelper::editList();
                //JToolBarHelper::addNewX();
                JToolBarHelper::back(JText::_('DASHBOARD'),'index.php?option='.JRequest::getWord('option'));
                JSubMenuHelper::addEntry(JText::_('DASHBOARD'),'index.php?option=com_celebrity&view=dashboard');
                JSubMenuHelper::addEntry(JText::_('ADDRESSES'),'index.php?option=com_celebrity&view=addresses');
                JSubMenuHelper::addEntry(JText::_('STATES'),'index.php?option=com_celebrity&view=states');
                JSubMenuHelper::addEntry(JText::_('COUNTRIES'),'index.php?option=com_celebrity&view=countries');
                JSubMenuHelper::addEntry(JText::_('TYPES'),'index.php?option=com_celebrity&view=addresstypes',true);
                JSubMenuHelper::addEntry(JText::_('DECEASEDCOMMENTS'),'index.php?option=com_celebrity&view=deceasedcomments');
        
                //Get the addresses from the model
                $model =& $this->getModel('Addresstypes');
                $addresstypes = $model->getAddresstypes();
        
                $this->assignRef('addresstypes', $addresstypes);
        }        
        
        // display template
        parent::display($tpl);
    }
}

?>