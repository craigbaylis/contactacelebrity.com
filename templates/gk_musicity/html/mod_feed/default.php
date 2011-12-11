<?php 

/**
 * 
 * GK Joomla! Override by GavickPro
 * 
 * v.1.0.0
 * 
 */

/**
 *
 * CSS classes
 * 
 * .mod_feed - selector for main container
 * .mod_feed>h3 - selector for header with RSS url
 * .mod_feed>h3 a - selector for link in header
 * .mod_feed>p.desc - selector for feed description
 * .mod_feed>p.img - selector for block with feed image
 * .mod_feed>p.img img - selector for image in block with feed image
 * .mod_feed>ul.list - selector for list
 * .mod_feed>ul.list li - selector for item
 * .mod_feed>ul.list li a - selector for item link
 * .mod_feed>ul.list li .item - selector for item text
 * 
 * -- when counting mode for user list is enabled you can use also these classes: 
 * 
 * .mod_feed>ul.list li.odd - selector for odd items
 * .mod_feed>ul.list li.even - selector for even items
 * 
 * -- REQUIRED styles
 * 
 * .mod_feed.dir_left,
 * .mod_feed .item.dir_left{
 *    direction: ltr;
 *    text-align: left!important;	
 * }
 * 
 * .mod_feed.dir_right,
 * .mod_feed .item.dir_right{
 *    direction: rtl;	
 *    text-align: right!important;
 * }
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 *
 * Configuration
 * 
 */

// Enabled counting mode causes adding classes odd/even for users list 
$mod_feed_counting_mode = true; // counting mode is enabled

// Enabled target="_blank" in feed urls
$mod_feed_target_blank = true; // target="blank" in feed url is enabled

/**
 *
 * Additional code
 * 
 */ 

$mod_feed_direction = 'dir_'.(($rssrtl) ? 'right' :'left');

if( $feed != false )
{
	// image handling
	$iUrl 	= isset($feed->image->url)   ? $feed->image->url   : null;
	$iTitle = isset($feed->image->title) ? $feed->image->title : null;	
	// showing title
	$mod_feed_show_title = !is_null( $feed->title ) && $params->get('rsstitle', 1);
	$mod_feed_url        = str_replace( '&', '&amp', $feed->link );
	$mod_feed_target     = ($mod_feed_target_blank) ? ' target="_blank"' : '';
	
	$actualItems = count( $feed->items );
	$setItems    = $params->get('rssitems', 5);
    $totalItems  = ($setItems > $actualItems) ? $actualItems : $setItems;
    
   	$words = $params->def('word_count', 0);
}

?>

<div class="mod_feed <?php echo $mod_feed_direction; ?>">

<?php if( $feed != false ) : ?>
	<?php if ($mod_feed_show_title) : ?>
	<h3>
		<a href="<?php echo $mod_feed_url; ?>"<?php echo $mod_feed_target; ?>>
			<?php echo $feed->title; ?>
		</a>
	</h3>
	<?php endif; ?>
	
    <?php if ($params->get('rssdesc', 1)) : ?>
	<p class="desc">
		<?php echo $feed->description; ?>
	</p>
	<?php endif; ?>
	
	<?php if ($params->get('rssimage', 1) && $iUrl) : ?>
	<p class="img">
		<img src="<?php echo $iUrl; ?>" alt="<?php echo @$iTitle; ?>"/>
	</p>
	<?php endif; ?>

	<ul class="list">
	<?php for ($j = 0; $j < $totalItems; $j ++) : ?>
		<?php 
			$currItem = & $feed->items[$j];
			if($mod_feed_counting_mode) $mod_feed_counting_class = ' class="'.((($j+1)%2 == 1) ? 'odd' : 'even').'"'; 
			else $mod_feed_counting_class = '';
		?>
		<li<?php echo $mod_feed_counting_class; ?>>
			<?php if ( !is_null( $currItem->get_link() ) ) : ?>
			<a href="<?php echo $currItem->get_link(); ?>"<?php echo $mod_feed_target; ?>>
				<?php echo $currItem->get_title(); ?>
			</a>
			<?php endif; ?>
			
			<?php if ($params->get('rssitemdesc', 1)) : ?>
				<?php 
					$text = $currItem->get_description();
					$text = str_replace('&apos;', "'", $text);
					// word limit check
					if ($words) {
						$texts = explode(' ', $text);
						$count = count($texts);
						if ($count > $words) {
							$text = '';
							for ($i = 0; $i < $words; $i ++) { $text .= ' '.$texts[$i]; }
							$text .= '...';
						}
					}
				?>
				<div class="item <?php echo $mod_feed_direction; ?>">
					<?php echo $text; ?>
				</div>
			<?php endif; ?>
		</li>
	<?php endfor; ?>
	</ul>
<?php else: ?>
	No feed to display
<?php endif; ?>
</div>