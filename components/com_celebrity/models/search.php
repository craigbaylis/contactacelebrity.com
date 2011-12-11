<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// No direct access
defined('_JEXEC') or die( 'Restricted access' );

// Import the JModel class
jimport( 'joomla.application.component.model' );

// Import the JError class
jimport('joomla.error.error');

/**
* Search class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelSearch extends JModel
{
    //variables for caching
    var $_celebrities = null;
    
    var $_allcelebrities = null;
    
    var $_total = null;
    
    var $_pagination = null;
    
    var $_query = null;
    
    var $_default_limit;
    
    public function __construct()
    {
        $app    =& JFactory::getApplication();
        
       //set the limit for results returned per page
       $params = JComponentHelper::getParams('com_celebrity'); 
       $this->_default_limit = $params->get('results_displayed', '5');
        
        // Call the parents constructor
        parent::__construct();

        $context = 'com_celebrity.list.';
        
        // Get the pagination request variables
        $limit        = $app->getUserStateFromRequest( $context.'limit', 'limit', $this->_default_limit, 'int' );
        $limitstart    = JRequest::getInt('limitstart', 0);

        // In case limit has been changed, adjust limitstart accordingly
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }
    
    //search celebrities by first letter of fist name
    function getCelebrities()
    {
        if (!$this->_celebrities) {
            $app = JFactory::getApplication();
            $limit = JRequest::getVar('limit', $this->_default_limit);
            $limitstart = JRequest::getVar('limitstart', 0);            
            $db =& $this->_db;
            $letter = JRequest::getCmd('letter');
            if (!empty($letter)) {
                if($letter != 9) {
                    $letter = $db->Quote($letter.'%'); 
                    $where = '
                        WHERE
                        a.first_name LIKE '.$letter;
                    $where .= ' AND a.published=1';
                } else {
                    $letter = $db->Quote('^[0-9]'); 
                    $where = '
                        WHERE
                        a.first_name REGEXP '.$letter;
                    $where .= ' AND a.published=1';                
                }                
            } else {
                $where = '
                WHERE
                a.published=1';
            }
            $query = "
                SELECT 
                  a.id,
                  CONCAT(a.first_name, ' ', a.last_name) AS name,
                  DATE_FORMAT(a.birth_date, '%M %e, %Y') AS birthday,
                  CONCAT(d.celebrity_id, '_', d.file_name, '_S','.', d.file_ext) AS image,
                  GROUP_CONCAT(c.name) AS profession,
                  a.famous_for,
                  a.gender
                FROM
                  #__celebrity_celebrity_profession b
                  RIGHT OUTER JOIN #__celebrity_celebrity a ON (b.celebrity_id = a.id)
                  LEFT OUTER JOIN #__celebrity_profession c ON (b.profession_id = c.id)
                  LEFT OUTER JOIN #__celebrity_photo d ON (a.id = d.celebrity_id)
                $where
                GROUP BY
                  a.id,
                  CONCAT(a.first_name, ' ', a.last_name),
                  DATE_FORMAT(a.birth_date, '%M %e, %Y'),
                  CONCAT(d.celebrity_id, '_', d.file_name, '_S','.', d.file_ext),
                  a.famous_for,
                  a.gender
                ORDER BY
                  a.first_name";
            $this->_query = $query;
            $this->_celebrities = $this->_getList($query, $limitstart, $limit);
            if ($db->getErrorNum()) JError::raiseWarning(500,'There was a problem getting the celebrity data');
        }
        $this->_total =  $this->getTotal();
        return $this->_celebrities;            
    }

        //search all celebrities
    function getAllCelebrities()
    {
        if (!$this->_allcelebrities) {
            $app = JFactory::getApplication();
            $limit = JRequest::getVar('limit', $this->_default_limit);
            $limitstart = JRequest::getVar('limitstart', 0);            
            $db =& $this->_db;
            $searchword = JRequest::getVar('searchword');
            $words = explode('+',$searchword);
            $where = array();
            foreach ($words as $word) {
                $word        = $db->Quote( '%'.$db->getEscaped( $word, true ).'%', false );
                $wheres2     = array();
                $wheres2[]     = 'a.first_name LIKE '.$word;
                $wheres2[]     = 'a.middle_name LIKE '.$word;
                $wheres2[]     = 'a.last_name LIKE '.$word;
                $where[]     = implode( ' OR ', $wheres2 );
                $where[]    = 'a.published = 1';
            }
            $where = '(' . implode( ') AND (', $where ) . ')';            
            $query = "
                SELECT 
                  a.id,
                  CONCAT(a.first_name,' ', a.last_name) AS name,
                  DATE_FORMAT(a.birth_date, '%M %e, %Y') AS birthday,
                  CONCAT(d.celebrity_id, '_', d.file_name, '_S', '.', d.file_ext) AS image,
                  a.famous_for,
                  c.name AS profession,
                  a.gender
                FROM
                  #__celebrity_celebrity_profession b
                  RIGHT OUTER JOIN #__celebrity_celebrity a ON (b.celebrity_id = a.id)
                  LEFT OUTER JOIN #__celebrity_profession c ON (b.profession_id = c.id)
                  LEFT OUTER JOIN #__celebrity_photo d ON (a.id = d.celebrity_id)
                WHERE 
                    $where
                ORDER BY
                  a.first_name
            ";
            $this->_query = $query;
            $this->_allcelebrities = $this->_getList($query, $limitstart, $limit);
            if ($db->getErrorNum()) JError::raiseWarning(500,'There was a problem getting the celebrity data');
        }
        $this->_total =  $this->getTotal();
        return $this->_allcelebrities;            
    }
    
    /**
     * Method to get a pagination object of the weblink items for the category
     *
     * @access public
     * @return integer
     */
    function getPagination()
    {
        // Lets load the content if it doesn't already exist
        if (empty($this->_pagination))
        {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }

        return $this->_pagination;
    }
    
    function getTotal()
    {
        if ($this->_total) {
            return $this->_total;
        } else {
            $this->_total = $this->_getListCount($this->_query);
            return $this->_total;
        }
    }    
}

?>