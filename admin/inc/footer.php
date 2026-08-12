<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

  //バナーの設定
	$dp_default_options['footer_banner_font_color'] = '#f95660';
	$dp_default_options['footer_banner_font_size'] = '20';
	$dp_default_options['footer_banner_font_size_mobile'] = '16';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['show_footer_banner'.$i] = 1;
		$dp_default_options['footer_banner_image'.$i] = false;
		$dp_default_options['footer_banner_url'.$i] = '#';
		$dp_default_options['footer_banner_title'.$i] = __( 'Title', 'tcd-w' );
		$dp_default_options['footer_banner_target'.$i] = 1;
	}

  //会社情報・インフォメーションの設定
	$dp_default_options['show_footer_company_info'] = 1;
	$dp_default_options['show_footer_logo'] = '';
	$dp_default_options['footer_company_info'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['show_footer_info'.$i] = 1;
		$dp_default_options['footer_info_title'.$i] = __( 'Title', 'tcd-w' );
		$dp_default_options['footer_info_desc'.$i] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
		$dp_default_options['footer_info_url'.$i] = '#';
		$dp_default_options['footer_info_target' . $i] = '';
		$dp_default_options['footer_info_button_label'.$i] = __( 'Sample button', 'tcd-w' );
		$dp_default_options['show_footer_info_button'.$i] = 1;
		$dp_default_options['foonter_info_button_font_color'.$i] = '#FFFFFF';
		$dp_default_options['foonter_info_button_bg_color'.$i] = '#222222';
		$dp_default_options['foonter_info_button_font_color_hover'.$i] = '#FFFFFF';
		$dp_default_options['foonter_info_button_bg_color_hover'.$i] = '#f45963';
	}

  //メニューエリアの設定
	$dp_default_options['footer_show_home_menu'] = 1;
	$dp_default_options['footer_menu_bg_color'] = '#f4f4f5';
	$dp_default_options['footer_menu_font_color'] = '#000000';
	$dp_default_options['footer_menu_font_color_hover'] = '#f95660';
	$dp_default_options['footer_menu_headline_color'] = '#f95660';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['footer_show_category_menu'.$i] = 1;
		$dp_default_options['footer_category_menu_num'.$i] = '8';
		$dp_default_options['footer_category_menu_type'.$i] = '0';
	}

  //SNS
	$dp_default_options['footer_facebook_url'] = '';
	$dp_default_options['footer_twitter_url'] = '';
	$dp_default_options['footer_instagram_url'] = '';
	$dp_default_options['footer_pinterest_url'] = '';
	$dp_default_options['footer_youtube_url'] = '';
	$dp_default_options['footer_contact_url'] = '';
	$dp_default_options['footer_show_rss'] = 1;

  //コピーライト
	$dp_default_options['copyright_font_color'] = '#FFFFFF';
	$dp_default_options['copyright_bg_color'] = '#222222';
	$dp_default_options['copyright'] = 'Copyright &copy; 2018';

	// フッターコンテンツの設定
	$dp_default_options['footer_content_type'] = 'type1';

	// フッターボタンの設定
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['show_footer_button'.$i] = '';
		$dp_default_options['footer_button_label'.$i] = '';
		$dp_default_options['footer_button_url'.$i] = '';
		$dp_default_options['footer_button_target' . $i] = '';
		$dp_default_options['footer_button_font_color'.$i] = '#FFFFFF';
		$dp_default_options['footer_button_bg_color'.$i] = '#222222';
		$dp_default_options['footer_button_font_color_hover'.$i] = '#FFFFFF';
		$dp_default_options['footer_button_bg_color_hover'.$i] = '#f45963';
	}

	// フッターの固定メニュー
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_tp'] = 0.8;
	$dp_default_options['footer_bar_bg'] = '#FFFFFF';
	$dp_default_options['footer_bar_border'] = '#DDDDDD';
	$dp_default_options['footer_bar_color'] = '#000000';
	$dp_default_options['footer_bar_btns'] = array(
		array(
			'type' => 'type1',
			'label' => '',
			'url' => '',
			'number' => '',
			'target' => 0,
			'icon' => 'file-text'
		)
	);

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $fixed_footer_banner_type_options, $fixed_footer_sub_content_type_options, $footer_content_type_options;

  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-w' );

  // サービスカテゴリー
  global $service_category_options;
  $service_category = get_terms( 'service_category', array( 'hide_empty' => true, 'orderby' => 'id', 'parent' => 0) );
  $service_category_options[0] = array('value' => 0, 'label' => __( 'All category', 'tcd-w' ));
  if(!empty($service_category)){
    foreach( $service_category as $cat ) :
      $service_category_options[$cat->term_id] = array('value' => $cat->term_id, 'label' => $cat->name);
    endforeach;
  };
