<?php
     get_header();
     $options = get_design_plus_option();
     $title = $options['staff_label'];
     $image_id = $options['staff_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
       if(is_mobile()) {
         $image_mobile = wp_get_attachment_image_src( $options['staff_bg_image_mobile'], 'full');
         if($image_mobile) {
           $image = $image_mobile;
         };
       }
     } else {
       $background_color = $options['staff_bg_color'];
     }
     $use_overlay = $options['staff_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['staff_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['staff_overlay_opacity'];
     }
?>
<?php if(!empty($image_id)) { ?>

<div id="page_header" class="small" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;">
<?php } else { ?>
<div id="page_header" class="small" style="background:<?php echo $background_color; ?>;">
  <?php }; ?>
  <div id="page_header_inner">
    <div id="page_header_catch">
      <?php if($title){ ?>
      <h2 class="title rich_font"><?php echo wp_kses_post(nl2br($title)); ?></h2>
      <?php }; ?>
    </div>
  </div>
  <?php if($image_id && $use_overlay) { ?>
  <div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div>
  <?php }; ?>
</div>
<?php get_template_part('template-parts/breadcrumb'); ?>
<div id="main_contents" class="clearfix">
  <div id="main_col" class="fullwidth clearfix">
    <div id="single_staff">
      <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $catch = get_post_meta($post->ID, 'staff_catch', true);
        $desc = get_post_meta($post->ID, 'staff_desc', true);
        $catch_mobile = get_post_meta($post->ID, 'staff_catch_mobile', true);
        $catch_font_color = get_post_meta($post->ID, 'staff_catch_font_color', true);

        $data_list_headline = get_post_meta($post->ID, 'staff_featured_list_headline', true);
        $data_list_headline_font_color = get_post_meta($post->ID, 'staff_featured_list_headline_font_color', true);
        $data_list_bg_color = get_post_meta($post->ID, 'staff_featured_list_bg_color', true);
        $data_list_check_color = get_post_meta($post->ID, 'staff_featured_list_check_color', true);
        $data_list = get_post_meta($post->ID, 'staff_featured_list', true);

        $content_list = get_post_meta($post->ID, 'staff_content_list', true);
        $content_list_headline_font_color = get_post_meta($post->ID, 'staff_content_list_headline_font_color', true);
        $content_list_headline_bg_color = get_post_meta($post->ID, 'staff_content_list_headline_bg_color', true);
        $content_list_headline_border_color = get_post_meta($post->ID, 'staff_content_list_headline_border_color', true);
 ?>
      <article id="article">
        <?php
       // header image ------------------------------------------------------------------------------------------------------------------------
       if($options['single_show_staff_img'] && has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
  ?>
        <div class="cf_header_image" id="staff_header_image">
          <div class="title_area frost_bg">
            <h1 class="title rich_font" style="color:<?php echo esc_attr($options['single_staff_title_font_color']); ?>;"><span>
              <?php the_title(); ?>
              </span></h1>
            <div class="blur_image"> <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>"> </div>
          </div>
          <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>"> </div>
        <?php }else{; ?>
        <div class="cf_header_no_image" id="staff_header_image">
          <h1 class="title rich_font" style="color:<?php echo esc_attr($options['single_staff_title_font_color']); ?>;"><span>
            <?php the_title(); ?>
            </span></h1>
        </div>
        <?php }; ?>
        <?php
       // Catch and description ------------------------------------------------------------------------------------------------------------------
       if($catch || $desc){
  ?>
        <div class="cf_catch">
          <?php if($catch){ ?>
          <h3 class="catch rich_font<?php if($catch_mobile) { echo ' has_mobile_word'; }; ?>" style="color:<?php echo esc_attr($catch_font_color); ?>;"<?php if($catch_mobile) { echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"'; }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h3>
          <?php }; ?>
          <?php if($desc) { ?>
          <div class="post_content clearfix"> <?php echo do_shortcode( wpautop(wp_kses_post($desc)) ); ?> </div>
          <?php }; ?>
        </div>
        <?php }; ?>
        <?php
       // Featured list --------------------------------------------------------------------------------------------------------------
       if(!empty($data_list)){
  ?>
        <div class="cf_data_list type2" style="background:<?php echo esc_attr($data_list_bg_color); ?>;">
          <?php if($data_list_headline) { ?>
          <h3 class="headline rich_font" style="color:<?php echo esc_attr($data_list_headline_font_color); ?>;"><?php echo nl2br(esc_html($data_list_headline)); ?></h3>
          <?php }; ?>
          <ul class="clearfix">
            <?php foreach ( $data_list as $key => $value ) : ?>
            <?php
         if(!empty($value['title'])){
           if(!empty($value['url'])){
    ?>
            <li><a href="<?php echo esc_url($value['url']); ?>"><?php echo wp_kses_post($value['title']); ?></a></li>
            <?php } else { ?>
            <li><?php echo wp_kses_post($value['title']); ?></li>
            <?php }; }; ?>
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
            <div class="post_content clearfix"> <?php echo do_shortcode( wpautop(wp_kses_post($value['content'])) ); ?> </div>
            <?php }; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php }; ?>
        <div class="doctor-wrapper">
		  <h3 class="headline">他の医師</h3>
          <?php
       // Pagination  --------------------------------------------------------------------------------------------------------------
			$prevpost = get_previous_post(); //前の記事
			$nextpost = get_next_post(); //次の記事
			if( $prevpost or $nextpost ){ //前の記事、次の記事いずれか存在しているとき
			?>
    	    <ul class="doctor-list">
			<?php
				if ( $prevpost ) { //前の記事が存在しているとき
					echo '<li><a href="' . get_permalink($prevpost->ID) . '"><div class="image-area">' . get_the_post_thumbnail($prevpost->ID, 'full') . '</div><div class="title-area rich_font">' . get_the_title($prevpost->ID) . '</div></a></li>';
				}

				if ( $nextpost ) { //次の記事が存在しているとき
					echo '<li><a href="' . get_permalink($nextpost->ID) . '"><div class="image-area">' . get_the_post_thumbnail($nextpost->ID, 'full') . '</div><div class="title-area rich_font">' . get_the_title($nextpost->ID) . '</div></a></li>';
				}
			?>
        	</ul>
	        <?php } ?>
        </div>  
      </article>
      <!-- END #article -->
      <?php endwhile; endif; ?>
    </div>
    <!-- END #single_staff -->
  </div>
  <!-- END #main_col -->
  <?php //サイドバー非表示対応 get_sidebar(); ?>
</div>
<!-- END #main_contents -->
<?php get_footer(); ?>
