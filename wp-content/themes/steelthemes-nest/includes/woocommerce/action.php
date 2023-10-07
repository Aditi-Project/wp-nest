<?php
/*
**====================================
** Nest nestmerce woocommerce action
**====================================
*/
global $nest_theme_mod; 
//Remove Actions
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10,0);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20,0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10,0);
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
// single removing summary 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title',5);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating',10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
// single removing summary end
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
 
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
// twice the ajax cart
if ('no' === get_option('woocommerce_cart_redirect_after_add') && 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') ) { 
    remove_action('wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );
}
//Adding Actions
add_action( 'nest_single_title', 'woocommerce_template_single_title',5);
add_action( 'nest_single_rating', 'woocommerce_template_single_rating',10);
add_action( 'nest_single_meta', 'woocommerce_template_single_meta', 40 );
add_action( 'nest_single_sharing', 'woocommerce_template_single_sharing', 50 );
add_action( 'wp_footer' , 'nest_quantity_fields_script' );
add_action( 'woocommerce_shop_loop_item_title',  'nest_attribute_links');
add_action( 'woocommerce_after_shop_loop_item_title',  'nest_wc_template_loop_stock', 10 );
add_action( 'woocommerce_nest_product_image_box', 'nest_product_image_box', 11 );
add_action( 'woocommerce_process_product_meta','nest_woocommerce_process_product_meta', 10 );
add_action( 'woocommerce_checkout_before_customer_details', 'woocommerce_checkout_payment', 10 );
//Adding Filters
add_filter( 'woocommerce_add_to_cart_fragments',  'nest_mini_cart_count');
add_filter( 'woocommerce_breadcrumb_defaults', 'nest_change_breadcrumb_delimiter' );
add_filter( 'woocommerce_product_description_heading', '__return_null' );
add_filter( 'woocommerce_product_reviews_heading', '__return_null' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );
add_filter( 'woocommerce_add_to_cart_fragments',  'nest_mini_cart_dropdown');
//Adding Filters
add_action( 'wp_ajax_nopriv_nest_get_quick_view', 'nest_get_quick_view_output' );
add_action( 'wp_ajax_nest_get_quick_view', 'nest_get_quick_view_output' );
/*
**================================== 
** Qucik view
**==================================
*/
function nest_get_quick_view_output(){
	$id = intval( $_POST['id'] );
	$loop = new WP_Query( array(
		'post_type' => 'product',
		'p' => $id,
	  )
	);
	while ( $loop->have_posts() ) : $loop->the_post(); 
		$output .= '<div class="woocommerce quick_view">';
			ob_start();
			do_action( 'quick_view_get' );
			$output .= ob_get_clean();
		$output .= '</div>';
		endwhile; 
	wp_reset_postdata();
	$output_escaped = $output;
	echo $output_escaped;
	wp_die();
}

// Enable product tabs in quick view
function enable_product_tabs_in_quickview( $tabs ) {
    $tabs['description']['enabled'] = true;
    $tabs['additional_information']['enabled'] = true;
    $tabs['reviews']['enabled'] = true;
    return $tabs;
}
add_filter( 'woocommerce_quick_view_product_tabs', 'enable_product_tabs_in_quickview', 10, 1 );


//hide default compare button on product archive page
add_filter( 'filter_wooscp_button_archive', function() {
    return '0';
} );

//hide default compare button on product single page
add_filter( 'filter_wooscp_button_single', function() {
    return '0';
} );
/*
**================================== 
**  wcc_change_breadcrumb_delimiter
**==================================
*/
function nest_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = '';
    return $defaults;
}   
/*
**==============================   
**   Nest_quantity_fields_script
**==============================
*/
function nest_quantity_fields_script(){?>
<script type='text/javascript'>
    jQuery(function ($) {
        if (!String.prototype.getDecimals) {
            String.prototype.getDecimals = function () {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if (!match) {
                    return 0;
                }
                return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
            }
        }
        // Quantity "plus" and "minus" buttons
        $(document.body).on('click', '.plus, .minus', function () {
            var $qty = $(this).closest('.quantity').find('.qty'),
                currentVal = parseFloat($qty.val()),
                max = parseFloat($qty.attr('max')),
                min = parseFloat($qty.attr('min')),
                step = $qty.attr('step');

            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
            if (max === '' || max === 'NaN') max = '';
            if (min === '' || min === 'NaN') min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
                step = 1;

            // Change the value
            if ($(this).is('.plus')) {
                if (max && (currentVal >= max)) {
                    $qty.val(max);
                } else {
                    $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                }
            } else {
                if (min && (currentVal <= min)) {
                    $qty.val(min);
                } else if (currentVal > 0) {
                    $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                }
            }

            // Trigger change event
            $qty.trigger('change');
        });
    });
</script>
<?php
}   


 

