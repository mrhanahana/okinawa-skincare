<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['campaign_label'];
     $image_id = $options['campaign_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['campaign_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     } else {
       $background_color = $options['campaign_bg_color'];
     }
     $use_overlay = $options['campaign_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['campaign_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['campaign_overlay_opacity'];
     }
?>
<div id="page_header" class="small" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;">
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

 <div id="single_campaign">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $catch = get_post_meta($post->ID, 'campaign_catch', true);
        $desc = get_post_meta($post->ID, 'campaign_desc', true);
        $catch_mobile = get_post_meta($post->ID, 'campaign_catch_mobile', true);
        $catch_font_color = get_post_meta($post->ID, 'campaign_catch_font_color', true);

        $data_list_headline = get_post_meta($post->ID, 'campaign_featured_list_headline', true);
        $data_list_headline_font_color = get_post_meta($post->ID, 'campaign_featured_list_headline_font_color', true);
        $data_list_bg_color = get_post_meta($post->ID, 'campaign_featured_list_bg_color', true);
        $data_list_check_color = get_post_meta($post->ID, 'campaign_featured_list_check_color', true);
        $data_list = get_post_meta($post->ID, 'campaign_featured_list', true);

        $content_list = get_post_meta($post->ID, 'campaign_content_list', true);
        $content_list_headline_font_color = get_post_meta($post->ID, 'campaign_content_list_headline_font_color', true);
        $content_list_headline_bg_color = get_post_meta($post->ID, 'campaign_content_list_headline_bg_color', true);
        $content_list_headline_border_color = get_post_meta($post->ID, 'campaign_content_list_headline_border_color', true);

        $list_image_type = get_post_meta($post->ID, 'campaign_image_list_type', true);
        $list_image1_id = get_post_meta($post->ID, 'campaign_image1', true);
        $list_image2_id = get_post_meta($post->ID, 'campaign_image2', true);
        $list_image3_id = get_post_meta($post->ID, 'campaign_image3', true);

        $price_list_headline = get_post_meta($post->ID, 'campaign_price_list_headline', true);
        $price_list_headline_font_color = get_post_meta($post->ID, 'campaign_price_list_headline_font_color', true);
        $price_list_headline_bg_color = get_post_meta($post->ID, 'campaign_price_list_headline_bg_color', true);
        $price_list = get_post_meta($post->ID, 'campaign_price_list', true);
        $price_list_desc = get_post_meta($post->ID, 'campaign_price_list_desc', true);
 ?>

 <article id="article">

  <?php
       // header image ------------------------------------------------------------------------------------------------------------------------
       if($options['single_show_campaign_img'] && has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
  ?>
  <div class="cf_header_image" id="campaign_header_image">
   <?php
        if ( $options['single_show_campaign_category'] ){
          $campaign_cats = get_the_terms( $post->ID, 'campaign_category' );
          if ($campaign_cats) {
            echo '<p class="category">';
              foreach ( $campaign_cats as $cat ) {
                echo '<a class="campaign_cat_id' . esc_attr($cat->term_id) . '" href="' . esc_url(get_term_link($cat,'campaign_category')) . '">' . esc_html($cat->name) . '</a>';
              }
            echo '</p>';
          };
        };
   ?>
   <!--<div class="title_area frost_bg">
    <h1 class="title rich_font" style="color:<?php echo esc_attr($options['single_campaign_title_font_color']); ?>;"><span><?php the_title(); ?></span></h1>
    <div class="blur_image">
     <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>">
    </div>
   </div>-->
   <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
  </div>
  <?php }else{ ?>
  <div class="cf_header_no_image" id="campaign_header_image">
   <?php
        if ( $options['single_show_campaign_category'] ){
          $campaign_cats = get_the_terms( $post->ID, 'campaign_category' );
          if ($campaign_cats) {
            echo '<p class="category">';
              foreach ( $campaign_cats as $cat ) {
                echo '<a class="campaign_cat_id' . esc_attr($cat->term_id) . '" href="' . esc_url(get_term_link($cat,'campaign_category')) . '">' . esc_html($cat->name) . '</a>';
              }
            echo '</p>';
          };
        };
   ?>
    <h1 class="title rich_font" style="color:<?php echo esc_attr($options['single_campaign_title_font_color']); ?>;"><span><?php the_title(); ?></span></h1>
  </div>
  <?php }; ?>

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
       // Featured list --------------------------------------------------------------------------------------------------------------
       if(!empty($data_list)){
  ?>
  <div class="cf_data_list" style="background:<?php echo esc_attr($data_list_bg_color); ?>;">
   <?php if($data_list_headline) { ?>
   <h3 class="headline rich_font" style="color:<?php echo esc_attr($data_list_headline_font_color); ?>;"><?php echo nl2br(esc_html($data_list_headline)); ?></h3>
   <?php }; ?>
   <ul class="clearfix">
    <?php foreach ( $data_list as $key => $value ) : ?>
    <?php if($value['title']){ ?><li><span><?php echo esc_html($value['title']); ?></span></li><?php }; ?>
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
    <?php if($value['headline']) { ?>
    <h3 class="headline" style="color:<?php echo esc_attr($content_list_headline_font_color); ?>; background:<?php echo esc_attr($content_list_headline_bg_color); ?>; border-color:<?php echo esc_attr($content_list_headline_border_color); ?>;"><?php echo esc_html($value['headline']); ?></h3>
    <?php }; ?>
    <?php if($value['content']) { ?>
    <div class="post_content clearfix">
     <?php echo do_shortcode( wpautop(wp_kses_post($value['content'])) ); ?>
    </div>
    <?php }; ?>
   </div>
   <?php endforeach; ?>
  </div>
  <?php }; ?>

  <?php
       // Image list --------------------------------------------------------------------------------------------------------------
       if(!empty($list_image1_id)){
  ?>
  <div class="cf_image_list <?php echo esc_attr($list_image_type); ?> clearfix">
   <?php
        if(!empty($list_image1_id)) {
          $list_image1 = wp_get_attachment_image_src($list_image1_id, 'full');
   ?>
   <img src="<?php echo esc_attr($list_image1[0]); ?>" alt="" title="" />
   <?php }; ?>
   <?php
        if(!empty($list_image2_id)) {
          $list_image2 = wp_get_attachment_image_src($list_image2_id, 'full');
   ?>
   <img src="<?php echo esc_attr($list_image2[0]); ?>" alt="" title="" />
   <?php }; ?>
   <?php
        if(!empty($list_image3_id)) {
          $list_image3 = wp_get_attachment_image_src($list_image3_id, 'full');
   ?>
   <img src="<?php echo esc_attr($list_image3[0]); ?>" alt="" title="" />
   <?php }; ?>
  </div>
  <?php }; ?>

  <?php
       // Price list --------------------------------------------------------------------------------------------------------------
       if(!empty($price_list)){
  ?>
  <div class="cf_price_list" style="background:<?php echo esc_attr($price_list_bg_color); ?>;">
   <?php if($price_list_headline) { ?>
   <h3 class="headline rich_font" style="color:<?php echo esc_attr($price_list_headline_font_color); ?>; background:<?php echo esc_attr($price_list_headline_bg_color); ?>;"><?php echo nl2br(esc_html($price_list_headline)); ?></h3>
   <?php }; ?>
   <dl class="clearfix">
    <?php foreach ( $price_list as $key => $value ) : ?>
    <dt><span><?php if($value['title']) { echo esc_html($value['title']); }; ?></span></dt>
    <dd><span><?php if($value['price']) { echo esc_html($value['price']); }; ?></span></dt>
    <?php endforeach; ?>
   </dl>
   <?php if($price_list_desc){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($price_list_desc)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

 </article><!-- END #article -->

 <?php endwhile; endif; ?>


 </div><!-- END #single_campaign -->

 </div><!-- END #main_col -->

 <?php // get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>