<?php
/**
* @package      CAC
* @subpackage   com_celebrity
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
* Celebrity Class.
*
* Handles Celebrity Actions
*
* @package        CAC
* @subpackage    com_celebrity
*/

class CelebrityControllerCelebrity extends JController {

	public function __construct()
	{
	    parent::__construct();
	}

   public function search()
   {     
       //Check the token for security
       //JRequest::checkToken() or JError::raiseError( JText::_( 'INVAILDTOKEN' ), JText::_('INVALIDTOKENERROR') );
       
       //TODO Server side form validation make sure form is not empty      
      
      //Set the view
      $view =& $this->getView('celebrity','raw');

      //Set the default model for the view
      $model =& $this->getModel('Celebrity');
      $view->setModel($model, true);          
       
       //Display Results
       $view->display();       
   }
   
   
   public function save()
   {
 
        //Check the token for security
       JRequest::checkToken() or JError::raiseError( JText::_( 'INVAILDTOKEN' ), JText::_('INVALIDTOKENERROR') );
       
       //load image handling class
       //require_once JPATH_COMPONENT.DS.'helpers'.DS.'class.upload.php';
       
       // import JFolder
       jimport('joomla.filesystem.folder');
       
       //get the required models to save the data
       $celebrityModel  =& $this->getModel('celebrity');
       $photoModel      =& $this->getModel('photo');
       $professionModel      =& $this->getModel('profession');
       
       
       //get the data from the form
       $post = JRequest::get('POST');
       
       //force a new record to be created
       $post['id'] = false;
       
       //set extra variables
       $user    =& JFactory::getUser();
       $date   =& JFactory::getDate();
       $post['created_by_uid'] = $user->get('id');
       $post['date_created'] = $date->toMySQL();
       $post['birth_date'] =  date('Y-m-d H:i:s', mktime(0,0,0,$post['bmonth'],$post['bday'],$post['byear']));
       
       
       //TODO -c com_celebrity :check for allowed files types and allow file size, define allowed file types somewhere else
       
       //save data to celebrity table
       $cid = $celebrityModel->store($post);
       
       //save data to celebrity_profession table
       $profession['id'] = null;
       $profession['celebrity_id'] = $cid; 
       $profession['profession_id'] = $post['profession'];
       $profession['date_created'] = $post['date_created'];
       $professionModel->store($profession);
       
       /*Create the folder for phoca gallery */
       $category = array();
       require_once(JPATH_ROOT.DS.'components'.DS.'com_celebrity'.DS.'helpers'.DS.'utilities.php');
       $name = $post['first_name'].' '.$post['last_name'];
       $alias = CelebrityUtilitiesHelper::getAliasName($name);
       $path = md5($alias);
       $category['userfolder'] = substr($path,0,1).DS.substr($path,1,2).DS.$alias.'-'.$cid;
       if(!file_exists($category['userfolder'])) CelebrityUtilitiesHelper::createFolder($category['userfolder']);
       
       //add the data to the phocagallery_galleries table
        $category['id'] = null;
        $category['title'] = $name;
        $category['description'] = 'Photo gallery for '.$name;
        $category['alias'] = $alias;
        $category['image_position'] = 'left';
        $category['date'] = '';
        $category['approved'] = 1;
        $category['image_position'] = 'left';
        $category['published'] = 1;
        $category['accessuserid'] = '0';
        $category['uploaduserid'] = '-2';
        $category['deleteuserid'] = '-2';
        
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
        $model->store($category);
        
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
       
       //save the image(s) to the folder
       require_once(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'controller.php');
       require_once(JPATH_ROOT.DS.'components'.DS.'com_phocagallery'.DS.'controllers'.DS.'user.php');
       JRequest::setVar( 'folder', $category['userfolder']);
       JRequest::setVar( 'format', 'html');
       JRequest::setVar( 'return-url', null, 'post');
       JRequest::setVar( 'viewback', '', 'post');
       JRequest::setVar( 'catid', $album_catid, 'post');
       $phocagalleryuploadtitle = JRequest::getVar('image_title', null, 'post');
       $phocagalleryuploaddescription = JRequest::getVar('image_description', '', 'post');
       JRequest::setVar( 'phocagalleryuploadtitle', $phocagalleryuploadtitle);
       JRequest::setVar( 'phocagalleryuploaddescription', $phocagalleryuploaddescription);       
       $object = new PhocaGalleryControllerUser();
       $errUploadMsg    = '';
       $redirectUrl     = '';
       if(is_array($_FILES)) {
        foreach ($_FILES as $file => $fileArray) {
            if (!$object->_singleFileUpload($errUploadMsg, $fileArray, $redirectUrl)) {
                $errUploadMsg = JText::_($errUploadMsg);
                return false;
            }
        }           
       }
       //add the data to the phocagallery table
       
       /*
       //get the image
       $handle = new Upload(JRequest::getVar('celebrity_photo', null, 'FILES', 'ARRAY'));
 
       //set the allowed types
       $handle->allowed = array('image/bmp','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
 
       //check that image was uploaded
       if (!$handle->uploaded)
       {
            JError::raiseError(500,'No image was uploaded');
       }
       */
       /*HANDLE THE ORIGINAL IMAGE*/
       /*
       //set the destination
       $dest = JPATH_SITE.DS.'images'.DS.'stories'.DS.'com_celebrity';
       $url = JURI::root().'images/stories/com_celebrity';
       //rename the file
       $new_file_name = $post['first_name'].'_'.$post['last_name'];
       $handle->file_new_name_body = $new_file_name;
        
       //identify it as the orignial
       $handle->file_name_body_pre = $cid.'_';
       $handle->file_name_body_add = '_O';
       $handle->process($dest);
       
       if(!$handle->processed)
       {
           JError::raiseError(500, 'We experienced a problem and the original image was not saved');
       } 
       */
       /*HANDLE THE RESIZED IMAGE*/
       /*
       $handle->file_new_name_body = $new_file_name;
       $handle->file_name_body_pre = $cid.'_';
       $handle->file_name_body_add = '_M';
       $handle->image_resize    = true;
       $handle->image_ratio_x   = true;
       $handle->image_y         = 300;
       $handle->process($dest);
       if(!$handle->processed)
       {
            JError::raiseError(500, 'We experienced a problem and the resized image was not saved');  
       }
       */
       /*CREATE THUMBNAIL FOR SEARCH RESULTS*/
       /*
       $handle->file_new_name_body = $new_file_name;
       $handle->file_name_body_pre = $cid.'_';
       $handle->file_name_body_add = '_S';
       $handle->image_resize    = true;
       $handle->image_ratio_crop = true;
       $handle->image_x         = 113;
       $handle->image_y         = 150;
       $handle->process($dest);
       if(!$handle->processed)
       {
            JError::raiseError(500, 'We experienced a problem and the thumbnail image was not saved');  
       }              
       */
       /*SAVE FILE INFORMATION*/
       /*
        $photo['id']            = false;
        $photo['celebrity_id']  = $cid;
        $photo['file_name']     = $new_file_name;
        $photo['file_ext']      = $handle->file_src_name_ext;
        $photo['date_created']  = $date->toMySQL();
       
       //save to photo information to the database
       $photoModel->store($photo);
       
       //delete temp image
       $handle->clean();
        */
        
       //set the view
       $view =& $this->getView('celebrity','html');
       
       //pass the celebrity's id to be used to add their address on the final step
       JRequest::setVar('cid',$cid);
       
       //set the default model for the view
       $model =& $this->getModel('celebrity');
       $view->setModel($model, true);
       
       //display results
       $view->display();        
       
   }
   public function details()
   {
       //add the photo model to get the profile picture
       $photoModel = $this->getModel('photo','celebritymodel');
       $view = $this->getView('celebrity','html');
       $view->setModel($photoModel);
       
       //add the celebrity model to get the celebrity details
       $celebrityModel = $this->getModel('celebrity');
       $view->setModel($celebrityModel, true);
       
       //Display Results
       $view->display(); 
   }
   
   public function add()
   {
      //check if user is has rights to add an address
      $user = JFactory::getUser();
      $uid = $user->get('id');
      if (!$uid) {
        JError::raiseWarning('','You must be logged in to add a celebrity');
        $url = @$_SERVER['HTTP_REFERER'];
        $uri = JURI::getInstance();
        $uri->parse($url);
        $task = $uri->getVar('task');
        $controller = $uri->getVar('controller');
        if (($task == 'add') && ($controller == 'celebrity')) {
            $url = JURI::root();
            $this->setRedirect($url);
        } else {
            $this->setRedirect($url);
        }   
      } else {
        //we have a logged in user to so pass along his id
        JRequest::setVar('uid',$uid);
        $view = $this->getView('celebrity','html');
        $view->display();
      }       
   }

}
?>
