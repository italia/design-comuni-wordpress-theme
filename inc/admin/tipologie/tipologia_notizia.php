<?php

/**
 * Definisce post type Notizia
 */
add_action( 'init', 'dci_register_post_type_notizia');
function dci_register_post_type_notizia() {

    $labels = array(
        'name'          => _x( 'Notizie', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name' => _x( 'Notizia', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'       => _x( 'Aggiungi una Notizia', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'  => _x( 'Aggiungi una nuova Notizia', 'Post Type Singular Name', 'design_comuni_italia' ),
        'edit_item'       => _x( 'Modifica la Notizia', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Immagine di riferimento', 'design_comuni_italia' ),
    );
    $args   = array(
        'label'         => __( 'Notizia', 'design_comuni_italia' ),
        'labels'        => $labels,
        'supports'      => array( 'title', 'editor', 'author', 'thumbnail'),
        'hierarchical'  => false,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-media-interactive',
        'has_archive'   => false,
        //'rewrite' => array('slug' => 'novita/%tipi_notizia%','with_front' => false),
        'rewrite' => array('slug' => 'novita','with_front' => false),
        'capability_type' => array('notizia', 'notizie'),
        'map_meta_cap'    => true,
        'description'    => __( "Tipologia che struttura le informazioni relative a agli aggiornamenti d un comune", 'design_comuni_italia' ),
    );
    register_post_type('notizia', $args );

    remove_post_type_support( 'notizia', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_notizia_add_content_after_title' );
function dci_notizia_add_content_after_title($post) {
    if($post->post_type == "notizia")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della News o del Comunicato</b>.</i></span><br><br>', 'design_comuni_italia' );
}

add_action( 'cmb2_init', 'dci_add_notizia_metaboxes' );
function dci_add_notizia_metaboxes() {
    $prefix = '_dci_notizia_';

    //argomenti
    $cmb_argomenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_argomenti',
        'title'        => __( 'Argomenti *', 'design_comuni_italia' ),
        'object_types' => array( 'notizia' ),
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

    //APERTURA
    $cmb_apertura = new_cmb2_box( array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'notizia' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'tipo_notizia',
        'name'        => __( 'Tipo di notizia *', 'design_comuni_italia' ),
        'type'             => 'taxonomy_radio_hierarchical',
        'taxonomy'       => 'tipi_notizia',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'numero_comunicato',
        'name'        => __( 'Numero progressivo comunicato stampa', 'design_comuni_italia' ),
        'desc' => __( 'Se è un comunicato stampa, indica un\'eventuale numero progressivo del comunicato stampa' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '255',
            'data-conditional-id'     => $prefix.'tipo_notizia',
            'data-conditional-value'  => 'comunicato-stampa',
        ),
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'a_cura_di',
        'name'    => __( 'A cura di *', 'design_comuni_italia' ),
        'desc' => __( 'Ufficio che ha curato il comunicato (presumibilmente l\'ufficio comunicazione)' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes'    => array(
            'required'    => 'required',
            'placeholder' =>  __( 'Seleziona le unità organizzative', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_apertura->add_field( array(
        'name'       => __('Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine principale della notizia' , 'design_comuni_italia' ),
        'id'             => $prefix . 'immagine',
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ),
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'descrizione_breve',
        'name'        => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione sintentica della notizia, inferiore a 255 caratteri' , 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes'    => array(
            'maxlength'  => '255',
            'required'    => 'required'
        ),
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'data_pubblicazione',
        'name'    => __( 'Data della notizia', 'design_comuni_italia' ),
        'desc' => __( 'Data di pubblicazione della notizia. Se non compilato a front end viene mostrata la data di pubblicazione del post.' , 'design_comuni_italia' ),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'data_scadenza',
        'name'    => __( 'Data di scadenza', 'design_comuni_italia' ),
        'desc' => __( 'Data di pubblicazione della notizia. Eventuale data di scadenza (in caso di avviso pubblicato)' , 'design_comuni_italia' ),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
    ) );

    $cmb_apertura->add_field( array(
        'id' => $prefix . 'persone',
        'name'    => __( 'Persone', 'design_comuni_italia' ),
        'desc' => __( 'Riferimenti a persone dell\'amministrazione citate nella notizia' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('persona_pubblica'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona le Persone Pubbliche', 'design_comuni_italia' ),
        ),
    ) );
    $cmb_apertura->add_field( array(
        'id' => $prefix . 'luoghi',
        'name'    => __( 'Luoghi', 'design_comuni_italia' ),
        'desc' => __( 'Riferimenti a luoghi del Comune citati nella notizia' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('luogo'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona i Luoghi', 'design_comuni_italia' ),
        ),
    ) );

    //CORPO
    $cmb_corpo = new_cmb2_box( array(
        'id'           => $prefix . 'box_corpo',
        'title'        => __( 'Corpo', 'design_comuni_italia' ),
        'object_types' => array( 'notizia' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
    $cmb_corpo->add_field( array(
        'id' => $prefix . 'testo_completo',
        'name'        => __( 'Testo completo della notizia *', 'design_comuni_italia' ),
        'desc' => __( 'Testo principale della notizia' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'attributes'    => array(
            'required'    => 'required'
        ),
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );
    $cmb_corpo->add_field( array(
        'id'         => $prefix . 'multimedia',
        'name'       => __( 'Multimedia', 'design_comuni_italia' ),
        'desc'       => __( 'Possibilità di includere nel corpo della notizia una galleria di immagini e/o una serie di video e/o audio riferite alla news.', 'design_comuni_italia' ),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
    ) );

    /**
    $cmb_gallerie_multimediali = new_cmb2_box( array(
        'id'           => $prefix . 'box_gallerie_multimediali',
        'title'        => __( 'Gallerie multimediali', 'design_comuni_italia' ),
        'object_types' => array( 'notizia' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    // repeater Gallerie Multimediali
    $group_field_id = $cmb_gallerie_multimediali->add_field( array(
        'id'          => $prefix . 'gallerie_multimediali',
        'type'        => 'group',
        'description' => __( 'E\' possibile inserire più gallerie multimediali' , 'design_comuni_italia' ),
        'options'     => array(
            'group_title'    => __( 'Galleria {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi una gallery', 'design_comuni_italia' ),
            'remove_button'  => __( 'Rimuovi la gallery', 'design_comuni_italia' ),
            'sortable'       => true,
        ),
    ) );

    $cmb_gallerie_multimediali->add_group_field( $group_field_id, array(
        'name'       => __('Titolo gallery', 'design_comuni_italia' ),
        'id'         => 'titolo_gallery',
        'type'       => 'text',
    ) );

    $cmb_gallerie_multimediali->add_group_field( $group_field_id, array(
        'name'       => __('Media', 'design_comuni_italia' ),
        'desc'       => __('contenuti della gallery (immagini o video)', 'design_comuni_italia' ),
        'id'         => 'data_fase',
        'type'       => 'file_list',
        'query_args' => array( 'type' => array('image','video') )
    ) );
    /*** fine repeater gallerie **/

    //DOCUMENTI
    $cmb_documenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'notizia' ),
        'context'      => 'normal',
        'priority'     => 'low',
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'documenti',
        'name'        => __( 'Documenti', 'design_comuni_italia' ),
        'desc' => __( 'Link a schede di Documenti' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona i Documenti Pubblici', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'allegati',
        'name'        => __( 'Allegati', 'design_comuni_italia' ),
        'desc' => __( 'Elenco di documenti allegati alla struttura' , 'design_comuni_italia' ),
        'type' => 'file_list',
    ) );

    //DATASET
    $cmb_documenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'notizia' ),
        'context'      => 'normal',
        'priority'     => 'low',
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'dataset',
        'name'        => __( 'Dataset ', 'design_comuni_italia' ),
        'desc' => __( 'Lista schede Dataset collegate alla notizia' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('dataset'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona i Dataset', 'design_comuni_italia' ),
        ),
    ) );

}


/**
 * aggiungo js per controllo compilazione campi
 */

add_action( 'admin_print_scripts-post-new.php', 'dci_notizia_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_notizia_admin_script', 11 );

function dci_notizia_admin_script() {
    global $post_type;
    if( 'notizia' == $post_type )
        wp_enqueue_script( 'notizia-admin-script', get_template_directory_uri() . '/inc/admin-js/notizia.js' );
}

/**
 * Valorizzo il post content in base al contenuto dei campi custom
 * @param $data
 * @return mixed
 */
function dci_notizia_set_post_content( $data ) {

    if($data['post_type'] == 'notizia') {

        $descrizione_breve = '';
        if (isset($_POST['_dci_notizia_descrizione_breve'])) {
            $descrizione_breve = $_POST['_dci_notizia_descrizione_breve'];
        }

        $testo_completo = '';
        if (isset($_POST['_dci_notizia_testo_completo'])) {
            $testo_completo = $_POST['_dci_notizia_testo_completo'];
        }

        $content = $descrizione_breve.'<br>'.$testo_completo;

        $data['post_content'] = $content;
    }

    return $data;
}
add_filter( 'wp_insert_post_data' , 'dci_notizia_set_post_content' , '99', 1 );
