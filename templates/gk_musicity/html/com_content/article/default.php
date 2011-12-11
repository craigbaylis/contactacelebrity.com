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





// no direct access

defined('_JEXEC') or die('Restricted access'); ?>



<?php if ($this->params->get('show_page_title', 1) && $this->params->get('page_title') != $this->article->title) : ?>

<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><span><?php echo $this->escape($this->params->get('page_title')); ?></span></h1>

<?php endif; ?>

<?php  if (!$this->params->get('show_intro')) :
	echo $this->article->event->afterDisplayTitle;
endif; ?>

<?php echo $this->article->event->beforeDisplayContent; ?>

<?php if ($this->params->get('show_title',1)) : ?>
<h2 class="contentheading<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?> clearfix">
	
	<?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
	<span>
		<a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>"><?php echo $this->escape(isset($this->article->page_title)?$this->article->page_title:$this->article->title); ?></a>
	</span>
	<?php else : ?>
	<span><?php echo $this->escape(isset($this->article->page_title)?$this->article->page_title:$this->article->title); ?></span>
	<?php endif; ?>
</h2>
<?php endif; ?>

<?php

if (
($this->params->get('show_create_date'))
|| (($this->params->get('show_author')) && ($this->article->author != ""))
|| (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid))
|| ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon'))
|| ($this->params->get('show_url') && $this->article->urls)
) :

?>

<div class="article-tools clearfix">
	<div class="article-meta">
	<?php if ($this->params->get('show_create_date')) : ?>
		<span class="createdate">
			<?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')) ?>
		</span>
	<?php endif; ?>

	<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
		<span class="createby">
			<?php $this->escape(JText::printf(($this->escape($this->article->created_by_alias) ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author)) )); ?>
		</span>
	<?php endif; ?>

	<?php	
    $comments = JPATH_SITE . '/components/com_jcomments/jcomments.php';
	if (file_exists($comments) ) :
		require_once($comments);
        if (JCommentsContentPluginHelper::checkCategory($this->article->catid) && (JCommentsContentPluginHelper::isEnabled($this->article, false) || !JCommentsContentPluginHelper::isDisabled($this->article, false))):
		$jcomment_count = JComments::getCommentsCount($this->article->id, 'com_content');	
	?>
	
		<a class="comments" href="<?php echo $this->article->readmore_link; ?>#comments"><?php echo $jcomment_count; ?> <?php echo JText::_('COMMENTS'); ?></a>
			
	<?php endif; ?>
	<?php endif; ?>

	<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
		<?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
		<span class="article-section">
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->article->section); ?>
			<?php if ($this->params->get('link_section')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
				<?php if ($this->params->get('show_category')) : ?>
				<?php echo ' - '; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
		<?php if ($this->params->get('show_category') && $this->article->catid) : ?>
		<span class="article-section">
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
			<?php endif; ?>
			<?php echo $this->escape($this->article->category); ?>
			<?php if ($this->params->get('link_category')) : ?>
				<?php echo '</a>'; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>
	<?php endif; ?>
	</div>	

	<?php if ($this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
	<div class="buttonheading">
		<?php if (!$this->print) : ?>
			<?php if ($this->params->get('show_email_icon')) : ?>
			<span>
			<?php echo JHTML::_('icon.email',  $this->article, $this->params, $this->access); ?>
			</span>
			<?php endif; ?>

			<?php if ( $this->params->get( 'show_print_icon' )) : ?>
			<span>
			<?php echo JHTML::_('icon.print_popup',  $this->article, $this->params, $this->access); ?>
			</span>
			<?php endif; ?>

			<?php if ($this->params->get('show_pdf_icon')) : ?>
			<span>
			<?php echo JHTML::_('icon.pdf',  $this->article, $this->params, $this->access); ?>
			</span>
			<?php endif; ?>
		<?php else : ?>
			<span>
			<?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
			</span>
		<?php endif; ?>
	</div>
	<?php endif; ?>	
	
	<?php if (($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) && !$this->print) : ?>
	<div class="contentpaneopen_edit<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>" >
		<?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
	</div>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
		<span class="article-url">
			<a href="http://<?php echo $this->escape($this->article->urls) ; ?>" target="_blank">
				<?php echo $this->escape($this->article->urls); ?></a>
		</span>
	<?php endif; ?>
</div>
<?php endif; ?>


<div class="article-content<?php echo $this->escape($this->params->get( 'pageclass_sfx' )); ?>">
<?php if (isset ($this->article->toc)) : ?>
	<?php echo $this->article->toc; ?>
<?php endif; ?>
<?php echo $this->article->text; ?>
</div>

<?php if ( intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
	<span class="modifydate">
		<?php JText::sprintf('LAST_UPDATED2', $this->escape(JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2')))); ?>
	</span>
<?php endif; ?>

<?php echo $this->article->event->afterDisplayContent; ?>
