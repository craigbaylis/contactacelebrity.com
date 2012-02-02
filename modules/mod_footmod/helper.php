<?php

/**

 * Helper class for new address! module

 * 

 * @package    Joomla.Tutorials

 * @subpackage Modules

 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/

 * @license        GNU/GPL, see LICENSE.php

 * mod_newaddress is free software. This version may have been modified pursuant

 * to the GNU General Public License, and as distributed it includes or

 * is derivative of works licensed under the GNU General Public License or

 * other free or open source software licenses.

 */

class modFootModHelper

{

    /**

     * Retrieves the hello message

     *

     * @param array $params An object containing the module parameters

     * @access public

     */    

    function getNewaddress()

    {

		$db= JFactory::getDBO();

		$query='select

		      b.company,

              b.line_1,

              b.line_2,

              b.city,

			  c.name AS country,

              c.abbreviation,

              d.name AS state,

              b.zipcode,

			  a.celebrity_id,

              a.address_id

			  from   #__celebrity_address b

			  INNER JOIN #__celebrity_celebrity_address a ON (b.id = a.address_id)

              INNER JOIN #__celebrity_country c ON (b.country_id = c.id)

              INNER JOIN #__celebrity_state d ON (b.state_id = d.id) order by b.id desc limit 0,6';

		$db->setQuery($query);

		$db->query(); 

		 $result = $db->loadRowList();

		 return $result;

    }

	

	function getMemberactivity()

    {

		$db= JFactory::getDBO();

		$query='select

		      b.title,

              b.content,

			  a.thumb,

			  c.name,

			  DATE_FORMAT(b.created,"%a, %b %d %Y %h:%i%p") AS created,

			  b.actor,

			  d.name        

			  from  #__community_activities b 

			  INNER JOIN #__community_users a ON (a.userid = b.actor)

			  INNER JOIN #__users c ON (c.id = b.actor)

			  left join #__users d on (d.id = b.target)

			  order by b.id desc limit 0,4';

		$db->setQuery($query);

		$db->query(); 

		$result = $db->loadRowList();

		return $result;

    }

	

	function getHotestceleb()

    {

		$db= JFactory::getDBO();

		$query='select

		       a.title,

			   b.filename,

			   a.userfolder,

			   a.id,

			   d.id as celeb_id

               from  #__phocagallery_categories a 

			   INNER JOIN #__phocagallery b ON (b.catid = a.id)

			   INNER JOIN #__celebrity_celebrity d ON (d.album_catid = a.id)

			   where a.parent_id=0 and a.owner_id=0 and b.filename <> " " order by a.id desc limit 0,16';

		$db->setQuery($query);

		$db->query(); 

		$result = $db->loadRowList();

		return $result;

    }

	

	function getNewsceleb()

    {

		$db= JFactory::getDBO();

		$query='select

		       a.introtext

               from  #__content a where a.catid = 8

			   order by rand() limit 0,1';

		$db->setQuery($query);

		$db->query(); 

		$result = $db->loadRowList();

		return $result;

    }

}

?>