<?php $options = get_design_plus_option(); ?>

 <?php
      // Banner content --------------------------------------------------------------------
      if( $options['show_footer_banner1'] || $options['show_footer_banner2'] || $options['show_footer_banner3'] ) {
 ?>
 <div id="footer_banner" class="clearfix">
  <?php
       for ( $i = 1; $i <= 3; $i++ ) :
         $image = wp_get_attachment_image_src( $options['footer_banner_image'.$i], 'full' );
         if($image) {
  ?>
  <div class="box box<?php echo $i; ?>">
   <a class="link animate_background" href="<?php echo esc_url($options['footer_banner_url'.$i]); ?>" <?php if($options['footer_banner_target'.$i]) { echo 'target="_blank"'; }; ?>>
    <div class="catch frost_bg">
     <p class="title rich_font"><?php echo esc_html($options['footer_banner_title'.$i]); ?></p>
     <div class="blur_image">
      <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>">
     </div>
    </div>
    <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
   </a>
  </div>
  <?php }; endfor; ?>
 </div><!-- END #footer_banner -->
 <?php }; ?>


 <?php
      // Information --------------------------------------------------------------------
      if( $options['show_footer_company_info'] || $options['show_footer_info1'] || $options['show_footer_info2'] ) {
 ?>
 <div id="footer_information">
  <div id="footer_information_inner" class="clearfix">
   <?php if( $options['show_footer_company_info']) { ?>
   <div id="footer_company">
    <?php if( $options['show_footer_logo']) { ?>
    <div id="footer_logo">
     <?php footer_logo(); ?>
    </div>
    <?php }; ?>
    <?php if($options['footer_company_info']){ ?><p class="desc"><?php echo wp_kses_post(nl2br($options['footer_company_info'])); ?></p><?php }; ?>
   </div><!-- END #footer_company -->
   <?php }; ?>
   <?php
        for ( $i = 1; $i <= 2; $i++ ) :
          if($options['show_footer_info'.$i]) {
   ?>
   <div id="footer_info_content<?php echo $i; ?>" class="footer_info_content">
    <?php if($options['footer_info_title'.$i]){ ?><h3 class="title rich_font"><?php echo wp_kses_post(nl2br($options['footer_info_title'.$i])); ?></h3><?php }; ?>
    <?php if($options['footer_info_desc'.$i]){ ?><p class="desc"><?php echo wp_kses_post(nl2br($options['footer_info_desc'.$i])); ?></p><?php }; ?>
    <?php if($options['show_footer_info_button'.$i]) { ?>
    <div class="button">
     <a href="<?php echo esc_url($options['footer_info_url'.$i]); ?>"<?php if($options['footer_info_target'.$i]) { echo ' target="_blank"'; }; ?>><?php echo esc_html($options['footer_info_button_label'.$i]); ?></a>
    </div>
    <?php }; ?>
   </div><!-- END .footer_info_content -->
   <?php }; endfor; ?>
   <div class="footer_info_map">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1789.712758102049!2d127.6786773700335!3d26.215360051120264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34e5699d0852fee5%3A0x232a37354b39abe0!2z44CSOTAwLTAwMTUg5rKW57iE55yM6YKj6KaH5biC5LmF6IyC5Zyw77yS5LiB55uu77yR4oiS77yT!5e0!3m2!1sja!2sjp!4v1659590401637!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="gmap"></iframe>
   </div>
  </div><!-- END #footer_information_inner -->
 </div><!-- END #footer_information -->
 <?php }; ?>

 <div class="float-button__wrap"><a href="/reserve/">ご予約は<br>
  こちら</a>
  <div class="circleTextWrap">
    <svg class="circleText" viewBox="0 0 100 100">
      <path id="circle" class="circleText__circle" d="M 0 50 A 50 50 0 1 1 0 51 z"/>
      <text class="circleText__text">
        <textPath xlink:href="#circle">OKINAWA SKINCARE CLINIC — RESERVATION — </textPath>
      </text>
    </svg>
  </div>
