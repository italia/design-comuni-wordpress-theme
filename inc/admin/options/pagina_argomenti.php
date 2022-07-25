<?php

function dci_register_pagina_argomenti_options(){
    $prefix = '';

    $args = array(
        'id'           => 'dci_options_argomenti',
        'title'        => esc_html__( 'Argomenti', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'argomenti',
        'tab_title'    => __('Argomenti', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

// 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $argomenti_options = new_cmb2_box( $args );

    $argomenti_options->add_field( array(
        'id' => $prefix . 'argomenti_options',
        'name'        => __( 'Argomenti', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione della Pagina Argomenti.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $argomenti_options->add_field( array(
        'id' => $prefix . 'argomenti_evidenziati',
        'name'        => __( 'Argomenti in Evidenza', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona gli argomenti in evidenza.' , 'design_comuni_italia' ),
        'type'             => 'pw_multiselect',
        'options' => dci_get_terms_options('argomenti'),
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes' => array(
            'data-maximum-selection-length' => '8',
        ),
    ) );

}