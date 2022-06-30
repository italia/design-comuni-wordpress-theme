<?php
    // Per selezionare i contenuti in evidenza tramite flag
    // $eventi = dci_get_highlighted_posts(['evento'], 6);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $eventi = dci_get_option('eventi_evidenziati','vivi');

    $url_eventi = get_permalink( get_page_by_title('Eventi') );
    if (is_array($eventi) && count($eventi)) {
?>

<div class="bg-grey-dsk">
    <div class="container p-3 p-md-5">
        <h2 class="title-xxlarge mb-40">Eventi in evidenza</h2>
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
                    data-bs-toggle="modal"
                    data-bs-target="#"
                    class="btn btn-primary px-5 py-3 full-mb"
                    label="Tutti gli eventi" 
                    buttonNext=true 
                    aria-label="Vedi tutti gli eventi"}}
                >
                    <span class="">Tutti gli eventi</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php } ?>