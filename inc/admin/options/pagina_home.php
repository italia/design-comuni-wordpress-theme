<?php

function dci_register_pagina_home_options(){
    $prefix = '';

    /**
     * Opzioni Home
     */
    $args = array(
        'id'           => 'dci_options_home',
        'title'        => esc_html__( 'Home Page', 'design_comuni_italia' ),
        'object_types' => array( 'options-page' ),
        'option_key'   => 'homepage',
        'capability'    => 'manage_options',
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'tab_title'    => __('Home Page', "design_comuni_italia"),	);

    // 'tab_group' property is supported in > 2.4.0.
    if ( version_compare( CMB2_VERSION, '2.4.0' ) ) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $home_options = new_cmb2_box( $args );

    $home_options->add_field( array(
        'id' => $prefix . 'contenuti_evidenziati_title',
        'name'        => __( 'Sezione Contenuti in Evidenza', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione Contenuti in Evidenza.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $home_options->add_field( array(
            'name' => __('Notizia in evidenza', 'design_comuni_italia'),
            'desc' => __('Seleziona una notizia da mostrare in homepage', 'design_comuni_italia'),
            'id' => $prefix . 'notizia_evidenziata',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array('notizia'),
                ), // override the get_posts args
            ),
            'attributes' => array(
                'data-max-items' => 1, //change the value here to how many posts may be attached.
            ),
        )
    );

    $home_options->add_field(array(
        'id' => $prefix . 'notizie_in_home',
        'name' => __('Notizie in homepage', 'design_comuni_italia'),
        'desc' => __('Seleziona il numero di notizie da mostrare in homepage.', 'design_comuni_italia'),
        'type' => 'radio_inline',
        'default' => 0,
        'options' => array(
            0 => __(0, 'design_comuni_italia'),
            3 => __(3, 'design_comuni_italia'),
            6 => __(6, 'design_comuni_italia'),
        ),
        'attributes' => array(
            'data-conditional-value' => "false",
        ),
    ));


    $home_options->add_field( array(
		    'name'        => __('Schede in evidenza', 'design_comuni_italia'),
		    'desc' => __( 'Definisci il contenuto delle Schede in evidenza' , 'design_comuni_italia' ),
            'id' => $prefix . 'schede_evidenziate',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array('evento','luogo','unita_organizzativa','documento_pubblico','servizio','notizia','dataset'),
                ), // override the get_posts args
            ),
            'attributes' => array(
                'data-max-items' => 6, //change the value here to how many posts may be attached.
            ),
        )
    );

    //sezione Siti Tematici
    $home_options->add_field( array(
        'id' => $prefix . 'siti_tematici_title',
        'name'        => __( 'Sezione Siti Tematici', 'design_comuni_italia' ),
        'desc' => __( 'Configurazione sezione Siti Tematici.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $home_options->add_field( array(
        'id' => $prefix . 'siti_tematici',
        'name'        => __( 'Sito Tematico ', 'design_comuni_italia' ),
        'desc' => __( 'Selezionare il sito tematico di cui visualizzare la Card' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('sito_tematico'),
        'attributes' => array(
            'data-maximum-selection-length' => '3',
        ),
    ) );

    //sezione Argomenti
    $home_options->add_field( array(
        'id' => $prefix . 'argomenti_title',
        'name'        => __( 'Sezione Argomenti', 'design_comuni_italia' ),
        'desc' => __( 'Gestione Argomenti mostrati in homepage.' , 'design_comuni_italia' ),
        'type' => 'title',
    ) );

    $argomenti_group_id = $home_options->add_field( array(
        'id'           => $prefix . 'argomenti_evidenziati_1',
        'type'        => 'group',
        'name'        => 'Argomenti in evidenza',
        'desc' => __( 'Definisci il contenuto delle Card degli argomenti' , 'design_comuni_italia' ),
        'repeatable'  => false,
        'options'     => array(
            'group_title'   => __( 'Argomento 1: ', 'design_comuni_italia' ),
            'closed' => true
        ),
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
        'id' => $prefix . 'argomento_1_argomento',
        'name'        => __( 'Argomento', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona l\'Argomento' , 'design_comuni_italia' ),
        'type' => 'taxonomy_select',
        'taxonomy'=>'argomenti'
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
        'id' => $prefix . 'argomento_1_siti_tematici',
        'name'        => __( 'Sito Tematico ', 'design_comuni_italia' ),
        'desc' => __( 'Selezionare il sito tematico da inserire nella Card' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('sito_tematico'),
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
            'name' => __('<h5>Selezione contenuti</h5>', 'design_comuni_italia'),
            'desc' => __('Seleziona i contenuti da mostrare nella Card dell\'Argomento. ', 'design_comuni_italia'),
            'id' => $prefix . 'argomento_1_contenuti',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array('evento','luogo','unita_organizzativa','documento_pubblico','servizio','notizia'),
                ), // override the get_posts args
            )
        )
    );

    $argomenti_group_id = $home_options->add_field( array(
        'id'           => $prefix . 'argomenti_evidenziati_2',
        'type'        => 'group',
        'repeatable'  => false,
        'options'     => array(
            'group_title'   => __( 'Argomento 2: ', 'design_comuni_italia' ),
            'closed' => true
        ),
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
        'id' => $prefix . 'argomento_2_argomento',
        'name'        => __( 'Argomento', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona l\'Argomento' , 'design_comuni_italia' ),
        'type' => 'taxonomy_select',
        'taxonomy'=>'argomenti'
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
        'id' => $prefix . 'argomento_2_siti_tematici',
        'name'        => __( 'Sito Tematico ', 'design_comuni_italia' ),
        'desc' => __( 'Selezionare il sito tematico da inserire nella Card' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('sito_tematico'),
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
            'name' => __('<h5>Selezione contenuti</h5>', 'design_comuni_italia'),
            'desc' => __('Seleziona i contenuti da mostrare nella Card dell\'Argomento. ', 'design_comuni_italia'),
            'id' => $prefix . 'argomento_2_contenuti',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array('evento','luogo','unita_organizzativa','documento_pubblico','servizio','notizia'),
                ), // override the get_posts args
            )
        )
    );

    $argomenti_group_id = $home_options->add_field( array(
        'id'           => $prefix . 'argomenti_evidenziati_3',
        'type'        => 'group',
        'repeatable'  => false,
        'options'     => array(
            'group_title'   => __( 'Argomento 3: ', 'design_comuni_italia' ),
            'closed' => true
        ),
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
        'id' => $prefix . 'argomento_3_argomento',
        'name'        => __( 'Argomento', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona l\'Argomento' , 'design_comuni_italia' ),
        'type' => 'taxonomy_select',
        'taxonomy'=>'argomenti'
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
        'id' => $prefix . 'argomento_3_siti_tematici',
        'name'        => __( 'Sito Tematico ', 'design_comuni_italia' ),
        'desc' => __( 'Selezionare il sito tematico da inserire nella Card' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('sito_tematico'),
    ) );
    $home_options->add_group_field( $argomenti_group_id, array(
            'name' => __('<h5>Selezione contenuti</h5>', 'design_comuni_italia'),
            'desc' => __('Seleziona i contenuti da mostrare nella Card dell\'Argomento. ', 'design_comuni_italia'),
            'id' => $prefix . 'argomento_3_contenuti',
            'type'    => 'custom_attached_posts',
            'column'  => true, // Output in the admin post-listing as a custom column. https://github.com/CMB2/CMB2/wiki/Field-Parameters#column
            'options' => array(
                'show_thumbnails' => false, // Show thumbnails on the left
                'filter_boxes'    => true, // Show a text box for filtering the results
                'query_args'      => array(
                    'posts_per_page' => -1,
                    'post_type'      => array('evento','luogo','unita_organizzativa','documento_pubblico','servizio','notizia'),
                ), // override the get_posts args
            )
        )
    );

    $home_options->add_field( array(
        'id' => $prefix . 'argomenti_altri',
        'name'        => __( 'Altri argomenti', 'design_comuni_italia' ),
        'desc' => __( 'Seleziona altri Argomenti peri quali compariranno link in homepage.' , 'design_comuni_italia' ),
        'type'             => 'pw_multiselect',
        'options' => dci_get_terms_options('argomenti'),
        'show_option_none' => false,
        'remove_default' => 'true',
    ) );

}
