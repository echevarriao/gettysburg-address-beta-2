<?php

/**
 * 
 * The template for displaying search results pages
 * 
 * @package
 * @since 0.1
 * 
 */

global $wp_query;
$total_results = $wp_query->found_posts;

?>
<?php $theme_obj->getHeader(); ?>

  <section id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
            <div class ="grid-container">
                <div class ="grid-x grid-margin-x">
                    <div class ="cell large-12">
                        <p>&nbsp;</p>
                <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'gettysburg' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
                            <p><b>Search Results: </b> <?php print $total_results; ?></p>
                        </div>
                    </div>
                </div>

            <?php if ( have_posts() ) : ?>

            <div class ="grid-container">
                <div class ="grid-x grid-margin-x">
                    <div class ="cell large-12">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php $theme_obj->getTemplatePart( 'content', 'search' ); ?>
                <?php endwhile; ?>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                
                <div class ="grid-container">
                    <div class ="grid-x grid-margin-x">
                        <div class ="large-12 cell">
                            <p>Your search has return no results.</p>
                            <?php print $theme_obj->getSearchForm('Search'); ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            </div><!-- #content .site-content -->
        </section><!-- #primary .content-area -->

<?php $theme_obj->getFooter(); ?>