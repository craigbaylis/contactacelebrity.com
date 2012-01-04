<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$image_location = $this->params->get('image_location');
$image_path = DS.str_replace('/',DS,$image_location);

//save the value of the first name in the list to be used for modules
$session = JFactory::getSession();
$session->set('celebrity_name_search_result',$this->celebrities[0]->name);

$alansworkip = '174.31.231.205';
$kevinshomeip = '189.24.194.252';
$localhost = '127.0.0.1';
$blockips = array();

if(!JRequest::getCmd('letter')){
	if(isset($_POST['searchword'])){
		$letter = str_replace("+"," ",$_POST['searchword']);//JRequest::getCmd('searchword');	
	} else {
		$letter = str_replace("+"," ",$_GET['searchword']);
	}
} else {
$letter = JRequest::getCmd('letter');
}
//set the text dependeding on if the user chose a letter or a number search from the browse search
if($this->searchType == 'browse'){
    if ($letter == '9') {
        $browsetype = 'number';
        $letter = '0-9';
    } else {
        $browsetype = 'letter';
    }
} else {
    $browsetype = 'all';
}
?>
<script type="text/javascript">
    GS_googleAddAdSenseService("ca-pub-7953222348963766");
    GS_googleEnableAllServices();
</script>
<script type="text/javascript">
    GA_googleAddSlot("ca-pub-7953222348963766", "<?php echo $this->searchType ?>_mid1_468x60");
    GA_googleAddSlot("ca-pub-7953222348963766", "<?php echo $this->searchType ?>_mid2_468x60");
    GA_googleAddSlot("ca-pub-7953222348963766", "<?php echo $this->searchType ?>_RT1_300x250");
</script>
<script type="text/javascript">
    GA_googleFetchAds();
</script>
<?php 
$style = "
#google_ads_div_".$this->searchType."_mid1_468x60_ad_container, #google_ads_div_".$this->searchType."_mid2_468x60_ad_container {
	text-align:center;
    margin-bottom: 10px;
}
#google_ads_div_".$this->searchType."_RT1_300x250_ad_container{
    text-align:right;
    margin-top:20px
}
";
$document = JFactory::getDocument();
$document->addStyleDeclaration($style);
?>
<div class="width960">
<?php /*?><?php if(JRequest::getCmd('sr')){?>
    <div id="left">
        <h1 class="search"><?php echo JText::_('No matches were found') ?></h1>
        <p id="browseSearchP"><?php echo 'No matches for "'.JRequest::getCmd('sr').'" were found...we returned celebs starting with the letter '.$letter.'..please search again';?></p>
        <h2 id="browseSearchbox_fukidashi">"
            <?php echo strtoupper($letter) ?>
        "</h2>
    </div>
<?php } elseif(JRequest::getCmd('searchword')) {
	$sr= str_replace("+"," ",$_POST['searchword']);
	?>
    <div id="left">
        <h1 class="search"><?php echo JText::_('MATCHESFOR') ?></h1>
       <h2 id="browseSearchbox_fukidashi">"
            <?php echo strtoupper($sr) ?>
        "</h2>
    </div>
    <?php } else {?>
    <div id="left">
        <h1 class="search"><?php echo JText::_('MATCHESFOR') ?></h1>
              <h2 id="browseSearchbox_fukidashi">"
            <?php echo strtoupper($letter) ?>
        "</h2>
    </div>
    <?php }?><?php */?>
    <?php if(JRequest::getCmd('sr') && JRequest::getCmd('letter')){?>
     <div id="left">
        <h1 class="search"><?php echo JText::_('No matches were found') ?></h1>
        <p id="browseSearchP"><?php echo 'No matches for "'.str_replace("+"," ",$_GET['sr']).'" were found...we returned celebs starting with the letter '.$letter.'..please search again';?></p>
        <h2 id="browseSearchbox_fukidashi">"
            <?php echo strtoupper($letter) ?>
        "</h2>
    </div>
   <?php } elseif(JRequest::getCmd('searchword') || JRequest::getCmd('letter')) {?>
     <div id="left">
        <h1 class="search"><?php echo JText::_('MATCHESFOR') ?></h1>
       <h2 id="browseSearchbox_fukidashi">"
            <?php echo strtoupper($letter) ?>
        "</h2>
    </div>
      
<?php }?>
     
    <div id="rightsearch">
        <h3><?php echo JText::sprintf('TOTALSEARCHRESULTS',$this->total) ?><br><span id="bigOrange"><?php echo JText::_('SEERESULTS') ?></span></h3>
        <p><?php echo JText::sprintf('BROWSESEACHDESC',$browsetype,$letter) ?></p>
    </div>
