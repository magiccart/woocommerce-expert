<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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

if ( ! $upsells ) return;

$selector = 'alo-content-'.rand(0,999999999);
$config = magiccart_options('product_up_sells');
$settings = magiccart_settings_slider($config);
?>
<div class="<?php echo esc_attr($selector) ?>">
	<section class="up-sells upsells products auto-height">
		<div class="block-title-tabs">
			<h2><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>
		</div>
		<?php //woocommerce_product_loop_start(); ?>
		<div class="grid products-grid">
		<ol class="products grid content-products" <?php foreach($settings as $key => $value){?>
                                   data-<?php echo esc_attr($key); ?>='<?php echo esc_attr($value); ?>'
                           <?php } ?> >

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				 	$post_object = get_post( $upsell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>
		</ol>
		</div>
		<?php //woocommerce_product_loop_end(); ?>

	</section>
</div>

<?php
	wp_reset_postdata();
?>

<script type="text/javascript">
jQuery(document).ready(function(){
	(function ($) {
		var upsells  = $('.<?php echo $selector ?> .upsells .products');
		if(upsells.length) $('head').append(magicproduct(upsells, '[class*="type-product"]'));
    })(jQuery);
});
</script>
