<?php 
$categorie_servizio_names = dci_categorie_servizio_array();
?>

<div class="container py-5">
    <h2 class="title-xxlarge mb-4">Esplora per categoria</h2>
    <div class="row g-4">
        <?php foreach ($categorie_servizio_names as $categoria_servizio_name) {
            $args = array('post_type' => 'servizio',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorie_servizio',
                        'field' => 'name',
                        'terms' => $categoria_servizio_name,
                    ),
                ),
            );
            $servizi = get_posts($args);
            $categoria = get_term_by('name', $categoria_servizio_name, 'categorie_servizio');
            $url = get_term_link( $categoria->term_id, 'categorie_servizio');
        ?>
        <div class="col-md-6 col-xl-4">
            <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <a class="text-decoration-none" href="<?php echo $url; ?>" data-element="service-category-link">
                            <h3 class="card-title t-primary"><?php echo $categoria->name; ?></h3>
                        </a>
                        <p class="text-secondary mb-0">
                            <?php echo $categoria->description; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>