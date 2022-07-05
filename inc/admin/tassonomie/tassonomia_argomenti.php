<?php

/**
 * Definisce la tassonomia Argomenti
 */
add_action( 'init', 'dci_register_taxonomy_argomenti', -10 );
function dci_register_taxonomy_argomenti() {

    //TASSONOMIA ARGOMENTI
     $labels = array(
        'name'              => _x( 'Argomenti', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Argomento', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Argomento', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutti gli Argomenti', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica Argomento', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna Argomento', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi un Argomento', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuovo Argomento', 'design_comuni_italia' ),
        'menu_name'         => __( 'Argomenti', 'design_comuni_italia' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_nav_menus' => true,
        'rewrite'           => array( 'slug' => 'argomento' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_argomenti',
            'edit_terms'    => 'edit_argomenti',
            'delete_terms'  => 'delete_argomenti',
            'assign_terms'  => 'assign_argomenti'
        )
    );
    register_taxonomy( 'argomenti',dci_get_tipologie_related_to_taxonomy('argomenti'), $args );
}

add_action( 'cmb2_admin_init', 'dci_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function dci_register_taxonomy_metabox() {
    $prefix = 'dci_term_';

    /**
     * Metabox to add fields to categories and tags
     */
    $cmb_term = new_cmb2_box( array(
        'id'               => $prefix . 'edit',
        'title'            => __( 'Personalizzazione <b>pagina Argomento</b>' , 'design_comuni_italia' ), // Doesn't output for term boxes
        'object_types'     => array( 'term' ), // Tells CMB2 to use term_meta vs post_meta
        'taxonomies'       => array( 'argomenti' ), // Tells CMB2 which taxonomies should have these fields
        // 'new_term_section' => true, // Will display in the "Add New Category" section
        'context' => 'normal',
        'priority' => 'high',
    ) );


    $cmb_term->add_field( array(
        'name' => __( 'Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine principale dell\'Area/ufficio', 'design_comuni_italia' ),
        'id'   => $prefix . 'immagine',
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ) );

    $cmb_term->add_field( array(
        'id' => $prefix . 'area_appartenenza',
        'name'    => __( 'Area di appartenenza'  , 'design_comuni_italia' ),
        'desc' => __( 'Aree Amministrative responsabili di questo argomento' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
    ) );

    $cmb_term->add_field( array(
        'id' => $prefix . 'assessorato_riferimento',
        'name'    => __( 'Assessorato di riferimento' , 'design_comuni_italia' ),
        'desc' => __( 'Assessorati che hanno deleghe su questo argomento' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
    ) );

}

add_action('current_screen', 'dci_current_screen_callback');
function dci_current_screen_callback($screen) {
    // Put some checks and balances in place to only replace where and when we need to
    if(
        is_object($screen) && ($screen->base==='edit-tags' || $screen->base==='term') &&
        $screen->taxonomy==='argomenti'){
        add_filter( 'gettext', 'dci_change_argomenti_labels', 99, 3 );
    }
}

function dci_change_argomenti_labels($translated_text, $untranslated_text, $domain){

    if(stripos( $untranslated_text, 'description' )!== FALSE ){
        $translated_text = str_ireplace('Description', 'Descrizione', $untranslated_text);
    }

    return $translated_text;
}

