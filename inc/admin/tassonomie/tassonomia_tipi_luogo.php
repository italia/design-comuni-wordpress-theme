<?php

/**
 * Definisce la tassonomia Tipi di Luogo
 */
add_action( 'init', 'dci_register_taxonomy_tipi_luogo', -10 );
function dci_register_taxonomy_tipi_luogo() {

    $labels = array(
        'name'              => _x( 'Tipi di Luogo', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Luogo', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di Luogo', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Luogo ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Luogo', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Luogo', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Luogo', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Luogo', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Luogo', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tipo-luogo' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_luogo',
            'edit_terms'    => 'edit_tipi_luogo',
            'delete_terms'  => 'delete_tipi_luogo',
            'assign_terms'  => 'assign_tipi_luogo'
        )
    );

    register_taxonomy( 'tipi_luogo', array( 'luogo' ), $args );
}