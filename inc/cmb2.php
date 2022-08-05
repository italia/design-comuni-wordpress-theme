<?php
/**
 * cmb2 field plugins
 */
require 'lib/CMB2/init.php';
require 'lib/CMB2-conditional-logic/cmb2-conditional-logic.php';
require 'lib/CMB2-field-Leaflet-Geocoder/cmb-field-leaflet-map.php';
require 'lib/cmb2-attached-posts/cmb2-attached-posts-field.php';
require 'lib/CMB2-taxonomy-hierarchy-child.php';

function asset_path_faiconselect() { // Fix for $asset_path issue for Icon field
    return get_template_directory_uri(). '/inc/lib/cmb2-field-type-font-awesome'; //Change to correct path.
}
add_filter( 'sa_cmb2_field_faiconselect_asset_path', 'asset_path_faiconselect' );
require 'lib/cmb2-field-type-font-awesome/iconselect.php';

add_filter( 'pw_cmb2_field_select2_asset_path', function ($var){return get_template_directory_uri().'/inc/lib/cmb-field-select2-master';});
require 'lib/cmb-field-select2-master/cmb-field-select2.php';

//Opzioni per i campi select dei metabox cmb2

/**
 * tutti gli Utenti/Persone
 * @param false $query_args
 * @return array
 */
function dci_get_user_options( $query_args = false) {

	if(!$query_args)
		$query_args['fields'] = array( 'ID', 'user_login' );

	$users = get_users( $query_args );

	$user_options = array();
	if ( $users ) {
		foreach ( $users as $user ) {
			$user_options[ $user->ID ] = $user->user_login;
		}
	}

	return $user_options;
}

/**
 * tutti i post di un dato tipo
 * @param string $post_type
 * @param false $parent
 * @param false $addnone
 * @return array
 */
function dci_get_posts_options( $post_type = 'post', $parent = false, $addnone=false) {

    if($parent)
        $posts = get_posts('post_type='.$post_type.'&posts_per_page=-1&orderby=title&order=ASC&post_parent=0');
    else
        $posts = get_posts('post_type='.$post_type.'&posts_per_page=-1&orderby=title&order=ASC');

    $options = array();
    if($addnone)
        $options[0]=__('Nessun contenuto','design_comuni_italia');
    if ( $posts ) {
        foreach ( $posts as $post) {
            $options[ $post->ID ] = $post->post_title;
        }
    }

    return $options;
}

/**
 * tutte le pagine
 * @param false $parent
 * @param false $addnone
 * @return array
 */
function dci_get_first_level_pages_options($addnone=false) {
    $pages = get_pages();
    $options = array();
    if($addnone)
        $options[0]=__('Nessuna pagina','design_comuni_italia');
    if ( $pages ) {
        foreach ( $pages as $page) {
            if($page-> post_parent == 0){
                $options[ $page->ID ] = $page->post_title;
            }
        }
    }
    return $options;
}

/**
 * tutte le pagine di secondo livello
 * @param $parent Pagina genitore
 */
function dci_get_children_pages_options($parent = '',$addnone=false) {
    if($parent !== ''){
        $page = get_page_by_title( $parent );
        $pages = get_pages(array('child_of'=>$page->ID));
    }
    else
        $pages = get_pages(array('child_of'=>0));//all pages
    if($addnone)
        $options[0]=__('Nessuna pagina','design_comuni_italia');
    if ( $pages ) {
        foreach ( $pages as $page) {
            $options[ $page->ID ] = $page->post_title;
        }
    }
    return $options;
}

/**
 * tutti i termini di una data tassonomia
 * @param $taxonomy_name
 * @param false $query_args
 * @return array
 */
