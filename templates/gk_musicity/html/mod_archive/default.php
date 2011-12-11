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
 * .mod_archive - selector for main container
 * .mod_archive>ul - selector for list
 * .mod_archive>ul li - selector for list items
 * .mod_archive>ul a - selector for links in list items
 * 
 * -- when counting mode for user list is enabled you can use also these classes: 
 * 
 * .mod_archive>ul li.odd - selector for odd user items
 * .mod_archive>ul li.even - selector for even user items
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * Configuration
 * 
 */

// Enabled counting mode causes adding classes odd/even for items list 
$mod_archive_counting_mode = true; // counting mode is enabled

?>
<div class="mod_archive">
	<ul>
		<?php 
			$counter = 1;
			foreach ($list as $item) :
				if($mod_archive_counting_mode) $class = ($counter %2 == 1) ? ' class="odd"' : ' class="even"';
				else $class = ''; 
		?>
		<li<?php echo $class; ?>>
			<a href="<?php echo $item->link; ?>"><?php echo $item->text; ?></a>
		</li>
		<?php 
				$counter++;
			endforeach; 
		?>
	</ul>
</div>