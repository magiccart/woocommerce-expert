<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2017-08-09 22:09:48
 * @@Modify Date: 2018-08-01 18:06:00
 * @@Function:
 */

namespace Magiccart\Core\Controller\Adminhtml;

class Product extends Action {

    public function __construct()
    {
        if(!class_exists('WooCommerce')) return;
        add_action( 'woocommerce_product_write_panel_tabs', array($this, 'magiccart_product_panel_tab') );
        add_action( 'woocommerce_product_data_panels', array($this, 'magiccart_product_data_panel') );
        add_action( 'woocommerce_process_product_meta', array($this, 'magiccart_process_product_meta') );
    }


    /**
    * Adding a magiccart product tab
    */
    public function magiccart_product_panel_tab()
    {

        echo '<li class="magiccart_tab"><a href="#magiccart_product_panel_tab"><span>' . __( 'Magiccart', 'alothemes' ) . '</span></a></li>';
    }

    public function magiccart_product_data_panel() 
    {

        echo '<div id="magiccart_product_panel_tab" class="panel woocommerce_options_panel">
            <div class="options_group">';
            global $product_object, $post;
            // var_dump($product_object);
            //*
            $date = get_post_meta( $post->ID, '_new_dates_from', true );
            $new_dates_from = is_numeric( $date ) ? date_i18n( 'Y-m-d', $date ) : '';
            $date = get_post_meta( $post->ID, '_new_dates_to', true );
            $new_dates_to = is_numeric( $date ) ? date_i18n( 'Y-m-d', $date ) : '';
            //*/
            // $new_dates_from = get_post_meta( $post->ID, '_new_dates_from', true );
            // $new_dates_to = get_post_meta( $post->ID, '_new_dates_to', true );
            echo '<p class="form-field new_dates_fields">
                    <label for="_new_dates_from">' . esc_html__( 'Set Product as New', 'woocommerce' ) . '</label>
                    <input style="margin-bottom: 1em;" type="text" class="short" name="_new_dates_from" id="_new_dates_from" value="' . esc_attr( $new_dates_from ) . '" placeholder="' . esc_html( _x( 'From&hellip;', 'placeholder', 'woocommerce' ) ) . ' YYYY-MM-DD" maxlength="10" pattern="' . esc_attr( apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ) ) . '" />
                    <input style="clear:left;" type="text" class="short" name="_new_dates_to" id="_new_dates_to" value="' . esc_attr( $new_dates_to ) . '" placeholder="' . esc_html( _x( 'To&hellip;', 'placeholder', 'woocommerce' ) ) . '  YYYY-MM-DD" maxlength="10" pattern="' . esc_attr( apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ) ) . '" />'
                    . wc_help_tip( __( 'The new will end at the beginning of the set date.', 'woocommerce' ) ) . '
                </p>';
        
        echo '</div>';
    ?>
        <script type="text/javascript">     
            (function($) {
                $(document).ready(function() {
                    /* Datepicker default configuration */                                      
                    var options = $.extend({}, $.datepicker.regional["en-GB"]);
                    $.datepicker.setDefaults(options);
                    $("body").on("focus", "#_new_dates_from, #_new_dates_to", function() {
                        $(this).datepicker({                        
                            dateFormat:'yy-mm-dd',
                            beforeShowDay: disableDates,
                            onSelect: function( dateText ) {   
                                $( this ).trigger( "change" );
                            }                                
                        });
                    });     
                    
                    function disableDates( date ) {
                        var disablenextxdates = parseInt( "" ),
                        cDateObj = new Date(),
                        cDate   = cDateObj.getDate(),
                        numbers = [];
                        for ( var i = cDate; i < (cDate+disablenextxdates); i++ ) {
                            numbers.push( i+1 );
                        }
                        if( numbers.indexOf( date.getDate() ) != -1 && cDateObj.getMonth() == date.getMonth() ){
                            return [false];
                        }                                   
                        return [true];
                    }
                });
            })(jQuery);
        </script>
    </div>
    <?php
    }

    public function magiccart_process_product_meta($post_id)
    {
        $_new_dates_from = $_POST['_new_dates_from'];
        if (!empty($_new_dates_from)){
            $_new_dates_from = strtotime($_new_dates_from);
        }
        update_post_meta($post_id, '_new_dates_from', esc_attr($_new_dates_from));
        $_new_dates_to = $_POST['_new_dates_to'];
        if (!empty($_new_dates_to)){
            $_new_dates_to = strtotime($_new_dates_to);
        }
        update_post_meta($post_id, '_new_dates_to', esc_attr($_new_dates_to));
    }

}
