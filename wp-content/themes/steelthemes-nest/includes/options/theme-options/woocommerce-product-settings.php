<?php
/*
=======================
 Woocommerce Settings
=======================
*/
Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Product Card Settings', 'steelthemes-nest' ),
        'id'     => 'woocommerce_product_settings',
        'desc'   => esc_html__( '', 'steelthemes-nest' ),
        'icon'   => 'el el-wrench',
        'subsection' => true ,
        'fields' => array(

            array(
                'id' => 'woocommerce-product-card-settings',
                'type' => 'section',
                'title' => __('Woocommerce Product Card  Settings', 'steelthemes-nest'),
                'indent' => true 
            ), 
            array(
                'id'       => 'image_size_enable',
                'type'     => 'switch', 
                'title'    => __('Product Image Resize Enable / Disable', 'steelthemes-nest'),
                'default'  => false,
            ), 
            array(
                'id'       => 'pro_image_size',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Card Image size ( Desktop )', 'steelthemes-nest' ), 
                'default' => esc_html__('150px', 'steelthemes-nest') ,  
                'desc' => esc_html__('Enter the image size like this 100px or 120px or 150px', 'steelthemes-nest') , 
                'required' => array('image_size_enable', '=', true),
            ), 
            array(
                'id'       => 'mdpro_image_size',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Card Image size ( Mobile )', 'steelthemes-nest' ), 
                'default' => esc_html__('150px', 'steelthemes-nest') ,  
                'desc' => esc_html__('Enter the image size like this 100px or 120px or 150px', 'steelthemes-nest') , 
                'required' => array('image_size_enable', '=', true),
            ), 
            array(
                'id'       => 'product_title_resize',
                'type'     => 'switch', 
                'title'    => __('Product Title Resize Enable / Disable', 'steelthemes-nest'),
                'default'  => false,
            ), 
            array(
                'id'       => 'text_over_flow_size',
                'type'     => 'text',
                'title'    => esc_html__( 'Title Text Overflow Size', 'steelthemes-nest' ), 
                'default' => esc_html__('2', 'steelthemes-nest') ,  
                'desc' => esc_html__('Enter the numbers like this 2 or 3 or 4', 'steelthemes-nest') ,  
                'required' => array('product_title_resize', '=', true),
            ), 
            array(
                'id'       => 'title_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Title Height', 'steelthemes-nest' ), 
                'default' => esc_html__('50px', 'steelthemes-nest') ,  
                'desc' => esc_html__('Enter the numbers like this 30px or 40px 0r 50px', 'steelthemes-nest') ,  
                'required' => array('product_title_resize', '=', true),
            ), 
            array(
                'id'       => 'rating_enable',
                'type'     => 'switch', 
                'title'    => __('Rating Enable / Disable', 'steelthemes-nest'),
                'default'  => true,
            ),  
            array(
                'id'       => 'category_enable',
                'type'     => 'switch', 
                'title'    => __('Category Enable  / Disable', 'steelthemes-nest'),
                'default'  => true,
            ),  
            array(
                'id'       => 'brand_enable',
                'type'     => 'switch', 
                'title'    => __('Brand Enable View Enable  / Disable', 'steelthemes-nest'),
                'default'  => true,
            ),    
            array(
                'id'    => 'brand_type',
                'type'  => 'select',
                'title' => esc_html__( 'Brand Type' , 'steelthemes-nest' ),
                'options'  => array(
                    'title' => esc_html__( 'Show Title', 'steelthemes-nest' ),
                    'image' => esc_html__( 'Show Brand image', 'steelthemes-nest' ),
                ),
                'default'  => 'title',
            ),
            array(
                'id'       => 'quick_view_enable',
                'type'     => 'switch', 
                'title'    => __('Quick View , Compare and  Wishlish Enable  / Disable ', 'steelthemes-nest'),
                'default'  => true,
            ), 
            
            array(
                'id'       => 'add_to_cart_enable_disable',
                'type'     => 'switch', 
                'title'    => __('Add to cart Enable  / Disable ', 'steelthemes-nest'),
                'default'  => true,
            ),  

            array(
                'id'       => 'short_description_enable',
                'type'     => 'switch', 
                'title'    => __('Short Description Enable  / Disable ', 'steelthemes-nest'),
                'default'  => true,
            ),

            array(
                'id'       => 'sold_items_enable',
                'type'     => 'switch', 
                'title'    => __('Sold Items Progress Bar Enable  / Disable ', 'steelthemes-nest'),
                'default'  => true,
            ),

            array(
                'id'    => 'sold_type',
                'type'  => 'select',
                'title' => esc_html__( 'Sold Type' , 'steelthemes-nest' ),
                'options'  => array(
                    'default' => esc_html__( 'Default based on avilable products and sold products', 'steelthemes-nest' ),
                    'bymeta' => esc_html__( 'By using meta option Manually', 'steelthemes-nest' ),
                ),
                'default'  => 'bymeta',
            ),

            array(
                'id'       => 'badge_enable',
                'type'     => 'switch', 
                'title'    => __('Badge Enable  / Disable ', 'steelthemes-nest'),
                'default'  => true,
            ),
            array(
                'id'       => 'vendor_name_enable',
                'type'     => 'switch', 
                'title'    => __('Vendor Store Name Enable  / Disable ', 'steelthemes-nest'),
                'default'  => true,
            ),
        ),
    )
);