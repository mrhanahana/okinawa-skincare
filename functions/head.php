<?php
function child_tcd_head()
{
  $options = get_design_plus_option();
?>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
  <link rel="stylesheet" media="screen and (max-width:1250px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
  <link rel="stylesheet" media="screen and (max-width:1250px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">

  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>


  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/perfect-scrollbar.css?ver=<?php echo version_num(); ?>">
  <script src="<?php echo get_template_directory_uri(); ?>/js/perfect-scrollbar.min.js?ver=<?php echo version_num(); ?>"></script>

  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.js?ver=<?php echo version_num(); ?>"></script>

  <?php if (is_mobile()) { ?>
    <script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
  <?php }; ?>
  <?php
  if ($options['header_fix'] == 'type2') {
    if (!is_singular('find')) {
  ?>
      <script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>
  <?php };
  }; ?>
  <?php
  if ($options['mobile_header_fix'] == 'type2') {
    if (!is_singular('find')) {
  ?>
      <script src="<?php echo get_template_directory_uri(); ?>/js/header_fix_mobile.js?ver=<?php echo version_num(); ?>"></script>
  <?php };
  }; ?>
  <?php
  // Googleマップ
  if (is_singular('clinic')) {
    global $post;
    $access_address = get_post_meta($post->ID, 'access_address', true);
    if (!empty($access_address)) {
  ?>
      <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($options['gmap_api_key']); ?>" type="text/javascript"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/pagebuilder/assets/js/googlemap.js?ver=<?php echo version_num(); ?>"></script>
  <?php };
  }; ?>

  <style type="text/css">
    <?php
    // フォントタイプの設定　------------------------------------------------------------------
    ?><?php
      // 基本のフォントタイプ
      if ($options['font_type'] == 'type1') {
      ?>body,
    input,
    textarea {
      font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif;
    }

    <?php } elseif ($options['font_type'] == 'type2') { ?>body,
    input,
    textarea {
      font-family: "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif;
    }

    <?php } else { ?>body,
    input,
    textarea {
      font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif;
    }

    <?php }; ?><?php
                // 見出しのフォントタイプ
                if ($options['headline_font_type'] == 'type1') {
                ?>.rich_font,
    .p-vertical {
      font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif;
    }

    <?php } elseif ($options['headline_font_type'] == 'type2') { ?>.rich_font,
    .p-vertical {
      font-family: "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif;
      font-weight: 500;
    }

    <?php } else { ?>.rich_font,
    .p-vertical {
      font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif;
      font-weight: 500;
    }

    <?php }; ?>.rich_font_type1 {
      font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif;
    }

    .rich_font_type2 {
      font-family: "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif;
      font-weight: 500;
    }

    .rich_font_type3 {
      font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif;
      font-weight: 500;
    }

    <?php
    // 本文のフォントタイプ
    if (is_single()) {
      if ($options['content_font_type'] == 'type1') {
    ?>.post_content,
    #next_prev_post {
      font-family: Arial, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif;
    }

    <?php } elseif ($options['content_font_type'] == 'type2') { ?>.post_content,
    #next_prev_post {
      font-family: "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif;
    }

    <?php } else { ?>.post_content,
    #next_prev_post {
      font-family: "Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif;
    }

    <?php };
    }; ?><?php
          //ヘッダー -----------------------------------------------------------------------------------
          $header_bg_color = hex2rgb($options['header_bg_color']);
          $header_bg_color = implode(",", $header_bg_color);
          $global_menu_bg_color = hex2rgb($options['global_menu_bg_color']);
          $global_menu_bg_color = implode(",", $global_menu_bg_color);
          $global_menu_border_color = hex2rgb($options['global_menu_border_color']);
          $global_menu_border_color = implode(",", $global_menu_border_color);
          $global_menu_bg_color_fix = hex2rgb($options['global_menu_bg_color_fix']);
          $global_menu_bg_color_fix = implode(",", $global_menu_bg_color_fix);
          ?>.home #header_top {
      background: rgba(<?php echo esc_html($header_bg_color); ?>, <?php echo esc_html($options['header_bg_color_opacity']); ?>);
    }

    #header_top {
      background: rgba(<?php echo esc_html($header_bg_color); ?>, 1);
    }

    #header_logo a {
      color: <?php echo esc_html($options['header_font_color']); ?>;
    }

    .pc #global_menu {
      background: rgba(<?php echo esc_html($global_menu_bg_color); ?>, <?php echo esc_html($options['global_menu_bg_color_opacity']); ?>);
    }

    .pc #global_menu>ul {
      border-left: 1px solid rgba(<?php echo esc_html($global_menu_border_color); ?>, <?php echo esc_html($options['global_menu_border_color_opacity']); ?>);
    }

    .pc #global_menu>ul>li {
      border-right: 1px solid rgba(<?php echo esc_html($global_menu_border_color); ?>, <?php echo esc_html($options['global_menu_border_color_opacity']); ?>);
    }

    .pc #global_menu>ul>li>a,
    .pc #global_menu ul ul li.menu-item-has-children>a:before {
      color: <?php echo esc_html($options['global_menu_font_color']); ?>;
    }

    .pc #global_menu>ul>li>a:after {
      background: <?php echo esc_html($options['global_menu_color_hover']); ?>;
    }

    .pc #global_menu ul ul a {
      color: <?php echo esc_html($options['global_menu_font_color']); ?>;
      background: <?php echo esc_html($options['global_menu_child_bg_color']); ?>;
    }

    .pc #global_menu ul ul a:hover {
      background: <?php echo esc_html($options['global_menu_child_bg_color_hover']); ?>;
    }

    .pc .header_fix #global_menu {
      background: rgba(<?php echo esc_html($global_menu_bg_color_fix); ?>, <?php echo esc_html($options['global_menu_bg_color_opacity_fix']); ?>);
    }

    .pc .header_fix #global_menu>ul {
      border-left: 1px solid rgba(<?php echo esc_html($global_menu_border_color); ?>, <?php echo esc_html($options['global_menu_border_color_opacity_fix']); ?>);
    }

    .pc .header_fix #global_menu>ul>li {
      border-right: 1px solid rgba(<?php echo esc_html($global_menu_border_color); ?>, <?php echo esc_html($options['global_menu_border_color_opacity_fix']); ?>);
    }

    .mobile #mobile_menu {
      background: <?php echo esc_html($options['mobile_menu_bg_color']); ?>;
    }

    .mobile #global_menu a {
      color: <?php echo esc_html($options['mobile_menu_font_color']); ?> !important;
      background: <?php echo esc_html($options['mobile_menu_bg_color']); ?>;
      border-bottom: 1px solid <?php echo esc_html($options['mobile_menu_border_color']); ?>;
    }

    .mobile #global_menu li li a {
      background: <?php echo esc_html($options['mobile_menu_sub_menu_bg_color']); ?>;
    }

    .mobile #global_menu a:hover,
    #mobile_menu .close_button:hover,
    #mobile_menu #global_menu .child_menu_button:hover {
      color: <?php echo esc_html($options['mobile_menu_font_hover_color']); ?> !important;
      background: <?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>;
    }

    <?php
    //メガメニュー -----------------------------------------------------------------------------------
    ?>.megamenu_clinic_list1 {
      border-color: <?php echo esc_attr($options['mega_menu1_border_color']); ?>;
      background: <?php echo esc_attr($options['mega_menu1_bg_color']); ?>;
    }

    .megamenu_clinic_list1 a {
      background: <?php echo esc_attr($options['mega_menu1_bg_color']); ?>;
    }

    .megamenu_clinic_list1 ol,
    .megamenu_clinic_list1 li {
      border-color: <?php echo esc_attr($options['mega_menu1_border_color']); ?>;
    }

    .megamenu_clinic_list1 .title {
      color: <?php echo esc_attr($options['mega_menu1_headline_color']); ?>;
    }

    .megamenu_clinic_list2 {
      border-color: <?php echo esc_attr($options['mega_menu2_border_color']); ?>;
      background: <?php echo esc_attr($options['mega_menu2_bg_color']); ?>;
    }

    .megamenu_clinic_list2 a {
      background: <?php echo esc_attr($options['mega_menu2_bg_color']); ?>;
    }

    .megamenu_clinic_list2_inner,
    .megamenu_clinic_list2 ol,
    .megamenu_clinic_list2 li {
      border-color: <?php echo esc_attr($options['mega_menu2_border_color']); ?>;
    }

    .megamenu_clinic_list2 .headline,
    .megamenu_clinic_list2 .title {
      color: <?php echo esc_attr($options['mega_menu2_headline_color']); ?>;
    }

    .megamenu_clinic_list2 .link_button a {
      color: <?php echo esc_attr($options['mega_menu2_button_font_color']); ?>;
      background: <?php echo esc_attr($options['mega_menu2_button_bg_color']); ?>;
    }

    .megamenu_clinic_list2 .link_button a:hover {
      color: <?php echo esc_attr($options['mega_menu2_button_font_color_hover']); ?>;
      background: <?php echo esc_attr($options['mega_menu2_button_bg_color_hover']); ?>;
    }

    .megamenu_campaign_list {
      background: <?php echo esc_attr($options['mega_menu3_bg_color1']); ?>;
    }

    .megamenu_campaign_list .post_list_area,
    .megamenu_campaign_list .menu_area a:hover,
    .megamenu_campaign_list .menu_area li.active a {
      background: <?php echo esc_attr($options['mega_menu3_bg_color2']); ?>;
    }

    .megamenu_campaign_list .menu_area a {
      background: <?php echo esc_attr($options['mega_menu3_bg_color3']); ?>;
    }

    .megamenu_campaign_list .menu_area a:hover,
    .megamenu_campaign_list .menu_area li.active a {
      color: <?php echo esc_attr($options['mega_menu3_bg_color3']); ?>;
    }

    <?php
    // 固定ヘッダー
    $fixed_header_bg_color = hex2rgb($options['fixed_header_bg_color']);
    $fixed_header_bg_color = implode(",", $fixed_header_bg_color);
    ?>.pc .header_fix #header_top {
      background: rgba(<?php echo esc_html($fixed_header_bg_color); ?>, <?php echo esc_html($options['fixed_header_bg_color_opacity']); ?>);
    }

    .header_fix #header_logo a {
      color: <?php echo esc_html($options['fixed_header_font_color']); ?> !important;
    }

    <?php
    // ボタン
    if ((is_mobile() && $options['show_footer_button1']) || (is_mobile() && $options['show_footer_button2'])) {
    ?>#header_button .button1 a {
      color: <?php echo esc_html($options['header_button_font_color1']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color1']); ?>;
    }

    #header_button .button1 a:hover {
      color: <?php echo esc_html($options['header_button_font_color_hover1']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color_hover1']); ?>;
    }

    #header_button .button2 a {
      color: <?php echo esc_html($options['header_button_font_color2']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color2']); ?>;
    }

    #header_button .button2 a:hover {
      color: <?php echo esc_html($options['header_button_font_color_hover2']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color_hover2']); ?>;
    }

    #footer_button .button1 a {
      color: <?php echo esc_html($options['footer_button_font_color1']); ?>;
      background: <?php echo esc_html($options['footer_button_bg_color1']); ?>;
    }

    #footer_button .button1 a:hover {
      color: <?php echo esc_html($options['footer_button_font_color_hover1']); ?>;
      background: <?php echo esc_html($options['footer_button_bg_color_hover1']); ?>;
    }

    #footer_button .button2 a {
      color: <?php echo esc_html($options['footer_button_font_color2']); ?>;
      background: <?php echo esc_html($options['footer_button_bg_color2']); ?>;
    }

    #footer_button .button2 a:hover {
      color: <?php echo esc_html($options['footer_button_font_color_hover2']); ?>;
      background: <?php echo esc_html($options['footer_button_bg_color_hover2']); ?>;
    }

    <?php } elseif ($options['show_header_button1'] || $options['show_header_button2']) { ?>#header_button .button1 a,
    #footer_button .button1 a {
      color: <?php echo esc_html($options['header_button_font_color1']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color1']); ?>;
    }

    #header_button .button1 a:hover,
    #footer_button .button1 a:hover {
      color: <?php echo esc_html($options['header_button_font_color_hover1']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color_hover1']); ?>;
    }

    #header_button .button2 a,
    #footer_button .button2 a {
      color: <?php echo esc_html($options['header_button_font_color2']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color2']); ?>;
    }

    #header_button .button2 a:hover,
    #footer_button .button2 a:hover {
      color: <?php echo esc_html($options['header_button_font_color_hover2']); ?>;
      background: <?php echo esc_html($options['header_button_bg_color_hover2']); ?>;
    }

    <?php
    }
    //フッター -----------------------------------------------------------------------------------
    if ($options['show_footer_info_button1'] || $options['show_footer_info_button2']) {
    ?>#footer_info_content1 .button a {
      color: <?php echo esc_html($options['foonter_info_button_font_color1']); ?>;
      background: <?php echo esc_html($options['foonter_info_button_bg_color1']); ?>;
    }

    #footer_info_content1 .button a:hover {
      color: <?php echo esc_html($options['foonter_info_button_font_color_hover1']); ?>;
      background: <?php echo esc_html($options['foonter_info_button_bg_color_hover1']); ?>;
    }

    #footer_info_content2 .button a {
      color: <?php echo esc_html($options['foonter_info_button_font_color2']); ?>;
      background: <?php echo esc_html($options['foonter_info_button_bg_color2']); ?>;
    }

    #footer_info_content2 .button a:hover {
      color: <?php echo esc_html($options['foonter_info_button_font_color_hover2']); ?>;
      background: <?php echo esc_html($options['foonter_info_button_bg_color_hover2']); ?>;
    }

    <?php }; ?>#footer_banner .title {
      color: <?php echo esc_attr($options['footer_banner_font_color']); ?>;
      font-size: <?php echo esc_attr($options['footer_banner_font_size']); ?>px;
    }

    #footer_menu_area,
    #footer_menu_area a,
    #footer_menu .footer_headline a:before {
      color: <?php echo esc_attr($options['footer_menu_font_color']); ?>;
    }

    #footer_menu_area .footer_headline a {
      color: <?php echo esc_attr($options['footer_menu_headline_color']); ?>;
    }

    #footer_menu_area a:hover,
    #footer_menu .footer_headline a:hover:before {
      color: <?php echo esc_attr($options['footer_menu_font_color_hover']); ?>;
    }

    #footer_bottom,
    #footer_bottom a {
      color: <?php echo esc_attr($options['copyright_font_color']); ?>;
    }

    @media screen and (max-width:950px) {
      #footer_banner .title {
        font-size: <?php echo esc_attr($options['footer_banner_font_size_mobile']); ?>px;
      }
    }

    <?php
    // クリニック -----------------------------------------------------------------------------
    if (is_post_type_archive('clinic') || is_singular('clinic')) {
    ?>#page_header_catch .catch {
      font-size: <?php echo esc_html($options['clinic_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['clinic_catch_color']); ?>;
    }

    #page_header_catch .desc {
      font-size: <?php echo esc_html($options['clinic_desc_font_size']); ?>px;
      color: <?php echo esc_html($options['clinic_desc_color']); ?>;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['clinic_title_font_size']); ?>px;
      color: <?php echo esc_html($options['clinic_title_color']); ?>;
    }

    #archive_clinic .title {
      font-size: <?php echo esc_html($options['archive_clinic_title_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_clinic_title_color']); ?>;
    }

    #archive_clinic .catch {
      font-size: <?php echo esc_html($options['archive_clinic_catch_font_size']); ?>px;
    }

    #archive_clinic .bottom_area .link_button a {
      color: <?php echo esc_html($options['archive_clinic_button_font_color']); ?>;
      background: <?php echo esc_html($options['archive_clinic_button_bg_color']); ?>;
    }

    #archive_clinic .bottom_area .link_button a:hover {
      color: <?php echo esc_html($options['archive_clinic_button_font_color_hover']); ?>;
      background: <?php echo esc_html($options['archive_clinic_button_bg_color_hover']); ?>;
    }

    @media screen and (max-width:950px) {
      #page_header_catch .catch {
        font-size: <?php echo esc_html($options['clinic_catch_font_size_mobile']); ?>px;
      }

      #page_header_catch .desc {
        font-size: <?php echo esc_html($options['clinic_desc_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['clinic_title_font_size_mobile']); ?>px;
      }

      #archive_clinic .title {
        font-size: <?php echo esc_html($options['archive_clinic_title_font_size_mobile']); ?>px;
      }

      #archive_clinic .catch {
        font-size: <?php echo esc_html($options['archive_clinic_catch_font_size_mobile']); ?>px;
      }
    }

    <?php
      if (is_singular('clinic')) {
        global $post;
        $clinic_catch_font_size = get_post_meta($post->ID, 'clinic_catch_font_size', true);
        $clinic_catch_font_size_mobile = get_post_meta($post->ID, 'clinic_catch_font_size_mobile', true);
        $clinic_catch_font_size2 = get_post_meta($post->ID, 'clinic_catch2_font_size', true);
        $clinic_catch_font_size_mobile2 = get_post_meta($post->ID, 'clinic_catch2_font_size_mobile', true);
        $clinic_content_list2 = get_post_meta($post->ID, 'clinic_content_list2', true);
        $access_button_url = get_post_meta($post->ID, 'access_button_url', true);
        $access_button_font_color = get_post_meta($post->ID, 'access_button_font_color', true);
        $access_button_bg_color = get_post_meta($post->ID, 'access_button_bg_color', true);
        $access_button_font_color_hover = get_post_meta($post->ID, 'access_button_font_color_hover', true);
        $access_button_bg_color_hover = get_post_meta($post->ID, 'access_button_bg_color_hover', true);
    ?>#access_info .pb_googlemap_custom-overlay-inner {
      background: <?php echo esc_html($options['gmap_marker_bg']); ?>;
      color: <?php echo esc_html($options['gmap_marker_color']); ?>;
    }

    #access_info .pb_googlemap_custom-overlay-inner::after {
      border-color: <?php echo esc_html($options['gmap_marker_bg']); ?> transparent transparent transparent;
    }

    body.single #main_col,
    #clinic_content_list1 .desc,
    #cinic_address_data .address p,
    #clinic_content_list2 .desc,
    #clinic_staff_info .name {
      font-size: <?php echo esc_html($options['single_clinic_content_font_size']); ?>px;
    }

    #clinic_header_image .title {
      font-size: <?php echo esc_html($options['single_clinic_title_font_size']); ?>px;
    }

    #side_clinic_list .headline {
      font-size: <?php echo esc_html($options['side_clinic_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['side_clinic_font_color']); ?>;
      background: <?php echo esc_html($options['side_clinic_bg_color']); ?>;
    }

    #side_clinic_list.type1 a {
      background: <?php echo esc_html($options['side_clinic_odd_bg_color']); ?>;
    }

    #side_clinic_list.type1 li:nth-child(even) a {
      background: <?php echo esc_html($options['side_clinic_even_bg_color']); ?>;
    }

    #side_clinic_list.type2 a {
      border-color: <?php echo esc_html($options['side_clinic_border_color']); ?>;
    }

    <?php if ($access_button_url) { ?>#cinic_address_data .link_button a {
      color: <?php echo esc_html($access_button_font_color); ?>;
      background: <?php echo esc_html($access_button_bg_color); ?>;
    }

    <?php }; ?><?php if ($access_button_url) { ?>#cinic_address_data .link_button a:hover {
      color: <?php echo esc_html($access_button_font_color_hover); ?>;
      background: <?php echo esc_html($access_button_bg_color_hover); ?>;
    }

    <?php }; ?><?php if ($clinic_catch_font_size) { ?>.cf_catch1 .catch {
      font-size: <?php echo esc_html($clinic_catch_font_size); ?>px;
    }

    <?php }; ?><?php if ($clinic_catch_font_size2) { ?>.cf_catch2 .catch {
      font-size: <?php echo esc_html($clinic_catch_font_size2); ?>px;
    }

    <?php }; ?><?php
                if (!empty($clinic_content_list2)) {
                  $i = 1;
                  foreach ($clinic_content_list2 as $key => $value) :
                    if ($value['button_font_color'] || $value['button_bg_color'] || $value['button_font_color_hover'] || $value['button_bg_color_hover']) {
                ?>#clinic_content_list2 .item<?php echo $i; ?>.link_button a {
      color: <?php echo esc_html($value['button_font_color']); ?>;
      background: <?php echo esc_html($value['button_bg_color']); ?>;
    }

    #clinic_content_list2 .item<?php echo $i; ?>.link_button a:hover {
      color: <?php echo esc_html($value['button_font_color_hover']); ?>;
      background: <?php echo esc_html($value['button_bg_color_hover']); ?>;
    }

    <?php
                    };
                    $i++;
                  endforeach;
                };
    ?>@media screen and (max-width:950px) {

      body.single #main_col,
      #clinic_content_list1 .desc,
      #cinic_address_data .address p,
      #clinic_content_list2 .desc,
      #clinic_staff_info .name {
        font-size: <?php echo esc_html($options['single_clinic_content_font_size_mobile']); ?>px;
      }

      #clinic_header_image .title {
        font-size: <?php echo esc_html($options['single_clinic_title_font_size_mobile']); ?>px;
      }

      #side_clinic_list .headline {
        font-size: <?php echo esc_html($options['side_clinic_headline_font_size_mobile']); ?>px;
      }

      <?php if ($clinic_catch_font_size_mobile) { ?>.cf_catch1 .catch {
        font-size: <?php echo esc_html($clinic_catch_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($clinic_catch_font_size_mobile2) { ?>.cf_catch2 .catch {
        font-size: <?php echo esc_html($clinic_catch_font_size_mobile2); ?>px;
      }

      <?php }; ?>
    }

    <?php }; ?><?php
                // サービス -----------------------------------------------------------------------------
              } elseif (is_post_type_archive('service') || is_tax('service_category') || is_singular('service')) {
                ?>#page_header_catch .catch {
      font-size: <?php echo esc_html($options['service_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['service_catch_color']); ?>;
    }

    #page_header_catch .desc {
      font-size: <?php echo esc_html($options['service_desc_font_size']); ?>px;
      color: <?php echo esc_html($options['service_desc_color']); ?>;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['service_title_font_size']); ?>px;
      color: <?php echo esc_html($options['service_title_color']); ?>;
    }

    #archive_service .bottom_area .desc {
      font-size: <?php echo esc_html($options['archive_service_desc_font_size']); ?>px;
    }

    #archive_service .bottom_area .link_button a {
      color: <?php echo esc_html($options['archive_service_button_font_color']); ?>;
      background: <?php echo esc_html($options['archive_service_button_bg_color']); ?>;
    }

    #archive_service .bottom_area .link_button a:hover {
      color: <?php echo esc_html($options['archive_service_button_font_color_hover']); ?>;
      background: <?php echo esc_html($options['archive_service_button_bg_color_hover']); ?>;
    }

    #archive_service .archive_service_child .headline {
      font-size: <?php echo esc_html($options['category_service_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['category_service_headline_font_color']); ?>;
      background: <?php echo esc_html($options['category_service_headline_bg_color']); ?>;
      border-color: <?php echo esc_html($options['category_service_headline_border_color']); ?>;
    }

    .service_post_list li a {
      background: <?php echo esc_html($options['category_service_bg_color']); ?>;
    }

    .service_post_list .title {
      font-size: <?php echo esc_html($options['category_service_title_font_size']); ?>px;
      color: <?php echo esc_html($options['category_service_title_color']); ?>;
    }

    #single_service_title_area .title {
      font-size: <?php echo esc_html($options['single_service_title_font_size']); ?>px;
    }

    #side_service_category_list .headline {
      color: <?php echo esc_html($options['side_service_category_font_color']); ?>;
      background: <?php echo esc_html($options['side_service_category_bg_color']); ?>;
    }

    #side_service_category_list.type1 .post_list a {
      background: <?php echo esc_html($options['side_service_odd_bg_color']); ?>;
    }

    #side_service_category_list.type1 .post_list li:nth-child(even) a {
      background: <?php echo esc_html($options['side_service_even_bg_color']); ?>;
    }

    #side_service_category_list .child_menu>a {
      color: <?php echo esc_html($options['side_service_sub_category_font_color']); ?>;
      background: <?php echo esc_html($options['side_service_sub_category_bg_color']); ?>;
    }

    #side_service_category_list .child_menu>a:before {
      border-color: <?php echo esc_html($options['side_service_sub_category_bg_color']); ?> transparent transparent transparent;
    }

    #side_service_category_list.type2 a {
      border-color: <?php echo esc_html($options['side_service_border_color']); ?>;
    }

    @media screen and (max-width:950px) {
      #page_header_catch .catch {
        font-size: <?php echo esc_html($options['service_catch_font_size_mobile']); ?>px;
      }

      #page_header_catch .desc {
        font-size: <?php echo esc_html($options['service_desc_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['service_title_font_size_mobile']); ?>px;
      }

      #archive_service .archive_service_child .headline {
        font-size: <?php echo esc_html($options['category_service_headline_font_size_mobile']); ?>px;
      }

      #archive_service .bottom_area .desc {
        font-size: <?php echo esc_html($options['archive_service_desc_font_size_mobile']); ?>px;
      }

      .service_post_list .title {
        font-size: <?php echo esc_html($options['category_service_title_font_size_mobile']); ?>px;
      }

      #single_service_title_area .title {
        font-size: <?php echo esc_html($options['single_service_title_font_size_mobile']); ?>px;
      }
    }

    <?php
                if (is_singular('service')) {
                  global $post;
                  $service_catch_font_size = get_post_meta($post->ID, 'service_catch_font_size', true);
                  $service_catch_font_size_mobile = get_post_meta($post->ID, 'service_catch_font_size_mobile', true);
                  $service_recommend_list_headline_font_size = get_post_meta($post->ID, 'service_recommend_list_headline_font_size', true);
                  $service_recommend_list_headline_font_size_mobile = get_post_meta($post->ID, 'service_recommend_list_headline_font_size_mobile', true);
                  $service_content_list_headline_font_size = get_post_meta($post->ID, 'service_content_list_headline_font_size', true);
                  $service_content_list_headline_font_size_mobile = get_post_meta($post->ID, 'service_content_list_headline_font_size_mobile', true);
                  $service_price_list_headline_font_size = get_post_meta($post->ID, 'service_price_list_headline_font_size', true);
                  $service_price_list_headline_font_size_mobile = get_post_meta($post->ID, 'service_price_list_headline_font_size_mobile', true);
                  $service_recommend_list_check_color = get_post_meta($post->ID, 'service_recommend_list_check_color', true);
    ?>body.single #main_col,
    .cf_data_list li {
      font-size: <?php echo esc_html($options['single_service_content_font_size']); ?>px;
    }

    <?php if ($service_catch_font_size) { ?>.cf_catch .catch {
      font-size: <?php echo esc_html($service_catch_font_size); ?>px;
    }

    <?php }; ?><?php if ($service_recommend_list_headline_font_size) { ?>.cf_data_list .headline {
      font-size: <?php echo esc_html($service_recommend_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($service_content_list_headline_font_size) { ?>.cf_content_list .headline {
      font-size: <?php echo esc_html($service_content_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($service_price_list_headline_font_size) { ?>.cf_price_list .headline {
      font-size: <?php echo esc_html($service_price_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($service_recommend_list_check_color) { ?>.cf_data_list li:before {
      border: 1px solid <?php echo esc_attr($service_recommend_list_check_color); ?>;
      color: <?php echo esc_attr($service_recommend_list_check_color); ?>;
    }

    <?php }; ?>@media screen and (max-width:950px) {

      body.single #main_col,
      .cf_data_list li {
        font-size: <?php echo esc_html($options['single_service_content_font_size_mobile']); ?>px;
      }

      <?php if ($service_catch_font_size_mobile) { ?>.cf_catch .catch {
        font-size: <?php echo esc_html($service_catch_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($service_recommend_list_headline_font_size_mobile) { ?>.cf_data_list .headline {
        font-size: <?php echo esc_html($service_recommend_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($service_content_list_headline_font_size_mobile) { ?>.cf_content_list .headline {
        font-size: <?php echo esc_html($service_content_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($service_price_list_headline_font_size_mobile) { ?>.cf_price_list .headline {
        font-size: <?php echo esc_html($service_price_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?>
    }

    <?php }; ?><?php
                if (is_tax('service_category') || is_singular('service')) {
                  if (is_tax('service_category')) {
                    $query_obj = get_queried_object();
                    $parent_id = $query_obj->parent;
                    if ($parent_id != 0) { // if is child category
                      $current_page_id = $parent_id;
                    } else {
                      $current_page_id = $query_obj->term_id;
                    }
                  } else { // if single page
                    $service_cats = get_the_terms($post->ID, 'service_category');
                    if ($service_cats) {
                      foreach ($service_cats as $cat) {
                        $current_page_id = $cat->term_id;
                      }
                    };
                    $category_data = get_term_by('id', $current_page_id, 'service_category');
                    $parent_id = $category_data->parent;
                    if ($parent_id != 0) { // if is child category
                      $current_page_id = $parent_id;
                    }
                  }
                  $custom_fields = get_option('taxonomy_' . $current_page_id, array());
                ?>#archive_service .top_area .title {
      font-size: <?php if (!empty($custom_fields['title_font_size'])) {
                    echo esc_html($custom_fields['title_font_size']);
                  } else {
                    echo '46';
                  }; ?>px;
    }

    #archive_service .top_area .title span {
      font-size: <?php if (!empty($custom_fields['sub_title_font_size'])) {
                    echo esc_html($custom_fields['sub_title_font_size']);
                  } else {
                    echo '16';
                  }; ?>px;
    }

    #archive_service .top_area .catch {
      font-size: <?php if (!empty($custom_fields['catch_font_size'])) {
                    echo esc_html($custom_fields['catch_font_size']);
                  } else {
                    echo '26';
                  }; ?>px;
    }

    #side_service_category_list .headline {
      font-size: <?php if (!empty($custom_fields['side_font_size'])) {
                    echo esc_html($custom_fields['side_font_size']);
                  } else {
                    echo '36';
                  }; ?>px;
    }

    #side_service_category_list .headline span {
      font-size: <?php if (!empty($custom_fields['side_sub_font_size'])) {
                    echo esc_html($custom_fields['side_sub_font_size']);
                  } else {
                    echo '16';
                  }; ?>px;
    }

    @media screen and (max-width:950px) {
      #archive_service .top_area .title {
        font-size: <?php if (!empty($custom_fields['title_font_size_mobile'])) {
                      echo esc_html($custom_fields['title_font_size_mobile']);
                    } else {
                      echo '24';
                    }; ?>px;
      }

      #archive_service .top_area .title span {
        font-size: <?php if (!empty($custom_fields['sub_title_font_size_mobile'])) {
                      echo esc_html($custom_fields['sub_title_font_size_mobile']);
                    } else {
                      echo '12';
                    }; ?>px;
      }

      #archive_service .top_area .catch,
      #archive_service .mobile_catch {
        font-size: <?php if (!empty($custom_fields['catch_font_size_mobile'])) {
                      echo esc_html($custom_fields['catch_font_size_mobile']);
                    } else {
                      echo '16';
                    }; ?>px;
      }

      #side_service_category_list .headline {
        font-size: <?php if (!empty($custom_fields['side_font_size_mobile'])) {
                      echo esc_html($custom_fields['side_font_size_mobile']);
                    } else {
                      echo '20';
                    }; ?>px;
      }

      #side_service_category_list .headline span {
        font-size: <?php if (!empty($custom_fields['side_sub_font_size_mobile'])) {
                      echo esc_html($custom_fields['side_sub_font_size_mobile']);
                    } else {
                      echo '12';
                    }; ?>px;
      }
    }

    <?php
                } elseif (is_post_type_archive('service')) {
                  $service_category = get_terms('service_category', array('hide_empty' => true, 'orderby' => 'id', 'parent' => 0));
                  if ($service_category && ! is_wp_error($service_category)) :
                    foreach ($service_category as $cat):
                      $cat_id = $cat->term_id;
                      $custom_fields = get_option('taxonomy_' . $cat_id, array());
    ?>#archive_service .cat_id<?php echo esc_html($cat_id); ?>.top_area .title {
      font-size: <?php if (!empty($custom_fields['title_font_size'])) {
                        echo esc_html($custom_fields['title_font_size']);
                      } else {
                        echo '46';
                      }; ?>px;
    }

    #archive_service .cat_id<?php echo esc_html($cat_id); ?>.top_area .title span {
      font-size: <?php if (!empty($custom_fields['sub_title_font_size'])) {
                        echo esc_html($custom_fields['sub_title_font_size']);
                      } else {
                        echo '16';
                      }; ?>px;
    }

    #archive_service .cat_id<?php echo esc_html($cat_id); ?>.top_area .catch {
      font-size: <?php if (!empty($custom_fields['catch_font_size'])) {
                        echo esc_html($custom_fields['catch_font_size']);
                      } else {
                        echo '26';
                      }; ?>px;
    }

    @media screen and (max-width:950px) {
      #archive_service .cat_id<?php echo esc_html($cat_id); ?>.top_area .title {
        font-size: <?php if (!empty($custom_fields['title_font_size_mobile'])) {
                        echo esc_html($custom_fields['title_font_size_mobile']);
                      } else {
                        echo '24';
                      }; ?>px;
      }

      #archive_service .cat_id<?php echo esc_html($cat_id); ?>.top_area .title span {
        font-size: <?php if (!empty($custom_fields['sub_title_font_size_mobile'])) {
                        echo esc_html($custom_fields['sub_title_font_size_mobile']);
                      } else {
                        echo '12';
                      }; ?>px;
      }

      #archive_service .cat_id<?php echo esc_html($cat_id); ?>.top_area .catch {
        font-size: <?php if (!empty($custom_fields['catch_font_size_mobile'])) {
                        echo esc_html($custom_fields['catch_font_size_mobile']);
                      } else {
                        echo '16';
                      }; ?>px;
      }

      #archive_service .cat_id<?php echo esc_html($cat_id); ?>.mobile_catch {
        font-size: <?php if (!empty($custom_fields['catch_font_size_mobile'])) {
                        echo esc_html($custom_fields['catch_font_size_mobile']);
                      } else {
                        echo '16';
                      }; ?>px;
      }
    }

    <?php
                    endforeach;
                  endif;
                };
    ?><?php
                // スタッフ -----------------------------------------------------------------------------
              } elseif (is_post_type_archive('staff') || is_singular('staff')) {
      ?>body.single #main_col {
      font-size: <?php echo esc_html($options['single_staff_content_font_size']); ?>px;
    }

    #page_header_catch .catch {
      font-size: <?php echo esc_html($options['staff_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['staff_catch_color']); ?>;
    }

    #page_header_catch .desc {
      font-size: <?php echo esc_html($options['staff_desc_font_size']); ?>px;
      color: <?php echo esc_html($options['staff_desc_color']); ?>;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['staff_title_font_size']); ?>px;
      color: <?php echo esc_html($options['staff_title_color']); ?>;
    }

    #staff_list .title {
      font-size: <?php echo esc_html($options['archive_staff_title_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_staff_title_color']); ?>;
    }

    #staff_list .data_list .headline {
      font-size: <?php echo esc_html($options['archive_staff_featured_list_headline_font_size']); ?>px;
    }

    #staff_list .data_list li span {
      color: <?php echo esc_html($options['archive_staff_featured_list_headline_color']); ?>;
    }

    #staff_header_image .title {
      font-size: <?php echo esc_html($options['single_staff_title_font_size']); ?>px;
    }

    #side_staff_list .headline {
      font-size: <?php echo esc_html($options['side_staff_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['side_staff_font_color']); ?>;
      background: <?php echo esc_html($options['side_staff_bg_color']); ?>;
    }

    #side_staff_list.type1 a {
      background: <?php echo esc_html($options['side_staff_odd_bg_color']); ?>;
    }

    #side_staff_list.type1 li:nth-child(even) a {
      background: <?php echo esc_html($options['side_staff_even_bg_color']); ?>;
    }

    #side_staff_list.type2 a {
      border-color: <?php echo esc_html($options['side_staff_border_color']); ?>;
    }

    @media screen and (max-width:950px) {
      body.single #main_col {
        font-size: <?php echo esc_html($options['single_staff_content_font_size_mobile']); ?>px;
      }

      #page_header_catch .catch {
        font-size: <?php echo esc_html($options['staff_catch_font_size_mobile']); ?>px;
      }

      #page_header_catch .desc {
        font-size: <?php echo esc_html($options['staff_desc_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['staff_title_font_size_mobile']); ?>px;
      }

      #staff_header_image .title {
        font-size: <?php echo esc_html($options['single_staff_title_font_size_mobile']); ?>px;
      }

      #staff_list .title {
        font-size: <?php echo esc_html($options['archive_staff_title_font_size_mobile']); ?>px;
      }

      #staff_list .data_list .headline {
        font-size: <?php echo esc_html($options['archive_staff_featured_list_headline_font_size_mobile']); ?>px;
      }

      #side_staff_list .headline {
        font-size: <?php echo esc_html($options['side_staff_headline_font_size_mobile']); ?>px;
      }
    }

    <?php
                if (is_singular('staff')) {
                  global $post;
                  $staff_catch_font_size = get_post_meta($post->ID, 'staff_catch_font_size', true);
                  $staff_catch_font_size_mobile = get_post_meta($post->ID, 'staff_catch_font_size_mobile', true);
                  $staff_featured_list_headline_font_size = get_post_meta($post->ID, 'staff_featured_list_headline_font_size', true);
                  $staff_featured_list_headline_font_size_mobile = get_post_meta($post->ID, 'staff_featured_list_headline_font_size_mobile', true);
                  $staff_content_list_headline_font_size = get_post_meta($post->ID, 'staff_content_list_headline_font_size', true);
                  $staff_content_list_headline_font_size_mobile = get_post_meta($post->ID, 'staff_content_list_headline_font_size_mobile', true);
                  $staff_featured_list_headline_font_color = get_post_meta($post->ID, 'staff_featured_list_headline_font_color', true);
    ?><?php if ($staff_catch_font_size) { ?>.cf_catch .catch {
      font-size: <?php echo esc_html($staff_catch_font_size); ?>px;
    }

    <?php }; ?><?php if ($staff_featured_list_headline_font_size) { ?>.cf_data_list .headline {
      font-size: <?php echo esc_html($staff_featured_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($staff_content_list_headline_font_size) { ?>.cf_content_list .headline {
      font-size: <?php echo esc_html($staff_content_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($staff_featured_list_headline_font_color) { ?>.cf_data_list li span {
      color: <?php echo esc_attr($staff_featured_list_headline_font_color); ?>;
    }

    <?php }; ?>@media screen and (max-width:950px) {
      <?php if ($staff_catch_font_size_mobile) { ?>.cf_catch .catch {
        font-size: <?php echo esc_html($staff_catch_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($staff_content_list_headline_font_size_mobile) { ?>.cf_content_list .headline {
        font-size: <?php echo esc_html($staff_content_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($staff_featured_list_headline_font_size_mobile) { ?>.cf_data_list .headline {
        font-size: <?php echo esc_html($staff_featured_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?>
    }

    <?php }; ?><?php
                // キャンペーン -----------------------------------------------------------------------------
              } elseif (is_post_type_archive('campaign') || is_tax('campaign_category') || is_singular('campaign')) {
                ?>body.single #main_col {
      font-size: <?php echo esc_html($options['single_campaign_content_font_size']); ?>px;
    }

    #page_header_catch .catch {
      font-size: <?php echo esc_html($options['campaign_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['campaign_catch_color']); ?>;
    }

    #page_header_catch .desc {
      font-size: <?php echo esc_html($options['campaign_desc_font_size']); ?>px;
      color: <?php echo esc_html($options['campaign_desc_color']); ?>;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['campaign_title_font_size']); ?>px;
      color: <?php echo esc_html($options['campaign_title_color']); ?>;
    }

    #archive_campaign_category_list li a {
      background: <?php echo esc_html($options['archive_campaign_category_bg_color']); ?>;
      border-color: <?php echo esc_html($options['archive_campaign_category_border_color']); ?>;
    }

    #archive_campaign_category_list li a:hover,
    #archive_campaign_category_list li.active a {
      color: <?php echo esc_html($options['archive_campaign_category_font_color_hover']); ?>;
      background: <?php echo esc_html($options['archive_campaign_category_bg_color_hover']); ?>;
      border-color: <?php echo esc_html($options['archive_campaign_category_bg_color_hover']); ?>;
    }

    #campaign_list .title {
      font-size: <?php echo esc_html($options['archive_campaign_title_font_size']); ?>px;
    }

    #category_campaign_headline {
      font-size: <?php echo esc_html($options['category_campaign_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['category_campaign_headline_font_color']); ?>;
      background: <?php echo esc_html($options['category_campaign_headline_bg_color']); ?>;
      border-color: <?php echo esc_html($options['category_campaign_headline_border_color']); ?>;
    }

    #campaign_list2 .title {
      font-size: <?php echo esc_html($options['category_campaign_title_font_size']); ?>px;
      color: <?php echo esc_html($options['category_campaign_title_color']); ?>;
    }

    #side_campaign_category_list .headline {
      font-size: <?php echo esc_html($options['side_campaign_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['side_campaign_category_font_color']); ?>;
      background: <?php echo esc_html($options['side_campaign_category_bg_color']); ?>;
    }

    #side_campaign_category_list.type1 a {
      background: <?php echo esc_html($options['side_campaign_odd_bg_color']); ?>;
    }

    #side_campaign_category_list.type1 li:nth-child(even) a {
      background: <?php echo esc_html($options['side_campaign_even_bg_color']); ?>;
    }

    #side_campaign_category_list.type2 a {
      border-color: <?php echo esc_html($options['side_campaign_border_color']); ?>;
    }

    @media screen and (max-width:950px) {
      body.single #main_col {
        font-size: <?php echo esc_html($options['single_campaign_content_font_size_mobile']); ?>px;
      }

      #page_header_catch .catch {
        font-size: <?php echo esc_html($options['campaign_catch_font_size_mobile']); ?>px;
      }

      #page_header_catch .desc {
        font-size: <?php echo esc_html($options['campaign_desc_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['campaign_title_font_size_mobile']); ?>px;
      }

      #campaign_list .title {
        font-size: <?php echo esc_html($options['archive_campaign_title_font_size_mobile']); ?>px;
      }

      #category_campaign_headline {
        font-size: <?php echo esc_html($options['category_campaign_headline_font_size_mobile']); ?>px;
      }

      #campaign_list2 .title {
        font-size: <?php echo esc_html($options['category_campaign_title_font_size_mobile']); ?>px;
      }

      #side_campaign_category_list .headline {
        font-size: <?php echo esc_html($options['side_campaign_headline_font_size_mobile']); ?>px;
      }
    }

    <?php
                if (is_singular('campaign')) {
                  global $post;
                  $campaign_catch_font_size = get_post_meta($post->ID, 'campaign_catch_font_size', true);
                  $campaign_catch_font_size_mobile = get_post_meta($post->ID, 'campaign_catch_font_size_mobile', true);
                  $campaign_featured_list_headline_font_size = get_post_meta($post->ID, 'campaign_featured_list_headline_font_size', true);
                  $campaign_featured_list_headline_font_size_mobile = get_post_meta($post->ID, 'campaign_featured_list_headline_font_size_mobile', true);
                  $campaign_featured_list_check_color = get_post_meta($post->ID, 'campaign_featured_list_check_color', true);
                  $campaign_content_list_headline_font_size = get_post_meta($post->ID, 'campaign_content_list_headline_font_size', true);
                  $campaign_content_list_headline_font_size_mobile = get_post_meta($post->ID, 'campaign_content_list_headline_font_size_mobile', true);
                  $campaign_price_list_headline_font_size = get_post_meta($post->ID, 'campaign_price_list_headline_font_size', true);
                  $campaign_price_list_headline_font_size_mobile = get_post_meta($post->ID, 'campaign_price_list_headline_font_size_mobile', true);
    ?>#campaign_header_image .title {
      font-size: <?php echo esc_html($options['single_campaign_title_font_size']); ?>px;
    }

    <?php if ($campaign_catch_font_size) { ?>.cf_catch .catch {
      font-size: <?php echo esc_html($campaign_catch_font_size); ?>px;
    }

    <?php }; ?><?php if ($campaign_featured_list_headline_font_size) { ?>.cf_data_list .headline {
      font-size: <?php echo esc_html($campaign_featured_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($campaign_featured_list_check_color) { ?>.cf_data_list li:before {
      border: 1px solid <?php echo esc_html($campaign_featured_list_check_color); ?>;
      color: <?php echo esc_html($campaign_featured_list_check_color); ?>;
    }

    <?php }; ?><?php if ($campaign_content_list_headline_font_size) { ?>.cf_content_list .headline {
      font-size: <?php echo esc_html($campaign_content_list_headline_font_size); ?>px;
    }

    <?php }; ?><?php if ($campaign_price_list_headline_font_size) { ?>.cf_price_list .headline {
      font-size: <?php echo esc_html($campaign_price_list_headline_font_size); ?>px;
    }

    <?php }; ?>@media screen and (max-width:950px) {
      #campaign_header_image .title {
        font-size: <?php echo esc_html($options['single_campaign_title_font_size_mobile']); ?>px;
      }

      <?php if ($campaign_catch_font_size_mobile) { ?>.cf_catch .catch {
        font-size: <?php echo esc_html($campaign_catch_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($campaign_featured_list_headline_font_size_mobile) { ?>.cf_data_list .headline {
        font-size: <?php echo esc_html($campaign_featured_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($campaign_content_list_headline_font_size_mobile) { ?>.cf_content_list .headline {
        font-size: <?php echo esc_html($campaign_content_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?><?php if ($campaign_price_list_headline_font_size_mobile) { ?>.cf_price_list .headline {
        font-size: <?php echo esc_html($campaign_price_list_headline_font_size_mobile); ?>px;
      }

      <?php }; ?>
    }

    <?php }; ?><?php
                // FAQ -----------------------------------------------------------------------------
              } elseif (is_post_type_archive('faq') || is_tax('faq_category')) {
                ?>#page_header_catch .title {
      font-size: <?php echo esc_html($options['faq_title_font_size']); ?>px;
      color: <?php echo esc_html($options['faq_title_color']); ?>;
    }

    #faq_headline {
      font-size: <?php echo esc_html($options['archive_faq_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_faq_headline_font_color']); ?>;
      background: <?php echo esc_html($options['archive_faq_headline_bg_color']); ?>;
      border-color: <?php echo esc_html($options['archive_faq_headline_border_color']); ?>;
    }

    #faq_list .queestion:before {
      background: <?php echo esc_html($options['archive_faq_icon_bg_color']); ?>;
      color: <?php echo esc_html($options['archive_faq_icon_font_color']); ?>;
    }

    #faq_list .queestion {
      font-size: <?php echo esc_html($options['archive_faq_title_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_faq_title_color']); ?>;
    }

    #faq_list .post_content {
      font-size: <?php echo esc_html($options['archive_faq_content_font_size']); ?>px;
    }

    #faq_list .meta li {
      color: <?php echo esc_html($options['archive_faq_meta_color']); ?>;
    }

    #side_faq_category_list .headline {
      font-size: <?php echo esc_html($options['side_faq_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['side_faq_category_font_color']); ?>;
      background: <?php echo esc_html($options['side_faq_category_bg_color']); ?>;
    }

    #side_faq_category_list.type1 a {
      background: <?php echo esc_html($options['side_faq_odd_bg_color']); ?>;
    }

    #side_faq_category_list.type1 li:nth-child(even) a {
      background: <?php echo esc_html($options['side_faq_even_bg_color']); ?>;
    }

    #side_faq_category_list.type2 a {
      border-color: <?php echo esc_html($options['side_faq_border_color']); ?>;
    }

    @media screen and (max-width:950px) {
      #page_header_catch .title {
        font-size: <?php echo esc_html($options['faq_title_font_size_mobile']); ?>px;
      }

      #faq_headline {
        font-size: <?php echo esc_html($options['archive_faq_headline_font_size_mobile']); ?>px;
      }

      #faq_list .queestion {
        font-size: <?php echo esc_html($options['archive_faq_title_font_size_mobile']); ?>px;
      }

      #faq_list .post_content {
        font-size: <?php echo esc_html($options['archive_faq_content_font_size_mobile']); ?>px;
      }

      #side_faq_category_list .headline {
        font-size: <?php echo esc_html($options['side_faq_headline_font_size_mobile']); ?>px;
      }
    }

    <?php
                // お知らせ -----------------------------------------------------------------------------
              } elseif (is_post_type_archive('news') || is_singular('news')) {
    ?>body.single #main_col {
      font-size: <?php echo esc_html($options['single_news_content_font_size']); ?>px;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['news_title_font_size']); ?>px;
      color: <?php echo esc_html($options['news_title_color']); ?>;
    }

    #post_title_area .title {
      font-size: <?php echo esc_html($options['single_news_title_font_size']); ?>px;
    }

    #recent_news .headline {
      font-size: <?php echo esc_html($options['recent_news_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['recent_news_headline_color']); ?>;
    }

    @media screen and (max-width:950px) {
      body.single #main_col {
        font-size: <?php echo esc_html($options['single_news_content_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['news_title_font_size_mobile']); ?>px;
      }

      #post_title_area .title {
        font-size: <?php echo esc_html($options['single_news_title_font_size_mobile']); ?>px;
      }

      #recent_news .headline {
        font-size: <?php echo esc_html($options['recent_news_headline_font_size_mobile']); ?>px;
      }
    }

    <?php
                // コラム -----------------------------------------------------------------------------
              } elseif (is_post_type_archive('column') || is_tax('column_category') || is_singular('column')) {
    ?>body.single #main_col {
      font-size: <?php echo esc_html($options['single_column_content_font_size']); ?>px;
    }

    #page_header_catch .catch {
      font-size: <?php echo esc_html($options['column_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['column_catch_color']); ?>;
    }

    #page_header_catch .desc {
      font-size: <?php echo esc_html($options['column_desc_font_size']); ?>px;
      color: <?php echo esc_html($options['column_desc_color']); ?>;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['column_title_font_size']); ?>px;
      color: <?php echo esc_html($options['column_title_color']); ?>;
    }

    #archive_column .headline {
      font-size: <?php echo esc_html($options['archive_column_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_column_headline_color']); ?>;
    }

    #archive_column .title {
      font-size: <?php echo esc_html($options['archive_column_title_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_column_title_color']); ?>;
    }

    #archive_column .category a {
      color: <?php echo esc_html($options['column_category_font_color']); ?>;
      background: <?php echo esc_html($options['column_category_bg_color']); ?>;
    }

    #archive_column .category a:hover {
      color: <?php echo esc_html($options['column_category_font_color_hover']); ?>;
      background: <?php echo esc_html($options['column_category_bg_color_hover']); ?>;
    }

    #column_post_title_area .title {
      font-size: <?php echo esc_html($options['single_column_title_font_size']); ?>px;
      color: <?php echo esc_attr($options['single_column_title_color']); ?>;
    }

    #column_post_image .category a {
      color: <?php echo esc_html($options['column_category_font_color']); ?>;
      background: <?php echo esc_html($options['column_category_bg_color']); ?>;
    }

    #column_post_image .category a:hover {
      color: <?php echo esc_html($options['column_category_font_color_hover']); ?>;
      background: <?php echo esc_html($options['column_category_bg_color_hover']); ?>;
    }

    #related_post .headline {
      font-size: <?php echo esc_html($options['related_column_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['related_column_headline_color']); ?>;
    }

    @media screen and (max-width:950px) {
      #page_header_catch .catch {
        font-size: <?php echo esc_html($options['column_catch_font_size_mobile']); ?>px;
      }

      #page_header_catch .desc {
        font-size: <?php echo esc_html($options['column_desc_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['column_title_font_size_mobile']); ?>px;
      }

      #archive_column .headline {
        font-size: <?php echo esc_html($options['archive_column_headline_font_size_mobile']); ?>px;
      }

      #archive_column .title {
        font-size: <?php echo esc_html($options['archive_column_title_font_size_mobile']); ?>px;
      }
    }

    @media screen and (max-width:750px) {
      body.single #main_col {
        font-size: <?php echo esc_html($options['single_column_content_font_size_mobile']); ?>px;
      }

      #column_post_title_area .title {
        font-size: <?php echo esc_html($options['single_column_title_font_size_mobile']); ?>px;
      }

      #related_post .headline {
        font-size: <?php echo esc_html($options['related_column_headline_font_size_mobile']); ?>px;
      }
    }

    <?php
                // ブログ -----------------------------------------------------------------------------
              } elseif (is_archive() || is_home() || is_search() || is_single()) {
    ?>body.single #main_col {
      font-size: <?php echo esc_html($options['single_blog_content_font_size']); ?>px;
    }

    #page_header_catch .catch {
      font-size: <?php echo esc_html($options['blog_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['blog_catch_color']); ?>;
    }

    #page_header_catch .desc {
      font-size: <?php echo esc_html($options['blog_desc_font_size']); ?>px;
      color: <?php echo esc_html($options['blog_desc_color']); ?>;
    }

    #page_header_catch .title {
      font-size: <?php echo esc_html($options['blog_title_font_size']); ?>px;
      color: <?php echo esc_html($options['blog_title_color']); ?>;
    }

    #blog_list .title_area .title {
      font-size: <?php echo esc_html($options['archive_blog_title_font_size']); ?>px;
      color: <?php echo esc_html($options['archive_blog_title_color']); ?>;
    }

    #blog_list a:hover .title_area .title {
      color: <?php echo esc_html($options['archive_blog_title_color_hover']); ?>;
    }

    #blog_list .category a,
    #single_category a {
      color: <?php echo esc_html($options['blog_category_font_color']); ?>;
      background: <?php echo esc_html($options['blog_category_bg_color']); ?>;
    }

    #blog_list .category a:hover,
    #single_category a:hover {
      color: <?php echo esc_html($options['blog_category_font_color_hover']); ?>;
      background: <?php echo esc_html($options['blog_category_bg_color_hover']); ?>;
    }

    #post_title_area .title {
      font-size: <?php echo esc_html($options['single_blog_title_font_size']); ?>px;
    }

    #related_post .headline {
      font-size: <?php echo esc_html($options['related_headline_font_size']); ?>px;
      color: <?php echo esc_html($options['related_headline_color']); ?>;
    }

    @media screen and (max-width:950px) {
      body.single #main_col {
        font-size: <?php echo esc_html($options['single_blog_content_font_size_mobile']); ?>px;
      }

      #page_header_catch .catch {
        font-size: <?php echo esc_html($options['blog_catch_font_size_mobile']); ?>px;
      }

      #page_header_catch .desc {
        font-size: <?php echo esc_html($options['blog_desc_font_size_mobile']); ?>px;
      }

      #page_header_catch .title {
        font-size: <?php echo esc_html($options['blog_title_font_size_mobile']); ?>px;
      }

      #blog_list .title_area .title {
        font-size: <?php echo esc_html($options['archive_blog_title_font_size_mobile']); ?>px;
      }

      #post_title_area .title {
        font-size: <?php echo esc_html($options['single_blog_title_font_size_mobile']); ?>px;
      }

      #related_post .headline {
        font-size: <?php echo esc_html($options['related_headline_font_size_mobile']); ?>px;
      }
    }

    <?php
              }
              // トップページ -----------------------------------------------------------------------------
              if (is_front_page()) {
                // サイドボタン
                if ($options['show_index_side_button']) {
    ?>#index_side_button a {
      color: <?php echo esc_html($options['index_side_button_font']); ?>;
      background: <?php echo esc_html($options['index_side_button_bg']); ?>;
    }

    #index_side_button a:hover {
      color: <?php echo esc_html($options['index_side_button_font_hover']); ?>;
      background: <?php echo esc_html($options['index_side_button_bg_hover']); ?>;
    }

    <?php
                };
                // ボックスコンテンツ
                for ($row = 1; $row <= 3; $row++) :
                  if ($options['show_index_box_content_row' . $row] == 1) {
    ?><?php if ($options['index_box_content_row' . $row . '_type'] == 'type1') { ?>.index_box_content.row<?php echo $row; ?>.title {
      font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_title_font_size']); ?>px;
    }

    <?php } else { ?>.index_box_content.row<?php echo $row; ?>.title {
      font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_title_font_size2']); ?>px;
    }

    <?php }; ?>.index_box_content.row<?php echo $row; ?>.sub_title {
      font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_sub_title_font_size']); ?>px;
    }

    .index_box_content.row<?php echo $row; ?>.catch {
      font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_catch_font_size']); ?>px;
    }

    @media screen and (max-width:950px) {
      .index_box_content.row<?php echo $row; ?>.title {
        font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_title_font_size_mobile']); ?>px;
      }

      .index_box_content.row<?php echo $row; ?>.sub_title {
        font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_sub_title_font_size_mobile']); ?>px;
      }

      .index_box_content.row<?php echo $row; ?>.catch {
        font-size: <?php echo esc_html($options['index_box_content_row' . $row . '_catch_font_size_mobile']); ?>px;
      }
    }

    <?php
                  }
                endfor;
                // クリニック案内
                if ($options['show_index_clinic']) {
    ?>#index_clinic .catch {
      font-size: <?php echo esc_html($options['index_clinic_catch_font_size']); ?>px;
    }

    #index_clinic .desc {
      font-size: <?php echo esc_html($options['index_clinic_desc_font_size']); ?>px;
    }

    #index_clinic .title_area .title {
      font-size: <?php echo esc_html($options['index_clinic_title_font_size']); ?>px;
    }

    #index_clinic .title_area {
      color: <?php echo esc_html($options['index_clinic_font_color']); ?>;
      background: <?php echo esc_html($options['index_clinic_bg_color']); ?>;
    }

    #index_clinic .item a:hover .title_area {
      color: <?php echo esc_html($options['index_clinic_font_color_hover']); ?>;
      background: <?php echo esc_html($options['index_clinic_bg_color_hover']); ?>;
    }

    #index_clinic .index_cb_button a {
      color: <?php echo esc_html($options['index_clinic_link_font_color']); ?>;
      background: <?php echo esc_html($options['index_clinic_link_bg_color']); ?>;
    }

    #index_clinic .index_cb_button a:hover {
      color: <?php echo esc_html($options['index_clinic_link_font_color_hover']); ?>;
      background: <?php echo esc_html($options['index_clinic_link_bg_color_hover']); ?>;
    }

    @media screen and (max-width:950px) {
      #index_clinic .catch {
        font-size: <?php echo esc_html($options['index_clinic_catch_font_size_mobile']); ?>px;
      }

      #index_clinic .desc {
        font-size: <?php echo esc_html($options['index_clinic_desc_font_size_mobile']); ?>px;
      }

      #index_clinic .post_list .title {
        font-size: <?php echo esc_html($options['index_clinic_title_font_size_mobile']); ?>px;
      }
    }

    <?php
                }
                // キャンペーンコンテンツ1
                if ($options['show_index_campaign']) {
    ?>#index_campaign1 .index_cb_catch {
      color: <?php echo esc_html($options['index_campaign_font_color']); ?>;
    }

    #index_campaign1 .catch {
      font-size: <?php echo esc_html($options['index_campaign_catch_font_size']); ?>px;
    }

    #index_campaign1 .desc {
      font-size: <?php echo esc_html($options['index_campaign_desc_font_size']); ?>px;
    }

    #index_campaign_slider .title {
      font-size: <?php echo esc_html($options['index_campaign_title_font_size']); ?>px;
    }

    #index_campaign1 .index_cb_button a {
      color: <?php echo esc_html($options['index_campaign_link_font_color']); ?>;
      background: <?php echo esc_html($options['index_campaign_link_bg_color']); ?>;
    }

    #index_campaign1 .index_cb_button a:hover {
      color: <?php echo esc_html($options['index_campaign_link_font_color_hover']); ?>;
      background: <?php echo esc_html($options['index_campaign_link_bg_color_hover']); ?>;
    }

    @media screen and (max-width:950px) {
      #index_campaign1 .catch {
        font-size: <?php echo esc_html($options['index_campaign_catch_font_size_mobile']); ?>px;
      }

      #index_campaign1 .desc {
        font-size: <?php echo esc_html($options['index_campaign_desc_font_size_mobile']); ?>px;
      }

      #index_campaign_slider .title {
        font-size: <?php echo esc_html($options['index_campaign_title_font_size_mobile']); ?>px;
      }
    }

    <?php
                };
                // お知らせ
                if ($options['show_index_news']) {
    ?>#index_news .catch {
      font-size: <?php echo esc_html($options['index_news_catch_font_size']); ?>px;
    }

    #index_news .desc {
      font-size: <?php echo esc_html($options['index_news_desc_font_size']); ?>px;
    }

    #index_news .index_cb_button a {
      color: <?php echo esc_html($options['index_news_link_font_color']); ?>;
      background: <?php echo esc_html($options['index_news_link_bg_color']); ?>;
    }

    #index_news .index_cb_button a:hover {
      color: <?php echo esc_html($options['index_news_link_font_color_hover']); ?>;
      background: <?php echo esc_html($options['index_news_link_bg_color_hover']); ?>;
    }

    @media screen and (max-width:950px) {
      #index_news .catch {
        font-size: <?php echo esc_html($options['index_news_catch_font_size_mobile']); ?>px;
      }

      #index_news .desc {
        font-size: <?php echo esc_html($options['index_news_desc_font_size_mobile']); ?>px;
      }
    }

    <?php
                };
                // バナーコンテンツ
                if ($options['show_index_banner']) {
                  for ($i = 1; $i <= 2; $i++) :
    ?>#index_banner .box<?php echo $i; ?>.title {
      font-size: <?php echo esc_html($options['index_banner_title_font_size' . $i]); ?>px;
    }

    @media screen and (max-width:950px) {
      #index_banner .box<?php echo $i; ?>.title {
        font-size: <?php echo esc_html($options['index_banner_title_font_size_mobile' . $i]); ?>px;
      }
    }

    <?php
                  endfor;
                };
                // キャンペーンコンテンツ2
                if ($options['show_index_campaign2']) {
    ?>#index_campaign2 .catch {
      font-size: <?php echo esc_html($options['index_campaign2_catch_font_size']); ?>px;
    }

    #index_campaign2 .desc {
      font-size: <?php echo esc_html($options['index_campaign2_desc_font_size']); ?>px;
    }

    #campaign_list .item.large .title {
      font-size: <?php echo esc_html($options['index_campaign2_title_font_size']); ?>px;
    }

    #campaign_list .item .title {
      font-size: <?php echo esc_html($options['index_campaign2_title_font_size_small']); ?>px;
    }

    #index_campaign2 .index_cb_button a {
      color: <?php echo esc_html($options['index_campaign2_link_font_color']); ?>;
      background: <?php echo esc_html($options['index_campaign2_link_bg_color']); ?>;
    }

    #index_campaign2 .index_cb_button a:hover {
      color: <?php echo esc_html($options['index_campaign2_link_font_color_hover']); ?>;
      background: <?php echo esc_html($options['index_campaign2_link_bg_color_hover']); ?>;
    }

    @media screen and (max-width:950px) {
      #index_campaign2 .catch {
        font-size: <?php echo esc_html($options['index_campaign2_catch_font_size_mobile']); ?>px;
      }

      #index_campaign2 .desc {
        font-size: <?php echo esc_html($options['index_campaign2_desc_font_size_mobile']); ?>px;
      }

      #campaign_list .title {
        font-size: <?php echo esc_html($options['index_campaign2_title_font_size_mobile']); ?>px !important;
      }
    }

    <?php
                };
                // スタッフ
                if ($options['show_index_staff']) {
    ?>#index_staff .index_cb_catch {
      color: <?php echo esc_html($options['index_staff_font_color']); ?>;
    }

    #index_staff .catch {
      font-size: <?php echo esc_html($options['index_staff_catch_font_size']); ?>px;
    }

    #index_staff .desc {
      font-size: <?php echo esc_html($options['index_staff_desc_font_size']); ?>px;
    }

    #index_staff_slider .desc span {
      color: <?php echo esc_html($options['index_staff_span_color']); ?>;
    }

    #index_staff .index_cb_button a {
      color: <?php echo esc_html($options['index_staff_link_font_color']); ?>;
      background: <?php echo esc_html($options['index_staff_link_bg_color']); ?>;
    }

    #index_staff .index_cb_button a:hover {
      color: <?php echo esc_html($options['index_staff_link_font_color_hover']); ?>;
      background: <?php echo esc_html($options['index_staff_link_bg_color_hover']); ?>;
    }

    @media screen and (max-width:950px) {
      #index_staff .catch {
        font-size: <?php echo esc_html($options['index_staff_catch_font_size_mobile']); ?>px;
      }

      #index_staff .desc {
        font-size: <?php echo esc_html($options['index_staff_desc_font_size_mobile']); ?>px;
      }
    }

    <?php
                };
                // ヘッダーコンテンツ　キャプションとオーバーレイ　・・・画像スライダーは別
                if ($options['header_content_type'] != 'type1') {
                  // キャプション
                  if ($options['show_header_catch'] == 1) {
    ?>#header_slider_wrap .title {
      font-size: <?php echo esc_html($options['header_catch_font_size']); ?>px;
      color: <?php echo esc_html($options['header_catch_color']); ?>;
    }

    #header_slider_wrap .caption .sub_title {
      font-size: <?php echo esc_html($options['header_catch_sub_title_font_size']); ?>px;
      color: <?php echo esc_html($options['header_catch_sub_title_color']); ?>;
    }

    @media screen and (max-width:950px) {
      #header_slider_wrap .title {
        font-size: <?php echo esc_html($options['header_catch_font_size_mobile']); ?>px;
      }

      #header_slider_wrap .caption .sub_title {
        font-size: <?php echo esc_html($options['header_catch_sub_title_font_size_mobile']); ?>px;
      }
    }

    <?php
                  };
                  // ボタン
                  if ($options['header_catch_show_button'] == 1) {
    ?>#header_slider_wrap .button {
      color: <?php echo esc_html($options['header_catch_button_font_color']); ?>;
      background: <?php echo esc_html($options['header_catch_button_bg_color']); ?>;
    }

    #header_slider_wrap .button:hover {
      color: <?php echo esc_html($options['header_catch_button_font_color_hover']); ?>;
      background: <?php echo esc_html($options['header_catch_button_bg_color_hover']); ?>;
    }

    <?php
                  }
                  // オーバーレイ
                  if ($options['use_header_overlay'] == 1) {
                    $header_overlay_color = hex2rgb($options['header_overlay_color']);
                    $header_overlay_color = implode(",", $header_overlay_color);
                    if ($options['use_header_overlay_gd']) {
    ?>#header_slider_wrap .overlay {
      background: -webkit-linear-gradient(top, transparent, rgba(<?php echo esc_html($header_overlay_color); ?>, <?php echo esc_html($options['header_overlay_opacity']); ?>));
      background: linear-gradient(to bottom, transparent, rgba(<?php echo esc_html($header_overlay_color); ?>, <?php echo esc_html($options['header_overlay_opacity']); ?>));
    }

    <?php } else { ?>#header_slider_wrap .overlay {
      background: rgba(<?php echo esc_html($header_overlay_color); ?>, <?php echo esc_html($options['header_overlay_opacity']); ?>);
    }

    <?php
                    }; //END use header overlay
                  }; // header content type not 1
                  // ヘッダーコンテンツ 画像スライダー
                } elseif ($options['header_content_type'] == 'type1') {
                  for ($i = 1; $i <= 5; $i++) :
                    // キャッチフレーズ
                    if ($options['header_slider_show_catch' . $i] == 1) {
    ?>#header_slider .item<?php echo $i; ?>.title {
      font-size: <?php echo esc_html($options['header_slider_catch_font_size' . $i]); ?>px;
      color: <?php echo esc_html($options['header_slider_catch_color' . $i]); ?>;
    }

    #header_slider .item<?php echo $i; ?>.sub_title {
      font-size: <?php echo esc_html($options['header_slider_sub_title_font_size' . $i]); ?>px;
      color: <?php echo esc_html($options['header_slider_sub_title_color' . $i]); ?>;
    }

    @media screen and (max-width:950px) {
      #header_slider .item<?php echo $i; ?>.title {
        font-size: <?php echo esc_html($options['header_slider_catch_font_size_mobile' . $i]); ?>px;
      }

      #header_slider .item<?php echo $i; ?>.sub_title {
        font-size: <?php echo esc_html($options['header_slider_sub_title_font_size_mobile' . $i]); ?>px;
      }
    }

    <?php
                    }
                    // ボタン
                    if ($options['header_slider_show_button' . $i] == 1) {
    ?>#header_slider .item<?php echo $i; ?>.button {
      color: <?php echo esc_html($options['header_slider_button_font_color' . $i]); ?>;
      background: <?php echo esc_html($options['header_slider_button_bg_color' . $i]); ?>;
    }

    #header_slider .item<?php echo $i; ?>.button:hover {
      color: <?php echo esc_html($options['header_slider_button_font_color_hover' . $i]); ?>;
      background: <?php echo esc_html($options['header_slider_button_bg_color_hover' . $i]); ?>;
    }

    <?php
                    }
                  endfor;
                };
                // 固定ページ -----------------------------------------------------------------------------
              } elseif (is_page()) {
                global $post;
                $title_font_size = get_post_meta($post->ID, 'page_title_font_size', true);
                if (empty($title_font_size)) {
                  $title_font_size = '38';
                };
                $title_font_size_mobile = get_post_meta($post->ID, 'page_title_font_size_mobile', true);
                if (empty($title_font_size_mobile)) {
                  $title_font_size_mobile = '24';
                };
    ?>#page_header .catch {
      font-size: <?php echo esc_html($title_font_size); ?>px;
    }

    @media screen and (max-width:750px) {
      #page_header .catch {
        font-size: <?php echo esc_html($title_font_size_mobile); ?>px;
      }
    }

    <?php
                // 404ページ -----------------------------------------------------------------------------
              } elseif (is_404()) {
                $title_font_size_pc = (! empty($options['header_txt_size_404'])) ? $options['header_txt_size_404'] : 38;
                $sub_title_font_size_pc = (! empty($options['header_sub_txt_size_404'])) ? $options['header_sub_txt_size_404'] : 16;
                $title_font_size_mobile = (! empty($options['header_txt_size_404_mobile'])) ? $options['header_txt_size_404_mobile'] : 28;
                $sub_title_font_size_mobile = (! empty($options['header_sub_txt_size_404_mobile'])) ? $options['header_sub_txt_size_404_mobile'] : 14;
    ?>#page_404 .title {
      font-size: <?php echo esc_html($title_font_size_pc); ?>px;
    }

    #page_404 .sub_title {
      font-size: <?php echo esc_html($sub_title_font_size_pc); ?>px;
    }

    @media screen and (max-width:750px) {
      #page_404 .title {
        font-size: <?php echo esc_html($title_font_size_mobile); ?>px;
      }

      #page_404 .sub_title {
        font-size: <?php echo esc_html($sub_title_font_size_mobile); ?>px;
      }
    }

    <?php
              }; //END page setting
    ?><?php
      // サムネイルのアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
      if ($options['hover_type'] != "type4") {

        // ズーム ------------------------------------------------------------------------------
        if ($options['hover_type'] == "type1") {
      ?>.author_profile a.avatar img,
    .animate_image img,
    .animate_background .image {
      width: 100%;
      height: auto;
      -webkit-transition: transform 0.75s ease;
      transition: transform 0.75s ease;
    }

    .author_profile a.avatar:hover img,
    .animate_image:hover img,
    .animate_background:hover .image,
    #index_staff_slider a:hover img {
      -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
      transform: scale(<?php echo $options['hover1_zoom']; ?>);
    }


    <?php
          // スライド ------------------------------------------------------------------------------
        } elseif ($options['hover_type'] == "type2") {
    ?>.animate_image img,
    .animate_background .image {
      -webkit-width: calc(100% + 30px) !important;
      width: calc(100% + 30px) !important;
      height: auto;
      max-width: inherit !important;
      position: relative;
      <?php if ($options['hover2_direct'] == 'type1'): ?>-webkit-transform: translate(-15px, 0px);
      -webkit-transition-property: opacity, translateX;
      -webkit-transition: 0.5s;
      transform: translate(-15px, 0px);
      transition-property: opacity, translateX;
      transition: 0.5s;
      <?php else: ?>-webkit-transform: translate(-15px, 0px);
      -webkit-transition-property: opacity, translateX;
      -webkit-transition: 0.5s;
      transform: translate(-15px, 0px);
      transition-property: opacity, translateX;
      transition: 0.5s;
      <?php endif; ?>
    }

    .animate_image:hover img,
    .animate_background:hover .image,
    #index_staff_slider a:hover img {
      opacity: <?php echo $options['hover2_opacity']; ?>;
      <?php if ($options['hover2_direct'] == 'type1'): ?>-webkit-transform: translate(0px, 0px);
      transform: translate(0px, 0px);
      <?php else: ?>-webkit-transform: translate(-30px, 0px);
      transform: translate(-30px, 0px);
      <?php endif; ?>
    }

    .animate_image.square img {
      -webkit-width: calc(100% + 30px) !important;
      width: calc(100% + 30px) !important;
      height: auto;
      max-width: inherit !important;
      position: relative;
      <?php if ($options['hover2_direct'] == 'type1'): ?>-webkit-transform: translate(-15px, -15px);
      -webkit-transition-property: opacity, translateX;
      -webkit-transition: 0.5s;
      transform: translate(-15px, -15px);
      transition-property: opacity, translateX;
      transition: 0.5s;
      <?php else: ?>-webkit-transform: translate(-15px, -15px);
      -webkit-transition-property: opacity, translateX;
      -webkit-transition: 0.5s;
      transform: translate(-15px, -15px);
      transition-property: opacity, translateX;
      transition: 0.5s;
      <?php endif; ?>
    }

    .animate_image.square:hover img {
      opacity: <?php echo $options['hover2_opacity']; ?>;
      <?php if ($options['hover2_direct'] == 'type1'): ?>-webkit-transform: translate(0px, -15px);
      transform: translate(0px, -15px);
      <?php else: ?>-webkit-transform: translate(-30px, -15px);
      transform: translate(-30px, -15px);
      <?php endif; ?>
    }

    <?php
          // フェードアウト ------------------------------------------------------------------------------
        } elseif ($options['hover_type'] == "type3") {
    ?>.author_profile a.avatar,
    .animate_image,
    .animate_background,
    .animate_background .image_wrap {
      background: <?php echo $options['hover3_bgcolor']; ?>;
    }

    .author_profile a.avatar img,
    .animate_image img,
    .animate_background .image {
      -webkit-transition-property: opacity;
      -webkit-transition: 0.5s;
      transition-property: opacity;
      transition: 0.5s;
    }

    .author_profile a.avatar:hover img,
    .animate_image:hover img,
    .animate_background:hover .image,
    #index_staff_slider a:hover img {
      opacity: <?php echo $options['hover3_opacity']; ?>;
    }

    <?php };
      }; // アニメーションここまで 
    ?><?php
      // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

      // メインカラー ----------------------------------
      $main_color = esc_html($options['main_color']);
      ?>a {
      color: #000;
    }

    #bread_crumb li.last span,
    #comment_headline,
    .tcd_category_list a:hover,
    .tcd_category_list .child_menu_button:hover,
    .side_headline,
    #faq_category li a:hover,
    #faq_category li.active a,
    #archive_service .bottom_area .sub_category li a:hover,
    #side_service_category_list a:hover,
    #side_service_category_list li.active>a,
    #side_faq_category_list a:hover,
    #side_faq_category_list li.active a,
    #side_staff_list a:hover,
    #side_staff_list li.active a,
    .cf_data_list li a:hover,
    #side_campaign_category_list a:hover,
    #side_campaign_category_list li.active a,
    #side_clinic_list a:hover,
    #side_clinic_list li.active a {
      color: <?php echo $main_color; ?>;
    }

    #page_header .tab,
    #return_top a,
    #comment_tab li a:hover,
    #comment_tab li.active a,
    #comment_header #comment_closed p,
    #submit_comment:hover,
    #cancel_comment_reply a:hover,
    #p_readmore .button:hover,
    #wp-calendar td a:hover,
    #post_pagination p,
    #post_pagination a:hover,
    .page_navi span.current,
    .page_navi a:hover,
    .c-pw__btn:hover {
      background-color: <?php echo $main_color; ?>;
    }

    #guest_info input:focus,
    #comment_textarea textarea:focus,
    .c-pw__box-input:focus {
      border-color: <?php echo $main_color; ?>;
    }

    #comment_tab li.active a:after,
    #comment_header #comment_closed p:after {
      border-color: <?php echo $main_color; ?> transparent transparent transparent;
    }


    <?php
    // サブカラー ----------------------------------
    $sub_color = esc_html($options['sub_color']);
    ?>#header_logo a:hover,
    #footer a:hover,
    .cardlink_title a:hover,
    #menu_button:hover:before,
    #header_logo a:hover,
    #related_post .item a:hover,
    .comment a:hover,
    .comment_form_wrapper a:hover,
    #next_prev_post a:hover,
    #bread_crumb a:hover,
    #bread_crumb li.home a:hover:after,
    .author_profile a:hover,
    .author_profile .author_link li a:hover:before,
    #post_meta_bottom a:hover,
    #next_prev_post a:hover:before,
    #recent_news a.link:hover,
    #recent_news .link:hover:after,
    #recent_news li a:hover .title,
    #searchform .submit_button:hover:before,
    .styled_post_list1 a:hover .title_area,
    .styled_post_list1 a:hover .date,
    .p-dropdown__title:hover:after,
    .p-dropdown__list li a:hover {
      color: <?php echo esc_html($sub_color); ?>;
    }

    <?php
    // その他のカラー ----------------------------------
    ?>.post_content a,
    .custom-html-widget a {
      color: <?php echo esc_html($options['content_link_color']); ?>;
    }

    .post_content a:hover,
    .custom-html-widget a:hover {
      color: <?php echo esc_html($options['content_link_hover_color']); ?>;
    }

    #return_top a:hover {
      background-color: <?php echo esc_html($options['return_top_hover_color']); ?>;
    }

    <?php
    //すりガラスエフェクト ------------------------------
    $frost_color = hex2rgb($options['frost_color']);
    $frost_color = implode(",", $frost_color);
    ?>.frost_bg:before {
      background: rgba(<?php echo esc_html($frost_color); ?>, <?php echo esc_html($options['frost_opacity']); ?>);
    }

    .blur_image img {
      filter: blur(<?php echo esc_attr($options['frost_blur']); ?>px);
    }

    <?php
    // キャンペーンカテゴリー ----------------------------------
    $campaign_category = get_terms('campaign_category', array('hide_empty' => true));
    if ($campaign_category && ! is_wp_error($campaign_category)) :
      foreach ($campaign_category as $cat):
        $cat_id = $cat->term_id;
        $custom_fields = get_option('taxonomy_' . $cat_id, array());
        if (!empty($custom_fields['color'])) {
    ?>.campaign_cat_id<?php echo $cat_id; ?> {
      background: <?php echo $custom_fields['color']; ?>;
    }

    .campaign_cat_id<?php echo $cat_id; ?>:hover {
      background: <?php echo $custom_fields['color_hover']; ?>;
    }

    <?php
        }
      endforeach;
    endif;

    // その他のスタイル ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

    // loading screen -----------------------------------------
    get_template_part('functions/loader');
    ?><?php
      //フッターバー --------------------------------------------
      if (is_mobile()) {
        if ($options['footer_bar_display'] == 'type1' || $options['footer_bar_display'] == 'type2') {
      ?>.dp-footer-bar {
      background: <?php echo 'rgba(' . implode(',', hex2rgb($options['footer_bar_bg'])) . ', ' . esc_html($options['footer_bar_tp']) . ');'; ?> border-top: solid 1px <?php echo esc_html($options['footer_bar_border']); ?>;
      color: <?php echo esc_html($options['footer_bar_color']); ?>;
      display: flex;
      flex-wrap: wrap;
    }

    .dp-footer-bar a {
      color: <?php echo esc_html($options['footer_bar_color']); ?>;
    }

    .dp-footer-bar-item+.dp-footer-bar-item {
      border-left: solid 1px <?php echo esc_html($options['footer_bar_border']); ?>;
    }

    <?php
        };
      };
    ?><?php
      // カスタムCSS --------------------------------------------
      if ($options['css_code']) {
        echo wp_kses_post($options['css_code']);
      };
      if (is_single() || is_page()) {
        global $post;
        $custom_css = get_post_meta($post->ID, 'custom_css', true);
        if ($custom_css) {
          echo wp_kses_post($custom_css);
        };
      }
      ?>
  </style>

  <?php
  // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

  // トップページ
  if (is_front_page()) {
    // パララックススライダー --------------------------------------------------
    if ($options['header_content_type'] == 'type4') {
  ?>
      <script src="<?php echo get_template_directory_uri(); ?>/js/parallax-slider.js?ver=<?php echo version_num(); ?>"></script>
    <?php
      // 画像スライダー --------------------------------------------------
    } elseif ($options['header_content_type'] == 'type1') {
      wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri() . '/js/slick.css'), '', '1.0.0');
      wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri() . '/js/slick.min.js'), '', '1.0.0', true);
    ?>

      <script type="text/javascript">
        jQuery(document).ready(function($) {

          $('#header_slider').slick({
            infinite: true,
            //dots: false,
            dots: true,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false,
            pauseOnHover: false,
            autoplay: true,
            fade: true,
            easing: 'easeOutExpo',
            speed: 1500,
            autoplaySpeed: <?php echo esc_html($options['header_slider_time']); ?>
          });
          $('#header_slider .item1').addClass('animate');
          $('#header_slider').on("beforeChange", function(event, slick, currentSlide, nextSlide) {
            $('#header_slider .item').eq(nextSlide).addClass('animate');
          });
          $('#header_slider').on("afterChange", function(event, slick, currentSlide, nextSlide) {
            $('#header_slider .item1').removeClass('first_active');
            $('#header_slider .item').not(':eq(' + currentSlide + ')').removeClass('animate');
          });

        });
      </script>
      <?php
    };
    // Youtube ------------------------------------------------------------
    if ($options['header_content_type'] == 'type3') {
      if (!wp_is_mobile()) {
      ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/jquery.mb.YTPlayer.min.css?ver=<?php echo version_num(); ?>">
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mb.YTPlayer.min.js?ver=<?php echo version_num(); ?>"></script>
        <script type="text/javascript">
          jQuery(document).ready(function($) {
            $("#youtube_video_player").YTPlayer();
          });
        </script>
    <?php
      };
    };
    // キャンペーンスライダー ------------------------------------------------------------
    //if($options['show_index_campaign']){ コメントアウト by hanahana 2023.02.20
    wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri() . '/js/slick.css'), '', '1.0.0');
    wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri() . '/js/slick.min.js'), '', '1.0.0', true);
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {

        $('#index_campaign_slider').slick({
          infinite: true,
          dots: false,
          arrows: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          adaptiveHeight: false,
          pauseOnHover: false,
          autoplay: true,
          fade: false,
          easing: 'easeOutExpo',
          speed: 700,
          autoplaySpeed: <?php echo esc_html($options['index_campaign_slider_time']); ?>,
          responsive: [{
              breakpoint: 950,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 550,
              settings: {
                slidesToShow: 1
              }
            }
          ]
        });
        $('#index_campaign_slider_left_arrow').on('click', function() {
          $('#index_campaign_slider').slick('slickPrev');
        });
        $('#index_campaign_slider_right_arrow').on('click', function() {
          $('#index_campaign_slider').slick('slickNext');
        });
      });

      jQuery(document).ready(function($) {

        $('#index_campaign_slider_top').slick({
          infinite: true,
          dots: false,
          arrows: false,
          slidesToShow: 4,
          slidesToScroll: 1,
          adaptiveHeight: false,
          pauseOnHover: false,
          autoplay: true,
          fade: false,
          easing: 'easeOutExpo',
          autoplaySpeed: 5000,
          speed: 700,
          responsive: [{
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }]
        });
      });
    </script>
    <?php
    //}
    // スタッフスライダー ------------------------------------------------------------
    if ($options['show_index_staff']) {
      wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri() . '/js/slick.css'), '', '1.0.0');
      wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri() . '/js/slick.min.js'), '', '1.0.0', true);
    ?>
      <script type="text/javascript">
        jQuery(document).ready(function($) {

          $('#index_staff_slider').slick({
            infinite: true,
            dots: false,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            adaptiveHeight: false,
            pauseOnHover: false,
            autoplay: true,
            fade: false,
            easing: 'easeOutExpo',
            speed: 700,
            autoplaySpeed: 7000,
            responsive: [{
                breakpoint: 1250,
                settings: {
                  slidesToShow: 3
                }
              },
              {
                breakpoint: 750,
                settings: {
                  slidesToShow: 2
                }
              },
              {
                breakpoint: 550,
                settings: {
                  slidesToShow: 1
                }
              }
            ]
          });
          $('#index_staff_slider_left_arrow').on('click', function() {
            $('#index_staff_slider').slick('slickPrev');
          });
          $('#index_staff_slider_right_arrow').on('click', function() {
            $('#index_staff_slider').slick('slickNext');
          });
        });
      </script>
    <?php
    }
  }; // END トップページ

  // ウィジェット --------------------
  if (is_active_widget(false, false, 'campaign_slider_widget', true)) {
    wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri() . '/js/slick.css'), '', '1.0.0');
    wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri() . '/js/slick.min.js'), '', '1.0.0', true);
    ?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {

        if ($('.campaign_slider').length) {
          $('.campaign_slider').slick({
            infinite: true,
            dots: false,
            arrows: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: false,
            pauseOnHover: false,
            autoplay: true,
            fade: false,
            easing: 'easeOutExpo',
            speed: 700,
            autoplaySpeed: 7000,
            responsive: [{
                breakpoint: 950,
                settings: {
                  slidesToShow: 2
                }
              },
              {
                breakpoint: 550,
                settings: {
                  slidesToShow: 1
                }
              }
            ]
          });
        }

      });
    </script>
<?php
  }
}; // END function tcd_head()
add_action("wp_head", "child_tcd_head");



?>