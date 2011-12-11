<?php if($this->_tpl->params->get("chrome_frame")) : ?>
<meta http-equiv="X-UA-Compatible" content="chrome=1"/>
<?php endif; ?>
<script type="text/javascript">try{delete Function.prototype.bind;}catch(e){}</script>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>

<?php if (!$this->isIE6()) : ?>

<?php
	
	$document =& JFactory::getDocument();
	$headData = $document->getHeadData();
	$scripts_array_keys = array_keys($headData['scripts']);
	$headData['scripts'] = array();
	foreach($scripts_array_keys as $key){
		$headData['scripts'][$key] = 'text/javascript';
		if(preg_match('/mootools.js/',$key)) {
			$headData['scripts'][$this->templateurl().'/js/domready_fix.js'] = 'text/javascript';
		}
	}
	
	$document->setHeadData($headData);
	
	$document->addStylesheet($this->baseurl() . 'templates/system/css/system.css');
	$document->addStylesheet($this->baseurl() . 'templates/system/css/general.css');
	$document->addStylesheet($this->templateurl() . '/css/addons.css');
	$document->addStylesheet($this->templateurl() . '/css/layout.css');
	$document->addStylesheet($this->templateurl() . '/css/template.css');
	$document->addStylesheet($this->templateurl() . '/css/joomla.css');
	$document->addStylesheet($this->templateurl() . '/css/gk_stuff.css');
	$document->addStylesheet($this->templateurl() . '/css/typo.css');
	$document->addStylesheet($this->templateurl() . '/css/formalize.css');
    
    $template_style = '';
    if($this->getParam("stylearea", 1)) $template_style = (isset($_COOKIE['gk48_style']) ? $_COOKIE['gk48_style'] : $this->getParam("template_color", 1));
    else $template_style = $this->getParam("template_color", 1);
    
    if($this->_tpl->params->get("css3")) $document->addStylesheet($this->templateurl() . '/css/css3_style' . $template_style . '.css');	
    $document->addStylesheet($this->templateurl() . '/css/style' . $template_style . '.css');
?>

<!--[if IE 8.0]><link rel="stylesheet" href="<?php echo $this->templateurl(); ?>/css/ie8.css" type="text/css" /><![endif]-->
<!--[if IE 7.0]>
<link rel="stylesheet" href="<?php echo $this->templateurl(); ?>/css/ie.css" type="text/css" />
<style>.clearfix { display: inline-block; } /* IE7xhtml*/</style>
<![endif]-->
<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'></script>
<script type="text/javascript">
var siteurl='<?php echo $this->baseurl();?>';
var tmplurl='<?php echo $this->templateurl();?>';
</script>
<?php
	
    $document->addScript($this->templateurl() . '/js/gk.script.js');
	$document->addScript($this->templateurl() . '/js/mootools.formalize.min.js');
	
	//added to inject js into the head dynamically and event delegation for com_celebrity (Assets, Element.Delegation)
	$document->addScript($this->templateurl() . '/js/mootools-1.2.5.1-more.js');

?>

<?php if (($gkmenu = $this->loadMenu())) $gkmenu->genMenuHead (); ?>
<?php $this->loadBlock('cufon'); ?>

<!--Width of template -->
<style type="text/css">
.main { width: <?php echo $this->getParam('tmplWidth', 'auto', true); ?>; margin: 0 auto; }
</style>

<?php else : ?>
<link href="<?php echo $this->templateurl(); ?>/css/ie6.css" rel="stylesheet"/>
<?php endif; ?> 

<?php if($this->getParam('css_override')) $document->addStylesheet($this->templateurl() . '/css/override.css'); ?>