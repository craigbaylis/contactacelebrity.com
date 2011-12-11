<br />
<div id="gk-footer" class="main clearfix">
	<?php $this->loadBlock('usertools/layout-switcher') ?>
	<a href="<?php echo $this->getCurrentURL();?>#Top" title="Back to Top"><strong>Top</strong></a> 
</div>

<div class="gk-breadcrumbs clearfix">
	<div><strong>You are here:</strong> <jdoc:include type="module" name="breadcrumbs" /></div>
</div>

<div class="gk-copyright">
	<?php echo $this->_tpl->params->get("footer_content"); ?>
</div>