function dci_get_terms_options( $taxonomy_name, $with_slug = false) {

    $terms = get_terms( array(
        'taxonomy' => $taxonomy_name,
        'hide_empty' => false,
    ));

    $options = array();

    if ($terms && $with_slug) {
        foreach ( $terms as $term ) {
            if ($term->slug != 'account')
                $options[ $term->slug ] = $term->name;
        }
    }

    if ( $terms && !$with_slug) {
        foreach ( $terms as $term ) {
            $options[ $term->term_id ] = $term->name;
        }
    }
    return $options;
}

/**
 * @param string $type
 * @return string[]
 */
function dci_get_bootstrap_icon_options($category = 'all'){
    $all =  array (
        'it-arrow-down'=> 'it-arrow-down',
        'it-arrow-down-circle'=> 'it-arrow-down-circle',
        'it-arrow-down-triangle'=> 'it-arrow-down-triangle',
        'it-arrow-left'=> 'it-arrow-left',
        'it-arrow-left-circle'=> 'it-arrow-left-circle',
        'it-arrow-left-triangle'=> 'it-arrow-left-triangle',
        'it-arrow-right'=> 'it-arrow-right',
        'it-arrow-right-circle'=> 'it-arrow-right-circle',
        'it-arrow-right-triangle'=> 'it-arrow-right-triangle',
        'it-arrow-up'=> 'it-arrow-up',
        'it-arrow-up-circle'=> 'it-arrow-up-circle',
        'it-arrow-up-triangle'=> 'it-arrow-up-triangle',
        'it-ban'=> 'it-ban',
        'it-bookmark'=> 'it-bookmark',
        'it-box'=> 'it-box',
        'it-burger'=> 'it-burger',
        'it-calendar'=> 'it-calendar',
        'it-camera'=> 'it-camera',
        'it-card'=> 'it-card',
        'it-chart-line'=> 'it-chart-line',
        'it-check'=> 'it-check',
        'it-check-circle'=> 'it-check-circle',
        'it-chevron-left'=> 'it-chevron-left',
        'it-chevron-right'=> 'it-chevron-right',
        'it-clip'=> 'it-clip',
        'it-clock'=> 'it-clock',
        'it-close'=> 'it-close',
        'it-close-big'=> 'it-close-big',
        'it-close-circle'=> 'it-close-circle',
        'it-code-circle'=> 'it-code-circle',
        'it-collapse'=> 'it-collapse',
        'it-comment'=> 'it-comment',
        'it-copy'=> 'it-copy',
        'it-delete'=> 'it-delete',
        'it-download'=> 'it-download',
        'it-error'=> 'it-error',
        'it-exchange-circle'=> 'it-exchange-circle',
        'it-expand'=> 'it-expand',
        'it-external-link'=> 'it-external-link',
        'it-file'=> 'it-file',
        'it-files'=> 'it-files',
        'it-flag'=> 'it-flag',
        'it-folder'=> 'it-folder',
        'it-fullscreen'=> 'it-fullscreen',
        'it-funnel'=> 'it-funnel',
        'it-hearing'=> 'it-hearing',
        'it-help'=> 'it-help',
        'it-help-circle'=> 'it-help-circle',
        'it-horn'=> 'it-horn',
        'it-inbox'=> 'it-inbox',
        'it-info-circle'=> 'it-info-circle',
        'it-key'=> 'it-key',
        'it-link'=> 'it-link',
        'it-list'=> 'it-list',
        'it-locked'=> 'it-locked',
        'it-mail'=> 'it-mail',
        'it-map-marker'=> 'it-map-marker',
        'it-map-marker-circle'=> 'it-map-marker-circle',
        'it-map-marker-minus'=> 'it-map-marker-minus',
        'it-map-marker-plus'=> 'it-map-marker-plus',
        'it-maximize'=> 'it-maximize',
        'it-maximize-alt'=> 'it-maximize-alt',
        'it-minimize'=> 'it-minimize',
        'it-minus'=> 'it-minus',
        'it-minus-circle'=> 'it-minus-circle',
        'it-more-actions'=> 'it-more-actions',
        'it-more-items'=> 'it-more-items',
        'it-note'=> 'it-note',
        'it-open-source'=> 'it-open-source',
        'it-pa'=> 'it-pa',
        'it-password-invisible'=> 'it-password-invisible',
        'it-password-visible'=> 'it-password-visible',
        'it-pencil'=> 'it-pencil',
        'it-piattaforme'=> 'it-piattaforme',
        'it-pin'=> 'it-pin',
        'it-plug'=> 'it-plug',
        'it-plus'=> 'it-plus',
        'it-plus-circle'=> 'it-plus-circle',
        'it-presentation'=> 'it-presentation',
        'it-print'=> 'it-print',
        'it-refresh'=> 'it-refresh',
        'it-restore'=> ' it-restore',
        'it-rss'=> 'it-rss',
        'it-rss-square'=> 'it-rss-square',
        'it-search'=> 'it-search',
        'it-settings'=> 'it-settings',
        'it-share'=> 'it-share',
        'it-software'=> 'it-software',
        'it-star-full'=> 'it-star-full',
        'it-star-outline'=> 'it-star-outline',
        'it-telephone'=> 'it-telephone',
        'it-tool'=> 'it-tool',
        'it-unlocked'=> 'it-unlocked',
        'it-upload'=> 'it-upload',
        'it-user'=> 'it-user',
        'it-video'=> 'it-video',
        'it-warning'=> 'it-warning',
        'it-warning-circle'=> 'it-warning-circle',
        'it-wifi'=> 'it-wifi',
        'it-zoom-in'=> 'it-zoom-in',
        'it-zoom-out'=> 'it-zoom-out',
        'it-behance' => 'it-behance',
        'it-facebook' => 'it-facebook',
        'it-facebook-square' => 'it-facebook-square',
        'it-flickr' => 'it-flickr',
        'it-flickr-square' => 'it-flickr-square',
        'it-github' => 'it-github',
        'it-instagram' => 'it-instagram',
        'it-linkedin' => 'it-linkedin',
        'it-linkedin-square' => 'it-linkedin-square',
        'it-medium' => 'it-medium',
        'it-medium-square' =>  'it-medium-square',
        'it-telegram' => 'it-telegram',
        'it-twitter' => 'it-twitter',
        'it-twitter-square' => 'it-twitter-square',
        'it-whatsapp' => 'it-whatsapp',
        'it-whatsapp-square' => 'it-whatsapp-square',
        'it-youtube' => 'it-youtube',
        'it-google' => 'it-google',
        'it-designers-italia'=>'it-designers-italia',
        'it-team-digitale'=>'it-team-digitale'
    );
    $social = array(
        'it-facebook' => 'it-facebook',
        'it-facebook-square' => 'it-facebook-square',
        'it-flickr' => 'it-flickr',
        'it-flickr-square' => 'it-flickr-square',
        'it-github' => 'it-github',
        'it-instagram' => 'it-instagram',
        'it-linkedin' => 'it-linkedin',
        'it-linkedin-square' => 'it-linkedin-square',
        'it-medium' => 'it-medium',
        'it-medium-square' =>  'it-medium-square',
        'it-telegram' => 'it-telegram',
        'it-twitter' => 'it-twitter',
        'it-twitter-square' => 'it-twitter-square',
        'it-whatsapp' => 'it-whatsapp',
        'it-whatsapp-square' => 'it-whatsapp-square',
        'it-youtube' => 'it-youtube',
        'it-google' => 'it-google',
        'it-behance' => 'it-behance',
    );
    $extra =array(
        'it-designers-italia'=>'it-designers-italia',
        'it-team-digitale'=>'it-team-digitale'
    );

    if($category == 'social'){
        return $social;
    }

    if ($category == 'extra'){
        return $extra;
    }

    if ($category == 'it-social'){
        return array_merge($extra,$social);
    }


    return $all;
}

