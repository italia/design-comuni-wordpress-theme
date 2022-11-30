<?php

function dci_register_comune_options(){
    $prefix = '';

    /**
     * Opzioni di base
     * nome Comune, Regione, informazioni essenziali
     */
    $args = array(
        'id'           => 'dci_options_configurazione',
        'title'        => esc_html__( 'Configurazione', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'dci_options',
        'tab_group'    => 'dci_options',
        'tab_title'    => __('Configurazione Comune', "design_comuni_italia"),
        'capability'    => 'manage_options',
        'position'        => 2, // Menu position. Only applicable if 'parent_slug' is left empty.
        'icon_url'        => 'dashicons-admin-tools', // Menu icon. Only applicable if 'parent_slug' is left empty.
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $header_options = new_cmb2_box( $args );

    $header_options->add_field( array(
        'id' => $prefix . 'home_istruzioni',
        'name'        => __( 'Configurazione Comune', 'design_comuni_italia' ),
        'desc' => __( 'Area di configurazione delle informazioni di base' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'nome_comune',
        'name'        => __( 'Nome del Comune *', 'design_comuni_italia' ),
        'desc' => __( 'Il Nome del Comune' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'nome_regione',
        'name'        => __( 'Nome Regione *', 'design_comuni_italia' ),
        'desc' => __( 'La Regione di appartenenza del Comune' , 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'url_sito_regione',
        'name'        => __( 'Sito Regione', 'design_comuni_italia' ),
        'desc' => __( 'Link al sito della Regione di Appartenenza' , 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $header_options->add_field( array(
        'id' => $prefix . 'motto_comune',
        'name'        => __( 'Motto del Comune ', 'design_comuni_italia' ),
        'desc' => __( 'Il Motto del Comune, viene visualizzato sotto il nome del Comune' , 'design_comuni_italia' ),
        'type' => 'text',
    ));

    $header_options->add_field( array(
        'id'    => $prefix . 'stemma_comune',
        'name' => __('Stemma', 'design_comuni_italia' ),
        'desc' => __( 'Lo stemma del Comune. Si raccomanda di caricare un\'immagine in formato svg' , 'design_comuni_italia' ),
        'type' => 'file',
        'query_args'   => array(
        'type' => array(
            'image/svg',
        ))
    ));

    $header_options->add_field( array(
        'id'    => $prefix . 'stemma_comune_mobile',
        'name' => __('Stemma per mobile', 'design_comuni_italia' ),
        'desc' => __( 'Utilizzare questo campo per caricare un\'immagine alternativa dello stemma del Comune visibile dal menu hamburger (mobile). Si raccomanda di caricare un\'immagine in formato svg' , 'design_comuni_italia' ),
        'type' => 'file',
        'query_args'   => array(
        'type' => array(
            'image/svg',
        ))
    ));

}