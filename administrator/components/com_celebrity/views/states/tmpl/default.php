<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
$lang = JFactory::getLanguage();
$lang->load('com_celebrity', JPATH_SITE);
?>
<form action="index.php" method="post" name="adminForm">
    <table class="adminlist">
        <thead>
            <tr>
                <th width="10"><?php echo JText::_('ID') ?></th>
                <th width="10"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->states) ?>)" /></th>
                <th><?php echo JText::_('STATE') ?></th>
                <th><?php echo JText::_('ABBREVIATION') ?></th>
                <th><?php echo JText::_('COUNTRY') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $k = 0;
            $i = 0;
            
            foreach ($this->states as $row){
                $checked    = JHTML::_('grid.id', $i, $row->id);
                $published  = JHTML::_('grid.published', $row, $i);
                $link       = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=edit&cid[]='.$row->id.'&hidemainmenu=1');
                
        ?>
         <tr class="<?php echo "row$k" ?>">
            <td><?php echo $row->id ?></td>
            <td><?php echo $checked ?></td>
            <td><a href="#"><?php echo $row->state ?></a></td>
            <td><a href="#"><?php echo $row->abbreviation ?></a></td>
            <td><a href="#"><?php echo $row->country ?></a></td>
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