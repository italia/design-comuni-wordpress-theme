<?php

add_action( 'wp_enqueue_scripts', 'enqueue_my_frontend_script' );
function enqueue_my_frontend_script() {
    wp_enqueue_script( 'dci-rating', get_template_directory_uri() . '/assets/js/rating.js', array('jquery'), null, true );
    $variables = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    );
    wp_localize_script('dci-rating', "data", $variables);
}
add_action("wp_ajax_save_rating" , "save_rating");
add_action("wp_ajax_nopriv_save_rating" , "save_rating");

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
