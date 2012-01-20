<?php
/**
 * Celebrity Model for Celebrity Component
 * 
 * @package    Celebrity
 * @subpackage com_celebrity
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * Celebrity Model
 *
 * @package    Joomla.Components
 * @subpackage 	Celebrity
 */
class CelebrityModelResult extends JModel{

	/**
	 * Result data array for tmp store
	 *
	 * @var array
	 */
	private $_data;
	
	/**
	 * Gets the data
	 * @return mixed The data to be displayed to the user
	 */
	public function getData()
    {
		if (empty( $this->_data )){
			$id = JRequest::getInt('id',  0);
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM `#__celebrity_result` where `id` = {$id}";
			$db->setQuery( $query );
			$this->_data = $db->loadObject();
		}
		return $this->_data;
	}
    
    public function saveResult()
    {
               
        //prepare data for the database
        $date_created = JFactory::getDate();
        JRequest::setVar('date_created',$date_created->toMySQL(),'post');
        
        $date_sent = JRequest::getVar('date_sent',null,'post');
        $date_sent = JFactory::getDate($date_sent);
        JRequest::setVar('date_sent',$date_sent->toMySQL(),'post');
        
        $date_received = JRequest::getVar('date_received',null,'post');
        $date_received = JFactory::getDate($date_received);
        JRequest::setVar('date_received',$date_received->toMySQL(),'post');
        
        $user = JFactory::getUser();
        JRequest::setVar('created_by_id',$user->get('id'),'post');        
        
        //get the result data to save
        $resultData = JRequest::get('post');
        
        //get the table
        $resultTable = $this->getTable('result');
        
        //save data in table
        $resultTable->bind($resultData);
        if (!$resultTable->store()) {
            return false;
        } else {
            return $this->_db->insertid();
        }
            
    }
	
	public function getResultOfAddress()
    {
 		$aid  = Jrequest::getcmd("aid");
		$id  = Jrequest::getcmd("id");
        if (!$aid) JError::raiseError(500,'Missing address identification code');
        //build query
		$db =& JFactory::getDBO();
        $query = "
            SELECT 
			 a.id,
             a.address_id,
			 a.created_by_id,
			 DATE_FORMAT(a.date_sent,'%m/%d/%Y') AS datesent,
			 DATE_FORMAT(a.date_received,'%m/%d/%Y') AS datereceive,
			 DATE_FORMAT(a.date_created,'%a, %b %d %Y %h:%i%p') AS datecreate,			 
			 a.comments,
			 u.username,
			 c.thumb,
			 r.label,
			 q.quality			 
            FROM
              #__celebrity_result a  
			  INNER JOIN #__users u ON (a.created_by_id = u.id)
			  INNER JOIN #__community_users c ON (u.id = c.userid)
			  INNER JOIN #__celebrity_result_received_type r ON (a.received_type_id = r.id)
			  LEFT OUTER JOIN #__celebrity_result_quality q ON (q.id=a.quality_id)  
			          
            WHERE
              a.id = $id and
			  a.published=1 order by a.id desc
        ";
        $db->setQuery( $query );
		$this->_data = $db->loadObject();

		return $this->_data;     
     
    } 
	
	public function getMemberSent($result_id) {
 		$aid  = Jrequest::getcmd("aid");
        if (!$aid) JError::raiseError(500,'Missing address identification code');
		
        //build query
        $query = "select rst.label from #__celebrity_result a,#__celebrity_result_sent rs,#__celebrity_result_sent_type as rst where a.id = rs.result_id and  rst.id = rs.sent_type_id and a.id=".$result_id;
		 $db = JFactory::getDBO();
        $db->setQuery($query);
        $result = $db->loadResultArray();
        return $result;   
     
   	} 
	
	public function getCelebrityDetail() {
 		$cid  = Jrequest::getcmd("cid");
        if (!$cid) JError::raiseError(500,'Missing celebrity identification code');
		
        //build query
		$db =& JFactory::getDBO();
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
				  `a`.`album_catid`,
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
		 $db->setQuery( $query );
		$this->_data = $db->loadObject();

		return $this->_data;     
     
   	} 
	
	
	public function getResultPhoto() {
 		$id  = Jrequest::getcmd("id");
        if (!$id) JError::raiseError(500,'Missing result id identification code');
		
		$db = JFactory::getDBO();
        //build query
        $query = " SELECT 
                  `a`.`filename`,
				   `a`.`title`
				  from #__phocagallery `a`
				  where a.result_id=$id
				  ";
        $db->setQuery( $query );
		$this->_data = $db->loadResultArray();
		$result_image = array();
		$Lresult_image = array();
		if ($this->_data) {	
		foreach($this->_data as $newimage){			
			$resultexplode = explode("/",$newimage); 
/*			for($g=0;$g<count($resultexplode)-1;$g++):
			$getphotopath = $resultexplode[$g]."/";
			endfor;*/
			$image_location = 'images/phocagallery/'.$resultexplode[0].'/'.$resultexplode[1].'/'.$resultexplode[2].'/'.$resultexplode[3].'/'.'thumbs/phoca_thumb_m_'.end($resultexplode);	
			$Limage_location = 'images/phocagallery/'.$resultexplode[0].'/'.$resultexplode[1].'/'.$resultexplode[2].'/'.$resultexplode[3].'/'.'thumbs/phoca_thumb_l_'.end($resultexplode);
				 $file_path = JPATH_SITE.DS.str_replace('/', DS, $image_location);
					if (!file_exists($file_path)) {
                        $result_image[] = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
						$Lresult_image[] = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
                    } else {
                        $result_image[] = JURI::root().$image_location;
						$Lresult_image[] = JURI::root().$Limage_location;
                    }
				 
			}
		 }  else {
				$result_image[] = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
				$Lresult_image[] = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
		}
			$db = JFactory::getDBO();
        //build query
        $title = " SELECT 
				   `a`.`title`
				  from #__phocagallery `a`
				  where a.result_id=$id
				  ";
        $db->setQuery( $title );
		$this->_data = $db->loadResultArray();
		$image_title = array();
		$image_title = $this->_data;
$smallimage = array("smallimage"=>$result_image,"imagetitle"=>$image_title);
$largeimage = array("largeimage"=>$Lresult_image);
$arraymerge = array_merge($smallimage,$largeimage);
return $arraymerge;     
     
   	} 
	
	
/*=================================================Jcomment - Recent======================================*/	

public function getRecentcomment() {
 		$id  = Jrequest::getcmd("id");
        if (!$id) JError::raiseError(500,'Missing result id identification code');
		
        //build query
        $query = "select
		      b.username,
              b.comment,
			  a.thumb,
			  c.name,
			  DATE_FORMAT(b.date,'%a, %b %d %Y %h:%i%p') AS created,
			  b.userid
			  from  #__jcomments b 
			  INNER JOIN #__community_users a ON (a.userid = b.userid)
			  INNER JOIN #__users c ON (c.id = b.userid)
			  where b.object_id = ".$id." and b.object_group = 'com_celebrity' order by b.id desc limit 0,4";
		 $db = JFactory::getDBO();
        $db->setQuery($query);
        $result = $db->loadRowList();
        return $result;   
     
   	} 
	
}
