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
* Raw view for class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewCelebrity extends JView
{

	public function display($tpl = null)
	{
        
        //determine type of task to choose the right layout and set the right variables
        $task = JRequest::getWord('task','add');
    
        switch($task)
        {
            case 'search':
                $celebrity_name = JRequest::getVar('name',null,'POST','ARRAY');
                $model =& $this->getModel();
                $celebritys = $model->getCelebritys($celebrity_name);
                $this->setLayout('_search_results');
                JRequest::setVar('tmpl','component');
                if($celebritys)
                {
                    $this->assign('celebresult',JText::_('CELEBSFOUND'));
                    $this->assign('goahead', JText::_('NOCELEBSRIGHT'));                
                    $this->assignRef('celebritys', $celebritys);
                    $this->assignRef('celebrity_name', $celebrity_name);
                    $this->assign('match',true);   
                }else{
                    $this->assign('celebresult',JText::_('NOCELEBSFOUND'));
                    $this->assignRef('celebrity_name', $celebrity_name);
                    $this->assign('match',false);
                }
                break;
            default:
        }
            
        // display template
        parent::display($tpl);
	}
}