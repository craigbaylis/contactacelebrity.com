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
 * @package	Joomla.Components
 * @subpackage	Celebrity
 */
class CelebrityViewResultquality extends JView
{
	function display($tpl = null)
	{
		$data = $this->get('Data');
		$this->assignRef('data', $data);

		parent::display($tpl);
	}
}
?>
