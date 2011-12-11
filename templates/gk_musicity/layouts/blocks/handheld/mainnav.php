<div id="gk-mainnav" class="main clearfix">
    <div class="imenu">
    <?php if (($gkmenu = $this->loadMenu())) $gkmenu->genMenu (0, 0); ?>
    </div>

	<a id="login-btn" href="index.php?option=com_user&amp;view=login"><?php echo JText::_('LOGIN'); ?></a>
	
	<?php if($this->countModules('search')) : ?>
	<div id="gk-search">
		<jdoc:include type="modules" name="search" />
	</div>
	<?php endif; ?>
</div>