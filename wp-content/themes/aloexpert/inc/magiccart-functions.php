<?php
/**
 * Magiccart 
 * @category 	Magiccart 
 * @copyright 	Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license 	http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-05-15 10:40:32
 * @@Modify Date: 2018-08-03 11:39:55
 * @@Function:
 */


function magiccart_plugin_activation() {

    $pluginsDir = dirname(__FILE__) . '/plugins';
    $tmps = array();
    if (file_exists($pluginsDir) && is_dir($pluginsDir)) {
        $regexr     = '/.*.zip$/';
        $tmps  = preg_grep($regexr,  scandir($pluginsDir, 1));
    }
    $url = 'http' . '://wp.alothemes.com/plugins/';
    $path = get_stylesheet_directory() . '/plugins/';;
    $plugins = array() ;
    $requires = array( 'js_composer.zip', 'woocommerce.zip', 'redux-framework.zip', 'Magiccart.zip' );
    foreach ($requires as $plg) {
        $source = $url . $plg;
        $idx = array_search($plg, $tmps);
        if($idx){
            $source = $path . $plg;
            unset($tmps[$idx]);
        }
        $name = basename($plg,".zip");
        $plugins[] = array(
            'name'      => $name,
            'slug'      => $name,
            'source'    => $source, 
            'required'  => true
        );
    }
    foreach ($tmps as $plg) {
        $source = $path . $plg;
        $name = basename($plg,".zip");
        $plugins[] = array(
            'name'      => $name,
            'slug'      => $name,
            'source'    => $source, 
            'required'  => false
        );
    }

    // Setting TGM
    $configs = array(
        'menu'          => 'tp_plugin_install',
        'has_notice'    => true,
        'dismissable'   => false,
        'is_automatic'  => true
    );
    tgmpa( $plugins, $configs );
}

/* Get options Redux */
function magiccart_options($key = '', $default=null)
{
    global $alothemes;
    return $alothemes->get_options($key, $default);
}

function magiccart_get_page_layout() {
    if(isset($_GET['layout'])) return $_GET['layout']; //  LAYOUT DEMO
    $options    = magiccart_options();
    if(is_blog()) return  $options['blog_layout'];
    if(is_portfolio()) return $options['portfolio_layout'];
    // if(is_portfolio_category()) return $options['portfolio_layout'];
    if(function_exists('is_shop') && is_shop()) return $options['product_shop_layout'];
    if(function_exists('is_product_category') && is_product_category()) return $options['product_category_layout'];
    if(function_exists('is_product') && is_product()) return $options['single_product_layout'];
    return $options['default_layout'];
}

function magiccart_body_classes( $classes ) {
    $classes[] = magiccart_get_page_layout();
    if(magiccart_options('preload')) $classes[] = 'preload';
    $classes[] = 'woocommerce';
    if(is_page()){
    	$classes[] = 'is_page';
	    global $post;
	    if($post) $classes[] = $post->post_name;
    } 
    return $classes;
}

