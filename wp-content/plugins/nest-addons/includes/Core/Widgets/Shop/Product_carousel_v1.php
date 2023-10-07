<?php

namespace  Nestaddons\Core\Widgets\Shop;

if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.

class Product_carousel_v1 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'nest-product-carousel-v1';
    }

    public function get_title()
    {
        return __('Product   Carousel V1', 'nest-addons');
    }

    public function get_icon()
    {
        return 'icon-letter-n';
    }

    public function get_categories()
    {
        return ['103'];
    }

    protected function register_controls(){
 
        // style one start
        $this->start_controls_section('product_carsousel_v1_settings',
        [ 
            'label' => __('Product Content', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        ); 
        $this->add_control(
            'product_style',
            [
                'label' => __('Shop style', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_one'   => esc_html__( 'Style One', 'nest-addons' ),
                    'style_two'   => esc_html__( 'Style Two', 'nest-addons' ),
                    'style_three'   => esc_html__( 'Style Three', 'nest-addons' ),
                    'style_four'   => esc_html__( 'Style Four', 'nest-addons' ),
                    'style_five'   => esc_html__( 'Style Five', 'nest-addons' ),
                ],
                'default' => 'style_one',
            ]
        );
        $this->add_control(
            'border_radius_enable',
           [
              'label' => __('Box Border Radius Enable / Disable', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => __('Yes', 'nest-addons'),
               'label_off' => __('No', 'nest-addons'),
               'return_value' => 'yes',
               'default' => 'yes',
               'condition' => [
                'product_style' => 'style_three'
            ], 
           ]
        );
       
        $this->add_responsive_control(
			'tab_align',
			[
				'label' => esc_html__( 'Tab Alignment', 'nest-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'nest-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'nest-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'nest-addons' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .product-tabs_two .section_tab ' => 'text-align: {{VALUE}}!important;',
                ],
			]
		);
 
     
     
        $this->add_control(
            'post_count',
            [
                'label' => __('Post Count', 'nest-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
            ]
        );
       
        $this->add_control(
			'query_orderby',
			[
				'label'   => esc_html__( 'Order By', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
                    ''  => esc_html__( 'Default', 'nest-addons' ),
					'date'       => esc_html__( 'Date', 'nest-addons' ),
					'title'      => esc_html__( 'Title', 'nest-addons' ),
					'menu_order' => esc_html__( 'Menu Order', 'nest-addons' ),
					'rand'       => esc_html__( 'Random', 'nest-addons' ),
				),
			]
		);
		$this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
                    ''  => esc_html__( 'Default', 'nest-addons' ),
					'DESC' => esc_html__( 'DESC', 'nest-addons' ),
					'ASC'  => esc_html__( 'ASC', 'nest-addons' ),
				),
			]
        );
      
        $this->add_control(
            'query_category', 
				[
                    'type' => \Elementor\Controls_Manager::SELECT2, // Use SELECT2 for multiple select
                    'label' => esc_html__('Category', 'nest-addons'),
                    'options' => nest_get_product_categories(),
                    'multiple' => true, // Enable multiple select
				]
        );

        $this->add_control(
            'product_options_showing',
            [
                'label'   => esc_html__( 'Products', 'nest-addons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    ''   => esc_html__( 'Select Options', 'nest-addons' ),
                    'featured'     => esc_html__( 'Featured', 'nest-addons' ),
                    'best_selling' => esc_html__( 'Best Selling', 'nest-addons' ),
                    'sale'         => esc_html__( 'On Sale', 'nest-addons' ),
                    'outofstock'   => esc_html__( 'Out Of Stock', 'nest-addons' ),
                    'price_low_high' => esc_html__( 'Price Low to High', 'nest-addons' ),
                    'price_high_low' => esc_html__( 'Price High to Low', 'nest-addons' ),
                ],
                'default' => '',
                'toggle'  => false,
            ]
        );
        
        $this->add_control(
            'product_not_in',
            [
                'label'       => esc_html__( 'Product Not In', 'nest-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default' =>  esc_html__( '' , 'nest-addons'),
            ]
        );
 
    $this->end_controls_section(); 

       // carouse settings
       $this->start_controls_section('carousel_settings',
       [ 
           'label' => __('Carousel Settings', 'nest-addons'),
           'tab' => \Elementor\Controls_Manager::TAB_CONTENT, 
       ]
   ); 
   $this->add_control(
       'desktop',
         [
         'label' => __('Items Desktop', 'nest-addons'),
         'type' => \Elementor\Controls_Manager::SELECT,
         'options' => [
             '10' => __('10 Items', 'nest-addons'),
             '9' => __('9 Items', 'nest-addons'),
             '8' => __('8 Items', 'nest-addons'),
             '7' => __('7 Items', 'nest-addons'),
             '6' => __('6 Items', 'nest-addons'),
             '5' => __('5 Items', 'nest-addons'),
             '4' => __('4 Items', 'nest-addons'),
             '3' => __('3 Items', 'nest-addons'),
             '2' => __('2 Items', 'nest-addons'),
             '1' => __('1 Items', 'nest-addons'),
         ],
         'default' => '4' , 
         ]
     );

     $this->add_control(
         'tablet',
           [
           'label' => __('Items Tablet', 'nest-addons'),
           'type' => \Elementor\Controls_Manager::SELECT,
           'options' => [
               '10' => __('10 Items', 'nest-addons'),
               '9' => __('9 Items', 'nest-addons'),
               '8' => __('8 Items', 'nest-addons'),
               '7' => __('7 Items', 'nest-addons'),
               '6' => __('6 Items', 'nest-addons'),
               '5' => __('5 Items', 'nest-addons'),
               '4' => __('4 Items', 'nest-addons'),
               '3' => __('3 Items', 'nest-addons'),
               '2' => __('2 Items', 'nest-addons'),
               '1' => __('1 Items', 'nest-addons'),
           ],
           'default' => '4' , 
           ]
       );
       $this->add_control(
         'mobile',
           [
           'label' => __('Items Mobile', 'nest-addons'),
           'type' => \Elementor\Controls_Manager::SELECT,
           'options' => [
               '3' => __('3 Items', 'nest-addons'),
               '2' => __('2 Items', 'nest-addons'),
               '1' => __('1 Items', 'nest-addons'),
           ],
           'default' => '3' , 
           ]
       );
       $this->add_control(
           'mini',
             [
             'label' => __('Items Mini', 'nest-addons'),
             'type' => \Elementor\Controls_Manager::SELECT,
             'options' => [
                 '3' => __('3 Items', 'nest-addons'),
                 '2' => __('2 Items', 'nest-addons'),
                 '1' => __('1 Items', 'nest-addons'),
             ],
             'default' => '2' , 
             ]
       );
       $this->add_control(
           'op_hr_1',
           [
               'type' => \Elementor\Controls_Manager::DIVIDER, 
           ]
       );
       $this->add_control(
           'loop',
           [
               'label' => __('Loop Enable / Disable', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => __('Yes', 'nest-addons'),
               'label_off' => __('No', 'nest-addons'),
               'return_value' => 'yes',
               'default' => 'yes',
           ]
       ); 
       $this->add_control(
           'right',
           [
               'label' => __('Loop Right Enable / Disable', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => __('Yes', 'nest-addons'),
               'label_off' => __('No', 'nest-addons'),
               'return_value' => 'yes',
               'default' => 'no',
           ]
       ); 
       $this->add_control(
           'op_hr_2',
           [
               'type' => \Elementor\Controls_Manager::DIVIDER, 
           ]
       );
       $this->add_control(
           'op_margin',
           [
               'label' => __('Margin', 'nest-addons'),
               'type'    => \Elementor\Controls_Manager::NUMBER,
               'min'     => 0,
               'max'     => 10,
               'step'    => 1,  
               'default'    => 20,  
           ]
       ); 
       $this->add_control(
        'op_hr_35',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER, 
        ]
        );
       
       $this->add_control(
        'hoverpause',
        [
            'label' => __('Hover Pause Enable / Disable', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'nest-addons'),
            'label_off' => __('No', 'nest-addons'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
        ); 
       $this->add_control(
           'op_hr_3',
           [
               'type' => \Elementor\Controls_Manager::DIVIDER, 
           ]
       );
       $this->add_control(
           'autoplay',
           [
               'label' => __('Autoplay Enable / Disable', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => __('Yes', 'nest-addons'),
               'label_off' => __('No', 'nest-addons'),
               'return_value' => 'yes',
               'default' => 'no',
           ]
       ); 
       $this->add_control(
           'autoplay_count',
           [
               'label' => __('Autoplay Speed', 'nest-addons'),
               'type'    => \Elementor\Controls_Manager::NUMBER,
               'min'     => 0,
               'max'     => 100000,
               'step'    => 100,  
               'default'    => 3000,  
           ]
       );
       $this->add_control(
           'smartspeed',
           [
               'label' => __('Smart Speed', 'nest-addons'),
               'type'    => \Elementor\Controls_Manager::NUMBER,
               'min'     => 0,
               'max'     => 100000,
               'step'    => 100,  
               'default'    => 3000,  
           ]
       ); 
   $this->end_controls_section();
   // carouse settings
    
    $this->start_controls_section('owl_nav_style',
    [ 
        'label' => __('Custom Css', 'nest-addons'),
        'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
    ]
    );
  
    $this->add_control(
        'nav_style_options',
        [
        'label' => __('Nav Move Position', 'nest-addons'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'none_nav' => __( 'Select Nav Position', 'nest-addons' ),
            'position_one' => __( 'Position One', 'nest-addons' ),
            'position_two' => __( 'Position Two', 'nest-addons' ),
            'position_three' => __( 'Position Three', 'nest-addons' ),
            'position_four' => __( 'Position Four', 'nest-addons' ),
        ],
        'default' => 'position_one' ,
        ]
    );
    $this->add_control(
        'nav_move_count',
        [
            'label' => __('Nav Move Top', 'nest-addons'),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'min'     => -100,
            'max'     => 1,
            'step'    => 1,
            'condition' => [
                'nav_style_options' => ['position_two' , 'position_three' , 'position_four'],
            ],
            'selectors' => [
                '{{WRAPPER}}  .position_two .owl-carousel .owl-nav , {{WRAPPER}}  .position_three .owl-carousel .owl-nav , {{WRAPPER}}  .position_four .owl-carousel .owl-nav ' => 'top: {{VALUE}}px!important;',
            ],
        ]
    );
   
 
 
    $this->add_control(
        'nav_display',
        [
        'label' => __('Naigation Enable / Disabel', 'nest-addons'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'true' => __( 'Block', 'nest-addons' ),
            'false' => __( 'none', 'nest-addons' ),
        ],
        'default' => 'true' ,
       
        ]
    );
    $this->add_control(
        'owl_nav_color',
         [
            'label' => __('Owl Nav Arrow Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-tabs_two  .owl-nav i ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
     
    $this->add_control(
        'owl_nav_bg_color',
         [
            'label' => __('Owl Nav Arrow Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-tabs_two .owl-carousel .owl-nav .owl-prev, .product-tabs_two .owl-carousel .owl-nav .owl-next ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );

    
    $this->add_control(
        'owl_nav_hover_color',
         [
            'label' => __('Owl Nav Hover Arrow Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-tabs_two  .owl-nav .owl-prev:hover i , {{WRAPPER}} .product-tabs_two  .owl-nav .owl-next:hover i ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
     
    $this->add_control(
        'owl_nav_hover_bg_color',
         [
            'label' => __('Owl Nav Hover Arrow Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-tabs_two .owl-carousel .owl-nav .owl-prev:hover , {{WRAPPER}} .product-tabs_two .owl-carousel .owl-nav .owl-next:hover ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );
 

    $this->end_controls_section();


    $this->start_controls_section('product_tab_css',
    [ 
        'label' => __('Product  Css', 'nest-addons'),
        'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
    ]
    );

    $this->add_control(
        'tab_text_color',
         [
            'label' => __('Tab Text Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .section_tab  .nav.nav-tabs.links button  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );


    $this->add_control(
        'tab_text_ac_color',
         [
            'label' => __('Tab Text Active Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .section_tab  .nav.nav-tabs.links button.active  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );


    $this->add_control(
        'product_tag_color',
         [
            'label' => __('Product Category Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-content-wrap .product-category a  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

 
    $this->add_control(
        'product_title_color',
         [
            'label' => __('Product Title Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-content-wrap h2 a  , {{WRAPPER}} .product-list-small h6 a , {{WRAPPER}}  .product_style_five .product-content-wrap h5 a ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'product_rating_color',
         [
            'label' => __('Product Rating Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product_wrapper .star-rating::before  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    
    $this->add_control(
        'product_rating_active_color',
         [
            'label' => __('Product Rating Active Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product_wrapper .star-rating span::before  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'product_rating_count_color',
         [
            'label' => __('Product Rating Count Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product_wrapper .product-rate-cover .font-small ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'product_vendor_color',
         [
            'label' => __('Product Vendor Text Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product_wrapper .product-content-wrap .vendord .font-small.text-muted ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'product_vendor_two_color',
         [
            'label' => __('Product Vendor Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product_wrapper .product-content-wrap   .font-small.text-muted a ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'product_price_color',
         [
            'label' => __('Product Price Offer Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-content-wrap .product-price ins span ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );


    
    $this->add_control(
        'product_price_og_color',
         [
            'label' => __('Product Price Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}   .product_wrapper .product-price del , {{WRAPPER}} .product_wrapper .product-price del bdi , {{WRAPPER}}   .product_wrapper .product-price del bdi .woocommerce-Price-currencySymbol ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    
    
    $this->add_control(
        'button_colors',
         [
            'label' => __('Product Btn Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-card-bottom .add-cart .add , {{WRAPPER}} .product-cart-wrap .product-card-bottom .add-cart .add span , {{WRAPPER}} .product-cart-wrap .product-card-bottom .add-cart  a::before  ,
                {{WRAPPER}} .product-cart-wrap.style_two .add_to_cart_button  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'button_bg_color',
         [
            'label' => __('Product Btn Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-card-bottom .add-cart .add , {{WRAPPER}} .product-cart-wrap .product-card-bottom .add-cart .add span ,
                {{WRAPPER}} .product-cart-wrap.style_two .add_to_cart_button ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );


    $this->add_control(
        'progress_text_color',
         [
            'label' => __('Progress Text Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-content-wrap .sold  span ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'progress_bg_color',
         [
            'label' => __('Progress Bar Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .progress ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );

 $this->add_control(
        'progress_ac_bg_color',
         [
            'label' => __('Progress Bar Active Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .progress-bar ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );

    
    $this->add_control(
        'box_color',
         [
            'label' => __('Box Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap , {{WRAPPER}} .product-cart-wrap .product-img-action-wrap ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'box_border_color',
         [
            'label' => __('Box Border Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap ' => 'border-color: {{VALUE}}!important;',
            ],
         ]
    );
    

    
    $this->add_control(
        'hover_components_color',
         [
            'label' => __('Hover Content Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-action-1 li button:before , {{WRAPPER}}  .product-cart-wrap .product-action-1 li i
                , {{WRAPPER}} .product-cart-wrap .product-action-1 li small ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'hover_components_bor_color',
         [
            'label' => __('Hover Content Border Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-action-1 li ' => 'border-color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'hover_components_tool_color',
         [
            'label' => __('Hover Content Tooltip Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .product-cart-wrap .product-action-1 li small:before  ' => 'border-top-color: {{VALUE}}!important;',
                '{{WRAPPER}}  .product-cart-wrap .product-action-1 li small ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'hover_components_bg_color',
         [
            'label' => __('Hover Content Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}  .product-cart-wrap .product-img-action-wrap .product-action-1 ' => 'border-color: {{VALUE}}!important; background: {{VALUE}}!important;',
            ],
         ]
    ); 
    $this->end_controls_section();

    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');
        $loop = 'false';
        if($settings['loop'] == 'yes'):
            $loop = 'true';
        endif;
        $right = 'false';
        if($settings['right'] == 'yes'):
            $right = 'true';
        endif;
        $autoplay = 'false';
        if($settings['autoplay'] == 'yes'):
            $autoplay = 'true';
        endif;
        $hoverpause = 'false';
        if($settings['hoverpause'] == 'yes'):
            $hoverpause = 'true';
        endif; 
    ?>
<section  class="product-tabs_two filter_carousel <?php if($settings['border_radius_enable'] == 'yes'): ?> enab_borfor_styheee <?php endif; ?>  position-relative <?php echo esc_attr($settings['nav_style_options']); ?>">
            <?php   
             $product_not_inside = '';
                    if(!empty($settings['product_not_in'])){
                        $product_not_inside = explode(',', $settings['product_not_in']);
                    }
                    else{
                        $product_not_inside = '0';
                    }

                    $query_args = array(
                        'post_type' => 'product',
                        'ignore_sticky_posts' => true, 
                        'posts_per_page' => $settings['post_count'],
                        'orderby'        => $settings['query_orderby'],
                        'order'          =>  $settings['query_order'],
                        'post__not_in'   => $product_not_inside ,
                    );
                    if (!empty($settings['query_category']) && is_array($settings['query_category'])) {
                        $category_string = implode(',', $settings['query_category']);
                        $query_args['product_cat'] = $category_string;
                    }
                    if($settings['product_options_showing'] == 'outofstock'):
                        $query_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'outofstock',
                            'operator' => 'NOT IN',
                            ),
                        ); // WPCS: slow query ok.
                        elseif($settings['product_options_showing'] == 'best_selling'):
                            $query_args['meta_key'] = 'total_sales';
                            $query_args['orderby'] = 'meta_value_num';
                        elseif($settings['product_options_showing'] == 'featured'):
                            $query_args['tax_query'] = array( array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'name',
                                'terms'    => array( 'featured' ),
                                'operator' => 'IN',
                            ) 
                        );
                        elseif($settings['product_options_showing'] == 'sale'):
                            $query_args['meta_key'] = '_sale_price';
                            $query_args['meta_value'] = array('');
                            $query_args['meta_compare'] = 'NOT IN';
                        elseif ($settings['product_options_showing'] == 'price_low_high'):
                            $query_args['meta_key'] = '_price';
                            $query_args['orderby'] = 'meta_value_num';
                            $query_args['order'] = 'ASC';
                        elseif ($settings['product_options_showing'] == 'price_high_low') :
                            $query_args['meta_key'] = '_price';
                            $query_args['orderby'] = 'meta_value_num';
                            $query_args['order'] = 'DESC';
                        endif;
                        $product_query = new \WP_Query( $query_args );
                    ?> 
                <div class="theme_carousel owl-theme owl-carousel" data-options='{"loop": <?php echo esc_attr($loop); ?> , "rtl" : <?php echo esc_attr($right); ?>, "margin": <?php echo esc_attr($settings['op_margin']); ?>, "autoheight":true, "autoplayHoverPause":<?php echo esc_attr($hoverpause); ?> ,  "lazyload":true, "nav": <?php echo esc_attr($settings['nav_display']); ?>, "dots": false, "autoplay": <?php echo esc_attr($autoplay); ?>, "autoplayTimeout":<?php echo esc_attr($settings['autoplay_count']); ?>, "smartSpeed": <?php echo esc_attr($settings['smartspeed']); ?>, "responsive":{ "0" :{ "items": "1" }, "290" :{ "items" : "2" }, "500" :{ "items" : "<?php echo esc_attr($settings['mini']); ?>" }, "768" :{ "items" : "<?php echo esc_attr($settings['mobile']); ?>" } , "992":{ "items" : "<?php echo esc_attr($settings['tablet']); ?>" }, "1200":{ "items" : "<?php echo esc_attr($settings['desktop']); ?>" }}}'>
                    <?php  if($product_query->have_posts()):
                             while($product_query->have_posts()) : $product_query->the_post();
                            global $product;
			                 global $woocommerce;    
                        ?>
                    <?php // product style ?>
                    <?php if($settings['product_style'] == 'style_one'): ?>
                    <?php // product style ?>
                    <div <?php wc_product_class( '', $product ); ?>>
                        <?php do_action('get_nest_product_card_one'); ?>
                    </div>
                    <?php elseif($settings['product_style'] == 'style_two'): ?>
                    <?php // product style ?>
                    <div <?php wc_product_class( '', $product ); ?>>
                        <?php do_action('get_nest_product_card_two'); ?>
                    </div>
                    <?php // product style ?>
                    <?php elseif($settings['product_style'] == 'style_three'): ?>
                    <?php // product style ?>
                    <div <?php wc_product_class( '', $product ); ?>>
                    <?php do_action('get_nest_product_card_three'); ?>
                    </div>

                    <?php elseif($settings['product_style'] == 'style_four'): ?>
                    <?php // product style ?>
                    <div <?php wc_product_class( '', $product ); ?>>
                    <?php do_action('get_nest_product_card_five'); ?>
                    </div>

                    <?php elseif($settings['product_style'] == 'style_five'): ?>
                    <?php // product style ?>
                    <div <?php wc_product_class( '', $product ); ?>>
                    <?php do_action('get_nest_product_card_six'); ?> 
                    </div>
                    <?php // product style ?>
                    <?php endif; ?>
                    <?php // product style ?>
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                    <?php endif; ?>
                </div> 
</section>

<?php
    }
}
 
