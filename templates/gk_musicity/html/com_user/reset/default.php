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

<?php if($this->params->get('show_page_title',1)) : ?>

<h1 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')) ?>">

	<span><?php echo $this->escape($this->params->get('page_title')) ?></span>

</h1>

<?php endif; ?>



<form action="<?php echo JRoute::_( 'index.php?option=com_user&task=requestreset' ); ?>" method="post" class="josForm form-validate">

	<p><?php echo JText::_('RESET_PASSWORD_REQUEST_DESCRIPTION'); ?></p>

<p class="remind_1">

	<label for="email" class="hasTip left" title="<?php echo JText::_('RESET_PASSWORD_EMAIL_TIP_TITLE'); ?>::<?php echo JText::_('RESET_PASSWORD_EMAIL_TIP_TEXT'); ?>"><?php echo JText::_('Email Address'); ?>:</label>

	<input id="email" name="email" type="text" class="inputbox required validate-email left" />



	<button type="submit" class="button validate remind_2"><?php echo JText::_('Submit'); ?></button></p>

	<?php echo JHTML::_( 'form.token' ); ?>

</form>

