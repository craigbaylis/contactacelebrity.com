<?php

if(!class_exists('GKImageShowTemplate')){
	
	class GKImageShowTemplate {
		var $ID;
		var $config;
		var $path;
		var $settings;
		var $slides;
		var $slides_additional_data;
		
		function GKImageShowTemplate( $module_id, $settings, $base_path, $group_settings, $slide_data ) {
			$this->ID = $module_id;
			$this->path = $base_path;
			$this->settings = $group_settings;
			$this->slides = $slide_data;
			$this->slides_additional_data = array();
			$this->getAdditionalSlideData();
			//
			$this->parse($settings);
			$this->generate();
		}
		
		function returnJSData() {
			return array(
				"animation_speed" => $this->config['animation_speed'],
				"animation_interval" => $this->config['animation_interval'],
				"autoanimation" => $this->config['autoanimation'],
				"animation_type" => $this->config['animation_type'],
				"slide_links" => $this->config['slide_links']
			);
		}
		
		function parse($settings) {
			// creating configuration array (hash)
			$this->config = array(
										"show_title_block" => true, // true|false
										"show_date_block" => true, // true|false
										"date_format" => '%B %e, %Y', // strtotime format
										"interface" => true,
										"title_block_y" => 23,
										"date_block_y" => 14, 
										"slide_links" => true, // true |false
										"animation_speed" => 500,
										"animation_interval" => 5000,
										"autoanimation" => true, // true |false
										"animation_type" => 'opacity' // top|bottom|right|left|opacity
									);
			// exploding settings
			$settings = preg_replace("/\n$/", '', $settings);
			$exploded_settings = explode(';', $settings);
			// parsing
			for( $i = 0; $i < count($exploded_settings) - 1; $i++ ) {
				// preparing pair key-value
				$pair = explode('=', trim($exploded_settings[$i]));
				// extracting key and value from pair	
				$key = $pair[0];
				$value = $pair[1];	
				// checking existing of key in config array
				if(isset($this->config[$key])) {
					// setting value for key
					$this->config[$key] = $value;
				}
			}	
		}
		
		function generate() {
			require(JModuleHelper::getLayoutPath('mod_gk_image_show', 'content'));
		}
		
		function getAdditionalSlideData(){
			$ids = '';
			$i = 0;
			foreach($this->slides as $slide){
				if($i == 0){
					$ids .= ' c.id = '.$slide['article'];	
				}else{
					$ids .= ' OR c.id = '.$slide['article'];
				}
				$i++;
			}
			
			if($ids !== '') {
				// get SQL query
				$query = "
					SELECT 
						c.id AS id,
						c.created AS date
					FROM 
						#__content AS c
					LEFT JOIN
						#__users AS u
						ON
						c.created_by = u.id	
					WHERE 
						".$ids." 
					;
				";
				$database = & JFactory::getDBO();
				$database->setQuery($query);
				//
				if( $dane = $database->loadObjectList() ) {
					foreach($dane as $item) {
						$this->slides_additional_data[$item->id] = array(
																			'date' => $item->date
																		);
					}
				}
			}
		}
	}	
}

/**/