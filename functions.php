<?php

require_once(get_template_directory() . '/inc/theme.class.php');
require_once(get_template_directory() . '/inc/theme.news-shortcode.php');
require_once(get_template_directory() . '/inc/theme.events-shortcode.php');
// require_once(get_template_directory() . '/inc/wpmenu.class.php');

$theme_obj = new ThemeClass();

/* add CSS */

$theme_obj->enqueueCSS('uconn-banner', get_template_directory_uri() . "/uconn-banner-css/uconn-banner.css");
$theme_obj->enqueueCSS('site-styles', get_stylesheet_uri());
$theme_obj->enqueueCSS('foundation-styles', get_template_directory_uri() . "/css/foundation.css");
$theme_obj->enqueueCSS('foundation-float-styles', get_template_directory_uri() . "/css/foundation-float.css");
$theme_obj->enqueueCSS('foundation-prototype-styles', get_template_directory_uri() . "/css/foundation-prototype.css");

/* add jQuery JavaScript */

$theme_obj->enqueueJS('jquery-vendor', get_template_directory_uri() . "/js/vendor.js");
$theme_obj->enqueueJS('jquery-migrate', get_template_directory_uri() . "/js/jquery-migrate-3.3.2.min.js");

/* add Foundation JavaScript files */

$theme_obj->enqueueJS('foundation-main', get_template_directory_uri() . "/js/foundation.js");

/*

$theme_obj->enqueueJS('foundation-core', get_template_directory_uri() . "/js/plugins/foundation.core.js"); 
$theme_obj->enqueueJS('foundation-responsive-menu', get_template_directory_uri() . "/js/plugins/foundation.responsiveMenu.js");
$theme_obj->enqueueJS('foundation-util-triggers', get_template_directory_uri() . "/js/plugins/foundation.util.triggers.js");
$theme_obj->enqueueJS('foundation-media-query', get_template_directory_uri() . "/js/plugins/foundation.util.mediaQuery.js");
$theme_obj->enqueueJS('foundation-responsive-toggle', get_template_directory_uri() . "/js/plugins/foundation.responsiveToggle.js");
$theme_obj->enqueueJS('foundation-util-motion', get_template_directory_uri() . "/js/plugins/foundation.util.motion.js");
*/

$theme_obj->addShortCode('searchform', function($atts){
    
        $defaults = array('label' => 'Search for');
        $inf = array();
        $label = "";
        $h_url = home_url();

        $inf = shortcode_atts($defaults, $atts);
        $label = $inf['label'];
        $inf['form'] = "<form role=\"search\" method=\"get\" id=\"searchform\" class=\"searchform\" action=\"$h_url\">
		<div>
                    <label class=\"screen-reader-text\" for=\"s\">$label</label>
			<input type=\"text\" value=\"\" name=\"s\" id=\"s\" />
			<input type=\"submit\" id=\"searchsubmit\" value=\"Search\" />
		</div>
</form>";

        return $inf['form'];
    
    
});

$theme_obj->addShortCode('foundation_show_posts', function($atts){
    
    $defaults = array('category_name' => 'news', 'class' => 'row small-up-1 medium-up-2 large-up-3', 'posts_per_page' => '3');
    $wp_news = null;
    $content = "";
    $featured_img_url = "";

    $inf = shortcode_atts($defaults, $atts);
    
    $wp_news = new WP_Query($inf);
    $count = $wp_news->post_count;
  
    if($wp_news->have_posts()){
        
    $content .= '<div class = "' . $inf['class'] . '">';
            $content .= "\n";

        while($wp_news->have_posts()){

            $wp_news->the_post();
            
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
            
            $content .= '  <div class="columns column-block">';
            $content .= "<a href = \"" . get_the_permalink() . "\">\n";
            if($featured_img_url) {
                
            $content .= "<img src = \"$featured_img_url\" alt = \"featured image\"/>\n";
                
            }
            
            $content .= "<p><b>". get_the_title() . "</b><br />Read Full Article</p></a>\n";
            $content .= '  </div>';
            $content .= "\n";
        
            
            
        }
        
        $content .= '</div>';
            $content .= "\n";
        
    } else {
        
        $content = "";
        
    }
    
    
    wp_reset_postdata();
    
    return $content;
    
});


