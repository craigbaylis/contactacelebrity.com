window.addEvent("load", function(){
	$$('.gk_js_members_main').each(function(wrapper){
		var module_id = wrapper.getProperty("id");
		var $G = $Gavick["gk_js_members-"+module_id]; 
		var tabs = wrapper.getElements('.gk_js_tab');
		var members = wrapper.getElements('.gk_js_members');
		var membersFx = [];
		var wrap = wrapper.getElement('.gk_js_content_wrap');
		
		members.each(function(el,i){
			membersFx[i] = new Fx.Style(el,'opacity',{duration:250});
		});
		if(wrapper.getElement('.gk_js_interface')){
			members.setStyle("display","block");
			wrapper.getElements('.gk_js_interface').each(function(elm,i){
				elm.setStyles({
					"width" : (elm.getSize().size.x - elm.getElement('div').getStyle("padding-left").toInt()) + "px",
					"float" : "none"
				});
			});
			members.each(function(elm,i){ if(i != 0) elm.setStyle("display","none"); });
		}
		tabs[0].setProperty("class","gk_js_tab active");
		tabs.each(function(tab,i){
			tab.addEvent("click", function(){
				(function() { wrapper.getElements('.gk_js_content').addClass('loading'); }).delay(700);
				wrap.setStyle("height", wrap.getSize().size.y+"px");
				members.each(function(e,j){
					if(i != j){
						membersFx[i].set(1);
						membersFx[i].start(1,0);
						(function(){e.setStyle("display","none");}).delay(550);
					}
				});
				(function(){
					wrapper.getElements('.gk_js_content').removeClass('loading');
					members.each(function(e,j){
						if(i == j){
							membersFx[i].set(0);
							e.setStyle("display", "block");
							membersFx[i].start(0,1);
							(function(){wrap.setStyle("height", "auto");}).delay(100);
						}
					});
				}).delay(2000);
				tabs.each(function(t,j){
					if(j!=i) t.setProperty("class","gk_js_tab");
					else  t.setProperty("class","gk_js_tab active");
				});
			});
		});
        if(wrapper.getElement('.gk_js_interface')){
    		members.each(function(el,i){
    			var prev = el.getElement('.gk_js_interface .gk_js_prev');
    			var next = el.getElement('.gk_js_interface .gk_js_next');
    			var page = 0;
    			var pages = el.getElements('.gk_js_members_wrap');
    			var maxPage = pages.length;
    			var scroll = new Fx.Scroll(el.getElement('.gk_js_members_scroll1'), {wheelStops:false,duration:$G['animationSpeed'],transition:$G['animationType']});
				scroll.scrollTo(0,0);

				el.getElements('.gk_js_page')[0].setProperty('class', 'gk_js_page active');

    			if(prev) {
    				prev.addEvent("click", function(){
			    		page = (page > 0) ? page-1 : maxPage-1;
			    		el.getElements('.gk_js_page').setProperty('class', 'gk_js_page');
			    		el.getElements('.gk_js_page')[page].setProperty('class', 'gk_js_page active');
						scroll.scrollTo(pages[0].getSize().size.x * page, 0);
			 		});
				}
    			if(next){
  					next.addEvent("click", function(){
				    	page = (page < maxPage - 1) ? page+1 : 0;
				    	el.getElements('.gk_js_page').setProperty('class', 'gk_js_page');
				    	el.getElements('.gk_js_page')[page].setProperty('class', 'gk_js_page active');
				    	scroll.scrollTo(pages[0].getSize().size.x * page, 0);				
				    });
				}
				
				el.getElements('.gk_js_page').each(function(elm,j){
					elm.addEvent('click', function(){
						page = j;
						el.getElements('.gk_js_page').setProperty('class', 'gk_js_page');
						el.getElements('.gk_js_page')[j].setProperty('class', 'gk_js_page active');
						scroll.scrollTo(pages[0].getSize().size.x * page, 0);
					});
				});
    		});
        }
	});
});