function magiccart_widgets_init(){
    
    /* sidebar Shop */
    $shopByProduct = array(
        'name'           => __('Shop By Product', 'aloexpert'),
        'id'             => 'shop-by-product',
        'class'          => 'shop-by-product',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="widget-title right-widget-title">',
        'after_title'    => '</h3>'
    );
   register_sidebar($shopByProduct);

   $sidebarLeftShop = array(
        'name'           => __('Left Sidebar Shop', 'aloexpert'),
        'id'             => 'left-sidebar-shop',
        'class'          => 'left-sidebar-shop',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'   => '<h3 class="left-widget-title">',
        'after_title'    => '</h3>'
   );
   register_sidebar($sidebarLeftShop);

   $sidebarRightShop = array(
        'name'           => __('Right Sidebar Shop', 'aloexpert'),
        'id'             => 'right-sidebar-shop',
        'class'          => 'right-sidebar-shop',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="right-widget-title">',
        'after_title'    => '</h3>'
   );
   register_sidebar($sidebarRightShop);

    /* sidebar Portfolio */
   $sidebarLeftPortfolio = array(
        'name'           => __('Left Sidebar Portfolio', 'aloexpert'),
        'id'             => 'left-sidebar-portfolio',
        'class'          => 'left-sidebar-portfolio',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="left-widget-title">',
        'after_title'    => '</h3>'
   );
   register_sidebar($sidebarLeftPortfolio);

   $sidebarRightPortfolio = array(
        'name'           => __('Right Sidebar Portfolio', 'aloexpert'),
        'id'             => 'right-sidebar-portfolio',
        'class'          => 'right-sidebar-portfolio',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="right-widget-title">',
        'after_title'    => '</h3>'
   );
   register_sidebar($sidebarRightPortfolio);

    /* sidebar Details */
   $sidebarLeftDetail = array(
        'name'           => __('Left Sidebar Details', 'aloexpert'),
        'id'             => 'left-sidebar-detail',
        'class'          => 'left-sidebar-detail',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="left-widget-title">',
        'after_title'    => '</h3>'
   );
   register_sidebar($sidebarLeftDetail);

   $sidebarRightDetail = array(
        'name'           => __('Right Sidebar Details', 'aloexpert'),
        'id'             => 'right-sidebar-detail',
        'class'          => 'right-sidebar-detail',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="right-widget-title">',
        'after_title'    => '</h3>'
   );
   register_sidebar($sidebarRightDetail);

    // Register Post sidebar
    $sidebarLeft = array(
        'name'           => __('Left Sidebar Post', 'aloexpert'),
        'id'             => 'left-sidebar',
        'description'    => __('left sidebar', 'aloexpert'),
        'class'          => 'left-sidebar',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="left-widget-title">',
        'after_title'    => '</h3>'
    );
   register_sidebar($sidebarLeft);

    $sidebarRight = array(
        'name'           => __('Right Sidebar Post', 'aloexpert'),
        'id'             => 'right-sidebar',
        'description'    => __('right sidebar', 'aloexpert'),
        'class'          => 'right-sidebar',
        'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'   => '</aside>',
        'before_title'   => '<h3 class="right-widget-title">',
        'after_title'    => '</h3>'
    );
    register_sidebar($sidebarRight);
}

function magiccart_breadcrumbs(){
    echo '<ul class="breadcrumbs" >';
        if(!is_front_page()) echo '<li class="trail-item trail-begin"><a href="' . esc_url( home_url( '/' ) ) .'">' . __('Home','aloexpert') . '</a></li>';
        if( is_tag() ) {
            echo '<li class="trail-item">' . __('Posts Tagged ','aloexpert');
            single_tag_title();
            echo '</li>';
        } elseif (is_day()){
            echo '<li class="trail-item">' . __('Posts made in ','aloexpert');
             the_time('F jS, Y');
            echo  '</li>';
        } elseif (is_month()) {
            echo '<li class="trail-item">' . __('Posts made in ','aloexpert');
            the_time('F, Y');
            echo  '</li>';
        } elseif (is_year()) {
            echo '<li class="trail-item">' . __('Posts made in ','aloexpert');
            the_time('Y');
            echo  '</li>';
        } elseif (is_search()) {
            echo '<li class="trail-item">' . __('Search results for','aloexpert');
            the_search_query();
            echo '</li>';
        } elseif (is_single()) {
            $category = get_the_category();
            if(empty($category)){
                //echo get_the_term_list( get_the_ID(), "product_category");
                echo '<li class="trail-item trail-end"> '.get_the_title() . '</li>'; 
            }else{
                $catlink = get_category_link( $category[0]->cat_ID );
                echo ('<li class="trail-item"><a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a></li>  <li class="trail-item trail-end">'.get_the_title() . "</li>"); 
            }

        } elseif (is_category()) {
            echo '<li class="trail-item trail-end">' . single_cat_title('', false) . '</li>';

        } elseif(is_tax() ){
            $queried_object = get_queried_object();
            $term_id = $queried_object->term_id;
            $term_obj = get_term( $term_id, "product_category");
            if(!$term_obj){
                $term_obj = get_term( $term_id, "new_product");
                if(!$term_obj){
                    $term_obj = get_term( $term_id, "hot_deal");
                }
            } else {
                $term_obj = get_term( $term_id, "portfolio_category");
                if(!$term_obj) $term_obj = get_term( $term_id, "portfolio_tag");
            }
            echo $term_obj ? '<li class="trail-item">' . $term_obj->name . '</li>' : '';

        } elseif (is_author()) {
            echo '<li class="trail-item">' . get_the_author_meta('nickname') . '</li>';
        } else {
            $title = wp_title('', false);
            if($title) echo "<li class='trail-item'>" .  $title . "</li>";
        }

    echo '</ul>';  // End .breadcrumbs
}

