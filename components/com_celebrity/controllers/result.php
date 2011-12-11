<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

//no direct access
defined('_JEXEC') or die('Restricted access');

//load the base JController class
jimport('joomla.application.component.controller');


/**
* Result class for the Celebrity Component
* 
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/
class CelebrityControllerResult extends JController
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
        JError::raiseWarning('',JText::_('You must be logged in to submit your result for an address'));
        $uri = JURI::getInstance();
        $url = @$_SERVER['HTTP_REFERER'];
        $this->setRedirect($url);   
      } else {
        //we have a logged in user to so pass along his id
        JRequest::setVar('uid',$uid);
      }      
      
      //Get the view
      $view =& $this->getView(JRequest::getWord('view', 'result'), 'html');      

      //Get the celebrity model to get the celebrity's name and id
      $celebrityModel =& $this->getModel('celebrity');
      
      //get the address model to ge the address data
      $addressModel =& $this->getModel('address');
      
      //get the sent types
      $resultsenttypeModel =& $this->getModel('resultsenttype');
      
      //get the received type
      $resultreceivedtypeModel = $this->getModel('resultreceivedtype');
      
      //get the quality types
      $resultqualitylistModel = $this->getModel('resultqualitylist');
      
      
      //Set the models for the view
      $view->setModel($celebrityModel);
      $view->setModel($addressModel);
      $view->setModel($resultsenttypeModel);
      $view->setModel($resultreceivedtypeModel);
      $view->setModel($resultqualitylistModel);
      
      //set the layou
      $view->setLayout('form');          
       
       //Display the view
       $view->display();        
    }
    
    public function save()
    {
        //verify the form token
        JRequest::checkToken() or JError::raiseError(500, 'Invalid Token');
        
        //get the result model
        $resultModel = $this->getModel('result');
        
        //get the Result_Sent linking table
        $resultSentModel = $this->getModel('resultsent');
        
        //get the image model
        $imageModel = $this->getModel('resultreceivedimage');
        
        //save the data to the result table
        $result_id = $resultModel->saveResult();
        
        //check that the data was indeed correctly saved
        if(!$result_id) {
            JError::raiseError(500, JText::_('There was a problem with the database and your result was not saved, please try again later'));
        }
        //we are using the vmproductid to store the id of the result that this image is related to.
        JRequest::setVar('vmproductid',$result_id,'POST');
        
        //check that we have something to save in the result_sent table
        $sent_types = JRequest::getVar('sent_types',null,'POST','ARRAY');
        
        if(!empty($sent_types)){
            //save each sent type
            foreach($sent_types as $key => $value){
                $data = array();
                $data['id'] = null;
                $data['result_id'] = JRequest::getInt('result_id',null,'POST');
                $data['sent_type_id'] = $value;
                $data['date_created'] = JRequest::getVar('date_created',null,'POST');
                $resultSentModel->save($data);
            }
        }      
        
        //check if there is an image to save
        $scannedimages = JRequest::get('files');        
        if (!is_array($scannedimages) || empty($scannedimages['scannedimage1']['tmp_name'])) {
            
            //no image so display results page
            $view = $this->getView('result','html');
            $view->setLayout('success');
            $view->display();
            return true;
            
        }
        
        require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'libraries'.DS.'phocagallery'.DS.'path'.DS.'path.php');
        require_once( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'libraries'.DS.'loader.php');
        require_once( JPATH_ROOT . DS . 'components' . DS . 'com_phocagallery' . DS . 'controller.php');
        require_once( JPATH_ROOT . DS . 'components' . DS . 'com_phocagallery' . DS . 'controllers' . DS . 'user.php');
        phocagalleryimport('phocagallery.text.text');
        jimport('joomla.database.table');
        JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'tables');
        $object = new PhocaGalleryControllerUser();
        
        //add paths to phocagallery models
        $object->addModelPath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'models');
        $object->addModelPath(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'models');
        
        
        //get user results folder data
        $catdata = $imageModel->getCatData;
        
        JRequest::setVar('folder',$catdata->folder);
        JRequest::setVar('catid',$catdata->catid);
        $object->_realJavaUpload();
                
        //TODO check the that file sizes are correct
        /*
        //load image handling class
        require_once JPATH_COMPONENT.DS.'helpers'.DS.'class.upload.php';
        
        //get the allowed types
       $celebrityConfig  = JComponentHelper::getParams( 'com_celebrity' );
       $allowed_files = $celebrityConfig->get('allowed_files');
       $allowed_files = explode(',',$allowed_files);
       $allowed = array();
       foreach ($allowed_files AS $allowed_file) {
            $allowed[] = 'image/'.$allowed_file;
       }
       
       //set the destination
       $dest = $celebrityConfig->get('results_image_location');
       if(PHP_OS == 'WINNT') $dest = JPATH_ROOT.DS.str_replace('/','\\',$dest);
            
        $i = 1;
        foreach($scannedimages AS $scannedimage){

            //get the image
            $handle = new Upload($scannedimage);

            //check that image was uploaded
            if (!$handle->uploaded)
            {
                //if no image then skip processing this one
                break;
            }  
            
            //set the allowed file types
            $handle->allowed = $allowed;
            */

            /*HANDLE THE ORIGINAL IMAGE*/

            //identify it as the orignial
            /*
            $uid = JRequest::getInt('created_by_id');
            $handle->file_new_name_body = $newfilename = mt_rand();
            $handle->file_name_body_pre = $uid.'_';
            $handle->file_name_body_add = '_O';
            $handle->process($dest);
            if(!$handle->processed)
            {
                JError::raiseError(500, 'We experienced a problem and the original image '.$handle->file_src_name_body.' was not saved');
            }

            //add image info to the post data to be saved later
            JRequest::setVar('file_name',$newfilename,'post');
            JRequest::setVar('title',JRequest::getVar('imagetitle'.$i,null,'post'),'post');
            JRequest::setVar('caption',JRequest::getVar('caption'.$i,null,'post'),'post');
            JRequest::setVar('file_ext',$handle->file_src_name_ext);
            */
            /*create the medium size image*/
            /*
            $handle->file_new_name_body = $newfilename;
            $handle->file_name_body_pre = $uid.'_';
            $handle->file_name_body_add = '_S';
            $handle->image_resize    = true;
            $handle->image_ratio_x   = true;
            $handle->image_y         = 300;
            $handle->process($dest);
            if(!$handle->processed)
            {
                JError::raiseError(500, 'We experienced a problem and the resized image '.$handle->file_src_name_body.' was not saved');  
            }
            */
            /*create the large size image*/
            /*
            $handle->file_new_name_body = $newfilename;
            $handle->file_name_body_pre = $uid.'_';
            $handle->file_name_body_add = '_M';
            $handle->image_ratio_no_zoom_in = true;
            $handle->image_resize    = true;
            $handle->image_x         = 800;
            $handle->image_y         = 800;
            $handle->process($dest);
            if(!$handle->processed)
            {
                JError::raiseError(500, 'We experienced a problem and the resized image'.$handle->file_src_name_body.' was not saved');  
            }             


            $result = $imageModel->saveImage();
        }
        */
        //display success results page
        $view = $this->getView('result','html');
        $view->setLayout('success');
        $view->display();
    }
}