<?php
     $options = get_design_plus_option();
?>
<div id="side_col">
<?php
     // Clinic ---------------------------------------
     if(is_singular('clinic')) {
       if($options['show_side_clinic']){
         global $post;
         $current_post_id = $post->ID;
?>
<div class="side_category_list <?php echo esc_html($options['side_clinic_color_type']); ?>" id="side_clinic_list">
 <h3 class="headline rich_font"><?php echo esc_html($options['clinic_label']); ?><?php if($options['side_clinic_sub_title']){ ?><span><?php echo esc_html($options['side_clinic_sub_title']); ?></span><?php }; ?></h3>
 <?php
      $clinic_query = new WP_Query('post_type=clinic&posts_per_page=-1');
      if ($clinic_query->have_posts()) :
 ?>
 <ul>
  <?php
       while($clinic_query->have_posts()): $clinic_query->the_post();
         $post_id = $post->ID;
  ?>
  <li<?php if($current_post_id == $post_id){ echo ' class="active"'; }; ?>><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
  <?php endwhile; ?>
 </ul>
 <?php endif; ?>
</div>
<?php
       }
     // Service ---------------------------------------
     } elseif(is_singular('service') || is_tax('service_category')) {
       if(is_tax('service_category')){
         $current_post_id = '';
         $query_obj = get_queried_object();
         $parent_id = $query_obj->parent;
         if($parent_id != 0){ // if is child category
           $current_page_id = $parent_id;
         } else {
           $current_page_id = $query_obj->term_id;
         }
       } else { // if single page
         $current_page_id = '';
         $current_post_id = $post->ID;
         $service_cats = get_the_terms( $post->ID, 'service_category' );
         if ($service_cats) {
           foreach ( $service_cats as $cat ) {
             $current_page_id = $cat->term_id;
           }
           $category_data = get_term_by( 'id', $current_page_id, 'service_category' );
           $parent_id = $category_data->parent;
           if($parent_id != 0){ // if is child category
             $current_page_id = $parent_id;
           }
         };
       }
       // side category list -----------
       if($options['show_side_service']){
         $current_category_data = get_term_by( 'id', $current_page_id, 'service_category' );
         if($current_category_data){
           $current_category_name = $current_category_data->name;
           $custom_fields = get_option( 'taxonomy_' . $current_page_id, array() );
?>
<div class="side_category_list <?php echo esc_html($options['side_service_category_color_type']); ?>" id="side_service_category_list">
 <h3 class="headline rich_font"><?php echo esc_html($current_category_name); ?><?php if (!empty($custom_fields['sub_title'])){ ?>
 <!-- サブタイトルを非表示に -->
 <!--<span><?php echo esc_html($custom_fields['sub_title']); ?></span><?php }; ?>-->
 </h3>
 <ul>
  <?php
       $child_category = get_terms( 'service_category' , array( 'hide_empty' => true, 'orderby' => 'id' , 'parent' => $current_page_id) );
       if ( $child_category && ! is_wp_error( $child_category ) ) :
         foreach ( $child_category as $cat ):
           $cat_id = $cat->term_id;
           $active = '';
           if(is_tax('service_category')){
             if($parent_id != 0){ // if is child category
               $current_page_id = $query_obj->term_id;
             }
           }
           if($current_page_id == $cat_id) {
             $active = ' active';
           }
  ?>
  <li class="child_menu<?php echo $active; ?>"><a href="<?php echo esc_url(get_term_link($cat,'service_category')); ?>"><?php echo esc_html( $cat->name ); ?></a>
   <?php
         $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
         $service_list = new wp_query($args);
         if($service_list->have_posts()):
   ?>
   <ol class="post_list">
    <?php
         while( $service_list->have_posts() ) : $service_list->the_post();
           $active = '';
           $post_id = $post->ID;
           if($current_post_id == $post_id) {
             $active = ' active';
           }
    ?>
    <li class="post_name<?php echo $active; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; wp_reset_query(); ?>
   </ol>
   <?php endif; // END end post list ?>
  </li>
  <?php endforeach; ?>
  <?php else: ?>
  <?php
       $args = array( 'post_type' => 'service', 'posts_per_page' => -1, 'tax_query' => array( array( 'taxonomy' => 'service_category', 'field' => 'term_id', 'terms' => $current_page_id ) ) );
       $service_list = new wp_query($args);
       if($service_list->have_posts()):
  ?>
  <ol class="post_list">
   <?php
        while( $service_list->have_posts() ) : $service_list->the_post();
          $active = '';
          $post_id = $post->ID;
          if($current_post_id == $post_id) {
            $active = ' active';
          }
   ?>
   <li class="post_name<?php echo $active; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
   <?php endwhile; wp_reset_query(); ?>
  </ol>
  <?php endif; // END end post list ?>
  <?php endif; // END child menu ?>
 </ul>
</div>
<?php
         }; // END $current_category_data
       }; // END side category list

       // side campaign list ----------
       if($options['show_side_campaign_list']){
         $current_category_data = get_term_by( 'id', $current_page_id, 'service_category' );
         $campaign_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Campaign', 'tcd-w' );
         if($current_category_data){
           $current_category_name = $current_category_data->name;
           $post_num = $options['side_campaign_list_num'];
           $post_order = $options['side_campaign_list_order'];
           if($post_order=='date2'){ $order = 'ASC'; } else { $order = 'DESC'; };
           if($post_order=='date1'||$post_order=='date2'){ $post_order = 'date'; };
           $show_category = $options['show_side_campaign_list_category'];
           $args = array(
             'post_type' => 'campaign',
             'posts_per_page' => $post_num,
             'ignore_sticky_posts' => 1,
             'orderby' => $post_order,
             'order' => $order,
             'tax_query' => array( array('taxonomy' => 'service_category','field' => 'term_id','terms' => $current_page_id))
           );
           $campaign_query = new WP_Query($args);
           if ($campaign_query->have_posts()) {
?>
<div class="side_widget clearfix campaign_list_widget">
 <h3 class="side_headline"><?php  printf(__('%s <span>%s</span> list', 'tcd-w'),$current_category_name, $campaign_label); ?></h3>
 <div class="campaign_list clearfix">
  <?php
       while ($campaign_query->have_posts()) : $campaign_query->the_post();
         $campaign_category = get_the_terms( $campaign_query->ID, 'campaign_category' );
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $campaign_query->ID ), 'size2' );
         } elseif($options['no_image2']) {
           $image = wp_get_attachment_image_src( $options['no_image2'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
  ?>
  <article class="item clearfix">
   <?php if ($campaign_category && $show_category) { ?>
   <div class="category">
    <?php foreach ( $campaign_category as $cat ) : ?>
    <a class="campaign_cat_id<?php echo esc_attr($cat->term_id); ?>" href="<?php echo esc_url(get_term_link($cat,'service_category')); ?>"><?php echo esc_html($cat->name); ?></a>
    <?php endforeach; ?>
   </div>
   <?php }; ?>
   <a class="link animate_background" href="<?php the_permalink() ?>">
    <div class="title_area frost_bg">
     <h4 class="title rich_font"><span><?php the_title(); ?></span></h4>
     <div class="blur_image">
      <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>">
     </div>
    </div>
    <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
   </a>
  </article>
  <?php endwhile; wp_reset_query(); ?>
 </div>
</div>
<?php
           } // END if has $campaign_query
         } // END $current_category_data
       }; // END show campaign list

     // Staff ---------------------------------------
     } elseif(is_singular('staff')) {
       if($options['show_side_staff']){
         global $post;
         $current_post_id = $post->ID;
?>
<div class="side_category_list <?php echo esc_html($options['side_staff_color_type']); ?>" id="side_staff_list">
 <h3 class="headline rich_font"><?php echo esc_html($options['staff_label']); ?><?php if($options['side_staff_sub_title']){ ?><span><?php echo esc_html($options['side_staff_sub_title']); ?></span><?php }; ?></h3>
 <?php
        $staff_query = new WP_Query('post_type=staff&posts_per_page=-1');
        if ($staff_query->have_posts()) :
 ?>
 <ul>
  <?php
       while($staff_query->have_posts()): $staff_query->the_post();
         $post_id = $post->ID;
  ?>
  <li<?php if($current_post_id == $post_id){ echo ' class="active"'; }; ?>><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
  <?php endwhile; ?>
 </ul>
 <?php endif; ?>
</div>
<?php
       }
     // Campaign ---------------------------------------
     } elseif(is_singular('campaign') || is_tax('campaign_category')) {
       if($options['show_side_campaign']){
?>
<div class="side_category_list <?php echo esc_html($options['side_campaign_category_color_type']); ?>" id="side_campaign_category_list">
 <h3 class="headline rich_font"><?php echo esc_html($options['campaign_label']); ?><?php if($options['side_campaign_sub_title']){ ?><span><?php echo esc_html($options['side_campaign_sub_title']); ?></span><?php }; ?></h3>
 <ul>
  <?php
       if(is_tax('campaign_category')){
         $query_obj = get_queried_object();
         $current_page_id = $query_obj->term_id;
       } else {
         $campaign_cats = get_the_terms( $post->ID, 'campaign_category' );
         if ($campaign_cats) {
           foreach ( $campaign_cats as $cat ) {
             $current_page_id = $cat->term_id;
           }
        };
       }
       $terms = get_terms( 'campaign_category', array( 'hide_empty' => true, 'orderby' => 'id' ) );
       if ( $terms && ! is_wp_error( $terms ) ) :
         foreach ( $terms as $term ):
           $term_id = $term->term_id;
           $active = '';
           if($current_page_id == $term_id) {
             $active = ' class="active"';
           }
           echo '<li' . $active . '><a href="' . esc_url(get_term_link($term,'campaign_category')) . '">' . esc_html( $term->name ) . "</a></li>\n";
         endforeach;
       endif;
  ?>
 </ul>
</div>
<?php
       };
     // FAQ ---------------------------------------
     } elseif(is_post_type_archive('faq') || is_tax('faq_category')) {
       if($options['show_side_faq']){
       $faq_label = $options['faq_label'] ? esc_html( $options['faq_label'] ) : __( 'FAQ', 'tcd-w' );

?>
<div class="side_category_list <?php echo esc_html($options['side_faq_category_color_type']); ?>" id="side_faq_category_list">
 <h3 class="headline rich_font"><?php echo esc_html($options['faq_label']); ?><?php if($options['side_faq_sub_title']){ ?><span><?php echo esc_html($options['side_faq_sub_title']); ?></span><?php }; ?></h3>
 <ul>
  <li><a href="<?php echo esc_url(get_post_type_archive_link('faq')); ?>"><?php  printf(__('New %s', 'tcd-w'),$faq_label); ?></a></li>
  <?php
       if(is_tax('faq_category')){
         $query_obj = get_queried_object();
         $current_page_id = $query_obj->term_id;
         $parent_id = $query_obj->parent;
         if($parent_id != 0){ // if is child category
           $current_page_id = $parent_id;
         }
       } else {
         $current_page_id = '';
         $parent_id = '';
       }
       $terms = get_terms( 'faq_category', array( 'hide_empty' => true, 'orderby' => 'id', 'parent' => 0 ) );
       if ( $terms && ! is_wp_error( $terms ) ) :
         foreach ( $terms as $term ):
           $term_id = $term->term_id;
           $active = '';
           if($current_page_id == $term_id) {
             $active = ' class="active"';
           }
           echo '<li' . $active . '><a href="' . esc_url(get_term_link($term,'faq_category')) . '">' . esc_html( $term->name ) . "</a></li>\n";
         endforeach;
       endif;
  ?>
 </ul>
</div>
<?php
       };
     }; // END FAQ ---------------------------------------

