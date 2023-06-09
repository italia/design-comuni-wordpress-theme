<?php
    global $post, $posts;
    // Per selezionare i contenuti in evidenza tramite flag
    // $post_types = dci_get_post_types_grouped('documenti-e-dati');
    // $contenuti_evidenza = dci_get_highlighted_posts( $post_types, 6);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $contenuti_evidenza = dci_get_option('contenuti_evidenziati','documenti');

    if (is_array($contenuti_evidenza) && count($contenuti_evidenza)) {
?>
<div class="container py-5">
    <h2 class="title-xxlarge mb-4">In evidenza</h2>
    <div class="row g-4">
        <?php foreach ($contenuti_evidenza as $post_id) { 
            $post = get_post($post_id);
            $description = dci_get_meta('descrizione_breve'); 
            if ($post->post_type == "documento_pubblico") {
                $tipo_documento = get_the_terms($post->ID, 'tipi_documento')[0];
            } 
        ?>
            <div class="col-sm-6 col-lg-4">
                <div class="card-wrapper rounded shadow-sm border border-light pb-0">
                    <div class="card bg-none no-after">
                        <div class="card-body">
                            <div class="categoryicon-top">
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use href="#it-file"></use>
                                </svg>
                                <span class="text fw-semibold">
                                <?php if ($post->post_type == "documento_pubblico") { ?>
                                    <a class="text-decoration-none" href="<?php echo get_term_link($tipo_documento->term_id); ?>"><?php echo $tipo_documento->name; ?></a>
                                <?php } else { ?>
                                    <a href="<?php echo get_post_type_archive_link( 'dataset' ); ?>">Dataset</a>
                                <?php } ?>
                                </span>
                            </div>
                            <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
                                <h3 class="card-title h4"><?php echo the_title(); ?></h3>
                            </a>
                            <p class="text-secondary mb-0"><?php echo $description; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>