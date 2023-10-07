<?php
  class Launch{ 
    public function __construct() {   
      add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }
      
    /**
       * Include Files
       *
       * Load required plugin core files.
       *
       * @since 1.0.0
       *
       * @access public
    */ 
    public function register_widgets() {
  
      $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
      //header
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Header\Header_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Header\Custom_menu());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Header\Extra_header_items());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Header\Category_header());
      //slider
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Slider\Single_banner_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Slider\Slider_v1());
      //shop
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Category_carousel_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Category_grid_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Category_list_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Brand_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Product_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Product_carousel_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Product_tab_filter_carousel_v1()); 
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Product_tab_filter_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Product_deals_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Product_deals_v2());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Popup_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Shop_banner_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Shop\Deals_v1()); 
      //Content
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Text_editor_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Title_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Theme_btn_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Social_media_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\List_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Icon_box_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Image_grid_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Simple_image_box_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Blog_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Contact_box_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Contact_form_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Fun_facts_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Team_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Sidebar_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Testimonial_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Content\Subscribe_v1());
      //Footer
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Footer\About_contact_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Footer\Hot_line_v1());
      $widgets_manager->register(new  Nestaddons\Core\Widgets\Footer\Navigation_v1());
    }
}
 