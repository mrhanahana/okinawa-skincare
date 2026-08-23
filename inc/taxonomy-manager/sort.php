<?php

/**************************************************************************************
/* Taxonomy Manager - Sort
/**************************************************************************************/


/**************************************************************************************
/* 並び替え対象タクソノミー
/**************************************************************************************/

/* sortable => true のタクソノミーを取得
/* ---------------------------------------------------------- */
function theme_get_sortable_taxonomies()
{
    $taxonomies =
        theme_get_custom_taxonomies();


    $sortable = [];


    foreach (
        $taxonomies
        as $taxonomy => $config
    ) {

        if (
            !empty($config['sortable'])
        ) {

            $sortable[] =
                $taxonomy;
        }
    }


    return $sortable;
}


/* 並び替え対象か確認
/* ---------------------------------------------------------- */
function theme_is_sortable_taxonomy(
    $taxonomy
) {

    return in_array(
        $taxonomy,
        theme_get_sortable_taxonomies(),
        true
    );
}


/**************************************************************************************
/* option
/**************************************************************************************/

/* 並び順保存用 option 名
/* ---------------------------------------------------------- */
function theme_taxonomy_order_option_name(
    $taxonomy
) {

    return
        'theme_taxonomy_order_'
        . sanitize_key($taxonomy);
}


/**************************************************************************************
/* タームID取得
/**************************************************************************************/

/* タクソノミーに存在する全タームID
/* ---------------------------------------------------------- */
function theme_get_all_taxonomy_term_ids(
    $taxonomy
) {

    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {
        return [];
    }


    /*
   * 管理画面表示順フィルターとの
   * 再帰を防止
   */
    $previous_bypass =
        !empty($GLOBALS['theme_taxonomy_sort_bypass']);


    $GLOBALS['theme_taxonomy_sort_bypass'] = true;


    $term_ids =
        get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'fields'     => 'ids',
            'orderby'    => 'term_id',
            'order'      => 'ASC',
        ]);


    /*
   * 元の状態へ戻す
   */
    if ($previous_bypass) {

        $GLOBALS['theme_taxonomy_sort_bypass'] = true;
    } else {

        unset(
            $GLOBALS['theme_taxonomy_sort_bypass']
        );
    }


    if (
        is_wp_error($term_ids)
    ) {
        return [];
    }


    return array_values(
        array_map(
            'absint',
            $term_ids
        )
    );
}


/**************************************************************************************
/* 保存済み並び順取得
/**************************************************************************************/

/* タクソノミーの並び順を取得
/* ---------------------------------------------------------- */
function theme_get_taxonomy_order(
    $taxonomy
) {

    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {
        return [];
    }


    /*
   * 現在存在する全ターム
   */
    $all_term_ids =
        theme_get_all_taxonomy_term_ids(
            $taxonomy
        );


    if (!$all_term_ids) {
        return [];
    }


    /*
   * 保存済み順番
   */
    $saved_order =
        get_option(
            theme_taxonomy_order_option_name(
                $taxonomy
            ),
            []
        );


    if (
        !is_array($saved_order)
    ) {
        $saved_order = [];
    }


    /*
   * 数値化・重複削除
   */
    $saved_order =
        array_values(
            array_unique(
                array_map(
                    'absint',
                    $saved_order
                )
            )
        );


    /*
   * すでに削除されたタームを除外
   */
    $saved_order =
        array_values(
            array_intersect(
                $saved_order,
                $all_term_ids
            )
        );


    /*
   * 新規追加されたターム
   */
    $new_term_ids =
        array_values(
            array_diff(
                $all_term_ids,
                $saved_order
            )
        );


    /*
   * 新規タームは最後へ追加
   */
    $order =
        array_merge(
            $saved_order,
            $new_term_ids
        );


    /*
   * DB上の値と違う場合だけ更新
   */
    $current_option =
        get_option(
            theme_taxonomy_order_option_name(
                $taxonomy
            ),
            []
        );


    if (
        !is_array($current_option) ||
        $current_option !== $order
    ) {

        update_option(
            theme_taxonomy_order_option_name(
                $taxonomy
            ),
            $order,
            false
        );
    }


    return $order;
}


/**************************************************************************************
/* ターム追加・削除
/**************************************************************************************/

/* 新規タームを最後へ追加
/* ---------------------------------------------------------- */
function theme_taxonomy_sort_created_term(
    $term_id,
    $tt_id,
    $taxonomy
) {

    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {
        return;
    }


    /*
   * theme_get_taxonomy_order() 内で
   * 新規IDが最後へ自動追加される
   */
    theme_get_taxonomy_order(
        $taxonomy
    );
}

