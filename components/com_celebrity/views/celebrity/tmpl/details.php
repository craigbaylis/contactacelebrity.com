<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$tinytab = JURI::base().'components/com_celebrity/js/tinytab.js';
/*custom*/
$mooltools  = JURI::base().'components/com_celebrity/js/mootools-1.2.5.1-more.js';
$lightbox = JURI::base().'components/com_celebrity/js/LightFace.js';
$more = JURI::base().'components/com_celebrity/js/LightFace.IFrame.js';
/*custom*/
$scripid = Jrequest::getcmd("cid");
$albumid = $this->details->album_catid;
$titleceleb = addslashes($this->details->name);
$domready = <<<SCRIPT
window.addEvent('domready',function(){
    tb = new TinyTab($$('ul.tabs li'),$$('ul.contents li'));
	document.id('start').addEvent('click',function() {				
				light = new LightFace.IFrame({ height:250, width:525, url: 'index.php?option=com_celebrity&view=celebrity&task=lightupload&cid=$scripid&album_id=$albumid', title: '$titleceleb' }).addButton('Close', function() { light.close(); },true).open();
				
			});
			
			//for deceased report
			document.id('reportdeceased').addEvent('click',function() {				
				light = new LightFace.IFrame({ height:445, width:525, url: 'index.php?option=com_celebrity&view=celebrity&task=deceased&cid=$scripid', title: '$titleceleb - Report Deceased' }).addButton('Close', function() { light.close(); },true).open();
				
			});
});
SCRIPT;
$celebrityCss = JURI::base().'components/com_celebrity/assets/css/Assets/LightFace.css';
$document = JFactory::getDocument();



$document->addScript($tinytab);
/*custom*/
$document->addScript($mooltools);
$document->addScript($lightbox);
$document->addScript($more);
$document->addStyleSheet($celebrityCss);
/*custom*/
$document->addScriptDeclaration($domready);

//load module helper to display addresses module
//jimport('joomla.application.module.helper');
//$module = JModuleHelper::getModule('mod_celebrityaddresses');
//get user details
$user =& JFactory::getUser();
?>

