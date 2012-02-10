<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 

?>

<style>

#mainPage .moduletable{

	background-color:transparent;

	margin:0px;

}

#mainPage .moduletable_content{

padding:0px;	

}

#mainPage .moduletable > div{

	margin:0px;

}

.newAddress ul li {

    line-height: 1;

}
.forumPost ul li {

    line-height: 1;

}

</style>



<div class="width240">	

		<h1 id="details">New Addresses</h1>

<?php

foreach($newaddress as $getaddress){

?>

			<div class="newAddress">

				<ul>

					<li class="celebrityName"><?php echo substr($getaddress[0],0,5);?></li>

					<li class="address1"><?php echo substr($getaddress[1],0,15);?></li>

					<li class="address2"><?php echo $getaddress[6];?>, <?php echo $getaddress[5];?> <?php echo $getaddress[7];?></li>

				</ul>

				<a class="viewDetailButton" href="<?php echo JRoute::_('index.php?option=com_celebrity&view=address&task=details&type=address&aid='.$getaddress[9].'&cid='.$getaddress[8].'&anumber=1&Itemid=60');?>">View Detail</a>

				

			</div><!-- .newAddress close -->

<?php }?>		



			

		</div>

        		<div class="width240">

			<h1 id="details">Member Activity</h1>

            <?php

foreach($memberactivity as $getmember){

?>

			<div class="forumPost">

             <?php if($getmember[2] && file_exists($getmember[2])):

			 ?> 

                            

 <img src="<?php echo JURI::base();?><?php echo $getmember[2];?>" class="avatar" alt="greenStar" width="72" height="71" />                <?php else:?>

                 <img class="avatar" src="<?php echo JURI::base();?>components/com_community/assets/user_thumb.png" alt="avatar1" width="72" height="71" />

                <?php endif;?>

			<ul>

				<li class="postedBy">Posted by <a href="<?php echo JRoute::_('index.php?option=com_community&view=profile&userid='.$getmember[5].'&Itemid=20');?>"><?php echo $getmember[3];?></a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>

				<li class="postingDate"><?php echo $getmember[4];?></li>

				<li class="commentText"><p><?php 

				$describe = str_replace('{actor}',$getmember[3],$getmember[0]);

				 echo str_replace('{target}',$getmember[6],$describe);?></p></li>

			</ul>

			</div><!-- .forumPost close -->

			<?php }?>

			<!-- .forumPost close -->

		

		</div><!-- div.width240 close -->





		<div class="width240">

		<h1 id="details">Hottest Celebs</h1>

		<?php foreach($hotestceleb as $hottest){

		$getpath = array();

		$getpath = explode("/",$hottest[1]);

		$celebimage = end($getpath);

		?>

		<div class="hottestCelebList">
<!--index.php?option=com_phocagallery&view=gallery&task=galleryview&id=<?php //echo $hottest[3];?>&Itemid=65&cid=<?php //echo $hottest[4];?>-->
		<a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$hottest[4].'&Itemid=60');?>" class="celebrity">

		<img src="<?php echo JURI::base();?>images/phocagallery/<?php echo str_replace('\\','/',$hottest[2]);?>/thumbs/phoca_thumb_s_<?php echo $celebimage;?>" alt="benicioDelToro" width="50" height="50" />

		<p class="hotCelebName"><?php echo substr($hottest[0],0,4);?></p>

		</a>

		</div><!--hottestCelebList -->

		<?php }?>
<div style="height:330px;*height:100px;"><!--ie7 css hack--></div>
	<!--hottestCelebList -->

		

		</div><!-- div.width240 close -->

		

		

		

		

		<div class="width240_noMargin">

		<h1 id="details">C.A.C News</h1>

		<?php /*?><h3>Denise Richards Adoption Inspired By Late Mother</h3>

		<p>Denise Richards shocked even her closet friends last week when she announced she had adopted a little girl, and although few details have been made public Bialek says Cain told her to come to D.C. so they could talk. She did -- and to her surprise, Cain hooked her up with a HUGE hotel room ... took her to dinner ... and afterward, promised to show her the NRA headquarters, with gorgeous robster dinner...</p><?php */?>

		<?php echo ($newsceleb[0][0])?substr($newsceleb[0][0],0,480):'<p>No News Found</p>';?>

		</div>

        