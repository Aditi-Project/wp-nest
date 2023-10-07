<?php
namespace  Nestaddons\Core\Widgets\Shop;
if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.
class Brand_v1 extends \Elementor\Widget_Base{
    public function get_name()
    {
        return 'nest-brand-v1';
    }
    public function get_title()
    {
        return __('Brand V1', 'nest-addons');
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
        $this->start_controls_section('brand_v1_settings',
        [ 
            'label' => __('Brand Content', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        );
        $this->add_control(
            'brand_type',
            [
            'label' => __('Brand Types', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'carousel' => __( 'Carousel', 'nest-addons' ),
                'grid' => __( 'Grid', 'nest-addons' ),
            ],
            'default' => 'carousel' , 
            ]
        );
        $this->add_control(
            'brand_column',
            [
                'label' => __('Brand Column', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'col-xl-2 col-lg-6 col-md-6 col-sm-6'   => esc_html__( 'Six Column', 'nest-addons' ),
                    'col-lg-1-5  col-md-4 col-sm-6'   => esc_html__( 'Five Column', 'nest-addons' ),
                    'col-xl-3 col-lg-4 col-md-6 col-sm-6'   => esc_html__( 'Four Column', 'nest-addons' ),
                    'col-xl-4 col-lg-4 col-md-6 col-sm-6'   => esc_html__( 'Three Column', 'nest-addons' ),
                    'col-xl-6 col-lg-6 col-md-6 col-sm-6'   => esc_html__( 'Two Column', 'nest-addons' ),
                    'col-xl-12'   => esc_html__( 'One Column', 'nest-addons' ),
                ],
                'default' => 'col-xl-3 col-lg-4 col-md-6 col-sm-6',
                'condition' => [
                    'brand_type' => 'grid'
                ], 
            ]
        );
        $this->add_control(
            'brand',
            [
               'label' => __('Exclude Brand By  Id', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('', 'nest-addons'),
               'placeholder' => __('1 , 44 , 56', 'nest-addons'),   
               'description' => __('Enter the id like this -> 1 , 44 , 56 ', 'nest-addons'), 
            ]
        );
        $this->add_control( 
			'query_orderby',
			[
				'label'   => esc_html__( 'Brand Order By', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
                    'name'  => esc_html__( 'Brand Name', 'nest-addons' ),
					'ID'       => esc_html__( 'Brand ID', 'nest-addons' ),
					'slug'      => esc_html__( 'Brand Slug', 'nest-addons' ),
					'term_group' => esc_html__( 'Term Group', 'nest-addons' ),
					'term_order'       => esc_html__( 'Term Order', 'nest-addons' ),
                    'count'       => esc_html__( 'Product Count', 'nest-addons' ),
                    'none'       => esc_html__( 'None', 'nest-addons' ), 
				), 
                'default' => 'name',
			]
		);
        $this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array( 
					'DESC' => esc_html__( 'DESC', 'nest-addons' ),
					'ASC'  => esc_html__( 'ASC', 'nest-addons' ),
				),
                'default' => 'DESC',
			]
        ); 
        $this->add_control(
            'query_number',
            [
                'label' => __('Number Of Brands', 'nest-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 100,
                'step'    => 1, 
                'default' => 5
            ]
        );
        $this->add_control(
			'count_text',
			[
				'label'   => esc_html__( 'Brand Count Text', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__( 'Items', 'nest-addons' ),
			]
        );  
        $this->add_control(
            'transition_enable',
            [
                'label' => __('Transition Enable', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'nest-addons'),
                'label_off' => __('No', 'nest-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        ); 
        $this->add_control(
            'wow_animation',
            [
                'label' => esc_html__( 'Transition Timing', 'nest-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '0',
                'options' => [
                    '0'  => esc_html__( '0', 'nest-addons' ),
                    '.1s' => esc_html__( '.1s', 'nest-addons' ),
                    '.2s' => esc_html__( '.2s', 'nest-addons' ),
                    '.3s' => esc_html__( '.3s', 'nest-addons' ),
                    '.4s' => esc_html__( '.4s', 'nest-addons' ),
                    '.5s' => esc_html__( '.5s', 'nest-addons' ),
                    '.6s' => esc_html__( '.6s', 'nest-addons' ),
                    '.7s' => esc_html__( '.7s', 'nest-addons' ),
                    '.8s' => esc_html__( '.8s', 'nest-addons' ),
                    '.9s' => esc_html__( '.9s', 'nest-addons' ),
                    '1s' => esc_html__( '1s', 'nest-addons' ),
                    '1.1s' => esc_html__( '1.1s', 'nest-addons' ),
                    '1.2s' => esc_html__( '1.2s', 'nest-addons' ),
                    '1.3s' => esc_html__( '1.3s', 'nest-addons' ),
                    '1.4s' => esc_html__( '1.4s', 'nest-addons' ),
                    '1.5s' => esc_html__( '1.5s', 'nest-addons' ),
                    '1.6s' => esc_html__( '1.6s', 'nest-addons' ),
                    '1.7s' => esc_html__( '1.7s', 'nest-addons' ),
                    '1.8s' => esc_html__( '1.8s', 'nest-addons' ),
                    '1.9s' => esc_html__( '1.9s', 'nest-addons' ),
                    '2s' => esc_html__( '2s', 'nest-addons' ),
                ],
                'condition' => [
                    'transition_enable' => 'yes'
                ], 
            ]
        );  
 
    $this->end_controls_section();

    // carouse settings
    $this->start_controls_section('carousel_settings',
        [ 
            'label' => __('Carousel Settings', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            'condition' => [
                'brand_type' => 'carousel'
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
          'default' => '8' , 
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
            'default' => '8' , 
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
              'default' => '3' , 
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
     $this->start_controls_section('brand_css',
     [ 
         'label' => __('Brand Css', 'nest-addons'),
         'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
     ]
     );
     $this->add_control(
        'title_color',
         [
            'label' => __('Title Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand_box h6 a ' => 'color: {{VALUE}}!important;',
            ],
         ]
    ); 

    $this->add_control(
        'count_color',
         [
            'label' => __('Count Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand_box span ' => 'color: {{VALUE}}!important;',
            ],
         ]
    ); 

    $this->add_control(
        'brand_box_olor',
         [
            'label' => __('Box bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand_box ' => 'background: {{VALUE}}!important;',
            ],
         ]
    ); 

    $this->add_control(
        'brand_bor_olor',
         [
            'label' => __('Box Border Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .brand_box ' => 'border-color: {{VALUE}}!important;',
            ],
         ]
    ); 
     
     $this->end_controls_section(); 

    // carouse settings
    $this->start_controls_section('owl_nav_style',
    [ 
        'label' => __('Carousel Navigation Css', 'nest-addons'),
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
                '{{WRAPPER}}  .position_two .owl-carousel .owl-nav , {{WRAPPER}}  .position_three .owl-carousel .owl-nav  , {{WRAPPER}}  .position_four .owl-carousel .owl-nav ' => 'top: {{VALUE}}px!important;',
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
}
protected function render(){
$settings = $this->get_settings_for_display();
$allowed_tags = wp_kses_allowed_html('post');
?>
   <section class="sec_brand_grid position-relative <?php echo esc_attr($settings['nav_style_options']); ?>  <?php if($settings['transition_enable'] == 'yes'): ?> wow animate__animated animate__fadeInUp" data-wow-delay="<?php echo esc_attr($settings['wow_animation']); ?><?php endif; ?>">
    <?php if($settings['brand_type'] == 'grid'): ?>
        <div class="row">
            <?php 
            $brans_ids = $settings['brand'];
            $brans_orderbg = $settings['query_orderby'];
            $brans_order = $settings['query_order'];
            $brans_count = $settings['query_number'];
            $args = array(
                'taxonomy'     => 'brand', // Replace with the actual taxonomy name for brands
                'exclude'      => $brans_ids,
                'orderby'      => $brans_orderbg,
                'order'        => $brans_order,
                'number' => $brans_count, 
                'hide_empty'   => 1, // Updated parameter to hide empty brands
            );
            $brand_terms = get_terms($args); 
            ?>
            <?php foreach ($brand_terms as $brand):
            $brand_link = get_term_link($brand);
            $brand_image = get_term_meta($brand->term_id, 'brand_image', true); 
            $brand_title = $brand->name;
            $brand_count = $brand->count;
               
                if ($brand_count > 0):
                ?>
                <div class="<?php echo esc_attr($settings['brand_column']); ?>">
                <div class="brand_box"> 
               
                    <?php if(!empty($brand_image)): ?>
                    <figure class="img-hover-scale">
                        <a href="<?php echo esc_url($brand_link); ?>" class="d-block">
                            <img src="<?php echo esc_attr($brand_image); ?>" alt="<?php echo esc_attr($brand_title); ?>" />
                        </a>
                    </figure>
                    <?php endif; ?>
                    <div class="content">
                        <?php if(!empty($brand_title)): ?>
                        <h6> <a href="<?php echo esc_url($brand_link); ?>"><?php echo esc_attr($brand_title); ?></a></h6>
                        <?php endif; ?>
                        <?php if(!empty($brand_count)): ?>
                        <span><?php echo esc_attr($brand_count); ?> <?php echo esc_attr($settings['count_text']); ?></span>
                        <?php endif; ?>
                    </div>
             
                </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: 
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
        <div class="theme_carousel owl-theme owl-carousel" data-options='{"loop": <?php echo esc_attr($loop); ?> , "rtl" : <?php echo esc_attr($right); ?>, "margin": <?php echo esc_attr($settings['op_margin']); ?>, "autoheight":true , "autoplayHoverPause":<?php echo esc_attr($hoverpause); ?> , "lazyload":true, "nav": <?php echo esc_attr($settings['nav_display']); ?>, "dots": false, "autoplay": <?php echo esc_attr($autoplay); ?>, "autoplayTimeout":<?php echo esc_attr($settings['autoplay_count']); ?>, "smartSpeed": <?php echo esc_attr($settings['smartspeed']); ?>, "responsive":{ "0" :{ "items": "1" }, "290" :{ "items" : "2" }, "500" :{ "items" : "<?php echo esc_attr($settings['mini']); ?>" }, "768" :{ "items" : "<?php echo esc_attr($settings['mobile']); ?>" } , "992":{ "items" : "<?php echo esc_attr($settings['tablet']); ?>" }, "1200":{ "items" : "<?php echo esc_attr($settings['desktop']); ?>" }}}'>
            <?php 
            $brans_ids = $settings['brand'];
            $brans_orderbg = $settings['query_orderby'];
            $brans_order = $settings['query_order'];
            $brans_count = $settings['query_number'];
            $args = array(
                'taxonomy'     => 'brand', // Replace with the actual taxonomy name for brands
                'exclude'      => $brans_ids,
                'orderby'      => $brans_orderbg,
                'order'        => $brans_order,
                'number' => $brans_count, 
                'hide_empty'   => 1, // Updated parameter to hide empty brands
            );
            $brand_terms = get_terms($args); 
            ?>
            <?php foreach ($brand_terms as $brand):
            $brand_link = get_term_link($brand);
            $brand_image = get_term_meta($brand->term_id, 'brand_image', true); 
            $brand_title = $brand->name;
            $brand_count = $brand->count;
                if ($brand_count > 0):
                ?> 
                <div class="brand_box">  
                    <?php if(!empty($brand_image)): ?>
                    <figure class="img-hover-scale">
                        <a href="<?php echo esc_url($brand_link); ?>" class="d-block">
                            <img src="<?php echo esc_attr($brand_image); ?>" alt="<?php echo esc_attr($brand_title); ?>" />
                        </a>
                    </figure>
                    <?php endif; ?>
                    <div class="content">
                        <?php if(!empty($brand_title)): ?>
                        <h6> <a href="<?php echo esc_url($brand_link); ?>"><?php echo esc_attr($brand_title); ?></a></h6>
                        <?php endif; ?>
                        <?php if(!empty($brand_count)): ?>
                        <span><?php echo esc_attr($brand_count); ?> <?php echo esc_attr($settings['count_text']); ?></span>
                        <?php endif; ?>
                    </div> 
                </div> 
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>
 
    <?php
    }
}

 