<?php

/**
 * Definisce la tassonomia degli Stati di pratica, definibile come lo stato dell'iter conseguente a una richiesta
 */
add_action( 'init', 'dci_register_taxonomy_stati_pratica', -10 );
function dci_register_taxonomy_stati_pratica() {

    $labels = array(
        'name'              => _x( 'Stati di una Pratica', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Stato di una Pratica', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Stato di una Pratica', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti gli Stati di una Pratica', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica lo Stato di una Pratica', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna lo Stato di una Pratica', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi uno Stato di una Pratica', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Stato di una Pratica', 'design_comuni_italia' ),
        'menu_name'         => __( 'Stati di una Pratica', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'stato-pratica' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_stati_pratica',
            'edit_terms'    => 'edit_stati_pratica',
            'delete_terms'  => 'delete_stati_praticaa',
            'assign_terms'  => 'assign_stati_pratica'
        )
    );

    register_taxonomy( 'stati_pratica', array( 'pratica' ), $args );
}