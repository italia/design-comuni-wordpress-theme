<?php


add_action( 'wp_enqueue_scripts', 'load_more_script' );
function load_more_script() {
	global $wp_query, $the_query, $wp_the_query;

    wp_enqueue_script( 'dci-load_more', get_template_directory_uri() . '/assets/js/load_more.js', array('jquery'), null, true );
    $variables = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'posts' => json_encode( $wp_query->query_vars ), 
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages,
    );
    wp_localize_script('dci-load_more', "data", $variables);
}

function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

// load more posts
add_action("wp_ajax_load_more" , "load_more");
add_action("wp_ajax_nopriv_load_more" , "load_more");
function load_more(){
	global $wp_query, $servizio, $i, $hide_categories;
	
    // prepare our arguments for the query
	$load_card_type = $_POST['load_card_type'];
	$post_types = json_decode( stripslashes( $_POST['post_types'] ), true );
	$url_query_params =  json_decode( stripslashes( $_POST['query_params'] ), true );
	$additional_filter =  json_decode( stripslashes( $_POST['additional_filter'] ), true );

	$args = array(
        's' => $_POST['search'],
        'posts_per_page' => $_POST['post_count'] + $_POST['load_posts'],
        'post_type'      => $post_types,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
	
	if ( $post_types != "notizia" ) {
		$args = array(
			's' => $_POST['search'],
	    'posts_per_page' => $_POST['post_count'] + $_POST['load_posts'],
	    'post_type'      => $post_types,
			'orderby' => 'post_title',
			'order'   => 'ASC'
		);
	}

	if ( isset($url_query_params["post_terms"]) ) {
		$taxquery = array(
			array(
				'taxonomy' => 'argomenti',
				'field' => 'id',
				'terms' => $url_query_params["post_terms"]
			)
		);
	
		$args['tax_query'] = $taxquery;
	}
	if ( isset($url_query_params["post_types"]) ) $args['post_type'] = $url_query_params["post_types"];
	if ( isset($url_query_params["s"]) ) $args['s'] = $url_query_params["s"];
	if ( isset($additional_filter) ) $args = $args + $additional_filter;
 
	// it is always better to use WP_Query but not here
	$new_query = query_posts( $args );

	$out = '';
    if( have_posts() ) :
		
		$i = 0;
		// run the loop
		while( have_posts() ): the_post();
		$post = get_post();
		++$i;

		if ($load_card_type == "servizio"){
			$servizio = $post;
			$out .= load_template_part("template-parts/servizio/card");  
		}
		if ($load_card_type == "categoria_servizio"){
			$servizio = $post;
			$hide_categories = true;
			$out .= load_template_part("template-parts/servizio/card");  
		}
		if ($load_card_type == "notizia"){
			$out .= load_template_part("template-parts/novita/cards-list");  
		}
		if ($load_card_type == "documento"){
			$out .= load_template_part("template-parts/documento/cards-list");  
		}
		if ($load_card_type == "global-search"){
			$out .= load_template_part("template-parts/search/item");  
		}	
		if ($load_card_type == "domanda-frequente"){
			$out .= load_template_part("template-parts/domanda-frequente/item");  
		}	
 
		endwhile;
 
	endif;

	$res = array();
	$res['response'] = $out;
	$res['post_count'] = count($new_query);
	if ($wp_query->found_posts == count($new_query)) {
		$res['all_results'] = true;
	}
	$res = json_encode($res);
    wp_reset_postdata();
    die($res);
}