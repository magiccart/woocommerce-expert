<?php
/**
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

$_delay = 200;
$_count = 1;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global  $wp_query;

$typelist = (isset($_COOKIE['gridcookie']) && $_COOKIE['gridcookie'] == 'list') ? true : false;

$hasSidebar = true;

get_header('shop');

$options          = magiccart_options();
$classer          = '';
$row              = '';
$visible          = '';
if(is_shop()){
	$layout   = $options['product_shop_layout'];
	$visible  =  $options['product_shop']['visible'];
}else{
	$layout = $options['product_category_layout'];
	$visible  = $options['product_category']['visible'];
}
if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
if(isset($_GET['visible'])) $visible = $_GET['visible']; //  LAYOUT DEMO
if($layout != 'col1-layout'){
	$row        = 'row';
	$classer  = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
} 
$classer .= " col-visible-$visible";
?>
<div class="woo-shop content <?php echo esc_attr($layout) ?>">
  	<div class="container">
    <?php do_action('woocommerce_before_main_content'); ?>
    <div class="<?php echo esc_attr($row) ?>">
    	<!-- sidebar -->       
      	<?php if($layout == 'col3-layout'){ ?>
        <div class="sidebar sidebar-left col-md-3 col-sm-3">
            <div class="sidebar-content"><?php get_sidebar('left'); ?></div>
        </div>
      	<?php } ?>
      	<?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>
      	<div class="col-main mb__60 <?php echo esc_attr($classer) ?>">
	        <?php
	        	if ( is_product_category() ){
					global $wp_query;
					global $alothemes;
					$cat = $wp_query->get_queried_object();
					$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
					$image = wp_get_attachment_url( $thumbnail_id );
					if ( !$image ) $image = $alothemes->get_theme_url('images/placeholder-category.jpg');
					echo '<div class="category-image"><img src="' . esc_url($image) . '" alt="' . esc_attr($cat->name) . '" /></div>';
	        	}
	        ?>
	        <div class="cat-header">
	        	<div class="sort-bar">
	                <?php if ( have_posts() ) : do_action( 'woocommerce_before_shop_loop' ); ?><?php endif; ?>
	            </div>
	            <div class="woo-pagination clearfix">
	               <!-- Pagination -->
	               <?php do_action( 'woocommerce_after_shop_loop' );?>
	               <!-- End Pagination -->
	            </div>
	        </div>
	        <div class="category-page products-grid">
	        	<?php //do_action( 'woocommerce_archive_description' ); ?>
	            <?php if ( have_posts() ) : ?>
	                <?php woocommerce_product_loop_start(); ?>
	                    <?php woocommerce_product_subcategories(); ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
	                        <!-- Product Item -->
	                        <?php wc_get_template( 'content-product.php', array('_delay' => $_delay, 'wrapper' => 'li') ); ?>
	                        <!-- End Product Item -->
	                        <?php  $_delay+=200; ?>
	                    <?php endwhile;?>
	                <?php woocommerce_product_loop_end(); ?>
	                <div class="cat-footer clearfix">
		                <div class="woo-pagination clearfix">
		                    <?php do_action( 'woocommerce_after_shop_loop' );?>
		                </div>
		                <div class="sort-bar">
		                <?php if ( have_posts() ) : do_action( 'woocommerce_before_shop_loop' ); ?><?php endif; ?>
		            	</div>
	            	</div>
	            <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
	                <?php wc_get_template( 'loop/no-products-found.php' ); ?>
	            <?php endif; ?>
	        </div>
        </div>
		<!-- sidebar -->        
		<?php 
        $sidebar = '';
        if($layout == 'col3-layout' || $layout == 'col2-right-layout'){
            $sidebar = 'right';
        } elseif($layout == 'col2-left-layout')
            $sidebar = 'left';
        if($sidebar){
      ?>
        <div class="sidebar sidebar-shop mb__60 sidebar-<?php echo esc_attr($sidebar) ?> col-md-3 col-sm-3">
            <div class="sidebar-content"><?php get_sidebar($sidebar); ?></div>
        </div>
        <?php } ?>
    </div>
    <?php do_action('woocommerce_after_main_content'); ?>  
	</div>
</div> <!-- end container -->
<?php get_footer('shop'); ?>
