<?php
/*
=======================
 Woocommerce Settings
=======================
*/
Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Woocommerce Settings', 'steelthemes-nest' ),
        'id'     => 'woocommerce_settings',
        'desc'   => esc_html__( '', 'steelthemes-nest' ),
        'icon'   => 'el el-wrench',
        'fields' => array(

            array(
                'id' => 'woocommerce-archive-settings',
                'type' => 'section',
                'title' => __('Woocommerce Archive  Settings', 'steelthemes-nest'),
                'indent' => true 
            ), 
            
            array(
                'id'    => 'product_archive_style',
                'type'  => 'select',
                'title' => esc_html__( 'Archive Product Style' , 'steelthemes-nest' ),
                'options'  => array(
                    'style_one' => esc_html__( 'Style One (Default)', 'steelthemes-nest' ),
                    'style_two' => esc_html__( 'Style Two', 'steelthemes-nest' ),
                    'style_three' => esc_html__( 'Style Three ', 'steelthemes-nest' ),
                    'style_four' => esc_html__( 'Style Four ', 'steelthemes-nest' ),
                    'style_five' => esc_html__( 'Style Five ', 'steelthemes-nest' ),
                ),
                'default'  => 'style_one',
            ),

            array(
                'id'       => 'filter_content_enable',
                'type'     => 'switch', 
                'title'    => __('Filter Button Enable  / Disable In Shop Page', 'steelthemes-nest'),
                'default'  => true,
            ),  
            array(
                'id'       => 'grid_list_vide_enable',
                'type'     => 'switch', 
                'title'    => __('Grid / List View Enable  / Disable In Shop Page', 'steelthemes-nest'),
                'default'  => true,
            ),  
          
            array(
                'id'       => 'per_page_enable',
                'type'     => 'switch', 
                'title'    => __('Select Products Per Page View Enable  / Disable In Shop Page', 'steelthemes-nest'),
                'default'  => true,
            ),   
            array(
                'id'       => 'filter_deep_content_enable',
                'type'     => 'switch', 
                'title'    => __('Select Filter Enable  / Disable In Shop Page', 'steelthemes-nest'),
                'default'  => true,
            ),  
            array(
                'id'       => 'active_filters',
                'type'     => 'switch', 
                'title'    => __('Active Filter Enable  / Disable In Shop Page', 'steelthemes-nest'),
                'default'  => true,
            ),
            array(
                'id'       => 'recently_viewd_poducts',
                'type'     => 'switch', 
                'title'    => __('Recently Viewed Products Enable  / Disable In Shop Page', 'steelthemes-nest'),
                'default'  => true,
            ),
            array(
                'id'       => 'recent_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Recently Viewd Products Title', 'steelthemes-nest' ),
                'default' => esc_html__('Recently Viewd Products', 'steelthemes-nest') ,
                'required' => array('recently_viewd_poducts', '=', true),
            ),
            
            array(
                'id'    => 'filter_alignment',
                'type'  => 'select',
                'title' => esc_html__( 'Fliter Alignment' , 'steelthemes-nest' ),
                'options'  => array(
                    'flex-start' => esc_html__( 'Start', 'steelthemes-nest' ),
                    'center' => esc_html__( 'Center', 'steelthemes-nest' ),
                    'flex-end' => esc_html__( 'End', 'steelthemes-nest' ), 
                ),
                'default'  => 'flex-start',
            ),
            array(
                'id' => 'woocommerce-single-settings',
                'type' => 'section',
                'title' => __('Woocommerce Single  Settings', 'steelthemes-nest'),
                'indent' => true 
            ),  
            array(
                'id'    => 'product_single_style',
                'type'  => 'select',
                'title' => esc_html__( 'Product Single Style' , 'steelthemes-nest' ),
                'options'  => array(
                    'style_one' => esc_html__( 'Style One (Default)', 'steelthemes-nest' ),
                    'style_two' => esc_html__( 'Style Two', 'steelthemes-nest' ),
                    'style_three' => esc_html__( 'Style Three ', 'steelthemes-nest' ),
                    'style_four' => esc_html__( 'Style Four ', 'steelthemes-nest' ),
                ),
                'default'  => 'style_one',
            ),
            array(
                'id'       => 'stickt_add_to_cart',
                'type'     => 'switch', 
                'title'    => __('Stick Add to cart Enable / Disable In Shop Single', 'steelthemes-nest'),
                'default'  => true,
            ),  
          
            array(
                'id'       => 'product_paginaion_type',
                'type'     => 'button_set',
                'title'    => __('Pagination , Load More or Infinite Product Scroll', 'steelthemes-nest'),
                //Must provide key => value pairs for options
                'options' => array(
                    'pagination' => esc_html__( 'Woocommerce Product Pagination', 'steelthemes-nest' ),
                    'loadmore' => esc_html__( 'Woocommerce Product Loadmore', 'steelthemes-nest' ), 
                    'infinite' => esc_html__( 'Woocommerce Product Infinite Scroll', 'steelthemes-nest' ),
                 ), 
                'default' => 'pagination'
            ),

            array(
                'id' => 'woocommerce-related-settings',
                'type' => 'section',
                'title' => __('Related Posts', 'steelthemes-nest'),
                'indent' => true 
            ), 
            array(
                'id'       => 'related_post_count_woo',
                'type'     => 'text',
                'title'    => esc_html__( 'Related Post Count', 'steelthemes-nest' ),
                'default' => esc_html__('3', 'steelthemes-nest') ,
            ),
            
            array(
                'id' => 'woocommerce-deals-settings',
                'type' => 'section',
                'title' => __('Deals Text Changing', 'steelthemes-nest'),
                'indent' => true 
            ), 
           
            
            array(
                'id'       => 'deal_day',
                'type'     => 'text',
                'title'    => esc_html__( 'Days', 'steelthemes-nest' ),
                'default' => esc_html__('Days', 'steelthemes-nest') ,
            ),
            array(
                'id'       => 'deal_hours',
                'type'     => 'text',
                'title'    => esc_html__( 'Hours', 'steelthemes-nest' ),
                'default' => esc_html__('Hours', 'steelthemes-nest') ,
            ),
            array(
                'id'       => 'deal_min',
                'type'     => 'text',
                'title'    => esc_html__( 'Minutes', 'steelthemes-nest' ),
                'default' => esc_html__('Mins', 'steelthemes-nest') ,
            ),
            array(
                'id'       => 'deal_sec',
                'type'     => 'text',
                'title'    => esc_html__( 'Secs', 'steelthemes-nest' ),
                'default' => esc_html__('Secs', 'steelthemes-nest') ,
            ),   
            
        ),
    )
);