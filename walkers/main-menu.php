<?php
/**
 * Nav Menu API: Main_Menu_Walker class
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


class Main_Menu_Walker extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth=0, $args=[], $id=0) {
		$output .= "<li class='nav-item'>";
		$group = $args->current_group == 'documenti-e-dati' ? 'amministrazione' : $args->current_group;
		$active_class = '';
		if ($item->attr_title == $group) {
			$active_class = 'active';
		}
 
		if ($item->url && $item->url != '#') {
			$output .= '<a class="nav-link '.$active_class.'" href="' . $item->url . '" aria-label="Vai alla pagina ' . $item->title . '">';
		} else {
			$output .= '<span>';
		}
 
		$output .= $item->title;
 
		if ($item->url && $item->url != '#') {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}
	}
}