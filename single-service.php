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

 <div id="single_service">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $catch = get_post_meta($post->ID, 'service_catch', true);
        $desc = get_post_meta($post->ID, 'service_desc', true);
        $catch_mobile = get_post_meta($post->ID, 'service_catch_mobile', true);
        $catch_font_color = get_post_meta($post->ID, 'service_catch_font_color', true);

        $data_list_headline = get_post_meta($post->ID, 'service_recommend_list_headline', true);
        $data_list_headline_font_color = get_post_meta($post->ID, 'service_recommend_list_headline_font_color', true);
        $data_list_bg_color = get_post_meta($post->ID, 'service_recommend_list_bg_color', true);
        $data_list_check_color = get_post_meta($post->ID, 'service_recommend_list_check_color', true);
        $data_list = get_post_meta($post->ID, 'service_recommend_list', true);

        $content_list = get_post_meta($post->ID, 'service_content_list', true);
        $content_list_headline_font_color = get_post_meta($post->ID, 'service_content_list_headline_font_color', true);
        $content_list_headline_bg_color = get_post_meta($post->ID, 'service_content_list_headline_bg_color', true);
        $content_list_headline_border_color = get_post_meta($post->ID, 'service_content_list_headline_border_color', true);

        $price_list_headline = get_post_meta($post->ID, 'service_price_list_headline', true);
        $price_list_headline_font_color = get_post_meta($post->ID, 'service_price_list_headline_font_color', true);
        $price_list_headline_bg_color = get_post_meta($post->ID, 'service_price_list_headline_bg_color', true);
        $price_list = get_post_meta($post->ID, 'service_price_list', true);
        $price_list_desc = get_post_meta($post->ID, 'service_price_list_desc', true);
 ?>

 <article id="article">

  <div id="single_service_title_area">
   <div class="title rich_font" style="color:<?php echo esc_attr($options['single_service_title_font_color']); ?>; background:<?php echo esc_attr($options['single_service_title_bg_color']); ?>; border-color:<?php echo esc_attr($options['single_service_title_border_color']); ?>;"><span><?php the_title(); ?></span></div>
   <?php
        if($options['single_show_service_img'] && has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
   ?>
   <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php }; ?>
  </div>

  <?php
       // Catch and description ------------------------------------------------------------------------------------------------------------------
       if($catch || $desc){
  ?>
  <div class="cf_catch">
   <?php if($catch){ ?><h3 class="catch rich_font<?php if($catch_mobile) { echo ' has_mobile_word'; }; ?>" style="color:<?php echo esc_attr($catch_font_color); ?>;"<?php if($catch_mobile) { echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"'; }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h3><?php }; ?>
   <?php if($desc) { ?>
   <div class="post_content clearfix">
    <?php echo do_shortcode( wpautop(wp_kses_post($desc)) ); ?>
   </div>
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       // Recommend list --------------------------------------------------------------------------------------------------------------
       if(!empty($data_list)){
  ?>
  <div class="cf_data_list" style="background:<?php echo esc_attr($data_list_bg_color); ?>;">
   <?php if($data_list_headline) { ?>
   <h3 class="headline rich_font" style="color:<?php echo esc_attr($data_list_headline_font_color); ?>;"><?php echo nl2br(esc_html($data_list_headline)); ?></h3>
   <?php }; ?>
   <ul class="clearfix">
    <?php foreach ( $data_list as $key => $value ) : ?>
    <?php if(!empty($value['title'])){ ?><li><span><?php echo esc_html($value['title']); ?></span></li><?php }; ?>
    <?php endforeach; ?>
   </ul>
  </div>
  <?php }; ?>

  <?php
       // Content list --------------------------------------------------------------------------------------------------------------
       if(!empty($content_list)){
  ?>
  <div class="cf_content_list">
   <?php foreach ( $content_list as $key => $value ) : ?>
   <div class="item">
    <?php if(!empty($value['headline'])) { ?>
    <h3 class="headline" style="color:<?php echo esc_attr($content_list_headline_font_color); ?>; background:<?php echo esc_attr($content_list_headline_bg_color); ?>; border-color:<?php echo esc_attr($content_list_headline_border_color); ?>;"><?php echo esc_html($value['headline']); ?></h3>
    <?php }; ?>
    <?php if(!empty($value['content'])) { ?>
    <div class="post_content clearfix">
     <?php echo do_shortcode( $value['content'] ); ?>
    </div>
    <?php }; ?>
   </div>
   <?php endforeach; ?>
  </div>
  <?php }; ?>

  <?php
       // Price list --------------------------------------------------------------------------------------------------------------
       if(!empty($price_list)){
  ?>
  <div class="cf_price_list" style="background:<?php echo esc_attr($price_list_bg_color); ?>;">
   <?php if($price_list_headline) { ?>
   <h3 class="headline" style="color:<?php echo esc_attr($price_list_headline_font_color); ?>; background:<?php echo esc_attr($price_list_headline_bg_color); ?>;"><?php echo nl2br(esc_html($price_list_headline)); ?></h3>
   <?php }; ?>
   <dl class="clearfix">
    <?php foreach ( $price_list as $key => $value ) : ?>
    <dt><span><?php if(!empty($value['title'])) { echo esc_html($value['title']); }; ?></span></dt>
    <dd><span><?php if(!empty($value['price'])) { echo esc_html($value['price']); }; ?></span></dt>
    <?php endforeach; ?>
   </dl>
   <?php if($price_list_desc){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($price_list_desc)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

 </article><!-- END #article -->

 <?php endwhile; endif; ?>

 <?php
      if($options['show_single_service_post_list']){
        $categories = get_the_terms( $post->ID, 'service_category' );
        if($categories) {
          $child_category_name = '';
          $cat_id = '';
          foreach($categories as $cat){
            if($cat->parent){
              $child_category_name = $cat->name;
              $cat_id = $cat->term_id;
            }
          }
          if(empty($child_category_name)){ // no sub category
            foreach($categories as $cat){
              $child_category_name = $cat->name;
              $cat_id = $cat->term_id;
            }
          }
 ?>
 <div id="single_service_related_post">
  <?php if($child_category_name) { ?><h3 class="headline rich_font" style="color:<?php echo esc_attr($options['single_service_post_list_headline_font_color']); ?>; font-size:<?php echo esc_attr($options['single_service_post_list_headline_font_size']); ?>px;"><?php echo esc_html($child_category_name); ?></h3><?php }; ?>
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
 </div><!-- END #single_service_related_post -->
 <?php }; }; ?>

 </div><!-- END #single_service -->

 </div><!-- END #main_col -->

 <?php // get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>