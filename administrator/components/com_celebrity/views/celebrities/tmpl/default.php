<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="adminForm">
    <table class="adminlist">
        <thead>
            <tr>
                <th width="10"><?php echo JText::_('ID') ?></th>
                <th width="10"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->celebrities) ?>)" /></th>
                <th><?php echo JText::_('First Name') ?></th>
                <th><?php echo JText::_('Middle Name') ?></th>
                <th><?php echo JText::_('Last Name') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $k = 0;
            $i = 0;
            
            foreach ($this->celebrities as $row){
                $checked    = JHTML::_('grid.id', $i, $row->id);
                $published  = JHTML::_('grid.published', $row, $i);
                $link       = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=edit&cid[]='.$row->id.'&hidemainmenu=1');
                
        ?>
         <tr class="<?php echo "row$k" ?>">
            <td><?php echo $row->id ?></td>
            <td><?php echo $checked ?></td>
            <td><a href="<?php echo $link ?>"><?php echo $row->first_name ?></a></td>
            <td><a href="<?php echo $link ?>"><?php echo $row->middle_name ?></a></td>
            <td><a href="<?php echo $link ?>"><?php echo $row->last_name ?></a></td>
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