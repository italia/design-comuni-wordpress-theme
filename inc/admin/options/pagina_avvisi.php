<?php

function dci_register_pagina_avvisi_options(){
    $prefix = '';

       /**
     * Registers options page "Alerts".
     */

    $args = array(
        'id'           => 'dci_options_messages',
        'title'        => esc_html__( 'Avvisi in Home', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'home_messages',
        'capability'    => 'manage_options',
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'tab_title'    => __('Avvisi in Home', "design_comuni_italia"),	);

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $alerts_options = new_cmb2_box( $args );

    $alerts_options->add_field( array(
        'id' => $prefix . 'messages_istruzioni',
        'name'        => __( 'Avvisi di allerta in home page', 'design_comuni_italia' ),
        'desc' => __( 'Inserisci messaggi che saranno visualizzati nella homepage.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $alerts_group_id = $alerts_options->add_field( array(
        'id'           => $prefix . 'messages',
        'type'        => 'group',
        'desc' => __( 'Ogni messaggio &egrave; costruito attraverso una descrizione breve (max 140 caratteri), una data di scadenza (opzionale) e un collegamento ad una pagina di approfondimento (opzionale).' , 'design_comuni_italia' ),
        'repeatable'  => true,
        'options'     => array(
            'group_title'   => __( 'Messaggio {#}', 'design_comuni_italia' ),
            'add_button'    => __( 'Aggiungi un messaggio', 'design_comuni_italia' ),
            'remove_button' => __( 'Rimuovi il messaggio', 'design_comuni_italia' ),
            'sortable'      => true,  // Allow changing the order of repeated groups.
        ),
    ) );

    $alerts_options->add_group_field( $alerts_group_id, array(
        'name'    => 'Selezione colore del messaggio',
        'id'      => 'colore_message',
        'type'    => 'radio_inline',
        'options' => array(
            'red'   => __( '<span class="radio-color red"></span>Rosso', 'design_comuni_italia' ),
            'orange'   => __( '<span class="radio-color orange"></span>Arancione', 'design_comuni_italia' ),
            'yellow' => __( '<span class="radio-color yellow"></span>Giallo', 'design_comuni_italia' ),
            'green'     => __( '<span class="radio-color green"></span>Verde', 'design_comuni_italia' ),
            'blue'     => __( '<span class="radio-color blue"></span>Blu', 'design_comuni_italia' ),
            'purple'     => __( '<span class="radio-color purple"></span>Viola', 'design_comuni_italia' ),
        ),
        'default' => 'yellow',
    ) );

    $alerts_options->add_group_field( $alerts_group_id, array(
        'name' => 'Visualizza icona',
        'id'   => 'icona_message',
        'type' => 'checkbox',
    ) );

    $alerts_options->add_group_field( $alerts_group_id, array(
        'id' => $prefix . 'data_message',
        'name'        => __( 'Data fine', 'design_comuni_italia' ),
        'type' => 'text_date',
        'date_format' => 'd-m-Y',
        'data-datepicker' => json_encode( array(
            'yearRange' => '-100:+0',
        ) ),
    ) );

    $alerts_options->add_group_field( $alerts_group_id, array(
        'id' => $prefix . 'testo_message',
        'name'        => __( 'Testo', 'design_comuni_italia' ),
        'desc' => __( 'Massimo 140 caratteri' , 'design_comuni_italia' ),
        'type' => 'textarea_small',
        'attributes'    => array(
            'rows'  => 3,
            'maxlength'  => '140',
        ),
    ) );

    $alerts_options->add_group_field( $alerts_group_id, array(
        'id' => $prefix . 'link_message',
        'name'        => __( 'Collegamento', 'design_comuni_italia' ),
        'desc' => __( 'Link al una pagina di approfondimento anche esterna al sito' , 'design_comuni_italia' ),
        'type' => 'text_url',
    ) );


}