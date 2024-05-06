<?php
/**
 * Template part for displaying page content in search.php
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
            <?php the_excerpt(); ?>
            <p><a href ="<?php the_permalink(); ?>" class ="hollow button">View Content</a>
            <hr />
        </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
