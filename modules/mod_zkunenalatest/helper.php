<?php 
/**
 * @version		0.53
 * @package		zKunenaLatest
 * @author		Aaron Gilbert {@link http://www.nzambi.braineater.ca}
 * @author		Created on 22-Dec-2010
 * @copyright	Copyright (C) 2009 - 2010 Aaron Gilbert. All rights reserved.
 * @license		GNU/GPL, see http://www.gnu.org/licenses/gpl-2.0.html
 *
 *  Portions of this file are modeled after the Official Kuenna Latest Posts module
 *  from the Kuena Team - http://www.kunena.com
 */

defined('_JEXEC') or die('Restricted access');


class modZKunenaLatestHelper {
	
/* 	function trimStringLong($str, $limit, $break=".", $pad="...") {
		if(strlen($str) <= $limit) return $str;
		if(false !== ($breakpoint = strpos($str, $break, $limit))) { 
			if($breakpoint < strlen($str) - 1) { 
				$str = substr($str, 0, $breakpoint) . $pad; 
			} 
		} 
		return $str; 
	}
	function trimString($string, $limit, $break=" ", $pad="...") { 
		if(strlen($string) <= $limit) return $string; 
		$string = substr($string, 0, $limit); 
		if(false !== ($breakpoint = strrpos($string, $break))) { 
			$string = substr($string, 0, $breakpoint); 
		} 
		return $string . $pad; 
	}
 */
 
