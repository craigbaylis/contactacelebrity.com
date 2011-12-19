<?php



/**

* Gavick GK JS Members - layout

* @package Joomla!

* @Copyright (C) 2009 Gavick.com

* @ All rights reserved

* @ Joomla! is Free Software

* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html

* @version $Revision: 1.0.1 $

**/



// no direct access

defined('_JEXEC') or die('Restricted access');

//get user
//$user =& JFactory::getUser();
//$getuser=$user->get('id');			

?>
<div class="gk_js_members_main" id="<?php echo $this->config['module_unique_id']; ?>" style="width:<?php echo $this->config['module_width']; ?>px;">

	<div class="gk_js_tabs">

		<div class="gk_js_tabs_wrap">

			<div class="gk_js_tab"><span><?php echo JText::_('POSTAL ADDRESSES'); ?></span></div>

			<div class="gk_js_tab"><span><?php echo JText::_('EMAIL ADDRESSES'); ?></span></div>

			<div class="gk_js_tab"><span><?php echo JText::_('WEBSITES'); ?></span></div>

		</div>

	</div>	

<div>
</div>

	<div class="gk_js_content" style="width:<?php echo $this->config['module_width']; ?>px;">

		<div class="gk_js_content_wrap">

		<?php 

			

			$keys = array_keys($this->content);
			for($i = 0; $i < count($keys); $i++) :
		?>

			<div class="gk_js_members" >

				<div class="gk_js_members_scroll1" style="width:<?php echo $this->config['module_width']; ?>px;">		

					<div class="gk_js_members_scroll2">		

						<?php 

							$member_counter = 0;

							$total = count($this->content[$keys[$i]]);
							
							if($total==0){
							if($keys[$i] == "newest"){
								?>								
                        <div class="noRightBorder" id="addAnotherAddress">
<a href="<?php echo JURI::base();?>index.php?option=com_celebrity&task=add&controller=address&cid=<?php echo $_GET['cid'];?>&Itemid=61"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
</div>
<?php } else {?>
                        <div class="noRightBorder" id="addAnotherAddress">
<a href="<?php echo JURI::base();?>index.php?option=com_celebrity&task=add&controller=address&cid=<?php echo $_GET['cid'];?>&Itemid=61"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
</div>
<?php }?>
							
                          <!-- div.individualAddress close -->
                            <?php
							}else{
$j=1;


							foreach($this->content[$keys[$i]] as $member) : 
							
						?>			

						

							<?php if($member_counter % ($this->config['rows'] * $this->config['cols']) == 0) : ?>

							<div class="gk_js_members_wrap" style="width:<?php echo $this->config['module_width']; ?>px;">

							<?php endif; ?>
							<div class="gk_js_member" style="width:<?php echo floor(($this->config['module_width']) / ($this->config['cols'])); ?>px; border-bottom:1px solid #000;">
								<div class="gk_js_member_wrap">

									
									
									<?php /*?><?php if( $this->config['show_avatar'] ) : ?>

									<a href="index.php?option=com_community&amp;view=profile&amp;userid=<?php echo $member->id; ?>" class="gk_js_avatar">

										<?php 

											$user =& CFactory::getUser($member->id);

											$avatarUrl = ($this->config['avatar_size'] == 'thumb') ? $user->getThumbAvatar() : $user->getAvatar();
										?>
										<img src="<?php echo $avatarUrl; ?>" height="<?php echo $this->config['avatar_height']; ?>" alt="<?php echo $member->name; ?>" />

									</a>

									<?php endif; ?>
<?php */?>
 <?php if($member->name ||  $member->email ||  $member->url ){?>
									   <div class="individualAddress" <?php /*?><?php if($member->email || $member->url){?>style="height:70px"<?php }?><?php */?>>
                                              <ul>
                                              <?php if($member->name){?>
                                                <li class="addressTitle"><?php echo JText::_('Address').''. $j++;?>
                                                </li>
                                                <?php }?>
                                                 <?php if($member->email){?>
                                                <li class="addressTitle"><?php echo JText::_('Email Address').''. $j++;?>
                                                </li>
                                                <?php }?>
                                                 <?php if($member->url){?>
                                                <li class="addressTitle"><?php echo JText::_('Web Address').''. $j++;?>
                                                </li>
                                                <?php }?>
                                                
                                                 <?php if($member->name){
													 ?>
                                                <li class="viewDetail"><a href="#"></a></li>
                                                <?php } ?>
                                               <?php if($member->name){?>
                                                <li class="addressLine1">
												<?php echo ($member->company=="")?$member->name:$member->company;?>
                                                 </li>
                                                 <?php }?>
                                                      <?php if($member->email){?>
                                                  <li>&nbsp;</li>
                                                    <li>&nbsp;</li>
                                                <li class="addressLine1">
												<?php echo $member->email;?>
                                                 </li>
                                               
                                               
                                                 <li>&nbsp;</li>
                                                 <li>&nbsp;</li>
                                                 <li>&nbsp;</li>
                                                 <?php }?>
                                                      <?php if($member->url){?>
                                                       <li>&nbsp;</li>
                                                    <li>&nbsp;</li>
                                                <li class="addressLine1">
												<?php echo $member->url;?>
                                                 </li>
                                                 <?php }?>
									
												
                                                 <?php if($member->name){
													 ?>
                                                <li class="addressLine2"><?php
												$user =& CFactory::getUser($member->id);
												echo ($user->get('id')) ? $member->line_1 : substr($member->line_1,0,4).' ****' ?></li>
                                                <li class="city_state_zip"><?php echo $member->city.', '.$member->state.' '.$member->zipcode ?></li>
                                                <li class="submission">Submitted by: <a href="index.php?option=com_community&view=profile&userid=<?php echo $member->created_by_uid;?>&Itemid=41"><?php echo $member->username;?></a></li>
                                      <li class="success"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/success_check.png" alt="success" title="success"/>Success  <img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/success_green.png" alt="successNumber" title="successNumber"><a class="green" href="#"><?php echo (!empty($successCounts[$key]->total_success)) ? $successCounts[$key]->total_success : '0' ?></a><a class="red" href="#"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/unsuccess_red.png" alt="unsuccessNumber" title="unsuccessNumber"/><?php echo (!empty($returnedCounts[$key]->total_returned)) ? $returnedCounts[$key]->total_returned : '0' ?></a></li>  
                                      <?php
										}
									  ?>
									</ul>
                                       
										</div> 
                                      <?php }?>
                                       	

									<?php /*?><?php if( $this->config['show_name'] ) : ?>

									<div class="gk_js_member_name">

										<span><?php if($member->company){
											 echo $member->company;
											 
									      }
										 if($member->email){ echo $member->email;}
										 if($member->url){ echo $member->url;}; ?></span>

									</div>

									<?php endif; ?>

									

									<?php if( $this->config['show_since'] ) : ?>

									<div class="gk_js_since">

										<span><?php echo JText::_('MEMBER_SINCE'); ?></span>

										<span><?php echo date('d.m.y',strtotime($member->registerDate)); ?></span>

									</div>	

									<?php endif; ?>

									

									<?php if( $this->config['show_lastonline'] ) : ?>

									<div class="gk_js_lastonline">

										<span><?php echo JText::_('LAST_ONLINE'); ?></span>

										<span><?php echo (strtotime($member->lastvisitDate) == 0) ? JText::_('NEVER') : date('d.m.y h:i',strtotime($member->lastvisitDate)); ?></span>

									</div>

									<?php endif; ?>

									

									<?php if( $this->config['show_views'] ) : ?>

									<div class="gk_js_profileviews">

										<span><?php echo JText::_('PROFILE_VIEWS'); ?></span>
										<span><?php echo $member->_view; ?></span>

									</div>

									<?php endif; ?><?php */?>

								</div>

							</div>
  						
		<?php 
							$member_counter++;
							if($member_counter % $this->config['cols'] == 0) echo '<div class="clearfix"></div>';

				
						?>

						<?php
						//check a session user.
						$getuser =$_SESSION[__default][user]->id;
						
						//personal address
						 if($member->name && $member_counter==$total){?>
                        <div class="noRightBorder" id="addAnotherAddress">
                        <?php if($getuser == "0"){?>
                        <a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
                        <?php } else {?>
<a href="<?php echo JURI::base();?>index.php?option=com_celebrity&task=add&controller=address&cid=<?php echo $_GET['cid'];?>&Itemid=61"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
<?php }?>
</div>

<?php }?>
<?php
//email address
 if($member->email && $member_counter==$total){?>
                        <div class="noRightBorder" id="addAnotherAddress">
                          <?php if($getuser == "0"){?>
                        <a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
                        <?php } else {?>
<a href="<?php echo JURI::base();?>index.php?option=com_celebrity&task=add&controller=address&cid=<?php echo $_GET['cid'];?>&Itemid=61"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="113" height="133" /></a>
<?php }?>
</div><?php }?>
<?php
//website address
 if($member->url && $member_counter==$total){?>
                        <div class="noRightBorder" id="addAnotherAddress">
                          <?php if($getuser == "0"){?>
                        <a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
                        <?php } else {?>
<a href="<?php echo JURI::base();?>index.php?option=com_celebrity&task=add&controller=address&cid=<?php echo $_GET['cid'];?>&Itemid=61"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/addNewAddress_box.png" alt="addNewAddress_box" title="Have another address? Add it here!" width="114" height="133" /></a>
<?php }?>
</div><?php }?>


						<?php 

								if(

									(($member_counter % ($this->config['rows'] * $this->config['cols'])) == 0)

									||

									($member_counter == $total)

								) : 

						?>

						

						</div>

						

						<?php 

							endif; 

							endforeach; 
							?>
                          
							<?php
							}
						?>
				</div>
				</div>
				<?php if($this->config['pages'] > 1 && $total > ($this->config['rows'] * $this->config['cols'])): ?>
				<div class="gk_js_interface">
					<div class="clearfix">
						<?php for($x = 0; $x < ceil($total / ($this->config['rows'] * $this->config['cols']));$x++) : ?>
						<span class="gk_js_page"><?php echo $x+1; ?></span>
						<?php endfor; ?>
						<span class="gk_js_prev">&laquo;</span>
						<span class="gk_js_next">&raquo;</span>
					</div>
				</div>	
                <?php endif; ?>		

			</div>
			<?php endfor; ?>

			<div class="gk_js_overlay"></div>

		</div>	

	</div>		

</div>

<script type="text/javascript">

	try{$Gavick;}catch(e){$Gavick = {};}

	$Gavick["gk_js_members-<?php echo $this->config['module_unique_id'];?>"] = {

		"animationType" : Fx.Transitions.<?php echo $this->config['animation'];?>,

		"animationSpeed" : <?php echo $this->config['anim_speed'];?>

	};

</script>