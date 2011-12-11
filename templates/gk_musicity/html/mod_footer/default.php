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
 * .mod_footer - selector for main container
 * .mod_footer>div:firstchild - selector for first div in main container
 * .mod_footer>div - selector for second div in main container
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<div class="mod_footer">
	<div><?php echo $lineone; ?></div>
	<div><?php echo JText::_( 'FOOTER_LINE2' ); ?></div>
</div>