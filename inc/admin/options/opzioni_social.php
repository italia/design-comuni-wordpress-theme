<?php

function dci_register_social_options(){
    $prefix = '';

    /**
     * Opzioni Social
     */
    $args = array(
        'id'           => 'dci_options_socials',
        'title'        => esc_html__( 'Socialmedia', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'socials',
        'capability'    => 'manage_options',
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'tab_title'    => __('Socialmedia', "design_comuni_italia"),	);

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $social_options = new_cmb2_box( $args );

    $social_options->add_field( array(
        'id' => $prefix . 'socials_istruzioni',
        'name'        => __( 'Sezione socialmedia', 'design_comuni_italia' ),
        'desc' => __( 'Inserisci qui i link ai tuoi socialmedia.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $social_options->add_field(array(
        'id' => $prefix . 'show_socials',
        'name' => __('Mostra le icone social', 'design_comuni_italia'),
        'desc' => __('Abilita la visualizzazione dei socialmedia nell\'header.', 'design_comuni_italia'),
        'type' => 'radio_inline',
        'default' => 'false',
        'options' => array(
            'true' => __('Si', 'design_comuni_italia'),
            'false' => __('No', 'design_comuni_italia'),
        ),
        'attributes' => array(
            'data-conditional-value' => "false",
        ),
    ));

    $social_group_id = $social_options->add_field( array(
        'id'           => $prefix . 'link_social',
        'type'        => 'group',
        'name'        => 'Link ai Socialmedia',
        'desc' => __( 'Definisci i link ai socialmedia e le icone associate' , 'design_comuni_italia' ),
        'repeatable'  => true,
        'options'     => array(
            'closed' =>true,
            'group_title'   => __( 'Social {#}:', 'design_comuni_italia' ),
            'add_button'    => __( 'Aggiungi un Social', 'design_comuni_italia' ),
            'remove_button' => __( 'Rimuovi il Social ', 'design_comuni_italia' ),
            'sortable'      => true,  // Allow changing the order of repeated groups.
        ),
    ) );

    $social_options->add_group_field( $social_group_id, array(
        'id' => $prefix . 'nome_social',
        'name'        => __( 'Nome Social', 'design_comuni_italia' ),
        'desc' => __( 'Nome del Social Network' , 'design_comuni_italia' ),
        'type' => 'text',
    ) );

    $social_options->add_group_field( $social_group_id, array(
        'id' => $prefix . 'url_social',
        'name' => 'URL Social',
        'desc' => __( 'Link vero e proprio al Social Network.' , 'design_comuni_italia' ),
        'type' => 'text_url',
    ) );

    $social_options->add_group_field( $social_group_id, array(
        'id' => $prefix . 'icona_social',
        'name' => 'Icona Social',
        'desc' => __( 'Seleziona una Icona Bootstrap Italia.' , 'design_comuni_italia' ),
        'type' => 'faiconselect',
        'options' =>dci_get_bootstrap_icon_options('it-social'),
    ) );

}