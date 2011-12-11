<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
	
?>

<div id="gk-nav" class="main clear">
      <div id="gk-mainnav">
            <?php if (($gkmenu = $this->loadMenu())) $gkmenu->genMenu ($this->getParam('startlevel',0), $this->getParam('endlevel',-1)); ?>
      </div>
</div>
<?php if ($this->hasSubmenu() && ($gkmenu = $this->loadMenu())) : ?>
<div id="gk-subnav" class="main clear">
      <?php $gkmenu->genMenu(1); ?>
</div>
<?php endif;?>
<ul class="no-display">
      <li>
            <a href="<?php echo $this->getCurrentURL();?>#gk-content" title="<?php echo JText::_("Skip to content");?>"><?php echo JText::_("Skip to content");?></a>
      </li>
</ul>

<?php if($this->countModules('info + search')) : ?>
<div id="gk-nav-bottom" class="main clear">
	<?php if($this->countModules('search')) : ?>
	<div id="gk-search">
		<jdoc:include type="modules" name="search" style="none" />
	</div>
	<?php endif; ?>
	<?php if($this->countModules('info')) : ?>
	<div id="gk-info">
		<jdoc:include type="modules" name="info" style="xhtml" />
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>
