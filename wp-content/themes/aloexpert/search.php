<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-13 10:43:27
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php  get_header(); ?>
<?php 
    $options    = magiccart_options();
    $blogHeader = $options['blog_header_text'];
    $layout     = $options['blog_layout'];
    $blog_view  = isset($options['blog_view']) ? $options['blog_view'] : 'list-view';
    $classer    = '';
    $row        = '';

    if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
    if($layout != 'col1-layout'){
        $row        = 'row';
        $classer    = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
    }   
    get_search_query();
?>
<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
    <?php magiccart_breadcrumbs(); ?>
        <div class="post-content <?php echo esc_attr($row) ?>" >
              <!-- sidebar -->       
              <?php if($layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-left col-md-3 col-sm-3">
                     <?php get_sidebar('left'); ?>
                </div>
              <?php } ?>
              <?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>

            <div class="<?php echo esc_attr($classer) ?> col-main">
                <div class="title-page clearfix">
                    <h2><?php echo $blogHeader; ?></h2>
                    <div class="hd-pagination" >
                    <?php magiccart_posts_pagination('<div class="blog-next"></div>', '<div class="blog-prev"></div>'); ?>
                    </div>
                </div><!-- title-page -->
                
                <ul class="list-blog <?php echo esc_attr($blog_view); ?> clearfix">
                    <?php if( have_posts()) : while( have_posts() ) : the_post(); ?>
                        <?php get_template_part('content', "none"); ?>
                    <?php endwhile ?>
                </ul> <!-- list-blog -->
                
                <div class="hd-pagination last clearfix">
                    <?php magiccart_posts_pagination('<div class="blog-next"></div>', '<div class="blog-prev"></div>'); ?>
                </div>
                <?php else: ?>
                    <?php get_template_part('content', 'none'); ?>
                <?php endif; ?>
            </div><!-- end col-main-->
            
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
                    <?php get_sidebar($sidebar); ?>
                </div>
            <?php } ?>
        </div>
    </div><!-- end container -->    
</div><!--  End .content -->

<?php get_footer(); ?>
