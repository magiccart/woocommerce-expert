<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 11:39:15
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php 
	$options 	= magiccart_options();
	$layout 	= $options['blog_layout'];
	$blog_view  = isset($options['blog_view']) ? $options['blog_view'] : 'list-view';
	$classer 	= '';
	$row        = '';
	if(is_single()){
        $layout         = $options['single_blog_layout'];
        if(is_portfolio()) $layout = $options['portfolio_layout'];
    }
    if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
	if($layout != 'col1-layout'){
		$row        = 'row';
		$classer 	= ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
	}
?>
<?php get_header(); ?>

<div class="content <?php echo esc_attr($layout); ?>">
	<div class="container">
		<?php magiccart_breadcrumbs(); ?>
	    <div class="single-content <?php echo esc_attr($row) ?>" >
	    	<!-- sidebar -->       
	      	<?php if($layout == 'col3-layout'){ ?>
	        	<div class="sidebar sidebar-left col-md-3 col-sm-3">
	        		<div class="sidebar-content"><?php get_sidebar('left'); ?></div>
	        	</div>
	      	<?php } ?>
	      	<?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>
	      	
			<div id="single-page" class="col-main mb__60 post-detail <?php echo esc_attr($classer) ?>">
		        <?php 
		        	if( have_posts()) {
		        		$post_type = get_post_type();
		        		if($post_type != 'testimonial' && $post_type != 'portfolio' ){
			        		while( have_posts() ) : the_post(); 
			        			magiccart_set_post_views(get_the_ID()); 
					             //get_template_part('content', get_post_format()); 
					            get_template_part('content', 'single'); 
			                    // If comments are open or we have at least one comment, load up the comment template.
			                    if ( comments_open() || get_comments_number() ) :
			                        comments_template();
			                    endif;
					        endwhile;
					    } else {
					       	while( have_posts() ) : the_post(); 
			        			magiccart_set_post_views(get_the_ID()); 
					            get_template_part('content', "$post_type-single"); 
						   	endwhile;
			       		}
		    		}else{ 
	            		get_template_part('content', 'none'); 
		        	}

		        ?>    
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
	    </div><!-- End .single-content -->
    </div> <!-- End .container -->
</div><!--  End .content -->
<?php get_footer(); ?>
