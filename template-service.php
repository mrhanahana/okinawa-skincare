<?php
/*
Template Name: 施術メニュー
Template Post Type: service
*/
?>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

<div id="service_contents" class="clearfix">

 <div id="service_main" class="clearfix">

 <div id="single_service">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $title = get_post_meta($post->ID, 'service_title', true);
        $subtitle = get_post_meta($post->ID, 'service_subtitle', true);
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

  <div id="template_service_title_area">

   <?php if($subtitle){ ?><div class="subtitle"><span><?php echo wp_kses_post(nl2br($subtitle)); ?></span></div><?php }; ?>
   <?php if($title){ ?>
     <div class="title rich_font" style="color:<?php echo esc_attr($options['single_service_title_font_color']); ?>;"><span><?php echo wp_kses_post(nl2br($title)); ?></span></div>
   <?php } else { ?>
     <div class="title rich_font" style="color:<?php echo esc_attr($options['single_service_title_font_color']); ?>;"><span><?php the_title(); ?></span></div>
   <?php }; ?>
   <?php
       if($options['single_show_service_img'] && has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
   ?>
   <div class="eyecatch"><img src="<?php echo esc_attr($image[0]); ?>" ></div>
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
  <div class="bg_data_list">
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
    <div class="service_btn_area">
      <div class="btn tel"><a href="#tel_footer" onclick="gtag_tel_conversion('tel:098-861-1010')">電話でお問い合わせ</a></div>
      <div class="btn mail"><a href="/reserve/">ご予約はこちら</a></div>
    </div>
  </div>
  <?php }; ?>

  <?php
    remove_filter('the_content', 'wpautop');
	the_content();
  ?>

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

  <?php
 	$tag_list = array();
   	if ($terms = get_the_terms($post->ID, 'tag_service')) {
   		foreach ( $terms as $term ) {
			array_push($tag_list, esc_html($term->name));
   		}
   	}

	$args = [
		'post_type' => 'service',
		'tax_query' => [
			[
				'taxonomy' => 'tag_service',
				'field' => 'slug',
				'terms' => $tag_list,
				'operator' => 'IN',
			]
		],
	];
	$the_query = new WP_Query($args);
	if($the_query->post_count >= 2){
  ?>
  <div id="related" class="scroll-point bg_gray">
    <div class="cf_content_wrapper">
      <div id="template_service_title_area">
        <div class="subtitle"><span>Related treatments</span></div>
        <div class="title rich_font"><span>関連する施術</span></div>
        <div class="desc">患者さまのご希望に合わせて、様々な施術をご用意しております。</div>
      </div>
	  <ul class="taglist">
 	  <?php
    	if ($terms) {
    		foreach ( $terms as $term ) {
    			echo '<li>' . esc_html($term->name) . '</li>';
    		}
    	}
      ?>
	  </ul>
	  <ul class="related_list">
	  <?php
		$count = 0;
		$this_id = get_the_ID();
		while ( $the_query->have_posts() ) : $the_query->the_post(); 
		$post_id = get_the_ID();
	    if ( $this_id != $post_id ){
			$count++;
			if ($count % 2 == 0) {
				$num = '02';
			} else if ($count % 3 == 0) {
				$num = '03';
				$count = 0;
			} else {
				$num = '01';
			}
			$title = get_post_meta($post->ID, 'service_title', true);
			$summary = get_post_meta($post->ID, 'service_summary', true);
	  ?>
        <li class="fadeUpTrigger delay-time<?php echo $num; ?>">
          <a href="<?php the_permalink(); ?>">
            <h3>
              <?php if($title){ ?>
				<?php echo wp_kses_post(nl2br($title)); ?>
			  <?php } else { ?>
				<?php the_title(); ?>
			  <?php }; ?>
            </h3>
            <p><?php echo $summary; ?></p>
            <div class="more">Read More</div>
          </a>
        </li>
      <?php } endwhile; ?>
      <?php } ?>
	  </ul>
    </div>
  </div>
  <div class="scroll-point"></div>
 </article><!-- END #article -->

 <?php endwhile; endif; ?>
 </div><!-- END #single_service -->

 </div><!-- END #main_col -->

</div><!-- END #main_contents -->

<?php get_footer(); ?>