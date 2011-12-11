<?php

/*
#------------------------------------------------------------------------
# Copyright (C) 2007-2010 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com   
#------------------------------------------------------------------------ 
# Based on T3 Framework
#------------------------------------------------------------------------
# Copyright (C) 2004-2009 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - GNU/GPL, http://www.gnu.org/copyleft/gpl.html
# Author: J.O.O.M Solutions Co., Ltd
# Websites: http://www.joomlart.com - http://www.joomlancers.com
#------------------------------------------------------------------------
*/

define ('GK_TOOL_COLOR', 'gk_color');
define ('GK_TOOL_SCREEN', 'gk_screen');
define ('GK_TOOL_FONT', 'gk_font');
define ('GK_TOOL_MENU', 'gk_menu');

require_once (dirname(__FILE__).DS.'obj.extendable.php');

class GKTemplateHelper extends ObjectExtendable {
	function GKTemplateHelper ($template, $_params_cookie=null) {
		$helper = new GKTemplateHelper1 ($template, $_params_cookie);
		$this->_extend (array($template, $helper));
	}

	function &getInstance($template=null, $_params_cookie=null){
		static $instance;
		if (!isset( $instance )) $instance = new GKTemplateHelper ($template, $_params_cookie);
		return $instance;
	}

	function display ($layout) { $this->_load ($layout); }
	function _load ($layout) { if (($layoutpath = $this->layout_exists ($layout))) { include ($layoutpath); } }
	function _display ($layout) { $tmplTools = JATemplateHelper::getInstance(); $tmplTools->display ($layout); }
	function loadBlock ($name) { $this->_load ('blocks'.DS.$name); }	
	//Override template countModules function: prevent empty count.
	function countModules ($modules) {
		if ($this->isContentEdit()) return 0;
		$_tpl = $this->_tpl;
		return $modules?$_tpl->countModules ($modules):0;
	}
}

class GKTemplateHelper1 {
	var $_params_cookie = null; //Params will store in cookie for user select. Default: store all params
	var $_tpl = null;
	var $template = '';
	var $_positions = null;
	var $_colwidth = null;
	var $_basewidth = 10;

	function GKTemplateHelper1 ($template, $_params_cookie=null) {
		//$this->_extend ($template);
		$this->_tpl = $template;
		$this->template = $template->template;
		
		if(!$_params_cookie) {
			$this->_params_cookie = $this->_tpl->params->toArray();
		} else {
			foreach ($_params_cookie as $k) {
				$this->_params_cookie[$k] = $this->_tpl->params->get($k);
			}
		}

		$this->getUserSetting();
		$this->_colwidth = array();
		$this->_positions = array();
	}
	
	function addParamCookie ($_params_cookie) {
		if (!is_array($_params_cookie)) $_params_cookie = array($_params_cookie);
		$tpl = $this->_tpl;

		foreach ($_params_cookie as $k) {
			$this->_params_cookie[$k] = $tpl->params->get($k);
		}
		$this->getUserSetting();
	}

	function &getInstance1($template=null, $_params_cookie=null) {
		static $instance;
		
		if (!isset( $instance )) {
			$instance = new GKTemplateHelper1 ($template, $_params_cookie);
		}
		
		return $instance;
	}

	function getUserSetting(){
		$exp = time() + 60*60*24*355;
		if (isset($_COOKIE[$this->template.'_tpl']) && $_COOKIE[$this->template.'_tpl'] == $this->template){
			foreach($this->_params_cookie as $k=>$v) {
				$kc = $this->template."_".$k;
				if (JRequest::getVar($k, null, 'GET') !== null) {
					$v = preg_replace('/[\x00-\x1F\x7F<>;\/\"\'%()]/', '', JRequest::getString($k, '', 'GET'));
					setcookie ($kc, $v, $exp, '/');
				}else{
					if (isset($_COOKIE[$kc])){
						$v = $_COOKIE[$kc];
					}
				}
				$this->setParam($k, $v);
			}
		}else{
			setcookie ($this->template.'_tpl', $this->template, $exp, '/');
		}

		return $this;
	}

