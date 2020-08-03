<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-13 17:31:03
 * @@Modify Date: 2018-07-10 12:05:15
 * @@Function:
 */

namespace Magiccart\Composer\Block\Adminhtml\Vc\Post;
use Magiccart\Composer\Block\Adminhtml\Vc;

class Posts extends Vc{

    public function initMap(){
        $temp = array(
    	                array(
            				'type'          => 'dropdown',
            				'heading'       => __( 'Order by : ', 'alothemes' ),
            				'value'         => array_flip($this->getTypePosts()),
            				'param_name'    => 'orderby',
                            'save_always'   => true,
                		),
                        array(
                            'type'          => 'multiselect',
                            'heading'       => __( 'Filter in Categories:', 'alothemes' ),
                            'value'         => $this->getCategories(),
                            'param_name'    => 'categories',
                            'description'   => __( 'Limit Post in categories', 'alothemes' ),
                        ),
                        array(
                            'type'          => "textfield",
                            'heading'       => __("Extra class name : ", 'alothemes'),
                            'description'   => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'alothemes'),
                            'param_name'    => "el_class",
                            'save_always'   => true,
                        ),
            	);
        $params = array_merge(
            $temp, 
            $this->get_settings(), 
            $this->get_responsive(),
            $this->get_templates()
        );
        
        $this->add_VcMap($params);
    }

    protected function getCategories(){
        return $this->_vcComposer->get_arr_category('category');
    }

    protected function getTypePosts(){
        $arrType = array(
            __('Date', 'alothemes')     => 'date',
            __('Author', 'alothemes')   => 'author',
            __('Title', 'alothemes')    => 'title',
            __('Modified', 'alothemes') => 'modified',
            __('Rand', 'alothemes')     => 'rand',
            __('Comment', 'alothemes')  => 'comment_count',
        );
        return $arrType;
    }

}
