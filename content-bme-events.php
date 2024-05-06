<?php
/**
 * Template part for displaying page content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Gettysburg_Address
 * @since 0.1
 */

?>
<div id = "post-container" class = "grid-container fluid">
        <div class = "grid-x grid-padding-x">
                <div class = "cell">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                        <h2 class = "header-content" id = "header-id">
                        			<?php the_title(); ?>
                        		</h2>
                                </header>
                                <div class="entry-content">
                                        <?php the_content(); ?>
<?php 

$obj = array();

$obj['start-time'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_start-time', true);
$obj['end-time'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_end-time', true);
$obj['excerpt'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-excerpt', true);
$obj['desc'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-description', true);
$obj['location'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_location', true);
$obj['flyer'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-flyer', true);
$obj['icon'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_event-icon', true);
$obj['date'] = get_post_meta(get_the_ID(), 'biomedical_engineering_events_date-of-event', true);

?>

<?php if($obj['date']): ?>
<p><b>Date of Event</b> <?php print date("M d Y", strtotime($obj['date'])) ?></p>
<?php endif; ?>

<?php if($obj['start-time']): ?>
<p><b>Start Time</b> <?php print date("h:i A", strtotime($obj['start-time'])) ?></p>
<?php endif; ?>

<?php if($obj['end-time']): ?>
<p><b>End Time</b> <?php print date("h:i A", strtotime($obj['end-time'])) ?></p>
<?php endif; ?>

<?php if($obj['desc']): ?>
<p><b>Description</b></p>
<p><?php print $obj['desc'] ?></p>
<?php endif; ?>

<?php if($obj['flyer']): ?>
<p><b>Flyer -- </b><a href = "<?php print $obj['flyer'] ?>" target = "_blank">Download</a></p>
<?php endif; ?>

<?php if($obj['location']): ?>
<p><b>Location</b></p>
<p><?php print $obj['location'] ?></p>
<?php endif; ?>



                                <?php the_date( 'M d, Y', '<p><b>Date Published: </b> <i>', '</i></p>' ); ?>
                                </div><!-- .entry-content -->
                                <?php if ( get_edit_post_link() ) : ?>
                        	<div class = "edit-button-row" id = "edit-row">
                                <?php edit_post_link(__('edit content', 'gettysburg-address'), '<hr /><p>', '</p><hr>', null, 'hollow button'); ?>
                        	</div>
                                <?php endif; ?>
                        </article><!-- #post-<?php the_ID(); ?> -->
                </div>
        </div>
</div>
