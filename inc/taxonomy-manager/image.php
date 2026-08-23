<?php

/**************************************************************************************
/* Taxonomy Manager - Image
/**************************************************************************************/


/* 画像対応タクソノミー設定取得
/* ---------------------------------------------------------- */
function theme_get_taxonomy_image_config($taxonomy)
{
    $taxonomies =
        theme_get_custom_taxonomies();


    if (
        !isset($taxonomies[$taxonomy]) ||
        empty($taxonomies[$taxonomy]['image'])
    ) {
        return false;
    }


    return $taxonomies[$taxonomy];
}


/* 画像メタキー取得
/* ---------------------------------------------------------- */
function theme_get_taxonomy_image_meta_key($taxonomy)
{
    $config =
        theme_get_taxonomy_image_config(
            $taxonomy
        );


    if (!$config) {
        return '';
    }


    /*
   * config.php で image_meta_key を
   * 指定している場合はそれを使用
   *
   * 指定がない場合は term_image_id
   */
    return
        !empty($config['image_meta_key'])
        ? sanitize_key(
            $config['image_meta_key']
        )
        : 'term_image_id';
}


/**************************************************************************************
/* 新規追加画面
/**************************************************************************************/

function theme_taxonomy_add_image_field($taxonomy)
{
    $meta_key =
        theme_get_taxonomy_image_meta_key(
            $taxonomy
        );


    if (!$meta_key) {
        return;
    }


    wp_nonce_field(
        'theme_taxonomy_image_save',
        'theme_taxonomy_image_nonce'
    );
?>

    <div class="form-field taxonomy-image-wrap">

        <label>
            画像
        </label>


        <input
            type="hidden"
            name="<?php echo esc_attr($meta_key); ?>"
            class="taxonomy-image-id"
            value="">


        <div
            class="taxonomy-image-preview"
            style="margin-bottom:10px;">
        </div>


        <button
            type="button"
            class="button taxonomy-image-select">
            画像を選択
        </button>


        <button
            type="button"
            class="button taxonomy-image-remove"
            style="display:none;">
            画像を削除
        </button>

    </div>

<?php
}


/**************************************************************************************
/* 編集画面
/**************************************************************************************/

function theme_taxonomy_edit_image_field(
    $term,
    $taxonomy
) {

    $meta_key =
        theme_get_taxonomy_image_meta_key(
            $taxonomy
        );


    if (!$meta_key) {
        return;
    }


    $image_id =
        absint(
            get_term_meta(
                $term->term_id,
                $meta_key,
                true
            )
        );


    $image_url =
        $image_id
        ? wp_get_attachment_url(
            $image_id
        )
        : '';


    wp_nonce_field(
        'theme_taxonomy_image_save',
        'theme_taxonomy_image_nonce'
    );
?>

    <tr class="form-field taxonomy-image-wrap">

        <th scope="row">
            <label>
                画像
            </label>
        </th>


        <td>

            <input
                type="hidden"
                name="<?php echo esc_attr($meta_key); ?>"
                class="taxonomy-image-id"
                value="<?php echo esc_attr($image_id); ?>">


            <div
                class="taxonomy-image-preview"
                style="margin-bottom:10px;">

                <?php if ($image_url) : ?>

                    <img
                        src="<?php echo esc_url($image_url); ?>"
                        alt=""
                        style="max-width:200px;max-height:200px;width:auto;height:auto;">

                <?php endif; ?>

            </div>


            <button
                type="button"
                class="button taxonomy-image-select">
                画像を選択
            </button>


            <button
                type="button"
                class="button taxonomy-image-remove"
                <?php echo $image_id ? '' : 'style="display:none;"'; ?>>
                画像を削除
            </button>

        </td>

    </tr>

<?php
}


/**************************************************************************************
/* 保存
/**************************************************************************************/

function theme_taxonomy_save_image($term_id)
{
    /*
   * nonce確認
   */
    if (
        !isset(
            $_POST['theme_taxonomy_image_nonce']
        ) ||
        !wp_verify_nonce(
            sanitize_text_field(
                wp_unslash(
                    $_POST['theme_taxonomy_image_nonce']
                )
            ),
            'theme_taxonomy_image_save'
        )
    ) {
        return;
    }


    $term =
        get_term($term_id);


    if (
        !$term ||
        is_wp_error($term)
    ) {
        return;
    }


    $taxonomy =
        $term->taxonomy;


    $config =
        theme_get_taxonomy_image_config(
            $taxonomy
        );


    if (!$config) {
        return;
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
        return;
    }


    $meta_key =
        theme_get_taxonomy_image_meta_key(
            $taxonomy
        );


    if (!$meta_key) {
        return;
    }


    /*
   * 画像ID
   */
    $image_id =
        isset($_POST[$meta_key])
        ? absint(
            $_POST[$meta_key]
        )
        : 0;


    /*
   * 画像あり
   */
    if ($image_id) {

        update_term_meta(
            $term_id,
            $meta_key,
            $image_id
        );
    } else {

        /*
     * 画像削除
     */
        delete_term_meta(
            $term_id,
            $meta_key
        );
    }
}


