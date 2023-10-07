<?php

add_action( 'nest_get_perpage_product', 'nest_perpage_product');
function nest_perpage_product() {
    global $nest_theme_mod; 
    $per_page = isset( $_GET['per_page'] ) ? absint( $_GET['per_page'] ) : 2; // default number of products per page is 12
    $options = array(8 , 12, 24, 36 , 48 , 60 , 72 , 84 , 96 , 108 , 120 , 132 , 144 , 156 , 168 , 180 ); // dropdown options
    ?>
    <form class="woocommerce-products-per-page" action="" method="get">
        <label for="products_per_page"><?php _e( 'Show:', 'steelthemes-nest' ); ?></label>
        <select name="per_page" id="products_per_page" class="woocommerce-products-per-page__select noselectwo" onchange="this.form.submit()">
            <?php foreach ( $options as $option ) : ?>
                <option value="<?php echo esc_attr( $option ); ?>" <?php selected( $per_page, $option ); ?>><?php echo esc_html( $option ); ?></option>
            <?php endforeach; ?>
        </select>
    </form>
    <?php
}
add_filter( 'loop_shop_per_page', 'custom_products_per_page', 20 );
function custom_products_per_page( $products_per_page ) {
    $per_page = isset( $_GET['per_page'] ) ? absint( $_GET['per_page'] ) : $products_per_page; // use the selected number of products per page, or the default value
    return $per_page;
}