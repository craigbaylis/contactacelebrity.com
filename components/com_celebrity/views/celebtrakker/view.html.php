<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
* Celebtrakker class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewCelebtrakker extends JView
{

    public function display($tpl = null)
    {
        //determine type of task to choose the right layout and set the right variables
        $task = JRequest::getWord('task','add');
        
        //determine which layout to use and assign the correct variables
        switch($task)
        {
            case '':
            //set correct view for the task and assign the variables
            break;
            
            default:
            //set the default action here
        }        

        //pass in pagination
        $pagination = $this->get('Pagination');
        $this->assignRef('pagination',$pagination);
                
        // display template
        parent::display($tpl);
    }
}

?>