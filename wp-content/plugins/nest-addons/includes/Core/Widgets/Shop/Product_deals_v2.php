<?php
namespace  Nestaddons\Core\Widgets\Shop;
if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.
class Product_deals_v2 extends \Elementor\Widget_Base{
    public function get_name()
    {
        return 'nest-product-deals-v2';
    }
    public function get_title()
    {
        return __('Product Deals V2', 'nest-addons');
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
        $this->start_controls_section('product_deal_v2_settings',
        [ 
            'label' => __('Product Content', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        );
        $this->add_control(
            'product_deals_type',
            [
                'label' => __('Deal Type', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'single'   => esc_html__( 'Single', 'nest-addons' ),
                    'carousel'   => esc_html__( 'Carousel', 'nest-addons' ),
                ],
                'default' => 'carousel',
            ]
        );

        $this->end_controls_section();
  
        $this->start_controls_section('product_deal_v2_settingstwo',
        [ 
            'label' => __('Product Content', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            'condition' => [
                'product_deals_type' => 'single',
            ],
        ]
        );
        $this->add_control(
            'product_deals',
            [
                'label'			=> esc_html__('Select  Product', 'nest-addons'),
                'type'			=> 'Nest_select2_get_auto',
				'multiple'		=> false,
                'post_type' => 'product',
				'label_block'	=> true,
                'options'		=> 'nest_get_product_post_id',
            ]
        );
        
    
        $this->add_control(
			'bgimage',
			[
				'label' => __( 'deals Image', 'nest-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
                    'url' => NEST_ADDONS_URL . '/assets/imgs/deals-1.png',
				],
              
			]
        );
 
    $this->end_controls_section();


     // style one start
     $this->start_controls_section('product_deals_v2_settingstwo',
     [ 
         'label' => __('Product Content', 'nest-addons'),
         'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
         'condition' => [
            'product_deals_type' => 'carousel',
        ],
     ]
     );
     $this->add_control(
        'carousel_items',
        [
        'label' => __('Carousel Items', 'nest-addons'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            '6' => __('6 Items', 'nest-addons'),
            '5' => __('5 Items', 'nest-addons'),
            '4' => __('4 Items', 'nest-addons'),
            '3' => __('3 Items', 'nest-addons'),
            '2' => __('2 Items', 'nest-addons'),
            '1' => __('1 Items', 'nest-addons'),
        ],
        'default' => '3' , 
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

     
     $this->add_control(
         'deals_second_remining',
        [
           'label' => __('Deals Timing Enable / Disable', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'nest-addons'),
            'label_off' => __('No', 'nest-addons'),
            'return_value' => 'yes',
            'default' => 'no',
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
       ]
    );
   

 $this->end_controls_section();
  // carouse settings
  $this->start_controls_section('carousel_settings',
  [ 
      'label' => __('Carousel Settings', 'nest-addons'),
      'tab' => \Elementor\Controls_Manager::TAB_CONTENT, 
      'condition' => [
        'product_deals_type' => 'carousel',
    ],
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
          'max'     => 100,
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

    $this->start_controls_section('deals_css',
    [ 
        'label' => __('deals Css', 'nest-addons'),
        'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
    ]
    );

   
    $this->add_control(
        'deals_bg_color',
         [
            'label' => __('deal Bg  Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one  ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'deals_border_colors',
         [
            'label' => __('deal Border Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one  ' => 'border-color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'cat_color',
         [
            'label' => __('Cat Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}  .dela_type_one .peoduct_deals.style_one .content_mained .pro_cat a ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'cat_bg_color',
         [
            'label' => __('Cat Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}}  .dela_type_one .peoduct_deals.style_one .content_mained .pro_cat a ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'deal_text_color',
         [
            'label' => __('Title Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .peoduct_deals.style_one .content_mained h2 a  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    
    $this->add_control(
        'price_color_one',
         [
            'label' => __('Price Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .price ins  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'price_color_two',
         [
            'label' => __('Price Color Two', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .price del  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );


    $this->add_control(
        'deal_count_color_t',
         [
            'label' => __('Deal Count Title Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .peoduct_deals .deals_box .deals_title  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'count_bg_color',
         [
            'label' => __('Count Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .peoduct_deals .deals_box .deals-countdown .countdown-section ' => 'background: {{VALUE}}!important;',
            ],
         ]
    );

    $this->add_control(
        'dealcount_down_color',
         [
            'label' => __('Deal Countdown Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .peoduct_deals .deals_box .deals-countdown .countdown-section .countdown-amount ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_control(
        'dealcount_down_text_color',
         [
            'label' => __('Deal Countdown Text Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dela_type_one .peoduct_deals .deals_box .deals-countdown .countdown-section .countdown-period ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    
 

    $this->end_controls_section();


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
                'nav_style_options' => ['position_two' , 'position_three'],
            ],
            'selectors' => [
                '{{WRAPPER}}  .position_two .owl-carousel .owl-nav , {{WRAPPER}}  .position_three .owl-carousel .owl-nav ' => 'top: {{VALUE}}px!important;',
            ],
        ]
    );
   
 
 
    $this->add_responsive_control(
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


    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');

    ?>

<?php if($settings['product_deals_type'] == 'single'): ?>
<div class="dela_type_one <?php if($settings['border_radius_enable'] == 'yes'): ?> border_enabled <?php endif; ?>" <?php if(!empty($settings['bgimage']['url'])): ?>
    style="background-image: url('<?php echo esc_url($settings['bgimage']['url']); ?>')" <?php endif; ?>>

    <?php 
    if(!empty($settings['product_deals'])):
    $query_args = array(
                 'post_type' => 'product',
                'ignore_sticky_posts' => true,
                'orderby' => 'date',
                'posts_per_page' => '1',
                 'p'       => $settings['product_deals'],
            );      
             $product_query = new \WP_Query( $query_args );?>
    <?php if($product_query->have_posts()):
                        while($product_query->have_posts()) : $product_query->the_post();
                        global $product;
			            global $post;
			            global $woocommerce;
                        if(empty($product) || !$product->is_visible()) {
                            return;
                        }
                    ?>

    <div class="peoduct_deals  style_one">
        <div class="pro_inner">
            <div class="image">
                <a href="<?php echo esc_url(get_permalink(get_the_id())); ?>">
                    <?php echo woocommerce_get_product_thumbnail('default-img'); ?>

                </a>
            </div>
            <div class="content_mained">
                <?php do_action('get_nest_current_product_category'); ?>
                <h2><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h2>
                <?php woocommerce_template_single_price(); ?>

            </div>
        </div>
        <?php do_action('get_nest_product_deals');?>

    </div>
    <?php endwhile; // while loop end ?>
    <?php wp_reset_postdata(); ?>
    <?php endif; // Post Endif after loop end  ?>
    <?php endif; //  product_deals ?>
</div>

<?php elseif($settings['product_deals_type'] == 'carousel'):  
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
    endif; ?>

    <section class="deal_caro position-relative <?php echo esc_attr($settings['nav_style_options']); ?>"> 
        <?php   $product_not_inside = '';
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
                            $query_args['order']    = 'DESC';
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
                   <?php if($product_query->have_posts()):
                            while($product_query->have_posts()) : $product_query->the_post();
                            global $product;
			                global $post;
			                global $woocommerce;
                           
                    // while loop start ?>

     <div class="dela_type_one <?php if($settings['border_radius_enable'] == 'yes'): ?> border_enabled <?php endif; ?>">
    <div class="peoduct_deals  style_one">
        <div class="pro_inner">
            <div class="image">
                <a href="<?php echo esc_url(get_permalink(get_the_id())); ?>">
                    <?php echo woocommerce_get_product_thumbnail('default-img'); ?>

                </a>
            </div>
            <div class="content_mained">
                <?php do_action('get_nest_current_product_category'); ?>
                <h2><a href="<?php echo esc_url(get_permalink(get_the_id())); ?>"><?php the_title(); ?></a></h2>
                <?php woocommerce_template_single_price(); ?>

            </div>
        </div>
        <?php if($settings['deals_second_remining'] == 'yes'): ?>
        <?php do_action('get_nest_product_deals');?>
        <?php endif; ?>
        </div>
    </div>


        <?php endwhile; // while loop end ?>
        <?php wp_reset_postdata(); ?>
        <?php endif; // Post Endif after loop end  ?>
    </div>
    <!--End tab-content-->
</section>
<?php endif; ?>
<?php
    }
}
 