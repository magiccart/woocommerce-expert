<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $cross_sells ) return; 
$selector = 'alo-content-'.rand(0,999999999);
$config = magiccart_options('page_cart');
$settings = magiccart_settings_slider($config);
?>
<div class="<?php echo esc_attr($selector) ?>">
	<div class="cross-sells">
		<div class="block-title-tabs">
			<h2><?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?></h2>
		</div>
		<?php //woocommerce_product_loop_start(); ?>
		<div class="grid products-grid">
		<ol class="products grid content-products" <?php foreach($settings as $key => $value){?>
                                   data-<?php echo esc_attr($key);   ?>='<?php echo esc_attr($value); ?>'
                           <?php } ?> >
			<?php foreach ( $cross_sells as $cross_sell ) : ?>
				<?php
				 	$post_object = get_post( $cross_sell->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					wc_get_template_part( 'content', 'product' ); ?>
			<?php endforeach; ?>
		</ol>
		</div>
		<?php //woocommerce_product_loop_end(); ?>
	</div>
</div>
<?php 
	wp_reset_postdata();
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	(function ($) {
		var crossSells  = $('.<?php echo $selector ?> .cross-sells .products');
		if(crossSells.length) $('head').append(magicproduct(crossSells, '.type-product'));
    })(jQuery);
});
</script>
