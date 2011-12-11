<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<table width="100%" border="0">
    <tr>
        <td width="55%" valign="top">
            <div id="cpanel">
                <div style="float:left;">
                    <div class="icon">
                        <a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=celebrities') ?>">
                        <?php echo JHTML::_('image', 'administrator/templates/khepri/images/header/icon-48-install.png' , NULL, NULL ); ?>
                        <span>Celebrity<br />Management</span></a>
                    </div>
                </div>
                <div style="float:left;">
                    <div class="icon">
                        <a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=addresses') ?>">
                        <?php echo JHTML::_('image', 'administrator/templates/khepri/images/header/icon-48-install.png' , NULL, NULL ); ?>
                        <span>Address<br />Management</span></a>
                    </div>
                </div>                
            </div>
        </td>
        <td width="45%" valign="top">
            <?php
                echo $this->pane->startPane( 'stat-pane' );
                echo $this->pane->startPanel( JText::_('WELCOME_TO_CONTACT_CELEBRITY') , 'welcome' );
            ?>
            <table class="adminlist">
                <tr>
                    <td>
                        <div style="font-weight:bold;">
                            <?php echo JText::_('ADMIN_DASHBOARD_COMING_SOON');?>
                        </div>
                        <p>
                         We use this area for anything you want to know about when you first login. Statistics is just one example. Total Celebrites, Total Memebers, Total Unapproved Addresses, etc.
                        </p>
                    </td>
                </tr>
            </table>
            <?php
                echo $this->pane->endPanel();
                echo $this->pane->endPane();
            ?>
        </td>
    </tr>
</table>