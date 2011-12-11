<?php

/**
* Gavick Image Show - Style 1
* @package Joomla!
* @Copyright (C) 2009 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0.0 $
**/

// access restriction
defined('_JEXEC') or die('Restricted access');

$uri = JURI::getInstance();

?>

<script type="text/javascript">
	try {$Gavick;}catch(e){$Gavick = {};};
	$Gavick["gk_is-<?php echo $this->module_id;?>"] = {
		"anim_speed": <?php echo $dataForJSEngine["animation_speed"];?>,
		"anim_interval": <?php echo $dataForJSEngine["animation_interval"];?>,
		"autoanim": <?php echo $dataForJSEngine["autoanimation"];?>,
		"anim_type": "<?php echo $dataForJSEngine["animation_type"];?>",
		"slide_links": <?php echo $dataForJSEngine["slide_links"]; ?>
	};
</script>

<script type="text/javascript" src="<?php echo $uri->root(); ?>templates/gk_musicity/js/gk.image_show.js"></script>