/*
**==============================   
**  woocommerce_shop_loop_item_title
**==============================
*/
function nest_attribute_links(){
    global $post;
    $allowed_tag = wp_kses_allowed_html('post');
    $product_attributes = get_post_meta(get_the_ID() , 'pro_attribute', true);
    $attribute_names =  'pa_'.$product_attributes.''; // Add attribute names here and remember to add the pa_ prefix to the attribute name
    $taxonomy = get_taxonomy( $attribute_names );
        if($taxonomy && ! is_wp_error($taxonomy)){
            $terms = wp_get_post_terms( $post->ID, $attribute_names );
            $terms_array = array();
            if(!empty($terms)){
            foreach($terms as $term){
                $full_line = '<li>'. $term->name . ' <small>,</small></li>';
                array_push( $terms_array, $full_line );
            }
            ?>
    <ul class="attributes_list_items">
        <?php $attributename =  get_post_meta(get_the_ID() , 'pro_attribute_name', true); if(!empty($attributename)): ?>
            <li><?php echo esc_attr($attributename); ?> <?php echo esc_html(':', 'steelthemes-nest'); ?></li>
        <?php endif; ?>
        <?php foreach($terms_array as $term){
                echo wp_kses($term , $allowed_tag );   
        }?>
    </ul>
<?php 
        }
    }
}       
/*
**==============================   
**  Nest_wc_template_loop_stock
**==============================
*/
function nest_wc_template_loop_stock() {
    global $product;
    if($product->managing_stock() && (int)$product->get_stock_quantity() < 1)
    echo '<p class="stock out-of-stock">'.esc_html_e('Out of Stock' , 'steelthemes-nest').'</p>';
}   
/*
**==================================== 
**   Nest_get_current_product_category
**====================================
*/
add_action('get_nest_current_product_category', 'nest_get_current_product_category');
function nest_get_current_product_category(){
    global $product ,  $nest_theme_mod;
    $category_enable = isset( $nest_theme_mod['category_enable'] ) ? $nest_theme_mod['category_enable'] : '';
    if($category_enable == false):
        return false;
    endif; 
        $product_id = get_the_ID(); // Assuming you're inside the loop, otherwise provide the product ID
        $categories = get_the_terms( $product_id, 'product_cat' );
        
        if ( $categories && ! is_wp_error( $categories ) ) {
            $first_category = reset( $categories ); // Get the first category from the array
          
    ?>
    
    <div class="product-category">
        <div class="pro_cat">
            <a href="<?php echo get_term_link( $first_category ); ?>"> <?php echo esc_attr($first_category->name); ?></a>
        </div>
    </div>
<?php
  }
 
}  



/*
**==============================   
** Nest nestmerce Sales Badges
**==============================
*/
add_action('get_nest_sales_badges', 'nest_sales_badges_two');
function nest_sales_badges_two(){
    global $product;
    $bage_one_color_bg  =  get_post_meta( get_the_ID(), 'product_badge_bg_color', true);
    $product_badge_color  =  get_post_meta( get_the_ID(), 'product_badge_color', true);
    $bage_one_color_bg    = ! empty( $bage_one_color_bg ) ? "background: $bage_one_color_bg!important;" : '';
    $product_badge_color    = ! empty( $product_badge_color ) ? "color: $product_badge_color!important;" : '';
    $style_css  = "style='$bage_one_color_bg  $product_badge_color'";
    $product_badge_bg_color_two  =  get_post_meta( get_the_ID(), 'product_badge_bg_color_two', true);
    $product_badge_color_two  =  get_post_meta( get_the_ID(), 'product_badge_color_two', true);
    $product_badge_bg_color_two    = ! empty( $product_badge_bg_color_two ) ? "background: $product_badge_bg_color_two!important;" : '';
    $product_badge_color_two    = ! empty( $product_badge_color_two ) ? "color: $product_badge_color_two!important;" : '';
    $style_css_two  = "style='$product_badge_bg_color_two  $product_badge_color_two'";
    $out_of_stock = $product->get_stock_status();
    $onsale = get_post_meta(get_the_ID(), 'badges_onsale', true);
    if($product->is_on_sale() && $product->is_type( 'variable' )):   ?>
        <?php if(get_post_meta(get_the_ID(), 'product_percent_show', true) == true): ?>
            <?php $percentage = ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price( 'min' )) * 100); ?>
                <small class="badge_type_one onsale"
                    <?php if(!empty($style_css)): echo $style_css; endif;?>><?php echo esc_attr($percentage); ?>%
                </small>
               
            <?php endif; ?>
            <?php elseif( $product->is_on_sale() && $product->get_regular_price()):?>
            <?php if(get_post_meta(get_the_ID(), 'product_percent_show', true) == true): ?>
                <?php if($out_of_stock == 'outofstock'): ?>
                    <span class="badge_type_one onsale outofstock" <?php if(!empty($style_css)): echo $style_css; endif; ?>>
                    <?php echo esc_html_e('Out of Stock' , 'steelthemes-nest'); ?></span>
                <?php else: ?>
            <?php $percentage = ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100); ?>
                <span class="badge_type_one onsale" <?php if(!empty($style_css)): echo $style_css; endif; ?>>
                    <?php echo esc_attr($percentage); ?>%</span>
                <?php endif; ?>
                <?php elseif($out_of_stock == 'outofstock'): ?>
                <span class="badge_type_one onsale outofstock" <?php if(!empty($style_css)): echo $style_css; endif; ?>>
                    <?php echo esc_html_e('Out of Stock' , 'steelthemes-nest'); ?></span>
                <?php endif; ?>
                <?php if(!empty($onsale)): ?>
                <span class="badge_text"
                    <?php if(!empty($style_css_two)): echo $style_css_two; endif; ?>><?php echo esc_attr($onsale); ?>
                </span>
            <?php endif; ?>
            <?php elseif( $product->is_on_sale() || $product->get_regular_price()):?>
            <?php if($out_of_stock == 'outofstock'): ?>
                <span class="badge_type_one onsale outofstock" <?php if(!empty($style_css)): echo $style_css; endif; ?>>
                    <?php echo esc_html_e('Out of Stock' , 'steelthemes-nest'); ?></span>
                <?php elseif($out_of_stock == 'instock'): ?>
                <span class="badge_type_one onsale instock" <?php if(!empty($style_css)): echo $style_css; endif; ?>>
                    <?php echo esc_html_e('In Stock' , 'steelthemes-nest'); ?></span>
                    <?php elseif($out_of_stock == 'onbackorder'): ?>
                <span class="badge_type_one onsale onbackorder" <?php if(!empty($style_css)): echo $style_css; endif; ?>>
                    <?php echo esc_html_e('On Backorder' , 'steelthemes-nest'); ?></span>
                <?php endif; ?>
