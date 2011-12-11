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
* Countries class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelCountries extends JModel
{
    //variables for caching
    var $_countries = '';
    
    // get data
    function getCountries()
    {
        if (!$this->_countries) {
            $query = "
                SELECT 
                  a.id,
                  a.name,
                  a.abbreviation
                FROM
                  #__celebrity_country a
            ";
            $this->_countries = $this->_getList($query);
            if (!$this->_countries) JError::raiseWarning(500,'There was a problem getting the countries data');
        }
        return $this->_countries;            
    }
}

?>