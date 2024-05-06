<?php

/**
 * By O. Echevarria
 * License: GPL v2
 * orlando.echevarria@uconn.edu
 * Copyright 2021
 *
 */ 

if(!class_exists('ThemeClass')){

class ThemeClass {
	
	private $excerpt_length = 0;
	private $featured_image = "";
	private $site_icon = "";
	
	protected $theme_version = 0.1;
	protected $theme_name = "";
	
	private $m_css_handle;
	private $m_css_src = '';
	private $m_css_ver = false;
	private $m_css_deps = array();
	private $m_css_media = 'all';

	//
	// properties to hold values we pass to
	// our hooks when fired
	//

	private $m_css_info = array();
	private $m_jsc_info = array();
	private $m_admin_css = array();
	private $m_admin_js = array();
	private $m_widgets = array();
	private $theme_support = array();
	private $footer_inline_styles = array();
	private $header_inline_styles = array();
	private $m_menus = array();
	private $m_image_sizes = array();
	private $m_shortcodes = array();
	
	//
	// hooks that we use to implement theme
	// 

	private $css_hook = 'wp_enqueue_scripts';
	private $jsc_hook = 'wp_enqueue_scripts';
	private $widgets_hook = 'widgets_init';
	private $admin_init_hook = 'admin_init';
	private $theme_support_hook = 'after_setup_theme';
	private $menu_hook = 'after_setup_theme';
	private $set_image_size = 'after_setup_theme';
	
	function __construct(){
		
	// register our actions their hooks
		
	add_action($this->admin_init_hook, array($this, 'loadAdminCSS'));
	add_action($this->admin_init_hook, array($this, 'loadAdminJS'));
	add_action($this->css_hook, array($this, 'loadCSS'));
	add_action($this->jsc_hook, array($this, 'loadJS'));
	add_action($this->widgets_hook, array($this, 'loadWidget'));
	add_action($this->menu_hook, array($this, 'loadMenus'));
	add_action($this->theme_support_hook, array($this, 'loadThemeSupport'));
	add_action($this->set_image_size, array($this, 'loadImageSize'));
	
	}

	/**
	 * This methods acts as a wrapper which implements the function get_template_part
	 *
	 * @param String $m_slug This provides for the slug you are wishing to load
	 * @param String $m_name This specifies the specific slug you are wishing to load
	 * @param Array $m_argv This provides any additional parameters for loading the template
	 *
	 * @return void
	 *
	 */ 

	public function getTemplatePart($m_slug = "", $m_name = "", $m_argv = array()){
		
		get_template_part($m_slug, $m_name, $m_argv);

	}
	
	/**
	 * This method adds an OOP way to insert short codes
	 *
	 * @param String $sc_name This is the shortcode name that will be used to call the shortcode functions
	 * @param Function_Callback $func_name_cb This parameter represents the callback function that triggers the shortcode
	 *
	 * @return void
	 *
	 */ 
	
	public function addShortCode($sc_name, $func_name_cb){
		
		add_shortcode($sc_name, $func_name_cb);
		
	}

	/**
	 *
	 * This method sets the name of the theme
	 *
	 * @param String $m_name The name of the theme that is being created
	 * @return void
	 *
	 */ 
	
	
	function setThemeName($m_name = "General Theme"){
		
		$this->theme_name = $m_name;
		
	}
	
	/**
	 *
	 * This method returns the name of the theme
	 *
	 * @return String
	 *
	 */ 
	
	
	function getThemeName(){
		
		return $this->theme_name;
		
	}
	
	/**
	 *
	 * This theme returns the version of the theme
	 *
	 * @return String
	 *
	 */ 
	
	function getVersion(){
		
		return $this->theme_version;
		
	}
	
	/**
	 *
	 * This sets the version of the theme
	 *
	 * @param float $m_version The variable to hold the version of the theme
	 * @return void
	 *
	 */ 
	
	function setVersion($m_version = 0){
		
		$this->theme_version = $m_version;
		
	}
	
	/**
	 *
	 * Displays menu given an array hash table
	 *
	 * @param array $m_nav String
	 *
	 * @return void
	 *
	 */ 
	
	function displayNavMenu($m_nav = array()){
		
		print_r($m_nav);
		
		if(count($m_nav) < 1){
			
			return -1;
		
		} else {

			wp_nav_menu($m_nav);	
			
		}
		
	}
	
	/**
	 * detects if a menu location / navigation exists
	 *
	 * @param String $m_nav String
	 *
	 * @return boolean
	 *
	 */ 
	
	
	function hasNavMenu($m_nav = ''){
			
		return has_nav_menu($m_nav);;
		
	}

	/**
	 *
	 *  this wrapper method displays a menu theme location
	 *
	 *  @param Array $m_inf Contains the information about the menu we want to display along with parameters
	 *
	 *	@return boolean
	 *
	 */  

	
	public function navMenu($m_inf){

		// wp_nav_menu($m_inf);
		
		print "wing chun";
		
	}
	
	
	/**
	 *
	 * returns basic information on object
	 *
	 * @param void none
	 *
	 * @return void
	 * 
	 */ 

	
	function toString(){
		
		return "[ThemeClass Object]";
		
	}
	
	
	/**
	 *
	 * removes feature from header section
	 *
	 * @param string $m_section Section of the page to have item removed
	 * @param string $m_feature Feature to remove
	 *
	 * @return void
	 *
	 */
	
	function removeAction($m_section = '', $m_feature = ''){
		
		remove_action($m_section, $m_feature);

	}
	
	
	/**
	 *
	 * includes a required file that is local to template directory
	 *
	 * @param String $m_file The paramater accepts a string with the local reference
	 *
	 * @return void
	 *
	 */ 
	
	function requireFile($m_file = ""){
		
		if(!file_exists(get_template_directory() . $m_file)){
			
			return;
			
		} else {
			
			require_once(get_template_directory() . $m_file);
			
		}
		
	}
	
	/**
	 * loads up the administrative Style Sheet portion of the site
	 * 
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_media Where to display this style sheet
	 * @param String $m_hook Where to load the style sheet on a particular hook, default is set to 'wp_enqueue_style'
	 * @return void
	 *
	 */

	function enqueueAdminCSS($m_handle, $m_src = '', $m_deps = array(), $m_ver = false, $m_media = 'all', $m_hook = 'wp_enqueue_scripts'){
		
		if(is_admin()){
		
		$this->m_admin_css[] = array('handle' => $m_handle, 'src' => $m_src, 'deps' => $m_deps, 'ver' => $m_ver, 'media' => $m_media, 'hook' => $m_hook);

		}
		
	}

	/**
	 *
	 * callback method that loads up the style sheets for both enqueueAdminCSS behind the scenes
	 *
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_media Where to display this style sheet
	 * @return void
	 *
	 */
	
	public function loadAdminCSS() {

		// loop through each of the CSS array elements
	
		foreach($this->m_admin_css as $css_meta){
			
		wp_enqueue_style($css_meta['handle'], $css_meta['src'], $css_meta['deps'], $css_meta['ver'], $css_meta['media']);
			
		}
		
	}
	
	/**
	 * loads up the public Style Sheet portion of the site into an array
	 * 
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_media Where to display this style sheet
	 * @param String $m_hook Where to load the style sheet on a particular hook, default is set to 'wp_enqueue_style'
	 * @return void
	 *
	 */

	function enqueueCSS($m_handle, $m_src = '', $m_deps = array(), $m_ver = false, $m_media = 'all', $m_hook = 'wp_enqueue_scripts'){
		
		if(! is_admin()){
		
		$this->m_css_info[] = array('handle' => $m_handle, 'src' => $m_src, 'deps' => $m_deps, 'ver' => $m_ver, 'media' => $m_media, 'hook' => $m_hook);

		}
		
	}
	
	/**
	 *
	 * callback method that loads up the style sheet for both enqueueAdminCSS and enqueueCSS behind the scenes
	 *
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_media Where to display this style sheet
	 * @return void
	 *
	 */

	
	public function loadCSS() {

		// loop through each of the CSS array elements
	
		foreach($this->m_css_info as $css_meta){
			
		wp_enqueue_style($css_meta['handle'], $css_meta['src'], $css_meta['deps'], $css_meta['ver'], $css_meta['media']);
			
		}
		
	}

	/**
	 * loads up the JavaScript administrative portion of the site
	 * 
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_footer Whether to display this JavaScript in footer
	 * @return void
	 *
	 */
	
	function enqueueAdminJS($m_handle, $m_src  = '', $m_deps = array(), $m_ver = false, $m_footer = false){

		if(is_admin()){

		$this->m_admin_js[] = array('handle' => $m_handle, 'src' => $m_src, 'deps' => $m_deps, 'ver' => $m_ver, 'infooter' => $m_footer);
			
		}
		
	}
	
	/**
	 *
	 * callback method that loads up the administrative JavaScript behind the scenes
	 *
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_footer Whether to display this JavaScript in footer
	 * @return void
	 *
	 */

	public function loadAdminJS(){
		
		foreach($this->m_admin_js as $js){

		wp_enqueue_script($js['handle'], $js['src'], $js['deps'], $js['ver'], $js['infooter']);
			
		}
		
	}

	/**
	 * loads up the JavaScript public portion of the site
	 * 
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_media Where to display this style sheet
	 * @param String $m_hook Where to load the style sheet on a particular hook, default is set to 'wp_enqueue_script'
	 * @return void
	 *
	 */

	function enqueueJS($m_handle = 'stylesheet', $m_src  = '', $m_deps = array(), $m_ver = false, $m_footer = false){
		
		if(! is_admin()){

		$this->m_jsc_info[] = array('handle' => $m_handle, 'src' => $m_src, 'deps' => $m_deps, 'ver' => $m_ver, 'infooter' => $m_footer);
			
		}
		
	}
	
	/**
	 *
	 * private method that loads up the JavaScript for both enqueueAdminCSS and enqueueCSS behind the scenes
	 *
	 * @param String $m_handle The unique ID that refers to the style sheet to load
	 * @param String $m_src The URL source of the style sheet to load
	 * @param Array $m_deps The array dependencies for this style sheet
	 * @param Integer|Boolean $m_ver Set to boolean or number for version
	 * @param String $m_media Where to display this style sheet
	 * @return void
	 *
	 */

	public function loadJS(){
		
		foreach($this->m_jsc_info as $js){

		wp_enqueue_script($js['handle'], $js['src'], $js['deps'], $js['ver'], $js['infooter']);
			
		}
		
	}

	/**
	 *
	 * A method that adds a widget to the Theme
	 *
	 * @param Array $m_widget Widget information passed as an array(), array(
                        'name'          => __( 'Footer', 'twentynineteen' ),
                        'id'            => 'sidebar-1',
                        'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
                        'before_widget' => '<section id="%1$s" class="widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<h2 class="widget-title">',
                        'after_title'   => '</h2>',
                )
	 * @param String $m_hook Default is set to "widgets_init"
	 * @return void
	 * 
	 */ 
	
	
	public function addWidget($m_widget = array()){
		
		$this->m_widgets[] = $m_widget;
		
	}
	
	/**
	 *
	 * This private method is called when widgets_init is fired or when the widget is placed in a particular hook
	 * 
	 * @param Array $m_widget This parameter is passed as an array
	 *
	 */
	
	public function loadWidget(){
		
		foreach($this->m_widgets as $widget_obj){
			
		register_sidebar($widget_obj);
		
		}
		
	}
	
	/**
	 * The method addMenus is used to add menu locations for the theme
	 *
	 * @param Array $loc The paramater accepts a hash array of array('secondmenu' => 'Menu Name 2', 'firstmenu' => 'Menu Name 1')
	 * @param String $desc This is the description of the menus you are loading
	 * @param String $m_hook This is the hook in which you are loading the menus, default is 'after_setup_theme'
	 * @return void
	 * 
	 */
	
	function addMenus($loc = array(), $desc = ""){

	$this->m_menus[] = $loc;
		
	}

	/**
	 * callback method loadMenus is used as a wrapper method to implement register_nav_menus()
	 *
	 * @param Array $loc The paramater accepts a hash array of array('secondmenu' => 'Menu Name 2', 'firstmenu' => 'Menu Name 1')
	 * @param String $desc This is the description of the menus you are loading
	 * @return void
	 * 
	 */

	function loadMenus(){

	foreach($this->m_menus as $m_menus){

		register_nav_menus($m_menus);
		
	}
	
		
	}
	
	/**
	 *
	 * This method adds support for a theme's particular feature
	 *
	 * @param String $obID This is the object identifier of the feature(s) being added
	 * @param Array $m_args This is the array or feature you are adding to the theme
	 * @param String $m_hook This is the hook in which you want the features to be loaded, default is set to 'after_setup_theme'
	 * @return void
	 *
	 */
	
	public function addThemeSupport($objID = "", $m_args = array()){
		
	$this->theme_support[$objID] = $m_args;
		
	}
	
	/**
	 *
	 * This callback method is what adds support for a theme's particular feature
	 *
	 * @param String $obID This is the object identifier of the feature(s) being added
	 * @param Array $m_args This is the array or feature you are adding to the theme
	 * @return void
	 *
	 */
	
	function loadThemeSupport(){
		
		foreach($this->theme_support as $key => $value){
			
		add_theme_support($key, $value);
			
		}
		
	}
	
	/**
	 *
	 * Gets the theme support arguments passed when registering that support.
	 *
	 * @param String $m_feature The feature you wish to extract
	 * @param Mixed extract arguements to be check against certain features to extract
	 * @return Mixed
	 *
	 */ 

	
	function getThemeSupport($m_feature = "", $m_args = null){
		
		if(!$m_feature || !isset($m_feature) || isempty($m_feature)){
			
			return null;
			
		} else {
			
			return get_theme_support($m_feature, $m_args);
			
		}
		
	}
	
	/**
	 *
	 * This method retrieves a theme modification value for the current theme being implemented
	 * 
	 * @param String $m_mod The mod name
	 * @param String|Boolean $m_def The default value of the mod
	 *
	 * @return Mixed value
	 *
	 */
	
	function getThemeMod($m_mod = "", $m_def = false){
		
		return get_theme_mod($m_mod, $m_def);
				
	}
	
	/**
	 *
	 * This method is the wrapper method of load_theme_textdomain function
	 *
	 * @param String $m_td The identifier of the text domain you are loading, default is set to 'text_domain'
	 * @param Boolean|String $m_lang_path This parameter is either a string or boolean, if string, then you are setting the language path
	 * @param String $m_hook This is the hook in which you want to load the theme text domain, the default is 'after_setup_theme'
	 * @return void
	 *  
	 */ 
	

	public function loadTextDomain($m_td = 'text_domain', $m_lang_path = false, $m_hook = 'after_setup_theme'){
		
	add_action($m_hook, array($this, $this->setThemeTextDomain($m_td, $m_lang_path)));

	}
	
	/**
	 *
	 * This method is the wrapper method of loadTextDomain method which calls directoryy load_theme_textdomain
	 *
	 * @param String $m_td The identifier of the text domain you are loading, default is set to 'text_domain'
	 * @param Boolean|String $m_lang_path This parameter is either a string or boolean, if string, then you are setting the language path
	 * @return void
	 *  
	 */ 

	private function setTextDomain($m_id, $m_lang_path){
		
		load_theme_textdomain($m_td, $m_lang_path);
		
	}
	
	/**
	 *
	 * This registers a new image size but the object oriented way
	 *
	 * @param String $img_id Image ID for the image being set
	 * @param Integer $img_width The width of the image you are registering
	 * @param Intger $img_height The height of the image you are registering
	 * @paran Boolean|array Set the image to be cropped or set the parameter to crop image
	 * @param String $m_hook The hook in which to add your new image size, default is set to after_setup_theme
	 *
	 * @return void
	 *
	 */ 
	
	public function addImageSize($img_id = "an-image", $img_width = 250, $img_height = "250", $m_crop = true){

	$this->m_image_sizes[] = array('id' => $img_id, 'width' => $img_width, 'height' => $img_height, 'crop' => $m_crop);

	}
	
	/**
	 * This method is the wrapper callback is what triggers add_image_size function
	 *
	 * @param String $img_id Image ID for the image being set
	 * @param Integer $img_width The width of the image you are registering
	 * @param Intger $img_height The height of the image you are registering
	 * @paran Boolean|array Set the image to be cropped or set the parameter to crop image
	 *
	 * @return void
	 * 
	 */ 

	
	function loadImageSize(){
		
		// load image sizes
		
		foreach($this->m_image_sizes as $img_obj){
			
		add_image_size($img_['id'], $img_['width'], $img_['height'], $img_['crop']);

		}
		
	}
	
	/**
	 *
	 * This method sets the post thumbnail size
	 *
	 * @param Integer $m_width Sets the width of the thumbnail size
	 * @param Integer $m_height Sets the height of the thumbnail sizze
	 * @param Boolean $m_bool Sets the size to be boolean for cropping
	 * @param String $m_hook Sets the hook in which to trigger the sizing of the thumbnail
	 *
	 * @return void
	 *
	 */ 
	
	
	public function setPostThumbnailSize($m_width, $m_height, $m_bool, $m_hook = 'after_setup_theme'){
		
		add_action($m_hook, array($this, $this->loadPostThumbnailSize($m_width, $m_height, $m_bool)));
		
	}
	
	/**
	 *
	 * This private method sets the post thumbnail size; it is fired when the add_action() is called
	 *
	 * @param Integer $m_width Sets the width of the thumbnail size
	 * @param Integer $m_height Sets the height of the thumbnail sizze
	 * @param Boolean $m_bool Sets the size to be boolean for cropping
	 *
	 * @return void
	 *
	 */ 

	private function loadPostThumbnailSize($m_width = 200, $m_height = 200, $m_bool = true){
		
		set_post_thumbnail_size($m_width, $m_height, $m_bool);
		
	}

	/**
	 *
	 * This method displays the header template content
	 *
	 * @param String $tmpl_name The template header name to display
	 * @param Array $m_argv The settings array for the template to be displayed
	 *
	 * @return void
	 *
	 */ 


	public function getHeader($tmpl_name = "", $m_argv = array()){
		
		get_header($tmpl_name, $m_argv);		
		
	}

	/**
	 *
	 * This method displays the footer template content
	 *
	 * @param String $tmpl_name The template footer name to display
	 * @param Array $m_argv The settings array for the template to be displayed
	 *
	 * @return void
	 *
	 */

	public function getFooter($tmpl_name = "", $m_argv = array()){
		
		get_footer($tmpl_name, $m_argv);
				
	}
	
        public function getSearchForm($label = 'Search For'){

            $h_url = home_url();
            
        $searchform = "<form role=\"search\" method=\"get\" id=\"searchform\" class=\"searchform\" action=\"$h_url\">
		<div>
                    <label class=\"screen-reader-text\" for=\"s\">$label
			<input type=\"text\" value=\"\" name=\"s\" id=\"s\" /> 
			<input type=\"submit\" id=\"searchsubmit\" value=\"Search\" /></label>
		</div>
</form>";            
        
        return $searchform;
        
        }
        
	

} // end of class

}