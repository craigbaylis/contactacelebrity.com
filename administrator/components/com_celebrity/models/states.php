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
* States class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelStates extends JModel
{
    //variables for caching
    var $_states = '';
    
    // get data
    function getStates()
    {
        if (!$this->_states) {
            $query = "
                SELECT 
                  a.id,
                  a.name AS state,
                  a.abbreviation,
                  b.name AS country
                FROM
                  #__celebrity_state a
                  INNER JOIN #__celebrity_country b ON (a.country_id = b.id)
            ";
            $this->_states = $this->_getList($query);
            if (!$this->_states) JError::raiseWarning(500,'There was a problem getting the states data');
        }
        return $this->_states;            
    }
}

?>