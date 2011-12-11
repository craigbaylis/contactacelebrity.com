<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableEmail extends JTable
{
   var $id = '';
   
   var $email = '';
   
   var $celebrity_id = '';
   
   var $published = '1';
   
   var $created_by_uid = '';
   
   var $date_created = '';  
   
   
   /**
* Create a new Table
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_email', 'id', $db);
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