<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-13 17:50:35
 * @@Modify Date: 2018-06-21 16:30:13
 * @@Function:
 */

namespace Magiccart\Composer\Block\Product;

class CategoryImage extends Products{

    public function initShortcode( $atts, $content = null ){
        global $woocommerce;
        if(!$woocommerce)  return '';
        $this->unsetData();
        $this->addData( array_merge( $this->defaultProduct(), $atts ) );

        $categories    = $this->getCategories($this->getData('categories'));
        $this->addData(array('categories' => $categories));
        
        if($categories){
            return $this->toHtml();
        }
        
        return $this->addError(__( "Categories not yet select!", "alothemes" ));
    }
    
    public function defaultProduct(){
    	$categories = $this->_vcComposer->get_arr_category();
    	
    	$category = array_flip(array_slice($categories, 0, 1));
    	$category = implode($category, '');
    
    	$catRelated = array_flip(array_slice($categories, 0, 5));;
    	$catRelated = implode($catRelated, ',');
    	 
    	$default = array(
    			'default'           => $category,
    			'categories_related'=> $catRelated,
    	);
    	return $default;
    }

    public function magiccart_image($catId) 
    {
        if(!$catId) return;
        return get_post_meta($catId, '_magiccart_image', true);
    }

    public function woocommerce_category_image($catId) 
    {
        if ( ! $catId && is_product_category() ){
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $catId =  $cat->term_id;
        } 
        if(!$catId) return;
        $thumbnail_id = get_woocommerce_term_meta( $catId, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        return $image;
    }

}
