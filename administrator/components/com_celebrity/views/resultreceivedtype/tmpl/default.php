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
	
        // do field validation
        if (form.label.value == "") {
            alert( "<?php echo JText::_( 'Please enter a label', true ); ?>" );        
        } else if(form.name.value == ""){
            alert( "<?php echo JText::_( 'Please enter a name', true ); ?>" );    
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
		<label for="type">
			<?php echo JText::_( 'Label' ); ?>:
		</label>
	</td>
	<td>
		<input class="text_area" type="text" name="label" id="label" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->label, ENT_COMPAT, 'UTF-8');?>" />
	</td>
</tr>
<tr>
    <td width="100" align="right" class="key">
        <label for="type">
            <?php echo JText::_( 'Name' ); ?>:
        </label>
    </td>
    <td>
        <input class="text_area" type="text" name="name" id="name" size="32" maxlength="255" value="<?php echo htmlspecialchars($this->data->name, ENT_COMPAT, 'UTF-8');?>" />
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
<input type="hidden" name="controller" value="resultreceivedtype" />
</form>
