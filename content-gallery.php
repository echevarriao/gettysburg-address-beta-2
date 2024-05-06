<?php
/**
 * Template part for displaying page content in gallery.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Gettysburg_Address
 * @since 0.1
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
                <h2 class = "header-content" id = "header-id">
					<?php the_title(); ?>
				</h2>
        </header>
        <div class="entry-content">
                <?php the_content(); ?>
        </div><!-- .entry-content -->
        <?php if ( get_edit_post_link() ) : ?>
		<div class = "edit-button-row" id = "edit-row">
<?php edit_post_link(__('edit content', 'gettysburg-address'), '<p>', '</p>', null, 'hollow button'); ?>
		</div>
        <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
