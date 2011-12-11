/*
#------------------------------------------------------------------------
# Musicity - #2 2011 template (for Joomla 1.5)
#
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

//Call noconflict if detect jquery
//Apply jquery.noConflict if jquery is enabled
if ($defined(window.jQuery) && $type(jQuery.noConflict)=='function') {
	jQuery.noConflict();
	jQuery.noConflict();
}

function switchFontSize (ckname,val){
	var bd = $E('body');
	switch (val) {
		case 'inc':
			if (CurrentFontSize+1 < 7) {
				bd.removeClass('fs'+CurrentFontSize);
				CurrentFontSize++;
				bd.addClass('fs'+CurrentFontSize);
			}		
		break;
		case 'dec':
			if (CurrentFontSize-1 > 0) {
				bd.removeClass('fs'+CurrentFontSize);
				CurrentFontSize--;
				bd.addClass('fs'+CurrentFontSize);
			}		
		break;
		default:
			bd.removeClass('fs'+CurrentFontSize);
			CurrentFontSize = val;
			bd.addClass('fs'+CurrentFontSize);		
	}
	Cookie.set(ckname, CurrentFontSize,{duration:365});
}

function switchTool (ckname, val) {
	createCookie(ckname, val, 365);
	window.location.reload();
}

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

//addEvent - attach a function to an event
function gkAddEvent(obj, evType, fn){ 
 if (obj.addEventListener){ 
   obj.addEventListener(evType, fn, false); 
   return true; 
 } else if (obj.attachEvent){ 
   var r = obj.attachEvent("on"+evType, fn); 
   return r; 
 } else { 
   return false; 
 } 
}

window.addEvent('load', function() {
    new SmoothScroll(); 
    //
    if($('stylearea')){
    	$$('.style_switcher').each(function(element,index){
    		element.addEvent('click',function(event){
                var event = new Event(event);
    			event.preventDefault();
    			changeStyle(index+1);
    		});
    	});
    }
    //HACK added address_login option
    if($('btn_login') || $('btn_register') || $$('.address_login')) {
    	var popup_overlay = $('gk-popup-overlay');
    	popup_overlay.setStyle('display', 'block');
    	var popup_overlay_fx = new Fx.Style(popup_overlay, 'opacity', {duration:200}).set(0);
    	var opened_popup = null;
    	var popup_login = null;
    	var popup_login_h = null;
    	var popup_login_fx = null;
    	var popup_register = null;
    	var popup_register_h = null;
    	var popup_register_fx = null;
    	
    	if($('btn_login')) {
    		popup_login = $('gk-popup-login');
    		popup_login.setStyle('display', 'block');
    		popup_login_h = popup_login.getElement('.gk-popup-wrap').getSize().size.y + 8;
    		popup_login_fx = new Fx.Styles(popup_login, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0, 'margin-top':0}); 
    		$('btn_login').addEvent('click', function(e) {
    			new Event(e).stop();
    			popup_overlay_fx.start(0.85);
    			popup_login_fx.start({'opacity':1, 'margin-top': -popup_login_h / 2, 'height': popup_login_h});
    			opened_popup = 'login';
    		});
    	}
    	
    	if($('btn_register')) {
    		popup_register = $('gk-popup-register');
    		popup_register.setStyle('display', 'block');
    		popup_register_h = popup_register.getElement('.gk-popup-wrap').getSize().size.y + 8;
    		popup_register_fx = new Fx.Styles(popup_register, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0, 'margin-top':0}); 
    		$('btn_register').addEvent('click', function(e) {
    			new Event(e).stop();
    			popup_overlay_fx.start(0.85);
    			popup_register_fx.start({'opacity':1, 'margin-top': -popup_register_h / 2, 'height': popup_register_h});
    			opened_popup = 'register';
    		});
    	}
        //HACK to display popup for order choices
        if($('order_now')) {
            popup_order = $('gk-popup-order');
            popup_order.setStyle('display', 'block');
            popup_order_h = popup_order.getElement('.gk-popup-wrap').getSize().size.y + 8;
            popup_order_fx = new Fx.Styles(popup_order, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0, 'margin-top':0}); 
            function openChoices(e) {
                new Event(e).stop();
                popup_overlay_fx.start(0.85);
                popup_order_fx.start({'opacity':1, 'margin-top': -popup_order_h / 2, 'height': popup_order_h});
                opened_popup = 'order';
            }
            $('pay_btn_top').addEvent('click', openChoices);
            $('pay_btn_bottom').addEvent('click', openChoices);
        }
        
        //HACK to display popup when user not logged in and trying to view celebrity address details
        if($$('.address_login')) {
            popup_login = $('gk-popup-login');
            popup_login.setStyle('display', 'block');
            popup_login_h = popup_login.getElement('.gk-popup-wrap').getSize().size.y + 8;
            popup_login_fx = new Fx.Styles(popup_login, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0, 'margin-top':0}); 
            $$('.address_login').addEvent('click', function(e) {
                new Event(e).stop();
                popup_overlay_fx.start(0.85);
                popup_login_fx.start({'opacity':1, 'margin-top': -popup_login_h / 2, 'height': popup_login_h});
                opened_popup = 'login';
            });
        }
        
    	popup_overlay.addEvent('click', function() {
    		if(opened_popup == 'login')	{
    			popup_overlay_fx.start(0);
    			popup_login_fx.start({
    				'opacity' : 0,
    				'height' : 0,
    				'margin-top': 0
    			});
    		}
    		
    		if(opened_popup == 'register') {
    			popup_overlay_fx.start(0);
    			popup_register_fx.start({
    				'opacity' : 0,
    				'height' : 0,
    				'margin-top': 0
    			});
    		}
            //HACK to display popup for order choices
            if(opened_popup == 'order') {
                popup_overlay_fx.start(0);
                popup_order_fx.start({
                    'opacity' : 0,
                    'height' : 0,
                    'margin-top': 0
                });
            }	
    	});
    }
});
// Function to change styles
function changeStyle(style){
	var file = tmplurl+'/css/style'+style+'.css';
	new Asset.css(file);
	new Cookie.set('gk48_style',style,{duration: 200,path: "/"});
}
// JCaptionCheck
function JCaptionCheck(){ return (typeof(JCaption) == "undefined")?  false: true; }

if(!JCaptionCheck()) {
	var JCaption = new Class({
		initialize: function(selector)
		{
			this.selector = selector;
			var images = $$(selector);
			images.each(function(image){ this.createCaption(image); }, this);
		},

		createCaption: function(element)
		{
			var caption   = document.createTextNode(element.title);
			var container = document.createElement("div");
			var text      = document.createElement("p");
			var width     = element.getAttribute("width");
			var align     = element.getAttribute("align");
			var docMode = document.documentMode;

			//Windows fix
			if (!align)
				align = element.getStyle("float");  // Rest of the world fix
			if (!align) // IE DOM Fix
				align = element.style.styleFloat;

			text.appendChild(caption);
			text.className = this.selector.replace('.', '_');

			if (align=="none") {
				if (element.title != "") {
					element.parentNode.replaceChild(text, element);
					text.parentNode.insertBefore(element, text);
				}
			} else {
				element.parentNode.insertBefore(container, element);
				container.appendChild(element);
				if ( element.title != "" ) {
					container.appendChild(text);
				}
				container.className   = this.selector.replace('.', '_');
				container.className   = container.className + " " + align;
				container.setAttribute("style","float:"+align);

				//IE8 fix
				if (!docMode|| docMode < 8) {
					container.style.width = width + "px";
				}
			}

		}
	});

	document.caption = null;
	window.addEvent('load', function() {
		var caption = new JCaption('img.caption')
		document.caption = caption
	});
}
