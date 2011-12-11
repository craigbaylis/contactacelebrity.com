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



<?php if ($this->params->get('show_page_title', 1)) : ?>

<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<span><?php echo $this->escape($this->params->get('page_title')); ?></span>

</h1>

<?php endif; ?>





<div class="weblinks<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">



	<?php if ( $this->category->image || $this->category->description) : ?>

	<div class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?> clearfix">



		<?php if ($this->category->image) :

			echo $this->category->image;

		endif; ?>



		<?php echo $this->category->description; ?>



		<?php if ($this->category->image) : ?>

		<div class="wrap_image">&nbsp;</div>

		<?php endif; ?>



	</div>

	<?php endif; ?>



	<?php echo $this->loadTemplate('items'); ?>



</div>

