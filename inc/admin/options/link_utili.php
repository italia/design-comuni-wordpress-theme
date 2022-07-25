<?php

function dci_register_link_utili_options(){
    $prefix = '';

    $args = array(
        'id'           => 'dci_options_link_utili',
        'title'        => esc_html__( 'Link Utili', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'link_utili',
        'tab_title'    => __('Link Utili', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'    => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $link_utili_options = new_cmb2_box( $args );

    $link_utili_options->add_field( array(
        'id' => $prefix . 'link_utili_options',
        'name'        => __( 'Link Utili', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione dei Link Utili.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

   //repeater link
    $group_field_id = $link_utili_options->add_field( array(
        'id'          => $prefix . 'link',
        'type'        => 'group',
        'description' => __( 'Inserire più Link Utili' , 'design_comuni_italia' ),
        'options'     => array(
            'group_title'    => __( 'Link {#}', 'design_comuni_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi un link', 'design_comuni_italia' ),
            'remove_button'  => __( 'Rimuovi il link', 'design_comuni_italia' ),
            'sortable'       => true,
            'remove_confirm' => esc_html__( 'Sei sicuro di voler eliminare questo elemento?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );

    $link_utili_options->add_group_field( $group_field_id, array(
        'id' => $prefix . 'testo',
        'name' => __('Testo del link *','design_comuni_italia'),
        'desc' => __( '', 'design_comuni_italia' ),
        'type' => 'text',
        'attributes'    => array(
            //'required'    => 'required'
        ),
    ) );

    $link_utili_options->add_group_field( $group_field_id, array(
        'id' => $prefix . 'url',
        'name' => __('URL *','design_comuni_italia'),
        'desc' => __( 'URL del Link Utile', 'design_comuni_italia' ),
        'type' => 'text_url',
        'attributes'    => array(
            //'required'    => 'required'
        ),
    ) );

}