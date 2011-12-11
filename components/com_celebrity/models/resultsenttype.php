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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * Celebrity Model
 *
 * @package    Joomla.Components
 * @subpackage 	Celebrity
 */
class CelebrityModelResultsenttype extends JModel{

	/**
	 * Resultsenttype data array for tmp store
	 *
	 * @var array
	 */
	private $_data;
	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData(){
		if (empty( $this->_data )){
			$db =& JFactory::getDBO();
			$query = "
                SELECT 
                  `a`.`id`,
                  `a`.`label`,
                  `a`.`name`,
                  `a`.`ordering`,
                  `a`.`published`,
                  `a`.`date_created`
                FROM
                  `#__celebrity_result_sent_type` `a`
                WHERE
                  `a`.`published` = 1
                ORDER BY
                  `a`.`ordering`
                ";
			$db->setQuery( $query );
			$this->_data = $db->loadObjectList();
		}
		return $this->_data;
	}
}
