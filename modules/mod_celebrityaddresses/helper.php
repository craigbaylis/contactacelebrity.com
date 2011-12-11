<?php
/**
 * Helper class for Celebrity Addresses module
 * 
 * @package    CAC
 * @subpackage Joomla!
 * @link www.tcmsvc.net
 * @license        Private
 * Displays a list of celebrity addresses
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access');

class modCelebrityAddressesHelper
{
    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    function getAdddresses($params)
    {
        //get the id of the celebrity from the url
        $cid =& JRequest::getInt('cid',null);
        if (!$cid) JError::raiseError(500,'No Celebrity Found on This Page');
        
        //get the addresses
        $db =& JFactory::getDBO();
        $query = "
            SELECT 
              b.id,
              b.company,
              b.line_1,
              b.line_2,
              b.city,
              b.zipcode,
              DATE_FORMAT(b.date_created, '%m.%d.%Y') AS `date`,
              c.username,
              CONCAT(e.first_name, ' ', e.last_name) AS name,
              d.abbreviation AS state
            FROM
              #__celebrity_address b
              INNER JOIN #__celebrity_celebrity_address a ON (b.id = a.address_id)
              INNER JOIN #__users c ON (b.created_by_uid = c.id)
              INNER JOIN #__celebrity_state d ON (b.state_id = d.id)
              INNER JOIN #__celebrity_celebrity e ON (a.celebrity_id = e.id)
            WHERE
              a.celebrity_id = $cid AND 
              b.published = 1      
        ";
        $db->setQuery($query);
        $addresses = $db->loadObjectList('id');
        if ($db->getErrorNum()) JError::raiseError(500,'We experienced a problem with the database while trying to retrieve this celebrities adddresses, please try again later or contact us to report the problem');
        return $addresses;
    }
    function getResults(&$keys, $type='success')
    {
        $db = JFactory::getDBO();
        $query = "
            SELECT 
              `a`.`address_id`,
              COUNT(`a`.`id`) AS `total_$type`
            FROM
              `#__celebrity_result` `a`
              LEFT OUTER JOIN `#__celebrity_result_received_type` `b` ON (`a`.`received_type_id` = `b`.`id`)
            WHERE
              `b`.`name` = '$type' AND 
              `a`.`address_id` IN ($keys)
            GROUP BY
              `a`.`address_id`
        ";
        $db->setQuery($query);
        $types = $db->loadObjectList('address_id');
        if($db->getErrorNum()) JError::raiseWarning(500,JText::_('There was a problem with the database when trying to fetch the address type count'));
        
        return ($types) ? $types : 0;
    }
    function getFailure()
    {
        $db = JFactory::getDBO();
        $query = "
        
        ";       
    }
}
?>