function magiccart_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
    <nav class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'aloexpert' ); ?></h2>
        <div class="nav-links">
            <?php
                if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'aloexpert' ) ) ) :
                    printf( '<div class="nav-previous">%s</div>', $prev_link );
                endif;

                if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'aloexpert' ) ) ) :
                    printf( '<div class="nav-next">%s</div>', $next_link );
                endif;
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .comment-navigation -->
    <?php
    endif;
}

function magiccart_pagination(){
    if($GLOBALS['wp_query']->max_num_pages < 2){
        return "";
    } ?>
    <nav class="pagination" role="navigation">
        <?php if (get_next_posts_link()) : ?>
            <div class="prev"><?php next_posts_link( __('Older Posts', 'aloexpert') ); ?></div>
        <?php endif; ?>
        <?php if(get_previous_posts_link() ) : ?>
            <div class="next"><?php previous_posts_link( __('Newest Posts', 'aloexpert')); ?></div>
        <?php endif;?>
    </nav>
<?php }

function magiccart_posts_pagination($class = "pagination", $next = '&rarr;', $prev = '&larr;')
{
    if (is_singular())
        return;
    global $wp_query;    
    echo '<nav class="woocommerce-pagination ' . $class . '">';
            echo paginate_links(  array(
                'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                'format'       => '',
                'add_args'     => false,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'total'        => $wp_query->max_num_pages,
                'prev_text'    =>  $prev,
                'next_text'    => $next,
                'type'         => 'list',
                'end_size'     => 1,
                'mid_size'     => 2
            ) );
    echo '</nav>';
}

function magiccart_readmore($link){
    if ( is_admin() ) {
        return $link;
    }

    $link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link read-more">%2$s</a></p>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( __( 'Read more<span class="screen-reader-text"> "%s"</span>', 'aloexpert' ), get_the_title( get_the_ID() ) )
    );
    return ' &hellip; ' . $link;
}

/* show tag */

function magiccart_entry_tag()
{
    if (has_tag()):
        echo '<div class="entry-tag">';
        printf(__('Tags: %1$s', 'aloexpert'), get_the_tag_list('<span class="tag-list">', ', ', '</span>'));
        echo '</div>';
    endif;
}


/* Get view */
function magiccart_get_post_views($postID)
{
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

/* Set + Update view */
function magiccart_set_post_views($postID)
{
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count); // update count
    }
}

