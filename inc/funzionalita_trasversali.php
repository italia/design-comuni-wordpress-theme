<?php

/**
 * Estendo Wordpress Rest Api
 */
function dci_register_sedi_route() {
    register_rest_route('wp/v2', '/sedi/ufficio/', array(
        'methods' => 'GET',
        'callback' => 'dci_get_sedi_ufficio'
    ));
}
add_action('rest_api_init', 'dci_register_sedi_route');

/**
 * restituisce i luoghi che sono referenxiati come sedi dell'Unità Organizzativa passata come parametro (id o title)
 * @param WP_REST_Request $request
 * @return array[]
 */
function dci_get_sedi_ufficio(WP_REST_Request $request) {

    $params = $_GET;
    if (array_key_exists('title', $params)) {
        $ufficio  = get_page_by_title($params['title'], OBJECT, 'unita_organizzativa');
        $id = $ufficio -> ID;
    }
    else if (array_key_exists('id', $params)) {
        $id = $params['id'];
    }

    $sedi_ids = array();
    $sede_principale = dci_get_meta('sede_principale','_dci_unita_organizzativa_', $id);

    if ($sede_principale != '') {
        $sedi_ids [] = $sede_principale;
    }

    $altre_sedi [] = dci_get_meta('altre_sedi','_dci_unita_organizzativa_', $id);

    if (!empty($altre_sedi[0])) {
        foreach ($altre_sedi[0] as $sede) {
            if ($sede != $sede_principale) {
                $sedi_ids [] = $sede;
            }
        }
    }

    if (!isset($id)) {
        return array(
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            ));
    }

    $sedi = array();

    $sedi = get_posts([
        'post_type' => 'luogo',
        'post_status' => 'publish',
        'numberposts' => -1,
        'post__in' => $sedi_ids,
        'order_by' => 'post__in'
    ]);

    foreach ($sedi as $sede) {
        $sede -> indirizzo = dci_get_meta('indirizzo','_dci_luogo_', $sede ->ID);
        $sede -> apertura = dci_get_meta('orario_pubblico','_dci_luogo_', $sede ->ID);
    }

    return $sedi;
}

/**
 * script dci-rating
 */
function enqueue_my_frontend_script() {
    wp_enqueue_script( 'dci-rating', get_template_directory_uri() . '/assets/js/rating.js', array('jquery'), null, true );
    $variables = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script('dci-rating', "data", $variables);
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_frontend_script' );


/**
 * crea contenuto di tipo Rating
 */
function save_rating(){

    $params = json_decode(json_encode($_POST), true);

    if((array_key_exists("title", $params)) && ($params['title']!= null)) {
        $postId = wp_insert_post(array(
            'post_type' => 'rating',
            'post_title' =>  $params['title']
        ));
    }

    if($postId == 0) {
        echo json_encode(array(
            "success" => false,
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )));
        wp_die();
    }

    if(array_key_exists("star", $params) && $params['star'] != "null") {
        wp_set_object_terms($postId, $params['star'], "stars");
    }

    if(array_key_exists("radioResponse", $params) && $params['radioResponse'] != "null") {
        update_post_meta($postId, '_dci_rating_risposta_chiusa',  $params['radioResponse']);
    }

    if(array_key_exists("freeText", $params) && $params['freeText'] != "null") {
        update_post_meta($postId, '_dci_rating_risposta_aperta',  $params['freeText']);
    }

    if(array_key_exists("page", $params) && $params['page'] != "null") {
        update_post_meta($postId, '_dci_rating_url',  $params['page']);
        wp_set_object_terms($postId, $params['page'], "page_urls");
    }

    echo json_encode(array(
        "success" => true,
        "rating" => array(
            "id" => $postId)
    ));
    wp_die();
}
add_action("wp_ajax_save_rating" , "save_rating");
add_action("wp_ajax_nopriv_save_rating" , "save_rating");