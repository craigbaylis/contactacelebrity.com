<?php

	$h1_width = $h2_width = '';

	if($this->countModules('header1 and header2')) {
		$h1_width = ' style="width:' . $this->_tpl->params->get("header_column") . '%;float:left;"';
		$h2_width = ' style="width:' . (98 - $this->_tpl->params->get("header_column")) . '%;float:right;"';
	}

?>

<?php if( $this->countModules('banner1')) : ?>
<div id="banner1" class="clear clearfix">
      <jdoc:include type="modules" name="banner1" style="gavickpro" />
</div>
<?php endif; ?>
<?php if($this->countModules('header1 + header2')) : ?>
<div id="gk-header" class="normal clear">
	<?php if($this->countModules('header1')) : ?>	
	<div id="gk-header1"<?php echo $h1_width; ?>>
		<jdoc:include type="modules" name="header1" style="gavickpro" />
	</div>
	<?php endif; ?>	
	<?php if($this->countModules('header2')) : ?>	
	<div id="gk-header2"<?php echo $h2_width; ?>>
		<jdoc:include type="modules" name="header2" style="gavickpro" />
	</div>
	<?php endif; ?>
	<div class="clear"></div>	
</div>
<?php endif; ?>

