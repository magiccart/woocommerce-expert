<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-06-21 18:19:03
 * @@Function:
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
global $alothemes;
global $themecfg;
?>
<header class="header">
	<div class="header-top">
        <div class="container">
            <div class="top-left">
				<p><?php  echo __('Default welcome msg!', 'aloexpert'); ?></p>
				<?php 
					$currency = $alothemes->create_object('Alothemes\Element\Block\Currency');
					if ( $currency ) {
						echo $currency->toHtml();
					}
				?>
				<?php 
					$language = $alothemes->create_object('Alothemes\Element\Block\Language');
					if ( $language ) {
						echo $language->toHtml();
					}
				?>
			</div>
			<div class="top-right">
	            <ul>
	            	<li><a href="#"><?php echo __('Order Tracking', 'aloexpert') ?></a></li>
					<li><a href="<?php echo esc_url( site_url('checkout') ); ?>"><?php echo __('Checkout', 'aloexpert') ?></a></li>
					<li><a href="#"><?php echo __('Store Localtion', 'aloexpert') ?></a></li>
					<li><a href="<?php echo esc_url( site_url('about-us') ); ?>"><?php echo __('About', 'aloexpert') ?></a></li>

				</ul>
			</div>
		</div>
    </div><!-- End .menu.header-top --> 
	<div class="header-content">
		<div class="container">
			<div class="row">
				<div class='site-logo col-sm-3 col-md-3 col-lg-3'>
				    <?php 
				    	$logo = $alothemes->create_object('Alothemes\Element\Block\Logo');
						if ( $logo ) echo $logo->toHtml();
				    ?>
      			</div>
				<div class="main-support col-sm-5 col-md-5 col-lg-5">
				    <div class="content-support">
				    	<div class="support support-phone">
				    		<span class="call-number call-text"><?php echo __('Call Us toll Free', 'aloexpert') ?></span>
				    		<span class="call-number call-phone"><?php echo __('(080)123 4567 891', 'aloexpert') ?></span>
				    	</div>
				    	<div class="support free-delivery">
				    		<span class="free-delivery-text free-delivery-text-bold"><?php echo __('Free Delivery', 'aloexpert') ?></span>
				    		<span class="free-delivery-text free-delivery-text-normal"><?php echo __('On Orders Over $99', 'aloexpert') ?></span>
				    	</div>
				    </div>
				</div>
				<div class="tool-setting col-sm-4 col-md-4 col-lg-4">
					<div class="tool-header">
						<?php 
							$account = $alothemes->create_object('Alothemes\Element\Block\Account');
							if ( $account ){
								echo $account->toHtml();
							}
						?>
						<?php 
							$wishlist = $alothemes->create_object('Alothemes\Element\Block\Wishlist');
							if ( $wishlist ){
								echo $wishlist->toHtml();
							}
						?>
						<?php 
							$minicart = $alothemes->create_object('Alothemes\Element\Block\Minicart');
							if ( $minicart ){
								echo $minicart->toHtml();
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-bottom header-sticker menu">
		<div class="container">
			   <div class="bottom-left">
			    <?php 
			    	$navigation = $alothemes->create_object('Alothemes\Element\Block\Navigation');
					if ( $navigation ) echo $navigation->setTemplate('navigation.phtml')->toHtml();
			    ?>
				<div id="mobileSidenav" class="sidenav menu-mobile">
					<a href="javascript:void(0)" class="closebtn">&times;</a>
					<div class="nav-mobile navigation-mobile clearfix">
						<?php  
							// wp_nav_menu(array(
							// 		'theme_location'    => 'mobile-menu',
							// 		'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>'
							// ));  
						?>
						<ul class="menu" >
							<?php global $navmobile; echo implode(' ', $navmobile); ?>
						</ul>
					</div>
				</div>
				<div class="nav-mobile-overlay-fixed"></div>
			</div>
			<div class="bottom-right search-area">
				<?php 
			    	$search = $alothemes->create_object('Alothemes\Element\Block\Search');
					if ( $search ) echo $search->toHtml();
			    ?>
			</div>
		</div>
	</div>
	<?php
  	if(is_home() || is_front_page()){ 
		$newsletter = $alothemes->create_object('Alothemes\Element\Block\Newsletter');
		 if ( $newsletter ) echo $newsletter->setTemplate('newsletterpopup_home6.phtml')->toHtml();
  	}
	?>
</header>