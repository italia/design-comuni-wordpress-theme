<?php

/**
 * Definisce la tassonomia Tipi di Unità organizzativa
 */
add_action( 'init', 'dci_register_taxonomy_tipi_unita_organizzativa', -10 );
function dci_register_taxonomy_tipi_unita_organizzativa() {

    $labels = array(
        'name'              => _x( 'Tipi di Unità organizzativa', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Unità organizzativa', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di Unità organizzativa', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Unità organizzativa ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Unità organizzativa', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Unità organizzativa', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Unità organizzativa', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Unità organizzativao', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Unità organizzativa', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tipi_unita_organizzativa' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_unita_organizzativa',
            'edit_terms'    => 'edit_tipi_unita_organizzativa',
            'delete_terms'  => 'delete_tipi_unita_organizzativa',
            'assign_terms'  => 'assign_tipi_unita_organizzativa'
        ),
        'show_in_rest'          => true,
        'rest_base'             => 'tipi_unita_organizzativa',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy( 'tipi_unita_organizzativa', array( 'unita_organizzativa' ), $args );
}