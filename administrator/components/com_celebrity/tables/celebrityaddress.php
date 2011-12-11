<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableCelebrityAddress extends JTable
{
   var $id = '';
   
   var $celebrity_id = '';
   
   var $address_id = '';
   
   var $date_created = '';  
   
   
   /**
* Create a new Table
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_celebrity_address', 'id', $db);
    }
    
    /**
    * Check if the data is already in the database?
    */
    function check() {

    // TODO check for valid strings
    return true;
    } 
}
?>