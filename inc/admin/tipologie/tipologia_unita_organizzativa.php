<?php
/**
 * Definisce post type Unità organizzativa
 */
add_action( 'init', 'dci_register_post_type_unita_organizzativa', 60 );
function dci_register_post_type_unita_organizzativa() {
    /** scheda **/
    $labels = array(
        'name'          => _x( 'Unità organizzative', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name' => _x( 'Unità organizzativa', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'       => _x( 'Aggiungi una Unità organizzativa', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'  => _x( 'Aggiungi una nuova Unità organizzativa', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'       => _x( 'Modifica l\'Unità organizzativa', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Immagine di riferimento dell\'Unità organizzativa', 'design_comuni_italia' ),
    );

    $args   = array(
        'label'         => __( 'Unità organizzativa', 'design_comuni_italia' ),
        'labels'        => $labels,
        'supports'      => array( 'title', 'editor', 'author', 'thumbnail'),
        //'taxonomies'    => array( 'post_tag' ),
        'hierarchical'  => false,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-admin-multisite',
        'has_archive'   => true,
        'rewrite' => array('slug' => 'unita_organizzativa','with_front' => false),
        'capability_type' => array('unita_orgnaizzativa', 'unita_organizzative'),
        'map_meta_cap'    => true,
        'description'    => __( 'Questa Tipologia descrive la struttura di un\'organizzazione comunale funzionale alla creazione di contenuti come uffici o altre unità organizzative (content type "organizzazione")', 'design_comuni_italia' ),
    );
    register_post_type('unita_organizzativa', $args );

    remove_post_type_support( 'unita_organizzativa', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_unita_organizzativa_add_content_after_title' );
function dci_unita_organizzativa_add_content_after_title($post) {
    if($post->post_type == "unita_organizzativa")
        _e('<span><i>il <b>Titolo</b> è il <b>Nome dell\'Unità Organizzativa</b>.</i></span><br><br>', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Unità organizzativa
 */
add_action( 'cmb2_init', 'dci_add_unita_organizzativa_metaboxes' );
function dci_add_unita_organizzativa_metaboxes() {
    $prefix = '_dci_unita_organizzativa_';

    $cmb_argomenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_argomenti',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );

    $cmb_argomenti->add_field( array(
        'id' => $prefix . 'argomenti',
        'name'        => __( 'Argomenti', 'design_comuni_italia' ),
        'desc' => __( 'Argomenti di cui si occupa' , 'design_comuni_italia' ),
        'type'             => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'argomenti',
        'show_option_none' => false,
        'remove_default' => 'true',
    ) );

    //APERTURA
    $cmb_apertura = new_cmb2_box( array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_apertura->add_field( array(
        'name'       => __('Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine principale e rappresentativa della struttura descritta nella scheda' , 'design_comuni_italia' ),
        'id'             => $prefix . 'immagine',
        'type' => 'file',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    )
    );
    $cmb_apertura->add_field( array(
        'id' => $prefix . 'descrizione_breve',
        'name'        => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( ' Descrizione sintetica (inferiore ai 255 caratteri) della struttura' , 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes'    => array(
            'maxlength'  => '255',
            'required'    => 'required'
        ),
    ) );

    //COSA FA
    $cmb_cosa_fa = new_cmb2_box( array(
        'id'           => $prefix . 'box_cosa_fa',
        'title'        => __( 'Cosa fa', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_cosa_fa->add_field( array(
        'id' => $prefix . 'competenze',
        'name'        => __( 'Competenze *', 'design_comuni_italia' ),
        'desc' => __( 'Elenco/descrizione dei compiti assegnati alla struttura.' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'attributes'    => array(
            'required'    => 'required'
        ),
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );

    //STRUTTURA
    $cmb_struttura = new_cmb2_box( array(
        'id'           => $prefix . 'box_struttura',
        'title'        => __( 'Struttura', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_struttura->add_field( array(
        'id' => $prefix . 'unita_organizzativa_genitore',
        'name'    => __( 'Unità organizzativa genitore', 'design_comuni_italia' ),
        'desc' => __( 'Se la struttura fa parte di un\'Area o altre macro unità, va inserita la struttura principale' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
    ) );

    $cmb_struttura->add_field( array(
        'id' => $prefix . 'responsabile',
        'name'    => __( 'Responsabile', 'design_comuni_italia' ),
        'desc' => __( 'Link alla scheda della persona responsabile della struttura.' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('persona_pubblica'),
    ) );

    $cmb_struttura->add_field( array(
        'id' => $prefix . 'tipo_organizzazione',
        'name'        => __( 'Tipo di organizzazione *', 'design_comuni_italia' ),
        'type'             => 'taxonomy_radio_hierarchical',
        'taxonomy'       => 'tipi_unita_organizzativa',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes' => [
            'required' => 'required'
        ]
    ) );

    $cmb_struttura->add_field( array(
        'id' => $prefix . 'assessore_riferimento',
        'name'    => __( 'assessore di riferimento', 'design_comuni_italia' ),
        'desc' => __( 'L\'assessore di riferimento della struttura, se esiste' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('persona_pubblica'),
    ) );
    

    //PERSONE
    $cmb_persone = new_cmb2_box( array(
        'id'           => $prefix . 'box_persone',
        'title'        => __( 'Persone', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_persone->add_field( array(
        'id' => $prefix . 'persone_struttura',
        'name'    => __( 'Persone che compongono la struttura *', 'design_comuni_italia' ),
        'desc' => __( 'Un link alla scheda persona per ciascuno dei componenti della struttura.' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('persona_pubblica'),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    //SERVIZI
    $cmb_servizi = new_cmb2_box( array(
        'id'           => $prefix . 'box_servizi',
        'title'        => __( 'Servizi', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_servizi->add_field( array(
        'id' => $prefix . 'elenco_servizi_offerti',
        'name'    => __( 'Elenco servizi offerti', 'design_comuni_italia' ),
        'desc' => __( 'Relazione con i servizi offerti dalla struttura' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('servizio'),
    ) );

    //CONTATTI
    $cmb_contatti = new_cmb2_box( array(
        'id'           => $prefix . 'box_contatti',
        'title'        => __( 'Contatti', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'sede_principale',
        'name'        => __( 'Sede principale *', 'design_comuni_italia' ),
        'desc' => __( 'Relazione con un luogo (sede fisica principale)' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('luogo'),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'altre_sedi',
        'name'        => __( 'Altre sedi', 'design_comuni_italia' ),
        'desc' => __( 'Relazioni con eventuali altri luoghi che sono definibili come sedi' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('luogo'),
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'contatti',
        'name'        => __( 'Contatti *', 'design_comuni_italia' ),
        'desc' => __( 'contatti dell\'Unità organizzativa' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('punto_contatto'),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );


    //DOCUMENTI
    $cmb_documenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'low',
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'allegati',
        'name'        => __( 'Allegati', 'design_comuni_italia' ),
        'desc' => __( 'Elenco di documenti allegati alla struttura' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
    ) );

    //ULTERIORI INFORMAZIONI
    $cmb_ulteriori_informazioni = new_cmb2_box( array(
        'id'           => $prefix . 'box_ulteriori_informazioni',
        'title'        => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'object_types' => array( 'unita_organizzativa' ),
        'context'      => 'normal',
        'priority'     => 'low',
    ) );
    $cmb_ulteriori_informazioni->add_field( array(
        'id' => $prefix . 'ulteriori_informazioni',
        'name'        => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'desc' => __( 'Ulteriori informazioni sulla struttura non contemplate dai campi precedenti.' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 6, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );
}