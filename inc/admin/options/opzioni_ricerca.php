<?php

function dci_register_ricerca_options(){
    $prefix = '';

    /**
     * Opzioni Ricerca Globale
     */
    $args = array(
        'id'           => 'dci_options_ricerca',
        'title'        => esc_html__( 'Ricerca', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'ricerca',
        'capability'    => 'manage_options',
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'tab_title'    => __('Ricerca', "design_comuni_italia"),	);

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $ricerca_options = new_cmb2_box( $args );

    $ricerca_options->add_field( array(
        'id' => $prefix . 'ricerca_istruzioni',
        'name'        => __( 'Sezione "Forse stavi cercando"', 'design_comuni_italia' ),
        'desc' => __( 'Inserisci qui link a contenuti del Sito del Comune.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $ricerca_options->add_field(array(
        'name' => __('Contenuti', 'design_comuni_italia'),
        'desc' => __('Seleziona i contenuti', 'design_comuni_italia'),
        'id' => $prefix . 'contenuti',
        'type'    => 'custom_attached_posts',
        'column'  => true,
        'options' => array(
            'show_thumbnails' => false,
            'filter_boxes'    => true,
            'query_args'      => array(
                'posts_per_page' => -1,
                'post_type'      =>  array_merge(dci_get_sercheable_tipologie(), array('page'))
            ),
        )
    ));
}