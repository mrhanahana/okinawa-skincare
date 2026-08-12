<?php
$options = get_design_plus_option();
get_header();
?>
<div id="news_header">
  <?php
  $post_num = $options['index_campaign_num'];
  $categuory_type = $options['index_campaign_category_type'];
  if ($category_type == 0) {
    $args = array('post_type' => 'campaign', 'posts_per_page' => $post_num);
  } else {
    $args = array(
      'post_type' => 'campaign',
      'posts_per_page' => $post_num,
      'tax_query' => array(array('taxonomy' => 'campaign_category', 'field' => 'term_id', 'terms' => $category_type))
    );
  }
  $campaign_query = new WP_Query($args);
  if ($campaign_query->have_posts()):
    // slider -----
  ?>
    <div class="index_title pt50">
      <h2 class="headline rich_font_type2">CAMPAIGN</h2>
      <h3 class="catch rich_font_type3">キャンペーンa</h3>
    </div>
    <div id="news_header_banner">
      <div id="index_campaign_slider_top" class="clearfix">
        <?php
        $i = 1;
        while ($campaign_query->have_posts()): $campaign_query->the_post();
          $campaign_category = get_the_terms($post->ID, 'campaign_category');
          $campaign_desc = get_post_meta($post->ID, 'campaign_desc', true);
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
            <?php if ($campaign_category && $options['show_index_campaign_category']) { ?>
              <div class="category">
                <?php foreach ($campaign_category as $cat) : ?>
                  <a class="campaign_cat_id<?php echo esc_attr($cat->term_id); ?>" href="<?php echo esc_url(get_term_link($cat, 'campaign_category')); ?>"><?php echo esc_html($cat->name); ?></a>
                <?php endforeach; ?>
              </div>
            <?php }; ?>
            <a class="link animate_background" href="<?php the_permalink() ?>" style="background:none;">
              <div class="top_area">
                <!--<div class="title_area frost_bg">
            <h4 class="title rich_font"><span>
              <?php the_title(); ?>
              </span></h4>
            <div class="blur_image"> <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>"> </div>
          </div>-->
                <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
              </div>
              <?php if ($campaign_desc && $options['show_index_campaign_desc']) { ?>
                <p class="desc"><?php echo wp_strip_all_tags(trim_desc($campaign_desc, 40)); ?></p>
              <?php }; ?>
            </a>
          </article>
        <?php $i++;
        endwhile; ?>
      </div>
    </div>
    <!-- END #index_campaign_slider_area -->
  <?php endif;
  wp_reset_query(); ?>
  <div id="news_header_inner">
    <?php
    $catch = $options['index_news_catch'];
    $desc = $options['index_news_desc'];
    $catch_mobile = $options['index_news_catch_mobile'];
    $desc_mobile = $options['index_news_desc_mobile'];
    ?>
    <?php if ($catch || $desc) { ?>
      <?php if ($catch) { ?>
        <h2 id="news_headline_top" class="catch<?php if ($catch_mobile) {
                                                  echo ' has_mobile_word';
                                                }; ?>" <?php if ($catch_mobile) {
                                                          echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                                        }; ?>><span class="rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></span>
        <?php }; ?>
        <?php if ($desc) { ?>
          <span class="desc<?php if ($desc_mobile) {
                              echo ' has_mobile_word';
                            }; ?>" <?php if ($desc_mobile) {
                                      echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                    }; ?>><?php echo nl2br(esc_html($desc)); ?></span>
        </h2>
      <?php }; ?>
    <?php }; ?>
    <div id="news_header_list">
      <?php if ($catch || $desc) { ?>
        <?php if ($catch) { ?>
          <h2 class="catch<?php if ($catch_mobile) {
                            echo ' has_mobile_word';
                          }; ?>" <?php if ($catch_mobile) {
                                    echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                  }; ?>><span class="rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></span>
          <?php }; ?>
          <?php if ($desc) { ?>
            <span class="desc<?php if ($desc_mobile) {
                                echo ' has_mobile_word';
                              }; ?>" <?php if ($desc_mobile) {
                                        echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                      }; ?>><?php echo nl2br(esc_html($desc)); ?></span>
          </h2>
        <?php }; ?>
      <?php }; ?>
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
        <!-- END .post_list -->
        <div class="index_cb_button"> <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($options['index_news_link_label']); ?></a> </div>
      <?php endif;
      wp_reset_query(); ?>
    </div>
  </div>
