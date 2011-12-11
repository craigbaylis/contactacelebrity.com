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
class CelebrityModelResultsent extends JModel{

	/**
	 * Resultsent data array for tmp store
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
			$id = JRequest::getInt('id',  0);
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM `#__celebrity_result_sent` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
    
    public function save($data){
        //get the table
        $resultSentTable = $this->getTable('resultsent');
        
        //save data in table
        $resultSentTable->bind($data);
        if (!$resultSentTable->store()) {
            return false;
        } else {
            return true;
        }        
    }
}
