<?php
/*
 ** ==============================
 ** Dashboard
 ** ==============================
 */
class Theme_Admin_Panel{
 
    public function __construct()
    {
        add_action("admin_menu", [$this, "add_admin_menu"]);
        add_action("admin_init", [$this, "register_settings"]);
        add_action( 'admin_notices', [$this,'display_admin_notice']); 
        add_action( 'admin_notices', [$this,'display_admin_notice_two']);
        add_action('template_redirect', [$this , 'check_maintenance_mode']);
        add_action(
            "admin_notices",
            [$this, "display_header_admin_notice"],
            110
        );
        // Add styles and scripts for the admin panel
        add_action("admin_enqueue_scripts", [$this, "nest_admin_scripts"]);  
    }
    
    public function add_admin_menu()
    {
        // Add a top-level menu item with a specific position
        add_menu_page(
            "Nest", // Page title
            "Nest", // Menu title
            "manage_options", // Capability required to access the menu item
            "nest", // Menu slug
            [$this, "render_page"], // Callback function to render the page
            "dashicons-admin-settings", // Icon for the menu item
            2
        );
        // Add subpages
        add_submenu_page(
            "nest",
            "Welcome",
            "Welcome",
            "manage_options",
            "nest",
            [$this, "render_page"],
            0
        ); 
        add_submenu_page(
            "nest",
            "More Themes",
            "More Themes",
            "manage_options",
            "nest-more-themes",
            [$this, "render_our_theme"],
            129
        ); 
    }
    public function enqueue_admin_scripts()
    {
        $screen = get_current_screen();
        if (
            $screen->id === "toplevel_page_nest" ||
            $screen->id === "theme_page_theme-system-status" ||
            $screen->id === "theme_page_theme-options" ||
            $screen->id === "theme_page_theme-plugins"
        ) {
            // Enqueue your CSS and JS files here for styling and functionality of the admin panel
            wp_enqueue_style(
                "admin-panel-style",
                get_template_directory_uri() . "/admin-panel.css"
            );
            wp_enqueue_script(
                "admin-panel-script",
                get_template_directory_uri() . "/admin-panel.js",
                ["jquery"],
                "1.0",
                true
            );
        }
    }
    public function add_single_tabs($tab_activate)
    {
        $navtabs["main"] = [
            "title" => esc_html__("Welcome / Theme Activation", "steelthemes-nest"),
            "link" => "admin.php?page=nest",
        ];
        $navtabs["plugin"] = [
            "title" => esc_html__("Plugins", "steelthemes-nest"),
            "link" => "themes.php?page=install-required-plugins",
        ];
        if (class_exists("OCDI_Plugin")) {
            $navtabs["oneclick"] = [
                "title" => esc_html__("Import Demo Content", "steelthemes-nest"),
                "link" => "themes.php?page=one-click-demo-import",
            ];
        } 
        if (class_exists("Nest_elementor_extension")) {
            $navtabs["header"] = [
                "title" => esc_html__("Create Header", "steelthemes-nest"),
                "link" => "edit.php?post_type=header",
            ];
            $navtabs["footer"] = [
                "title" => esc_html__("Create Footer", "steelthemes-nest"),
                "link" => "edit.php?post_type=footer",
            ];
            $navtabs["megamenu"] = [
                "title" => esc_html__("Create Megamenu", "steelthemes-nest"),
                "link" => "edit.php?post_type=mega_menu",
            ];
            $navtabs["themeoptions"] = [
                "title" => esc_html__("Theme Options", "steelthemes-nest"),
                "link" => "admin.php?page=nest-theme-options",
            ];
        }
        $navtabs["ourthemes"] = [
            "title" => esc_html__("Our Themes", "steelthemes-nest"),
            "link" => "admin.php?page=nest-more-themes",
        ];
        ?>
            <div class="nav-tab-wrapper admin_dashboad">
            <?php foreach ($navtabs as $key => $tab) {
                    if ($tab_activate == $key){ ?>
                    <span class="nav-tab nav-tab-active"><?php echo sprintf(__("%s", "steelthemes-nest") , $tab["title"]); ?></span>
                   <?php }else{ ?>
                    <a href="<?php echo esc_url($tab["link"]); ?>" class="nav-tab"><?php echo sprintf(__("%s", "steelthemes-nest") , $tab["title"]); ?></a>
                    <?php
                    }
                } ?>

            </div>
		<?php
    }
    public function render_page()
    {
        $this->add_single_tabs("main"); 
        require_once get_template_directory() .
            "/includes/admin/dashboard/welcome/welcome.php";
    }
    public function render_our_theme()
    {
        $this->add_single_tabs("ourthemes");
        require_once get_template_directory() .
            "/includes/admin/dashboard/ourthemes/outthemes.php";
    }
    
