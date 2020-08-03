
<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:47:35
 * @@Modify Date: 2018-03-13 10:29:01
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php

$messager 	= "";
$name 		= '';
$email 		= '';
$text 		= '';
$rating 	= 0;
$website 	= '';
$company 	= '';
if(count($_POST) > 0){
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['text']) && isset($_POST['rating']) && trim($_POST['name']) != '' && trim($_POST['email']) != '' && trim($_POST['text']) != ''  ){
		$my_post = array(
		  'post_title'    => wp_strip_all_tags( $_POST['name'] ),
		  'post_content'  => sanitize_textarea_field($_POST['text']),
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_type' => 'testimonial',
		);
		
		add_action( 'save_post', 'magiccart_save_testimonial', 10, 3 );
		function magiccart_save_testimonial($post_id, $post, $update  ){
			if(isset($_FILES['image'])){
			 	if ( ! function_exists( 'wp_handle_upload' ) ) {
				    //require_once( ABSPATH . 'wp-admin/includes/file.php' );
				    get_template_part( ABSPATH . 'wp-admin/includes/file.php' );
				}
				$uploadedfile = $_FILES['image'];
				$upload_overrides = array( 'test_form' => false );

				$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
				$getImageFile = $movefile['url'];
				magiccart_upload_featured_image($getImageFile, $post_id);
			}

			if(isset($_POST['name'])){
				update_post_meta( $post_id, 'testimonial-name', sanitize_title( $_POST['name']) );
			}
			if(isset($_POST['company'])){
				update_post_meta( $post_id, 'testimonial-company', sanitize_text_field( $_POST['company']) );
			}
			if(isset($_POST['email'])){
				update_post_meta( $post_id, 'testimonial-email', sanitize_email( $_POST['email']) );
			}
			if(isset($_POST['rating'])){
				update_post_meta( $post_id, 'testimonial-rating', sanitize_key($_POST['rating']) );
			}
			if(isset($_POST['website'])){
				update_post_meta( $post_id, 'testimonial-website', sanitize_text_field($_POST['website']) );
			}
		}
		wp_insert_post( $my_post );
		$messager 	= "<div class='message error woocommerce-message'>" . __('Your review has been added!', 'aloexpert') . "</div>";
	}else{
		$messager 	= "<div class='message error woocommerce-error'>" . __('Please enter full data!', 'aloexpert') . "</div>";
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$text 		= $_POST['text'];
		$rating 	= isset($_POST['rating']) ? sanitize_key($_POST['rating']) : 0;
		$website 	= $_POST['website'];
		$company 	= $_POST['company'];
	}
}	 

if(is_front_page()){
	the_content();
} else {
?>
<div class="testimonial">
	<div>
		<article id="post-<?php the_ID()?>"  <?php post_class('post')?> >
		    <div class="entry-header">
		    	<div class="post-title">
		            <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a> </h1>
		        </div>
		        <?php if(!is_cart() && !is_page()) { ?>
			        <ul class="post-info clearfix">
			        	<li>
			        		<span class="date"><?php echo __('Date: ', 'aloexpert'); ?></span>
			        		<span><?php echo get_the_date( "d M, Y", get_the_ID() )?></span>
			        	</li>
			        </ul>
			    <?php  } ?>
		     </div>
		    <div class="entry-content">
				<div>
					<?php if(has_post_thumbnail()){ ?>
						<div class="entry-thumb"><a href="<?php echo the_permalink(); ?>"><?php the_post_thumbnail()?></a></div>
					<?php } ?>
					<?php 
						echo "<div class='content-testimonial'";
							the_content();
						echo "</div>";
					?>
					<?php (is_single() ? magiccart_entry_tag() : ''); ?>
				</div> 
			</div>
		</article>
	</div>
</div>

<div class="your-testimonial">
    <h2><?php echo __('Your review', 'aloexpert') ?></h2>
    <?php echo $messager; ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="fieldset"> 
        	<label for="name"><?php echo __('Contact Name', 'aloexpert') ?><span class="required">*</span></label>
        		<div class="input-box"> 
        			<input type="text" class=" input-text required-entry" value="<?php echo esc_attr($name); ?>" name="name" id="name">
				</div> 
			<label for="company"><?php echo __('Company', 'aloexpert') ?></label>
				<div class="input-box"> 
					<input type="text" class=" input-text" value="<?php echo esc_attr($company); ?>" name="company" id="company">
				</div> 
			<label for="email"><?php echo __('Email', 'aloexpert') ?><span class="required">*</span></label>
				<div class="input-box"> 
					<input type="text" class=" validate-email input-text required-entry" value="<?php echo esc_attr($email); ?>" name="email" id="email">
				</div> 
			<label for="website"><?php echo __('Your website', 'aloexpert') ?></label>
				<div class="input-box"> 
					<input type="text" class="validate-clean-url input-text" value="<?php echo esc_attr($website); ?>" name="website" id="website">
				</div> 
			<label for="image"><?php echo __('Image', 'aloexpert') ?></label>
				<div class="input-box"> 
					<input type="file" class="input-file" name="image" id="image">
				</div>
			<label for="detailed_rating" class="rating"> <?php echo __('Rating', 'aloexpert') ?><span class="required">*</span></label>
				<?php
				    for($i = 1; $i < 6; $i++){
				    	if($rating == $i){
			                echo '<input id="mc-rating" checked="checked" name="rating" type="radio" value="' . esc_attr($i) . '" /><b>' . "$i " . __('Star(s)', 'aloexpert') . '</b>&nbsp;&nbsp;&nbsp;';
			                continue;
			            }
			            echo '<input id="mc-rating" name="rating" type="radio" value="'esc_attr($i) . '" /><b>' . "$i " . __('Star(s)', 'aloexpert') . '</b>&nbsp;&nbsp;&nbsp;';
			        }
				?>	
			<label for="text"><?php echo __('Text', 'aloexpert') ?><span class="required">*</span></label>
				<div class="input-box"> 
					<textarea class=" required-entry textarea" cols="15" rows="2" title="<?php echo esc_attr__('Text', 'aloexpert') ?>" name="text" id="text"><?php echo $text; ?></textarea>
				</div>
			<div class="buttons-set"> 
				<button class="button" title="<?php echo esc_attr__('Submit', 'aloexpert') ?>" type="submit">
					<span><span><?php echo __('Submit', 'aloexpert') ?></span></span>
				</button>
			</div>
		</div>
    </form>
</div>
<?php  } ?>
