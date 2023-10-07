<?php
namespace  Nestaddons\Core\Widgets\Header;
if (!defined('ABSPATH')) {
    exit;
} // If this file is called directly, abort.
class Category_header extends \Elementor\Widget_Base{
    public function get_name()
    {
        return 'nest-category-header-v1';
    }
    public function get_title()
    {
        return __('Category Dropdown Header', 'nest-addons');
    }
    public function get_icon()
    {
        return 'icon-letter-n';
    }
    public function get_categories()
    {
        return ['100'];
    }
    protected function register_controls(){
    $this->start_controls_section('headers_settings',
        [ 
            'label' => __('Header Settings', 'nest-addons'),
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
        'default' =>  'style_two' ,   
        ]
    );
    $this->add_control(
        'category_texts',
        [
            'label' => __( 'Category Text One', 'nest-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Browse All Categories', 'nest-addons' ),
        
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
 
    $this->start_controls_section('cat_m_css',
    [ 
        'label' => __('Category Css', 'nest-addons'),
        'tab' =>\Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->add_control(
        'cate_drop_text_color',
        [
            'label' => __('Category Btn Text Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .main-categori-wrap > a.categories-button-active , 
                {{WRAPPER}} .main-categori-wrap > a.categories-button-active span ,
                {{WRAPPER}} .main-categori-wrap > a.categories-button-active  i ' => 'color: {{VALUE}}!important;',
            ],
        ]
    ); 
    $this->add_control(
        'cate_drop_color',
        [
            'label' => __('Category Btn Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .main-categori-wrap > a.categories-button-active ' => 'background: {{VALUE}}!important;',
            ],
        ]
    ); 
    $this->add_control(
        'cate_h_dropt_color',
        [
            'label' => __('Category Btn Hover Text Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .main-categori-wrap > a.categories-button-active:hover , 
                {{WRAPPER}} .main-categori-wrap > a.categories-button-active:hover span ,
                {{WRAPPER}} .main-categori-wrap > a.categories-button-active:hover  i ' => 'color: {{VALUE}}!important;',
            ],
        ]
    );  
    $this->add_control(
        'cate_h_drop_color',
        [
            'label' => __('Category Btn Hover Bg Color', 'nest-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .main-categori-wrap > a.categories-button-active:hover ' => 'background: {{VALUE}}!important;',
            ],
        ]
    );   
    $this->end_controls_section(); 

} 
protected function render(){
$settings = $this->get_settings_for_display();
$allowed_tags = wp_kses_allowed_html('post');
?>

<div class="main-categori-wrap">
    <a class="categories-button-active" href="#">
        <span class="fi-rs-apps"></span> <?php echo esc_attr($settings['category_texts']); ?>

        <i class="fi-rs-angle-down"></i>
    </a>
    <div class="categories-dropdown-wrap header_dropdown scrollbarcolor categories-dropdown-active-large font-heading">
        <div class="d-flex categori-dropdown-inner">
            <ul class="content_cat clearfix">
                <?php if($settings['category_type'] == 'style_two'): ?>
                <?php $category_ids = $settings['category'];
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
                if ($category_count > 0): ?>
                <li class="content_cat_list  <?php if(!empty($category_image_url)): ?> cat_image_in <?php endif; ?>">
                    <a href="<?php echo esc_url($category_link); ?>">
                        <?php if(!empty($category_image_url)): ?>
                        <img src="<?php echo esc_attr($category_image_url); ?>"
                            alt="<?php echo esc_attr($category_title); ?>" />
                        <?php endif; ?>
                        <?php if(!empty($category_title)): ?>
                        <span>
                            <?php echo esc_attr($category_title); ?>
                            <?php if(!empty($category_count)): ?>
                            <small><?php echo esc_attr($category_count); ?> </small>
                            <?php endif; ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
       
            <?php else: ?>
            <?php foreach($settings['cat_repeater'] as  $key => $cat_repeater):   
            $target = $cat_repeater['cat_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $cat_repeater['cat_link']['nofollow'] ? ' rel="nofollow"' : ''; ?>
            <li
                class="content_cat_list <?php if(!empty($cat_repeater['cat_image']['url'])): ?>cat_image_in <?php endif; ?>">
                <a href="<?php echo esc_url($cat_repeater['cat_link']['url']); ?>" <?php echo esc_attr($target); ?>
                    <?php echo esc_attr($nofollow); ?>>
                    <?php if(!empty($cat_repeater['cat_image']['url'])): 
                        $alt_text = 'alt';
                        $image = isset($cat_repeater['cat_image']['alt']) ? $cat_repeater['cat_image']['alt'] : '';
                        if(!empty($image)) {
                            $alt_text = $image;
                        }
                    ?>
                    <img src="<?php echo esc_url($cat_repeater['cat_image']['url']); ?>" alt="<?php echo esc_attr($alt_text); ?>"> <?php endif; ?>
                    <?php echo esc_attr($cat_repeater['cat_name']); ?></a>
            </li>
            <?php endforeach; ?>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php
    }
}