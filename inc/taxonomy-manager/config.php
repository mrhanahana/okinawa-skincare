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

            'rewrite' => [
                'slug'       => 'service-concern',
                'with_front' => false,
            ],

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

            'rewrite' => [
                'slug'       => 'service-treatment',
                'with_front' => false,
            ],

            // 画像なし
            'image' => false,

            // 並び替え
            'sortable' => true,

        ],

    ];
}