	function getParam ($param, $default='', $raw=false) {
		if (isset($this->_params_cookie[$param])) {
			if ($raw) return $this->_params_cookie[$param];
			else return preg_replace('/[\x00-\x1F\x7F<>;\/\"\'%()]/', '', $this->_params_cookie[$param]);
		}

		if ($raw) {
			return $this->_tpl->params->get($param, $default);
		}
		return preg_replace('/[\x00-\x1F\x7F<>;\/\"\'%()]/', '', $this->_tpl->params->get($param, $default));
	}

	function setParam ($param, $value) {
		$this->_params_cookie[$param] = $value;
	}

	function getCurrentURL(){
		$cururl = JRequest::getURI();
		if(($pos = strpos($cururl, "index.php"))!== false){
			$cururl = substr($cururl,$pos);
		}
		
		$cururl =  JRoute::_($cururl, true, 0);
		return $cururl;
	}

	function getCurrentMenuIndex(){
		$Itemid = JRequest::getInt( 'Itemid');
		$database		=& JFactory::getDBO();
		$id = $Itemid;
		$menutype = 'mainmenu';
		$ordering = '0';

		while (1){
			$sql = "select parent, menutype, ordering from #__menu where id = $id limit 1";
			$database->setQuery($sql);
			$row = null;
			$row = $database->loadObject();

			if ($row) {
				$menutype = $row->menutype;
				$ordering = $row->ordering;
				if ($row->parent > 0) {
					$id = $row->parent;
				}else break;
			}else break;
		}
		
		$user	=& JFactory::getUser();

		if (isset($user)) {
			$aid = $user->get('aid', 0);
			$sql = "SELECT count(*) FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$aid' AND parent=0 and ordering < $ordering";
		} else {
			$sql = "SELECT count(*) FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND parent=0 and ordering < $ordering";
		}

		$database->setQuery($sql);
		return $database->loadResult();
	}

	function calSpotlight ($spotlight, $totalwidth=100, $specialwidth=0, $special='first') {
		/********************************************
		$spotlight = array ('position1', 'position2',...)
		*********************************************/
		$modules = array();
		$modules_s = array();

		foreach ($spotlight as $position) {
			if( $this->_tpl->countModules ($position) ){
				$modules_s[] = $position;
			}
			$modules[$position] = array('class'=>'-full','width'=>$totalwidth.'%');
		}

		if (!count($modules_s)) return null;

		if ($specialwidth) {
			if (count($modules_s)>1) {
				$width = round(($totalwidth-$specialwidth)/(count($modules_s)-1),1) . "%";
				$specialwidth = $specialwidth . "%";
			}else{
				$specialwidth = $totalwidth . "%";
			}
		}else{
			$width = (round($totalwidth/(count($modules_s)),2)) . "%";
			$specialwidth = $width;
		}
		
		if($width * count($modules_s) > 100.0){
			$width = $width - 0.005;
		}

		if (count ($modules_s) > 1){
			$modules[$modules_s[0]]['class'] = "-left";
			$modules[$modules_s[0]]['width'] = (($special=='left')?$specialwidth - ($this->isIE() ? 0.1 : 0) : $width - ($this->isIE() ? 0.1 : 0)). '%';
			$modules[$modules_s[count ($modules_s) - 1]]['class'] = "-right";
			$modules[$modules_s[count ($modules_s) - 1]]['width'] = (($special=='right')?$specialwidth - ($this->isIE() ? 0.1 : 0) : $width - ($this->isIE() ? 0.1 : 0)). '%';
			for ($i=1; $i<count ($modules_s) - 1; $i++){
				$modules[$modules_s[$i]]['class'] = "-center";
				$modules[$modules_s[$i]]['width'] = ($width - ($this->isIE() ? 0.1 : 0)). '%';
			}
		}

		return $modules;
	}	

