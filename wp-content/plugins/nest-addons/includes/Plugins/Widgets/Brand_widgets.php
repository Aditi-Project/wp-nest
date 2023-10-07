<?php
/*
======================================
Brand Widgets
======================================
*/
function nest_register_brand_filter_widget() {
    register_widget('Nest_Brand_Filter_Widget');
}
add_action('widgets_init', 'nest_register_brand_filter_widget');
// Custom Brand Filter Widget
// Custom Brand Filter Widget
class Nest_Brand_Filter_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'Nest_Brand_Filter_Widget',
            'Nest Brand Filter V1',
            array('description' => 'Widget to filter products by multiple brands.')
        );
    }
    function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $this->render_brand_filter();
        echo $args['after_widget'];
    }

    function render_brand_filter() {
        // Get the current brand filters from the URL
        $current_brand_filters = isset($_GET['brand']) ? explode(',', $_GET['brand']) : array();
    
        // Get all unique brand terms
        $brand_terms = get_terms(array(
            'taxonomy' => 'brand',
            'hide_empty' => true,
        ));
    
        if (!empty($brand_terms)) {
            echo '<ul class="brand-filter-widget">';
    
            foreach ($brand_terms as $term) {
                // Check if the brand is currently selected
                $is_selected = in_array($term->slug, $current_brand_filters);
    
                // Generate the input checkbox for each brand
                echo '<li>
                    <label>';
                echo '<input type="checkbox" name="brand[]" value="' . $term->slug . '" ';
                if ($is_selected) {
                    echo 'checked';
                }
                echo '>';
                echo $term->name;
                echo '<small>' . $term->count . '</small>';
                echo '</label>
                    </li>';
            }
    
            echo '</ul>';
    
            // Add filter and reset buttons
            echo '<div class="brand-filter-buttons">';
    
            // Remove existing brand parameter from the URL
            $current_url = remove_query_arg('brand', $_SERVER['REQUEST_URI']);
    
            // Create the brand filter link
            $brand_filter_link = add_query_arg('brand', implode(',', $current_brand_filters), $current_url);
      
            echo '<button class="reset-button btn btn-sm">' . esc_html__('Reset', 'nest-addons') . '</button>';
            echo '</div>';
        }
    }
     
 
    function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Title : ' , 'nest-addons'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <?php
    }
}
function nest_enqueue_brand_filter_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'brand-filter-script', NEST_ADDONS_URL . 'includes/Plugins/js/brand-widget.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'nest_enqueue_brand_filter_script' );
 