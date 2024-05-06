<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $wp_query;
$total_results = $wp_query->found_posts;


?>

<div class = "content-box" id = "page-content-container"><!-- start content box section -->
    <div class ="grid-container">
                <div class ="grid-x grid-margin-x">
                    <div class ="cell large-12">
                        
                        
                        <?php print $theme_obj->getSearchForm('Search'); ?>
                    </div>
                </div>
    </div>
</div>
