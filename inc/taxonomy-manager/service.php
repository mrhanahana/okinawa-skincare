<?php

/** タームごとの施術並び替え */
function theme_get_service_orderable_taxonomies()
{
    $result = [];
    foreach (theme_get_custom_taxonomies() as $taxonomy => $config) {
        if (!empty($config['service_orderable'])) {
            $result[] = $taxonomy;
        }
    }
    return $result;
}

function theme_is_service_orderable_taxonomy($taxonomy)
{
    return in_array($taxonomy, theme_get_service_orderable_taxonomies(), true);
}

function theme_service_order_meta_key()
{
    return '_theme_service_order';
}

/** 保存済みの順番を優先し、新規の施術は末尾へ加える。 */
function theme_get_ordered_service_ids_for_term($taxonomy, $term_id, $post_status = 'publish')
{
    if (!theme_is_service_orderable_taxonomy($taxonomy)) {
        return [];
    }

    $available_ids = get_posts([
        'post_type'      => 'service',
        'post_status'    => $post_status,
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'orderby'        => [
            'menu_order' => 'ASC',
            'date'       => 'DESC',
        ],
        'tax_query'      => [[
            'taxonomy' => $taxonomy,
            'field'    => 'term_id',
            'terms'    => (int) $term_id,
        ]],
    ]);

    $available_ids = array_map('absint', $available_ids);
    $saved_ids = get_term_meta($term_id, theme_service_order_meta_key(), true);
    $saved_ids = is_array($saved_ids)
        ? array_values(array_unique(array_map('absint', $saved_ids)))
        : [];
    $ordered_ids = array_values(array_intersect($saved_ids, $available_ids));

    return array_merge($ordered_ids, array_values(array_diff($available_ids, $ordered_ids)));
}

/** ターム別の保存順で施術を取得する。 */
function theme_get_ordered_services_for_term($taxonomy, $term_id, $args = [])
{
    $post_status = $args['post_status'] ?? 'publish';
    $service_ids = theme_get_ordered_service_ids_for_term($taxonomy, $term_id, $post_status);

    return new WP_Query(wp_parse_args($args, [
        'post_type'      => 'service',
        'post_status'    => $post_status,
        'posts_per_page' => -1,
        'post__in'       => $service_ids,
        'orderby'        => 'post__in',
        'tax_query'      => [[
            'taxonomy' => $taxonomy,
            'field'    => 'term_id',
            'terms'    => (int) $term_id,
        ]],
    ]));
}

/** ターム編集画面のドラッグ＆ドロップ一覧。 */
function theme_show_services_on_term_edit_screen($term)
{
    if (!theme_is_service_orderable_taxonomy($term->taxonomy)) {
        return;
    }

    $services = theme_get_ordered_services_for_term(
        $term->taxonomy,
        $term->term_id,
        ['post_status' => 'any']
    );
    ?>
    <tr class="form-field">
        <th scope="row"><label>紐づいている施術</label></th>
        <td>
            <?php if (!$services->have_posts()) : ?>
                <p>紐づく施術はありません。</p>
            <?php else : ?>
                <p>ドラッグ＆ドロップで並び替えると自動保存されます。</p>
                <ul id="theme-service-sortable" class="theme-service-sortable">
                    <?php while ($services->have_posts()) : ?>
                        <?php $services->the_post(); ?>
                        <li data-post-id="<?php echo esc_attr(get_the_ID()); ?>">
                            <span class="dashicons dashicons-menu" aria-hidden="true"></span>
                            <a href="<?php echo esc_url(get_edit_post_link()); ?>"><?php the_title(); ?></a>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <p class="description theme-service-sort-status" aria-live="polite"></p>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php
}

function theme_save_service_order()
{
    check_ajax_referer('theme_service_order', 'nonce');

    $taxonomy = isset($_POST['taxonomy']) ? sanitize_key(wp_unslash($_POST['taxonomy'])) : '';
    $term_id = isset($_POST['term_id']) ? absint($_POST['term_id']) : 0;
    $submitted_ids = isset($_POST['post_ids']) && is_array($_POST['post_ids'])
        ? array_values(array_unique(array_map('absint', wp_unslash($_POST['post_ids']))))
        : [];
    $term = get_term($term_id, $taxonomy);
    $taxonomy_object = get_taxonomy($taxonomy);

    if (
        !$term || is_wp_error($term) ||
        !theme_is_service_orderable_taxonomy($taxonomy) ||
        !$taxonomy_object ||
        !current_user_can($taxonomy_object->cap->manage_terms)
    ) {
        wp_send_json_error(['message' => '保存する権限がありません。'], 403);
    }

    $expected_ids = theme_get_ordered_service_ids_for_term($taxonomy, $term_id, 'any');
    $checked_ids = $submitted_ids;
    sort($expected_ids);
    sort($checked_ids);

    if ($checked_ids !== $expected_ids) {
        wp_send_json_error(['message' => '施術の情報を更新してから、もう一度お試しください。'], 400);
    }

    update_term_meta($term_id, theme_service_order_meta_key(), $submitted_ids);
    wp_send_json_success(['message' => '並び順を保存しました。']);
}
add_action('wp_ajax_theme_save_service_order', 'theme_save_service_order');

function theme_service_order_admin_assets($hook)
{
    if ($hook !== 'term.php') {
        return;
    }

    $screen = get_current_screen();
    $taxonomy = $screen ? $screen->taxonomy : '';
    $term_id = isset($_GET['tag_ID']) ? absint($_GET['tag_ID']) : 0;
    if (!$term_id || !theme_is_service_orderable_taxonomy($taxonomy)) {
        return;
    }

    wp_enqueue_script('jquery-ui-sortable');
    wp_add_inline_style('common', '
        .theme-service-sortable { max-width: 560px; margin: 12px 0; }
        .theme-service-sortable li { align-items: center; background: #fff; border: 1px solid #ccd0d4; cursor: move; display: flex; gap: 8px; margin: -1px 0 0; padding: 10px; }
        .theme-service-sortable .dashicons { color: #72777c; }
        .theme-service-sort-status.error { color: #b32d2e; }
    ');

    $script = 'jQuery(function($) {
        var $list = $("#theme-service-sortable");
        if (!$list.length) { return; }
        var $status = $(".theme-service-sort-status");
        $list.sortable({ update: function() {
            var postIds = $list.children().map(function() { return $(this).data("post-id"); }).get();
            $status.removeClass("error").text("保存中...");
            $.post(' . wp_json_encode(admin_url('admin-ajax.php')) . ', {
                action: "theme_save_service_order",
                nonce: ' . wp_json_encode(wp_create_nonce('theme_service_order')) . ',
                taxonomy: ' . wp_json_encode($taxonomy) . ',
                term_id: ' . (int) $term_id . ',
                post_ids: postIds
            }).done(function(response) {
                if (response.success) { $status.text(response.data.message); }
                else { $status.addClass("error").text(response.data.message); }
            }).fail(function() {
                $status.addClass("error").text("保存に失敗しました。ページを再読み込みしてお試しください。");
            });
        }});
    });';
    wp_add_inline_script('jquery-ui-sortable', $script);
}
add_action('admin_enqueue_scripts', 'theme_service_order_admin_assets');

foreach (theme_get_service_orderable_taxonomies() as $taxonomy) {
    add_action($taxonomy . '_edit_form_fields', 'theme_show_services_on_term_edit_screen');
}
