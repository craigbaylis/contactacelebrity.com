<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php jimport( 'joomla.html.editor' ); $editor =& JFactory::getEditor(); ?>
<?php jimport( 'joomla.html.html' ); ?>
<?php $data =& $this->data; ?>
<script type="text/javascript">

	function submitbutton(pressbutton)	{
		var form = document.adminForm;
	
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
	
		// remove this code
		alert ('<?php echo 'Remember to add js check in after line: ' . __LINE__; ?>');
		submitform( pressbutton );
		return;
		// end remove this code
	
		// do field validation
		if (form.My_Field_Name.value == "") {
			alert( "<?php echo JText::_( 'Field must have a name', true ); ?>" );
		} else if (form.My_Field_Name.value.match(/[a-zA-Z0-9]*/) != form.My_Field_Name.value) {
			alert( "<?php echo JText::_( 'Field name contains bad caracters', true ); ?>" );
		} else if (form.My_Field_Name_typefield.options[form.My_Field_Name_typefield.selectedIndex].value == "0") {
			alert( "<?php echo JText::_( 'You must select a field type', true ); ?>" );		
		} else {
			submitform( pressbutton );
		}
	}

</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
		<table class="admintable">
<!-- jcb code -->
<tr>
	<td width="100" align="right" class="key">
		<label for="title">
			<?php echo JText::_( 'Title' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="title" id="title" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->title, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="caption">
			<?php echo JText::_( 'Caption' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="caption" id="caption" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->caption, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="file_name">
			<?php echo JText::_( 'File Name' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="file_name" id="file_name" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->file_name, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
    <td width="100" align="right" class="key">
        <label for="file_name">
            <?php echo JText::_( 'File Ext' ); ?>:
        </label>
    </td>
    <td>
        <input class="text_area" type="text" name="file_ext" id="file_ext" size="5" maxlength="5" value="<?php echo htmlspecialchars($this->data->file_ext, ENT_COMPAT, 'UTF-8');?>" />
    </td>
</tr>
<tr>
    <td width="100" align="right" class="key">
        <label for="file_name">
            <?php echo JText::_( 'Result Id' ); ?>:
        </label>
    </td>
    <td>
        <input class="text_area" type="text" name="result_id" id="result_id" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->file_name, ENT_COMPAT, 'UTF-8');?>" />
    </td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="published">
			<?php echo JText::_( 'Published' ); ?>:
		</label>
	</td>
	<td>
		<?php echo JHTML::_('select.booleanlist', 'published', null, $this->data->published, JText::_( 'yes' ), JText::_( 'no' ), false); ?>
	</td>
</tr>
<!-- jcb code -->

		</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_celebrity" />
<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="resultreceivedimage" />
</form>
