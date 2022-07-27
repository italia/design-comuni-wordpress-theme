<?php
 global $custom_class;

 if (!$custom_class) $custom_class = '';
?>

<div class="cmp-breadcrumbs <?php echo $custom_class; ?>" role="navigation">
  <?php
  if ( function_exists( 'breadcrumb_trail' ) ) {
    $args = array(
      'container'       => 'nav',
      'before'          => '',
      'after'           => '',
      'browse_tag'      => 'h2',
      'list_tag'        => 'ol',
      'item_tag'        => 'li',
      'show_on_front'   => true,
      'network'         => false,
      'show_title'      => true,
      'show_browse'     => false,
      'labels'          => array(
        'search'        => esc_html__( 'Ricerca','design_comuni_italia' ),
          ),
      'echo'            => true
    );
    breadcrumb_trail($args);
  }
  ?>
</div>