<?php 
	
	if (($l = $this->getColumnWidth('l'))): 
	
	$left_top = $this->getPositionName ('left-mass-top');
	$left_bottom = $this->getPositionName ('left-mass-bottom');
	
	$left1 = $this->getPositionName ('left1');
	$left2 = $this->getPositionName ('left2');
	
	$wleft1 = $wleft2 = 0;
		
	if($this->countModules($left1.' && '.$left2)){
		$wleft1 = 100 - $this->getColumnBasedWidth ('left2');
		$wleft2 = $this->getColumnBasedWidth ('left2');	
	}else{
		$wleft1 = $wleft2 = 100;
	}

?>
<div id="gk-left" class="column" style="width:<?php echo $l ?>%">
    <div class="inner cleft ctop cbottom">
    	<?php if ($this->countModules($left_top)): ?>
    	<div class="gk-mass gk-mass-top clearfix">
    		<jdoc:include type="modules" name="<?php echo $left_top;?>" style="gavickpro" />
    	</div>
    	<?php endif; ?>
    	
    	<?php if ($this->countModules("$left1 + $left2")): ?>
    	<div class="gk-colswrap gk-mass clearfix">
    		
    		<?php if ($this->countModules($left1)): ?>
    		<div class="gk-col column" style="width:<?php echo $wleft1; ?>%">
    			<?php if($this->countModules($left2)) : ?>
                <div class="inner ctop cleft cbottom">
                <?php endif; ?>
    				<jdoc:include type="modules" name="<?php echo $left1;?>" style="gavickpro" />
    			<?php if($this->countModules($left2)) : ?>
                </div>
                <?php endif; ?>	
    		</div>
    		<?php endif; ?>
    		
    		<?php if ($this->countModules($left2)): ?>
    		<div class="gk-col column" style="width:<?php echo $wleft2; ?>%">
  				<jdoc:include type="modules" name="<?php echo $left2;?>" style="gavickpro" />
    		</div>
    		<?php endif; ?>
    		
    	</div>
    	<?php endif; ?>
    	
    	<?php if ($this->countModules($left_bottom)): ?>
    	<div class="gk-mass-bottom clearfix">
    		<jdoc:include type="modules" name="<?php echo $left_bottom;?>" style="gavickpro" />
    	</div>
    	<?php endif; ?>
	</div>
</div>
<?php endif; ?>