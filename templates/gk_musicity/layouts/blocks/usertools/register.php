<?php

	// no direct access
	defined('_JEXEC') or die('Restricted access');

	$url = JURI::getInstance();	
	$user = JFactory::getUser();
	$userID = $user->get('id');

	$popup_class = '';
	
	if(!($this->countModules('login'))) {
		$popup_class = ' class="only-one"';
	}

?>

<?php if(($this->countModules('register') && (($this->_tpl->params->get("register_button",1)) ? $userID == 0 : false))) : ?>	
<div id="register_form"<?php echo $popup_class; ?>>		
	<h3><?php echo JText::_('GK_REGISTER'); ?></h3>
	<jdoc:include type="modules" name="register" style="none" />
</div>		
<?php endif; ?>		