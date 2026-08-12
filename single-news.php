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
   <?php if($title){ ?><h2 class="title rich_font"><?php echo wp_kses_post(nl2br($title)); ?></h2><?php }; ?>
  </div>
 </div>
 <?php if($image_id && $use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents" class="clearfix">

 <div id="main_col" class="fullwidth clearfix">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="article">

  <div id="post_title_area" style="border-color:<?php echo esc_attr($options['single_news_title_border_color']); ?>;">
   <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
   <?php if ( $options['show_news_date'] ){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p><?php }; ?>
  </div>

  <?php if($page == '1') { // ***** only show on first page ***** ?>

  <?php
       // mobile banner ------------------------------------------------------------------------------------------------------------------------
       if($options['show_news_image'] && has_post_thumbnail()) {
  ?>
  <div id="post_image">
   <?php the_post_thumbnail('size4'); ?>
  </div>
  <?php }; ?>

  <?php
       // mobile banner ------------------------------------------------------------------------------------------------------------------------
       if(is_mobile()) {
  ?>
  <?php if( $options['news_single_mobile_ad_code1'] || $options['news_single_mobile_ad_image1'] ) { ?>
  <div id="mobile_banner_top" class="single_banner_area one_banner">
   <?php if ($options['news_single_mobile_ad_code1']) { ?>
   <div class="single_banner">
    <?php echo $options['news_single_mobile_ad_code1']; ?>
   </div>
   <?php } else { ?>
   <?php $single_mobile_image = wp_get_attachment_image_src( $options['news_single_mobile_ad_image1'], 'full' ); ?>
   <div class="single_banner">
    <a href="<?php echo esc_url( $options['news_single_mobile_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_mobile_image[0]); ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
  </div><!-- END #single_banner_area_top -->
  <?php }; ?>
  <?php }; ?>

  <?php
       // banner top ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['news_single_top_ad_code1'] || $options['news_single_top_ad_image1'] || $options['news_single_top_ad_code2'] || $options['news_single_top_ad_image2'] ) {
  ?>
  <div id="single_banner_top" class="single_banner_area clearfix<?php if( !$options['news_single_top_ad_code2'] && !$options['news_single_top_ad_image2'] ) { echo ' one_banner'; }; ?>">
   <?php if ($options['news_single_top_ad_code1']) { ?>
   <div class="single_banner single_banner_left">
    <?php echo $options['news_single_top_ad_code1']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image1 = wp_get_attachment_image_src( $options['news_single_top_ad_image1'], 'full' ); ?>
   <div class="single_banner single_banner_left">
    <a href="<?php echo esc_url( $options['news_single_top_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image1[0]); ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
   <?php if ($options['news_single_top_ad_code2']) { ?>
   <div class="single_banner single_banner_right">
    <?php echo $options['news_single_top_ad_code2']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image2 = wp_get_attachment_image_src( $options['news_single_top_ad_image2'], 'full' ); ?>
   <div class="single_banner single_banner_right">
    <a href="<?php echo esc_url( $options['news_single_top_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image2[0]); ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
  </div><!-- END #single_banner_area -->
  <?php
         };
       };
  ?>

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

  <?php
       // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if($options['show_news_sns']) {
  ?>
  <div class="single_share clearfix" id="single_share_bottom">
   <?php get_template_part('template-parts/sns-btn-btm'); ?>
  </div>
  <?php }; ?>

  <?php
       // banner bottom ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['news_single_bottom_ad_code1'] || $options['news_single_bottom_ad_image1'] || $options['news_single_bottom_ad_code2'] || $options['news_single_bottom_ad_image2'] ) {
  ?>
  <div id="single_banner_bottom" class="single_banner_area clearfix<?php if( !$options['news_single_bottom_ad_code2'] && !$options['news_single_bottom_ad_image2'] ) { echo ' one_banner'; }; ?>">
   <?php if ($options['news_single_bottom_ad_code1']) { ?>
   <div class="single_banner single_banner_left">
    <?php echo $options['news_single_bottom_ad_code1']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image1 = wp_get_attachment_image_src( $options['news_single_bottom_ad_image1'], 'full' ); ?>
   <div class="single_banner single_banner_left">
    <a href="<?php echo esc_url( $options['news_single_bottom_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image1[0]); ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
   <?php if ($options['news_single_bottom_ad_code2']) { ?>
   <div class="single_banner single_banner_right">
    <?php echo $options['news_single_bottom_ad_code2']; ?>
   </div>
   <?php } else { ?>
   <?php $single_image2 = wp_get_attachment_image_src( $options['news_single_bottom_ad_image2'], 'full' ); ?>
   <div class="single_banner single_banner_right">
    <a href="<?php echo esc_url( $options['news_single_bottom_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image2[0]); ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
  </div><!-- END #single_banner_area -->
  <?php
         };
       };
  ?>

  <?php
       // mobile banner ------------------------------------------------------------------------------------------------------------------------
       if(is_mobile()) {
  ?>
  <?php if( $options['news_single_mobile_ad_code2'] || $options['news_single_mobile_ad_image2'] ) { ?>
  <div id="mobile_banner_bottom" class="single_banner_area one_banner">
   <?php if ($options['news_single_mobile_ad_code2']) { ?>
   <div class="single_banner">
    <?php echo $options['news_single_mobile_ad_code2']; ?>
   </div>
   <?php } else { ?>
   <?php $single_mobile_image = wp_get_attachment_image_src( $options['news_single_mobile_ad_image2'], 'full' ); ?>
   <div class="single_banner">
    <a href="<?php echo esc_url( $options['news_single_mobile_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_mobile_image[0]); ?>" alt="" title="" /></a>
   </div>
   <?php }; ?>
  </div><!-- END #single_banner_area_bottom -->
  <?php }; ?>
  <?php }; // END if mobile ?>

  <?php
       // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_news_nav']) :
  ?>
  <div id="next_prev_post" class="clearfix">
   <?php next_prev_post_link(); ?>
  </div>
  <?php endif; ?>

 </article><!-- END #article -->

 <?php endwhile; endif; ?>

 <?php
       // recent news ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if ($options['show_recent_news']){
        $num_post = $options['recent_news_num'];
        $args = array('post_type' => 'news', 'showposts'=> $num_post);
        $news_list = new wp_query($args);
        if($news_list->have_posts()):
 ?>
 <div id="recent_news" style="background:<?php echo esc_attr($options['recent_news_bg_color']); ?>;">
  <h3 class="headline"><?php echo esc_html($options['recent_news_headline']); ?></h3>
  <ol class="post_list">
   <?php while( $news_list->have_posts() ) : $news_list->the_post(); ?>
   <li>
    <a href="<?php the_permalink() ?>" class="clearfix">
     <?php if ( $options['show_recent_news_date'] ){ ?>
     <p class="date" style="color:<?php echo esc_attr($options['recent_news_date_color']); ?>;"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.j'); ?></time></p>
     <?php }; ?>
     <h4 class="title"><span><?php the_title(); ?></span></h4>
    </a>
   </li>
   <?php endwhile; wp_reset_query(); ?>
  </ol>
  <?php if ($options['show_recent_news_link']){ ?>
  <a class="link" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($options['recent_news_link']); ?></a>
  <?php }; ?>
 </div><!-- END #recent_news -->
 <?php endif; }; ?>

 </div><!-- END #main_col -->

 <?php // get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>