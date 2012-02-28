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
                $data['result_id'] = $result_id;//JRequest::getInt('result_id',null,'POST');
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
		phocagalleryimport('phocagallery.path.path');
        phocagalleryimport('phocagallery.file.file');
        phocagalleryimport('phocagallery.file.filethumbnail');
        phocagalleryimport('phocagallery.file.fileupload');
        phocagalleryimport('phocagallery.render.renderadmin');
        phocagalleryimport('phocagallery.render.renderprocess');

        jimport('joomla.database.table');
        JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'tables');
        $object = new PhocaGalleryControllerUser();
		$errUploadMsg    = '';
       	$redirectUrl     = '';
        
        //add paths to phocagallery models
        $object->addModelPath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'models');
        $object->addModelPath(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'models');


        //get user results folder data
        $catdata = $imageModel->getUserFolder();
		
		//Image upload in mailing result directory for particular celebrity
		$categorymailing = array();
       require_once(JPATH_ROOT.DS.'components'.DS.'com_celebrity'.DS.'helpers'.DS.'utilities.php');
	   //get a celebrity details
	    $cid = Jrequest::getcmd("cid");
		
	   	$celebrity = new stdClass();
		$catid = new stdClass();
		
	    $db = JFactory::getDBO();
		
		$query2 = 'select `a`.`first_name`, `a`.`last_name` , `a`.`album_catid` from `#__celebrity_celebrity` `a` where a.id ='.$cid;
		$db->setQuery($query2);
		$celebrity = $db->loadObject();
		
		//section start
		if($celebrity->album_catid == "0"){
			/*Create the folder for phoca gallery */
       $categorycreate = array();
       require_once(JPATH_ROOT.DS.'components'.DS.'com_celebrity'.DS.'helpers'.DS.'utilities.php');
       $name = $celebrity->first_name.' '.$celebrity->last_name;
       $alias = CelebrityUtilitiesHelper::getAliasName($name);
       $path = md5($alias);
       $categorycreate['userfolder'] = substr($path,0,1).DS.substr($path,1,2).DS.$alias.'-'.$cid;
       if(!file_exists($categorycreate['userfolder'])) CelebrityUtilitiesHelper::createFolder($categorycreate['userfolder']);
	   //copy(JPATH_ROOT.DS.'components'.DS.'com_celebrity'.DS.'assets'.DS.'images'.DS.'m-head.png',$categorycreate['userfolder'].'/m-head.png');
       //move_uploaded_file($scannedimages['scannedimage1']['tmp_name'],$categorycreate['userfolder'].'/'.$scannedimages['scannedimage1']['name']);
       //add the data to the phocagallery_galleries table
        $categorycreate['id'] = null;
        $categorycreate['title'] = $name;
        $categorycreate['description'] = 'Photo gallery for '.$name;
        $categorycreate['alias'] = $alias;
        $categorycreate['image_position'] = 'left';
        $categorycreate['date'] = '';
        $categorycreate['approved'] = 1;
        $categorycreate['image_position'] = 'left';
        $categorycreate['published'] = 1;
        $categorycreate['accessuserid'] = '0';
        $categorycreate['uploaduserid'] = '-2';
        $categorycreate['deleteuserid'] = '-2';
        
        require_once(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'libraries'.DS.'loader.php');
        phocagalleryimport('phocagallery.path.path');
        phocagalleryimport('phocagallery.file.file');
        phocagalleryimport('phocagallery.file.filethumbnail');
        phocagalleryimport('phocagallery.file.fileupload');
        phocagalleryimport('phocagallery.render.renderadmin');
        phocagalleryimport('phocagallery.text.text');
        phocagalleryimport('phocagallery.render.renderprocess');
        
        //add paths to phocagallery models
        $this->addModelPath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'models');
        $this->addModelPath(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'models');
        
        $model = $this->getModel('PhocaGalleryC','PhocaGalleryCpModel');
        $model->addTablePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'tables');
        $model->store($categorycreate);
        
       //update the celebrity table with the phocagallery catid
       $db = JFactory::getDBO();
       $celebupdate = array();
       $album_catid = $db->insertid();
       $query = "
            UPDATE
              `#__celebrity_celebrity` `a`
            SET
              `album_catid` = $album_catid
            WHERE
              `a`.`id` = $cid       
       ";
       $db->setQuery($query);
       $db->query();
	   
	   //subcategory
		$subcategory = array();
		$subcategory['userfolder'] = substr($path,0,1).DS.substr($path,1,2).DS.$alias.'-'.$cid.DS.'Mailing Results';
       if(!file_exists($subcategory['userfolder'])) CelebrityUtilitiesHelper::createFolder($subcategory['userfolder']);
		$subcategory['id'] = null;
		$subcategory['parent_id']= $album_catid;		
        $subcategory['title'] = 'Mailing Result - '.$name;
        $subcategory['description'] = 'Mailing Result for '.$name;
        $subcategory['alias'] = $alias;
        $subcategory['image_position'] = 'left';
        $subcategory['date'] = '';
        $subcategory['approved'] = 1;
        $subcategory['image_position'] = 'left';
        $subcategory['published'] = 1;
        $subcategory['accessuserid'] = '0';
        $subcategory['uploaduserid'] = '-2';
        $subcategory['deleteuserid'] = '-2';   
		$model->store($subcategory) ; 
       
       //save the image(s) to the folder
       require_once(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'controller.php');
       require_once(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'controllers'.DS.'user.php');
       JRequest::setVar( 'folder', $categorycreate['userfolder']);
       JRequest::setVar( 'format', 'html');
       JRequest::setVar( 'return-url', null, 'post');
       JRequest::setVar( 'viewback', '', 'post');
       JRequest::setVar( 'catid', $album_catid, 'post');
       $phocagalleryuploadtitle = JRequest::getVar('image_title', null, 'post');
       $phocagalleryuploaddescription = JRequest::getVar('image_description', '', 'post');
       JRequest::setVar( 'phocagalleryuploadtitle', $phocagalleryuploadtitle);
       JRequest::setVar( 'phocagalleryuploaddescription', $phocagalleryuploaddescription);       
       $object = new PhocaGalleryControllerUser();
       $errUploadMsgs    = '';
       $redirectUrls     = '';
	   //$object->_singleFileUpload($errUploadMsg, $scannedimages['scannedimage1']['name'], $redirectUrl);
      /* if(is_array($_FILES)) {
			foreach ($_FILES as $file => $fileArray) {
				if (!$object->_singleFileUpload($errUploadMsgs, $fileArray, $redirectUrls)) {
					$errUploadMsgs = JText::_($errUploadMsgs);
					return false;
				}
			}           
		   }*/
		}
		
		//session start
		 $queryget = "select a.parent_id from  `#__phocagallery_categories` `a` order by a.id desc";
	   $db->setQuery($queryget);
		$resultget =$db->loadObject();
		
		$query3 = 'select `a`.`id` from `#__phocagallery_categories` `a` where a.parent_id ='.$resultget->parent_id;
		$db->setQuery($query3);
		$catid = $db->loadObject();	
		
       $name = $celebrity->first_name.' '.$celebrity->last_name;
       $alias = CelebrityUtilitiesHelper::getAliasName($name);
       $path = md5($alias);
       $categorymailing['userfolder'] = substr($path,0,1).DS.substr($path,1,2).DS.$alias.'-'.$cid.DS.'Mailing Results';
       if(!file_exists($categorymailing['userfolder'])) CelebrityUtilitiesHelper::createFolder($categorymailing['userfolder']);
		//if user not have a category id
		/*if(!$catdata->catid){ 
		require_once(JPATH_ROOT.DS.'components'.DS.'com_celebrity'.DS.'helpers'.DS.'utilities.php');		
		phocagalleryimport('phocagallery.path.path');
        phocagalleryimport('phocagallery.file.file');
        phocagalleryimport('phocagallery.file.filethumbnail');
        phocagalleryimport('phocagallery.file.fileupload');
        phocagalleryimport('phocagallery.render.renderadmin');
        phocagalleryimport('phocagallery.render.renderprocess');
	   $user    =& JFactory::getUser();
	   $category = array();
	   $name = $user->username;
	   $alias = CelebrityUtilitiesHelper::getAliasName($name);
       $path = md5($alias);
       $category['userfolder'] = substr($path,0,1).DS.substr($path,1,2).DS.$name.'-'.$user->id;
       if(!file_exists($category['userfolder'])) CelebrityUtilitiesHelper::createFolder($category['userfolder']);
       
       //add the data to the phocagallery_galleries table
        $category['id'] = null;
		$category['owner_id'] = $user->id;
        $category['title'] = $name;
        $category['description'] = 'Photo gallery for '.$name;
        $category['alias'] = $name;
        $category['image_position'] = 'left';
        $category['date'] = '';
        $category['approved'] = 1;
        $category['image_position'] = 'left';
        $category['published'] = 1;
        $category['accessuserid'] = '0';
        $category['uploaduserid'] = '-2';
        $category['deleteuserid'] = '-2';
		$model = $this->getModel('PhocaGalleryC','PhocaGalleryCpModel');
        $model->addTablePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_phocagallery'.DS.'tables');
        $model->store($category);
	    $db = JFactory::getDBO();
        $cat_id = $db->insertid();
		} else {
		$cat_id = $catdata->catid;
		}*/

        JRequest::setVar('folder',$categorymailing['userfolder']);
        JRequest::setVar('catid',$catid->id);
        $object->_realJavaUpload($errUploadMsg,$redirectUrl);
		
		//update a result id in phocagallery table
	   $db = JFactory::getDBO();
	   $user    =& JFactory::getUser();
       //$phoca_id = $db->insertid();
	   $countimage =  count($scannedimages); // count a number of file upload
	   $getruserid = $user->id;
	   $query = "select a.id from  `#__phocagallery` `a` where a.userid=$getruserid order by a.id desc limit 0,$countimage";
	   $db->setQuery($query);
		$result =$db->loadResultArray();
	     $queueimage = 1;
		  foreach($result as $getid){
			 $getimagename = 'imagetitle'. $queueimage++;
			 $imgtitle = JRequest::getvar($getimagename);
			$query = "
            UPDATE
              `#__phocagallery` `a`
            SET
			  `title` = '$imgtitle',
              `result_id` = $result_id
            WHERE
              `a`.`id` = $getid       
       		";
       		$db->setQuery($query);
       		$db->query();	
		  }
		 //}

		
                
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
		 //JRequest::setVar('resultid', '79184');
        $view = $this->getView('result','html');
        $view->setLayout('success');
        $view->display();
    }
}