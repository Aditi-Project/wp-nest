<?php

namespace  Nestaddons\Core\Widgets\Footer;

if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.

class Hot_line_v1 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'nest-hotline-box-v1';
    }

    public function get_title()
    {
        return __('Hot Line V1', 'nest-addons');
    }

    public function get_icon()
    {
        return 'icon-letter-n';
    }

    public function get_categories()
    {
        return ['104'];
    }

    protected function register_controls(){
 
        // style one start
        $this->start_controls_section('widget_hot_line_v1_settings',
        [ 
            'label' => __('Widget  Content', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        );
        $this->add_control(
            'contact_type',
            [
            'label' => __('Choose Types', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'mails' => __( 'Mail', 'nest-addons' ),
                'phones' => __( 'Phone', 'nest-addons' ),
                'addresss' => __( 'Address', 'nest-addons' ),
                'timings' => __( 'Timing', 'nest-addons' ),
            ],
            'default' => 'mails',
            ]
        );
 
        $this->add_control(
            'icon_style',
            [
            'label' => __('Icon Styles', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'type_image' => __( 'Image Type', 'nest-addons' ),
                'type_icon' => __( 'Image Icon', 'nest-addons' ),
            ],
            'default' => 'type_image' , 
            ]
        );

        $this->add_control(
            'image_font',
            [
            'label' => __( 'Image', 'nest-addons' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            'condition' => [
                'icon_style' => 'type_image' 
            ],
            ] 
        );
        $this->add_control(
            'icon_fonts',
            [
                'label' => __('Icon', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => nest_get_icon(),
                'default' => 'fi-rs-user' , 
                'condition' => [
                    'icon_style' => 'type_icon'
                ],
            ]
        );

        
        $this->add_control(
          'address_title',
          [
             'label' => __('Address Content', 'nest-addons'),
             'type' => \Elementor\Controls_Manager::TEXT,
             'default' => __('Address', 'nest-addons'),
             'placeholder' => __('Type your text here', 'nest-addons'),   
             'condition' => [
                'contact_type' => 'addresss'
            ], 
          ]
        );
        $this->add_control(
            'address',
            [
               'label' => __('Address', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('5171 W Campbell Ave undefined Kent, Utah 53127 United States', 'nest-addons'),
               'placeholder' => __('Type your text here', 'nest-addons'),   
               'condition' => [
                  'contact_type' => 'addresss'
              ], 
            ]
        );

 
        $this->add_control(
          'phone_title',
          [
             'label' => __('Phone Conent', 'nest-addons'),
             'type' => \Elementor\Controls_Manager::TEXT,
             'default' => __('Call Us', 'nest-addons'),
             'placeholder' => __('Type your text here', 'nest-addons'),   
             'condition' => [
                'contact_type' => 'phones'
            ], 
          ]
        );
        $this->add_control(
            'phone',
            [
               'label' => __('Phone Number', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('(+91)-540-025-124553', 'nest-addons'),
               'placeholder' => __('Type your text here', 'nest-addons'),   
               'condition' => [
                  'contact_type' => 'phones'
              ], 
            ]
        );
 
        $this->add_control(
          'email_content',
          [
             'label' => __('Mail Content', 'nest-addons'),
             'type' => \Elementor\Controls_Manager::TEXT,
             'default' => __('Email', 'nest-addons'),
             'placeholder' => __('Type your text here', 'nest-addons'),   
             'condition' => [
                'contact_type' => 'mails'
            ], 
          ]
        );
        $this->add_control(
            'email',
            [
               'label' => __('Mail', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('sale@Nest.com', 'nest-addons'),
               'placeholder' => __('Type your text here', 'nest-addons'),   
               'condition' => [
                  'contact_type' => 'mails'
              ], 
            ]
        );

 
        $this->add_control(
          'timing_title',
          [
             'label' => __('Timing Content', 'nest-addons'),
             'type' => \Elementor\Controls_Manager::TEXT,
             'default' => __('Hours', 'nest-addons'),
             'placeholder' => __('Type your text here', 'nest-addons'),   
             'condition' => [
                'contact_type' => 'timings'
            ], 
          ]
        );
        $this->add_control(
            'timing',
            [
               'label' => __('Timing', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('10:00 - 18:00, Mon - Sat', 'nest-addons'),
               'placeholder' => __('Type your text here', 'nest-addons'),   
               'condition' => [
                  'contact_type' => 'timings'
              ], 
            ]
        );
 
    $this->end_controls_section();

    $this->start_controls_section('hotline_css',
    [ 
        'label' => __('HotLine Css', 'nest-addons'),
        'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
    ]
    );
    $this->add_responsive_control(
        'text_align',
        [
            'label' => esc_html__( 'Alignment', 'nest-addons' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'start' => [
                    'title' => esc_html__( 'Left', 'nest-addons' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'nest-addons' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'end' => [
                    'title' => esc_html__( 'Right', 'nest-addons' ),
                    'icon' => 'eicon-text-align-right',
                ], 
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .hotline ' => 'justify-content: {{VALUE}}!important;',
            ],
        ]
    );
    $this->add_control(
        'img_height',
        [
            'label' => __( 'Image Width', 'nest-addons' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'default' => 30,
            'selectors' => [
                '{{WRAPPER}} .hotline img ' => 'width: {{VALUE}}px',
            ],
        ]
    );

    
    $this->add_control(
        'icon_font',
        [
            'label' => __( 'Icon Font Size', 'nest-addons' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 1,
            'max' => 100,
            'step' => 1,
            'default' => 20,
            'selectors' => [
                '{{WRAPPER}} .hotline .banner-icon span ' => 'font-size: {{VALUE}}px',
            ],
        ]
    );
    $this->add_control(
        'icon_color',
         [
            'label' => __('Icon Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .hotline .banner-icon span  ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'label' => esc_html__( 'Content Typography', 'nest-addons' ),
            'name' => 'sm_typo',
            'selector' => '{{WRAPPER}} .hotline p a , {{WRAPPER}} .hotline p ',
        ]
    );
    $this->add_control(
        'phonee_color',
         [
            'label' => __('Contnet Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .hotline p a , {{WRAPPER}} .hotline p ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
 
    $this->add_control(
        'content_color',
         [
            'label' => __('Title Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .hotline  span ' => 'color: {{VALUE}}!important;',
            ],
         ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'label' => esc_html__( 'Content Typography', 'nest-addons' ),
            'name' => 't_typo',
            'selector' => '{{WRAPPER}} .hotline span ',
        ]
    );
    $this->end_controls_section();

    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');
         
    ?>
    <?php // style ?>
    <?php if($settings['contact_type'] == 'mails'):  ?>
    <?php // style ?>
    <div class="hotline d-flex align-items-center">
     <?php if($settings['icon_style'] == 'type_image'): // icon style ?> 
            <?php if(!empty($settings['image_font'])): // icon image ?>
                <img src="<?php echo esc_attr($settings['image_font']['url']); ?>" alt="icon" />
            <?php endif; // icon image ?>
        <?php elseif($settings['icon_style'] == 'type_icon'): // icon style ?>
            <div class="banner-icon">
                <span class="<?php echo esc_attr($settings['icon_fonts']); ?>"></span>
            </div>
        <?php endif; // icon style ?>
        <?php if(!empty($settings['email'])): ?>
        <p><a href="tel:<?php echo esc_attr($settings['email']); ?>"><?php echo esc_attr($settings['email']); ?></a>
        <?php endif; ?>
        <?php if(!empty($settings['email_content'])): ?>
        <span><?php echo wp_kses($settings['email_content'] , $allowed_tags); ?></span></p>
        <?php endif; ?>
    </div>

    <?php // style ?>
    <?php elseif($settings['contact_type'] == 'timings'):  ?>
    <?php // style ?>
    <div class="hotline d-flex align-items-center">
     <?php if($settings['icon_style'] == 'type_image'): // icon style ?> 
            <?php if(!empty($settings['image_font'])): // icon image ?>
                <img src="<?php echo esc_attr($settings['image_font']['url']); ?>" alt="icon" />
            <?php endif; // icon image ?>
        <?php elseif($settings['icon_style'] == 'type_icon'): // icon style ?>
            <div class="banner-icon">
                <span class="<?php echo esc_attr($settings['icon_fonts']); ?>"></span>
            </div>
        <?php endif; // icon style ?>
        <?php if(!empty($settings['timing_title'])): ?>
        <p> <?php echo wp_kses($settings['timing_title'] , $allowed_tags); ?>
        <?php endif; ?>
        <?php if(!empty($settings['timing'])): ?>
        <span><?php echo wp_kses($settings['timing'] , $allowed_tags); ?></span></p>
        <?php endif; ?>
    </div>

    <?php // style ?>
    <?php elseif($settings['contact_type'] == 'addresss'):  ?>
    <?php // style ?>
    <div class="hotline d-flex align-items-center">
     <?php if($settings['icon_style'] == 'type_image'): // icon style ?> 
            <?php if(!empty($settings['image_font'])): // icon image ?>
                <img src="<?php echo esc_attr($settings['image_font']['url']); ?>" alt="icon" />
            <?php endif; // icon image ?>
        <?php elseif($settings['icon_style'] == 'type_icon'): // icon style ?>
            <div class="banner-icon">
                <span class="<?php echo esc_attr($settings['icon_fonts']); ?>"></span>
            </div>
        <?php endif; // icon style ?>
        <?php if(!empty($settings['address_title'])): ?>
        <p> <?php echo wp_kses($settings['address_title'] , $allowed_tags); ?>
        <?php endif; ?>
        <?php if(!empty($settings['address'])): ?>
        <span><?php echo wp_kses($settings['address'] , $allowed_tags); ?></span></p>
        <?php endif; ?>
    </div>
   <?php // style ?>
    <?php else:  ?>
    <?php // style ?>
    <div class="hotline d-flex align-items-center">
     <?php if($settings['icon_style'] == 'type_image'): // icon style ?> 
            <?php if(!empty($settings['image_font']['url'])): // icon image 
                  $alt_text = 'alt';
                  $image = isset($currency_repeater['currency_image']['alt']) ? $currency_repeater['currency_image']['alt'] : '';
                  if(!empty($image)) {
                      $alt_text = $image;
                  }?>
                <img src="<?php echo esc_attr($settings['image_font']['url']); ?>" alt="icon" />
            <?php endif; // icon image ?>
        <?php elseif($settings['icon_style'] == 'type_icon'): // icon style ?>
            <div class="banner-icon">
                <span class="<?php echo esc_attr($settings['icon_fonts']); ?>"></span>
            </div>
        <?php endif; // icon style ?>
        <?php if(!empty($settings['phone'])): ?>
        <p><a href="tel:<?php echo esc_attr($settings['phone']); ?>"><?php echo esc_attr($settings['phone']); ?></a>
        <?php endif; ?>
        <?php if(!empty($settings['phone_title'])): ?>
        <span><?php echo wp_kses($settings['phone_title'] , $allowed_tags); ?></span></p>
        <?php endif; ?>
    </div>

    <?php // style ?>
    <?php endif; ?>
    <?php // style ?>


    <?php
    }
}

 