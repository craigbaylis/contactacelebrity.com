<?php
/**
 * Celebrity Addresses Module Entry Point
 * 
 * @package    CAC
 * @subpackage Joomla!
 * @link www.tcmsvc.net
 * @license        Private
 * Displays a list of celebrity addresses
 */
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
 
//get the addresses
$addresses = modCelebrityAddressesHelper::getAdddresses($params);

if(!empty($addresses)) {

    //get the address success count
    $keys = array_keys($addresses);
    $keys = implode(',',$keys);
    $successCounts = modCelebrityAddressesHelper::getResults($keys,'success');

    //get the address failure count
    $returnedCounts = modCelebrityAddressesHelper::getResults($keys,'returned');    
} 

require( JModuleHelper::getLayoutPath( 'mod_celebrityaddresses' ) );
?>
