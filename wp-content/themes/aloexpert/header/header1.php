<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-08-07 10:46:02
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
	<div id="header-offer" class="top-banner" style="background-image: url(<?php echo $alothemes->get_theme_url('images/promotion.jpg') ?>);">
	  	<div class="bg-overlay"><span class="hidden">overlay</span></div>
	  	<a href="#" class="add-link add-link-promotion"><span class="hidden">hidden</span></a>
	  	<div class="full-width">
			<div class="container-offer">
			  	<div class="promotion-offer">
					<span class="header-offer-close"><i class="fa fa-times"><span class="hidden">header-offer-close</span></i></span>
			  	</div>
			</div>
	  	</div>
	</div>
	<div class="header-top">
		<div class="container">
			<div class="top-left">
				<p><?php  echo __('Default welcome msg!', 'aloexpert'); ?></p>
				<div class="support">
					<span class="fa fa-phone"><span class="hidden">hidden</span></span>
					<span class="number"><?php  echo __('(080)123 4567 891', 'aloexpert'); ?></span>
				</div>
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
	</div>
	<div class="header-content">
		<div class="container">
			<div class="row">
				<div class='site-logo col-sm-3 col-md-3 col-lg-3'>
					<?php 
						$logo = $alothemes->create_object('Alothemes\Element\Block\Logo');
						if ( $logo ) {
							echo $logo->toHtml();
						}
					?>
	  			</div>
				<div class="search-area col-sm-5 col-md-5 col-lg-5">
					<?php 
						$search = $alothemes->create_object('Alothemes\Element\Block\Search');
						if ( $search ){
							echo $search->toHtml();
						}
					?>
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
			<?php 
				$navigation = $alothemes->create_object('Alothemes\Element\Block\Navigation');
				if ( $navigation ) echo $navigation->setTemplate('aio-navigation.phtml')->toHtml();
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
	</div><!-- End .menu.header-bottom --> 
	<?php
  	if(is_home() || is_front_page()){ 
		$newsletter = $alothemes->create_object('Alothemes\Element\Block\Newsletter');
		 if ( $newsletter ) echo $newsletter->setTemplate('newsletterpopup_home1.phtml')->toHtml();
  	}
	?>
</header>
