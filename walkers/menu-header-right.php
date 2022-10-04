<?php
/**
 * Nav Menu API: Menu_Header_Right_Walker class
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


class Menu_Header_Right_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li class='nav-item'>";

		$data_element = '';

		if ( !$item->url ) $item['url'] = '#';
		else if ( strpos($item->url, '/argomenti') ) $data_element="data-element='all-topics'";


		$output .= '<a class="nav-link" href="' . $item->url . '" '.$data_element.'>';
		if ($item->menu_order == $args->menu->count) {
			$output .= '<span class="fw-bold">'.$item->title.'</span>';
		} else {
			$output .= $item->title;
		}
		
		$output .= '</a>';
	}
}