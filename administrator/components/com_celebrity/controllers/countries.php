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
* Countries class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_celebrities
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityControllerCountries extends JController
{
    public function __construct()
    {
        parent::__construct();
    }
}