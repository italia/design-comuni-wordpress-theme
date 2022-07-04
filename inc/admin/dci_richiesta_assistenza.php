<?php
/**
 * Definisce post type Richiesta Assistenza (per memorizzare le richieste di assistenza da parte degli utenti)
 */
add_action( 'init', 'dci_register_post_type_richiesta_assistenza', 100 );
function dci_register_post_type_richiesta_assistenza() {

    $labels = array(
        'name'                  => _x( 'Richieste Assistenza', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Richiesta Assistenza', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi una Richiesta Assistenza', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi una Richiesta Assistenza', 'Post Type Singular Name', 'design_comuni_italia' ),
        //'featured_image' => __( 'Logo Identificativo del Rating', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica la Richiesta Assistenza', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza la Richiesta Assistenza', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Richiesta Assistenza' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Richiesta Assistenza' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Richiesta Assistenza' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Rating', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-media-spreadsheet',
        'has_archive'           => false,
        'capability_type' => array('richiesta_assistenza', 'richieste_assistenza'),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura dei resoconti delle richieste di assistenza degli utenti", 'design_comuni_italia' ),
    );
    register_post_type( 'richiesta_assistenza', $args );
    remove_post_type_support( 'richiesta_assistenza', 'editor');

}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_richiesta_assistenza_add_content_after_title' );
function dci_richiesta_assistenza_add_content_after_title($post) {
    if($post->post_type == "rating")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo della Richiesta Assistenza</b></i></span><br><br><br> ', 'design_comuni_italia' );
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
    ) );

    $cmb_richiedente->add_field( array(
        'id' => $prefix . 'cognome',
        'name'  => __( 'Cognome', 'design_comuni_italia' ),
        'desc'  => __( 'Cognome del Richiedente', 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $cmb_richiedente->add_field( array(
        'id' => $prefix . 'email',
        'name'  => __( 'Email', 'design_comuni_italia' ),
        'desc'  => __( 'Email del Richiedente', 'design_comuni_italia' ),
        'type' => 'text_email',
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
    ) );

    $cmb_richiesta->add_field( array(
        'id' => $prefix . 'servizio',
        'name'  => __( 'Servizio', 'design_comuni_italia' ),
        'desc'  => __( 'Servizio per il quale viene richiesta assistenza', 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $cmb_richiesta->add_field( array(
        'id' => $prefix . 'dettagli',
        'name'  => __( 'Dettagli', 'design_comuni_italia' ),
        'desc'  => __( 'Dettagli richiesta di assistenza', 'design_comuni_italia' ),
        'type' => 'textarea',
    ) );

}


add_filter( 'manage_richiesta_assistenza_posts_columns', 'dci_filter_richiesta_assistenza_columns' );
function dci_filter_richiesta_assistenza_columns( $columns ) {

    $columns['richiedente'] = __( 'Richiedente','design_comuni_italia' );
    $columns['email'] = __( 'Email','design_comuni_italia' );
    $columns['categoria_servizio'] = __( 'Categoria','design_comuni_italia' );
    $columns['servizio'] = __( 'Servizio','design_comuni_italia' );
    $columns['dettagli'] = __( 'Dettagli','design_comuni_italia' );

    return $columns;
}

add_action( 'manage_richiesta_assistenza_posts_custom_column', 'dci_manage_richiesta_assistenza_posts_custom_column', 10, 2);
function dci_manage_richiesta_assistenza_posts_custom_column( $column, $post_id ) {
    console_log(get_post_meta($post_id, '_dci_richiesta_assistenza_nome', true ));

    if ( 'richiedente' === $column ) {
       $nome = get_post_meta($post_id, '_dci_richiesta_assistenza_nome', true );
       $cognome =  get_post_meta($post_id, '_dci_richiesta_assistenza_cognome', true );
       echo  $nome.' '.$cognome;
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
