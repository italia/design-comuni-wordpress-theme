<?php

/**
 * Definisce post type Pagamento
 */
add_action( 'init', 'dci_register_post_type_pagamento', 100 );
function dci_register_post_type_pagamento() {

    $labels = array(
        'name'                  => _x( 'Pagamenti', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Pagamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Pagamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Pagamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo del Pagamento', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica il Pagamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Pagamento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Pagamento' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Pagamento' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Pagamento' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Pagamento', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-money',
        'has_archive'           => true,
        'capability_type' => array('pagamento', 'pagamenti'),
        'map_meta_cap'    => true,
        'description'    => __( "Content type utile per l’implementazione dell’AREA RISERVATA", 'design_comuni_italia' ),

    );
    register_post_type( 'pagamento', $args );

    remove_post_type_support( 'pagamento', 'editor');
}

/**
 * Aggiungo notice per segnalare l'appartenenza della tipologia all'Area Riservata
 * @param $views
 * @return mixed
 */
function dci_pagamento_desc_notice( $views ){

    $screen = get_current_screen();
    $post_type = get_post_type_object($screen->post_type);

    if ($post_type->description) {
        echo '<div class="notice notice-warning settings-error is-dismissible"><p>'.$post_type->description.'</p></div>';
    }

    return $views;
}

add_filter("views_edit-pagamento", 'dci_pagamento_desc_notice');

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_pagamento_add_content_after_title' );
function dci_pagamento_add_content_after_title($post) {
    if($post->post_type == "pagamento")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo del Pagamento</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Pagamento
 */
add_action( 'cmb2_init', 'dci_add_pagamento_metaboxes' );
function dci_add_pagamento_metaboxes() {
    $prefix = '_dci_pagamento_';

    //protocollo
    $cmb_protocollo = new_cmb2_box( array(
        'id'           => $prefix . 'box_protocollo',
        'title'        => __( 'Numero di protocollo *', 'design_comuni_italia' ),
        'object_types' => array( 'pagamento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_protocollo->add_field( array(
        'id' => $prefix . 'numero_protocollo',
        'desc' => __('Codice univoco che associa il pagamento ad una pratica', 'design_comuni_italia'),
        'type' => 'text',
        'attributes' => array(
            'maxlength' => '255',
            'required' => 'required'
        )
    ) );

    $cmb_dati = new_cmb2_box( array(
        'id'           => $prefix . 'box_dati',
        'title'        => __( 'Dati' ),
        'object_types' => array( 'pagamento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'ricevuta',
        'name'        => __( 'Ricevuta *', 'design_comuni_italia' ),
        'desc' => __( 'URL per scaricare la ricevuta' , 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes'    => array(
            'required' => 'required'
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'data_pagamento',
        'name'    => __( 'Data Pagamento *', 'design_comuni_italia' ),
        'desc' => __('Data in cui è stato effettuato il pagamento', 'design_comuni_italia'),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
        'attributes' => array(
            'required' => 'required'
        )
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'importo_pagato',
        'name'    => __( 'Importo pagato *', 'design_comuni_italia' ),
        'desc' => __('Riportare l\'importo del pagamento effettuato', 'design_comuni_italia'),
        'type'    => 'text',
        'attributes' => array(
            'type' => 'number',
            'required' => 'required',        )
    ) );


    $cmb_dati->add_field(array(
        'id' => $prefix . 'descrizione_pagamento',
        'name' => __('Descrizione del Pagamento *', 'design_comuni_italia'),
        'desc' => __('Descrizione del pagamento effettuato. Esempio: "Pagamento della prima rata d\'iscrizione all\'asilo nido per anno 2020"', 'design_comuni_italia'),
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

    $cmb_dati->add_field(array(
        'id' => $prefix . 'modalita_pagamento',
        'name' => __('Modalità di pagamento *', 'design_comuni_italia'),
        'desc' => __('Descrivere la modalità di pagamento utilizzata (bonifico, carta di credito, etc...) ed esporre i codici per eventuali riconciliazioni bancarie (es. codici MAV)', 'design_comuni_italia'),
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
        'object_types' => array('pagamento'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_pratica_servizio->add_field( array(
        'id' => $prefix . 'pratica_associata',
        'name'    => __( 'Pratica associata', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale pratica associata al pagamento (se presente)' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('pratica'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona la Pratica', 'design_comuni_italia' ),
        )
    ) );

    $cmb_pratica_servizio->add_field( array(
        'id' => $prefix . 'servizio_collegato',
        'name'    => __( 'Servizio collegato', 'design_comuni_italia' ),
        'desc' => __( 'Se il pagamento non è collegato a una pratica ma contempla un servizio, riportare il servizio che permette di soddisfare il task richiesto' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('servizio'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona il Servizio', 'design_comuni_italia' ),
        )
    ) );

    $cmb_esito = new_cmb2_box( array(
        'id'           => $prefix . 'box_esito',
        'title'        => __( 'Esito *' ),
        'object_types' => array( 'pagamento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_esito->add_field( array(
        'id' => $prefix . 'esito',
        'desc' => __( 'Prevedere un campo dove informare l\'utente dell\'esito del pagamento' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '255',
        ),
    ) );

    /**
     * metabox Documenti
     */
    $cmb_documenti = new_cmb2_box(array(
        'id' => $prefix . 'box_documenti',
        'title' => __('Documenti'),
        'object_types' => array('pagamento'),
        'context' => 'normal',
        'priority' => 'low',
    ));

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'documenti_personali',
        'name'    => __( 'Documenti personali', 'design_comuni_italia' ),
        'desc' => __( 'Eventuali documenti personali allegati' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_privato'),
        'attributes' => array(
            'placeholder' =>  __( ' Seleziona i Documenti Privati', 'design_comuni_italia' ),
        )
    ) );
}
