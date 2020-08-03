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

$optionsCfg  = magiccart_options();
$hoverImage = isset($optionsCfg['hover-image']) ? $optionsCfg['hover-image'] : 0;
$configLazy   = false; //$optionsCfg['lazy-load'];
$typeView = '';
if(is_shop()){
    $typeView  = $optionsCfg['product_shop_default_view'];
}else{
    $typeView  = $optionsCfg['product_category_default_view'];
}
$args['quickview'] = 1;
?>
<li <?php post_class() ?> >
    <div class="inner-wrap per-product clearfix wow fadeInUp animated" data-wow-duration="1s" data-wow="fadeInUp" data-wow-delay="<?php echo isset($args['sec']) ? $args['sec'] : 0 ?>ms" >
        <div class="product-img">
            
        <div class="image-overlay"></div>
        <div class="main-img">
            <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                <?php
                    echo get_the_post_thumbnail($post);
                    // echo wc_placeholder_img( $size = 'woocommerce_thumbnail' );
                    // echo $imge_lazy = wc_placeholder_img_src();
                ?>
            </a>
        </div>
       <?php 
            if($hoverImage){
                $attachment_ids = $product->get_gallery_image_ids();
                if ( $attachment_ids ) {
                    echo wc_get_gallery_image_html($attachment_ids[0], true);
                } 
            }
        ?>
        </div>
        <div class="info">
            <div class="information clearfix">
                <div class="info_main">
                    <?php
                        global $alothemes;
                        $label = $alothemes->create_object('Alothemes\Element\Block\Label');
                        if ( $label ) {
                            echo $label->toHtml();
                        }
                    ?>  
                    <?php 
                        wc_get_template( 'loop/price.php' );
                        if( isset($args['review']) && $args['review'] ){
                            wc_get_template( 'loop/rating.php' );
                        }
                        echo '<h3 class="product-name"><a href="' . esc_url( get_the_permalink() ) . '">' . get_the_title() . '</a></h3>';
                    ?>
                    <div class="short-description">
                        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
                    </div>
                </div>
                <?php
                    // $product->is_type( $type ) checks the product type, string/array $type ( 'simple', 'grouped', 'variable', 'external' ), returns boolean

                    if( ( !$product->is_type( 'grouped' ) && isset($args['statistic']) && $args['statistic'] ) ) :
                        global $alothemes;
                        $_soldHelper = $alothemes->create_object('Alothemes\Core\Helper\Sold');
                        $sold   = $_soldHelper->get_sold_qty($product);
                        // $sold   = $_soldHelper->get_sold_qty_deals($product);
                        $qty    = (int) $_soldHelper->get_stock_qty($product);
                        $total_qty = $qty + $sold;
                        $percent = $qty > 0 ? round(($qty/$total_qty) * 100) : 0;
                ?>
                        <div class="product-deal-special-progress">
                            <div class="deal-stock-label">
                                <span class="stock-available text-left"><?php echo __('Available', 'aloexpert') ?>: <strong><?php echo $qty ?></strong></span>
                                <span class="stock-sold text-right"><?php echo __('Already Sold', 'aloexpert') ?>: <strong><?php echo $sold ?></strong></span>
                            </div>
                            <div class="deal-progress">
                                <span class="deal-progress-bar" style="width:<?php echo $percent ?>%"><?php echo $percent ?>%</span>
                            </div>
                        </div>
                <?php
                    endif;
                ?> 
                <div class="product-summary">
                    <div class="pad-summary">
                    <?php 
                        if ( $product ) {
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
                            
                            $args = isset($args) ? $args : array();
                            $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

                            if( ( isset($args['cart']) && $args['cart'] ) || (!is_front_page() && !isset($args['cart'])) ){
                                    wc_get_template( 'loop/add-to-cart.php', $args );
                            }
                        }
                    ?>
                    </div>
                </div>
                <div class="action"><a href="<?php echo isset($args['type']) ? esc_url( site_url( $args['type'] ) ) : '#'; ?>"><?php  echo __('View Collection', 'aloexpert'); ?></a></div>
            </div>
        </div>
    </div>   
</li>