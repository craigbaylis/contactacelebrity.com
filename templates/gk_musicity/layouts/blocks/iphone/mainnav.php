<div id="gk-mainnav" class="main clearfix">
	<div id="gk-toolbar-top">
		<a class="toggle ip-button button-menu" href="#gk-iphonemenu" title="Menu"><span>Menu</span></a>
		
		<?php if($this->countModules('search')) : ?>		
		<a class="toggle ip-button button-search" href="#gk-search" title="Search">Search</a>
		<?php endif; ?>

		<a class="toggle ip-button button-login" href="#gk-login" title="Login">Login</a>
		
		<?php
			//if (!($mobile = $this->mobile_device_detect())) return; 
			$handheld_view = $this->getParam('ui');
			$switch_to = $handheld_view=='desktop'?'default':'desktop';
			$text = $handheld_view=='desktop'?'Mobile Version':'Desktop Version';
		?>

		<a class="gk-tool-switchlayout toggle ip-button button-switchlayout" href="<?php echo JURI::base()?>?ui=<?php echo $switch_to?>" onclick="return confirm('<?php echo JText::_('Switch to standard mode confirmation')?>');" title="<?php echo JText::_($text)?>" ><span><?php echo JText::_($text)?></span></a>

	</div>

	<div id="gk-toolbar-main">
		<div id="gk-toolbar-wrap">
	
			<div id="gk-toolbar-title">
				<a class="ip-button button-back" href="#" id="toolbar-back" title=""><span>Back</span></a>
				<a class="ip-button button-close" href="#" id="toolbar-close" title=""><span>Close</span></a>
			</div>
	
			<div id="menu">
			<?php if (($gkmenu = $this->loadMenu())) $gkmenu->genMenu (0,0); ?>
			</div>
			
			<?php if($this->countModules('search')) : ?>
			<div id="gk-search" title="Search" class="toolbox">
				<jdoc:include type="module" name="search" />
			</div>
			<?php endif; ?>
			
			<div id="gk-login" title="Login" class="toolbox">
				<jdoc:include type="module" name="login" />
			</div>
		</div>
	</div>

</div>
<div id="gk-overlay">&nbsp;</div>