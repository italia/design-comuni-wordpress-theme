<?php

/**
 * Definisce la tassonomia delle Tipologie di Documento che sono di tipo Albo Pretorio
 */
add_action( 'init', 'dci_register_taxonomy_tipi_doc_albo_pretorio', -10 );
function dci_register_taxonomy_tipi_doc_albo_pretorio() {

    $labels = array(
        'name'              => _x( 'Tipi di Documento Albo Pretorio', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Documento Albo Pretorio', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo Documento Albo Pretorio', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Documento Albo Pretorio ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Documento Albo Pretorio', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Documento Albo Pretorio', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Documento Albo Pretorio', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Documento Albo Pretorio', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Documento Albo Pretorio', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => true,    //archive page
        //'rewrite'           => array( 'slug' => 'tipo-doc-albo-pretorio' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_doc_albo_pretorio',
            'edit_terms'    => 'edit_tipi_doc_albo_pretorio',
            'delete_terms'  => 'delete_tipi_doc_albo_pretorio',
            'assign_terms'  => 'assign_tipi_doc_albo_pretorio'
        )
    );

    register_taxonomy( 'tipi_doc_albo_pretorio', array( 'documento' ), $args );
}