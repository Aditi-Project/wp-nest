<?php
/*
**==============================   
**Nest Ecommerce Search File
**==============================
*/
get_header();
$error_images = '';
if(!empty($nest_theme_mod['404_image']['url'])):
    $error_images = $nest_theme_mod['404_image']['url'];
else:
    $error_images = get_template_directory_uri().'/assets/images/page-404.png'; 
endif;

$bg_error_image = '';
if(!empty($nest_theme_mod['bg_error_images']['url'])):
    $bg_error_image = $nest_theme_mod['bg_error_images']['url']; 
endif;
?>
<main class="main page-404" <?php if(!empty($bg_error_image)): ?> style="background-image:url('<?php echo esc_attr($bg_error_image); ?>" <?php endif; ?>>
    <div class="page-content">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 m-auto">
            <div class="m-auto text-center">
            <p class="m-auto">
                <img class="m-auto" src="<?php echo esc_url($error_images); ?>" alt="404" class="hover-up">
            </p>
            <div class="title_no_a_24">
                <?php echo esc_html_e('Oops! Why you’re here?', 'steelthemes-nest'); ?>
            </div>
            <p>
                <?php echo esc_html_e( 'We are very sorry for inconvenience. It looks like you’re try to access a page that either has been deleted or never existed.', 'steelthemes-nest' ); ?>
            </p>
            <div class="search-form text-center">
                <?php do_action('nest_custom_search_setup'); ?>
            </div>
            <div class="text-cetner">
                <a class="btn" href="<?php echo esc_url(home_url()); ?>"><i class="fi-rs-home mr-5"></i>
                    <?php esc_html_e('Back to home', 'steelthemes-nest'); ?></a>
            </div>
        </div>
</div>
</div>
</div>
    </div>
</main>
<?php get_footer();?>