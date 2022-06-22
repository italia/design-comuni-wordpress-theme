<?php

/*
Plugin Name: CMB2 Field Type: Font Awesome
Plugin URI: https://github.com/serkanalgur/cmb2-field-faiconselect
GitHub Plugin URI: https://github.com/serkanalgur/cmb2-field-faiconselect
Description: Font Awesome icon selector for CMB2
Version: 1.4
Author: Serkan Algur
Author URI: https://wpadami.com/
License: GPLv3
*/

/**
 * Class IConSelectFA
 */

class CMBS_SerkanA_Plugin_IConSelectFA {


	const VERSION = '1.4';

	public function __construct() {
		add_filter( 'cmb2_render_faiconselect', array( $this, 'render_faiconselect' ), 10, 5 );
		add_filter( 'style_loader_tag', array( $this, 'sa_add_font_awesome_5_cdn_attributes' ), 10, 2 );
	}

	public function render_faiconselect( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		$this->Sesetup_my_cssjs( $field );

		if ( version_compare( CMB2_VERSION, '2.2.2', '>=' ) ) {
			$field_type_object->type = new CMB2_Type_Select( $field_type_object );
		}

		echo $field_type_object->select(
			array(
				'class'   => 'iconselectfa',
				'desc'    => $field_type_object->_desc( true ),
				'options' => '<option></option>' . $field_type_object->concat_items(),
			)
		);

	}

	public function Sesetup_my_cssjs( $field ) {
		$asset_path = apply_filters( 'sa_cmb2_field_faiconselect_asset_path', plugins_url( '', __FILE__ ) );

		$font_args        = $field->args( 'attributes', 'fatype' );
		$font_awesome_ver = $field->args( 'attributes', 'faver' );

		if ( $font_awesome_ver && $font_awesome_ver === 5 ) {
			wp_enqueue_style( 'fontawesome5', 'https://use.fontawesome.com/releases/v5.7.2/css/fontawesome.css', array( 'jqueryfontselector' ), self::VERSION, 'all' );
			wp_add_inline_style( 'fontawesome5', '.fip-icons-container i.fas{font-family: "Font Awesome 5 Free" !important;} .selected-icon i.fas{font-family: "Font Awesome 5 Free" !important;}' );
			wp_enqueue_style( 'fontawesome5solid', 'https://use.fontawesome.com/releases/v5.7.2/css/solid.css', array( 'jqueryfontselector' ), self::VERSION, 'all' );
			wp_enqueue_style( 'fontawesome5brands', 'https://use.fontawesome.com/releases/v5.7.2/css/brands.css', array( 'jqueryfontselector' ), self::VERSION, 'all' );
			wp_add_inline_style( 'fontawesome5brands', '.fip-icons-container i.fab{font-family: "Font Awesome 5 Brands" !important;} .selected-icon i.fab{font-family: "Font Awesome 5 Brands" !important;}' );
		} else {
			wp_enqueue_style( 'fontawesomeiselect', $asset_path . '/css/faws/css/font-awesome.min.css', array( 'jqueryfontselector' ), self::VERSION );
		}
			wp_enqueue_style( 'jqueryfontselectormain', $asset_path . '/css/css/base/jquery.fonticonpicker.min.css', array(), self::VERSION );
			wp_enqueue_style( 'jqueryfontselector', $asset_path . '/css/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css', array(), self::VERSION );
			wp_enqueue_script( 'jqueryfontselector', $asset_path . '/js/jquery.fonticonpicker.min.js', array( 'jquery' ), self::VERSION, true );
			wp_enqueue_script( 'mainjsiselect', $asset_path . '/js/main.js', array( 'jqueryfontselector' ), self::VERSION, true );
	}

	public function sa_add_font_awesome_5_cdn_attributes( $html, $handle ) {
		if ( 'fontawesome5' === $handle ) {
			return str_replace( "media='all'", "media='all' integrity='sha384-4aon80D8rXCGx9ayDt85LbyUHeMWd3UiBaWliBlJ53yzm9hqN21A+o1pqoyK04h+' crossorigin='anonymous'", $html );
		} elseif ( 'fontawesome5solid' === $handle ) {
			return str_replace( "media='all'", "media='all' integrity='sha384-r/k8YTFqmlOaqRkZuSiE9trsrDXkh07mRaoGBMoDcmA58OHILZPsk29i2BsFng1B' crossorigin='anonymous'", $html );
		} elseif ( 'fontawesome5brands' === $handle ) {
			return str_replace( "media='all'", "media='all' integrity='sha384-BKw0P+CQz9xmby+uplDwp82Py8x1xtYPK3ORn/ZSoe6Dk3ETP59WCDnX+fI1XCKK' crossorigin='anonymous'", $html );
		}

		return $html;
	}
}

function returnRayFaPre() {
	include 'predefined-array-fontawesome.php';
	return $fontAwesome;
}

function returnRayFapsa() {
	include 'predefined-array-fontawesome.php';

	$fa5a = array_combine( $fa5all, $fa5all );

	return $fa5a;
}


new CMBS_SerkanA_Plugin_IConSelectFA();
