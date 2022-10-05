<?php
/**
 * Definisce i campi custom degli user come persone
 */

/**
 * Definisce post type e tassonomie relative ai documenti
 */
//add_action( 'init', 'dci_register_user_terms');
function dci_register_user_terms()
{
    //TASSONOMIA TIPOLOGIA PERSONA
	$labels = array(
        'name'              => _x( 'Tipologie persona', 'taxonomy general name', 'design_comuni_italia' ),
        'singular_name'     => _x( 'Tipologia persona', 'taxonomy singular name', 'design_comuni_italia' ),
        'search_items'      => __( 'Cerca Tipologia persona', 'design_comuni_italia' ),
        'all_items'         => __( 'Tutte le Tipologie persona', 'design_comuni_italia' ),
        'edit_item'         => __( 'Modifica Tipologia persona', 'design_comuni_italia' ),
        'update_item'       => __( 'Aggiorna Tipologia persona', 'design_comuni_italia' ),
        'add_new_item'      => __( 'Aggiungi una Tipologia persona', 'design_comuni_italia' ),
        'new_item_name'     => __( 'Nuova Tipologia persona', 'design_comuni_italia' ),
        'menu_name'         => __( 'Tipologia persona', 'design_comuni_italia' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'tipologia-persona' ),
    );
    register_taxonomy( 'tipologia-persona', 'user' , $args );
}

//add_filter( 'gettext', 'dci_change_user_to_person' );
//add_filter( 'ngettext', 'dci_change_user_to_person' );

/*
 * Cambio label per caratterizzare gli utenti potenziati
 */
function dci_change_user_to_person( $translated )
{
	$translated = str_replace( 'Utenti', 'Utenti/Persone', $translated );
	$translated = str_replace( 'Users', 'Utenti/Persone', $translated );
    $translated = str_replace( 'Utente', 'Utente/Persona', $translated );
    $translated = str_replace( 'User', 'Utente/Persona', $translated );

    return $translated;
}

//add_action( 'admin_head-user-edit.php', 'dci_remove_user_profile_fields_with_css' );
//add_action( 'admin_head-profile.php',   'dci_remove_user_profile_fields_with_css' );

/**
 * Nascondo i campi inutili\
 */
function dci_remove_user_profile_fields_with_css() {
//Hide unwanted fields in the user profile
	$fieldsToHide = [
		'rich-editing',
		'admin-color',
		'comment-shortcuts',
		//'admin-bar-front',
		//'user-login',
		//'role',
		//'super-admin',
		//'first-name',
		//'last-name',
		//'nickname',
		//'display-name',
		//'email',
		//'description',
		//'pass1',
		//'pass2',
		//'sessions',
		//'capabilities',
		//'syntax-highlighting',
		'url'

	];

	//add the CSS
	foreach ($fieldsToHide as $fieldToHide) {
		echo '<style>tr.user-'.$fieldToHide.'-wrap{ display: none; }</style>';
	}

	//fields that don't follow the wrapper naming convention
	echo '<style>tr.user-profile-picture{ display: none; }</style>';

	//all subheadings
	echo '<style>#your-profile h2{ display: none; }</style>';
}



/**
 * Sostituisco gravatar con la foto utente
 */

function remove_avatar_from_users_list( $avatar ) {
    if (is_admin()) {
	    global $current_screen;
	    //	    if ( $current_screen->base == 'users' ) {
	    // todo: recuperare la thumb del profilo per mostrarla nella pagina di lista
		    $avatar = '';
		//	    }
    }
    return $avatar;
}
//add_filter( 'get_avatar', 'remove_avatar_from_users_list' );



/**
 * Crea i metabox dello user
 */
