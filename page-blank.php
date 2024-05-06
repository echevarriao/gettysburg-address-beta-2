<?php /* Template Name: Blank Page Template */ ?>
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
<?php $theme_obj->getHeader('blank'); ?>
	<div class = "content-box" id = "page-content-container"><!-- start content box section -->
<?php if(have_posts()) { ?>

<?php while(have_posts()) { the_post(); ?>

<?php the_content(); ?>

<?php } ?>

<?php } else { ?>

<?php } ?>
	</div>
<?php $theme_obj->getFooter('blank'); ?>