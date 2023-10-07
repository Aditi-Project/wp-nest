<?php
/**  nest edited
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
global  $nest_theme_mod;
global  $product; 
$clearfix = '';
$flex_enable = '';
$active_filters = isset( $nest_theme_mod['active_filters'] ) ? $nest_theme_mod['active_filters'] : '';
$product_archive_styleclass = '';
$product_archive_style = isset( $nest_theme_mod['product_archive_style'] ) ? $nest_theme_mod['product_archive_style'] : '';
if($product_archive_style == 'style_two' || nest_get_product_card_option_via_url() == 'style_two'):
	$product_archive_styleclass = 'product_arch_style_two';
elseif($product_archive_style == 'style_three' || nest_get_product_card_option_via_url() == 'style_three'):
	$product_archive_styleclass = 'product_arch_style_three';
elseif($product_archive_style == 'style_four' || nest_get_product_card_option_via_url() == 'style_four'):
	$product_archive_styleclass = 'product_arch_style_four';
elseif($product_archive_style == 'style_five' || nest_get_product_card_option_via_url() == 'style_five'):
	$product_archive_styleclass = 'product_arch_style_five';
else:
	$product_archive_styleclass = 'product_arch_style_one';
endif;
if(!empty($nest_theme_mod['per_page_enable']) == true || !empty($nest_theme_mod['filter_content_enable']) == true || !empty($nest_theme_mod['grid_list_vide_enable']) == true): 
	$flex_enable = 'flex_enable';
endif;
if(!empty($nest_theme_mod['filter_content_enable']) == false && !empty($nest_theme_mod['grid_list_vide_enable']) == false && !empty($nest_theme_mod['per_page_enable']) == false): 
  $clearfix = 'clearfix';
endif;
$filter_deep_content_enable = isset( $nest_theme_mod['filter_deep_content_enable'] ) ? $nest_theme_mod['filter_deep_content_enable'] : '';
?>
<div id="primary" class="content-area <?php nest_column_for_shop(); ?>">
<main id="mains" class="site-main">
	<div class="row">
		<div class="col-lg-12">
			<header class="woocommerce-products-header  clearfix"> 
				<?php do_action('woocommerce_archive_description'); ?>
				<div class="woocommerce_output_all_notices">
					<?php woocommerce_output_all_notices(); ?>
				</div>
				<div class="position-relative w_hun <?php echo esc_attr($clearfix); ?> <?php echo esc_attr($flex_enable); ?>">
					<?php do_action('nest_inside_shop_loop'); ?>
					<div class="in_right">
						<?php  do_action( 'woocommerce_before_shop_loop' ); ?>
					</div>
				</div>
				<?php if($filter_deep_content_enable == true): do_action( 'nest_after_shop_loop_fliter' );  endif; ?> 
			</header>
			<?php if($active_filters == true):
				$get_Nest_active_filters = new Nest_active_filters();
				$active_filter = $get_Nest_active_filters->display_active_filters();
				echo wp_kses($active_filter , wp_kses_allowed_html('post'));
			endif;
			?>
			<div class="products_box_outer <?php echo esc_attr($product_archive_styleclass); ?> clearfix">
				<?php if ( woocommerce_product_loop() ) {  
					woocommerce_product_loop_start();
					if ( wc_get_loop_prop( 'total' ) ) { 
						while ( have_posts() ) {
							the_post();
							do_action( 'woocommerce_shop_loop' );
							wc_get_template_part( 'content', 'product' ); 
					
						} 
					}  
					woocommerce_product_loop_end(); 
					do_action( 'woocommerce_after_shop_loop' );
					} else {
						do_action( 'woocommerce_after_main_content' );
						do_action( 'woocommerce_no_products_found' );
					}
				?>
			</div><!-- #primary -->
		</div>
		</div>
	</main><!-- #main -->
</div>
<?php
do_action( 'woocommerce_sidebar' );
get_footer( 'shop' );