//add_action( 'cmb2_init', 'dci_add_persone_metaboxes' );
function dci_add_persone_metaboxes() {

	$prefix = '_dci_persona_';

	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'persona_box',
		'title'            => __( 'Persona', 'design_comuni_italia' ),
		// Doesn't output for user boxes
		'object_types'     => array( 'user' ),
		// Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user',
        //'new_user_section' => 'add-existing-user',
        // where form will show on new user page. 'add-existing-user' is only other valid option.
		'priority'     => 'hight',
	) );

    $cmb_user->add_field( array(
        'name'    => __( 'Tipologia', 'design_comuni_italia' ),
        'desc'    => __( 'tipologia Persona (es: Persona Politica )', 'design_comuni_italia' ),
        'id'      => $prefix . 'tipologia_persona',
        'type'    => 'pw_select',
        'options' => array(
            'default' => null,
            'Persona Politica' => 'Persona Politica',
            //eventuali altre tipologie di Persona
        )
    ) );



    $cmb_user->add_field( array(
		'name'    => __( 'Foto della Persona', 'design_comuni_italia' ),
		'desc'    => __( 'Inserire una fotografia che ritrae il soggetto descritto nella scheda', 'design_comuni_italia' ),
		'id'      => $prefix . 'foto',
		'type'    => 'file',
	) );

	$cmb_user->add_field( array(
        'id' => $prefix . 'incarichi',
        'name'        => __( 'Incarichi', 'design_comuni_italia' ),
        'desc' => __( 'Collegamenti con gli incarichi' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('incarico'),
    ) );

	$cmb_user->add_field( array(
        'id' => $prefix . 'organizzazioni',
        'name'    => __( 'Organizzazione *' ),
        'desc' => __( 'Le organizzazioni di cui fa parte (es. Consiglio Comunale; es. Sistemi informativi)' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('unita_organizzativa'),
		'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

	$cmb_user->add_field( array(
        'id' => $prefix . 'responsabile_di',
        'name'    => __( 'Responsabile di', 'design_comuni_italia' ),
        'desc' => __( 'Organizzazione di cui è responsabile.' , 'design_comuni_italia' ),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('unita_organizzativa'),
    ) );

	$cmb_user->add_field( array(
        'id' => $prefix . 'data_conclusione_incarico',
        'name'    => __( 'Data conclusione incarico', 'design_comuni_italia' ),
        'desc' => __( 'Data conclusione incarico.' , 'design_comuni_italia' ),
        'type'    => 'text_date',
    ) );

	$cmb_user->add_field( array(
        'id' => $prefix . 'competenze',
        'name'        => __( 'Competenze', 'design_comuni_italia' ),
        'desc' => __( 'Se Persona Politica, descrizione testuale del ruolo, comprensiva delle deleghe <br> OPPURE se Persona Amministrativa, descrizione dei compiti di cui si occupa la persona.' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_user->add_field( array(
        'id' => $prefix . 'deleghe',
        'name'        => __( 'Deleghe', 'design_comuni_italia' ),
        'desc' => __( 'Elenco delle deleghe a capo della persona' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

	$cmb_user->add_field( array(
        'id' => $prefix . 'biografia',
        'name'        => __( 'Biografia', 'design_comuni_italia' ),
        'desc' => __( 'Solo per Persona Politica: testo descrittivo che riporta la biografia della persona.' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

	$cmb_user->add_field( array(
        'name'       => __('Galleria di immagini', 'design_comuni_italia' ),
        'desc' => __( 'Solo per Persona Politica: gallery dell attività politica e istituzionale della persona.' , 'design_comuni_italia' ),
        'id'             => $prefix . 'gallery',
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
        'attributes'    => array(
            'data-conditional-id'     => $prefix.'tipologia_persona',
            'data-conditional-value'  => "Persona Politica",
        ),
    ) );

    $cmb_user->add_field( array(
        'id' => $prefix . 'punti_contatto',
        'name'        => __( 'Punti di contatto *', 'design_comuni_italia' ),
        'desc' => __( 'Telefono, mail o altri punti di contatto<br><a href="post-new.php?post_type=punto_contatto">Inserisci Punto di Contatto</a>' , 'design_comuni_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('punto_contatto'),
        'attributes'    => array(
            'required'    => 'required'
        ),
    ) );

    $cmb_user->add_field( array(
        'name'       => __('Curriculum Vitae', 'design_comuni_italia' ),
        'id'             => $prefix . 'curriculum_vitae',
        'type' => 'file',
    ) );

    $cmb_user->add_field( array(
        'id' => $prefix . 'situazione_patrimoniale',
        'name'        => __( 'Situazione patrimoniale', 'design_comuni_italia' ),
        'desc' => __( 'Solo per Persona Politica: situazione patrimoniale della persona' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

    $cmb_user->add_field( array(
        'id'             => $prefix . 'dichiarazione_redditi',
        'name' => __( 'Dichiarazione dei redditi' , 'design_comuni_italia' ),
        'desc'       => __('Obbligatorio per Persona che ha incarichi o cariche politiche: copia dell\'ultima dichiarazione dei redditi soggetti all\'imposta sui redditi delle persone fisiche Per il soggetto, il coniuge non separato e i parenti entro il secondo grado, ove gli stessi vi consentano (NB: dando eventualmente evidenza del mancato consenso) (NB: è necessario limitare, con appositi accorgimenti a cura dell\'interessato o della amministrazione, la pubblicazione dei dati sensibili)', 'design_comuni_italia' ),
        'type' => 'file_list',
    ) );

    $cmb_user->add_field( array(
        'id'             => $prefix . 'spese_elettorali',
        'name' => __( 'Spese elettorali' , 'design_comuni_italia' ),
        'desc'       => __('Obbligatorio per Persona che ha incarichi o cariche politiche:: dichiarazione concernente le spese sostenute e le obbligazioni assunte per la propaganda elettorale ovvero attestazione di essersi avvalsi esclusivamente di materiali e di mezzi propagandistici predisposti e messi a disposizione dal partito o dalla formazione politica della cui lista il soggetto ha fatto parte, con l\'apposizione della formula «sul mio onore affermo che la dichiarazione corrisponde al vero» (con allegate copie delle dichiarazioni relative a finanziamenti e contributi per un importo che nell\'anno superi 5.000 €)', 'design_comuni_italia' ),
        'type' => 'file_list',
    ) );

    $cmb_user->add_field( array(
        'id'             => $prefix . 'variazione_situazione_patrimoniale',
        'name' => __( 'Variazione situazione patrimoniale' , 'design_comuni_italia' ),
        'desc'       => __('Obbligatorio per Persona che ha incarichi o cariche politiche:: attestazione concernente le variazioni della situazione patrimoniale intervenute nell\'anno precedente e copia della dichiarazione dei redditi Per il soggetto, il coniuge non separato e i parenti entro il secondo grado, ove gli stessi vi consentano (NB: dando eventualmente evidenza del mancato consenso)', 'design_comuni_italia' ),
        'type' => 'file_list',
    ) );

    $cmb_user->add_field( array(
        'id'             => $prefix . 'altre_cariche',
        'name' => __( 'Altre cariche' , 'design_comuni_italia' ),
        'desc'       => __('Obbligatorio per Persona che ha incarichi o cariche politiche: i dati relativi all\'assunzione di altre cariche, presso enti pubblici o privati, ed i relativi compensi a qualsiasi titolo corrisposti.', 'design_comuni_italia' ),
        'type' => 'file_list',
    ) );



    $cmb_user->add_field( array(
        'id' => $prefix . 'ulteriori_informazioni',
        'name'        => __( 'Ulteriori informazioni', 'design_comuni_italia' ),
        'desc' => __( 'Ulteriori informazioni relative alla persona.' , 'design_comuni_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 10, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),
    ) );

}

/**
 * Funzione per recuperare gli user/persone da mostrare su cmb2
 * @param $query_args
 *
 * @return array
 */
function dci_get_cmb2_user( $query_args ) {

	$args = wp_parse_args( $query_args, array(
		'fields' => array( 'user_login' ),

	) );

	$users = get_users(  );

	$user_options = array();
	if ( $users ) {
		foreach ( $users as $user ) {
			$user_options[ $user->ID ] = $user->user_login;
		}
	}

	return $user_options;
}


/**
 * aggiungo js per condizionale parent
 */
//add_action( 'admin_print_scripts-user-edit.php', 'dci_utente_admin_script', 11 );
//add_action( 'admin_print_scripts-user-new.php', 'dci_utente_admin_script', 11 );
//add_action( 'admin_print_scripts-profile.php', 'dci_utente_admin_script', 11 );

function dci_utente_admin_script() {
		wp_enqueue_script( 'utente-admin-script', get_template_directory_uri() . '/inc/admin-js/persona.js' );
}
