<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
if ( !$related_products ) return;


$selector = 'alo-content-'.rand(0,999999999);
$config = magiccart_options('product_related');
$settings = magiccart_settings_slider($config);
?>
<div class="<?php echo esc_attr($selector) ?>">
	<section class="related auto-height compaliti-product products">
		<div class="block-title-tabs">
			<h2><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>
		</div>
		<?php //woocommerce_product_loop_start(); ?>
			<div class="grid products-grid">
			<ol class="products grid content-products" <?php foreach($settings as $key => $value){?>
                                   data-<?php echo esc_attr($key); ?>='<?php echo esc_attr($value); ?>'
                           <?php } ?> >
			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

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
		var related  = $('.<?php echo $selector ?> .related .products');
		if(related.length) $('head').append(magicproduct(related, '[class*="type-product"]'));
    })(jQuery);
});
</script>
