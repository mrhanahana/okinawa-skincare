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








</div>
<!-- END #index_content -->

<?php get_footer('test'); ?>