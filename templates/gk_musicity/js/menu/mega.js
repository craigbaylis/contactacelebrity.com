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

var gkMegaMenuMoo = new Class({
	options: {
			slide:	true, //enable slide
			duration: 300, //slide speed. lower for slower, bigger for faster
			transition: Fx.Transitions.Sine.easeOut,
			fading: false, //Enable fading
			action: 'mouseenter', //mouseenter or click
			hidestyle: 'fastwhenshow',
			//events
			onItemShow: null, //function (li) {}
			onItemHide: null, //function (li) {}
			onItemShowComplete: null, //function (li) {}
			onItemHideComplete: null, //function (li) {}
			onFirstShow: null, //First child show
			onLastHide: null, //All child hidden			
			onLoad: null //Load done
	},
	
    initialize: function(menu, options){
		this.setOptions(options);
		this.menu = menu;
		this.childopen = new Array();
		this.items = null;
		this.start();
		this.options.delayHide = 150;
	},
	
	start: function () {
		this.menu = $(this.menu);
		if (this.items) return; //started already
		this.items = this.menu.getElements ('li.mega');
		this.items.each (function(li) {
			//link item
			if ((a = li.getElement('a.mega')) && this.isChild (a, li)) li.a = a;
			else li.a = null;
			//parent
			li._parent = this.getParent (li);
			//child content
			if ((childcontent = li.getElement('.childcontent')) && this.isChild (childcontent, li)) {
				li.childcontent = childcontent;
				li.childcontent_inner = li.childcontent.getElement ('.childcontent-inner-wrap');
				var coor = li.getElement('.childcontent-inner').getCoordinates();
				li._w = coor.width;
				li._h = coor.height;
				li._ml = li.childcontent.getStyle('margin-left').toInt();
				li._mt = li.childcontent.getStyle('margin-top').toInt();
				li.level0 = li.getParent().hasClass('level0');
				//
				if (li._w) {
					li.childcontent.setStyles ({'width':li._w + 6});
					li.childcontent_inner.setStyles ({'width':li._w + 6});
				}
				//fix for overflow
				li.childcontent_inner1 = li.childcontent.getElement ('.childcontent-inner');
				li.childcontent_inner1.ol = false;
				//Fix for IE: correct render at the first show
				li.childcontent_inner1.setStyle ('min-height', li.childcontent_inner1.offsetHeight);
				if (li.childcontent_inner1.getStyle ('overflow') == 'auto' || li.childcontent_inner1.getStyle ('overflow') == 'scroll') {
					li.childcontent_inner1.ol = true;
				}		
			}
			else li.childcontent = null;
			
			if (li.childcontent && (this.options.slide || this.options.fading)) {
				//li.childcontent.setStyles ({'width': li._w});
				li.childcontent.setStyles ({'left':'auto'});
				if (li.childcontent.hasClass ('right')) li.childcontent.setStyle ('right', 0);
				if (this.options.slide) {
					li.childcontent.setStyles ({'left':'auto', 'overflow':'hidden'});
					if (li.level0) {
						li.childcontent_inner.setStyle ('margin-top', -li._h-20);
					} else {					
						li.childcontent_inner.setStyle ('margin-left', -li._w-20);
					}
				}
				if (this.options.fading) {
					li.childcontent_inner.setStyle ('opacity', 0);
				}
				//Init Fx.Styles for childcontent
				li.fx = new Fx.Styles(li.childcontent_inner, {duration: this.options.duration, transition: this.options.transition, onComplete: this.itemAnimDone.bind(this, li)});
				//effect
				li.eff_on = {};
				li.eff_off = {};
				if (this.options.slide) {
					if (li.level0) {
						li.eff_on ['margin-top'] = 0;
						li.eff_off ['margin-top'] = -li._h;
					} else {
						li.eff_on['margin-left'] = 0;
						li.eff_off['margin-left'] = -li._w;
					}
				}
				if (this.options.fading) {
					li.eff_on['opacity'] = 1;
					li.eff_off['opacity'] = 0;
				}
			}
				
			if (this.options.action=='click') {
				if (li.childcontent) {
					li.addEvent('click', function(e) {
						var event = new Event (e);
						if (li.hasClass ('group')) return;
						if (li.childcontent) {
							if (li.status == 'open') {
								if (this.cursorIn (li, event)) {
									this.itemHide (li);
								} else {
									this.itemHideOthers(li);
								}
							} else {
								this.itemShow (li);
							}
						} else {
							if (li.a) location.href = li.a.href;
						}
						if(!window.ie) event.stop();
					}.bind (this));
					//If action is click, click on windows will close all submenus
					this.windowClickFn = function (e) {		
						this.itemHideOthers(null);
					}.bind (this);
				}
				li.addEvent('mouseenter', function(e) {
					if (li.hasClass ('group')) return;
					this.itemOver (li);
					if(!window.ie) e.stop();
				}.bind (this));
				
				li.addEvent('mouseleave', function(e) {
					if (li.hasClass ('group')) return;
					this.itemOut (li);
					if(!window.ie) e.stop();
				}.bind (this));				
			}

			if (this.options.action == 'mouseover' || this.options.action == 'mouseenter') {
				li.addEvent('mouseenter', function(e) {
					if (li.hasClass ('group')) return;
					$clear (li.timer);
					this.itemShow (li);
					if(!window.ie) e.stop();
				}.bind (this));
				
				li.addEvent('mouseleave', function(e) {
					if (li.hasClass ('group')) return;
					$clear (li.timer);
					if (li.childcontent) li.timer = setTimeout(this.itemHide.bind(this, [li, e]), this.options.delayHide);
					else this.itemHide (li, e);
					if(!window.ie) e.stop();
				}.bind (this));
			}
			
			//when click on a link - close all open childcontent
			if (li.a && !li.childcontent) {
				li.a.addEvent ('click',function (e){
					this.itemHideOthers (null);
					//Remove current class
					this.menu.getElements ('.active').removeClass ('active');
					//Add current class
					var p = li;
					while (p) {
						p.addClass ('active');
						p.a.addClass ('active');
						p = p._parent;
					}
					//new Event (e).stop();
				}.bind (this));
			}
		},this);
		
		if (this.options.slide || this.options.fading) {
			//hide all content child
			//this.menu.getElements('.childcontent').setStyle ('display', 'none');
			this.menu.getElements('.childcontent').setStyle ('left', -9999);
		}
		//Call onLoad
		if (typeof (this.options.onLoad) == 'function') this.options.onLoad.call (this);
	}, 

	position: function (li) {
		//fix position for level0 / show it
		li.childcontent.setStyle ('left', 'auto');
		//reposition
		if (li.childcontent) {
			var pos = $merge (li.getPosition(), {'w':li.childcontent.offsetWidth, 'h':li.childcontent.offsetHeight});
			var win = {'x': window.getWidth(), 'y': window.getHeight()};
			var scroll = {'x': window.getScrollLeft(), 'y': window.getScrollTop()};

			if (li.level0) {
				li.childcontent.setStyle ('margin-left', (pos['x'] + pos['w'] + li._ml > win['x'] + scroll ['x']) ? win['x'] + scroll ['x'] - pos['w'] - pos['x']:li._ml);
			} else {
				//sub level
				li.childcontent.setStyle ('margin-top', (pos['y'] + pos['h'] + 20 + li._mt > win['y'] + scroll ['y'])?win['y'] + scroll ['y'] - pos['y'] - pos['h'] - 20 : li._mt);
			}	
		}
	},
	
	getParent: function (li) { 
		var p = li;
		while ((p=p.getParent())) {
			if (this.items.contains (p) && !p.hasClass ('group')) return p;
			if (!p || p == this.menu) return null;
		}
	},
	
	cursorIn: function (el, event) {
		if (!el || !event) return false;
		var pos = $merge (el.getPosition(), {'w':el.offsetWidth, 'h': el.offsetHeight});;
		var cursor = {'x': event.page.x, 'y': event.page.y};
	
		if (cursor.x>pos.x && cursor.x<pos.x+el.offsetWidth
				&& cursor.y>pos.y && cursor.y<pos.y+el.offsetHeight) return true;			
		return false;
	},
	
	isChild: function (child, parent) {
		return !!parent.getChildren().contains (child);
	},
	
	itemOver: function (li) {
		if (li.hasClass ('haschild')) 
			li.removeClass ('haschild').addClass ('haschild-over');
		li.addClass ('over');
		if (li.a) {
			li.a.addClass ('over');
		}
	},
	
	itemOut: function (li) {
		li = (li[0]) ? li[0] : li;
		if (li.hasClass ('haschild-over'))
			li.removeClass ('haschild-over').addClass ('haschild');
		li.removeClass ('over');
		if (li.a) {
			li.a.removeClass ('over');
		}
	},

	itemShow: function (li) {		
		clearTimeout(li.timer);
		if (li.status == 'open') return; //don't need do anything
		//Adjust position
		//Setup the class
		this.itemOver (li);
		//Check if this is the first show
		if (li.childcontent) {
			var firstshow = true;
			this.childopen.each (function (li) {
				if (li.childcontent) firstshow = false;
			});
			if (firstshow && typeof (this.options.onFirstShow) == 'function') {
				this.options.onFirstShow.call (this, li);
			}
		}
		//push to show queue
		li.status = 'open';
		this.childopen.push (li);
		//hide other
		this.itemHideOthers (li);
		if (li.childcontent) {
			if (this.options.action=='click' && this.childopen.length && !this.windowClickEventAdded) {
				//addEvent click for window
				$(document.body).addEvent ('click', this.windowClickFn);
				this.windowClickEventAdded = true;
			}
			//call event
			if (typeof (this.options.onItemHide) == 'function') this.options.onItemHide.call (this, li);
		}
		
		if (!$defined(li.fx) || !$defined(li.childcontent)) return;
		
		li.childcontent.setStyle ('display', 'block');
		this.position (li);

		li.childcontent.setStyles ({'overflow': 'hidden'});		
		if (li.childcontent_inner1.ol) li.childcontent_inner1.setStyles ({'overflow': 'hidden'});
		li.fx.stop();
		li.fx.start (li.eff_on);
	},
	
	itemHide: function (li, e) {
		li = (li[0]) ? li[0] : li;
		
		if (e && e.page) { //if event
			if (this.cursorIn (li, e) || this.cursorIn (li.childcontent, e)) {
				return;
			} //cursor in li
			var p=li._parent;
			if (p && !this.cursorIn (p, e) && !this.cursorIn(p.childcontent, e)) {
				p.fireEvent ('mouseleave', e); //fire mouseleave event
			}
		}
		clearTimeout(li.timer);
		this.itemOut(li);
		li.status = 'close';
		this.childopen.remove (li);
		if (li.childcontent) {
			if (this.options.action=='click' && !this.childopen.length && this.windowClickEventAdded) {
				//removeEvent click for window
				$(document.body).removeEvent ('click', this.windowClickFn);
				this.windowClickEventAdded = false;
			}
			//call event
			if (typeof (this.options.onItemShow) == 'function') this.options.onItemShow.call (this, li);
		}
		
		if (!$defined(li.fx) || !$defined(li.childcontent)) return;
		
		if (li.childcontent.getStyle ('opacity') == 0) return;
		li.childcontent.setStyles ({'overflow': 'hidden'});
		if (li.childcontent_inner1.ol) li.childcontent_inner1.setStyles ({'overflow': 'hidden'});
		li.fx.stop();
		switch (this.options.hidestyle) {
		case 'fast': 
			li.fx.options.duration = 100;
			li.fx.start ($merge(li.eff_off,{'opacity':0}));
			break;
		case 'fastwhenshow': //when other show
			if (!e) { //force hide, not because of event => hide fast
				li.fx.options.duration = 100;
				li.fx.start ($merge(li.eff_off,{'opacity':0}));
			} else {	//hide as normal
				li.fx.start (li.eff_off);
			}
			break;
		case 'normal':
		default:
			li.fx.start (li.eff_off);
			break;
		}	
	},
	
	itemAnimDone: function (li) {
		//hide done
		if (li.status == 'close'){
			//reset duration and enable opacity if not fading
			if (this.options.hidestyle.test (/fast/)) {
				li.fx.options.duration = this.options.duration;
				if (!this.options.fading) li.childcontent_inner.setStyle ('opacity', 1);
			}
			//hide
			li.childcontent.setStyle ('left', -9999);
			//call event
			if (typeof (this.options.onItemHideComplete) == 'function') this.options.onItemHideComplete.call (this, li);
			//Check if there's no child content shown, raise event onLastHide
			var lasthide = true;
			this.childopen.each (function (li) {
				if (li.childcontent) lasthide = false;
			});
			if (lasthide && typeof (this.options.onLastHide) == 'function') this.options.onLastHide.call (this, li);
		}
		//show done
		if (li.status == 'open'){
			li.childcontent.setStyles ({'overflow': ''});
			if (li.childcontent_inner1.ol) li.childcontent_inner1.setStyles ({'overflow-y': 'auto'});
			if (typeof (this.options.onItemShowComplete) == 'function') this.options.onItemShowComplete.call (this, li);
		}
	},
	
	itemHideOthers: function (el) {
		var fakeevent = null
		if (el && !el.childcontent) fakeevent = {};
		var curopen = this.childopen.copy();
		curopen.each (function(li) {
			if (li && typeof (li.status) != 'undefined' && (!el || (li != el && !li.hasChild (el)))) {
				this.itemHide(li, fakeevent);
			}
		},this);
	}
});

gkMegaMenuMoo.implement(new Options);