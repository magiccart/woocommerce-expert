<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-05-17 17:47:14
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
global $alothemes;
global $themecfg;
if(isset($_GET['taxonomy']) && isset($_GET['term'])){
	$type 	= substr($_GET['taxonomy'], 3);
	$data = "?filter_" . $type . "=" . sanitize_term($_GET['term']);
	wp_safe_redirect( get_permalink( woocommerce_get_page_id( 'shop' ) ) . $data );
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmgp.org/xfn/11" />
    <link rel="pingback" href="<?php esc_url( bloginfo('pingback_url') ); ?>" />
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div class="preloading"><div class="loading"></div></div>
<div class="page-wrapper">
	<?php
		$header = magiccart_options('header', false);
		$header = basename($header, '.php');
		$header = $header ? "header/$header" : 'header/header1';
		get_template_part($header);
	?>
	<div id="container-main">