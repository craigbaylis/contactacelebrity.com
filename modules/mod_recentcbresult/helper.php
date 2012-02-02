<?php







/**



* Gavick GK JS Members - helper class



* @package Joomla!



* @Copyright (C) 2009 Gavick.com



* @ All rights reserved



* @ Joomla! is Free Software



* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html



* @version $Revision: 1.0.0 $



**/







// no direct access



defined('_JEXEC') or die('Restricted access');



// required files



require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');



// Main class



class RCRHelper



{



	var $configresult;



	var $contentresult;







	/**



	 * 



	 *	INITIALIZATION



	 * 



	 **/



	



	function init()



	{		



		// configuration array



		$this->configresult = array(



			'module_unique_id' => 'mod_recentcbresult1',				            



            'show_avatar' => true,



            'avatar_width' => 150,



			'avatar_height' => 180,



			'avatar_size' => 'thumb',



			'show_name' => true,



            'show_since' => true,



			'show_lastonline' => true,



			'show_views' => true,



			'rowsresult' => '',



			'colsresult' => '',



			'pagesresult' => '',



			'module_width' => '',



			'animation' => '',



			'anim_speed' => 0,



			'useJS' => true,



			'useCSS' => true



		);	



		// content array



		$this->contentresult = array(



			'postal' => '',



			'email' => '',



			'website' => ''



		);



	}



	



	/**



	 * 



	 *	VARIABLES VALIDATION



	 * 



	 **/



	



	function validateVariables(&$paramsresult)



	{



		$this->configresult['module_unique_id'] = $paramsresult->get('module_unique_id','gk_js_stats1'); // unique ID



		$this->configresult['show_avatar'] = (bool) $paramsresult->get('show_avatar',1);	



		$this->configresult['avatar_height'] = $paramsresult->get('avatar_height',180);



		$this->configresult['avatar_size'] = $paramsresult->get('avatar_size','thumb');



       	$this->configresult['show_name'] = (bool) $paramsresult->get('show_name',1);



       	$this->configresult['show_since'] = (bool) $paramsresult->get('show_since',1);



       	$this->configresult['show_lastonline'] = (bool) $paramsresult->get('show_lastonline',1);



       	$this->configresult['show_views'] = (bool) $paramsresult->get('show_views',1);



       	$this->configresult['rowsresult'] = (int) $paramsresult->get('rowsresult',2);



       	$this->configresult['colsresult'] = (int) $paramsresult->get('colsresult',4);



  		$this->configresult['pagesresult'] = (int) $paramsresult->get('pagesresult',3);



  		$this->configresult['module_width'] = $paramsresult->get('module_width',650);



		$this->configresult['animation'] = $paramsresult->get('animation','linear');



		$this->configresult['anim_speed'] = $paramsresult->get('anim_speed',500);



		$this->configresult['useJS'] = (bool) $paramsresult->get('useJS',1);



		$this->configresult['useCSS'] = (bool) $paramsresult->get('useCSS',1);



	}



	



	/**



	 * 



	 *	GETTING DATA



	 * 



	 **/



		



	function getData()



	{



		// Creating DB object instance



		$db =& JFactory::getDBO();



		$limit = $this->configresult['rowsresult'] * $this->configresult['colsresult'] * $this->configresult['pagesresult'];	



		//



		// newest members



		//



		$db->setQuery('SELECT a.id,a.address_id,DATE_FORMAT(a.date_created,"%e.%m.%Y") AS datecreate,u.username,`p`.`filename`,`p`.`title`,ca.company,cca.celebrity_id,p.alias
FROM #__celebrity_result a INNER JOIN #__users u ON (a.created_by_id = u.id) INNER JOIN #__phocagallery p ON (a.id = p.result_id) INNER JOIN #__celebrity_address ca ON (a.address_id = ca.id) INNER JOIN #__celebrity_celebrity_address cca ON (a.address_id = cca.address_id) WHERE   a.published=1 group by p.result_id order by a.id DESC LIMIT '.$limit);



		// reading results



		$results = $db->loadObjectList();

		

		$newestMembers = array();



		// iterations



		foreach( $results as $user )



		{



			$newestMembers[] = $user;



		}



		//



		// active members



		//



		$query = 	"SELECT a.id,a.address_id,ce.celebrity_id,DATE_FORMAT(a.date_created,'%e.%m.%Y') AS datecreate,u.username,`p`.`filename`,`p`.`title`,ce.email,p.alias
FROM #__celebrity_result a INNER JOIN #__users u ON (a.created_by_id = u.id) INNER JOIN #__phocagallery p ON (a.id = p.result_id) INNER JOIN #__celebrity_email ce ON (a.address_id = ce.id) WHERE   a.published=1 group by p.result_id order by a.id DESC LIMIT ".$limit;



		$db->setQuery( $query );



		$results = $db->loadObjectList();
		

		//



		$activeMembers = array();


		



		foreach( $results as $user )



		{



			$activeMembers[] = $user;

		}



		//



		// popular members



		//			



		$query = 	"SELECT a.id,a.address_id,cw.celebrity_id,DATE_FORMAT(a.date_created,'%e.%m.%Y') AS datecreate,u.username,`p`.`filename`,`p`.`title`,cw.url,p.alias
FROM #__celebrity_result a INNER JOIN #__users u ON (a.created_by_id = u.id) INNER JOIN #__phocagallery p ON (a.id = p.result_id) INNER JOIN #__celebrity_website cw ON (a.address_id = cw.id) WHERE   a.published=1 group by p.result_id order by a.id LIMIT ".$limit;



		$db->setQuery( $query );



		$results = $db->loadObjectList();


	
		


		$popularMembers = array();



		



		foreach( $results as $user )



		{



			$popularMembers[] = $user;



		}



		// Generating content



		$this->contentresult['postal'] = $newestMembers;



		$this->contentresult['email'] = $activeMembers;



		$this->contentresult['website'] = $popularMembers;



	}



	



	/**



	 * 



	 *	RENDERING LAYOUT



	 * 



	 **/



	



	function renderLayout()



	{	



		/**



			GENERATING FINAL XHTML CODE START



		**/







		// create instances of basic Joomla! classes



		$document =& JFactory::getDocument();



		$uri =& JURI::getInstance();



		// add stylesheets to document header



		if($this->configresult["useCSS"]){



			$document->addStyleSheet( $uri->root().'modules/mod_recentcbresult/style/style.css', 'text/css' );



		}



		//



		if($this->configresult["useJS"]){



			$document->addScript( $uri->root().'modules/mod_recentcbresult/scripts/engine.js', 'text/javascript' );



		}



		//



		require(JModuleHelper::getLayoutPath('mod_recentcbresult', 'default'));



	}



}







?>