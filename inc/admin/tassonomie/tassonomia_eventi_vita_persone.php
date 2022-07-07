<?php

/**
 * Definisce la tassonomia degli Eventi della vita delle persone (Life Events)
 */
add_action( 'init', 'dci_register_taxonomy_eventi_vita_persone', -10 );
function dci_register_taxonomy_eventi_vita_persone() {

    $labels = array(
        'name'              => _x( 'Eventi della vita delle Persone', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Evento della vita delle Persone', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Evento della vita delle Persone', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutte gli Eventi della vita delle Persone ', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica l\'Evento della vita delle Persone', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna l\'Evento della vita delle Persone', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Evento della vita delle Persone', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuov o Evento della vita delle Persone', 'design_comuni_italia' ),
        'menu_name'         => __( 'Eventi della vita delle Persone', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'evento-vita-persona' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_eventi_vita_persone',
            'edit_terms'    => 'edit_eventi_vita_persone',
            'delete_terms'  => 'delete_eventi_vita_persone',
            'assign_terms'  => 'assign_eventi_vita_persone'
        )
    );

    register_taxonomy( 'eventi_vita_persone', array( 'documento_pubblico', 'documento_privato', 'servizio'), $args );
}