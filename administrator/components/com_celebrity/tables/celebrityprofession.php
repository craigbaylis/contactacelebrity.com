<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableCelebrityProfession extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */   
    var $id = null;
    
    /**
    * Celebrity Id
    * 
    * @var int
    */
    var $celebrity_id = null;

    /**
    * Profession Id
    * 
    * @var int
    */
    var $profession_id = null;
    
    /**
     *
     * @var datetime
     */    
    var $date_created = '0000-00-00 00:00:00';
   
   
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function __construct(&$db)
    {
        parent::__construct('#__celebrity_celebrity_profession', 'id', $db);
    }
    
    /**
    * Check if the data is valid?
    */
    function check()
    {
        // write here data validation code
        return parent::check();
    } 
}
?>