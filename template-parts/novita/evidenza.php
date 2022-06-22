<?php
    global $post, $posts;
    // Per selezionare i contenuti in evidenza tramite flag
    // $post_types = dci_get_post_types_grouped('novita');
    // $contenuti_evidenza = dci_get_highlighted_posts( $post_types, 3);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $contenuti_evidenza = dci_get_option('contenuti_evidenziati','novita');

    if (is_array($contenuti_evidenza) && count($contenuti_evidenza)) {
?>

<h2 class="title-xxlarge mt-70 mb-4 mt-lg-40 pt-lg-2 mb-lg-40">
    Notizie in evidenza
</h2>
<div class="row cmp-list-card-img cmp-list-card-img-hr g-4 align-items-stretch pb-60">
    <?php 
        $posts = $contenuti_evidenza; 
        get_template_part('template-parts/novita/cards-list');
    ?>
</div>
<?php } ?>