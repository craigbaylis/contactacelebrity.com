<?php
/**
 * Celebrity Model for Celebrity Component
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

/**
 * Celebrity Table
 *
 * @package    Joomla.Components
 * @subpackage 	Celebrity
 */
class TableResultsent extends JTable{
	/** jcb code */
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 *
	 * @var int
	 */
	var $result_id = null;
	/**
	 *
	 * @var int
	 */
	var $sent_type_id = null;
	/**
	 *
	 * @var datetime
	 */
	var $date_created = "0000-00-00 00:00:00";
	/** jcb code */

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableResultsent(& $db){
		parent::__construct('#__celebrity_result_sent', 'id', $db);
	}
	
	function check(){
		// write here data validation code
		return parent::check();
	}
}