	function isIE6 () {
		$msie='/msie\s(5\.[5-9]|[6]\.[0-9]*).*(win)/i';
		$notIE6 = '/msie\s([7-9]\.[0-9]*).*(win)/i';
		return isset($_SERVER['HTTP_USER_AGENT']) &&
		preg_match($msie,$_SERVER['HTTP_USER_AGENT']) &&
		!preg_match($notIE6,$_SERVER['HTTP_USER_AGENT']) &&
		!preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']);
	}
	
	function isIE () {
		$msie='/msie/i';
		return isset($_SERVER['HTTP_USER_AGENT']) &&
			preg_match($msie,$_SERVER['HTTP_USER_AGENT']) &&
			!preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']);
	}

	function isIPad () {
		$ipad='/ipad/i';
		return isset($_SERVER['HTTP_USER_AGENT']) && preg_match($ipad, $_SERVER['HTTP_USER_AGENT']);
	}

	function isOP () {
		return isset($_SERVER['HTTP_USER_AGENT']) &&
			preg_match('/opera/i',$_SERVER['HTTP_USER_AGENT']);
	}

	function isFrontPage(){
		return (JRequest::getCmd( 'view' ) == 'frontpage') ;
	}

	function isContentEdit() {
		return (JRequest::getCmd( 'option' )=='com_content' && JRequest::getCmd( 'view' ) == 'article' && (JRequest::getCmd( 'task' ) == 'edit' || JRequest::getCmd( 'layout' ) == 'form'));

	}

	function sitename() {
		$config = new JConfig();
		return $config->sitename;
	}

	function browser () {
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if ( strpos($agent, 'Gecko') ) {
		   if ( strpos($agent, 'Netscape') ) $browser = 'NS';
		   else if ( strpos($agent, 'Firefox') ) $browser = 'FF';
		   else $browser = 'Moz';
		} else if ( strpos($agent, 'MSIE') && !preg_match('/opera/i',$agent) ) {
			 $msie='/msie\s(7|8\.[0-9]).*(win)/i';
		   	 if (preg_match($msie,$agent)) $browser = 'IE7';
		   	 else $browser = 'IE6';
		} else if ( preg_match('/opera/i',$agent) ) {
		     $browser = 'OPE';
		} else {
		   $browser = 'Others';
		}

		return $browser;
	}

	function baseurl(){ return JURI::base(); }
	function templateurl(){ return JURI::base()."templates/".$this->template; }
	function basepath(){ return JPATH_SITE; }
	function templatepath(){ return $this->basepath().DS."templates".DS.$this->template; }
	
	function getLayout () {
		global $Itemid, $option;
		
		if (($mobile = $this->mobile_device_detect_layout())) {
			// if agent is Iphone
			if( $mobile == 'iphone' ) {
				$iphone = $this->_tpl->params->get ( 'iphone_layout', $mobile );
				if ( $iphone != -1 && $this->layout_exists ($iphone) ) { 
					return $iphone;
				}
			} 
			// Other Handheld device
			$handheld = $this->_tpl->params->get ( 'other_handheld_layout', 'handheld' );
			if ( $handheld !=- 1 && $this->layout_exists ($handheld)) {
				return $handheld;
			}
			// auto dectect and choose layout with this device
			if (($mobile = $this->mobile_device_detect())) {
				if ($this->layout_exists ($mobile)) return $mobile;
				if ($this->layout_exists ('handheld')) return 'handheld';
			}
		}
		
		$page_layouts = $this->_tpl->params->get ('page_layouts');		
		$page_layouts = str_replace ("<br />", "\n", $page_layouts);		
		$playouts = new JParameter ($page_layouts);
		$layout = $playouts->get($Itemid);
		
		if ($this->layout_exists ($layout)) return $layout;
		$layout = $playouts->get($option);
		if ($this->layout_exists ($layout)) return $layout;
		$layout = $this->getParam ('main_layout', 'default');
		if ($this->layout_exists ($layout)) return $layout;
		if ($this->layout_exists ('default')) return 'default';

		return null;
	}

