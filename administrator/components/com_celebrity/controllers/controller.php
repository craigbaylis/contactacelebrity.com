<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

//no direct access
defined('_JEXEC') or die('Restricted access');

//load the base JController class
jimport('joomla.application.component.controller');


/**
* Base class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_component
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityController extends JController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Method to display the view
     *
     * @access    public
     */
    public function display()
    {
        parent::display();      
    }
        
}