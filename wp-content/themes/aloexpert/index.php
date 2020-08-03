<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 16:46:30
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php  
    $options        = magiccart_options();
    $blogHeader     = $options['blog_header_text'];
    $layout         = isset($options['default_layout']) ? $options['default_layout'] : 'col1-layout';
    $blog_view      = isset($options['blog_view']) ? $options['blog_view'] : 'list-view';
    $row            = '';
    $classer        = '';
    if(is_blog()){
        $layout         = $options['blog_layout'];
    }
    if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
    if($layout != 'col1-layout'){
        $row        = 'row';
        $classer    = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';

    }
?>
<?php  get_header(); ?>

<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
    <?php magiccart_breadcrumbs(); ?>
        <div id="main-content" class="<?php echo esc_attr($row) ?>">
            <?php if($layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-left sidebar-post mb__60 sidebar-left col-md-3 col-sm-3">
                    <div class="sidebar-content">
                        <?php
                            if(is_active_sidebar('left-sidebar')){
                                dynamic_sidebar('left-sidebar');
                            } else {
                                get_sidebar();
                            } 
                        ?>                        
                    </div>
                </div>
            <?php } ?>   
            <?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>
            <div class="<?php echo esc_attr($classer) ?> col-main mb__60">    
                <div class="title-page clearfix" >
            		<h2><?php echo $blogHeader; ?></h2>
                    <div class="hd-pagination" >
                		<?php magiccart_posts_pagination('default_page', '', ''); ?>
                	</div>
                </div>
            	
                <div class="list-blog <?php echo esc_attr($blog_view); ?> clearfix">
                    <?php if( have_posts()) : while( have_posts() ) : the_post(); ?>
                        <?php get_template_part('content', get_post_format()); ?>
                    <?php endwhile ?>
                    <?php else: ?>
                        <?php get_template_part('content', 'none'); ?>
                    <?php endif; ?>
                </div>

                <div class="hd-pagination last">
                	<?php magiccart_posts_pagination('default_page', '', ''); ?>
                </div>
            </div>
            <?php 
                $sidebar = '';
                if($layout == 'col3-layout' || $layout == 'col2-right-layout'){
                    $sidebar = 'right-sidebar';
                } elseif($layout == 'col2-left-layout')
                    $sidebar = 'left-sidebar';
                if($sidebar){
            ?>
                <div class="sidebar sidebar-post <?php echo $sidebar ?> mb__60 col-md-3 col-sm-3">
                    <div class="sidebar-content">
                        <?php
                            if(is_active_sidebar($sidebar)){
                                dynamic_sidebar($sidebar);
                            } else {
                                get_sidebar();
                            } 
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div><!-- End #main-content -->
    </div>
</div><!--  End .content -->

<?php get_footer(); ?>
