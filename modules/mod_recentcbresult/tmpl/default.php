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

<div class="gk_js_members_result" id="<?php echo $this->configresult['module_unique_id']; ?>" style="width:<?php echo $this->configresult['module_width']; ?>px;">

	<div class="gk_js_tabs">

		<div class="gk_js_tabs_wrap">

			<div class="gk_js_tab"><span><?php echo JText::_('POSTAL ADDRESS'); ?></span></div>

			<div class="gk_js_tab"><span><?php echo JText::_('EMAIL ADDRESS'); ?></span></div>

			<div class="gk_js_tab"><span><?php echo JText::_('WEBSITES'); ?></span></div>

		</div>

	</div>	



	<div class="gk_js_content" style="width:<?php echo $this->configresult['module_width']; ?>px;">

		<div class="gk_js_content_wrap">

		<?php 

			

			$keys = array_keys($this->contentresult);

			

			for($i = 0; $i < count($keys); $i++) : 

					

		?>

			<div class="gk_js_members">

				<div class="gk_js_members_scroll1" style="width:<?php echo $this->configresult['module_width']; ?>px;">		

					<div class="gk_js_members_scroll2">		

						<?php 

							$member_counter = 0;

							$total = count($this->contentresult[$keys[$i]]);

							foreach($this->contentresult[$keys[$i]] as $member) : 	

						?>			

						

							<?php if($member_counter % ($this->configresult['rowsresult'] * $this->configresult['colsresult']) == 0) : ?>

							<div class="gk_js_members_wrap" style="width:<?php echo $this->configresult['module_width']; ?>px;">

							<?php endif; ?>

							

						

							<div class="gk_js_member" style="width:<?php echo floor(($this->configresult['module_width']) / ($this->configresult['colsresult'])); ?>px;">

								<div class="gk_js_member_wrap">

									<?php if( $this->configresult['show_avatar'] ) : ?>
<?php
//get type
$db =& JFactory::getDBO();
if($member->company){
$gettype = "address";
$query = "SELECT * FROM (SELECT @row := @row +1 AS rownum, address_id FROM (SELECT @row :=0) r, #__celebrity_celebrity_address where celebrity_id = ".$member->celebrity_id.") ranked  WHERE address_id =".$member->address_id;
$db->setQuery($query);
$row = $db->loadAssoc();
$getnumber = ($row['rownum'] == "0" || $row['rownum'] == "1" || $row['rownum'] == "")?"1":$row['rownum']-1;
} 
if($member->email){
$gettype = "email";	
$query = "SELECT * FROM (SELECT @row := @row +1 AS rownum, id FROM (SELECT @row :=0) r, #__celebrity_email where celebrity_id = ".$member->celebrity_id.") ranked  WHERE id =".$member->address_id;
$db->setQuery($query);
$getnumber = ($row['rownum'] == "0" || $row['rownum'] == "1" || $row['rownum'] == "")?"1":$row['rownum']-3;

} 

if($member->url) {
$gettype = "website";	
$query = "SELECT * FROM (SELECT @row := @row +1 AS rownum, id FROM (SELECT @row :=0) r, #__celebrity_website where celebrity_id = ".$member->celebrity_id.") ranked WHERE id =".$member->address_id;
$db->setQuery($query);
$getnumber = ($row['rownum'] == "0" || $row['rownum'] == "1" || $row['rownum'] == "")?"1":$row['rownum']-3;

}
if(!$member->company && !$member->email && !$member->url){
$gettype="address";
$getnumber = ($row['rownum'] == "0" || $row['rownum'] == "1" || $row['rownum'] == "")?"1":$row['rownum']-1;

}
//echo $query;
//echo "<br>".$row['rownum'];

?>

									<a href="<?php echo JRoute::_('index.php?option=com_celebrity&task=details&view=result&id='.$member->id.'&cid='.$member->celebrity_id.'&aid='.$member->address_id.'&anumber='.$getnumber.'&type='.$gettype.'&Itemid=60');?>" class="gk_js_avatar">
<?php 
$filemember = array();
$filemember = explode("/",$member->filename);
$image_location = 'images/phocagallery/'.$filemember[0].'/'.$filemember[1].'/'.$filemember[2].'/Mailing Results/thumbs/phoca_thumb_m_'.end($filemember);
$file_path = JPATH_SITE.DS.str_replace('/', DS, $image_location);
if(!file_exists($file_path)){
$resultpath = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
} else {
$resultpath =$image_location;
}
?>
									
										

										<img src="<?php echo $resultpath; ?>" height="<?php echo $this->configresult['avatar_height']; ?>" width="<?php echo $this->configresult['avatar_width']; ?>"  alt="<?php echo $member->title; ?>" />

									</a>

									<?php endif; ?>

									

									<?php if( $this->configresult['show_name'] ) : ?>

									<div class="gk_js_member_name">

										<span><?php 
										$getname = str_replace($member->celebrity_id,'',str_replace("-"," ",$filemember[2]));
										echo substr($getname,0,20);
										//echo $getname;
										//echo substr($getname,0,20);
										
										
										//substr(str_replace('Mailing Result -','',$member->cat_title),0,20); //,0,20); ?></span>
                                        

									</div>

									<?php endif; ?>

									

									<?php if( $this->configresult['show_since'] ) : ?>

									<div class="gk_js_since">

										<span><?php echo JText::_('Posted On:'); ?></span>

										<span><?php echo date('m/d/Y',strtotime($member->datecreate)); ?></span>

									</div>	

									<?php endif; ?>

									

									<?php if( $this->configresult['show_lastonline'] ) : ?>

									<div class="gk_js_lastonline">

										<span><?php echo JText::_('Posted By:'); ?></span>

										<span><?php echo substr($member->username,0,8); ?>&nbsp;&nbsp;</span>

									</div>

									<?php endif; ?>

									

									<?php if( $this->configresult['show_views'] ) : ?>

									<div class="gk_js_profileviews">


										<?php /*?><span><?php echo JText::_('Caption:'); ?></span><?php */?>
										<span style="width:100%"><i><?php echo $member->title;?></i><?php //echo substr($member->title,0,15);?></span>


									</div>

									<?php endif; ?>
<div style="height:50px;">&nbsp;</div>
								</div>

							</div>

							

						<?php 

							

							$member_counter++;

							if($member_counter % $this->configresult['colsresult'] == 0) echo '<div class="clearfix"></div>';

							

						?>

						

						<?php 

								if(

									(($member_counter % ($this->configresult['rowsresult'] * $this->configresult['colsresult'])) == 0)

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

				<?php if($this->configresult['pagesresult'] > 1 && $total > ($this->configresult['rowsresult'] * $this->configresult['colsresult'])): ?>

				<div class="gk_js_interface">

					<div class="clearfix">

						<?php for($x = 0; $x < ceil($total / ($this->configresult['rowsresult'] * $this->configresult['colsresult']));$x++) : ?>

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

	$Gavick["gk_js_members-<?php echo $this->configresult['module_unique_id'];?>"] = {

		"animationType" : Fx.Transitions.<?php echo $this->configresult['animation'];?>,

		"animationSpeed" : <?php echo $this->configresult['anim_speed'];?>

	};

</script>