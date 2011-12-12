<!-- CONTENT -->

<?php 
	
	$right1   = $this->getPositionName ('right1');
	$right2 = $this->getPositionName ('right2');
	$right_mass_top = $this->getPositionName ('right-mass-top');
	$right_mass_bottom = $this->getPositionName ('right-mass-bottom');

	$left1   = $this->getPositionName ('left1');
	$left2 = $this->getPositionName ('left2');
	$left_mass_top = $this->getPositionName ('left-mass-top');
	$left_mass_bottom = $this->getPositionName ('left-mass-bottom');

    $class_main_bottom = '';
    
    $inset1 = $this->getPositionName ('inset1');
    $inset2 = $this->getPositionName ('inset2');    
    
    if($this->countModules($right1." + ".$right2." + ".$right_mass_top." + ".$right_mass_bottom) == 0 ) { 
        $class_main_bottom .= ' cright'; 
    }
    
?>

<div id="gk-main" style="width:<?php echo $this->getColumnWidth('m') ?>%">
     <div class="inner ctop cleft<?php echo $class_main_bottom; ?> cbottom">
          <?php 
		$mass_top    = $this->getPositionName ('content-mass-top');
		$mass_bottom = $this->getPositionName ('content-mass-bottom');
		$content_bottom = $this->getPositionName ('content-bottom');
		$content_top = $this->getPositionName ('content-top');
		
		if($this->countModules($mass_top)) : ?>
          <div class="gk-mass gk-mass-top clearfix">
               <jdoc:include type="modules" name="<?php echo $mass_top;?>" style="gavickpro" />
          </div>
          <?php endif; ?>
          <?php if($this->countModules($content_top) || $this->checkComponent() || $this->checkMainbody() || $this->countModules($content_bottom) || $this->countModules($inset1) || $this->countModules($inset2)) : ?>
          <div id="gk-contentwrap">
               <div id="gk-content" style="width:<?php echo $this->getColumnWidth('cw') ?>%">
                    <?php if($this->countModules($content_top) || $this->checkComponent() || $this->checkMainbody() || $this->countModules($content_bottom)) : ?>
                    <div id="gk-current-content" style="width:<?php echo $this->getColumnWidth('c') ?>%">
                         <?php
								 
							$class_main = '';
							if(!$this->countModules($right1." + ".$right2." + ".$right_mass_top." + ".$right_mass_bottom) && !$this->countModules($inset2)) $class_main .= ' cright';
							
					       ?>
					      
                         <?php if($this->countModules($mass_bottom) || $this->countModules($inset2)) : ?>  
                         <div class="inner cleft<?php if(!$this->countModules($inset2)) echo ' cright'; ?> cbottom ctop">
                         <?php endif; ?>
                          
                              <?php if($this->countModules($content_top)) : ?>
                              <div class="gk-content-top clearfix gk-mass">
                                    <jdoc:include type="modules" name="<?php echo $content_top;?>" style="gavickpro" />
                              </div>
                              <?php endif; ?>
                              <?php 		
								
							if($this->checkComponent() || $this->checkMainbody()) : 
						?>
							
							<?php if(($this->_tpl->params->get('mainbody_pos') == 1 && $this->checkMainbody()) || ($this->_tpl->params->get('mainbody_pos') == 2 && $this->checkMainbody()) ) : ?>
							<div id="mainbody">
							     <jdoc:include type="modules" name="mainbody" style="gavickpro" />
							</div>
							<?php endif; ?>
							
							
							<?php if(($this->_tpl->params->get('mainbody_pos') == 1 && !$this->checkMainbody()) || $this->_tpl->params->get('mainbody_pos') != 1) : ?>
							
							<div <?php if(!JRequest::getCmd('searchword') && JRequest::getCmd('task') != "details"){?>id="gk-current-content-wrap" <?php }?> class="gk-mass">
							      <?php if($this->countModules('breadcrumb') || $this->getTools()) : ?>
	                              <div id="gk-top-nav" class="clear gk-mass clearfix">
	                            	<?php if($this->countModules('breadcrumb')) : ?>
	                            	<div id="gk-breadcrumb">
	                            		<?php if($this->countModules('breadcrumb')) : ?>
	                            		<jdoc:include type="modules" name="breadcrumb" style="none" />
	                            		<?php endif; ?>
	                            	</div>
	                            	<?php endif; ?>
	                            	<div id="component-header"></div>
	                            	<?php if($this->getTools()) : ?>
	                            	<div id="gk-tools">
	                            		<?php $this->loadBlock('usertools/tools') ?>
	                            	</div>
	                            	<?php endif; ?>
	                              </div>
	                              <?php endif; ?>
							
	                              <div id="component_wrap" class="clearfix <?php if(!($this->countModules('breadcrumb') || $this->getTools())) : ?>gk-mass <?php endif; ?>clear<?php echo ($_GET['option'] === 'com_k2') ? ' k2' : ''; ?><?php echo ($_GET['option'] === 'com_community') ? ' jomsocial' : ''; ?>">
										<div>
		                                    <?php if($this->_tpl->params->get('mainbody_pos') == 0) : ?>
		                                    <div id="component" class="clear">
		                                         <jdoc:include type="component" />
		                                    </div>
		                                    <?php elseif($this->_tpl->params->get('mainbody_pos') == 1) : ?>
		                                   
			                                    <?php if(!$this->checkMainbody() && $this->checkComponent()) : ?>
			                                    <div id="component" class="clear">
			                                         <jdoc:include type="component" />
			                                    </div>
			                                    <?php endif; ?>
		                                    <?php elseif($this->_tpl->params->get('mainbody_pos') == 2) : ?>
		                                    	<?php if($this->checkComponent()) : ?>
		                                    	<div id="component" class="clear">
		                                    	     <jdoc:include type="component" />
		                                    	</div>
		                                    	<?php endif; ?>
		                                    <?php else : ?>
			                                    <?php if($this->checkComponent()) : ?>
			                                    <div id="component" class="clear">
			                                         <jdoc:include type="component" />
			                                    </div>
			                                    <?php endif; ?>
		                                    <?php endif; ?>
	                                    </div>    
	                              </div>
	                          </div>    
                              <?php endif; ?>
                              <?php endif; ?>
                              
                              <?php if($this->_tpl->params->get('mainbody_pos') == 3 && $this->checkMainbody()) : ?>
                              <div id="mainbody" class="clear">
                                   <jdoc:include type="modules" name="mainbody" style="gavickpro" />
                              </div>
                              <?php endif; ?>
                              
                              
                              
                              
							  <?php if($this->countModules($content_bottom)) : ?>
                              <div class="gk-content-bottom clearfix gk-mass">
                                    <jdoc:include type="modules" name="<?php echo $content_bottom;?>" style="gavickpro" />
                              </div>
                              <?php endif; ?>
                              
                         <?php if($this->countModules($mass_bottom) || $this->countModules($inset2)) : ?>  
                         </div>
                         <?php endif; ?>
                         
                    </div>
                    <?php endif; ?>
                    <?php 
					if($this->countModules($inset1)) : 
				?>
                    <div class="gk-col column gk-inset1" style="width:<?php echo $this->getColumnWidth('i1') ?>%">
                         <div class="inner ctop cbottom cleft">
                              <jdoc:include type="modules" name="<?php echo $inset1;?>" style="gavickpro" />
                         </div>
                    </div>
                    <?php endif; ?>
               </div>
               <?php 
				if($this->countModules($inset2)) : 
			?>
               <div class="gk-col column gk-inset2" style="width:<?php echo $this->getColumnWidth('i2') ?>%">
                    <jdoc:include type="modules" name="<?php echo $inset2;?>" style="gavickpro" />
               </div>
               <?php endif; ?>
          </div>
          <?php endif; ?>
          
          <?php 
			if($this->countModules($mass_bottom)) : ?>
          	<div class="gk-mass gk-mass-bottom clearfix clear">
 		         <jdoc:include type="modules" name="<?php echo $mass_bottom;?>" style="gavickpro" />
  			</div>
    	<?php endif; ?>
     </div>
</div>
<!-- //CONTENT -->