<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

$width= $params->get('sortdesign', 'vertical');
$limitAuction =  $params->get('limitAuction', '10');
$title_length =  $params->get('title_length', '50');
$item = 1;
$css = JURI::base().'modules/mod_myebay_search/css/style.css';
$document = JFactory::getDocument();
$document->addStyleSheet($css);
?>

<div class="<?php echo $width;?>">
  <?php 
    if( $feedtotal != false )  {
      $picture =  $params->get('picture', 'false');
      $lines=1;
  ?>
  <?php foreach ($feedtotal as $feeditem) { ?>
    <?php if ($item == 1)  echo "<ul>"; ?>
     
     <?php 
       if (strlen($feeditem['title']) > $title_length){
         $title = substr($feeditem['title'],0,$title_length).'(...)';
       } else {
         $title = $feeditem['title'];
       }
     ?>
     
     
	<li <?php if ($item !=1){ echo 'class="border"'; }?>>
	  <?php if (!$picture){ ?>
	    <div class="ebaylist_MyEbay_Search">
		  <div class="ebaytitleSmall_MyEbay_Search">
		    <a href="<?php echo $feeditem['url']; ?> " target = "_blank"><?php echo $title; ?></a>
		  </div>
		<div class="price">
		  <?php echo $feeditem["price"]; ?>
        </div>				
      </div>
      <?php } else { ?>
        <div class="ebaylist_MyEbay_Search">
          <div class="ebaytitle_MyEbay_Search">
            <a href="<?php echo $feeditem['url']; ?> " target = "_blank"><?php echo $title; ?></a>
          </div>
          <div class="description">
            <?php echo $feeditem["description"]; ?>
          </div>
        </div>
      <?php } ?>
    </li>		
	<?php $item++; ?>
	<?php 
	  if ($width == 'horizontal'){
        if ($item == 3) {
          echo "</ul>";
          if ((($item-1)*$lines) != count($feedtotal)) {echo "<div class='ebayseparator'>&nbsp;</div>"; }
          $item = 1;
          $lines++;
        }
      } 
    ?>
    <?php } ?>
  <?php if ($width =='vertical'){ echo "</ul>";} ?>
  <?php } ?>
</div>