<?php

/**
 * Definisce la tassonomia Tipi di Notizia
 */
add_action( 'init', 'dci_register_taxonomy_tipi_notizia', -10 );
function dci_register_taxonomy_tipi_notizia() {

    $labels = array(
        'name'              => _x( 'Tipi di Notizia', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Notizia', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di Notizia', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Notizia ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Notizia', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Notizia', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Notizia', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Notizia', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Notizia', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => true, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'       => true, //archive page
        //'rewrite'           => array( 'slug' => 'novita' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_notizia',
            'edit_terms'    => 'edit_tipi_notizia',
            'delete_terms'  => 'delete_tipi_notizia',
            'assign_terms'  => 'assign_tipi_notizia'
        )
    );

    register_taxonomy( 'tipi_notizia', array( 'notizia' ), $args );
}