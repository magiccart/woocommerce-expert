<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-10 18:40:00
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php 
/* 
 * Template Name: Full Width  
 * */
?>
<?php   do_action( 'magiccart_page_before_template_part', __FILE__ ); ?>
<?php get_header(); ?>

<div class="content page-fullwidth">
    <div class="container">
        <?php
            if(!is_front_page()){
                magiccart_breadcrumbs();
            }
        ?>
    </div>
        <div class="page-content" >
            <?php if( have_posts()) : while( have_posts() ) : the_post(); ?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php endwhile ?>
            <?php else: ?>
                <?php get_template_part('content', 'none'); ?>
                <?php //the_content(); ?>
            <?php endif; ?>
        </div><!-- End .page-content -->

</div><!--  End .content -->

<?php get_footer(); ?>
<?php   do_action( 'magiccart_page_after_template_part', __FILE__ ); ?>
