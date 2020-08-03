<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 11:37:07
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

    if(class_exists( 'WooCommerce' )){
        $is_shop = ( is_shop() || is_product_category() || get_post_type() == 'product' ) ? true: false;
        $is_product = is_product();
    } else {
        $is_shop = false;
        $is_product = false;
    }
    if($is_product && is_active_sidebar('left-sidebar-detail')){
        dynamic_sidebar('left-sidebar-detail');
    }else if( $is_shop && is_active_sidebar('left-sidebar-shop') ){
        dynamic_sidebar('left-sidebar-shop');
    }else if(is_portfolio() || get_post_type() == 'portfolio'){
        if(is_active_sidebar('right-sidebar-portfolio')){
            dynamic_sidebar('right-sidebar-portfolio');         
        }
    }else if(!is_front_page() && is_active_sidebar('right-sidebar')){
        dynamic_sidebar('right-sidebar');
    }else {
        get_sidebar();
    }
?>