 	//
	// UTF-8 Support added by oc666 (oc666.net) with thanks...
	//
	function trimStringLong($str, $limit, $break=".", $pad="...") {
		if(mb_strlen($str, "UTF-8") <= $limit) return $str;
		if(false !== ($breakpoint = mb_strpos($str, $break, $limit, 0, "UTF-8"))) { 
			if($breakpoint < mb_strlen($str, "UTF-8") - 1) { 
				$str = mb_substr($str, 0, $breakpoint, "UTF-8") . $pad; 
			} 
		} 
		return $str; 
	}
	function trimString($string, $limit, $break=" ", $pad="...") { 
		if(mb_strlen($string,"UTF-8") <= $limit) return $string; 
		$string = mb_substr($string, 0, $limit, "UTF-8"); 
		if(false !== ($breakpoint = mb_strrpos($string, $break, 0, "UTF-8"))) { 
			$string = mb_substr($string, 0, $breakpoint, "UTF-8"); 
		} 
		return $string . $pad; 
	}

	
	function getItems($params) {
		JRequest::setVar ( 'sel', 10000 );
		KunenaFactory::getSession ( true );
		$model = new CKunenaLatestX ( '', 0 );
		$model->threads_per_page = $params->get ( 'numberPosts', 6 );
		$model->latestcategory = $params->get ( 'categoryLimit', 0  );
		$model->latestcategory_in = $params->get ( 'categoryFilter', 1 );

		$result = array ();
		$threadmode = true;

		switch ( $params->get( 'modelType' ) ) {
			case 'latestmessages' :
				$model->getLatestPosts();
				$threadmode = false;
				break;
			case 'noreplies' :
				$model->getNoReplies();
				break;
			case 'subscriptions' :
				$model->getSubscriptions();
				break;
			case 'favorites' :
				$model->getFavorites();
				break;
			case 'owntopics' :
				$model->getOwnTopics();
				break;
			case 'deletedposts' :
				$model->getDeletedPosts();
				$threadmode = false;
				break;
			case 'saidthankyouposts' :
				$model->getSaidThankYouPosts();
				$threadmode = false;
				break;
			case 'gotthankyouposts' :
				$model->getGotThankYouPosts();
				$threadmode = false;
				break;
			case 'userposts' :
				$model->getUserPosts();
				$threadmode = false;
				break;
			case 'latesttopics' :
			default :
				$model->getLatest ();
		}

		if ($threadmode == true) {
			$result = $model->threads;

			foreach ($result as $message) {
				$message->id = $model->lastreply[$message->thread]->id;
				$message->message = $model->lastreply[$message->thread]->message;
				$message->userid = $model->lastreply[$message->thread]->userid;
				$message->name = $model->lastreply[$message->thread]->name;
				$message->lasttime = $model->lastreply[$message->thread]->lasttime;
			}

		} else {
			$result = $model->customreply;
		}
		return $result;
	}
	function getNew($item, $params) {
		return '('.$item->unread. ' '. JText::_('MOD_ZKUENALATEST_NEW').')';
	}
	function getTopic($item, $params) {
		$subject = JText::_('MOD_ZKUENALATEST_TOPIC');
		$title = JText::_('MOD_ZKUENALATEST_TOPIC_TITLE');
		return CKunenaLink::GetThreadLink ( 'view', $item->catid, $item->thread, $subject , $title , 'follow' );
	}
	function getSubject($item, $params) {
		$subject =  JString::substr(htmlspecialchars ($item->subject), '0', $params->get ('subjectLength', 50) );
		$title = JText::_('MOD_ZKUENALATEST_POSTED_IN') .' - '. $item->catname;
		
		return CKunenaLink::GetThreadLink ( 'view', $item->catid, $item->id, $subject , $title , 'follow' );
	}
	function getMessage($item, $params) {
		
		$user      	= &JFactory::getUser();
		// first strip BBCode
		// remove Quoted Text to save room.
		$item->message = preg_replace('#\[quote(.*?)\[/quote\]#si', '', $item->message);
		// remove Spoilers,  we don't want to spoil anything...
		$item->message = preg_replace('#\[spoiler(.*?)\[/spoiler\]#si', JText::_('MOD_ZKUNENALATEST_BBC_SPOILER'), $item->message);
		// remove code block...
		$item->message = preg_replace('#\[code(.*?)\[/code\]#si', JText::_('MOD_ZKUNENALATEST_BBC_CODE'), $item->message);
		// remove Ebay...
		$item->message = preg_replace('#\[ebay(.*?)\[/ebay\]#si', JText::_('MOD_ZKUNENALATEST_BBC_EBAY'), $item->message);																		 						 		// remove Maps,  we don't want to spoil anything...
		$item->message = preg_replace('#\[map(.*?)\[/map\]#si', JText::_('MOD_ZKUNENALATEST_BBC_MAP'), $item->message);
		// remove Video...
		$item->message = preg_replace('#\[video(.*?)\[/video\]#si', JText::_('MOD_ZKUNENALATEST_BBC_VIDEO'), $item->message);
		// remove Image links...
		$item->message = preg_replace('#\[img(.*?)\[/img\]#si', JText::_('MOD_ZKUNENALATEST_BBC_IMAGE'), $item->message);
		//Don't show hiden stuff to guests... that would be rude...
		if ($user->guest)
		{
			$item->message = preg_replace('#\[hide(.*?)\[/hide\]#si', JText::_('MOD_ZKUNENALATEST_BBC_HIDDEN') , $item->message);
		}
		// Strip the rest of the bbCodes	
		$item->message = preg_replace('|[[\/\!]*?[^\[\]]*?]|si', '', $item->message);
		
		return modZKunenaLatestHelper::trimString($item->message, $params->get ( 'messageTrim', 150 ), " ");
		//return  JString::substr( htmlspecialchars ( KunenaParser::stripBBCode($item->message) ), '0', $params->get ( 'messageTrim', 150 ) );
	}
	function getCredit() {
		return JText::_('MOD_ZKUENALATEST_POWERED_BY')." <a href=\"http://nzambi.braineater.ca\" target=\"_blank\"><em>nZambi!</em></a>";
	}
	function getAvatar($userid, $params) {
		$kunena_user = KunenaFactory::getUser ( ( int ) $userid );
		$username = $kunena_user->getName(); // Takes care of realname vs username setting
		$avatarlink = $kunena_user->getAvatarLink ( '', $params->get('avatarsize', 40 ), $params->get('avatarsize', 40 ));
		
		return CKunenaLink::GetProfileLink ( $userid, $avatarlink, $username );
	}
	function getTopicIcon($item, $params) {
		$ktemplate = KunenaFactory::getTemplate();
		return $ktemplate->getTopicIcon($item);
	}
	function getPostDate($item, $params) {
		return CKunenaTimeformat::showDate($item->lasttime, $params->get('timeFormat', 'datetime_today'));
	}
	function getExtraCss($params, $moduleId ) {
		
		$setWidth 	= (int)$params->get('modulewidth',200);
		$bottom 	= $setWidth - 8 ;
		$boxLarge	= ((int)$params->get('boxLarge',160)) - 3  ;
		
		$CSS 	= '#zKlatest { width: '.$setWidth.'px; } '
				. '#Kboxwrap'.$moduleId .' { width: '.$setWidth.'px; } '
				. '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid { height: '.(int)$params->get('boxNormal',60).'px; ';
		$CSS   .= ( $params->get('borderClr') ? ' border: 1px solid '.$params->get('borderClr') : '' );
		$CSS   .= ' ;} ' 
				. '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .zKlatestAvatar_left { width: '.((int)$params->get('avatarsize',50)+8).'px; } '
				. '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .Kboxcaption { height: '.$boxLarge.'px; width: '.$bottom.'px; } '
				. '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .Kboxcaption .Kboxbottom { width: '.$bottom.'px; } ';
				
		$CSS   .= '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .topKboxcaption { '
				. 'background: ' 
				. $params->get('topSlideBkg', '#000000' ) . '; color: '.$params->get('topSlideClr', '' ).' }';
				
		$CSS   .= '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .Kboxcaption { '
				. 'background: ' 
				. $params->get('botSlideBkg', '#000000' ) . '; color: '.$params->get('botSlideClr', '' ).' }';
		
		$CSS   .= ( $params->get('contentBkg')  ? '#Kboxwrap'.$moduleId .' { background: '.$params->get('contentBkg'). '; }' : '' );
					
		if ($params->get('borderClr')) {
										
			$CSS   .= '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .topKboxcaption { '
					. 'border-bottom-width: 3px; '
					. 'border-bottom-style: double; '
					. 'border-bottom-color: '
					. $params->get('borderClr') . '; }';
		}
		if ($params->get('botNavBkg')) {
			$CSS   .= '#Kboxwrap'.$moduleId .' .Kboxgridwrap .Kboxgrid .Kboxcaption .Kboxbottom { '
						. 'background-color: '
						. $params->get('botNavBkg') . '; }';
		}
					
		return $CSS;
	} // function CSS
	
