<?php 

/**
 * 
 * GK Joomla! Override by GavickPro
 * 
 * v.1.0.0
 * 
 */

/**
 *
 * CSS classes
 * 
 * .mod_sections - selector for main container
 * .mod_sections>ul - selector for list
 * .mod_sections>ul li - selector for list items
 * .mod_sections>ul a - selector for list links
 * 
 * -- when counting mode for list is enabled you can use also these classes: 
 * 
 * .mod_sections>ul li.odd - selector for odd user items
 * .mod_sections>ul li.even - selector for even user items
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * Configuration
 * 
 */

// Enabled counting mode causes adding classes odd/even for users list 
$mod_sections_counting_mode = true; // counting mode is enabled 

?>
<div class="mod_sections">
	<ul>
	<?php 
		$counter = 1;
		foreach ($list as $item) :
			if($mod_sections_counting_mode) $class = ($counter % 2 == 1) ? ' class="odd"' : ' class="even"'; 
			else $class = '';	
	?>
		<li<?php echo $class; ?>>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($item->id)); ?>">
				<?php echo $item->title;?>
			</a>
		</li>
	<?php 
			$counter++;
		endforeach; 
	?>
	</ul>
</div>