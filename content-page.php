<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Gettysburg_Address
 * @since 0.1
 */

?>
<div id = "page-container" class = "grid-container fluid">
        <div class = "grid-x grid-padding-x">
                <div class = "cell">
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                        <h1 class = "header-content" id = "header-id">
                        			<?php the_title(); ?>
                        		</h1>
                                </header>
                                <div class="entry-content">
                                        <?php the_content(); ?>
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
