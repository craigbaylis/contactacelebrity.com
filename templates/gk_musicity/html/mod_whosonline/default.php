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
 * .mod_whosonline - selector for main container
 * .mod_whosonline.text - selector for text
 * .mod_whosonline.text span - selector for user counters
 * .mod_whosonline.users - selector for user list
 * .mod_whosonline.users li - selector for user items
 * .mod_whosonline.users li span - selector for span in user items
 * 
 * -- when counting mode for user list is enabled you can use also these classes: 
 * 
 * .mod_whosonline.users li.odd - selector for odd user items
 * .mod_whosonline.users li.even - selector for even user items
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
$mod_whosonline_counting_mode = true; // counting mode is enabled
 
/**
 *
 * Additional code
 * 
 */ 

if ($showmode == 0 || $showmode == 2)
{
    if ($count['guest'] != 0 || $count['user'] != 0)
    {
    	echo '<p class="mod_whosonline text">';
        echo JText::_('We have') . '&nbsp;';
        
		if ($count['guest'] == 1)
		{
		    echo '<span>'.JText::sprintf('guest', '1').'</span>';
		}
		else
		{
		    if ($count['guest'] > 1)
		    {
			    echo '<span>'.JText::sprintf('guests', $count['guest']).'</span>';
			}
		}

		if ($count['guest'] != 0 && $count['user'] != 0)
		{
		    echo '&nbsp;' . JText::_('and') . '&nbsp;';
	    }

		if ($count['user'] == 1)
		{
		    echo '<span>'.JText::sprintf('member', '1').'</span>';
		}
		else
		{
		    if ($count['user'] > 1)
		    {
			    echo '<span>'.JText::sprintf('members', $count['user']).'</span>';
			}
		}
		
		echo '&nbsp;' . JText::_('online');
		echo '</p>';
    }
}

?>

<?php if(($showmode > 0) && count($names)) : ?>
    <ul class="mod_whosonline users">
		<?php if($mod_whosonline_counting_mode === TRUE) : ?>
			<?php 
				
				$counter = 1;
				foreach($names as $name) :
					$class = ($counter%2 == 1) ? 'odd' : 'even'; 
			?>
			<li class="<?php echo $class; ?>"><span><?php echo $name->username; ?></span></li>
			<?php 
			
					$counter++;
				endforeach;  
			
			?>
		<?php else : ?>
			<?php foreach($names as $name) : ?>
	    	<li><span><?php echo $name->username; ?></span></li>
			<?php endforeach;  ?>
		<?php endif; ?>
	</ul>
<?php endif; ?>