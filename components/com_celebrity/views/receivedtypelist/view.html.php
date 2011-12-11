<?php
/**
 * Celebrity View for com_celebrity Component
 * 
 * @package    Celebrity
 * @subpackage com_celebrity
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Celebrity Component
 *
 * @package		Celebrity
 * @subpackage	Components
 */
class CelebrityViewReceivedtypelist extends JView
{
	function display($tpl = null){
		$app =& JFactory::getApplication();
		/*
		$params =& JComponentHelper::getParams( 'com_celebrity' );
		$params =& $app->getParams( 'com_celebrity' );	
		$dummy = $params->get( 'dummy_param', 1 ); 
		*/
	
		$data =& $this->get('Data');
		$this->assignRef('data', $data);
		
		$pagination =& $this->get('Pagination');
		$this->assignRef('pagination', $pagination);

		parent::display($tpl);
	}
}
?>