add_action(
    'created_term',
    'theme_taxonomy_sort_created_term',
    10,
    3
);


/* 削除されたタームを並び順から削除
/* ---------------------------------------------------------- */
function theme_taxonomy_sort_deleted_term(
    $term_id,
    $tt_id,
    $taxonomy
) {

    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {
        return;
    }


    $option_name =
        theme_taxonomy_order_option_name(
            $taxonomy
        );


    $order =
        get_option(
            $option_name,
            []
        );


    if (
        !is_array($order)
    ) {
        return;
    }


    $term_id =
        absint($term_id);


    $order =
        array_values(
            array_filter(
                $order,
                function ($id) use ($term_id) {

                    return
                        (int) $id !==
                        (int) $term_id;
                }
            )
        );


    update_option(
        $option_name,
        $order,
        false
    );
}

add_action(
    'delete_term',
    'theme_taxonomy_sort_deleted_term',
    10,
    3
);


/**************************************************************************************
/* 管理画面の表示順
/**************************************************************************************/

/*
 * タクソノミー一覧を
 * HTML生成前から保存済み順番にする
/* ---------------------------------------------------------- */
function theme_taxonomy_admin_order(
    $args,
    $taxonomies
) {

    global $pagenow;


    /*
   * 内部取得時は処理しない
   */
    if (
        !empty($GLOBALS['theme_taxonomy_sort_bypass'])
    ) {
        return $args;
    }


    if (!is_admin()) {
        return $args;
    }


    /*
   * タクソノミー一覧画面のみ
   */
    if (
        $pagenow !==
        'edit-tags.php'
    ) {
        return $args;
    }


    /*
   * WP_Terms_List_Table が
   * 一覧取得するときには page が入る
   */
    if (
        !isset($args['page'])
    ) {
        return $args;
    }


    $target_taxonomies =
        array_values(
            array_intersect(
                (array) $taxonomies,
                theme_get_sortable_taxonomies()
            )
        );


    if (
        count($target_taxonomies) !== 1
    ) {
        return $args;
    }


    /*
   * 検索時はWordPress標準動作
   */
    if (
        !empty($args['search'])
    ) {
        return $args;
    }


    /*
   * 名前やスラッグの列をクリックして
   * 明示的にソートしている場合は
   * WordPress標準を優先
   */
    if (
        !empty($_REQUEST['orderby'])
    ) {
        return $args;
    }


    $taxonomy =
        $target_taxonomies[0];


    $order =
        theme_get_taxonomy_order(
            $taxonomy
        );


    if (!$order) {
        return $args;
    }


    /*
   * include に渡したIDの順番で取得
   */
    $args['include'] =
        $order;

    $args['orderby'] =
        'include';

    $args['order'] =
        'ASC';


    return $args;
}

add_filter(
    'get_terms_args',
    'theme_taxonomy_admin_order',
    20,
    2
);


/**************************************************************************************
/* ドラッグハンドル列
/**************************************************************************************/

/* 並び替え列を追加
/* ---------------------------------------------------------- */
function theme_taxonomy_sort_add_column(
    $columns
) {

    $new_columns = [];


    foreach (
        $columns
        as $key => $label
    ) {

        $new_columns[$key] =
            $label;


        /*
     * チェックボックスの直後
     */
        if ($key === 'cb') {

            $new_columns['taxonomy_sort'] = '';
        }
    }


    return $new_columns;
}


/* 並び替え列を各タクソノミーへ登録
/* ---------------------------------------------------------- */
function theme_register_taxonomy_sort_columns()
{
    foreach (
        theme_get_sortable_taxonomies()
        as $taxonomy
    ) {

        add_filter(
            'manage_edit-'
                . $taxonomy
                . '_columns',
            'theme_taxonomy_sort_add_column'
        );


        add_filter(
            'manage_'
                . $taxonomy
                . '_custom_column',
            'theme_taxonomy_sort_column_content',
            10,
            3
        );
    }
}

theme_register_taxonomy_sort_columns();


/* ドラッグハンドル表示
/* ---------------------------------------------------------- */
function theme_taxonomy_sort_column_content(
    $content,
    $column_name,
    $term_id
) {

    if (
        $column_name !==
        'taxonomy_sort'
    ) {
        return $content;
    }


    return
        '<span
      class="taxonomy-sort-handle dashicons dashicons-menu"
      aria-hidden="true"
      title="ドラッグして並び替え">
    </span>';
}


/**************************************************************************************
/* Ajax 並び順保存
/**************************************************************************************/

