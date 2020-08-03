<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product;
// $products_cats = $product->get_categories();
// list($fistpart) = explode(',', $products_cats);
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
$srcDefault = ALOTHEMES_IMAGES . 'placeholder-product.png';
$optionsCfg  = magiccart_options();
$configLazy   = false; //$optionsCfg['lazy-load'];
$typeView = '';
if(is_shop()){
    $typeView  = $optionsCfg['product_shop_default_view'];
}else{
    $typeView  = $optionsCfg['product_category_default_view'];
}

$classLi = is_home() ? post_class('product') : 'class="product type-product"';
$args['quickview'] = 1;
?>
<li <?php echo $classLi; ?> >
    <div class="inner-wrap per-product product clearfix">
        <div class="product-img">
            <?php
                if( ( isset($args['quickview']) && $args['quickview'] ) || (!is_front_page() && !isset($args['quickview']) && $typeView != 'list-view' ) ){
                        if(defined( 'YITH_WCQV' )){
                            echo '<div class="quickview"><a href="#" class="button yith-wcqv-button" title="' . __('Quick View', 'aloexpert') . '" data-product_id="'. $post->ID .'">' . __('Quick View', 'aloexpert') . '</a></div>';
                        }
                }
                
                $imgCatalog = get_the_post_thumbnail_url($post->ID, 'shop_catalog');
                $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
               
                if($imgCatalog == ''){
                    $imgCatalog = $srcDefault;
                }
                
            ?>
                
        <div class="image-overlay"></div>
        <div class="main-img">
        <?php
            wc_get_template( 'single-product/product-image.php' );
        ?>
        </div>
        <?php 
        
        $hoverImage = isset($optionsCfg['hover-image']) ? $optionsCfg['hover-image'] : 0;
        
        if($hoverImage){
            $attachment_ids = $product->get_gallery_image_ids();
            if ( $attachment_ids ) {
                $backImg        = wp_get_attachment_image_src( $attachment_ids[0], 'shop_catalog' );
                if(isset($backImg[0]) && $backImg[0]){
                    if( ! $configLazy){
                       echo '<div class="back-img back"><a href="' . get_the_permalink() .'"><img src="'. $backImg[0] .'" class="attachment-shop_catalog size-shop_catalog" alt="'. $props['alt'] .'" title="'. $props['title'] .'"></a></div>';
                    }else{
                        echo '<div class="back-img back"><a href="' . get_the_permalink() .'"><img src="'. $srcDefault .'" data-lazy="'. $backImg[0] .'" class="attachment-shop_catalog size-shop_catalog lazy" alt="'. $props['alt'] .'" title="'. $props['title'] .'"></a></div>';
                    }
                }
            } 
        }
        
        ?>
         </div>
         <div class="info">
            <div class="information clearfix">
                <div class="info_main">
                    <?php 
                        echo '<h3 class="product-name"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                        if( isset($args['review']) && $args['review'] ){
                            wc_get_template( 'loop/rating.php' );
                        }
                        wc_get_template( 'loop/price.php' );
                    ?>
                    <?php if ( $product->is_on_sale() ) : ?>
                        <div class="badge">
                            <div class="badge-inner sale-label">
                                 <?php echo apply_filters( 'woocommerce_sale_flash', '<div class="inner-text">' . __( 'Sale', 'woocommerce' ) . '</div>', $post, $product ); ?>
                            </div>
                        </div>
                    
                    <?php endif; ?>
                </div>
                <?php 
                    $sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);
                    if($sales_price_to != ""){
                        $sales_price_to = date("j M y", $sales_price_to);
                        echo '<div class="alo-count-down">
                                <div class="countdown caption" data-timer="' . esc_attr( $sales_price_to ) . '"></div>
                              </div>';
                    }
                ?>                 
                <div class="product-summary">
                    <?php 
                        if ( $product ) {
                            global $woocommerce;
                            if( version_compare( $woocommerce->version, 3.3, ">=" ) ) {
                                $defaults = array(
                                    'quantity' => 1,
                                    'class'    => implode( ' ', array_filter( array(
                                        'button',
                                        'product_type_' . $product->get_type(),
                                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
                                    ) ) ),
                                    'attributes' => array(
                                        'data-product_id'  => $product->get_id(),
                                        'data-product_sku' => $product->get_sku(),
                                        'aria-label'       => $product->add_to_cart_description(),
                                        'rel'              => 'nofollow',
                                    ),
                                );
                            }else {
                                $defaults = array(
                                    'quantity' => 1,
                                    'class'    => implode( ' ', array_filter( array(
                                        'button',
                                        'product_type_' . $product->get_type(),
                                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
                                    ) ) )
                                );
                            }

                            
                            $args = isset($args) ? $args : array();
                            $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

                            if( ( isset($args['cart']) && $args['cart'] ) || (!is_front_page() && !isset($args['cart'])) ){
                                    wc_get_template( 'loop/add-to-cart.php', $args );
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>   
</li>
