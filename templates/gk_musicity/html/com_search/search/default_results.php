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

<?php if (!empty($this->searchword)) : ?>
<div class="searchintro<?php echo $this->escape($this->params->get('pageclass_sfx')) ?> clearfix">
	<p>
		<?php echo JText::_('Search Keyword') ?> <strong><?php echo $this->escape($this->searchword) ?></strong>
		<?php echo $this->result ?>
	</p>
	<p>
		<a href="#form1" onclick="document.getElementById('search_searchword').focus();return false" onkeypress="document.getElementById('search_searchword').focus();return false" ><?php echo JText::_('Search_again') ?></a>
	</p>
</div>
<?php endif; ?>

<?php if (count($this->results)) : ?>
<div class="results  clearfix">
	<h3><?php echo JText :: _('Search_result'); ?></h3>
	<?php $start = $this->pagination->limitstart + 1; ?>
	<ol class="list<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>" start="<?php echo (int)$start ?>">
		<?php foreach ($this->results as $result) : ?>
		<li>
			<?php if ($result->href) : ?>
			<h4>
				<a href="<?php echo JRoute :: _($result->href) ?>" <?php echo ($result->browsernav == 1) ? 'target="_blank"' : ''; ?> >
					<?php echo $this->escape($result->title); ?></a>
			</h4>
			<?php endif; ?>
			<?php if ($result->section) : ?>
			<p><?php echo JText::_('Category') ?>:
				<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
					<?php echo $this->escape($result->section); ?>
				</span>
			</p>
			<?php endif; ?>

			<?php echo $result->text; ?>
			<span class="small<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">
				<?php echo $this->escape($result->created); ?>
			</span>
		</li>
		<?php endforeach; ?>
	</ol>
	<?php echo $this->pagination->getPagesLinks(); ?>
	
	<?php if($this->total > 0) : ?>
	<div class="search_limit">
		<label for="limit">
			<?php echo JText::_( 'Display Num' ); ?>
		</label>
		<?php echo $this->pagination->getLimitBox( ); ?>
	</div>
	<div class="search_counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
    <?php endif; ?>
	
</div>
<?php endif; ?>
