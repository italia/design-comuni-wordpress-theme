<?php

/**
 * Definisce post type Sito Tematico
 */
add_action( 'init', 'dci_register_post_type_sito_tematico', 60 );
function dci_register_post_type_sito_tematico() {

    /** evento **/
    $labels = array(
        'name'                  => _x( 'Siti Tematici', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Sito Tematico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Sito Tematico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Sito Tematico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo del Sito Tematico', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica il Sito Tematico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Sito Tematico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Sito Tematico' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Sito Tematico' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Sito Tematico' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Sito Tematico', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-links',
        'has_archive'           => true,
        'capability_type' => array('sito_tematico', 'siti_tematici'),
        'map_meta_cap'    => true,
        'description'    => __( "Questa Tipologia descrive la struttura di un Sito Tematico, che può essere fisico, virtuale o digitale", 'design_comuni_italia' ),

    );
    register_post_type( 'sito_tematico', $args );

    remove_post_type_support( 'sito_tematico', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_sito_tematico_add_content_after_title' );
function dci_sito_tematico_add_content_after_title($post) {
    if($post->post_type == "sito_tematico")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo del Sito Tematico *</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Sito Tematico
 */
add_action( 'cmb2_init', 'dci_add_sito_tematico_metaboxes' );
function dci_add_sito_tematico_metaboxes() {
    $prefix = '_dci_sito_tematico_';

    $cmb_dati = new_cmb2_box( array(
        'id'           => $prefix . 'box_dati_card',
        'title'        => __( 'Card' ),
        'object_types' => array( 'sito_tematico' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );


    $cmb_dati->add_field( array(
        'name'       => __('Sottotitolo/descrizione *', 'design_comuni_italia' ),
        'desc'       => __('Esempio: "Il Sistema Museale della città, polo di attrazione cittadina e turistica"', 'design_comuni_italia' ),
        'id'         => $prefix . 'descrizione_breve',
        'type'       => 'textarea',
        'attributes'    => array(
            'required'    => 'required',
            'maxlength'  => '255',
        ),
    ) );

    $cmb_dati->add_field( array(
        'name'       => __('URL sito tematico *', 'design_comuni_italia' ),
        'desc'       => __('URL esterno, link al sito tematico"', 'design_comuni_italia' ),
        'id'         => $prefix . 'link',
        'type'       => 'text_url',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_dati->add_field( array(
            'id'    => $prefix . 'immagine',
            'name' => __('Immagine', 'design_comuni_italia' ),
            'desc' => __( 'Seleziona un\'immagine da mostrare  nella Card del sito tematico', 'design_comuni_italia' ),
            'type' => 'file',
            'query_args' => array( 'type' => 'image' ),
        )
    );

}
