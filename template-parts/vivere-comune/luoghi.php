<?php
    // Per selezionare i contenuti in evidenza tramite flag
    // $luoghi = dci_get_highlighted_posts(['luogo'], 6);

    //Per selezionare i contenuti in evidenza tramite configurazione
    $luoghi = dci_get_option('luoghi_evidenziati','vivi');

    $url_luoghi = get_permalink( get_page_by_title('Luoghi') );
    if (is_array($luoghi) && count($luoghi)) {
?>

<div class="container p-3 p-md-5">
    <h2 class="title-xxlarge mb-40">Luoghi in evidenza</h2>
    <div class="row cmp-list-card-img g-4">
        <?php
            foreach ($luoghi as $luogo_id) {
                $post = get_post($luogo_id);
                get_template_part("template-parts/luogo/card-full");
            }
        ?>
    </div>
    <div class="d-flex justify-content-end">
        <button
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#"
            class="btn btn-primary px-5 py-3 full-mb"
            onclick="location.href='<?php echo $url_luoghi; ?>'"
            label="Tutti i luoghi" 
            buttonNext=true 
            aria-label="Vedi tutti i luoghi"}}
        >
            <span class="">Tutti i luoghi</span>
        </button>
    </div>
</div>
<?php } ?>