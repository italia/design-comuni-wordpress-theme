<?php
global $video, $trascrizione;
?>

<div class="ratio ratio-16x9 my-4">
    <?php echo wp_oembed_get ($video); ?>
</div>
<?php if ($trascrizione) { ?>
<div class="accordion border-0 mb-4" id="videoTranscription">
    <div class="accordion-item">
        <div class="accordion-header" id="heading1c">
            <button class="accordion-button collapsed title-snall-semi-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1c" aria-expanded="true" aria-controls="collapse1c" aria-label="Trascrizione del video">
                <div class="button-wrapper d-flex">
                Trascrizione del video
                    <div class="icon-wrapper">
                        <svg class="icon icon-sm me-1 icon-primary">
                        <use href="#it-expand"></use>
                        </svg>
                    </div>
                </div>
            </button>
        </div>
        <div id="collapse1c" class="accordion-collapse collapse p-0" data-bs-parent="#videoTranscription" role="region" aria-labelledby="heading1c">
        <div class="accordion-body ps-0 pb-4">
            <p class="font-serif mb-0">
                <?php echo $trascrizione; ?>
            </p>
        </div>
        </div>
    </div>
</div>
<?php } ?>