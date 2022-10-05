<?php

/**
 * Definisce post type Messaggio
 */
add_action( 'init', 'dci_register_post_type_messaggio', 100 );
function dci_register_post_type_messaggio() {

    /** evento **/
    $labels = array(
        'name'                  => _x( 'Messaggi', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Messaggio', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Messaggio', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Messaggio', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo del Messaggio', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica il Messaggio', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Messaggio', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Messaggio' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Messaggio' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Messaggio' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Messaggio', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-testimonial',
        'has_archive'           => true,
        'capability_type' => array('messaggio', 'messaggi'),
        'map_meta_cap'    => true,
        'description'    => __( "Content type utile per l’implementazione dell’AREA RISERVATA", 'design_comuni_italia' ),

    );
    register_post_type( 'messaggio', $args );

    remove_post_type_support( 'messaggio', 'editor');
}


/**
 * Aggiungo notice per segnalare l'appartenenza della tipologia all'Area Riservata
 * @param $views
 * @return mixed
 */
function dci_messaggio_desc_notice( $views ){

    $screen = get_current_screen();
    $post_type = get_post_type_object($screen->post_type);

    if ($post_type->description) {
        echo '<div class="notice notice-warning settings-error is-dismissible"><p>'.$post_type->description.'</p></div>';
    }

    return $views;
}

add_filter("views_edit-messaggio", 'dci_messaggio_desc_notice');

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_messaggio_add_content_after_title' );
function dci_messaggio_add_content_after_title($post) {
    if($post->post_type == "messaggio")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo del Messaggio</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Messaggio
 */
add_action( 'cmb2_init', 'dci_add_messaggio_metaboxes' );
function dci_add_messaggio_metaboxes() {
    $prefix = '_dci_messaggio_';

    $cmb_dati = new_cmb2_box( array(
        'id'           => $prefix . 'box_dati',
        'title'        => __( 'Dati' ),
        'object_types' => array( 'messaggio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'data_messaggio',
        'name'    => __( 'Data del Messaggio *', 'design_comuni_italia' ),
        'desc' => __('Data di invio del Messaggio', 'design_comuni_italia'),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
        'attributes' => array(
            'required' => 'required'
        )
    ) );

    $cmb_dati->add_field(array(
        'id' => $prefix . 'testo_messaggio',
        'name' => __('Testo del Messaggio *', 'design_comuni_italia'),
        'desc' => __('Contenuto del Messaggio (es: "In data 31/02 abbiamo fatto una multa al tuo veicolo XK123 Ti inviamo le indicazioni per il pagamento)"', 'design_comuni_italia'),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
        'attributes' => array(
            'required' => 'required'
        )
    ));

    //SERVIZIO/pratica
    $cmb_pratica_servizio = new_cmb2_box(array(
        'id' => $prefix . 'box_pratica_servizio',
        'title' => __('Pratiche/ Servizi', 'design_comuni_italia'),
        'object_types' => array('messaggio'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_pratica_servizio->add_field( array(
        'id' => $prefix . 'pratica_associata',
        'name'    => __( 'Pratica associata', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale pratica associata' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('pratica'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona la Pratica', 'design_comuni_italia' ),
        )
    ) );

    $cmb_pratica_servizio->add_field( array(
        'id' => $prefix . 'servizio_collegato',
        'name'    => __( 'Servizio collegato', 'design_comuni_italia' ),
        'desc' => __( 'Se il documento non è collegato a una pratica è possibile indicare il servizio che ha generato il messaggio' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('servizio'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona il Servizio', 'design_comuni_italia' ),
        )
    ) );

    $cmb_data_scadenza = new_cmb2_box(array(
        'id' => $prefix . 'box_data_scadenza',
        'title' => __('Data scadenza', 'design_comuni_italia'),
        'object_types' => array('messaggio'),
        'context' => 'side',
        'priority' => 'high',
    ));


    $cmb_data_scadenza->add_field( array(
        'id' => $prefix . 'data_scadenza',
        'desc' => __('Data entro la quale rispondere', 'design_comuni_italia'),
        'type'    => 'text_date_timestamp',
    ) );

    /**
     * metabox Documenti
     */
    $cmb_documenti = new_cmb2_box(array(
        'id' => $prefix . 'box_documenti',
        'title' => __('Documenti'),
        'object_types' => array('messaggio'),
        'context' => 'normal',
        'priority' => 'low',
    ));

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'documenti_pubblici',
        'name'    => __( 'Documenti pubblici', 'design_comuni_italia' ),
        'desc' => __( 'Link ai documenti (Es. modulo per...)' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona i Documenti Pubblici', 'design_comuni_italia' ),
        )
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'documenti_privati',
        'name'    => __( 'Documenti privati', 'design_comuni_italia' ),
        'desc' => __( 'Link ai documenti (Es. ricevuta pagamento fatto. Es. certificato residenza)' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_privato'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona i Documenti Privati', 'design_comuni_italia' ),
        )
    ) );
}
