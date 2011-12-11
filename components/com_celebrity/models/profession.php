<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
* [MODEL_NAME] class for the [COMPONENT_NAME] Model
* 
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelProfession extends JModel
{
        // get data
        function &getProfessions()
        {
            //get the database reference
            $db = $this->getDBO();
            
            //prepare query            
            $query = "
                SELECT 
                  a.id,
                  a.name AS profession,
                  b.name AS category
                FROM
                  #__celebrity_profession a
                  LEFT OUTER JOIN #__celebrity_profession_categories b ON (a.category_id = b.id)
                WHERE
                  a.published = 1
                ORDER BY
                  category,
                  profession
            ";
            
            //get results
            $db->setQuery($query);
            $results = $db->loadObjectList();
            
            return $results;            
        }
        // get data
        function &getCategories()
        {
            //get the database reference
            $db = $this->getDBO();
            
            //prepare query            
            $query = "
                SELECT 
                  a.id,
                  a.name
                FROM
                  #__celebrity_profession_categories a
                ORDER BY
                  a.name
            ";
            
            //get results
            $db->setQuery($query);
            $results = $db->loadObjectList();
            
            return $results;            
        }        
        
        function store($data)
        {
            
            $celebrityprofession =& $this->getTable('CelebrityProfession');
                                      
            $Error='';
            if (!$celebrityprofession->bind($data)) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
            if (!$celebrityprofession->check()) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
            if (!$celebrityprofession->store()) {
                $this->setError($this->_db->getErrorMsg());
                return false;
            }
            return $celebrityprofession->id;
        }

}

?>