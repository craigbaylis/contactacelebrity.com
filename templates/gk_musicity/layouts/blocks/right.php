<?php 

	if (($r = $this->getColumnWidth('r'))): 
	$right_top = $this->getPositionName ('right-mass-top');
	$right_bottom = $this->getPositionName ('right-mass-bottom');
	
	$right1 = $this->getPositionName ('right1');
	$right2 = $this->getPositionName ('right2');
	
	$wright1 = $wright2 = 0;
		
	if($this->countModules($right1.' && '.$right2)){
		$wright1 = 100 - $this->getColumnBasedWidth ('right2');
		$wright2 = $this->getColumnBasedWidth ('right2');	
	}else{
		$wright1 = $wright2 = 100;
	}
	
?>

<div id="gk-right" class="column" style="width:<?php echo $r ?>%">
	<?php if ($this->countModules($right_top)): ?>
	<div class="gk-mass gk-mass-top clearfix">
		<jdoc:include type="modules" name="<?php echo $right_top; ?>" style="gavickpro" />
	</div>
	<?php endif; ?>

	<?php if ($this->countModules("$right1 + $right2")): ?>
	<div class="gk-colswrap gk-mass clearfix">

		<?php if ($this->countModules($right1)): ?>
		<div class="gk-col column" style="width:<?php echo $wright1; ?>%">
			<jdoc:include type="modules" name="<?php echo $right1;?>" style="gavickpro" />
		</div>
		<?php endif; ?>
		
		<?php if ($this->countModules($right2)): ?>
		<div class="gk-col column" style="width:<?php echo $wright2; ?>%">
			<div class="inner ctop cbottom <?php if (!$this->countModules($right1)): ?>cleft<?php endif; ?> cright">
				<jdoc:include type="modules" name="<?php echo $right2;?>" style="gavickpro" />
			</div>
		</div>
		<?php endif; ?>

	</div>
	<?php endif; ?>

	<?php if ($this->countModules($right_bottom)): ?>
	<div class="gk-mass-bottom clearfix">
		<jdoc:include type="modules" name="<?php echo $right_bottom;?>" style="gavickpro" />
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>