/**
 * Tutte le label (al singolare) delle Tipologie del Sito dei Comuni Italiani (label in maiuscolo)
 * @return array
 */
function dci_get_tipologie_singular_labels(){
    $tipologie = dci_get_tipologie_names();
    $singular_labels = array();
    foreach($tipologie as $tipologia){
        $label = get_post_type_object( $tipologia )->labels->singular_name;
        $singular_labels [$tipologia] = $label;
    }
    return $singular_labels;
}



/**
 * bidirectional relation
 */

class dci_bidirectional_cmb2 {
	private $prefix;
	private $post_type_from;
	private $post_field_from;
	private $box_from;
	private $post_field_to;

	public function __construct ($prefix, $post_type_from, $post_field_from, $box_from, $post_field_to) {

		$this->prefix = $prefix;
		$this->post_type_from = $post_type_from;
		$this->post_field_from = $prefix.$post_field_from;
		$this->box_from = $prefix.$box_from;
		$this->post_field_to = $post_field_to;

		add_action( 'pre_post_update', array(&$this, 'get_old_values') );
		add_action( 'before_delete_post', array(&$this,'posts_delete') );
		add_action( 'cmb2_save_field_'.$this->post_field_from, array(&$this,'posts_bidirectional'), 10, 3 );
	}