</div>

 <div id="footer_menu_area" style="background:<?php echo esc_attr($options['footer_menu_bg_color']); ?>;">
  <div id="footer_menu_area_inner" class="clearfix">
   <?php // footer menu -------------------------------------------- ?>
   <?php if (has_nav_menu('footer-menu')) { ?>
   <div id="footer_menu" class="footer_menu">
    <?php if($options['footer_show_home_menu']){ ?>
    <h3 class="footer_headline"><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a></h3>
    <?php }; ?>
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'container' => '' , 'depth' => '1') ); ?>
   </div>
   <?php }; ?>
   <?php
        // Category menu --------------------------------------------------------------------
        if( $options['footer_show_category_menu1'] || $options['footer_show_category_menu2'] || $options['footer_show_category_menu3'] ) {
          for ( $i = 1; $i <= 3; $i++ ) :
            if($options['footer_show_category_menu'.$i]) {
              $post_num = $options['footer_category_menu_num'.$i];
              $category_id = $options['footer_category_menu_type'.$i];
              $custom_fields = get_option( 'taxonomy_' . $category_id, array() );

              if($category_id != 0) {
                $term = get_term_by( 'id', $category_id, 'service_category' );
              }
              if($category_id == 0) {
                $args = array('post_type' => 'service','posts_per_page' => $post_num);
              } else {
                $args = array(
                  'post_type' => 'service',
                  'posts_per_page' => $post_num,
                  'tax_query' => array( array('taxonomy' => 'service_category','field' => 'term_id','terms' => $category_id))
                );
              }
              $service_query = new WP_Query($args);
              if ($service_query->have_posts()) :
   ?>
   <div id="footer_category_menu<?php echo $i; ?>" class="footer_menu">
    <?php if($category_id == 0) { ?>
    <h3 class="footer_headline"><a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><?php echo esc_html($options['service_label']); ?></a></h3>
    <?php } else { ?>
    <h3 class="footer_headline"><a href="<?php echo esc_url(get_term_link($term,'service_category')); ?>"><?php echo esc_html($term->name); if (!empty($custom_fields['sub_title'])){ ?><span><?php echo esc_html($custom_fields['sub_title']); ?></span><?php }; ?></a></h3>
    <?php }; ?>
    <ol>
     <?php
         while($service_query->have_posts()): $service_query->the_post();
     ?>
     <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
     <?php endwhile; ?>
    </ol>
   </div><!-- END .footer_category_menu -->
   <?php
              endif; wp_reset_query();
            };
          endfor;
        };
   ?>
  </div><!-- END #footer_menu_area_inner -->
 </div><!-- END #footer_menu_area -->

 <div id="footer_bottom" style="background:<?php echo esc_attr($options['copyright_bg_color']); ?>;">
  <div id="footer_bottom_inner" class="clearfix">

   <?php if(!is_mobile()) { ?>
   <div id="return_top">
    <a href="#body"><span><?php _e('PAGE TOP', 'tcd-w'); ?></span></a>
   </div>
   <?php }; ?>

   <?php
        // footer sns ------------------------------------
        $facebook = $options['footer_facebook_url'];
        $twitter = $options['footer_twitter_url'];
        $insta = $options['footer_instagram_url'];
        $pinterest = $options['footer_pinterest_url'];
        $youtube = $options['footer_youtube_url'];
        $contact = $options['footer_contact_url'];
        $show_rss = $options['footer_show_rss'];
   ?>
   <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $show_rss) { ?>
   <ul id="footer_social_link" class="clearfix">
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>" rel="nofollow" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

   <p id="copyright"><?php echo wp_kses_post($options['copyright']); ?></p>

  </div>
 </div><!-- END #footer_bottom -->

 <?php
      // footer button ------------------------------------------
      if( ( is_mobile() && $options['show_footer_button1']) || ( is_mobile() && $options['show_footer_button2']) ) {
        if($options['footer_content_type'] == 'type2') {
 ?>
 <div id="footer_button">
  <?php
       for ( $i = 1; $i <= 2; $i++ ) :
         if($options['show_footer_button'.$i]) {
  ?>
  <div class="button button<?php echo $i; ?>">
   <a href="<?php echo esc_url($options['footer_button_url'.$i]); ?>"<?php if($options['footer_button_target'.$i]) { echo ' target="_blank"'; }; ?>><?php echo esc_html($options['footer_button_label'.$i]); ?></a>
  </div>
  <?php }; endfor; ?>
 </div><!-- END #footer_button -->
 <?php  }
      } elseif($options['show_header_button1'] || $options['show_header_button2']) {
        if(!is_mobile()) {
 ?>
 <div id="footer_button">
  <?php
       for ( $i = 1; $i <= 2; $i++ ) :
         if($options['show_header_button'.$i]) {
  ?>
  <div class="button button<?php echo $i; ?>">
   <a href="<?php echo esc_url($options['header_button_url'.$i]); ?>"<?php if($options['header_button_target'.$i]) { echo ' target="_blank"'; }; ?>><?php echo esc_html($options['header_button_label'.$i]); ?></a>
  </div>
  <?php }; endfor; ?>
 </div><!-- END #footer_button -->
 <?php }; }; ?>

 <?php
      // footer bar for mobile device -------------------
      if( is_mobile() ) {
        if($options['footer_content_type'] == 'type3') {
          get_template_part('template-parts/footer-bar');
        }
      };
 ?>

</div><!-- #container -->

<?php // mobile menu -------------------------------------------- ?>
<div id="mobile_menu">
  <?php
  wp_nav_menu(array(
    'theme_location' => 'drawer_menu',
    'container'      => 'nav',
    'container_id'   => 'drawer_menu',
    'menu_class'     => 'drawer_menu_list',
    'fallback_cb'    => false,
  ));
  ?>
 <div id="header_mobile_banner">
  <?php
       for($i=1; $i<= 3; $i++):
         if( $options['mobile_menu_ad_code'.$i] || $options['mobile_menu_ad_image'.$i] ) {
           if ($options['mobile_menu_ad_code'.$i]) {
  ?>
  <div class="banner">
   <?php echo $options['mobile_menu_ad_code'.$i]; ?>
  </div>
  <?php
       } else {
         $mobile_menu_image = wp_get_attachment_image_src( $options['mobile_menu_ad_image'.$i], 'full' );
  ?>
  <div class="banner">
   <a href="<?php echo esc_url( $options['mobile_menu_ad_url'.$i] ); ?>"<?php if($options['mobile_menu_ad_target'.$i] == 1) { ?> target="_blank"<?php }; ?>><img src="<?php echo esc_attr($mobile_menu_image[0]); ?>" alt="" title="" /></a>
  </div>
  <?php }; }; endfor; ?>
 </div><!-- END #header_mobile_banner -->
</div>

<?php
     // load script -----------------------------------------------------------
     if ($options['show_load_icon_only_front']) {
       if(is_front_page()){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } elseif ($options['use_load_icon']) {
       if(is_front_page() || is_home() || is_post_type_archive(array('news','service','faq','staff','column','campaign','clinic')) ){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } else {
       no_loading_screen();
     };
?>

<?php
     // share button ----------------------------------------------------------------------
     if ( is_single() && ( $options['show_sns_top'] || $options['show_sns_btm'] ) ) :
       if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
         if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
         endif;
         if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( $options['show_pinterest_top'] || $options['show_pinterest_btm'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
<?php
     // blur effect and object fit for ie11 -----------------------------------------------
     $browser  = strtolower($_SERVER['HTTP_USER_AGENT']);
     if (mb_strstr($browser  , 'trident') || mb_strstr($browser  , 'msie')) {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/blurify.min.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/ofi.min.js?ver=<?php echo version_num(); ?>"></script>
<script>
(function () {
  blurify({
    images: document.querySelectorAll('.blur_image img'),
    blur: <?php echo esc_attr($options['frost_blur']); ?>,
    mode: 'canvas',
  });
})();
objectFitImages('.object_fit');
</script>
<?php }; ?>
<script>
window.ontouchstart = function() {};
window.addEventListener('touchstart', function() {}, true);
window.addEventListener('touchstart', function() {}, false);

document.ontouchstart = function() {};
document.addEventListener('touchstart', function() {}, true);
document.addEventListener('touchstart', function() {}, false);

document.body.ontouchstart = function() {};
document.body.addEventListener('touchstart', function() {}, true);
document.body.addEventListener('touchstart', function() {}, false);
</script>

<?php if ( is_front_page() ) { ?>
<!-- slick slider読み込み add by hanahana 2021.07.25 -->
<link rel="stylesheet" type="text/css" href="https://okinawa-skincare.com/slick/slick-theme.css" media="screen" />
<?php }; ?>

<!-- ギャラリー表示用スクリプト -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script> 
<script src="https://okinawa-skincare.com/js/gallery.js"></script> 
<script src="https://okinawa-skincare.com/js/common.js?<?php echo date('YmdHis'); ?>"></script>
</body>
</html>