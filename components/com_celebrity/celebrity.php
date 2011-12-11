<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Load base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Load specific controller
if ($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller='';
	}
}

//Load controller based on view
if (empty($controller)) {
    $controller = JRequest::getWord('view');        
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
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
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();