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

window.addEvent ('load', function() {
	if (!$('gksdl-subnav') || !$('gksdl-subnav').getElement('ul')) return;
	var sfEls = $('gksdl-subnav').getElement('ul').getChildren();
	sfEls.each (function(li){
		li.addEvent('mouseenter', function(e) {
			clearTimeout(this.timer);
			if(this.className.indexOf(" hover") == -1)
				this.className+=" hover";
		});
		li.addEvent('mouseleave', function(e) {
			//this.className=this.className.replace(new RegExp(" hover\\b"), "");
			this.timer = setTimeout(gksdl_sub_mouseOut.bind(this), 100);
		});
	});
});

function gksdl_sub_mouseOut () {
	this.className=this.className.replace(new RegExp(" hover\\b"), "");
}
