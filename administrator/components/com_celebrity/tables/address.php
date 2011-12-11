<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableAddress extends JTable
{
   var $id = '';
   
   var $company = '';
   
   var $line_1 = '';
   
   var $line_2 = '';
   
   var $city ='';
   
   var $country_id = '';
   
   var $state_id = '';
   
   var $zipcode = '';
   
   var $address_type_id = '';
   
   var $source = '';
   
   var $is_outdated = '';
   
   var $is_approved = '';
   
   var $approved_by_uid = '';
   
   var $temporary = '';
   
   var $start = '';
   
   var $end = '';
   
   var $published = 1;
   
   var $created_by_uid = '';
   
   var $outdated_address_comment = '';
   
   var $date_created = '';  
   
   
   /**
* Create a new Table
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_address', 'id', $db);
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