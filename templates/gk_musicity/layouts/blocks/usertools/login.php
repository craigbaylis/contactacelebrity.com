<?php

	// no direct access
	defined('_JEXEC') or die('Restricted access');

	$url = JURI::getInstance();	
	$user = JFactory::getUser();
	$userID = $user->get('id');
	$popup_class = '';
	
	if(!(($this->countModules('register') && (($this->_tpl->params->get("register_button",1)) ? $userID == 0 : false)))) {
		$popup_class = ' class="only-one"';
	}

?>

<?php if($this->countModules('login')) : ?>		
<div id="login_form"<?php echo $popup_class; ?>>
	<h3><?php echo JText::_(($userID == 0) ? 'GK_LOGIN' : 'GK_ACCOUNT'); ?></h3>
	<jdoc:include type="modules" name="login" style="none" />
</div>
<?php endif; ?>	