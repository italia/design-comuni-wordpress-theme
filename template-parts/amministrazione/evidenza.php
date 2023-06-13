<?php
    // Per selezionare i contenuti in evidenza tramite flag
    // $post_types = dci_get_post_types_grouped('amministrazione');
    // $posts_evidenza = dci_get_highlighted_posts( $post_types, 3);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $posts_evidenza = dci_get_option('notizia_evidenziata','amministrazione');

    if (is_array($posts_evidenza) && count($posts_evidenza)) {
?>

<div class="bg-grey-card py-5">
    <div class="container">
        <h2 class="title-xxlarge mb-4">
        In evidenza
        </h2>
        <div class="row g-4">
            <?php foreach ($posts_evidenza as $post_id) { 
                $post = get_post($post_id);
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
                    <div class="card shadow-sm rounded">
                        <div class="card-body">
                            <a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>">
                                <h3 class="card-title t-primary">
                                    <?php echo $post->post_title; ?>
                                </h3>
                            </a>
                            <p class="text-paragraph mb-0">
                                <?php echo dci_get_meta('descrizione_breve'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>