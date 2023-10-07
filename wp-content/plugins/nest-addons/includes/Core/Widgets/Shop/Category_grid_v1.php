<?php
namespace  Nestaddons\Core\Widgets\Shop;
if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.
class Category_grid_v1 extends \Elementor\Widget_Base{
    public function get_name()
    {
        return 'nest-grid-v1';
    }
    public function get_title()
    {
        return __('Category Grid V1', 'nest-addons');
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
        $this->start_controls_section('category_v1_settings',
        [ 
            'label' => __('Category Content', 'nest-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
        );
        $this->add_control(
            'category_type',
            [
            'label' => __('Categoty Types', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'style_one' => __( 'Custom Category', 'nest-addons' ),
                'style_two' => __( 'Default Category', 'nest-addons' ),
            ],
            'default' => 'style_one' , 
            ]
        );
        $this->add_control(
            'cat_column',
            [
                'label' => __('Category Column', 'nest-addons'),
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
               
            ]
        );
        $this->add_control(
            'category',
            [
               'label' => __('Exclude Category By  Id', 'nest-addons'),
               'type' => \Elementor\Controls_Manager::TEXTAREA,
               'default' => __('', 'nest-addons'),
               'placeholder' => __('1 , 44 , 56', 'nest-addons'),   
               'description' => __('Enter the id like this -> 1 , 44 , 56 ', 'nest-addons'), 
               'condition' => [
                'category_type' => 'style_two'
            ],    
            ]
        );
        $this->add_control( 
			'query_orderby',
			[
				'label'   => esc_html__( 'Category Order By', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
                    'name'  => esc_html__( 'Category Name', 'nest-addons' ),
					'ID'       => esc_html__( 'Category ID', 'nest-addons' ),
					'slug'      => esc_html__( 'Category Slug', 'nest-addons' ),
					'term_group' => esc_html__( 'Term Group', 'nest-addons' ),
					'term_order'       => esc_html__( 'Term Order', 'nest-addons' ),
                    'count'       => esc_html__( 'Product Count', 'nest-addons' ),
                    'none'       => esc_html__( 'None', 'nest-addons' ), 
				), 
                'default' => 'name',
                'condition' => [
                    'category_type' => 'style_two'
                ], 
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
                'condition' => [
                    'category_type' => 'style_two'
                ], 
			]
        ); 
        $this->add_control(
			'count_text',
			[
				'label'   => esc_html__( 'Category Count Text', 'nest-addons' ),
				'type'    => \Elementor\Controls_Manager::TEXT, 
                'default' => esc_html__( 'Items', 'nest-addons' ),
                'condition' => [
                    'category_type' => 'style_two'
                ], 
			]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
          'cat_image',
          [
            'label' => __( 'Image', 'nest-addons' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
              'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ] 
         );
        $repeater->add_control(
          'cat_name',
          [
             'label' => __('Category Name', 'nest-addons'),
             'type' => \Elementor\Controls_Manager::TEXTAREA,
             'default' => __('Inspired <br>  Performance', 'nest-addons'),
             'placeholder' => __('Type your text here', 'nest-addons'),    
          ]
        );
        $repeater->add_control(
            'item_count',
            [
              'label' => __('Item Count', 'nest-addons'),
              'type' => \Elementor\Controls_Manager::TEXTAREA,
              'default' => __('Our Vision to Grow Better', 'nest-addons'),
              'placeholder' => __('Type your text here', 'nest-addons'),
            ]
        );
        $repeater->add_control(
          'cat_link',
          [
              'label' => __('Link', 'nest-addons'),
              'type' => \Elementor\Controls_Manager::URL,
              'placeholder' => __('https://your-link.com', 'nest-addons'),
              'show_external' => true,
              'default' => [
                  'url' => '#',
                  'is_external' => true,
                  'nofollow' => true,
              ],
          ]
      ); 
    $repeater->add_control(
        'background_color',
         [
            'label' => __('background Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
         ]
    );
    $repeater->add_control(
        'border_color',
         [
            'label' => __('Border Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
         ]
    );
    $repeater->add_control(
        'heading_color',
         [
            'label' => __('Heading Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
         ]
    );
    $repeater->add_control(
        'count_color',
         [
            'label' => __('Count Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
         ]
    );
   
       $this->add_control(
        'cat_repeater',
        [
            'label' => __('Category Repeater', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                'cat_name' =>  __('Cake & Milk', 'nest-addons'),
                'item_count' =>  __('26 items', 'nest-addons'),
                ],
                [
                'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                'item_count' =>  __('28 items', 'nest-addons'),
                ],
            ],
            'title_field' => '{{{ cat_name }}}',
            'condition' => [
                'category_type' => 'style_one'
            ], 
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
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $allowed_tags = wp_kses_allowed_html('post');
    ?>
   <section class="sec_category_grid position-relative   <?php if($settings['transition_enable'] == 'yes'): ?> wow animate__animated animate__fadeInUp" data-wow-delay="<?php echo esc_attr($settings['wow_animation']); ?><?php endif; ?>">
    <?php if($settings['category_type'] == 'style_two'): ?>
        <div class="row">
            <?php 
            $category_ids = $settings['category'];
            $category_orderbg = $settings['query_orderby'];
            $category_order = $settings['query_order'];
            $args = array(
                    'taxonomy'     => 'product_cat',
                    'exclude'      => $category_ids,
                    'orderby'      => $category_orderbg,
                    'order'        => $category_order,
                    'show_count'   => 1,
                    'pad_counts'   => 1,
                    'hierarchical' => 1,
                    'hide_empty'   => 0,
                );
                $product_categories = get_categories($args); 
            ?>
            <?php foreach ($product_categories as $category):
                $category_link = get_term_link($category);
                $category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $category_image_url = wp_get_attachment_url($category_image_id);
                $category_title = $category->name;
                $category_count = $category->count;
                if ($category_count > 0):
                ?>
                <div class="<?php echo esc_attr($settings['cat_column']); ?> card_d_flex cat_box">
                <div>
                    <?php if(!empty($category_image_url)): ?>
                    <figure class="img-hover-scale">
                        <a href="<?php echo esc_url($category_link); ?>" class="d-block">
                            <img src="<?php echo esc_attr($category_image_url); ?>" alt="<?php echo esc_attr($category_title); ?>" />
                        </a>
                    </figure>
                    <?php endif; ?>
                    <?php if(!empty($category_title)): ?>
                    <h6> <a href="<?php echo esc_url($category_link); ?>"><?php echo esc_attr($category_title); ?></a></h6>
                    <?php endif; ?>
                    <?php if(!empty($category_count)): ?>
                    <span><?php echo esc_attr($category_count); ?> <?php echo esc_attr($settings['count_text']); ?></span>
                    <?php endif; ?>
                </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach($settings['cat_repeater'] as  $key => $cat_repeater):   
                $target = $cat_repeater['cat_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $cat_repeater['cat_link']['nofollow'] ? ' rel="nofollow"' : ''; ?>
                <div class="<?php echo esc_attr($settings['cat_column']); ?> card_d_flex cat_box" <?php if(!empty($cat_repeater['background_color']) || !empty($cat_repeater['border_color'])): ?>style="<?php if(!empty($cat_repeater['background_color'])): ?>background:<?php echo esc_attr($cat_repeater['background_color']); ?>!important;<?php endif; ?>
                <?php if(!empty($cat_repeater['border_color'])): ?>border-color:<?php echo esc_attr($cat_repeater['border_color']); ?>!important;<?php endif; ?>" <?php endif; ?>>
                <div>
                    <?php if(!empty($cat_repeater['cat_image']['url'])): 
                         $alt_text = 'alt';
                         $image = isset($cat_repeater['cat_image']['alt']) ? $cat_repeater['cat_image']['alt'] : '';
                         if(!empty($image)) {
                           $alt_text = $image;
                         }
                        ?>
                    <figure class="img-hover-scale">
                        <a href="<?php echo esc_url($cat_repeater['cat_link']['url']); ?>" <?php echo esc_attr($target); ?>
                            <?php echo esc_attr($nofollow); ?> class="d-block">
                            <img src="<?php echo esc_url($cat_repeater['cat_image']['url']); ?>" alt="<?php echo esc_attr($alt_text); ?>" />
                        </a>
                    </figure>
                    <?php endif; ?>
                    <?php if(!empty($cat_repeater['cat_name'])): ?>
                    <h6> <a href="<?php echo esc_url($cat_repeater['cat_link']['url']); ?>" <?php echo esc_attr($target); ?>
                            <?php echo esc_attr($nofollow); ?> <?php if(!empty($cat_repeater['heading_color'])): ?>style="color:<?php echo esc_attr($cat_repeater['heading_color']); ?>;" <?php endif; ?>><?php echo wp_kses($cat_repeater['cat_name'] , $allowed_tags); ?></a></h6>
                    <?php endif; ?>
                    <?php if(!empty($cat_repeater['item_count'])): ?>
                    <span <?php if(!empty($cat_repeater['count_color'])): ?>style="color:<?php echo esc_attr($cat_repeater['count_color']); ?>;" <?php endif; ?>><?php echo esc_attr($cat_repeater['item_count']); ?></span>
                    <?php endif; ?>
                </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </section>


 

    <?php
    }
}

 