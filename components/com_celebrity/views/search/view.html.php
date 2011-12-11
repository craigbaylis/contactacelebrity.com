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
* Search class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_extension
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewSearch extends JView
{

    public function display($tpl = null)
    {
        //determine type of task to choose the right layout and set the right variables
        $type = JRequest::getWord('type','all');
        
        //get the menu itemid if exists. we assume only one celebrity details menu item exists
        $app = JFactory::getApplication();
        $menus = $app->getMenu();
        $comMenu = $menus->getItems('component','com_celebrity',true);
        if (is_object($comMenu)) {
            if(($comMenu->query['view'] == 'celebrity') && $comMenu->query['layout'] == 'details') {
                $this->assignRef('itemid',$comMenu->id);
            }
        } else {
            $this->assign('itemid',null);
        }
        //determine which layout to use and assign the correct variables
        switch($type)
        {
            case 'alpha':
            //set correct view for the task and assign the variables
            $celebrities = $this->get('Celebrities');
            $document = JFactory::getDocument();
            $this->setLayout('default');
            $this->assignRef('celebrities', $celebrities);
            $search = JRequest::getCmd('letter');
            $this->assignRef('search', $search);
            $total = $this->get('Total');
            $this->assignRef('total', $total);
            
            //pass store celebrity names to be used in search results page meta description
            $celebrityNames = array();
            foreach($celebrities as $celebrity){
                $celebrityNames[] = trim($celebrity->name);
            }
            $celebrityNames = implode(', ',$celebrityNames);
            $session = JFactory::getSession();
            $session->set('celebrityNames',$celebrityNames,'com_celebrity.search.alpha.desc');
            $this->assign('searchType','browse');
            break;
            
            case 'all':
            default:
            // slashes cause errors, <> get stripped anyway later on. # causes problems.
            $badchars = array('#','>','<','\\'); 
            $searchword = trim(str_replace($badchars, '', JRequest::getString('searchword', null)));            

            // if searchword enclosed in double quotes, strip quotes
            if (substr($searchword,0,1) == '"' && substr($searchword, -1) == '"') { 
                $searchword = substr($searchword,1,-1);
            }

            //replace spaces with + to be able to handle adding the searchword to the url
            $searchword = str_replace(' ','+',$searchword);                     
            JRequest::setVar('searchword',$searchword);

            $post = JRequest::get('post');
            $router = JRouter::getInstance('site');
            $router->setVars($post);
                         
            //set correct view for the task and assign variables
            $celebrities = $this->get('AllCelebrities');
            $this->setLayout('default');
            $this->assignRef('celebrities',$celebrities);
            $search = JText::_('All');
            $this->assignRef('search', $search);
            $this->assign('searchType','search');
            break;
        }        
        
        //pass in pagination
        $pagination = $this->get('Pagination');
        $this->assignRef('pagination',$pagination);
        
        //add breadcrumb ending
        switch($type == 'alpha')
        {
            case 'alpha':
            $app = JFactory::getApplication();
            $pathway = $app->getPathway();
            ($search == '9') ? $letter = '0-9': $letter = $search;
            $pathway->setItemName(0, JText::sprintf('CELEBRITIES',$letter));
            
            //override default joomla breadcrumb path because it uses the menu item link
            $link = $pathway->_pathway[0]->link;
            $uri = parse_url($link);
            parse_str($uri['query']);
            $pathway->_pathway[0]->link = JRoute::_('index.php?option=com_celebrity&view=search&task=search&type=alpha&letter='.$search.'&Itemid='.$Itemid);   
            $page = $pagination->get('pages.current');
            $pathway->addItem(JText::sprintf('BREADCRUMBPAGE',$page),'');
            break;
        }
        
        //pass in image path parameters
        $params = JComponentHelper::getParams('com_celebrity');
        $this->assignRef('params',$params);
        
        // display template
        parent::display($tpl);
    }
}

?>