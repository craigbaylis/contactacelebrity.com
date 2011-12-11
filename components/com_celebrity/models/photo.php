<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );
jimport('joomla.error.error');

/**
* Photo class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelPhoto extends JModel
{
        // save photo
        function store($data)
        {
            
            $photo =& $this->getTable('Photo');
                                      
            $Error='';
            if (!$photo->bind($data)) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
            if (!$photo->check()) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
            if (!$photo->store()) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
            return $photo->id;
        }
        
        function &getPhoto($size = 'S')
        {
            $cid = JRequest::getInt('cid',0);
            $db = $this->_db;
            $query = "
                SELECT 
                  CONCAT('$cid','_',a.file_name,'_','$size','.',a.file_ext) AS file
                FROM
                  #__celebrity_photo a
                WHERE
                  a.celebrity_id = $cid
            ";
            $db->setQuery($query);
            $result = $db->loadObject();
            $error = $db->getErrorNum();
            if ($error) {
                JError::raiseWarning(500,'There was a problem getting the photo of the celebrity');
            } else {
                return $result;
            }
        }
}

?>