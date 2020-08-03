<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-08-07 10:47:44
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
				<div class="support">
					<span class="fa fa-phone"><span class="hidden"><?php echo __('hidden', 'aloexpert') ?></span></span>
					<span class="number"><?php echo __('(080)123 4567 891', 'aloexpert') ?></span>
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
					<li><a href="#"><?php echo __('Register or Sign in', 'aloexpert') ?></a></li>
				</ul>
			</div>
		</div>
    </div><!-- End .menu.header-top --> 
	<div class="header-content header-sticker menu">
		<div class="container">
		<div class="header-position">
			<div class="row">
				<div class='site-logo col-sm-3 col-md-3 col-lg-3'>
				    <?php 
				    	$logo = $alothemes->create_object('Alothemes\Element\Block\Logo');
						if ( $logo ) echo $logo->toHtml();
				    ?>
      			</div>
				<div class="nav-top col-sm-12">
				    <?php 
			    	$navigation = $alothemes->create_object('Alothemes\Element\Block\Navigation');
					if ( $navigation ) echo $navigation->setTemplate('navigation.phtml')->toHtml();
			    	?>
				</div>
				<div class="tool-setting">
					<div class="tool-header">
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
	</div>
	<div class="header-bottom">
		<div class="container">
			<div class="row">
			    <div class="bottom-left col-md-3">
				    
			    	<?php 
				    	$navigation = $alothemes->create_object('Alothemes\Element\Block\Navigation');
						if ( $navigation ) echo $navigation->setTemplate('vnavigation.phtml')->toHtml();
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
				<div class="bottom-right search-area col-md-9">
					<?php 
				    	$search = $alothemes->create_object('Alothemes\Element\Block\Search');
						if ( $search ) echo $search->toHtml();
				    ?>
				    <ul class="custom-block-right">
				    	<li>
				    		<a href="#"><?php echo __('Special Offer!', 'aloexpert') ?></a>
				    	</li>
				    	<li>
				    		<a href="#"><?php echo __('Buy Theme!', 'aloexpert') ?></a>
				    	</li>
				    </ul>
				</div>
			</div>
		</div>
	</div>
	<?php
  	if(is_home() || is_front_page()){ 
		$newsletter = $alothemes->create_object('Alothemes\Element\Block\Newsletter');
		 if ( $newsletter ) echo $newsletter->setTemplate('newsletterpopup_home1.phtml')->toHtml();
  	}
	?>
</header>