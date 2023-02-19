<?php

/**
 * Definisce post type Servizio
 */
add_action( 'init', 'dci_register_post_type_servizio' );
function dci_register_post_type_servizio() {

	/** servizio **/
	$labels = array(
		'name'                  => _x( 'Servizi', 'Post Type General Name', 'design_comuni_italia' ),
		'singular_name'         => _x( 'Servizio', 'Post Type Singular Name', 'design_comuni_italia' ),
		'add_new'               => _x( 'Aggiungi un Servizio', 'Post Type Singular Name', 'design_comuni_italia' ),
		'add_new_item'          => _x( 'Aggiungi un Servizio', 'Post Type Singular Name', 'design_comuni_italia' ),
		'featured_image'        => __( 'Logo Identificativo del Servizio', 'design_comuni_italia' ),
		'edit_item'             => _x( 'Modifica il Servizio', 'Post Type Singular Name', 'design_comuni_italia' ),
		'view_item'             => _x( 'Visualizza il Servizio', 'Post Type Singular Name', 'design_comuni_italia' ),
		'set_featured_image'    => __( 'Seleziona Logo' ),
		'remove_featured_image' => __( 'Rimuovi Logo' , 'design_comuni_italia' ),
		'use_featured_image'    => __( 'Usa come Logo' , 'design_comuni_italia' ),
	);

	$args = array(
		'label'            => __( 'Servizio', 'design_comuni_italia' ),
		'labels'           => $labels,
		'supports'         => array( 'title', 'editor', 'thumbnail' ),
//		'taxonomies'       => array( 'tipologia' ),
		'hierarchical'     => false,
		'public'           => true,
        'menu_position'    => 5,
        'menu_icon'        => 'dashicons-id-alt',
		'has_archive'      => false,
        'capability_type'  => array('servizio', 'servizi'),
        'map_meta_cap'     => true,
        'description'      => __( "I servizi che il comune mette a disposizione del cittadino.", 'design_comuni_italia' ),
        //'rewrite' => array('slug' => 'servizi'),
        'show_in_rest'       => true,
        'rest_base'          => 'servizi',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
	);

	register_post_type( 'servizio', $args );
    remove_post_type_support( 'servizio', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'sdi_servizio_add_content_after_title' );
function sdi_servizio_add_content_after_title($post) {
    if($post->post_type == "servizio")
        _e('<span><i>il <b>Titolo</b> è il <b>Nome del Servizio</b>. Il nome del Servizio deve essere facilmente comprensibile dai cittadini. Vincoli: massimo 60 caratteri spazi inclusi.</i></span><br><br>', 'design_comuni_italia' );
}

/**
 * Crea i metabox del post type servizi
 */
add_action( 'cmb2_init', 'dci_add_servizi_metaboxes' );
function dci_add_servizi_metaboxes() {

	$prefix = '_dci_servizio_';

	//STATO DEL SERVIZIO
	$cmb_stato = new_cmb2_box( array(
		'id'           => $prefix . 'box_stato',
		'title'        => __( 'Stato del Servizio *', 'design_comuni_italia' ),
		'object_types' => array( 'servizio' ),
		'context'      => 'side',
		'priority'     => 'high',
	) );

	$cmb_stato->add_field( array(
		'id'        => $prefix . 'stato',
		'desc'      => __( 'Lo stato del servizio indica l\'effettiva fruibilità del Servizio', 'design_comuni_italia' ),
		'type'      => 'radio_inline',
		'default'   => 'true',
		'options'   => array(
			"true"  => __( 'Attivo', 'design_comuni_italia' ),
			"false" => __( 'Disattivo', 'design_comuni_italia' ),
		),
	) );

	$cmb_stato->add_field(array(
		'id'         => $prefix . 'motivo_stato',
		'name'       => __( 'Motivo dello stato *', 'design_comuni_italia' ),
		'desc'       => __( 'Descrizione testuale del motivo per cui un servizio non è attivo. Es. Servizio momentaneamente disattivato perché....Servizio attivo dal...', 'design_comuni_italia' ),
		'type'       => 'textarea_small',
		'attributes' => array(
			'data-conditional-id'    => $prefix.'stato',
			'data-conditional-value' => "false",
		),
	) );

	//APERTURA
   	$cmb_apertura = new_cmb2_box( array(
		'id'           => $prefix . 'box_apertura',
		'title'        => __( 'Apertura', 'design_comuni_italia' ),
		'object_types' => array( 'servizio' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

    $cmb_apertura->add_field( array(
        'id'             => $prefix . 'categorie',
        'name'           => __( 'Categorie del Servizio *', 'design_comuni_italia' ),
        'type'           => 'taxonomy_multicheck_inline',
        'taxonomy'       => 'categorie_servizio',
        'remove_default' => 'true',
    ) );

    $cmb_apertura->add_field( array(
        'id'         => $prefix . 'sottotitolo',
        'name'       => __( 'Sottotitolo', 'design_comuni_italia' ),
        'desc'       => __( 'Indica un sottotitolo che può avere il Servizio, oppure un nome che identifica informalmente il Servizio.' , 'design_comuni_italia' ),
        'type'       => 'text',
        'attributes' => array(
            'maxlength'  => '255',
        ),
    ) );

    $cmb_apertura->add_field( array(
            'name'       => __('Immagine', 'design_comuni_italia' ),
            'desc'       => __( 'Eventuale logo identificativo del servizio' , 'design_comuni_italia' ),
            'id'         => $prefix . 'immagine',
            'type'       => 'file',
            // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            'query_args' => array( 'type' => 'image' ), // Only images attachment
        )
    );

	$cmb_apertura->add_field( array(
		'id'         => $prefix . 'descrizione_breve',
		'name'       => __( 'Descrizione breve *', 'design_comuni_italia' ),
		'desc'       => __( 'Indicare una sintetica descrizione del Servizio (max 255 caratteri) utilizzando un linguaggio semplice che possa aiutare qualsiasi utente a identificare con chiarezza il Servizio. Non utilizzare un linguaggio ricco di riferimenti normativi. Vincoli: 160 caratteri spazi inclusi.' , 'design_comuni_italia' ),
		'type'       => 'textarea',
		'attributes' => array(
			'maxlength' => '255',
			'required'  => 'required'
		),
	) );

    //A CHI SI RIVOLGE
    $cmb_destinatari = new_cmb2_box( array(
        'id'           => $prefix . 'box_destinatari',
        'title'        => __( 'A chi è rivolto', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_destinatari->add_field( array(
        'id'         => $prefix . 'a_chi_e_rivolto',
        'name'       => __( 'A chi è rivolto *', 'design_comuni_italia' ),
        'desc'       => __( 'Descrizione testuale dei principali destinatari dell\'Evento' , 'design_comuni_italia' ),
        'type'       => 'wysiwyg',
        'attributes' => array(
            'required'    => 'required'
        ),
        'options'    => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    //DESCRIZIONE
    $cmb_descrizione = new_cmb2_box( array(
        'id'           => $prefix . 'box_descrizione',
        'title'        => __( 'Cos\'è', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_descrizione->add_field( array(
        'id' => $prefix . 'descrizione_estesa',
        'name'        => __( 'Descrizione estesa', 'design_comuni_italia' ),
        'desc' => __( 'Descrizione estesa e completa del servizio.' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options'    => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_descrizione->add_field( array(
        'id'      => $prefix . 'copertura_geografica',
        'name'    => __( 'Copertura geografica', 'design_comuni_italia' ),
        'desc'    => __( 'Eventuale area geografica a cui il servizio si riferisce. Ad esempio "le zone coperte da ZTL"' , 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    //COME FARE
    $cmb_come_fare= new_cmb2_box( array(
        'id'           => $prefix . 'box_come_fare',
        'title'        => __( 'Come fare', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_come_fare->add_field( array(
        'id'      => $prefix . 'come_fare',
        'name'    => __( 'Come fare *', 'design_comuni_italia' ),
        'desc'    => __( 'Procedura da seguire per usufruire del Servizio.' , 'design_comuni_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
        'attributes' => array(
            'required' => 'required'
        ),
    ) );

    //COSA SERVE
    $cmb_cosa_serve= new_cmb2_box( array(
        'id'           => $prefix . 'box_cosa_serve',
        'title'        => __( 'Cosa serve', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_in_rest' => WP_REST_Server::READABLE
    ) );

    $cmb_cosa_serve->add_field( array(
        'id'         => $prefix . 'cosa_serve_introduzione',
        'name'       => __( 'Cosa Serve (testo introduttivo) * ', 'design_comuni_italia' ),
        'desc'       => __( 'es: "Per attivare il servizio bisogna prima compilare il modulo on line oppure stampare e compilare il modulo cartaceo che trovi nella sezione documenti di questa pagina. [Vai alla sezione documenti]" Per creare un link mediante ancora inserisci #art-par-documenti come valore del link', 'design_comuni_italia' ),
        'type'       => 'wysiwyg',
        'attributes' => array(
            'required' => 'required'
        ),
        'options'    => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_cosa_serve->add_field( array(
        'id'         => $prefix . 'cosa_serve_list',
        'name'       => __( 'Cosa Serve (lista) *', 'design_comuni_italia' ),
        'desc'       => __( 'la lista di cosa serve' , 'design_comuni_italia' ),
        'type'       => 'textarea',
        'repeatable' => true
    ) );

    //COSA SI OTTIENE
    $cmb_cosa_ottieni= new_cmb2_box( array(
        'id'           => $prefix . 'box_cosa_ottieni',
        'title'        => __( 'Cosa si ottene', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_cosa_ottieni->add_field( array(
        'id'    => $prefix . 'output',
        'name'  => __( 'Output/Cosa si ottiene *', 'design_comuni_italia' ),
        'desc'  => __( 'Indicare uno o più output prodotti dal servizio. Ad es.: "certificato di residenza", o "carta d\'identità elettronica"...' , 'design_comuni_italia' ),
        'type'  => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    //TEMPI E SCADENZE
    $cmb_tempi = new_cmb2_box( array(
        'id'           => $prefix . 'box_tempi',
        'title'        => __( 'Tempi e scadenze *', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_tempi->add_field( array(
        'id' => $prefix . 'tempi_text',
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    /**  repeater fasi_scadenze **/
    $group_field_id = $cmb_tempi->add_field( array(
        'id'          => $prefix . 'scadenze',
        //'name'        => __('Fasi' , 'design_scuole_italia' ),
        'type'        => 'group',
        'description' => __( 'Aggiungi le fasi specifiche per questo servizio (è possibile specificare il numero di giorni)', 'design_scuole_italia' ),
        'options'     => array(
            'group_title'    => __( 'Fase {#}', 'design_scuole_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi fase', 'design_scuole_italia' ),
            'remove_button'  => __( 'Rimuovi', 'design_scuole_italia' ),
            'sortable'       => true,
            'closed'      => true
        ),
    ) );
    $cmb_tempi->add_group_field( $group_field_id,  array(
        'id'      => 'titolo',
        'name'    => __( 'Titolo della fase *', 'design_comuni_italia' ),
        'type' => 'text',
    ) );
    $cmb_tempi->add_group_field( $group_field_id,  array(
        'id'      => 'giorni',
        'name'    => __( 'Giorni', 'design_comuni_italia' ),
        //'desc'    => __( 'giorni', 'design_scuole_italia' ),
        'type' => 'text_small',
        'attributes' => array(
            'type' => 'number',
        ),
    ) );
    $cmb_tempi->add_group_field( $group_field_id,  array(
        'id'      => 'descrizione',
        'name'    => __( 'Descrizione', 'design_comuni_italia' ),
        //'desc'    => __( 'Descrizione', 'design_scuole_italia' ),
        'type'             => 'textarea',
    ) );
    /*** fine repeater fasi e scadenze **/

    $cmb_tempi->add_field( array(
        'id' => $prefix . 'fasi',
        'name'        => __( 'Fasi esistenti', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona le fasi del Servizio. <br><a href="post-new.php?post_type=fase">Inserisci Fase</a>' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('fase'),
        'attributes' => array(
            //'required' => true,
            'placeholder' => __( 'Seleziona le fasi del Servizio', 'design_comuni_italia')
        )
    ) );

    //ACCEDERE AL SERVIZIO
    $cmb_costi = new_cmb2_box( array(
        'id'           => $prefix . 'box_costi',
        'title'        => __( 'Quanto costa', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_costi->add_field( array(
        'id' => $prefix . 'costi',
        'name'        => __( 'Costi', 'design_comuni_italia' ),
        'desc' => __( 'Condizioni e termini economici per compleare la procedura di richiesta del Servizio. Ad es. "il rinnovo della carta d\'identità ha un costo di euro x."" ' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    //ACCEDERE AL SERVIZIO
    $cmb_accesso = new_cmb2_box( array(
        'id'           => $prefix . 'box_accedi_servizio',
        'title'        => __( 'Accedi al Servizio', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_in_rest' => WP_REST_Server::READABLE
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'procedure_collegate',
        'name'        => __( 'Procedure collegate all\'esito *', 'design_comuni_italia' ),
        'desc' => __( 'Questo campo indica cosa fare per conoscere \'esito della procedura, e dove eventualmente ritirare l\'esito (sede dell\'ufficio, orari, numero sportello, etc.)' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'canale_digitale_text',
        'name'        => __( 'Introduzione canale digitale', 'design_comuni_italia' ),
        //'desc' => __( Label introduttiva al canale digitale' , 'design_comuni_italia' ),
        'type' => 'text'
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'canale_digitale_label',
        'name'        => __( 'Canale digitale label', 'design_comuni_italia' ),
        'desc' => __( 'Label del bottone associato al link che segue ' , 'design_comuni_italia' ),
        'type' => 'text',
        'default' => 'Richiedi online'
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'canale_digitale_link',
        'name'        => __( 'Canale digitale', 'design_comuni_italia' ),
        'desc' => __( 'Link per avviare la procedura di attivazione del servizio. Questo campo mette in relazione "Servizio" con il suo canale digitale di attivazione. ' , 'design_comuni_italia' ),
        'type' => 'text_url'
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'canale_fisico_text',
        'name'        => __( 'Introduzione canale fisico', 'design_comuni_italia' ),
        'desc' => __( 'Label introduttiva al canale fisico' , 'design_comuni_italia' ),
        'type' => 'text',
        'default' => 'Oppure, puoi prenotare un appuntamento e presentarti presso gli uffici.'
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'canale_fisico_uffici',
        'name'        => __( 'Uffici (canale fisico)', 'design_comuni_italia' ),
        'desc' => __( 'Uffici che erogano il servizio ' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona le Unità Organizzative', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_accesso->add_field( array(
        'id' => $prefix . 'vincoli',
        'name'        => __( 'Vincoli', 'design_comuni_italia' ),
        'desc' => __( 'Specificare anche eventuali vincoli. Ad es. "Non è possibile rinnovare la carta identità x mesi prima della scadenza."' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    //CASI PARTICOLARI
    $cmb_casi_particolari = new_cmb2_box( array(
        'id'           => $prefix . 'box_casi_particolari',
        'title'        => __( 'Casi particolari', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_casi_particolari->add_field( array(
        'id' => $prefix . 'casi_particolari',
        //'name'        => __( 'Casi particolari', 'design_comuni_italia' ),
        'desc' => __( 'Eventuali casi particolari riferiti all\'ottenimento del Servizio in questione. Ad es. "Le persone con disabilità (legge 104) possono contattare direttamente l\'ufficio e concordare una procedura di rinnovo a domicilio"' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    //ULTERIORI INFORMAZIONI
    $cmb_informazioni = new_cmb2_box( array(
        'id'           => $prefix . 'box_informazioni',
        'title'        => __( 'Informazioni', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_informazioni->add_field( array(
        'id'         => $prefix . 'ulteriori_informazioni',
        'name'       => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'desc'       => __( 'Eventuali link a pagine web, siti, servizi esterni all\'ambito comunale utili all\'erogazione del servizio descritto. Ad esempio nella pagina servizio "Carta di IdTipologia Elettronica", potrebbe essere utile inserire in questo campo un link al Ministero dell\'Interno', 'design_comuni_italia' ),
        'type'       => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );


    //CONDIZIONI DI SERVIZIO

    $cmb_condizioni_servizio = new_cmb2_box( array(
        'id'           => $prefix . 'box_condizioni_servizio',
        'title'        => __( 'Condizioni di servizio *', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_condizioni_servizio->add_field( array(
            //'name'       => __('Condizioni di servizio *', 'design_comuni_italia' ),
            'desc' => __( 'file contenente i termini e le condizioni del servizio' , 'design_comuni_italia' ),
            'id'             => $prefix . 'condizioni_servizio',
            'type' => 'file',
            'attributes' => array(
                'required' => 'required'
            )
        )
    );

    //CONTATTI
    $cmb_contatti = new_cmb2_box( array(
        'id'           => $prefix . 'box_contatti',
        'title'        => __( 'Contatti', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'punti_contatto',
        'name'        => __( 'Punti di Contatto', 'design_comuni_italia' ),
        'desc' => __( 'Telefono, mail o altri punti di contatto<br><a href="post-new.php?post_type=punto_contatto">Inserisci Punto di Contatto</a>' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('punto_contatto'),
        'attributes'    => array(
            'required'    => 'required',
            'placeholder' =>  __( 'Seleziona i Punti di Contatto', 'design_comuni_italia' ),
        ),
    ) );

    $cmb_contatti->add_field( array(
        'id' => $prefix . 'unita_responsabile',
        'name'    => __( 'Unità Organizzativa responsabile * ', 'design_comuni_italia' ),
        'desc' => __( 'Link dell\'ufficio resposanbile dell\'erogazione di questo Servizio' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),
        'attributes' => array(
            'required' => 'required',
            'placeholder' =>  __( 'Seleziona le Unità Organizzative', 'design_comuni_italia' ),
        )
    ) );

    //DOCUMENTI
    $cmb_documenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __( 'Documenti', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'normal',
        'priority'     => 'low',
    ) );

    $cmb_documenti->add_field( array(
        'id' => $prefix . 'documenti',
        'name'        => __( 'Documenti', 'design_comuni_italia' ),
        'desc' => __( 'Link alle schede documenti non funzionali al completamento del servizi, ma di semplice supporto' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __( 'Seleziona i Documenti Pubblici', 'design_comuni_italia' ),
        ),
    ) );

    //argomenti
    $cmb_argomenti = new_cmb2_box( array(
        'id'           => $prefix . 'box_argomenti',
        'title'        => __( 'Argomenti *', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
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

    $cmb_events = new_cmb2_box( array(
        'id'           => $prefix . 'box_events',
        'title'        => __( 'Events collegati', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
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

    //CODICE ENTE
	$cmb_ipa = new_cmb2_box( array(
		'id'           => $prefix . 'box_ipa',
		'title'        => __( 'Codice dell’Ente Erogatore (ipa)', 'design_comuni_italia' ),
		'object_types' => array( 'servizio' ),
		'context'      => 'side',
		'priority'     => 'high',
	) );

	$cmb_ipa->add_field( array(
		'id' => $prefix . 'codice_ente_erogatore',
		'desc' => __( 'Specificare il nome dell’organizzazione, come indicato nell’Indice della Pubblica Amministrazione (IPA), che esercita uno specifico ruolo sul Servizio.', 'design_comuni_italia' ),
		'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '255',
        ),
	) );

    //SETTORE MERCEOLOGICO
    $cmb_settore_merceologico = new_cmb2_box( array(
        'id'           => $prefix . 'box_settore_merceologico',
        'title'        => __( 'Settore merceologico', 'design_comuni_italia' ),
        'object_types' => array( 'servizio' ),
        'context'      => 'side',
        'priority'     => 'high',
    ) );

    $cmb_settore_merceologico->add_field( array(
        'id' => $prefix . 'settore_merceologico',
        'desc' => __( 'Classificazione del servizio basata su catalogo dei servizi (Classificazione NACE)', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'maxlength'  => '255',
        ),
    ) );
}

/**
 * aggiungo js per controllo compilazione campi
 */

add_action( 'admin_print_scripts-post-new.php', 'dci_servizio_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dci_servizio_admin_script', 11 );

function dci_servizio_admin_script() {
    global $post_type;
    if( 'servizio' == $post_type )
        wp_enqueue_script( 'servizio-admin-script', get_template_directory_uri() . '/inc/admin-js/servizio.js' );
}

/**
 * Valorizzo il post content in base al contenuto dei campi custom
 * @param $data
 * @return mixed
 */
function dci_servizio_set_post_content( $data ) {

    if($data['post_type'] == 'servizio') {

        $descrizione_breve = '';
        if (isset($_POST['_dci_servizio_descrizione_breve'])) {
            $descrizione_breve = $_POST['_dci_servizio_descrizione_breve'];
        }

        $descrizione_estesa = '';
        if (isset($_POST['_dci_servizio_descrizione_estesa'])) {
            $descrizione_estesa = $_POST['_dci_servizio_descrizione_estesa'];
        }

        $info = '';
        if (isset($_POST['_dci_servizio_ulteriori_informazioni'])) {
            $info = $_POST['_dci_servizio_ulteriori_informazioni'];
        }

        $content = $descrizione_breve.'<br>'.$descrizione_estesa.'<br>'.$info;

        $data['post_content'] = $content;
    }

    return $data;
}
add_filter( 'wp_insert_post_data' , 'dci_servizio_set_post_content' , '99', 1 );
