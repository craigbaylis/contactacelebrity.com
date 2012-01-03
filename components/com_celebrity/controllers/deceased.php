<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
* Celebrity Class.
*
* Handles Celebrity Actions
*
* @package        CAC
* @subpackage    com_celebrity
*/

class CelebrityControllerDeceased extends JController {

	public function __construct()
	{
	    parent::__construct();
	}


   public function deceasedsave()
   {
 
        //Check the token for security
       JRequest::checkToken() or JError::raiseError( JText::_( 'INVAILDTOKEN' ), JText::_('INVALIDTOKENERROR') );
       
       
       //get the required models to save the data
       $deceasedModel  =& $this->getModel('deceased');
       
       $cid = JRequest::getcmd("cid");
       //get the data from the form
       $post = JRequest::get('POST');
       
       //force a new record to be created
       $post['id'] = false;
       
       //set extra variables
       $user    =& JFactory::getUser();
       $date   =& JFactory::getDate();
       $post['created_by_uid'] = $user->get('id');
	   $post['comment'] = $post['comment'];
       $post['date_created'] = $date->toMySQL();
	   $post['offer_cond'] = $post['offer_cond'];
	   $post['news_link'] = $post['news_link'];
       $post['deceased_date'] =  date('Y-m-d', strtotime($post['desdate']."-".$post['desmonth']."-".$post['desyear']));
       
       
       //save data to deceased table
       $deceased = $deceasedModel->store($post);
	   
	   //update a deceased comment in celebrity table
       $db = JFactory::getDBO();
       $query = "
            UPDATE
              `#__celebrity_celebrity` `a`
            SET
              `is_deceased` = 1,
			  `deceased_comment_id` = $deceased
            WHERE
              `a`.`id` = $cid       
       ";
       $db->setQuery($query);
       $db->query();
	   
	   /*send a mail*/
	   $config =& JFactory::getConfig();
	   $mailer =& JFactory::getMailer();
	   $sender = array($config->getValue( 'config.mailfrom' ),$config->getValue( 'config.fromname' ) );
	   $celebrityname = $post['celebrity_name'];
	   $username = $user->username;
	   $body   = "Hi, $username said celebrity $celebrityname is deceased.";
	   $mailer->setSubject("$celebrityname is report as deceased.");
	   $mailer->setBody($body);
	   $mailer->setSender($sender); 
	  // $recipient = array( 'madhu@intrug.com');
	   $mailer->addRecipient($config->getValue( 'config.mailfrom' ));
	   $send =& $mailer->Send();
		if ( $send !== true ) {
			JError::raiseError(500,'Error sending email: ' . $send->message);
		} else {
			echo 'Mail sent';
		}
	   /*send a mail*/
	   
  	 $msg = $post['celebrity_name']." is report as deceased";
     $this->setRedirect('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$cid.'&Itemid=60',$msg);
       
   }
  

}
?>
