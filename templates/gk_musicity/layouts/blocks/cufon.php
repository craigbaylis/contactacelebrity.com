<?php 

	if($this->_tpl->params->get('font_method') == 2) {
		if($this->getParam('google_font','none') != 'none'){
			echo '<link href="http://fonts.googleapis.com/css?family='.$this->getParam('google_font').'" rel="stylesheet" type="text/css" />';
		}

		if($this->getParam('google_font1','none') != 'none'){
			if($this->getParam('google_font1') != $this->getParam('google_font')){
				echo '<link href="http://fonts.googleapis.com/css?family='.$this->getParam('google_font1').'" rel="stylesheet" type="text/css" />';		
			}
		}
	}

?>

<?php

if($this->_tpl->params->get('font_method') == 3) {
	if($this->getParam('squirell_dirname','') != ''){
		echo '<link href="'. $this->templateurl() . '/fonts/' . $this->getParam('squirell_dirname') . '/stylesheet.css" rel="stylesheet" type="text/css" />';
	}

	if($this->getParam('squirell_dirname','') != $this->getParam('squirell_dirname1','')) {
		if($this->getParam('squirell_dirname1','') != ''){
			echo '<link href="'. $this->templateurl() . '/fonts/' . $this->getParam('squirell_dirname1') . '/stylesheet.css" rel="stylesheet" type="text/css" />';
		}
	}
}	

?>

<style type="text/css">	

	body,
	#gk-mainnav .level0 > li li {
		font-family: <?php echo $this->fontFamily($this->getParam('font_family',1), $this->getParam('google_font','none'), ''); ?>;
	}
	
    h1,
    h2,
    h3,
    #jc h4,
    .componentheading,
    .contentheading, 
    .article-content h4,
    #gk-mainnav .level0 > li,
    #gk-subnav > div > ul > li, 
    .itemDateCreated,
    .itemComments ul.itemCommentsList li span.commentAuthorName,
    .itemComments ul.itemCommentsList li span.commentDate,
    .itemNavigation,
    ul.gk_tab_ul-style1 li span,
    .gk_js_members_main .gk_js_tabs span,
    .gk_is_text_title,
    .blogcreatedate, 
	body #community-wrap div.greybox a#joinButton,
	div.ctitle, body #community-wrap #profile-new-status label,
	#comments .comment-author, 
	#comments .author-homepage,
	#comments .comment-date,
    #Kunena #ktab li,
    #Kunena tr.ksth,
    #Kunena li.kpost-username,
    #Kunena div.kthead-title,
    #Kunena .kwholegend span 
	{
		font-family: <?php echo $this->fontFamily($this->getParam('font_family1', 1), $this->getParam('google_font1','none'), '1'); ?>;
	}

</style>