	public function get_old_values( $post_ID ) {
		// check if post type is not a 'revision'. Otherwise the hook fires more than once.
		if ( $this->post_type_from === get_post_type( $post_ID ) ) {
			$old_values = get_post_meta( $post_ID, $this->post_field_from, true );
			// Retrieve a CMB2 instance
			$cmb = cmb2_get_metabox( $this->box_from );
			//$old_values = $cmb->get_field( '_cmb2_attached_posts_ids' )->escaped_value();
			$cmb->update_field_property($this->post_field_from, 'old_values', $old_values );
		}
	}

	public function posts_delete( $post_ID ) {
		if ( ! $unbind_posts = get_post_meta( $post_ID, $this->post_field_from, true ) ) {
			return;
		}
		foreach ( $unbind_posts as $value => $id ) {
			$post_values = get_post_meta( $id, $this->post_field_from, true );
			if(is_array($post_values)){
                $pos = array_search( $post_ID, $post_values );
                unset( $post_values[ $pos ] );
                update_post_meta( $id, $this->post_field_from, $post_values );
            }

		}
	}


    public function posts_bidirectional( $updated, $action, $field ) {
        if ( ! $updated ) {
            return;
        }
        // getting old values
        if(isset($field->args['old_values']))
            $old_values = $field->args['old_values'];
        // getting current post id
        $object_id = $field->object_id;
        // getting meta key
        $meta_key = $this->post_field_from;
        $meta_key_dest = $this->post_field_to;

        // getting new values from the Attached Posts field
        //$related_posts = $field->escaped_value();
        $related_posts = get_post_meta( $object_id, $meta_key, true );
        // update meta field for each selected post with current Post ID
        foreach ( (array) $related_posts as $post => $id ) {
            $field_ids = get_post_meta( $id, $meta_key_dest, true );
            if($field_ids == '')
                $field_ids = array();
            if ( is_array($field_ids) && in_array( $object_id ,$field_ids ) ) {
                continue;
            } else {
                $field_ids[] = $object_id;
            }
            update_post_meta( $id, $meta_key_dest, $field_ids );

        }
        // deleting removed relationships
        $unbind_posts = array();

        if ( ! empty( $related_posts ) && ! empty( $old_values ) ) {
            $unbind_posts = array_diff( $old_values, $related_posts );
        } elseif ( ! empty( $old_values ) ) {
            $unbind_posts = $old_values;
        }

        foreach ( (array) $unbind_posts as $value => $post_id ) {
            // check if there is no meta field by some reason
            if ( ! $post_values = get_post_meta( $post_id, $meta_key_dest, true ) ) {
                continue;
            }

            $pos = array_search( $object_id, $post_values );
            unset( $post_values[ $pos ] );
            update_post_meta( $post_id, $meta_key_dest, $post_values );
		}
	}
}

