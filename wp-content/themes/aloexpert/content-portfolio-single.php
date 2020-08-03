<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-13 21:34:56
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
$post_id = get_the_ID();
if(!$post_id) return; 
$metaSkillNeeded = get_post_meta($post_id, 'portfolio-skill-needed', true);
$metaUrl = get_post_meta($post_id, 'portfolio-url', true);
$metaCopyright = get_post_meta($post_id, 'portfolio-copyright', true);
$categories = get_the_terms($post_id, "portfolio_category");
?>
<article id="post-<?php the_ID()?>"  <?php post_class('post single-post')?> >
    <div class="entry-header">
    	<div class="post-title">
            <h1 class=title-port><?php the_title();?></h1>
        </div>
     </div>
    <div class="entry-content">
    	<div class="port-portfolio">
			<?php if(has_post_thumbnail()){ ?>
				<div class="entry-thumb"><?php the_post_thumbnail()?></div>
			<?php } ?>
			<div class="portfolio-content">
				<div class="description">
					<h3 class="title-desc"><?php echo __('Project description', 'aloexpert'); ?></h3>
					<div><?php the_content(); ?></div>
				</div>
				<div class="detail">
					<h3 class="title-pro"><?php echo __('Project Details', 'aloexpert'); ?></h3>
					<?php 
						if($metaSkillNeeded){
							echo '<span class="skill_needed_wrapper">'. __("Skill needed:", 'aloexpert') 
									.'<span class="skill_needed">'. $metaSkillNeeded .'</span>
								</span>';
						} 
						if($categories){
							echo '<span class="category_wrapper">'. __("Category:", 'aloexpert');
							foreach ($categories as $cat) {
								echo '<a class="category" href="' . esc_url( get_term_link( (int) $cat->term_id, 'portfolio_category' ) ) . '">'. $cat->name .'</a>';
							}
							echo '</span>';
						} 
						if($metaUrl){
							echo '<span class="url_wrapper">'. __("URL:", 'aloexpert') 
									.'<span class="url">'. $metaUrl .'</span>
								</span>';
						} 
						if($metaCopyright){
							echo '<span class="copyright_wrapper">'. __("Copyright:", 'aloexpert') 
									.'<span class="copyright">'. $metaCopyright .'</span>
								</span>';
						} 
					?>
						<span class="date_wrapper"><?php echo __("Date:", 'aloexpert')  ?>
							<span class="date"> <?php the_date("j,F Y") ?></span>
						</span>

				<!-- ==================== START SOCIAL SHARE ===================== -->
				<div class="addit">
			         <div class="alo-social-links clearfix">
			            <div class="so-facebook so-social-share">
			                <div id="fb-root"></div>
			                <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="20" data-show-faces="false"></div>
			            </div>
			            <div class="so-twitter so-social-share">
			                <a href="//twitter.com/share" class="twitter-share-button" data-count="horizontal" data-dnt="true">Tweet</a>
			            </div>
			            <div class="so-plusone so-social-share">
			                <div class="g-plusone" data-size="medium" data-width="20px"></div>
			                <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
			            </div>
			            <?php echo get_simple_likes_button( get_the_ID() ); ?>
			        </div>
			    </div>
		    	<script type="text/javascript">
		    		(function(d, s, id) {
					    var js, fjs = d.getElementsByTagName(s)[0];
					    if (d.getElementById(id)) return;
					    js = d.createElement(s);
					    js.id = id;
					    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=115245961994281";
					    fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));
					!function(d,s,id){
					    var js,fjs=d.getElementsByTagName(s)[0];
					    if(!d.getElementById(id)){
					        js=d.createElement(s);
					        js.id=id;
					        js.src="//platform.twitter.com/widgets.js";
					        fjs.parentNode.insertBefore(js,fjs);
					    }
					}(document,"script","twitter-wjs");
		    	</script>
		    	<!-- ==================== END SOCIAL SHARE ===================== -->
		    	
				</div>
			</div>
			</div>
			<?php get_template_part('content-portfolio-related');?>
	</div>
</article>
