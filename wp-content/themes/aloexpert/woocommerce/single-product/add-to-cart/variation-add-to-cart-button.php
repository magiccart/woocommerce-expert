<?php
/**
 * Single variation cart button
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $post;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php
		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input( array(
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1,
		) );

		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<div class="actions">
		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
		<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
		<input type="hidden" name="variation_id" class="variation_id" value="0" />
	</div>
</div>

