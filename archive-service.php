<?php
     get_header();
     $options = get_design_plus_option();
     $catch = $options['service_catch'];
     $desc = $options['service_desc'];
     $catch_mobile = $options['service_catch_mobile'];
     $desc_mobile = $options['service_desc_mobile'];
     $image_id = $options['service_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['service_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     }
     $use_overlay = $options['service_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['service_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['service_overlay_opacity'];
     }
?>
<?php if(!empty($image_id)) { ?>
<div id="page_header" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;">
<?php } else { ?>
<div id="page_header" style="background:<?php echo esc_attr($options['service_bg_color']); ?>;">
<?php }; ?>
 <div id="page_header_inner">
  <div id="page_header_catch">
   <?php if($catch){ ?><div class="catch rich_font<?php if($catch_mobile) { echo ' has_mobile_word'; }; ?>"<?php if($catch_mobile) { echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"'; }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></div><?php }; ?>
   <?php if($desc){ ?><p class="desc<?php if($desc_mobile) { echo ' has_mobile_word'; }; ?>"<?php if($desc_mobile) { echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"'; }; ?>><span><?php echo nl2br(esc_html($desc)); ?></span></p><?php }; ?>
  </div>
 </div>
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="archive_service">

 <?php
       $service_category = get_terms( 'service_category', array( 'hide_empty' => true, 'orderby' => 'id', 'parent' => 0 ) );
       if ( $service_category && ! is_wp_error( $service_category ) ) :
         foreach ( $service_category as $cat ):
           $cat_id = $cat->term_id;
           $custom_fields = get_option( 'taxonomy_' . $cat_id, array() );
           if (!empty($custom_fields['image_position'])){
             $image_position = $custom_fields['image_position'];
           } else {
             $image_position = 'type1';
           }
           if (!empty($custom_fields['bg_color'])){
             $bg_color = $custom_fields['bg_color'];
           } else {
             $bg_color = '#f4f4f5';
           }
           if (!empty($custom_fields['image'])){
             $image = wp_get_attachment_image_src( $custom_fields['image'], 'full' );
           }
 ?>
 <article class="item clearfix cat_id<?php echo esc_html($cat_id); ?> <?php echo esc_attr($image_position); ?>">

  <?php if( !empty($custom_fields['image']) && ($image_position == 'type1') ){ ?>
  <div class="top_area clearfix" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat right center; background-size:cover;">
  <?php } else { ?>
  <div class="top_area clearfix" style="background:<?php echo esc_attr($bg_color); ?>;">
  <?php }; ?>
   <h2 class="title rich_font" style="color:<?php echo esc_attr($options['archive_service_title_color']); ?>;"><?php echo esc_html($cat->name); if (!empty($custom_fields['sub_title'])){ ?><span><?php echo esc_html($custom_fields['sub_title']); ?></span><?php }; ?></h2>
   <?php if (!empty($custom_fields['catch'])){ ?>
   <p class="catch rich_font"><?php echo wp_kses_post(nl2br($custom_fields['catch'])); ?></p>
   <?php }; ?>
   <?php if( !empty($custom_fields['image']) && ($image_position == 'type2') ){ ?>
   <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php }; ?>
  </div><!-- END .top_area -->

  <?php if (!empty($custom_fields['catch'])){ ?>
  <p class="mobile_catch rich_font"><?php echo esc_html($custom_fields['catch']); ?></p>
  <?php }; ?>
  <div class="bottom_area clearfix">
   <?php
        // post list --------------------
        $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
        $service_list = new wp_query($args);
        if($service_list->have_posts()):
   ?>
   <div class="sub_category clearfix">
    <ul class="clearfix">
     <?php while( $service_list->have_posts() ) : $service_list->the_post(); ?>
     <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
     <?php endwhile; ?>
    </ul>
   </div>
   <?php endif; // END post list ?>
   <?php if (!empty($custom_fields['desc'])){ ?>
   <p class="desc<?php if($service_list->have_posts()){ } else { echo ' no_sub_category'; }; ?>"><?php echo wp_kses_post(nl2br($custom_fields['desc'])); ?></p>
   <?php }; ?>
   <?php if (!empty($custom_fields['button_label'])){ ?>
   <div class="link_button">
    <a href="<?php echo esc_url(get_term_link($cat,'service_category')); ?>"><?php echo esc_html($custom_fields['button_label']); ?></a>
   </div>
   <?php }; ?>
  </div><!-- END .bottom_area -->

 </article>
 <?php
        endforeach;
      endif; // has term
 ?>

</div><!-- END #archive_service -->

<?php get_footer(); ?>