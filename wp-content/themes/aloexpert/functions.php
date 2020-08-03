<?php
/**
 * Magiccart 
 * @category  Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license   http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-07-24 12:11:00
 * @@Modify Date: 2018-08-02 15:02:29
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
define( 'ALOTHEMES_URL', get_stylesheet_directory_uri());
define( 'ALOTHEMES_IMAGES', ALOTHEMES_URL . '/images/');
define('SHOPBRAND', 'brand');
define('HEADER_BUILDER', false);
define('FOOTER_BUILDER', true);
require_once('inc/alothemes.php');
require_once('inc/post-like.php');
require_once('inc/magiccart-functions.php');
require_once('inc/magiccart-functions-extra.php'); // Add your custom function in this file.
global $alothemes;
if($alothemes->get_options('templatehints', false)){
    define('TEMPLATEDHINTS', true);  
}

if(defined('TEMPLATEDHINTS')){
    // add the action template path hints 
    add_action( 'get_header', 'magiccart_header_hints', 10, 4 );
    add_action( 'get_header_after', 'magiccart_end_file', 10 );
    add_action( 'get_sidebar', 'magiccart_sidebar_hints', 10, 4 );
    add_action( 'get_sidebar_after', 'magiccart_end_file', 10 );
    add_action( 'get_template_part_content', 'magiccart_template_part_content_hints', 10, 4 );
    add_action( 'get_template_part_content_after', 'magiccart_end_file', 10 );
    add_action( 'get_template_part_embed', 'magiccart_template_part_content_hints', 10, 4 );
    add_action( 'get_template_part_embed_after', 'magiccart_end_file', 10 );
    add_action( 'get_template_part_loop', 'magiccart_template_part_content_hints', 10, 4 );
    add_action( 'get_template_part_loop_after', 'magiccart_end_file', 10 );
    add_action( 'woocommerce_before_template_part', 'magiccart_woocommerce_before_template_hints', 10, 4 );
    add_action( 'woocommerce_after_template_part', 'magiccart_end_file', 10 );
    add_action( 'magiccart_before_template_part', 'magiccart_before_template_hints', 10, 4 );
    add_action( 'magiccart_after_template_part', 'magiccart_end_file', 10 );
    add_action( 'magiccart_page_before_template_part', 'magiccart_before_template_hints', 10, 4 );
    add_action( 'magiccart_page_after_template_part', 'magiccart_end_file', 10 ); 
    add_action( 'get_footer', 'magiccart_footer_hints', 10, 4 );
    add_action( 'get_footer_after', 'magiccart_end_file', 10 );
}

// add_action( 'after_setup_theme', 'magiccart_theme_setup' );
add_action( 'init', 'magiccart_empty_cart' );
add_action( 'widgets_init', 'magiccart_widgets_init' );
add_filter( 'body_class', 'magiccart_body_classes' );
add_filter( 'excerpt_more', 'magiccart_readmore');

// Add feature support woocommerce
add_filter( 'add_to_cart_fragments', 'magiccart_header_add_to_cart_fragment' );
add_action( 'pre_get_posts', 'magiccart_woocommerce_alter_category_search' );
add_filter( 'woocommerce_breadcrumb_defaults', 'magiccart_woocommerce_breadcrumb' );
add_filter( 'woocommerce_output_related_products_args', 'magiccart_product_related_limit_args' );

if ( wp_doing_ajax() ) {
    if(isset($_POST['action']) && $_POST['action'] == 'yith_load_product_quick_view'){
        add_action( 'woocommerce_product_thumbnails', 'magiccart_get_product_image_quickview', 20 );
    }
}

// End add feature support woocommerce


if (is_admin()) {
    if(!class_exists('Magiccart')){
        require_once('inc/class-tgm-plugin-activation.php');
        add_action('tgmpa_register', 'magiccart_plugin_activation' );
    }
    if (class_exists('ReduxFrameworkPlugin')) $alothemes->create_object('Magiccart\Core\Block\Adminhtml\Themecfg');
}else {
    $megamenu = $alothemes->create_object('Alothemes\Megamenu\Block\Menu');
    global $navmobile;
    $navmobile = array();
    add_filter( 'wp_nav_menu_args', array($megamenu, 'setMenu') );
}
