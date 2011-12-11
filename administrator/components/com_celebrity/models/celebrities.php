<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// No direct access
defined('_JEXEC') or die( 'Restricted access' );

// Import the JModel class
jimport( 'joomla.application.component.model' );

// Import the JError class
jimport('joomla.error.error');

/**
* Celebrities class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelCelebrities extends JModel
{
    var $_celebrities = null;

    // get data
    public function getCelebrities()
    {
        if (!$this->_celebrities) {
            $query1  = "
            SELECT *
            FROM
                #__celebrity_celebrity
            ";
            
            $this->_celebrities = $this->_getList($query1,0,5);
        }
       
       //return the list of celebrities 
        return $this->_celebrities;            
    }
   
    //TODO -c celebrities -o Kevin Campbell : Add removal of the address and any other related celebrity information    
    public function delete($cids)
    {
        $cids = implode(',', $cids);
        $db     =& JFactory::getDBO();
        $query2  = "
        DELETE
        FROM
            #__celebrity_celebrity
        WHERE
            id IN ($cids)
        ";
        
        $db->setQuery($query2);
        
        if (!$db->query()) {
            $errorMessage = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, "Error deleting celebrities: $errorMessage");
        }
    }
   
}

?>