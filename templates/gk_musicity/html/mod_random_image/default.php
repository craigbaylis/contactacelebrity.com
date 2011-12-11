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
 * .mod_random_image - selector for main container
 * .mod_random_image>a - selector for link around image 
 * .mod_random_image img - selector for image 
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');


/**
 *
 * Configuration
 * 
 */

// Target value for link
$mod_random_image_target = false; // Accepted values: '_self', '_blank', false

if($mod_random_image_target == false)         $mod_random_image_target_code = '';
else if($mod_random_image_target == '_self')  $mod_random_image_target_code = ' target="_self"';
else if($mod_random_image_target == '_blank') $mod_random_image_target_code = ' target="_blank"';
else                                          $mod_random_image_target_code = '';

?>

<div class="mod_random_image">
	<?php if ($link) : ?><a href="<?php echo $link; ?>"<?php echo $mod_random_image_target_code; ?>><?php endif; ?>
		<?php echo JHTML::_('image', $image->folder.'/'.$image->name, $image->name, array('width' => $image->width, 'height' => $image->height)); ?>
	<?php if ($link) : ?></a><?php endif; ?>
</div>