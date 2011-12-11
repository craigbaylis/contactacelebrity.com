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
 * .mod_syndicate - selector for main container
 * .mod_syndicate>a - selector for link 
 * .mod_syndicate>a img - selector for image in link
 * .mod_syndicate>a span - selector for text in link
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * Configuration
 * 
 */

// Enable image for syndicate link 
$mod_syndicate_image = true; // image is enabled

?>

<div class="mod_syndicate">
	<a href="<?php echo $link ?>">
		<?php if($mod_syndicate_image) : ?>
		<?php echo JHTML::_('image.site', 'livemarks.png', '/images/M_images/', NULL, NULL, 'feed-image'); ?> 
		<?php endif; ?>
		<span>
			<?php echo $params->get('text') ?>
		</span>
	</a>
</div>