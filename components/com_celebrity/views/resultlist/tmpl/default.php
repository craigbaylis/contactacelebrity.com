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
		<?php echo JText::_( 'DATE_SENT' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'RECEIVED_TYPE_ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'DATE_RECEIVED' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'COMMENTS' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'ADDRESS_ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'QUALITY_ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'CREATED_BY_ID' ); ?>
	</th>
	<th class="jcb_fieldDiv jcb_fieldLabel">
		<?php echo JText::_( 'PUBLISHED' ); ?>
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
	$link = JRoute::_( "index.php?option=com_celebrity&view=result&id={$dataItem->id}" );
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
		<?php echo $dataItem->date_sent; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->received_type_id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->date_received; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->comments; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->address_id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->quality_id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->created_by_id; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->published; ?>
	</td>
	<td class="jcb_fieldDiv jcb_fieldValue">
		<?php echo $dataItem->date_created; ?>
	</td>

<!-- Joomla! Component Builder - begin code  -->
		</tr>
<?php endforeach; ?>
	<tbody>
</table>

<table>
  <thead>
    <tr>
      <th class="jcb_fieldDiv jcb_fieldLabel"><?php echo JText::_( 'Added' ); ?></th>
      <th class="jcb_fieldDiv jcb_fieldLabel"><?php echo JText::_( 'Celebrity Name' ); ?></th>
      <th class="jcb_fieldDiv jcb_fieldLabel"<?php echo JText::_( 'Status' ); ?>></th>
      <th class="jcb_fieldDiv jcb_fieldLabel"><?php echo JText::_( 'Date Sent' ); ?></th>
      <th class="jcb_fieldDiv jcb_fieldLabel"><?php echo JText::_( 'Received' ); ?></th>
      <th class="jcb_fieldDiv jcb_fieldLabel"><?php echo JText::_( 'Trakker Notes' ); ?></th>
      <th class="jcb_fieldDiv jcb_fieldLabel"><?php echo JText::_( 'Photo/Edit/Delete' ); ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="jcb_fieldDiv jcb_fieldValue">12/21/2008</td>
      <td class="jcb_fieldDiv jcb_fieldValue">Robert Hayes</td>
      <td class="jcb_fieldDiv jcb_fieldValue">Success</td>
      <td class="jcb_fieldDiv jcb_fieldValue">12/31/2008</td>
      <td class="jcb_fieldDiv jcb_fieldValue">09/25/2009</td>
      <td class="jcb_fieldDiv jcb_fieldValue">I Hope he sends it to me.</td>
      <td class="jcb_fieldDiv jcb_fieldValue"><a href="#"><img src="<?php echo JURI::base().'/components/com_celebrity/assets/images/photos.png' ?>" border="0" /></a><a href="#"><img src="<?php echo JURI::base().'/components/com_celebrity/assets/images/blog.png' ?>" border="0" /></a><a href="#"><img src="<?php echo JURI::base().'/components/com_celebrity/assets/images/trash.png' ?>" border="0" /></a></td>
    </tr>
  </tbody>
  <tfoot>
  </tfoot>
</table>
