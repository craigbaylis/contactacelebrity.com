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
class TableResult extends JTable{
	/** jcb code */
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
	/**
	 *
	 * @var datetime
	 */
	var $date_sent = "0000-00-00";
	/**
	 *
	 * @var int
	 */
	var $received_type_id = null;
    /**
     *
     * @var int
     */
	/**
	 *
	 * @var datetime
	 */
	var $date_received = "0000-00-00";
	/**
	 *
	 * @var string
	 */
	var $comments = null;
	/**
	 *
	 * @var int
	 */
	var $address_id = null;
	/**
	 *
	 * @var int
	 */
	var $quality_id = null;
	/**
	 *
	 * @var int
	 */
	var $created_by_id = null;
	/**
	 *
	 * @var int
	 */
	var $published = 1;
    /**
     *
     * @var int
     */
    var $displayed = 1;    
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
	function TableResult(& $db){
		parent::__construct('#__celebrity_result', 'id', $db);
	}
	
	function check(){
		// write here data validation code
		return parent::check();
	}
}