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
 * .mod_related_items - selector for main container
 * .mod_related_items>ul - selector for list
 * .mod_related_items>ul li - selector for list items
 * .mod_related_items>ul a - selector for list links
 * .mod_related_items>ul a span - selector for dates in list items
 * 
 * -- when counting mode for list is enabled you can use also these classes: 
 * 
 * .mod_related_items>ul li.odd - selector for odd user items
 * .mod_related_items>ul li.even - selector for even user items
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
$mod_related_items_counting_mode = true; // counting mode is enabled 

?>
<div class="mod_related_items">
	<ul>
	<?php 
		$counter = 1;
		foreach ($list as $item) :
			if($mod_related_items_counting_mode) $class = ($counter % 2 == 1) ? ' class="odd"' : ' class="even"'; 
			else $class = '';	
	?>
		<li<?php echo $class; ?>>
			<a href="<?php echo $item->route; ?>">
				<?php if ($showDate): ?> 
				<span><?php echo $item->created . " - "; ?></span>
				<?php endif; ?>
				
				<?php echo $item->title; ?>
			</a>
		</li>
	<?php 
			$counter++;
		endforeach; 
	?>
	</ul>
</div>