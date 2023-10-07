<?php
/*
 ** ==============================
 ** System Status
 ** ==============================
 */
global $wp_filesystem, $wpdb; ?>
<section class="nest_tab_box">
    <div class="nest_tab_wrapper">
        <div class="nest_admin_tab">
            <div class="nest_content_box">
                <div class="welcome_contnet c_bg_color">
                <div class="our_recent_themes">
                                <h2><?php echo esc_html(
                                    "Our Recent Themes",
                                    "steelthemes-nest"
                                ); ?> </h2>
                                <div class="d-flex"> 
                                    <div class="video common_box">
                                        <div class="inner_docsuppo">
                                            <?php $theme_1 =
                                                get_template_directory_uri() .
                                                "/includes/admin/images/theme-1.jpg"; ?>
                                            <?php if (
                                                !empty($theme_1)
                                            ): ?><img class="img-fluid"
                                                src="<?php echo esc_attr(
                                                    $theme_1
                                                ); ?>" alt="support" /><?php endif; ?>
                                            <h6>
                                                <?php echo esc_html(
                                                    "Vankine - Insurance & Consulting Business WordPress Theme",
                                                    "steelthemes-nest"
                                                ); ?>
                                                <a href="https://themeforest.net/item/vankine-insurance-business-wordpress-theme/43132301" target="_blank">
                                                    <?php echo esc_html(
                                                        "Purchase Now",
                                                        "steelthemes-nest"
                                                    ); ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div> 
                                    <div class="video common_box">
                                        <div class="inner_docsuppo">
                                            <?php $theme_2 =
                                                get_template_directory_uri() .
                                                "/includes/admin/images/theme-2.jpg"; ?>
                                            <?php if (
                                                !empty($theme_2)
                                            ): ?><img class="img-fluid"
                                                src="<?php echo esc_attr(
                                                    $theme_2
                                                ); ?>" alt="support" /><?php endif; ?>
                                            <h6>
                                                <?php echo esc_html(
                                                    "CopyGen - AI Writer & Copywriting Landing Page WordPress Theme",
                                                    "steelthemes-nest"
                                                ); ?>
                                                <a href="https://themeforest.net/item/copygen-ai-writer-copywriting-wordpress-theme/45798395" target="_blank">
                                                    <?php echo esc_html(
                                                        "Purchase Now",
                                                        "steelthemes-nest"
                                                    ); ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="d-flex">
                                    <div class="video common_box">
                                        <div class="inner_docsuppo">
                                            <?php $theme_3 =
                                                get_template_directory_uri() .
                                                "/includes/admin/images/theme-3.jpg"; ?>
                                            <?php if (
                                                !empty($theme_3)
                                            ): ?><img class="img-fluid"
                                                src="<?php echo esc_attr(
                                                    $theme_3
                                                ); ?>" alt="support" /><?php endif; ?>
                                            <h6>
                                                <?php echo esc_html(
                                                    "Lawnella - Gardening & Landscaping WordPress Theme",
                                                    "steelthemes-nest"
                                                ); ?>
                                                <a href="https://themeforest.net/item/lawnella-landscaping-wordpress-theme/26526840" target="_blank">
                                                    <?php echo esc_html(
                                                        "Purchase Now",
                                                        "steelthemes-nest"
                                                    ); ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div> 
                                    <div class="video common_box">
                                        <div class="inner_docsuppo">
                                            <?php $theme_4 =
                                                get_template_directory_uri() .
                                                "/includes/admin/images/theme-4.jpg"; ?>
                                            <?php if (
                                                !empty($theme_4)
                                            ): ?><img class="img-fluid"
                                                src="<?php echo esc_attr(
                                                    $theme_4
                                                ); ?>" alt="support" /><?php endif; ?>
                                            <h6>
                                                <?php echo esc_html(
                                                    "Creote - Corporate & Consulting Business WordPress Theme",
                                                    "steelthemes-nest"
                                                ); ?>
                                                <a href="https://themeforest.net/item/creote-business-wordpress-theme/34450141?s_rank=7" target="_blank">
                                                    <?php echo esc_html(
                                                        "Purchase Now",
                                                        "steelthemes-nest"
                                                    ); ?>
                                                </a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>

    </div>
</section>
