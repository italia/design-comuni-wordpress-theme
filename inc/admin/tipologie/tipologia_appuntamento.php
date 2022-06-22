<?php

/**
 * Definisce post type Appuntamento
 */
add_action( 'init', 'dci_register_post_type_appuntamento', 100 );
function dci_register_post_type_appuntamento() {

    $labels = array(
        'name'                  => _x( 'Appuntamenti', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Appuntamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Appuntamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Appuntamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo dell\'Appuntamento', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica l\'Appuntamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza l\'Appuntamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Appuntamento' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Appuntamento' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Appuntamento' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Appuntamento', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'has_archive'           => true,
        'capability_type' => array('appuntamento', 'appuntamenti'),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura delle informazioni relative utili a presentare un appuntamento", 'design_comuni_italia' ),

    );
    register_post_type( 'appuntamento', $args );

    remove_post_type_support( 'appuntamento', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_appuntamento_add_content_after_title' );
function dci_appuntamento_add_content_after_title($post) {
    if($post->post_type == "appuntamento")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della richiesta</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Appuntamento
 */
add_action( 'cmb2_init', 'dci_add_appuntamento_metaboxes' );
function dci_add_appuntamento_metaboxes()
{
    $prefix = '_dci_appuntamento_';

    $cmb_dati = new_cmb2_box(array(
        'id' => $prefix . 'box_dati',
        'title' => __('Dati'),
        'object_types' => array('appuntamento'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_dati->add_field( array(
        'id' => $prefix . 'dettaglio_richiesta',
        'desc' => __( 'Testo della richiesta' , 'design_comuni_italia' ),
        'name'  => __( 'Dettaglio richiesta *', 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 7, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    /**
     * metabox Date
     */
    $cmb_date = new_cmb2_box(array(
        'id' => $prefix . 'box_date',
        'title' => __('Date'),
        'object_types' => array('appuntamento'),
        'context' => 'side',
        'priority' => 'high',
    ));

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_ora_prenotazione',
        'name'    => __( 'Data e ora in cui è stata fatta la prenotazione *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_ora_inizio_appuntamento',
        'name'    => __( 'Data e ora inizio appuntamento *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_ora_fine_appuntamento',
        'name'    => __( 'Data e ora della fine dell\'appuntamento *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    /**
     * metabox Servizio
     */
    $cmb_servizio = new_cmb2_box(array(
        'id' => $prefix . 'box_servizio',
        'title' => __('Servizio *'),
        'object_types' => array('appuntamento'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_servizio->add_field( array(
        'id' => $prefix . 'servizio',
        'desc' => __( 'Associazione con il servizio per il quale si prende appuntamento' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('servizio')
    ) );

    /**
     * metabox Unità organizzativa
     */
    $cmb_servizio = new_cmb2_box(array(
        'id' => $prefix . 'box_unita_organizzativa',
        'title' => __('Unità organizzativa *'),
        'object_types' => array('appuntamento'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_servizio->add_field( array(
        'id' => $prefix . 'unita_organizzativa',
        'desc' => __( 'Se l\'appuntamento non è su un servizio ma con un\'Unità organizzativa' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa')
    ) );

}
