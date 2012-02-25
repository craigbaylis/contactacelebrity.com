<?php

/*
#------------------------------------------------------------------------
# Copyright (C) 2007-2010 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com   
#------------------------------------------------------------------------ 
# Based on T3 Framework
#------------------------------------------------------------------------
# Copyright (C) 2004-2009 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - GNU/GPL, http://www.gnu.org/copyleft/gpl.html
# Author: J.O.O.M Solutions Co., Ltd
#------------------------------------------------------------------------
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

// Load the form validation behavior
JHTML::_('behavior.formvalidation');
if(JPluginHelper::isEnabled('authentication', 'openid')) :
		$lang = &JFactory::getLanguage();
		$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );
		$langScript = 	'var JLanguage = {};'.
						' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.
						' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.
						' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.
						' var comlogin = 1;';
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration( $langScript );
		JHTML::_('script', 'openid.js');
endif;
?>
<style>
#gk-current-content-wrap{
background:none;
padding-top:0px;
padding-left:0px;
}
#component .login_form label{
line-height:15px;
width:100px;	
}
#gkLogin h2, #gkRegister h2{
margin-left:5px;
margin-top:5px;	
}
#component .login_form{
margin:15px 15px 15px 15px	
}
#component .form-register{
margin:15px 15px 15px 15px;
line-height:20px;

}
#name{
	margin-left:0px;
	margin-top:0px;
}
</style>
<div class="width960">
<div id="gkLogin">
      <h2>Login</h2>
   <form action="<?php echo JRoute::_( 'index.php', true, $this->params->get('usesecure')); ?>" method="post" name="com-login" id="com-form-login" class="login_form<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
              <?php if ( $this->params->get( 'description_login' ) ) : ?>
            <div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' );?> clearfix">
                  <?php if ($this->params->get('description_login')) : ?>
                  <p>
                        <?php echo $this->params->get('description_login_text'); ?>
                  </p>
                  <?php endif; ?>
            </div>
            <?php endif; ?>
            <fieldset>
                  <p class="name">
                      <label for="username"><?php echo JText::_('Email') ?></label>
		<input name="username" id="username" type="text" class="inputbox" alt="username" size="32"/>
                  </p>
                  <p class="pass">
                       <label for="passwd"><?php echo JText::_('Password') ?></label>
		<input type="password" id="passwd" name="passwd" class="inputbox" size="32" alt="password" />
                  </p>
                  	<?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
                  <p class="remember">
                     <label for="remember"><?php echo JText::_('Remember me') ?></label>
		<input type="checkbox" id="remember" name="remember" class="inputbox" value="yes" alt="Remember Me" />
                  </p>
                  <?php endif; ?>
                  <p>
                     <input type="submit" name="submit" class="button" value="<?php echo JText::_( 'Login' ); ?>" />
                  </p>
                  <noscript>
                  <?php echo JText::_( 'WARNJAVASCRIPT' ); ?>
                  </noscript>
             <input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $this->return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
            </fieldset>
            <p class="lost-noaccount">
                  <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset#content' ); ?>">
                        <?php echo JText::_('Lost Password?'); ?></a>
                  <?php if ( $this->params->get( 'registration' ) ) : ?>
                  <?php echo JText::_('No account yet?'); ?>
                  <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=register#content' ); ?>">
                        <?php echo JText::_( 'Register' ); ?></a>
                  <?php endif; ?>
            </p>
      </form>
</div>
<?php
		$usersConfig = &JComponentHelper::getParams( 'com_users' );
		if ($usersConfig->get('allowUserRegistration')) : 
?>
<div id="gkRegister">
      <script type="text/javascript">
		Window.onDomReady(function(){
			document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
		});
	</script>
      <h2>Register</h2>
      <form action="<?php echo JRoute::_( 'index.php?option=com_user#content' ); ?>" method="post" id="josForm" name="josForm" class="form-register form-validate user">
            <?php if(isset($this->message)) :
			$this->display('message');
		endif; ?>
         <p class="form-des"><?php echo JText::_('REGISTER_REQUIRED'); ?></p>
            <fieldset>
                 
                  <p class="name">
                        <label id="namemsg" for="name"><?php echo JText::_('Name'); ?>: *</label>
                        <input type="text" name="name" id="name" value="" class="inputbox validate required none namemsg" maxlength="50" />
                  </p>

                  <p class="email">
                        <label id="emailmsg" for="email"><?php echo JText::_('Email'); ?>: *</label>
                        <input type="text" id="email" name="email"  value="" class="inputbox validate required email emailmsg" maxlength="100" />
                  </p>
                  <p class="pass">
                        <label id="pwmsg" for="password"><?php echo JText::_('Password'); ?>: *</label>
                        <input type="password" id="password" name="password" value="" class="inputbox required validate-password" />
                  </p>
                  <p class="verify_pass">
                        <label id="pw2msg" for="password2"><?php echo JText::_('Verify Password'); ?>: *</label>
                        <input type="password" id="password2" name="password2" value="" class="inputbox required validate-passverify" />
                  </p>
            </fieldset>
            <button class="button validate" type="submit"><?php echo JText::_('Register'); ?></button>
            <input type="hidden" name="task" value="register_save" />
            <input type="hidden" name="id" value="0" />
            <input type="hidden" name="gid" value="0" />
            <?php echo JHTML::_( 'form.token' ); ?>
      </form>
</div>
<?php endif; ?>
</div>