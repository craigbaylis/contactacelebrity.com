<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TablePhoto extends JTable
{
   var $id = null;
   
   var $celebrity_id = '';
   
   var $file_name = '';
   
   var $file_ext = '';
   
   var $date_created = '';
   
   /**
* Create a new TablePhoto
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_photo', 'id', $db);
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