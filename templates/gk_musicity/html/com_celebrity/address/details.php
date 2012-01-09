<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$css = JURI::base().'components/com_celebrity/assets/css/celebrity.css';
$document = JFactory::getDocument();
$document->setTitle(JText::sprintf('CELEBADDRESSTITLE',$this->celebrity->full_name,$this->address->id));
//format names that end with "s" for apostrophe
if(strtolower(substr($this->celebrity->full_name,-1,1)) == 's') {
    $owner_full_name = $this->celebrity->full_name."'";
} else {
    $owner_full_name = $this->celebrity->full_name."'s";
}
$document->setDescription(JText::sprintf('CELEBADDRESSDESC',$owner_full_name,$this->celebrity->full_name,$this->address->id));
$document->addStyleSheet($css);

$type = Jrequest::getcmd('type');
//pagination
$prevcount = Jrequest::getcmd("anumber")-2;
$prevcountadd = Jrequest::getcmd("anumber")-1;
$nextcount= Jrequest::getcmd("anumber")-1;
//previous
if(Jrequest::getcmd("anumber") == "1"){
$prev = $this->addressPage[$prevcountadd];
$countprev = Jrequest::getcmd("anumber");
$prevurl = "javascript:;";
} else {
$prev = $this->addressPage[$prevcount];
$countprev = Jrequest::getcmd("anumber")-1;
$prevurl = JRoute::_('index.php?option=com_celebrity&view=address&task=details&type='.$type.'&aid='.$prev.'&cid='.Jrequest::getcmd("cid").'&anumber='.$countprev.'&Itemid=60');
}
//next
if(Jrequest::getcmd("anumber") == count($this->addressPage)){
$next = $this->addressPage[$nextcount];	
$countnext = Jrequest::getcmd("anumber");
$nexturl = "javascript:;";
} else {
$next = $this->addressPage[Jrequest::getcmd("anumber")];
$countnext = Jrequest::getcmd("anumber")+1;	
$nexturl = JRoute::_('index.php?option=com_celebrity&view=address&task=details&type='.$type.'&aid='.$next.'&cid='.Jrequest::getcmd("cid").'&anumber='.$countnext.'&Itemid=60');
}
// adjust auto width
if($type == "address"):
$adjustlen = 295 + strlen($this->celebrity->full_name.' - '.JText::_('Address').$this->anumber);
$name = "Address";
elseif($type=="email"):
$adjustlen = 295 + strlen($this->celebrity->full_name.' - '.JText::_('Email').$this->anumber);
$name = "E-mail";
elseif($type=="website"):
$adjustlen = 295 + strlen($this->celebrity->full_name.' - '.JText::_('Website').$this->anumber);
$name = "Website";
endif;
//get user section
$user =& JFactory::getUser();

//get member sent
$newmodel = $this->getModel();
?>
<style>
ul.pagination_result li a, ul.pagination_result li span {
background-attachment: scroll;
    background-clip: border-box;
    background-color: transparent;
    background-image: url("../images/dark_bg.png");
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: no-repeat;
    background-size: auto auto;
    color: #FFFFFF;
    font-size: 11px;
    font-weight: bold;
    margin-bottom: 2px;
    margin-left: 5px;
    margin-right: 5px;
    margin-top: 2px;
    overflow-x: hidden;
    overflow-y: hidden;

}
</style>

