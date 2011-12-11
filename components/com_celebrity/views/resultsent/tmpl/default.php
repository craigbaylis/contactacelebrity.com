<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
$data = $this->data;
$link = JRoute::_( "index.php?option=com_celebrity&view=resultsent&id={$data->id}" );
?>
<div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'RESULT_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->result_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'SENT_TYPE_ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->sent_type_id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'DATE_CREATED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->date_created; ?></span>
	</div>

</div>
