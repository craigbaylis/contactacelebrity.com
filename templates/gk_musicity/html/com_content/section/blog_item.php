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

<div class="contentpaneopen<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>">

<?php  if (!$this->item->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>

<?php

if (
$this->item->params->get('show_title')
|| ($this->item->params->get('show_create_date'))
|| (($this->item->params->get('show_author')) && ($this->item->author != ""))
|| (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid))
|| ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon'))
|| ($this->item->params->get('show_url') && $this->item->urls)
) :

?>

<div class="article-tools clearfix">
	<?php if ($this->item->params->get('show_create_date')) : ?>
	<?php $article_time = strtotime($this->item->created); ?>
	<div class="blogcreatedate">
		<div>
			<span><?php echo JHTML::_('date', $article_time, "%d"); ?></span>
			<span><?php echo JHTML::_('date', $article_time, "%b"); ?></span>
		</div>
	</div>
	<?php endif; ?>

	<div class="article-meta blog" <?php if (!($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon'))):?>style="width: 100%"<?php endif;?>>
	
	<?php if ($this->item->params->get('show_title')) : ?>
	<h2 class="contentheading<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>"><span><?php if ($this->item->params->get('link_titles') && $this->item->readmore_link != '') : ?><a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>"><?php echo $this->escape($this->item->title); ?></a><?php else : ?><?php echo $this->escape($this->item->title); ?><?php endif; ?></span></h2>
	<?php endif; ?>

<?php if (($this->item->params->get('show_author')) && ($this->item->author != "")) : ?>
	<span class="createby">
		<?php JText::printf('Written by', ($this->item->created_by_alias ? $this->escape($this->item->created_by_alias) : $this->escape($this->item->author)) ); ?>
	</span>
<?php endif; ?>

<?php

$comments = JPATH_SITE . '/components/com_jcomments/jcomments.php';
if (file_exists($comments) ) :
	require_once($comments);
    if (JCommentsContentPluginHelper::checkCategory($this->item->catid) && (JCommentsContentPluginHelper::isEnabled($this->item, false) || !JCommentsContentPluginHelper::isDisabled($this->item, false))):
	$jcomment_count = JComments::getCommentsCount($this->item->id, 'com_content');

?>

	<a class="comments" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute( $this->item->id, $this->item->catslug, $this->item->sectionid)); ?>#comments"><?php echo $jcomment_count; ?> <?php echo JText::_('COMMENTS'); ?></a>

<?php endif; ?>
<?php endif; ?>

<?php if (($this->item->params->get('show_section') && $this->item->sectionid) || ($this->item->params->get('show_category') && $this->item->catid)) : ?>
	<?php if ($this->item->params->get('show_section') && $this->item->sectionid && isset($this->section->title)) : ?>
	<span class="article-section">
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->item->sectionid)).'">'; ?>
		<?php endif; ?>
		<?php echo $this->escape($this->section->title); ?>
		<?php if ($this->item->params->get('link_section')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
		<?php if ($this->item->params->get('show_category')) : ?>
		<?php echo ' - '; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>


	<?php if ($this->item->params->get('show_category') && $this->item->catid) : ?>
	<span class="article-section">
		<?php if ($this->item->params->get('link_category')) : ?>
			<?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug, $this->item->sectionid)).'">'; ?>
		<?php endif; ?>

		<?php echo $this->escape($this->item->category); ?>

		<?php if ($this->item->params->get('link_category')) : ?>
			<?php echo '</a>'; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
<?php endif; ?>
</div>

<?php if ($this->item->params->get('show_pdf_icon') || $this->item->params->get('show_print_icon') || $this->item->params->get('show_email_icon')) : ?>
<div class="buttonheading">
	<?php if ($this->item->params->get('show_email_icon')) : ?>
	<span>
	<?php echo JHTML::_('icon.email', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>
	
	<?php if ( $this->item->params->get( 'show_print_icon' )) : ?>
	<span>
	<?php echo JHTML::_('icon.print_popup', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>

	<?php if ($this->item->params->get('show_pdf_icon')) : ?>
	<span>
	<?php echo JHTML::_('icon.pdf', $this->item, $this->item->params, $this->access); ?>
	</span>
	<?php endif; ?>
</div>

<?php endif; ?>

<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
	<div class="contentpaneopen_edit<?php echo $this->escape($this->item->params->get( 'pageclass_sfx' )); ?>" style="float: left;">
		<?php echo JHTML::_('icon.edit', $this->item, $this->item->params, $this->access); ?>
	</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_url') && $this->item->urls) : ?>
	<span class="article-url">
		<a href="http://<?php echo $this->item->urls ; ?>" target="_blank">
			<?php echo $this->escape($this->item->urls); ?></a>
	</span>
<?php endif; ?>
</div>

<?php endif; ?>
<div class="article-content clearfix">
<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<?php echo $this->item->text; ?>
</div>

<?php if ( intval($this->item->modified) != 0 && $this->item->params->get('show_modify_date')) : ?>
	<span class="modifydate">
		<?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
	</span>
<?php endif; ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
	<a href="<?php echo $this->item->readmore_link; ?>" title="<?php echo $this->escape($this->item->title); ?>" class="readon<?php echo $this->escape($this->item->params->get('pageclass_sfx')); ?>">
	<?php if ($this->item->readmore_register) : ?>
		<span><?php echo JText::_('Register to read more...'); ?></span>
	<?php else : ?>
		<span><?php echo JText::_('Read more...'); ?></span>
	<?php endif; ?>
	</a>
<?php endif; ?>
</div>
<?php echo $this->item->event->afterDisplayContent; ?>