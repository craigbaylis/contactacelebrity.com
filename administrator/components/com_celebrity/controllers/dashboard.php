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
* Dashboard class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityControllerDashboard extends CelebrityController
{
    public function __construct()
    {
        parent::__construct();
    }

        public function display()
    {
        
        // Get the view
        $view        =& $this->getView( 'dashboard' , 'html' );
        $model        =& $this->getModel( 'dashboard' );
        
        if( $model )
        {
            $view->setModel( $model , 'dashboard' );
        }

        // Display the view
        $view->display();
             
    }
    
}