<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$name = trim($this->celebrity_name['first_name'].' '.$this->celebrity_name['last_name']);
?>
    <?php if($this->match){ ?>
        <div class="step_body">
            <div class="step_message1"><span><?php echo JText::_('CELEBSFOUND') ?></span></div>
            <ul class="celebs_found">
            <?php foreach($this->celebritys as $celebrity){ ?>
            <li id="celebname" class="celebname"><?php echo $celebrity->first_name.' '.$celebrity->last_name ?></li>
            <?php } ?>
            </ul>
            <div class="step_message2"><span><?php echo JText::_('NOCELEBSRIGHT') ?></span></div>
        </div>
    <?php }else{ ?>
        <div class="step_body">
            <div class="step_message1"><p class="notfound"><?php echo JText::sprintf('NOCELEBSFOUND',$name) ?></p></div>
        </div>
    <?php } ?>