window.addEvent("load",function(){
	$$(".gk_is_wrapper-template").each(function(el){
		var elID = el.getProperty("id");
		var wrapper = $(elID);
		var $G = $Gavick[elID];
		var slides = [];
		var contents = [];
		var dates = [];
		var links = [];
		var loadedImages = (wrapper.getElement('.gk_is_preloader')) ? false : true;
		var $blank = false;
		
		if(!loadedImages){
			var imagesToLoad = [];
			
			wrapper.getElements('.gk_is_slide').each(function(el,i){
				links.push(el.getFirst().getProperty('href'));
				var newImg = new Element('img',{
					"title":el.getProperty('title'),
					"class":el.getProperty('class'),
					"style":el.getProperty('style')
				});
				
				newImg.setProperty('alt',el.getChildren()[0].getProperty('href'));
				el.getFirst().remove();
				newImg.setProperty("src",el.innerHTML);
				imagesToLoad.push(newImg);
				newImg.injectAfter(el);
				el.remove();
			});
			
			var time = (function(){
				var process = 0;				
				imagesToLoad.each(function(el,i){
					if(el.complete) process++;
 				});
 				
				if(process == imagesToLoad.length){
					$clear(time);
					loadedImages = process;
					(function(){new Fx.Style(wrapper.getElement('.gk_is_preloader'), 'opacity').start(1,0);}).delay(400);
				}
			}).periodical(200);
		}
		
		var time_main = (function(){
			if(loadedImages){
				$clear(time_main);
				
				wrapper.getElements(".gk_is_slide").each(function(elmt,i){
					slides[i] = elmt;
					if($G['slide_links']){
						elmt.addEvent("click", function(){window.location = elmt.getProperty('alt');});
						elmt.setStyle("cursor", "pointer");
					}
				});
				
				slides.each(function(el,i){
					if(i != 0) el.setOpacity(0);
				});
				
				if(wrapper.getElement(".gk_is_text_title")){
					wrapper.getElements(".gk_is_text_item").each(function(elmt,i){
						contents[i] = elmt.innerHTML;
					});
				}
				
				if(wrapper.getElement(".gk_is_date")){
					wrapper.getElements(".gk_is_date_item").each(function(elmt,i){
						dates[i] = elmt.innerHTML;
					});
				}
				
				$G['actual_slide'] = 0;
				
				if(wrapper.getElement(".gk_is_text_title")) {
					wrapper.getElement(".gk_is_text_title").innerHTML = contents[0];
				}
				
				if(wrapper.getElement(".gk_is_date")) {
					wrapper.getElement(".gk_is_date").innerHTML = dates[0];
				}
				
				if(wrapper.getElement('.gk_is_text_interface span')) {
					wrapper.getElement('.gk_is_text_interface span').setProperty('class', 'active');
					
					wrapper.getElements('.gk_is_text_interface span').each(function(elm, i){
						elm.addEvent('click', function() {
							gk_is_template_anim(wrapper, contents, dates, slides, i, $G);
							$blank = true;
						});
					});
				}
				
				if($G['autoanim']){
					$G['actual_animation'] = (function(){
						if(!$blank) {
							gk_is_template_anim(wrapper, contents, dates, slides, $G['actual_slide']+1, $G);
						} else {
							$blank = false;
						}
					}).periodical($G['anim_interval']+$G['anim_speed']);
				}
			}
		}).periodical(250);
	});
});

function gk_is_template_anim(wrapper, contents, dates, slides, which, $G){
	if(which != $G['actual_slide']){
		var max = slides.length-1;
		if(which > max) which = 0;
		if(which < 0) which = max;
		var actual = $G['actual_slide'];
		
		$G['actual_slide'] = which;
		slides[$G['actual_slide']].setStyle("z-index",max+1);
		new Fx.Style(slides[actual], 'opacity',{duration: $G['anim_speed']}).start(1,0);
		new Fx.Style(slides[which], 'opacity',{duration: $G['anim_speed']}).start(0,1);	
			
		switch($G['anim_type']){
			case 'opacity': break;
			case 'top': new Fx.Style(slides[which],'margin-top',{duration: $G['anim_speed']}).start((-1)*slides[which].getSize().size.y,0);break;
			case 'left': new Fx.Style(slides[which],'margin-left',{duration: $G['anim_speed']}).start((-1)*slides[which].getSize().size.x,0);break;
			case 'bottom': new Fx.Style(slides[which],'margin-top',{duration: $G['anim_speed']}).start(slides[which].getSize().size.y,0);break;
			case 'right': new Fx.Style(slides[which],'margin-left',{duration: $G['anim_speed']}).start(slides[which].getSize().size.x,0);break;
		}
		
		var txt = wrapper.getElement(".gk_is_text_title");
		var date = wrapper.getElement('.gk_is_date');
		if(txt) txt.innerHTML = contents[which];
		if(date) date.innerHTML = dates[which];
		
		if(wrapper.getElement('.gk_is_text_interface span')) {
			wrapper.getElements('.gk_is_text_interface span').setProperty('class', '');
			wrapper.getElements('.gk_is_text_interface span')[which].setProperty('class', 'active');
		}
				
		(function(){slides[$G['actual_slide']].setStyle("z-index",$G['actual_slide']);}).delay($G['anim_speed']);
	}
}