<?php endif; 
}
/*
**==============================   
**  shop product sold count
**==============================
*/
add_action('get_nest_shop_product_sold_count', 'nest_shop_product_sold_count');
function nest_shop_product_sold_count() {
    global $product , $nest_theme_mod;
    $sold_items_enable = isset( $nest_theme_mod['sold_items_enable'] ) ? $nest_theme_mod['sold_items_enable'] : '';
    if($sold_items_enable == false):
        return false;
    endif;
    $sold_type = isset( $nest_theme_mod['sold_type'] ) ? $nest_theme_mod['sold_type'] : '';
    if($sold_type == 'default'):
        if ($product) {
            $product_id = $product->get_id();
            $available_quantity = $product->get_stock_quantity();
            $sold_quantity = $product->get_total_sales();
            if(!empty($available_quantity) && !empty($sold_quantity)): 
            $total_quantity = $available_quantity + $sold_quantity;
            $progress_percentage = ($sold_quantity / $total_quantity) * 100;
            $progress_percentage = round($progress_percentage, 2);
            ?>
            <div class="progressboxs">
            <div class="progress style_two">
                <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($progress_percentage) ?>%;" aria-valuenow="<?php echo esc_attr($progress_percentage) ?>" aria-valuemin="0" aria-valuemax="100"></div> 
            </div>
            <div class="d-flex align-items-center">
                <span class="font-xs text-heading"><?php echo esc_html__('Sold' , 'steelthemes-nest'); ?> : <?php echo esc_attr($sold_quantity); ?>
                    <?php echo esc_html('/'); ?> <?php echo esc_attr($available_quantity); ?> 
                </span>  
                <em><?php echo esc_attr($progress_percentage) ?>%</em>
            </div> 
            </div> 
            <?php
            endif;
        }
    ?>
    <?php else: ?>
    <?php $sold_items = get_post_meta($product->get_id(), 'sold_items', true);
        $sale_quantity = get_post_meta($product->get_id(), 'sale_quantity', true);
        $sold_items_type = get_post_meta($product->get_id(), 'sold_items_type', true);
        if(!empty($sold_items) && !empty($sale_quantity)): ?>
            <div class="sold mt-10 mb-5">
                <div class="progress mb-5">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr( $sold_items / $sale_quantity * 100 ); ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            <div>
            <span class="font-xs text-heading"><?php echo esc_html__('Sold' , 'steelthemes-nest'); ?> : <?php echo esc_attr($sold_items); ?> <?php echo esc_attr($sold_items_type); ?> 
                <?php echo esc_html('/'); ?><?php echo esc_attr($sale_quantity); ?>  <?php echo esc_attr($sold_items_type); ?> </span>  
            </div> 
    </div>
     <?php endif; ?>
<?php endif;
}

add_action('get_nest_shop_product_sold_count_default', 'nest_shop_product_sold_countefault');
function nest_shop_product_sold_countefault() {
    global $product;
        if ($product) {
            $product_id = $product->get_id();
            $available_quantity = $product->get_stock_quantity();
            $sold_quantity = $product->get_total_sales();
            if(!empty($available_quantity) && !empty($sold_quantity)): 
            $total_quantity = $available_quantity + $sold_quantity;
            $progress_percentage = ($sold_quantity / $total_quantity) * 100;
            $progress_percentage = round($progress_percentage, 2);
            ?>
            <div class="progressboxs">
            <div class="progress style_two">
                <div class="progress-bar" role="progressbar" style="width: <?php echo esc_attr($progress_percentage) ?>%;" aria-valuenow="<?php echo esc_attr($progress_percentage) ?>" aria-valuemin="0" aria-valuemax="100"></div> 
            </div>
            <div class="d-flex align-items-center">
                <span class="font-xs text-heading"><?php echo esc_html__('Sold' , 'steelthemes-nest'); ?> : <?php echo esc_attr($sold_quantity); ?>
                    <?php echo esc_html('/'); ?> <?php echo esc_attr($available_quantity); ?> 
                </span>  
                <em><?php echo esc_attr($progress_percentage) ?>%</em>
            </div> 
            </div> 
            <?php
            endif;
        }
}

