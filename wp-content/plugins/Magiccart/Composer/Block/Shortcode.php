<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-01 22:57:48
 * @@Modify Date: 2018-06-22 17:51:55
 * @@Function:
 */

namespace Magiccart\Composer\Block;

use Magiccart\Core\Block\Template;
use Magiccart\Composer\Model\Vccomposer;

class Shortcode extends Template{

    protected $_vcComposer;
    protected $nameShortcode;

    public function __construct(){
        parent::__construct();
        $this->_vcComposer = new Vccomposer();
        if(!$this->nameShortcode) $this->nameShortcode = 'magiccart_' . $this->_class;
        $this->beforeShortcode();
        add_shortcode($this->nameShortcode, array($this, 'initShortcode'));
        $this->afterShortcode();

    }

    public function beforeShortcode(){
        // NULL
    }
    
    public function initShortcode($atts, $content = null ){
        $this->addData((array) $atts);
    }

    public function afterShortcode(){
        // NULL
    }
    
    public function getOptions(){

        // if(isset($_GET['visible'])) $this->addData( array('visible' => absint($_GET['visible'])) ); // USED DEMO 

        $arrResponsive = array(1201=>'visible', 1200=>'desktop', 992=>'notebook', 768=>'tablet', 641=>'landscape', 481=>'portrait', 361=>'mobile');
        $settings = array();
        $settings['padding'] = $this->getData('padding');    
        $total   = count($arrResponsive);
        if($this->getData('slide')){
            $options = array(
                    'autoplay',
                    'arrows',
                    'dots',
                    'infinite',
                    'padding',
                    'responsive' ,
                    'rows',
                    //'vertical-swiping',
                    //'swipe-to-slide',
                    'autoplay-speed',
                    //'slides-to-show'
                    'vertical',
            );
            
            foreach ($options as $value){
                $settings[$value] = $this->getData( $value );
            }
            $settings['vertical-swiping'] = $this->getData('vertical');
            $settings['slides-to-show']   = $this->getData('visible');
            $settings['swipe-to-slide']   = 'true';
            
            $responsive = '[';
            foreach ($arrResponsive as $size => $screen) {
                $responsive .= '{"breakpoint": "'.$size.'", "settings":{"slidesToShow":"'.$this->getData($screen).'"}}';
                if($total-- > 1) $responsive .= ', ';
            }
            $responsive .= ']';
            $settings['responsive']         = $responsive;
 
        }else{          
            $responsive = '[["'. $this->getData('mobile') .'"],';
            ksort($arrResponsive);
            foreach ($arrResponsive as $size => $screen) {
                $size -= 1;
                $responsive .= '{"'.$size.'":"'.$this->getData($screen).'"}';
                if($total-- > 1) $responsive .= ',';
            }
            $responsive .= ']';
            $settings['responsive'] = $responsive;
        }
        return $settings;
    }

    public function getCategories($ids='', $taxonomy='product_cat')
    {
        if( is_array($ids) ) $ids = implode(',', $ids);
        $args = array(
            'type'          => 'post',
            'child_of'      => 0,
            'parent'        => '',
            'orderby'       => 'id',
            'order'         => 'ASC',
            'hide_empty'    => false,
            'hierarchical'  => 1,
            'exclude'       => '',
            'include'       => $ids,
            'number'        => '',
            'taxonomy'      => $taxonomy,
            'pad_counts'    => true,
        );
        $categories = get_categories( $args );
        return $categories;  
    }

    public function getCategoryById($cat_id, $taxonomy='product_cat')
    {
        $term = get_term_by( 'id', $cat_id, $taxonomy );
        return $term;
    }

    public function getCategoriesByIdKey($ids, $taxonomy='product_cat')
    {
        if( is_array($ids) ) $ids = implode(',', $ids);
        $categories = $this->getCategories($ids, $taxonomy);

        $slugs = '';
        foreach ($categories as $key => $value) {
            $slugs .= $slugs ? ',' . $value->slug : $value->slug;
        }
        return $slugs;
    }

    public function getSlugCategoryById($category_id, $taxonomy='product_cat')
    {
        $term = get_term_by( 'id', $category_id, $taxonomy, 'ARRAY_A' );
        if($term) return $term['slug'];
    }

    public function getCategoriesByIdName($ids, $arr = true, $taxonomy='product_cat')
    {
        if(!$ids) return $arr ? array() : '';
        if( is_array($ids) ) $ids = implode(',', $ids);
        $categories = $this->getCategories( $ids, $taxonomy );
        $nameCat = array();
        if($arr){
            foreach ($categories as $key => $value) {
                $nameCat[$value->slug] = $value->name ;
            }          
        } else {
            $nameCat = '';
            foreach ($categories as $key => $value) {
                $nameCat .= $value->name;
            }            
        }
        return $nameCat;
    }

}
