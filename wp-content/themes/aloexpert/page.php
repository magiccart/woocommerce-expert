<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-17 11:19:43
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php   do_action( 'magiccart_page_before_template_part', __FILE__, '' ); ?>
<?php
    $options    = magiccart_options();
    $layout     = is_front_page() ? $options['home_layout'] : $options['default_layout'];
    $classer    = '';
    $row        = '';
    if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
    if($layout != 'col1-layout' && !is_front_page()){
        $row        = 'row';
        $classer    = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
    }
?>

<?php get_header(); ?>
<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
        <?php
            $breadcrumbs  = true;
            $page_title   = true;
            $page_comment = true;
            if (( is_front_page() && is_home()) || is_front_page() ) {
                $breadcrumbs = false;
                $page_title = false;
                $page_comment = false;
            }
            if($breadcrumbs){
                magiccart_breadcrumbs();
            }
        ?>
        <div class="page-content <?php echo esc_attr($row) ?>" >
            <!-- sidebar -->       
            <?php if($layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-left col-md-3 col-sm-3">
                    <div class="sidebar-content"><?php get_sidebar('left'); ?></div>
                </div>
            <?php } ?>
            <?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>

            <div class="col-main <?php echo esc_attr($classer) ?>">
                <?php if( have_posts()) : while( have_posts() ) : the_post(); ?>
                    <?php if($page_title){ ?>
                    <div class="entry-header">
                        <h1 class="entry-title"><?php the_title() ?></h1> 
                    </div>
                    <?php } ?>
                    <?php get_template_part('content', get_post_format()); ?>
                    <?php
                        if($page_comment){
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) {
                                comments_template();
                            } 
                        }
                    ?>
                <?php endwhile ?>
                <?php else: ?>
                    <?php get_template_part('content', 'none'); ?>
                    <?php //the_content(); ?>
                <?php endif; ?>
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
                <div class="sidebar sidebar-<?php echo esc_attr($sidebar) ?> col-md-3 col-sm-3">
                    <div class="sidebar-content"><?php get_sidebar($sidebar); ?></div>
                </div>
            <?php } ?>
        </div><!-- End .page-content -->    
    </div><!--  End .container -->
</div><!--  End .content -->

<?php get_footer(); ?>

<?php   do_action( 'magiccart_page_after_template_part', __FILE__ ); ?>