<div class="width960">
			<div id="left">
				<h1 id="details">Addresses For <?php echo $this->details->name ?></h1>
			
				<div id="name">
				<h3><?php echo $this->details->name ?></h3>
				</div><!-- div#name close -->
			
				<div id="photo" >
                 <?php if($this->deceasedstatus[0]->is_deceased == 1):?>
  <?php /*?>     <img name="" src="imagecreation.php?imageurl=<?php echo $this->celeb_image ?>" width="140" height="180" alt="" />   <?php */?><img name="" src="images/deceased.gif" width="140" height="180" alt="" style="background-image:url(<?php echo $this->celeb_image ?>);background-repeat:no-repeat; width:140px; height:180px;" />
	          <?php else:?>
      <img name="" src="<?php echo $this->celeb_image ?>" width="140" height="180" alt="" />
                 <?php endif;?>
				<p>
                <?php if($user->get('id') == "0"):?>
                <a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login" >[+] Add Image</a>
                <?php else:?>
                 <?php if($this->details->album_catid == "0"):?>
                <a href="javascript:;" id="start" >[+] Add Image</a>
                <?php else:?>
                 <a href="javascript:;" id="start">[+] Add Image</a>
                <?php /*?> index.php?option=com_celebrity&view=celebrity&task=lightupload&cid=<?php echo Jrequest::getcmd("cid"); ?>&album_id=<?php echo $this->details->album_catid;?>index.php?option=com_celebrity&view=celebrity&task=lightupload&cid=<?php echo Jrequest::getcmd("cid"); ?><?php */?>
                <?php endif;?>
                <?php endif;?>
                </p>
				</div><!-- div#photo close -->
			
				<div id="userInteraction">
						<span id="emailAlert"><a href="#"><span class="aligning"><?php echo JText::_('Send me email alerts') ?></span></a></span><br />
						<span id="chat"><a href="#"><span class="aligning"><?php echo JText::_('Chat about ').$this->details->name ?></span></a></span><br />
						<span id="gallery">
                        <?php if($this->details->album_catid == "0"):?>
                        <a href="javascript:;"><span class="aligning"><?php echo JText::_('Photo Gallery') ?></span></a>
                       <?php else:?>
                         <a href="index.php?option=com_phocagallery&view=category&id=<?php echo $this->details->album_catid;?>:<?php echo strtolower($this->details->first_name);?>-<?php echo strtolower($this->details->last_name);?>&Itemid=59"><span class="aligning"><?php echo JText::_('Photo Gallery') ?></span></a>
                         <?php endif;?>
                        </span><br />
                        <?php if($this->deceasedstatus[0]->is_deceased == 1):?>
                        <?php else:?>
                          <?php
						if($user->get('id') == "0"):
						?>
                        <span id="deceased"><a href="javascript:;" class="general_login"><span class="aligning"><?php echo JText::_('Report '.$this->details->name.' as deceased') ?></span></a></span><br />
					<?php   else:?>
						<span id="deceased"><a href="javascript:;" id="reportdeceased"><span class="aligning"><?php echo JText::_('Report '.$this->details->name.' as deceased') ?></span></a></span><br />
                        <?php endif;?>
                        <?php
					if($user->get('id') == "0"){
						?>
                        <span id="addNewAddress"><a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" class="general_login"><span class="aligning"><?php echo JText::_('Add New Address') ?></span></a></span><br />
                        <?php } else {?>
						<span id="addNewAddress"><a href="<?php echo JRoute::_('index.php?option=com_celebrity&task=add&controller=address&cid='.$this->details->id.'&Itemid='.$this->itemid) ?>"><span class="aligning"><?php echo JText::_('Add New Address') ?></span></a></span><br />
                        <?php }?>
                        <?php endif;?>
				</div><!-- div#userInteraction close -->
		
			</div><!-- div#left close -->
		
			<div id="right460">
             <ul class="tabs">
    <li><?php echo JText::_('Intro') ?></li>
    <li><?php echo JText::_('Profile') ?></li>
    <li><?php echo JText::_('Biography') ?></li>
    <!-- <li><?php echo JText::_('Photos') ?></li> -->
    <!-- <li><?php echo JText::_('Videos') ?></li> -->
    </ul>
    <ul class="contents">
        <li><p>If you're looking to find "<?php echo $this->details->ownership_name ?> address", you're in the right place! Look at the addresses below where members have contacted <?php echo $this->details->name ?> and send them your fan mail, posters, photographs or memorablilia to be autographed. Autograph collectors have used our celebrity contacts database since 1996 to get a <?php echo $this->details->name ?> autograph or other signed memorablilia from thousands of famous people.</p></li>
        <li>
            <div>
                <?php if ($this->details->full_name) : ?>
                <div>
                    <span><?php echo JText::_('Full Name') ?>:</span><span><?php echo ' '.$this->details->full_name ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->birth_date) : ?>
                <div>
                    <span><?php echo JText::_('Birthday') ?>:</span><span><?php echo ' '.$this->details->birth_date ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->birth_date) : ?>
                <div>
                    <span><?php echo JText::_('Famous for') ?>:</span><span><?php echo ' '.$this->details->famous_for ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->birth_place) : ?>
                <div>
                    <span><?php echo JText::_('Birth Place') ?>:</span><span><?php echo ' '.$this->details->birth_place ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->hair_color) : ?>
                <div>
                    <span><?php echo JText::_('Hair Color') ?>:</span><span><?php echo ' '.$this->details->hair_color ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->eye_color) : ?>
                <div>
                    <span><?php echo JText::_('Eye Color') ?>:</span><span><?php echo ' '.$this->details->eye_color ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->profession) : ?> 
                <div>
                    <span><?php echo JText::_('Profession(s)') ?>:</span><span><?php echo ' '.$this->details->profession ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->celebrity_submitted_by) : ?>
                <div>
                    <span><?php echo JText::_('Celebrity Submitted By') ?>:</span><span><?php echo ' '.$this->details->celebrity_submitted_by ?></span>
                </div>
                <?php endif; ?>                                                                                               
            </div>
        </li>
        <li><?php echo $this->details->biography ?></li>
        <!-- <li>Photo thumbnails will go here.</li> -->
        <!-- <li>Videos will go here.</li> -->
    </ul>    
				<!--<ul id="introTabs">
					<li><a href="#">Intro</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="#">Biography</a></li>
				</ul>
			
				
			
				<p class="introText">If you are looking to find "Brittany Murphy's address", you're in the right place! Look at the addresses below where members have contacted Brittany Murphy and send them your fan mail, posters, photographs or memorabilia to be autographed. Autograph collectors have used our celebrity contacts database since 1996 to get a Brittany Murphy autograph or other signed memorabilia from thousands of famous people.<br/><br/>
				If you are looking to find "Brittany Murphy's address", you're in the right place! Look at the addresses below where members have contacted Brittany Murphy and send them your fan mail, posters, photographs or memorabilia to be autographed. 
				
				</p>-->
	
			</div><!-- div#right440 close -->
		
			
	</div>
    <!-- div#gavickModule close -->
