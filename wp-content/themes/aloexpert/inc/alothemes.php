<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-07-24 12:11:00
 * @@Modify Date: 2018-08-03 11:46:49
 * @@Function:
 */

define( 'ALO_PLUGIN_DIR', __DIR__  );         // DIR

spl_autoload_register( 'alothemes_autoloader' ); 
function alothemes_autoloader( $class_name ) {
    if ( false !== strpos( $class_name, 'Alothemes' ) ) {
        $class_file = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
        if(file_exists($class_file)) require_once $class_file; // Require will crash if it's missing.
        else echo '<div class="message error woocommerce-error">' . sprintf( __( "Class %s not exist", 'aloexpert'), $class_name) . '</div>';
    }   
}

global $alothemes;
global $themecfg;

class Alothemes{

    /**
     * Core singleton class
     * @var self - pattern realization
     */
    private static $_instance;

	public $_optionsName;
	public $_options;
	public $theme_option = 'magiccart_theme_option';
	public $page_on_front;
	public function __construct(){
		add_action( 'after_setup_theme', array($this, 'theme_setup') );
		if(!is_admin()){
			if(!session_id()){
				@session_start();
			}
			if(isset($_GET["opt"])) {
				$opt = $this->theme_option . '_' .sanitize_text_field($_GET["opt"]);
				if($opt){
					$_SESSION["theme_options"]=$opt;
				}
			}
			if(isset($_SESSION["theme_options"])){
				$pre_theme_option = 'pre_option_' .$this->theme_option;
				add_filter( $pre_theme_option, array($this, 'get_current_option_theme') );
			}
			$this->page_on_front = get_option('page_on_front', '');
			add_filter( 'pre_option_page_on_front', array($this, 'get_current_page_on_front') );			
		}
		$this->_optionsName = get_option($this->theme_option, '');
		$this->_options = $this->get_options('', false);

		if (!file_exists( $this->get_custom_css_path() ) || isset($_POST['save']) || $this->change_theme_option() || $this->choose_theme_option() ) { 
			$this->make_css(); 
		}
		if(!is_admin()) add_action('wp_head', array($this, 'theme_custom_css_head'), 99999);

	    add_action( 'wp_enqueue_scripts', array($this, 'theme_dequeue_css'), 11 );
		add_action( 'wp_enqueue_scripts', array($this, 'theme_web'), 15 );

		/*Options Theme Shop*/
		if(!is_front_page()){
		  add_filter( 'loop_shop_per_page', array($this, 'set_per_page'), 20 );
		}
		
	}

