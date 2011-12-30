<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
$data = $this->data;
$link = JRoute::_( "index.php?option=com_celebrity&view=result&id={$data->id}" );
//get member sent
$newmodel = $this->getModel();

//lightbox
/*add a js and css file*/
$mooltools  = JURI::base().'components/com_celebrity/js/mootools-1.2.5.1-more.js';
$slimbox = JURI::base().'components/com_celebrity/js/slimbox.js';
$slimboxCss = JURI::base().'components/com_celebrity/assets/css/ResultLight/slimbox.css';
$document = JFactory::getDocument();
$document->addScript($mooltools);
$document->addScript($slimbox);
$document->addStyleSheet($slimboxCss);


//lightbox
?>
<style>
#gk-current-content-wrap{
background-color:transparent;	
}
</style>

		
		<div class="width1002">
				<h1 id="result"><?php echo $this->CelebrityDetail->full_name;?> Success for Address<?php echo Jrequest::getcmd("anumber");?></h1>
				
				
			<div id="individualSuccess_story">
            <?php if($this->ResultAddress->thumb == ""):?>			<!-- avatar1 -->
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar1.gif" alt="<?php echo $this->ResultAddress->username;?>" width="72" height="71" />
            <?php else:?>
           <img class="avatar" src="<?php echo JURI::base();?><?php echo $this->ResultAddress->thumb;?>" alt="<?php echo $this->ResultAddress->username;?>" width="72" height="71" />

            <?php endif;?>
			
			<div id="userInfo">	
				<ul>
					<li class="postedBy">Posted by <a href="<?php echo JRoute::_('index.php?option=com_community&view=profile&userid='.$this->ResultAddress->created_by_id) ?>"><?php echo $this->ResultAddress->username;?></a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate"><?php echo $this->ResultAddress->datecreate;?></li>
					<li class="status">Status:<span class="greenText"><?php echo $this->ResultAddress->label;?></span></li>
					<?php if(!$this->ResultAddress->quality):?>
                    <?php else:?>
					<li class="successType">Success Type: <?php echo $this->ResultAddress->quality;?></li>
                     <?php endif;?>
					<li class="dateSent">Date Sent: <?php echo $this->ResultAddress->datesent;?></li>
					<li class="dateReceived">Date Received: <?php echo $this->ResultAddress->datereceive;?></li>
					<li class="memberSent">Member Sent: 
<?php
$getmodel = $newmodel->getMemberSent($this->ResultAddress->id);
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
			</div><!-- #userInfo close -->
			
			<div class="clr"></div>
				
		<div class="avatar_speech_triangle_up"></div>
		<div class="avatar_speachBubble_325">
		<p><?php echo $this->ResultAddress->comments; ?></p>						
		</div><!-- avatar_speachBubble_300 close -->	

</div><!--individualSuccess_story close -->

				
				<div id="middleImageLoader">		
					<div id="successImage">
                    <img src="<?php echo $this->result_image;?>" width="200" height="260" />	
					</div><!-- div#userInteraction close -->
				<a id="viewFullimage" href="<?php echo $this->Lresult_image;?>" rel="lightbox">View Full Image</a>
				</div><!-- div#middleImageLoader close -->
				
				
				
		<div id="successResult_SEOtext">
			<h3> Get Your <?php echo $this->CelebrityDetail->full_name;?>!</h3>
			<p>Here is a <?php echo $this->CelebrityDetail->full_name;?> Autograph acquired by one of our members. Use our celebrity address database and get your own <?php echo $this->CelebrityDetail->full_name;?> autographed picture. Collecting autograph has never been easier! Start your autograph collection today!</p>
		</div><!-- div#successResult_SEOtext close -->
		
		
		<div class="clear"></div>
					
		</div><!-- div.width960 close -->
		
	
		
<div class="width680">

		<h1 id="result">Comments About this <?php echo $this->CelebrityDetail->full_name;?> Mail Result</h1>
	
			
<!-- ============================================================================================== -->	

		<div id="userCommentList">
		
		<div class="primaryComment">	
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar1.gif" alt="avatar1" width="72" height="71" />	
			<div class="primaryCommentText">	
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- primaryCommentText close -->
		
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!--comment_action close -->						
		</div><!-- primaryComment close -->	
		
		
		<div class="secondaryComment">
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar2.gif" alt="avatar2" width="72" height="71" />
			<div class="secondaryCommentText">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- secondaryCommentText close -->
			
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!-- comment_action close -->			
		</div><!-- secondaryComment close -->
		
		
		
		<div class="secondaryComment">
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar3.gif" alt="avatar3" width="72" height="71" />
			<div class="secondaryCommentText">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- secondaryCommentText close -->
			
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!-- comment_action close -->			
		</div><!-- secondaryComment close -->

<img class="googleAdsresult_468x60" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/googleAds_468x60.gif" alt="googleAdsresult_468x60" width="468" height="60" />

<div class="clr"></div>
		
