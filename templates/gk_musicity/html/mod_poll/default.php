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
 * .mod_poll - selector for main container
 * .mod_poll>h4 - selector for header
 * .mod_poll>p.item - selector for items
 * .mod_poll>.buttons - selector for buttons container
 * .mod_poll>.buttons span - selector for button structure
 * .mod_poll>.buttons input - selector for button structure input
 * 
 * -- when counting mode for option list is enabled you can use also these classes: 
 * 
 * .mod_poll>p.item.odd - selector for odd items
 * .mod_poll>p.item.even - selector for even items
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
$mod_poll_counting_mode = true; // counting mode is enabled

?>

<form action="index.php" method="post" name="form2">
	<div class="mod_poll">
		<h4><?php echo $poll->title; ?></h4>
	
		<?php 
			for ($i = 0, $n = count($options); $i < $n; $i ++) : 
				if($mod_poll_counting_mode) $class = (($i+1) % 2) ? ' odd' : ' even';
				else $class = '';
		?>
		
		<p class="item<?php echo $class; ?>">
			<input type="radio" name="voteid" id="voteid<?php echo $options[$i]->id;?>" value="<?php echo $options[$i]->id;?>" alt="<?php echo $options[$i]->id;?>" />
			<label for="voteid<?php echo $options[$i]->id;?>"><?php echo $options[$i]->text; ?></label>
		</p>
		
		<?php 
				$tabcnt = 1 - $tabcnt;
			endfor;
	 	?>
		
		<p class="buttons">
			<span><input type="submit" name="task_button" class="button" value="<?php echo JText::_('Vote'); ?>" /></span>
			<span><input type="button" name="option" class="button" value="<?php echo JText::_('Results'); ?>" onclick="document.location.href='<?php echo JRoute::_("index.php?option=com_poll&id=$poll->slug".$itemid); ?>'" /></span>
		</p>
	
	</div>

	<input type="hidden" name="option" value="com_poll" />
	<input type="hidden" name="task" value="vote" />
	<input type="hidden" name="id" value="<?php echo $poll->id;?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>