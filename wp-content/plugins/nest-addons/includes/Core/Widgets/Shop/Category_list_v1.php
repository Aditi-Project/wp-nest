<?php

namespace  Nestaddons\Core\Widgets\Shop;

if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.

class Category_list_v1 extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'nest-categort-list-v1';
    }

    public function get_title()
    {
        return __('Category List V1', 'nest-addons');
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
        $this->start_controls_section('cat_list_v1_settings',
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
            'default' => 'style_two' , 
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
        $this->add_control(
            'cat_repeater',
            [
                'label' => __('Category Repeater', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                    'cat_name' =>  __('Cake & Milk', 'nest-addons'),
                    ],
                    [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                     [
                    'cat_name' =>  __('Oganic Kiwi', 'nest-addons'),
                    ],
                ],
                'title_field' => '{{{ cat_name }}}',
                'condition' => [
                    'category_type' => 'style_one'
                ], 
            ]
        );
         
       
     
        $this->end_controls_section();


        $this->start_controls_section('cat_list_css',
        [ 
            'label' => __('Category List Css', 'nest-addons'),
            'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
        ]
        );

       
        $this->add_control(
            'cat_color',
             [
                'label' => __('Category Color', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-dropdown-wrap-style-2 ul li a ' => 'color: {{VALUE}}!important;',
                ],
             ]
        );
        $this->add_control(
            'cat_hover_color',
             [
                'label' => __('Category Hover Color', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-dropdown-wrap-style-2 ul li a:hover ' => 'color: {{VALUE}}!important;',
                ],
             ]
        );

        $this->add_control(
            'cat_box_bor_color',
             [
                'label' => __('Category Box Border Color', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-dropdown-wrap-style-2  ' => 'border-color: {{VALUE}}!important;',
                ],
             ]
        );
        
        $this->add_control(
            'cat_box_background_color',
             [
                'label' => __('Category Box Background Color', 'nest-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .categories-dropdown-wrap-style-2  ' => 'background: {{VALUE}}!important;',
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
    <?php if($settings['category_type'] == 'style_two'): ?>
		<div class="categories-dropdown-wrap-style-2 font-heading">
            <div class="d-flex categori-dropdown-inner">
			<ul class="content_cat clearfix">
            <?php 
            $category_ids = $settings['category'];
            $category_orderbg = $settings['query_orderby'];
            $category_order = $settings['query_order'];

       
            $parent_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'exclude'      => $category_ids,
                'orderby'      => $category_orderbg,
                'order'        => $category_order,
                'parent' => 0, // Get only the top-level categories
                'hide_empty' => false // Include empty categories as well
            ));
        
            foreach ($parent_categories as $parent_category) {
                $category_link = get_term_link($parent_category);
                $category_image_id = get_term_meta($parent_category->term_id, 'thumbnail_id', true);
                $category_image_url = wp_get_attachment_url($category_image_id);
                $category_title = $parent_category->name;
                $category_count = $parent_category->count;
                $child_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'child_of' => $parent_category->term_id,
                    'hide_empty' => false // Include empty categories as well
                ));
                ?>
                <li class="content_cat_list<?php if (!empty($category_image_url)): ?> cat_image_in<?php endif; ?><?php if (!empty($child_categories)): ?> drop_down<?php endif; ?>">
                <a href="<?php echo esc_url($category_link); ?>" class="clearfix">
                    <em>
                    <?php if (!empty($category_image_url)): ?>
                    <img src="<?php echo esc_attr($category_image_url); ?>" alt="<?php echo esc_attr($category_title); ?>" />
                    <?php endif; ?>
                    <?php if (!empty($category_title)): ?>
                        <span>
                            <?php echo esc_attr($category_title); ?>   
                           
                        </span>
                        <?php if (!empty($category_count)): ?>
                                <small><?php echo esc_attr($category_count); ?></small>
                            <?php endif; ?>
                    <?php endif; ?>
                    </em>
                    </a>
                    <?php if (!empty($child_categories)) {
                     
                        ?>
                        <ul>
                            <?php foreach ($child_categories as $child_category) {
                                    $child_category_link = get_term_link($child_category);
                                    $child_category_image_id = get_term_meta($child_category->term_id, 'thumbnail_id', true);
                                    $child_category_image_url = wp_get_attachment_url($child_category);
                                    $child_category_title = $child_category->name;
                                    $child_category_count = $child_category->count;
                                ?>
                                <li class="content_cat_list clearfix<?php if (!empty($child_category_image_url)): ?> cat_image_in<?php endif; ?>">
                                    <a href="<?php echo esc_url($child_category_link); ?>"  class="clearfix">
                                    <em>
                                    <?php if (!empty($child_category_image_url)): ?>
                                        <img src="<?php echo esc_attr($child_category_image_url); ?>" alt="<?php echo esc_attr($child_category_title); ?>" />
                                        <?php endif; ?>
                                        <?php if (!empty($child_category_title)): ?>
                                            <span>
                                                <?php echo esc_attr($child_category_title); ?>    
                                            </span>
                                             <?php if (!empty($child_category_count)): ?>
                                                    <small><?php echo esc_attr($child_category_count); ?></small>
                                                <?php endif; ?>
                                        <?php endif; ?>
                                    </em>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
 
				</ul>
            </div>
		</div>
       <?php else: ?>
    <div class="categories-dropdown-wrap-style-2 font-heading">
        <div class="d-flex categori-dropdown-inner">
            <ul>
            <?php foreach($settings['cat_repeater'] as  $key => $cat_repeater):   
            $target = $cat_repeater['cat_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $cat_repeater['cat_link']['nofollow'] ? ' rel="nofollow"' : ''; ?>
                <li class="content_cat_list_sutom <?php if(!empty($cat_repeater['cat_image'])): ?>  cat_image_in<?php endif; ?>">
                <a href="<?php echo esc_url($cat_repeater['cat_link']['url']); ?>" <?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>>  
                <em>
                    <?php if(!empty($cat_repeater['cat_image']['url'])): 
                     $alt_text = 'alt';
                     $image = isset($cat_repeater['cat_image']['alt']) ? $cat_repeater['cat_image']['alt'] : '';
                     if(!empty($image)) {
                       $alt_text = $image;
                     }
                    ?>
                    <img src="<?php echo esc_url($cat_repeater['cat_image']['url']); ?>" alt="<?php echo esc_attr($alt_text); ?>">
                    <?php endif; ?>
                <span><?php echo esc_attr($cat_repeater['cat_name']); ?></span>
                </em>
                </a>                
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
      
    </div>

    
    <?php endif; ?>


    <?php
    }
}
 