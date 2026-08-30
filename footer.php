<footer>
  <div class="footer__inner">
    <div class="footer__main">
      <h2 class="footer__logo"> <span class="footer__logo-reader">那覇市の美容皮膚科｜沖縄スキンケアクリニック</span> <a href="<?php echo home_url(); ?>"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/img_logo_mark.svg" alt="<?php bloginfo('name'); ?>" class="link"> </a></h2>
      <dl class="footer__desc">
        <dt class="footer__label">完全予約制</dt>
        <dd class="footer__about">沖縄スキンケアクリニック<br>
          美容皮膚科・美容外科</dd>
      </dl>
      <nav class="footer__nav utility-nav" aria-label="フッター関連リンク">
        <ul class="utility-nav__list">
          <li class="utility-nav__item">
            <a
              href="https://www.instagram.com/okinawa_skincare_clinic/"
              target="_blank"
              rel="noopener noreferrer">
              <i class="fa-brands fa-instagram" aria-hidden="true"></i>
              <span>Instagram</span>
            </a>
          </li>

          <li class="utility-nav__item">
            <a
              href="https://line.me/R/ti/p/@401dbayd"
              target="_blank"
              rel="noopener noreferrer">
              <i class="fa-brands fa-line" aria-hidden="true"></i>
              <span>公式LINE</span>
            </a>
          </li>

          <li class="utility-nav__item">
            <a href="/about/#access">
              <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
              <span>アクセス</span>
            </a>
          </li>

          <li class="utility-nav__item">
            <a href="/recruit/">
              <i class="fa-solid fa-file-pen" aria-hidden="true"></i>
              <span>親権者同意書</span>
            </a>
          </li>
        </ul>
      </nav>
      <section class="footer__cta reservation-info" aria-labelledby="footer-reservation-title">
        <div class="reservation-info__inner">
          <div id="footer-reservation-title" class="reservation-info__title">
            ご予約・お問い合わせ
          </div>

          <p class="reservation-info__text">
            ご予約はWEBまたはお電話にて承っております。
          </p>

          <div class="reservation-info__buttons">
            <a href="/reserve/" class="reservation-info__button is-web">
              <i class="fa-regular fa-calendar" aria-hidden="true"></i>
              <span>WEB予約</span>
            </a>

            <a href="tel:0988601001" class="reservation-info__button is-tel">
              <i class="fa-solid fa-phone" aria-hidden="true"></i>
              <span>098-860-1001</span>
            </a>
          </div>

          <div class="reservation-info__schedule">
            <table>
              <caption class="screen-reader-text">診療時間</caption>
              <thead>
                <tr>
                  <th scope="col">診療時間</th>
                  <th scope="col">月</th>
                  <th scope="col">火</th>
                  <th scope="col">水</th>
                  <th scope="col">木</th>
                  <th scope="col">金</th>
                  <th scope="col">土</th>
                  <th scope="col">日</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">10:00〜19:00</th>
                  <td><span class="schedule-open">●</span></td>
                  <td><span class="schedule-open">●</span></td>
                  <td><span class="schedule-close">／</span></td>
                  <td><span class="schedule-close">／</span></td>
                  <td><span class="schedule-open">●</span></td>
                  <td><span class="schedule-open">●</span></td>
                  <td><span class="schedule-open">●</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
    <div class="footer__sub">
      <?php if (!is_mobile()) { ?>
        <div class="pagetop">
          <a href="#body"><span>PAGE TOP</span></a>
        </div>
      <?php }; ?>
      <div class="footer_copyright">© OKINAWA SKINCARE CLINIC</div>
    </div>
  </div>
</footer>



<?php $options = get_design_plus_option(); ?>

