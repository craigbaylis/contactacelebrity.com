<?php 

/**
 * 
 * GK Joomla! Override by GavickPro
 * 
 * v.1.0.0
 * 
 */

/**
 *
 * CSS classes
 * 
 * .com_wrapper - selector for main container
 * .com_wrapper>h2.page_title - selector for page title
 * .com_wrapper>h2.page_title span - selector for span in page title 
 * .com_wrapper>iframe - selector for iframe
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

?>

<script language="javascript" type="text/javascript">
function iFrameHeight() {
	var h = 0;
	if ( !document.all ) {
		h = document.getElementById('blockrandom').contentDocument.height;
		document.getElementById('blockrandom').style.height = h + 60 + 'px';
	} else if( document.all ) {
		h = document.frames('blockrandom').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + 'px';
	}
}
</script>

<div class="com_wrapper content_main<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
	<?php if ( $this->params->get( 'show_page_title', 1 ) ) : ?>
	<h2 class="page_title">
		<span>
			<?php echo $this->escape($this->params->get( 'page_title' )); ?>
		</span>
	</h2>
	<?php endif; ?>
	
	<iframe <?php echo $this->wrapper->load; ?>
		id="blockrandom"
		name="iframe"
		src="<?php echo $this->wrapper->url; ?>"
		width="<?php echo $this->params->get( 'width' ); ?>"
		height="<?php echo $this->params->get( 'height' ); ?>"
		scrolling="<?php echo $this->params->get( 'scrolling' ); ?>"
		align="top"
		frameborder="0"
		class="wrapper<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo JText::_( 'NO_IFRAMES' ); ?>
	</iframe>
</div>