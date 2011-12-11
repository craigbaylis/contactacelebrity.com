<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );
jimport('joomla.error.error');

/**
* Celebrity class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelCelebrity extends JModel
{     
       var $_celebrity = null;
       var $_id        = null;
    
       public function getCelebrity($id)
       {
           $this->_id = $id;
           if (!$this->_celebrity) {
               
                $query3 = "
                SELECT *
                FROM
                    #__celebrity_celebrity
                WHERE
                    id = $this->_id
                ";
                
                $this->_db->setQuery($query3);
                $this->_celebrity  = $this->_db->loadObject();
                
                if ($this->_celebrity === null) {
                    JError::raiseError(500,"Celebrity [$id] not found");
                }
           }
           return $this->_celebrity;        
       }
       
       public function getNewCelebrity()
       {
           $newCelebrity =& $this->getTable('celebrity');
           $newCelebrity->id = null;
           
           return $newCelebrity;
       }
       
       public function store()
       {
           // Get the table
           $table       =& $this->getTable();
           $celebrity   = JRequest::get('POST');
           
           // Get todays date
           $date =& JFactory::getDate();
           $celebrity['date_created'] = $date->toMySQL();
           
           // Get user id
           $user    =& JFactory::getUser();
           $celebrity['created_by_uid'] = $user->get('id');
           
           // Make sure the table buffer is empty
           $table->reset();
           
           // Close order gaps
           $table->reorder();
           
           // Determine the next order position for the celebrity
           $nextOrder   = $table->getNextOrder();
           $table->set('ordering', $nextOrder);
           
           // Bind the data to the table
           if (!$table->bind($celebrity)) {
               $this->setError($this->_db->getErrorMsg());
               return false;
           }
           
           // Validate the data
           if (!$table->check()) {
               $this->setError($this->_db->getErrorMsg());
               return false;
           }
           
           // Store the data
           if (!$table->store()) {
                $this->setError($this->_db->getErrorMsg());
                return false;
           }
           
           // Checkin the celebrity
           if (!$table->checkin()) {
               $this->setError($this->_db->getErrorMsg());
               return false;
           }
           
           return true;
       }   
           
}

?>