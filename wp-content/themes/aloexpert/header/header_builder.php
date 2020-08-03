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
?>
<header>
	<?php
		$el_class = '';
		$content = '';
		$headerName = magiccart_options('header', false);
	    if($headerName && defined( 'WPB_VC_VERSION' )){
            $post_header = get_page_by_path( $headerName, OBJECT, 'header' );
            if($post_header){
            	$dir = $alothemes->get_theme_file('vc_templates/header');
            	vc_set_shortcodes_templates_dir( $dir );
            	// var_dump( vc_shortcodes_theme_templates_dir( 'vc_row.php' ) );
                $content = apply_filters('the_content', $post_header->post_content);
                // $content = do_shortcode($post_header->post_content, true);
                if(!isset($_GET['vc_editable'])){
                	$content = str_replace('vc_col', 'col', $content);
                }
                $el_class  	 = get_post_meta( $post_header->ID, 'el_class', true );
                wp_reset_postdata();
				$dir = get_stylesheet_directory() . '/vc_templates';	
				vc_set_shortcodes_templates_dir($dir);                
            }
        }
	?>
    <div class="header <?php echo esc_attr($el_class) ?>">
    	<div class="header-container header-wrap <?php echo $content ? '': 'header-default'; ?>">
		    <div id="header-content" class="container-none">
		    	<?php 
		    		if($content){
		    			echo $content;
		    		} else { 
						get_template_part('header_default');
				 	}
				?>
			</div>
		</div>	
    </div>
    <?php 
    	if(is_front_page()){
	    	$newsletterPopup = $alothemes->create_object('Magiccart\Composer\Block\Element\Newsletterpopup');
			if ( $newsletterPopup ) {
				echo $newsletterPopup->toHtml();
			}
    	}
    ?>
</header>
