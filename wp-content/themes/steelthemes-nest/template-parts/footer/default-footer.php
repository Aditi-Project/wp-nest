<?php
/*
** ============================== 
**   Nest Ecommerce footer File
** ==============================
*/
if(is_page_template( 'template-empty.php' ) || is_singular('header')  || is_singular('footer')  || is_singular('sticky_header') || is_singular('mega_menu') ||  is_404()):
  return false;
endif;
global $nest_theme_mod;
$footer_custom_enables = '';
if(!empty($nest_theme_mod['footer_custom_enables'])):
  $footer_custom_enables = $nest_theme_mod['footer_custom_enables'];
endif;

function  nest_default_footer(){
?>
<footer class="footer before_plugin_installation_footer footer_default  footer-bottom text-center">
  <div class="auto-container">
    <div class="row">
        <div class="col-lg-12">
          <div class="copyright">
            <?php echo esc_html__('© 2023 Steelthemes. All Right Reseved' , 'steelthemes-nest'); ?>
          </div>
        </div>
      </div>
    </div>
  </footer>
<?php } 
 if($footer_custom_enables == true): ?>
  <div class="footer_area" id="footer_contents">
    <?php do_action('nest_footer'); ?>
  </div>
<?php  else:  
    nest_default_footer();
endif; ?>
 
    