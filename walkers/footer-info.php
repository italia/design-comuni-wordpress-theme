<?php
/**
 * Nav Menu API: Footer_Menu_Walker class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Custom class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */


class Footer_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li>";
		if ( !$item->url ) $item['url'] = '#';
		
		$data_element = '';
		// set data-elements
		if ( $item->title == 'Leggi le FAQ' ) $data_element="data-element='faq'";
		if ( $item->title == 'Segnalazione disservizio' ) $data_element="data-element='report-inefficiency'";
		if ( $item->title == 'Informativa privacy' ) $data_element="data-element='privacy-policy-link'";
		if ( $item->title == 'Dichiarazione di accessibilità' ) $data_element="data-element='accessibility-link'";
		if ( $item->title == 'Note legali' ) $data_element="data-element='legal-notes'";

		$output .= '<a href="' . $item->url . '" '.$data_element.'>';
		$output .= $item->title;		
		$output .= '</a>';
	}
}