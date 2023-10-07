<?php
/*
======================================
Brand Widgets
======================================
*/
class Nest_Brand_Widget extends WP_Widget {
    // Widget constructor
    public function __construct() {
        $widget_options = array(
            'classname' => 'Nest_brand_widget',
            'description' => 'Nest Brand V2',
        );
        parent::__construct('Nest_brand_widget', 'Nest Brand Widget', $widget_options);
    }
    // Widget frontend display
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        $enableImage = isset($instance['enable_image']) ? $instance['enable_image'] : false;
        $enableTitle = isset($instance['enable_title']) ? $instance['enable_title'] : false;
        $enableCount = isset($instance['enable_count']) ? $instance['enable_count'] : false;
  
        $excludeIds = isset($instance['exclude_ids']) ? $instance['exclude_ids'] : '';
        $orderby = isset($instance['orderby']) ? $instance['orderby'] : 'name';
        $order = isset($instance['order']) ? $instance['order'] : 'asc';
    
        // Widget output code here
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $term_args = array(
            'taxonomy'     => 'brand', // Replace with the actual taxonomy name for brands
            'exclude'      => $excludeIds,
            'orderby'      => $orderby,
            'order'        => $order,
            'hide_empty'   => 1, // Updated parameter to hide empty brands
        );
        $brand_terms = get_terms($term_args); 
        ?>
        <div class="n_brand_box">
            <ul>
                <?php foreach ($brand_terms as $brand) {
                    $brand_link = get_term_link($brand);
                    $brand_image = get_term_meta($brand->term_id, 'brand_image', true); 
                    $brand_title = $brand->name;
                    $brand_count = $brand->count;
    
                    if ($brand_count > 0) {
                        ?>
                        <li class="brand_list">
                            <div class="brand_box"> 
                                <?php if (!empty($brand_image) && $enableImage): ?>
                                    <figure class="img-hover-scale">
                                        <a href="<?php echo esc_url($brand_link); ?>" class="d-block">
                                            <img src="<?php echo esc_attr($brand_image); ?>" alt="<?php echo esc_attr($brand_title); ?>" />
                                        </a>
                                    </figure>
                                <?php endif; ?>
                                <div class="content">
                                    <?php if (!empty($brand_title) && $enableTitle): ?>
                                        <h6><a href="<?php echo esc_url($brand_link); ?>"><?php echo esc_attr($brand_title); ?></a> <?php if (!empty($brand_count) && $enableCount): ?>
                                        <span><?php echo esc_attr($brand_count); ?></span>
                                    <?php endif; ?></h6>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                } ?>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }
    // Widget backend form
    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $enableImage = isset($instance['enable_image']) ? (bool) $instance['enable_image'] : false;
        $enableTitle = isset($instance['enable_title']) ? (bool) $instance['enable_title'] : false;
        $enableCount = isset($instance['enable_count']) ? (bool) $instance['enable_count'] : false;
        $excludeIds = isset($instance['exclude_ids']) ? esc_attr($instance['exclude_ids']) : '';
        $orderby = isset($instance['orderby']) ? esc_attr($instance['orderby']) : 'name';
        $order = isset($instance['order']) ? esc_attr($instance['order']) : 'asc';
        // Widget form code here
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Widget Title:' , 'nest-addons'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('enable_image'); ?>" name="<?php echo $this->get_field_name('enable_image'); ?>" type="checkbox" <?php checked($enableImage); ?>>
            <label for="<?php echo $this->get_field_id('enable_image'); ?>"><?php echo esc_html__('Enable Brand Image', 'nest-addons'); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('enable_title'); ?>" name="<?php echo $this->get_field_name('enable_title'); ?>" type="checkbox" <?php checked($enableTitle); ?>>
            <label for="<?php echo $this->get_field_id('enable_title'); ?>"><?php echo esc_html__('Enable Brand Title', 'nest-addons'); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('enable_count'); ?>" name="<?php echo $this->get_field_name('enable_count'); ?>" type="checkbox" <?php checked($enableCount); ?>>
            <label for="<?php echo $this->get_field_id('enable_count'); ?>"><?php echo esc_html__('Enable Brand Count', 'nest-addons'); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('exclude_ids'); ?>"><?php echo esc_html__('Exclude Brand IDs (comma-separated):', 'nest-addons'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('exclude_ids'); ?>" name="<?php echo $this->get_field_name('exclude_ids'); ?>" type="text" value="<?php echo $excludeIds; ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php echo esc_html__('Order By:', 'nest-addons'); ?></label>
            <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
                <option value="name" <?php selected($orderby, 'name'); ?>><?php echo esc_html__('Name', 'nest-addons'); ?></option>
                <option value="count" <?php selected($orderby, 'count'); ?>><?php echo esc_html__('Count' , 'nest-addons'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php echo esc_html__('Order:', 'nest-addons'); ?></label>
            <select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option value="asc" <?php selected($order, 'asc'); ?>><?php echo esc_html__('Ascending', 'nest-addons'); ?></option>
                <option value="desc" <?php selected($order, 'desc'); ?>><?php echo esc_html__('Descending', 'nest-addons'); ?></option>
            </select>
        </p>
        <?php
    }
   // Widget backend form update
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['enable_image'] = isset($new_instance['enable_image']) ? (bool) $new_instance['enable_image'] : false;
        $instance['enable_title'] = isset($new_instance['enable_title']) ? (bool) $new_instance['enable_title'] : false;
        $instance['enable_count'] = isset($new_instance['enable_count']) ? (bool) $new_instance['enable_count'] : false;
        $instance['count_text'] = (!empty($new_instance['count_text'])) ? sanitize_text_field($new_instance['count_text']) : '';
        $instance['exclude_ids'] = (!empty($new_instance['exclude_ids'])) ? sanitize_text_field($new_instance['exclude_ids']) : '';
        $instance['orderby'] = isset($new_instance['orderby']) ? sanitize_text_field($new_instance['orderby']) : 'name';
        $instance['order'] = isset($new_instance['order']) ? sanitize_text_field($new_instance['order']) : 'asc';
        return $instance;
    }
}

// Register the Nest_Brand_Widget
function register_Nest_brand_widget() {
    register_widget('Nest_Brand_Widget');
}
add_action('widgets_init', 'register_Nest_brand_widget');