/*
**=================================== 
**Show cart contents / total Ajax
**===================================
*/
function nest_mini_cart_count($fragments){
    ob_start();
        $items_counts = WC()->cart->get_cart_contents_count();
    ?>
    <a class="mini-cart-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
        <g>
            <path
                d="M24.4941 3.36652H4.73614L4.69414 3.01552C4.60819 2.28593 4.25753 1.61325 3.70863 1.12499C3.15974 0.636739 2.45077 0.366858 1.71614 0.366516L0.494141 0.366516V2.36652H1.71614C1.96107 2.36655 2.19748 2.45647 2.38051 2.61923C2.56355 2.78199 2.68048 3.00626 2.70914 3.24952L4.29414 16.7175C4.38009 17.4471 4.73076 18.1198 5.27965 18.608C5.82855 19.0963 6.53751 19.3662 7.27214 19.3665H20.4941V17.3665H7.27214C7.02705 17.3665 6.79052 17.2764 6.60747 17.1134C6.42441 16.9505 6.30757 16.7259 6.27914 16.4825L6.14814 15.3665H22.3301L24.4941 3.36652ZM20.6581 13.3665H5.91314L4.97214 5.36652H22.1011L20.6581 13.3665Z"
                fill="#253D4E" />
            <path
                d="M7.49414 24.3665C8.59871 24.3665 9.49414 23.4711 9.49414 22.3665C9.49414 21.2619 8.59871 20.3665 7.49414 20.3665C6.38957 20.3665 5.49414 21.2619 5.49414 22.3665C5.49414 23.4711 6.38957 24.3665 7.49414 24.3665Z"
                fill="#253D4E" />
            <path
                d="M17.4941 24.3665C18.5987 24.3665 19.4941 23.4711 19.4941 22.3665C19.4941 21.2619 18.5987 20.3665 17.4941 20.3665C16.3896 20.3665 15.4941 21.2619 15.4941 22.3665C15.4941 23.4711 16.3896 24.3665 17.4941 24.3665Z"
                fill="#253D4E" />
        </g>
        <defs>
            <clipPath>
                <rect width="24" height="24" fill="white" transform="translate(0.494141 0.366516)" />
            </clipPath>
        </defs>
    </svg>
    <span class="pro-count blue"> 
        <?php if(!empty($items_counts)): ?>
            <?php echo esc_attr($items_counts) ? esc_attr($items_counts) : '&nbsp;'; else: echo esc_html('0'); ?>
        <?php endif; ?> 
    </span>
</a>
<?php
$fragments['.mini-cart-icon'] = ob_get_clean();
return $fragments;
}   
/*
**==============================   
**product image
**==============================
*/
function nest_product_image_box(){
    global $product;
    $poduct_image = get_post_thumbnail_id();
    $image_source = wp_get_attachment_image_src( $poduct_image, 'full' );
    $image_source =   ! empty( $image_source[0] ) ?  $image_source[0] : '';
    $product_image_repeats = $product->get_gallery_image_ids();
    if((function_exists('has_post_thumbnail')) && (has_post_thumbnail())):
    ?>
<div class="detail-gallery">
    <?php  if(!empty($product_image_repeats)): ?>
    <div class="galler">
        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
        <!-- MAIN SLIDES -->
        <div class="product-image-slider owl-carousel">

            <?php 
            foreach($product_image_repeats as $product_image_repeat):
                $image_source_url = wp_get_attachment_url( $product_image_repeat );	
                ?>
            <figure class="border-radius-10">
            <img data-thumb='<img src="<?php echo esc_url($image_source_url);  ?>" />' src="<?php echo esc_url($image_source_url);  ?>" alt="<?php the_title(); ?>">
         
            </figure>
            <?php endforeach;?>
           
        </div>
    </div>
    <?php else: ?>

<div class="product_thumb"><img src="<?php echo esc_url($image_source); ?>"></div>
<?php endif; ?>
</div>
<?php else: ?>
<div class="detail-gallery">
    <img src="<?php echo esc_url($image_source);  ?>" alt="product image" />
</div>
<?php
endif;

}   
/*
**==============================   
** Nest Gallery Image
**==============================
*/
function nest_get_gallery_image_html( $attachment_id, $main_image = false ) {
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail');
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', 'full' );
	$image_size        = apply_filters( 'woocommerce_gallery_image_size',   $main_image ? 'woocommerce_single' : $thumbnail_size );
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
	$image             = wp_get_attachment_image(
		$attachment_id,
		$image_size,
		false,
		apply_filters(
			'woocommerce_gallery_image_html_attachment_image_params',
			array(
				'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-src'                => esc_url( $full_src[0] ),
				'data-large_image'        => esc_url( $full_src[0] ),
				'data-large_image_width'  => esc_attr( $full_src[1] ),
				'data-large_image_height' => esc_attr( $full_src[2] ),
				'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
			),
			$attachment_id,
			$image_size,
			$main_image
		)
	);

	return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image">
    <a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
}

/*
**==================================
**  Nest nestmerce nest_mini_cart
**==================================
*/
function nest_mini_cart(){ ?>
<div class="side_bar_cart" id="mini_cart">
    <div class="cart_overlay"></div>
    <div class="cart_right_conten">

        <div class="close">
            <div class="close_btn_mini"><i class="icon-close"></i></div>
        </div>
        <div class="cart_content_box">
            <?php  
                global $woocommerce;
                ob_start();
                woocommerce_mini_cart();
                $mini_cart = ob_get_clean();
        
                $mini_content = sprintf( '	<div class="widget_shopping_cart_content">%s</div>', $mini_cart );
    
                printf(
                    '<div class="contnet_cart_box">%s</div>', 
                    $mini_content
                );
                ?>
        </div>
    </div>
</div>
<?php 
}   
/*
**==============================   
** Nest nestmerce nest_mini_cart
**==============================
*/
function nest_sales_percentage_only(){
    global $product;
    if($product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped')){
        $regular_price     = get_post_meta( $product->get_id(), '_regular_price', true ); 
        $sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
        if(!empty($sale_price)){
            $amount_saved = $regular_price - $sale_price;
            $currency_symbol = get_woocommerce_currency_symbol();
            $percentage = round((($regular_price - $sale_price ) / $regular_price ) * 100);
        ?>
    <span class="badge_type_one onsale"> <?php echo esc_attr($percentage,0, '', '').'%'; ?></span>
<?php   }
    }
} 
/*
**=========================================
** Nest nestmerce nest mini cart dropdown
**=========================================
*/
function  nest_mini_cart_dropdown($fragments){ 
   global  $woocommerce; 
    ob_start();
    $cart = WC()->cart;
    // If cart is NOT empty
    if(!empty($cart)) {
   ?>
   <div class="contnet_cart_box">
   <div class="widget_shopping_cart_content">
     <?php woocommerce_mini_cart() ?>
     </div>
     </div>
     <?php
    }
    $fragments['.contnet_cart_box'] = ob_get_clean();
    return $fragments;
        
      
}
   
/*
**====================================================
** Nest nestmerce Quick View  , Compare  , Wishlist
**====================================================
*/
add_action('nest_get_product_action_button' , 'nest_product_action_button');
function nest_product_action_button(){ 
    global $nest_theme_mod;
    $quick_view_enable = isset( $nest_theme_mod['quick_view_enable'] ) ? $nest_theme_mod['quick_view_enable'] : ''; 
    if ( $quick_view_enable == false ) {
        return false;
    }
    if(function_exists('woosq_init') || function_exists('woosc_init') || function_exists('woosw_init')){ ?>
    <ul class="product-action-1">
        <li class="q_view_btn">
            <?php global $product; ?>
            <a href="<?php echo esc_attr($product->get_id()); ?>" class="nest_quick_view_btn">
            <i class="fi-rs-eye"></i></a>
            <small><?php echo esc_html__( 'Quick view', 'steelthemes-nest' ); ?></small>
        </li>

        <?php if(function_exists('woosc_init')): ?>
        <li>
            <?php $woosc_button_text = get_option( 'woosc_button_text' );
            if ( empty( $woosc_button_text ) ) {$woosc_button_text = esc_html__( 'Compare', 'steelthemes-nest' );} ?>
            <?php echo do_shortcode('[woosc]'); ?>
            <small><?php echo esc_attr( $woosc_button_text); ?></small>
        </li>
        <?php endif; ?>
        <?php if(function_exists('woosw_init' )): ?>
        <li>
            <?php $woosw_button_text = get_option( 'woosw_button_text' );
            if ( empty( $woosw_button_text ) ) {$woosw_button_text = esc_html__( 'Wishlist', 'steelthemes-nest' );} ?>
            <?php echo do_shortcode('[woosw]'); ?>
            <small><?php echo esc_attr( $woosw_button_text); ?></small>
        </li>
        <?php endif; ?>
    </ul>
<?php
        }
    }   

