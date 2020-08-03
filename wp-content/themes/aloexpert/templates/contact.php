<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-10 18:39:55
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php 
/* 
 * Template Name: Contact  
 * */
?>
<?php   do_action( 'magiccart_page_before_template_part', __FILE__ ); ?>
<?php
    $options        = magiccart_options();
    $layout         = $options['default_layout'];
    $contact        = isset($options['shortcode_contact']) ? $options['shortcode_contact'] : '';
    $classer    = '';
    $row        = '';
    if($layout != 'col1-layout'){
        $row        = 'row';
        $classer    = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
    }
?>

<?php get_header(); ?>
<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
        <?php magiccart_breadcrumbs(); ?>
        <div class="page-content <?php echo esc_attr($row) ?>" >
            <?php  if($layout == 'col2-left-layout' || $layout == 'col3-layout'){ ?> 
                <div class="sidebar-left col-md-3 col-sm-3">
                    <?php dynamic_sidebar('left-sidebar'); ?>
                </div>
            <?php  } ?>
            <div class="col-main <?php echo esc_attr($classer) ?>">
                <div class="contact-form">
                    <?php 
                        echo do_shortcode($contact);
                       // the_content();
                     ?>
                </div>
            </div>
            <?php  if($layout == 'col2-right-layout' || $layout == 'col3-layout'){ ?> 
                <div class="sidebar-right col-md-3 col-sm-3">
                    <?php dynamic_sidebar('right-sidebar'); ?>
                </div>
            <?php  } ?>
        </div><!-- End .page-content -->    
    </div><!--  End .container -->
</div><!--  End .content -->

<?php get_footer(); ?>
<?php   do_action( 'magiccart_page_after_template_part', __FILE__ ); ?>
