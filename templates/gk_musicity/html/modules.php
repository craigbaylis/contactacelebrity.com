<?php

defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.module.helper' );

function modChrome_gavickpro($module, &$params, &$attribs) { 

	$badge = preg_match ('/badge/', $params->get('moduleclass_sfx')) ? "<span class=\"badge\">badge</span>\n" : "";
	$headerLevel = isset($attribs['headerLevel']) ? (int) $attribs['headerLevel'] : 3;
	
	if (!empty ($module->content)) : ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>">
			<div>
				<?php if ($module->showtitle) : ?>				
					<h<?php echo $headerLevel; ?>><?php echo $module->title; ?><?php echo $badge; ?></h<?php echo $headerLevel; ?>>
				<?php endif; ?>
				
	   			<div class="moduletable_content">
	            	<?php echo $module->content; ?>
				</div>
			</div>
		</div>
	<?php endif;	
}

/* EOF */