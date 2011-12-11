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
* Search class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityControllerSearch extends JController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function search()
    {
      //Get the view
      $view =& $this->getView(JRequest::getWord('view', 'Search'), 'html');      

      //Get the model for the view
      $model =& $this->getModel('Search');
      
      //Set the model for the view and make it the default
      $view->setModel($model, true);          
      
       //Display the view
       $view->display();        
    }
}