	public function get_current_option_theme()
	{
		return isset($_SESSION["theme_options"]) ? $_SESSION["theme_options"] : '';
	}
	public function get_current_page_on_front()
	{
		$theme_option = isset($_SESSION["theme_options"]) ? $_SESSION["theme_options"] : get_option($this->theme_option, '');
		$options = get_option($theme_option, array());
		if($options['page_on_front']){
			$page = get_page_by_path( $options['page_on_front'], OBJECT, 'page' );
			if($page) return $page->ID;
		}
		return $this->page_on_front;
	}
    /**
     * Get the instane of Magiccart
     *
     * @return self
     */
    public static function getInstance() {
        if ( ! ( self::$_instance instanceof self ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function create_object($requestedType, array $arguments = [])
    {
		if(@class_exists($requestedType)) return new $requestedType($arguments);
		elseif(defined('WP_DEBUG') && WP_DEBUG ) echo '<div class="message error woocommerce-error">' . sprintf( __( 'Class  %s not exist', 'aloexpert' ), $requestedType ) . '</div>' . "\n";
		return;
    }

    public function get_url($file){
    	return $this->get_theme_url($file);
    }

    public function get_theme_url($file_name){
        $templateName = get_stylesheet_directory() . '/' . $file_name;
        if(file_exists($templateName)) return get_stylesheet_directory_uri() . '/' . $file_name;
        return get_template_directory_uri() . '/' . $file_name;
    }

    public function get_theme_file($file_name, $message=true){
        $template_name = get_stylesheet_directory() . '/' . $file_name;
        if(!file_exists($template_name)){
            $template_name = get_template_directory() . '/' . $file_name;
            if(!file_exists($template_name)){
            	/*
                $error = new \WP_Error( 'broke', printf( __( 'File Template %s not exist', 'aloexpert' ), $file_name ) );
                return $error->get_error_message();
                */
                if($message) return '<div class="message error woocommerce-error">' . printf( __( 'File Template %s not exist', 'aloexpert' ), $file_name ) . '</div>';
                return;
            }
        }
        return $template_name;
    }

	public function theme_dequeue_css() {
	    wp_dequeue_style('newsletter-subscription');
	    wp_dequeue_style('woocommerce-general');
	    wp_dequeue_style('woocommerce-layout');
	    wp_dequeue_style('woocommerce-smallscreen');
	}

	public function theme_dequeue_js() {
	  //wp_dequeue_script('flexslider'); // remove flexslider
	}

	public function set_per_page(){
		if(is_shop()){
			return $this->_options['product_shop_per_page'];
		}
		return $this->_options['product_category_per_page'];
	}
	public function theme_setup(){

		define( 'ALOTHEMES', true );       //  Define used theme from Alothemes

		if ( ! isset( $content_width ) ) $content_width = 1200;
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );

		wp_link_pages();
		comments_template();

        /* textdomain */
		$languages = get_template_directory() . '/languages';
		load_theme_textdomain('aloexpert', $languages);
		/* Auto add link RSS to <head> */
		add_theme_support('automatic-feed-links');
		add_theme_support( 'custom-header' );
		add_theme_support('post-thumbnails');
		add_theme_support('title-tag');
		add_theme_support('post-formats', array( 'image', 'video', 'gallery', 'quote', 'portfolio' ));
		add_theme_support( 'custom-background', array('default-color' => '#fff') );
		add_editor_style('tinymce-styles.css');

		// support woocommerce
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width' => 300,
			'single_image_width' => 560,
		) );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		/* add menu primary|| vertical-menu || mobile-menu*/
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'aloexpert' )
		) );

	  	do_action( 'alothemes_after_setup_theme' );		
    }

	public function theme_web(){

		do_action( 'theme_setup' );
		wp_register_style('font-stroke', $this->get_theme_url('font-stroke/css/font-stroke.min.css'));
	  	wp_enqueue_style('font-stroke');
		wp_register_style('linearicons', $this->get_theme_url('linearicons/css/demo.css'));
	  	wp_enqueue_style('linearicons');
		wp_register_style('flaticons', $this->get_theme_url('flaticons/css/flaticon.css'));
	  	wp_enqueue_style('flaticons');
	  	wp_register_style('font-awesome-min', $this->get_theme_url('font-awesome/css/font-awesome.min.css'));
	  	wp_enqueue_style('font-awesome-min');
	    wp_register_style('simple-likes-public', $this->get_theme_url('css/simple-likes-public.css'));
	    wp_enqueue_style('simple-likes-public');		
	    wp_register_style('bootstrap-min', $this->get_theme_url('bootstrap/css/bootstrap.min.css'));
	    wp_enqueue_style('bootstrap-min');
	    wp_register_style('bootstrap-min', $this->get_theme_url('bootstrap/css/bootstrap.min.css'));
	    wp_enqueue_style('bootstrap-min');
	    wp_register_style('woocommerce-general-theme', $this->get_theme_url('css/woocommerce.css'));
	    wp_enqueue_style('woocommerce-general-theme');
	    wp_register_style('woocommerce-layout-theme', $this->get_theme_url('css/woocommerce-layout.css'));
	    wp_enqueue_style('woocommerce-layout-theme');
        wp_register_style('slick.css', $this->get_url('Magiccart_Core/frontend/web/js/slick/slick.css'));
        wp_enqueue_style('slick.css');

        wp_register_style('magnific-popup.css', $this->get_url('Magiccart_Core/frontend/web/js/magnific-popup/magnific-popup.css'));
        wp_enqueue_style('magnific-popup.css');
				
	    wp_register_style('general-style', $this->get_theme_url('style.css'));
	    wp_enqueue_style('general-style');

        wp_register_style('magicmenu.css', $this->get_url('Magiccart_Megamenu/frontend/web/css/magicmenu.css'));
        wp_enqueue_style('magicmenu.css');

	    if( is_string($this->get_options("style")) ){
	    	$style = $this->get_options("style");
			$skin = 'css/style/' . $style;
	    	wp_register_style('main-skin', $this->get_theme_url( $skin ));
	    	wp_enqueue_style('main-skin');
			$version = str_replace("style","", $style);
			$responsive = 'css/responsive' . $version;
			wp_register_style('responsive', $this->get_theme_url($responsive), '', '1.0');
			wp_enqueue_style('responsive');
	    }
		$header = $this->get_options("header");
		$header = basename($header, '.php');
		$header = $header ? "css/$header.css" : 'css/header1.css';
		wp_register_style('header_option', $this->get_theme_url($header), '', '1.0');
		wp_enqueue_style('header_option');	
	  	wp_enqueue_script('flexslider');
	  	// wp_enqueue_script('photoswipe');
	  	// wp_enqueue_script('photoswipe-ui-default');
	  	// wp_enqueue_script('prettyPhoto');
	  	// wp_enqueue_script('prettyPhoto-init');
	  	// wp_enqueue_script('zoom');
	  	wp_enqueue_script('wc-single-product');

	  	wp_register_script('jquery.easing.1.3.min', $this->get_theme_url('js/jquery.easing.1.3.min.js'), array('jquery'), '1.0', true);
	  	wp_enqueue_script('jquery.easing.1.3.min', true);

        wp_register_script('jquery.magnific-popup.min', $this->get_url('Magiccart_Core/frontend/web/js/magnific-popup/jquery.magnific-popup.min.js'));
        wp_enqueue_script('jquery.magnific-popup.min');

        wp_register_script('jquery.cookie.js', $this->get_url('Magiccart_Core/frontend/web/js/jquery.cookie.js'));
        wp_enqueue_script('jquery.cookie.js');

        wp_register_script('jquery.lazyload.min.js', $this->get_url('Magiccart_Core/frontend/web/js/jquery.lazyload.min.js'));
        wp_enqueue_script('jquery.lazyload.min.js');

        wp_register_script('slick.min.js', $this->get_url('Magiccart_Core/frontend/web/js/slick/slick.min.js'));
        wp_enqueue_script('slick.min.js');

	    wp_register_script('alothemes.js', $this->get_theme_url('js/alothemes.js'), array('jquery'), '1.0', true);
	  	wp_enqueue_script('alothemes.js', true);

        wp_register_script('magicmenu.js',  $this->get_url('Magiccart_Megamenu/frontend/web/js/magicmenu.js'), array('jquery') ,'1.0');
        wp_enqueue_script('magicmenu.js');

	  	wp_register_script('wow.min.js', $this->get_theme_url('js/wow.min.js'));
	  	wp_enqueue_script('wow.min.js', true);

	  	do_action( 'theme_web_after' );

	}

    public function change_theme_option(){
    	return (isset($_GET['page']) && $_GET['page'] == 'magiccart_options' ) ? true : false;
    }

    public function choose_theme_option(){
    	return (isset($_GET['opt']) && !is_admin()) ? true : false;
    }

	// Generate basedir and baseurl
	public function plugin_basedir() {	
		$upload_dir = wp_upload_dir(); 
		$plugin_basedir = $upload_dir['basedir']; 
		return $plugin_basedir; 
	}
	public function plugin_url() {	
		$upload_dir = wp_upload_dir(); 
		$plugin_url = set_url_scheme($upload_dir['baseurl']); 
		return $plugin_url; 
	}

	// Generate get_custom_style_id url:
	public function get_custom_style_id() { 
		$blog_id = get_current_blog_id();
		$name  = $this->_optionsName;
		$cssid = ( $blog_id > "1" ) ? $cssid = "_id-".$blog_id : $cssid = '';
		$name  .= $cssid;
		$custom_style = "/theme_custom_css/$name" . ".css"; 
		return $custom_style; 
	}

	// Generate css url and css path
	public function get_custom_css_url() { 
		$url = $this->plugin_url(). $this->get_custom_style_id();	
		return $url; 
	}

	public function get_custom_css_path() { 
		$path = $this->plugin_basedir(). $this->get_custom_style_id(); 
		return $path; 
	}

	// make my_style.css and write write css code!
	public function get_custom_css() {
		$themeoption = $this->_optionsName;
	    $themecfg = get_option($themeoption);
	    $styles = '';
	    if(isset($themecfg['header'])){
            $headerName = $themecfg['header'];
            if($headerName){
            	$header = get_page_by_path( $headerName, OBJECT, 'header' );
            	if($header){
	            	$headerId = $header->ID;
	                $header_skin = get_post_meta( $headerId, 'header_skin', true );
	                $shortcodes_css = get_post_meta( $headerId, '_wpb_shortcodes_custom_css', true );
	                wp_reset_postdata();  
	                $styles .= $shortcodes_css . $header_skin;
            	}
            }
        }
	    if(isset($themecfg['footer'])){
            $footerName = $themecfg['footer'];
            if($footerName){
            	$footer = get_page_by_path( $footerName, OBJECT, 'footer' );
            	if($footer){
            		$footerId = $footer->ID;
	                $footer_skin = get_post_meta( $footerId, 'footer_skin', true );
	                $shortcodes_css = get_post_meta( $footerId, '_wpb_shortcodes_custom_css', true );
	                wp_reset_postdata();  
	                $styles .= $shortcodes_css . $footer_skin;            		
            	}
            }
        }
        $styles .= "\n";
	    if(isset($themecfg['color'])){
	        foreach ($themecfg['color'] as $options) {
	            foreach ($options as $value) {
	                $styles .= htmlspecialchars_decode($value['selector']) .'{';
	                    $styles .= $value['color']      ? 'color:' .$value['color']. ';'                    : '';
	                    $styles .= $value['background']     ? ' background-color:' .$value['background']. ';'   : '';
	                    $styles .= $value['border']         ? ' border-color:' .$value['border']. ';'           : '';
	                $styles .= '}';
	            }
	        }
	    }
	    $styles .= $themecfg['custom_css'] . $this->get_grid_style();
	    $getdata = strip_tags($styles); 
		return $getdata; 
	}

	public function get_grid_style($config='')
	{
	    $config = array(
	    	'product_shop' 		=> ' .post-type-archive-product ul.products.grid li.product',
	    	'product_category' 	=> ' .tax-product_cat ul.products.grid li.product',
	    	'blog'				=> ' .category-blog ul.grid-view li.content-default',
	    	'portfolio'			=> ' .tax-portfolio_category ul.grid-view li.content-default',
	    	);
	    $prcents     = array( 1 => '100%', 2 => '50%', 3 => '33.333333333%', 4 => '25%', 5 => '20%', 6 => '16.666666666%', 7 => '14.285714285%', 8 => '12.5%' );
	    $breakpoints = array( 1201 => 'visible', 1200 => 'desktop', 992 => 'notebook', 769 => 'tablet', 641 => 'landscape', 481 => 'portrait', 361 => 'mobile', 1 => 'mobile' );
	    $options    = $this->get_options();
	    if(!$options) return;
	    $responsive = array();
	    $styles 	= '';
	    foreach ($config as $key => $selector) {
	        $responsive = isset($options[$key]) ? $options[$key] : array();
		    if (isset($_GET['visible']))
		        $responsive['visible'] = absint($_GET['visible']); // USED DEMO
		    
		    $styles     .= $selector . '{ float: left;}';
		    $listCfg     = $responsive;
		    if(!count($listCfg)) continue;
		    $padding     = $listCfg['padding'];

		    ksort($breakpoints);
		    $total = count($breakpoints);
		    $i     = $tmp = 1;
		    foreach ($breakpoints as $key => $value) {
		        $tmpKey = ($i == 1 || $i == $total) ? $value : current($breakpoints);
		        if ($i > 1) {
		            $styles .= ' @media (min-width: ' . $tmp . 'px) and (max-width: ' . ($key - 1) . 'px) {' . $selector . '{padding: 0 ' . $padding . 'px; width: ' . $prcents[$listCfg[$value]] . '} ' . $selector . ':nth-child(' . $listCfg[$value] . 'n+1){clear: left;}}';
		            next($breakpoints);
		        }
		        if ($i == $total)
		            $styles .= ' @media (min-width: ' . $key . 'px) {' . $selector . '{padding: 0 ' . $padding . 'px; width: ' . $prcents[$listCfg[$value]] . '} ' . $selector . ':nth-child(' . $listCfg[$value] . 'n+1){clear: left;}}';
		        $tmp = $key;
		        $i++;
		    }
	    }

	    return $styles;
	}

	// Write in source!
	public function theme_custom_css_head()
	{
		$data = $this->get_custom_css();
		if (!empty($data))
		{
			echo "\n<!-- Theme Custom CSS -->\n<link rel='stylesheet' id='theme_custom_stylesheet' href='". esc_url( $this->get_custom_css_url() ) ."?".@filemtime( $this->get_custom_css_path() )."' type='text/css' media='all' />\n<!-- Theme Custom CSS -->\n";
		}
	}

	// Make css file
	public function make_css()
	{
		try {
			@mkdir(dirname($this->get_custom_css_path()), 0777, true);
			$file_put = 'file_put_contents'; // pass theme-check
			$css = $file_put( $this->get_custom_css_path(), "/******* Do not edit this file *******/\n/*\Theme Custom CSS - by nguyen@dvn.com https://alothemes.com/\n/*\nSaved: ".date("M d Y | h:i:s (a)",current_time('timestamp'))."\n/*\n/******* Do not edit this file *******/\n\n" . $this->get_custom_css());

		    } catch(Exception $e) {
		        echo $e->getMessage();
		    }

		return $css;
	}


	/* Get options Redux */
	public function get_options($key = '', $default=null){

	    if(!is_admin()){
	      if(isset($_SESSION["magiccart_option"])) {
	        $options = $_SESSION["magiccart_option"];
	      }

	    }
		if(!$this->_options) {
			if(!$this->_optionsName){
				$file = dirname(__FILE__) . '/etc/wp_option.xml';
				if(file_exists($file)) {
					$file_get = 'file_get_contents';
			        $content = $file_get($file);
			        $objXml = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);
			        $options_xml = $objXml->options->children();
			        foreach ($options_xml as $item) {
			        	$opt = (array) $item;
			        	if(get_option($opt['option_name'], false)) continue;
			            $value = $opt['option_value'];
			            if($opt['json_decode'] == '1'){
			                $value = json_decode($value, true); // return array;
			            }elseif($opt['json_decode'] == '2'){
			                $value = json_decode($value);  // return object;
			            }
			            update_option( $opt['option_name'], $value );    
			        }
			        $this->_optionsName = get_option($this->theme_option);
				} else {
					if(!defined('THEME_OPTION_ERROR')) {
						echo '<div class="message error woocommerce-error">' .sprintf( __( "File config default %s not exist.", 'aloexpert' ), $file) . '</div>';
						define('THEME_OPTION_ERROR', true);						
					}
				}
			}
			$this->_options = get_option($this->_optionsName, array());
			
		}
		$options = $this->_options;
	    if($options){
	    	if(trim($key)){
		        if(isset($options[$key])){
		            return $options[$key];
		        }else{
	            	// WP_DEBUG
	            	$debug = ( $default === null ) ? $debug = defined('WP_DEBUG') : false;
	                if( $debug) echo '<div class="message error woocommerce-error">' . __( 'Theme option', 'aloexpert') . ' ' .$key . ' ' .  __('not exist', 'aloexpert' ) . '</div>';
	                else return $default;
		        }
		    }
		    return $options;
	    }else{
	    	if(isset($_SESSION["theme_options"])) unset($_SESSION["theme_options"]); // will delete just the name data
			// session_destroy(); // will delete ALL data associated with that user.
			$debug = ( $default === null ) ? $debug = defined('WP_DEBUG') : false;
	        if( $debug && !defined('THEME_OPTION_ERROR') ) echo '<div class="message error woocommerce-error">' . __( 'This theme requires the plugin Magiccart', 'aloexpert' ) . '</div>';
	    }
	}

}

if ( !$alothemes ) $alothemes = Alothemes::getInstance();
if ( !$themecfg ) $themecfg  = $alothemes->get_options('', false);
