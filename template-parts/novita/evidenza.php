<?php
    global $post, $posts;
    // Per selezionare i contenuti in evidenza tramite flag
    // $post_types = dci_get_post_types_grouped('novita');
    // $contenuti_evidenza = dci_get_highlighted_posts( $post_types, 3);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $contenuti_evidenza = dci_get_option('contenuti_evidenziati','novita');

    if (is_array($contenuti_evidenza) && count($contenuti_evidenza)) {
?>
<div class="container py-5">
    <h2 class="title-xxlarge mb-4">
        In evidenza
    </h2>
    <div class="row g-4">
        <?php 
            $posts = $contenuti_evidenza; 
            foreach ($posts as $post_id) {
                $post = get_post($post_id);
                get_template_part('template-parts/novita/cards-list');
            }
        ?>
    </div>
</div>
<?php } ?>