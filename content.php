<?php
/**
 * Template part for displaying content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Gettysburg_Address
 * @since 0.1
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header"><!-- start of entry header-->
                <?php
                if ( is_sticky() && is_home() && ! is_paged() ) {
                        printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'twentynineteen' ) );
                }
                if ( is_singular() ) :
                        the_title( '<h1 class="entry-title">', '</h1>' );
                else :
                        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                endif;
                ?>
        </header><!-- end of entry header -->
        <div class="entry-content"><!-- start of entry content -->
                <?php the_content(); ?>
        </div><!-- end of entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
