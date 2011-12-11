<?php

/*
#------------------------------------------------------------------------
# Musicity - #2 2011 template (for Joomla 1.5)
#
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
# Websites: http://www.joomlart.com - http://www.joomlancers.com
#------------------------------------------------------------------------
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
$this->_basewidth = 20;
$positions = array (
	'left1'					=>'left1',
	'left2'					=>'left2',
	'left-mass-top'			=>'left_top',
	'left-mass-bottom'		=>'left_bottom',
	'right1'				=>'right1',
	'right2'				=>'right2',
	'right-mass-top'		=>'right_top',
	'right-mass-bottom'		=>'right_bottom',
	'content-mass-top'		=>'top',
	'content-mass-bottom'	=>'bottom',
	'content-top'			=>'adv_top',
	'content-bottom'		=>'adv_bottom',
	'inset1'				=>'inset1',
	'inset2'				=>'inset2'
);

$this->customwidth('right', $this->_tpl->params->get("right_column"));
$this->customwidth('right2', $this->_tpl->params->get("right2_column"));
$this->customwidth('left', $this->_tpl->params->get("left_column"));
$this->customwidth('left2', $this->_tpl->params->get("left2_column"));
$this->customwidth('inset1', $this->_tpl->params->get("inset1_column"));
$this->customwidth('inset2', $this->_tpl->params->get("inset2_column"));

$this->definePosition ($positions);
$this->loadBlock('definitions');

$user =& JFactory::getUser();
// getting User ID
$userID = $user->get('id');
// defines if register is active
define('GK_REGISTER', ($this->countModules('register') ? $userID == 0 : false));
// defines if login is active
define('GK_LOGIN', $this->countModules('login'));

?>
<?php if ($this->isIE()) : ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php else : ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<?php 
    $this->loadBlock('head'); 
    $this->useCache($this->getParam('css_compress'), $this->getParam('css_cache'));
?>
</head>

<body id="bd" class="fs<?php echo $this->getParam(GK_TOOL_FONT);?> <?php echo $this->browser();?>">
<div id="bg">
	<?php if($this->isIE6() && $this->_tpl->params->get('ie6bar') == 1) : ?>
	<div id="infobar">
	      <a href="http://browsehappy.com"><?php echo JText::_('IE6_BAR'); ?></a>
	</div>
	<?php endif; ?>
	
	<jdoc:include type="message" />
	
	<!-- MAIN NAVIGATION -->
	<div id="gk-top" class="clear">    
	    <div id="gk-top-shadow">
	    	<div id="gk-top-wrap">
	    		<?php $this->loadBlock('top'); ?>
	    		<?php $this->loadBlock('nav'); ?>
	    	</div>
	    </div>
	</div>
		
	<div id="mainPage" class="main">
        <jdoc:include type="modules" name="breadcrumb2" style="xhtml" />
		<!-- HEADER -->
		<?php $this->loadBlock('header'); ?>
		<!-- BANNER 2 MODULE -->
		<?php if( $this->countModules('banner2') ): ?>
		<div id="banner2" class="clearfix clear">
		    <jdoc:include type="modules" name="banner2" style="none" />
		</div>
		<?php endif; ?>
		<!-- TOP MODULES -->
		<?php $this->loadBlock('topsl'); ?>
		<?php if($this->checkComponent() || $this->checkMainbody() || $this->countModules($this->getPositionName('left1').' + '.$this->getPositionName('left2').' + '.$this->getPositionName('left-mass-top').' + '.$this->getPositionName('left-mass-bottom').' + '.$this->getPositionName('right1').' + '.$this->getPositionName('right2').' + '.$this->getPositionName('right-mass-top').' + '.$this->getPositionName('right-mass-bottom').' + '.$this->getPositionName('content-mass-top').' + '.$this->getPositionName('content-mass-bottom').' + '.$this->getPositionName('content-top').' + '.$this->getPositionName('content-bottom').' + '.$this->getPositionName('inset1').' + '.$this->getPositionName('inset2'))) : ?>
		<!-- MAIN CONTAINER -->
		<div id="gk-container">
		    <div class="static clearfix">
		          <div id="gk-mainbody" style="width:<?php echo $this->getColumnWidth('mw') ?>%">
		                <?php $this->loadBlock('left') ?>
		                <?php $this->loadBlock('main') ?>
		          </div>
		          <?php $this->loadBlock('right') ?>
		    </div>
		</div>
		<?php endif; ?>
		<!-- USER MODULES -->
		<?php $this->loadBlock('usersl') ?>
	</div>
</div>
<div id="gk-bottom-wrap" class="clear">
	<!-- BOTTOM MODULES -->
	<?php $this->loadBlock('botsl') ?>
	<!-- FOOTER -->
	<?php $this->loadBlock('footer') ?>
</div>

<?php if($this->_tpl->params->get('t3_logo')) : ?>
<a href="http://wiki.joomlart.com/wiki/JA_Template_Framework/Overview" target="_blank" id="t3_logo">Powered by T3 Framework</a>
<?php endif; ?>

<?php if(GK_LOGIN) : ?>	
<div id="gk-popup-login">	
	<div class="gk-popup-wrap">
		<?php $this->loadBlock('usertools/login'); ?>
	</div>
</div>
<?php endif; ?>

<?php if(GK_REGISTER) : ?>	
<div id="gk-popup-register">	
	<div class="gk-popup-wrap">
		<?php $this->loadBlock('usertools/register'); ?>
	</div>
</div>
<?php endif; ?>

<?php if(GK_LOGIN || GK_REGISTER) : ?>	
<div id="gk-popup-overlay"></div>
<?php endif; ?>

<jdoc:include type="modules" name="debug" />
</body>
</html>