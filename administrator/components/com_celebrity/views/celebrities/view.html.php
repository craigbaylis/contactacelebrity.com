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
* Celebrities class for the Celelbrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewCelebrities extends JView
{

    public function display($tpl = null)
    {
        JToolBarHelper::title(JText::_('CELEBRITYMANAGEMENT'),'generic.png');
      //  JToolBarHelper::deleteList();
      //  JToolBarHelper::editList();
      //  JToolBarHelper::addNewX();
        JToolBarHelper::back(JText::_('DASHBOARD'),'index.php?option=com_celebrity');
       // JSubMenuHelper::addEntry(JText::_('DASHBOARD'),'index.php?option=com_celebrity');
       // JSubMenuHelper::addEntry(JText::_('CELEBRITIES'),'index.php?option=com_celebrity&view=celebrities',true);
        
        // Get the celebrities from the model
        $model =& $this->getModel('Celebrities');
        $celebrities = $model->getCelebrities();
        
        $this->assignRef('celebrities', $celebrities);
        
        // display template
        parent::display($tpl);
    }
}

?>