/*
**========================================== 
** Nest nestmerce nest mini cart dropdown
**==========================================
*/
if(!function_exists('nest_product_single_action_button')) {
function nest_product_single_action_button(){
if(function_exists('woosc_init') || function_exists('woosw_init')){ ?>
<ul class="product-extra-link2">
    <?php if(function_exists('woosc_init')): ?>
    <li>
        <?php echo do_shortcode('[woosc]'); ?>
    </li>
    <?php endif; ?>
    <?php if(function_exists('woosw_init' )): ?>
    <li>
        <?php echo do_shortcode('[woosw]'); ?>
    </li>
    <?php endif; ?>
</ul>
<?php
        }
    }   
}
/*
**==============================   
**woocommerce sale quantity
**==============================
*/ 
add_action( 'woocommerce_product_options_general_product_data', 'nest_woocommerce_product_general_data', 10);
function nest_woocommerce_product_general_data(){
    woocommerce_wp_text_input([
        'id' => 'sale_quantity',
        'label' => __('Sale quantity', 'steelthemes-nest'),
        'type'              => 'number', 
        'custom_attributes' => array(
            'step' 	=> 'any',
            'min'	=> '0'
        ),
    ]);
    woocommerce_wp_text_input([
        'id' => 'sold_items',
        'label' => __('Sold Total Items', 'steelthemes-nest'),
        'type'              => 'number', 
        'custom_attributes' => array(
            'step' 	=> 'any',
            'min'	=> '0'
        ),
    ]);
    woocommerce_wp_text_input([
        'id' => 'sold_items_type',
        'label' => __('Sold Total Type (Kg , g , li , Ml)', 'steelthemes-nest'),
        'type'              => 'text', 
        
    ]);
}
/*
* ==============================   
**    woocommerce_process_product_meta
**==============================
*/

function nest_woocommerce_process_product_meta($post_id){
    $product = wc_get_product($post_id);
	  $woosale_quantity = isset($_POST['sale_quantity']) ? $_POST['sale_quantity'] : '';
	  $product->update_meta_data('sale_quantity', sanitize_text_field($woosale_quantity));
      $woosold_items = isset($_POST['sold_items']) ? $_POST['sold_items'] : '';
	  $product->update_meta_data('sold_items', sanitize_text_field($woosold_items));
      $sold_items_type = isset($_POST['sold_items_type']) ? $_POST['sold_items_type'] : '';
	  $product->update_meta_data('sold_items_type', sanitize_text_field($sold_items_type));
	  $product->save();
}  

/*
* ==============================   
**   woocommerce product meta
**==============================
*/
add_action( 'get_nest_woocommerce_other_product_meta' , 'nest_woocommerce_other_product_meta' );
function nest_woocommerce_other_product_meta(){
global $product;
global $nest_theme_mod;
if(get_post_meta(get_the_ID() , 'product_data_enable', true) == true): 
    $product_type = get_post_meta(get_the_ID() , 'product_type', true);
    $product_mfg = get_post_meta(get_the_ID() , 'product_mfg', true);
    $product_life = get_post_meta(get_the_ID() , 'product_life', true);
?>
    <?php if(!empty($product_type) || !empty($product_mfg) || !empty($product_life)): ?>
    <div class="product_meta right_move">
        <?php if(!empty($product_type)): ?>
        <span class="pro_typ"><?php echo esc_html__('Type:', 'steelthemes-nest'); ?>
            <span class="metadatacustom"><?php echo esc_attr($product_type); ?></span></span>
        <?php endif; ?>
        <?php if(!empty($product_mfg)): ?>
        <span class="pro_mfg"><?php echo esc_html__('MFG:', 'steelthemes-nest'); ?>
            <span class="metadatacustom"><?php echo esc_attr($product_mfg); ?></span></span>
        <?php endif; ?>
        <?php if(!empty($product_life)): ?>
        <span class="pro_life"><?php echo esc_html__('LIFE:', 'steelthemes-nest'); ?>
            <span class="metadatacustom"><?php echo esc_attr($product_life); ?></span></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
<?php 
endif;
}

/*
* ==============================   
**   woocommerce product Message
**==============================
*/

add_action( 'get_nest_woocommerce_other_product_message' , 'nest_woocommerce_other_product_message' );
function nest_woocommerce_other_product_message(){
global $product;
global $nest_theme_mod;
if(get_post_meta(get_the_ID() , 'product_message_enable', true) == true): 
    $product_message_title = get_post_meta(get_the_ID() , 'product_message_titles', true);
    $product_message_content = get_post_meta(get_the_ID() , 'product_message_content', true);
?>
    <?php if(!empty($product_message_content) || !empty($product_message_title)): ?>
    <div class="product_message">
    <?php if(!empty($product_message_title)): ?>
        <h6><?php echo esc_attr($product_message_title); ?></h6>
        <?php endif; ?>
    <?php if(!empty($product_message_content)): ?>
        <ul>
      <?php $product_message_contents = explode("\n", ($product_message_content));?>
      <?php foreach($product_message_contents as $product_message_content):?>
        <li>
            <i class="fi-rs-check"></i> <span> <?php echo wp_kses($product_message_content, true); ?></span>
        </li>
      <?php endforeach; ?>
      </ul>
     <?php endif; ?>
    </div>
    <?php endif; ?>
<?php 
endif;
}

