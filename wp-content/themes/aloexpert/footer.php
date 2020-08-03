<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-06-14 13:50:40
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
</div><!-- #page -->
<?php do_action( 'magiccart_before_footer' ); ?>
<?php
    $el_class = '';
    $content = '';
    $footerName = magiccart_options('footer', false);
    if($footerName && defined( 'WPB_VC_VERSION' )){
        $post_footer = get_page_by_path( $footerName, OBJECT, 'footer' );
        if($post_footer){
            $content = apply_filters('the_content', $post_footer->post_content);
            // $content = do_shortcode($post_footer->post_content);
            if(!isset($_GET['vc_editable'])){
                $content = str_replace('vc_col', 'col', $content);
            }
            $el_class    = get_post_meta( $post_footer->ID, 'el_class', true );
            wp_reset_postdata();             
        }
    }
?>  
<footer id="colophon" class="site-footer footer <?php echo $el_class ?>">
    <div class="footer-container <?php echo $content ? '' : 'footer-default' ?>">
            <?php do_action( 'magiccart_footer' ); ?>        
            <div class="container">
                <?php 
                    if($content){
                        echo $content;
                    } else { ?>
                    <div class="site-info">
                        <div>
                            <ul class="footer-menu-bottom">
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Customer Service</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Site Map</a></li>
                            <li><a href="#">Search Terms</a></li>
                            <li><a href="#">Us</a></li>
                            </ul>
                        </div>
                        <div id="footer-copyright" class=" footer-copyright">
                                <div class="license copy-right">
                                    <address><?php echo __( 'Copyright &#169 2018', 'aloexpert' ) ?>
                                         <a class="active" href="<?php echo esc_url( home_url( '/' ) ); ?>">Alothemes</a> template. All rights reserved
                                    </address>
                                </div>
                        </div>

                    </div><!-- .site-info -->
                <?php } ?>
            </div>     
    </div><!-- .footer-container -->
    <a id="toTop"><i class="fa fa-angle-up"></i></a>
</footer><!-- #colophon -->

<?php do_action( 'magiccart_after_footer' ); ?>
</div> <!--  End page-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
