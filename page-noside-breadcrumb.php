<?php
/*
Template Name:No side content breadcrumb
*/
__('No side content', 'tcd-w');
?>
<?php
     get_header();
     $options = get_design_plus_option();
     $page_title_color = get_post_meta($post->ID, 'page_title_color', true);
     $image_id = get_post_meta($post->ID, 'page_bg_image', true);
     if($image_id) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile_id = get_post_meta($post->ID, 'page_bg_image_mobile', true);
         if($image_mobile_id) {
           $image = wp_get_attachment_image_src($image_mobile_id, 'full');
         };
       }
     }
     $page_bg_color = get_post_meta($post->ID, 'page_bg_color', true);
     $use_overlay = get_post_meta($post->ID, 'page_use_overlay', true);
     if($use_overlay) {
       $page_overlay_color = get_post_meta($post->ID, 'page_overlay_color', true);
       if($page_overlay_color){
         $overlay_color = hex2rgb($page_overlay_color);
         $overlay_color = implode(",",$overlay_color);
         $overlay_opacity = get_post_meta($post->ID, 'page_overlay_opacity', true);
       };
     }
     if($image_id){
?>
<div id="page_header" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;">
<?php } else { ?>
<div id="page_header" style="background:<?php echo esc_attr($page_bg_color); ?>">
<?php }; ?>
 <div id="page_header_inner">
  <div id="page_header_catch">
   <h1 class="catch rich_font" style="color:<?php echo esc_html($page_title_color); ?>;"><?php the_title(); ?></h1>
  </div>
 </div>
 <?php if($use_overlay && $page_overlay_color && $overlay_opacity) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="one_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="article" class="clearfix">

  <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
  <div class="post_content clearfix">
   <?php
        echo get_the_content();
        if ( ! post_password_required() ) {
          $pagenation_type = $options['pagenation_type'];
          if ( $pagenation_type == 'type2' ) {
            if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
   ?>
   <div id="p_readmore">
    <a class="button" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
    <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
   </div>
   <?php
            endif;
          } else {
            custom_wp_link_pages();
          }
        }
   ?>
  </div>

  <?php endwhile; endif; ?>

  </article><!-- END #article -->

 </div><!-- END #one_col -->

<?php get_footer(); ?>