?>

<div id="tab-content-footer" class="tab-content">


   <?php // バナーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner contents setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('Content%s setting', 'tcd-w'), $i); ?></h3>
      <div class="sub_box_content">
       <p><label><input id="dp_options[show_footer_banner<?php echo $i; ?>]" name="dp_options[show_footer_banner<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_banner'.$i] ); ?> /> <?php _e('Display banner content', 'tcd-w');  ?></label></p>
       <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
       <textarea id="dp_options[footer_banner_title<?php echo $i; ?>]" class="large-text" cols="50" rows="2" name="dp_options[footer_banner_title<?php echo $i; ?>]"><?php echo esc_textarea( $options['footer_banner_title'.$i] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w'); ?></h4>
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '480', '300'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js footer_banner_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['footer_banner_image'.$i] ); ?>" id="footer_banner_image<?php echo $i; ?>" name="dp_options[footer_banner_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['footer_banner_image'.$i]){ echo wp_get_attachment_image($options['footer_banner_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_banner_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <h4 class="theme_option_headline2"><?php _e('URL', 'tcd-w');  ?>ああああああああああああああああ</h4>
       <input id="dp_options[footer_banner_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[footer_banner_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_banner_url'.$i] ); ?>" />













       <p><label><input id="dp_options[show_footer_banner<?php echo $i; ?>]" name="dp_options[show_footer_banner<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['footer_banner_target'.$i] ); ?> /> <?php _e('Open with new window', 'tcd-w');  ?></label></p>


















       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php endfor; ?>
     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="font_size_field">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_banner_font_size]" value="<?php esc_attr_e( $options['footer_banner_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font size (mobile)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[footer_banner_font_size_mobile]" value="<?php esc_attr_e( $options['footer_banner_font_size_mobile'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_banner_font_color]" value="<?php echo esc_attr( $options['footer_banner_font_color'] ); ?>" data-default-color="#f95660" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 会社情報・インフォメーションの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Company data and information content setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Company data setting', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <p><label><input id="dp_options[show_footer_company_info]" name="dp_options[show_footer_company_info]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_company_info'] ); ?> /> <?php _e('Display company data', 'tcd-w');  ?></label></p>
       <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
       <textarea id="dp_options[footer_company_info]" class="large-text" cols="50" rows="4" name="dp_options[footer_company_info]"><?php echo esc_textarea( $options['footer_company_info'] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e('Logo setting', 'tcd-w');  ?></h4>
       <p><label><input id="dp_options[show_footer_logo]" name="dp_options[show_footer_logo]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_logo'] ); ?> /> <?php _e('Display logo', 'tcd-w');  ?></label></p>
       <div class="theme_option_message2">
        <p><?php _e('Please register logo image from Logo option section.', 'tcd-w'); ?></p>
       </div>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('Information content%s setting', 'tcd-w'), $i); ?></h3>
      <div class="sub_box_content">
       <p><label><input id="dp_options[show_footer_info<?php echo $i; ?>]" name="dp_options[show_footer_info<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_info'.$i] ); ?> /> <?php _e('Display information content', 'tcd-w');  ?></label></p>
       <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
       <textarea id="dp_options[footer_info_title<?php echo $i; ?>]" class="large-text" cols="50" rows="2" name="dp_options[footer_info_title<?php echo $i; ?>]"><?php echo esc_textarea( $options['footer_info_title'.$i] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
       <textarea id="dp_options[footer_info_desc<?php echo $i; ?>]" class="large-text" cols="50" rows="4" name="dp_options[footer_info_desc<?php echo $i; ?>]"><?php echo esc_textarea( $options['footer_info_desc'.$i] ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
       <ul class="color_field">
        <li class="cf"><span class="label"><?php _e('Display button', 'tcd-w');  ?></span><input name="dp_options[show_footer_info_button<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['show_footer_info_button'.$i], 1 ); ?>></li>
        <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input id="dp_options[footer_info_button_label<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[footer_info_button_label<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_info_button_label'.$i] ); ?>" style="max-width:50%;" /></li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input id="dp_options[footer_info_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[footer_info_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_info_url'.$i] ); ?>" style="width:50%;" /></li>
        <li class="cf"><span class="label"><?php _e('Open with new window', 'tcd-w' ); ?></span><input name="dp_options[footer_info_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_info_target'.$i], 1 ); ?>></li>
        <li class="cf"><span class="label"><?php _e('Font color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[foonter_info_button_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['foonter_info_button_font_color'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[foonter_info_button_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['foonter_info_button_bg_color'.$i] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Font color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[foonter_info_button_font_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['foonter_info_button_font_color_hover'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[foonter_info_button_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['foonter_info_button_bg_color_hover'.$i] ); ?>" data-default-color="#f45963" class="c-color-picker"></li>
       </ul>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php endfor; ?>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メニューエリアの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Menu area setting', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Custom menu setting', 'tcd-w'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('Please register custom menu from <a href="./nav-menus.php">custom navigaton page</a>.', 'tcd-w'); ?></p>
       </div>
       <ul>
        <li><label><input id="dp_options[footer_show_home_menu]" name="dp_options[footer_show_home_menu]" type="checkbox" value="1" <?php checked( '1', $options['footer_show_home_menu'] ); ?> /> <?php _e('Display home icon', 'tcd-w');  ?></label></li>
       </ul>
       <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s category menu%s setting', 'tcd-w'), $service_label, $i); ?></h3>
      <div class="sub_box_content">
       <ul class="font_size_field">
        <li class="cf"><span class="label"><?php _e('Display menu', 'tcd-w');  ?></span><input name="dp_options[footer_show_category_menu<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_show_category_menu'.$i], 1 ); ?>></li>
        <li class="cf">
         <span class="label"><?php _e('Category type', 'tcd-w');  ?></span>
         <select name="dp_options[footer_category_menu_type<?php echo $i; ?>]">
          <?php foreach ( $service_category_options as $option ) { ?>
          <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['footer_category_menu_type'.$i], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
          <?php }; ?>
         </select>
        </li>
        <li class="cf">
         <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
         <select name="dp_options[footer_category_menu_num<?php echo $i; ?>]">
          <?php for($num=5; $num<= 10; $num++): ?>
          <option style="padding-right: 10px;" value="<?php echo esc_attr($num); ?>" <?php selected( $options['footer_category_menu_num'.$i], $num ); ?>><?php echo esc_html($num); ?></option>
          <?php endfor; ?>
         </select>
        </li>
       </ul>
       <input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" />
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php endfor; ?>
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="color_field">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_menu_bg_color]" value="<?php echo esc_attr( $options['footer_menu_bg_color'] ); ?>" data-default-color="#f4f4f5" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of menu', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_menu_font_color]" value="<?php echo esc_attr( $options['footer_menu_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of menu on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_menu_font_color_hover]" value="<?php echo esc_attr( $options['footer_menu_font_color_hover'] ); ?>" data-default-color="#f95660" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_menu_headline_color]" value="<?php echo esc_attr( $options['footer_menu_headline_color'] ); ?>" data-default-color="#f95660" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタンの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('SNS button setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e('Enter url of your Twitter, Facebook, Instagram, Pinterest, Flickr, Tumblr, and contact page. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-w');  ?></p>
     </div>
     <ul>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('Facebook URL', 'tcd-w');  ?></label>
       <input id="dp_options[footer_facebook_url]" class="regular-text" type="text" name="dp_options[footer_facebook_url]" value="<?php esc_attr_e( $options['footer_facebook_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('Twitter URL', 'tcd-w');  ?></label>
       <input id="dp_options[footer_twitter_url]" class="regular-text" type="text" name="dp_options[footer_twitter_url]" value="<?php esc_attr_e( $options['footer_twitter_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('Instagram URL', 'tcd-w');  ?></label>
       <input id="dp_options[footer_instagram_url]" class="regular-text" type="text" name="dp_options[footer_instagram_url]" value="<?php esc_attr_e( $options['footer_instagram_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('Pinterest URL', 'tcd-w');  ?></label>
       <input id="dp_options[footer_pinterest_url]" class="regular-text" type="text" name="dp_options[footer_pinterest_url]" value="<?php esc_attr_e( $options['footer_pinterest_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('Youtube URL', 'tcd-w');  ?></label>
       <input id="dp_options[footer_youtube_url]" class="regular-text" type="text" name="dp_options[footer_youtube_url]" value="<?php esc_attr_e( $options['footer_youtube_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('Your Contact page URL (You can use mailto:)', 'tcd-w');  ?></label>
       <input id="dp_options[footer_contact_url]" class="regular-text" type="text" name="dp_options[footer_contact_url]" value="<?php esc_attr_e( $options['footer_contact_url'] ); ?>" />
      </li>
     </ul>
     <hr />
     <p><label><input id="dp_options[footer_show_rss]" name="dp_options[footer_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['footer_show_rss'] ); ?> /> <?php _e('Display RSS button', 'tcd-w');  ?></label></p>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コピーライトの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Copyright setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <input id="dp_options[copyright]" class="regular-text" type="text" name="dp_options[copyright]" value="<?php echo esc_attr($options['copyright']); ?>" />
     <h4 class="theme_option_headline2"><?php _e('Color setting', 'tcd-w');  ?></h4>
     <ul class="color_field">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_font_color]" value="<?php echo esc_attr( $options['copyright_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_bg_color]" value="<?php echo esc_attr( $options['copyright_bg_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
     </ul>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターコンテンツの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Footer content setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Type of footer content', 'tcd-w');  ?></h4>
     <ul class="design_radio_button" id="footer_content_type" style="margin-bottom:30px;">
      <?php foreach ( $footer_content_type_options as $option ) { ?>
      <li id="footer_content_type_<?php esc_attr_e( $option['value'] ); ?>_button">
       <input type="radio" id="footer_content_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_content_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_content_type'], $option['value'] ); ?> />
       <label for="footer_content_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>
     <?php // フッターボタンの設定 ------------------------ ?>
     <div id="footer_button_area" style="display:<?php if($options['footer_content_type'] == 'type2'){ echo 'block'; } else { echo 'none'; }; ?>;">
      <h3 class="theme_option_headline2"><?php _e('Footer button setting', 'tcd-w');  ?></h3>
      <div class="theme_option_message2">
       <p><?php _e( 'Footer button will only be displayed at mobile device.', 'tcd-w' ); ?>
      </div>
      <?php for($i = 1; $i <= 2; $i++) : ?>
      <h4 class="theme_option_headline2"><?php printf(__('Button%s setting', 'tcd-w'), $i); ?></h4>
      <ul class="color_field">
       <li class="cf"><span class="label"><?php _e('Display button', 'tcd-w');  ?></span><input name="dp_options[show_footer_button<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['show_footer_button'.$i], 1 ); ?>></li>
       <li class="cf"><span class="label"><?php _e('Label', 'tcd-w');  ?></span><input id="dp_options[footer_button_label<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[footer_button_label<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_button_label'.$i] ); ?>" style="max-width:50%;" /></li>
       <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input id="dp_options[footer_button_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[footer_button_url<?php echo $i; ?>]" value="<?php echo esc_url( $options['footer_button_url'.$i] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Open with new window', 'tcd-w' ); ?></span><input name="dp_options[footer_button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['footer_button_target'.$i], 1 ); ?>></li>
       <li class="cf"><span class="label"><?php _e('Font color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_font_color'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color of button', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_bg_color'.$i] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_font_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_font_color_hover'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color of button on mouseover', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['footer_button_bg_color_hover'.$i] ); ?>" data-default-color="#f45963" class="c-color-picker"></li>
      </ul>
      <?php endfor; ?>
     </div>
     <?php // フッターバーの設定 ------------------------ ?>
     <div id="footer_bar_area" style="display:<?php if($options['footer_content_type'] == 'type3'){ echo 'block'; } else { echo 'none'; }; ?>;">
      <h3 class="theme_option_headline2"><?php _e( 'Footer bar setting', 'tcd-w' ); ?></h3>
      <div class="theme_option_message2">
       <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-w' ); ?>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Display type of the footer bar', 'tcd-w'); ?></h4>
      <ul class="design_radio_button">
       <?php foreach ( $footer_bar_display_options as $option ) { ?>
       <li>
        <input type="radio" id="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_bar_display]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_bar_display'], $option['value'] ); ?> />
        <label for="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
       </li>
       <?php } ?>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Settings for the appearance of the footer bar', 'tcd-w'); ?></h4>
      <ul class="color_field">
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg]" value="<?php echo esc_attr( $options['footer_bar_bg'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_border]" value="<?php echo esc_attr( $options['footer_bar_border'] ); ?>" data-default-color="#DDDDDD" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_color]" value="<?php echo esc_attr( $options['footer_bar_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Opacity of background', 'tcd-w'); ?></span><input id="dp_options[footer_bar_tp]" class="font_size hankaku" type="text" name="dp_options[footer_bar_tp]" value="<?php echo esc_attr( $options['footer_bar_tp'] ); ?>" /><p><?php _e('Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w'); ?></p></li>
      </ul>
      <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
      </div>
      <table class="table-border">
       <tr>
        <th><?php _e( 'Default', 'tcd-w' ); ?></th>
        <td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
       </tr>
       <tr>
        <th><?php _e( 'Share', 'tcd-w' ); ?></th>
        <td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
       </tr>
       <tr>
        <th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
        <td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
       </tr>
      </table>
      <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
      <div class="repeater-wrapper">
       <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
<?php
    if ( $options['footer_bar_btns'] ) :
      foreach ( $options['footer_bar_btns'] as $key => $value ) :  
?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
       <div class="sub_box_content">
        <p class="footer-bar-target" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>"><label><input name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
        <table class="table-repeater">
         <tr class="footer-bar-type">
          <th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
          <td>
           <select name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </td>
         </tr>
         <tr>
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="large-text repeater-label" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></td>
         </tr>
         <tr class="footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="large-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_attr( $value['url'] ); ?>"></td>
         </tr>
         <tr class="footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="large-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>"></td>
         </tr>
         <tr>
          <th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
          <td>
           <?php foreach( $footer_bar_icon_options as $option ) : ?>
           <p><label><input type="radio" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
           <?php endforeach; ?>
          </td>
         </tr>
        </table>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div>
      </div>
<?php
      endforeach;
    endif;

    $key = 'addindex';
    ob_start();
?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <p class="footer-bar-target"><label><input name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1"><?php _e( 'Open with new window', 'tcd-w' ); ?></label></p>
        <table class="table-repeater">
         <tr class="footer-bar-type">
          <th><label><?php _e( 'Button type', 'tcd-w' ); ?></label></th>
          <td>
           <select name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>"><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </td>
         </tr>
         <tr>
          <th><label for="dp_options[repeater_footer_bar_btn<?php echo esc_attr( $key ); ?>_label]"><?php _e( 'Button label', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_label]" class="large-text repeater-label" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></td>
         </tr>
         <tr class="footer-bar-url">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]"><?php _e( 'Link URL', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_url]" class="large-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" value=""></td>
         </tr>
         <tr class="footer-bar-number" style="display: none;">
          <th><label for="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]"><?php _e( 'Phone number', 'tcd-w' ); ?></label></th>
          <td><input id="dp_options[footer_bar_btn<?php echo esc_attr( $key ); ?>_number]" class="large-text" type="text" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value=""></td>
         </tr>
         <tr>
          <th><?php _e( 'Button icon', 'tcd-w' ); ?></th>
          <td>
           <?php foreach( $footer_bar_icon_options as $option ) : ?>
           <p><label><input type="radio" name="dp_options[repeater_footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr( $option['value'] ); ?>"<?php if ( 'file-text' == $option['value'] ) { echo ' checked="checked"'; } ?>><span class="icon icon-<?php echo esc_attr( $option['value'] ); ?>"></span><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label></p>
           <?php endforeach; ?>
          </td>
         </tr>
        </table>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div>
      </div>
<?php
    $clone = ob_get_clean();
?>
       </div><!-- END .repeater -->
       <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
      </div><!-- END .repeater-wrapper -->
     </div><!-- END #footer_bar_area -->
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options, $fixed_footer_banner_type_options, $fixed_footer_sub_content_type_options, $footer_content_type_options;

  // バナーの設定
  $input['footer_banner_font_color'] = wp_filter_nohtml_kses( $input['footer_banner_font_color'] );
  $input['footer_banner_font_size'] = wp_filter_nohtml_kses( $input['footer_banner_font_size'] );
  $input['footer_banner_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_banner_font_size_mobile'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    if ( ! isset( $input['show_footer_banner'.$i] ) )
      $input['show_footer_banner'.$i] = null;
      $input['show_footer_banner'.$i] = ( $input['show_footer_banner'.$i] == 1 ? 1 : 0 );
    $input['footer_banner_title'.$i] = $input['footer_banner_title'.$i];
    $input['footer_banner_image'.$i] = wp_filter_nohtml_kses( $input['footer_banner_image'.$i] );
    $input['footer_banner_url'.$i] = wp_filter_nohtml_kses( $input['footer_banner_url'.$i] );
  }

  // 会社情報・インフォメーションの設定
  if ( ! isset( $input['show_footer_company_info'] ) )
    $input['show_footer_company_info'] = null;
    $input['show_footer_company_info'] = ( $input['show_footer_company_info'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_footer_logo'] ) )
    $input['show_footer_logo'] = null;
    $input['show_footer_logo'] = ( $input['show_footer_logo'] == 1 ? 1 : 0 );
  $input['footer_company_info'] = wp_filter_nohtml_kses( $input['footer_company_info'] );
  for ( $i = 1; $i <= 2; $i++ ) {
    if ( ! isset( $input['show_footer_info'.$i] ) )
      $input['show_footer_info'.$i] = null;
      $input['show_footer_info'.$i] = ( $input['show_footer_info'.$i] == 1 ? 1 : 0 );
    $input['footer_info_title'.$i] = $input['footer_info_title'.$i];
    $input['footer_info_desc'.$i] = wp_filter_nohtml_kses( $input['footer_info_desc'.$i] );
    $input['footer_info_url'.$i] = wp_filter_nohtml_kses( $input['footer_info_url'.$i] );
    if ( ! isset( $input['show_footer_info_button'.$i] ) )
      $input['show_footer_info_button'.$i] = null;
      $input['show_footer_info_button'.$i] = ( $input['show_footer_info_button'.$i] == 1 ? 1 : 0 );
    $input['footer_info_button_label'.$i] = $input['footer_info_button_label'.$i];
    $input['foonter_info_button_font_color'.$i] = wp_filter_nohtml_kses( $input['foonter_info_button_font_color'.$i] );
    $input['foonter_info_button_bg_color'.$i] = wp_filter_nohtml_kses( $input['foonter_info_button_bg_color'.$i] );
    $input['foonter_info_button_font_color_hover'.$i] = wp_filter_nohtml_kses( $input['foonter_info_button_font_color_hover'.$i] );
    $input['foonter_info_button_bg_color_hover'.$i] = wp_filter_nohtml_kses( $input['foonter_info_button_bg_color_hover'.$i] );
    if ( ! isset( $input['footer_info_target'.$i] ) )
      $input['footer_info_target'.$i] = null;
      $input['footer_info_target'.$i] = ( $input['footer_info_target'.$i] == 1 ? 1 : 0 );
  }

  // メニューエリア
  if ( ! isset( $input['footer_show_home_menu'] ) )
    $input['footer_show_home_menu'] = null;
    $input['footer_show_home_menu'] = ( $input['footer_show_home_menu'] == 1 ? 1 : 0 );
  $input['footer_menu_headline_color'] = wp_filter_nohtml_kses( $input['footer_menu_headline_color'] );
  $input['footer_menu_bg_color'] = wp_filter_nohtml_kses( $input['footer_menu_bg_color'] );
  $input['footer_menu_font_color'] = wp_filter_nohtml_kses( $input['footer_menu_font_color'] );
  $input['footer_menu_font_color_hover'] = wp_filter_nohtml_kses( $input['footer_menu_font_color_hover'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    if ( ! isset( $input['footer_show_category_menu'.$i] ) )
      $input['footer_show_category_menu'.$i] = null;
      $input['footer_show_category_menu'.$i] = ( $input['footer_show_category_menu'.$i] == 1 ? 1 : 0 );
    $input['footer_category_menu_num'.$i] = wp_filter_nohtml_kses( $input['footer_category_menu_num'.$i] );
    $input['footer_category_menu_type'.$i] = wp_filter_nohtml_kses( $input['footer_category_menu_type'.$i] );
  }

  //フッターのSNSボタンの設定
  $input['footer_facebook_url'] = wp_filter_nohtml_kses( $input['footer_facebook_url'] );
  $input['footer_twitter_url'] = wp_filter_nohtml_kses( $input['footer_twitter_url'] );
  $input['footer_instagram_url'] = wp_filter_nohtml_kses( $input['footer_instagram_url'] );
  $input['footer_pinterest_url'] = wp_filter_nohtml_kses( $input['footer_pinterest_url'] );
  $input['footer_youtube_url'] = wp_filter_nohtml_kses( $input['footer_youtube_url'] );
  $input['footer_contact_url'] = wp_filter_nohtml_kses( $input['footer_contact_url'] );
  if ( ! isset( $input['footer_show_rss'] ) )
    $input['footer_show_rss'] = null;
    $input['footer_show_rss'] = ( $input['footer_show_rss'] == 1 ? 1 : 0 );

  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);
  $input['copyright_font_color'] = wp_filter_nohtml_kses( $input['copyright_font_color'] );
  $input['copyright_bg_color'] = wp_filter_nohtml_kses( $input['copyright_bg_color'] );

  // フッターコンテンツの設定
  if ( ! isset( $input['footer_content_type'] ) )
    $input['footer_content_type'] = null;
  if ( ! array_key_exists( $input['footer_content_type'], $footer_content_type_options ) )
    $input['footer_content_type'] = null;

  // フッターボタンの設定
  for ( $i = 1; $i <= 2; $i++ ) {
    if ( ! isset( $input['show_footer_button'.$i] ) )
      $input['show_footer_button'.$i] = null;
      $input['show_footer_button'.$i] = ( $input['show_footer_button'.$i] == 1 ? 1 : 0 );
    $input['footer_button_label'.$i] = $input['footer_button_label'.$i];
    $input['footer_button_url'.$i] = $input['footer_button_url'.$i];
    $input['footer_button_font_color'.$i] = wp_filter_nohtml_kses( $input['footer_button_font_color'.$i] );
    $input['footer_button_bg_color'.$i] = wp_filter_nohtml_kses( $input['footer_button_bg_color'.$i] );
    $input['footer_button_font_color_hover'.$i] = wp_filter_nohtml_kses( $input['footer_button_font_color_hover'.$i] );
    $input['footer_button_bg_color_hover'.$i] = wp_filter_nohtml_kses( $input['footer_button_bg_color_hover'.$i] );
    if ( ! isset( $input['footer_button_target'.$i] ) )
      $input['footer_button_target'.$i] = null;
      $input['footer_button_target'.$i] = ( $input['footer_button_target'.$i] == 1 ? 1 : 0 );
  }

  // スマホ用固定フッターバーの設定
  $footer_bar_btns = array();
  if ( ! isset( $input['repeater_footer_bar_btns'] ) && ! empty( $input['footer_bar_btns'] ) && is_array($input['footer_bar_btns'] ) ) :
    $input['repeater_footer_bar_btns'] = $input['footer_bar_btns'];
  endif;
  if ( isset( $input['repeater_footer_bar_btns'] ) ) :
	  foreach ( (array)$input['repeater_footer_bar_btns'] as $key => $value ) {
	    $footer_bar_btns[] = array(
	      'type' => ( isset( $input['repeater_footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['repeater_footer_bar_btns'][$key]['type'] : 'type1',
	      'label' => isset( $input['repeater_footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['label'] ) : '',
	      'url' => isset( $input['repeater_footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['url'] ) : '',
	      'number' => isset( $input['repeater_footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['number'] ) : '',
	      'target' => ! empty( $input['repeater_footer_bar_btns'][$key]['target'] ) ? 1 : 0,
	      'icon' => ( isset( $input['repeater_footer_bar_btns'][$key]['icon'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['icon'], $footer_bar_icon_options ) ) ? $input['repeater_footer_bar_btns'][$key]['icon'] : 'file-text'
	    );
	  }
	  unset( $input['repeater_footer_bar_btns'] );
  endif;
  $input['footer_bar_btns'] = $footer_bar_btns;

	return $input;

};


?>