<!-- ========================================================================================== -->		
	<div class="primaryComment">	
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar4.gif" alt="avatar4" width="72" height="71" />	
			<div class="primaryCommentText">	
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- primaryCommentText close -->
		
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!--comment_action close -->						
		</div><!-- primaryComment close -->	


			<div class="secondaryComment">
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar2.gif" alt="avatar2" width="72" height="71" />
			<div class="secondaryCommentText">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- secondaryCommentText close -->
			
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!-- comment_action close -->			
		</div><!-- secondaryComment close -->


			<div class="secondaryComment">
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar5.gif" alt="avatar5" width="72" height="71" />
			<div class="secondaryCommentText">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- secondaryCommentText close -->
			
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!-- comment_action close -->			
		</div><!-- secondaryComment close -->

<img class="googleAds_468x60" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/googleAds_468x60.gif" alt="googleAds_468x60" width="468" height="60" />
<div class="clr"></div>

		
<!-- ========================================================================================== -->			
<div class="primaryComment">	
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar7.gif" alt="avatar7" width="72" height="71" />	
			<div class="primaryCommentText">	
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- primaryCommentText close -->
		
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!--comment_action close -->						
		</div><!-- primaryComment close -->	


		<div class="secondaryComment">
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar6.gif" alt="avatar6" width="72" height="71" />
			<div class="secondaryCommentText">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- secondaryCommentText close -->
			
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!-- comment_action close -->			
		</div><!-- secondaryComment close -->

			<div class="secondaryComment">
			<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar3.gif" alt="avatar3" width="72" height="71" />
			<div class="secondaryCommentText">
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>Sent the letter asking for a signed picture for my sisters' birthday. She is the most coolest girl ever I love her CD identified it reminds me of how I left my boyfriend, but it was so nice to leave a message...</p></li>
				</ul>
			</div><!-- secondaryCommentText close -->
			
			<div class="comment_action">
				<ul>
					<a href="#"><li class="thumbUp">+59</li></a>
					<a href="#"><li class="thumbDown">-10</li></a>
					<a href="#"><li class="reply">Reply</li></a>
				</ul>
			</div><!-- comment_action close -->			
		</div><!-- secondaryComment close -->
		

		
<img class="googleAds_468x60" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/googleAds_468x60.gif" alt="googleAds_468x60" width="468" height="60" />		
<div class="clr"></div>
								
	
			
						
		</div><!-- div#userCommentList close -->
					
					
			<!--		
			<ul id="pagination">
				<li class="roundedSquare"><a href="#">Prev</a></li>
				<li class="roundedSquare"><a href="#">1</a></li>
				<li class="roundedSquare"><a href="#">2</a></li>
				<li class="roundedSquare"><a href="#">3</a></li>
				<li class="roundedSquare"><a href="#">4</a></li>
				<li class="roundedSquare"><a href="#">5</a></li>
				<li class="roundedSquare"><a href="#">Next</a></li>
			</ul> 
			-->
			
</div><!-- div#width640 close -->



<!-- ============================================================================================== -->	

		<div style="margin-right:-25px;float:right">	
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
</div>
	<div id="recentComments" style="margin-right:-25px;float:right">
		<h1 id="result">Recent Comments</h1>
		
		<div class="recentCommentPost">
				<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar3.gif" alt="avatar3" width="72" height="71" />
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
				</ul>
		</div><!-- .recentCommentText close -->
		
		<div class="recentCommentPost">
				<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar2.gif" alt="avatar2" width="72" height="71" />
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
				</ul>
		</div><!-- .recentCommentText close -->
		
		<div class="recentCommentPost">
				<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar1.gif" alt="avatar1" width="72" height="71" />
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
				</ul>
		</div><!-- .recentCommentText close -->
		
		<div class="recentCommentPost">
				<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar5.gif" alt="avatar5" width="72" height="71" />
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
				</ul>
		</div><!-- .recentCommentText close -->
		
		<div class="recentCommentPost">
				<img class="avatar" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/avatar4.gif" alt="avatar4" width="72" height="71" />
				<ul>
					<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/greenStar.png" alt="greenStar" width="13" height="12" /></li>
					<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
					<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
				</ul>
		</div><!-- .recentCommentText close -->
		
		<a href="#"><img id="recentCommentRSS" src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/rss2.png" alt="rss%202" width="64" height="25" /></a>
		
	
	</div><!--#recentComments close -->
	
	
	
	
<div id="ebayaddress" style="margin-right:-25px;float:right" >
		<h1 id="details"><?php echo JText::_('FUNITEMS') ?></h1>
		<?php 
                $myEbay = JModuleHelper::getModule('MyEbay_Search','MyEbay_Search module');
                echo JModuleHelper::renderModule($myEbay);
            ?>
            <img title="ebay" alt="ebay" src="<?php echo JURI::base() ?>templates/gk_musicity/images/style/ebayLogo.png" class="ebayLogo">
	</div>


<?php /*?><div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_SENT' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_sent; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'RECEIVED_TYPE_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->received_type_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_RECEIVED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_received; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'COMMENTS' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->comments; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ADDRESS_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->address_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'QUALITY_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->quality_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'RECEIVED_IMAGE_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->received_image_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'CREATED_BY_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->created_by_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'PUBLISHED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->published; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_CREATED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_created; ?></span>
	</div>

</div>
<?php */?>