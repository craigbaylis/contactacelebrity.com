<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
$data = $this->data;
$link = JRoute::_( "index.php?option=com_celebrity&view=resultreceivedimage&id={$data->id}" );
?>
<div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'TITLE' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->title; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'CAPTION' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->caption; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'FILE_NAME' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->file_name; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'PUBLISHED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->published; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_CREATED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_created; ?></span>
	</div>

</div>
