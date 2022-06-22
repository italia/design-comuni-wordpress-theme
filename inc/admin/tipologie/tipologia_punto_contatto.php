<?php

/**
 * Definisce post type Punto di contatto
 */
add_action( 'init', 'dci_register_post_type_punto_contatto', 60 );
function dci_register_post_type_punto_contatto() {

    /** evento **/
    $labels = array(
        'name'                  => _x( 'Punti di contatto', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Punto di contatto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Punto di contatto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Punto di contatto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo del Punto di contatto', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica il Punto di contatto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Punto di contatto', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Punto di contatto' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Punto di contatto' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Punto di contatto' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Punto di contatto', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-phone',
        'has_archive'           => true,
        'capability_type' => array('punto_contatto', 'punti_contatto'),
        'map_meta_cap'    => true,
        'description'    => __( "Questa Tipologia descrive la struttura di un punto di contatto, che può essere fisico, virtuale o digitale", 'design_comuni_italia' ),

    );
    register_post_type( 'punto_contatto', $args );

    remove_post_type_support( 'punto_contatto', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_punto_contatto_add_content_after_title' );
function dci_punto_contatto_add_content_after_title($post) {
    if($post->post_type == "punto_contatto")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo del Punto di contatto</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Punto di contatto
 */
add_action( 'cmb2_init', 'dci_add_punto_contatto_metaboxes' );
function dci_add_punto_contatto_metaboxes() {
    $prefix = '_dci_punto_contatto_';

    $cmb_dati = new_cmb2_box( array(
        'id'           => $prefix . 'box_dati',
        'title'        => __( 'Dati' ),
        'object_types' => array( 'punto_contatto' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $group_field_id = $cmb_dati->add_field( array(
        'id'          => $prefix . 'voci',
        //'name'        => __('<h1>Fasi e Scadenze</h1>', 'design_comuni_italia' ),
        'type'        => 'group',
        'description' => __( 'Inserire più voci di contatto' , 'design_comuni_italia' ),
        'options'     => array(
            'group_title'    => __( 'Voce {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi una voce', 'design_comuni_italia' ),
            'remove_button'  => __( 'Rimuovi la voce', 'design_comuni_italia' ),
            'sortable'       => true,
            // 'closed'      => true, // true to have the groups closed by default
            //'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );

    $cmb_dati->add_group_field( $group_field_id, array(
        'id' => $prefix . 'tipo_punto_contatto',
        'name'        => __( 'Tipo punto di contatto *', 'design_comuni_italia' ),
        'type'             => 'pw_select',
        'show_option_none' => true,
        'remove_default' => false,
        'options' => dci_get_terms_options('tipi_punto_contatto', true),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_dati->add_group_field( $group_field_id, array(
        'id' => $prefix . 'valore',
        'name' => __('Valore punto di contatto *','design_comuni_italia'),
        'desc' => __( 'Il valore del punto di contatto: il numero compreso di prefisso internazionale (se telefono), l\'account (se social network), l\'URL (se sito o pagina web), l\'indirizzo email (se email)', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '160',
            'required'    => 'required'
        ),
    ) );



    $cmb_dati->add_field( array(
        'id' => $prefix . 'persona',
        'name'    => __( 'Persona', 'design_comuni_italia' ),
        'desc' => __( 'Se una persona è un punto di contatto di un\'altra Tipologia' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('persona_pubblica'),
    ) );
}