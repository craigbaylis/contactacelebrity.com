<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();

$formCheckTheme = JURI::base().'components/com_celebrity/assets/form/theme/red/formcheck.css';
$formCheckHints = JURI::base().'components/com_celebrity/assets/form/theme/red/hints.css';  
$moreURI        = JURI::base().'components/com_celebrity/js/mootools-more-uri.js'; 
$formCheckLang  = JURI::base().'components/com_celebrity/assets/form/lang/en.js';
$formCheckJs    = JURI::base().'components/com_celebrity/assets/form/formcheck-yui.js';
$document->addScript($moreURI);
$document->addScript($formCheckLang);
$document->addScript($formCheckJs);
$document->addStyleSheet($formCheckTheme);
$document->addStyleSheet($formCheckHints);
?>