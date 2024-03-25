<?php 
    global $post;

        $description = dci_get_meta('descrizione_breve');
        if ($post->post_type == 'documento_pubblico') {
	        $ufficio_id = dci_get_meta('ufficio_responsabile', '_dci_documento_pubblico_', $post->ID)[0] ?? '';
	        $ufficio = get_post($ufficio_id);

	        $url_documento = dci_get_meta('url_documento', '_dci_documento_pubblico_', $post->ID) ?? '';
            $file_documento = dci_get_meta('file_documento', '_dci_documento_pubblico_', $post->ID);
            $link_documento = ($url_documento!='') ? $url_documento : $file_documento;
            //var_dump($link_documento);
        }
        if ($post->post_type == 'dataset') {
            $tipo = '';
            $arrdata = explode( '-', date('d-m-Y', dci_get_meta("data_modifica")));
        }
        else {
            $arrdata = explode( '-', dci_get_meta("data_protocollo") );
            $tipo = get_the_terms($post->term_id, 'tipi_documento')[0];
        }
        $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
?>

<div class="col-md-6 col-xl-4">
  <div class="card-wrapper border border-light rounded shadow-sm pb-0">
    <div class="card no-after rounded">
      <div class="">
        <div class="">
          <div class="card-body">
            <div class="categoryicon-top">
              <svg class="icon icon-sm" aria-hidden="true">
                <use href="#it-file"></use>
              </svg>
              <?php if ($tipo) { ?>
              <span class="text fw-semibold">
                <?php if ($post->post_type == "documento_pubblico") { ?>
                    <a class="text-decoration-none" href="<?php echo get_term_link($tipo->term_id); ?>"><?php echo $tipo->name; ?></a>
                <?php } else { ?>
                    <a href="<?php echo get_post_type_archive_link( 'dataset' ); ?>">Dataset</a>
                <?php } ?>
              </span>
              <?php } ?>
            </div>
            <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
              <h3 class="card-title h4"><?php echo the_title(); ?></h3>
            </a>
            <p class="text-secondary mb-0">
              <?php echo $description; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>