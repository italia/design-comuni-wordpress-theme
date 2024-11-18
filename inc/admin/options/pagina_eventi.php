<?php

function dci_register_pagina_eventi_options(){
    $prefix = '';

    /**
     * Opzioni eventi
     */
    $args = array(
        'id'           => 'dci_options_eventi',
        'title'        => esc_html__( 'Eventi', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'eventi',
        'tab_title'    => __('Eventi', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }
    $eventi_options = new_cmb2_box( $args );
    $eventi_options->add_field( array(
        'id' => $prefix . 'eventi_options',
        'name'        => __( 'Eventi', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione della pagina eventi' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );
    $eventi_options->add_field( array(
        'id' => $prefix . 'immagine',
        'name'        => __( 'Immagine', 'design_comuni_italia' ),
        'desc' => __( 'Immagine di copertina della pagina (opzionale)' , 'design_comuni_italia' ),
        'type' => 'file',
        'query_args' => array( 'type' => 'image' ),
    ) );
    $eventi_options->add_field( array(
        'id' => $prefix . 'didascalia',
        'name'        => __( 'Didascalia', 'design_comuni_italia' ),
        //'desc' => __( 'didascalia.' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );
    $eventi_options->add_field(array(
            'name' => __('eventi in evidenza', 'design_comuni_italia'),
            'desc' => __('Seleziona i eventi in evidenza. NB: Selezionane 3 o multipli di 3 per evitare buchi nell\'impaginazione.  ', 'design_comuni_italia'),
            'id' => $prefix . 'eventi_evidenziati',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array(
                        'evento'
                    )
                ), // override the get_posts args
            ),
            'attributes' => array(
                'data-max-items' => 6, //change the value here to how many posts may be attached.
            )
        )
    );
}