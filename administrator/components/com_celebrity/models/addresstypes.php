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
* AddressTypes class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelAddresstypes extends JModel
{
    //variables for caching
    var $_addresstypes = '';
    
    // get data
    function &getAddresstypes()
    {
        if (!$this->_addresstypes) {
            $query = "
                SELECT *
                FROM
                  #__celebrity_address_type a
            ";
            $this->_addresstypes = $this->_getList($query);
            if (!$this->_addresstypes) JError::raiseWarning(500,'There was a problem getting the Address Types data');
        }
        return $this->_addresstypes;            
    }
}

?>