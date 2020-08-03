<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-10 11:09:08
 * @@Modify Date: 2018-08-01 19:43:24
 * @@Function:
 */

namespace Magiccart\Composer\Block\Adminhtml\Vc\Product;
use Magiccart\Composer\Block\Adminhtml\Vc;
use Magiccart\Composer\Model\System\Config\Product\Types as typeFilter;

class Products extends Vc{

    protected $typeFilter;

    public function initMap(){
        $temp = array(
		                array(
		                    'type'              => "multiselect",
		                    'heading'           => __("Product Collection  <span style='color:red;'>*</span> :", 'alothemes'),
		                    'param_name'        => "product_collection",
		                    'value'             => $this->get_type("name"),
		                ),
                        array(
                            'type'          => 'multiselect',
                            'heading'       => __( 'Filter in Categories <span style="color:red;">*</span> : ', 'alothemes' ),
                            'value'         => $this->getCategories(),
                            'param_name'    => 'categories',
                            'description'   => __( 'Limit Product in categories', 'alothemes' ),
                        ),
		                array(
		                    'type'      	=> "dropdown",
		                    'heading'   	=> __("Product Activated : ", 'alothemes'),
		                    'param_name' 	=> "product_activated",
		                    'value' 		=>  $this->get_type(),
		                    'save_always' 	=> true,
		                )
		            );
        $params = array_merge(
        	$temp, 
        	$this->get_settings(),
        	$this->get_responsive(), 
        	$this->setting_product(), 
        	$this->count_time(), 
        	$this->default_block(), 
        	$this->get_templates()
        );
        
        $this->add_VcMap($params);
    }

    protected function get_type($type = "key")
    {
        if(!$this->typeFilter) $this->typeFilter  = new typeFilter; 
        $arrType = $this->typeFilter->toArray();
        if($type != "key") return $arrType;
    
        return array_flip($arrType);
    }

    protected function getCategories()
    {
        return $this->_vcComposer->get_arr_category();
    }

    protected function count_time(){
        $downTime = array(
                        array(
                            'type'          => "date",
                            'heading'       => __('Countdown Time :', 'alothemes'),
                            'param_name'    => 'date',
                            'group'         => __( 'Settings', 'alothemes' ),
                        ),
                    );
        return $downTime;
    }
    
    protected function default_block(){
        $vcComposer = $this->_vcComposer;
        $settings = array(
                array(
                    'type'          => "dropdown",
                    'heading'       => __("Block Left :", 'alothemes'),
                    'param_name'    => "shortcode_left",
                    'value'         => $vcComposer->getBlocks(),
                    'save_always'   => true,
                ),
                array(
                    'type'          => "dropdown",
                    'heading'       => __("Block Bottom :", 'alothemes'),
                    'param_name'    => "shortcode_bottom",
                    'value'         => $vcComposer->getBlocks(),
                    'save_always'   => true,
                ),
        );
        return $settings;
    }

}

