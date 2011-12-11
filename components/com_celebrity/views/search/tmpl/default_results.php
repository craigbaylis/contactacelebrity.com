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
$blockips = array($localhost, $kevinshomeip);
?>
<style type="text/css">
#google_ads_div_search_mid1_468x60_ad_container, #google_ads_div_search_mid2_468x60_ad_container{
	text-align:center;
}
</style>
<!-- search_mid1_468x60 -->
<?php if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)): ?>
<script type='text/javascript'>
GA_googleFillSlot("search_mid1_468x60");
</script>
<?php endif; ?>
<?php foreach ($this->celebrities AS $celebrity) : ?>
<div id="sr-container">
    <?php if (!file_exists(JPATH_SITE.$image_path.$celebrity->image) || empty($celebrity->image)) {$celebrity->image = JURI::base().'components/com_celebrity/assets/images/'.strtolower('M').'-head.png';} else {$celebrity->image = JURI::root().$this->params->get('image_location').$celebrity->image;} ?>
    <div id="sr-pict">
        <a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$celebrity->id.'&Itemid='.$this->itemid) ?>"><img name="celebrity-photo" src="<?php echo $celebrity->image ?>" width="72" height="95" alt="<?php echo JText::_('Thumbnail picture of').' '.$celebrity->name ?>" title="<?php echo JText::_('Thumbnail picture of').' '.$celebrity->name ?>" /></a>
    </div>
     <div id=sr-extra>
        <div id="sr-name"><span class="sr-title"><?php echo JText::_('Name') ?>:</span><span class="sr-name-text"><a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$celebrity->id.'&Itemid='.$this->itemid) ?>"><?php echo $celebrity->name ?></a></span></div>
        <div id="sr-profession"><span class="sr-title"><?php echo JText::_('Profession(s)') ?>:</span><span class="sr-profession-text"><?php echo ($celebrity->profession) ? $celebrity->profession: JText::_('Currently Not Available') ?></span></div>
        <div id="sr-famous-for"><span class="sr-title"><?php echo JText::_('Famous For') ?>:</span><span class="sr-famous-text"><?php echo ($celebrity->famous_for) ? $celebrity->famous_for: JText::_('Currently Not Available') ?></span></div>
        <div id="sr-bdate"><span class="sr-title"><?php echo JText::_('Born') ?>:</span><span class="sr-bdate-text"><?php echo ($celebrity->birthday) ? $celebrity->birthday: JText::_('Currently Not Available') ?></span></div> 
    </div>
</div>
<?php endforeach; ?>
<?php if(!in_array($_SERVER['REMOTE_ADDR'], $blockips)): ?>
<!-- search_mid2_468x60 -->
<script type='text/javascript'>
GA_googleFillSlot("search_mid2_468x60");
</script>
<?php endif; ?>