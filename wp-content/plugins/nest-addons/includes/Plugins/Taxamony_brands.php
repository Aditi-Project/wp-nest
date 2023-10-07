<?php
/*
** ===================
** Nest Taxamony Brands
** version: 1.0;
** Authour : Steeltheme;
** ===================
*/
function nest_brand_taxonomy() {
    $labels = array(
        'name' => esc_html_x('Brands', 'nest-addons'),
        'singular_name' => esc_html_x('Brand','nest-addons'),
        'search_items' => esc_html_x('Search Brands','nest-addons'),
        'all_items' => esc_html_x('All Brands','nest-addons'),
        'parent_item' => esc_html_x('Parent Brand','nest-addons'),
        'parent_item_colon' => esc_html_x('Parent Brand:','nest-addons'),
        'edit_item' => esc_html_x('Edit Brand','nest-addons'),
        'update_item' => esc_html_x('Update Brand','nest-addons'),
        'add_new_item' => esc_html_x('Add New Brand','nest-addons'),
        'new_item_name' => esc_html_x('New Brand Name','nest-addons'),
        'menu_name' => esc_html_x('Brands','nest-addons'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'brand' ),
    );

    register_taxonomy( 'brand', array( 'product' ), $args );
}
add_action( 'init', 'nest_brand_taxonomy' );

function nest_brand_image_field() {
    add_action( 'brand_add_form_fields', 'nest_brand_image_add_form_field', 10, 2 );
    add_action( 'created_brand', 'nest_brand_image_save_form_field', 10, 2 );
    add_action( 'brand_edit_form_fields', 'nest_brand_image_edit_form_field', 10, 2 );
    add_action( 'edited_brand', 'nest_brand_image_update_form_field', 10, 2 );
    add_action( 'admin_enqueue_scripts', 'nest_brand_image_enqueue_scripts' );
}
add_action( 'init', 'nest_brand_image_field' );

function nest_brand_image_add_form_field() {
    ?>
    <div class="form-field term-group">
        <label for="brand-image"><?php esc_html_e( 'Brand Image', 'nest-addons' ); ?></label>
        <input type="hidden" id="brand-image" name="brand_image" class="custom-media-url" value="">
        <div class="custom-media-container">
            <img src="" alt="" class="custom-media-image">
            <a href="#" class="custom-media-upload"><?php esc_html_e( 'Upload/Add Image', 'nest-addons' ); ?></a>
            <a href="#" class="custom-media-remove"><?php esc_html_e( 'Remove Image', 'nest-addons' ); ?></a>
        </div>
    </div>
    <?php
}

function nest_brand_image_save_form_field( $term_id, $tt_id ) {
    if ( isset( $_POST['brand_image'] ) ) {
        update_term_meta( $term_id, 'brand_image', sanitize_text_field( $_POST['brand_image'] ) );
    }
}
function nest_brand_image_edit_form_field( $term, $taxonomy ) {
    $brand_image = get_term_meta( $term->term_id, 'brand_image', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="brand-image"><?php esc_html_e( 'Brand Image', 'nest-addons' ); ?></label>
        </th>
        <td>
            <input type="hidden" id="brand-image" name="brand_image" class="custom-media-url" value="<?php echo esc_attr( $brand_image ); ?>">
            <div class="custom-media-container">
                <?php if ( ! empty( $brand_image ) ) : ?>
                    <img src="<?php echo esc_url( $brand_image ); ?>" alt="brand-img" class="custom-media-image">
                <?php endif; ?>
                <a href="#" class="custom-media-upload"><?php esc_html_e( 'Upload/Add Image', 'nest-addons' ); ?></a>
                <a href="#" class="custom-media-remove"><?php esc_html_e( 'Remove Image', 'nest-addons' ); ?></a>
            </div>
        </td>
    </tr>
    <?php
}

function nest_brand_image_update_form_field( $term_id, $tt_id ) {
    if ( isset( $_POST['brand_image'] ) ) {
        update_term_meta( $term_id, 'brand_image', sanitize_text_field( $_POST['brand_image'] ) );
    }
}
function nest_brand_image_enqueue_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'custom-brand-image', NEST_ADDONS_URL . 'includes/Plugins/js/brand.js', array( 'jquery' ), '1.0', true );
}
?>