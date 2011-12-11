<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

//no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

//load the base JController class
jimport( 'joomla.application.component.controller' );


/**
* Address class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityControllerAddress extends JController
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function add()
    {
      //check if user is has rights to add an address
      $user = JFactory::getUser();
      $uid = $user->get('id');
      if (!$uid) {
        JError::raiseWarning('','You must be logged in to add an address');
        $uri = JURI::getInstance();
        $url = @$_SERVER['HTTP_REFERER'];
        $this->setRedirect($url);   
      } else {
        //we have a logged in user to so pass along his id
        JRequest::setVar('uid',$uid);
      }
      
      
      //Set the view
      $view =& $this->getView('address','html');

      //Get the model for the view
      $model =& $this->getModel('address');
      
      //Set the model for the view and make it the default
      $view->setModel($model, true);          
       
       //Display the view
       $view->display();        
    }
    
    public function save()
    {
      //check if email was save
      $view =& $this->getView('address','html');
      
      //get the model
      $model =& $this->getModel('address');
      
      //check to see which address form was submitted
      $formSubmitted = JRequest::getWord('formSubmitted');
      switch($formSubmitted)
      {
          case 'email':
          
          //check to make sure the email isn't already associated with this celebrity
          $duplicate = $model->duplicateCheck($formSubmitted);
          if (!$duplicate) {
            //add email address to the database
            $result = $model->addEmailAddress();
            if ($result) {
                //send user to thank you page
                JRequest::setVar('layout','emailThankYou');
                $view->display();
            } else {
                //display error
                JError::raiseError(500,'We experienced a problem and the email address was not added, please try again');
            }
             
          } else {
            //duplicate let user know
            JRequest::setVar('layout','emailError');
            $view->display();
              
          }
          break;
          
          case 'website':
          //check to make sure the website isn't already associated with this celebrity
          $duplicate = $model->duplicateCheck($formSubmitted);
          if (!$duplicate) {
            //add url address to the database
            $result = $model->addUrl();
            if ($result) {
                //send user to thank you page
                JRequest::setVar('layout','urlThankYou');
                $view->display();
            } else {
                //display error
                JError::raiseError(500,'We experienced a problem and the website address was not added, please try again');
            }
             
          } else {
            //duplicate let user know
            JRequest::setVar('layout','urlError');
            $view->display();
              
          }
          break;          
          
          case 'mailing':
          //check to make sure the address isn't already associated with this celebrity
          $duplicate = $model->duplicateCheck($formSubmitted);
          if (!$duplicate) {
            //add address to the database
            $result = $model->addAddress();
            if ($result) {
                //send user to thank you page
                JRequest::setVar('layout','mailingThankYou');
                $view->display();
            } else {
                //display error
                JError::raiseError(500,'We experienced a problem and the mailing address was not added, please try again');
            }
             
          } else {
            //duplicate let user know
            JRequest::setVar('layout','mailingError');
            $view->display();
              
          }          
          break;
          
          default:
      }  
    }
    
    public function details()
    {
        //get the view
        $view = $this->getView('address','html');
           
        $detailType = JRequest::getWord('type');
        if (!$detailType) return $this->setRedirect(JRoute::_(JURI::root()),'ERROR: Incomplete URL');
        
        //set the celebrity model
        $celebrityModel = $this->getModel('celebrity');
        $view->setModel($celebrityModel);
        
        //set the correct model
        switch ($detailType) {
            case 'address':
            $model = $this->getModel('address');
            $view->setModel($model,true);             
            break;
            
            case 'email':
            break;
            
            case 'website':
            break;
        }
        
        JRequest::setVar('layout','details');
        
        //display view
        $view->display(); 
    }
}