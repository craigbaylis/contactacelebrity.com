<?php
/**
 * @version		0.40
 * @package		zKunenaLatest
 * @author		Aaron Gilbert {@link http://www.nzambi.braineater.ca}
 * @author		Created on 22-Dec-2010
 * @copyright	Copyright (C) 2009 - 2010 Aaron Gilbert. All rights reserved.
 * @license		GNU/GPL, see http://www.gnu.org/licenses/gpl-2.0.html
 *
 */
//-- No direct access
defined('_JEXEC') or die('Restricted access');

	
	require_once(dirname(__FILE__).DS.'helper.php');

	require_once (KUNENA_PATH_LIB . DS . 'kunena.link.class.php');
	require_once (KUNENA_PATH_LIB . DS . 'kunena.image.class.php');
	require_once (KUNENA_PATH_LIB . DS . 'kunena.timeformat.class.php');
	require_once (KUNENA_PATH_FUNCS . DS . 'latestx.php');
	require_once (JPATH_ADMINISTRATOR . '/components/com_kunena/libraries/html/parser.php');
	KunenaFactory::loadLanguage();
	$KunenaConfig = KunenaFactory::getConfig ();

	$list = modZKunenaLatestHelper::getItems($params);

$layout = 'default';
$document =& JFactory::getDocument();
if(!$params->get('noMooFX', 0 )) {
	$document->addScriptDeclaration( modZKunenaLatestHelper::getScript($params, $module)  );
}

$document->addStyleDeclaration( modZKunenaLatestHelper::getExtraCss($params, $module->id ) );

require(JModuleHelper::getLayoutPath('mod_zkunenalatest', $layout));
?>