<?php /*?><div id="celebrity-profile">
<div id="left-side">
    <div>
        <h3 id="name"><?php echo $this->details->name ?></h3>
        <h4 id="mail-address"><?php echo JText::_('Contact Mailing Address') ?></h4>
        <hr />
        <div>
            <div id="inner-left">
                <img name="" src="<?php echo $this->profile_image ?>" width="113" height="150" alt="" />
                <div style="margin-top:5px;"><span>[+]</span><span> Add Image</span></div>
            </div>
            <div id="inner-right">
                <ul>
                    <li><?php echo JText::_('Send me email alerts') ?></li>
                    <li><?php echo JText::_('Chat about ').$this->details->name ?></li>
                    <li><?php echo JText::_('Photo Gallery') ?></li>
                    <li><?php echo JText::_('Report '.$this->details->name.' as deceased') ?></li>
                    <li><a href="<?php echo JRoute::_('index.php?option=com_celebrity&task=add&controller=address&cid='.$this->details->id.'&Itemid='.$this->itemid) ?>"><?php echo JText::_('Add New Address') ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="right-side">
    <ul class="tabs">
    <li><?php echo JText::_('Intro') ?></li>
    <li><?php echo JText::_('Profile') ?></li>
    <li><?php echo JText::_('Biography') ?></li>
    <!-- <li><?php echo JText::_('Photos') ?></li> -->
    <!-- <li><?php echo JText::_('Videos') ?></li> -->
    </ul>
    <ul class="contents">
        <li><p>If you're looking to find "<?php echo $this->details->ownership_name ?> address", you're in the right place! Look at the addresses below where members have contacted <?php echo $this->details->name ?> and send them your fan mail, posters, photographs or memorablilia to be autographed. Autograph collectors have used our celebrity contacts database since 1996 to get a <?php echo $this->details->name ?> autograph or other signed memorablilia from thousands of famous people.</p></li>
        <li>
            <div>
                <?php if ($this->details->full_name) : ?>
                <div>
                    <span><?php echo JText::_('Full Name') ?>:</span><span><?php echo ' '.$this->details->full_name ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->birth_date) : ?>
                <div>
                    <span><?php echo JText::_('Birthday') ?>:</span><span><?php echo ' '.$this->details->birth_date ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->birth_date) : ?>
                <div>
                    <span><?php echo JText::_('Famous for') ?>:</span><span><?php echo ' '.$this->details->famous_for ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->birth_place) : ?>
                <div>
                    <span><?php echo JText::_('Birth Place') ?>:</span><span><?php echo ' '.$this->details->birth_place ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->hair_color) : ?>
                <div>
                    <span><?php echo JText::_('Hair Color') ?>:</span><span><?php echo ' '.$this->details->hair_color ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->eye_color) : ?>
                <div>
                    <span><?php echo JText::_('Eye Color') ?>:</span><span><?php echo ' '.$this->details->eye_color ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->profession) : ?> 
                <div>
                    <span><?php echo JText::_('Profession(s)') ?>:</span><span><?php echo ' '.$this->details->profession ?></span>
                </div>
                <?php endif; ?>
                
                <?php if ($this->details->celebrity_submitted_by) : ?>
                <div>
                    <span><?php echo JText::_('Celebrity Submitted By') ?>:</span><span><?php echo ' '.$this->details->celebrity_submitted_by ?></span>
                </div>
                <?php endif; ?>                                                                                               
            </div>
        </li>
        <li><?php echo $this->details->biography ?></li>
        <!-- <li>Photo thumbnails will go here.</li> -->
        <!-- <li>Videos will go here.</li> -->
    </ul>    
</div>
</div><?php */?>

<?php /*?><div style="float: right;">

    <div id="ebay">
            <h1 class="search"><?php echo JText::_('FUNITEMS') ?></h1>
            <?php 
                $myEbay = JModuleHelper::getModule('myebay','MyEbay module');
                echo JModuleHelper::renderModule($myEbay);
            ?>
            <img title="ebay" alt="ebay" src="<?php echo JURI::base() ?>templates/gk_musicity/images/style/ebayLogo.png" class="ebayLogo">
    </div>   
</div><?php */?>


			
			

<div style="margin-right:40px;">
<img src="<?php echo JURI::base().'modules/mod_celebrityaddresses/assets/images/spacer.png' ?>" alt="Successes" width="18" height="1" />


<!-- browse_RT1_300x250 -->
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
<div class="width640detail">
<?php
/*$document   = &JFactory::getDocument();
$renderer   = $document->loadRenderer('module');
$params   = array('style'=>'moduletablenew');
echo $renderer->render(JModuleHelper::getModule('mod_gk_js_members'), $params);
*/$myEbaye = JModuleHelper::getModule('gk_js_members','tabselection');
echo JModuleHelper::renderModule($myEbaye);
?>
</div>
<?php 
$blockips = array();
//if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)): ?>
<script type='text/javascript'>
GA_googleFillSlot("browse_RT1_300x250");
</script>
<?php //endif; ?>
<!-- browse_RT1_300x250 -->
	</div>
    <div style="float: right;">
	<div id="ebay" >
		<h1 id="details"><?php echo JText::_('FUNITEMS') ?></h1>
		<?php 
                $myEbay = JModuleHelper::getModule('MyEbay_Search','MyEbay_Search module');
                echo JModuleHelper::renderModule($myEbay);
            ?>
            <img title="ebay" alt="ebay" src="<?php echo JURI::base() ?>templates/gk_musicity/images/style/ebayLogo.png" class="ebayLogo">
	</div><!-- div#ebay close -->

	</div>

