<?php
/*
**=======================================
** Nest Ecommerce Default Blog Content
**=======================================
*/
$featured_img_url = get_the_post_thumbnail_url($post->ID, 'full'); 
$myexcerpt = wp_trim_words(get_the_excerpt());  
$mycontent = wp_trim_words(get_the_content());  
?>
<div <?php post_class('col-xl-12'); ?>>
  <article class="news_box first-post default_blog_style mb-30 hover-up animated" id="post-<?php esc_attr(the_ID()); ?>">
    <div class="entry-content">
      <?php the_title( '<h2 class="post-title mb-20"><a href="' .  esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>' ); ?>
      <div class="entry-meta meta-2 align-items-center">
        <div class="entry-meta meta-1">
          <div class="font-sm">
            <span class="post-on mr-10"><?php nest_blog_time(); ?></span>
            <span class="hit-count has-dot mr-10"><?php  nest_comments(); ?></span>
            <?php if(!empty(nest_blog_category())): ?> <span
              class="hit-count has-dot"><?php nest_blog_category(); ?></span> <?php endif; ?>
          </div>
        </div>
      </div>
      </div>
  </article>
</div>
 