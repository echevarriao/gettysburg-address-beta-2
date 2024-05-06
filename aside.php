<?php

/**
 *
 *
 * The template for displaying: aside content
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

<?php if(have_posts()) { ?>

<?php while(have_posts()) { the_post(); ?>

<?php get_template_part('content', 'aside'); ?>

<?php } ?>

<?php } else { ?>

<?php } ?>

<?php $theme_obj->getFooter(); ?>