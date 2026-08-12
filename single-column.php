<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['column_label'];
     $image_id = $options['column_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['column_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     } else {
       $background_color = $options['column_bg_color'];
     }
     $use_overlay = $options['column_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['column_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['column_overlay_opacity'];
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

 <div id="main_col" class="clearfix">

 <div id="single_column" style="background:<?php echo esc_attr($options['single_column_bg_color']); ?>; border-color:<?php echo esc_attr($options['single_column_border_color']); ?>;">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="article">

  <?php
       // featured image ------------------------------------------------------------------------------------------------------------------------
  ?>
  <div id="column_post_image">
   <?php
        if ( $options['show_column_category'] ){
          $column_cats = get_the_terms( $post->ID, 'column_category' );
          if ($column_cats) {
            echo '<p class="category">';
              foreach ( $column_cats as $cat ) {
                echo '<a href="' . esc_url(get_term_link($cat,'column_category')) . '">' . esc_html($cat->name) . '</a>';
              }
            echo '</p>';
          };
        };
   ?>
   <?php if($options['show_column_thumbnail'] && has_post_thumbnail()) {
    the_post_thumbnail('size4');
   }; ?>
  </div>

  <?php if($page == '1') { // ***** only show on first page ***** ?>
  <div id="column_post_title_area">
   <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
   <?php if ( $options['show_column_date'] ){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p><?php }; ?>
  </div>
  <?php }; // ***** END only show on first page ***** ?>

  <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
  <div class="post_content clearfix">
   <?php
        the_content();
        if ( ! post_password_required() ) {
          $pagenation_type = get_post_meta($post->ID, 'pagenation_type', true);
          if($pagenation_type == 'type3') {
            $pagenation_type = $options['pagenation_type'];
          };
          if ( $pagenation_type == 'type2' ) {
            if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
   ?>
   <div id="p_readmore">
    <a class="button" href="<?php echo esc_url( $matches[1] ); ?>#article"><?php _e( 'Read more', 'tcd-w' ); ?></a>
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

  <?php
       // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_column_nav']) :
  ?>
  <div id="next_prev_post" class="clearfix">
   <?php next_prev_post_link(); ?>
  </div>
  <?php endif; ?>

 </article><!-- END #article -->

 <?php endwhile; endif; ?>

 <?php
       // related post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if ($options['show_related_column']){
        $categories = get_the_terms( $post->ID, 'column_category' );
        if ($categories) {
          $post_num = $options['related_post_num'];
          $args = array(
            'post_type' => 'column',
            'posts_per_page' => $post_num,
            'post__not_in' => array($post->ID),
            'tax_query' => array(
              array(
                'taxonomy' => 'column_category',
                'field' => 'term_id',
                'terms' => $categories[0]->term_id,
              )
            )
          );
          $column_list = new wp_query($args);
          if($column_list->have_posts()):
 ?>
 <div id="related_post">
  <?php if(!empty($options['related_column_headline'])) { ?>
  <h3 class="headline"><?php echo esc_html($options['related_column_headline']); ?></h3>
  <?php }; ?>
  <div class="post_list clearfix">
   <?php
        while( $column_list->have_posts() ) : $column_list->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $column_list->ID ), 'size2' );
          } elseif($options['no_image2']) {
            $image = wp_get_attachment_image_src( $options['no_image2'], 'full' );
          } else {
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
   ?>
   <article class="item">
    <a class="animate_background" href="<?php the_permalink() ?>" style="background:none;">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <p class="title"><span><?php trim_title(25); ?></span></p>
    </a>
   </article>
   <?php endwhile; wp_reset_query(); ?>
  </div><!-- END #post_list_type1 -->
 </div><!-- END #related_post -->
 <?php
         endif;
       };
     };
 ?>

 </div><!-- END #single_column -->

 </div><!-- END #main_col -->

 <!-- <?php get_sidebar(); ?> -->

</div><!-- END #main_contents -->

<?php get_footer(); ?>