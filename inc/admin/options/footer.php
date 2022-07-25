<?php

function dci_register_footer_options(){
    $prefix = '';

    /**
     * Opzioni Footer
     */
    $args = array(
        'id'           => 'dci_options_footer',
        'title'        => esc_html__( 'Footer', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'footer',
        'tab_title'    => __('Footer', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'   => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $footer_options = new_cmb2_box( $args );

    $footer_options->add_field( array(
        'id' => $prefix . 'footer_options',
        'name'        => __( 'Footer', 'design_comuni_italia' ),
        'desc' => __( 'Area di configurazione del footer.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $footer_options->add_field( array(
        'id'   => $prefix . 'media_policy',
        'name' => __( 'Media Policy', 'design_comuni_italia' ),
        'desc' => __( 'Link alla Media Policy', 'design_comuni_italia' ),
        'type' => 'text_url',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'sitemap',
        'name'        => __( 'Mappa del sito', 'design_comuni_italia' ),
        'desc'        => __( 'Link alla Mappa del sito', 'design_comuni_italia' ),
        'type' => 'text_url',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'contatti_title',
        'name'        => __( 'Contatti', 'design_comuni_italia' ),
        'desc' => __( 'Specifica le opzioni di contatto del Comune (compaiono nel footer)' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'contatti_indirizzo',
        'name' => 'Indirizzo',
        'type' => 'text',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'contatti_CF_PIVA',
        'name' => 'Codice fiscale / P.IVA',
        'type' => 'text',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'contatti_PEC',
        'name' => 'Posta Elettronica Certificata (PEC)',
        'type' => 'text_email',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'contatti_URP',
        'name'    => __( 'Ufficio Relazioni con il Pubblico (URP)', 'design_comuni_italia' ),
        'desc' => __( 'Link alla scheda dell\'Ufficio Relazioni con il Pubblico' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'numero_verde',
        'name'        => __( 'Numero Verde', 'design_comuni_italia' ),
        'type' => 'text_medium',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'SMS_Whatsapp',
        'name'        => __( 'SMS e Whatsapp', 'design_comuni_italia' ),
        'type' => 'text_medium',
    ) );

    $footer_options->add_field( array(
        'id' => $prefix . 'centralino_unico',
        'name'        => __( 'Centralino unico', 'design_comuni_italia' ),
        'type' => 'text_medium',
    ) );

}