<!--<div id="wrapper">-->
		
		<div class="width960">
			
				<h1 class="searchAddressDetails"><?php echo $this->celebrity->full_name.' - '.JText::_($name).$this->anumber ?></h1>
				
			
				<div class="pagenationNumbers">
					<ul style="margin-left:<?php echo $adjustlen;?>px;">
						<li class="backwards_button"><a href="#"></a></li>
                        <?php
						$k=1;
						?>
                        <li><a href="<?php echo $prevurl;?>">prev</a></li>                     
                        <?php
						 foreach($this->addressPage as $getaddressid){	
						 $count = $k++;						
						?>
						<li><a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=address&task=details&type='.$type.'&aid='.$getaddressid.'&cid='.Jrequest::getcmd("cid").'&anumber='.$count.'&Itemid=60') ?>" <?php echo ($count == Jrequest::getcmd("anumber"))?"style='color:#DA6246'":'';?>><?php echo $count;?></a></li>
                        <?php }?>
						<li><a href="<?php echo $nexturl;?>">next</a></li>
						<li class="forward_button"><a href="#"></a></li>
					</ul>
				</div><!-- div#pagenationNumbers close -->
				
				<div class="clr"></div>
				
				
			<div id="grungeAddressBox">
				<div id="address_bigDisplayed" style="overflow-x :auto;padding-bottom:2px;">
                <?php if(Jrequest::getcmd('type') == "email"):?>
                <?php echo $this->address->email;?>
                <?php elseif(Jrequest::getcmd('type') == "website"):?>
                <?php echo $this->address->url;?>
                <?php else:?>
				<h3><?php echo $this->celebrity->full_name ?><br/>
                <?php if (!empty($this->address->company)) : ?><?php echo $this->address->company ?><br/><?php endif; ?>
                 <?php if (!$this->user->id) : ?>
                 <?php if (!empty($this->address->line_1)) : ?><?php echo substr($this->address->line_1,0,5).'*****' ?><br/><?php endif; ?>
                    <?php if (!empty($this->address->line_2)) : ?><?php echo substr($this->address->line_2,0,5).'*****' ?><br/><?php endif; ?>
                  <?php else : ?>
                    <?php if (!empty($this->address->line_1)) : ?><?php echo $this->address->line_1 ?><br/><?php endif; ?> <?php if (!empty($this->address->line_2)) : ?><?php echo $this->address->line_2 ?><br/><?php endif; ?>
                 <?php endif; ?>
				<?php echo $this->address->city.', '.$this->address->state_code.' '.$this->address->zipcode ?><br/>
				<?php echo $this->address->country; ?>
                 <?php endif;?>
                </h3>
				</div><!-- div#name close -->
                <div id="mailAddress_detailInfo" style="padding-top:65px;">
                <ul>
                <li id="backToAddressList"><a href="index.php?option=com_celebrity&view=celebrity&task=details&cid=<?php echo Jrequest::getcmd("cid");?>&Itemid=<?php echo Jrequest::getcmd("Itemid");?>"></a><span ><a href="index.php?option=com_celebrity&view=celebrity&task=details&cid=<?php echo Jrequest::getcmd("cid");?>&Itemid=<?php echo Jrequest::getcmd("Itemid");?>" style="background:none;color:#464646; text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Go Back to Address List Page</a></span></li>
                </ul>
                </div>
			</div><!-- div#grungeAddressBox close -->

				<div id="mailAddress_detailInfo">
					<ul>
						<li>Successful Mailings: <?php echo $this->Smailing[0];?></li>
						<li>Returned to Sender: <?php echo $this->Rmailing[0];?></li>
						<li>Still Waiting for Reply: X I'm waiting too!</li>
						<li>Submitted by: <a href="<?php echo JRoute::_('index.php?option=com_community&view=profile&userid='.$this->address->submitted_by_uid) ?>"><?php echo $this->address->submitted_by ?></a></li>
						<li>Submitted on: <?php echo $this->address->submitted_on;?></li>
						<?php /*?><li id="backToAddressList"><a href="index.php?option=com_celebrity&view=celebrity&task=details&cid=<?php echo Jrequest::getcmd("cid");?>&Itemid=<?php echo Jrequest::getcmd("Itemid");?>"></a><span ><a href="index.php?option=com_celebrity&view=celebrity&task=details&cid=<?php echo Jrequest::getcmd("cid");?>&Itemid=<?php echo Jrequest::getcmd("Itemid");?>" style="background:none;color:#464646; text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Go Back to Address List Page</a></span></li><?php */?>
					</ul>
				</div><!-- div#userInteraction close -->
				
				
				<p id="SEO_text">Below are the fanmail results for one of "<?php echo $this->celebrity->full_name ?> Addresses". Looking at the individual results of members who have contacted Brittany Murphy should increase your confidence in using this specific mailing address. If you do use this address to write to Brittany Murphy, please return to the Contact A Celebrity Website and share that success with the rest of our members!
				</p>
				
				<div class="clr"></div>
				
				<ul id="addressAction" style="width:220px"><!--remove after site launch-->
					<li>
