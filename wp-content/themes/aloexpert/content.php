<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-07 14:34:57
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
if(!get_the_ID()) return;
if( !is_blog() && !is_category() && !is_search() && !is_portfolio() ){
	the_content();
} else if(is_portfolio()){
	get_template_part('content-portfolio');
} else {
	$options 	= magiccart_options();
	$blogHeader = $options['blog_header_text'];
	$layout 	= $options['blog_layout'];
	$blog_view  = isset($options['blog_view']) ? $options['blog_view'] : 'list-view';
	$row 		= ($blog_view == 'list-view') ? 'row' : '';
	$col 		= ($blog_view == 'list-view') ? 'col-xs-12' : 'col-grid';
?>
<article class="<?php echo esc_attr($row); ?> content-default">
	<div class="<?php echo esc_attr($col); ?>">
		<div id="post-<?php the_ID()?>"  <?php post_class('post')?> >
		    <div class="entry-content">
				<div class="post-main">
					<?php if(has_post_thumbnail()){ ?>
						<div class="post-item-photo"><div class="entry-thumb"><a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail()?></a></div></div>
					<?php } ?>
					<div class="post-item-detail">
						 <div class="entry-header">
		        <h3 class="title-post">
		            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		            	<?php the_title();?>
		            	<?php echo (is_sticky()) ? '<i class="fa fa-thumb-tack"></i>':''?>
		            </a> 
		        </h3>
		        
		        <?php if ( (! function_exists( 'is_cart' ) ||  !is_cart() ) && !is_page() ) { ?>
		            <div class="post-info post-meta clearfix">
		            	<span class="meta-author">
		        			<i class="fa fa-user"></i>
		        			<?php echo __('By:', 'aloexpert') ?>
		        			<?php the_author_posts_link() ?>
		        		</span>
	        			<span class="meta-date">
	        				<i class="fa fa-calendar"></i>
		        			<a href="<?php the_permalink(); ?>">
		        				<?php echo get_the_date( "l, M d, Y", get_the_ID() )?></a>
	        			</span>
		        		<span class="meta-cats">
			        		<i class="fa fa-folder-open"></i>
			        		<?php echo __('In:', 'aloexpert') ?>
			        		<?php the_category(',') ?>
		        		</span>
		        		<span class="meta-comments">
		        			<i class="fa fa-comments"></i>
		        			<a href="<?php comments_link(); ?>"><?php echo get_post()->comment_count; ?> <?php echo __('Comment(s) ', 'aloexpert'); ?></a>
		        		</span>
			        </div>
			    <?php  } ?>
		    </div>
						<?php 
							if( !is_single() && !is_page() && has_excerpt( get_the_ID() ) ){
								echo "<div class='post-excerpt'>";
									the_excerpt();
								echo "</div>";
							}else{
								echo "<div class='post-desc'>";
								the_content();
								echo "</div>";
							}
							
		                    wp_link_pages( array(
		                        'before'      => '<div class="nav-links page-numbers"><span class="page-links-title">' . esc_attr__( 'Pages:', 'aloexpert' ) . '</span>',
		                        'after'       => '</div>',
		                        'link_before' => '<span class="number">',
		                        'link_after'  => '</span>',
		                        'pagelink'    => '%',
		                        'separator'   => '',
		                    ) );
		                ?>
						<div class="post-action"><a class="read-more" href="<?php the_permalink();?>"><?php esc_html_e( 'Read more', 'aloexpert' );?></a></div>
					</div>
					<?php (is_single() ? magiccart_entry_tag() : ''); ?>
				</div> 
			</div>
		</div>
	</div>
</article>
<?php  } ?>
