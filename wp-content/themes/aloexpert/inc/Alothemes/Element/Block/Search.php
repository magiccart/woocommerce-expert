<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-05-17 11:11:00
 * @@Modify Date: 2018-06-21 18:00:06
 * @@Function:
 */
 
namespace Alothemes\Element\Block;

class Search extends Template {
    
    protected function getCategoryChildsFull( $parent_id, $pos, $array, $level, &$dropdown ) {
        for ( $i = $pos; $i < count( $array ); $i ++ ) {
            if ( $array[ $i ]->category_parent == $parent_id ) {
                $name = str_repeat( '&nbsp;&nbsp;', $level ) . ucfirst($array[ $i ]->name);
                $value = $array[ $i ]->slug;
                $dropdown[] = array(
                        'label' => $name,
                        'value' => $value,
                );
                $this->getCategoryChildsFull( $array[ $i ]->term_id, $i, $array, $level + 1, $dropdown );
            }
        }
    }
    
    protected function get_categories($depth=0){
        $args = array(
            'type' => 'post',
            'child_of' => $depth,
            'parent' => '',
            'orderby' => 'id',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'number' => '',
            'taxonomy' => 'product_cat',
            'pad_counts' => false
            
        );

        $categories = get_categories($args);

        $product_categories_dropdown = array();
        $product_categories = array();
        $this->getCategoryChildsFull( 0, 0, $categories, 0, $product_categories_dropdown );
        
        foreach($product_categories_dropdown as $value){
            $product_categories[$value['value']] = $value['label'];
        }
        return $product_categories;
    }

}
