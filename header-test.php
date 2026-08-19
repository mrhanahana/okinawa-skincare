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

    <!-- Global site tag (gtag.js) - Google Analytics -->
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

    <div id="container">