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
* Address class for the Celebrity View
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityViewAddress extends JView
{

    public function display($tpl = null)
    {
        //determine type of task to choose the right layout and set the right variables
        $layout = JRequest::getWord('layout','layout');
        
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
        switch($layout)
        {
            case 'form':
            $this->setLayout('form');
            include_once('components'.DS.'com_celebrity'.DS.'helpers'.DS.'mailingAddressForm.php');
            
            //get the uid of the user adding the address
            $created_by_uid = JRequest::getInt('created_by_uid');
            
            //if the uid of the user adding the address is not passed by the form, we will get it another way
            if (!$created_by_uid) {
                $user = JFactory::getUser();
                $created_by_uid = $user->get('id');    
            }
            $this->assignRef('created_by_uid',$created_by_uid);
            break;
            
            case 'emailError':
            $this->setLayout('error');
            $celebName = JRequest::getVar('celebName');
            $cid = JRequest::getInt('cid');
            $emailAddresses = JRequest::getVar('emailAddress');
            $this->assignRef('error', JText::sprintf('DUPLICATEEMAILMSG',$emailAddresses,$celebName));
            $this->assignRef('errorType',JText::_('DUPLICATEEMAIL'));
            $this->assignRef('celebName',$celebName);
            $this->assignRef('cid', $cid);
            break;

            case 'emailThankYou':
            $this->setLayout('thankyou');
            $celebName = JRequest::getVar('celebName');
            $emailAddresses = JRequest::getVar('emailAddress');
            $cid = JRequest::getInt('cid');
            $this->assignRef('cid', $cid);            
            break;
            
            case 'urlError':
            $this->setLayout('error');
            $celebName = JRequest::getVar('celebName');
            $cid = JRequest::getInt('cid');
            $url = JRequest::getVar('websiteAddress');
            $this->assignRef('error', JText::sprintf('DUPLICATEURLMSG',$url,$celebName));
            $this->assignRef('errorType',JText::_('DUPLICATEURL'));
            $this->assignRef('celebName',$celebName);
            $this->assignRef('cid', $cid);
            break;
            
            case 'urlThankYou';
            $this->setLayout('thankyou');
            $celebName = JRequest::getVar('celebName');
            $url = JRequest::getVar('websiteAddress');
            $cid = JRequest::getInt('cid');
            $this->assignRef('cid', $cid);            
            break;

            case 'mailingError':
            $this->setLayout('error');
            $celebName = JRequest::getVar('celebName');
            $cid = JRequest::getInt('cid');
            $line_1 = JRequest::getVar('line_1');
            $this->assignRef('error', JText::sprintf('DUPLICATEMAILINGMSG',$line_1,$celebName));
            $this->assignRef('errorType',JText::_('DUPLICATEMAILING'));
            $this->assignRef('celebName',$celebName);
            $this->assignRef('cid', $cid);
            break;
            
            case 'mailingThankYou';
            $this->setLayout('thankyou');
            $celebName = JRequest::getVar('celebName');
            $line_1 = JRequest::getVar('line_1');
            $cid = JRequest::getInt('cid');
            $this->assignRef('cid', $cid);
            break;
            
            case 'details':
            $this->setLayout('details');
            $type = JRequest::getWord('type');
            $celebrityModel = $this->getModel('celebrity');
            $celebrity = $celebrityModel->getDetails();
            $this->assignRef('celebrity',$celebrity);
            $user = JFactory::getUser();
            $this->assignRef('user',$user);

            //get the menu itemid for the add address link if exists. we assume only one address default menu item exists
            $app = JFactory::getApplication();
            $menus = $app->getMenu();
            $comMenu = $menus->getItems('link','index.php?option=com_celebrity&view=address',true);
            if (is_object($comMenu)) {
                $this->assignRef('addressItemid',$comMenu->id);
            } else {
                $this->assign('addressItemid',null);
            }
            
            //get the menu itemid for the add results link if exists. we assume only one results default menu item exists
            $app = JFactory::getApplication();
            $menus = $app->getMenu();
            $comMenu = $menus->getItems('link','index.php?option=com_celebrity&view=result&layout=form',true);
            if (is_object($comMenu)) {
                $this->assignRef('resultsItemid',$comMenu->id);
            } else {
                $this->assign('resultsItemid',null);
            } 
                                               
            switch ($type) {
                case 'address':
                $addressModel = $this->getModel();
                $address = $addressModel->getMailingAddress();
                $this->assignRef('address',$address);
				//pagination
				$addressModel3 = $this->getModel();
				$addressPage = $addressModel3->getAddressPagination();
				$this->assignRef('addressPage',$addressPage);
				//sucessfull mailing
				$addressModel4 = $this->getModel();
				$Smailing = $addressModel4->getSucessfullMailing(1);
				$this->assignRef('Smailing',$Smailing);
				$Rmailing = $addressModel4->getSucessfullMailing(2);
				$this->assignRef('Rmailing',$Rmailing);
				
				//result for address
				$ResultAddress = $addressModel->getResultOfAddress();
				$this->assignRef('ResultAddress',$ResultAddress);
				
                break;
                
                case 'email':
                break;
                
                case 'website':
                break;
            }
            $anumber = JRequest::getCmd('anumber');
            $this->assignRef('anumber',$anumber);
            break;
            
            default:
            //set the default action here
            $model =& $this->getModel();
            
            //check if we have a valid celebrity to add
            if (!$model->celebCheck()) {
                JError::raiseError('500', 'No Celebrity Chosen');
            }
            
            //Get the celebrity's name
            $celebName = $model->getCelebName();
            $this->assignRef('celebName', $celebName);
            
            //Get the mailing addresses
            $mailingAddresses = $model->getMailingAddresses();
            
            //Get the email addresses
            $emailAddresses  = $model->getEmailAddresses();
            
            //Get the website address
            $websiteAddresses   = $model->getWebsiteAddresses();
            
            //Check for results and assign data to the template
            if ($mailingAddresses || $emailAddresses || $websiteAddresses) {
                $this->assign('found', true);
                $this->assignRef('mailingAddresses', $mailingAddresses);
                $this->assignRef('emailAddresses', $emailAddresses);
                $this->assignRef('websiteAddresses', $websiteAddresses);
                $this->assignRef('cid', JRequest::getInt('cid'));
                $this->assignRef('created_by_uid',JRequest::getInt('uid'));
            } else {
                $this->assign('found', false);
                $this->assignRef('cid', JRequest::getInt('cid'));
                $this->assignRef('created_by_uid',JRequest::getInt('uid'));
            }
            break;
        }        
        
        // display template
        parent::display($tpl);
    }
}

?>