<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$lang = JFactory::getLanguage();
$lang->load('com_celebrity',JPATH_SITE);
?>
<form action="index.php" method="post" name="adminForm">
    <table class="adminlist">
        <thead>
            <tr>
                <th width="10"><?php echo JText::_('ID') ?></th>
                <th width="10"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->addresses) ?>)" /></th>
                 <th><?php echo JText::_('CELEBRITY') ?></th>
                <th><?php echo JText::_('COMPANY') ?></th>
                <th><?php echo JText::_('ADDRESSLINE1') ?></th>
                <th><?php echo JText::_('ADDRESSLINE2') ?></th>
                <th><?php echo JText::_('CITYTOWN') ?></th>
                <th><?php echo JText::_('COUNTRY') ?></th>
                <th><?php echo JText::_('STATEPROVINCE') ?></th>
                <th><?php echo JText::_('ZIPCODE') ?></th>
                <th><?php echo JText::_('TYPE') ?></th>
                <th><?php echo JText::_('VENUESTARTDATE') ?></th>
                <th><?php echo JText::_('VENUEENDDATE') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $k = 0;
            $i = 0;
            
            foreach ($this->addresses as $row){
                $checked    = JHTML::_('grid.id', $i, $row->id);
                $published  = JHTML::_('grid.published', $row, $i);
                $link       = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=edit&cid[]='.$row->id.'&hidemainmenu=1');
                
        ?>
         <tr class="<?php echo "row$k" ?>">
            <td><?php echo $row->id ?></td>
            <td><?php echo $checked ?></td>
            <td><a href="#"><?php echo $row->company ?></a></td>
            <td><a href="#"><?php echo $row->company ?></a></td>
            <td><a href="#"><?php echo $row->line_1 ?></a></td>
            <td><a href="#"><?php echo $row->line_2 ?></a></td>
            <td><a href="#"><?php echo $row->city ?></a></td>
            <td><a href="#"><?php echo $row->country ?></a></td>
            <td><a href="#"><?php echo $row->state ?></a></td>
            <td><a href="#"><?php echo $row->zipcode ?></a></td>
            <td><a href="#"><?php echo $row->type ?></a></td>
            <td><a href="#"><?php echo $row->start ?></a></td>
            <td><a href="#"><?php echo $row->end ?></a></td>
         </tr>
         <?php 
           $k = 1 - $k;
           $i++;
            }
         ?>
        </tbody>
    </table>
    <input type="hidden" name="option" value="<?php echo JRequest::getVar('option') ?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <input type="hidden" name="hidemainmenu" value="0" />
</form>