/*
* ==============================   
**   woocommerce product advertisement
**==============================
*/
add_action( 'get_nest_woocommerce_other_product_add' , 'nest_woocommerce_other_product_add' );
function nest_woocommerce_other_product_add(){
global $product;
global $nest_theme_mod;
if(get_post_meta(get_the_ID() , 'product_add_image_enable', true) == true):
    $product_add_image = get_post_meta(get_the_ID() , 'product_add_image', true);
    $product_add_images =  $product_add_image['url'];
    if(!empty($product_add_images)):
        $product_add_image_link = get_post_meta(get_the_ID() , 'product_add_image_link', true);
        
?>
<div class="single_advertisement mt-15">
    <a href="<?php echo esc_url($product_add_image_link); ?>">
        <img src="<?php echo esc_url($product_add_images); ?>" alt="<?php echo esc_attr('advertisement' , 'steelthemes-nest'); ?>"  class="img-fluid" />
    </a>
</div>
<?php 
 endif;
endif;
}




/*
* ==============================   
**   woocommerce product Video
**==============================
*/
add_action( 'get_nest_woocommerce_other_product_video' , 'nest_woocommerce_other_product_video' );
function nest_woocommerce_other_product_video(){
global $product;
$allowed_tags = wp_kses_allowed_html('post');
global $nest_theme_mod;
$product_video_link = 'http://www.youtube.com/watch?v=0O2aH4XLbto';
if(!empty(get_post_meta(get_the_ID() , 'product_video_link', true))){
    $product_video_link = get_post_meta(get_the_ID() , 'product_video_link', true);
}

if(get_post_meta(get_the_ID() , 'product_video_enable', true) == true):    
if(get_post_meta(get_the_ID() , 'product_video_styles', true) == 'style_one'): 
    $porduct_video_text = get_post_meta(get_the_ID() , 'porduct_video_texts', true);
?>
    <div class="video_box_style_one">
        <a class="popup-video" href="<?php echo esc_attr($product_video_link); ?>">
            <?php echo wp_kses($porduct_video_text , $allowed_tags); ?>
        </a> 
    </div>
    <?php elseif(get_post_meta(get_the_ID() , 'product_video_styles', true) == 'style_two'):  ?>
    <div class="video_box_style_two">
        <?php if(get_post_meta(get_the_ID() , 'product_video_types', true) == 'iframe'):  ?>    
            <iframe  src="<?php echo esc_attr($product_video_link); ?>"  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
        <?php elseif(get_post_meta(get_the_ID() , 'product_video_types', true) == 'video'):  ?>
            <video autoplay="" loop="" controls="" width="640" height="480">
                <source type="video/mp4" src="<?php echo esc_attr($product_video_link); ?>">
            </video>
        <?php endif;  ?>
    </div>
<?php endif;  ?>
<?php 
endif;
} 
 
/*
**==============================   
**  product header list grid view and filter
**==============================
*/
 
 
function nest_get_view_via_url() { 
    $nest_views  = isset( $_GET['view'] ) ? $_GET['view'] : '';
	if($nest_views){
		return $nest_views;
	}
}
add_action( 'nest_inside_shop_loop', 'nest_before_shop_loop');
/**
 * Shop Loop Header
 */
if(!function_exists('nest_before_shop_loop' )):
function nest_before_shop_loop(){ 
global $nest_theme_mod;
?>
<div class="woo_products_header clearfix"> 
    <ul class="filter_end">
        <?php if(!empty($nest_theme_mod['filter_content_enable']) == true): ?> 
            <li class="nest_filter_btn">    
                <i class="fi-rs-filter"></i> <span> <?php echo esc_html__('Filter' , 'steelthemes-nest'); ?></span>
            </li>
         <?php endif; ?>
        <?php if(!empty($nest_theme_mod['grid_list_vide_enable']) == true): ?> 
        <li class="view_grid">
        <div class="d-flex">
            <a class="view-type-grid mr-5 <?php if ( ! isset( $_GET['view'] ) || $_GET['view'] === 'grid-view' ) : ?>active<?php endif; ?>"
                href="<?php echo esc_url( add_query_arg( array( 'view' => 'grid-view' ) ) );?>">
                <i class="fi-rs-grid"></i>
            </a>
            <a class="view-type-list <?php if ( isset( $_GET['view'] ) && $_GET['view'] === 'list-view' ) : ?>active<?php endif; ?>"
                href="<?php echo esc_url( add_query_arg( array( 'view' => 'list-view' ) ) );?>">
                <i class="fi-rs-list"></i>
            </a>
        </div>
</li> 
         <?php endif; ?>
        <?php if(!empty($nest_theme_mod['per_page_enable']) == true): ?>
            <li><?php do_action('nest_get_per_page_product'); ?></li>
        <?php endif; ?>
    </ul>
</div> 
<?php }
endif;

function nest_get_per_page_option() {
	$getopt = isset($_GET['per_page']) ? $_GET['per_page'] : '';
	return esc_html($getopt);
}

add_action('nest_get_per_page_product', 'nest_custom_products_per_page_dropdown', 20);
function nest_custom_products_per_page_dropdown() {
	$per_page = nest_get_per_page_option();
	$getper_page = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page();
	$options = array($getper_page, $getper_page * 2, $getper_page * 3, $getper_page * 4 , $getper_page * 5 , $getper_page * 6  , $getper_page * 7 , $getper_page * 8 , $getper_page * 9 , $getper_page * 10);
	?>
	<div class="products-per-page-box d-flex align-items-center">
		<span><?php esc_html_e('Show:', 'steelthemes-nest'); ?></span>
		<form class="products-per-page" method="get">
			<select name="per_page" class="per_page orderby" data-class="select-filter-per_page" onchange="this.form.submit()">
				<?php foreach ($options as $option) : ?>
					<option value="<?php echo esc_attr($option); ?>" <?php selected($per_page, $option); ?>><?php echo esc_html($option); ?></option>
				<?php endforeach; ?>
			</select>
			<?php wc_query_string_form_fields(null, array('per_page', 'submit', 'paged', 'product-page')); ?>
		</form>
	</div>
	<?php
}