<?php if(!$user->id):?>
<a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login"><?php echo JText::_('Add my Results') ?></a>
<?php else: ?>
<a href="<?php echo JText::_('index.php?option=com_celebrity&view=result&task=add&cid='.$this->celebrity->id.'&aid='.$this->address->id.'&type='.$type.'&anumber='.$this->anumber.'&Itemid='.$this->resultsItemid) ?>"><?php echo JText::_('Add my Results') ?></a>
<?php endif;?>
</li>
                    
					<li class="noBorder_right">
                  <?php if(!$user->id):?>  
                    <a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login"><?php echo JText::_('Add New Address') ?></a>
                    <?php else: ?>
                     <a href="<?php echo JRoute::_('index.php?option=com_celebrity&task=add&controller=address&cid='.$this->celebrity->id.'&Itemid='.$this->addressItemid) ?>"><?php echo JText::_('Add New '.$name); ?></a>
                     <?php endif;?>
                    </li>
                    <!--hide for now-->
					<?php /*?><li><a href="javascript:;"><?php echo JText::_('Add Private Tracking Notes') ?></a></li>
					<li class="noBorder_right"><a href="javascript:;"><?php echo JText::_('Report Address as Outdated') ?></a></li><?php */?>
                    <!--hide for now-->	
				</ul>
				
		
		</div><!-- div.width960 close -->
		
			
	
	
		
<div class="width640">

		<h1 class="search">Result For This <?php echo $name;?></h1>
			<div class="pagenationNumbers">
            <?php echo $this->pagination->getPagesLinks() ?>
					<!--<ul>
						<li class="backwards_button"><a href="#"></a></li>
						<li><a href="#">prev</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">next</a></li>
						<li class="forward_button"><a href="#"></a></li>
					</ul>-->
			</div><!-- div#pagenationNumbers close -->

<!-- ============================================================================================== -->	
		<?php if(!$this->ResultAddress):?>
			<br><br><div align="center">No Result Found</div><br><br><br><br>
         <?php else: ?>
		<div id="userCommentList">
		<?php 		
		for($m=0;$m<=count($this->ResultAddress)-1;$m++):?>
        <?php if($this->ResultAddress[$m]->thumb == ""):?>			<!-- avatar1 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar1.gif" alt="<?php echo $this->ResultAddress[$m]->username;?>" width="72" height="71" />
            <?php else:?>
           <img class="avatar" src="<?php echo JURI::base();?><?php echo $this->ResultAddress[$m]->thumb;?>" alt="<?php echo $this->ResultAddress[$m]->username;?>" width="72" height="71" />

            <?php endif;?>
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="<?php echo JRoute::_('index.php?option=com_community&view=profile&userid='.$this->ResultAddress[$m]->created_by_id); ?>"><?php echo $this->ResultAddress[$m]->username;?></a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate"><?php echo $this->ResultAddress[$m]->datecreate;?></li>
					<li class="status">Status:<span class="greenText"><?php echo $this->ResultAddress[$m]->label;?></span></li>
					<?php if(!$this->ResultAddress[$m]->quality):?>
                    <?php else:?>
					<li class="successType">Success Type: <?php echo $this->ResultAddress[$m]->quality;?></li>
                    <?php endif;?>
					<li class="dateSent">Date Sent: <?php echo $this->ResultAddress[$m]->datesent;?></li>
					<li class="dateReceived">Date Received: <?php echo $this->ResultAddress[$m]->datereceive;?></li>
