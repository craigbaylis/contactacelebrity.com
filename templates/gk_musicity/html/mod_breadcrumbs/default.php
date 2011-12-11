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
 * .mod_breadcrumbs - selector for main container
 * .mod_breadcrumbs>span.youah - selector for YOUAH text
 * .mod_breadcrumbs>span.pathway - selector for main elements of pathway 
 * .mod_breadcrumbs>span.pathway a - selector for links in pathway 
 * .mod_breadcrumbs>span.pathway a:hover - selector for hover effect in pathway links
 * .mod_breadcrumbs>span.pathway.separator - selector for separators
 * .mod_breadcrumbs>span.pathway.last - selector for last element
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<span class="mod_breadcrumbs">
	<?php for ($i = 0; $i < $count; $i ++) : ?>
		<?php if ($i < $count -1) : ?>
			<?php if(!empty($list[$i]->link)) : ?>
				<span class="pathway">
					<a href="<?php echo $list[$i]->link; ?>" class="pathway"><?php echo $list[$i]->name; ?></a>
				</span>
			<?php else : ?>
				<span class="pathway">
					<?php echo $list[$i]->name; ?>
				</span>	
			<?php endif; ?>
			<span class="pathway separator"> > </span>
		<?php elseif ($params->get('showLast', 1)) : // when $i == $count -1 and 'showLast' is true ?>
		    <span class="pathway last">
				<?php echo $list[$i]->name; ?>
			</span>
		<?php endif; ?>
	<?php endfor; ?>
</span>
