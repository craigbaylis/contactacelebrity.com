<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
* Addcelebrity class for the Celebrity View
* 
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewCelebrity extends JView
{

    public function display($tpl = null)
    {
        
        //set step details
        $step = JRequest::getVar('step', 1);        
        $this->assignRef('step', $step);
        $this->assign('steptitle', JText::_('STEP'.$step.'TITLE'));
        $this->assign('stepdesc', JText::_('STEP'.$step.'DESC'));
        
        //determine type of task to choose the right layout and set the right variables
        $task = JRequest::getWord('task','add');
        
        switch($task)
        {
            case 'search':
                $celebrity_name = JRequest::getVar('name',null,'POST','ARRAY');
                $model =& $this->getModel();
                $celebritys = $model->getCelebritys($celebrity_name);
                $this->setLayout('_search_results');
                JRequest::setVar('tmpl','component');
                if($celebritys)
                {
                    $this->assign('celebresult',JText::_('CELEBSFOUND'));
                    $this->assign('goahead', JText::_('NOCELEBSRIGHT'));                
                    $this->assignRef('celebritys', $celebritys);
                    $this->assignRef('celebrity_name', $celebrity_name);
                    $this->assign('match',true);   
                }else{
                    $this->assign('celebresult',JText::_('NOCELEBSFOUND'));
                    $this->assignRef('celebrity_name', $celebrity_name);
                    $this->assign('match',false);
                }
                break;            
            case 'save':
                //get the menu itemid for the add address link if exists. we assume only one address default menu item exists
                $app = JFactory::getApplication();
                $menus = $app->getMenu();
                $comMenu = $menus->getItems('link','index.php?option=com_celebrity&view=address',true);
                if (is_object($comMenu)) {
                    $itemid = $comMenu->id;
                } else {
                    $itemid = null;
                }                
                $first_name = JRequest::getVar('first_name',null,'post');
                $last_name  = JRequest::getVar('last_name',null,'post');
                $cid = JRequest::getInt('cid');
                $addMorelink = JRoute::_('index.php?option=com_celebrity&controller=celebrity&view=celebrity');
                $addAddressLink = JRoute::_('index.php?option=com_celebrity&task=add&controller=address&cid='.$cid.'&Itemid='.$itemid);
                $this->setLayout('_final_add_step');
                $this->assign('first_name',$first_name);
                $this->assign('last_name',$last_name);
                $this->assignRef('addMoreLink',$addMorelink);
                $this->assignRef('addAddressLink', $addAddressLink);
                break;
            case 'details':
                //get the celebrity details data
                $details = $this->get('Details');
                
                //get the celebrity profile photo
                $photoModel = $this->getModel('Photo');
                $photo = $photoModel->getPhoto();
                
                if ($photo) {
                    //get the file location of the photo
                    $params = JComponentHelper::getParams('com_celebrity');
                    $image_location = $params->get('image_location');
                    $file_path = JPATH_SITE.DS.str_replace('/', DS, $image_location).$photo->file;
                    
                    //set the profile picture
                    if (!file_exists($file_path)) {
                        $profile_image = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
                    } else {
                        $profile_image = JURI::root().$image_location.$photo->file;
                    }
                } else {
                    $profile_image = JURI::base().'/components/com_celebrity/assets/images/m-head.png';
                }
                
                //set the layout
                $this->setLayout('details');
                
                //get the menu itemid for the add address link if exists. we assume only one address default menu item exists
                $app = JFactory::getApplication();
                $menus = $app->getMenu();
                $comMenu = $menus->getItems('link','index.php?option=com_celebrity&view=address',true);
                if (is_object($comMenu)) {
                    $this->assignRef('itemid',$comMenu->id);
                } else {
                    $this->assign('itemid',null);
                }                
                
                //pass data to the layout
                $this->assignRef('profile_image',$profile_image);
                $this->assignRef('details',$details);
                $this->assignRef('profile_image',$profile_image);
                break;
            default:
                $this->setLayout('default');
                //build profession dropdown
                $model = JModel::getInstance('profession','CelebrityModel');
                $professions = $model->getProfessions();
                $categories = $model->getCategories();             

               
                //add first option
                $options[] = JHTML::_('select.option', 0, JText::_('SELECTPROFESSION'));
                
                //create list of professions that are categorized
                foreach ($categories as $category) {
                   $options[]= JHTML::_('select.optgroup',$category->name);
                    foreach ($professions as $profession) {
                        if ($profession->category == $category->name) {
                          $options[] = JHTML::_('select.option', $profession->id, $profession->profession);
                        }
                    }
                }
                
                //add the list of professions that are not categorized
                $options[]= JHTML::_('select.optgroup',JText::_('Other'));
                foreach ($professions as $profession) {
                    if (!$profession->category) {
                        $options[] = JHTML::_('select.option', $profession->id, $profession->profession);
                    }
                }                
                

                //build the profession list
                $professions =  JHTML::_('select.genericlist', $options, 'profession','class="validate[\'required\']" disabled="disabled"', 'value', 'text', '0');

                //build the birthday month dropdown
                $minAge = 13;
                $maxAge = 100;
                $thisYear = (int)date('Y');
                $minYear = $thisYear - $maxAge;
                $maxYear = $thisYear - $minAge;
                $yearCount = $maxYear - $minYear;
                $byear = '<option value = "0">'.JText::_('YEAR').'</option>'."/n/r";
                for($i=0; $i<$yearCount; $i++)
                {
                    $byear .=  '<option value = "'.$maxYear.'">'.$maxYear.'</option>'."/n/r";
                    $maxYear -= 1;  
                }

                $celebrity = JRequest::getVar('name',null,'POST','ARRAY');
                $this->assignRef('byear', $byear);
                $this->assignRef('professions', $professions);
                $this->assign('task', 'save');
                $this->assignRef('celebrity', $celebrity);        
        }

        // display template
        parent::display($tpl);
    }
}

?>