<?php

/**
 * Definisce la tassonomia Tipi di Punto di contatto
 */
add_action( 'init', 'dci_register_taxonomy_tipi_punto_contatto', -10 );
function dci_register_taxonomy_tipi_punto_contatto() {

    $labels = array(
        'name'              => _x( 'Tipi di punto di contatto', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipo di punto di contatto', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipo di punto di contatto', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti i Tipi di punto di contatto ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tipo di punto di contatto', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tipo di punto di contatto', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tipo di punto di contatto', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tipo di punto di contatto', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipi di Punto di contatto', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tipo' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_punto_contatto',
            'edit_terms'    => 'edit_tipi_punto_contatto',
            'delete_terms'  => 'delete_tipi_punto_contatto',
            'assign_terms'  => 'assign_tipi_punto_contatto'
        )
    );

    register_taxonomy( 'tipi_punto_contatto', array( 'punto_contatto' ), $args );
}