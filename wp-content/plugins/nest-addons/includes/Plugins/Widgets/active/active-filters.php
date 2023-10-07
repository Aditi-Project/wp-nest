<?php 
/*
======================================
Active Filters
======================================
*/
defined( 'ABSPATH' ) || exit; 
class Nest_active_filters {
        /**
 * Get the current page URL.
 *
 * @return string The current page URL.
 */
public function get_current_page_urls() {
    $page_url = '';

    if ( is_ssl() ) {
        $page_url .= 'https://';
    } else {
        $page_url .= 'http://';
    }

    if ( isset( $_SERVER['HTTP_HOST'] ) && isset( $_SERVER['REQUEST_URI'] ) ) {
        $page_url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    return $page_url;
}

    public function display_active_filters($args = array()) {
        $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
        $active_category_filters =  isset($_GET['category']) ? explode(',', $_GET['category']) : array();
        $active_brand_filters =   isset($_GET['brand']) ? explode(',', $_GET['brand']) : array();
		$min_price          = isset( $_GET['min_price'] ) ? wc_clean( wp_unslash( $_GET['min_price'] ) ) : 0; // WPCS: input var ok, CSRF ok.
		$max_price          = isset( $_GET['max_price'] ) ? wc_clean( wp_unslash( $_GET['max_price'] ) ) : 0; // WPCS: input var ok, CSRF ok.
        $rating_filter      = isset( $_GET['rating_filter'] ) ? array_filter( array_map( 'absint', explode( ',', wp_unslash( $_GET['rating_filter'] ) ) ) ) : array(); // WPCS: sanitization ok, input var ok, CSRF ok.
        $current_stock_filter = isset($_GET['filter_stock_status']) ? sanitize_text_field($_GET['filter_stock_status']) : '';
        $base_link = $this->get_current_page_urls(); 
        if ( 0 < count( $_chosen_attributes ) || 0 < $min_price || 0 < $max_price || ! empty( $rating_filter ) || ! empty( $active_category_filters )   || !empty($current_stock_filter)  || ! empty( $active_brand_filters ) ) {
        echo '<div class="active-filters">'; 
        echo '<ul>';
        echo '<li class="title_li">' . esc_html__('Active Filters ', 'nest-addons') . ' <em> - </em></li>';
        if (!empty($active_category_filters)) {
            echo '<li class="chosen"><span>' . esc_html__('Category : ', 'nest-addons') . '</span>';
            foreach ($active_category_filters as $category) {
                $link_category = implode(',', array_diff($active_category_filters, array($category)));
                $link = $link_category ? add_query_arg('category', $link_category, $base_link) : remove_query_arg('category', $base_link);
                echo '<small>' . esc_html($category) . '<a rel="nofollow" aria-label="' . esc_attr__('Remove filter', 'nest-addons') . '" href="' . esc_url($link) . '">X</a></small>';
            }
            echo '</li>';
        }

        if (!empty($active_brand_filters)) {
            echo '<li class="chosen"><span>' . esc_html__('Brand : ', 'nest-addons') . '</span>';
            foreach ($active_brand_filters as $brand) {
                $link_brand = implode(',', array_diff($active_brand_filters, array($brand)));
                $link = $link_brand ? add_query_arg('c', $link_brand) : remove_query_arg('brand', $base_link);

                echo '<small>' . esc_html($brand) . '<a rel="nofollow" aria-label="' . esc_attr__('Remove filter', 'nest-addons') . '" href="' . esc_url($link) . '">X</a></small>';
            }
            echo '</li>';
        }

     	// Attributes.
			if ( ! empty( $_chosen_attributes ) ) {
				foreach ( $_chosen_attributes as $taxonomy => $data ) {
                    echo '<li><span>'.esc_html__( 'Attribute : ', 'steelthemes-nest' ).'</span>';
					foreach ( $data['terms'] as $term_slug ) {
						$term = get_term_by( 'slug', $term_slug, $taxonomy );
						if ( ! $term ) {
							continue;
						} 
						$filter_name    = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
						$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array(); // WPCS: input var ok, CSRF ok.
						$current_filter = array_map( 'sanitize_title', $current_filter );
						$new_filter     = array_diff( $current_filter, array( $term_slug ) );

						$link = remove_query_arg( array( 'add-to-cart', $filter_name ), $base_link );

						if ( count( $new_filter ) > 0 ) {
							$link = add_query_arg( $filter_name, implode( ',', $new_filter ), $link );
						}

						$filter_classes = array('chosen-' . sanitize_html_class( str_replace( 'pa_', '', $taxonomy ) ), 'chosen-' . sanitize_html_class( str_replace( 'pa_', '', $taxonomy ) . '-' . $term_slug ) );

						echo '<li class="chosen"><small>' . esc_html( $term->name ) . ' <a class="' . esc_attr( implode( ' ', $filter_classes ) ) . '" rel="nofollow" aria-label="' . esc_attr__( 'Remove filter', 'steelthemes-nest' ) . '" href="' . esc_url( $link ) . '">X</a></small></li>';
					}
                    echo '</li>';
				}
			}
          


        if ($min_price > 0 || $max_price > 0) {
          
            echo '<li class="chosen"><span>' . esc_html__('Price: ', 'nest-addons') . '</span>';
            if ( $min_price ) {
                $link = remove_query_arg( 'min_price', $base_link );
                echo '<small>' . esc_html__('Min - ', 'nest-addons') . ' ' . wc_price($min_price) . '<a rel="nofollow" aria-label="' . esc_attr__('Remove filter', 'nest-addons') . '" href="' . esc_url($link) . '">X</a></small>';
            }
            if ( $max_price ) {
                $link = remove_query_arg( 'max_price', $base_link );
                echo '<small>' . esc_html__('Max - ', 'nest-addons') . ' ' . wc_price($max_price) . '<a rel="nofollow" aria-label="' . esc_attr__('Remove filter', 'nest-addons') . '" href="' . esc_url($link) . '">X</a></small>';
            }
            echo '</li>';
        }

        if (!empty($rating_filter)) {
            echo '<li class="chosen"> <span>' . esc_html__('Rating : ', 'nest-addons') . '</span>';
            foreach ($rating_filter as $rating) {
                $link_ratings = implode(',', array_diff($rating_filter, array($rating)));
                $link = $link_ratings ? add_query_arg('rating_filter', $link_ratings) : remove_query_arg('rating_filter', $base_link);

                echo '<small>' . esc_html($rating) . ' <a rel="nofollow" aria-label="' . esc_attr__('Remove filter', 'nest-addons') . '" href="' . esc_url($link) . '">X</a></small>';
            }
            echo '</li>';
        }

        if (!empty($current_stock_filter)) {
            $stock_label = '';
            if ($current_stock_filter === 'instock') {
                $stock_label = 'In Stock';
            } elseif ($current_stock_filter === 'outofstock') {
                $stock_label = 'Out of Stock';
            }

            if (!empty($stock_label)) {
                $link = remove_query_arg('filter_stock_status', $base_link);
                echo '<li class="chosen"><span>' . esc_html__('Status : ', 'nest-addons') . '</span> <small>' . esc_html($stock_label) . '  <a rel="nofollow" aria-label="' . esc_attr__('Remove filter', 'nest-addons') . '" href="' . esc_url($link) . '">X</a></small></li>';
            }
        }

        echo '</ul>';
        echo '</div>';
    }
    }
}
$Nest_active_filters = new Nest_active_filters(); 
