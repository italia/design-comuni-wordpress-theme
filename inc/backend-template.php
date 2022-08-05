<?php
// includo i singoli file di template di backend
foreach (glob(get_template_directory() ."/inc/admin/*.php") as $filename)
{
	require $filename;
}

//includo comuni_config.php
require get_template_directory()."/inc/comuni_config.php";


//custom js icone bootstrap -- fontawsome icon picker
function dci_icon_script() {

    wp_register_script( 'dci-icon-script', get_template_directory_uri() . '/inc/admin-js/admin.js');
    wp_enqueue_script('dci-icon-script');

    $dci_data =   array( 'stylesheet_directory_uri' => get_template_directory_uri() );

    wp_localize_script( 'dci-icon-script', 'dci_data', $dci_data );



    //console_log(get_stylesheet_directory_uri() ,$dci_data);

}
add_action( 'admin_enqueue_scripts', 'dci_icon_script' );