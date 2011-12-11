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
 * .mod_banners - selector for main container
 * .mod_banners .group - selector for group
 * .mod_banners .group>h3 - selector for header
 * .mod_banners .group>.item - selector for items 
 * .mod_banners .group>.footer - selector for footer
 * 
 * -- when counting mode for user list is enabled you can use also these classes: 
 * 
 * .mod_banners .group>.item.odd - selector for odd user items
 * .mod_banners .group>.item.even - selector for even user items
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
$mod_banners_counting_mode = true; // counting mode is enabled

?>

<div class="mod_banners">
	<div class="group">
	
	<?php if ($headerText) : ?>
		<h3><?php echo $headerText ?></h3>
	<?php endif; ?>
	
	<?php 
		$counter = 1;
		foreach($list as $item) : 
			if($mod_banners_counting_mode) $class = ($counter%2 == 1) ? ' odd' : ' even';
			else $class = ''; 
	?>
		<div class="item<?php echo $class; ?>">
			<?php echo modBannersHelper::renderBanner($params, $item); ?>
		</div>
	<?php 
			$counter++;
		endforeach; 
	?>
	
	<?php if ($footerText) : ?>
		<div class="footer">
			 <?php echo $footerText ?>
		</div>
	<?php endif; ?>
	</div>
</div>	