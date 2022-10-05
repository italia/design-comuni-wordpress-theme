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
        'featured_image' => __( 'Logo Identificativo dell\'Evento', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica l\'Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza l\'Evento', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Evento' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Evento' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Evento' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Evento', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position' => 5,
        'menu_icon'             => 'dashicons-tickets-alt',
        'has_archive'           => false,
        'rewrite' => array('slug' => 'vivere-il-comune/eventi', 'with_front' => false),
        'capability_type' => array('evento', 'eventi'),
        'map_meta_cap'    => true,
        'description'    => __( "Tipologia che struttura le informazioni relative a un evento di interesse pubblico pubblicato sul sito di un comune", 'design_comuni_italia' ),
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

    //tipo evento
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
        //'desc'      => __( 'Tipologia a cui appartiene l'evento', 'design_comuni_italia' ),
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
        'name'    => __( 'Data e orario di inizio', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'data_orario_fine',
        'name'    => __( 'Data e orario di fine', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'name'       => __('Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine dell\'evento' , 'design_comuni_italia' ),
        'id'             => $prefix . 'immagine',
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ),
    ));

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
        'options' => dci_get_posts_options('evento'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona Evento genitore', 'design_comuni_italia' ),
        ),
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
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'a_chi_e_rivolto',
        'name'        => __( 'A chi è rivolto *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione testuale dei principali destinatari dell\'Evento' , 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'attributes'    => array(
            'required'    => 'required'
        ),
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
    ) );

    $cmb_descrizione->add_field( array(
            'id' => $prefix . 'persone',
            'name'       => __('Persone dell\'amministrazione', 'design_comuni_italia' ),
            'desc' => __( 'Link a persone dell\'amministrazione che interverranno all\'evento ', 'design_comuni_italia' ),
            'type'    => 'pw_multiselect',
            'options' => dci_get_posts_options('persona_pubblica'),
            'attributes' => array(
                'placeholder' =>  __( 'Seleziona le Persone Pubbliche', 'design_comuni_italia' ),
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
        'query_args' => array( 'type' => 'image' ),
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'video',
        'name'       => __( 'Video', 'design_comuni_italia' ),
        'desc'       => __( 'Un video rappresentativo dell\'evento (è possibile insirerire un url esterno).', 'design_comuni_italia' ),
        'type' => 'file',
        'query_args' => array( 'type' => 'video' ),
    ) );

    $cmb_gallerie_multimediali->add_field( array(
        'id'         => $prefix . 'trascrizione',
        'name'       => __( 'Trascrizione', 'design_comuni_italia' ),
        'desc'       => __( 'Trascrizione del video', 'design_comuni_italia' ),
        'type' => 'textarea'
    ) );

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
            'placeholder' =>  __( 'Seleziona il Luogo', 'design_comuni_italia' ),
        ),
    ) );

  //COSTI
    $cmb_costi = new_cmb2_box( array(
        'id'           => $prefix . 'box_costi',
        'title'        => __( 'Costi', 'design_comuni_italia' ),
        'object_types' => array( 'evento' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    // repeater Costi
    $group_field_id = $cmb_costi->add_field( array(
    'id'          => $prefix . 'costi',
    'type'        => 'group',
    'options'     => array(
    'group_title'    => __( 'Costo {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
    'add_button'     => __( 'Aggiungi un costo', 'design_comuni_italia' ),
    'remove_button'  => __( 'Rimuovi il costo', 'design_comuni_italia' ),
    'sortable'       => true,
    ),
    ) );

    $cmb_costi->add_group_field( $group_field_id, array(
    'name'       => __('Titolo', 'design_comuni_italia' ),
     'description' => __( 'Es: il tipo di biglietto ("Intero","Ridotto"...)' , 'design_comuni_italia' ),
    'id'         => 'titolo_costo',
    'type'       => 'text',
    ) );

    $cmb_costi->add_group_field( $group_field_id, array(
    'name'       => __('Prezzo', 'design_comuni_italia' ),
    'id'         => 'prezzo_costo',
    'type'       => 'text',
    ) );

    $cmb_costi->add_group_field( $group_field_id, array(
    'name'       => __('Descrizione', 'design_comuni_italia' ),
    'id'         => 'descrizione_costo',
    'type'       => 'textarea',
    ) );

    /*** fine repeater Costi **/

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
            'required'    => 'required',
            'placeholder' =>  __( ' Seleziona i Punti di Contatto', 'design_comuni_italia' ),
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
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona le Unità Organizzative', 'design_comuni_italia' ),
        ),
    ) );

    //repeater link ("Patrocinato da")
    $group_field_id = $cmb_informazioni->add_field( array(
        'id'          => $prefix . 'patrocinato',
        'type'        => 'group',
        'description' => __( '<b>Patrocinato da</b>' , 'design_comuni_italia' ),
        'options'     => array(
            'group_title'    => __( 'Link {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi un link', 'design_comuni_italia' ),
            'remove_button'  => __( 'Rimuovi il link', 'design_comuni_italia' ),
            'sortable'       => true,
            ),
    ) );

    $cmb_informazioni->add_group_field( $group_field_id, array(
        'id' => $prefix . 'nome',
        'name' => __('Nome Ente','design_comuni_italia'),
        'desc' => __( 'Nome dell\'ente che patrocina l\'evento. Si raccomanda di non usare sigle ma il nome esteso (es. Non "Mise" ma "Ministero dello sviluppo economico").', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            //'required'    => 'required'
        ),
    ) );

    $cmb_informazioni->add_group_field( $group_field_id, array(
        'id' => $prefix . 'url',
        'name' => __('URL','design_comuni_italia'),
        'desc' => __( 'URL del Link', 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes'    => array(
            //'required'    => 'required'
        ),
    ) );
    //fine repeater

    //repeater link ("Sponsor")
    $group_field_id = $cmb_informazioni->add_field( array(
        'id'          => $prefix . 'sponsor',
        'type'        => 'group',
        'description' => __( '<b>Sponsor</b>' , 'design_comuni_italia' ),
        'options'     => array(
            'group_title'    => __( 'Link {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi un link', 'design_comuni_italia' ),
            'remove_button'  => __( 'Rimuovi il link', 'design_comuni_italia' ),
            'sortable'       => true,
        ),
    ) );

    $cmb_informazioni->add_group_field( $group_field_id, array(
        'id' => $prefix . 'nome',
        'name' => __('Nome Sponsor','design_comuni_italia'),
        //'desc' => __( 'Nome dello sponsor', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            //'required'    => 'required'
        ),
    ) );

    $cmb_informazioni->add_group_field( $group_field_id, array(
        'id' => $prefix . 'url',
        'name' => __('URL','design_comuni_italia'),
        'desc' => __( 'URL del Link', 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes'    => array(
            //'required'    => 'required'
        ),
    ) );
    //fine repeater

    $cmb_informazioni->add_field( array(
        'id'         => $prefix . 'ulteriori_informazioni',
        'name'       => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'desc'       => __( 'Ulteriori informazioni sull\'evento, FAQ ed eventuali riferimenti normativi', 'design_comuni_italia' ),
        'type'       => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
    ) );
}

