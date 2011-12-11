<?php
/**
 * @package celebritysearch for Joomla! 1.5
 * @version $Id: celebritysearch.php
 * @author Kevin Campbell
 * @copyright (C) 2010 - Kevin Campbell
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$letters = modCelebritySearchHelper::getLetters();
$numbers = modCelebritySearchHelper::getNumbers();

require(JModuleHelper::getLayoutPath('mod_celebritysearch'));
?>
