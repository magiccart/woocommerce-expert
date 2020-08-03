<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 16:41:43
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php 
    $options 	= magiccart_options();
    if(is_portfolio()){
        $header_text = $options['portfolio_header_text'];
        $layout     = $options['portfolio_layout'];
        $mode_view  = isset($options['portfolio_view']) ? $options['portfolio_view'] : 'list-view';        
    } else {
        $header_text = $options['blog_header_text'];
        $layout     = $options['blog_layout'];
        $mode_view  = isset($options['blog_view']) ? $options['blog_view'] : 'list-view';         
    }

	$classer 	= '';
	$row        = '';

    if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
	if($layout != 'col1-layout'){
		$row        = 'row';
		$classer 	= ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
	}	
?>
<?php  get_header(); ?>
<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
    <?php magiccart_breadcrumbs(); ?>
        <div class="post-content <?php echo esc_attr($row) ?>" >
              <!-- sidebar -->       
              <?php if($layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-left col-md-3 col-sm-3">
                     <div class="sidebar-content"><?php get_sidebar('left'); ?></div>
                </div>
              <?php } ?>
              <?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>

            <div class="col-main mb__60 <?php echo esc_attr($classer) ?>">
            	<div class="title-page clearfix">
                    <h2 class="heading-top"><?php echo $header_text; //the_archive_title() ?></h2>
                    <div class="hd-pagination" >
                    <?php magiccart_posts_pagination('post-pagination'); ?>
                    </div>
                </div><!-- title-page -->
                
                <div class="list-blog <?php echo esc_attr($mode_view); ?> clearfix">
                    <?php if( have_posts()) : while( have_posts() ) : the_post(); ?>
                        <?php get_template_part('content', get_post_format()); ?>
                    <?php endwhile ?>
                    <?php else: ?>
                        <?php get_template_part('content', 'none'); ?>
                    <?php endif; ?>
                </div> <!-- list-blog -->
                
                <div class="hd-pagination last clearfix">
                    <?php magiccart_posts_pagination('post-pagination'); ?>
                </div>
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
                <div class="sidebar sidebar-post mb__60 sidebar-<?php echo esc_attr($sidebar) ?> col-md-3 col-sm-3">
                    <div class="sidebar-content"><?php get_sidebar($sidebar); ?></div>
                </div>
            <?php } ?>
        </div>
    </div><!-- end container -->    
</div><!--  End .content -->

<?php get_footer(); ?>
