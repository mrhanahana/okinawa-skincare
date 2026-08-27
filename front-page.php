<?php
$options = get_design_plus_option();
get_header();
?>

<section class="home-campaign">
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

<section class="home-search">
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

          // serviceの施術一覧ページURL
          $service_archive_url = get_post_type_archive_link('service');
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

                // 施術一覧ページ内のリンクURL
                $internal_link =
                  $service_archive_url
                  . '#'
                  . $term->slug;
                ?>

                <li>

                  <a href="<?php echo esc_url($internal_link); ?>">

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
          <?php
          $taxonomy = 'service_treatment';

          $treatment_english_names = [
            '機械治療'     => 'Mechanical Treatment',
            '注入治療'     => 'Injection Treatment',
            '美肌治療'     => 'Skin Treatment',
            '糸リフト'     => 'Thread Lift',
            '脱毛'         => 'Hair Removal',
            '点滴・注射'   => 'IV Drip / Injection',
            'ダイエット'   => 'Diet',
            'アートメイク' => 'Permanent Makeup',
            '薄毛治療'     => 'Hair Loss Treatment',
            'ピアス'       => 'Piercing',
          ];

          $taxonomy = 'service_treatment';

          $treatment_terms = theme_get_ordered_terms($taxonomy, [
            'hide_empty' => true,
          ]);

          ?>

          <?php if (!is_wp_error($treatment_terms) && !empty($treatment_terms)) : ?>

            <ul class="treatmentList">

              <?php foreach ($treatment_terms as $term) : ?>
                <?php
                // popup-タームスラッグ
                $popup_id = 'popup-' . $term->slug;

                $english_name = $treatment_english_names[$term->name] ?? '';

                $service_query = new WP_Query([
                  'post_type'      => 'service',
                  'post_status'    => 'publish',
                  'posts_per_page' => -1,
                  'orderby'        => [
                    'menu_order' => 'ASC',
                    'date'       => 'DESC',
                  ],
                  'tax_query'      => [
                    [
                      'taxonomy' => $taxonomy,
                      'field'    => 'term_id',
                      'terms'    => $term->term_id,
                    ],
                  ],
                ]);
                ?>

                <?php if ($service_query->have_posts()) : ?>

                  <?php if ($service_query->post_count === 1) : ?>
                    <?php
                    // 投稿が1件だけの場合は、その記事へ直接リンク
                    $single_service = $service_query->posts[0];
                    ?>

                    <li>
                      <a
                        class="title"
                        href="<?php echo esc_url(get_permalink($single_service->ID)); ?>">
                        <?php echo esc_html($term->name); ?>
                      </a>
                    </li>

                  <?php else : ?>

                    <li>
                      <div
                        class="title"
                        data-popup="<?php echo esc_attr($popup_id); ?>">
                        <?php echo esc_html($term->name); ?>
                      </div>

                      <div
                        id="<?php echo esc_attr($popup_id); ?>"
                        class="popup popup-hidden">
                        <div class="popup-overlay"></div>

                        <div class="popup-content">
                          <button
                            type="button"
                            class="popup-close"
                            aria-label="閉じる"></button>

                          <h4
                            class="heading-en center"
                            data-en="<?php echo esc_attr($english_name); ?>">
                            <?php echo esc_html($term->name); ?>
                          </h4>

                          <ul class="treatmentItem">

                            <?php while ($service_query->have_posts()) : ?>
                              <?php $service_query->the_post(); ?>

                              <li>
                                <a href="<?php the_permalink(); ?>">
                                  <?php the_title(); ?>
                                </a>
                              </li>

                            <?php endwhile; ?>

                          </ul>
                        </div>
                      </div>
                    </li>
                  <?php endif; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-concept">
  <div class="content-wrap">
    <div class="concept__content">
      <h2 class="heading gold">Concept</h2>
      <div class="concept__text">
        <h3 class="rich_font">肌に寄り添い、美しさを育む。<br />
          安心と上質を備えた美容医療を。</h3>
        <p>当院では、レーザー治療専門医が患者様一人ひとりのお悩みやご希望に寄り添い、丁寧なカウンセリングをもとに、適切な美容医療をご提案します。</p>
        <p>美容皮膚科から医療脱毛まで、効果と安全性に配慮した多彩な施術をご用意。さまざまな肌のお悩みに、ワンストップでお応えします。</p>
        <p>院内はプライバシーに配慮した完全個室です。周囲を気にせず、心からくつろいで施術を受けていただける、上質で居心地の良い空間を整えています。</p>
        <a href="/about/" class="button-more right mt50">Read More</a>
      </div>
      <div class="concept__image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/img_concept.webp" /></div>
    </div>
  </div>
