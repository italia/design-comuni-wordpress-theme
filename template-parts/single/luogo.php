<?php
    global $luogo, $luoghi;
    $prefix = '_dci_luogo_';
    $indirizzo = dci_get_meta('indirizzo', $prefix, $luogo->ID);
?>

<div class="card-wrapper card-teaser-wrapper">
    <div class="card card-teaser shadow mt-3 rounded">
    <svg class="icon">
        <use xlink:href="#it-pin"></use>
    </svg>
    <div class="card-body">
        <h5 class="card-title">
            <a href="<?php echo get_permalink($luogo->ID); ?>" aria-label="Vai alla Pagina di <?php echo $luogo->post_title; ?>" title="Vai alla pagina di <?php echo $luogo->post_title; ?>">
                <?php echo $luogo->post_title; ?>
            </a>
        </h5>
        <div class="card-text">
        <p><?php echo $indirizzo; ?></p>
        <p class="mt-3">Ulteriori dettagli</p>
        </div>
    </div>
    </div>
</div>
<?php 
    $luoghi = array($luogo);
    get_template_part("template-parts/luogo/map"); 
?>