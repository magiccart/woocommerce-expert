<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-07-01 14:21:16
 * @@Modify Date: 2018-07-01 22:19:51
 * @@Function:
 */

namespace Alothemes\Core\Helper;

class Sold
{
    public function get_sold_qty($product)
    {
    	$productId = $product->get_id();
        $sold       = ($total_sales = get_post_meta($productId, 'total_sales', true)) ? round($total_sales) : 0;
        return $sold;
    }

    public function get_sold_percent($product)
    {
        $sold  = $this->get_sold_qty($product);
        $stock = $this->get_stock_qty($product);
        $total_qty = $qty + $sold;
        return $qty > 0 ? round(($qty/$total_qty) * 100) : 0;
    }

    public function get_stock_qty($product)
    {
        $productId = $product->get_id();
        $in_stock  = ($stock = get_post_meta($productId, '_stock', true)) ? round($stock) : 0;
        return $in_stock;        
    }

    public function get_sold_qty_deals($product)
    {
        $productId = $product->get_id();
        $date_from = get_post_meta($productId, '_sale_price_dates_from', true);
        $sold = $this->get_sold_qty_date_from($productId, $date_from);
        return (int) $sold;
    }

    public function get_sold_qty_date_from($product_id, $date_from=0)
    {
        global $wpdb;
        $date_to = date('Y-m-d');

        $sql = "
        SELECT COUNT(*) AS sale_count
        FROM {$wpdb->prefix}woocommerce_order_items AS order_items
        INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS order_meta ON order_items.order_item_id = order_meta.order_item_id
        INNER JOIN {$wpdb->posts} AS posts ON order_meta.meta_value = posts.ID
        WHERE order_items.order_item_type = 'line_item'
        AND order_meta.meta_key = '_product_id'
        AND order_meta.meta_value = %d
        AND order_items.order_id IN (
            SELECT posts.ID AS post_id
            FROM {$wpdb->posts} AS posts
            WHERE posts.post_type = 'shop_order'
                AND posts.post_status IN ('wc-completed','wc-processing')
                AND DATE(posts.post_date) BETWEEN %s AND %s
        )
        GROUP BY order_meta.meta_value";

        return $wpdb->get_var($wpdb->prepare($sql, $product_id, $date_from, $date_to));
    }

}