if( !function_exists('is_blog') ){
    function is_blog()
    {
        global $post;
        $posttype = get_post_type($post);
        return (((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ($posttype == 'post')) ? true : false;
    }    
}

if( !function_exists('is_portfolio') ){
    function is_portfolio() 
    {
        global $post;
        $posttype = get_post_type($post);
        return (  ($posttype == 'portfolio') || is_portfolio_category() ) ? true : false;
    }    
}

if( !function_exists('is_portfolio_category') ){
    function is_portfolio_category($term='') 
    {
        return is_tax( 'portfolio_category', $term );
    }    
}

function magiccart_settings_slider($optionSettings)
{
    $arrResponsive = array(
        1201 => 'visible',
        1200 => 'desktop',
        992 => 'notebook',
        768 => 'tablet',
        641 => 'landscape',
        481 => 'portrait',
        361 => 'mobile'
    );
    $settings      = array();
    $total         = count($arrResponsive);
    $options       = array(
        'autoplay',
        'arrows',
        'dots',
        'infinite',
        'padding',
        'rows',
        'autoplay-speed',
        'vertical'
    );
    
    foreach ($options as $value) {
        if (isset($optionSettings[$value])) {
            $settings[$value] = $optionSettings[$value];
        }
    }
    $settings['vertical-swiping'] = $optionSettings['vertical'];
    $settings['slides-to-show']   = isset($_GET['visible']) ? absint($_GET['visible']) : $optionSettings['visible']; // USED DEMO
    $settings['padding']          = $optionSettings['padding'];
    $settings['swipe-to-slide']   = 'true';
    
    $responsive = '[';
    foreach ($arrResponsive as $size => $screen) {
        $responsive .= '{"breakpoint": "' . $size . '", "settings":{"slidesToShow":"' . $optionSettings[$screen] . '"}}';
        if ($total-- > 1)
            $responsive .= ', ';
    }
    $responsive .= ']';
    $settings['responsive'] = $responsive;
    
    return $settings;
}

function magiccart_upload_featured_image($image_url, $post_id)
{
    $upload_dir = wp_upload_dir();
    $file_get = 'file_get_contents'; // pass theme-check
    $image_data = $file_get($image_url);
    $filename   = basename($image_url);
    if (wp_mkdir_p($upload_dir['path']))
        $file = $upload_dir['path'] . '/' . $filename;
    else
        $file = $upload_dir['basedir'] . '/' . $filename;
    $file_put = 'file_put_contents'; // pass theme-check
    $file_put($file, $image_data);
    
    $wp_filetype = wp_check_filetype($filename, null);
    $attachment  = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id   = wp_insert_attachment($attachment, $file, $post_id);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    $res1        = wp_update_attachment_metadata($attach_id, $attach_data);
    $res2        = set_post_thumbnail($post_id, $attach_id);
}

// Function support woocommerce

function magiccart_woocommerce_breadcrumb( $defaults ) {
    $defaults = array(
        'delimiter'   => '',
        'wrap_before' => '<ul class="breadcrumbs woocommerce-breadcrumb" >',
        'wrap_after'  => '</ul>',
        'before'      => '<li class="trail-item">',
        'after'       => '</li>',
        'home'        => __( 'Home', 'aloexpert'),
    );
    return $defaults;
}

function magiccart_woocommerce_alter_category_search($query) {
    if (is_admin() || !is_search())
        return false;

    if ($product_cat = $query->get('product_cat')) {
        $query->set('product_cat', '');
        $query->set('tax_query', array(
            array(
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => $product_cat,
                'include_children' => false,
            )
        ));
    }
}

function magiccart_product_related_limit_args( $args ) {
    $args['posts_per_page'] = magiccart_options('product_related_limit'); // related products
    //$args['columns'] = 2; // arranged in 2 columns
    return $args;
}

function magiccart_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    echo '<span class="cart-quantity text">' . WC()->cart->get_cart_contents_count() . '</span>';
    $fragments['span.cart-quantity'] = ob_get_clean();
    ob_start();
    echo '<p class="cart-total"><span class="text-account text-normal"><span class="price">' . $woocommerce->cart->get_cart_total() . '</span></span></p>';
    $fragments['p.cart-total'] = ob_get_clean();
    return $fragments;
}

function magiccart_empty_cart() {
    if ( isset( $_REQUEST['empty-cart'] ) ) {
        global $woocommerce;
        $woocommerce->cart->empty_cart();
    }
}

/* get Product Image */
function magiccart_get_product_image($product){
    $imgCatalog = get_the_post_thumbnail_url($product->ID, 'shop_catalog');
    $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $product );        
}

/* get Product Image */
function magiccart_get_product_image_quickview(){
    // woocommerce_show_product_images();
    // woocommerce_show_product_thumbnails();  
    // wc_get_template( 'single-product/product-image.php' );
    wc_get_template( 'single-product/product-thumbnails.php' );
}

// End function support woocommerce

// Function support developer

function magiccart_convert_classes_vc_to_bootstrap( $class_string, $tag ) {
    if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
        $classNames = ['wpb_row','vc_row-fluid','vc_row'];
        
        foreach($classNames as $className)
            $class_string = str_replace( $className, '', $class_string );
        
        $class_string = ('row'.($class_string?' ' :'').trim($class_string)); // This will replace "vc_row-fluid" with "my_row-fluid"
    }
    
    if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
        $classNames = ['wpb_column','vc_column_container'];
        
        foreach($classNames as $className)
            $class_string = str_replace( $className, '', $class_string );
        
        $cols = ['col-xs-offset-','col-xs-','col-sm-offset-','col-sm-','col-md-offset-','col-md-','col-lg-offset-','col-lg-'];
        foreach($cols as $col){
            $num = 0;
            
            if (preg_match('/vc_'.$col.'(\d{1,2})/', $class_string, $regs)) {
                $num = (int) str_replace(('vc_'.$col), '', $regs[0]);
                $class_string = preg_replace( '/vc_'.$col.'(\d{1,2})/', $col . $num , $class_string );
            }


        }
    }
    
    return $class_string; 
}

