<?php
global $nest_theme_mod; 
$logo_dokan = get_template_directory_uri() . '/assets/images/logo.svg';
do_action( 'dokan_dashboard_wrap_start' ); ?>

    <div class="dokan-dashboard-wrap">
    <div class="sidebar_rewirte_dok_dash">
            <div class="logo_dokan_dash">
            <?php $dokan_dsh_logo = $nest_theme_mod['dokan_dashboard_logo']['url']; ?>
                <?php if(!empty($dokan_dsh_logo)): ?>
                    <a href="<?php  echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($dokan_dsh_logo); ?>" alt="dokan_logo" /></a>
                <?php else: ?>
                    <a href="<?php  echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($logo_dokan); ?>" alt="dokan_logo" /></a>
                <?php endif; ?>
            </div>
        <?php

            /**
             *  dokan_dashboard_content_before hook
             *  dokan_withdraw_content_before hook
             *
             *  @hooked get_dashboard_side_navigation
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_before' );
            do_action( 'dokan_withdraw_content_before' );
        ?>
      </div>
        <div class="dokan-dashboard-content dokan-withdraw-content">

            <?php

                /**
                 *  dokan_withdraw_content_inside_before hook
                 *
                 *  @since 2.4
                 */
                do_action( 'dokan_withdraw_content_inside_before' );
            ?>

            <article class="dokan-withdraw-area">

                <?php
                    /**
                     * dokan_withdraw_header_render hook
                     *
                     * @hooked dokan_coupon_header_render
                     *
                     * @since 2.4
                     */
                    do_action( 'dokan_withdraw_content_area_header' );
                ?>

                <div class="entry-content">

                    <?php
                        /**
                         * dokan_withdraw_header_render hook
                         *
                         * @hooked dokan_render_withdraw_error
                         * @hooked dokan_withdraw_status_filter
                         * @hooked dokan_show_seller_balance
                         * @hooked dokan_withdraw_form_and_listing
                         *
                         * @since 2.4
                         */
                        do_action( 'dokan_withdraw_content' );
                    ?>

                </div><!-- .entry-content -->

            </article>

            <?php

                /**
                 *  dokan_withdraw_content_inside_after hook
                 *
                 *  @since 2.4
                 */
                do_action( 'dokan_withdraw_content_inside_after' );
            ?>
         
        <footer class="main-footer font-xs">
                <div class="row pb-30 pt-15">
                    <div class="col-sm-6">
                        <?php 
                        $copy_right_l = isset( $nest_theme_mod['copy_right_left'] ) ? $nest_theme_mod['copy_right_left'] : '';
                         echo esc_attr($copy_right_l); ?>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end">
                        <?php  
                            $copy_right_r = isset( $nest_theme_mod['copy_right_right'] ) ? $nest_theme_mod['copy_right_right'] : '';
                         echo esc_attr($copy_right_r); ?>    
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- .dokan-dashboard-content -->

         <?php
            /**
             *  dokan_dashboard_content_after hook
             *  dokan_withdraw_content_after hook
             *
             *  @since 2.4
             */
            do_action( 'dokan_dashboard_content_after' );
            do_action( 'dokan_withdraw_content_after' );
        ?>
    </div><!-- .dokan-dashboard-wrap -->

<?php do_action( 'dokan_dashboard_wrap_end' ); ?>
