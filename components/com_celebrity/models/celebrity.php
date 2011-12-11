<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

//no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');
jimport('joomla.error.error');

	class CelebrityModelCelebrity extends JModel
	{
		var $Error='';

		function __construct()
		{
		    parent::__construct();
		    $array = JRequest::getVar('cid',  0, '', 'array');
		    $this->setId((int)$array[0]);
		}
		function setId($id)
		{
		    // Set id and wipe data
		    $this->_id        = $id;
		    $this->_data    = null;
		}

		function &getData()
		{
		    // Load the data
		    if (empty( $this->_data )) {
		        $query = ' SELECT * FROM #__celebrity_celebrity '.
		                '  WHERE id = '.$this->_id;
		        $this->_db->setQuery( $query );
		        $this->_data = $this->_db->loadObject();

		    }
		    if (!$this->_data) {
		        $this->_data = new stdClass();
		        $this->_data->id = 0;
		        $this->_data->first_name = '';
		        $this->_data->middle_name = '';
		        $this->_data->last_name = '';
		        $this->_data->alias = '';
		        $this->_data->gender = '';
		        $this->_data->birth_date = '0000-00-00';
		        $this->_data->birth_place = '';
		        $this->_data->famous_for = '';
		        $this->_data->hair_color = '';
		        $this->_data->eye_color = '';
		        $this->_data->biography = '';
		        $this->_data->date_created = '';
		        $this->_data->created_by_uid = 0;
		        $this->_data->is_deceased = 0;
		        $this->_data->deceased_comment_id = 0;
		    }
		    return $this->_data;
		}

		function store($data)
		{
            
            $celebrity =& $this->getTable('Celebrity');
                                      
		    $Error='';
		    if (!$celebrity->bind($data)) {
		        $this->setError($this->_db->getErrorMsg());
		        return false;
		    }
		    if (!$celebrity->check()) {
		        $this->setError($this->_db->getErrorMsg());
		        return false;
		    }
		    if (!$celebrity->store()) {
		        $this->setError($this->_db->getErrorMsg());
		        return false;
		    }
		    return $celebrity->id;
		}
		function delete()
		{
		    $id = JRequest::getVar( 'id', 0, 'get', 'int' );
		    $row =& $this->getTable();

		        if (!$row->delete( $id )) {
		            $this->setError( $row->getErrorMsg() );
		            return false;
		        }
		    return true;
		}
        
        /**
        * Get a list of celebritys in the database with a similar name
        * 
        * @param mixed $celebrity
        * @return array
        */
        
        public function getCelebritys($celebrity)
        {
            $db =& JFactory::getDBO();
            $order = $db->nameQuote('first_name') . ' DESC';
            
            //build where clause
            $conditions = ''; 
            
            // prepare the names individually
            $nameConditions = array();
            foreach ($celebrity as $key => $name) {
                if(!empty($name))
                {
                    $name = $db->Quote('%'.$db->getEscaped($name, true).'%', false);
                    $nameConditions[] = $db->nameQuote($key)." LIKE $name";
                }
            }
            
            // determine the glue and put it all together!
            $glue = ') OR (';
            $conditions = '('.implode($glue, $nameConditions).')';
            
            //complete query
            $query = 'SELECT first_name, last_name '
            . ' FROM ' . $db->nameQuote('#__celebrity_celebrity')
            . " WHERE ($conditions) "
            . " ORDER BY $order";
              
            $db->setQuery($query);
            $result = $db->loadObjectList();
            
            return $result;
            
        }
        
        public function &getDetails()
        {
            $cid = JRequest::getInt('cid');
            $db = $this->_db;
            $query = "
                SELECT 
                  `a`.`id`,
                  `a`.`first_name`,
                  `a`.`last_name`,
                  CONCAT_WS(' ', `a`.`first_name`, `a`.`middle_name`, `a`.`last_name`) AS `full_name`,
                  CONCAT_WS(' ', `a`.`first_name`, `a`.`last_name`) AS `name`,
                  CONCAT(`a`.`first_name`, ' ', `a`.`last_name`, IF((SUBSTRING(`a`.`last_name`, -1) = 's'), '\'', '\'s')) AS `ownership_name`,
                  `a`.`gender`,
                  DATE_FORMAT(`a`.`birth_date`, '%M %e, %Y') AS `birth_date`,
                  `a`.`birth_place`,
                  `a`.`famous_for`,
                  `a`.`hair_color`,
                  `a`.`eye_color`,
                  `a`.`biography`,
                  `a`.`middle_name`,
                  `a`.`is_deceased`,
                  GROUP_CONCAT(`c`.`name`) AS `profession`,
                  `d`.`username` AS `celebrity_submitted_by`
                FROM
                  `#__celebrity_celebrity_profession` `b`
                  RIGHT OUTER JOIN `#__celebrity_celebrity` `a` ON (`b`.`celebrity_id` = `a`.`id`)
                  LEFT OUTER JOIN `#__celebrity_profession` `c` ON (`b`.`profession_id` = `c`.`id`)
                  LEFT OUTER JOIN `#__users` `d` ON (`a`.`created_by_uid` = `d`.`id`)
                WHERE
                  `a`.`published` = 1 AND 
                  `a`.`id` = $cid
                GROUP BY
                  `a`.`id`,
                  `a`.`first_name`,
                  `a`.`last_name`,
                  CONCAT_WS(' ', `a`.`first_name`, `a`.`middle_name`, `a`.`last_name`),
                  CONCAT_WS(' ', `a`.`first_name`, `a`.`last_name`),
                  CONCAT(`a`.`first_name`, ' ', `a`.`last_name`, IF((SUBSTRING(`a`.`last_name`, -1) = 's'), '\'', '\'s')),
                  `a`.`gender`,
                  DATE_FORMAT(`a`.`birth_date`, '%M %e, %Y'),
                  `a`.`birth_place`,
                  `a`.`famous_for`,
                  `a`.`hair_color`,
                  `a`.`eye_color`,
                  `a`.`biography`,
                  `a`.`middle_name`,
                  `a`.`is_deceased`,
                  `d`.`username`           
            ";
            $db->setQuery($query);
            $result = $db->loadObjectList();
            if ($db->getErrorNum() == 0) {
                // no errors occurred
                return $result[0];
            } else {
                // errors occurred
                $error = $db->getErrorMsg();
                JError::raiseWarning(500,$error);
            }
        }

	}
?>
