<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $wp_query;

if ( 1 == $wp_query->found_posts || ! woocommerce_products_will_display() )
	return;

	$mode_view = ''; 
	if(is_shop()){
		$mode_view  = magiccart_options('product_shop_default_view');
	}else{
		$mode_view  = magiccart_options('product_category_default_view');
	}
	$list = "";
	$grid = '';
	if($mode_view == 'list-view'){
		$list = "active";
	}else{
		$grid = 'active';
	}

?>
<form class="woocommerce-ordering custom" method="get">
	<div class='title-sort'>Sort by</div>
	<div class="select-wrapper"><select name="orderby" class="orderby">
		<?php
			$catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order' => esc_html__( 'Default Sorting', 'aloexpert' ),
				'popularity' => esc_html__( 'Popularity', 'aloexpert' ),
				'rating'     => esc_html__( 'Average rating', 'aloexpert' ),
				'date'       => esc_html__( 'Newness', 'aloexpert' ),
				'price'      => esc_html__( 'Price: low to high', 'aloexpert' ),
				'price-desc' => esc_html__( 'Price: high to low', 'aloexpert' )
			) );

			if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
				unset( $catalog_orderby['rating'] );

			foreach ( $catalog_orderby as $id => $name )
				echo '<option value="' . esc_attr( $id ) . '" ' . selected( $orderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
		?>
	</select></div>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' == $key )
				continue;
			
			if (is_array($val)) {
				foreach($val as $innerVal) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form>
<nav class="gridlist-toggle">
	<ul>
		<li id="grid" title="<?php echo esc_attr__('Grid', 'aloexpert')?>" class="<?php echo $grid; ?>">
			<span class="dashicons dashicons-grid-view"><?php echo esc_attr__('Grid', 'aloexpert')?></span></li>
		<li id="list" title="<?php echo esc_attr__('List', 'aloexpert')?>" class="<?php echo $list; ?>">
			<span class="dashicons dashicons-exerpt-view"><?php echo esc_attr__('List', 'aloexpert')?></span></li>		
	</ul>
</nav>
