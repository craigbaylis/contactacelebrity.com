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

$cparams = JComponentHelper::getParams ('com_media');

?>



<?php if ( $this->params->get( 'show_page_title',1)): ?>

<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<span><?php echo $this->escape($this->params->get('page_title')); ?></span>

</h1>

<?php endif; ?>



<div class="newsfeed<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">

	<?php if ( $this->category->image || $this->category->description ) : ?>

	<div class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">



		<?php if ( $this->category->image ) : ?>

		<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path').'/'.$this->category->image; ?>" class="image_<?php echo $this->category->image_position; ?>" />

		<?php endif; ?>



		<?php if ( $this->params->get( 'description' ) ) :

			echo $this->category->description;

		endif; ?>



		<?php if ( $this->category->image ) : ?>

		<div class="wrap_image">&nbsp;</div>

		<?php endif; ?>



	</div>

	<?php endif; ?>



	<?php echo $this->loadTemplate('items'); ?>

</div>

