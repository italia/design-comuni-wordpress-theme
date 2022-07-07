<?php

/**
 * Definisce la tassonomia dei Tipi di incarico che una persona può ricoprire presso un'amministrazione locale
 */
add_action( 'init', 'dci_register_taxonomy_tipi_incarico', -10 );
function dci_register_taxonomy_tipi_incarico() {

    $labels = array(
        'name'              => _x( 'Tipi di Incarico', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di Incarico', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di Incarico', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di Incarico', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di Incarico', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di Incarico', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di Incarico', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di Incarico', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Incarico', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tipo-incarico' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_incarico',
            'edit_terms'    => 'edit_tipi_incarico',
            'delete_terms'  => 'delete_tipi_incarico',
            'assign_terms'  => 'assign_tipi_incarico'
        )
    );

    register_taxonomy( 'tipi_incarico', array( 'incarico' ), $args );
}