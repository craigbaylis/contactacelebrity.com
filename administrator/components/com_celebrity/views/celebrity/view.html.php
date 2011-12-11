<?php
// Restrict Access
defined('_JEXEC') or die( 'Restricted access' );

// Include class base JView
jimport('joomla.application.component.view');


class CelebrityViewCelebrity extends JView
{

    public function edit($id)
    {
        // Build the toolbar for the edit function
        JToolBarHelper::title(JText::_('Celebrity').': [<small>'.JText::_('Edit').'</small>]');
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel','Close');
        
        // Get the celebrity
        $model =& $this->getModel();
        $celebrity = $model->getCelebrity($id);
        $this->assignRef('celebrity', $celebrity);
        
        parent::display();    
    }
    
    public function add()
    {
        // Build the toolbar for the add function
        JToolBarHelper::title(JText::_('Celebrity').': [<small>'.JText::_('Add').'</small>]');
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        
        // Get a new celebrity from the model
        $model =& $this->getModel('celebrity');
        $celebrity = $model->getNewCelebrity();
        $this->assignRef('celebrity', $celebrity);
        
        parent::display();
    }
}
?>