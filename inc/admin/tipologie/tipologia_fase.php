<?php
/**
 * Definisce post type Fase
 */
add_action( 'init', 'dci_register_post_type_fase', 60 );
function dci_register_post_type_fase() {

    $labels = array(
        'name'          => _x( 'Fasi', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name' => _x( 'Fase', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'       => _x( 'Aggiungi una Fase', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'  => _x( 'Aggiungi una nuova Fase', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'       => _x( 'Modifica la Fase', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Immagine di riferimento', 'design_comuni_italia' ),
    );
    $args   = array(
        'label'         => __( 'Fase', 'design_comuni_italia' ),
        'labels'        => $labels,
        'supports'      => array( 'title', 'editor', 'author', 'thumbnail'),
        'hierarchical'  => false,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-clock',
        'has_archive'   => true,
        'rewrite' => array('slug' => 'fase','with_front' => false),
        'capability_type' => array('fase', 'fasi'),
        'map_meta_cap'    => true,
    );
    register_post_type('fase', $args );

    remove_post_type_support( 'fase', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_fase_add_content_after_title' );
function dci_fase_add_content_after_title($post) {
    if($post->post_type == "fase")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della Fase</b>.</i></span><br><br>', 'design_comuni_italia' );
}

add_action( 'cmb2_init', 'dci_add_fase_metaboxes' );
function dci_add_fase_metaboxes() {
    $prefix = '_dci_fase_';

    //TEMPI E SCADENZE
    $cmb_dati = new_cmb2_box( array(
        'id'           => $prefix . 'box_dati',
        'title'        => __( 'Dati fase o scadenza', 'design_comuni_italia' ),
        'object_types' => array( 'fase' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_dati->add_field( array(
        'name'       => __('Titolo *', 'design_comuni_italia' ),
        'desc'       => __('Esempio: "Iscrizione alla gita" oppure "Pagamento della gita"', 'design_comuni_italia' ),
        'id'         => $prefix . 'titolo_fase',
        'type'       => 'text',
        'attributes' => array(
            'required'            => true
        )
    ) );
    $cmb_dati->add_field( array(
        'name'       => __('Data *', 'design_comuni_italia' ),
        'desc'       => __('Data', 'design_comuni_italia' ),
        'id'         => $prefix . 'data_fase',
        'type'       => 'text_date',
        'date_format' => 'd-m-Y',
        'attributes' => array(
            'required'            => true
        )
    ) );


    $cmb_dati->add_field(array(
        'name'       => __('Descrizione', 'design_comuni_italia' ),
        'id'         => $prefix . 'desc_fase',
        'type'       => 'textarea',
    ) );

}