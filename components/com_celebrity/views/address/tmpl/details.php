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
?>
<div class = "moduletable">
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
</div>