<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<?php $listClass = isset($args['list_class']) ? $args['list_class'] : ''; ?>
<?php $cart_count = WC()->cart->get_cart_contents_count() ?>
<p class="title"><?php printf( __( 'Your cart (%s)', 'woocommerce' ),  $cart_count) ?></p>
<ul class="cart_list product_list_widget <?php echo $listClass; ?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php
							global $woocommerce;
							if( version_compare( $woocommerce->version, 3.3, ">=" ) ) {
						     	$cart_remove_url = wc_get_cart_remove_url( $cart_item_key );
						    }else {
						    	$cart_remove_url = WC()->cart->get_remove_url( $cart_item_key );
						    }
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
								esc_url( $cart_remove_url ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $cart_item_key ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
						?>
						<div class="product-thumb">
							
							<?php if ( ! $_product->is_visible() ) : ?>
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>" class="clearfix thumbnail-img">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
								</a>
							<?php endif; ?>
						</div>
						<div class="product-info">
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							<?php
								global $product; 
								$product = wc_get_product( $product_id );
							?>
							<?php wc_get_template( 'loop/rating.php' ); ?>
							<a href="<?php echo esc_url( $product_permalink ); ?>"><p class="product-name"><?php echo $product_name ?></p></a>
							<?php 
								global $woocommerce;
								if( version_compare( $woocommerce->version, 3.3, ">=" ) ) {
							     	echo wc_get_formatted_cart_item_data( $cart_item );
							    }else {
							    	echo WC()->cart->get_item_data( $cart_item );
							    }
							?>
						</div>
					</li>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( ! WC()->cart->is_empty() ) : ?>
	<div class="total-buttons">
		<p class="total clearfix"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button viewcart wc-forward"><?php _e( 'Shopping cart', 'woocommerce' ); ?></a>
		</p>
	</div> 
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
