<?php

function theme_get_custom_taxonomies()
{
    return [

        'service_concern' => [

            'object_type' => [
                'service',
            ],

            'label' => 'お悩み',

            'hierarchical' => true,

            // 公開タームページを作らない
            'public'             => false,
            'publicly_queryable' => false,
            'rewrite'            => false,
            'query_var'          => false,

            // 管理画面では使用する
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,

            // ターム画像
            'image' => true,

            // 並び替え
            'sortable' => true,

        ],


        'service_treatment' => [

            'object_type' => [
                'service',
            ],

            'label' => '施術',

            'hierarchical' => true,

            // 公開タームページを作らない
            'public'             => false,
            'publicly_queryable' => false,
            'rewrite'            => false,
            'query_var'          => false,

            // 管理画面では使用する
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,

            // 画像なし
            'image' => false,

            // 並び替え
            'sortable' => true,

        ],

    ];
}
