<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
	
$user =& JFactory::getUser();
$userID = $user->get('id');
$btn_login_text = ($userID == 0) ? JText::_('GK_LOGIN') : JText::_('GK_LOGOUT');

?>

<div id="gk-top-interface" class="main">
	<?php if ($this->getParam('logoType')!=='none'): ?>
		<?php if ($this->getParam('logoType')=='image'): ?>
		<h1 class="logo">
		      <a href="/" title="<?php echo $this->sitename(); ?>"><?php echo $this->sitename(); ?></a>
		</h1>
		<?php elseif($this->getParam('logoType')=='text') : ?>
		<h1 class="logo text">
		    <a href="/" title="<?php echo $this->sitename(); ?>"><?php echo GK_LOGO; ?></a>
		    <small class="site-slogan"><?php echo GK_SLOGAN;?></small>
		</h1>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(GK_REGISTER || GK_LOGIN) { ?>
	<div id="gk-buttons">
		<?php if($userID == 0) { ?>
		<a href="<?php echo JRoute::_('index.php?option=com_content&itemid=40&id=5') ?>" id="register"><?php echo JText::_('GK_REGISTER'); ?></a>
		<?php }else{ 
            /* HACK to display UPGRADE link to Free Members */
            //Get the AEC class
            require_once( JApplicationHelper::getPath( 'class', 'com_acctexp' ) );
            
           //Get the AEC subscriptions
           $user = &JFactory::getUser();
           $metaUser = new metaUser( $user->id );
           $subscriptions = $metaUser->getAllCurrentSubscriptionsInfo();
            
           if($subscriptions[0]->plan == 1) {
        ?>
        <a href="<?php echo JRoute::_('index.php?option=com_content&itemid=40&id=5') ?>" id="btn_upgrade"><?php echo JText::_('UPGRADE') ?></a>
		<?php }} ?>
		<a href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>" id="btn_login"><?php echo $btn_login_text; ?></a>
    </div>
	<?php } ?>

	<?php if($this->getParam('socialIcons')) : ?>
	<div id="gk-social-icons">
		<?php if($this->getParam('socialIcons1')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons1url', '', true); ?>" id="gk-icons-facebook" target="_blank"><?php echo $this->getParam('socialIcons1text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons2')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons2url', '', true); ?>" id="gk-icons-vimeo" target="_blank"><?php echo $this->getParam('socialIcons2text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons3')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons3url', '', true); ?>" id="gk-icons-twitter" target="_blank"><?php echo $this->getParam('socialIcons3text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons4')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons4url', '', true); ?>" id="gk-icons-delicious" target="_blank"><?php echo $this->getParam('socialIcons4text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons5')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons5url', '', true); ?>" id="gk-icons-buzz" target="_blank"><?php echo $this->getParam('socialIcons5text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons6')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons6url', '', true); ?>" id="gk-icons-digg" target="_blank"><?php echo $this->getParam('socialIcons6text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons7')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons7url', '', true); ?>" id="gk-icons-youtube" target="_blank"><?php echo $this->getParam('socialIcons7text'); ?></a>
		<?php endif; ?>
		<?php if($this->getParam('socialIcons8')) : ?>	
		<a href="<?php echo $this->getParam('socialIcons8url', '', true); ?>" id="gk-icons-myspace" target="_blank"><?php echo $this->getParam('socialIcons8text'); ?></a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>