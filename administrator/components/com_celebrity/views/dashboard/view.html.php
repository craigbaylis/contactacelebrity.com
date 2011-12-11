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
* Dashboard class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewDashboard extends JView
{

    public function display($tpl = null)
    {    
        jimport('joomla.html.pane');
        $pane    =& JPane::getInstance('sliders');
        
        JToolBarHelper::title( JText::_( 'CONTACT_CELEBRITY' ) );
        JSubMenuHelper::addEntry(JText::_('DASHBOARD'),'index.php?option=com_celebrity&view=dashboard',true);
        JSubMenuHelper::addEntry(JText::_('CELEBRITYMANAGEMENT'),'index.php?option=com_celebrity&view=celebrities');
        JSubMenuHelper::addEntry(JText::_('ADDRESSMANAGEMENT'),'index.php?option=com_celebrity&view=addresses');
        JSubMenuHelper::addEntry(JText::_('RESULTS'),'index.php?option=com_celebrity&view=resultlist');
        JToolBarHelper::preferences('com_celebrity', '175');
        
        $this->assignRef( 'pane', $pane );
        parent::display( $tpl );
    }
}

?>