<?php

function dci_register_contenuti_options(){
    /**
     * Opzioni Contenuti
     */
    $args = array(
        'id'           => 'dci_options_content',
        'title'        => esc_html__( 'Contenuti', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'content',
        'tab_title'    => __('Contenuti', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $setup_options = new_cmb2_box( $args );

    $setup_options->add_field( array(
        'id' => $prefix . 'content_options',
        'name'        => __( 'Contenuti', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione delle icone dei contenuti.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $post_types = dci_get_tipologie_singular_labels();

    foreach ($post_types as $type => $label){
        $setup_options->add_field( array(
            'id' => $prefix . 'icona_post_type_'.$type,
            'name' => 'Icona '.$label,
            'desc' => __( 'Seleziona una Icona Bootstrap Italia da associare alla Tipologia di Contenuto '.$label , 'design_comuni_italia' ),
            'type' => 'faiconselect',
            'options' =>dci_get_bootstrap_icon_options('all'),
        ) );
    }
}