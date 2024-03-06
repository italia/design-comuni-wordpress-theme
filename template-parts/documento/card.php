<?php
global $documento, $file_documento;
?>
<div class="card card-teaser shadow-sm p-4s rounded border border-light flex-nowrap">
    <svg class="icon" aria-hidden="true"> 
        <use xlink:href="#it-clip"></use>
    </svg>
    <div class="card-body">
        <h5 class="card-title">
            <a class="text-decoration-none" href="<?php echo $file_documento; ?>" aria-label="Scarica il documento <?php echo $documento->post_title; ?>" title="Scarica il documento <?php echo $documento->post_title; ?>">
                <?php echo $documento->post_title; ?> (<?php echo getFileSizeAndFormat($file_documento);?>)
            </a>
        </h5>
        <div class="card-text">
            <p>
                <?php echo dci_get_meta('descrizione_breve','_dci_documento_pubblico_',$documento->ID); ?>
            </p>
        </div>
    </div>
</div>