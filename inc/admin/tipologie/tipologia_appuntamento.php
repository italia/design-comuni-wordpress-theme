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
        'supports'              => array( 'title', 'editor' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'has_archive'           => false,
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
        'options' => dci_get_posts_options('servizio'),
        'attributes'    => array(
            'required'    => 'required',
            'placeholder' =>  __( ' Seleziona il servizio', 'design_comuni_italia' ),
        ),
    ) );

    /**
     * metabox Unità organizzativa
     */
    $cmb_unita_organizzativa = new_cmb2_box(array(
        'id' => $prefix . 'box_unita_organizzativa',
        'title' => __('Unità organizzativa *'),
        'object_types' => array('appuntamento'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_unita_organizzativa->add_field( array(
        'id' => $prefix . 'unita_organizzativa',
        'desc' => __( 'Se l\'appuntamento non è su un servizio ma con un\'Unità organizzativa' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes'    => array(
            'required'    => 'required',
            'placeholder' =>  __( ' Seleziona unità organizzativa', 'design_comuni_italia' ),
        ),
    ) );

}

/**
 * Aggiungo colonne custom
 * @param $columns
 * @return mixed
 */
function dci_filter_appuntamento_columns( $columns ) {

    $columns['servizio'] = __( 'Servizio','design_comuni_italia' );
    $columns['ufficio'] = __( 'Ufficio','design_comuni_italia' );
    $columns['data_ora_inizio'] = __( 'Data e ora inizio','design_comuni_italia' );
    $columns['data_ora_fine'] = __( 'Data e ora fine','design_comuni_italia' );

    return $columns;
}
add_filter( 'manage_appuntamento_posts_columns', 'dci_filter_appuntamento_columns' );

/**
 * Valorizzo le colonne custom
 * @param $column
 * @param $post_id
 */
function dci_manage_appuntamento_posts_custom_column( $column, $post_id ) {

    if ( 'servizio' === $column ) {
        $service_id  =  get_post_meta($post_id, '_dci_appuntamento_servizio', true );
        if( get_post_type($service_id) == 'servizio')
            echo  get_the_title($service_id);
    }

    if ( 'ufficio' === $column ) {
        $office_id = get_post_meta($post_id, '_dci_appuntamento_unita_organizzativa', true );
        if( get_post_type($office_id) == 'unita_organizzativa')
            echo  get_the_title($office_id);
    }

    if ( 'data_ora_inizio' === $column ) {
        $data_ora_inizio = get_post_meta($post_id, '_dci_appuntamento_data_ora_inizio_appuntamento', true );
        if (is_numeric($data_ora_inizio)){
            echo date('Y-m-d\TH:i', $data_ora_inizio);
        } else {
            echo  $data_ora_inizio;
        }
    }

    if ( 'data_ora_fine' === $column ) {
        $data_ora_fine =  get_post_meta($post_id, '_dci_appuntamento_data_ora_fine_appuntamento', true );
        if (is_numeric($data_ora_fine)){
            echo date('Y-m-d\TH:i', $data_ora_fine);;
        } else {
            echo  $data_ora_fine;
        }
    }

}
add_action( 'manage_appuntamento_posts_custom_column', 'dci_manage_appuntamento_posts_custom_column', 10, 2);

/**
 * Ordino le colonne
 * @param $columns
 * @return array
 */
function dci_save_appuntamento_columns( $columns ) {

    $columns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'servizio' => $columns['servizio'],
        'ufficio' => $columns['ufficio'],
        'data_ora_inizio' => $columns['data_ora_inizio'],
        'data_ora_fine' => $columns['data_ora_fine'],
        'date' => $columns['date'],
    );

    return $columns;
}
add_filter( 'manage_appuntamento_posts_columns', 'dci_save_appuntamento_columns' );


/**
 * aggiungo js per controllo compilazione campi
 */
add_action( 'admin_print_scripts-post-new.php', 'dci_appuntamento_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_appuntamento_admin_script', 11 );

function dci_appuntamento_admin_script() {
    global $post_type;
    if( 'appuntamento' == $post_type )
        wp_enqueue_script( 'appuntamento-admin-script', get_stylesheet_directory_uri() . '/inc/admin-js/appuntamento.js' );
}

