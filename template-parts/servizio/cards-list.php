<?php
global $servizio, $hide_categories;

$prefix = '_dci_servizio_';
$tipo = get_the_terms($servizio->ID, 'categorie_servizio')[0];
$description = dci_get_meta('descrizione_breve', $prefix, $servizio->ID);
?>


<div class="col-md-6 col-xl-4">
    <div class="card-wrapper border border-light rounded shadow-sm cmp-list-card-img cmp-list-card-img-hr">
        <div class="card no-after rounded">
            <div class="row g-2 g-md-0 flex-md-column">
                <div class="col-12 order-1 order-md-2">
                    <div class="card-body card-img-none rounded-top">
                        <div class="category-top cmp-list-card-img__body">
                            <span class="category cmp-list-card-img__body-heading-title underline">
                                <?php echo strtoupper($tipo->name); ?>
                            </span>
                        </div>
                        <a class="text-decoration-none" href="<?php echo get_permalink($servizio->ID); ?>">
                            <h3 class="h5 card-title u-grey-light"><?php echo get_the_title($servizio->ID); ?></h3>
                        </a>
                        <p class="card-text d-none d-md-block">
                            <?php echo $description; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
