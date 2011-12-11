<?php 

/**
 * 
 * GK Joomla! Override by GavickPro
 * 
 * v.1.0.0
 * 
 */

/**
 *
 * CSS classes
 * 
 * .mod_search - selector for main container
 * .mod_search>input#mod_search_searchword - selector for search input
 * .mod_search>input#mod_search_button - selector for search button
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>


<script type="text/javascript">
window.addEvent('load', function(){
	var input = $('mod_search_searchword');
	input.addEvents({
		'blur' : function(){ if(input.value == '') input.value='<?php echo $text; ?>'; },
		'focus' : function(){ if(input.value == '<?php echo $text; ?>') input.value='';	}
	});
	input.value = '<?php echo $text; ?>';
	
	if($('mod_search_button')){
		$('mod_search_button').addEvent('click', function(){ 
			input.focus(); 
		});
	}
});
</script>

<form action="index.php" method="post">
	<div class="mod_search">
 		<input name="searchword" id="mod_search_searchword" maxlength="<?php echo $maxlength; ?>" alt="<?php echo $button_text; ?>" class="inputbox" type="text" size="<?php echo $width; ?>" />
		<?php
            $output = '';
		
			if ($button) :
			    if ($imagebutton) $button = '<input type="image" value="'.$button_text.'" class="button" id="mod_search_button" src="'.$img.'" />';
			    else              $button = '<input type="submit" value="'.$button_text.'" class="button" id="mod_search_button" />';
			endif;

			switch ($button_pos) :
			    case 'top'    : $button = $button.'<br />'; $output = $button.$output; break;
			    case 'bottom' : $button = '<br />'.$button; $output = $output.$button; break;
			    case 'right'  : $output = $output.$button; break;
			    case 'left'   :
			    default       : $output = $button.$output; break;
			endswitch;

			echo $output;
		?>
	</div>
	<input type="hidden" name="task"   value="search" />
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="0" />
</form>