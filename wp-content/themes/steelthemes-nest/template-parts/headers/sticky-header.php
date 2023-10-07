<?php
/*
** ============================== 
**   Nest Ecommerce Header File
** ==============================
*/

if(is_page_template( 'template-empty.php' )):
    return false;
endif;
?> 
<div class="sticky_header_area sticky_header_content">
    <?php do_action('nest_sticky_header'); ?>
</div> 