/**************************************************************************************
/* 各タクソノミーへフック登録
/**************************************************************************************/

function theme_register_taxonomy_image_hooks()
{
    $taxonomies =
        theme_get_custom_taxonomies();


    foreach (
        $taxonomies
        as $taxonomy => $config
    ) {

        /*
     * image => true のみ
     */
        if (
            empty($config['image'])
        ) {
            continue;
        }


        /*
     * 新規追加画面
     */
        add_action(
            $taxonomy . '_add_form_fields',
            'theme_taxonomy_add_image_field'
        );


        /*
     * 編集画面
     */
        add_action(
            $taxonomy . '_edit_form_fields',
            'theme_taxonomy_edit_image_field',
            10,
            2
        );


        /*
     * 新規保存
     */
        add_action(
            'created_' . $taxonomy,
            'theme_taxonomy_save_image'
        );


        /*
     * 編集保存
     */
        add_action(
            'edited_' . $taxonomy,
            'theme_taxonomy_save_image'
        );
    }
}

theme_register_taxonomy_image_hooks();


/**************************************************************************************
/* 管理画面 メディアライブラリ
/**************************************************************************************/

function theme_taxonomy_image_admin_scripts(
    $hook_suffix
) {

    /*
   * ターム一覧・編集画面のみ
   */
    if (
        $hook_suffix !== 'edit-tags.php' &&
        $hook_suffix !== 'term.php'
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


    /*
   * 画像対応タクソノミーか確認
   */
    if (
        !theme_get_taxonomy_image_config(
            $screen->taxonomy
        )
    ) {
        return;
    }


    /*
   * WordPressメディアライブラリ
   */
    wp_enqueue_media();


    $script = <<<'JS'

jQuery(function($) {


  /**************************************
   * 画像選択
   **************************************/
  $(document).on(
    'click',
    '.taxonomy-image-select',
    function(e) {

      e.preventDefault();


      const wrap =
        $(this).closest(
          '.taxonomy-image-wrap'
        );


      const frame =
        wp.media({

          title:
            '画像を選択',

          button: {
            text:
              'この画像を使用'
          },

          multiple:
            false

        });


      frame.on(
        'select',
        function() {

          const attachment =
            frame
              .state()
              .get('selection')
              .first()
              .toJSON();


          /*
           * attachment ID
           */
          wrap
            .find(
              '.taxonomy-image-id'
            )
            .val(
              attachment.id
            );


          /*
           * プレビュー
           *
           * SVGにも対応するため
           * attachment.urlを使用
           */
          wrap
            .find(
              '.taxonomy-image-preview'
            )
            .html(
              '<img src="' +
              attachment.url +
              '" alt="" style="max-width:200px;max-height:200px;width:auto;height:auto;">'
            );


          /*
           * 削除ボタン
           */
          wrap
            .find(
              '.taxonomy-image-remove'
            )
            .show();

        }
      );


      frame.open();

    }
  );


  /**************************************
   * 画像削除
   **************************************/
  $(document).on(
    'click',
    '.taxonomy-image-remove',
    function(e) {

      e.preventDefault();


      const wrap =
        $(this).closest(
          '.taxonomy-image-wrap'
        );


      /*
       * ID削除
       */
      wrap
        .find(
          '.taxonomy-image-id'
        )
        .val('');


      /*
       * プレビュー削除
       */
      wrap
        .find(
          '.taxonomy-image-preview'
        )
        .empty();


      /*
       * 削除ボタン非表示
       */
      $(this).hide();

    }
  );

});

JS;


    wp_add_inline_script(
        'jquery-core',
        $script
    );
}

add_action(
    'admin_enqueue_scripts',
    'theme_taxonomy_image_admin_scripts'
);


/**************************************************************************************
/* フロント用 画像ID取得
/**************************************************************************************/

function theme_get_term_image_id(
    $term_id,
    $taxonomy = ''
) {

    $term_id =
        absint($term_id);


    if (!$term_id) {
        return 0;
    }


    /*
   * taxonomy未指定なら
   * termから取得
   */
    if (!$taxonomy) {

        $term =
            get_term($term_id);


        if (
            !$term ||
            is_wp_error($term)
        ) {
            return 0;
        }


        $taxonomy =
            $term->taxonomy;
    }


    $meta_key =
        theme_get_taxonomy_image_meta_key(
            $taxonomy
        );


    if (!$meta_key) {
        return 0;
    }


    return absint(
        get_term_meta(
            $term_id,
            $meta_key,
            true
        )
    );
}


/**************************************************************************************
/* フロント用 画像URL取得
/**************************************************************************************/

function theme_get_term_image_url(
    $term_id,
    $taxonomy = ''
) {

    $image_id =
        theme_get_term_image_id(
            $term_id,
            $taxonomy
        );


    if (!$image_id) {
        return '';
    }


    $image_url =
        wp_get_attachment_url(
            $image_id
        );


    return
        $image_url
        ? $image_url
        : '';
}
