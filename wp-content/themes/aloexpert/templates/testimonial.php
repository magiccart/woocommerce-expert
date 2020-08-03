<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-12 18:40:00
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php 
/* 
 * Template Name: Testimoial 
 * */
?>
<?php  get_header(); ?>
<?php 
    $options    = magiccart_options();
    $blogHeader = $options['blog_header_text'];
    $layout     = $options['default_layout'];
    $blog_view  = isset($options['blog_view']) ? $options['blog_view'] : 'list-view';
    $classer    = '';
    $row        = '';
    if($layout != 'col1-layout'){
        $row        = 'row';
        $classer    = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
    }   
    $args = array( 
        'post_type' => 'testimonial', 
    );
    $testimonial = new \WP_Query( $args );
?>
<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
        <?php magiccart_breadcrumbs(); ?>
        <div id="main-content" class="post-content <?php echo esc_attr($row) ?>" >
            <?php if($layout == 'col2-left-layout' || $layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-left col-md-3 col-sm-3">
                    <?php dynamic_sidebar('left-sidebar'); ?>
                </div>
            <?php } ?>

            <div class="col-main <?php echo esc_attr($classer) ?>">
                <ul class="list-blog <?php echo esc_attr($blog_view); ?> clearfix">
                    <?php if( $testimonial->have_posts()) : while( $testimonial->have_posts() ) : $testimonial->the_post(); ?>
                        <?php
                            $metaName       = get_post_meta(get_the_ID(), 'testimonial-name', true);
                            $metaCompany    = get_post_meta(get_the_ID(), 'testimonial-company', true);
                            $metaEmail      = get_post_meta(get_the_ID(), 'testimonial-email', true);
                            $metaWebsite    = get_post_meta(get_the_ID(), 'testimonial-website', true);
                            $metaRating     = get_post_meta(get_the_ID(), 'testimonial-rating', true);
                            $metaStatus     = get_post_meta(get_the_ID(), 'testimonial-status', true);
                            $width          = ($metaRating * 2) * 10;
                        ?>
                        <div class='item'>
                            <span class="date"><?php echo __('Date: ', 'aloexpert'); ?></span>
                            <span><?php echo get_the_date( "d M, Y", get_the_ID() )?></span>
                            <div class="customer"> <?php the_post_thumbnail('thumbnail') ?> </div>
                            <div class="name"> <?php echo $metaName ?> </div>
                            <div class="testimonial_text"> 
                                <p class="title-name"><?php the_title(); ?></p>
                                <p class="name"><?php $metaName; ?></p>
                            </div>
                            <span class="sub-text"><?php the_excerpt();  ?></span>
                            <div class="star-rating" title="<?php printf( esc_html__('Rated %s out of 5','aloexpert'), $metaRating) ?>">
                                <span style="width:<?php echo esc_attr($width) ?>%"><?php printf( esc_html__('<strong class="rating">%s</strong> out of 5','aloexpert'), $metaRating) ?></span>
                            </div>
                        </div>
                    <?php endwhile ?>
                </ul> <!-- list-blog -->
                
                <?php else: ?>
                    <?php get_template_part('content', 'none'); ?>
                <?php endif; ?>
            </div><!-- end col-main-->
            
            <?php if($layout == 'col2-right-layout' || $layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-right col-md-3 col-sm-3">
                    <?php dynamic_sidebar('right-sidebar'); ?>
                </div>
            <?php } ?>
        </div><!-- End #main-content -->
    </div><!-- end container -->    
</div><!--  End .content -->

<?php get_footer(); ?>
