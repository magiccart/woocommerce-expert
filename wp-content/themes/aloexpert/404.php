<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-15 21:01:50
 * @@Modify Date: 2018-06-11 15:45:52
 * @@Function:
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
    $options        = magiccart_options();
    $layout         = $options['default_layout'];
    $classer    = '';
    $row        = '';
    if(isset($_GET['layout'])) $layout = $_GET['layout']; //  LAYOUT DEMO
    if($layout != 'col1-layout'){
        $row        = 'row';
        $classer    = ($layout == 'col3-layout') ? 'col-md-6 col-sm-6' : 'col-md-9 col-sm-9';
    }
?>

<?php get_header(); ?>
<div class="content <?php echo esc_attr($layout); ?>">
    <div class="container">
        <?php magiccart_breadcrumbs(); ?>
        <div class="page-content <?php echo esc_attr($row) ?>" >
            <!-- sidebar -->       
            <?php if($layout == 'col3-layout'){ ?>
                <div class="sidebar sidebar-left col-md-3 col-sm-3">
                    <div class="sidebar-content"><?php get_sidebar('left'); ?></div>
                </div>
            <?php } ?>
            <?php $classer .= $layout == 'col2-left-layout' ? ' f-right' : ''; ?>
            
            <div class="col-main <?php echo esc_attr($classer) ?>">
                <?php 
		            _e("<h2>OOPS! THAT PAGE CAN'T BE FOUND. </h2>", 'aloexpert');
		           
		            _e('<p>It looks like nothing was found at this location. Maybe try a search?</p>', 'aloexpert');
		            get_search_form();
		        ?>
            </div>
            <!-- sidebar -->        
            <?php 
                $sidebar = '';
                if($layout == 'col3-layout' || $layout == 'col2-right-layout'){
                    $sidebar = 'right';
                } elseif($layout == 'col2-left-layout')
                    $sidebar = 'left';
                if($sidebar){
            ?>
                <div class="sidebar sidebar-<?php echo esc_attr($sidebar) ?> col-md-3 col-sm-3">
                    <div class="sidebar-content"><?php get_sidebar($sidebar); ?></div>
                </div>
            <?php } ?>
        </div><!-- End .page-content -->    
    </div><!--  End .container -->
</div><!--  End .content -->

<?php get_footer(); ?>
