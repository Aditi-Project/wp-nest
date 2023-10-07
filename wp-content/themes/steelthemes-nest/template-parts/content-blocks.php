<?php
/*
**================================================================
**  Nest Single Page Content For Header , Footer , Mega Menu
**================================================================
*/
?>
<section id="post-<?php esc_attr(the_ID()); ?>">
      <?php the_content(); ?>
</section>