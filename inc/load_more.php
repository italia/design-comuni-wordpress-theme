<?php


add_action( 'wp_enqueue_scripts', 'load_more_script' );
function load_more_script() {
	global $wp_query, $the_query, $wp_the_query;

    wp_enqueue_script( 'dci-load_more', get_template_directory_uri() . '/assets/js/load_more.js', array('jquery'), null, true );
    $variables = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'posts' => json_encode( $wp_query->query_vars ), 
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
        'nonce' => wp_create_nonce('dci_load_more'),
    );
    wp_localize_script('dci-load_more', "data", $variables);
}

function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}


function dci_sanitize_load_more_post_types($post_types) {
    $allowed = array('post', 'page', 'notizia', 'servizio', 'documento', 'luogo', 'domanda_frequente', 'unita_organizzativa', 'evento');
    $post_types = is_array($post_types) ? $post_types : array($post_types);
    $post_types = array_map('sanitize_key', $post_types);
    $post_types = array_values(array_intersect($post_types, $allowed));
    return !empty($post_types) ? $post_types : array('post');
}

function dci_safe_json_array_from_post($key) {
    if (!isset($_POST[$key])) {
        return array();
    }
    $decoded = json_decode(wp_unslash($_POST[$key]), true);
    return is_array($decoded) ? $decoded : array();
}


// load more posts
add_action("wp_ajax_load_more" , "load_more");
add_action("wp_ajax_nopriv_load_more" , "load_more");
function load_more(){
    global $servizio, $i, $hide_categories;

    check_ajax_referer('dci_load_more', 'nonce');

    $load_card_type = isset($_POST['load_card_type']) ? sanitize_key(wp_unslash($_POST['load_card_type'])) : '';
    $post_types = dci_sanitize_load_more_post_types(dci_safe_json_array_from_post('post_types'));
    $url_query_params = dci_safe_json_array_from_post('query_params');

    $post_count = isset($_POST['post_count']) ? absint($_POST['post_count']) : 0;
    $load_posts = isset($_POST['load_posts']) ? absint($_POST['load_posts']) : 10;
    $posts_per_page = max(1, min(50, $post_count + $load_posts));
    $search = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])) : '';

    $args = array(
        's' => $search,
        'posts_per_page' => $posts_per_page,
        'post_type' => $post_types,
        'post_status' => 'publish',
        'order' => 'DESC',
        'meta_query' => array(
            array(
                'key' => '_dci_notizia_data_pubblicazione',
            )
        ),
        'meta_type' => 'text_date_timestamp',
        'orderby' => 'meta_value_num',
    );

    if (!in_array('notizia', $post_types, true)) {
        $args['orderby'] = 'post_title';
        $args['order'] = 'ASC';
        unset($args['meta_query'], $args['meta_type']);
    }

    if (isset($url_query_params['post_terms'])) {
        $terms = array_map('absint', (array) $url_query_params['post_terms']);
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'argomenti',
                'field' => 'id',
                'terms' => $terms,
            )
        );
    }
    if (isset($url_query_params['post_types'])) {
        $args['post_type'] = dci_sanitize_load_more_post_types($url_query_params['post_types']);
    }
    if (isset($url_query_params['s'])) {
        $args['s'] = sanitize_text_field($url_query_params['s']);
    }

    $new_query = new WP_Query($args);

    $out = '';
    if ($new_query->have_posts()) :
        $i = 0;
        while ($new_query->have_posts()): $new_query->the_post();
            $post = get_post();
            ++$i;

            if ($load_card_type == "servizio"){
                $servizio = $post;
                $out .= load_template_part("template-parts/servizio/card");
            }
            if ($load_card_type == "categoria_servizio"){
                $servizio = $post;
                $hide_categories = true;
                $out .= load_template_part("template-parts/servizio/card");
            }
            if ($load_card_type == "notizia"){
                $out .= load_template_part("template-parts/novita/cards-list");
            }
            if ($load_card_type == "documento"){
                $out .= load_template_part("template-parts/documento/cards-list");
            }
            if ($load_card_type == "global-search"){
                $out .= load_template_part("template-parts/search/item");
            }
            if ($load_card_type == "domanda-frequente"){
                $out .= load_template_part("template-parts/domanda-frequente/item");
            }
            if ($load_card_type == "luogo"){
                $out .= load_template_part("template-parts/luogo/card-full");
            }
        endwhile;
    endif;

    $res = array();
    $res['response'] = $out;
    $res['post_count'] = count($new_query->posts);
    if ($new_query->found_posts <= count($new_query->posts)) {
        $res['all_results'] = true;
    }

    wp_reset_postdata();
    wp_send_json($res);
}