	function getScript($params, $module) {
	
	$version = new JVersion;
	$joomla = $version->getShortVersion();
	$fx = (substr($joomla,0,3) == '1.6' ? 'Morph' : 'Styles');

	$avSize 	= ((int)$params->get('avatarsize',50) > 40 ? (int)$params->get('avatarsize',50) : 40 );
	$edge 		= ((int)$params->get('boxLarge',160) - $avSize - 10 );
	if ($params->get('moo_trans1')) {
		$transition	= "fx.options.transition = Fx.Transitions.".$params->get('moo_trans1').($params->get('moo_trans2') ? ".".$params->get('moo_trans2') : "" ).";";

	} else {
		$transition	= '';
	}
	
	$js = "
	var szNormal = ".$params->get('boxNormal',60).", szSmall  = ".$params->get('boxSmall',40).", szFull   = ".$params->get('boxLarge',160).";
	var szNormal".$module->id." = ".$params->get('boxNormal',60).", szSmall".$module->id."  = ".$params->get('boxSmall',40).", szFull".$module->id."   = ".$params->get('boxLarge',160).";
	var mTrans".$module->id." = \"".$params->get('moo_trans1','Back') ."\" ;
	var mEase".$module->id." = \"".$params->get('moo_trans2','easeOut') ."\" ;
	var topEdge =\"".  $edge ."\";
	
	window.addEvent('domready', function() {
		
		var wrap = $('Kboxwrap".$module->id."');
		var gridz = $$('.captionfull".$module->id."');
		
		var fx = new Fx.Elements(gridz, {wait: false, duration: 700});
		".$transition."
		
		gridz.each(function(el, i){
			var boxcaption = el.getElement('.cover');
			var profilelink = el.getElement('.profilelink');
			
			var capin = new Fx.".$fx."(boxcaption, {duration:500, wait:false});
			
			
			el.addEvent('mouseenter', function(event){
					".(substr($joomla,0,3) == '1.6' ? 'fx.cancel();' : '')."
					".(substr($joomla,0,3) == '1.6' ? 'capin.cancel();' : '')."
					var o = {};
					o[i] = {height: [el.getStyle(\"height\").toInt(), szFull".$module->id."]}
					
					gridz.each(function(other, j) {
										
						if(i != j) {
							var h = other.getStyle(\"height\").toInt();
							if(h != szSmall".$module->id.") o[j] = {height: [h, szSmall".$module->id."]};
						}
					});
					
					fx.start(o);
					capin.start({
					'top' : '0px',
					'opacity' : 1
					});
			});
			
			el.addEvent('mouseleave', function(event){
					".(substr($joomla,0,3) == '1.6' ? 'capin.cancel();' : '')."
					capin.start({
					'top' : '80px',
					'opacity' : .2
					});			   
			});
		});
	
		wrap.addEvent(\"mouseleave\", function(event) {
			".(substr($joomla,0,3) == '1.6' ? 'fx.cancel();' : '')."								   
			var o = {};
			gridz.each(function(el, i) {
				o[i] = {height: [el.getStyle(\"height\").toInt(), szNormal".$module->id."]}
			});
			fx.start(o);
		})
	
	});
	";
		return $js;
	} // function script
	
}// class
?>