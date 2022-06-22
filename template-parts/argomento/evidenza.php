<?php
    global $post;
    $argomenti_evidenza = dci_get_option('argomenti_evidenziati','argomenti');

    if (is_array($argomenti_evidenza) && count($argomenti_evidenza)) {
?>

<h2 class="title-xxlarge mt-70 mb-4 mt-lg-40 pt-lg-2 mb-lg-40">In evidenza</h2>
<div class="row">
    <?php foreach ($argomenti_evidenza as $arg_id) {
        $argomento = get_term_by('id', $arg_id, 'argomenti');
        $img = dci_get_term_meta('immagine', "dci_term_", $argomento->term_id);
    ?>
        <div class="col-sm-6 col-lg-4 mb-4">
            <div class="it-grid-item-wrapper it-grid-item-overlay">
                <a href="<?php echo get_term_link( $argomento->term_id ); ?>" title="vai all'argomento - <?php echo $argomento->name; ?>" aria-label="vai all'argomento - <?php echo $argomento->name; ?>">
                <div class="img-responsive-wrapper">
                    <div class="img-responsive">
                        <div class="img-wrapper">
                            <?php if ($img) { ?>
                                <?php dci_get_img($img); ?>
                                <?php } else { ?>
                                    <img
                                    src="<?php echo esc_url( get_template_directory_uri()); ?>/assets/img/placeholder_grey.jpeg"
                                    alt="descrizione immagine"
                                    title="Image Title"
                                />
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <span class="it-griditem-text-wrapper">
                    <h3><?php echo $argomento->name; ?></h3>
                </span>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
<?php } ?>