$theme_obj->addThemeSupport('post-formats', array("video", "audio", "image", "link", "quote"));
$theme_obj->addThemeSupport('post-thumbnails', array("post-thumbnails", "post"));
$theme_obj->addThemeSupport('title-tag', array());
        
/* add widgets */

$theme_obj->addWidget(array('name' => __( 'Custom Site Header Area', 'gettysburg-adddress' ),
                        'id' => 'custom-header-id',
						'class' => 'header-class',
                        'description'   => __( 'Add widgets here to appear in your custom  header.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="custom-header-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '',
                        'after_title'   => '',));

$theme_obj->addWidget(array('name' => __( 'Right Header Area', 'gettysburg-adddress' ),
                        'id' => 'header-id',
						'class' => 'header-class',
                        'description'   => __( 'Add widgets here to appear in your right section of the header.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="header-widget-title">',
                        'after_title'   => '</h2>',));

$theme_obj->addWidget(array('name' => __( 'Post Left Column', 'gettysburg-adddress' ),
                        'id' => 'post-left-column-id',
						'class' => 'post-left-column-class',
                        'description'   => __( 'Add widgets here to appear in your post on the left.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="post-left-column-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="post-left-column-widget-title">',
                        'after_title'   => '</h2>',));
						
$theme_obj->addWidget(array('name' => __( 'Post Right Column', 'gettysburg-adddress' ),
                        'id' => 'post-right-column-id',
						'class' => 'post-right-column-class',
                        'description'   => __( 'Add widgets here to appear in your post on the right.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="post-right-column-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="post-right-column-widget-title">',
                        'after_title'   => '</h2>',));

$theme_obj->addWidget(array('name' => __( 'Page Left Column', 'gettysburg-adddress' ),
                        'id' => 'page-left-column-id',
						'class' => 'page-left-column-class',
                        'description'   => __( 'Add widgets here to appear in your page on the left column.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="page-left-column-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="page-left-column-widget-title">',
                        'after_title'   => '</h2>',));
						
$theme_obj->addWidget(array('name' => __( 'Page Right Column', 'gettysburg-adddress' ),
                        'id' => 'page-right-column-id',
						'class' => 'page-right-column-class',
                        'description'   => __( 'Add widgets here to appear in your page on the right column.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="page-right-column-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="page-right-column-widget-title">',
                        'after_title'   => '</h2>',));

$theme_obj->addWidget(array('name' => __( 'Sub Footer', 'gettysburg-adddress' ),
                        'id' => 'subfooter-id',
						'class' => 'subfooter-class',
                        'description'   => __( 'Add widgets here to appear in your subfooter.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="subfooter-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="subfooter-widget-title">',
                        'after_title'   => '</h2>',));

$theme_obj->addWidget(array('name' => __( 'Footer', 'gettysburg-adddress' ),
                        'id' => 'footer-id',
						'class' => 'footer-class',
                        'description'   => __( 'Add widgets here to appear in your footer.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="footer-widget-title">',
                        'after_title'   => '</h2>',));

$theme_obj->addWidget(array('name' => __( 'Below Footer', 'gettysburg-adddress' ),
                        'id' => 'below-footer-id',
						'class' => 'below-footer-class',
                        'description'   => __( 'Add widgets here to appear in below your footer.', 'gettysburg-adddress' ),
                        'before_widget' => '<div id="%1$s" class="below-footer-widget %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="below-footer-widget-title">',
                        'after_title'   => '</h2>',));

/*	add site menus */
						
$theme_obj->addMenus(array('topnav' => 'Top Navigation', 'socialmedia' => 'Social Media', 'footernav' => 'Footer Navigation'), "Primary Navigation for website");


class Foundation_TopBar_Menu_Walker extends Walker_Nav_Menu
{   
	/*
	 * Add vertical menu class and submenu data attribute to sub menus
	 */
	 
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\" data-submenu>\n";
	}
}

//Optional fallback
function f6_topbar_menu_fallback($args)
{
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */
	 
	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("<ul class='children'>", '<ul class="vertical menu">', $fallback);
	
	echo '<ul class="vertical medium-horizontal menu" data-responsive-menu="drilldown medium-dropdown">'.$fallback.'</ul>';
}
