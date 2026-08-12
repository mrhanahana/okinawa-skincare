<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="<?php echo wp_is_mobile() ? 'mobile' : 'pc'; ?>" <?php language_attributes(); ?>>
<?php if ($options['use_ogp']) { ?>

  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
  <?php } else { ?>

    <head>
    <?php }; ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="<?php seo_description(); ?>">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php
    if ($options['favicon']) {
      $favicon_image = wp_get_attachment_image_src($options['favicon'], 'full');
      if (!empty($favicon_image)) {
    ?>
        <link rel="shortcut icon" href="<?php echo esc_url($favicon_image[0]); ?>">
    <?php };
    }; ?>
    <?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all');
    wp_enqueue_script('jquery');
    if (is_singular()) wp_enqueue_script('comment-reply'); ?>
    <?php wp_head(); ?>

    <!-- Global site tag (gtag.js) - Google Analyticsssssssssssssssssssssssssssssssssss -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-240830134-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-240830134-1');
      gtag('config', 'AW-754298546');
    </script>
    <link rel="stylesheet" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css">
    <script src="https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js"></script>
    <script>
      window.addEventListener('DOMContentLoaded', function() {
        new ScrollHint('.js-scrollable', {
          i18n: {
            scrollable: 'スクロールできます'
          }
        });
      });
    </script>

    <!-- ギャラリー表示用CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css" />
    <!-- モーダルウィンドウ表示用CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css">

    <!-- Meta Pixel Code -->
    <script>
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '879874276520189');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=879874276520189&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Meta Pixel Code -->

    <!-- Event snippet for 通話ボタンをクリック conversion page -->
    <script>
      function gtag_tel_conversion(url) {
        var callback = function() {
          if (typeof(url) != 'undefined') {
            window.location = url;
          }
        };
        gtag('event', 'conversion', {
          'send_to': 'AW-754298546/EIMqCOOV58oYELLd1ucC',
          'event_callback': callback
        });

        // Facebook Pixel のカスタムイベントをトリガーします
        fbq('trackCustom', 'tel', {
          number: url
        });

        return false;
      }
    </script>
    </head>

  <body id="body" <?php body_class(); ?>>
    <?php
    if ($options['show_load_icon_only_front']) {
      if (is_front_page()) {
        load_icon();
      }
    } elseif ($options['use_load_icon']) {
      if (is_front_page() || is_home() || is_post_type_archive(array('news', 'service', 'faq', 'staff', 'column', 'campaign', 'clinic'))) {
        load_icon();
      }
    };
    ?>
    <div id="container">
      <header id="header">
        <div id="header_top">
          <h1 class="title">
            <div class="inner"><?php echo esc_html(wp_get_document_title()); ?></div>
          </h1>
          <div id="header_top_inner">
            <div id="header_logo">
              <?php header_logo(); ?>
            </div>
            <?php if (has_nav_menu('global-menu')) { ?>
              <a href="#" id="menu_button"><span>
                  <?php _e('menu', 'tcd-w'); ?>
                </span></a>
            <?php }; ?>
            <?php if ($options['show_header_button1'] || $options['show_header_button2']) { ?>
              <div id="header_button" class="clearfix">
                <?php
                for ($i = 1; $i <= 2; $i++):
                  if ($options['show_header_button' . $i]) {
                ?>
                    <div class="button button<?php echo $i; ?>"> <a href="<?php echo esc_url($options['header_button_url' . $i]); ?>" <?php if ($options['header_button_target' . $i]) {
                                                                                                                                        echo ' target="_blank"';
                                                                                                                                      }; ?>><?php echo esc_html($options['header_button_label' . $i]); ?></a> </div>
                    <!-- END .header_button -->
                <?php };
                endfor; ?>
              </div>
              <!-- END #header_button -->
            <?php }; ?>
          </div>
          <!-- END #header_top_inner -->
        </div>
        <!-- END #header_top -->

        <?php if (has_nav_menu('global-menu')) { ?>
          <nav id="global_menu">
            <?php wp_nav_menu(array('sort_column' => 'menu_order', 'theme_location' => 'global-menu', 'container' => '')); ?>
          </nav>
        <?php }; ?>
      </header>
      <?php get_template_part('template-parts/megamenu'); ?>
      <?php
      // Header contents -------------------------------------------------------------------------
      if (is_front_page()) {
      ?>
        <div id="header_slider_wrap">
          <?php
          // caption and overlay for video, youtube, para slider ------------------------------------
          if ($options['header_content_type'] == 'type2' || $options['header_content_type'] == 'type3' || $options['header_content_type'] == 'type4') {
            if ($options['show_header_catch'] == 1) {
              $catch = $options['header_catch'];
              $sub_title = $options['header_catch_sub_title'];
              $catch_mobile = $options['header_catch_mobile'];
              $sub_title_mobile = $options['header_catch_sub_title_mobile'];
              $font_type = $options['header_catch_font_type'];
              $show_button = $options['header_catch_show_button'];
              $url = $options['header_catch_button_url'];
              $target = $options['header_catch_button_target'];
              $button_label = $options['header_catch_button_label'];
          ?>
              <div class="caption<?php if ($options['header_content_type'] == 'type4') {
                                    echo ' para_slider_caption';
                                  }; ?>">
                <div class="caption_inner">
                  <?php if ($catch || $catch_mobile) { ?>
                    <h2 class="title rich_font_<?php echo esc_attr($font_type);
                                                if ($catch_mobile) {
                                                  echo ' has_mobile_word';
                                                }; ?>" <?php if ($catch_mobile) {
                                                          echo 'data-label="' .  nl2br(esc_html($catch_mobile)) . '"';
                                                        }; ?>><span><?php echo nl2br(esc_html($catch)); ?></span></h2>
                  <?php }; ?>
                  <?php if ($sub_title || $sub_title_mobile) { ?>
                    <p class="sub_title<?php if ($sub_title_mobile) {
                                          echo ' has_mobile_word';
                                        }; ?>" <?php if ($sub_title_mobile) {
                                                  echo ' data-label="' . nl2br(esc_html($sub_title_mobile)) . '"';
                                                }; ?>><span><?php echo nl2br(esc_html($sub_title)); ?></span></p>
                  <?php }; ?>
                  <?php if (($show_button == 1) && $url) { ?>
                    <a class="button" href="<?php echo esc_url($url); ?>" <?php if ($target == 1) {
                                                                            echo ' target="_blank"';
                                                                          }; ?>><span><?php echo esc_html($button_label); ?></span></a>
                  <?php }; ?>
                </div>
              </div>
              <!-- END .caption -->
            <?php
            }; // END header catch
            if ($options['use_header_overlay'] == 1) {
            ?>
              <div class="overlay<?php if ($options['use_header_overlay_gd']) {
                                    echo ' gradation';
                                  }; ?>"></div>
            <?php
            };
          } else if ($options['header_content_type'] == 'type1') {
            ?>
            <div class="header_slider_wrap_inner">
            <?php
          }; // END caption
            ?>
            <div id="header_slider" <?php if ($options['header_content_type'] == 'type4') {
                                      echo ' class="header_para_slider" data-slider-time="' . esc_attr($options['header_para_time']) . '"';
                                    } ?>>
              <?php
              // para_slider ***********************************************************************************************************************
              if ($options['header_content_type'] == 'type4') {
                for ($i = 1; $i <= 6; $i++):
                  $image_id = $options['header_para_image' . $i];
                  if (!empty($image_id)) {
                    $image = wp_get_attachment_image_src($image_id, 'full');
                    if (is_mobile()) {
                      $image_mobile = wp_get_attachment_image_src($options['header_para_image_mobile' . $i], 'full');
                      if ($image_mobile) {
                        $image = $image_mobile;
                      };
                    }
                    $image_url = $image[0];
              ?>
                    <div class="item item<?php echo $i; ?>">
                      <div class="image" style="background:url(<?php echo esc_attr($image_url); ?>) no-repeat center center; background-size:cover;"></div>
                    </div>
                    <!-- END .item -->
                  <?php
                  }; //if has image
                endfor;
                // Image slider ***********************************************************************************************************************
              } elseif ($options['header_content_type'] == 'type1') {
                for ($i = 1; $i <= 5; $i++):
                  $image_id = $options['header_slider_image' . $i];
                  if (!empty($image_id)) {
                    $image = wp_get_attachment_image_src($image_id, 'full');
                    if (is_mobile()) {
                      $image_mobile = wp_get_attachment_image_src($options['header_slider_image_mobile' . $i], 'full');
                      if ($image_mobile) {
                        $image = $image_mobile;
                      };
                    }
                    $image_url = $image[0];
                    $image_mobile_url = $image_mobile[0];
                    $animation_type = $options['header_slider_animation_type' . $i];
                    $show_catch = $options['header_slider_show_catch' . $i];
                    $catch = $options['header_slider_catch' . $i];
                    $sub_title = $options['header_slider_sub_title' . $i];
                    $catch_mobile = $options['header_slider_catch_mobile' . $i];
                    $sub_title_mobile = $options['header_slider_sub_title_mobile' . $i];
                    $font_type = $options['header_slider_catch_font_type' . $i];
                    $show_button = $options['header_slider_show_button' . $i];
                    $url = $options['header_slider_url' . $i];
                    $target = $options['header_slider_target' . $i];
                    $button_label = $options['header_slider_button_label' . $i];
                  ?>
                    <div class="item item<?php echo $i; ?> slick-slide animation_<?php echo esc_attr($animation_type); ?>">
                      <?php if ($show_catch == 1) { ?>
                        <div class="caption">
                          <div class="caption_inner">
                            <?php if ($catch) { ?>
                              <h2 class="title rich_font_<?php echo esc_attr($font_type);
                                                          if ($catch_mobile) {
                                                            echo ' has_mobile_word';
                                                          }; ?>" <?php if ($catch_mobile) {
                                                                    echo 'data-label="' .  nl2br(esc_html($catch_mobile)) . '"';
                                                                  }; ?>><span><?php echo nl2br(esc_html($catch)); ?></span></h2>
                            <?php }; ?>
                            <?php if ($sub_title) { ?>
                              <p class="sub_title<?php if ($sub_title_mobile) {
                                                    echo ' has_mobile_word';
                                                  }; ?>" <?php if ($sub_title_mobile) {
                                                            echo ' data-label="' . nl2br(esc_html($sub_title_mobile)) . '"';
                                                          }; ?>><span><?php echo nl2br(esc_html($sub_title)); ?></span></p>
                            <?php }; ?>
                            <?php if (($show_button == 1) && $url) { ?>
                              <a class="button" href="<?php echo esc_url($url); ?>" <?php if ($target == 1) {
                                                                                      echo ' target="_blank"';
                                                                                    }; ?>><span><?php echo esc_html($button_label); ?></span></a>
                            <?php }; ?>
                          </div>
                        </div>
                        <!-- END .caption -->
                      <?php }; // END show catch 
                      ?>
                      <?php
                      if ($options['header_slider_use_overlay' . $i] == 1) {
                        $overlay_color = hex2rgb($options['header_slider_overlay_color' . $i]);
                        $overlay_color = implode(",", $overlay_color);
                        $overlay_opacity = $options['header_slider_overlay_opacity' . $i];
                      ?>
                        <div class="overlay" style="background-color:rgba(<?php echo $overlay_color; ?>,<?php echo $overlay_opacity; ?>);"></div>
                      <?php }; ?>
                      <!--
        <?php // if ( ( $show_button == 0 ) && $url ) { 
        ?>
        <a href = "<?php // echo esc_url($url); 
                    ?>" <?php // if($target == 1) { echo ' target="_blank"'; }; 
                        ?>>
        <?php // }; 
        ?>
        <img src="<?php // echo esc_attr($image_url); 
                  ?>" class="pc" /> <img src="<?php // echo esc_attr($image_mobile_url); 
                                              ?>" class="sp" />
        <?php // if ( ( $show_button == 0 ) && $url ) { 
        ?>
        </a>
        <?php // }; 
        ?>
				-->
                      <div class="image" style="background:url(<?php echo esc_attr($image_url); ?>) no-repeat center center; background-size:cover;"></div>
                    </div>
                    <!-- END .item -->
                <?php
                  }; //if has image
                endfor;
                ?>
            </div>
            <div class="caption fixed">
              <div class="caption_inner">
                <h2 class="title rich_font_type3"><span>「より美しく、より華やかに」</span></h2>
                <p class="sub_title rich_font_type3"><span>患者様に寄り添うクリニック</span></p>
              </div>
            </div>
            <?php
                // video ***********************************************************************************************************************
              } elseif ($options['header_content_type'] == 'type2') {
                if ($options['header_video'] && !wp_is_mobile()) { // if is pc
                  $video_url = wp_get_attachment_url($options['header_video']);
                  if ($video_url) {
            ?>
                <video id="header_video" src="<?php echo esc_url($video_url); ?>" playsinline autoplay loop muted></video>
              <?php
                  }; // END if has video
                } else { // if is mobile device ----------------------------------------------
                  $image_id = $options['header_video_image'];
                  if ($image_id) {
                    $image = wp_get_attachment_image_src($image_id, 'full');
                  };
                  if (!empty($image_id)) {
              ?>
                <div class="item" style="opacity:1; background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div>
                <!-- END .item -->
              <?php
                  }; // END if has image
                }; // END mobile device

                // Youtube *******************************************************************************************************************
              } elseif ($options['header_content_type'] == 'type3') {
                if (!wp_is_mobile()) { // if is pc
                  $youtube_url = $options['header_youtube_url'];
                  if (!empty($youtube_url)) {
              ?>
                <div id="youtube_video_player" class="player" data-property="{videoURL:'<?php echo esc_url($youtube_url); ?>', containment:'#header_slider', optimizeDisplay:true, startAt:0, mute:true, autoPlay:true, loop:true, opacity:1, showControls:false}"></div>
              <?php
                  }; // END if has video
                } else { // if is mobile device ----------------------------------------------
                  $image_id = $options['header_youtube_image'];
                  if ($image_id) {
                    $image = wp_get_attachment_image_src($image_id, 'full');
                  };
                  if (!empty($image_id)) {
              ?>
                <div class="item" style="opacity:1; background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div>
                <!-- END .item -->
          <?php
                  }; // END if has image
                }; // END mobile device
              }; // END header content type
          ?>
            </div>
            <!-- END #header_slider -->
        </div>
        <!-- END #header_slider_wrap -->

      <?php }; // END if is front page 
      ?>

      <?php
      // side button --------------------------------------------------------------------
      if ($options['show_index_side_button'] == 1) {
      ?>
        <div id="index_side_button" class="<?php echo esc_attr($options['index_side_button_direction']); ?>"> <a href="<?php echo esc_url($options['index_side_button_url']); ?>"><span><?php echo esc_html($options['index_side_button']); ?></span></a> </div>
      <?php }; ?>