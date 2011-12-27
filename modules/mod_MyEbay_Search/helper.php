<?php
/**
* @version		$Id: helper.php 10381 2008-06-01 03:35:53Z edeetion $
* @package		Joomla
* @copyright	Copyright (C) 2008 - edeetion.com.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
class modMyEbay_SearchHelper
{
  function getMyEbay_Search($params)
  {
	//get tags from search results
    //$session = JFactory::getSession();
    //$tags = $session->get('celebrity_name_search_result');
    
    //get tags from database table
	if(JRequest::getCmd('searchword')){
		if(isset($_POST['searchword'])){
			$letter = str_replace("+"," ",$_POST['searchword']);//JRequest::getCmd('searchword');	
		} else {
			$letter = str_replace("+"," ",$_GET['searchword']);
		}
   // $letter = str_replace("+"," ",JRequest::getCmd('searchword'));
	} else {
	$cid = JRequest::getCmd('cid');
	//detail page
	$dbdetails = JFactory::getDBO();
    $querydetails = "
        SELECT 
          `a`.`first_name`,
		  `a`.`last_name`
        FROM
          `jos_celebrity_celebrity` `a`
        WHERE
          `a`.`id` = '$cid'
    ";
     $dbdetails->setQuery($querydetails);
     $resultdetails = $dbdetails->loadAssoc();
	 $letter = $resultdetails['first_name']." ".$resultdetails['last_name']; //get a firstname of celebrity		
	}
    //$db = JFactory::getDBO();
//    $query = "
//        SELECT 
//          `a`.`celeb_name`
//        FROM
//          `jos_celebrity_browse` `a`
//        WHERE
//          `a`.`celeb_name` like '%$letter%'
//    ";
//     $db->setQuery($query);
//     $result = $db->loadResultArray();
//	 if(!$result){
//	$dbresult = JFactory::getDBO();
//    $querydbresult = "
//        SELECT 
//          `a`.`celeb_name`
//        FROM
//          `jos_celebrity_browse` `a`
//        WHERE
//          `a`.`alpha` = '$letter'
//    ";
//	 $dbresult->setQuery($querydbresult);
//     $getresult = $dbresult->loadResultArray();
//	 $value_key = array_rand($getresult);
//     $tags = $getresult[$value_key]; 
//	 } else {
	
     $tags = $letter; 
	// }
//     
    if(!empty($tags)) {
        $tags = htmlspecialchars($tags).' '.$params->get('tags');
        $tags = str_replace(' ', '+', $tags);
    }
    
    // module params  	
	$limitAuction =  $params->get('limitAuction', '10');	
	$picture =  $params->get('picture', '1');
	$category =  $params->get('category', '');
	if (!empty($category)){
	    $cat = "&sacat=".$category;
	} else {
        $cat = '';
    }
	$searchtype = $params->get('searchtype', '1');
	$searchtypefinal = '&fts='.$searchtype;

	$sortorder = $params->get('sortorder','efirst');
	switch ($sortorder){
	  case('efirst'):
	    $sortorderfinal = "&fsoo=1&fsop=1";
		break;
			 
	  case('hprice'):
	    $sortorderfinal = "&fsoo=2&fsop=3";
	    break;
			 
	  case('bmatch'):
	    $sortorderfinal = "&fsoo=1&fsop=32";
	    break;
			
	  case('nlisted'):
	    $sortorderfinal = "&fsoo=2&fsop=2";
		break;
			
	  case('priceaslow'):
	    $sortorderfinal = "&fsoo=1&fsop=34";
		break;
	}
	$auctiontype = $params->get('auctiontype', 'all');
	switch ($auctiontype){
	  case ('all'):
	    $auctiontypefinal = '&sabfmts=0&sascs=0';
		break;
	  case ('auctiononly'):
	    $auctiontypefinal = '&sabfmts=1&sascs=1';
		break;
	  case ('binonly'):
		$auctiontypefinal = '&sabfmts=2&sascs=2';
		break;
	 }
    $session = JFactory::getSession();
    $source = strtolower($session->get('ip_code'));
    $language = 'en-EN';  
    		
	// get Ebay portal
	switch($source){
	  case 'us':
	    $siteId = '0';
		break;
        
      case 'ca':
        $siteId = 2;
        break;        
		
	  case 'uk':
	    $siteId = 3;
		break;
	
	  case 'au':
	    $siteId = 15;
		break;
 
       case 'at':
        $siteId = 16;
        break;
 
      case 'be':
        $siteId = 23;
        break;
        
      case 'fr':
        $siteId = 71;
        break;         

      case 'de':
        $siteId = 77;
        break;
        
      case 'it':
        $siteId = 101;
        break;        
        
      case "nl":
        $siteId = 146;
        break;
        
      case 'es':
        $siteId = 186;
        break;

      case 'ch':
        $siteId = 193;
        break;                         

      case 'hk':
        $siteId = 201;
        break;        

      case 'in':
        $siteId = 203;
        break;
        
      case 'ie':
        $siteId = 205;
        break;
        
      case 'my':
        $siteId = 193;
        break;
        
      case 'ph':
        $siteId = 211;
        break;                        

      case 'pl':
        $siteId = 212;
        break;
        
      case 'sg':
        $siteId = 216;
        break;                  
        
      default:
        $siteId = 0;
	}
	//decide which campaign id to use based on the page being viewd
    $task = JRequest::getCmd('task');
    switch($task)
    {
        case 'search':
        if($this->searchType == 'browse') {
            $afepn = 5336911965;
        } else {
            $afepn = 5336926896;
        }
        break;
        
        case 'address':
        $afepn = 5336223578;
        
        default:
        $afepn = 5336223578;
    }
    
    $rssUrl = "http://rss.api.ebay.com/ws/rssapi?FeedName=SearchResults&dfsp=32&from=R6&nojspr=y&output=RSS20&saaff=afepn&language=en-US&siteId=$siteId&afepn=$afepn&satitle=$tags&fbfmt=1".$auctiontypefinal.$sortorderfinal.$cat.$searchtypefinal;
	//  get RSS parsed object
	
	$options = array();
	$options['rssUrl'] 		= $rssUrl;
	if ($params->get('cache')) {
	  $options['cache_time']  = $params->get('cache_time', 15) ;
	  $options['cache_time']	*= 60;
	} else {
	  $options['cache_time'] = null;
	}

	$rssDoc =& JFactory::getXMLparser('RSS', $options);
	$feed = new stdclass();

	if ($rssDoc != false)
	{
		 
	  $items = $rssDoc->get_items();
	  $feed->items = array_slice($items, 0, $params->get('rssitemRSS', $limitAuction));	 
	  // feed elements
	   if(!$items){
		//print_r($rssDoc);   
	   } else {
		      // channel header and link
	  $feed->title = $rssDoc->get_title();
	  $feed->link = $rssDoc->get_link();
	  $feed->description = $rssDoc->get_description();

	  // channel image if exists
      $feed->image->url = $rssDoc->get_image_url();
	  $feed->image->title = $rssDoc->get_image_title();
      // items
   
	   }
	  /*new operation */
	
	  /*new operation*/
	 
	} else {
	  $feed = false;
	}
	return $feed;
  }
  
  function getListmyCelebrityLetter($params){
	  if(JRequest::getCmd('searchword')){
    //$letter = str_replace("+"," ",JRequest::getCmd('searchword'));
		if(isset($_POST['searchword'])){
			$letter = str_replace("+"," ",$_POST['searchword']);//JRequest::getCmd('searchword');	
		} else {
			$letter = str_replace("+"," ",$_GET['searchword']);
		}
	} else {
	$cid = JRequest::getCmd('cid');
	//detail page
	$dbdetails = JFactory::getDBO();
    $querydetails = "
        SELECT 
          `a`.`first_name`,
		  `a`.`last_name`
        FROM
          `jos_celebrity_celebrity` `a`
        WHERE
          `a`.`id` = '$cid'
    ";
     $dbdetails->setQuery($querydetails);
     $resultdetails = $dbdetails->loadAssoc();
	 $letter = $resultdetails['first_name']." ".$resultdetails['last_name']; //get a firstname of celebrity		
	}
	  $dbresult = JFactory::getDBO();
			$querydbresult = "
				SELECT 
				  `a`.`alpha`
				FROM
				  `jos_celebrity_browse` `a`
				WHERE
				  `a`.`alpha` = '$letter[0]'
			";
			 $dbresult->setQuery($querydbresult);
			 $getresult = $dbresult->loadResultArray();
			 $value_key = array_rand($getresult);
			 $tags = $getresult[$value_key]; 
	      if(!empty($tags)) {
        $tags = htmlspecialchars($tags).' '.$params->get('tags');
        $tags = str_replace(' ', '+', $tags);
    }
    
    // module params  	
	$limitAuction =  $params->get('limitAuction', '10');	
	$picture =  $params->get('picture', '1');
	$category =  $params->get('category', '');
	if (!empty($category)){
	    $cat = "&sacat=".$category;
	} else {
        $cat = '';
    }
	$searchtype = $params->get('searchtype', '1');
	$searchtypefinal = '&fts='.$searchtype;

	$sortorder = $params->get('sortorder','efirst');
	switch ($sortorder){
	  case('efirst'):
	    $sortorderfinal = "&fsoo=1&fsop=1";
		break;
			 
	  case('hprice'):
	    $sortorderfinal = "&fsoo=2&fsop=3";
	    break;
			 
	  case('bmatch'):
	    $sortorderfinal = "&fsoo=1&fsop=32";
	    break;
			
	  case('nlisted'):
	    $sortorderfinal = "&fsoo=2&fsop=2";
		break;
			
	  case('priceaslow'):
	    $sortorderfinal = "&fsoo=1&fsop=34";
		break;
	}
	$auctiontype = $params->get('auctiontype', 'all');
	switch ($auctiontype){
	  case ('all'):
	    $auctiontypefinal = '&sabfmts=0&sascs=0';
		break;
	  case ('auctiononly'):
	    $auctiontypefinal = '&sabfmts=1&sascs=1';
		break;
	  case ('binonly'):
		$auctiontypefinal = '&sabfmts=2&sascs=2';
		break;
	 }
    $session = JFactory::getSession();
    $source = strtolower($session->get('ip_code'));
    $language = 'en-EN';  
    		
	// get Ebay portal
	switch($source){
	  case 'us':
	    $siteId = '0';
		break;
        
      case 'ca':
        $siteId = 2;
        break;        
		
	  case 'uk':
	    $siteId = 3;
		break;
	
	  case 'au':
	    $siteId = 15;
		break;
 
       case 'at':
        $siteId = 16;
        break;
 
      case 'be':
        $siteId = 23;
        break;
        
      case 'fr':
        $siteId = 71;
        break;         

      case 'de':
        $siteId = 77;
        break;
        
      case 'it':
        $siteId = 101;
        break;        
        
      case "nl":
        $siteId = 146;
        break;
        
      case 'es':
        $siteId = 186;
        break;

      case 'ch':
        $siteId = 193;
        break;                         

      case 'hk':
        $siteId = 201;
        break;        

      case 'in':
        $siteId = 203;
        break;
        
      case 'ie':
        $siteId = 205;
        break;
        
      case 'my':
        $siteId = 193;
        break;
        
      case 'ph':
        $siteId = 211;
        break;                        

      case 'pl':
        $siteId = 212;
        break;
        
      case 'sg':
        $siteId = 216;
        break;                  
        
      default:
        $siteId = 0;
	}
	//decide which campaign id to use based on the page being viewd
    $task = JRequest::getCmd('task');
    switch($task)
    {
        case 'search':
        if($this->searchType == 'browse') {
            $afepn = 5336911965;
        } else {
            $afepn = 5336926896;
        }
        break;
        
        case 'address':
        $afepn = 5336223578;
        
        default:
        $afepn = 5336223578;
    }
    
    $rssUrl = "http://rss.api.ebay.com/ws/rssapi?FeedName=SearchResults&dfsp=32&from=R6&nojspr=y&output=RSS20&saaff=afepn&language=en-US&siteId=$siteId&afepn=$afepn&satitle=$tags&fbfmt=1".$auctiontypefinal.$sortorderfinal.$cat.$searchtypefinal;
	//  get RSS parsed object
	$options = array();
	$options['rssUrl'] 		= $rssUrl;
	if ($params->get('cache')) {
	  $options['cache_time']  = $params->get('cache_time', 15) ;
	  $options['cache_time']	*= 60;
	} else {
	  $options['cache_time'] = null;
	}

	$rssDoc =& JFactory::getXMLparser('RSS', $options);
	$feed = new stdclass();

	if ($rssDoc != false)
	{
		 
	  $items = $rssDoc->get_items();
	  $feed->items = array_slice($items, 0, $params->get('rssitemRSS', $limitAuction));	 
	  // feed elements
	   if(!$items){
		//print_r($rssDoc);   
	   } else {
		      // channel header and link
	  $feed->title = $rssDoc->get_title();
	  $feed->link = $rssDoc->get_link();
	  $feed->description = $rssDoc->get_description();

	  // channel image if exists
      $feed->image->url = $rssDoc->get_image_url();
	  $feed->image->title = $rssDoc->get_image_title();
      // items
   
	   }
	  /*new operation */
	
	  /*new operation*/
	 
	} else {
	  $feed = false;
	}
	return $feed;
	  
}
	  
	  
  

}