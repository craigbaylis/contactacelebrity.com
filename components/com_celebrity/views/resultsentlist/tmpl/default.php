<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<table>
	<thead>
		<tr>
			<th>
				View
			</th>
<!-- Joomla! Component Builder - begin code  -->
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'RESULT_ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'SENT_TYPE_ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'DATE_CREATED' ); ?>
	</th>

<!-- Joomla! Component Builder - begin code  -->
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="0">
				<div class="jcb_pagination"><?php echo $this->pagination->getPagesLinks(); ?> - <?php echo $this->pagination->getPagesCounter(); ?></div>
			</td>
		</tr>
	</tfoot>
	<tbody>
<?php foreach($this->data as $dataItem): ?> 
<?php
	$link = JRoute::_( "index.php?option=com_celebrity&view=resultsent&id={$dataItem->id}" );
?>
		<tr>
			<td>
				<!-- You can use $link var for link edit controller -->
				<a href="<?php echo $link; ?>">View</a>
			</td>
<!-- Joomla! Component Builder - begin code  -->
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->result_id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->sent_type_id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->date_created; ?>
	</td>

<!-- Joomla! Component Builder - begin code  -->
		</tr>
<?php endforeach; ?>
	<tbody>
</table>

