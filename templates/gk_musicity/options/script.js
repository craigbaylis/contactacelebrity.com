window.addEvent("domready",function(){
	var tabs = [];
	var options = [];
	var opt_iterator = -1;
	var base_table = $ES('.adminform .admintable',$$('#element-box .m')[0])[2];
	var update_url = 'http://www.gavick.com/updates.raw?task=json&tmpl=component&query=product&product=gk_musicity';
	
	$$('.paramlist_value').each(function(el){
		if(!$E('input', el) && !$E('select', el) && !$E('textarea', el)){
			opt_iterator++;
			var div_gen = new Element('div',{"class":"gk_opt"});
			div_gen.innerHTML = '<span class="gk_text">'+el.innerHTML+'</span><span class="gk_btn">Toggle</span>';
			div_gen.injectBefore(base_table);
			tabs.push(div_gen);
			options[opt_iterator] = [];
		}else options[opt_iterator].push(el.getParent());
	});

	options.each(function(el,i){
		if(i == 2){
			var div = new Element('div',{"class":"gk_opts"});
			div.innerHTML = '<td colspan="2"><table cellspacing="1" width="100%" class="paramlist admintable"><tbody><tr><td width="40%" class="paramlist_key"><span><label for="paramsmenuname">Cufon font generator</label></span></td><td class="paramlist_value"><big><a href="http://cufon.shoqolate.com/generate/" target="_blank" class="gk_link">Click here</a></big></td></tr><tr><td width="40%" class="paramlist_key"><span><label for="paramsmenuname">Google Font Directory</label></span></td><td class="paramlist_value"><big><a href="http://code.google.com/webfonts" target="_blank" class="gk_link">Click here</a></big></td></tr><tr><td width="40%" class="paramlist_key"><span><label for="paramsmenuname">Font Squirell kits</label></span></td><td class="paramlist_value"><big><a href="http://www.fontsquirrel.com/fontface" target="_blank" class="gk_link">Click here</a></big></td></tr></tbody></table></td>';
			div.injectAfter(tabs[i]);
			div_body = div.getElementsBySelector('tbody')[0];
			options[i].each(function(elm,j){ elm.injectInside(div_body); });	
		}else if(i == 6){
			var div = new Element('div',{"class":"gk_opts"});
			div.innerHTML = '<td colspan="2"><table cellspacing="1" width="100%" class="paramlist admintable"><tbody><tr><td width="40%" class="paramlist_key"><span><label for="paramsmenuname">Link to transitions demo</label></span></td><td class="paramlist_value"><big><a href="http://demos111.mootools.net/Fx.Transitions">MooTools 1.11 transitions demo</a></big></td></tr></tbody></table></td>';
			div.injectAfter(tabs[i]);
			div_body = div.getElementsBySelector('tbody')[0];
			options[i].each(function(elm,j){ elm.injectInside(div_body); });	
		}else{
			var div = new Element('div',{"class":"gk_opts"});
			div.innerHTML = '<td colspan="2"><table cellspacing="1" width="100%" class="paramlist admintable"><tbody></tbody></table></td>';
			div.injectAfter(tabs[i]);
			div_body = div.getElementsBySelector('tbody')[0];
			options[i].each(function(elm,j){ elm.injectInside(div_body); });
		}
	});
	
	var update_tab = new Element('div',{"class":"gk_opt","id":"gk_update"});
	update_tab.innerHTML = '<span class="gk_text">Updates</span><span class="gk_btn">Toggle</span>';
	
	update_tab.injectAfter($$('.gk_opts').getLast());
	var update_div = new Element('div',{"class":"gk_opts"});
	
	update_div.innerHTML = '<div id="gk_update_div"><span id="gk_loader"></span>Loading update data from GavicPro Update service...</div>';
	update_div.injectAfter($$('.gk_opt').getLast());
	
	base_table.remove();
	
	$$('.gk_switch').each(function(el){
		el.setStyle('display','none');
		var style = (el.value == 1) ? 'on' : 'off';
		var switcher = new Element('div',{'class' : 'switcher-'+style});
		switcher.injectAfter(el);
		switcher.addEvent("click", function(){
			if(el.value == 1){
				switcher.setProperty('class','switcher-off');
				el.value = 0;
			}else{
				switcher.setProperty('class','switcher-on');
				el.value = 1;
			}
		});
	});
	
	new Accordion($$('.gk_opt'),$$('.gk_opts'),{
		onActive:function(toggler){ toggler.setProperty("class","gk_opt active"); },
		onBackground:function(toggler){ toggler.setProperty("class","gk_opt"); },
		alwaysHide: true
	});
	
	$('gk_update').addEvent("click", function(){
		new Asset.javascript(update_url,{
	   		id: "new_script",
	   		onload: function(){
  				$('gk_update_div').innerHTML = '<p>Updates available for this template:</p>';
				$GK_UPDATE.each(function(el){
	  				$('gk_update_div').innerHTML += '<div class="gk_update"><span class="gk_update_version"><strong>Version:</strong> ' + el.version + ' </span><span class="gk_update_data"><strong>Date:</strong> ' + el.date + ' </span><span class="gk_update_link"><a href="' + el.link + '">Download this update</a></span></div>';
				});
				if($$('.gk_update').length == 0) $('gk_update_div').innerHTML += '<p>Any updates are available for this template</p>';	
	   		}
		});
		
		if(window.ie){
			var $timer = (function(){
				if(typeof($GK_UPDATE) != undefined){
					$clear($timer);
					alert('Updates data downloaded');
					$('gk_update_div').innerHTML = '<p>Updates available for this template:</p>';
					$GK_UPDATE.each(function(el){
	  					$('gk_update_div').innerHTML += '<div class="gk_update"><span class="gk_update_version"><strong>Version:</strong> ' + el.version + ' </span><span class="gk_update_data"><strong>Date:</strong> ' + el.date + ' </span><span class="gk_update_link"><a href="' + el.link + '">Download this update</a></span></div>';
					});
					if($$('.gk_update').length == 0) $('gk_update_div').innerHTML += '<p>Any updates are available for this template</p>';	
				}
			}).periodical(250);
		}
	});
	
	$$('.last-in-group').each(function(el){
		var new_tr = new Element('tr');
		var elm = el.getParent().getParent();
		new_tr.injectAfter(elm);
		new_tr.innerHTML = '<td width="40%" style="height:5px;background:#eee;" class="paramlist_key"></td><td class="paramlist_value" style="height:5px;background:#eee;"></td>';
	});
});