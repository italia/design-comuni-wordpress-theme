<?php

/**
 * Definisce post type Rating (per memorizzare le valutazioni delle pagine del Sito dei Comuni)
 */
add_action( 'init', 'dci_register_post_type_rating', 100 );
function dci_register_post_type_rating() {

    $labels = array(
        'name'                  => _x( 'Valutazioni', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi una Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi una Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        //'featured_image' => __( 'Logo Identificativo del Rating', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Dettagli Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza la Valutazione', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Valutazione' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Valutazione' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Valutazione' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Rating', 'design_comuni_italia' ),
        'labels'                => $labels,
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-star-half',
        'has_archive'           => false,
        'capability_type' => array('rating', 'ratings'),
        'capabilities' => array(
            'create_posts' => 'do_not_allow'
        ),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura dei resoconti delle valutazioni degli utenti", 'design_comuni_italia' ),
    );
    register_post_type( 'rating', $args );
    remove_post_type_support( 'rating', 'editor');
    remove_post_type_support( 'rating', 'title' );


    $labels = array(
        'name'              => _x( 'Stars', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Stars', 'taxonomy singular name', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'capabilities'      => array(
            'manage_terms'  => 'manage_stars',
            'edit_terms'    => 'edit_stars',
            'delete_terms'  => 'delete_stars',
            'assign_terms'  => 'assign_stars'
        )
    );

    register_taxonomy( 'stars', array( 'rating' ), $args );

    $labels = array(
        'name'              => _x( 'Page Url', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Page Url', 'taxonomy singular name', 'design_comuni_italia' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => false,
        'show_admin_column' => true,
        'query_var'         => true,
        'capabilities'      => array(
            'manage_terms'  => 'manage_page_urls',
            'edit_terms'    => 'edit_page_urls',
            'delete_terms'  => 'delete_page_urls',
            'assign_terms'  => 'assign_page_urls'
        )
    );

    register_taxonomy( 'page_urls', array( 'rating' ), $args );
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'dci_rating_add_content_after_title' );
function dci_rating_add_content_after_title($post) {

    if($post->post_type == "rating") {
        if (isset($_GET['post']))
            $curr_post_id = $_GET['post'];
        else if (isset($_POST['post_ID']))
            $curr_post_id = $_POST['post_ID'];

        if (isset($curr_post_id)) {
            $post_title = get_the_title($curr_post_id);
            _e('Pagina valutata: <h1>' . $post_title . '</h1>', 'design_comuni_italia');
        }

        //_e('<span><i>il <b>Titolo</b> è il <b>Titolo della pagina o del contenuto valutato</b></i></span><br><br><br> ', 'design_comuni_italia');
    }
}

/**
 * Crea i metabox del post type Rating
 */
add_action( 'cmb2_init', 'dci_add_rating_metaboxes' );
function dci_add_rating_metaboxes()
{
    $prefix = '_dci_rating_';

    $cmb_dati = new_cmb2_box(array(
        'id' => $prefix . 'box_dati',
        'title' => __('Dati'),
        'object_types' => array('rating'),
        'context' => 'normal',
        'priority' => 'high',
    ));

    $cmb_dati->add_field( array(
        'id' => $prefix . 'url',
        'name'  => __( 'URL', 'design_comuni_italia' ),
        'desc'  => __( 'URL della pagina o del contenuto valutato', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'stelle',
        'name'  => __( 'Valutazioni (stelle)', 'design_comuni_italia' ),
        'desc'  => __( 'Valutazione fornita dall\'utente', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'type' => 'number',
            'readonly' => true
        )
    ) );
    
    $cmb_dati->add_field( array(
        'id' => $prefix . 'risposta_chiusa',
        'name'  => __( 'Risposta scelta multipla', 'design_comuni_italia' ),
        'desc' => __( 'Risposta alla prima domanda (a scelta multipla)' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes' => array(
            'readonly' => true
        )
    ) );

    $cmb_dati->add_field( array(
        'id' => $prefix . 'risposta_aperta',
        'name'  => __( 'Risposta domanda aperta', 'design_comuni_italia' ),
        'desc' => __( 'Risposta alla domanda aperta' , 'design_comuni_italia' ),
        'type' => 'text',
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
function dci_filter_rating_columns( $columns ) {

    $columns['risposta_multipla'] = __( 'Risposta<br> (scelta multipla)','design_comuni_italia' );
    $columns['risposta_aperta'] = __( 'Risposta<br> (domanda aperta)','design_comuni_italia' );

    return $columns;
}
add_filter( 'manage_rating_posts_columns', 'dci_filter_rating_columns' );

/**
 * Valorizzo le colonne custom
 * @param $column
 * @param $post_id
 */
function dci_manage_rating_posts_custom_column( $column, $post_id ) {

    if ( 'risposta_multipla' === $column ) {
        echo  get_post_meta($post_id, '_dci_rating_risposta_chiusa', true );
    }

   if ( 'risposta_aperta' === $column ) {
        echo  get_post_meta($post_id, '_dci_rating_risposta_aperta', true );
    }

}
add_action( 'manage_rating_posts_custom_column', 'dci_manage_rating_posts_custom_column', 10, 2);

/**
 * Ordino le colonne
 * @param $columns
 * @return array
 */
function dci_save_rating_columns( $columns ) {

    $columns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'taxonomy-page_urls' => $columns['taxonomy-page_urls'],
        'taxonomy-stars' => $columns['taxonomy-stars'],
        'risposta_multipla' => $columns['risposta_multipla'],
        'risposta_aperta' => $columns['risposta_aperta'],
        'date' => $columns['date'],
    );

    return $columns;
}
add_filter( 'manage_rating_posts_columns', 'dci_save_rating_columns' );

/**
 * Rendo le colonne filtrabili
 * @param $columns
 * @return mixed
 */
function dci_rating_sortable_columns( $columns ) {

    $columns['taxonomy-page_urls'] = 'rating_taxonomy-page_urls';
    $columns['taxonomy-stars'] = 'rating_taxonomy-stars';
    $columns['risposta_multipla'] = 'rating_risposta_multipla';

    return $columns;
}
add_filter( 'manage_edit-rating_sortable_columns', 'dci_rating_sortable_columns');

/**
 * Filtro le colonne
 * @param $query
 */
function dci_rating_posts_orderby( $query ) {
    if( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( 'rating_taxonomy-page_urls' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_rating_url' );
    }

    if ( 'rating_taxonomy-stars' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_rating_stelle' );
    }

    if ( 'rating_risposta_multipla' === $query->get( 'orderby') ) {
        $query->set( 'orderby', 'meta_value' );
        $query->set( 'meta_key', '_dci_rating_risposta_chiusa' );
    }
}
add_action( 'pre_get_posts', 'dci_rating_posts_orderby' );

/**
 * disabilito quick edit del titolo per le Valutazioni
 * @param $actions
 * @param $post
 * @return mixed
 */
function dci_rating_row_actions( $actions, $post ) {

    if ( 'rating' === $post->post_type ) {

        // Removes the "Quick Edit" action.
        unset( $actions['inline hide-if-no-js'] );
    }
    return $actions;
}
add_filter( 'post_row_actions', 'dci_rating_row_actions', 10, 2 );

/**
 * rimuovo voce menu aggiungi Valutazione
 */
function dci_rating_remove_add_new_menu() {

    remove_submenu_page('edit.php?post_type=rating','post-new.php?post_type=rating');

}
add_action('admin_menu','dci_rating_remove_add_new_menu');

/**
 * rimuovo meta box Update, Publish
 * @param $post_type
 * @param $position
 * @param $post
 */
function dci_rating_remove_publish_mbox( $post_type, $position, $post )
{
    remove_meta_box( 'submitdiv', 'rating', 'side' );
}
add_action( 'do_meta_boxes', 'dci_rating_remove_publish_mbox', 10, 3 );

