<?php
/**
 * Celebrity View for com_celebrity Component
 * 
 * @package    Celebrity
 * @subpackage com_celebrity
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Celebrity Component
 *
 * @package	Joomla.Components
 * @subpackage	Celebrity
 */
class CelebrityViewResult extends JView
{
	function display($tpl = null)
	{
		$layout = $this->getLayout();
        switch($layout){
            case 'success':        
            
            //build return to celebrity link
            $cid = JRequest::getInt('cid');
            
            //get the celebrity menu itemid
            $menu = JSite::getMenu();
            $celebDetailsMenu = $menu->getItems('link','index.php?option=com_celebrity&view=celebrity&layout=details',true);
            if (is_object($celebDetailsMenu)) {
               $Itemid = '&Itemid='.$celebDetailsMenu->id;
            } 
            
            $backlink = JRoute::_('index.php?option=com_celebrity&view=celebrity&task=details&cid='.$cid.$Itemid);
            $this->assignRef('backlink',$backlink);
            break;
            
            case 'form':
            //get the celebrity's name
            $celebrityModel = $this->getModel('Celebrity');
            $celebrity = $celebrityModel->getData();            
            $this->assignRef('celebrity',$celebrity);
            
            //get the chosen address information
            $addressModel = $this->getModel('Address');
            $address = $addressModel->getMailingAddress();
            $this->assignRef('address',$address);
            
            //get the sent types
            $resultsenttypeModel = $this->getModel('resultsenttype');
            $resultsenttypes = $resultsenttypeModel->getData();
            $this->assignRef('resultsenttypes',$resultsenttypes);           
            
            //get the result received types
            $resultreceivedtypeModel = $this->getModel('resultreceivedtype');
            $resultreceivedtypes = $resultreceivedtypeModel->getData();
            $this->assignRef('resultreceivedtypes',$resultreceivedtypes);
            $otherSuccesses = array();
            foreach ($resultreceivedtypes AS $resultreceivedtype) {
                if($resultreceivedtype->name !='success') $otherSuccesses[] = '#'.$resultreceivedtype->name;    
            }
            $otherSuccesses = implode(',',$otherSuccesses);
            $this->assignRef('otherSuccesses',$otherSuccesses);
            
            //get the quality types
            $resultqualitylistModel = $this->getModel('resultqualitylist');
            $resultqualitylist = $resultqualitylistModel->getData();
            
            //prepare the quality types dropdown
            $options = array();
            foreach ($resultqualitylist AS $resultquality) {
                $options[] = JHTML::_('select.option',$resultquality->id,$resultquality->quality);
            }
            $qualitytypedropdown = JHTML::_('select.genericlist', $options, 'quality_id', 'id="quality_id" class="dropdown" disabled="disabled"', 'value', 'text');
            $this->assignRef('qualitytypedropdown',$qualitytypedropdown);
            
            //create date sent calendar
            $date_sent = JHTML::_('calendar','','date_sent','date_sent','%B %d, %Y', array('readonly' => 'readonly','class'=>'validate[\'required\']'));
            $this->assignRef('date_sent',$date_sent);
            
            //create date received calendar
            $date_received = JHTML::_('calendar','','date_received','date_received','%B %d, %Y', array('readonly' => 'readonly','class'=>'validate[\'required\']'));
            $this->assignRef('date_received',$date_received);
            
            //get component configuration variables
            $componentHelper = JComponentHelper::getParams('com_celebrity');
            $max_image_uploads = $componentHelper->get('max_image_uploads','2');
            $this->assignRef('max_image_uploads',$max_image_uploads);
            break;
            
            default:
            $data = $this->get('Data');
            $this->assignRef('data', $data);
        }

		parent::display($tpl);
	}
}
?>