/**
 * aggiungo js per controllo compilazione campi
 */
add_action( 'admin_print_scripts-post-new.php', 'dci_evento_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_evento_admin_script', 11 );

function dci_evento_admin_script() {
    global $post_type;
    if( 'evento' == $post_type )
        wp_enqueue_script( 'luogo-admin-script', get_template_directory_uri() . '/inc/admin-js/evento.js' );
}


/**
 * Valorizzo il post content in base al contenuto dei campi custom
 * @param $data
 * @return mixed
 */
function dci_evento_set_post_content( $data ) {

    if($data['post_type'] == 'evento') {

        $descrizione_breve = '';
        if (isset($_POST['_dci_evento_descrizione_breve'])) {
            $descrizione_breve = $_POST['_dci_evento_descrizione_breve'];
        }

        $descrizione_estesa = '';
        if (isset($_POST['_dci_evento_descrizione_completa'])) {
            $descrizione_estesa = $_POST['_dci_evento_descrizione_completa'];
        }

        $info = '';
        if (isset($_POST['_dci_evento_ulteriori_informazioni'])) {
            $info = $_POST['_dci_evento_ulteriori_informazioni'];
        }

        $content = $descrizione_breve.'<br>'.$descrizione_estesa.'<br>'.$info;
        $data['post_content'] = $content;

        /**
         * Pulizia field data per campi non compilati
         */
        if (isset($_POST['_dci_evento_data_orario_inizio']) && isset($_POST['_dci_evento_data_orario_inizio']['date']) && $_POST['_dci_evento_data_orario_inizio']['date'] == "") {
            unset($_POST["_dci_evento_data_orario_inizio"]);
        }
        if (isset($_POST['_dci_evento_data_orario_fine']) && isset($_POST['_dci_evento_data_orario_fine']['date']) && $_POST['_dci_evento_data_orario_fine']['date'] == "") {
            unset($_POST["_dci_evento_data_orario_fine"]);
        }
    }
    return $data;
}
add_filter( 'wp_insert_post_data' , 'dci_evento_set_post_content' , '99', 1 );
