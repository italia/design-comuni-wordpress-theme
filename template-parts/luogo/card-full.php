<?php
global $post;

$prefix = '_dci_luogo_';
$img = dci_get_meta('immagine', $prefix, $post->ID);
$descrizione = dci_get_meta('descrizione_breve', $prefix, $post->ID);
$tipi_luogo = get_the_terms($post->ID,'tipi_luogo');
?>

<div class="col-lg-6 col-xl-4">
    <div class="card-wrapper shadow-sm rounded cmp-list-card-img">
        <div class="card card-img no-after rounded">
            <div class="img-responsive-wrapper cmp-list-card-img__wrapper">
                <div class="img-responsive img-responsive-panoramic h-100">
                    <figure class="img-wrapper">
                        <?php dci_get_img($img, 'rounded-top img-fluid'); ?>
                    </figure>
                </div>
            </div>
            <div class="card-body">
                <div class="category-top cmp-list-card-img__body">
                    <?php 
                        $count = 1;
                        if ( is_array($tipi_luogo) && count($tipi_luogo) ) {
                        foreach ($tipi_luogo as $tipo_luogo) {
                    ?>
                        <?php echo $count == 1 ? '' : ' - '; ?>
                        <a class="text-decoration-none fw-bold cmp-list-card-img__body-heading-title"
                            href="<?php echo get_term_link($tipo_luogo->term_id); ?>"
                        >
                            <?php echo $tipo_luogo->name;?>
                        </a>
                    <?php ++$count; }} ?>
                </div>
                <h3 class="cmp-list-card-img__body-title u-main-primary">
                    <a class="text-decoration-none"
                        href="<?php echo get_permalink($post->ID); ?>"
                        data-element="live-category-link"
                    >
                        <?php echo $post->post_title ?>
                    </a>
                </h3>
                <p class="cmp-list-card-img__body-description">
                    <?php echo $descrizione; ?>
                </p>
                <a class="read-more t-primary text-uppercase cmp-list-card-img__body-link"
                    href="<?php echo get_permalink($post->ID); ?>"
                    aria-label="Leggi di più sulla pagina di <?php echo $post->post_title ?>"
                >
                    <span class="text">Leggi di più</span>
                    <span class="visually-hidden"></span>
                    <svg class="icon icon-primary icon-xs ml-10">
                        <use href="#it-arrow-right"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>