<li class="memberSent">Member Sent: <?php
$getmodel = $newmodel->getMemberSent($this->ResultAddress[$m]->id);
$resultstr = array();
if(!$getmodel){
echo "-";
} else {
foreach($getmodel as $getlist){$resultstr[] =  $getlist;}
$result = implode(",",$resultstr);
echo $result;
}
?></li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
            <?php 

			
			?>
				<ul>
                <?php //if($this->ResultAddress[$m]->label == "Success"):?>
					<li class="readButton"><a href="<?php echo JRoute::_( "index.php?option=com_celebrity&view=result&id=".$this->ResultAddress[$m]->id."&cid=".Jrequest::getcmd("cid")."&aid=".Jrequest::getcmd("aid")."&anumber=".Jrequest::getcmd("anumber")."&type=".$type."&Itemid=60");?>">View Details</a></li>
                    <?php //endif;?>
					<!--<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>-->
				</ul>
				<p><!--Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...--><?php echo ($this->ResultAddress[$m]->comments=="")?'No Comment':$this->ResultAddress[$m]->comments;?></p>		
			</div><!-- div.user_comment close -->			
		</div><!-- avatar_speachBubble close -->	
			
		<?php endfor;?>	
			
			<?php /*?><!-- avatar2 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar2.gif" alt="avatar2" width="72" height="71" />
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li>Status:<span class="greenText">Success</span></li>
					<li>Success Type: Definitely Authentic</li>
					<li>Date Sent: 09/18/2011</li>
					<li>Date Received: 09/25/2011</li>
					<li>Member Sent: Letter</li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
				<ul>
					<li class="readButton"><a href="#">Read</a></li>
					<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>
				</ul>
				<p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p>		
			</div><!-- div.user_comment close -->
		</div><!-- avatar_speachBubble close -->
		
		
			
			<!-- avatar3 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar3.gif" alt="avatar3" width="72" height="71" />
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li>Status:<span class="greenText">Success</span></li>
					<li>Success Type: Definitely Authentic</li>
					<li>Date Sent: 09/18/2011</li>
					<li>Date Received: 09/25/2011</li>
					<li>Member Sent: Letter</li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
				<ul>
					<li class="readButton"><a href="#">Read</a></li>
					<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>
				</ul>
				<p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p>		
			</div><!-- div.user_comment close -->
		</div><!-- avatar_speachBubble close -->
	
	
			
<img class="googleAds_468x60" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/googleAds_468x60.gif" alt="googleAds_468x60" width="468" height="60" />			
			
<div class="clr"></div>		
			
			<!-- avatar4 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar4.gif" alt="avatar4" width="72" height="71" />
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li>Status:<span class="greenText">Success</span></li>
					<li>Success Type: Definitely Authentic</li>
					<li>Date Sent: 09/18/2011</li>
					<li>Date Received: 09/25/2011</li>
					<li>Member Sent: Letter</li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
				<ul>
					<li class="readButton"><a href="#">Read</a></li>
					<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>
				</ul>
				<p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p>		
			</div><!-- div.user_comment close -->
		</div><!-- avatar_speachBubble close -->
		
		
			
			<!-- avatar5 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar5.gif" alt="avatar5" width="72" height="71" />
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li>Status:<span class="greenText">Success</span></li>
					<li>Success Type: Definitely Authentic</li>
					<li>Date Sent: 09/18/2011</li>
					<li>Date Received: 09/25/2011</li>
					<li>Member Sent: Letter</li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
				<ul>
					<li class="readButton"><a href="#">Read</a></li>
					<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>
				</ul>
				<p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p>		
			</div><!-- div.user_comment close -->
		</div><!-- avatar_speachBubble close -->
		
		
			
			<!-- avatar6 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar6.gif" alt="avatar6" width="72" height="71" />
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li>Status:<span class="greenText">Success</span></li>
					<li>Success Type: Definitely Authentic</li>
					<li>Date Sent: 09/18/2011</li>
					<li>Date Received: 09/25/2011</li>
					<li>Member Sent: Letter</li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
				<ul>
					<li class="readButton"><a href="#">Read</a></li>
					<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>
				</ul>
				<p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p>		
			</div><!-- div.user_comment close -->
		</div><!-- avatar_speachBubble close -->
		
		

<img class="googleAds_468x60" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/googleAds_468x60.gif" alt="googleAds_468x60" width="468" height="60" />

<div class="clr"></div>
			
			<!-- avatar7 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar7.gif" alt="avatar7" width="72" height="71" />
			<div class="avatar_speech_triangle"></div>
		<div class="avatar_speachBubble">
			<div class="successStatus">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li>Status:<span class="greenText">Success</span></li>
					<li>Success Type: Definitely Authentic</li>
					<li>Date Sent: 09/18/2011</li>
					<li>Date Received: 09/25/2011</li>
					<li>Member Sent: Letter</li>
				</ul>
			</div><!-- div.successStatus close -->
			
			<div class="user_comment">
				<ul>
					<li class="readButton"><a href="#">Read</a></li>
					<li class="commentNumber">5 Comments</li>
					<li class="addComment"><a href="#">+ Add Comment</a></li>
				</ul>
				<p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p>		
			</div><!-- div.user_comment close -->
		</div><!-- avatar_speachBubble close -->	<?php */?>		

		
			
		</div><!-- div#userCommentList close -->
					
			<?php //echo $this->pagination->getPagesLinks() ?>
					
		<!--	<ul id="pagination">
				<li class="roundedSquare"><a href="#">Prev</a></li>
				<li class="roundedSquare"><a href="#">1</a></li>
				<li class="roundedSquare"><a href="#">2</a></li>
				<li class="roundedSquare"><a href="#">3</a></li>
				<li class="roundedSquare"><a href="#">4</a></li>
				<li class="roundedSquare"><a href="#">5</a></li>
				<li class="roundedSquare"><a href="#">Next</a></li>
			</ul> -->
            <?php endif;?>

