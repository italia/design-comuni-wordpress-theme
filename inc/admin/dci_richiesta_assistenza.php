<?php

/**
 * Definisce post type Richiesta Assistenza (per memorizzare le richieste di assistenza da parte degli utenti)
 */
add_action( 'init', 'dci_register_post_type_richiesta_assistenza', 100 );
function dci_register_post_type_richiesta_assistenza() {

    $labels = array(
        'name'                  => _x( 'Tickets', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Ticket', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Ticket', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un nuovo Ticket', 'Post Type Singular Name', 'design_comuni_italia' ),
        //'featured_image' => __( 'Logo Identificativo del Rating', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Dettagli Ticket', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Ticket', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Richiesta Assistenza' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Richiesta Assistenza' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Richiesta Assistenza' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Rating', 'design_comuni_italia' ),
        'labels'                => $labels,
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-media-spreadsheet',
        'has_archive'           => false,
        'capability_type' => array('richiesta_assistenza', 'richieste_assistenza'),
        'capabilities' => array(
            'create_posts' => 'do_not_allow'
        ),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura dei resoconti delle richieste di assistenza degli utenti", 'design_comuni_italia' ),
    );
    register_post_type( 'richiesta_assistenza', $args );
    remove_post_type_support( 'richiesta_assistenza', 'title');
    remove_post_type_support( 'richiesta_assistenza', 'editor');

}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_richiesta_assistenza_add_content_after_title' );
function dci_richiesta_assistenza_add_content_after_title($post) {

    if($post->post_type == "richiesta_assistenza") {
        if (isset($_GET['post']))
            $curr_post_id = $_GET['post'];
        else if (isset($_POST['post_ID']))
            $curr_post_id = $_POST['post_ID'];

        if (isset($curr_post_id)) {
            $post_title = get_the_title($curr_post_id);
            _e('<h1>' . $post_title . '</h1>', 'design_comuni_italia');
        }

        //_e('<span><i>il <b>Titolo</b> è il <b>Titolo della Richiesta Assistenza</b></i></span><br><br><br> ', 'design_comuni_italia' );
    }
}

/**
 * Crea i metabox del post type Richiesta Assistenza
 */
add_action( 'cmb2_init', 'dci_add_richiesta_assistenza_metaboxes' );
function dci_add_richiesta_assistenza_metaboxes()
{
    $prefix = '_dci_richiesta_assistenza_';

    $cmb_richiedente = new_cmb2_box(array(
        'id' => $prefix . 'box_richiedente',
        'title' => __('Richiedente'),
        'object_types' => array('richiesta_assistenza'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_richiedente->add_field( array(
        'id' => $prefix . 'nome',
        'name'  => __( 'Nome', 'design_comuni_italia' ),
        'desc'  => __( 'Nome del Richiedente', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_richiedente->add_field( array(
        'id' => $prefix . 'cognome',
        'name'  => __( 'Cognome', 'design_comuni_italia' ),
        'desc'  => __( 'Cognome del Richiedente', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_richiedente->add_field( array(
        'id' => $prefix . 'email',
        'name'  => __( 'Email', 'design_comuni_italia' ),
        'desc'  => __( 'Email del Richiedente', 'design_comuni_italia' ),
        'type' => 'text_email',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_richiesta = new_cmb2_box(array(
        'id' => $prefix . 'box_richiesta',
        'title' => __('Richiesta'),
        'object_types' => array('richiesta_assistenza'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_richiesta->add_field( array(
        'id' => $prefix . 'categoria_servizio',
        'name'  => __( 'Categoria', 'design_comuni_italia' ),
        'desc'  => __( 'Categoria del Servizio per il quale viene richiesta assistenza', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_richiesta->add_field( array(
        'id' => $prefix . 'servizio',
        'name'  => __( 'Servizio', 'design_comuni_italia' ),
        'desc'  => __( 'Servizio per il quale viene richiesta assistenza', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_richiesta->add_field( array(
        'id' => $prefix . 'dettagli',
        'name'  => __( 'Dettagli', 'design_comuni_italia' ),
        'desc'  => __( 'Dettagli richiesta di assistenza', 'design_comuni_italia' ),
        'type' => 'textarea',
        'attributes' => array(
            'readonly' => true
        )
    ) );

}


/**
 * Aggiungo colonne custom
 * @param $columns
 * @return mixed
 */
function dci_filter_richiesta_assistenza_columns( $columns ) {

    $columns['richiedente'] = __( 'Richiedente','design_comuni_italia' );
    $columns['email'] = __( 'Email','design_comuni_italia' );
    $columns['categoria_servizio'] = __( 'Categoria','design_comuni_italia' );
    $columns['servizio'] = __( 'Servizio','design_comuni_italia' );
    $columns['dettagli'] = __( 'Dettagli','design_comuni_italia' );

    return $columns;
}
add_filter( 'manage_richiesta_assistenza_posts_columns', 'dci_filter_richiesta_assistenza_columns' );

/**
 * Valorizzo le colonne custom
 * @param $column
 * @param $post_id
 */
function dci_manage_richiesta_assistenza_posts_custom_column( $column, $post_id ) {

    if ( 'richiedente' === $column ) {
       $nome = get_post_meta($post_id, '_dci_richiesta_assistenza_nome', true );
       $cognome =  get_post_meta($post_id, '_dci_richiesta_assistenza_cognome', true );
       echo  $cognome.' '.$nome;
    }

    if ( 'email' === $column ) {
        echo  get_post_meta($post_id, '_dci_richiesta_assistenza_email', true );
    }

    if ( 'categoria_servizio' === $column ) {
        echo  get_post_meta($post_id, '_dci_richiesta_assistenza_categoria_servizio', true );
    }

    if ( 'servizio' === $column ) {
        echo  get_post_meta($post_id, '_dci_richiesta_assistenza_servizio', true );
    }

    if ( 'dettagli' === $column ) {
        echo  get_post_meta($post_id, '_dci_richiesta_assistenza_dettagli', true );
    }

}
add_action( 'manage_richiesta_assistenza_posts_custom_column', 'dci_manage_richiesta_assistenza_posts_custom_column', 10, 2);

/**
 * Ordino le colonne
 * @param $columns
 * @return array
 */
function dci_save_richiesta_assistenza_columns( $columns ) {

    $columns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'richiedente' =>  $columns['richiedente'],
        'email' =>  $columns['email'],
        'categoria_servizio' =>  $columns['categoria_servizio'],
        'servizio' => $columns['servizio'],
        'dettagli' =>  $columns['dettagli'],
        'date' => $columns['date'],
    );

    return $columns;
}
add_filter( 'manage_richiesta_assistenza_posts_columns', 'dci_save_richiesta_assistenza_columns' );

/**
 * Rendo le colonne filtrabili
 * @param $columns
 * @return mixed
 */
function dci_richiesta_assistenza_sortable_columns( $columns ) {

    $columns['richiedente'] = 'richiesta_assistenza_richiedente';
    $columns['email'] = 'richiesta_assistenza_email';
    $columns['categoria_servizio'] = 'richiesta_assistenza_categoria_servizio';
    $columns['servizio'] = 'richiesta_assistenza_servizio';

    return $columns;
}
add_filter( 'manage_edit-richiesta_assistenza_sortable_columns', 'dci_richiesta_assistenza_sortable_columns');

/**
 * Filtro le colonne
 * @param $query
 */
function dci_richiesta_assistenza_posts_orderby( $query ) {
    if( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( 'richiesta_assistenza_richiedente' === $query->get( 'orderby') ) {

        $order = ($query->query['order'] == 'asc')? 'ASC' : 'DESC';

        $meta_query = array(
            'relation' => 'AND',
            'query_one' => array(
                'key' => '_dci_richiesta_assistenza_cognome'
            ),
            'query_two' => array(
                'key' => '_dci_richiesta_assistenza_nome',
            ),
        );

        $order_by = array(
            'query_one' => $order,
            'query_two' => $order,
        );

        $query->set( 'meta_query', $meta_query );
        $query->set( 'orderby', $order_by);
    }

    if ( 'richiesta_assistenza_email' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_richiesta_assistenza_email' );
    }

    if ( 'richiesta_assistenza_categoria_servizio' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_richiesta_assistenza_categoria_servizio' );
    }

    if ( 'richiesta_assistenza_servizio' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_richiesta_assistenza_servizio' );
    }
}
add_action( 'pre_get_posts', 'dci_richiesta_assistenza_posts_orderby' );

/**
 * disabilito quick edit del titolo per le Richieste di Assistenza
 * @param $actions
 * @param $post
 * @return mixed
 */
function dci_richiesta_assistenza_row_actions( $actions, $post ) {

    if ( 'richiesta_assistenza' === $post->post_type ) {

        // Removes the "Quick Edit" action.
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'post_row_actions', 'dci_richiesta_assistenza_row_actions', 10, 2 );

/**
 * rimuovo voce menu aggiungi Richiesta Assistenza
 */
function dci_richiesta_assistenza_remove_add_new_menu() {

    remove_submenu_page('edit.php?post_type=richiesta_assistenza','post-new.php?post_type=richiesta_assistenza');

}
add_action('admin_menu','dci_richiesta_assistenza_remove_add_new_menu');

/**
 * rimuovo meta box Update, Publish
 * @param $post_type
 * @param $position
 * @param $post
 */
function dci_richiesta_assistenza_remove_publish_mbox( $post_type, $position, $post )
{
    remove_meta_box( 'submitdiv', 'richiesta_assistenza', 'side' );
}
add_action( 'do_meta_boxes', 'dci_richiesta_assistenza_remove_publish_mbox', 10, 3 );

