<?php
// no direct access 
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

//include form validation code
require_once(JPATH_SITE.DS.'components'.DS.'com_celebrity'.DS.'helpers'.DS.'loadformvalidation.php');

$domready = <<<SCRIPT
window.addEvent('load', function(){
    var input = $('mod_search_searchword');
    input.addEvents({
        'blur' : function(){ if(input.value == '') input.value='search...'; },
        'focus' : function(){ if(input.value == 'search...') input.value=''; }
        });
        input.value = 'search...';
        if($('mod_search_button')){
            $('mod_search_button').addEvent('click', function(){
            input.focus();
        });
    }
    var celebritySearch = new FormCheck('celebrity-search');
}); 
SCRIPT;

$document->addScriptDeclaration($domready);
?>
<form id="celebrity-search" action="index.php" method="post">
<div id="search-container" class="search-container main">
    <div id="search-group1" class="search-group1">
        <span id="search-title" class="search-title">Celebrity Search</span>
        <input type="text" size="20" class="inputbox validate['required','length[3,-1]']" alt="Search" maxlength="20" id="mod_search_searchword" name="searchword" />
    </div>
    <div id="search-group2" class="search-group2">
        <?php echo JText::_('Browse') ?> - <?php echo $letters ?>&nbsp;<?php echo $numbers ?>
    </div>
    <?php if($params->get('social_network_icons',0)): ?>
    <div style="display:inline;">
    <ul id="socialMedia">
        <li id="twitter"><a href="#"></a></li>
        <li id="facebook"><a href="#"></a></li>
        <li id="rss"><a href="#"></a></li>
    </ul>
    </div>
    <?php endif; ?>
</div>
<input type="hidden" name="option" value="com_celebrity" />
<input type="hidden" name="view" value="search" />
<input type="hidden" name="task" value="search" />
<input type="hidden" name="type" value="all" />
</form>
