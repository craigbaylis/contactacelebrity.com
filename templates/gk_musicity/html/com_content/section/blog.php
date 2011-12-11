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

<?php if ($this->params->get('show_page_title')) : ?>
<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<span><?php echo $this->escape($this->params->get('page_title')); ?></span>
</h1>
<?php endif; ?>

<div class="blog<?php echo $this->escape($this->params->get('pageclass_sfx')); ?> clearfix">

	<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<div class="contentdescription<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

		<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
		<img src="<?php echo $this->baseurl . $cparams->get('image_path').'/'.$this->escape($this->section->image); ?>" class="image_<?php echo $this->escape($this->section->image_position); ?>" />
		<?php endif; ?>

		<?php if ($this->params->get('show_description') && $this->section->description) :
			echo $this->section->description;
		endif; ?>

		<?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
		<div class="wrap_image">&nbsp;</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>

	<?php $i = $this->pagination->limitstart;
	$rowcount = $this->params->def('num_leading_articles', 1);
	for ($y = 0; $y < $rowcount && $i < $this->total; $y++, $i++) : ?>
		<div class="leading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?> clearfix">
			<?php $this->item =& $this->getItem($i, $this->params);
			echo $this->loadTemplate('item'); ?>
		</div>
	<?php endfor; ?>

	<?php $introcount = (int)$this->params->def('num_intro_articles', 4);
	if ($introcount) :
		$colcount = (int)$this->params->def('num_columns', 2);
		if ($colcount == 0) :
			$colcount = 1;
		endif;
		$rowcount = (int) $introcount / $colcount;
		$ii = 0;
		for ($y = 0; $y < $rowcount && $i < $this->total; $y++) : ?>
			<div class="article_row<?php echo $this->escape($this->params->get('pageclass_sfx')); ?> cols<?php echo $colcount; ?> clearfix">
				<?php for ($z = 0; $z < $colcount && $ii < $introcount && $i < $this->total; $z++, $i++, $ii++) : ?>
					<div class="article_column column<?php echo $z + 1; ?>" >
						<?php $this->item =& $this->getItem($i, $this->params);
						echo $this->loadTemplate('item'); ?>
					</div>
				<?php endfor; ?>
			</div>
		<?php endfor;
	endif; ?>

	<?php $numlinks = (int)$this->params->def('num_links', 4);
	if ($numlinks && $i < $this->total) : ?>
	<?php 
		$this->links = array_slice($this->items, $i - $this->pagination->limitstart, $i - $this->pagination->limitstart + $numlinks);
		echo $this->loadTemplate('links'); 
	?>
	<?php endif; ?>

	<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
		<?php if( $this->pagination->get('pages.total') > 1 ) : ?>
		<p class="counter">
			<span><?php echo $this->pagination->getPagesCounter(); ?></span>
		</p>
		<?php endif; ?>
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		<?php endif; ?>
	<?php endif; ?>

</div>
