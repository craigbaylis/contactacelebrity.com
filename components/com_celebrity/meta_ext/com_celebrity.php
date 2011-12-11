<?php

// no direct access
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );
// init languages system
global $shMosConfig_locale, $sh_LANG, $mainframe;
$sefConfig = & shRouter::shGetConfig();

$shLangName = empty($lang) ? $shMosConfig_locale : shGetNameFromIsoCode( $lang);
$shLangIso = isset($lang) ? $lang : shGetIsoCodeFromName( $shMosConfig_locale);

global $shCustomTitleTag, $shCustomDescriptionTag, $shCustomKeywordsTag, $shCustomLangTag, $shCustomRobotsTag, $shCanonicalTag;

$task = JRequest::getCmd('task');
$type = JRequest::getCmd('type');
$session = JFactory::getSession();
$celebrityNames = $session->get('celebrityNames', null, 'com_celebrity.search.alpha.desc');
$maxDescLength = 170;
switch ($task)
{
    case 'details':
        break;
    
    case 'search':
        if($type == 'alpha'){
            $letter = JRequest::getWord('letter');
            $celebrities = '';
            $shCustomTitleTag = JText::sprintf('ALPHASEARCHTITLE',$letter,$letter);
            $shCustomDescriptionTag = JText::sprintf('ALPHASEARCHDESC',$letter,$celebrityNames);
            if(strlen($shCustomDescriptionTag)> $maxDescLength){
                $shCustomDescriptionTag = substr($shCustomDescriptionTag,0,($maxDescLength - 3)).'...';
            }    
        }
        break;
    
    default:
        $dosef = false;
}

?>
