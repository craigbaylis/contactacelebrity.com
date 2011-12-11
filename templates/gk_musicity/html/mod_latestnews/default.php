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
 * .mod_latestnews - selector for main container
 * .mod_latestnews>ul - selector for list
 * .mod_latestnews>ul li - selector for list items
 * .mod_latestnews>ul a - selector for list links
 * 
 * -- when counting mode for list is enabled you can use also these classes: 
 * 
 * .mod_latestnews>ul li.odd - selector for odd user items
 * .mod_latestnews>ul li.even - selector for even user items
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
$mod_latestnews_counting_mode = true; // counting mode is enabled 

?>
<div class="mod_latestnews">
	<ul>
	<?php 
		$counter = 1;
		foreach ($list as $item) :
			if($mod_latestnews_counting_mode) $class = ($counter % 2 == 1) ? ' class="odd"' : ' class="even"'; 
			else $class = '';	
	?>
		<li<?php echo $class; ?>>
			<a href="<?php echo $item->link; ?>">
				<?php echo $item->text;?>
			</a>
		</li>
	<?php 
			$counter++;
		endforeach; 
	?>
	</ul>
</div>