function theme_taxonomy_save_order()
{
    /*
   * nonce
   */
    check_ajax_referer(
        'theme_taxonomy_sort_nonce',
        'nonce'
    );


    /*
   * taxonomy
   */
    $taxonomy =
        isset($_POST['taxonomy'])
        ? sanitize_key(
            wp_unslash(
                $_POST['taxonomy']
            )
        )
        : '';


    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {

        wp_send_json_error([
            'message' =>
            '対象外のタクソノミーです。',
        ]);
    }


    /*
   * 権限確認
   */
    $taxonomy_object =
        get_taxonomy($taxonomy);


    if (
        !$taxonomy_object ||
        !current_user_can(
            $taxonomy_object
                ->cap
                ->manage_terms
        )
    ) {

        wp_send_json_error([
            'message' =>
            '権限がありません。',
        ]);
    }


    /*
   * order
   */
    if (
        !isset($_POST['order']) ||
        !is_array($_POST['order'])
    ) {

        wp_send_json_error([
            'message' =>
            '並び順データがありません。',
        ]);
    }


    $posted_order =
        array_values(
            array_unique(
                array_map(
                    'absint',
                    wp_unslash(
                        $_POST['order']
                    )
                )
            )
        );


    /*
   * 空ID削除
   */
    $posted_order =
        array_values(
            array_filter(
                $posted_order
            )
        );


    if (!$posted_order) {

        wp_send_json_error([
            'message' =>
            '保存するタームがありません。',
        ]);
    }


    /*
   * 本当に対象taxonomyのタームか確認
   */
    $valid_order = [];


    foreach (
        $posted_order
        as $term_id
    ) {

        $term =
            get_term(
                $term_id,
                $taxonomy
            );


        if (
            !$term ||
            is_wp_error($term)
        ) {
            continue;
        }


        $valid_order[] =
            $term_id;
    }


    if (!$valid_order) {

        wp_send_json_error([
            'message' =>
            '有効なタームがありません。',
        ]);
    }


    /*
   * 現在の全体並び順
   */
    $current_order =
        theme_get_taxonomy_order(
            $taxonomy
        );


    /*
   * 現在のページに表示されている
   * タームだけを入れ替える。
   *
   * 複数ページになっていても
   * 他ページのターム位置を壊さない。
   */
    $visible_lookup =
        array_fill_keys(
            $valid_order,
            true
        );


    $queue =
        $valid_order;


    $new_order = [];


    foreach (
        $current_order
        as $term_id
    ) {

        if (
            isset(
                $visible_lookup[$term_id]
            )
        ) {

            $new_order[] =
                array_shift(
                    $queue
                );
        } else {

            $new_order[] =
                $term_id;
        }
    }


    /*
   * 念のため残ったものを追加
   */
    foreach (
        $queue
        as $term_id
    ) {

        if (
            !in_array(
                $term_id,
                $new_order,
                true
            )
        ) {

            $new_order[] =
                $term_id;
        }
    }


    /*
   * 保存
   */
    update_option(
        theme_taxonomy_order_option_name(
            $taxonomy
        ),
        $new_order,
        false
    );


    wp_send_json_success([
        'message' =>
        '並び順を保存しました。',
    ]);
}

add_action(
    'wp_ajax_theme_taxonomy_save_order',
    'theme_taxonomy_save_order'
);


/**************************************************************************************
/* 管理画面 JavaScript / CSS
/**************************************************************************************/

