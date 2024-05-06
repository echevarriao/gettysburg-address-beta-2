<?php /* Template Name: Search Page Template */ ?>
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
            <div class ="grid-container">
                <div class ="grid-x grid-margin-x">
                    <div class ="cell large-12">
                        <?php print $theme_obj->getSearchForm('Search'); ?>
                    </div>
                </div>
            </div>
	</div>
<?php $theme_obj->getFooter(); ?>