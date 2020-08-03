<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-08-01 18:32:46
 * @@Modify Date: 2018-08-01 20:11:07
 * @@Function:
 */

namespace Magiccart\Composer\Model\System\Config\Product;

class Types
{

    const ALL        = '0';
    const BEST       = 'best_selling';
    const DEALS 	 = 'deals';
    const FEATURED 	 = 'featured_product';
    const LATEST     = 'recent_product';
    const NEWPRODUCT = 'new_product';
    const RANDOM 	 = 'random_product';
    const REVIEW     = 'recent_review';
    const SALE 	     = 'sale_product';
    const TOPRATE    = 'top_rate';

    public function toArray()
    {
        return [
            self::BEST          =>  __('Best Seller', 'alothemes'),
            self::DEALS         =>  __('Deals Products', 'alothemes'),
            self::FEATURED      =>  __('Featured Products', 'alothemes'),
            self::LATEST        =>  __('Latest Products', 'alothemes'),
            self::NEWPRODUCT    =>  __('New Products', 'alothemes'),
            self::RANDOM        =>  __('Random Products', 'alothemes'),
            // self::REVIEW        =>  __('Recent Review', 'alothemes'),
            self::SALE          =>  __('Sale Products', 'alothemes'),
            self::TOPRATE       =>  __('Top Rate', 'alothemes'),
        ];
    }

    public function toOptionArray()
    {
        return [
            [ 'value' =>  self::BEST, 'label'       =>   __('Best Seller', 'alothemes') ],
            [ 'value' =>  self::DEALS, 'label'      =>   __('Deals Products', 'alothemes') ],
            [ 'value' =>  self::FEATURED, 'label'   =>   __('Featured Products', 'alothemes') ],
            [ 'value' =>  self::LATEST, 'label'     =>   __('Latest Products', 'alothemes') ],
            [ 'value' =>  self::NEWPRODUCT, 'label' =>   __('New Products', 'alothemes') ],
            [ 'value' =>  self::RANDOM, 'label'     =>   __('Random Products', 'alothemes') ],
            // [ 'value' =>  self::REVIEW, 'label'     =>   __('Recent Review', 'alothemes') ],
            [ 'value' =>  self::SALE, 'label'       =>   __('Sale Products', 'alothemes') ],
            [ 'value' =>  self::TOPRATE, 'label'    =>   __('Top Rate', 'alothemes') ],
        ];
    }

    public function toOptionAll()
    {
        return [
            [ 'value' =>  self::ALL, 'label'        =>   __('All', 'alothemes') ],
            [ 'value' =>  self::BEST, 'label'       =>   __('Best Seller', 'alothemes') ],
            [ 'value' =>  self::DEALS, 'label'      =>   __('Deals Products', 'alothemes') ],
            [ 'value' =>  self::FEATURED, 'label'   =>   __('Featured Products', 'alothemes') ],
            [ 'value' =>  self::LATEST, 'label'     =>   __('Latest Products', 'alothemes') ],
            [ 'value' =>  self::NEWPRODUCT, 'label' =>   __('New Products', 'alothemes') ],
            [ 'value' =>  self::RANDOM, 'label'     =>   __('Random Products', 'alothemes') ],
            // [ 'value' =>  self::REVIEW, 'label'     =>   __('Recent Review', 'alothemes') ],
            [ 'value' =>  self::SALE, 'label'       =>   __('Sale Products', 'alothemes') ],
            [ 'value' =>  self::TOPRATE, 'label'    =>   __('Top Rate', 'alothemes') ],
        ];
    }

}
