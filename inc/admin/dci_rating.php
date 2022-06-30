<?php
/**
 * Definisce post type Rating (per memorizzare le valutazioni delle pagine del Sito dei Comuni)
 */
add_action( 'init', 'dci_register_post_type_rating', 100 );
function dci_register_post_type_rating() {

    $labels = array(
        'name'                  => _x( 'Valutazioni', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi una Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi una Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        //'featured_image' => __( 'Logo Identificativo del Rating', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica la Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza la Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Valutazione' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Valutazione' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Valutazione' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Rating', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-star-half',
        'has_archive'           => false,
        'capability_type' => array('rating', 'ratings'),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura dei resoconti delle valutazioni degli utenti", 'design_comuni_italia' ),
    );
    register_post_type( 'rating', $args );
    remove_post_type_support( 'rating', 'editor');

    $labels = array(
        'name'              => _x( 'Stars', 'taxonomy general name', 'design_scuole_italia' ),
        'singular_name'     => _x( 'Stars', 'taxonomy singular name', 'design_scuole_italia' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'capabilities'      => array(
            'manage_terms'  => 'manage_stars',
            'edit_terms'    => 'edit_stars',
            'delete_terms'  => 'delete_stars',
            'assign_terms'  => 'assign_stars'
        )
    );

    register_taxonomy( 'stars', array( 'rating' ), $args );

    $labels = array(
        'name'              => _x( 'Page Url', 'taxonomy general name', 'design_scuole_italia' ),
        'singular_name'     => _x( 'Page Url', 'taxonomy singular name', 'design_scuole_italia' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'capabilities'      => array(
            'manage_terms'  => 'manage_page_urls',
            'edit_terms'    => 'edit_page_urls',
            'delete_terms'  => 'delete_page_urls',
            'assign_terms'  => 'assign_page_urls'
        )
    );

    register_taxonomy( 'page_urls', array( 'rating' ), $args );
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_rating_add_content_after_title' );
function dci_rating_add_content_after_title($post) {
    if($post->post_type == "rating")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della pagina o del contenuto valutato</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Rating
 */
add_action( 'cmb2_init', 'dci_add_rating_metaboxes' );
function dci_add_rating_metaboxes()
{
    $prefix = '_dci_rating_';

    $cmb_dati = new_cmb2_box(array(
        'id' => $prefix . 'box_dati',
        'title' => __('Dati'),
        'object_types' => array('rating'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_dati->add_field( array(
        'id' => $prefix . 'url',
        'name'  => __( 'URL', 'design_comuni_italia' ),
        'desc'  => __( 'URL della pagina o del contenuto valutato', 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'risposta_chiusa',
        'name'  => __( 'Risposta scelta multipla', 'design_comuni_italia' ),
        'desc' => __( 'Risposta alla prima domanda (a scelta multipla)' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'risposta_aperta',
        'name'  => __( 'Risposta domanda aperta', 'design_comuni_italia' ),
        'desc' => __( 'Risposta alla domanda aperta' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );
}