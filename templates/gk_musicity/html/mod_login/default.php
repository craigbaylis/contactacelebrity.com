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

 * .mod_login - selector for main container

 * .mod_login>.greeting - selector for greeting text container

 * .mod_login>.greeting>span - selector for greeting text span

 * .mod_login>.buttons - selector for button container

 * .mod_login>.buttons>.button - selector for submit button 

 * .mod_login>p label - selector for labels

 * .mod_login>p input - selector for text/password inputs

 * .mod_login>p.username - selector for paragraph with username

 * .mod_login>p.password - selector for paragraph with password

 * .mod_login>p.remember - selector for paragraph with remember

 * .mod_login>ul - selector for list with additional options

 * .mod_login>ul li - selector for options

 * .mod_login>ul a - selector for links in options

 * .mod_login>ul a:hover - selector for hover effect of links in options

 * 

 */



// no direct access

defined('_JEXEC') or die('Restricted access');



?>

<div class="mod_login">
     <?php if($type == 'logout') : ?>
     <form action="index.php" method="post" name="login" id="form-login">
          <?php if ($params->get('greeting')) : ?>
          <div class="greeting"> <span>
               <?php if ($params->get('name')) : ?>
               <?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?>
               <?php else : ?>
               <?php echo JText::sprintf( 'HINAME', $user->get('username') ); ?>
               <?php endif; ?>
               </span> </div>
          <?php endif; ?>
          <div class="buttons">
               <input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
          </div>
          <input type="hidden" name="option" value="com_user" />
          <input type="hidden" name="task" value="logout" />
          <input type="hidden" name="return" value="<?php echo $return; ?>" />
     </form>
     <?php else : ?>
     <?php 

	

	if(JPluginHelper::isEnabled('authentication', 'openid')) :

			$lang->load( 'plg_authentication_openid', JPATH_ADMINISTRATOR );

			$langScript = 	'var JLanguage = {};'.

							' JLanguage.WHAT_IS_OPENID = \''.JText::_( 'WHAT_IS_OPENID' ).'\';'.

							' JLanguage.LOGIN_WITH_OPENID = \''.JText::_( 'LOGIN_WITH_OPENID' ).'\';'.

							' JLanguage.NORMAL_LOGIN = \''.JText::_( 'NORMAL_LOGIN' ).'\';'.

							' var modlogin = 1;';

			$document = &JFactory::getDocument();

			$document->addScriptDeclaration( $langScript );

			JHTML::_('script', 'openid.js');

	endif; 

	

	?>
     <form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" >
          <?php echo $params->get('pretext'); ?>
          <p class="username">
               <label for="modlgn_username"><?php echo JText::_('Username') ?></label>
              
               <input id="modlgn_username" type="text" name="username" class="inputbox" alt="username" size="25" />
          </p>
          <p class="password">
               <label for="modlgn_passwd"><?php echo JText::_('Password') ?></label>
             
               <input id="modlgn_passwd" type="password" name="passwd" class="inputbox" size="25" alt="password" />
          </p>
          <?php if(JPluginHelper::isEnabled('system', 'remember')) : ?>
          <p class="remember">
               <label for="modlgn_remember"><?php echo JText::_('Remember me') ?></label>
               <input id="modlgn_remember" type="checkbox" name="remember" class="inputbox" value="yes" alt="Remember Me" />
          </p>
          <?php endif; ?>
          <div class="buttons">
               <input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" />
          </div>
          <ul>
               <li> <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>"> <?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a> </li>
               <li> <a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"> <?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a> </li>
               <?php

				$usersConfig = &JComponentHelper::getParams( 'com_users' );

				if ($usersConfig->get('allowUserRegistration')) : 

			?>
               <li> <a href="<?php echo JRoute::_( 'index.php?option=com_content&itemid=40&id=5' ); ?>"> <?php echo JText::_('REGISTER'); ?></a> </li>
               <?php endif; ?>
          </ul>
          <div style="clear: both;"></div>
          <?php echo $params->get('posttext'); ?>
          <input type="hidden" name="option" value="com_user" />
          <input type="hidden" name="task" value="login" />
          <input type="hidden" name="return" value="<?php echo $return; ?>" />
          <?php echo JHTML::_( 'form.token' ); ?>
     </form>
     <?php endif; ?>
</div>
