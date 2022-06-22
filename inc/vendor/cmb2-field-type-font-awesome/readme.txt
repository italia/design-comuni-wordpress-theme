=== CMB2 Field Type: Font Awesome ===
Contributors: kaisercrazy
Donate link: https://paypal.me/serkanalgur
Tags: font-awesome,cmb2,plugins,font awesome,font awesome 5,cmb2 fields
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.6
Tested up to: 5.2
Stable tag: trunk

Font Awesome icon selector for powerful custom metabox generator CMB2

== Description ==

Font Awesome icon selector for powerful custom metabox generator [CMB2](https://github.com/WebDevStudios/CMB2 "Custom Metaboxes and Fields for WordPress 2")

You can use as field type in CMB2 function file. Add a new field, set type to `faiconselect` and add font awesome icons to options (look Usage for examples). Plugin uses [jQuery Font Picker](https://codeb.it/fonticonpicker/) for creating a icon selector.

== Sample Usage ==
Detailed instructions on [Github ](https://github.com/serkanalgur/cmb2-field-faiconselect)

`
$cmb->add_field( array(
    'name' => __( 'Select Font Awesome Icon', 'cmb' ),
    'id'   => $prefix . 'iconselect',
    'desc' => 'Select Font Awesome icon',
    'type' => 'faiconselect',
    'options' => array(
	'fa fa-facebook' => 'fa fa-facebook',
	'fa fa-500px'  	 => 'fa fa-500px',
	'fa fa-twitter'	 => 'fa fa-twitter'
    )
) );
`

== Sample Usage With Font Awesome 5 ==

`
$cmb->add_field( array(
    'name' => __( 'Select Font Awesome Icon', 'cmb' ),
    'id'   => $prefix . 'iconselect',
    'desc' => 'Select Font Awesome icon',
    'type' => 'faiconselect',
    'options' => array(
        'fab fa-facebook' => 'fa fa-facebook',
        'fab fa-500px'  	 => 'fa fa-500px',
        'fab fa-twitter'	 => 'fa fa-twitter',
        'fas fa-address-book' => 'fas fa-address-book'
    ),
    'attributes' => array(
        'faver' => 5
    )
) );
`

== Installation ==

1. Upload `cmb2-field-type-font-awesome` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Selector

== Changelog ==

= Version 1.4 =
* Composer Support Added

= Version 1.3-beta =
* Test for Gutenberg
* Font Awesome 5 support added
* Code Fixes

= Version 1.2 =
* Version corrections and tests
* fontawesome & mainjs definition fix

= Version 1.1 =
* Group Field Problem Solved
* Icon Selector js updated to latest version

= Version 1.0 =
* Released

== Upgrade Notice ==
No need any changes
