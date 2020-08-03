<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
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

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
echo '<div class="content-review">';
echo wc_get_rating_html( $product->get_average_rating() );
if( ! $product->get_average_rating() ){
	echo '<div class="star-rating" title="Rated 0" style="opacity:0">
			<span style="opacity:0"><strong class="rating">0</strong> out of 0</span>
		</div>';
}

$review_count = $product->get_review_count();

if ( $review_count > 0 ) : ?>
	<?php echo '<div class="number-review">'; ?>
	<span class="bracket">(</span><?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?><span class="bracket">)</span>
	<?php echo '</div>'; ?>
<?php endif; ?>
<?php echo '</div>'; ?>