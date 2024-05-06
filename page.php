<?php

/**
 *
 *
 * The template for displaying: page content
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
	<div class = "content-box" id = "page-content-container"><!-- start content box section -->
<?php if(have_posts()) { ?>

<?php while(have_posts()) { the_post(); ?>

<?php $theme_obj->getTemplatePart('content', 'page'); ?>

<?php } ?>

<?php } else { ?>

    <?php $theme_obj->getTemplatePart('content', '404'); ?>

<?php } ?>
	</div>
<?php $theme_obj->getFooter(); ?>