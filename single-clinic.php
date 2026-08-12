<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['clinic_label'];
     $image_id = $options['clinic_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['clinic_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     } else {
       $background_color = $options['clinic_bg_color'];
     }
     $use_overlay = $options['clinic_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['clinic_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['clinic_overlay_opacity'];
     }
?>
<?php if(!empty($image_id)) { ?>
<div id="page_header" class="small" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;">
<?php } else { ?>
<div id="page_header" class="small" style="background:<?php echo $background_color; ?>;">
<?php }; ?>
 <div id="page_header_inner">
  <div id="page_header_catch">
   <?php if($title){ ?><h2 class="title rich_font"><?php echo wp_kses_post(nl2br($title)); ?></h2><?php }; ?>
  </div>
 </div>
 <?php if($image_id && $use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents" class="clearfix">

 <div id="main_col" class="fullwidth clearfix">

 <div id="single_clinic">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $catch = get_post_meta($post->ID, 'clinic_catch', true);
        $desc = get_post_meta($post->ID, 'clinic_desc', true);
        $catch_mobile = get_post_meta($post->ID, 'clinic_catch_mobile', true);
        $catch_font_color = get_post_meta($post->ID, 'clinic_catch_font_color', true);
        $clinic_layout_type = get_post_meta($post->ID, 'clinic_layout_type', true);
 ?>

 <article id="article">

  <?php
       // header image ------------------------------------------------------------------------------------------------------------------------
       if($options['single_show_clinic_img'] && has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
  ?>
  <div class="cf_header_image" id="clinic_header_image">
   <div class="title_area frost_bg">
    <h1 class="title rich_font" style="color:<?php echo esc_attr($options['single_clinic_title_font_color']); ?>;"><span><?php the_title(); ?></span></h1>
    <div class="blur_image">
     <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>">
    </div>
   </div>
   <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
  </div>
  <?php }else{; ?>
  <div class="cf_header_no_image" id="clinic_header_image">
    <h1 class="title rich_font" style="color:<?php echo esc_attr($options['single_staff_title_font_color']); ?>;"><span><?php the_title(); ?></span></h1>
  </div>
  <?php }; ?>

  <?php
       // Catch and description ------------------------------------------------------------------------------------------------------------------
       if($catch || $desc){
  ?>
  <div class="cf_catch cf_catch1">
   <?php if($catch){ ?><h3 class="catch rich_font<?php if($catch_mobile) { echo ' has_mobile_word'; }; ?>" style="color:<?php echo esc_attr($catch_font_color); ?>;"<?php if($catch_mobile) { echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"'; }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h3><?php }; ?>
   <?php if($desc) { ?>
   <div class="post_content clearfix">
    <?php echo do_shortcode( wpautop(wp_kses_post($desc)) ); ?>
   </div>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       if($clinic_layout_type == 'type1'){
         get_template_part('single-clinic-type1');
       } elseif($clinic_layout_type == 'type2'){
         get_template_part('single-clinic-type2');
       } elseif($clinic_layout_type == 'type3'){
         get_template_part('single-clinic-type3');
       } elseif($clinic_layout_type == 'type4'){
         get_template_part('single-clinic-type4');
       }
   ?>

 </article><!-- END #article -->

 <?php endwhile; endif; ?>

 </div><!-- END #single_clinic -->

 </div><!-- END #main_col -->

 <?php //サイドバー非表示 get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>