	function getMenuType () {
		global $Itemid, $option;
		if ($this->mobile_device_detect_layout()) {
			$mobile = $this->getLayout ();
			if (is_file(dirname(__FILE__).DS.'menu'.DS."$mobile.class.php")) $menutype = $mobile;
			else $menutype = 'handheld';
			return $menutype;
		}

		$page_menus = $this->_tpl->params->get ('page_menus');
		$page_menus = str_replace ("<br />", "\n", $page_menus);
		$pmenus = new JParameter ($page_menus);		

		$menutype = $pmenus->get($Itemid);
		if (is_file(dirname(__FILE__).DS.'menu'.DS."$menutype.class.php")) return $menutype;
		$menutype = $pmenus->get($option);
		if (is_file(dirname(__FILE__).DS.'menu'.DS."$menutype.class.php")) return $menutype;
		$menutype = $this->getParam(GK_TOOL_MENU, 'css');
		if (is_file(dirname(__FILE__).DS.'menu'.DS."$menutype.class.php")) return $menutype;
		return 'css';
	}
	
	function getTools () {
		global $Itemid, $option;

		$tools_menus = $this->_tpl->params->get ('tools_button');
		$tools_menus = str_replace ("<br />", "\n", $tools_menus);
		$tmenus = new JParameter ($tools_menus);		

		$tools_enabled = $tmenus->get($Itemid);
		if($tools_enabled == 'disabled') return false;
		$tools_enabled = $tmenus->get($option);
		if($tools_enabled == 'disabled') return false;
		
        return false;
	}

