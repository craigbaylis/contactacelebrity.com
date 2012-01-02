<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableCelebritydeceased extends JTable
{
   var $id = null;
     
   var $created_by_uid = '';
   
   var $comment = '';
   
   var $date_created = '';
   
   var $offer_cond = '';
   
   var $news_link = '';
   
   var $deceased_date = '';
   
  
   
   /**
* Create a new TableCelebrity
*/
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_deceased_comment', 'id', $db);
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