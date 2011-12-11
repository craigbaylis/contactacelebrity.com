<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
$data = $this->data;
$link = JRoute::_( "index.php?option=com_celebrity&view=result&id={$data->id}" );
?>
<div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_SENT' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_sent; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'RECEIVED_TYPE_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->received_type_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_RECEIVED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_received; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'COMMENTS' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->comments; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ADDRESS_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->address_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'QUALITY_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->quality_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'RECEIVED_IMAGE_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->received_image_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'CREATED_BY_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->created_by_id; ?></span>
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
