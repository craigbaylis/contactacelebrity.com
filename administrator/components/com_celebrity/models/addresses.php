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
* Addresses class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelAddresses extends JModel
{
    var $_addresses = '';    
    
    // get data
    function &getAddresses()
    {
        $query = "
            SELECT 
              a.id,
              a.company,
              a.line_1,
              a.line_2,
              a.city,
              a.zipcode,
              a.published,
              b.name AS country,
              c.name AS state,
              d.`type`,
              a.start,
              a.`end`,
              a.`temporary`
            FROM
              #__celebrity_country b
              INNER JOIN #__celebrity_address a ON (b.id = a.country_id)
              INNER JOIN #__celebrity_state c ON (a.state_id = c.id)
              INNER JOIN #__celebrity_address_type d ON (a.address_type_id = d.id)
        ";
        $this->_addresses = $this->_getList($query, 0,5);
        if(!$this->_addresses) JError::raiseWarning(500,'Problem getting the address data');
        return $this->_addresses;            
    }
}

?>