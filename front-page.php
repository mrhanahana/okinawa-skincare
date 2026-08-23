<?php
$options = get_design_plus_option();
get_header('');
?>

<section class="campaign">
  <div class="campaign__wrap">
    <?php
    $post_num = $options['index_campaign_num'];
    $args = array('post_type' => 'campaign', 'posts_per_page' => $post_num);
    $campaign_query = new WP_Query($args);
    if ($campaign_query->have_posts()):
      // slider -----
    ?>

      <h2 class="heading gold">Campaign</h2>
      <div id="index_campaign_slider_top" class="clearfix">

        <?php
        $i = 1;
        while ($campaign_query->have_posts()): $campaign_query->the_post();
          if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'size2');
          } elseif ($options['no_image2']) {
            $image = wp_get_attachment_image_src($options['no_image2'], 'full');
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
          }
        ?>
          <article class="item item<?php echo $i; ?> clearfix">
            <a class="link animate_background" href="<?php the_permalink() ?>" style="background:none;">
              <div class="top_area">
                <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
              </div>
            </a>
          </article>
        <?php $i++;
        endwhile; ?>
      </div>
    <?php endif;
    wp_reset_query(); ?>
  </div>
</section>

<section class="search">
  <div class="content-wrap">
    <h2 class="heading">Menu</h2>
    <div class="info flexC">
      <div class="trouble">
        <div>
          <div class="search__heading">
            <h3 class="headLine">お悩みから探す</h3>
            <a href="#" class="viewMore">
              <span>VIEW MORE</span>
              <span class="viewMore__arrow" aria-hidden="true"></span>
            </a>
          </div>
          <?php
          $trouble_terms = theme_get_ordered_terms(
            'service_concern',
            [
              'hide_empty' => false,
            ]
          );
          ?>

          <?php if (!is_wp_error($trouble_terms) && !empty($trouble_terms)) : ?>

            <ul class="troubleList">

              <?php foreach ($trouble_terms as $term) : ?>

                <?php
                // ターム画像URL
                $image_url = theme_get_term_image_url(
                  $term->term_id,
                  'service_concern'
                );

                // タームページURL
                $term_link = get_term_link($term);
                ?>

                <li>

                  <a href="<?php echo esc_url($term_link); ?>">

                    <?php if ($image_url) : ?>

                      <div class="icon">

                        <img
                          src="<?php echo esc_url($image_url); ?>"
                          alt="<?php echo esc_attr($term->name); ?>">

                      </div>

                    <?php endif; ?>

                    <div class="title">
                      <?php echo esc_html($term->name); ?>
                    </div>

                  </a>

                </li>

              <?php endforeach; ?>

            </ul>

          <?php endif; ?>
        </div>
      </div>
      <div class="treatment">
        <div>
          <div class="search__heading">
            <h3 class="headLine">施術から探す</h3>
            <a href="#" class="viewMore">
              <span>VIEW MORE</span>
              <span class="viewMore__arrow" aria-hidden="true"></span>
            </a>
          </div>
          <ul class="treatmentList">
            <li>
              <div class="title" data-popup="popup-a">機械治療</div>
              <div id="popup-a" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Mechanical Treatment">機械治療</h4>
                  <ul class="treatmentItem">
                    <li><a href="">ノーリス</a></li>
                    <li><a href="">Ｑスイッチレーザー</a></li>
                    <li><a href="">ＣＯ２レーザー</a></li>
                    <li><a href="">トーニング</a></li>
                    <li><a href="">ダーマペン</a></li>
                    <li><a href="">レーザーフェイシャル</a></li>
                    <li><a href="">水光注射</a></li>
                    <li><a href="">ハイフ</a></li>
                    <li><a href="">ハイドラフェイシャル</a></li>
                    <li><a href="">エレクトロポレーション</a></li>
                    <li><a href="">イオン導入</a></li>
                    <li><a href="">オムニラックス</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <div class="title" data-popup="popup-b">注入治療</div>
              <div id="popup-b" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Injection Treatment">注入治療</h4>
                  <ul class="treatmentItem">
                    <li><a href="">ボツリヌストキシン注（韓国製剤）</a></li>
                    <li><a href="">ヒアルロン酸注射（アラガン社）</a></li>
                    <li><a href="">脂肪溶解注射（カベリン）</a></li>
                    <li><a href="">肌育注射</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <div class="title" data-popup="popup-c">美肌治療</div>
              <div id="popup-c" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Skin Treatment">美肌治療</h4>
                  <ul class="treatmentItem">
                    <li><a href="">ピーリング</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <div class="title" data-popup="popup-d">糸リフト</div>
              <div id="popup-d" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Thread Lift">糸リフト</h4>
                  <ul class="treatmentItem">
                    <li><a href="">テスリフト</a></li>
                    <li><a href="">ＱＴＬ</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <div class="title" data-popup="popup-e">脱毛</div>
              <div id="popup-e" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Hair Removal">脱毛</h4>
                  <ul class="treatmentItem">
                    <li><a href="">医療脱毛</a></li>
                    <li><a href="">メンズ医療脱毛</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li> <a class="title" href="">点滴・注射</a> </li>
            <li>
              <div class="title" data-popup="popup-f">ダイエット</div>
              <div id="popup-f" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Diet">ダイエット</h4>
                  <ul class="treatmentItem">
                    <li><a href="">GLP1ダイエット</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li> <a class="title" href="">アートメイク</a> </li>
            <li>
              <div class="title" data-popup="popup-g">薄毛治療</div>
              <div id="popup-g" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Hair Loss Treatment">薄毛治療</h4>
                  <ul class="treatmentItem">
                    <li><a href="">男性の薄毛治療</a></li>
                    <li><a href="">女性の薄毛治療</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <div class="title" data-popup="popup-h">ピアス</div>
              <div id="popup-h" class="popup popup-hidden">
                <div class="popup-overlay"></div>
                <div class="popup-content">
                  <button class="popup-close" aria-label="閉じる"></button>
                  <h4 class="heading-en center" data-en="Piercing">ピアス</h4>
                  <ul class="treatmentItem">
                    <li><a href="">軟骨ピアス</a></li>
                    <li><a href="">耳たぶ</a></li>
                    <li><a href="">ボディーピアス</a></li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>








</div>
<!-- END #index_content -->

<?php get_footer('test'); ?>