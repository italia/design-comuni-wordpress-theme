<?php 
$categorie_servizio_names = dci_categorie_servizio_array();
?>

<div class="container">
    <h2 class="title-xxlarge mt-60 mt-lg-80 mb-lg-40">
        Esplora per categoria
    </h2>
    <div
        class="row flex-wrap justify-content-between gy-4 gy-lg-5 gx-lg-5 pb-3 pb-lg-60 align-items-stretch"
    >
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
        <div class="col-12 col-md-6 col-lg-4">
            <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <a  href="<?php echo $url; ?>" aria-label="Vai all'argomento <?php echo $categoria->name; ?>" title="Vai all'argomento <?php echo $categoria->name; ?>"><h3 class="card-title t-primary title-xlarge"><?php echo $categoria->name; ?></h3></a>
                        <p class="titillium text-paragraph mb-0">
                            <?php echo $categoria->description; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>