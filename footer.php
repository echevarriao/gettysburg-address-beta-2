<?php
/**
 *
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Gettysburg Address
 * @since 0.1
 *
 * 
 */

?>

		</div><!-- end content box section -->
                <footer>
<div id = "page-footer-container" class = "grid-container fluid footer-box">
        <div class = "grid-x grid-padding-x">
                <div class = "cell">
                    <?php if(is_active_sidebar('footer-id')) { ?>
<?php dynamic_sidebar('footer-id'); ?>
<?php } else { ?>
                    
<ul id = "default-footer-menu">
    <li><a href = "https://www.uconn.edu/">&copy; University of Connecticut</a></li>
    <li><a href = "http://uconn.edu/disclaimers-privacy-copyright/">Disclaimers, Privacy &amp; Copyright</a></li>
    <li><a href = "https://accessibility.uconn.edu/">Accessibility</a></li>
    <li><a href = "http://www.uconn.edu/az/">A-Z Index</a></li>
</ul>
<?php } ?>
                </div>
        </div>
</div>

                </footer>
</div><!-- end site wrapper -->
<?php wp_footer(); ?>
<script langauge = "javascript" type = "text/javascript">
	
	$(document).foundation();
	// var elem = new Foundation.ResponsiveToggle("#example-menu");
	
// 	var elem = new Foundation.ResponsiveToggle('#example-menu');
</script>
<script type='text/javascript' src='https://scripts-universityofconn.netdna-ssl.com/cookie-notification.js'>
</script>
<noscript>
	<p>Our websites may use cookies to personalize and enhance your experience. By continuing without changing your cookie settings, you agree to this collection. For more information, please see our <a href="https://privacy.uconn.edu/university-website-notice/" target="_blank">University Websites Privacy Notice</a>.</p>
</noscript>
</body>
</html>
