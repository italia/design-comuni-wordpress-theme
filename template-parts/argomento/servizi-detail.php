<?php
    global $argomento;

    $posts = dci_get_grouped_posts_by_term( 'servizi' , 'argomenti', $argomento->slug, 3);
?>

<section id="servizi">
    <div class="pb-40 pt-40 pt-lg-80">
        <div class="container">
            <div class="row row-title">
                <div class="col-12">
                    <h3 class="u-grey-light border-bottom border-semi-dark pb-2 pb-lg-3 title-large-semi-bold">
                        Servizi
                    </h3>
                </div>
            </div>
            <div class="row mt-0 g-4">
                <?php foreach ($posts as $post) { 
                    $description = dci_get_meta('descrizione_breve');
                    $categoria_servizio = get_the_terms($post->ID, 'categorie_servizio')[0];
                ?>
                    <div class="col-lg-4">
                        <div class="card-teaser card-teaser-image card-flex rounded border border-light">
                            <div class="card-body d-flex justify-content-between">
                                <div class="teaser-content">
                                    <div class="category-top">
                                        <a class="text-decoration-none fw-semibold" href="<?php echo get_term_link($categoria_servizio->term_id); ?>"><?php echo $categoria_servizio->name; ?></a>
                                    </div>
                                        <h4 class="text-paragraph-medium">
                                            <a href="<?php echo get_permalink(); ?>" class="text-decoration-none"><?php echo the_title(); ?></a>
                                        </h4>
                                    <p class="m-0 u-grey-light text-paragraph-card"><?php echo $description; ?></p>
                                </div>
                            </div>
                        </div>          
                    </div>
                <?php } ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-lg-3 offset-lg-9">
                    <button 
                        type="button" 
                        class="btn btn-primary text-button w-100"
                        onclick="location.href='<?php echo dci_get_template_page_url('page-templates/servizi.php'); ?>'"
                    >
                        Tutti i servizi
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>