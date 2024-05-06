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

<?php if(have_posts()) { ?>

<?php while(have_posts()) { the_post(); ?>

<?php $theme_obj->getTemplatePart('content'); ?>

<?php } ?>

<?php } else { ?>

    <?php $theme_obj->getTemplatePart('content', '404'); ?>

<?php } ?>

<?php $theme_obj->getFooter(); ?>