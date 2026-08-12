<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['service_label'];
     $image_id = $options['service_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['service_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     } else {
       $background_color = $options['service_bg_color'];
     }
     $use_overlay = $options['service_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['service_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['service_overlay_opacity'];
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

  <div id="archive_service">

   <?php
        $query_obj = get_queried_object();
        $parent_id = $query_obj->parent;
        if($parent_id != 0){ // if is child category
          $cat_id = $parent_id;
          $category_data = get_term_by( 'id', $cat_id, 'service_category' );
          $parent_category_name = $category_data->name;
        } else {
          $cat_id = $query_obj->term_id;
          $parent_category_name = single_cat_title('', false);
        }
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
   <article class="item clearfix <?php echo esc_attr($image_position); ?>">
    <?php if( !empty($custom_fields['image']) && ($image_position == 'type1') ){ ?>
    <div class="top_area clearfix" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat right center; background-size:cover;">
    <?php } else { ?>
    <div class="top_area clearfix" style="background:<?php echo esc_attr($bg_color); ?>;">
    <?php }; ?>
     <div class="title rich_font" style="color:<?php echo esc_attr($options['archive_service_title_color']); ?>;"><?php echo esc_html($parent_category_name); if (!empty($custom_fields['sub_title'])){ ?><span><?php echo esc_html($custom_fields['sub_title']); ?></span><?php }; ?></div>
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
    <?php if (!empty($custom_fields['desc'])){ ?>
    <p class="category_desc"><?php echo wp_kses_post(nl2br($custom_fields['desc'])); ?></p>
    <?php }; ?>
   </article>

   <?php
        if($parent_id != 0){ // if is child category -------------------------------------
          $cat_id = $query_obj->term_id;
          $custom_fields = get_option( 'taxonomy_' . $cat_id, array() );
   ?>
   <div class="archive_service_child">
    <h2 class="headline"><?php echo esc_html(single_cat_title('', false)); ?></h2>
    <?php if (!empty($custom_fields['desc'])){ ?>
    <p class="category_desc"><?php echo wp_kses_post(nl2br($custom_fields['desc'])); ?></p>
    <?php }; ?>
    <?php
         $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
         $service_list = new wp_query($args);
         if($service_list->have_posts()):
    ?>
    <ol class="service_post_list clearfix">
     <?php
          while( $service_list->have_posts() ) : $service_list->the_post();
            $service_desc = get_post_meta($post->ID, 'service_desc', true);
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
            } elseif($options['no_image3']) {
              $image = wp_get_attachment_image_src( $options['no_image3'], 'full' );
            } else {
              $image = array();
              $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image3.gif";
            }
     ?>
     <li>
      <a class="link animate_background" href="<?php the_permalink(); ?>">
       <div class="image_wrap">
        <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
       </div>
       <div class="title_area">
        <h3 class="title rich_font"><span><?php the_title(); ?></span></h3>
       </div>
      </a>
     </li>
     <?php endwhile; wp_reset_query(); ?>
    </ol>
    <?php endif; // END end post list ?>
   </div><!-- END .archive_service_child -->

   <?php } else { // if parent category page ----------------------------------- ?>

   <?php
        $child_category = get_terms( 'service_category' , array( 'hide_empty' => true, 'orderby' => 'id' , 'parent' => $cat_id) );
        if ( $child_category && ! is_wp_error( $child_category ) ) :
         foreach ( $child_category as $cat ):
           $child_cat_id = $cat->term_id;
           $custom_fields = get_option( 'taxonomy_' . $child_cat_id, array() );
   ?>
   <div class="archive_service_child">
    <h3 class="headline"><?php echo esc_html( $cat->name ); ?></h3>
    <?php if (!empty($custom_fields['desc'])){ ?>
    <p class="category_desc"><?php echo wp_kses_post(nl2br($custom_fields['desc'])); ?></p>
    <?php }; ?>
    <?php
         $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $child_cat_id ) ) );
         $service_list = new wp_query($args);
         if($service_list->have_posts()):
    ?>
    <ol class="service_post_list clearfix">
     <?php
          while( $service_list->have_posts() ) : $service_list->the_post();
            $service_desc = get_post_meta($post->ID, 'service_desc', true);
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
            } elseif($options['no_image3']) {
              $image = wp_get_attachment_image_src( $options['no_image3'], 'full' );
            } else {
              $image = array();
              $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image3.gif";
            }
     ?>
     <li>
      <a class="link animate_background" href="<?php the_permalink(); ?>">
       <div class="image_wrap">
        <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
       </div>
       <div class="title_area">
        <h4 class="title rich_font"><span><?php the_title(); ?></span></h4>
       </div>
      </a>
     </li>
     <?php endwhile; wp_reset_query(); ?>
    </ol>
    <?php endif; // END end post list ?>
   </div><!-- END .archive_service_child -->
   <?php endforeach; ?>
   <?php else: ?>
   <div class="archive_service_child">
    <?php
         $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
         $service_list = new wp_query($args);
         if($service_list->have_posts()):
    ?>
    <ol class="service_post_list clearfix">
     <?php
          while( $service_list->have_posts() ) : $service_list->the_post();
            $service_desc = get_post_meta($post->ID, 'service_desc', true);
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
            } elseif($options['no_image3']) {
              $image = wp_get_attachment_image_src( $options['no_image3'], 'full' );
            } else {
              $image = array();
              $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image3.gif";
            }
     ?>
     <li>
      <a class="link animate_background" href="<?php the_permalink(); ?>">
       <div class="image_wrap">
        <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
       </div>
       <div class="title_area">
        <h4 class="title rich_font"><span><?php the_title(); ?></span></h4>
       </div>
      </a>
     </li>
     <?php endwhile; wp_reset_query(); ?>
    </ol>
    <?php endif; // END end post list ?>
   </div><!-- END .archive_service_child -->
   <?php endif; // END child menu ?>

   <?php }; // END parent category page ?>

  </div><!-- END #archive category -->

 </div><!-- END #main_col -->

 <?php // get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>