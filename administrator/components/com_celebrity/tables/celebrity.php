<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableCelebrity extends JTable
{
   var $id = null;
     
   var $first_name = '';
   
   var $middle_name = '';
   
   var $last_name = '';
   
   var $alias = '';
   
   var $gender = '';
   
   var $birth_date = '';
   
   var $birth_place = '';
   
   var $famous_for = '';
   
   var $hair_color = '';
   
   var $eye_color = '';
   
   var $biography = '';
   
   var $date_created = '';
   
   var $created_by_uid = '';
   
   var $is_deceased = 0;
   
   var $deceased_comment_id = '';
   
   var $ordering = 0;
   
   var $published = 1;  
  
   var $checked_out = 0;
   
   var $checked_out_time = '';
   
   var $album_catid = 0;
   
   
   /**
* Create a new TableCelebrity
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_celebrity', 'id', $db);
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