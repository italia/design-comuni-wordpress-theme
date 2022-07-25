<?php

function dci_register_scheda_assistenza_options(){
    $prefix = '';

    $args = array(
        'id'           => 'dci_options_assistenza',
        'title'        => esc_html__( 'Assistenza', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'assistenza',
        'tab_title'    => __('Assistenza e Contatti', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

// 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $assistenza_options = new_cmb2_box( $args );

    $assistenza_options->add_field( array(
        'id' => $prefix . 'assistenza_options',
        'name'        => __( 'Assistenza e Contatti', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione della card Assistenza e Contatti.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $assistenza_options->add_field( array(
        'id' => $prefix . 'numero_verde',
        'name'        => __( 'Numero Verde', 'design_comuni_italia' ),
        //'desc' => __( 'Numero Verde del Comune.' , 'design_comuni_italia' ),
        'type' => 'text_medium',
    ) );
}