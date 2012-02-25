<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
 $db = JFactory::getDBO();
$query = "select a.id from  `#__celebrity_result` `a` order by a.id desc";
$db->setQuery($query);
$result =$db->loadRow();
$tinytab = JURI::base().'components/com_celebrity/js/tinytab.js';
/*custom*/
$mooltools  = JURI::base().'components/com_celebrity/js/mootools-1.2.5.1-more.js';
$lightbox = JURI::base().'components/com_celebrity/js/LightFace.js';
$more = JURI::base().'components/com_celebrity/js/LightFace.IFrame.js';
$celebrityCss = JURI::base().'components/com_celebrity/assets/css/Assets/LightFace.css';
$document = JFactory::getDocument();
$domready = <<<SCRIPT

window.addEvent('domready',function(){
	document.id('start').addEvent('click',function() {				
				light = new LightFace.IFrame({ height:530, width:530, url: 'https://facebook.com', title: 'Facebook' }).addButton('Close', function() { light.close(); },true).open();
				
			});
	//http://www.facebook.com/sharer.php?u=http://contactacelebrity.st4ging.com/index.php?option=com_celebrity&task=details&view=result&id=$result[0]&cid=$this->cid&aid=$this->aid&anumber=$this->anumber&type=$this->type&Itemid=60		

});
SCRIPT;

$document->addScript($tinytab);
/*custom*/
$document->addScript($mooltools);
$document->addScript($lightbox);
$document->addScript($more);
$document->addStyleSheet($celebrityCss);
/*custom*/
$document->addScriptDeclaration($domready);
?>
<h1><?php echo JText::_('Congratulations!') ?></h1>
<p><?php echo JText::_('Your result has been posted. Click <a href="'.$this->backlink.'">HERE</a> to go back to the celebrity\'s profile') ?>
<?php /*?><script>
var myPopup = window.open("<?php echo 'http://www.facebook.com/sharer.php?u=http://contactacelebrity.st4ging.com/index.php?option=com_celebrity&task=details&view=result&id=$result[0]&cid=$this->cid&aid=$this->aid&anumber=$this->anumber&type=$this->type&Itemid=60';?>", "screenX=100",'name','height=200,width=150');
if (!myPopup)
    alert("failed for most browsers");
else {
    myPopup.onload = function() {
        setTimeout(function() {
            if (myPopup.screenX === 0)
                alert("failed for chrome");
        }, 0);
    };
}
</script><?php */?>
<!--<a href="javascript:;" id="start">click now</a>
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
/*function fireEvent(obj,evt){
	
	var fireOnThis = obj;
	if( document.createEvent ) {
	  var evObj = document.createEvent('MouseEvents');
	  evObj.initEvent( evt, true, false );
	  fireOnThis.dispatchEvent(evObj);
	} else if( document.createEventObject ) {
	  fireOnThis.fireEvent('on'+evt);
	}
}*/

window.onload = function(){
<?php /*?>	newwindow=window.open('http://www.facebook.com/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST']?><?php echo JRoute::_( "index.php?option=com_celebrity&task=details&view=result&id=".$result[0]."&cid=".$this->cid."&aid=".$this->aid."&anumber=".$this->anumber."&type=".$this->type."&Itemid=60");?>','name','height=100,width=500');
	if (window.focus) {newwindow.focus()}
	return false;<?php */?>
	//fireEvent(document.getElementById("kickstart"),'click');
	//document.getElementById('kickstart').click();
	$('#kickstart').click();
	
}

function popupit(){
	newwindow=window.open('http://www.facebook.com/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST']?><?php echo JRoute::_( "index.php?option=com_celebrity&task=details&view=result&id=".$result[0]."&cid=".$this->cid."&aid=".$this->aid."&anumber=".$this->anumber."&type=".$this->type."&Itemid=60");?>','name','height=100,width=500');
	if (window.focus) {newwindow.focus()}
	return false;	
}
</script>

<a href="javascript:;" onclick="popupit();" id="kickstart"></a>
<?php /*?><div style="position: relative; top: -3px;"><a class="class_fshare" name="fb_share" type="button" share_url="http://www.buildweb.eu/index.php?option=com_content&view=article&id=58&Itemid=81&lang=en"></a></script><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></div><?php */?>

<?php /*?><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo JRoute::_( "index.php?option=com_celebrity&task=details&view=result&id=".$result[0]."&cid=".$this->cid."&aid=".$this->aid."&anumber=".$this->anumber."&type=".$this->type."&Itemid=60");?>" title="Share this webpage on Facebook">Share on Facebook</a><?php */?>
</p>