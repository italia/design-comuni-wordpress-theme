<?php

function dci_register_pagina_novita_options(){
    $prefix = '';

    /**
     * Opzioni Novità
     */
    $args = array(
        'id'           => 'dci_options_novita',
        'title'        => esc_html__( 'Novità', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'novita',
        'tab_title'    => __('Novità', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }
    $novita_options = new_cmb2_box( $args );
    $novita_options->add_field( array(
        'id' => $prefix . 'novita_options',
        'name'        => __( 'Novità', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione della pagina Novità' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );
    $novita_options->add_field(array(
            'name' => __('Contenuti in evidenza', 'design_comuni_italia'),
            'desc' => __('Seleziona le notizie da mostrare nella sezione In Evidenza.', 'design_comuni_italia'),
            'id' => $prefix . 'contenuti_evidenziati',
            'type'    => 'custom_attached_posts',
            'sanitization_cb' => function($value, $field_args, $field){
                    return explode(",",$value);
            },
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array(
                        'notizia',
                    )
                ), // override the get_posts args
            ),
        'attributes' => array(
            'data-max-items' => 3, //change the value here to how many posts may be attached.
        )
        )
    );
    $novita_options->add_field( array(
        'id' => $prefix . 'novita_argomenti',
        'name'        => __( 'Sezione Argomenti', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione della Sezione Argomenti' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );
    $novita_options->add_field( array(
        'id' => $prefix . 'argomenti',
        'name'        => __( 'Argomenti ', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona e ordina gli argomenti.' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_terms_options('argomenti'),
    ) );
}