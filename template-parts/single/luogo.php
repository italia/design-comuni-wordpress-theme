<?php
global $luogo, $luoghi, $with_map;
$prefix = '_dci_luogo_';
$indirizzo = dci_get_meta('indirizzo', $prefix, $luogo->ID);
?>

<div class="row">
    <div class="col-xl-8 col-lg-12">
        <div class="card card-teaser shadow mt-3 rounded">
            <svg class="icon">
                <use xlink:href="#it-pin" aria-hidden="true"></use>
            </svg>
            <div class="card-body">
                <h3 class="card-title h5">
                    <a class="text-decoration-none" href="<?php echo get_permalink($luogo->ID); ?>">
                        <?php echo $luogo->post_title; ?>
                    </a>
                </h3>
                <div class="card-text">
                    <p><?php echo $indirizzo; ?></p>
                    <a href="<?php echo get_permalink($luogo->ID); ?>" class="mt-3">Ulteriori dettagli</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ( $with_map ?? null ) {
    $luoghi = array($luogo);
    get_template_part("template-parts/luogo/map");
}
?>
