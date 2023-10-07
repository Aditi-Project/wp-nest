<?php
/*
 ** ==============================
 ** Welcome to theme page Main
 ** ==============================
 */
global $wp_filesystem, $wpdb; ?>
<section class="nest_tab_box">
    <div class="nest_tab_wrapper">
        <div class="nest_admin_tab">
            <div class="nest_content_box"> 
                <div class="welcome_contnet c_bg_color">
                    <h2 class="main_t"><?php echo esc_html(
                        "Welcome to Nest  ",
                        "steelthemes-nest"
                    ); ?> 
                    <?php
                    $current_theme = wp_get_theme();
                    echo "v" . $current_theme->get("Version");
                    ?>
                    </h2>
                    <p class="end">
                        <?php echo esc_html(
                            'Thank you for purchasing our Nest theme. Here you are able to 
                        start creating your awesome web Application by importing our dummy content and theme by options.',
                            "steelthemes-nest"
                        ); ?>
                    </p>
                    <div class="clearfix d-flex">
                        
                        <div class="copt_system_information">
                            <?php 
                              $customizer_url = admin_url( 'customize.php' );
                            ?>
                            <div class="start_box"> 
                            <p style="padding:10px 0 0 0;"><?php echo esc_html__("To Enable staging site  go to apperance -- customize -- Staging Site", "steelthemes-nest"); ?>
                            <a target="_blank" href="<?php echo  esc_url( $customizer_url ); ?>" class="customizer-button"><?php echo esc_html__("Click Here to enable staging", "steelthemes-nest"); ?></a></p>
                            <?php
                            //$Welcometotheme = new Welcometotheme();
                            //$Welcometotheme->theme_activation_page();
                            ?>
                            </div>
                         <div class="c_bg_teo_color">
                            <h2>
                                <?php echo esc_html(
                                    "System Information",
                                    "steelthemes-nest"
                                ); ?>
                            </h2>
                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "Your Php Version ",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php
                                        $php_version = phpversion();
                                        if (
                                            version_compare(
                                                $php_version,
                                                "5.6",
                                                "<"
                                            )
                                        ): ?>
                                        <?php
                                        echo esc_attr($php_version);
                                        echo esc_html__(
                                            " is too old. Please upgrade to version 5.6 or higher",
                                            "steelthemes-nest"
                                        );
                                        ?>
                                        <label> <?php esc_html__(
                                            "Please contact Host provider to fix it.",
                                            "steelthemes-nest"
                                        ); ?>
                                        </label>
                                        <?php else: ?>
                                        <?php
                                        echo esc_attr($php_version);
                                        echo esc_html__(
                                            " is up to date.",
                                            "steelthemes-nest"
                                        );
                                        ?>
                                        <?php endif;
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "MySQL Version",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php
                                        global $wpdb;
                                        $mysql_version = $wpdb->get_var(
                                            "SELECT version() as version"
                                        );
                                        ?>
                                        <span><?php echo esc_attr(
                                            $mysql_version
                                        ); ?></span>

                                    </li>
                                </ul>
                            </div>

                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "PHP Post Max Size",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php
                                        $max_post_size_bytes = wp_convert_hr_to_bytes(
                                            ini_get("post_max_size")
                                        );
                                        $max_post_size_formatted = size_format(
                                            $max_post_size_bytes
                                        );
                                        $bytes = wp_convert_hr_to_bytes(
                                            "512MB"
                                        );
                                        ?>
                                        <span><?php echo esc_attr(
                                            $max_post_size_formatted
                                        ); ?></span>
                                        <small><?php if (
                                            $max_post_size_bytes > $bytes
                                        ): ?>
                                            <?php echo esc_html(
                                                "looks good",
                                                "steelthemes-nest"
                                            ); ?>
                                            <?php else: ?>
                                            <?php echo esc_html(
                                                "Increase Your Post Max Size greaten than 512",
                                                "steelthemes-nest"
                                            ); ?>
                                            <?php endif; ?>
                                        </small>
                                    </li>
                                </ul>
                            </div>
                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "Max Upload Size",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php
                                        $max_upload_size_low = 256;
                                        $max_upload_size = ini_get(
                                            "upload_max_filesize"
                                        );
                                        ?>
                                        <span><?php echo esc_attr(
                                            $max_upload_size
                                        ); ?></span>
                                        <?php if (
                                            $max_upload_size >
                                            $max_upload_size_low
                                        ): ?>
                                        <small>
                                            <?php echo esc_html(
                                                "looks good",
                                                "steelthemes-nest"
                                            ); ?>
                                        </small>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                                <?php if (
                                    $max_upload_size < $max_upload_size_low
                                ): ?>
                                <em> <?php echo esc_html(
                                    "Increase Max Upload Size to 300 or 512 or maximum",
                                    "steelthemes-nest"
                                ); ?>
                                </em>
                                <?php endif; ?>
                            </div>

                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "PHP Time Limit",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php $current_time_limit = ini_get(
                                            "max_execution_time"
                                        ); ?>
                                        <?php if (
                                            $current_time_limit < 1000
                                        ): ?>
                                        <span>
                                            <?php
                                            echo esc_attr($current_time_limit);
                                            echo esc_html__("sec", "steelthemes-nest");
                                            ?></span>
                                        <?php else: ?>
                                        <span>
                                            <?php
                                            echo esc_attr($current_time_limit);
                                            echo esc_html__(" sec", "steelthemes-nest");
                                            ?>
                                            <small>
                                                <?php echo esc_html(
                                                    "looks good",
                                                    "steelthemes-nest"
                                                ); ?>
                                            </small>
                                        </span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                                <?php if ($current_time_limit < 1000): ?>
                                <em><?php echo esc_html(
                                    "Your PHP time limit is too low. Please set it to at least 600 seconds to import demo content",
                                    "steelthemes-nest"
                                ); ?>
                                </em>
                                <?php endif; ?>
                            </div>

                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "PHP Max Input Vars",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php
                                        $max_input_vars = ini_get(
                                            "max_input_vars"
                                        );
                                        $menu_items = get_nav_menu_locations();
                                        $menu_items_count = count($menu_items);
                                        $required_input_vars = ceil(
                                            ($menu_items_count * 4) / 1024
                                        );
                                        $buffer = 500; // adjust this as needed
                                        $required_input_vars += $buffer;
                                        $required_input_vars_formatted = number_format(
                                            $required_input_vars
                                        );
                                        $current_input_vars_formatted = number_format(
                                            $max_input_vars
                                        );
                                        ?>
                                        <span><?php echo esc_attr(
                                            $current_input_vars_formatted
                                        ); ?> </span> <small>
                                            <?php echo esc_html(
                                                "looks good",
                                                "steelthemes-nest"
                                            ); ?>
                                        </small>

                                    </li>
                                </ul>
                                <?php if (
                                    $max_input_vars < $required_input_vars
                                ): ?>
                                <em><strong><?php echo esc_html(
                                    "Note:",
                                    "steelthemes-nest"
                                ); ?></strong>
                                    <?php echo esc_html(
                                        "Your current PHP Max Input Vars setting is too low. Please increase it to at least",
                                        "steelthemes-nest"
                                    ); ?>
                                    <?php
                                    echo esc_attr(
                                        $required_input_vars_formatted
                                    );
                                    echo esc_html(
                                        " to avoid issues with your menu items.",
                                        "steelthemes-nest"
                                    );
                                    ?></em>
                                <?php endif; ?>
                            </div>

                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "ZipArchive",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php if (
                                            class_exists("ZipArchive")
                                        ): ?>
                                        <span><?php echo esc_html(
                                            "Yes",
                                            "steelthemes-nest"
                                        ); ?></span>
                                        <?php else: ?>
                                        <?php echo esc_html("No", "steelthemes-nest"); ?>
                                        <?php endif; ?>

                                    </li>
                                </ul>
                                <?php if (!class_exists("ZipArchive")): ?>
                                <em><?php echo esc_html(
                                    "ZipArchive class is not available on your server.",
                                    "steelthemes-nest"
                                ); ?></em>
                                <?php endif; ?>
                            </div>

                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "GD Library",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php if (
                                            extension_loaded("gd") &&
                                            function_exists("gd_info")
                                        ): ?>
                                        <span><?php
                                        $gdinfo = gd_info();
                                        echo esc_html($gdinfo["GD Version"]);
                                        ?></span>
                                        <?php else: ?>
                                        <span><?php echo esc_html__(
                                            "Not Installed",
                                            "steelthemes-nest"
                                        ); ?></span>
                                        <?php endif; ?>
                                    </li>
                                </ul>
                            </div>

                            <div class="inform">
                                <ul>
                                    <li class="heads">
                                        <?php echo esc_html(
                                            "cURL",
                                            "steelthemes-nest"
                                        ); ?>
                                    </li>
                                    <li>
                                        =>
                                    </li>
                                    <li>
                                        <?php if (
                                            function_exists("curl_version")
                                        ): ?>
                                        <span><?php
                                        $curl_version = curl_version();
                                        echo esc_html($curl_version["version"]);
                                        ?></span>

                                        <?php else: ?>
                                        <span><?php echo esc_html(
                                            "Not Enabled",
                                            "steelthemes-nest"
                                        ); ?></span>
                                        <?php endif; ?>

                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="right_box">
                            <div class="d-flex">
                                <div class="documentation common_box">
                                    <div class="inner_docsuppo">
                                    <div>  <h6><?php echo esc_html__(
                                        "Our documentation is simple  , With details and covers all the essential features from the beginning to the most advanced.",
                                        "steelthemes-nest"
                                    ); ?>
                                     </h6>
                                            <a href="https://themepanthers.com/wp/nest/documentation/"
                                                target="_blank">
                                                <?php echo esc_html(
                                                    "Documentation",
                                                    "steelthemes-nest"
                                                ); ?>
                                            </a>   </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve"><path fill="#3f3eed" d="M100.3,191.9c-6.6,0-6.6-10,0-10h32.9c6.6,0,6.6,10,0,10H100.3z M100.3,221.9c-6.6,0-6.6-10,0-10H166c6.6,0,6.6,10,0,10  H100.3z M378.5,436.8l87.9-152.2H121.5L33.6,436.8H378.5z M30,423.2l84.1-145.6c0.8-1.7,2.5-2.9,4.5-2.9h257.8v-72.8H206.4  l-23.9,54.9c-0.8,1.9-2.7,3-4.6,3v0H30V423.2z M386.4,274.6H475l0,0c3.8,0,6.2,4.1,4.3,7.5l-93.4,161.8c-1,1.4-1.6,2.7-4.5,2.9H25  c-2.7,0-5-2.2-5-5V254.7c0-2.7,2.2-5,5-5h34.5V138.6c0-1.4,0.6-2.6,1.5-3.5l47.6-47.7c1.1-1.1,2.6-1.6,4-1.4c9,0,17.9,0,26.9,0V58.2  c0-2.8,2.2-5,5-5h189.7c2.7,0,5,2.2,5,5v133.6h42.2c2.8,0,5,2.2,5,5V274.6z M69.5,249.7h105.2l23.8-54.5c0.7-2,2.6-3.4,4.7-3.4h84.7  V95.6l-170.7,0.3v42.7c0,2.7-2.2,5-5,5H69.5V249.7z M297.9,191.8h31.3V63.2H149.5v22.7l143.4-0.3c2.8,0,5,2.2,5,5l0,0V191.8z   M138,132c-6.6,0-6.6-10,0-10h64c6.6,0,6.6,10,0,10H138z M138,162c-6.6,0-6.6-10,0-10h66.6c6.6,0,6.6,10,0,10H138z M76.6,133.6  l30.6,0v-30.5L76.6,133.6z"/>
                                          </svg>
                                    </div>

                                </div>
                                <div class="support common_box">
                                    <div class="inner_docsuppo">
                                        <div><h6> <?php echo esc_html__(
                                            "Nest theme comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via ThemeForest.",
                                            "steelthemes-nest"
                                        ); ?>
                                          
                                            </h6>
                                            <a href="https://steelthemes.ticksy.com/submit/#100019994" target="_blank">
                                                <?php echo esc_html(
                                                    "Support",
                                                    "steelthemes-nest"
                                                ); ?>
                                            </a></div>
                                     
                                       <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 2" viewBox="0 0 100 125" x="0px" y="0px" style="bottom: -23px; right: -5px;"> 
                                        <path  fill="#3f3eed" d="M18.75,94.75h62.5a1,1,0,0,0,1-1V79.23A30.26,30.26,0,0,0,52,49H48A30.26,30.26,0,0,0,17.75,79.23V93.75A1,1,0,0,0,18.75,94.75Zm52-2H29l-3.12-23h48ZM47.8,60.38h4.4l.64,7.37H47.16ZM80.25,79.23V92.75H72.76L76,68.88a1,1,0,0,0-.24-.79,1,1,0,0,0-.75-.34H54.85l-.69-8,1.62-1.62,2.68,6a1,1,0,0,0,.85.59h.07a1,1,0,0,0,.85-.48L66,54.71A28.24,28.24,0,0,1,80.25,79.23Zm-16-25.46-4.7,7.82L54.84,51.14A27.92,27.92,0,0,1,64.21,53.77ZM52,51h.57l2.31,5.17-2.19,2.2H47.29l-2.19-2.2L47.41,51H52Zm-6.86.14L40.49,61.59l-4.7-7.82A27.92,27.92,0,0,1,45.16,51.14ZM19.75,79.23A28.24,28.24,0,0,1,34,54.71l5.75,9.56a1,1,0,0,0,.86.48h.06a1,1,0,0,0,.85-.59l2.68-6,1.62,1.62-.69,8H24.73a1,1,0,0,0-.75.34,1,1,0,0,0-.24.79L27,92.75H19.75Z"/><path fill="#3f3eed" d="M28.13,35.38h3.12a1,1,0,0,0,1-1V20.75a13.52,13.52,0,0,1,13.5-13.5h8.5a13.52,13.52,0,0,1,13.5,13.5V37.5H63.38A15.92,15.92,0,0,0,66,28.75V20.33a12,12,0,0,0-12-11.95H46A12,12,0,0,0,34,20.33v8.42A16,16,0,0,0,61.82,39.5h6.93a1,1,0,0,0,1-1V35.38h2.12A4.14,4.14,0,0,0,76,31.25V25a4.13,4.13,0,0,0-4.13-4.12H69.75v-.13a15.51,15.51,0,0,0-15.5-15.5h-8.5a15.51,15.51,0,0,0-15.5,15.5v.13H28.13A4.13,4.13,0,0,0,24,25v6.25A4.14,4.14,0,0,0,28.13,35.38ZM36,20.33a10,10,0,0,1,10-9.95h8.1a10,10,0,0,1,10,9.95v3.85h0c-1,0-3.32-2-5-4a1,1,0,0,0-1.08-.3C53.3,21.45,40.77,25,36,23.85ZM50,42.75a14,14,0,0,1-14-14V25.9C42,27,54.63,23.08,57.93,22c1.28,1.42,4,4.16,6.07,4.17v2.57a13.92,13.92,0,0,1-3.09,8.75H54.5v2H59A13.89,13.89,0,0,1,50,42.75ZM71.87,22.88A2.12,2.12,0,0,1,74,25v6.25a2.13,2.13,0,0,1-2.13,2.13H69.75V22.88ZM26,25a2.12,2.12,0,0,1,2.13-2.12h2.12v10.5H28.13A2.13,2.13,0,0,1,26,31.25Z"/><path fill="#3f3eed" d="M50,75a6.21,6.21,0,1,0,6.21,6.21A6.22,6.22,0,0,0,50,75Zm0,10.42a4.21,4.21,0,1,1,4.21-4.21A4.22,4.22,0,0,1,50,85.46Z"/>
 </svg>
                                    </div>
                                </div>
                                </div>
                                <div class="d-flex">
                                <div class="video common_box">
                                    <div class="inner_docsuppo">
                                    <div>   <h6> <?php echo esc_html__(
                                        "Here is the Video Tutorials to install theme , pluign , import demo content and Get Start with it.",
                                        "steelthemes-nest"
                                    ); ?>
                                    </h6>  
                                            <a href="https://www.youtube.com/watch?v=iLh1EA0WrKU&list=PL0r7c9VEks_sRdFJ8oitH3qYhU1AZ_qH5" target="_blank">
                                                <?php echo esc_html(
                                                    "Video Tutorials",
                                                    "steelthemes-nest"
                                                ); ?>
                                            </a>
                                            </div>
                                    
                                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 100" x="0px" y="0px" style="bottom: -16px;">  
                                            <path data-name="Compound Path" fill="#3f3eed" d="M87.1,72.5h.4l.5-.2a1,1,0,0,0,.5-.8V40.5a1,1,0,0,0-1.4-.9l-17,7.9V44.8a9,9,0,0,0-9-9H55.8l-5.4-8.1a9,9,0,0,0-7.5-4H28.2a7,7,0,0,0-7,7v5.1h-.7a9,9,0,0,0-9,9V67.3a9,9,0,0,0,9,9H61.1a9,9,0,0,0,9-9V64.6Zm-.6-30.4V70L70.1,62.4V49.7ZM23.2,30.7a5,5,0,0,1,5-5H42.9a7,7,0,0,1,5.8,3.1l4.7,7H23.2Zm45,36.7a7,7,0,0,1-7,7H20.4a7,7,0,0,1-7-7V44.8a7,7,0,0,1,7-7H61.1a7,7,0,0,1,7,7Z"></path> 
                                        </svg>
                                    </div>
                                </div>
                            </div>

                         

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
