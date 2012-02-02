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



class GKJSTSHelper



{



	var $config;



	var $content;







	/**



	 * 



	 *	INITIALIZATION



	 * 



	 **/



	



	function init()



	{		



		// configuration array



		$this->config = array(



			'module_unique_id' => 'gk_js_topsinger1',				            



            'show_avatar' => true,



            'avatar_width' => 64,



			'avatar_height' => 64,



			'avatar_size' => 'thumb',



			'show_name' => true,



            'show_since' => true,



			'show_lastonline' => true,



			'show_views' => true,



			'rows' => '',



			'cols' => '',



			'pages' => '',



			'module_width' => '',



			'animation' => '',



			'anim_speed' => 0,



			'useJS' => true,



			'useCSS' => true



		);	



		// content array



		$this->content = array(



			'newest' => '',



			'active' => '',



			'popular' => ''



		);



	}



	



	/**



	 * 



	 *	VARIABLES VALIDATION



	 * 



	 **/



	



	function validateVariables(&$params)



	{



		$this->config['module_unique_id'] = $params->get('module_unique_id','gk_js_stats2'); // unique ID



		$this->config['show_avatar'] = (bool) $params->get('show_avatar',0);	



		$this->config['avatar_height'] = $params->get('avatar_height',64);



		$this->config['avatar_size'] = $params->get('avatar_size','thumb');



       	$this->config['show_name'] = (bool) $params->get('show_name',1);



       	$this->config['show_since'] = (bool) $params->get('show_since',0);



       	$this->config['show_lastonline'] = (bool) $params->get('show_lastonline',0);



       	$this->config['show_views'] = (bool) $params->get('show_views',0);



       	$this->config['rows'] = (int) $params->get('rows',10);



       	$this->config['cols'] = (int) $params->get('cols',1);



  		$this->config['pages'] = (int) $params->get('pages',3);



  		$this->config['module_width'] = $params->get('module_width',290);



		$this->config['animation'] = $params->get('animation','linear');



		$this->config['anim_speed'] = $params->get('anim_speed',500);



		$this->config['useJS'] = (bool) $params->get('useJS',1);



		$this->config['useCSS'] = (bool) $params->get('useCSS',1);



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



		$limit = $this->config['rows'] * $this->config['cols'] * $this->config['pages'];	



		//



		// newest members



		//



		$db->setQuery('SELECT CONCAT_WS(" ", `a`.`first_name`, `a`.`middle_name`, `a`.`last_name`) AS `name`,a.id FROM #__celebrity_celebrity a LEFT OUTER JOIN `#__celebrity_celebrity_profession` `c` ON (`c`.`celebrity_id` = `a`.`id`) WHERE a.published=1 and c.profession_id = 250 and MONTH(c.date_created)=MONTH(NOW()) order by c.date_created DESC LIMIT '.$limit);



		// reading results



		$results = $db->loadObjectList();



		$newestMembers = array();



		// iterations



		foreach( $results as $user )



		{

			//$newestMembers[] =  $user->id;

			$newestMembers[] = $user;



		}



		//



		// active members



		//



		$query = 	"SELECT CONCAT_WS(' ', `a`.`first_name`, `a`.`middle_name`, `a`.`last_name`) AS `name`,a.id FROM #__celebrity_celebrity a LEFT OUTER JOIN `#__celebrity_celebrity_profession` `c` ON (`c`.`celebrity_id` = `a`.`id`) WHERE a.published=1 and c.profession_id = 250 and YEAR(c.date_created)=YEAR(NOW()) order by c.date_created DESC LIMIT ".$limit;



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



		$query = 	"SELECT CONCAT_WS(' ', `a`.`first_name`, `a`.`middle_name`, `a`.`last_name`) AS `name`,a.id  FROM #__celebrity_celebrity a LEFT OUTER JOIN `#__celebrity_celebrity_profession` `c` ON (`c`.`celebrity_id` = `a`.`id`) WHERE a.published=1 and c.profession_id = 250 ORDER BY a.id DESC LIMIT ".$limit;


		$db->setQuery( $query );



		$results = $db->loadObjectList();



		



		$popularMembers = array();





		foreach( $results as $user )



		{


			$popularMembers[] = $user;



		}



		// Generating content



		$this->content['newest'] = $newestMembers;



		$this->content['active'] = $activeMembers;



		$this->content['popular'] = $popularMembers;



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



		if($this->config["useCSS"]){



			$document->addStyleSheet( $uri->root().'modules/mod_gk_js_topsinger/style/style.css', 'text/css' );



		}



		//



		if($this->config["useJS"]){



			$document->addScript( $uri->root().'modules/mod_gk_js_topsinger/scripts/engine.js', 'text/javascript' );



		}



		//



		require(JModuleHelper::getLayoutPath('mod_gk_js_topsinger', 'default'));



	}



}







?>