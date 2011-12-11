<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div class="col100">
        <fieldset class="adminform">
            <legend><?php echo JText::_('DETAILS') ?></legend>
        
            <table class="admintable">
                <tr>
                    <td align="right" class="key">
                        <label for="first_name"><?php echo JText::_('CELEBFIRSTNAME')?></label>
                    </td>
                    <td>
                        <input class="inputbox" type="text" name="first_name" id="first_name" size="25" value="<?php echo $this->celebrity->first_name ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right" class="key">
                        <label for="middle_name"><?php echo JText::_('CELEBMIDDLENAME')?></label>
                    </td>
                    <td>
                        <input class="inputbox" type="text" name="middle_name" id="middle_name" size="25" value="<?php echo $this->celebrity->middle_name ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right" class="key">
                        <label for="last_name"><?php echo JText::_('CELEBLASTNAME')?></label>
                    </td>
                    <td>
                        <input class="inputbox" type="text" name="last_name" id="last_name" size="25" value="<?php echo $this->celebrity->last_name ?>" />
                    </td>
                </tr>                               
            </table>
            
        </fieldset>
    </div>
    
    <div class="clr"></div>
    
    <input type="hidden" name="option" value="<?php echo JRequest::getCmd('option') ?>" />
    <input type="hidden" name="id" value="<?php echo $this->celebrity->id ?>" />
    <input type="hidden" name="task" value="" />
</form>