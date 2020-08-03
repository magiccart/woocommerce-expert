<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-01-03 12:59:00
 * @@Modify Date: 2018-03-13 20:21:31
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php

if(get_the_ID() == "") return; 
$post_id = get_the_ID();
$portfolio_tags = get_the_terms( $post_id, 'portfolio_tag' );
$tag_ids = array();
if($portfolio_tags) {
	foreach( $portfolio_tags as $tag ) {
	    $tag_ids[] = $tag->term_id;
	}				
}
$limit = magiccart_options('portfolio_related_limit');
if(!$limit) $limit = 12;
$args = array(
	'post_type' => 'portfolio',
	'tax_query' => array( 
	                array( 
	                	'taxonomy' => 'portfolio_tag', 
	                    'field' => 'id',
	                    'terms' => $tag_ids
	                )
	            ),
	'post__not_in'     => array( $post_id ),
	'posts_per_page'   => $limit,
);
$portfolio_related = new WP_Query( $args );

if ( ! $portfolio_related->have_posts() ) return;
$config = magiccart_options('portfolio_related');
$visible = isset($config['slides-to-show']) ? 'visible-' . $config['slides-to-show'] : '';
$settings = magiccart_settings_slider($config);
?>
<div class="related-project">
	<div class="box-portfolio <?php echo esc_attr($visible); ?>">
		<div class="alo-content-<?php echo rand(0,9999999); ?> magicproduct autoplay">
			<div class="block-portfolio auto-height">
			<span class="toggle-tab mobile" style="display:none"><i class="fa fa-bars"></i></span>
			<div class="block-title-tabs clearfix toggle-content">
				<ul class="magictabs">
					<?php 
						echo '<li class="item loaded activated" data-type="'.esc_attr($post_id).'"><span class="title">' . __('Related Project', 'aloexpert')  . '</span></li>';           
						?>
				</ul>
			</div>
			<div class="block-content clearfix">
				<!--   <div class="row"> -->
				<div class="content-products content-portfolio" <?php foreach($settings as $key => $value){?>
					data-<?php echo esc_attr($key); ?>='<?php echo esc_attr($value) ?>'
					<?php } ?> >
					<div class="mage-magictabs mc-<?php echo esc_attr($post_id);?>">
						<div class="products products-grid">
							<ol class="products items clearfix" >
								<?php
									while($portfolio_related->have_posts()): $portfolio_related->the_post();
									?>
								<li class='item type-product item-portfolio'>
									<div class="box-content-port">
										<div class="port-thumb"><a href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>"> <?php the_post_thumbnail()?></a></div>
										<div class="links-wrapper">
											<div class="links">
												<div class="caption">
													<div class="port-title"> <?php the_title()?> </div>
													<div class="sub-text description"> <?php the_excerpt(); ?> </div>
												</div>
												<div class="portfolio-icons">
													<a href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>" target="_self" class="icon self-link "><span class=hide>hidden</span></a>
													<?php echo get_simple_likes_button( get_the_ID() ); ?>
												</div>
											</div>
										</div>
									</div>
								</li>
								<?php endwhile;   ?>
							</ol>
						</div>
					</div>
				</div>
				<!--  </div> end row -->
			</div>
			<!-- end block-content -->
		</div>
	</div>
</div>
