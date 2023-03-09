<?php
    global $post;
    $argomenti_evidenza = dci_get_option('argomenti_evidenziati','argomenti');

    if (is_array($argomenti_evidenza) && count($argomenti_evidenza)) {
?>

<div class="container py-5">
    <h2 class="title-xxlarge mb-4">In evidenza</h2>
    <div class="row g-4">
        <?php foreach ($argomenti_evidenza as $arg_id) {
            $argomento = get_term_by('id', $arg_id, 'argomenti');
            $img = dci_get_term_meta('immagine', "dci_term_", $argomento->term_id);
        ?>
            <div class="col-sm-6 col-lg-4">
                <div class="it-grid-item-wrapper it-grid-item-overlay">
                    <a href="<?php echo get_term_link( $argomento->term_id ); ?>">
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
                    <div class="it-griditem-text-wrapper">
                        <h3><?php echo $argomento->name; ?></h3>
                    </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>