<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style')
);
}

// 列の追加
function my_add_columns($columns)
{
    $columns['my_column_name'] = 'タグ';

    // 日付を列の最後に移動
    $date = $columns['date'];
    unset($columns['date']);
    $columns['date'] = $date;

    return $columns;
}

add_filter('manage_edit-service_columns', 'my_add_columns');

// 列の内容を追加
function my_add_columns_content($column_name, $post_id)
{
    if ($column_name == 'my_column_name') {
        // タームを表示
        $my_terms = get_the_terms($post_id, 'tag_service');

        if ($my_terms && !is_wp_error($my_terms)) {
            $draught_links = array();
            foreach ($my_terms as $my_term) {
                $draught_links[] = $my_term->name;
            }
            $stitle = join(", ", $draught_links);
        }
    }

    if (isset($stitle) && $stitle) {
        echo esc_attr($stitle);
    }
}
add_action('manage_service_posts_custom_column', 'my_add_columns_content', 10, 2);

add_filter('posts_orderby', 'custom_post_type_archive_orderby', 10, 2);
function custom_post_type_archive_orderby($orderby, $query){
    if(is_post_type_archive('campaign') && $query->is_main_query()){
        $orderby = 'post_date DESC';
    }
    return $orderby;
}


//PCでのみ表示するコンテンツ
function if_is_pc($atts, $content = null )
{
$content = do_shortcode( $content);
    if(!wp_is_mobile())
        {
        return $content;
        }
}
add_shortcode('pc', 'if_is_pc');



//スマートフォン・タブレットでのみ表示するコンテンツ
function if_is_sp($atts, $content = null )
{
$content = do_shortcode( $content);
    if(wp_is_mobile())
        {
        return $content;
        }
}
add_shortcode('sp', 'if_is_sp');




// グローバル変数を使って孫メニューの順番を管理
$menu_item_count = 0;

function add_custom_submenu_class_with_row( $classes, $args, $depth ) {
    global $menu_item_count;
    // 階層ごとのクラス名を付与
    $classes[] = 'col' . ($depth + 1);
    // 孫メニュー（$depth = 2）の場合、番号を追加
    if ( $depth === 1 ) {
        $menu_item_count++;
        $classes[] = 'row' . $menu_item_count;
    }
    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'add_custom_submenu_class_with_row', 10, 3 );

// メニューの前に番号をリセットする
function reset_menu_item_count() {
    global $menu_item_count;
    $menu_item_count = 0;
}
add_action( 'wp_nav_menu_start', 'reset_menu_item_count' );




?>