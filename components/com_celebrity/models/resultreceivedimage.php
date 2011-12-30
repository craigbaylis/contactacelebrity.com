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
class CelebrityModelResultreceivedimage extends JModel{

	/**
	 * Resultreceivedimage data array for tmp store
	 *
	 * @var array
	 */
	private $_data;
    
    private $_catdata;
	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData()
    {
		if (empty( $this->_data )){
			$id = JRequest::getInt('id',  0);
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM `#__celebrity_result_received_image` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
    
    public function saveImage()
    {
        //perform some kind of array merge that will overwrite the last image information in the post variable
        
        JRequest::setVar('id',null,'post');
        $data = JRequest::get('post');
        
        //get the table
        $imageTable = $this->getTable('resultreceivedimage');
        
        //save data in table
        $imageTable->bind($data);
        if (!$imageTable->store()) {
            return false;
        } else {
            return $this->_db->insertid();
        }         
    }
    
    public function getCatData()
    {
        if(empty($this->_catdata)) {
            $db = JFactory::getDBO();
            $user = JFactory::getUser();
            $uid = $user->get('id');
            
            $query = "
            SELECT 
              `a`.`userfolder`,
              `a`.`id` AS `catid`
            FROM
              `#__phocagallery_categories` `a`
            WHERE
              `a`.`owner_id` = $uid AND 
              `a`.`published` = 1 AND 
              `a`.`approved` = 1
            ";
            $db->setQuery($query);
            $result = $db->loadObject();
        }
        
        if (!$this->_data) {
            JError::raiseError( 404, JText::_("Error getting data for storing results image") );
        }        
        return $this->_catdata;
    }
	
	
	public function getUserFolder()
    {
        
            $db = JFactory::getDBO();
            $user = JFactory::getUser();
            $uid = $user->get('id');
            
            $query = "
            SELECT 
              `a`.`userfolder`,
              `a`.`id` AS `catid`
            FROM
              `#__phocagallery_categories` `a`
            WHERE
              `a`.`owner_id` = $uid AND 
              `a`.`published` = 1 AND 
              `a`.`approved` = 1
            ";
            $db->setQuery($query);
            $result = $db->loadObject();
      
        return $result;
    }
}
