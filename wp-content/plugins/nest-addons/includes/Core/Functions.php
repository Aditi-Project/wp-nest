<?php 
namespace Nestaddons\Core;
class Functions{
	  /**
      * Instantiate the object.
      *
      * @since 1.0.0
      *
      * @return void
      */
      public function __construct() {
		add_shortcode('nest-mega-menu', [$this, 'nest_render_megamenu']);
		add_action('nest_header', [$this, 'nest_render_header']);
		add_action('nest_sticky_header', [$this, 'nest_render_sticky_header']);
		add_action('nest_footer', [$this, 'nest_render_footer']);
	}

/*
** ============================== 
**   nestheader
** ==============================
*/ 
	
public function nest_render_header() { 
	global $nest_theme_mod;
	$header_id = '';
	if(!empty($nest_theme_mod['header_custom_style'])):
		$header_id = $nest_theme_mod['header_custom_style'];
	endif;
	if(get_post_meta(get_the_ID() , 'custom_header', true)):
		$header_id = get_post_meta(get_the_ID() , 'header_settings_meta', true);
	endif;
	$header_query_args = array(
		'post_type' => 'header',
		'p' => $header_id,
	);
	$header_post_query = new \WP_Query($header_query_args); ?>

	<?php if ($header_post_query->have_posts()) : ?>
		<?php wp_reset_query(); ?> <!-- reset the global $wp_query object -->
		<?php while ($header_post_query->have_posts()) : $header_post_query->the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html__('Sorry, no posts matched your criteria.', 'nest-addons'); ?></p>
	<?php endif;
}

/*
** ============================== 
**   nestheader
** ==============================
*/ 
	
public function nest_render_sticky_header() {
	global $nest_theme_mod;
	$header_sticky_id = '';
	if(!empty($nest_theme_mod['header_sticky_custom_style'])):
		$header_sticky_id = $nest_theme_mod['header_sticky_custom_style'];
	endif;
	if(get_post_meta(get_the_ID() , 'custom_sticky_header', true)):
	$header_sticky_id = get_post_meta(get_the_ID() , 'sticky_header_settings_meta', true);
	endif;
	$sticky_query_args = array(
		'post_type' => 'sticky_header',
		'p' => $header_sticky_id,
	);
	$sticky_post_query = new \WP_Query($sticky_query_args); ?>

	<?php if ($sticky_post_query->have_posts()) : ?>
		<?php wp_reset_query(); ?> <!-- reset the global $wp_query object -->
		<?php while ($sticky_post_query->have_posts()) : $sticky_post_query->the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html__('Sorry, no posts matched your criteria.', 'nest-addons'); ?></p>
	<?php endif;
}
/*
** ============================== 
**   nest megamenu
** ==============================
*/ 
	
public function nest_render_megamenu($atts, $content = '') {
	$query_args = array(
		'p' => $atts['id'],
		'post_type' => 'mega_menu',
	);
	$post_query = new \WP_Query($query_args); ?>

	<?php if ($post_query->have_posts()) : ?>
		<?php wp_reset_query(); ?> <!-- reset the global $wp_query object -->
		<?php while ($post_query->have_posts()) : $post_query->the_post(); ?>
		
			<?php the_content(); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html__('Sorry, no posts matched your criteria.', 'nest-addons'); ?></p>
	<?php endif;
}
/*
** ============================== 
**   nestfooter
** ==============================
*/ 
public function nest_render_footer() {
	global $nest_theme_mod;
	$footer_id = '';
	if(!empty($nest_theme_mod['footer_custom_style'])):
	$footer_id = $nest_theme_mod['footer_custom_style'];
	endif;
	if(get_post_meta(get_the_ID() , 'custom_footer', true)):
		$footer_id = get_post_meta(get_the_ID() , 'footer_settings_meta', true);
	endif;
	$footer_query_args = array(
		'p' => $footer_id,
		'post_type' => 'footer',
	);
	$footer_post_query = new \WP_Query($footer_query_args); ?>

	<?php if ($footer_post_query->have_posts()) : ?>
		<?php wp_reset_query(); ?> <!-- reset the global $wp_query object -->
		<!-- the loop -->
		<?php while ($footer_post_query->have_posts()) : $footer_post_query->the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		<!-- end of the loop -->

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html__('Sorry, no posts matched your criteria.', 'nest-addons'); ?></p>
	<?php endif;
  }

    
}