</section>

<section class="home-doctor">
  <div class="content-wrap">
    <h2 class="heading gold">Doctor</h2>
    <div class="doctor-image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/img_y.maeda.webp" alt="前田由紀" /></div>
    <div class="doctor-content">
      <p class="doctor-catch rich_font_type3">患者様一人ひとりに、<br class="sp" />本当に必要な美容医療を。</p>
      <p class="doctor-message">「見た目」は、単なる整容にとどまらず、心も整えてくれる大切な要素といえます。にきびや肌荒れといった肌トラブルからエイジングサインのしみ・しわ・たるみ・赤みまで、あらゆる年代でQuality Of Lifeに関係しています。</p>
      <p class="doctor-message">見た目の老化メカニズムは解明が進み、美容医療の質も年々上がっています。その反面、数多くの治療や治療機器があることから、どの治療が自分の症状にあっているのかわからないと相談に来られる方が多くおられます。</p>
      <p class="doctor-message">皆様の悩みに寄り添いながら、しっかりとコミュニケーションをとり、より良い治療と適正な料金で美容診療にあたります。安心して皆様からお気軽にご相談を頂けるように診療に努めてまいります。どうぞよろしくお願いいたします。</p>
      <div class="doctor-sign">
        <div class="doctor-sign-name">
          <div class="position">沖縄スキンケアクリニック 院長</div>
          <div class="doctor-name rich_font">前田 由紀</div>
        </div>
        <div class="sign">Yuki Maeda</div>
      </div>
      <a href="/about/" class="button-more right mt50">Read More</a>
    </div>
    <aside class="doctor-profile">
      <div class="item">
        <div class="title">経歴</div>
        <ul>
          <li>大阪府出身</li>
          <li>大阪市立大学 医学部卒業</li>
          <li>大阪市立大学 医学部付属病院形成外科 勤務</li>
          <li>東京都内 レーザー専門総合病院 美容皮膚科 勤務</li>
          <li>沖縄スキンケアクリニック 院長</li>
        </ul>
      </div>
      <div class="item">
        <div class="title">所属学会</div>
        <ul>
          <li>日本形成外科学会</li>
          <li>日本皮膚科学会</li>
          <li>日本美容皮膚科学会</li>
          <li>日本レーザー医学会</li>
          <li>日本レーザー治療学会</li>
          <li>日本抗加齢医学会</li>
        </ul>
      </div>
      <div class="item">
        <div class="title">免許</div>
        <ul>
          <li>医師免許</li>
          <li>日本形成外科学会 形成外科専門医</li>
          <li>日本レーザー医学会 レーザー専門医</li>
          <li>日本レーザー医学会 レーザー指導医</li>
          <li>抗加齢医学会専門医</li>
          <li>日本形成外科学会 レーザー分野指導医</li>
        </ul>
      </div>
    </aside>
  </div>
</section>

<section class="home-news">
  <div class="content-wrap">
    <div id="news_header_list">
      <?php
      $post_num = 5;
      $news_query = new WP_Query('post_type=news&posts_per_page=' . $post_num);
      if ($news_query->have_posts()):
      ?>
        <ul>
          <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
            <li> <a href="<?php the_permalink() ?>">
                <p class="date" style="color:<?php echo esc_attr($options['index_news_date_color']); ?>;">
                  <time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>">
                    <?php the_time('Y.m.j'); ?>
                  </time>
                </p>
                <h4 class="title"><span>
                    <?php the_title(); ?>
                  </span></h4>
              </a> </li>
          <?php endwhile;  ?>
        </ul>
      <?php endif;
      wp_reset_query(); ?>
    </div>
  </div>
</section>


<!-- javaScriptエラー回避のため挿入 -->
<div id="index_box_content"></div>

</div>
<!-- END #index_content -->

<?php get_footer(); ?>