<?php

/**
 * Definisce post type Dataset
 */
add_action( 'init', 'dci_register_post_type_dataset' );
function dci_register_post_type_dataset() {

    $labels = array(
        'name'                  => _x( 'Dataset', 'Post Type General Name', 'design_comuni_italia' ),
        'singular_name'         => _x( 'Dataset', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new'               => _x( 'Aggiungi un Dataset', 'Post Type Singular Name', 'design_comuni_italia' ),
        'add_new_item'               => _x( 'Aggiungi un Dataset', 'Post Type Singular Name', 'design_comuni_italia' ),
        'featured_image' => __( 'Logo Identificativo del Dataset', 'design_comuni_italia' ),
        'edit_item'      => _x( 'Modifica il Dataset', 'Post Type Singular Name', 'design_comuni_italia' ),
        'view_item'      => _x( 'Visualizza il Dataset', 'Post Type Singular Name', 'design_comuni_italia' ),
        'set_featured_image' => __( 'Seleziona Immagine Dataset' ),
        'remove_featured_image' => __( 'Rimuovi Immagine Dataset' , 'design_comuni_italia' ),
        'use_featured_image' => __( 'Usa come Immagine Dataset' , 'design_comuni_italia' ),
    );
    $args = array(
        'label'                 => __( 'Dataset', 'design_comuni_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position' => 5,
        'menu_icon'             => 'dashicons-chart-line',
        'has_archive'           => true,
        'capability_type' => array('dataset', 'datasets'),
        'map_meta_cap'    => true,
        'description'    => __( "Struttura delle informazioni utili a presentare un dataset", 'design_comuni_italia' ),

    );
    register_post_type( 'dataset', $args );

    remove_post_type_support( 'dataset', 'editor');
}

/**
* Aggiungo label sotto il titolo
*/
add_action( 'edit_form_after_title', 'dci_dataset_add_content_after_title' );
function dci_dataset_add_content_after_title($post) {
    if($post->post_type == "dataset")
        _e('<span><i>il <b>Titolo</b> è il <b>Titolo del Dataset</b>. Si raccomanda di inserire un testo semplice e corto. Ad es. «Contratti del Sistema Pubblico di Connettività (SPC)» oppure «Luoghi ed eventi della cultura».</i></span><br><br><br> ', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type Dataset
 */
add_action( 'cmb2_init', 'dci_add_dataset_metaboxes' );
function dci_add_dataset_metaboxes() {
    $prefix = '_dci_dataset_';

    $cmb_temi = new_cmb2_box( array(
        'id'           => $prefix . 'box_temi',
        'title'        => __( 'Temi' ),
        'object_types' => array( 'dataset' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );

    $cmb_temi->add_field( array(
        'id' => $prefix . 'temi',
        'desc' => __( 'Temi di cui tratta il dataset *', 'design_comuni_italia' ),
        'type'             => 'taxonomy_multicheck_hierarchical',
        'taxonomy'       => 'temi_dataset',
        'show_option_none' => false,
        'remove_default' => 'true',

    ) );


    //APERTURA
    $cmb_apertura = new_cmb2_box( array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __( 'Apertura', 'design_comuni_italia' ),
        'object_types' => array( 'dataset' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_apertura->add_field( array(
        'id'         => $prefix . 'descrizione_breve',
        'name'       => __( 'Descrizione breve *', 'design_comuni_italia' ),
        'desc' => __( 'Inserire la descrizione del dataset. Si raccomanda di fornire una breve descrizione dei contenuti principali del dataset. Evitare di utilizzare un linguaggio ricco di riferimenti normativi. Utilizzare invece un linguaggio semplice che possa aiutare qualsiasi utente a identificare il contenuto del dataset. Ad es. «Il dataset contiene i dati sui contratti del Sistema Pubblico di Connettività (SPC) relativi al Lotto 1 dell’anno 2007.» .' , 'design_comuni_italia' ),
        'type'       => 'textarea',
        'attributes'    => array(
            'maxlength'  => '255',
            'required'    => 'required'
        ),
    ) );


    //DATASET
    $cmb_dataset = new_cmb2_box( array(
        'id'           => $prefix . 'box_dataset',
        'title'        => __( 'Dataset', 'design_comuni_italia' ),
        'object_types' => array( 'dataset' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_dataset->add_field( array(
        'id' => $prefix . 'distribuzione',
        'name'        => __( 'Distribuzione *', 'design_comuni_italia' ),
        'desc' => __( 'Una distribuzione è una forma attraverso cui il dataset è disponibile. Ogni dataset può essere disponibile in diverse forme, come per esempio diversi formati o differenti endpoint (e.g., SPARQL endpoint). Nel caso di serie temporali o spaziali o viste di un dataset, queste sono descritte mediante le distribuzioni. Per esempio, nel caso di un dataset suddiviso per regioni, le suddivisioni rappresentano distribuzioni di un dataset più ampio che include tutti i dati del territorio nazionale' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'attributes'    => array(
            'required'    => 'required'
        ),
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_dataset->add_field( array(
        'id' => $prefix . 'licenza',
        'name'    => __( 'Licenza *', 'design_comuni_italia' ),
        'desc' => __( 'Licenza del dataset', 'design_comuni_italia' ),
        'type'             => 'taxonomy_radio_hierarchical',
        'taxonomy'       => 'licenze',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_dataset->add_field( array(
            'name'       => __('Dataset url *', 'design_comuni_italia' ),
            'desc' => __( 'Link al dataset vero e proprio in un formato standard (es. csv' , 'design_comuni_italia' ),
            'id'             => $prefix . 'dataset_url',
            'type'       => 'text_url',
            'attributes'    => array(
                'required'    => 'required'
            ),
    ) );

    //INFORMAZIONI
    $cmb_informazioni = new_cmb2_box( array(
        'id'           => $prefix . 'box_informazioni',
        'title'        => __( 'Informazioni', 'design_comuni_italia' ),
        'object_types' => array( 'dataset' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_informazioni->add_field( array(
        'id' => $prefix . 'data_modifica',
        'name'    => __( 'Ultima modifica *', 'design_comuni_italia' ),
        'desc' => __( 'Data dell\'ultima modifica effettuata sul dataset' , 'design_comuni_italia' ),
        'type'    => 'text_date_timestamp',
        'date_format' => 'd-m-Y',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_informazioni->add_field( array(
        'id' => $prefix . 'titolare',
        'name'    => __( 'Titolare *', 'design_comuni_italia' ),
        'desc' => __( 'Organizzazione (o pubblica amministrazione) responsabile della gestione complessiva del dataset in virtù dei propri compiti istituzionali. Si raccomanda di evitare l’inserimento di nomi di singole persone.' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    //FREQUENZE DI AGGIORNAMENTO
    $cmb_frequenze_aggiornamento = new_cmb2_box( array(
        'id'           => $prefix . 'box_frequenze_aggiornamento',
        'title'        => __( 'Frequenza di aggiornamento *', 'design_comuni_italia' ),
        'object_types' => array( 'dataset' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );

    $cmb_frequenze_aggiornamento->add_field( array(
        'id' => $prefix . 'frequenza_aggiornamento',
        //'name'    => __( 'Frequenza di aggiornamento *', 'design_comuni_italia' ),
        'desc' => __( 'Indicare la frequenza di aggiornamento del dataset seguendo il la tassonomia prevista nel vocabolario europeo', 'design_comuni_italia' ),
        'type'             => 'taxonomy_radio',
        'taxonomy'       => 'frequenze_aggiornamento',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );


}

/**
 * aggiungo js per controllo compilazione campi
 */
add_action( 'admin_print_scripts-post-new.php', 'dci_dataset_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_dataset_admin_script', 11 );

function dci_dataset_admin_script() {
    global $post_type;
    if( 'dataset' == $post_type )
        wp_enqueue_script( 'dataset-admin-script', get_template_directory_uri() . '/inc/admin-js/dataset.js' );
}

/**
 * Valorizzo il post content in base al contenuto dei campi custom
 * @param $data
 * @return mixed
 */
function dci_dataset_set_post_content( $data ) {

    if($data['post_type'] == 'dataset') {

        $descrizione_breve = '';
        if (isset($_POST['_dci_dataset_descrizione_breve'])) {
            $descrizione_breve = $_POST['_dci_dataset_descrizione_breve'];
        }

        $distribuzione = '';
        if (isset($_POST['_dci_dataset_distribuzione'])) {
            $distribuzione = $_POST['_dci_dataset_distribuzione'];
        }

        $content = $descrizione_breve.'<br>'.$distribuzione;

        $data['post_content'] = $content;
    }

    return $data;
}
add_filter( 'wp_insert_post_data' , 'dci_dataset_set_post_content' , '99', 1 );