<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-04-13 23:22:30
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
?>
<div class="item-blog">
		<article id="post-<?php the_ID()?>"  <?php post_class('post single-post')?> >
		   
		    <div class="entry-content">
				<?php if(has_post_thumbnail()){ ?>
					<div class="post-item-photo"><?php the_post_thumbnail()?></div>
				<?php } ?>
				<div class="post-item-detail">
					<div class="entry-header">
			            <h3 class="title-post"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
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
							if(!is_single() && !is_page()){
								echo "<div class='post-excerpt'>";
									the_excerpt();
								echo "</div>";
							}else{
								echo "<div class='post-desc'>";
								the_content();
								echo "</div>";
							}
						?>
						<?php (is_single() ? magiccart_entry_tag() : ''); ?>
				</div>
                <?php
                    wp_link_pages( array(
                        'before'      => '<div class="nav-links page-numbers"><span class="page-links-title">' . esc_attr__( 'Pages:', 'aloexpert' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span class="number">',
                        'link_after'  => '</span>',
                        'pagelink'    => '%',
                        'separator'   => '',
                    ) );
                ?>
				
			</div>
		</article>
</div>
<?php  } ?>
