<?php

	$spotlight_u1 = array ('user1','user2','user3','user4','user5','user6');
	$spotlight_u2 = array ('user7','user8','user9','user10','user11','user12');
	$usersl1 = $this->calSpotlight ($spotlight_u1, 100);
	$usersl2 = $this->calSpotlight ($spotlight_u2, 100);	
	
	if( $usersl1 ) :

?>

<div id="gk-usersl1" class="clearfix gk-mass gk-user">	
	<?php if( $this->countModules('user1') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl1['user1']['class']; ?>" style="width: <?php echo $usersl1['user1']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user1" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user2') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl1['user2']['class']; ?>" style="width: <?php echo $usersl1['user2']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user2" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user3') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl1['user3']['class']; ?>" style="width: <?php echo $usersl1['user3']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user3" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user4') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl1['user4']['class']; ?>" style="width: <?php echo $usersl1['user4']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user4" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user5') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl1['user5']['class']; ?>" style="width: <?php echo $usersl1['user5']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user5" style="gavickpro" />
		</div>	
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user6') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl1['user6']['class']; ?>" style="width: <?php echo $usersl1['user6']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user6" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>

<?php if( $usersl2 ) : ?>
<div id="gk-usersl2" class="clearfix gk-mass gk-user">	
	<?php if( $this->countModules('user7') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl2['user7']['class']; ?>" style="width: <?php echo $usersl2['user7']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user7" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user8') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl2['user8']['class']; ?>" style="width: <?php echo $usersl2['user8']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user8" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user9') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl2['user9']['class']; ?>" style="width: <?php echo $usersl2['user9']['width']; ?>;">
		<div class="gk-box-wrap">	
			<jdoc:include type="modules" name="user9" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user10') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl2['user10']['class']; ?>" style="width: <?php echo $usersl2['user10']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user10" style="gavickpro" />
		</div>	
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user11') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl2['user11']['class']; ?>" style="width: <?php echo $usersl2['user11']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user11" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>

	<?php if( $this->countModules('user12') ): ?>
	<div class="gk-box column gk-box<?php echo $usersl2['user12']['class']; ?>" style="width: <?php echo $usersl2['user12']['width']; ?>;">
		<div class="gk-box-wrap">
			<jdoc:include type="modules" name="user12" style="gavickpro" />
		</div>
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>