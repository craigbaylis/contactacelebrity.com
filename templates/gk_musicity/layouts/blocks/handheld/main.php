<div id="gk-main" class="main clearfix">

	<jdoc:include type="message" />

	<div id="gk-current-content" class="column">
		<?php 
		$content_top = $this->getPositionName ('content-top');
		if($this->countModules($content_top)) : ?>
		<div class="gk-content-top clearfix">
			<jdoc:include type="modules" name="<?php echo $content_top;?>" />
		</div>
		<?php endif; ?>

		<div class="gk-content-main clearfix">
			<jdoc:include type="component" />
		</div>

		<?php 
		$content_bottom = $this->getPositionName ('content-bottom');
		if($this->countModules($content_bottom)) : ?>
		<div class="gk-content-bottom clearfix">
			<jdoc:include type="modules" name="<?php echo $content_bottom;?>" style="raw" />
		</div>
		<?php endif; ?>
	</div>

</div>