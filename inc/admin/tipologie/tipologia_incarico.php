<?php

/**
 * Definisce post type Incarico
 */
add_action( 'init', 'dci_register_post_type_incarico', 60 );
function dci_register_post_type_incarico() {

    $labels = array(
        'name'                  => _x( 'Incarichi', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Incarico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Incarico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Incarico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo dell\'Incarico', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica l\'Incarico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza l\'Incarico', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Incarico' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Incarico' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Incarico' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Incarico', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-businessman',
        'has_archive'           => true,
        'capability_type' => array('incarico', 'incarichi'),
        'map_meta_cap'    => true,
        'description'    => __( "Questa Tipologia descrive la struttura di cariche, incarichi o ruoli salienti per il dominio (sito di un comune), funzionale alla creazione di una scheda persona", 'design_comuni_italia' ),

    );
    register_post_type( 'incarico', $args );

    remove_post_type_support( 'incarico', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_incarico_add_content_after_title' );
function dci_incarico_add_content_after_title($post) {
    if($post->post_type == "incarico")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo carica o incarico</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Incarico
 */
add_action( 'cmb2_init', 'dci_add_incarico_metaboxes' );
function dci_add_incarico_metaboxes()
{
    $prefix = '_dci_incarico_';

    $cmb_dati = new_cmb2_box(array(
        'id' => $prefix . 'box_dati',
        'title' => __('Dati'),
        'object_types' => array('incarico'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_dati->add_field( array(
        'id' => $prefix . 'tipo_incarico',
        'name'  => __( 'Tipo di incarico *', 'design_comuni_italia' ),
        'type'  => 'taxonomy_radio_hierarchical',
        'taxonomy' => 'tipi_incarico',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'compensi',
        'name'        => __( 'Compensi', 'design_comuni_italia' ),
        'desc' => __( 'Solo per incarico politico: compensi di qualsiasi natura connessi all\'assunzione della carica' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'importi_viaggi_servizi',
        'name'        => __( 'Importi di viaggio e/o servizio', 'design_comuni_italia' ),
        'desc' => __( 'Solo per incarico politico: importi di viaggi di servizio e missioni pagati con fondi pubblici' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'persona',
        'name'    => __( 'Persona', 'design_comuni_italia' ),
        'desc' => __( 'La persona che ha la carica e l\'incarico' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('persona_pubblica'),
        'attributes'    => array(
          //  'required'    => 'required',
            'placeholder' =>  __( 'Seleziona una Persona Pubblica', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'unita_organizzativa',
        'name'    => __( 'Unità organizzativa', 'design_comuni_italia' ),
        'desc' => __( 'L\'organizzazione presso la quale svolge l\'incarico' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),'attributes' => array(
            'placeholder' =>  __( 'Seleziona una Unità Organizzativa', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'responsabile_struttura',
        'name'    => __( 'Responsabile della struttura', 'design_comuni_italia' ),
        'desc' => __( 'Se è un incarico di responsabilità, specificare l\'organizzazione della quale è responsabile in base all\'incarico' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona una Unità Organizzativa', 'design_comuni_italia' ),
        ),
    ) );

    /**
     * metabox Date
     */
    $cmb_date = new_cmb2_box(array(
        'id' => $prefix . 'box_date',
        'title' => __('Date'),
        'object_types' => array('incarico'),
        'context' => 'side',
        'priority' => 'high',
    ));

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_inizio_incarico',
        'name'    => __( 'Data inizio incarico *', 'design_comuni_italia' ),
        'desc' => __( 'Data di inizio dell\'incarico' , 'design_comuni_italia' ),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_conclusione_incarico',
        'name'    => __( 'Data conclusione incarico', 'design_comuni_italia' ),
        'desc' => __( 'Data in cui termina l\'incarico o la carica' , 'design_comuni_italia' ),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
    ) );

     $cmb_date->add_field( array(
        'id' => $prefix . 'data_insediamento',
        'name'    => __( 'Data insediamento', 'design_comuni_italia' ),
        'desc' => __( 'Solo per incarichi politici: specificare la data di insediamento' , 'design_comuni_italia' ),
        'type'    => 'text_date_timestamp',
         'date_format' => 'd-m-Y',
    ) );

    /**
     * metabox Documenti
     */
    $cmb_documenti = new_cmb2_box(array(
        'id' => $prefix . 'box_documenti',
        'title' => __('Documenti'),
        'object_types' => array('incarico'),
        'context' => 'normal',
        'priority' => 'low',
    ));

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'atto_nomina',
        'name'    => __( 'Atto di nomina', 'design_comuni_italia' ),
        'desc' => __( 'Inserire riferimento all\'atto di nomina della persona' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona il Documento Pubblico', 'design_comuni_italia' ),
        ),
    ) );

    /**
     * metabox Informazioni
     */
    $cmb_informazioni = new_cmb2_box(array(
        'id' => $prefix . 'box_informazioni',
        'title' => __('Informazioni'),
        'object_types' => array('incarico'),
        'context' => 'normal',
        'priority' => 'low',
    ));

    $cmb_informazioni->add_field( array(
        'id' => $prefix . 'ulteriori_informazioni',
        'name'        => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'desc' => __( 'Ulteriori informazioni relative all\'incarico' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

}
