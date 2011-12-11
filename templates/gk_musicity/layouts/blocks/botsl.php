<?php

	$spotlight_b1 = array ('bottom1','bottom2','bottom3','bottom4','bottom5','bottom6');
	$spotlight_b2 = array ('bottom7','bottom8','bottom9','bottom10','bottom11','bottom12');
	$botsl1 = $this->calSpotlight ($spotlight_b1, 100);
	$botsl2 = $this->calSpotlight ($spotlight_b2, 100);	
	
	if( $botsl1 ) :

?>

<div id="gk-botsl1" class="clear gk-mass gk-bottom main">	
	<?php if( $this->countModules('bottom1') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl1['bottom1']['class']; ?>" style="width: <?php echo $botsl1['bottom1']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom1" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom2') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl1['bottom2']['class']; ?>" style="width: <?php echo $botsl1['bottom2']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom2" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom3') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl1['bottom3']['class']; ?>" style="width: <?php echo $botsl1['bottom3']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom3" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom4') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl1['bottom4']['class']; ?>" style="width: <?php echo $botsl1['bottom4']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom4" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom5') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl1['bottom5']['class']; ?>" style="width: <?php echo $botsl1['bottom5']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom5" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom6') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl1['bottom6']['class']; ?>" style="width: <?php echo $botsl1['bottom6']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom6" style="gavickpro" /></div>
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>

<?php if( $botsl2 ) : ?>
<div id="gk-botsl2" class="clearfix gk-mass gk-bottom main">	
	<?php if( $this->countModules('bottom7') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl2['bottom7']['class']; ?>" style="width: <?php echo $botsl2['bottom7']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom7" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom8') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl2['bottom8']['class']; ?>" style="width: <?php echo $botsl2['bottom8']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom8" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom9') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl2['bottom9']['class']; ?>" style="width: <?php echo $botsl2['bottom9']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom9" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom10') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl2['bottom10']['class']; ?>" style="width: <?php echo $botsl2['bottom10']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom10" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom11') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl2['bottom11']['class']; ?>" style="width: <?php echo $botsl2['bottom11']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom11" style="gavickpro" /></div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('bottom12') ): ?>
	<div class="gk-box column gk-box<?php echo $botsl2['bottom12']['class']; ?>" style="width: <?php echo $botsl2['bottom12']['width']; ?>;">
		<div><jdoc:include type="modules" name="bottom12" style="gavickpro" /></div>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>