</div><!-- div#width640 close -->


<div style="float:right;margin-right:40px;" >
<!-- ============================================================================================== -->	

	<!-- browse_RT1_300x250 -->
    <img src="<?php echo JURI::base().'modules/mod_celebrityaddresses/assets/images/spacer.png' ?>" alt="Successes" width="18" height="1" />
<script type="text/javascript">
    GS_googleAddAdSenseService("ca-pub-7953222348963766");
    GS_googleEnableAllServices();
</script>
<script type="text/javascript">
    GA_googleAddSlot("ca-pub-7953222348963766", "browse_RT1_300x250");
</script>
<script type="text/javascript">
    GA_googleFetchAds();
</script>
<?php 
$style = "
#google_ads_div_browse_mid1_468x60_ad_container, #google_ads_div_browse_mid2_468x60_ad_container {
	text-align:center;
    margin-bottom: 10px;
}
#google_ads_div_browse_RT1_300x250_ad_container{
    text-align:right;
    margin-top:20px
}
";
$document = JFactory::getDocument();
$document->addStyleDeclaration($style);
?>
<?php 
$blockips = array();
//if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)): ?>
<script type='text/javascript'>
GA_googleFillSlot("browse_RT1_300x250");
</script>
<?php //endif; ?>		
	<?php /*?><img class="googleAds_300x250" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/googleAds300x250.gif" alt="googleAds300x250" width="300" />	<?php */?>	
	<div id="ebayaddress" >
		<h1 id="details"><?php echo JText::_('FUNITEMS') ?></h1>
		<?php 
                $myEbay = JModuleHelper::getModule('MyEbay_Search','MyEbay_Search module');
                echo JModuleHelper::renderModule($myEbay);
            ?>
            <img title="ebay" alt="ebay" src="<?php echo JURI::base() ?>templates/gk_musicity/images/style/ebayLogo.png" class="ebayLogo">
	</div>
