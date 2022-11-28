<?php
global $video, $trascrizione;
?>
<div class="mb-4">
    <h3 class="h4">Video</h3>
    <div class="ratio ratio-16x9 my-4">
        <?php 
        if (wp_oembed_get($video) ) {
            echo wp_oembed_get($video); 
        } else { ?>
        <video width="320" height="240" controls>
            <source src="<?php echo $video;?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <?php } ?>
    </div>
    <?php if ($trascrizione) { ?>
    <div class="accordion border-0 mb-4" id="videoTranscription">
        <div class="accordion-item">
            <div class="accordion-header" id="heading1c">
                <button class="accordion-button collapsed title-snall-semi-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1c" aria-expanded="true" aria-controls="collapse1c">
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
</div>