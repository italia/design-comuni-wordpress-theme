<?php

/**
 * Definisce la tassonomia Licenze dei dataset
 */
add_action( 'init', 'dci_register_taxonomy_licenze', -10 );
function dci_register_taxonomy_licenze() {

    $labels = array(
        'name'              => _x( 'Licenze', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Licenza', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Licenza', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutte le licenze', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica la Licenza', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna la Licenza', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi una Licenza', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuova Licenza', 'design_comuni_italia' ),
        'menu_name'         => __( 'Licenze', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'licenza' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_licenze',
            'edit_terms'    => 'edit_licenze',
            'delete_terms'  => 'delete_licenze',
            'assign_terms'  => 'assign_licenze'
        )
    );

    register_taxonomy( 'licenze', array( 'documento_pubblico', 'documento_privato', 'dataset' ), $args );
}