<?php

/**
 * Definisce la tassonomia Tipi di Documento
 */
add_action( 'init', 'dci_register_taxonomy_tipi_documento', -10 );
function dci_register_taxonomy_tipi_documento() {

    $labels = array(
        'name'              => _x( 'Tipi di Documento', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Documento', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di Documento', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Documento ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Documento', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Documento', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Documento', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Documento', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Documento', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => true, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => true,    //archive page
        //'rewrite'           => array( 'slug' => 'tipo-documento' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_documento',
            'edit_terms'    => 'edit_tipi_documento',
            'delete_terms'  => 'delete_tipi_documento',
            'assign_terms'  => 'assign_tipi_documento'
        )
    );

    register_taxonomy( 'tipi_documento', array( 'documento_pubblico' ), $args );
}