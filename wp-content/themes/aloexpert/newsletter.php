<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-03-14 20:08:26
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="tnp tnp-widget-minimal">
    <form action="<?php echo esc_attr( home_url('/') ) . '?na=s';  ?>" method="post" id="newsletter-validate-detail">
            <div class="block-title"><span class="title"><?php echo __('Newsletter: ', 'aloexpert'); ?></span></div>
            <div class=form-subscribe clearfix>
	            <div class="input-box">
	                <input type="hidden" name="nr" value="widget-minimal"/>
	                <input type="email" required name="ne" id="newsletter" value="" title="<?php echo esc_attr__('Sign up for our newsletter', 'aloexpert') ?>" placeholder="<?php echo esc_attr__('Your email', 'aloexpert') ?>" class="tnp-email">
	            </div>
	            <div class="actions">
					<button type="submit" title="<?php echo esc_attr__('Subscribe', 'aloexpert'); ?>" class="tnp-submit"><span><?php echo __('Subscribe', 'aloexpert'); ?></span></button>
	         	</div>
         	</div>
    </form>
</div>
