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
* DeceasedComments class for the Celebrity Model
* 
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelDeceasedComments extends JModel
{
    //variables for caching
    var $_deceasedcomments = '';
    
    // get data
    function getDeceasedcomments()
    {
        if (!$this->_deceasedcomments) {
            $query = "
                SELECT 
                  a.id,
                  a.created_by_uid,
                  a.`comment`,
                  a.date_created
                FROM
                  #__celebrity_deceased_comment a
            ";
            $this->_deceasedcomments = $this->_getList($query);
            if ($this->_db->getErrorNum() != 0) JError::raiseWarning(500,'There was a problem getting the comments data');
        }
        return $this->_deceasedcomments;            
    }
}

?>