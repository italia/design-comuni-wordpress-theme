<?php
global $post_id, $excerpt;

$post = get_post( $post_id );

$description = dci_get_meta( 'descrizione_breve' );
if ( $post->post_type == 'documento_pubblico' ) {
	$ufficio_id = dci_get_meta( 'ufficio_responsabile', '_dci_documento_pubblico_', $post->ID )[0] ?? '';
	$ufficio    = get_post( $ufficio_id );

	$url_documento  = dci_get_meta( 'url_documento', '_dci_documento_pubblico_', $post->ID ) ?? '';
	$file_documento = dci_get_meta( 'file_documento', '_dci_documento_pubblico_', $post->ID );
	$link_documento = ( $url_documento != '' ) ? $url_documento : $file_documento;
	//var_dump($link_documento);
}


$data_documento = dci_get_meta( "data_protocollo", '_dci_documento_pubblico_', $post->ID ) != "" ?
	dci_get_meta( "data_protocollo", '_dci_documento_pubblico_', $post->ID ) :
	dci_get_meta( "data_modifica", '_dci_documento_pubblico_', $post->ID );
$arrdata        = explode( '-', date( 'd-m-Y', strtotime( $data_documento ) ) );

if ( $post->post_type == 'dataset' ) {
	$tipo = '';
} else {
	$tipo = get_the_terms( $post_id, 'tipi_doc_albo_pretorio' )[0] ?? get_the_terms( $post_id, 'tipi_documento' )[0];
}

$monthName = date_i18n( 'M', mktime( 0, 0, 0, $arrdata[1], 10 ) );
$img       = dci_get_meta( 'immagine' );
?>


<div class="card no-after rounded shadow-sm h-100">
	<div class="row g-2">
		<?php if ( $img ) { ?>
			<div style="max-width: 150px;" class="col-auto h-100 p-2 order-1 d-flex flex-wrap align-items-center">
				<?php dci_get_img( $img, 'rounded-top img-fluid img-responsive' ); ?>
			</div>
		<?php } ?>

		<div class="col order-2">
			<div class="card-body">
				<div class="g-2">
					<div class="float-end">
						<a class="button button-link" href="<?= $link_documento ?>">
							<svg style="font-weight: bold;" fill="darkgreen" class="icon" viewBox="0 0 20 20">
								<use xlink:href="#it-download"></use>
							</svg>
						</a>
					</div>
					<div>
						<div class="category-top cmp-list-card-img__body">
							<?php if ( $tipo ) { ?>
								<span
									class="category cmp-list-card-img__body-heading-title underline"><?php echo $tipo->name ? $tipo->name : 'DATASET'; ?></span>
							<?php } ?>
							<span class="data"><?php echo $arrdata[0] . ' ' . $monthName . ' ' . $arrdata[1] ?></span>
						</div>
						<a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
							<h3 class="h5 card-title">
								<?php
								if ( ! $excerpt ?? null ) {
									echo the_title();
								} else {
									echo wp_trim_words( get_the_title( $post_id ), 30 );
								}
								?>
							</h3>
						</a>
						<p class="card-text d-none d-md-block">
							<?php echo $description; ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
