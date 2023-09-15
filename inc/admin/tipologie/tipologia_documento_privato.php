<?php
/**
 * Definisce post type Documento privato
 */
add_action( 'init', 'dci_register_post_type_documento_privato', 60);
function dci_register_post_type_documento_privato() {

    /** documenti **/
    $labels = array(
        'name'          => _x( 'Documenti Privati', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name' => _x( 'Documento Privato', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'       => _x( 'Aggiungi un Documento Privato', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'  => _x( 'Aggiungi un Documento Privato', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'       => _x( 'Modifica il Documento Privato', 'Post Type Singular Name', 'design_comuni_italia' ),
    );
    $args   = array(
        'label'         => __( 'Documento Privato', 'design_comuni_italia' ),
        'labels'        => $labels,
        'supports'      => array( 'title', 'editor' , 'thumbnail' ),
        'taxonomies'    => array( 'tipologia' ),
        'hierarchical'  => false,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-portfolio',
        'has_archive'   => true,
        'capability_type' => array('documento_privato', 'documenti_privati'),
        'map_meta_cap'    => true,
        'description'    => __( "Content type utile per l’implementazione dell’AREA RISERVATA", 'design_comuni_italia' ),
    );
    register_post_type( 'documento_privato', $args );

    remove_post_type_support( 'documento_privato', 'editor');
}

/**
 * Aggiungo notice per segnalare l'appartenenza della tipologia all'Area Riservata
 * @param $views
 * @return mixed
 */
function dci_documento_privato_desc_notice( $views ){

    $screen = get_current_screen();
    $post_type = get_post_type_object($screen->post_type);

    if ($post_type->description) {
        echo '<div class="notice notice-warning settings-error is-dismissible"><p>'.$post_type->description.'</p></div>';
    }

    return $views;
}

add_filter("views_edit-documento_privato", 'dci_documento_privato_desc_notice');


/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_documento_privato_add_content_after_title' );
function dci_documento_privato_add_content_after_title($post) {
    if($post->post_type == "documento_privato")
        _e('<span><i>il <b>Titolo</b> è il <b>Nome del Documento</b>.<i></span><br><br>', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Documento privato
 */
add_action( 'cmb2_init', 'dci_add_documento_privato_metaboxes' );
function dci_add_documento_privato_metaboxes()
{

    $prefix = '_dci_documento_privato_';
    //protocollo
    $cmb_protocollo = new_cmb2_box( array(
        'id'           => $prefix . 'box_protocollo',
        'title'        => __( 'Protocollo', 'design_comuni_italia' ),
        'object_types' => array( 'documento_privato' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_protocollo->add_field( array(
        'id' => $prefix . 'numero_protocollo',
        'name'        => __( 'Numero di protocollo', 'design_comuni_italia' ),
        'desc' => __('Numero di protocollo del documento', 'design_comuni_italia'),
        'type' => 'text',
        'attributes' => array(
            'maxlength' => '255'
        )
    ) );

    $cmb_protocollo->add_field( array(
        'id' => $prefix . 'data_protocollo',
        'name'        => __( 'Data protocollo', 'design_comuni_italia' ),
        'desc' => __('Data di protocollo del documento', 'design_comuni_italia'),
        'type' => 'text_date',
        'date_format' => 'd-m-Y',
        'data-datepicker' => json_encode( array(
            'yearRange' => '-100:+0',
        ) )
    ) );

    //APERTURA
    $cmb_apertura = new_cmb2_box(array(
        'id' => $prefix . 'box_apertura',
        'title' => __('Apertura', 'design_comuni_italia'),
        'object_types' => array('documento_privato'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_apertura->add_field( array(
            'name'       => __('Immagine', 'design_comuni_italia' ),
            'desc' => __( 'Immagine di riferimento del documento' , 'design_comuni_italia' ),
            'id'             => $prefix . 'immagine',
            'type' => 'file',
            // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            'query_args' => array( 'type' => 'image' ), // Only images attachment
        )
    );

    //argomenti
    $cmb_argomenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_argomenti',
        'title'        => __( 'Argomenti *', 'design_comuni_italia' ),
        'object_types' => array( 'documento_privato' ),
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


    $cmb_apertura->add_field(array(
        'id' => $prefix . 'descrizione_breve',
        'name' => __('Descrizione breve *', 'design_comuni_italia'),
        'desc' => __('Indicare una sintetica descrizione del documento utilizzando un linguaggio semplice che possa aiutare qualsiasi utente a identificare con chiarezza il documento. Non utilizzare un linguaggio ricco di riferimenti normativi. VIncoli: 160 caratteri spazi inclusi.', 'design_comuni_italia'),
        'type' => 'textarea',
        'attributes' => array(
            'maxlength' => '255',
            'required' => 'required'
        ),
    ));

    $cmb_documento = new_cmb2_box(array(
        'id' => $prefix . 'box_documento',
        'title' => __('Documento *', 'design_comuni_italia'),
        'object_types' => array('documento_privato'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_documento->add_field(array(
        'id' => $prefix . 'url_documento',
        'name' => __('Documento: URL', 'design_comuni_italia'),
        'desc' => __('Link al documento vero e proprio', 'design_comuni_italia'),
        'type' => 'text_url'
    ));
    $cmb_documento->add_field(array(
        'id' => $prefix . 'file_documento',
        'name' => __('Documento: Carica file', 'design_comuni_italia'),
        'desc' => __('Se non è presente un link a risorsa esterna, bisogna ricordarsi di allegare il documento vero e proprio, in un formato scaricabile e stampabile da parte dell\'utente', 'design_comuni_italia'),
        'type' => 'file',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => __('Aggiungi un nuovo allegato', 'design_comuni_italia'), // default: "Add or Upload Files"
            'remove_image_text' => __('Rimuovi allegato', 'design_comuni_italia'), // default: "Remove Image"
            'remove_text' => __('Rimuovi', 'design_comuni_italia'), // default: "Remove"
        ),
    ));

    //DESCRIZIONE
    $cmb_descrizione = new_cmb2_box(array(
        'id' => $prefix . 'box_descrizione',
        'title' => __('Descrizione', 'design_comuni_italia'),
        'object_types' => array('documento_privato'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'descrizione_estesa',
        'name'        => __( 'Descrizione estesa', 'design_comuni_italia' ),
        'desc' => __( 'L\'oggetto del documento, utilizzando un linguaggio semplice che possa aiutare qualsiasi utente a identificare con chiarazza il documento. Non utilizzare un linguaggio ricco di riferimenti normativi' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ));

    $cmb_descrizione->add_field(array(
        'id' => $prefix . 'gallery',
        'name' => __('Galleria', 'design_comuni_italia'),
        'desc' => __('Galleria di immagini  significative relative a un documento, corredate da didascalia', 'design_comuni_italia'),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array('type' => 'image'), // Only images attachment
    ));

    $cmb_descrizione->add_field(array(
        'id' => $prefix . 'ufficio_responsabile',
        'name' => __('Ufficio responsabile del documento *', 'design_comuni_italia'),
        'desc' => __('Link alla scheda dell\'ufficio responsabile del documento', 'design_comuni_italia'),
        'type' => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes' => array(
            'required' => 'required',
            'placeholder' =>  __( 'Seleziona le Unità Organizzative', 'design_comuni_italia' ),
        )
    ));

    $cmb_descrizione->add_field(array(
        'id' => $prefix . 'autori',
        'name' => __('Autore/i', 'design_comuni_italia'),
        'desc' => __('Persone che hanno redatto il documento', 'design_comuni_italia'),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ));

    $cmb_descrizione->add_field(array(
        'id' => $prefix . 'formati',
        'name' => __('Formati disponibili *', 'design_comuni_italia'),
        'desc' => __('Lista dei formati in cui è disponibile il documento', 'design_comuni_italia'),
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

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'licenza',
        'name'    => __( 'Licenza di distribuzione *', 'design_comuni_italia' ),
        'desc' => __( 'Licenza con il quale il documento viene distribuito', 'design_comuni_italia' ),
        'type'             => 'taxonomy_radio_hierarchical',
        'taxonomy'       => 'licenze',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    //SERVIZIO/pratica
    $cmb_pratica_servizio = new_cmb2_box(array(
        'id' => $prefix . 'box_pratica_servizio',
        'title' => __('Pratiche/ Servizi', 'design_comuni_italia'),
        'object_types' => array('documento_privato'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_pratica_servizio->add_field( array(
        'id' => $prefix . 'pratica_associata',
        'name'    => __( 'Pratica associata', 'design_comuni_italia' ),
        'desc' => __( 'Eventuale pratica associata al documento' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('pratica'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona la Pratica', 'design_comuni_italia' ),
        )
    ) );

    $cmb_pratica_servizio->add_field( array(
        'id' => $prefix . 'servizio_collegato',
        'name'    => __( 'Servizio collegato', 'design_comuni_italia' ),
        'desc' => __( 'Se il documento non è collegato a una pratica è possibile indicare il servizio che ha generato il documento' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('servizio'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona il Servizio', 'design_comuni_italia' ),
        )
    ) );


    //ULTERIORI INFORMAZIONI
    $cmb_informazioni = new_cmb2_box(array(
        'id' => $prefix . 'box_informazioni',
        'title' => __('Ulteriori informazioni', 'design_comuni_italia'),
        'object_types' => array('documento_privato'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_informazioni->add_field(array(
        'id' => $prefix . 'ulteriori_informazioni',
        'name' => __('Ulteriori informazioni', 'design_comuni_italia'),
        'desc' => __('Ulteriori informazioni sul documento', 'design_comuni_italia'),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ));

    $cmb_informazioni->add_field(array(
        'id' => $prefix . 'riferimenti_normativi',
        'name' => __('Riferimenti normativi', 'design_comuni_italia'),
        'desc' => __('Lista di link con riferimenti normativi utili per il documento', 'design_comuni_italia'),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ));

    $cmb_informazioni->add_field(array(
        'id' => $prefix . 'documenti_collegati',
        'name' => __('Documenti collegati', 'design_comuni_italia'),
        'desc' => __('Lista di documenti allegati: link a quelli strutturati a loro volta come documenti', 'design_comuni_italia'),
        'type' => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona i Documenti Pubblici', 'design_comuni_italia' ),
        )
    ));

    $cmb_events = new_cmb2_box( array(
        'id'           => $prefix . 'box_events',
        'title'        => __( 'Events collegati', 'design_comuni_italia' ),
        'object_types' => array( 'documento_privato' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );

    $cmb_events->add_field( array(
        'id' => $prefix . 'life_events',
        'name'    => __( 'Life Events', 'design_comuni_italia' ),
        'type'             => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'eventi_vita_persone',
        'show_option_none' => false,
        'remove_default' => 'true',
    ) );

    $cmb_events->add_field( array(
        'id' => $prefix . 'business_events',
        'name'    => __( 'Business Events', 'design_comuni_italia' ),
        'type'             => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'eventi_vita_impresa',
        'show_option_none' => false,
        'remove_default' => 'true',
    ) );
}

/**
 * aggiungo js per controllo compilazione campi
 */
add_action( 'admin_print_scripts-post-new.php', 'dci_documento_privato_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_documento_privato_admin_script', 11 );

function dci_documento_privato_admin_script() {
    global $post_type;
    if( 'documento_privato' == $post_type )
        wp_enqueue_script( 'luogo-admin-script', get_template_directory_uri() . '/inc/admin-js/documento_privato.js' );
}






