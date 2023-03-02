<?php
    // Per selezionare i contenuti in evidenza tramite flag
    // $eventi = dci_get_highlighted_posts(['evento'], 6);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $eventi = dci_get_option('eventi_evidenziati','vivi');

    $url_eventi = get_permalink( get_page_by_title('Eventi') );
    if (is_array($eventi) && count($eventi)) {
?>

<div class="bg-grey-dsk py-5">
    <div class="container">
        <h2 class="title-xxlarge mb-4">Eventi in evidenza</h2>
        <div class="row g-4">
            <?php
                foreach ($eventi as $evento_id) {
                    $post = get_post($evento_id);
                    get_template_part("template-parts/evento/card-full");
                }
            ?>
            <div class="d-flex justify-content-end">
                <button
                    type="button"
                    class="btn btn-primary px-5 py-3 full-mb"
                    label="Tutti gli eventi" 
                    buttonNext=true
                    data-element="live-button-events"
                    onclick="location.href='/servizi-categoria/cultura-e-tempo-libero/';"
                >
                    <span class="">Tutti gli eventi</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>