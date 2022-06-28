# CMB2 Field Type: Font Awesome
#### Font Awesome Icon Selector for CMB2

## Description
Font Awesome icon selector for powerful custom metabox generator [CMB2](https://github.com/WebDevStudios/CMB2 "Custom Metaboxes and Fields for WordPress 2")

You can use as field type in CMB2 function file. Add a new field, set type to `faiconselect` and add font awesome icons to options (look Usage for examples). Plugin uses [jQuery Font Picker](https://codeb.it/fonticonpicker/) for creating a icon selector.

Plugin capable to use Font Awesome 4.7.0 or 5.7.2 (only Solid and Brands icons) for icons and selector.

### WordPress Plugin
You can download this plugin also here : [CMB2 Field Type: Font Awesome](https://wordpress.org/plugins/cmb2-field-type-font-awesome/)
or you can search as `CMB2 Field Type: Font Awesome` on your plugin install page.

### ScreenShot
![Image](screenshot-1.png?raw=true)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fserkanalgur%2Fcmb2-field-faiconselect.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fserkanalgur%2Fcmb2-field-faiconselect?ref=badge_shield)

## Usage

Download this repo and put files into `wp-content/plugins/` directory. When you enable plugin, you can use field type in CMB2.

Alternatively you can search `CMB2 Field Type: Font Awesome` on WordPress plugin directory.

Use `faiconselect` for type. For Example;

```php
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
  ```
  After that jQuery Font Picker plugin handle the select.

  Aslo you can use predefined array for Font Awesome. I created a function with this addon to use in `options_cb`. Function called as `returnRayFaPre`.

```php
$cmb->add_field( array(
    'name' => __( 'Select Font Awesome Icon', 'cmb' ),
    'id'   => $prefix . 'iconselect',
    'desc' => 'Select Font Awesome icon',
    'type' => 'faiconselect',
    'options_cb' => 'returnRayFaPre'
) );
```

## Usage From Template Folder

Download and place folder into your theme folder. You need to create a function for fixing asset path issue. Fore example;

```php
// Fix for $asset_path issue
function asset_path_faiconselect() {
    return get_template_directory_uri() . '/path/to/folder'; //Change to correct path.
}

add_filter( 'sa_cmb2_field_faiconselect_asset_path', 'asset_path_faiconselect' );

//Now call faiconselect
require get_template_directory() . '/path/to/folder/iconselect.php'; //Again Change to correct path.
```

This function solve assetpath issue for including javascript and css files.

## Usage With Font Awesome 5

You need two different options for activate Font Awesome 5. You will need to add an attribute. Also there is a function for predefined list of font-awesome :smile:

#### Standart Way

```php
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
  ```

This attribute needed for selecting right style files. If you don't add these attribute, you can not see icons.

#### Predefined Way

```php
$cmb->add_field( array(
    'name' => __( 'Select Font Awesome Icon', 'cmb' ),
    'id'   => $prefix . 'iconselect',
    'desc' => 'Select Font Awesome icon',
    'type' => 'faiconselect',
    'options_cb' => 'returnRayFapsa',
    'attributes' => array(
        'faver' => 5
    )
) );
  ```

As you can see we define an `options_cb` function named `returnRayFapsa`. This function create an array for options with `solid` and `brands` icons. Also you need `faver` attribute for Font Awesome 5.

That's All for now :smile: Contributions are welcome

## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fserkanalgur%2Fcmb2-field-faiconselect.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fserkanalgur%2Fcmb2-field-faiconselect?ref=badge_large)