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
class TableResultreceivedtype extends JTable{
	/** jcb code */
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;
    /**
     *
     * @var string
     */
    var $label = null;
    /**
         *
         * @var string
         */    
    var $name = null;
	/**
	 *
	 * @var int
	 */
	var $ordering = 0;
	/**
	 *
	 * @var int
	 */
	var $published = 1;
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
	function TableResultreceivedtype(& $db){
		parent::__construct('#__celebrity_result_received_type', 'id', $db);
	}
	
	function check(){
		// write here data validation code
		return parent::check();
	}
}