add_action('pre_get_posts', 'nest_custom_products_per_page');
function nest_custom_products_per_page($query) {
	if (!is_admin() && $query->is_main_query()) {
		$per_page = nest_get_per_page_option();
		if ($per_page) {
			$query->set('posts_per_page', $per_page);
		}
	}
}

/*
**==============================   
**  product header list grid view and filter
**==============================
*/
add_action('get_nest_product_deals', 'nest_product_deals');
function nest_product_deals() {
    global $product;
    $allowed_tags = wp_kses_allowed_html('post');
    $product_deals_text = get_post_meta(get_the_ID() , 'product_deals_text', true);
    $product_deals_date = get_post_meta(get_the_ID() , 'product_deals_date', true);
    ?>
    <?php if(!empty($product_deals_text) || !empty($product_deals_date)): ?>
        <div class="deals_box">
        <?php if(!empty($product_deals_text)): ?>
            <div class="deals_title">
                <?php echo esc_attr($product_deals_text); ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($product_deals_date)): ?>
                <div class="deal_box">
                    <div class="deals-countdown" data-countdown="<?php echo esc_attr($product_deals_date); ?>"></div>
                </div>
            <?php endif; ?>
        </div>           
    <?php endif; ?>
<?php 
} 
/*
**=============================================   
**  product header list grid view and filter
**=============================================
*/
add_filter( 'wc_add_to_cart_message', 'nest_wc_add_to_cart_message', 10, 2 );
add_filter( 'woocommerce_add_to_cart_message', 'nest_add_product_image_to_cart_message', 10, 2 );
function nest_add_product_image_to_cart_message( $message, $product_id ) {
    $product = wc_get_product( $product_id );
    $image = $product->get_image();
    $message .= sprintf( '<div class="product-image">%s</div>', $image );
    return $message;
}
function nest_wc_add_to_cart_message( $message, $product_id ) {
    $product = wc_get_product( $product_id );
    $image_html = '';
    if ( $product ) {
        $image_url = wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' );
        if ( $image_url ) {
            $image_html = '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" />';
        }
    }
    $message .= '<div class="product-image">' . $image_html . '</div>';
    return $message;
}
 
/*
**=============================================   
**  product header list grid view and filter
**=============================================
*/
add_filter( 'woocommerce_output_related_products_args', 'related_products_count' );
function related_products_count( $args ) {
    global $nest_theme_mod;
    $related_post_count_woo = isset( $nest_theme_mod['related_post_count_woo'] ) ? $nest_theme_mod['related_post_count_woo'] : '';
    $args['posts_per_page'] = $related_post_count_woo;
    return $args;
}

/*
**=============================================   
**  get_option through url
**=============================================
*/
function nest_get_product_card_option_via_url() {
    $productstyle  = isset( $_GET['product-style'] ) ? $_GET['product-style'] : '';
	if($productstyle){
		return $productstyle;
	}
}

function nest_get_spagination_option_via_url() { 
    $shoppaginationstyle  = isset( $_GET['shop-pagination-style'] ) ? $_GET['shop-pagination-style'] : '';
	if($shoppaginationstyle){
		return $shoppaginationstyle;
	}
}
/*
**=============================================   
**  remove and add pagination
**=============================================
*/
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
add_action('woocommerce_after_shop_loop', 'nest_custom_funtion_pageload', 10);
function nest_custom_funtion_pageload(){
    global $nest_theme_mod , $product;
    $product_paginaion_type = isset( $nest_theme_mod['product_paginaion_type'] ) ? $nest_theme_mod['product_paginaion_type'] : '';
    ?>
    <?php  if($product_paginaion_type == 'loadmore' || nest_get_spagination_option_via_url()  == 'loadmore'): ?>
        <div class="woo_pagination text-center loadmoreproduct">
        <div class="padyopextra_30"></div>
            <?php global $wp_query;
              if ($wp_query->max_num_pages > 1):
                echo '<div class="woocommerce-pagination button">';
                $next_link = get_next_posts_link( esc_html_e('Load More' , 'steelthemes-nest'), $wp_query->max_num_pages );
                if ( $next_link ) {
                    echo $next_link;
                }
                echo '</div>';
            endif;
           ?>
        </div>
    <?php elseif($product_paginaion_type == 'infinite' || nest_get_spagination_option_via_url()  == 'infinite'): ?>
        <div class="woo_pagination scrollproduct">
            <div class="padyopextra_30">
            </div>
            <div class="scroller-status">
            <div class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
            <p class="scroller-status__message infinite-scroll-last"><?php echo esc_html_e('No more Products to load' , 'steelthemes-nest'); ?></p>
            </div>
            <?php woocommerce_pagination(); ?>
        </div>
    <?php else: ?>
        <div class="woo_pagination">
            <div class="padyopextra_30"></div>
            <?php woocommerce_pagination(); ?>
        </div>
    <?php endif; ?>
    <?php
}  
/*
**=============================================   
**  Add category, brand, and attribute filter dropdowns
**=============================================
*/
 
