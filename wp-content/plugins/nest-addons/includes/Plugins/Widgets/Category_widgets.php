<?php
// Register Product Category Filters Widget
function custom_register_category_filter_widget() {
    register_widget('Nest_Category_Filter_Widget');
}
add_action('widgets_init', 'custom_register_category_filter_widget');

// Custom Product Category Filter Widget
class Nest_Category_Filter_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'Nest_Category_Filter_Widget',
            'Nest Product Category Filter V1',
            array('description' => 'Widget to filter products by multiple categories.')
        );
    }

    function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        $this->render_category_filter();
        echo $args['after_widget'];
    }

    function render_category_filter() {
        // Get the current category filters from the URL
        $current_category_filters = isset($_GET['category']) ? explode(',', $_GET['category']) : array();

        // Get all unique category terms
        $category_terms = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ));

        if (!empty($category_terms)) {
            echo '<ul class="category-filter-widget">';

            foreach ($category_terms as $term) {
                // Check if the category is currently selected
                $is_selected = in_array($term->slug, $current_category_filters);

                // Generate the input checkbox for each category
                echo '<li><label>';
                echo '<input type="checkbox" name="category[]" value="' . $term->slug . '" ';
                if ($is_selected) {
                    echo 'checked';
                }
                echo '>';
                echo $term->name;   
				echo '<small>'.$term->count.'</small>';
                echo '</label></li>';
            }

            echo '</ul>';

            // Add filter and reset buttons
            echo '<div class="category-filter-buttons">';
            
            echo '<button class="reset-button btn btn-sm">' . esc_html__('Reset' , 'nest-addons') .'</button>';
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
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <?php
    }
}

// Modify main query based on selected category filters
function custom_product_category_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (isset($_GET['category'])) {
            $categories = explode(',', $_GET['category']);
            $tax_query = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $categories,
                    'operator' => 'IN',
                ),
            );
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'custom_product_category_filter');

// Enqueue scripts and styles
function nest_category_filter_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('category-filter-script', NEST_ADDONS_URL . 'includes/Plugins/js/category-widget.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'nest_category_filter_scripts');

 
