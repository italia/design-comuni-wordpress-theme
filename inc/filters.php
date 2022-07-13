<?php

/**
 * filters url for post type Notizia (rewrite slug in tipologia_notizia.php)
 * @param $post_link
 * @param int $id
 * @return array|mixed|string|string[]
 */
function dci_tipi_notizia_post_link( $post_link, $id = 0 ){
    $post = get_post($id);
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'tipi_notizia' );
        if( $terms ){
            return str_replace( '%tipi_notizia%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}
//add_filter( 'post_type_link', 'dci_tipi_notizia_post_link', 1, 3 );


/**
 * filters url for post type Evento and Luogo (rewrite slug in tipologia_notizia.php)
 * @param $post_link
 * @param int $id
 * @return array|mixed|string|string[]
 */
function dci_vivere_il_comune_post_link( $post_link, $id = 0 ){
    $post = get_post($id);
    if ( is_object( $post ) ){
        $post_type = get_post_type($id);
        if( ($post_type == 'evento') || ($post_type == 'luogo') ){
            return str_replace( '%vivere-il-comune%' , 'vivere-il-comune' , $post_link );
        }
    }
    return $post_link;
}
add_filter( 'post_type_link', 'dci_vivere_il_comune_post_link', 1, 3 );