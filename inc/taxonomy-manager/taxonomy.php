<?php

function theme_register_custom_taxonomies()
{
    $taxonomies =
        theme_get_custom_taxonomies();


    foreach (
        $taxonomies
        as $taxonomy => $config
    ) {

        $label =
            $config['label'];


        register_taxonomy(
            $taxonomy,
            $config['object_type'],
            [

                'labels' => [

                    'name' =>
                    $label,

                    'singular_name' =>
                    $label,

                    'menu_name' =>
                    $label,

                    'all_items' =>
                    $label . '一覧',

                    'edit_item' =>
                    $label . 'を編集',

                    'update_item' =>
                    $label . 'を更新',

                    'add_new_item' =>
                    $label . 'を追加',

                    'new_item_name' =>
                    '新しい' . $label,

                    'search_items' =>
                    $label . 'を検索',

                ],

                'hierarchical' =>
                $config['hierarchical']
                    ?? true,

                'public' =>
                true,

                'show_ui' =>
                true,

                'show_admin_column' =>
                true,

                'show_in_rest' =>
                true,

                'rewrite' =>
                $config['rewrite']
                    ?? true,

            ]
        );
    }
}

add_action(
    'init',
    'theme_register_custom_taxonomies',
    20
);
