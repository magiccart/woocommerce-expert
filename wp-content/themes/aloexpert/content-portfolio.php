<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-15 15:16:07
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php 
if(get_the_ID() == "") return; 

if(is_front_page()){
	the_content();
} else {
	$options 	= magiccart_options();
	$header = $options['portfolio_header_text'];
	$layout 	= $options['portfolio_layout'];
	$view  = isset($options['portfolio_view']) ? $options['portfolio_view'] : 'list-view';
	$row 		= ($view == 'list-view') ? 'row' : '';
	$col 		= ($view == 'list-view') ? 'col-xs-12' : 'col-grid';
	$classImg 	= ($view == 'list-view') ? 'col-xs-12 col-sm-12 col-md-5' : '';
	$classExcerpt 	= ($view == 'list-view') ? 'col-xs-12 col-sm-12 col-md-7' : '';
?>
<li class="<?php echo esc_attr($row); ?> content-default">
	<div class="<?php echo esc_attr($col); ?>">
		<article id="post-<?php the_ID()?>"  <?php post_class('post')?> >
		    <div class="entry-header">
		    	
			        <h3 class="title-post">
			            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a> 
			        </h3>
		        
		        <?php if ( (! function_exists( 'is_cart' ) ||  !is_cart() ) && !is_page() ) { ?>
			        <ul class="post-info clearfix">
			        	<li>
			        		<a href="<?php the_permalink(); ?>">
			        			<span class="date"><?php echo __('Date: ', 'aloexpert'); ?></span>
			        			<span><?php echo get_the_date( "d M, Y", get_the_ID() )?></span>
			        		</a>
			        	</li>
			   <!--      	<li>
			        		<span class="cate"><?php echo __('Categories: ', 'aloexpert'); ?></span>
			        		<?php the_category(); ?>
			        	</li> -->
			        	<li>
			        		<?php echo __('By: ', 'aloexpert'); ?>
			        		<span><?php the_author(); ?></span>
			        	</li>
			        	<li>
			        		<?php echo __('Comment(s): ', 'aloexpert'); ?>
			        		<span><?php echo get_post()->comment_count; ?></span>
			        	</li>
			        	<li>
			        		<?php echo __('Viewed: ', 'aloexpert'); ?>
			        		<span><?php echo magiccart_get_post_views(get_the_ID()); ?></span>
			        	</li>
			        </ul>
			    <?php  } ?>
		     </div>
		    <div class="entry-content">
		    	<?php if( !has_post_thumbnail() ) $row = 'no-image';  ?>
				<div class="<?php echo esc_attr($row); ?>">
					<?php if(has_post_thumbnail()){ ?>
						<div class="<?php echo esc_attr($classImg); ?>"><div class="entry-thumb"><a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail()?></a></div></div>
					<?php } ?>
					<?php 
						if( !is_single() && !is_page() && has_excerpt( get_the_ID() ) ){
							echo '<div class="' . esc_attr($classExcerpt) .'">';
								the_excerpt();
							echo '</div>';
						}else{
							the_content();
						}
					?>
					<a class="read-more" href="<?php the_permalink();?>"><?php esc_html_e( 'Read more', 'aloexpert' );?></a>
					<?php (is_single() ? magiccart_entry_tag() : ''); ?>
				</div> <!-- end row -->
			</div>
		</article>
	</div>
</li>
<?php  } ?>
