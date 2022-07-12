<?php
    global $argomento;

    $posts = dci_get_grouped_posts_by_term( 'documenti-e-dati' , 'argomenti', $argomento->slug, 3 );
?>

<section id="documenti">
    <div class="pb-80 pt-40">
        <div class="container">
        <div class="row row-title ">
            <div class="col-12 ">
            <h3 class="u-grey-light border-bottom border-semi-dark pb-2 pb-lg-3 title-large-semi-bold">
                Documenti
            </h3>
            </div>
        </div>
        <div>
            <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3 py-2 py-lg-3">
                <?php foreach ($posts as $post) { 
                    $description = dci_get_meta('descrizione_breve');
                    $tipo_documento = get_the_terms($post->ID, 'tipi_documento')[0];
                ?>
                <div class="card card-teaser rounded border border-light">
                    <div class="card-body">
                        <div class="category-top">
                            <a class="u-main-primary fw-semibold" href="<?php echo get_term_link($tipo_documento->term_id); ?>" aria-label="Vai alla sezione <?php echo $tipo_documento->name; ?>" title="Vai alla sezione <?php echo $tipo_documento->name; ?>">
                                <?php echo $tipo_documento->name; ?>
                            </a>
                        </div>
                        <h4 class="text-paragraph-medium u-main-primary">
                            <a href="<?php echo get_permalink(); ?>" aria-label="Vai a <?php echo the_title(); ?>" title="Vai a <?php echo the_title(); ?>"><?php echo the_title(); ?></a>
                        </h4>
                        <p class="text-paragraph-card u-grey-light">
                            <?php echo $description; ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-12 col-lg-3 offset-lg-9">
            <button 
                type="button" 
                class="btn btn-primary text-button w-100"
                onclick="location.href='<?php echo dci_get_template_page_url('page-templates/documenti-e-dati.php'); ?>'"
                aria-label = "Vai alla pagina tutti i documenti"
                title = "Vai alla pagina tutti i documenti"
            >
            Tutti i documenti
            </button>
        </div>
        </div>
    </div>
</section>