</div>
<div class="clear"></div>
<div class="width640">
    <h1 class="search"><?php echo JText::_('YOURRESULTS') ?></h1>

    <?php 
        $i = 1;
        $k = 1;
        foreach ($this->celebrities AS $celebrity) :
    ?>
    <ul class="eachResult row<?php echo $k ?>">
        <li class="number"><?php echo $i ?></li>
        <?php if (!file_exists(JPATH_SITE.$image_path.$celebrity->image) || empty($celebrity->image)) {$celebrity->image = JURI::base().'components/com_celebrity/assets/images/'.strtolower('M').'-head.png';} else {$celebrity->image = JURI::root().$this->params->get('image_location').$celebrity->image;} ?>
        <li class="search-image"><a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$celebrity->id.'&Itemid='.$this->itemid) ?>"><img class="headshot" name="celebrity-photo" src="<?php echo $celebrity->image ?>" alt="<?php echo JText::_('Thumbnail picture of').' '.$celebrity->name ?>" title="<?php echo JText::_('Thumbnail picture of').' '.$celebrity->name ?>" /></a></li>
        <li>
            <ul class="listTitle">
                <li><?php echo JText::_('Name') ?>:</li>
                <li><?php echo JText::_('Profession(s)') ?>:</li>
                <li><?php echo JText::_('Famous For') ?>:</li>
                <li><?php echo JText::_('Born') ?>:</li>
            </ul>
        </li>
        <li>
            <ul class="listAnswer">
                <li><?php echo $celebrity->name ?></li>
                <li><?php echo ($celebrity->profession) ? $celebrity->profession: JText::_('Currently Not Available') ?></li>
                <li><?php
				$more = (strlen($celebrity->famous_for)>19)?'...':'';
				 echo ($celebrity->famous_for) ? substr($celebrity->famous_for,0,19).$more: JText::_('Currently Not Available') ?></li>
                <li><?php echo ($celebrity->birthday) ? $celebrity->birthday: JText::_('Currently Not Available') ?></li>
            </ul>
        </li>
        <li><a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$celebrity->id.'&Itemid='.$this->itemid) ?>" class="viewButton"><?php echo JText::_('VIEW') ?></a></li>
    </ul>
    <?php
        if($i == 1){
            //search_mid1_468x60
            if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)){
                echo '<script type="text/javascript">
                    GA_googleFillSlot("'.$this->searchType.'_mid1_468x60");
                </script>';
            }            
        }
        if($i == 5){
            //search_mid2_468x60
            if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)){
                echo '<script type="text/javascript">
                    GA_googleFillSlot("'.$this->searchType.'_mid2_468x60");
                </script>';
            }            
        }        
        $i++;
        $k = 1 - $k;
        endforeach;
    ?>
    <?php echo $this->pagination->getPagesLinks() ?>
    <div class="clr"></div>
    <div id="addressRequest">
        <a href="<?php echo JRoute::_('index.php?option=com_celebrity&task=add&controller=celebrity') ?>" id="addressRequestLink">
            <img width="275" height="103" title="Celebrity not in our database? Request an address here!" alt="addressRequest" src="<?php echo JURI::root() ?>templates/gk_musicity/images/style/addressRequest.png">
        </a>
    </div>
</div>
<div style="margin-right:40px;float: right;">
<img src="<?php echo JURI::base().'modules/mod_celebrityaddresses/assets/images/spacer.png' ?>" alt="Successes" width="18" height="1" />
<!-- browse_RT1_300x250 -->
<?php if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)): ?>
<script type='text/javascript'>
GA_googleFillSlot("<?php echo $this->searchType ?>_RT1_300x250");
</script>
<?php endif; ?>
</div>
<div style="float: right;">
<?php
if(JRequest::getCmd('searchword'))
{
?>
    <div id="ebay">
            <h1 class="search"><?php echo JText::_('FUNITEMS') ?></h1>
            <?php 
                $myEbay = JModuleHelper::getModule('MyEbay_Search','MyEbay_Search module');
                echo JModuleHelper::renderModule($myEbay);
            ?>
            <img title="ebay" alt="ebay" src="<?php echo JURI::base() ?>templates/gk_musicity/images/style/ebayLogo.png" class="ebayLogo">
    </div>
    <?php } else { ?>
    <div id="ebay">
            <h1 class="search"><?php echo JText::_('FUNITEMS') ?></h1>
            <?php 
                $myEbay = JModuleHelper::getModule('myebay','MyEbay module');
                echo JModuleHelper::renderModule($myEbay);
            ?>
            <img title="ebay" alt="ebay" src="<?php echo JURI::base() ?>templates/gk_musicity/images/style/ebayLogo.png" class="ebayLogo">
    </div>
    
    <?php } ?>
</div>
<div style="margin-right:40px;float: right;">
    <div id="thankYou">
        <p>
            <span class="big">"</span><?php echo JText::_('CACTHANKYOU') ?>
        </p>
    </div>
</div>

