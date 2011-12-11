<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableState extends JTable
{
   var $id = null;
   
   var $country_id = '';
   
   var $name = '';
   
   var $abbreviation = '';
     
   var $date_created = '';
   
   var $created_by_uid = '';
   
   var $ordering = 0;
   
   var $published = 1;  
   
   /**
* Create a new Table
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_state', 'id', $db);
    }
    
    /**
    * Check if the data is valid?
    */
    function check() {

    // TODO check for valid strings
    return true;
    } 
}
?>