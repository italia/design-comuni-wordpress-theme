<?php

/**
 * Definisce la tassonomia Tipi di Evento
 */
add_action( 'init', 'dci_register_taxonomy_tipi_evento', -10 );
function dci_register_taxonomy_tipi_evento() {

    $labels = array(
        'name'              => _x( 'Tipi di Evento', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Evento', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di Evento', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Evento ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Evento', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Evento', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Evento', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Evento', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Evento', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tipo-evento' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_evento',
            'edit_terms'    => 'edit_tipi_evento',
            'delete_terms'  => 'delete_tipi_evento',
            'assign_terms'  => 'assign_tipi_evento'
        )
    );

    register_taxonomy( 'tipi_evento', array( 'evento' ), $args );
}