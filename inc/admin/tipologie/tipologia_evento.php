<?php

/**
 * Definisce post type Evento
 */
add_action( 'init', 'dci_register_post_type_evento' );
function dci_register_post_type_evento() {

    /** evento **/
    $labels = array(
        'name'                  => _x( 'Eventi', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo del Evento', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica il Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Evento' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Evento' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Evento' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Evento', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position' => 5,
        'menu_icon'             => 'dashicons-tickets-alt',
        'has_archive'           => 'vivere-il-comune/eventi',
        'capability_type' => array('evento', 'eventi'),
        'map_meta_cap'    => true,
        'description'    => __( "Tipologia che struttura le informazioni relative a un evento di interesse pubblico pubblicato sul sito di un comune", 'design_comuni_italia' ),
        'rewrite' => array('slug' => 'vivere-il-comune/eventi'),

    );
    register_post_type( 'evento', $args );

    remove_post_type_support( 'evento', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_evento_add_content_after_title' );
function dci_evento_add_content_after_title($post) {
    if($post->post_type == "evento")
        _e('<span><i>il <b>Titolo</b> è il <b>Nome dell\'Evento</b>.</i></span><br><br>', 'design_comuni_italia' );
}


/**
 * Crea i metabox del post type eventi
 */
add_action( 'cmb2_init', 'dci_add_eventi_metaboxes' );
function dci_add_eventi_metaboxes() {
    $prefix = '_dci_evento_';

    //APERTURA
    $cmb_apertura = new_cmb2_box( array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    //argomenti
    $cmb_tipo_evento = new_cmb2_box( array(
        'id'           => $prefix . 'box_tipo_evento',
        'title'        => __( 'Tipo di evento *', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );
    $cmb_tipo_evento->add_field( array(
        'id'        => $prefix . 'tipo_evento',
        //'name'      => __( 'Tipo di evento *', 'design_comuni_italia' ),
        //'desc'      => __( 'tipologia a cui appartiene l'evento', 'design_comuni_italia' ),
        'type'           => 'taxonomy_radio_hierarchical',
        'taxonomy'       => 'tipi_evento',
        'remove_default' => 'true',
        'show_option_none' => false,
        'attributes' => array(
            'required' => 'required'
        )
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'sottotitolo',
        'name'        => __( 'Sottotitolo', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale sottotitolo o titolo abbreviato' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '255'
        )
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'data_orario_inizio',
        'name'    => __( 'Data e orario di inizio *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'attributes' => array(
            'required' => true
        )
    ) );
    $cmb_apertura->add_field( array(
        'id' => $prefix . 'data_orario_fine',
        'name'    => __( 'Data e orario di fine *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'attributes' => array(
            'required' => true
        )
    ) );

    $cmb_apertura->add_field( array(
            'name'       => __('Immagine', 'design_comuni_italia' ),
            'desc' => __( 'Immagine dell\'evento' , 'design_comuni_italia' ),
            'id'             => $prefix . 'immagine',
            'type' => 'file',
            // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            'query_args' => array( 'type' => 'image' ), // Only images attachment
        )
    );

    $cmb_evento_genitore = new_cmb2_box( array(
        'id'           => $prefix . 'box_evento_genitore',
        'title'        => __( 'Evento genitore', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_evento_genitore -> add_field( array(
        'id'           => $prefix . 'evento_genitore',
        'desc'        => __( 'Selezionare se l\'evento ha un genitore', 'design_comuni_italia' ),
        'type' => 'pw_select',
        'options' => dci_get_posts_options('evento')
    ) );

    //argomenti
    $cmb_argomenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_argomenti',
        'title'        => __( 'Argomenti *', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );
    $cmb_argomenti->add_field( array(
        'id' => $prefix . 'argomenti',
        'type'             => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'argomenti',
        'show_option_none' => false,
        'remove_default' => 'true',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'descrizione_breve',
        'name'        => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione sintentica dell\'evento, inferiore a 255 caratteri' , 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes'    => array(
            'maxlength'  => '255',
            'required'    => 'required'
        ),
    ) );

    //COS'E'
    $cmb_descrizione = new_cmb2_box( array(
        'id'           => $prefix . 'box_descrizione',
        'title'        => __( 'Cos\'è', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'descrizione_completa',
        'name'        => __( 'Descrizione completa *', 'design_comuni_italia' ),
        'desc' => __( 'Introduzione e descrizione esaustiva dell\'evento' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    /**
    $cmb_descrizione->add_field( array(
        'id'         => $prefix . 'gallery',
        'name'       => __( 'Galleria di immagini', 'design_comuni_italia' ),
        'desc'       => __( 'Una o più immagini corredate da didascalie', 'design_comuni_italia' ),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ) );

    $cmb_descrizione->add_field( array(
        'id'         => $prefix . 'video_gallery',
        'name'       => __( 'Galleria di video', 'design_comuni_italia' ),
        'desc'       => __( 'Una o più video corredate da didascalie', 'design_comuni_italia' ),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'video' ), // Only images attachment
    ) );*/

    /**
    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'destinatari_introduzione',
        'name'        => __( 'A chi è rivolto (testo introduttivo) * ', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione testuale dei principali interlocutori dell\'Evento', 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'attributes'    => array(
            'required'    => 'required'
        ),
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );
    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'destinatari_list',
        'name'        => __( 'A chi è rivolto (lista) *', 'design_comuni_italia' ),
        'desc' => __( 'la lista dei destinatari' , 'design_comuni_italia' ),
        'type' => 'textarea',
        'repeatable'  => true
    ) );
    */

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'a_chi_e_rivolto',
        'name'        => __( 'A chi è rivolto *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione testuale dei principali destinatari dell\'Evento' , 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'attributes'    => array(
            'required'    => 'required'
        ),
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );


    $cmb_descrizione->add_field( array(
            'id' => $prefix . 'persone',
            'name'       => __('Persone dell\'amministrazione * ', 'design_comuni_italia' ),
            'desc' => __( 'Link a persone dell\'amministrazione che interverranno all\'evento ', 'design_comuni_italia' ),
            'type'    => 'pw_multiselect',
            'options' => dci_get_posts_options('persona_pubblica'),
            'attributes' => array(
                'placeholder' =>  __( 'Seleziona uno o più persone / utenti', 'design_comuni_italia' ),
            ),
        )
    );


    $cmb_gallerie_multimediali = new_cmb2_box( array(
        'id'           => $prefix . 'box_gallerie_multimediali',
        'title'        => __( 'Gallerie multimediali', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'gallery',
        'name'       => __( 'Galleria di immagini', 'design_comuni_italia' ),
        'desc'       => __( 'Una o più immagini corredate da didascalie', 'design_comuni_italia' ),
        'type' => 'file_list',
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'video',
        'name'       => __( 'Video', 'design_comuni_italia' ),
        'desc'       => __( 'Un video rappresentativo dell\'evento (è possibile insirerire un url esterno))', 'design_comuni_italia' ),
        'type' => 'file',
        'query_args' => array( 'type' => 'video' ), // Only images attachment
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'trascrizione',
        'name'       => __( 'Trascrizione', 'design_comuni_italia' ),
        'desc'       => __( 'Trascrizione del video', 'design_comuni_italia' ),
        'type' => 'textarea'
    ) );

    /**
    // repeater Gallerie Multimediali
    $group_field_id = $cmb_gallerie_multimediali->add_field( array(
        'id'          => $prefix . 'gallerie_multimediali',
        //'name'        => __('<h1>Fasi e Scadenze</h1>', 'design_comuni_italia' ),
        'type'        => 'group',
        'description' => __( 'E\' possibile inserire più gallerie multimediali' , 'design_comuni_italia' ),
        'options'     => array(
            'group_title'    => __( 'Galleria {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi una gallery', 'design_comuni_italia' ),
            'remove_button'  => __( 'Rimuovi la gallery', 'design_comuni_italia' ),
            'sortable'       => true,
            // 'closed'      => true, // true to have the groups closed by default
            //'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );

    $cmb_gallerie_multimediali->add_group_field( $group_field_id, array(
        'name'       => __('Titolo gallery', 'design_comuni_italia' ),
        //'desc'       => __('Esempio: ".."', 'design_comuni_italia' ),
        'id'         => 'titolo_gallery',
        'type'       => 'text',
    ) );
    $cmb_gallerie_multimediali->add_group_field( $group_field_id, array(
        'name'       => __('Media', 'design_comuni_italia' ),
        'desc'       => __('contenuti della gallery (immagini o video)', 'design_comuni_italia' ),
        'id'         => 'contenuti_gallery',
        'type'       => 'file_list',
        'query_args' => array( 'type' => array('image','video') )
    ) );

    /*** fine repeater gallerie **/


    //LUOGO
    $cmb_luogo = new_cmb2_box( array(
        'id'           => $prefix . 'box_luogo',
        'title'        => __( 'Luogo dell\'evento', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_luogo->add_field( array(
        'id' =>  $prefix . 'luogo_evento',
        'name'    => __( 'Luogo dell\'evento', 'design_comuni_italia' ),
        'desc' => __( 'Selezione il <a href="edit.php?post_type=luogo">luogo</a> in cui viene organizzato l\'evento. ' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'show_option_none' => true,
        'options' =>  dci_get_posts_options('luogo'),
        'attributes'    => array(
            'placeholder' =>  __( 'Seleziona il luogo', 'design_comuni_italia' ),
        ),
    ) );


    /**mappa field GPS
    /**
    $cmb_luogo->add_field( array(
    'id'         => $prefix . 'posizione_gps',
    'name'       => __( 'Posizione GPS <br><small>NB: clicca sulla lente d\'ingrandimento e cerca l\'indirizzo, anche se lo hai già inserito nel campo precedente.<br>Questo permetterà una corretta georeferenziazione del luogo</small>', 'design_comuni_italia' ),
    'desc' => __( 'Georeferenziazione del luogo dell\'evento. Se l\'evento è un micro evento. Se l\'evento è un macro evento potrebbe essere difficile classificarlo tramite coordinate specifiche.' , 'design_comuni_italia' ),
    'type'       => 'leaflet_map',
    'attributes' => array(
    'searchbox_position'  => 'topleft', // topright, bottomright, topleft, bottomleft,
    'search'              => __( 'Digita l\'indirizzo della Sede' , 'design_comuni_italia' ),
    'not_found'           => __( 'Indirizzo non trovato' , 'design_comuni_italia' ),
    'initial_coordinates' => [
    'lat' => 41.894802, // Go Italy!
    'lng' => 12.4853384  // Go Italy!
    ],
    'initial_zoom'        => 5, // Zoomlevel when there's no coordinates set,
    'default_zoom'        => 12, // Zoomlevel after the coordinates have been set & page saved
    )
    ) );
     */


    //"paragraph" date dell'evento
    /**
    $group_field_id = $cmb_undercontent->add_field( array(
    'id'          => $prefix . 'date',
    'name'        => __('<h1>Date</h1>' , 'design_comuni_italia' ),
    'type'        => 'group',
    'description' => __( 'Se l\'evento si svolge in più giorni o fasi indica qui di seguito i diversi appuntamenti. Es: inizo attività, pausa pranzo, seconda sessione, etc', 'design_comuni_italia' ),
    'options'     => array(
    'group_title'    => __( 'Fase {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
    'add_button'     => __( 'Aggiungi una data evento', 'design_comuni_italia' ),
    'remove_button'  => __( 'Rimuovi', 'design_comuni_italia' ),
    'sortable'       => true,
    'closed'      => false, // true to have the groups closed by default
    //'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
    ),
    ) );
    $cmb_undercontent->add_group_field( $group_field_id,  array(
    'id'      => 'data',
    'after'    => __( '<br>Data / orario ', 'design_comuni_italia' ),
    'type' => 'text_datetime_timestamp',
    'date_format' => 'd-m-Y',
    ) );
    $cmb_undercontent->add_group_field( $group_field_id,  array(
    'id'      => 'descrizione',
    'desc'    => __( 'Descrizione', 'design_comuni_italia' ),
    'type'             => 'textarea_small',
    'attributes'  => array(
    'rows'        => 3,
    ),
    ) );*/

    //COSTI
    $cmb_costi = new_cmb2_box( array(
        'id'           => $prefix . 'box_costi',
        'title'        => __( 'Costi', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_costi->add_field( array(
        'id' => $prefix . 'costo',
        'name'        => __( 'Costo', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale costo dell\'Evento (se ci sono uno o più biglietti), con link all\'acquisto se disponibile' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );

    //DOCUMENTI
    $cmb_documenti= new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'allegati',
        'name'        => __( 'Allegati', 'design_comuni_italia' ),
        'desc' => __( 'Eventuali documenti in allegato' , 'design_comuni_italia' ),
        'type' => 'file',
    ) );

    //CONTATTI
    $cmb_contatti = new_cmb2_box( array(
        'id'           => $prefix . 'box_contatti',
        'title'        => __( 'Contatti', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'punti_contatto',
        'name'        => __( 'Punti di contatto *', 'design_comuni_italia' ),
        'desc' => __( 'Telefono, mail o altri punti di contatto<br><a href="post-new.php?post_type=punto_contatto">Inserisci Punto di Contatto</a>' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('punto_contatto'),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    //Ulteriori informazioni
    $cmb_informazioni = new_cmb2_box( array(
        'id'           => $prefix . 'box_informazioni',
        'title'        => __( 'Informazioni', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_informazioni->add_field( array(
        'id' => $prefix . 'organizzatore',
        'name'    => __( 'Organizzato da ', 'design_comuni_italia' ),
        'desc' => __( 'Relazione con le unità organizzative che organizzano l\'evento, se presenti' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
    ) );

    $cmb_informazioni->add_field( array(
        'id' => $prefix . 'patrocinato',
        'name'       => __('Patrocinato da ', 'design_comuni_italia' ),
        'desc' => __( 'Nome dell\'ente che patrocina l\'evento. Si raccomanda di non usare sigle ma il nome esteso (es. Non "Mise" ma "Ministero dello sviluppo economico").', 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_informazioni->add_field( array(
        'id' => $prefix . 'sponsor',
        'name'       => __('Sponsor', 'design_comuni_italia' ),
        'desc' => __( 'Lista sponsor dell\'evento', 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_informazioni->add_field( array(
        'id'         => $prefix . 'ulteriori_informazioni',
        'name'       => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'desc'       => __( 'Ulteriori informazioni sull\'evento, FAQ ed eventuali riferimenti normativi', 'design_comuni_italia' ),
        'type'       => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );
}

/**
 * Aggiungo testo prima del content

add_action( 'edit_form_after_title', 'sdi_evento_add_content_before_editor', 100 );
function sdi_evento_add_content_before_editor($post) {
    if($post->post_type == "evento")
        _e('<h1>Descrizione Estesa dell\'evento</h1>', 'design_comuni_italia' );
}*/

/**
 * aggiungo js per controllo compilazione campi
 */
add_action( 'admin_print_scripts-post-new.php', 'dci_evento_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_evento_admin_script', 11 );

function dci_evento_admin_script() {
    global $post_type;
    if( 'evento' == $post_type )
        wp_enqueue_script( 'luogo-admin-script', get_stylesheet_directory_uri() . '/inc/admin-js/evento.js' );
}
