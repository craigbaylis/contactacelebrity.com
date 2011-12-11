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
* Celebrity class for the Celebrity Component
* 
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityControllerCelebrity extends JController
{
    public function __construct()
    {
        parent::__construct();
    }
  
    public function edit()
    {
        //Get requested id(s)
        $cids   = JRequest::getVar('cid', 'null', 'default', 'array');
        
        if ($cids === null) {
            //Report an error
            JError::raiseError(500, 'cid parameter missing from the request');
        }
        
        //Get the first celebrity to be edited
        $celebrityId  = (int)$cids[0];
                
        //Get the view
        $view =& $this->getView(JRequest::getWord('view', 'celebrity'), 'html');

        //Get the model for the view
        $model =& $this->getModel('celebrity');
      
        //Set the model for the view and make it the default
        $view->setModel($model, true);          
       
        //Display the edit form
        $view->edit($celebrityId);        
    }
    
    public function add()
    {
        //Get the view for a single celebrity
        $view =& $this->getView(JRequest::getWord('view', 'celebrity'), 'html');
        
        //Get the model
        $model =& $this->getModel('celebrity');
        
        //Set the model
        $view->setModel($model, true);
        
        //Display the add form
        $view->add();
    }
    
    public function save()
    {
        //Get the model
        $model =& $this->getModel('celebrity');
       
       //Save the record
       $model->store();
       
       //Go back to the list of celebrities
       $redirectTo = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=display');
       $this->setRedirect( $redirectTo, 'Celebrity Saved' );     
    }
    
    public function cancel()
    {
        $redirectTo = JRoute::_('index.php?option='.JRequest::getCmd('option').'&task=display');
        $this->setRedirect($redirectTo, 'Cancelled');
    }
    
    public function remove()
    {
        //Retrieve the ids to be removed
        $cids   = JRequest::getVar('cids', null, 'default', 'array');
        
        //Make sure there are records to remove
        if ($cids === null) {
            //Raise Error
            JError::raiseError(500, 'No celebrities selected for removal');
        }
        
        //Get the model
        $model  =& $this->getModel('celebrity');
        
        //Delete the records
        $model->delete($cids);
        
        //Redirect to celebrity list
        $redirectTo = JRoute::_('index.php?option='.JRequest::getCmd('option').'&task=display');
        $this->setRedirect($redirectTo, 'Celebrities Deleted');
    }
}