</div>
<?php /*?><div class = "moduletable">
    <div style="border:solid 2px #000;">
        <h3><?php echo $this->celebrity->full_name.' - '.JText::_('Address #').$this->anumber ?></h3>
        <div class = "moduletable_content">
            <div class="address-detail-body">
                <div class="address-detail">
                    <div><?php echo $this->celebrity->full_name ?></div>
                    <?php if (!empty($this->address->company)) : ?><div><?php echo $this->address->company ?></div><?php endif; ?>
                    
                    <?php if (!$this->user->id) : ?>
                    <div>(<a class="address_login" href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>"><?php echo JText::_('sign in') ?></a><?php echo JText::_(' or ') ?><a href="<?php echo JRoute::_('index.php?option=com_content&itemid=40&id=5') ?>"><?php echo JText::_('join') ?></a><?php echo JText::_(' to view full address') ?>)</div>
                    <?php if (!empty($this->address->line_1)) : ?><div><?php echo substr($this->address->line_1,0,5).'*****' ?></div><?php endif; ?>
                    <?php if (!empty($this->address->line_2)) : ?><div><?php echo substr($this->address->line_2,0,5).'*****' ?></div><?php endif; ?>
                    <?php else : ?>
                    <?php if (!empty($this->address->line_1)) : ?><div><?php echo $this->address->line_1 ?></div><?php endif; ?>                    
                    <?php if (!empty($this->address->line_2)) : ?><div><?php echo $this->address->line_2 ?></div><?php endif; ?>                    
                    <?php endif; ?>
                    
                    <div><?php echo $this->address->city.', '.$this->address->state_code.' '.$this->address->zipcode ?></div>
                    <div><?php echo $this->address->country ?></div>
                </div>
                <div class="address-detail-options">
                    <div><?php echo JText::_('Successful Mailings') ?></div>
                    <div><?php echo JText::_('Returned to Sender') ?></div>
                    <div><?php echo JText::_('Still Waiting for a Reply') ?></div>
                </div>
                <div class="address-detail-options-values">
                    <div><a href="#"><?php echo JText::_('X') ?></a> <a href="#"><?php echo JText::_('view all') ?></a></div>
                    <div>0</div>
                    <div><a href="#"><?php echo JText::_('X') ?></a> <a href="#"><?php echo JText::_('I\'m waiting too!') ?></a></div>
                </div>
                <div class="address-detail-submit-info">
                    <div><?php echo JText::_('Submitted by').': ' ?><a href="<?php echo JRoute::_('index.php?option=com_community&view=profile&userid='.$this->address->submitted_by_uid) ?>"><?php echo $this->address->submitted_by ?></a></div>
                    <div><?php echo JText::_('Submitted on').': '.$this->address->submitted_on ?></div>
                </div>
            </div>       
        </div>
        <div class="address-detail-footer">
            <span><a href="<?php echo JRoute::_('index.php?option=com_celebrity&task=add&controller=address&cid='.$this->celebrity->id.'&Itemid='.$this->addressItemid) ?>"><?php echo JText::_('Add New Address') ?></a></span><span><a href="<?php echo JText::_('index.php?option=com_celebrity&view=result&task=add&cid='.$this->celebrity->id.'&aid='.$this->address->id.'&Itemid='.$this->resultsItemid) ?>"><?php echo JText::_('Add my Results') ?></a></span><span><a href="#"><?php echo JText::_('Report Address as Outdated') ?></a></span><span><a href="#"><?php echo JText::_('Add Private Tracking Notes') ?></a></span>
        </div>         
    </div>
</div><?php */?>