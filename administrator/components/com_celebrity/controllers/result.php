<?php
/**
 * Celebrity Controller for Celebrity Component
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

/**
 * Celebrity Model
 *
 * @package    Joomla.Components
 * @subpackage 	Celebrity
 */
class CelebrityControllerResult extends CelebrityController{


	/**
	 * Parameters in config.xml.
	 *
	 * @var	object
	 * @access	protected
	 */
	private $_params = null;

	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct(){
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
		
		// Set reference to parameters
		$this->_params = &JComponentHelper::getParams( 'com_celebrity' );
		//$dummy = $this->_params->get('parm_text');

	}

	/**
	 * display the edit form
	 * @return void
	 */
	public function edit(){
		JRequest::setVar( 'view', 'result' );
		JRequest::setVar( 'layout', 'default'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	public function save(){
		$model = $this->getModel('result'); 

		if ($model->store()) {
			$msg = JText::_( 'Data Saved' );
		} else {
			$msg = JText::_( 'Error Saving Data' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_celebrity&controller=resultlist';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	public function remove(){
		$model = $this->getModel('result'); //
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Items Could not be Deleted' );
		} else {
			$msg = JText::_( 'Data Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_celebrity&controller=resultlist', $msg );
	}

	/**
	 * cancel editing a record
	 * @return void
	 */
	public function cancel(){
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_celebrity&controller=resultlist', $msg );
	}
}