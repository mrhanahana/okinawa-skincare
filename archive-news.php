<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['news_label'];
     $image_id = $options['news_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['news_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     } else {
       $background_color = $options['news_bg_color'];
     }
     $use_overlay = $options['news_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['news_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['news_overlay_opacity'];
     }
?>
<?php if(!empty($image_id)) { ?>
<div id="page_header" class="small" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;">
<?php } else { ?>
<div id="page_header" class="small" style="background:<?php echo $background_color; ?>;">
<?php }; ?>
 <div id="page_header_inner">
  <div id="page_header_catch">
   <?php if($title){ ?><h1 class="title rich_font"><?php echo wp_kses_post(nl2br($title)); ?></h1><?php }; ?>
  </div>
 </div>
 <?php if($image_id && $use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents" class="clearfix">

 <div id="main_col" class="fullwidth clearfix">

  <?php if ( have_posts() ) : ?>
  <div id="news_archive" class="main_color clearfix">
    <?php
         while ( have_posts() ) : the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
          } elseif($options['no_image2']) {
            $image = wp_get_attachment_image_src( $options['no_image2'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
    ?>
    <article class="item <?php if( !has_post_thumbnail() && $options['news_no_image'] == 'hide' ) { echo 'no_image'; }; ?>">
     <a class="animate_background" href="<?php the_permalink() ?>">
      <?php if(has_post_thumbnail()) { ?>
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <?php } elseif($options['news_no_image'] != 'hide') { ?>
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <?php }; ?>
      <div class="title_area">
       <div class="title_area_inner">
        <?php if ( $options['show_news_list_date'] ){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p><?php }; ?>
        <h2 class="title rich_font"><span><?php trim_title(40); ?></span></h2>
       </div>
      </div>
     </a>
    </article>
    <?php endwhile; ?>
  </div><!-- #news_archive -->
  <?php get_template_part('template-parts/navigation'); ?>
  <?php else: ?>
  <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>
  <?php endif; ?>

 </div><!-- END #main_col -->

 <?php // get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>