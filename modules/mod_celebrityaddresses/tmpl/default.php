<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
//load module css
$css = JURI::base().'modules/mod_celebrityaddresses/assets/css/celebrityaddresses.css';
$document = JFactory::getDocument();
$document->addStyleSheet($css);

$cid = JRequest::getInt('cid');
$i = 1;
$user = JFactory::getUser();
?>
           <!-- <div id="gavickModule">
				<ul id="gModule">
					<li><a href="#">Postal Addresses</a></li>
					<li><a href="#">Email Addresses</a></li>
					<li><a href="#">Websites</a></li>
				</ul>
				<ul id="nextButtons">
					<li class="nextCircle"><a href="#"></a></li>
					<li class="nextCircle"><a href="#"></a></li>
					<li class="nextCircle"><a href="#"></a></li>
					<li id="backwardsArrow"><a href="#"></a></li>
					<li id="forwardArrow"><a href="#"></a></li>
				</ul>
			</div>-->
   			<div class="moduletable">
			<div>
	   			<div class="moduletable_content">
					<div class="gk_tab gk_tab-style1 clearfix-tabs" id="tabmix1">
                   			<div class="gk_tab_wrap-style1 clearfix-tabs" style="">
                            <ul class="gk_tab_ul-style1">
                                <li id="tabmix1_tab_1"><span>Postal Addresses</span></li>
                                <li id="tabmix1_tab_2"><span>Email Addresses</span></li>
                                <li id="tabmix1_tab_3"><span>Websites </span></li>
					        </ul>
                             <ul id="nextButtons">
                        		<li class="nextCircle"><a href="#"></a></li>
                                <li class="nextCircle"><a href="#"></a></li>
                                <li class="nextCircle"><a href="#"></a></li>
                                <li id="backwardsArrow"><a href="#"></a></li>
                                <li id="forwardArrow"><a href="#"></a></li>
						    </ul>
							<div class="gk_tab_container0-style1">  <!--style="height: 100px;"-->
						        <div class="gk_tab_container1-style1 clearfix-tabs"><!--style="height: 100px;"-->
						            <div class="gk_tab_container2-style1 clearfix-tabs">
										<div class="gk_tab_item-style1"><!--style="height: 100px;"-->
											<?php if ($addresses) : ?>
                                            <?php foreach ($addresses AS $key => $address) : ?>
                                            <div class="individualAddress">
                                              <ul>
                                                <li class="addressTitle"><?php echo JText::_('Address').''.$i ?></li>
                                                <li class="viewDetail"><a href="#"></a></li>
                                                <li class="addressLine1"><?php echo ($address->company)? $address->company: $address->name ?></li>
                                                <li class="addressLine2"><?php echo ($user->get('id')) ? $address->line_1 : substr($address->line_1,0,4).' ****' ?></li>
                                                <li class="city_state_zip"><?php echo $address->city.', '.$address->state.' '.$address->zipcode ?></li>
                                                <li class="submission">Submitted by: <a href="#"><?php echo $address->date ?></a></li>
                                                <li class="success"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/success_check.png" alt="success" title="success"/>Success  <img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/success_green.png" alt="successNumber" title="successNumber"><a class="green" href="#"><?php echo (!empty($successCounts[$key]->total_success)) ? $successCounts[$key]->total_success : '0' ?></a><a class="red" href="#"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/unsuccess_red.png" alt="unsuccessNumber" title="unsuccessNumber"/><?php echo (!empty($returnedCounts[$key]->total_returned)) ? $returnedCounts[$key]->total_returned : '0' ?></a></li>
                                        </ul>
										<!--<div class="gk_tab_item_space"></div>-->
										</div>
										<div class="gk_tab_item-style1" style="height: 100px;">
											<div class="gk_tab_item_space">
                                            <!--Place Email address code here-->
                                            <!--<div class="individualAddress">
                                              <ul>
                                               <li class="addressTitle">Address2</li>
                                                <li class="viewDetail"><a href="#"></a></li>
                                                <li class="addressLine1">A Train</li>
                                                <li class="addressLine2">PO B ****</li>
                                                <li class="city_state_zip">Oakland, CA 94604</li>
                                                <li class="submission">Submitted by: <a href="#">01.12.2011</a></li>
                                                <li class="success"></li>
                                              </ul>
										   </div>-->
										   </div>
										</div>
										<div class="gk_tab_item-style1" style="height: 100px;">
											<div class="gk_tab_item_space">
                                             <!-- Place Websites address code here-->
                                              <!--<div class="individualAddress">
                                               <ul>
                                                <li class="addressTitle">Address3</li>
                                                <li class="viewDetail"><a href="#"></a></li>
                                                <li class="addressLine1">A Train</li>
                                                <li class="addressLine2">PO B ****</li>
                                                <li class="city_state_zip">Oakland, CA 94604</li>
                                                <li class="submission">Submitted by: <a href="#">01.12.2011</a></li>
                                                <li class="success"></li>
                                               </ul>
										      </div>-->
                                            </div>
										</div>
                                  </div>
                               </div>
                        <div class="clearfix-tabs"></div>
                        <div class="gk_tab_button_next-style1"></div>
                        <div class="gk_tab_button_prev-style1"></div>
    						</div>
						</div>
					</div>

				</div>
			</div>
			</div>
          </div>

