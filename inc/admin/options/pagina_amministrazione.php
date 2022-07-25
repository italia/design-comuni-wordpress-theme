<?php

function dci_register_pagina_amministrazione_options(){
    $prefix = '';

    /**
     * Opzioni Amministrazione
     */
    $args = array(
        'id'           => 'dci_options_amministrazione',
        'title'        => esc_html__( 'Amministrazione', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'amministrazione',
        'tab_title'    => __('Amministrazione', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $amministrazione_options = new_cmb2_box( $args );

    $amministrazione_options->add_field( array(
        'id' => $prefix . 'amministrazione_options',
        'name'        => __( 'Amministrazione', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione della pagina Amministrazione.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $amministrazione_options->add_field( array(
            'name' => __('<h5>Selezione contenuti in evidenza</h5>', 'design_comuni_italia'),
            'desc' => __('Seleziona i contenuti da mostrare in homepage ', 'design_comuni_italia'),
            'id' => $prefix . 'notizia_evidenziata',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array(
                        'persona_pubblica',
                        'unita_organizzativa',
                        'documento_pubblico',
                        'dataset'
                    ),
                ), // override the get_posts args
            ),
            'attributes' => array(
                'data-max-items' => 3, //change the value here to how many posts may be attached.
            ),
        )
    );

}