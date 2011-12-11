<?php

/*
#------------------------------------------------------------------------
# Copyright (C) 2007-2010 Gavick.com. All Rights Reserved.
# License: Copyrighted Commercial Software
# Website: http://www.gavick.com
# Support: support@gavick.com   
#------------------------------------------------------------------------ 
# Based on T3 Framework
#------------------------------------------------------------------------
# Copyright (C) 2004-2009 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
# @license - GNU/GPL, http://www.gnu.org/copyleft/gpl.html
# Author: J.O.O.M Solutions Co., Ltd
# Websites: http://www.joomlart.com - http://www.joomlancers.com
#------------------------------------------------------------------------
*/


class ObjectExtendable
{
	var $_extendableObjects =     array();
	
	function _extend($oObject)
	{
		if (is_object($oObject)) {
			$this->_extendableObjects[] = $oObject;
		} else if (is_array($oObject)) {
			$this->_extendableObjects = array_merge($this->_extendableObjects, $oObject);
		}
	}

	function __get($sName)
	{
		foreach ($this->_extendableObjects as $oObject) {
			if (property_exists($oObject, $sName)) {
				$sValue = $oObject->$sName;
				return $sValue;
			}
		}
		
		return null;
	}
	
	function __set($sName, $sValue)
	{
		foreach ($this->_extendableObjects as $oObject) {
			if (property_exists($oObject, $sName)) {
				return $oObject->$sName = $sValue;
			}
		}
	}
	
	function __call($sName, $aArgs = array())
	{
		// try call itself method
		if (method_exists($this, $sName)) {
			$return = call_user_func_array(array($this, $sName), $aArgs);
			return $return;
		}
		
		// try to call method extended from objects
		foreach ($this->_extendableObjects as $oObject) {
			//if (method_callable($oObject, $sName)) {
			if (method_exists($oObject, $sName)) {
				$return = call_user_func_array(array($oObject, $sName), $aArgs);
				return $return;
			}
		}
 
		return NULL;
	}
}