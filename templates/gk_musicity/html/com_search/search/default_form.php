<?php defined('_JEXEC') or die('Restricted access'); ?>

<form id="searchForm" action="<?php echo JRoute::_( 'index.php?option=com_search' );?>" method="post" name="searchForm">	
    	
        <p>
				<label for="search_searchword">
					<?php echo JText::_( 'Search Keyword' ); ?>:
				</label>

				<input type="text" name="searchword" id="search_searchword" size="30" maxlength="20" value="<?php echo $this->escape($this->searchword); ?>" class="inputbox" />
			
				<button name="Search" onclick="this.form.submit()" class="button"><?php echo JText::_( 'Search' );?></button>
			
		</p>
		
	<div class="search_params">
    	<p>
				<?php echo $this->lists['searchphrase']; ?>
	
				<?php echo $this->lists['ordering'];?>
				<label for="ordering">
					<?php echo JText::_( 'Ordering' );?>
				</label>
			</td>
		</p>
	
    <?php if ($this->params->get( 'search_areas', 1 )) : ?>
		<p>
        <?php echo JText::_( 'Search Only' );?>:
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array( $this->searchareas['active'] ) && in_array( $val, $this->searchareas['active'] ) ? 'checked="checked"' : '';
		?>
		<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area_<?php echo $val;?>" <?php echo $checked;?> />
			<label for="area_<?php echo $val;?>">
				<?php echo JText::_($txt); ?>
			</label>
		<?php endforeach; ?>
		</p>
	<?php endif; ?>
    </div>

	<p>
			<?php echo JText::_( 'Search Keyword' ) .' <b>'. $this->escape($this->searchword) .'</b>'; ?> | <?php echo $this->result; ?>
	</p>

<input type="hidden" name="task"   value="search" />
</form>
