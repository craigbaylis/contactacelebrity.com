<?php
/**
* @package      [PROJECT_NAME]
* @subpackage   [COMPONENT_NAME]
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Load base controller
require_once JPATH_COMPONENT.DS.'controllers'.DS.'controller.php';

//check for controller and use view if not set
$controller = JRequest::getCmd('controller');

if (empty($controller)) {
    //treat view as controller
    $controller = JRequest::getCmd('view','dashboard');
    
    //set the controller variable
    JRequest::setVar('controller',$controller);
} else {
    //set the view to match the controller
    JRequest::setVar('view',$controller); 
}

if (!empty($controller)) {
    $controller    = JString::strtolower( $controller );
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    
    // Test if the controller really exists
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller='';
    }
}


//Create controller
$classname = 'CelebrityController'.ucfirst($controller);
$controller = new $classname();

//Execute the task
$controller->execute( JRequest::getCmd('task', 'display'));
$controller->redirect();