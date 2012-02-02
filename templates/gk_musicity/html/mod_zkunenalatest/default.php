<?php
/**
 * @version		0.40
 * @package		zKunenaLatest
 * @author		Aaron Gilbert {@link http://www.nzambi.braineater.ca}
 * @author		Created on 08-Dec-2010
 * @copyright	Copyright (C) 2009 - 2010 Aaron Gilbert. All rights reserved.
 * @license		GNU/GPL, see http://www.gnu.org/licenses/gpl-2.0.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::stylesheet('zk_latest.css','modules/mod_zkunenalatest/assets/'); ?>
<div class="forumPost">
<div id="zKlatest">
<?php if ($params->get('addHeader', 0)) : ?>
	<div id="zKlatestHeader"><?php echo $params->get('headerText', '') ?></div>
<?php endif; ?>
<div id="Kboxwrap<?php echo $module->id ?>" class="Kboxwrap kwrap" >
<?php foreach($list as $item) : ?>
	<div class="Kboxgridwrap" >
        <div class="Kboxgrid captionfull<?php echo $module->id ?>">
        <?php if($params->get('showAvatar', 1) == 1 ) :?>
        	<div class="zKlatestAvatar_left">
        		<?php echo modZKunenaLatestHelper::getAvatar( $item->userid, $params ); ?>
            </div>
        <?php elseif($params->get('showAvatar') == 2) :?>
        	<div class="zKlatestAvatar_left">
        		<?php echo modZKunenaLatestHelper::getTopicIcon( $item, $params ); ?>
            </div>
        <?php endif ;?>
            <div class="zKlatestSubject">
                <?php echo modZKunenaLatestHelper::getSubject($item, $params); ?>
                <?php if (($params->get('showNew', 1))&& ($item->unread)) :?>
                <span class="zKlatestUnread">
                    <?php echo modZKunenaLatestHelper::getNew($item, $params);  ?>
                </span>
                <?php endif;?>
            </div>
            <?php if ($params->get('showAuthor', 1)) : ?>
            <div class="zKlatestAuthor">
				<?php 
                echo $params->get( 'authorPrefix', 'by' ). ' ';
                echo CKunenaLink::GetProfileLink ($item->userid, $item->name);
                ?>
            </div>
            <?php endif; ?>

            <?php if ($params->get('showTime')) : ?>
            <div class="zKlatestDatetime">
                <?php echo modZKunenaLatestHelper::getPostDate($item, $params)?>
            </div>
            <?php endif; ?>
            <?php if(!$params->get('noMooFX', 0 )) : ?>
            <div class="cover Kboxcaption">
                <?php echo modZKunenaLatestHelper::getSubject($item, $params); ?>
                <span class="zKlatestMessage"><?php echo modZKunenaLatestHelper::getMessage($item, $params); ?></span>
                <div class="Kboxbottom">
                    <div class="Kboxbottomleft">
                        <?php echo modZKunenaLatestHelper::getTopic($item, $params); ?>
                    </div>
                    <div class="Kboxbottomright profilelink ">
                        <?php echo CKunenaLink::GetProfileLink ($item->userid, $item->name);?>
                    </div>
                </div><!--bottomKbox -->
            </div><!--Kboxcaption cover  -->
            <?php endif; ?>
        </div>
    </div>	
<?php endforeach; ?>
</div>
<?php /*?><?php if ($params->get('allowLink',1)) : ?>
	<span class="small"> <?php echo modZKunenaLatestHelper::getCredit() ;?> </span>
<?php endif;?><?php */?>
</div>
</div>