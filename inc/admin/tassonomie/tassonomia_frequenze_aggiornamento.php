<?php

/**
 * Definisce la tassonomia Frequenza di aggiornamento
 */
add_action( 'init', 'dci_register_taxonomy_frequenze_aggiornamento', -10 );
function dci_register_taxonomy_frequenze_aggiornamento() {

    $labels = array(
        'name'              => _x( 'Frequenze di aggiornamento', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Frequenza di aggiornamento', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Frequenza di aggiornamento', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutte le frequenze di aggiornamento ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica la Frequenza di aggiornamento', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna la Frequenza di aggiornamento', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi una Frequenza di aggiornamento', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuova Frequenza di aggiornamento', 'design_comuni_italia' ),
        'menu_name'         => __( 'Frequenze di aggiornamento', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'frequenza-di-aggiornamento' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_frequenze_aggiornamento',
            'edit_terms'    => 'edit_frequenze_aggiornamento',
            'delete_terms'  => 'delete_frequenze_aggiornamento',
            'assign_terms'  => 'assign_frequenze_aggiornamento'
        )
    );

    register_taxonomy( 'frequenze_aggiornamento', array( 'dataset' ), $args );
}