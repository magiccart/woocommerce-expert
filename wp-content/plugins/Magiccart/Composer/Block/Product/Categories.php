<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-13 17:50:35
 * @@Modify Date: 2018-06-22 17:54:42
 * @@Function:
 */

namespace Magiccart\Composer\Block\Product;

class Categories extends Products{

    public function initShortcode( $atts, $content = null ){
        global $woocommerce;
        if(!$woocommerce)  return '';
        $this->unsetData();
        $this->addData( array_merge( $this->defaultProduct(), $atts ) );

        $categories   = $this->getCategoriesByIdName($this->getData('categories'));
        $category_activated = $this->getCategoriesByIdKey($this->getData('category_activated'));
                $this->addData(array('category_activated' => $category_activated));
        $this->addData(array('categories' => $categories));
        
        if($categories){
            if(!isset($categories[$category_activated])){
                $tmp = array_keys($categories);
                $category_activated = array_shift($tmp);
                $this->addData(array('category_activated' => $category_activated));
            }
            if($this->getData('ajax_load')){
                $categories = array($category_activated => $categories[$category_activated]);
            }
            $this->_products = array();
            foreach ($categories as $key => $value){
                $this->_products[$key] = $this->_collection->woo_query($this->getData('product_activated'),$this->getData('number'), $key);
            }
            return $this->toHtml();
        }
        
        return $this->addError(__( "Category not yet select!", "alothemes" ));
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
}