	function mobile_device_detect () {
		require_once ('mobile_device_detect.php');
		//bypass special browser:
		$special = array('jigs', 'w3c ', 'w3c-', 'w3c_');		
		if (in_array(strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4)), $special)) return false;
		return mobile_device_detect('iphone','android','opera','blackberry','palm','windows');
	}

	function mobile_device_detect_layout () {
		$ui = $this->getParam('ui');
		return $ui == 'desktop' ? false : (($ui=='mobile' && !$this->mobile_device_detect()) ? 'iphone' : $this->mobile_device_detect());
	}
	
	function layout_exists ($layout) {
		$layoutpath = $this->templatepath().DS.'layouts';
		if(is_file ($layoutpath.DS.$layout.'.php')) return $layoutpath.DS.$layout.'.php';
		return false;
	}

	function loadMenu ($params = null, $menutype = 'css') {
		static $gkmenu;
		if (!isset($gkmenu)) {
			$file = dirname(__FILE__).DS.'menu'.DS."$menutype.class.php";
			if (!is_file ($file)) return null;
			require_once ($file);
			$menuclass = "GKMenu{$menutype}";
			$gkmenu = new $menuclass ($params);
			//assign template object
			$gkmenu->_tmpl = $this;
			//load menu
			$gkmenu->loadMenu();
			//check css/js file
			$file = $this->templatepath().DS.'css'.DS.'menu'.DS."$menutype.css";
			if (is_file ($file)) $gkmenu->_css = $this->templateurl()."/css/menu/$menutype.css";
			$file = $this->templatepath().DS.'js'.DS.'menu'.DS."$menutype.js";
			if (is_file ($file)) $gkmenu->_js = $this->templateurl()."/js/menu/$menutype.js";
		}
		return $gkmenu;
	}

	function hasSubmenu () {
		$gkmenu = $this->loadMenu();
		if ($gkmenu && $gkmenu->hasSubMenu (1) && $gkmenu->showSeparatedSub ) return true;
		return false;
	}
	
	function getSectionId ($catid) {
		$db 	=& JFactory::getDBO();
		$query = "SELECT section FROM #__categories WHERE id=$catid;";
		$db->setQuery($query);
		return $db->loadResult();
	}	

	function getLastUpdate(){
		$db	 = &JFactory::getDBO();
		$query = 'SELECT created FROM #__content a ORDER BY created DESC LIMIT 1';
		$db->setQuery($query);
		$data = $db->loadObject();
		
		if( $data->created ){  //return gmdate( 'h:i:s A', strtotime($data->created) ) .' GMT ';
			 $date =& JFactory::getDate(strtotime($data->created));
			 $user =& JFactory::getUser();
   			 $tz = $user->getParam('timezone');
   			 $sec =$date->toUNIX();   //set the date time to second
   			 return gmdate("h:i:s A", $sec+$tz).' GMT';
		}
		return ;
	}

	function countModules ($modules) {
		if ($this->isContentEdit()) return 0;	$_tpl = $this->_tpl;
		return $modules?$_tpl->countModules ($modules):0;
	}

	function definePosition ($positions) {
		$this->_positions = $positions;
		//parse layout
		$this->_colwidth = array();
		//Left
		$l = 0;
		$left1 = $this->getPositionName ('left1');
		$left2 = $this->getPositionName ('left2');
		$mt = $this->getPositionName ('left-mass-top');
		$mb = $this->getPositionName ('left-mass-bottom');
		
		if ($this->countModules ("$mt") || $this->countModules ("$mb") || $this->countModules ("$left1") || $this->countModules ("$left2") ){
			$l = $this->getColumnBasedWidth ('left');
		}
		//right
		$r = 0;
		$right1 = $this->getPositionName ('right1');
		$right2 = $this->getPositionName ('right2');
		$mt = $this->getPositionName ('right-mass-top');
		$mb = $this->getPositionName ('right-mass-bottom');

		if ($this->countModules ("$mt") || $this->countModules ("$mb") || $this->countModules ("$right1") || $this->countModules ("$right2") ){
			$r = $this->getColumnBasedWidth ('right');
		}
		
		//inset
		$inset1 = $this->getPositionName ('inset1');
		$inset2 = $this->getPositionName ('inset2');		
		$i1=$i2=0;

		if ($this->countModules("$inset1")) $i1 = $this->getColumnBasedWidth ('inset1');
		if ($this->countModules("$inset2")) $i2 = $this->getColumnBasedWidth ('inset2');
		//width
		$this->_colwidth ['r'] = $r;
		$this->_colwidth ['mw'] = 100 - $r;
		$m = 100 - $l - $r;
		$this->_colwidth ['l'] = ($l + $m)?round($l * 100 / ($l + $m)):0;
		$this->_colwidth ['m'] = 100 - $this->_colwidth ['l'];
		$c = $m - $i1 - $i2;
		$this->_colwidth ['i2'] = round($i2 * 100 / $m);
		$this->_colwidth ['cw'] = 100 - $this->_colwidth ['i2'];
		$this->_colwidth ['i1'] = ($c+$i1)?round($i1 * 100 / ($c+$i1)):0;
		$this->_colwidth ['c'] = 100 - $this->_colwidth ['i1'];
	}

	function customwidth ($name, $width) {
		if (!isset ($this->_customwidth)) $this->_customwidth = array();
		$this->_customwidth [$name] = $width;
	}

	function getColumnBasedWidth ($name) {
		if ($this->isContentEdit()) return 0;
		return (isset ($this->_customwidth) && isset ($this->_customwidth[$name]) && $this->_customwidth[$name]) ? $this->_customwidth[$name]:$this->_basewidth;
	}

	function getPositionName ($name) {
		if (isset ($this->_positions[$name])) return trim($this->_positions[$name]);
		return '';
	}	

	function hasPosition ($name) {
		return $this->countModules ($this->getPositionName ($name));
	}	

	function getColumnWidth ($name) {
		if (isset($this->_colwidth [$name])) return ($this->_colwidth [$name]/* - ($this->isIE() ? 0.1 : 0)*/);
		return null;
	}

    /**
     *
     * Function for CSS/JS compression 
     *
     */

    function useCache($cache_css, $overwrite = false) {
		$document =& JFactory::getDocument();
		
		$scripts = array();
		$css_urls = array();
		
		if($cache_css) {
    		foreach ($document->_styleSheets as $strSrc => $strAttr ) {		
    			if(!preg_match('/\?.{1,}$/', $strSrc)) {
                    $srcurl = $this->cleanUrl($strSrc);
        			if (!$srcurl) continue;
        			//remove this css and add later 
        			unset ($document->_styleSheets [$strSrc]);
        			$path = str_replace ('/', DS, $srcurl);
        			$css_urls[] = array (JPATH_SITE.DS.$path, JURI::base(true).'/'.$srcurl);
                }
            }
		}
		
		if($cache_css) {
            $url = $this->optimizecss($css_urls, $overwrite);
    		if ($url) $document->addStylesheet($url);
    		else{
    		  foreach ($css_urls as $urls) $document->addStylesheet($url[1]); //re-add stylesheet to head
    		}
		}
	} 
	
	function cleanUrl ($strSrc) {
		if (preg_match ('/^https?\:/', $strSrc)) {
			if (!preg_match ('#^'.preg_quote(JURI::base()).'#', $strSrc)) return false; //external css
			$strSrc = str_replace (JURI::base(), '', $strSrc);
		} else if (preg_match ('/^\//', $strSrc)) {
			if (!preg_match ('#^'.preg_quote(JURI::base(true)).'#', $strSrc)) return false; //same server, but outsite website
			$strSrc = preg_replace ('#^'.preg_quote(JURI::base(true)).'#', '', $strSrc);
		}

        $strSrc = str_replace ('//', '/', $strSrc);
		$strSrc = preg_replace ('/^\//', '', $strSrc);
		return $strSrc;
	}
     
   	function optimizecss ($css_urls, $overwrite = false) {
		$content = '';
		$files = '';
		jimport('joomla.filesystem.file');
		foreach ($css_urls as $url) {
            $files .= $url[1];
            //join css files into one file
            $content .= "/* FILE: {$url[1]} */\n".$this->compresscss(@JFile::read ($url[0]), $url[1])."\n\n";
		}

		$file = md5 ($files).'.css';
		$url = $this->store_file ($content, $file, $overwrite);
		return $url;
	}	
	
	function compresscss($data, $url) {
		global $current_css_url;
		//if ($url[0] == '/') $url = JURI::root(false, '').substr($url, 1);
		$current_css_url = $url;
		/* remove comments */
	    $data = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $data);
		/* remove tabs, spaces, new lines, etc. */        
	    $data = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), ' ', $data);
		/* remove unnecessary spaces */
	    $data = preg_replace ('/[ ]+([{};,:])/', '\1', $data);
	    $data = preg_replace ('/([{};,:])[ ]+/', '\1', $data);
	    /* remove empty class */
	    $data = preg_replace ('/(\}([^\}]*\{\})+)/', '}', $data);
	    /* replace url*/
	    $data = preg_replace_callback ('/url\(([^\)]*)\)/', array('GKTemplateHelper1', 'replaceurl'), $data);

        
        return $data;
	}
    
    function replaceurl ($matches) {
		$url = str_replace (array('"', '\''), '', $matches[1]);
		global $current_css_url;
		$url = GKTemplateHelper1::converturl ($url, $current_css_url);
		return "url('$url')";
	} 
	
	function converturl ($url, $cssurl) {
		$base = dirname ($cssurl);
		if (preg_match ('/^(\/|http)/', $url)) return $url; /*absolute or root*/
		while (preg_match ('/^\.\.\//', $url)) {
			$base = dirname ($base);
			$url = substr ($url, 3);
		}
		
		$url = $base.'/'.$url;
		return $url;
	}
	
	function store_file ($data, $filename, $overwrite = false) {
		$path = JPATH_SITE.DS.'cache'.DS.'gk';
		if (!is_dir ($path)) @JFolder::create ($path);
		$path = $path.DS.$filename;
		$url = JURI::base(true).'/cache/gk/'.$filename;
		if (is_file ($path) && !$overwrite) return $url;
		@file_put_contents($path, $data);
		return is_file ($path)?$url:false;		
	}

	/**
	 *
	 * Functions from GK Framework
	 * 
	 */
	 
	function checkComponent() {
		$menu = & JSite::getMenu();
		$result = !(($this->_tpl->params->get("frontpage") == 1) ? false : ($menu->getActive() == $menu->getDefault()));	
		return (!isset($_POST['option'])) ? $result : true;
	}

	function checkMainbody() { return (($this->_tpl->params->get('mainbody_pos') != 0) && $this->countModules("mainbody") > 0); }

	function fontFamily($n, $g = 'none', $squirell_num = ''){
		if($this->_tpl->params->get('font_method') == 3) {
			if($this->_tpl->params->get('squirell_fontname' . $squirell_num) != '') {
				return $this->_tpl->params->get('squirell_fontname' . $squirell_num).', Arial, sans-serif';
			} else {
				return $this->defaultFonts($n);
			}
		} else {
			if($g != 'none' && $g != '' && $this->_tpl->params->get('font_method') == 2){
				$gfont = $g;
				
				if(stripos($gfont, ':') !== FALSE) {
				    $gfont_cut = stripos($gfont, ':');
				    $gfont = substr($gfont, 0, $gfont_cut);
				}
				
				return '\''.str_replace('+', ' ', $gfont).'\', Arial, sans-serif';
			} else {	
				return $this->defaultFonts($n);
			}
		}
	}
	
	function defaultFonts($n) {
		switch($n) {
			case 1: return 'Verdana, Geneva, sans-serif';break;
			case 2: return 'Georgia, "Times New Roman", Times, serif';break;
			case 3: return 'Arial, Helvetica, sans-serif';break;
			case 4: return 'Impact, Arial, Helvetica, sans-serif';break;
			case 5: return 'Tahoma, Geneva, sans-serif';break;
			case 6: return '"Trebuchet MS", Arial, Helvetica, sans-serif';break;
			case 7: return '"Arial Black", Gadget, sans-serif';break;
			case 8: return 'Times, "Times New Roman", serif';break;
			case 9: return '"Palatino Linotype", "Book Antiqua", Palatino, serif';break;
			case 10: return '"Lucida Sans Unicode", "Lucida Grande", sans-serif';break;
			case 11: return '"MS Serif", "New York", serif';break;
			case 12: return '"Comic Sans MS", cursive';break;
			case 13: return '"Courier New", Courier, monospace';break;
			case 14: return '"Lucida Console", Monaco, monospace';break;
			default: return 'Arial, Helvetica, sans-serif';break;
		}
	}
	
	function lessCSS($file){
		if($this->getParam('less_php',0)){ // check if LESS.js is enabled
			jimport('joomla.filesystem.file');
			
			if(JFile::exists($this->templatepath().DS.'less'.DS.str_replace('/',DS, $file).'.less')){ // check if file duplicate written in LESS exists
				
				require_once('lessc.inc.php');
				
    			lessc::ccompile($this->templatepath().DS.'less'.DS.str_replace('/',DS, $file).'.less', $this->templatepath().DS.'less'.DS.str_replace('/',DS, $file).'.css');

				echo '<link rel="stylesheet" href="'.$this->templateurl().'/less/'.$file.'.css" type="text/css" />'."\n";
			}else{
				echo '<link rel="stylesheet" href="'.$this->templateurl().'/css/'.$file.'.css" type="text/css" />'."\n";	
			}
		}else{
			echo '<link rel="stylesheet" href="'.$this->templateurl().'/css/'.$file.'.css" type="text/css" />'."\n";
		}
	}
}

make_object_extendable ('GKTemplateHelper');