function theme_taxonomy_sort_admin_scripts(
    $hook_suffix
) {

    if (
        $hook_suffix !==
        'edit-tags.php'
    ) {
        return;
    }


    $screen =
        get_current_screen();


    if (
        !$screen ||
        empty($screen->taxonomy)
    ) {
        return;
    }


    $taxonomy =
        $screen->taxonomy;


    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {
        return;
    }


    /*
   * 検索結果では並び替え無効
   */
    if (
        !empty($_REQUEST['s'])
    ) {
        return;
    }


    /*
   * 列見出しによるソート中は無効
   */
    if (
        !empty($_REQUEST['orderby'])
    ) {
        return;
    }


    wp_enqueue_script(
        'jquery-ui-sortable'
    );


    $nonce =
        wp_create_nonce(
            'theme_taxonomy_sort_nonce'
        );


    /**************************************
     * JavaScript
     **************************************/
    $script = <<<JS

jQuery(function($) {

  const tbody =
    $('.wp-list-table tbody');


  if (!tbody.length) {
    return;
  }


  tbody.sortable({

    /*
     * ターム行だけ
     */
    items:
      '> tr[id^="tag-"]',

    handle:
      '.taxonomy-sort-handle',

    axis:
      'y',

    cursor:
      'grabbing',

    tolerance:
      'pointer',


    /*
     * ドラッグ中の
     * テーブル幅崩れ防止
     */
    helper: function(e, ui) {

      ui
        .children()
        .each(function() {

          $(this).width(
            $(this).width()
          );

        });


      return ui;
    },


    /*
     * 並び替え完了
     */
    update: function() {

      const order = [];


      tbody
        .children(
          'tr[id^="tag-"]'
        )
        .each(function() {

          const rowId =
            $(this).attr('id');


          if (!rowId) {
            return;
          }


          const termId =
            parseInt(
              rowId.replace(
                'tag-',
                ''
              ),
              10
            );


          if (termId) {
            order.push(termId);
          }

        });


      /*
       * 状態表示
       */
      $('.taxonomy-sort-status')
        .remove();


      $('.wp-heading-inline')
        .after(
          '<span class="taxonomy-sort-status">保存中...</span>'
        );


      /*
       * Ajax
       */
      $.ajax({

        url:
          ajaxurl,

        type:
          'POST',

        dataType:
          'json',

        data: {

          action:
            'theme_taxonomy_save_order',

          nonce:
            '{$nonce}',

          taxonomy:
            '{$taxonomy}',

          order:
            order

        }

      })


      .done(function(response) {

        if (
          response &&
          response.success
        ) {

          $('.taxonomy-sort-status')
            .removeClass('error')
            .text(
              '保存しました'
            );


          setTimeout(
            function() {

              $('.taxonomy-sort-status')
                .fadeOut(
                  300,
                  function() {

                    $(this)
                      .remove();

                  }
                );

            },
            1500
          );


        } else {

          let message =
            '保存に失敗しました';


          if (
            response &&
            response.data &&
            response.data.message
          ) {

            message =
              response.data.message;

          }


          $('.taxonomy-sort-status')
            .addClass('error')
            .text(message);

        }

      })


      .fail(function(xhr) {

        console.error(
          'Taxonomy sort error:',
          xhr.responseText
        );


        $('.taxonomy-sort-status')
          .addClass('error')
          .text(
            '保存に失敗しました'
          );

      });

    }

  });

});

JS;


    wp_add_inline_script(
        'jquery-ui-sortable',
        $script
    );


    /**************************************
     * CSS
     **************************************/
    wp_add_inline_style(
        'common',
        '

    .column-taxonomy_sort {
      width: 36px;
      text-align: center;
    }

    .taxonomy-sort-handle {
      display: inline-block;
      color: #8c8f94;
      cursor: grab;
      vertical-align: middle;
    }

    .taxonomy-sort-handle:hover {
      color: #2271b1;
    }

    .taxonomy-sort-handle:active {
      cursor: grabbing;
    }

    .taxonomy-sort-status {
      display: inline-block;
      margin-left: 15px;
      color: #2271b1;
      font-weight: 600;
    }

    .taxonomy-sort-status.error {
      color: #d63638;
    }

    .wp-list-table
    tbody
    tr.ui-sortable-helper {
      display: table;
      background: #fff;
      box-shadow:
        0 3px 10px
        rgba(0, 0, 0, .15);
    }

    '
    );
}

add_action(
    'admin_enqueue_scripts',
    'theme_taxonomy_sort_admin_scripts'
);


/**************************************************************************************
/* フロント用：並び順を反映してターム取得
/**************************************************************************************/

function theme_get_ordered_terms(
    $taxonomy,
    $args = []
) {

    /*
   * sortableではない場合は
   * 通常のget_terms()
   */
    if (
        !theme_is_sortable_taxonomy(
            $taxonomy
        )
    ) {

        $args['taxonomy'] =
            $taxonomy;


        return get_terms(
            $args
        );
    }


    $order =
        theme_get_taxonomy_order(
            $taxonomy
        );


    /*
   * exclude指定がある場合
   */
    if (
        !empty($args['exclude'])
    ) {

        $exclude =
            wp_parse_id_list(
                $args['exclude']
            );


        $order =
            array_values(
                array_diff(
                    $order,
                    $exclude
                )
            );


        unset(
            $args['exclude']
        );
    }


    /*
   * includeを利用者側で
   * 指定している場合は絞り込む
   */
    if (
        !empty($args['include'])
    ) {

        $include =
            wp_parse_id_list(
                $args['include']
            );


        $order =
            array_values(
                array_intersect(
                    $order,
                    $include
                )
            );
    }


    $args['taxonomy'] =
        $taxonomy;


    if ($order) {

        $args['include'] =
            $order;

        $args['orderby'] =
            'include';

        $args['order'] =
            'ASC';
    }


    return get_terms(
        $args
    );
}
