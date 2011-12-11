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
class CelebrityModelResult extends JModel{

	/**
	 * Result data array for tmp store
	 *
	 * @var array
	 */
	private $_data;
	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData()
    {
		if (empty( $this->_data )){
			$id = JRequest::getInt('id',  0);
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM `#__celebrity_result` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
    
    public function saveResult()
    {
               
        //prepare data for the database
        $date_created = JFactory::getDate();
        JRequest::setVar('date_created',$date_created->toMySQL(),'post');
        
        $date_sent = JRequest::getVar('date_sent',null,'post');
        $date_sent = JFactory::getDate($date_sent);
        JRequest::setVar('date_sent',$date_sent->toMySQL(),'post');
        
        $date_received = JRequest::getVar('date_received',null,'post');
        $date_received = JFactory::getDate($date_received);
        JRequest::setVar('date_received',$date_received->toMySQL(),'post');
        
        $user = JFactory::getUser();
        JRequest::setVar('created_by_id',$user->get('id'),'post');        
        
        //get the result data to save
        $resultData = JRequest::get('post');
        
        //get the table
        $resultTable = $this->getTable('result');
        
        //save data in table
        $resultTable->bind($resultData);
        if (!$resultTable->store()) {
            return false;
        } else {
            return $this->_db->insertid();
        }
            
    }
}
