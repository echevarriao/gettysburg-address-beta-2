<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Gettysburg_Address
 * @since 0.1
 * 
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
	<title>Biomedical Engineering <?php wp_title('&raquo;', true, ''); ?></title>
        <?php wp_head(); ?>
	
<!-- Google Analytics snippet added by Site Kit -->
<script type="text/javascript" src="https://www.googletagmanager.com/gtag/js?id=UA-15349581-27" id="google_gtagjs-js" async></script>
<script type="text/javascript" id="google_gtagjs-js-after">
/* <![CDATA[ */
window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}
gtag('set', 'linker', {"domains":["www.bme.uconn.edu"]} );
gtag("js", new Date());
gtag("set", "developer_id.dZTNiMT", true);
gtag("config", "UA-15349581-27", {"anonymize_ip":true});
gtag("config", "G-PDHWH32RXC");
/* ]]> */
</script>	
</head>
<?php if(is_front_page()){  ?>
	<body <?php body_class('primary-page'); ?>>
<?php } else { ?>
	<body <?php body_class('second-page'); ?>>
<?php } ?>
<div class = "wrapper" id = "site-wrapper"><!-- start site wrapper -->
    <div id="uconn-banner" class="alternative no-js">
        
        <div id="uconn-header-container" class = "row">
        
            <div class="row-container">
                <div class="row-fluid row">
                    <div id="home-link-container">
                        <a id="home-link" href="https://www.uconn.edu">
                            <span id="wordmark" aria-hidden="true">UConn</span>
                            
                            <span class="no-css">University of Connecticut school of </span>
                            
                            <span id="university-of-connecticut">
                                University of Connecticut
                            </span>
                            
                            <span id="site-abbreviation"><?php bloginfo("name"); ?></span>
                            
                        </a>
                    </div>
                    
                    <div id="button-container">
                        <div class="icon-container" id="icon-container-search">

                            <button onClick = "location.href = 'https://www.uconn.edu/search/';" class="btn btn-popup-control" id="uconn-search" href="https://uconn.edu/search" aria-haspopup="true"
                                aria-controls="search-popup" aria-expanded="false">
                                <span class="no-css">Search University of Connecticut</span>
                                
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" aria-hidden="true"
                                    class="banner-icon">
                                    <title>Search UConn</title>
                                    <path 
                                        d="M28.072 24.749l-6.046-6.046c0.912-1.499 1.437-3.256 1.437-5.139 0-5.466-4.738-10.203-10.205-10.203-5.466 0-9.898 4.432-9.898 9.898 0 5.467 4.736 10.205 10.203 10.205 1.818 0 3.52-0.493 4.984-1.349l6.078 6.080c0.597 0.595 1.56 0.595 2.154 0l1.509-1.507c0.594-0.595 0.378-1.344-0.216-1.938zM6.406 13.258c0-3.784 3.067-6.853 6.851-6.853 3.786 0 7.158 3.373 7.158 7.158s-3.067 6.853-6.853 6.853-7.157-3.373-7.157-7.158z">
                                    </path>
                                </svg>
                            </button>
                            
                                <div id="search-popup" class="popup-container">
                                    <div class="form-wrapper">
                                        <form action="https://communications.uconn.edu" method="GET" role="search">
                                        <input type="search" name="s" id="site-search" placeholder="Search this site..."
                                            aria-label="Search this site" /><button type="submit"><span class="no-css">Search
                                                School of Engineering</span><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" aria-hidden="true"
                                                    class="banner-icon">
                                                    <title>Search UConn</title>
                                                    <path
                                                        d="M28.072 24.749l-6.046-6.046c0.912-1.499 1.437-3.256 1.437-5.139 0-5.466-4.738-10.203-10.205-10.203-5.466 0-9.898 4.432-9.898 9.898 0 5.467 4.736 10.205 10.203 10.205 1.818 0 3.52-0.493 4.984-1.349l6.078 6.080c0.597 0.595 1.56 0.595 2.154 0l1.509-1.507c0.594-0.595 0.378-1.344-0.216-1.938zM6.406 13.258c0-3.784 3.067-6.853 6.851-6.853 3.786 0 7.158 3.373 7.158 7.158s-3.067 6.853-6.853 6.853-7.157-3.373-7.157-7.158z">
                                                    </path>
                                                </svg></button>
                                        </form>
                                    </div>
                                    <hr />
                                    <div class="link-wrapper search-link-wrapper">
                                        <a href="https://uconn.edu/search"><span class="banner-search-text">Search UConn</span></a>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="icon-container" id="icon-container-az">
                            
                            <a class="btn" id="uconn-az" href="https://uconn.edu/az">
                                <span class="no-css">A to Z Index</span>
                                
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" aria-hidden="true"
                                    class="banner-icon">
                                    <title>UConn A to Z Search</title>
                                    <path
                                        d="M5.345 8.989h3.304l4.944 13.974h-3.167l-0.923-2.873h-5.147l-0.946 2.873h-3.055l4.989-13.974zM5.152 17.682h3.579l-1.764-5.499-1.815 5.499zM13.966 14.696h5.288v2.56h-5.288v-2.56zM20.848 20.496l7.147-9.032h-6.967v-2.474h10.597v2.341l-7.244 9.165h7.262v2.466h-10.798v-2.466h0.004z">
                                    </path>
                                </svg>
                            </a>
                            
                        </div>
                        
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
	<div class = "header-bar grid-container fluid" id = "site-header-container">
		<div class = "grid-x grid-padding-x" id = "site-title-container">
<?php if(is_active_sidebar('custom-header-id')) { ?>
                    <div class = "cell large-12">

<?php dynamic_sidebar('custom-header-id'); ?>                 
                    </div>

<?php } else { ?>
                    <div class = "cell large-6">
				<h2 id = "site-name">
                                    <a href = "https://engineering.uconn.edu/" id = "level-two-title">College of Engineering</a>
				<a href = "<?php bloginfo("url"); ?>" id = "level-one-title"><?php bloginfo("name"); ?></a>
				</h2>
			</div>
			<div class = "cell large-6">
<?php if(is_active_sidebar('header-id')) { ?>
<?php dynamic_sidebar("header-id"); ?>                            
<?php } ?>
			</div>
                    
<?php } ?>
		</div>
		
	</div><!-- site header -->
    <div id = "navigation-container">
        <div id = "main-nav">
    <nav role = "navigation">
        <div class="title-bar" data-responsive-toggle="mainNavigation" data-hide-for="medium">
          <div class="title-bar-left">
            <button class="menu-icon" type="button" data-toggle="mainNavigation">Go</button>
            <div class="title-bar-title"><?php bloginfo("name"); ?> Menu</div>
          </div>
        </div>
        <div class="top-bar" id="mainNavigation">
          <div class="top-bar-left"><!-- here -->
<?php		wp_nav_menu(array(
	    	'container' => false,
	    	'menu' => __( 'Top Bar Menu', 'gettysburg-adddress' ),
	    	'menu_class' => 'vertical medium-horizontal menu',
	    	'theme_location' => 'topnav',
	    	'items_wrap'      => '<ul id="%1$s" class="%2$s" data-responsive-menu="drilldown medium-dropdown">%3$s</ul>',
	    	//Recommend setting this to false, but if you need a fallback...
	    	'fallback_cb' => 'f6_topbar_menu_fallback',
	        'walker' => new Foundation_TopBar_Menu_Walker(),
		));
?>
            </div>
        </div>
    </nav>
        </div>
    </div>
</div>
