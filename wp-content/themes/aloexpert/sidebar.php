<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 11:37:22
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

    if(is_active_sidebar('left-sidebar-shop')){
        dynamic_sidebar('left-sidebar-shop');
    }else if(is_active_sidebar('right-sidebar-shop')){
        dynamic_sidebar('right-sidebar-shop');
    }else if(is_active_sidebar('left-sidebar-detail')){
        dynamic_sidebar('left-sidebar-detail');
    }else if(is_active_sidebar('right-sidebar-detail')){
        dynamic_sidebar('right-sidebar-detail');
    }else if(is_active_sidebar('left-sidebar')){
        dynamic_sidebar('left-sidebar');
    }else if(is_active_sidebar('right-sidebar')){
        dynamic_sidebar('right-sidebar');
    }else{
        _e('This is sidebar, you have to add some widgets', 'aloexpert');
    }

?>
