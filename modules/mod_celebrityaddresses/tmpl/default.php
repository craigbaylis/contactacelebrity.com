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
<?php if ($addresses) : ?>
<?php foreach ($addresses AS $key => $address) : ?>
<div class="address-container">
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
<?php
$i++; 
endforeach; 
?>
<?php else : ?>
<div>No Addresses Found</div>
<?php endif; ?>
