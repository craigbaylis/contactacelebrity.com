<?php





/**


* Gavick GK JS Members - main file


* @package Joomla!


* @Copyright (C) 2009 Gavick.com


* @ All rights reserved


* @ Joomla! is Free Software


* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html


* @version $Revision: 1.0.0 $


**/





/**


	access restriction


**/


defined('_JEXEC') or die('Restricted access');





/**


	Loading helper class


**/





// 


require_once (dirname(__FILE__).DS.'helper.php');


//


$helper =& new RCRHelper();


//


$helper->init();


$helper->validateVariables($params);


$helper->getData();


$helper->renderLayout();





?>