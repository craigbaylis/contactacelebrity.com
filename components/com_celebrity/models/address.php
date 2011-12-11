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
* Address class for the Celebrity Model
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityModelAddress extends JModel
{
    var $_cid;
    var $_aid;      
    
    function __construct()
    {
        parent::__construct();
        $this->_cid = JRequest::getInt('cid');
        $this->_aid = JRequest::getInt('aid');
    }
    
    // get data
   public function getMailingAddresses()
    {
        if (!$this->celebCheck()) {
            //throw error
            JError::raiseError(500,'No Celebrity Chosen');                
        } else {
            //build query
            $query = "
            SELECT 
              a.celebrity_id,
              a.address_id,
              b.company,
              b.line_1,
              b.line_2,
              b.city,
              c.name AS country,
              c.abbreviation,
              d.name AS state,
              b.zipcode,
              b.is_outdated,
              b.is_approved,
              b.temporary,
              b.start,
              b.end,
              e.type
            FROM
              #__celebrity_address b
              INNER JOIN #__celebrity_celebrity_address a ON (b.id = a.address_id)
              INNER JOIN #__celebrity_country c ON (b.country_id = c.id)
              INNER JOIN #__celebrity_state d ON (b.state_id = d.id)
              INNER JOIN #__celebrity_address_type e ON (b.address_type_id = e.id)
            WHERE
              a.celebrity_id = $this->_cid
            ";
            $result = $this->_getList($query);
        }
        return $result;            
    }
    
    // get a single mailing address
   public function getMailingAddress()
    {
        $aid  = $this->_aid;
        if (!$aid) JError::raiseError(500,'Missing address identification code');
        
        //build query
        $query = "
            SELECT 
              a.id,
              a.company,
              a.line_1,
              a.line_2,
              a.city,
              b.name AS country,
              b.abbreviation AS country_code,
              c.name AS state,
              c.abbreviation AS state_code,
              a.zipcode,
              a.is_outdated,
              a.is_approved,
              a.`temporary`,
              a.start,
              a.`end`,
              a.created_by_uid AS submitted_by_uid,
              DATE_FORMAT(a.date_created,'%m/%d/%Y') AS submitted_on,
              e.username AS submitted_by,
              d.`type`,
              f.`comment`
            FROM
              #__celebrity_address a
              INNER JOIN #__celebrity_country b ON (a.country_id = b.id)
              INNER JOIN #__celebrity_state c ON (a.state_id = c.id)
              INNER JOIN #__users e ON (a.created_by_uid = e.id)
              INNER JOIN #__celebrity_address_type d ON (a.address_type_id = d.id)
              LEFT OUTER JOIN #__celebrity_outdated_address_comment f ON (a.outdated_address_comment = f.id)
            WHERE
              a.published = 1 AND 
              a.id = $aid
        ";
        $db = JFactory::getDBO();
        $db->setQuery($query);
        $db->query();
        if ($db->getNumRows() == 0) return false;
        $result = $db->loadObject();
        if ($db->getErrorNum()) JError::raiseError('500', JText::_('DBERROR'));
        return $result;            
    }    
    
    public function getEmailAddresses()
    {
        if (!$this->celebCheck()) {
            JError::raiseError(500,'No Celebrity Chosen');                
        } else {
            //build query
            $query = "
            SELECT 
              a.email
            FROM
              #__celebrity_email a
            WHERE
              a.celebrity_id = $this->_cid
            ";
            
            $result = $this->_getList($query);
            
        }
        return $result;            
    }
    
    public function getWebsiteAddresses()
    {
        if (!$this->celebCheck()) {
            JError::raiseError(500,'No Celebrity Chosen');                
        } else {
            //build query
            $query = "
            SELECT 
              a.url
            FROM
              #__celebrity_website a
            WHERE
              a.celebrity_id = $this->_cid
            ";
            
            $result = $this->_getList($query);
        }
        return $result;            
    }
   
   public function getCelebName()
   {
        if (!$this->celebCheck()) {
            JError::raiseError(500,'No Celebrity Chosen');                
        } else {
            //build query
            $query = "
            SELECT 
              a.first_name,
              a.last_name
            FROM
              #__celebrity_celebrity a
            WHERE
              a.id = $this->_cid
            ";
                        
            $result = $this->_getList($query);
            $result = $result[0]->first_name.' '.$result[0]->last_name;
        }
        return $result;       
   }
   
   public function celebCheck()
   {
     //check if we have a celebrity's id to use
     if (!$this->_cid) {
         return false;
     }
     
     //check if the celebrity id actually exist in the database
     $db =& $this->_db;
     
     $query = "
        SELECT 
          a.id
        FROM
          #__celebrity_celebrity a
        WHERE
          a.id = $this->_cid
     ";
     $db->setQuery($query);
     if (!$db->loadResult()) {
         return false;
     }
     return true;   
   }
   
   public function getCountries()
   {       
       $query = "
       SELECT 
          a.name,
          a.id
        FROM
          #__celebrity_country a
        ORDER BY
         a.name
       ";
       $result = $this->_getList($query);
       return $result;
   }
   
   public function getStates($country_id)
   {
       $query = "
            SELECT 
              a.id,
              a.name
            FROM
              #__celebrity_state a
            WHERE
              a.country_id = $country_id
            ORDER BY
             a.name
       ";
       $result = $this->_getList($query);
       return $result;
   }
   
   public function duplicateCheck($formSubmitted)
   {
       $db = $this->_db;
       
       switch($formSubmitted)
       {
            case 'email':
                $emailAddress = JRequest::getVar('emailAddress',null,'POST');
                $emailAddress = $db->Quote($emailAddress);
                $celebrity_id = JRequest::getInt('cid',null,'POST');
                $query ="
                    SELECT 
                      COUNT(*) as found
                    FROM
                      #__celebrity_email a
                    WHERE
                      a.email = $emailAddress AND 
                      a.celebrity_id = $celebrity_id                
                ";
                break;
            case 'mailing':
                $line_1 = JRequest::getVar('line_1',null,'POST');
                $line_1 = $db->Quote($line_1);
                $celebrity_id = JRequest::getInt('cid',null,'POST');            
                $query ="
                    SELECT 
                      COUNT(*) AS found
                    FROM
                      #__celebrity_address a
                      INNER JOIN #__celebrity_celebrity_address b ON (a.id = b.address_id)
                    WHERE
                      a.line_1 = $line_1 AND 
                      b.celebrity_id = $celebrity_id              
                ";
                break;
            case 'website':
                $url = JRequest::getVar('websiteAddress',null,'POST');
                $url = $db->Quote($url);
                $celebrity_id = JRequest::getInt('cid',null,'POST');
                $query = "
                     SELECT 
                      COUNT(*) AS found
                    FROM
                      #__celebrity_website a
                    WHERE
                      a.celebrity_id = $celebrity_id AND 
                      a.url = $url               
                ";
                break;
            default:    
       }
       
       $db->setQuery($query);
       $result = $db->loadResult();
       return ($result) ? true : false ;
   }
   
   public function addEmailAddress()
   {
       $post = JRequest::get('post');
       $date = JFactory::getDate();
       $post['id'] = false;
       $post['celebrity_id'] = JRequest::getVar('cid');
       $post['email'] = JRequest::getVar('emailAddress');
       $post['date_created'] = $date->toMySQL();
       $post['$created_by_uid'] = '';
       $table = $this->getTable('email');
       $table->bind($post);
       if ($table->store(true)) {
          return true; 
       } else {
           return false;
       }
       
   }
   
   public function addUrl()
   {
       $post = JRequest::get('post');
       $date = JFactory::getDate();
       $post['id'] = false;
       $post['celebrity_id'] = JRequest::getVar('cid');
       $post['url'] = JRequest::getVar('websiteAddress');
       $post['date_created'] = $date->toMySQL();
       $post['$created_by_uid'] = '';
       $table = $this->getTable('website');
       $table->bind($post);
       if ($table->store(true)) {
          return true; 
       } else {
           return false;
       }       
   }
   public function addAddress()
   {
       $post = JRequest::get('post');
       $date = JFactory::getDate();
       $post['id'] = false;
       if ($post['addTempVenue']=='Yes') {
        $post['address_type_id'] = 2;
        $date = new JDate($post['start']);
        $post['start'] = $date->toMySQL();
        $date = new JDate($post['end']);
        $post['end'] = $date->toMySQL(); 
       } else {
           $post['address_type_id'] = 1;
           $post['start'] = null;
           $post['end'] = null;
       }
       $post['source'] = '';
       $post['is_outdated'] = '';
       $post['is_approved'] = '';
       $post['approved_by_uid'] = '';
       $post['outdated_address_comment_id'] = '';
       $post['temporary'] = $post['addTempVenue'];
       $post['celebrity_id'] = JRequest::getVar('cid');
       $post['date_created'] = $date->toMySQL();
       //check if state of address is new
       if ($post['state_id'] == 'other') {
           //add state to database
           $state = array();
           $state['id'] = false;
           $state['country_id'] = $post['country_id'];
           $state['name'] = $post['addOtherState'];
           $state['abbreviation'] = strtoupper(substr($state['name'],0,3));
           $state['date_created'] = $post['date_created'];
           $state['$created_by_uid'] = $post['created_by_uid'];
           $table = $this->getTable('state');
           $table->bind($state);
           if (!$table->store()) {
               return false;
           } else {
               //get the id of the state
               $post['state_id'] = $this->_db->insertid();
           }
       }
       
       //add address to the address table
       $table = $this->getTable('address');
       $table->bind($post);
       if (!$table->store()) {
          return false; 
       } else {
          //get id of address added to table
          $relationship['id'] = false;
          $relationship['celebrity_id'] = $post['celebrity_id'];
          $relationship['address_id'] = $this->_db->insertid();
          $relationship['date_created']  = $post['date_created'];
       }
       //add the relationship of the address to the celebrity
       $table = $this->getTable('CelebrityAddress');
       $table->bind($relationship);
       if(!$table->store(true)){
           return false;
       } else {
           return true;
       }       
   } 
}

?>