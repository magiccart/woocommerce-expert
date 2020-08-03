<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 11:41:16
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
<?php get_header(); ?>
<div class="content <?php echo esc_attr($layout); ?>">
	 <div class="container">
		<?php magiccart_breadcrumbs(); ?>
			<div id="main-content">
				<div class="author-box">
					<?php get_template_part('author-bio'); ?>
				</div>
				<?php if( have_posts()) : while( have_posts() ) : the_post(); ?>
					<?php get_template_part('content', get_post_format()); ?>
				<?php endwhile ?>
				<?php magiccart_pagination(); ?>
				<?php else: ?>
					<?php get_template_part('content', 'none'); ?>
				<?php endif; ?>
			</div><!-- End #main-content -->
		<div id="sidebar" class="sidebar">
			<div class="sidebar-content"><?php get_sidebar(); ?></div>
		</div>
	</div>
</div><!--  End .content -->
<?php get_footer(); ?>

