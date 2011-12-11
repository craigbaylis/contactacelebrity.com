<?php

	$spotlight_t1 = array ('top1','top2','top3','top4','top5','top6');
	$spotlight_t2 = array ('top7','top8','top9','top10','top11','top12');
	$topsl1 = $this->calSpotlight ($spotlight_t1, 100);
	$topsl2 = $this->calSpotlight ($spotlight_t2, 100);	
	
	if( $topsl1 ) :

?>

<div id="gk-topsl1" class="clearfix gk-top">	
	<?php if( $this->countModules('top1') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl1['top1']['class']; ?>" style="width: <?php echo $topsl1['top1']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top1" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top2') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl1['top2']['class']; ?>" style="width: <?php echo $topsl1['top2']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top2" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top3') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl1['top3']['class']; ?>" style="width: <?php echo $topsl1['top3']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top3" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top4') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl1['top4']['class']; ?>" style="width: <?php echo $topsl1['top4']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top4" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top5') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl1['top5']['class']; ?>" style="width: <?php echo $topsl1['top5']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top5" style="gavickpro" />
		</div>	
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top6') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl1['top6']['class']; ?>" style="width: <?php echo $topsl1['top6']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top6" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>

<?php if( $topsl2 ) : ?>
<div id="gk-topsl2" class="clearfix gk-top">	
	<?php if( $this->countModules('top7') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl2['top7']['class']; ?>" style="width: <?php echo $topsl2['top7']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top7" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top8') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl2['top8']['class']; ?>" style="width: <?php echo $topsl2['top8']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top8" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top9') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl2['top9']['class']; ?>" style="width: <?php echo $topsl2['top9']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top9" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top10') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl2['top10']['class']; ?>" style="width: <?php echo $topsl2['top10']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top10" style="gavickpro" />
		</div>	
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top11') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl2['top11']['class']; ?>" style="width: <?php echo $topsl2['top11']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top11" style="gavickpro" />
		</div>	
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('top12') ): ?>
	<div class="gk-box column gk-box<?php echo $topsl2['top12']['class']; ?>" style="width: <?php echo $topsl2['top12']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="top12" style="gavickpro" />
		</div>	
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>