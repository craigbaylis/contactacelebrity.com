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
* Addcelebrity class for the Celebrity View
* 
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewFrontpage extends JView
{

    public function display($tpl = null)
    {
        
        //determine type of task to choose the right layout and set the right variables
    		$this->setLayout('default');

        // display template
        parent::display($tpl);
    }
}

?>