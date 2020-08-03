<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-06-07 10:44:37
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
	$options 			= magiccart_options();
	$widthPopup 		= isset($options['popup-maxwidth']) ? $options['popup-maxwidth'] : 400;
	$heightPopup 		= isset($options['popup-maxheight']) ? $options['popup-maxheight'] : 300;
	$popupBackground 	= isset($options['popup-background']['url']) ? $options['popup-background']['url'] : '';
?>
<?php  if($options['popup-action'] && is_front_page()) {  ?>
	<ul id="inline-popups" data-popup-cookie="<?php echo esc_attr( $options['popup-cookie'] ) ?>" data-popup-delay="<?php echo esc_attr($options['popup-delay']) ?>">
		<li><a href="#newsletter-popup" data-effect="mfp-3d-unfold">3d unfold Popup</a></li>
	</ul>
	<div id="newsletter-popup" style="max-width: <?php echo esc_attr($widthPopup); ?>px;
							  max-height: <?php echo esc_attr($heightPopup); ?>px;
							  background-image: url(<?php echo esc_attr($popupBackground); ?>);" class="newsletter-popup mfp-with-anim mfp-hide">
		<?php if(isset($options['popup-content']) && $options['popup-content'] != "") { ?>
			<div class="popup-content">
				<?php print_r($options['popup-content']); ?>
			</div>
		<?php } ?>
		<div class="popup-newsleter">
			<h2 class="newsleter-title"><?php echo __("Enter your email below and
			get your voucher", 'aloexpert'); ?></h2>
	        <div class="tnp tnp-widget-minimal">
			    <form action="<?php echo esc_attr(home_url('/')) . '?na=s';  ?>" method="post" id="newsletter-validate-detail">

		            <div class="block-title"><span class="title"><?php echo __("Newsletter", 'aloexpert'); ?>: </span></div>
		            <div class="form-subscribe clearfix">
			            <div class="input-box">
			                <input type="hidden" name="nr" value="widget-minimal"/>
			                <input type="email" required name="ne" id="newsletter" value="" title="<?php echo esc_attr__('Sign up for our newsletter', 'aloexpert'); ?>" placeholder="<?php echo esc_attr__('Your email', 'aloexpert'); ?>" class="tnp-email">
			            </div>
			            <p><?php echo __("Subscribing to newsletter indicates your consent to our Privacy Policy", 'aloexpert'); ?></p>
			            <div class="action">
			            	<button type="submit" title="<?php echo esc_attr__("Subscribe", 'aloexpert'); ?>" class="tnp-submit"><span><?php echo __("Get my discount now", 'aloexpert'); ?></span></button>
			            </div>
	            	</div>
			    </form>
			</div>
	    </div>
	    <div class="social-checkbox clearfix">
		    <div class="socials block-social">
		    	<div class="block-title"><?php echo __("Or connect with", 'aloexpert'); ?>:</div>
		    	<div class="icon-share">
					<a href="#" class="social-link">
						<span class="fa fa-facebook">
							<span class="hidden">hidden</span>
						</span>
					</a>
					<a href="#" class="social-link">
						<span class="fa fa-twitter">
							<span class="hidden">hidden</span>
						</span>
					</a>
					<a href="#" class="social-link">
						<span class="fa fa-pinterest">
							<span class="hidden">hidden</span>
						</span>
					</a>
					<a href="#" class="social-link">
						<span class="fa fa-youtube-play">
							<span class="hidden">hidden</span>
						</span>
					</a>
					<a href="#" class="social-link">
						<span class="fa fa-instagram">
							<span class="hidden">hidden</span>
						</span>
					</a>
		    	</div>
		    </div>
		    <div class="checkbox btn-checkbox">
		    	<label>
                    <input class="disabled_popup_by_user" value="disabled_popup" type="checkbox">
                    <span><?php echo __("Dont show this popup again", 'aloexpert'); ?></span>
                </label>
		    </div>
	    </div>
	</div>
<?php } ?>
