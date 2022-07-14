<?php

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_page_add_content_after_title' );
function dci_page_add_content_after_title($post) {
    if($post->post_type == "page")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della Pagina</b>.</i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
* Crea i metabox del post type page
*/
add_action( 'cmb2_init', 'dci_add_page_metaboxes' );
function dci_add_page_metaboxes() {
    $prefix = '_dci_page_';

    $cmb_descrizione = new_cmb2_box( array(
    'id'           => $prefix . 'box_descrizione',
    'object_types' => array( 'page' ),
    'context'      => 'after_title',
    'priority'     => 'high',
    ) );

    $args =  array(
        'id' => $prefix . 'descrizione',
        'name'        => __( 'Descrizione *', 'design_comuni_italia' ),
        'desc'        => __( 'Una breve descrizione compare anche nella card di presentazione della pagina', 'design_comuni_italia' ),
        'type'             => 'textarea',
        'attributes' => array(
            'required' => 'required',
            'maxlength' => 255
        ),
    );

    /**
     * disabilito editor body e title per le pagine del Sito dei Comuni
     * rendo il campo descrivione_breve readonly
     */
    global $pagenow;
    if (( $pagenow == 'post.php' ) || (get_post_type() == 'post')) {

        if(isset($_GET['post']))
            $curr_page_id = $_GET['post'];
        else if(isset($_POST['post_ID']))
            $curr_page_id = $_POST['post_ID'];

        if ( ! isset( $curr_page_id ) ) {
            return;
        }

        $curr_page_id = $_GET['post'];
        $slug = get_post_field( 'post_name', $curr_page_id );

        // Get the name of the Page Template file.
        $template_file = get_post_meta( $curr_page_id, '_wp_page_template', true );
        $template_name = basename($template_file, ".php");

        //se la pagina utilizza un template del Sito dei Comuni
        if (in_array($template_name, dci_get_pagine_template_names())) {

            remove_post_type_support( 'page', 'editor' );

            remove_post_type_support( 'page', 'title' );

            $args['attributes'] = array(
                'required' => 'required',
                'maxlength' => 255,
                'readonly' => true
            );
        }

    }

    $cmb_descrizione->add_field($args);

}

/**
 * disabilito quick edit del titolo per le pagine del Sito dei Comuni
 * @param $actions
 * @param $post
 * @return mixed
 */
function dci_page_row_actions( $actions, $post ) {

    //se la pagina ha slug tra le pagine create all'attivazione del tema
    if ( 'page' === $post->post_type && in_array ($post->post_name, dci_get_pagine_slugs())) {

        // Removes the "Quick Edit" action.
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'page_row_actions', 'dci_page_row_actions', 10, 2 );