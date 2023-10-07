<?php
/*
**   ==============================   
**    Nest Ecommerce Footer File
**   ==============================
*/
global $nest_theme_mod; 
?> 
</div>
</div>
</div>

<?php if(!empty($nest_theme_mod['recently_viewd_poducts']) == true): ?>
<?php do_action('nest_get_recent_pro'); ?> 
<?php endif; ?>
<div class="cart_notice"></div>
<?php get_template_part('template-parts/footer/default', 'footer'); ?>
</div>
<?php if(function_exists('nest_mini_cart_mobile')): nest_mini_cart_mobile(); endif; ?>
<?php // mobile nav  ?>
<?php do_action('nest_custom_mobile_menu'); //nest_quick_view();?>
<?php // mobile nav  ?>
<?php if(!empty($nest_theme_mod['mobile_floating_enable']) == true): ?>
<?php // mobile Floating Menu  ?>
<?php do_action('get_custom_mobile_menu'); //nest_mobile_floating_menu();?>
<?php // mobile Floating Menu  ?>
<?php endif; ?>
<?php // filter side content ?>
<?php if(!empty($nest_theme_mod['filter_content_enable']) == true): ?>
<?php if(is_post_type_archive('product') || is_tax( 'product_cat')  || is_tax('product_tag')   || is_tax('brand')): ?>
<?php if(is_active_sidebar('filter-sidebar')): ?>
<div class="srollbar filter_side_content close-style-wrap scrollbarcolor">
    <div class="overlay_filter"></div>
    <button class="close-style nest_filter_btn_close search-close">
        <i class="icon-top"></i>
        <i class="icon-bottom"></i>
    </button>
    <div class="content">
        <?php dynamic_sidebar('filter-sidebar') ?>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php // filter side content ?>
<?php if(!empty($nest_theme_mod['bactotop_enable']) == true): ?>
<a class="scrollUp"><i class="fi-rs-arrow-small-up"></i></a>
<?php endif; ?>
<!--page_wapper-->
</div>
<?php wp_footer(); ?>
</body>
</html>