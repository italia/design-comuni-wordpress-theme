<?php

/**
 * Definisce la tassonomia Temi di un dataset
 */
add_action( 'init', 'dci_register_taxonomy_temi_dataset', -10 );
function dci_register_taxonomy_temi_dataset() {

    $labels = array(
        'name'              => _x( 'Temi', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tema', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tema', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutte i Temi', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica il Tema', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna il Tema', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Tema', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Tema', 'design_comuni_italia' ),
        'menu_name'         => __( 'Temi Dataset', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => false, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tema' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_temi_dataset',
            'edit_terms'    => 'edit_temi_dataset',
            'delete_terms'  => 'delete_temi_dataset',
            'assign_terms'  => 'assign_temi_dataset'
        )
    );

    register_taxonomy( 'temi_dataset', array( 'dataset' ), $args );
}