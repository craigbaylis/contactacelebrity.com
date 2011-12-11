<?php

/**
* Gavick Image Slide I
* @package Joomla!
* @Copyright (C) 2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0.0 $
**/

// access restriction
defined('_JEXEC') or die('Restricted access');
// vars
$highest_layer = 0;
$URI = JURI::getInstance();

?>

<div id="gk_is-<?php echo $this->ID;?>" class="gk_is_wrapper gk_is_wrapper-template">

	<div class="gk_is_preloader"></div>
	
	<div class="gk_is_image" style="width: <?php echo $this->settings["image_x"]; ?>px;height: <?php echo $this->settings["image_y"]; ?>px;">
		<?php for($i = 0; $i < count($this->slides); $i++) : ?>
			<?php 
			
				// cleaning variables
				unset($path, $title, $link);
				// creating slide path
				$path = $URI->root().'components/com_gk3_photoslide/thumbs_big/'.$this->slides[$i]["filename"];
				// creating slide title
				$title = htmlspecialchars(($this->slides[$i]["ctitle"] == "") ? $this->slides[$i]["title"] : $this->slides[$i]["ctitle"]);
				// creating slide link
				$link = ($this->slides[$i]["link_type"] != 0) ? JRoute::_(ContentHelperRoute::getArticleRoute($this->slides[$i]["article"], $this->slides[$i]["cid"], $this->slides[$i]["sid"])) : $this->slides[$i]["link"];	
				
			?>
			
			<div class="gk_is_slide" style="z-index: <?php echo $i+1; ?>;" title="<?php echo $title; ?>"><?php echo $path; ?><a href="<?php echo $link; ?>">link</a></div>
			
		<?php endfor; ?>
	</div>
	
	<?php if($this->config['show_date_block'] == "true") : ?>
	<div class="gk_is_date" style="top: <?php echo $this->config['date_block_y']; ?>px;"></div>
	<?php endif; ?>
	
	<?php if($this->config['show_title_block'] == "true" || $this->config['interface'] == "true") : ?>
	<div class="gk_is_text" style="bottom: <?php echo $this->config['title_block_y']; ?>px;">
		<?php if($this->config['show_title_block'] == "true") : ?>
		<div class="gk_is_text_title"></div>
		<?php endif; ?>
		<?php if($this->config['interface'] == "true") : ?>
		<div class="gk_is_text_interface">
			<?php for($i = 0; $i < count($this->slides); $i++) : ?>
			<span><?php echo $i; ?></span>
			<?php endfor; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	<?php if($this->config['show_title_block'] == "true" || $this->config['show_date_block'] == "true") : ?>
	<div class="gk_is_text_data">
		<?php for($i = 0; $i < count($this->slides); $i++) : ?>
		
		<?php 
		
			// cleaning variables
			unset($title, $link, $date);
			// creating slide title
			$title = ($this->slides[$i]["ctitle"] == "") ? $this->slides[$i]["title"] : $this->slides[$i]["ctitle"];
			// creating slide link
			$link = ($this->slides[$i]["link_type"] != 0) ? JRoute::_(ContentHelperRoute::getArticleRoute($this->slides[$i]["article"], $this->slides[$i]["cid"], $this->slides[$i]["sid"])) : $this->slides[$i]["link"];
			$date = JHTML::_('date', $this->slides_additional_data[$this->slides[$i]['article']]['date'], $this->config['date_format']);
			
		?>
		
		<div class="gk_is_text_item">
			<a href="<?php echo $link; ?>"><?php echo $title; ?></a>
			
		</div>
		
		<div class="gk_is_date_item">
			<span><?php echo $date; ?></span>
		</div>
		<?php endfor; ?>
	</div>
	<?php endif; ?>
</div>