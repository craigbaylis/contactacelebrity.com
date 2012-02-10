<?php
/**
 * sh404SEF support for com_XXXXX component.
 * Author : 
 * contact :
 * 
 * This is a sample sh404SEF native plugin file
 *    
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

// ------------------  standard plugin initialize function - don't change ---------------------------
global $sh_LANG;
$sefConfig = & shRouter::shGetConfig();  
$shLangName = '';
$shLangIso = '';
$title = array();
$shItemidString = '';
$dosef = shInitializePlugin( $lang, $shLangName, $shLangIso, $option);
if ($dosef == false) return;
// ------------------  standard plugin initialize function - don't change ---------------------------

// ------------------  load language file - adjust as needed ----------------------------------------
//$shLangIso = shLoadPluginLanguage( 'com_XXXXX', $shLangIso, '_SEF_SAMPLE_TEXT_STRING');
// ------------------  load language file - adjust as needed ----------------------------------------

// remove common URL from GET vars list, so that they don't show up as query string in the URL
shRemoveFromGETVarsList('option');
shRemoveFromGETVarsList('lang');
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');
if (!empty($limit))  
shRemoveFromGETVarsList('limit');
if (isset($limitstart)) 
  shRemoveFromGETVarsList('limitstart'); // limitstart can be zero
//$task = JRequest::getCmd('task',null);    

// start by inserting the menu element title (just an idea, this is not required at all)
$task = isset($task) ? $task : null;
//$Itemid = isset($Itemid) ? $Itemid : null;
//$option = shGetComponentPrefix($option); 
//$shSampleName = empty($option) ? getMenuTitle($option, $task, $Itemid, null, $shLangName) : $option;
//$shSampleName = (empty($option) || $shSampleName == '/') ? 'SampleCom':$option;

switch ($task) {
	case 'details':
        if (!empty($task)) shRemoveFromGETVarsList('task');
        if (!empty($cid)) shRemoveFromGETVarsList('cid');
        if (!empty($view)) shRemoveFromGETVarsList('view');
        if($view == 'celebrity'){
            $db = JFactory::getDBO();
            //get the celebrity name
            $query = "
                SELECT 
                  LOWER(`a`.`first_name`) as first_name,
                  LOWER(`a`.`last_name`) as last_name
                FROM
                  `#__celebrity_celebrity` `a`
                WHERE
                  `a`.`id` = $cid
            ";
             $db->setQuery($query);
             $results = $db->loadObject();
            $title[] = "$results->first_name-$results->last_name-$cid";
        } elseif($view == 'address'){
            if (!empty($type)) shRemoveFromGETVarsList('type');
            if (!empty($aid)) shRemoveFromGETVarsList('aid');
            if (!empty($anumber)) shRemoveFromGETVarsList('anumber');
			if (!empty($rpage)) shRemoveFromGETVarsList('rpage');
            $db = JFactory::getDBO();
            //get the celebrity name
            $query = "
                SELECT 
                  LOWER(`a`.`first_name`) as first_name,
                  LOWER(`a`.`last_name`) as last_name
                FROM
                  `#__celebrity_celebrity` `a`
                WHERE
                  `a`.`id` = $cid
            ";
             $db->setQuery($query);
             $results = $db->loadObject();
            $title[] = "$results->first_name-$results->last_name-".$type;
            $title[] = $aid.'-'.$anumber;            
        } elseif($view=='result'){
			if (!empty($id)) shRemoveFromGETVarsList('id');
            if (!empty($cid)) shRemoveFromGETVarsList('cid');
            if (!empty($aid)) shRemoveFromGETVarsList('aid');
			if (!empty($anumber)) shRemoveFromGETVarsList('anumber');
			if (!empty($type)) shRemoveFromGETVarsList('type');
			 $db = JFactory::getDBO();
            //get the celebrity name
            $query = "
                SELECT 
                  LOWER(`a`.`first_name`) as first_name,
                  LOWER(`a`.`last_name`) as last_name
                FROM
                  `#__celebrity_celebrity` `a`
                WHERE
                  `a`.`id` = $cid
            ";
             $db->setQuery($query);
             $results = $db->loadObject();
            $title[] = "$results->first_name-$results->last_name-autographs";
			$title[] = $id;         
		}
        break;
        case 'search':
        if($type == 'alpha') {
            if (!empty($task)) shRemoveFromGETVarsList('task');
            if (!empty($type)) shRemoveFromGETVarsList('type');
            if (!empty($view)) shRemoveFromGETVarsList('view');
            if (!empty($letter)) shRemoveFromGETVarsList('letter');
            $title[] = 'celebrity-names';
            $title[] = 'start-letter-'.$letter;
        }
		break;		
        default:
        $dosef = false;
}
  
// ------------------  standard plugin finalize function - don't change ---------------------------  
if ($dosef){
   $string = shFinalizePlugin( $string, $title, $shAppendString, $shItemidString, 
      (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), 
      (isset($shLangName) ? @$shLangName : null));
}      
// ------------------  standard plugin finalize function - don't change ---------------------------
  
