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


?>


<div class="rightColumn_width300">
	<h1 id="topSigner">Top Celebrity Signers!<img id="topTen" src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>top10.png" alt="top10" width="35" height="35" /></h1>

<div class="gk_js_members_main" id="<?php echo $this->config['module_unique_id']; ?>" style="width:<?php echo $this->config['module_width']; ?>px;margin-top:5px;">

	<div class="gk_js_tabs">

		<div class="gk_js_tabs_wrap">

			<div class="gk_js_tab"><span>&nbsp;<?php echo JText::_('THIS MONTH'); ?>&nbsp;</span></div>

			<div class="gk_js_tab"><span>&nbsp;<?php echo JText::_('THIS YEAR'); ?>&nbsp;</span></div>

			<div class="gk_js_tab"><span>&nbsp;<?php echo JText::_('ALL TIME'); ?>&nbsp;</span></div>

		</div>

	</div>	



	<div class="gk_js_content" style="width:<?php echo $this->config['module_width']; ?>px;">

		<div class="gk_js_content_wrap">

		<?php 

			

			$keys = array_keys($this->content);

			

			for($i = 0; $i < count($keys); $i++) : 

					

		?>

			<div class="gk_js_members">

				<div class="gk_js_members_scroll1" style="width:<?php echo $this->config['module_width']; ?>px;">		

					<div class="gk_js_members_scroll2">		

						<?php 

							$member_counter = 0;

							$total = count($this->content[$keys[$i]]);
$k=1;

							foreach($this->content[$keys[$i]] as $member) : 	

						?>			

						

							<?php if($member_counter % ($this->config['rows'] * $this->config['cols']) == 0) : ?>

							<div class="gk_js_members_wrap" style="width:<?php echo $this->config['module_width']; ?>px;">

							<?php endif; ?>

							

						

							<div class="gk_js_member" style="width:<?php echo floor(($this->config['module_width']) / ($this->config['cols'])); ?>px;">

								<div class="gk_js_member_wrap">

									<?php if( $this->config['show_avatar'] ) : ?>

									<a href="<?php echo JRoute::_('index.php?option=com_community&amp;view=profile&amp;userid='.$member->id);?>" class="gk_js_avatar">

										<?php 

											$user =& CFactory::getUser($member->id);

											$avatarUrl = ($this->config['avatar_size'] == 'thumb') ? $user->getThumbAvatar() : $user->getAvatar();

										?>

										

										<img src="<?php echo $avatarUrl; ?>" height="<?php echo $this->config['avatar_height']; ?>" alt="<?php echo $member->name; ?>" />

									</a>

									<?php endif; ?>

									

									<?php if( $this->config['show_name'] ) : ?>
<ul id="topSignerList">
		<li><?php echo $k++;?>. <?php echo substr($member->name,0,15)?> <a class="viewButton" href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$member->id.'&Itemid=60');?>">View</a></li>
	</ul>

								<!--	<div class="gk_js_member_name">

										<span><?php //echo $member->name; ?></span>

									</div>-->

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

									<?php endif; ?>

								</div>

							</div>

							

						<?php 

							

							$member_counter++;

							if($member_counter % $this->config['cols'] == 0) echo '<div class="clearfix"></div>';

							

						?>

						

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
</div>
<script type="text/javascript">

	try{$Gavick;}catch(e){$Gavick = {};}

	$Gavick["gk_js_members-<?php echo $this->config['module_unique_id'];?>"] = {

		"animationType" : Fx.Transitions.<?php echo $this->config['animation'];?>,

		"animationSpeed" : <?php echo $this->config['anim_speed'];?>

	};

</script>