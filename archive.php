<?php

/**
 *
 *
 * The template for displaying: archives
 * 
 * @package WordPress
 * @subpackage Gettysburg_Address
 * @since 0.1
 *
 * 
 *
 */

?>
<?php $theme_obj->getHeader(); ?>
	<div class = "content-box" id = "archive-content-container"><!-- start content box section -->
            <div id = "archive-container" class = "grid-container fluid">
                <div class = "grid-x grid-padding-x">
                    <div class = "cell">

<?php if(have_posts()) { ?>

            
            
<?php while(have_posts()) { the_post(); ?>

<?php $theme_obj->getTemplatePart('content', 'archive'); ?>

<?php } ?>

<?php } else { ?>

    <?php $theme_obj->getTemplatePart('content', '404'); ?>

<?php } ?>
                    </div>
                </div>
            </div>            
        </div>
<?php $theme_obj->getFooter(); ?>