<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$tinytab = JURI::base().'components/com_celebrity/js/tinytab.js';
$domready = <<<SCRIPT
window.addEvent('domready',function(){
    tb = new TinyTab($$('ul.tabs li'),$$('ul.contents li'));
});
SCRIPT;
$document = JFactory::getDocument();
$document->addScript($tinytab);
$document->addScriptDeclaration($domready);

//load module helper to display addresses module
//jimport('joomla.application.module.helper');
//$module = JModuleHelper::getModule('mod_celebrityaddresses');
?>
<div id="celebrity-profile">
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
</div>