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
        'edit_item'      => _x( 'Dettagli richiesta Appuntamento', 'Post Type Singular Name', 'design_comuni_italia' ),
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
        'capabilities' => array(
            'create_posts' => 'do_not_allow'
        ),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura delle informazioni relative utili a presentare un appuntamento", 'design_comuni_italia' ),

    );
    register_post_type( 'appuntamento', $args );

    remove_post_type_support( 'appuntamento', 'title');
    remove_post_type_support( 'appuntamento', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_appuntamento_add_content_after_title' );
function dci_appuntamento_add_content_after_title($post) {
    if($post->post_type == "appuntamento") {
        if (isset($_GET['post']))
            $curr_post_id = $_GET['post'];
        else if (isset($_POST['post_ID']))
            $curr_post_id = $_POST['post_ID'];

        if (isset($curr_post_id)) {
            $post_title = get_the_title($curr_post_id);
            _e('Richiesta di appuntamento: <h1>' . $post_title . '</h1>', 'design_comuni_italia');
        }

        //_e('<span><i>il <b>Titolo</b> è il <b>Titolo della richiesta</b></i></span><br><br><br> ', 'design_comuni_italia');
    }
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
        'id' => $prefix . 'email_richiedente',
        'desc' => __( 'Email del richiedente' , 'design_comuni_italia' ),
        'name'  => __( 'Email Richiedente *', 'design_comuni_italia' ),
        'type' => 'text_email',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
        ),
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'dettaglio_richiesta',
        'desc' => __( 'Testo della richiesta' , 'design_comuni_italia' ),
        'name'  => __( 'Dettaglio richiesta *', 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
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
        'date_format' => 'd-m-Y',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
        ),
    ) );

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_ora_inizio_appuntamento',
        'name'    => __( 'Data e ora inizio appuntamento *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
        ),
    ) );

    $cmb_date->add_field( array(
        'id' => $prefix . 'data_ora_fine_appuntamento',
        'name'    => __( 'Data e ora della fine dell\'appuntamento *', 'design_comuni_italia' ),
        'type'    => 'text_datetime_timestamp',
        'date_format' => 'd-m-Y',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
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
        'type'    => 'text',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
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
        'type'    => 'text',
        'attributes'    => array(
            'required'    => 'required',
            'readonly' => true
        ),
    ) );

}

/**
 * Aggiungo colonne custom
 * @param $columns
 * @return mixed
 */
function dci_filter_appuntamento_columns( $columns ) {

    $columns['email_richiedente'] = __( 'Email Richiedente','design_comuni_italia' );
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

    if ( 'email_richiedente' === $column ) {
        echo get_post_meta($post_id, '_dci_appuntamento_email_richiedente', true );
    }

    if ( 'servizio' === $column ) {
        echo get_post_meta($post_id, '_dci_appuntamento_servizio', true );
    }

    if ( 'ufficio' === $column ) {
        echo get_post_meta($post_id, '_dci_appuntamento_unita_organizzativa', true );
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
        'email_richiedente'=>$columns['email_richiedente'],
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
 * Rendo le colonne filtrabili
 * @param $columns
 * @return mixed
 */
function dci_appuntamento_sortable_columns( $columns ) {

    $columns['email_richiedente'] = 'appuntamento_email_richiedente';
    $columns['servizio'] = 'appuntamento_servizio';
    $columns['ufficio'] = 'appuntamento_ufficio';

    return $columns;
}
add_filter( 'manage_edit-appuntamento_sortable_columns', 'dci_appuntamento_sortable_columns');

/**
 * Filtro le colonne
 * @param $query
 */
function dci_appuntamento_posts_orderby( $query ) {
    if( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( 'appuntamento_email_richiedente' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_appuntamento_email_richiedente' );
    }

    if ( 'appuntamento_servizio' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_appuntamento_servizio' );
    }

    if ( 'appuntamento_ufficio' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_appuntamento_unita_organizzativa' );
    }


}
add_action( 'pre_get_posts', 'dci_appuntamento_posts_orderby' );

/**
 * disabilito quick edit del titolo per gli Appuntamenti
 * @param $actions
 * @param $post
 * @return mixed
 */
function dci_appuntamento_row_actions( $actions, $post ) {

    //se la pagina ha slug tra le pagine create all'attivazione del tema
    if ( 'appuntamento' === $post->post_type ) {

        // Removes the "Quick Edit" action.
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'post_row_actions', 'dci_appuntamento_row_actions', 10, 2 );

/**
 * rimuovo voce menu aggiungi Appuntamento
 */
function dci_appuntamento_remove_add_new_menu() {

        remove_submenu_page('edit.php?post_type=appuntamento','post-new.php?post_type=appuntamento');

}
add_action('admin_menu','dci_appuntamento_remove_add_new_menu');


/**
 * rimuovo meta box Update, Publish
 * @param $post_type
 * @param $position
 * @param $post
 */
function dci_appuntamento_remove_publish_mbox( $post_type, $position, $post )
{
    remove_meta_box( 'submitdiv', 'appuntamento', 'side' );
}
add_action( 'do_meta_boxes', 'dci_appuntamento_remove_publish_mbox', 10, 3 );