function magiccart_list_hooks($hook = '')
{
    global $wp_filter;
    
    if (isset($wp_filter[$hook]->callbacks)) {
        array_walk($wp_filter[$hook]->callbacks, function($callbacks, $priority) use (&$hooks)
        {
            foreach ($callbacks as $id => $callback) {
                //$hooks[] = array_merge( [ 'id' => $id, 'priority' => $priority ], $callback );
            }
        });
    } else {
        return array();
    }
    
    foreach ($hooks as &$item) {
        // skip if callback does not exist
        if (!is_callable($item['function']))
            continue;
        
        // function name as string or static class method eg. 'Foo::Bar'
        if (is_string($item['function'])) {
            $ref          = strpos($item['function'], '::') ? new ReflectionClass(strstr($item['function'], '::', true)) : new ReflectionFunction($item['function']);
            $item['file'] = $ref->getFileName();
            $item['line'] = get_class($ref) == 'ReflectionFunction' ? $ref->getStartLine() : $ref->getMethod(substr($item['function'], strpos($item['function'], '::') + 2))->getStartLine();
            
            // array( object, method ), array( string object, method ), array( string object, string 'parent::method' )
        } elseif (is_array($item['function'])) {
            
            $ref = new ReflectionClass($item['function'][0]);
            
            // $item['function'][0] is a reference to existing object
            $item['function'] = array(
                is_object($item['function'][0]) ? get_class($item['function'][0]) : $item['function'][0],
                $item['function'][1]
            );
            $item['file']     = $ref->getFileName();
            $item['line']     = strpos($item['function'][1], '::') ? $ref->getParentClass()->getMethod(substr($item['function'][1], strpos($item['function'][1], '::') + 2))->getStartLine() : $ref->getMethod($item['function'][1])->getStartLine();
            
            // closures
        } elseif (is_callable($item['function'])) {
            $ref              = new ReflectionFunction($item['function']);
            $item['function'] = get_class($item['function']);
            $item['file']     = $ref->getFileName();
            $item['line']     = $ref->getStartLine();
            
        }
    }
    
    return $hooks;
}

function magiccart_header_hints($name )
{
    $templates = array();
    $name = (string) $name;
    if ( '' !== $name )
        $templates[] = "header-{$name}.php";

    $templates[] = "header.php";

    $located = locate_template($templates, false, true);
    magiccart_start_file($located);
}

function magiccart_sidebar_hints($name )
{
    $templates = array();
    $name = (string) $name;
    if ( '' !== $name )
        $templates[] = "sidebar-{$name}.php";

    $templates[] = "sidebar.php";

    $located = locate_template($templates, false, true);
    magiccart_start_file($located);
}

function magiccart_woocommerce_before_template_hints( $template_name, $template_path, $located, $args )
{
   magiccart_start_file($located);
}

function magiccart_before_template_hints( $located, $object )
{
   magiccart_start_file($located, $object);
}

function magiccart_template_part_content_hints(  $slug, $name )
{
    $templates = array();
    $name = (string) $name;
    if ( '' !== $name )
        $templates[] = "{$slug}-{$name}.php";

    $templates[] = "{$slug}.php";

    $located = locate_template($templates, false, true);
    magiccart_start_file($located);
}

function magiccart_footer_hints($name )
{
    $templates = array();
    $name = (string) $name;
    if ( '' !== $name )
        $templates[] = "footer-{$name}.php";

    $templates[] = "footer.php";

    $located = locate_template($templates, false, true);
    magiccart_start_file($located);
}

function magiccart_start_file( $located='', $object = '', $content='' )
{
    echo '<div style="position:relative; border:1px dotted red; margin:6px 2px; padding:18px 2px 2px 2px; zoom:1;"><div style="position:absolute; left:0; top:0; padding:2px 5px; background:red; color:white; font:normal 11px Arial; text-align:left !important; z-index:998;" onmouseover="this.style.zIndex=999" onmouseout="this.style.zIndex=998" title="'. esc_attr($located) . '">'.$located.'</div>';
    if(!$object && isset( $this ) ) $object = $this;
    $thisClass = (is_object($object)) ? get_class($object) : '';
    if($thisClass) {
        echo '<div style="position:absolute; right:0; top:0; padding:2px 5px; background:red; color:blue; font:normal 11px Arial; text-align:left !important; z-index:998;" onmouseover="this.style.zIndex=999" onmouseout="this.style.zIndex=998" title="' . esc_attr($thisClass) . '">' .$thisClass. '</div>';
    }
    echo $content;
}

function magiccart_end_file($content)
{
    echo $content . '</div>';
}

// End function support developer
