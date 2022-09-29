<?php

/**
 * Require post title and given wysiwyg fields for custom post types
 */
add_action( 'edit_form_advanced', 'force_post_title' );
function force_post_title( $post )  {
    $post_types = dci_get_tipologie_names();

    //remove control for persona_pubblica
    if (($key = array_search('persona_pubblica', $post_types)) !== false) {
        unset($post_types[$key]);
    }

    //remove control for appuntamento
    if (($key = array_search('appuntamento', $post_types)) !== false) {
        unset($post_types[$key]);
    }

    // If the current post is not one of the chosen post types, exit this function.
    if ( ! in_array( $post->post_type, $post_types ) ) {
        return;
    }

    ?>
    <script type='text/javascript'>
        ( function ( $ ) {
            $( document ).ready( function () {

                jQuery("#title").on('change keyup paste', function(){
                    jQuery("#titlewrap").removeClass("highlighted_missing_field");
                    jQuery( "#title-required-msj").remove()
                });

                //Require post title when adding/editing Project Summaries
                $( 'body' ).on( 'submit.edit-post', '#post', function () {
                    //validate only if publishing
                    if (document.activeElement.id !== 'publish') {
                        return true;
                    }
                    const required_dci_cmb2_wysiwyg_fields = [
                        '_dci_unita_organizzativa_competenze',
                        '_dci_luogo_modalita_accesso',
                        '_dci_dataset_distribuzione',
                        '_dci_documento_privato_formati',
                        '_dci_documento_pubblico_formati',
                        '_dci_evento_descrizione_completa',
                        '_dci_evento_a_chi_e_rivolto',
                        '_dci_messaggio_testo_messaggio',
                        '_dci_notizia_testo_completo',
                        '_dci_pagamento_descrizione_pagamento',
                        '_dci_pagamento_modalita_pagamento',
                        '_dci_pratica_descrizione',
                        '_dci_servizio_a_chi_e_rivolto',
                        '_dci_servizio_come_fare',
                        '_dci_servizio_cosa_serve_introduzione',
                        '_dci_servizio_output',
                        '_dci_servizio_procedure_collegate',
                        '_dci_servizio_tempi_text',
                    ]
                    for (const field_id of required_dci_cmb2_wysiwyg_fields) {
                        if ( jQuery( "#"+field_id ).val() !== undefined && !jQuery( "#"+field_id ).val()) {
                            // Show the alert
                            var alertid = field_id+"-required-msj"
                            if ( !jQuery( "#"+alertid ).length ) {
                                jQuery( "#wp-"+field_id+"-wrap" )
                                    .append( '<div id="'+alertid+'"><em>Campo obbligatorio</em></div>' )
                                    .addClass("highlighted_missing_field")
                                setTimeout( function(){
                                    jQuery("#wp-"+field_id+"-wrap").removeClass("highlighted_missing_field");
                                    jQuery("#"+alertid).remove()
                                } , 3000);
                            }
                            // Hide the spinner
                            jQuery( '#major-publishing-actions .spinner' ).hide();
                            // The buttons get "disabled" added to them on submit. Remove that class.
                            jQuery( '#major-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );
                            jQuery( '#minor-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );
                            // Focus on the field.
                            //jQuery( "#"+field_id).focus();
                            jQuery('html,body').animate({
                                scrollTop: jQuery("#"+field_id).parent().offset().top - 100
                            }, 'slow');

                            return false;
                        }
                    }

                    // If the title isn't set
                    if ( jQuery( "#title" ).val().replace( / /g, '' ).length === 0 ) {
                        // Show the alert
                        if ( !jQuery( "#title-required-msj" ).length ) {
                            jQuery( "#titlewrap" )
                                .append( '<div id="title-required-msj"><em>il Titolo è obbligatorio</em></div>' )
                                .addClass("highlighted_missing_field")
                        }
                        // Hide the spinner
                        jQuery( '#major-publishing-actions .spinner' ).hide();
                        // The buttons get "disabled" added to them on submit. Remove that class.
                        jQuery( '#major-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );
                        jQuery( '#minor-publishing-actions' ).find( ':button, :submit, a.submitdelete, #post-preview' ).removeClass( 'disabled' );
                        // Focus on the title field.
                        //jQuery( "#title" ).focus();
                        jQuery('html,body').animate({
                            scrollTop: jQuery("#title").parent().offset().top - 100
                        }, 'slow');
                        return false;
                    }
                });
            });
        }( jQuery ) );
    </script>
    <?php
}

/**
 * Remove Featured Image Field on Posts Edit Screen
 */
add_action('do_meta_boxes', 'remove_thumbnail_box');
function remove_thumbnail_box() {
    remove_meta_box( 'postimagediv',array_merge(array('post','page'),dci_get_tipologie_names()),'side' );
}

/**
 * create menu locations
 */
add_action('after_setup_theme', 'dci_create_menu_locations');
function dci_create_menu_locations() {
    // registra le posizione dei menu
    register_nav_menus( array(
        'menu-header-main' => esc_html__( 'Menu principale di navigazione (header)', 'design_comuni_italia' ),
        'menu-header-right' => esc_html__( 'Menu secondario (header)', 'design_comuni_italia' ),
        'menu-footer-col-1' => esc_html__( 'Menu footer (colonna 1 - "Amministrazione")', 'design_comuni_italia' ),
        'menu-footer-col-2' => esc_html__( 'Menu footer (colonna 2 - "Categorie di Servizio")', 'design_comuni_italia' ),
        'menu-footer-col-3-1' => esc_html__( 'Menu footer (colonna 3 - "Novità")', 'design_comuni_italia' ),
        'menu-footer-col-3-2' => esc_html__( 'Menu footer (colonna 3 - "Vivere il Comune")', 'design_comuni_italia' ),
        'menu-footer-info-1' => esc_html__( 'Menu footer (informazioni - colonna 1)', 'design_comuni_italia' ),
        'menu-footer-info-2' => esc_html__( 'Menu footer (informazioni - colonna 2)', 'design_comuni_italia' ),

        //'menu-footer-bottom' => esc_html__( 'Menu a piè di pagina (es: voce "privacy policy")', 'design_comuni_italia' ),
    ) );
}

/**
 * Add css admin style
 */
function dci_admin_css_load() {
    wp_enqueue_style( 'style-admin-css', get_template_directory_uri() . '/inc/admin-css/style-admin.css' );
}
add_action( 'admin_enqueue_scripts', 'dci_admin_css_load' );

/**
 * customize admin menu order
 * @param $menu_ord
 * @return bool|string[]
 */
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return dci_get_admin_menu_order();
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');


/**
 * filter for search
 */
function dci_search_filters( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {
        $allowed_types = array_merge(array("any"), dci_get_group_ids() );
        if ( isset( $_GET["type"] ) && in_array( $_GET["type"], $allowed_types ) ) {
            $type = $_GET["type"];
            $post_types = dci_get_post_types_grouped( $type );
            $query->set( 'post_type', $post_types );
        }
        // Ricerca in ordine alfabetico
        $query->set( 'orderby', 'post_title' );
        $query->set( 'order', 'ASC' );

        // Seleziono solo i tipi ricercabili
        $query->set( 'post_type', dci_get_sercheable_tipologie() );

        if ( isset( $_GET["post_types"] ) ) {
            $query->set( 'post_type', $_GET["post_types"] );

        }

        if ( isset( $_GET["post_terms"] ) ) {
            $taxquery = array(
                array(
                    'taxonomy' => 'argomenti',
                    'field' => 'id',
                    'terms' => $_GET["post_terms"]
                )
            );
        
            $query->set( 'tax_query', $taxquery );
        }

    }
}
add_action( 'pre_get_posts', 'dci_search_filters' );

/**
 * add favicon
 */
function dci_add_designers_italia_favicon() {

    $favicon_path = get_template_directory_uri() . '/assets/svg/it-designers-italia.svg';
    if (get_site_icon_url() === '')
        echo '<link rel="shortcut icon" href="' . esc_url($favicon_path) . '" />';
}
add_action( 'wp_head', 'dci_add_designers_italia_favicon' ); //front end
add_action( 'admin_head', 'dci_add_designers_italia_favicon' ); //admin end

/**
 * customize excerpt
 * @param $length
 *
 * @return int
 */
function dci_excerpt_length( $length ) {
    return 36;
}
add_filter( 'excerpt_length', 'dci_excerpt_length', 999 );

/**
 * Personalizzo archive title
 */
add_filter( 'get_the_archive_title', function ($title) {
global $wp_query;

    if ( is_tax("tipologia-articolo") ) {
        $title = single_term_title('', false);
    } elseif ( is_tax("tipologia-documento") ) {
        $title = single_term_title('', false);
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title('', false);
    }

    $title = dci_pluralize_string($title);

    return $title;
});

/** add responsive class to table **/
function dci_bootstrap_responsive_table( $content ) {
    $content = str_replace( ['<table', '</table>'], ['<div class="table-responsive"><table class="table  table-striped table-bordered table-hover" ', '</table></div>'], $content );

    return $content;
}
add_filter( 'the_content', 'dci_bootstrap_responsive_table' );

/**
 * Customizzazione bottone header di Admin con simbolo wordpress & IT
 *
 */
function dci_admin_bar_customize_header() {
    global $wp_admin_bar;

    if ( current_user_can( 'read' ) ) {
        $about_url = self_admin_url( 'about.php' );
    } elseif ( is_multisite() ) {
        $about_url = get_dashboard_url( get_current_user_id(), 'about.php' );
    } else {
        $about_url = false;
    }

    $wp_admin_bar->add_menu(
        array(
            'id'     => 'design-comuni',
            'title' => '<span class="dci-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="30" viewBox="0 0 92 74"><g fill="#06C"><path d="M31.799 71.9V15.7h15.1V72h-15.1zM91.099 28.5h-13.8v23.1c0 2.3.1 3.8.2 4.8.1.9.5 1.7 1.2 2.4s1.8 1 3.3 1l8.6-.2.7 12c-5 1.1-8.9 1.7-11.5 1.7-6.8 0-11.4-1.5-13.8-4.6-2.5-3-3.7-8.6-3.7-16.8V0h15.1v15.6h13.8v12.9zM9.099 32.8c-2.6 0-4.8-.9-6.5-2.7s-2.6-4-2.6-6.6.9-4.8 2.5-6.6c1.7-1.8 3.9-2.6 6.5-2.6s4.8.9 6.5 2.7 2.5 4 2.5 6.7-.8 4.8-2.5 6.6c-1.6 1.6-3.7 2.5-6.4 2.5z"></path></g></svg></span><span class="screen-reader-text">' . __( 'About Design Comuni' ) . '</span>',
            'href'   => '#'
        )
    );

    $wp_admin_bar->add_group(
        array(
            'parent' => 'design-comuni',
            'id'     => 'design-comuni-external',
            'meta'   => array(
                'class' => 'ab-sub-secondary',
            ),
        )
    );

    $wp_admin_bar->add_menu(
        array(
            'parent' => 'design-comuni-external',
            'id'     => 'dci-about-design',
            'title'  => __( 'About Design Comuni' ),
            'href'   => 'https://designers.italia.it/modello/comuni/',
            'meta'  => array( 'target' => '_blank')
        )
    );

    $wp_admin_bar->add_menu(
        array(
            'parent' => 'design-comuni',
            'id'     => 'dci-about-wp',
            'title'  => __( 'About WordPress' ),
            'href'   => $about_url,
        )
    );

    $wp_admin_bar->add_menu(
        array(
            'parent' => 'design-comuni',
            'id'     => 'dci-github',
            'title'  => __( 'Design Comuni su GitHub' ),
            'href'   => "https://github.com/italia/design-comuni-wordpress-theme",
            'meta'  => array( 'target' => '_blank')
        )
    );

    if(current_user_can("manage_options")){
        $wp_admin_bar->add_menu(
            array(
                'id'     => 'design-comuni-conf',
                'title' => __( '<div class="dashicons-before dashicons-admin-tools" style="float:left; padding-top: 6px; padding-right:4px;"> </div>Configurazione', "design_comuni_italia" ),
                'href'   => admin_url("admin.php?page=homepage")
            )
        );
    }

}
add_action( 'admin_bar_menu', 'dci_admin_bar_customize_header', -10 );

/**
 * rimuovo wp-logo
 */
function dci_admin_bar_before_customize_header(){
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu("wp-logo");
}
add_action( 'wp_before_admin_bar_render', 'dci_admin_bar_before_customize_header', -10 );

/**
 * rimuovo customizer (customize.php)
 */
function dci_remove_customizer () {
    global $submenu;
    if ( isset( $submenu[ 'themes.php' ] ) ) {
        foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
            foreach ($menu_item as $value) {
                if (strpos($value,'customize') !== false) {
                    unset( $submenu[ 'themes.php' ][ $index ] );
                }
            }
        }
    }
}
//add_action( 'admin_menu', 'dci_remove_customizer');
function dci_before_admin_bar_render()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('customize');
}
//add_action( 'wp_before_admin_bar_render', 'dci_before_admin_bar_render' );

/**
 * abilito edit utenti agli admin di un netork multisite
 */
function dci_admin_users_caps( $caps, $cap, $user_id, $args ){

    foreach( $caps as $key => $capability ){

        if( $capability != 'do_not_allow' )
            continue;

        switch( $cap ) {
            case 'edit_user':
            case 'edit_users':
                $caps[$key] = 'edit_users';
                break;
            case 'delete_user':
            case 'delete_users':
                $caps[$key] = 'delete_users';
                break;
            case 'create_users':
                $caps[$key] = $cap;
                break;
        }
    }

    return $caps;
}
add_filter( 'map_meta_cap', 'dci_admin_users_caps', 1, 4 );
remove_all_filters( 'enable_edit_any_user_configuration' );
add_filter( 'enable_edit_any_user_configuration', '__return_true');

/**
 * Checks that both the editing user and the user being edited are
 * members of the blog and prevents the super admin being edited.
 */
function dci_edit_permission_check() {
    global $current_user, $profileuser;

    $screen = get_current_screen();

    $current_user = wp_get_current_user();

    if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
        if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
            wp_die( __( 'You do not have permission to edit this user.' ) );
        } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
            wp_die( __( 'You do not have permission to edit this user.' ) );
        }
    }

}
add_filter( 'admin_head', 'dci_edit_permission_check', 1, 4 );