<?php
// footer button ------------------------------------------
if ((is_mobile() && $options['show_footer_button1']) || (is_mobile() && $options['show_footer_button2'])) {
  if ($options['footer_content_type'] == 'type2') {
?>
    <div id="footer_button">
      <?php
      for ($i = 1; $i <= 2; $i++) :
        if ($options['show_footer_button' . $i]) {
      ?>
          <div class="button button<?php echo $i; ?>">
            <a href="<?php echo esc_url($options['footer_button_url' . $i]); ?>" <?php if ($options['footer_button_target' . $i]) {
                                                                                    echo ' target="_blank"';
                                                                                  }; ?>><?php echo esc_html($options['footer_button_label' . $i]); ?></a>
          </div>
      <?php };
      endfor; ?>
    </div><!-- END #footer_button -->
  <?php  }
} elseif ($options['show_header_button1'] || $options['show_header_button2']) {
  if (!is_mobile()) {
  ?>
    <div id="footer_button">
      <?php
      for ($i = 1; $i <= 2; $i++) :
        if ($options['show_header_button' . $i]) {
      ?>
          <div class="button button<?php echo $i; ?>">
            <a href="<?php echo esc_url($options['header_button_url' . $i]); ?>" <?php if ($options['header_button_target' . $i]) {
                                                                                    echo ' target="_blank"';
                                                                                  }; ?>><?php echo esc_html($options['header_button_label' . $i]); ?></a>
          </div>
      <?php };
      endfor; ?>
    </div><!-- END #footer_button -->
<?php };
}; ?>

<?php
// footer bar for mobile device -------------------
if (is_mobile()) {
  if ($options['footer_content_type'] == 'type3') {
    get_template_part('template-parts/footer-bar');
  }
};
?>

</div><!-- #container -->

<div class="float-button__wrap"><a href="/reserve/">ご予約は<br>
    こちら</a>
  <div class="circleTextWrap">
    <svg class="circleText" viewBox="0 0 100 100">
      <path id="circle" class="circleText__circle" d="M 0 50 A 50 50 0 1 1 0 51 z" />
      <text class="circleText__text">
        <textPath xlink:href="#circle">OKINAWA SKINCARE CLINIC — RESERVATION — </textPath>
      </text>
    </svg>
  </div>
</div>

<div class="drawer-overlay"></div>
<nav id="drawer-nav">
  <?php
  wp_nav_menu(array(
    'theme_location' => 'drawer-nav',
    'container' => false,
    'items_wrap' => '<ul id="drawernavul" class="menu">%3$s</ul>',
  ));
  ?>
</nav>

<?php
// load script -----------------------------------------------------------
if ($options['show_load_icon_only_front']) {
  if (is_front_page()) {
    has_loading_screen();
  } else {
    no_loading_screen();
  }
} elseif ($options['use_load_icon']) {
  if (is_front_page() || is_home() || is_post_type_archive(array('news', 'service', 'faq', 'staff', 'column', 'campaign', 'clinic'))) {
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
if (is_single() && ($options['show_sns_top'] || $options['show_sns_btm'])) :
  if ('type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm']) :
    if ($options['show_twitter_top'] || $options['show_twitter_btm']) :
?>
      <script>
        ! function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0],
            p = /^http:/.test(d.location) ? 'http' : 'https';
          if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
          }
        }(document, 'script', 'twitter-wjs');
      </script>
    <?php
    endif;
    if ($options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm']) :
    ?>
      <!-- facebook share button code -->
      <div id="fb-root"></div>
      <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s);
          js.id = id;
          js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
    <?php
    endif;
    if ($options['show_hatena_top'] || $options['show_hatena_btm']) :
    ?>
      <script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
    <?php
    endif;
    if ($options['show_pocket_top'] || $options['show_pocket_btm']) :
    ?>
      <script type="text/javascript">
        ! function(d, i) {
          if (!d.getElementById(i)) {
            var j = d.createElement("script");
            j.id = i;
            j.src = "https://widgets.getpocket.com/v1/j/btn.js?v=1";
            var w = d.getElementById(i);
            d.body.appendChild(j);
          }
        }(document, "pocket-btn-js");
      </script>
    <?php
    endif;
    if ($options['show_pinterest_top'] || $options['show_pinterest_btm']) :
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
if (mb_strstr($browser, 'trident') || mb_strstr($browser, 'msie')) {
?>
  <script src="<?php echo get_template_directory_uri(); ?>/js/blurify.min.js?ver=<?php echo version_num(); ?>"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/ofi.min.js?ver=<?php echo version_num(); ?>"></script>
  <script>
    (function() {
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



<!-- ギャラリー表示用スクリプト -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.min.js"></script>
<script src="https://wp-test.okinawa-skincare.com/js/gallery.js"></script>
<script src="https://wp-test.okinawa-skincare.com/js/common.js?<?php echo date('YmdHis'); ?>"></script>
</body>

</html>