    public function register_settings()
    {
        // Register any settings you need for your theme options
    }
    public function display_header_admin_notice()
    {
        $screen = get_current_screen(); 
     
        if (class_exists("Nest_elementor_extension")) {
            // Check if the current screen is the header post type edit screen
            if ($screen && $screen->post_type === "header") {
                $this->add_single_tabs("header");
            }
            // Check if the current screen is the footer post type edit screen
            if ($screen && $screen->post_type === "footer") {
                $this->add_single_tabs("footer");
            }
            // Check if the current screen is the mega_menu post type edit screen
            if ($screen && $screen->post_type === "mega_menu") {
                $this->add_single_tabs("megamenu");
            }
            // Check if the current screen is the theme otpion post type edit screen
            if (
                isset($_GET["page"]) &&
                $_GET["page"] === "nest-theme-options"
            ) {
                $this->add_single_tabs("themeoptions");
            }
        }
        
        if ( $screen->id === 'appearance_page_install-required-plugins' ) {
            $this->add_single_tabs("plugin");
        }
        if (class_exists("OCDI_Plugin")) {
            // Check if the current screen is the one click post type edit screen
            if (
                isset($_GET["page"]) &&
                $_GET["page"] === "one-click-demo-import"
            ) {
                $this->add_single_tabs("oneclick");
            }
        }
    }
    public function check_maintenance_mode() {
        $enable_custom_feature = get_theme_mod('enable_custom_feature', false);
        if ( $enable_custom_feature == true && !current_user_can('manage_options')) {
            include(locate_template('/includes/admin/dashboard/maintenance-mode.php'));
            exit();
        }
    }

    public function nest_admin_scripts()
    {
        wp_enqueue_style(
            "nest-admin-style",
            get_template_directory_uri() .
                "/includes/admin/dashboard/assets/theme.css",
            [],
            "1.0.0",
            "all"
        );
        wp_enqueue_script(
            "nest-admin",
            get_template_directory_uri() .
                "/includes/admin/dashboard/assets/admin.js",
            ["jquery"],
            "1.0",
            true
        );
        if (defined('WP_DEBUG') && WP_DEBUG) {
            wp_enqueue_script('nest-debug',  get_template_directory_uri() . '/includes/admin/dashboard/assets/debug.js', array( 'jquery' ), '1.0', true );
        }
    }
    public function display_admin_notice_two(){
        if (defined('WP_DEBUG') && WP_DEBUG) { 
            
            ?>
            <div class="admin-notice admin-notice-debug_enabled notice notice-info is-dismissible">
                <h2><?php echo esc_html('Warning Disable WP_DEBUG_DISPLAY' , 'steelthemes-nest'); ?></h2>
                    <p><?php echo esc_html('Debug mode is often enabled to gather more details about an error or site failure, but may contain sensitive information which 
                    should not be available on a publicly available website.' , 'steelthemes-nest'); ?></p>
                    <p><?php echo esc_html('The value, WP_DEBUG_DISPLAY, has either been enabled by WP_DEBUG or added to your configuration file. This will
                    make errors display on the front end of your site.' , 'steelthemes-nest'); ?></p>
                </div> 
            <?php
            
           
        }
    }
    public function display_admin_notice() {
        global $nest_theme_mod;
        $admin_notice_enable = isset( $nest_theme_mod['admin_notice_enable'] ) ? $nest_theme_mod['admin_notice_enable'] : ''; 
        $admin_dashboard_url = admin_url('admin.php?page=nest'); 
        ?>
       <div class="admin-notice admin-notice-nests notice notice-info is-dismissible <?php if($admin_notice_enable == false): ?> disable_copt_notice <?php  endif; ?>">
        <ul> 
            <li><?php echo esc_html('Before Import Demo Content Check the server configuration here' , 'steelthemes-nest'); ?> <a target="_blank" href="<?php echo esc_url($admin_dashboard_url);?>"><?php echo esc_html('Click here...' , 'steelthemes-nest'); ?></a></li>
            <li><?php echo esc_html('We are here to help you.For any issues please submit your ticket here' , 'steelthemes-nest'); ?> <a target="_blank" href="https://steelthemes.ticksy.com/submit/#100019994"><?php echo esc_html('Get Support' , 'steelthemes-nest'); ?></a></li>
            <li><?php echo esc_html('Looking for Nest Documentation' , 'steelthemes-nest'); ?> <a target="_blank" href="https://themepanthers.com/wp/nest/documentation"><?php echo esc_html('Click here' , 'steelthemes-nest'); ?></a></li>
             
        </ul>
        <p><?php echo esc_html('Disable this notification totally go to Nest -> theme option ->  general settings ->  Disable Admin Notice => Switch Off' , 'steelthemes-nest'); ?></p>
        </div> 
       <?php
    }
 
    
  

}

// Create an instance of the admin panel class
new Theme_Admin_Panel();