function nest_add_category_brand_and_attribute_filter_dropdowns() {
    $categories = get_categories( array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false,
    ) );

    $terms = get_terms( 'brand' );

    $attributes = wc_get_attribute_taxonomies();

    if ( ! empty( $categories ) || ! empty( $terms ) || ! empty( $attributes ) ) {
        $product_page_url = get_permalink( wc_get_page_id( 'shop' ) ); // Get the URL of the product page

        echo '<div class="nest_filter_box">';
        echo '<form method="get" action="' . esc_url( $product_page_url ) . '">';
        echo '<div class="left_s">';
        echo '<select name="product_cat" class="noselectwo">';
        echo '<option value="">' . esc_attr__('All Categories' , 'steelthemes-nest') .'</option>';
        foreach ( $categories as $category ) {
            echo '<option value="' . esc_attr( $category->slug ) . '"' . selected( $category->slug, isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '', false ) . '>' . esc_html( $category->name ) . '</option>';
        }
        echo '</select>';

        if ( ! empty( $terms ) ) {
            echo '<select name="brand_filter" class="noselectwo">';
            echo '<option value="">' . esc_attr__('All Brands' , 'steelthemes-nest') .'</option>';
            foreach ( $terms as $term ) {
                echo '<option value="' . esc_attr( $term->slug ) . '"' . selected( $term->slug, isset( $_GET['brand_filter'] ) ? $_GET['brand_filter'] : '', false ) . '>' . esc_html( $term->name ) . '</option>';
            }
            echo '</select>';
        }

        foreach ( $attributes as $attribute ) {
            $attribute_taxonomy = 'pa_' . $attribute->attribute_name;
            $attribute_terms = get_terms( $attribute_taxonomy );

            if ( ! empty( $attribute_terms ) ) {
                echo '<select name="' . esc_attr( $attribute_taxonomy ) . '_filter" class="attribute_filter noselectwo">';
                echo '<option value="">' . esc_attr__('All' , 'steelthemes-nest').' ' . esc_html( $attribute->attribute_label ) . '</option>';

                foreach ( $attribute_terms as $term ) {
                    $term_id = $term->term_id;
                    $term_name = $term->name;
                    $term_slug = $term->slug;
                    $term_value = get_term_meta( $term_id, 'attribute_pa_' . $attribute->attribute_name, true );
                    echo '<option value="' . esc_attr( $term_slug ) . '"' . selected( $term_slug, isset( $_GET[ $attribute_taxonomy . '_filter' ] ) ? $_GET[ $attribute_taxonomy . '_filter' ] : '', false ) . '>' . esc_html( $term_name ) . ' (' . esc_html( $term_value ) . ')</option>';
                }
                echo '</select>';
            }
        }
        echo '</div>';
        echo '<div class="right_s">';
        echo '<input type="submit" value="' . esc_attr__('Filter' , 'steelthemes-nest') .'">';
        echo '<input type="button" value="' . esc_attr__('Reset Filters' , 'steelthemes-nest') .'" onclick="window.location.href = \'' . esc_url( $product_page_url ) . '\';">';
        echo '<input type="hidden" name="post_type" value="product">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }
}
add_action( 'nest_after_shop_loop_fliter', 'nest_add_category_brand_and_attribute_filter_dropdowns' );


// Apply category, brand, and attribute filters to product query
function apply_category_brand_and_attribute_filters_to_product_query( $q ) {
    if ( isset( $_GET['product_cat'] ) && ! empty( $_GET['product_cat'] ) ) {
        $category_filter = sanitize_text_field( $_GET['product_cat'] );
        $tax_query[] = array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => $category_filter,
        );
    }
    if ( isset( $_GET['brand_filter'] ) && ! empty( $_GET['brand_filter'] ) ) {
        $brand_filter = sanitize_text_field( $_GET['brand_filter'] );
        $tax_query[] = array(
            'taxonomy' => 'brand',
            'field' => 'slug',
            'terms' => $brand_filter,
        );
    }
    $attributes = wc_get_attribute_taxonomies();
    foreach ( $attributes as $attribute ) {
        $attribute_taxonomy = 'pa_' . $attribute->attribute_name;

        if ( isset( $_GET[ $attribute_taxonomy . '_filter' ] ) && ! empty( $_GET[ $attribute_taxonomy . '_filter' ] ) ) {
            $attribute_filter = sanitize_text_field( $_GET[ $attribute_taxonomy . '_filter' ] );
            $tax_query[] = array(
                'taxonomy' => $attribute_taxonomy,
                'field' => 'slug',
                'terms' => $attribute_filter,
            );
        }
    }
    if ( isset( $tax_query ) ) {
        $tax_query['relation'] = 'AND';
        $q->set( 'tax_query', $tax_query );
    }
}
add_action( 'woocommerce_product_query', 'apply_category_brand_and_attribute_filters_to_product_query' );
/*
**====================================================================   
** Sticky Add to cart for product single only for product type simple
**====================================================================   
*/
add_action('nest_get_sticky_addtocart', 'nest_sticky_addtocart', 10, 1);
function nest_sticky_addtocart($product) {
    if (is_singular('product') && $product->is_type('simple')) :
        ?>
 <div class="sticky_sigle_add_to_cart">
        <div class="product-title-price">
            <div class="product-title"><?php the_title(); ?></div>
            <span class="product-price"><?php echo $product->get_price_html(); ?></span>
        </div>

        <div class="sticky-add-to-cart-container">
          
            <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype="multipart/form-data">
                <?php woocommerce_quantity_input(array('input_value' => 1)); ?>
                <button type="submit" name="add-to-cart"  value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html__('Add to Cart', 'steelthemes-nest'); ?></button>
                <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>">
            </form>

        </div>
        </div>
    <?php endif;
}

/*
**====================================================================   
** Add text for translation
**====================================================================   
*/
add_action('wp_enqueue_scripts', 'nest_add_css' );
function nest_add_css(){
    $add_css = '';
    $add_css .= 'body .product-type-simple .product-cart-wrap.style_one .product-card-bottom .add-cart a::before, body .product-type-simple .product-cart-wrap.deals_style_one .product-card-bottom .add-cart a::before {content:"'.esc_html__('Add' , 'steelthemes-nest').'"!important;}';
    wp_add_inline_style('nest-main-style', $add_css);
}

 