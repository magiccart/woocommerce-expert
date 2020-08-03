<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-10 11:09:08
 * @@Modify Date: 2018-06-21 12:07:09
 * @@Function:
 */

namespace Magiccart\Composer\Block\Adminhtml\Vc\Product;

class CategoryImage extends Products{
	
    public function initMap(){
        $temp = array(
        			array(
	        			'type'          => "textfield",
	        			'heading'       => __("Title : ", 'alothemes'),
	        			'param_name'    => "title",
	        			'save_always' 	=> true,
		        	),
	                array(
	                    'type'          => 'multiselect',
	                    'heading'       => __( 'Categories <span style="color:red;">*</span> : ', 'alothemes' ),
	                    'value'         => $this->getCategories(),
	                    'param_name'    => 'categories',
	                    'description'   => __( 'Product categories list', 'alothemes' ),
	                ),

	            );
        $params = array_merge(
        	$temp, 
        	$this->get_settings(), 
        	$this->get_responsive(),
        	$this->get_templates()
        );
        
        $this->add_VcMap($params, 'Magiccart Category Image');
    }

}

