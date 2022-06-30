<?php
    // Per selezionare i contenuti in evidenza tramite flag
    // $post_types = dci_get_post_types_grouped('amministrazione');
    // $posts_evidenza = dci_get_highlighted_posts( $post_types, 3);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $posts_evidenza = dci_get_option('notizia_evidenziata','amministrazione');

    if (is_array($posts_evidenza) && count($posts_evidenza)) {
?>

<div class="bg-grey-card">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="title-xxlarge mt-60 mb-4 mt-lg-80 mb-lg-40">
                In evidenza
                </h2>
                <div class="row flex-wrap justify-content-between gy-3 gy-lg-5 gx-lg-5 pb-3 pb-lg-60 align-items-stretch">
                    <?php foreach ($posts_evidenza as $post_id) { 
                        $post = get_post($post_id);
                    ?>
                    <div class="col-12 col-lg-4">
                        <div class="cmp-card-simple card-wrapper pb-0">
                            <div class="card shadow rounded">
                                <div class="card-body">
                                    <a href="<?php echo get_permalink($post->ID); ?>" aria-label="Vai all'argomento <?php echo $post->post_title; ?>" title="Vai all'argomento <?php echo $post->post_title; ?>" data-element="administration-element">
                                        <h3 class="card-title t-primary title-xlarge">
                                            <?php echo $post->post_title; ?>
                                        </h3>
                                    </a>
                                    <p class="titillium text-paragraph mb-4">
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
    </div>
</div>
<?php } ?>