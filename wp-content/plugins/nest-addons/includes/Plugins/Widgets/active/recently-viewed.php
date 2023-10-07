<?php
/*
======================================
Recent Viewed
======================================
*/
add_shortcode( 'nest_get_products_on', 'nest_recent_get_products' );
function nest_recent_get_products($atts){
    global $nest_theme_mod;
    $recent_title = isset( $nest_theme_mod['recent_title'] ) ? $nest_theme_mod['recent_title'] : '';
    ?>
    <div class="recent_viewd_products position_two">
    <div class="container">
        <div class="recent_view_inner">
            <?php if(!empty($recent_title)): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="title"> <?php echo esc_attr($recent_title); ?></div>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-lg-12">
    <?php
    $product_ids = isset($atts['ids']) ? $atts['ids'] : ''; 
    $recent_query_args = array(
        'post_type' => 'product', 
        'order' => 'DESC',  
        'post__in' => explode(',', $product_ids),
    ); 
    $reproduct_query = new WP_Query($recent_query_args); 
    if ($reproduct_query->have_posts()) {  
        ?>
       <div class="theme_carousel owl-theme owl-carousel" data-options='{"loop": false , "rtl" : false, "margin": 20, "autoheight":true, "autoplayHoverPause":true ,  "lazyload":true, "nav": true, "dots": false, "autoplay": true, "autoplayTimeout":7000, "smartSpeed": 1500, "responsive":{ "0" :{ "items": "1" }, "290" :{ "items" : "2" }, "500" :{ "items" : "2" }, "768" :{ "items" : "3" } , "992":{ "items" : "4" }, "1200":{ "items" : "4" }}}'>  <?php
        while ($reproduct_query->have_posts()) {
            $reproduct_query->the_post();
            global $product;
            global $woocommerce;
            ?>
            <div class="custom-product-container">
                <?php do_action('get_nest_product_card_three'); ?> 
            </div>
            <?php
        }
        wp_reset_query();
        ?>
        </div>
        </div>
        </div>
        </div>
            </div>
        </div>
    </div>
</div>
        <?php 
       
    }
}

add_shortcode( 'recently_viewed_products', 'nest_recently_viewed_shortcode' );

function nest_recently_viewed_shortcode() {
   $viewed_products = ! empty( $_COOKIE['nest_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['nest_recently_viewed'] ) ) : array();
   $viewed_products = array_slice($viewed_products, 0, 8);
   
   if ( empty( $viewed_products ) ) return ''; 
   
   $product_ids = implode( ",", $viewed_products );
   
   return do_shortcode("[nest_get_products_on ids='$product_ids']");
}

// adds notice at single product page above add to cart
add_action( 'nest_get_recent_pro', 'nest_recent_pros');

function nest_recent_pros() {
    global $nest_theme_mod;
    $recent_title = isset( $nest_theme_mod['recent_title'] ) ? $nest_theme_mod['recent_title'] : '';

    echo do_shortcode('[recently_viewed_products]');
}

function nest_track_product_view() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['nest_recently_viewed'] ) )
        $viewed_products = array();
    else
        $viewed_products = (array) explode( '|', $_COOKIE['nest_recently_viewed'] );

    if ( ! in_array( $post->ID, $viewed_products ) ) {
        $viewed_products[] = $post->ID;
    }

    if ( sizeof( $viewed_products ) > 15 ) {
        array_shift( $viewed_products );
    }

    // Store for session only
    wc_setcookie( 'nest_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'nest_track_product_view', 20 );
