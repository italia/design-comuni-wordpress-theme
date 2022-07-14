<?php

/**
 * Definisce post type Domanda Frequente
 */
add_action( 'init', 'dci_register_post_type_domanda_frequente', 60 );
function dci_register_post_type_domanda_frequente() {

    $labels = array(
        'name'                  => _x( 'Domande frequenti', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Domanda Frequente', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi una Domanda Frequente', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi una Domanda Frequente', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo della Domanda Frequente', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica la Domanda Frequente', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza la Domanda Frequente', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Domanda Frequente' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Domanda Frequente' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Domanda Frequente' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Domanda Frequente', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-editor-ul',
        'has_archive'           => false,
        'capability_type' => array('domanda_frequente', 'domande_frequenti'),
        'map_meta_cap'    => true,
        'description'    => __( "Elenco di risposte alle domande più frequenti raccolte dalle richieste di assistenza dei cittadini.", 'design_comuni_italia' ),
        'rewrite' => array('slug' => 'domande-frequenti'),
    );
    register_post_type( 'domanda_frequente', $args );

    remove_post_type_support( 'domanda_frequente', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_domanda_frequente_add_content_after_title' );
function dci_domanda_frequente_add_content_after_title($post) {
    if($post->post_type == "domanda_frequente")
        _e('<span><i>il <b>Titolo</b> è la <b>Domanda Frequente *</b></i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Domanda Frequente
 */
add_action( 'cmb2_init', 'dci_add_domanda_frequente_metaboxes' );
function dci_add_domanda_frequente_metaboxes() {
    $prefix = '_dci_domanda_frequente_';

    $cmb_risposta = new_cmb2_box( array(
        'id'           => $prefix . 'box_risposta',
        'title'        => __( 'Risposta *' ),
        'object_types' => array( 'domanda_frequente' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_risposta->add_field( array(
        'desc'       => __('Inserisci qui la risposta alla domanda.', 'design_comuni_italia' ),
        'id'         => $prefix . 'risposta',
        'type'       => 'textarea',
        'attributes'    => array(
            'required'    => 'required',
        ),
    ) );

}

/**
 * Valorizzo il post content in base al campo risposta, necessario per la ricerca del contenuto
 * @param $data
 * @return mixed
 */
function dci_domanda_frequente_set_post_content( $data ) {

    if($data['post_type'] == 'domanda_frequente' && isset($_POST['_dci_domanda_frequente_risposta'])) {
        $risposta = $_POST['_dci_domanda_frequente_risposta'];
        $data['post_content'] =  $risposta;
    }

    return $data;
}
add_filter( 'wp_insert_post_data' , 'dci_domanda_frequente_set_post_content' , '99', 1 );
