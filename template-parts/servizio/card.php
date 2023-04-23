<?php
global $post, $hide_categories;

$prefix            = '_dci_servizio_';
$categorie         = get_the_terms( $post->ID, 'categorie_servizio' );
$descrizione_breve = dci_get_meta( 'descrizione_breve', $prefix, $post->ID );

if ( $post->post_status == "publish" ) {
	?>
    <div class="card-wrapper border border-light rounded shadow-sm">
        <div class="card no-after rounded">
            <div class="row g-2 g-md-0 flex-md-column">
                <div class="col-12 order-1 order-md-2">
                    <div class="card-body card-img-none rounded-top">
                        <div class="category-top cmp-list-card-img__body">
                            <span class="category cmp-list-card-img__body-heading-title underline">
                                <?php if ( ! $hide_categories ) { ?>
                                    <span class="visually-hidden">Categoria:</span>
                                    <div class="card-header border-0 p-0">
                    <?php if ( is_array( $categorie ) && count( $categorie ) ) {
	                    $count = 1;
	                    foreach ( $categorie as $categoria ) {
		                    echo $count == 1 ? '' : ' - ';
		                    echo '<a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="' . get_term_link( $categoria->term_id ) . '">';
		                    echo $categoria->name;
		                    echo '</a>';
		                    ++ $count;
	                    }
                    }
                    ?>
                </div>
                                <?php } ?>
                            </span>
                        </div>
                        <h3 class="h5 card-title u-grey-light">
                            <a class="text-decoration-none" href="<?php echo get_permalink( $post->ID ); ?>"
                               data-element="service-link"><?php echo $post->post_title; ?></a>
                        </h3>
                        <p class="card-text d-none d-md-block">
							<?php echo $descrizione_breve; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


	<?php
}