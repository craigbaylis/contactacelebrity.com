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
$positions = array (
	'content-top'			=>'mobile_top',
	'content-bottom'		=>'mobile_bottom',
);

$this->_basewidth = 20;
$this->definePosition ($positions);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
	<?php $this->loadBlock('iphone/head') ?>
</head>
<body id="bd" onload="updateOrientation()" onorientationchange="updateOrientation()">

	<div id="gk-wrapper">
		<a name="Top" id="Top"></a>
		
		<div id="gk-top">
			<?php $this->loadBlock('iphone/header') ?>
			<?php $this->loadBlock('iphone/mainnav') ?>
		</div>
		
		<div id="gk-content">
		<?php $this->loadBlock('iphone/main') ?>

		<?php $this->loadBlock('iphone/footer') ?>
		</div>
	
	</div>

	<?php
		$document =& JFactory::getDocument();
		$headData = $document->getHeadData();
		$headData["styleSheets"] = array();
		$document->setHeadData($headData);
	?>
</body>
</html>