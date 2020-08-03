<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<li>
	<div class="sidebar-img">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo $product->get_image(); ?>
			
		</a>
	</div>
	<div class="info">
        <div class="information clearfix">
            <div class="info_main">
            	<h3 class="product-name">
					<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
						<span class="product-title"><?php echo $product->get_name(); ?></span>
					</a>
				</h3>
				<span class="price clearfix">
					<?php if ( ! empty( $show_rating ) ) : ?>
						<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
					<?php endif; ?>
					<?php echo $product->get_price_html(); ?>
				</span>
			</div>
		</div>
	</div>
</li>
