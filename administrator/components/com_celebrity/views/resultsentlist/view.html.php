<?php
/**
 * Celebrity View for Celebrity Component
 * 
 * @package    Celebrity
 * @subpackage com_celebrity
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Celebrity View
 *
 * @package    Joomla.Components
 * @subpackage 	Celebrity
 */
class CelebrityViewResultsentlist extends JView
{
	/**
	 * Resultsentlist view display method
	 * @return void
	 **/
	function display($tpl = null){
		$app =& JFactory::getApplication();

		// Get data from the model
		$rows = & $this->get( 'Data');
		
		// draw menu
		JToolBarHelper::title(   JText::_( 'CELEBRITY_MANAGER' ), 'generic.png' );
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();
		JToolBarHelper::divider();
		JToolBarHelper::deleteList();
		if(isset($rows[0]->published)){
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
		}
		// configuration editor for config.xml
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_celebrity', '250');

		$this->assignRef('rows', $rows );
		$pagination =& $this->get('Pagination');
		$this->assignRef('pagination', $pagination);

		// SORTING get the user state of order and direction
		$default_order_field = 'id';
		$lists['order_Dir'] = $app->getUserStateFromRequest('com_celebrityfilter_order_Dir', 'filter_order_Dir', 'ASC');
		$lists['order'] = $app->getUserStateFromRequest('com_celebrityfilter_order', 'filter_order', $default_order_field);
		$lists['search'] = $app->getUserStateFromRequest('com_celebritysearch', 'search', '');
		$this->assignRef('lists', $lists);


		parent::display($tpl);
	}
}