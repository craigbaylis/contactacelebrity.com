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

var gksdl_delay = 1000
var gksdl_current = null
var gksdl_recover = null
var gksdl_timeoutid = null
var gksdl_timetorecover = null
var gksdl_timeoutid2 = 0
function gksdl_initJAScriptDLMenu() {
	gksdl_current = gksdl_activemenu[0]
	mainlis = document.getElementById("gksdl-mainnav").getElementsByTagName("li")
	for (i=0; i<mainlis.length; ++i) {
		x = mainlis[i]
		gksdl_menuindex = x.id.substr(13)

		x._id = parseInt(gksdl_menuindex)
		x.onmouseover = gksdl_mouseOver
		
		x.onmouseout = gksdl_mouseOut

		subx = document.getElementById("gksdl-subnav"+gksdl_menuindex)
		if (subx)
		{
			if (gksdl_activemenu[0] && gksdl_menuindex == gksdl_activemenu[0]) {
				subx.style.display = "block"
				subx.className = 'active';
			}else{
				subx.style.display = "none"
			}
			subx._id = gksdl_menuindex


			subx.onmouseover = gksdl_mouseOver

			subx.onmouseout = gksdl_mouseOut
		}
		
		document.getElementById("gksdl-subnav").style.display = "block";

	}

	//Set active item
	if (gksdl_activemenu[0])
	{
		actitem = document.getElementById("gksdl-mainnav"+gksdl_activemenu[0].toString())
		if (actitem)
		{
			if (actitem.className) actitem.className += " active"; else actitem.className = "active";
		}	
		gksdl_recover = gksdl_activemenu[0]
	}
	if (gksdl_activemenu[1]) {
		actitem = document.getElementById("gksdl-subnavitem"+gksdl_activemenu[1].toString())
		if (actitem)
		{
			if (actitem.className) actitem.className += " active"; else actitem.className = "active";
		}	
	}

	//Hover on sub item
	var subnav = document.getElementById ('gksdl-subnav');
	if (subnav) {
		var sublis = subnav.getElementsByTagName("li");
		for (i=0; i<sublis.length; ++i) {
			objs = sublis[i];
			var child = objs.getElementsByTagName ('ul');
			if (child && child.length) {
				objs.className += " hasChild";
				objs.onmouseover=function() {
					this.className+=" hover";
				}
				objs.onmouseout=function() {
					//this.className=this.className.replace(new RegExp("hover\\b"), "");
					this.timer = setTimeout(gksdl_sub_mouseOut.bind(this), 100);
				}
			}
		}
	}
}

function gksdl_sub_mouseOut () {
	this.className=this.className.replace(new RegExp("hover\\b"), "");
}

function gksdl_mouseOver () {
	gksdl_hide()
	gksdl_current = this._id
	gksdl_show()
	gksdl_clearTimeOut(gksdl_timeoutid)
}
function gksdl_mouseOut () {
	if (this._id != gksdl_current) return

	gksdl_timeoutid = setTimeout('gksdl_restore()', gksdl_delay)
}

function gksdl_restore () {
	gksdl_clearTimeOut(gksdl_timeoutid)
	gksdl_hide()
	if (gksdl_recover)
	{
		gksdl_current = gksdl_recover
		gksdl_show()
	}
}

function gksdl_setHover () {
	if (gksdl_current == gksdl_recover) return
	mainx = document.getElementById("gksdl-mainnav"+gksdl_current.toString())
	if (mainx)
		mainx.className += ' hover';
}

function gksdl_clearHover () {
	if (gksdl_current == gksdl_recover) return
	mainx = document.getElementById("gksdl-mainnav"+gksdl_current.toString())
	if (mainx)
		mainx.className = mainx.className.replace(/[ ]?hover/, '');
}

function gksdl_hide () {
	subx = document.getElementById("gksdl-subnav"+gksdl_current.toString())
	if (subx)
		subx.style.display = "none"
	gksdl_clearHover ()
}

function gksdl_show () {
	subx = document.getElementById("gksdl-subnav"+gksdl_current.toString())
	if (subx)
		subx.style.display = "block"
	gksdl_setHover ()
}

function gksdl_clearTimeOut(timeoutid){
	clearTimeout(timeoutid)
	timeoutid = 0
}

gkAddEvent(window, 'load', gksdl_initJAScriptDLMenu)