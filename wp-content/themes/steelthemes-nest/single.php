<?php
/*
**==============================   
**Nest Ecommerce Single File
**==============================
*/
get_header(); 
if(is_singular('header') || is_singular('footer') || is_singular('mega_menu') || is_singular('sticky_header')):
	?>
	<?php // ===================== content for only header - footer - megamenu start ======================= ?>
	<div class="content_area"> 
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'blocks' ); ?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #primary --> 
	<?php // ===================== content for only header - footer - megamenu end ======================= ?>
<?php else:  ?>
<div id="primary" class="content-area <?php  nest_column_for_blog(); ?>">
	<main id="main" class="site-main">
		<?php while ( have_posts() ) : the_post(); ?>
		    <?php get_template_part( 'template-parts/content', 'single' ); ?>
		<?php endwhile; // end of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php endif; ?>
<?php get_footer(); ?>