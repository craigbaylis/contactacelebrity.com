<?php
/**
* @package      PROJECT
* @subpackage   EXTENSION
* @copyright    Copyright (C) TCM Services. All rights reserved.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>
<style>
#gk-current-content-wrap{
background:none;	
}
#wrapper {
	margin-left:-15px;
	width: 1000px;
}
</style>
<div id="wrapper">		
<div id="homeLeftContainer">		
	<div class="width680">
		<h1 class="search">Most Recent Celebrity Result</h1>
		
		    <?php 
$resultceleb = JModuleHelper::getModule('mod_recentcbresult','GK Recent Celebrity Result');
echo JModuleHelper::renderModule($resultceleb);



?><!-- div#homeMainContentContainer close -->
			
			
	</div><!-- div.width680 close -->

<!-- ============================================================================================== -->	





<!-- ============================================================================================== -->	

<div class="width680" id="joinToday">
	<h1 class="redBg">Join Today and Start Contacting Your Favorite Celeb!</h1>
	
	<div id="join_left">
	<h3>Join Contact A Celebrity Today!</h3>
	<p>It's so easy and fun! Contact any celebrity you like, as many times as you want. Our exclusive celebrity address list provides you with real addresses of Hollywood's biggest stars. Join our community and share your success with other members. There is no other celebrity site on the internet that offers you more addresses than ContactACelebrity.com. We sish you great success as you gather autographs, photos, send fanmails or just enjoy browsing the site.</p>
	</div><!-- div#join_left close -->
	<a id="joinNow" href="#"></a>
	

</div><!-- div.width680 close -->

</div><!-- div#home_leftContainer close -->	
<!-- ============================================================================================== -->	

<div id="homeRightContainer">
<div class="rightColumn_width300">
	<h1 class="search">Welcome to Contact A Celebrity!</h1>
	<p>" Thanks again for using CAC's contact database! We hope you'll continue to use us for all your autograph collecting needs. Finding addresses for stars like shania is never easy, but we hope our address information makes it possible for you to get that autograph that you are looking for! "</p>

</div><!-- div.rightColumn_width300 close -->

<div class="rightColumn_width300">
    <?php 
	$topsigner = JModuleHelper::getModule('mod_gk_js_topsinger','GK Top Singer');
echo JModuleHelper::renderModule($topsigner);?>


</div><!-- div.rightColumn_width300 close -->

<div class="rightColumn_width300">
	<h1 class="search">Forum Comments</h1>
	
		<div class="forumPost">
			<img class="avatar" src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>avatar3.gif" alt="avatar3" width="72" height="71" />
			<ul>
				<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>greenStar.png" alt="greenStar" width="13" height="12" /></li>
				<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
				<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
			</ul>
		</div><!-- .forumPost close -->
		
		<div class="forumPost">
			<img class="avatar" src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>avatar3.gif" alt="avatar3" width="72" height="71" />
			<ul>
				<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>greenStar.png" alt="greenStar" width="13" height="12" /></li>
				<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
				<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
			</ul>
		</div><!-- .forumPost close -->

		<div class="forumPost">
			<img class="avatar" src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>avatar3.gif" alt="avatar3" width="72" height="71" />
			<ul>
				<li class="postedBy">Posted by <a href="#">Rossy</a><img src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>greenStar.png" alt="greenStar" width="13" height="12" /><img src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>greenStar.png" alt="greenStar" width="13" height="12" /></li>
				<li class="postingDate">Fri, Sep 04 2010 10:34PM</li>
				<li class="commentText"><p>I just got signed poster from Audrey Tautou way from France!</p></li>
			</ul>
		</div><!-- .forumPost close -->
		<a href="#"><img id="recentCommentRSS" src="<?php echo JURI::base().'templates/gk_musicity/images/style4/';?>rss2.png" alt="rss%202" width="64" height="25" /></a>
</div><!-- div.rightColumn_width300 close -->
</div><!-- div#homeRightContainer close -->

<div class="clr"></div><!-- div#home_bottomContainer close -->

</div>