<?php

/*
#------------------------------------------------------------------------
# memovie - February 2010 (for Joomla 1.5)
#
# Copyright (C) 2007-2010 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com   
#------------------------------------------------------------------------ 
# Based on T3 Framework
#------------------------------------------------------------------------
# Copyright (C) 2004-2009 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - GNU/GPL, http://www.gnu.org/copyleft/gpl.html
# Author: J.O.O.M Solutions Co., Ltd
#------------------------------------------------------------------------
*/




defined('_JEXEC') or die('Restricted access');

?>



<?php JHTML::_('stylesheet', 'poll_bars.css', 'components/com_poll/assets/'); ?>



<?php if ($this->params->get('show_page_title',1)) : ?>

<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<span><?php echo $this->escape($this->params->get('page_title')); ?></span>

</h1>

<?php endif; ?>



<div class="poll<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">

	<form action="index.php" method="post" name="poll" id="poll">

		<label for="id">

			<?php echo JText::_( 'Select Poll' ); ?>&nbsp;<?php echo $this->lists['polls']; ?>

		</label>

	</form>

	<?php if (count($this->votes)) :

		echo $this->loadTemplate( 'graph' );

	endif; ?>

</div>

