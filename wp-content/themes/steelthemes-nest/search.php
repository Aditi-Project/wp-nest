<?php
/*
**==============================   
**Nest Ecommerce Search File
**==============================
*/
get_header(); ?>
<div id="primary" class="content-area blog_masonry col-lg-8 m-auto"><!-- #primary -->
    <main id="main" class="site-main"><!-- #main --> 
	
	<div class="row loop-grid"><!---#row---->
	
		<?php  $post = array( 'post', 'page' , 'product' ); 
		$args = array(
			'post_type' => $post,
			's' => get_search_query(),
		); 
		$query = new WP_Query( $args );
		if ( $query->have_posts() ):
			?>
<div class="row">
	<div class="col-lg-6 m-auto">
	<div class="search-form text-center mb-30">
                <?php do_action('nest_custom_search_setup'); ?>
            </div>
</div>
</div>
			<?php
			while ( $query->have_posts() ):
				$query->the_post(); 
				/**
				 * Run the loop for the search to output the results.
				 * ifyou want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part('template-parts/content', 'search');
			endwhile;
		?>
		<?php do_action('nest_custom_pagination'); ?>
		<?php else: ?>
			<?php get_template_part('template-parts/content', 'none'); ?>
		<?php endif; ?>
		<?php  wp_reset_postdata(); ?>
		</div><!-- #row --> 
		</main><!-- #main -->
	</div><!-- #primary --> 

<?php get_footer(); ?>