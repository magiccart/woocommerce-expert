<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-08-03 10:35:17
 * @@Modify Date: 2018-08-03 11:40:47
 * @@Function:
 */

namespace Magiccart\Widgets\Block\Product;

use Magiccart\Composer\Model\Product\Collection;

class ShopBy extends \WC_Widget{

    protected $_collection; 

    /**
     * Constructor
     */
    public function __construct() {
        $this->widget_cssclass    = 'woocommerce widget_product_shopby';
        $this->widget_description = esc_html__( 'Display Shop By Product sidebar.', 'alothemes' );
        $this->widget_id          = 'magiccart_product_shopby';
        $this->widget_name        = esc_html__( 'Magiccart Shop By Product', 'alothemes' );
        $this->settings           = array(
            'title'  => array(
                'type'  => 'text',
                'std'   => esc_html__( 'Shop By', 'alothemes' ),
                'label' => esc_html__( 'Title', 'alothemes' )
            ),
            // 'template' => array(
            //     'type'  => 'select',
            //     'std'   => 'shopby.phtml',
            //     'label' => esc_html__( 'template', 'alothemes' ),
            //     'options' => $this->get_templates()
            // )
        );
        parent::__construct();
    }

    /**
     * widget function.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     *
     * @return void
     */
    public function widget( $args, $instance ) {
        
        global $woocommerce;
        if(!$woocommerce) return array();

        $this->widget_start( $args, $instance );

            // echo $args['before_widget'];
            ?>
            <?php
                // $block = new Template;
                // $block->setTemplate('product/shopby.phtml');
                // echo $block->toHtml();
            ?>
            <div class="widget-products-shopby">
                <?php 
                    if ( is_active_sidebar( 'shop-by-product' ) ) {
                        dynamic_sidebar( 'shop-by-product' );
                    } else {
                        if ( function_exists( 'magiccart_shopbyproduct' ) ) {
                            magiccart_shopbyproduct();
                        }
                    }
                ?>
            </div>
                <?php 
            // echo $args['after_widget'];
        $this->widget_end( $args );
    }

    protected function get_templates(){
        $settings = array();
        $templates = array();
        $msg_template = '';
        $class = explode('\\', get_class($this));
        $templatesDirs = array(
                        get_stylesheet_directory(),
                        get_template_directory()
            );
        foreach ($templatesDirs as $dir) {
            $templateDir = $dir . '/' . $class[0] . '_' .$class[1] . '/templates/';
            if (file_exists($templateDir) && is_dir($templateDir)) {
                $fileTheme  = $templateDir . $this->_template;
                $msg_template .= "Create custom file in path: $fileTheme <br/>";
                $regexr     = '/^' . $this->_class . '.*.phtml$/';
                $tmps  = preg_grep($regexr,  scandir($templateDir, 1));
                if($templates){
                    foreach ($tmps as $fileName) {
                        $templates[] = $fileName;
                    }
                } else {
                    $templates = $tmps;
                }
            }
        }
        

        if($templates){
            $templates = array_unique($templates);
            asort($templates);
            if(!in_array($this->_template , $templates)){
                array_unshift($templates, $this->_template);
            }
            if(count($templates) > 1){
                $settings[] = array(
                    'type'          => "dropdown",
                    'heading'       => __('Template custom file: ', 'alothemes'),
                    'param_name'    => 'template',
                    'value'         => $templates,
                    'group'         => __( 'Template', 'alothemes' ),
                    'std'           => '',
                    'description'   => $msg_template,
                    'save_always'   => true,
                );                     
            }        
        }

        return $settings;
    }

}
