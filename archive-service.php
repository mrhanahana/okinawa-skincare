<?php
get_header();

$options      = get_design_plus_option();
$catch        = $options['service_catch'];
$desc         = $options['service_desc'];
$catch_mobile = $options['service_catch_mobile'];
$desc_mobile  = $options['service_desc_mobile'];
$image_id     = $options['service_bg_image'];
$image        = false;

if (!empty($image_id)) {
  $image = wp_get_attachment_image_src($image_id, 'full');

  if (is_mobile()) {
    $image_mobile = wp_get_attachment_image_src(
      $options['service_bg_image_mobile'],
      'full'
    );

    if ($image_mobile) {
      $image = $image_mobile;
    }
  }
}

$use_overlay = $options['service_use_overlay'];

if ($use_overlay) {
  $overlay_color   = hex2rgb($options['service_overlay_color']);
  $overlay_color   = implode(',', $overlay_color);
  $overlay_opacity = $options['service_overlay_opacity'];
}
?>

<?php if (!empty($image_id) && !empty($image[0])) : ?>
  <div
    id="page_header"
    style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;">
  <?php else : ?>
    <div
      id="page_header"
      style="background:<?php echo esc_attr($options['service_bg_color']); ?>;">
    <?php endif; ?>

    <div id="page_header_inner">
      <div id="page_header_catch">

        <?php if ($catch) : ?>
          <div
            class="catch rich_font<?php echo $catch_mobile ? ' has_mobile_word' : ''; ?>"
            <?php if ($catch_mobile) : ?>
            data-label="<?php echo esc_attr($catch_mobile); ?>"
            <?php endif; ?>>
            <span><?php echo wp_kses_post(nl2br($catch)); ?></span>
          </div>
        <?php endif; ?>

        <?php if ($desc) : ?>
          <p
            class="desc<?php echo $desc_mobile ? ' has_mobile_word' : ''; ?>"
            <?php if ($desc_mobile) : ?>
            data-label="<?php echo esc_attr($desc_mobile); ?>"
            <?php endif; ?>>
            <span><?php echo nl2br(esc_html($desc)); ?></span>
          </p>
        <?php endif; ?>

      </div>
    </div>

    <?php if ($use_overlay) : ?>
      <div
        class="overlay"
        style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
    <?php endif; ?>

    </div>

    <div id="archive_service">

      <?php
      /* ========================================================
   * お悩みから探す
   * ====================================================== */
      $concern_terms = theme_get_ordered_terms(
        'service_concern',
        [
          'hide_empty' => true,
        ]
      );
      ?>

      <?php if (!is_wp_error($concern_terms) && !empty($concern_terms)) : ?>
        <section class="service_archive_section service_archive_concern">
          <h2 id="service_concern" class="service_archive_heading rich_font">お悩みから探す</h2>

          <div class="service_archive_groups">

            <?php foreach ($concern_terms as $term) : ?>
              <?php
              $concern_query = new WP_Query([
                'post_type'      => 'service',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => [
                  'menu_order' => 'ASC',
                  'date'       => 'DESC',
                ],
                'tax_query'      => [
                  [
                    'taxonomy' => 'service_concern',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                  ],
                ],
              ]);
              ?>

              <?php if ($concern_query->have_posts()) : ?>
                <article
                  id="<?php echo esc_attr($term->slug); ?>"
                  class="service_archive_group service_archive_group_concern">
                  <h3 class="service_archive_term_title rich_font">
                    <?php echo esc_html($term->name); ?>
                  </h3>

                  <ul class="service_archive_list">
                    <?php while ($concern_query->have_posts()) : ?>
                      <?php $concern_query->the_post(); ?>
                      <li>
                        <a href="<?php the_permalink(); ?>">
                          <?php the_title(); ?>
                        </a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                </article>
              <?php endif; ?>

              <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>

          </div>
        </section>
      <?php endif; ?>


      <?php
      /* ========================================================
   * 施術から探す
   * ====================================================== */
      $treatment_terms = theme_get_ordered_terms(
        'service_treatment',
        [
          'hide_empty' => true,
        ]
      );
      ?>

      <?php if (!is_wp_error($treatment_terms) && !empty($treatment_terms)) : ?>
        <section class="service_archive_section service_archive_treatment">
          <h2 id="service_treatment" class="service_archive_heading rich_font">施術から探す</h2>

          <div class="service_archive_groups">

            <?php foreach ($treatment_terms as $term) : ?>
              <?php
              $treatment_query = new WP_Query([
                'post_type'      => 'service',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'orderby'        => [
                  'menu_order' => 'ASC',
                  'date'       => 'DESC',
                ],
                'tax_query'      => [
                  [
                    'taxonomy' => 'service_treatment',
                    'field'    => 'term_id',
                    'terms'    => $term->term_id,
                  ],
                ],
              ]);
              ?>

              <?php if ($treatment_query->have_posts()) : ?>
                <article class="service_archive_group service_archive_group_treatment">
                  <h3 class="service_archive_term_title rich_font">
                    <?php echo esc_html($term->name); ?>
                  </h3>

                  <ul class="service_archive_list">
                    <?php while ($treatment_query->have_posts()) : ?>
                      <?php $treatment_query->the_post(); ?>
                      <li>
                        <a href="<?php the_permalink(); ?>">
                          <?php the_title(); ?>
                        </a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                </article>
              <?php endif; ?>

              <?php wp_reset_postdata(); ?>
            <?php endforeach; ?>

          </div>
        </section>
      <?php endif; ?>


      <?php
      /* ========================================================
   * その他
   * service_concern・service_treatmentのどちらにも
   * 属していないservice投稿だけを取得
   * ====================================================== */
      $other_query = new WP_Query([
        'post_type'      => 'service',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => [
          'menu_order' => 'ASC',
          'date'       => 'DESC',
        ],
        'tax_query'      => [
          'relation' => 'AND',
          [
            'taxonomy' => 'service_concern',
            'operator' => 'NOT EXISTS',
          ],
          [
            'taxonomy' => 'service_treatment',
            'operator' => 'NOT EXISTS',
          ],
        ],
      ]);
      ?>

      <?php if ($other_query->have_posts()) : ?>
        <section class="service_archive_section service_archive_other">
          <h2 class="service_archive_heading rich_font">その他</h2>
          <article class="service_archive_group service_archive_group_treatment">
            <ul class="service_archive_list">
              <?php while ($other_query->have_posts()) : ?>
                <?php $other_query->the_post(); ?>
                <li>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
          </article>
        </section>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>

    </div><!-- END #archive_service -->

    <?php get_footer(); ?>