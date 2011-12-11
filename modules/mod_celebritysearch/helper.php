<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
class modCelebritySearchHelper
{
    public function getLetters()
    {
        $Itemid = '';
        $menus = JSite::getMenu();
        $menu = $menus->getItems('link','index.php?option=com_celebrity&view=search',true);
        if(!empty($menu)) $Itemid = '&Itemid='.$menu->id;
        $letterArray = range('A','Z');
        $results = '';
        foreach ($letterArray as $letter) {
            $url = JRoute::_('index.php?option=com_celebrity&view=search&task=search&type=alpha&letter='.$letter.$Itemid);
            $results .= '<a id="letter'.$letter.'" href="'.$url.'" class="search-letter">'.$letter.'</a>';
        }
        return $results;
    }
    
    public function getNumbers()
    {
        $Itemid = '';
        $menus = JSite::getMenu();
        $menu = $menus->getItems('link','index.php?option=com_celebrity&view=search',true);
        if(!empty($menu)) $Itemid = '&Itemid='.$menu->id;
        return '<a id="letter9" href="'.JRoute::_('index.php?option=com_celebrity&view=search&task=search&type=alpha&letter=9'.$Itemid).'" class="search-letter">[0-9]</a>';
    }
 }
?>