</div>
<?php
// Box content --------------------------------------------------------------------
if ($options['show_index_box_content_row1'] == 1) {
?>
  <div id="index_box_content" class="animation_content index_title">
    <h2 class="headline rich_font_type2">MENU</h2>
    <h3 class="catch rich_font_type3">治療メニュー</h3>
    <?php
    for ($row = 1; $row <= 3; $row++):
      if ($options['show_index_box_content_row' . $row] == 1) {
    ?>
        <div class="index_box_content row<?php echo $row; ?> <?php echo esc_attr($options['index_box_content_row' . $row . '_type']); ?> clearfix">
          <?php
          $limit = substr($options['index_box_content_row' . $row . '_type'], -1) + 1;
          for ($i = 1; $i <= $limit; $i++):
            $image = wp_get_attachment_image_src($options['index_box_content_row' . $row . '_image' . $i], 'full');
            if ($image) {
              $url = $options['index_box_content_row' . $row . '_url' . $i];
              $title = $options['index_box_content_row' . $row . '_title' . $i];
              $sub_title = $options['index_box_content_row' . $row . '_sub_title' . $i];
              $catch = $options['index_box_content_row' . $row . '_catch' . $i];
              $title_color = $options['index_box_content_row' . $row . '_title_color' . $i];
              $sub_title_color = $options['index_box_content_row' . $row . '_sub_title_color' . $i];
              $catch_color = $options['index_box_content_row' . $row . '_catch_color' . $i];
          ?>
              <div class="box box<?php echo $i; ?>">
                <?php if ($url) { ?>
                  <a class="link animate_background" href="<?php echo esc_url($url); ?>" ontouchstart="">
                    <?php if ($title) { ?>
                      <h2 class="title rich_font" style="color:<?php echo esc_attr($title_color); ?>;"> <?php echo esc_html($title); ?>
                        <?php if ($sub_title) { ?>
                          <span class="sub_title" style="color:<?php echo esc_attr($sub_title_color); ?>;"><?php echo esc_html($sub_title); ?></span>
                        <?php }; ?>
                      </h2>
                    <?php }; ?>
                    <?php if ($catch) { ?>
                      <p class="catch rich_font" style="color:<?php echo esc_attr($catch_color); ?>;"><?php echo esc_html($catch); ?></p>
                    <?php }; ?>
                    <div class="image_wrap">
                      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                    </div>
                  </a>
                <?php }; ?>
              </div>
              <!-- END .box -->
          <?php };
          endfor; ?>
        </div>
        <!-- END .index_box_content -->
    <?php };
    endfor; ?>
  </div>
  <!-- END #index_box_content -->
<?php }; ?>
<div id="index_content">
  <?php
  // content builder
  foreach ((array)$options['index_contents_order'] as $index_content):
  ?>
    <?php
    // Clinic --------------------------------------------------------------------
    if ($index_content == 'index_clinic' && $options['show_index_clinic'] == 1) {
      $catch = $options['index_clinic_catch'];
      $desc = $options['index_clinic_desc'];
      $catch_mobile = $options['index_clinic_catch_mobile'];
      $desc_mobile = $options['index_clinic_desc_mobile'];
      $image = wp_get_attachment_image_src($options['index_clinic_element_image'], 'full');
    ?>
      <div id="index_clinic" class="index_content">
        <?php if ($catch || $desc) { ?>
          <div class="index_cb_catch">
            <?php if ($image) { ?>
              <div class="element_image"> <img src="<?php echo esc_attr($image[0]); ?>" alt="" title=""> </div>
            <?php }; ?>
            <?php if ($catch) { ?>
              <h2 class="catch rich_font<?php if ($catch_mobile) {
                                          echo ' has_mobile_word';
                                        }; ?>" <?php if ($catch_mobile) {
                                                  echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                                }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
            <?php }; ?>
            <?php if ($desc) { ?>
              <p class="desc<?php if ($desc_mobile) {
                              echo ' has_mobile_word';
                            }; ?>" <?php if ($desc_mobile) {
                                      echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                    }; ?>><span><?php echo nl2br(esc_html($desc)); ?></span></p>
            <?php }; ?>
          </div>
        <?php }; ?>
        <div class="post_list clearfix">
          <?php
          for ($i = 1; $i <= 3; $i++):
            $image = wp_get_attachment_image_src($options['index_clinic_box_image' . $i], 'size1');
            if ($image) {
              $catch = $options['index_clinic_box_catch' . $i];
              $desc = $options['index_clinic_box_desc' . $i];
              $url = $options['index_clinic_box_url' . $i];
          ?>
              <article class="item clearfix">
                <?php if ($url) { ?>
                  <a class="link animate_background" href="<?php echo esc_url($url); ?>">
                  <?php }; ?>
                  <div class="image_wrap">
                    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
                  </div>
                  <div class="title_area">
                    <div class="title_area_inner">
                      <?php if ($catch) { ?>
                        <h4 class="title rich_font"><?php echo wp_kses_post(nl2br($catch)); ?></h4>
                      <?php }; ?>
                      <?php if ($desc) { ?>
                        <p class="desc rich_font_<?php echo esc_attr($options['index_clinic_desc_font_type']); ?>"><?php echo wp_kses_post(nl2br($desc)); ?></p>
                      <?php }; ?>
                    </div>
                  </div>
                  <?php if ($url) { ?>
                  </a>
                <?php }; ?>
              </article>
          <?php };
          endfor; ?>
        </div>
        <!-- END .post_list -->
        <?php if ($options['show_index_clinic_link']) { ?>
          <div class="index_cb_button"> <a href="<?php echo esc_url($options['index_clinic_link_url']); ?>"><?php echo esc_html($options['index_clinic_link_label']); ?></a> </div>
        <?php }; ?>
      </div>
      <!-- END #index_clinic -->

    <?php
      // Campaign --------------------------------------------------------------------
    } elseif ($index_content == 'index_campaign1' && $options['show_index_campaign'] == 1) {
      $catch = $options['index_campaign_catch'];
      $desc = $options['index_campaign_desc'];
      $catch_mobile = $options['index_campaign_catch_mobile'];
      $desc_mobile = $options['index_campaign_desc_mobile'];
      $image_id = $options['index_campaign_bg_image'];
      if ($image_id) {
        $image = wp_get_attachment_image_src($image_id, 'full');
        if (is_mobile()) {
          $image_mobile = wp_get_attachment_image_src($options['index_campaign_bg_image_mobile'], 'full');
          if ($image_mobile) {
            $image = $image_mobile;
          };
        }
        $image_url = $image[0];
      } else {
        $bg_color = $options['index_campaign_bg_color'];
      }
      if ($options['use_index_campaign_overlay'] == 1) {
        $overlay_color = hex2rgb($options['index_campaign_overlay']);
        $overlay_color = implode(",", $overlay_color);
        $overlay_opacity = $options['index_campaign_overlay_opacity'];
      }
    ?>
      <?php if ($image_id) { ?>
        <div id="index_campaign1" style="background:url(<?php echo esc_attr($image_url); ?>) no-repeat center center; background-size:cover;" class="index_content">
        <?php } else { ?>
          <div id="index_campaign1" style="background:<?php echo esc_attr($bg_color); ?>;" class="index_content">
          <?php }; ?>
          <?php if ($catch || $desc) { ?>
            <div class="index_cb_catch" style="color:<?php echo esc_attr($options['index_campaign_font_color']); ?>;">
              <?php if ($catch) { ?>
                <h2 class="catch rich_font<?php if ($catch_mobile) {
                                            echo ' has_mobile_word';
                                          }; ?>" <?php if ($catch_mobile) {
                                                    echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                                  }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
              <?php }; ?>
              <?php if ($desc) { ?>
                <p class="desc<?php if ($desc_mobile) {
                                echo ' has_mobile_word';
                              }; ?>" <?php if ($desc_mobile) {
                                        echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                      }; ?>><span><?php echo nl2br(esc_html($desc)); ?></span></p>
              <?php }; ?>
            </div>
          <?php }; ?>
          <?php
          $post_num = $options['index_campaign_num'];
          $category_type = $options['index_campaign_category_type'];
          if ($category_type == 0) {
            $args = array('post_type' => 'campaign', 'posts_per_page' => $post_num);
          } else {
            $args = array(
              'post_type' => 'campaign',
              'posts_per_page' => $post_num,
              'tax_query' => array(array('taxonomy' => 'campaign_category', 'field' => 'term_id', 'terms' => $category_type))
            );
          }
          $campaign_query = new WP_Query($args);
          if ($campaign_query->have_posts()):
            // slider -----
          ?>
            <div id="index_campaign_slider_area">
              <div id="index_campaign_slider_wrap">
                <div id="index_campaign_slider" class="clearfix">
                  <?php
                  $i = 1;
                  while ($campaign_query->have_posts()): $campaign_query->the_post();
                    $campaign_category = get_the_terms($post->ID, 'campaign_category');
                    $campaign_desc = get_post_meta($post->ID, 'campaign_desc', true);
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
                      <?php if ($campaign_category && $options['show_index_campaign_category']) { ?>
                        <div class="category">
                          <?php foreach ($campaign_category as $cat) : ?>
                            <a class="campaign_cat_id<?php echo esc_attr($cat->term_id); ?>" href="<?php echo esc_url(get_term_link($cat, 'campaign_category')); ?>"><?php echo esc_html($cat->name); ?></a>
                          <?php endforeach; ?>
                        </div>
                      <?php }; ?>
                      <a class="link animate_background" href="<?php the_permalink() ?>" style="background:none;">
                        <div class="top_area">
                          <div class="title_area frost_bg">
                            <h4 class="title rich_font"><span>
                                <?php the_title(); ?>
                              </span></h4>
                            <div class="blur_image"> <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>"> </div>
                          </div>
                          <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
                        </div>
                        <?php if ($campaign_desc && $options['show_index_campaign_desc']) { ?>
                          <p class="desc"><?php echo wp_strip_all_tags(trim_desc($campaign_desc, 40)); ?></p>
                        <?php }; ?>
                      </a>
                    </article>
                  <?php $i++;
                  endwhile; ?>
                </div>
                <!-- END #index_campaign_slider -->
              </div>
              <!-- END #index_campaign_slider_wrap -->
              <?php if ($post_num > 3) { ?>
                <div class="index_slider_arrow prev" id="index_campaign_slider_left_arrow">PREV</div>
                <div class="index_slider_arrow next" id="index_campaign_slider_right_arrow">NEXT</div>
              <?php }; ?>
            </div>
            <!-- END #index_campaign_slider_area -->
            <!-- キャンペーンが１つのためアーカイブへのボタンは非表示 -->
            <!--<div class="index_cb_button">
   <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>"><?php echo esc_html($options['index_campaign_link_label']); ?></a>
  </div>-->
            <?php if ($options['use_index_campaign_overlay'] == 1) { ?>
              <div class="overlay" style="background-color:rgba(<?php echo $overlay_color; ?>,<?php echo $overlay_opacity; ?>);"></div>
            <?php }; ?>
          <?php endif;
          wp_reset_query(); ?>
          </div>
          <!-- END #index_campaign -->

        <?php
        // News --------------------------------------------------------------------
      } elseif ($index_content == 'index_news' && $options['show_index_news'] == 1) {
        $catch = $options['index_news_catch'];
        $desc = $options['index_news_desc'];
        $catch_mobile = $options['index_news_catch_mobile'];
        $desc_mobile = $options['index_news_desc_mobile'];
        $image = wp_get_attachment_image_src($options['index_news_element_image'], 'full');
        ?>
          <div id="index_news" class="index_content">
            <?php if ($catch || $desc) { ?>
              <div class="index_cb_catch">
                <?php if ($image) { ?>
                  <div class="element_image"> <img src="<?php echo esc_attr($image[0]); ?>" alt="" title=""> </div>
                <?php }; ?>
                <?php if ($catch) { ?>
                  <h2 class="catch rich_font<?php if ($catch_mobile) {
                                              echo ' has_mobile_word';
                                            }; ?>" <?php if ($catch_mobile) {
                                                      echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                                    }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
                <?php }; ?>
                <?php if ($desc) { ?>
                  <p class="desc<?php if ($desc_mobile) {
                                  echo ' has_mobile_word';
                                }; ?>" <?php if ($desc_mobile) {
                                          echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                        }; ?>><span><?php echo nl2br(esc_html($desc)); ?></span></p>
                <?php }; ?>
              </div>
            <?php }; ?>
            <?php
            $post_num = $options['index_news_num'];
            $news_query = new WP_Query('post_type=news&posts_per_page=' . $post_num);
            if ($news_query->have_posts()):
            ?>
              <div class="post_list clearfix">
                <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
                  <article class="item"> <a href="<?php the_permalink() ?>">
                      <p class="date" style="color:<?php echo esc_attr($options['index_news_date_color']); ?>;">
                        <time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>">
                          <?php the_time('Y.m.j'); ?>
                        </time>
                      </p>
                      <h4 class="title"><span>
                          <?php the_title(); ?>
                        </span></h4>
                    </a> </article>
                <?php endwhile;  ?>
              </div>
              <!-- END .post_list -->
              <div class="index_cb_button"> <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($options['index_news_link_label']); ?></a> </div>
            <?php endif;
            wp_reset_query(); ?>
          </div>
          <!-- END #index_news -->

        <?php
        // Banner content --------------------------------------------------------------------
      } elseif ($index_content == 'index_banner' && $options['show_index_banner'] == 1) {
        ?>
          <div id="index_banner" class="index_content clearfix">
            <?php
            for ($i = 1; $i <= 2; $i++):
              $image = wp_get_attachment_image_src($options['index_banner_image' . $i], 'full');
              if ($image) {
            ?>
                <div class="box box<?php echo $i; ?>">
                  <?php if ($options['index_banner_url' . $i]) { ?>
                    <a class="link animate_background" href="<?php echo esc_url($options['index_banner_url' . $i]); ?>">
                      <?php if ($options['index_banner_title' . $i]) { ?>
                        <h2 class="title rich_font" style="color:<?php echo esc_attr($options['index_banner_title_color' . $i]); ?>; background:<?php echo esc_attr($options['index_banner_bg_color' . $i]); ?>;"><?php echo esc_html($options['index_banner_title' . $i]); ?></h2>
                      <?php }; ?>
                      <?php if ($options['index_banner_catch' . $i]) { ?>
                        <div class="catch frost_bg">
                          <p><?php echo esc_html($options['index_banner_catch' . $i]); ?></p>
                          <div class="blur_image"> <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>"> </div>
                        </div>
                      <?php }; ?>
                      <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
                    </a>
                  <?php }; ?>
                </div>
            <?php };
            endfor; ?>
          </div>
          <!-- END #index_banner -->

        <?php
        // Campaign2 --------------------------------------------------------------------
      } elseif ($index_content == 'index_campaign2' && $options['show_index_campaign2'] == 1) {
        $catch = $options['index_campaign2_catch'];
        $desc = $options['index_campaign2_desc'];
        $catch_mobile = $options['index_campaign2_catch_mobile'];
        $desc_mobile = $options['index_campaign2_desc_mobile'];
        ?>
          <div id="index_campaign2" class="index_content">
            <?php if ($catch || $desc) { ?>
              <div class="index_cb_catch">
                <?php if ($catch) { ?>
                  <h2 class="catch rich_font<?php if ($catch_mobile) {
                                              echo ' has_mobile_word';
                                            }; ?>" <?php if ($catch_mobile) {
                                                      echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                                    }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
                <?php }; ?>
                <?php if ($desc) { ?>
                  <p class="desc<?php if ($desc_mobile) {
                                  echo ' has_mobile_word';
                                }; ?>" <?php if ($desc_mobile) {
                                          echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                        }; ?>><span><?php echo nl2br(esc_html($desc)); ?></span></p>
                <?php }; ?>
              </div>
            <?php }; ?>
            <?php
            $post_num = $options['index_campaign2_num'];
            $exclude_cat_ids = $options['index_campaign2_category_exclude'];
            if (empty($exclude_cat_ids)) {
              $args = array('post_type' => 'campaign', 'posts_per_page' => $post_num);
            } else {
              $exclude_cat_ids = explode(",", $exclude_cat_ids);
              $args = array(
                'post_type' => 'campaign',
                'posts_per_page' => $post_num,
                'tax_query' => array(array('taxonomy' => 'campaign_category', 'field' => 'term_id', 'terms' => $exclude_cat_ids, 'operator' => 'NOT IN'))
              );
            }
            $campaign2_query = new WP_Query($args);
            if ($campaign2_query->have_posts()):
              $layout_type = $options['index_campaign2_layout'];
              $two_column_row = $options['index_campaign2_two_column_row'];
              if ($layout_type == 'type1') {
                $change_size = $two_column_row * 2;
              } else {
                $change_size = $two_column_row * 3;
              }
              $i = 1;
              $count = 1;
            ?>
              <div id="campaign_list" class="clearfix <?php echo esc_attr($layout_type);
                                                      if ($change_size == 0) {
                                                        echo ' same_size';
                                                      }; ?>">
                <?php
                while ($campaign2_query->have_posts()): $campaign2_query->the_post();
                  $campaign_category = get_the_terms($post->ID, 'campaign_category');
                  $campaign_desc = get_post_meta($post->ID, 'campaign_desc', true);
                  if (has_post_thumbnail()) {
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'size2');
                  } elseif ($options['no_image2']) {
                    $image = wp_get_attachment_image_src($options['no_image2'], 'full');
                  } else {
                    $image = array();
                    $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
                  }
                ?>
                  <?php if ($layout_type == 'type1') { ?>
                    <article class="item clearfix <?php if ($i <= $change_size) {
                                                    echo 'large';
                                                  } else {
                                                    if ($count % 3 == 0) {
                                                      echo ' third';
                                                    };
                                                    $count++;
                                                  }; ?>">
                    <?php } else { ?>
                      <article class="item clearfix <?php if ($i > $change_size) {
                                                      echo 'large';
                                                      if ($count % 2 == 0) {
                                                        echo ' even';
                                                      };
                                                      $count++;
                                                    }; ?>">
                      <?php }; ?>
                      <?php if ($campaign_category && $options['show_index_campaign2_category']) { ?>
                        <div class="category">
                          <?php foreach ($campaign_category as $cat) : ?>
                            <a class="campaign_cat_id<?php echo esc_attr($cat->term_id); ?>" href="<?php echo esc_url(get_term_link($cat, 'campaign_category')); ?>"><?php echo esc_html($cat->name); ?></a>
                          <?php endforeach; ?>
                        </div>
                      <?php }; ?>
                      <a class="link animate_background" href="<?php the_permalink() ?>">
                        <div class="title_area frost_bg">
                          <h4 class="title rich_font"><span>
                              <?php the_title(); ?>
                            </span></h4>
                          <div class="blur_image"> <img class="image object_fit" src="<?php echo esc_attr($image[0]); ?>" data-src="<?php echo esc_attr($image[0]); ?>"> </div>
                        </div>
                        <img class="image normal_image object_fit" src="<?php echo esc_attr($image[0]); ?>">
                      </a>
                      </article>
                    <?php $i++;
                  endwhile; ?>
              </div>
              <!-- END .post_list -->
              <div class="index_cb_button"> <a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>"><?php echo esc_html($options['index_campaign2_link_label']); ?></a> </div>
            <?php endif;
            wp_reset_query(); ?>
          </div>
          <!-- END #index_campaign2 -->

        <?php
        // Staff --------------------------------------------------------------------
      } elseif ($index_content == 'index_staff' && $options['show_index_staff'] == 1) {
        $catch = $options['index_staff_catch'];
        $desc = $options['index_staff_desc'];
        $catch_mobile = $options['index_staff_catch_mobile'];
        $desc_mobile = $options['index_staff_desc_mobile'];
        $image_id = $options['index_staff_bg_image'];
        if ($image_id) {
          $image = wp_get_attachment_image_src($image_id, 'full');
          if (is_mobile()) {
            $image_mobile = wp_get_attachment_image_src($options['index_staff_bg_image_mobile'], 'full');
            if ($image_mobile) {
              $image = $image_mobile;
            };
          }
          $image_url = $image[0];
        } else {
          $bg_color = $options['index_staff_bg_color'];
        }
        if ($options['use_index_staff_overlay'] == 1) {
          $overlay_color = hex2rgb($options['index_staff_overlay']);
          $overlay_color = implode(",", $overlay_color);
          $overlay_opacity = $options['index_staff_overlay_opacity'];
        }
        ?>
          <?php if ($image_id) { ?>
            <div id="index_staff" style="background:url(<?php echo esc_attr($image_url); ?>) no-repeat center center; background-size:cover;" class="index_content">
            <?php } else { ?>
              <div id="index_staff" style="background:<?php echo esc_attr($bg_color); ?>;" class="index_content">
              <?php }; ?>
              <?php if ($catch || $desc) { ?>
                <div class="index_cb_catch" style="color:<?php echo esc_attr($options['index_staff_font_color']); ?>;">
                  <?php if ($catch) { ?>
                    <h2 class="catch rich_font<?php if ($catch_mobile) {
                                                echo ' has_mobile_word';
                                              }; ?>" <?php if ($catch_mobile) {
                                                        echo ' data-label="' . nl2br(esc_html($catch_mobile)) . '"';
                                                      }; ?>><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2>
                  <?php }; ?>
                  <?php if ($desc) { ?>
                    <p class="desc<?php if ($desc_mobile) {
                                    echo ' has_mobile_word';
                                  }; ?>" <?php if ($desc_mobile) {
                                            echo ' data-label="' . nl2br(esc_html($desc_mobile)) . '"';
                                          }; ?>><span><?php echo nl2br(esc_html($desc)); ?></span></p>
                  <?php }; ?>
                </div>
              <?php }; ?>
              <?php
              $post_num = $options['index_staff_num'];
              $staff_query = new WP_Query('post_type=staff&posts_per_page=' . $post_num);
              if ($staff_query->have_posts()):
              ?>
                <div id="index_staff_slider_area">
                  <div id="index_staff_slider_wrap">
                    <div id="index_staff_slider" class="clearfix">
                      <?php
                      while ($staff_query->have_posts()): $staff_query->the_post();
                        $staff_index_desc = get_post_meta($post->ID, 'staff_index_desc', true);
                        $staff_index_image = get_post_meta($post->ID, 'staff_index_image', true);
                        if ($staff_index_image) {
                          $image = wp_get_attachment_image_src($staff_index_image, 'full');
                        } elseif ($options['no_image1']) {
                          $image = wp_get_attachment_image_src($options['no_image1'], 'full');
                        } else {
                          $image = array();
                          $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
                        }
                      ?>
                        <article class="item clearfix"> <a href="<?php the_permalink() ?>">
                            <?php if ($staff_index_desc) { ?>
                              <div class="desc_area">
                                <div class="desc">
                                  <div class="desc_inner">
                                    <p><?php echo wp_kses_post(nl2br($staff_index_desc)); ?></p>
                                  </div>
                                </div>
                              </div>
                            <?php }; ?>
                            <div class="animate_image"> <img src="<?php echo esc_attr($image[0]); ?>" alt="" title="" /> </div>
                            <p class="title">
                              <?php the_title(); ?>
                            </p>
                          </a> </article>
                      <?php endwhile;  ?>
                    </div>
                    <!-- END #index_staff_slider -->
                  </div>
                  <!-- END #index_staff_slider_wrap -->
                  <?php if ($post_num > 4) { ?>
                    <div class="index_slider_arrow prev" id="index_staff_slider_left_arrow">PREV</div>
                    <div class="index_slider_arrow next" id="index_staff_slider_right_arrow">NEXT</div>
                  <?php }; ?>
                </div>
                <!-- END #index_staff_slider_area -->
                <div class="index_cb_button"> <a href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>"><?php echo esc_html($options['index_staff_link_label']); ?></a> </div>
                <?php if ($options['use_index_staff_overlay'] == 1) { ?>
                  <div class="overlay" style="background-color:rgba(<?php echo $overlay_color; ?>,<?php echo $overlay_opacity; ?>);"></div>
                <?php }; ?>
              <?php endif;
              wp_reset_query(); ?>
              </div>
              <!-- END #index_staff -->

            <?php
            // free space-----------------------------------------------------------------
          } elseif ($index_content == 'index_free' && $options['show_index_free'] == 1) {
            $free_space = $options['index_free'];
            ?>
              <div id="index_free_space" class="index_content">
                <?php if (!empty($free_space)) { ?>
                  <div class="post_content clearfix"> <?php echo do_shortcode(wpautop(wp_kses_post($free_space))); ?> </div>
                <?php }; ?>
              </div>
              <!-- END #index_free_space -->

          <?php
          };
        endforeach; // content builder
          ?>
          <div class="index_title">
            <h2 class="headline rich_font_type2">DOCTOR</h2>
            <h3 class="catch rich_font_type3">ドクター紹介</h3>
            <section class="doc-eyecatch">
              <div class="content">
                <div class="image_area align1"><img src="https://okinawa-skincare.com/wp-content/uploads/2023/12/img_y.maeda_.jpg" alt="前田 由紀" class="aligncenter size-full" /></div>
                <div class="title_area">
                  <div class="title rich_font">
                    <h3>院長<span>前田　由紀</span></h3>
                  </div>
                  <p class="m10">「見た目」は、単なる整容にとどまらず、心も整えてくれる大切な要素といえます。にきびや肌荒れといった肌トラブルからエイジングサインのしみ・しわ・たるみ・赤みまで、あらゆる年代でQuality Of Lifeに関係しています。</p>
                  <p class="m10">見た目の老化メカニズムは解明が進み、美容医療の質も年々上がっています。その反面、数多くの治療や治療機器があることから、どの治療が自分の症状にあっているのかわからないと相談に来られる方が多くおられます。</p>
                  <p class="m10">皆様の悩みに寄り添いながら、しっかりとコミュニケーションをとり、より良い治療と適正な料金で美容診療にあたります。安心して皆様からお気軽にご相談を頂けるように診療に努めてまいります。どうぞよろしくお願いいたします。</p>
                </div>
              </div>
            </section>
            <section class="doc-content mb0">
              <div class="content">
                <div class="list">
                  <div>
                    <h4 class="rich_font">経　歴</h4>
                    <p>大阪府出身<br>
                      1999年 大阪市立大学（現大阪公立大学）医学部卒業<br>
                      1999年 大阪市立大学医学部付属病院形成外科にて勤務<br>
                      2006年 東京都内 レーザー専門総合病院　美容皮膚科にて勤務<br>
                      2023年 那覇市 沖縄スキンケアクリニックにて勤務</p>
                  </div>
                  <div>
                    <h4 class="rich_font">免　許</h4>
                    <p>医師免許<br />
                      日本形成外科学会 形成外科専門医<br />
                      日本レーザー医学会 レーザー専門医・指導医<br />
                      抗加齢医学会専門医<br />
                      日本形成外科学会 レーザー分野指導医</p>
                  </div>
                </div>
              </div>
              <div class="index_cb_button"> <a href="/about#clinic">医師紹介</a></div>
            </section>
          </div>
          <div class="index_title">
            <h2 class="headline rich_font_type2">PICKUP MENU</h2>
            <h3 class="catch rich_font_type3">おすすめ施術</h3>
            <div class="mt40 mb40 bnr2"> <a href="/about/specialist/"> <img src="https://okinawa-skincare.com/wp-content/uploads/2025/05/bnr_specialist2.jpg" alt="専門医による治療" /> </a> </div>
          </div>
          <div class="index_concept">
            <div class="inner">
              <h2 class="headline rich_font_type2">CONCEPT</h2>
              <h3 class="catch rich_font_type3">コンセプト</h3>
              <div class="message_area">
                <div class="image"><img src="https://okinawa-skincare.com/wp-content/uploads/2025/03/img_top_concept.jpg" alt="コンセプト"></div>
                <div class="content">
                  <div class="content_inner">
                    <div class="align1"> <img src="https://okinawa-skincare.com/wp-content/uploads/2022/07/logo_sp.png" alt="那覇市の美容皮膚科｜沖縄スキンケアクリニック">
                      <h2 class="catch rich_font_type3">患者様に寄り添うクリニック</h2>
                    </div>
                    <p class="desc">当院は「安心してお越しいただける居心地の良いクリニック」を目指して、プレミアムな空間で皆様のお越しをお待ちしております。</p>
                    <ul>
                      <li>レーザー治療専門医による美容医療</li>
                      <li>完全個室のプライベート空間</li>
                      <li>豊富な美容医療メニュー</li>
                    </ul>
                    <div class="index_cb_button mt50"> <a href="/about#feature">クリニック紹介</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="bnr mt40 mb40"> <a href="/recruit/"> <img src="https://okinawa-skincare.com/wp-content/uploads/2026/04/img_recruit_skincare.jpg" alt="沖縄スキンケアクリニックの求人情報" class="topbnr" /> </a> </div>
          <div class="bnr mb40"> <a href="https://www.instagram.com/okinawa_skincare_clinic/" rel="noopener" target="_blank"> <img src="https://okinawa-skincare.com/wp-content/uploads/2022/08/bnr_instagram_hiro-oscc.jpg" alt="沖縄スキンケアクリニックInstagram" class="topbnr" /> </a> </div>
          <div class="bnr mb40"> <a href="https://hiro-osp.com/" rel="noopener" target="_blank"> <img src="https://okinawa-skincare.com/wp-content/uploads/2024/12/img_bnr_hiroosp.png" alt="ひろ耳鼻科皮膚科形成外科" class="topbnr" /> </a> </div>
            </div>
            <!-- END #index_content -->

            <?php get_footer(); ?>