$sidebar = '';

if ( is_singular('news') || is_post_type_archive('news') ) {
  $sidebar = 'news_widget';
} elseif ( is_post_type_archive('faq') ) {
  $sidebar = 'faq_widget';
} elseif ( is_singular('staff') ) {
  $sidebar = 'staff_widget';
} elseif ( is_singular('column') ) {
  $sidebar = 'column_widget';
} elseif ( is_singular('campaign') || is_tax('campaign_category') ) {
  $sidebar = 'campaign_widget';
} elseif ( is_singular('clinic') ) {
  $sidebar = 'clinic_widget';
} elseif ( is_singular('service') || is_tax('service_category') ) {
  $sidebar = 'service_widget';
} elseif ( is_page() ) {
  $sidebar = 'page_widget';
} else {
  $sidebar = 'blog_widget';
}

if ( is_mobile() ) {
  $sidebar .= '_mobile';
}

if ( is_active_sidebar( $sidebar ) ) {
  dynamic_sidebar( $sidebar );
} elseif ( is_active_sidebar( 'common_widget' ) ) {
  if(is_singular('clinic')) {
    if($options['show_side_clinic'] != 1){
      dynamic_sidebar( 'common_widget' );
    }
  } elseif ( is_singular('service') || is_tax('service_category') ) {
    if($options['show_side_service'] != 1){
      dynamic_sidebar( 'common_widget' );
    }
  } elseif(is_singular('staff')) {
    if($options['show_side_staff'] != 1){
      dynamic_sidebar( 'common_widget' );
    }
  } elseif(is_singular('campaign') || is_tax('campaign_category')) {
    if($options['show_side_campaign'] != 1){
      dynamic_sidebar( 'common_widget' );
    }
  } elseif ( is_post_type_archive('faq') || is_tax('faq_category') ) {
    if($options['show_side_faq'] != 1){
      dynamic_sidebar( 'common_widget' );
    }
  } else {
    dynamic_sidebar( 'common_widget' );
  }
}
?>
</div>