<?php /*?><div class="addressList">
<?php if ($addresses) : ?>
<?php foreach ($addresses AS $key => $address) : ?>

				<div class="individualAddress">
					<ul>
						<li class="addressTitle"><?php echo JText::_('Address').''.$i ?></li>
						<li class="viewDetail"><a href="#"></a></li>
						<li class="addressLine1"><?php echo ($address->company)? $address->company: $address->name ?></li>
						<li class="addressLine2"><?php echo ($user->get('id')) ? $address->line_1 : substr($address->line_1,0,4).' ****' ?></li>
						<li class="city_state_zip"><?php echo $address->city.', '.$address->state.' '.$address->zipcode ?></li>
						<li class="submission">Submitted by: <a href="#"><?php echo $address->date ?></a></li>
						<li class="success"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/success_check.png" alt="success" title="success"/>Success  <img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/success_green.png" alt="successNumber" title="successNumber"><a class="green" href="#"><?php echo (!empty($successCounts[$key]->total_success)) ? $successCounts[$key]->total_success : '0' ?></a><a class="red" href="#"><img src="<?php echo JURI::base();?>templates/gk_musicity/images/style4/unsuccess_red.png" alt="unsuccessNumber" title="unsuccessNumber"/><?php echo (!empty($returnedCounts[$key]->total_returned)) ? $returnedCounts[$key]->total_returned : '0' ?></a></li>
					</ul>
			</div><?php */?>
<?php /*?><div class="address-container">
    <div class="address-header">
        <div class="address-header-text"><?php echo JText::_('Address').' #'.$i ?></div>
        <div class="address-results-successes">
            <div class="address-successes"><img src="<?php echo JURI::base().'modules/mod_celebrityaddresses/assets/images/spacer.png' ?>" alt="Successes" width="18" height="15" /></div>
            <div class="address-results-count"><?php echo (!empty($successCounts[$key]->total_success)) ? $successCounts[$key]->total_success : '0' ?></div>
        </div>
        <div class="address-results-failures">
            <div class="address-failures"><img src="<?php echo JURI::base().'modules/mod_celebrityaddresses/assets/images/spacer.png' ?>" alt="Failures" width="18" height="15"></div>
            <div class="address-results-count"><?php echo (!empty($returnedCounts[$key]->total_returned)) ? $returnedCounts[$key]->total_returned : '0' ?></div>
        </div>
    </div>
    <div class="address-body">
        <div><?php echo ($address->company)? $address->company: $address->name ?></div>
        <div><?php echo ($user->get('id')) ? $address->line_1 : substr($address->line_1,0,4).' ****' ?></div>
        <div><?php echo $address->city.', '.$address->state.' '.$address->zipcode ?></div>
        <div><span><?php echo JText::_('Submitted') ?>:</span><span><?php echo $address->date ?></span></div>
    </div>
    <div class="address-footer">
        <div>
            <?php if ($user->get('id')) : ?>
            <a href="<?php echo JRoute::_('index.php?option=com_celebrity&view=address&task=details&type=address&aid='.$address->id.'&cid='.$cid.'&anumber='.$i) ?>"><?php echo JText::_('ADDRESS DETAILS') ?></a>
            <?php else : ?>
            <a class="address_login" href="<?php echo JRoute::_('index.php?option=com_user&view=login') ?>"><?php echo JText::_('LOGIN FOR DETAILS') ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php */?><?php
$i++; 
endforeach; 
?>
</div>
<?php else : ?>
<div>No Addresses Found</div>
<?php endif; ?>
<div class="moduletable">
