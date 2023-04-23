<?php
global $post;

$description = dci_get_meta( 'descrizione_breve' );
if ( $post->post_type == 'documento_pubblico' ) {
	$ufficio_id = dci_get_meta( 'ufficio_responsabile', '_dci_documento_pubblico_', $post->ID )[0] ?? '';
	$ufficio    = get_post( $ufficio_id );

	$url_documento  = dci_get_meta( 'url_documento', '_dci_documento_pubblico_', $post->ID ) ?? '';
	$file_documento = dci_get_meta( 'file_documento', '_dci_documento_pubblico_', $post->ID );
	$link_documento = ( $url_documento != '' ) ? $url_documento : $file_documento;
}
if ( $post->post_type == 'dataset' ) {
	$tipo    = '';
	$arrdata = explode( '-', date( 'd-m-Y', dci_get_meta( "data_modifica" ) ) );
} else {
	$arrdata = explode( '-', dci_get_meta( "data_protocollo" ) );
	$tipo    = get_the_terms( $post->term_id, 'tipi_documento' )[0];
}
$monthName = date_i18n( 'M', mktime( 0, 0, 0, $arrdata[1], 10 ) );
$img       = dci_get_meta( 'immagine' );
if ( $img ) {
	?>
    <div class="col-md-6 col-xl-4">
        <div class="card-wrapper border border-light rounded shadow-sm cmp-list-card-img cmp-list-card-img-hr">
            <div class="card no-after rounded">
                <div class="row g-2 g-md-0 flex-md-column">
                    <div class="col-4 order-2 order-md-1">
						<?php dci_get_img( $img, 'rounded-top img-fluid img-responsive' ); ?>
                    </div>
                    <div class="col-8 order-1 order-md-2">
                        <div class="card-body">
                            <div class="category-top cmp-list-card-img__body">
								<?php if ( $tipo ) { ?>
                                    <span class="category cmp-list-card-img__body-heading-title underline"><?php echo $tipo->name ? strtoupper( $tipo->name ) : 'DATASET'; ?></span>
								<?php } ?>
                                <span class="data"><?php echo $arrdata[0] . ' ' . $monthName . ' ' . $arrdata[2] ?></span>
                            </div>
                            <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
                                <h3 class="h5 card-title"><?php echo the_title(); ?></h3>
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
<?php } else { ?>
    <div class="col-md-6 col-xl-4">
        <div class="card-wrapper border border-light rounded shadow-sm cmp-list-card-img cmp-list-card-img-hr">
            <div class="card no-after rounded">
                <div class="row g-2 g-md-0 flex-md-column">
                    <div class="col-12 order-1 order-md-2">
                        <div class="card-body card-img-none rounded-top">
                            <div class="category-top cmp-list-card-img__body">
                                <span class="category cmp-list-card-img__body-heading-title underline"><?php
	                                echo isset( $tipo->name ) ? strtoupper( $tipo->name ) : 'DATASET'; ?>
                                </span>
                                <span class="data"><?php echo $arrdata[0] . ' ' . strtoupper( $monthName ) . ' ' . $arrdata[2] ?></span>
                            </div>
                            <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
                                <h3 class="h5 card-title"><?php echo the_title(); ?></h3>
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
<?php } ?>
<!--
<a href="<?php /*echo get_permalink(); */ ?>" class="list-group-item" aria-current="true">
    <div class="d-flex w-100 justify-content-between">
        <h6 class="mb-1"><?php /*the_title() */ ?></h6>
        <small><span class="data"><?php /*echo $ufficio->post_title ?? ''; */ ?> | <?php /*echo $arrdata[0].' '.$monthName.' '.$arrdata[2] */ ?></span></small>
    </div>
    <div class="d-flex w-100 justify-content-between">
        <p><?php /*echo $description; */ ?></p>
        <small><span class="data"></span></small>
    </div>

</a>-->
