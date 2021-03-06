<?php
/**
 * Celebrity View for Celebrity Component
 * 
 * @package    Celebrity
 * @subpackage com_celebrity
 * @license  GNU/GPL v2
 *
 * Created with Marco's Component Creator for Joomla! 1.5
 * http://www.mmleoni.net/joomla-component-builder
 *
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Celebrity view
 *
 * @package    Joomla.Components
 * @subpackage 	Celebrity
 */
class CelebrityViewResultreceivedtype extends JView
{
	/**
	 * display method of Celebrity view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the data
		$data =& $this->get('Data');
		$isNew = ($data->id == null);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Received Type' ).': <small>[ ' . $text.' ]</small>' );
		JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('data', $data);
		
		// create options for 'select' used in template
		$dataOptions = array();
		foreach(explode(',', '') as $field){
			if (!$field) continue;
			//options array are generated in the model...
			$dataOptions[$field] =& $this->get( ucfirst($field) );
		}
		
		/*
		// related table example 
		// thisTableFieldKey : foreign key (es #__content.catid -> 'catid')
		// relatedTableModelList : name used for table holding data (es #__content -> 'contentlist')
		// getRelatedTableFieldData : method for getting related table values for key (es #__categories.title -> 'getTitleFieldData()')
		// REMEMBER to add model inclusion in controller recordset list
		// see http://www.mmleoni.net/joomla-component-builder/create-joomla-extensions-manage-the-back-end-part-2
		
		$rmodel =& $this->getModel('relatedTableModelList'); 
		$dataOptions['thisTableFieldKey'] =& $rmodel->relatedTableGetField();
		*/

		
		$this->assignRef('dataOptions', $dataOptions);

		parent::display($tpl);
	}
}