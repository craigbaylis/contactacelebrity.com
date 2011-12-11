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
		alert ('<?php echo 'Remember to add js check at:'. __LINE__; ?>');
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
		<label for="date_sent">
			<?php echo JText::_( 'Date Sent' ); ?>:
		</label>
	</td>
	<td>
		<?php echo JHTML::calendar($this->data->date_sent, 'date_sent', 'date_sent'); ?>
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="received_type_id">
			<?php echo JText::_( 'Received Type Id' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="received_type_id" id="received_type_id" size="32" maxlength="11" value="<?php echo htmlspecialchars($this->data->received_type_id, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="date_received">
			<?php echo JText::_( 'Date Received' ); ?>:
		</label>
	</td>
	<td>
		<?php echo JHTML::calendar($this->data->date_received, 'date_received', 'date_received'); ?>
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="comments">
			<?php echo JText::_( 'Comments' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="comments" id="comments" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->comments, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="address_id">
			<?php echo JText::_( 'Address Id' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="address_id" id="address_id" size="32" maxlength="11" value="<?php echo htmlspecialchars($this->data->address_id, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="quality_id">
			<?php echo JText::_( 'Quality Id' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="quality_id" id="quality_id" size="32" maxlength="11" value="<?php echo htmlspecialchars($this->data->quality_id, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="100" align="right" class="key">
		<label for="created_by_id">
			<?php echo JText::_( 'Created By Id' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="created_by_id" id="created_by_id" size="32" maxlength="11" value="<?php echo htmlspecialchars($this->data->created_by_id, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
	<td width="50" align="right" class="key">
		<label for="published">
			<?php echo JText::_( 'Published' ); ?>:
		</label>
	</td>
	<td>
		<?php echo JHTML::_('select.booleanlist', 'published', null, $this->data->published, JText::_( 'yes' ), JText::_( 'no' ), false); ?>
	</td>
</tr>
<tr>
    <td width="50" align="right" class="key">
        <label for="displayed">
            <?php echo JText::_( 'Displayed' ); ?>:
        </label>
    </td>
    <td>
        <?php echo JHTML::_('select.booleanlist', 'displayed', null, $this->data->displayed, JText::_( 'yes' ), JText::_( 'no' ), false); ?>
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
<input type="hidden" name="controller" value="result" />
</form>
