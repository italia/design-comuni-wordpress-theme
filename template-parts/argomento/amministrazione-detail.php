<?php
    global $argomento;

    $posts = dci_get_grouped_posts_by_term( 'amministrazione' , 'argomenti', $argomento->slug, 3 );
?>
<section id="amministrazione">
    <div class="section pb-40 pt-40 pt-lg-80">
        <div class="container">
            <div class="row row-title border-bottom border-semi-dark">
                <div class="col-12 d-lg-flex justify-content-between">
                    <h3 class="u-grey-light mb-lg-3 title-large-semi-bold">
                        Amministrazione
                    </h3>
                </div>
            </div>
        <div>
            <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3 py-2 py-lg-3">
                <?php foreach ($posts as $post) { 
                    $description = dci_get_meta('descrizione_breve');
                    $img = dci_get_meta('immagine');    
                    $tipo_amministrazione = get_the_terms($post->ID, 'tipi_unita_organizzativa')[0];
                ?>
                    <div class="card card-teaser rounded border border-light <?php echo $img ?'card-teaser-image card-flex' : '' ?> ">
                        <div class="card-body d-flex">
                            <div class="col py-4 ps-4">
                                <div class="category-top">
                                    <a class="u-grey-light fw-semibold" href="<?php echo get_term_link($tipo_amministrazione->term_id); ?>" aria-label="Vai alla sezione <?php echo $tipo_amministrazione->name; ?>" title="Vai alla sezione <?php echo $tipo_amministrazione->name; ?>">
                                <?php echo $tipo_amministrazione->name; ?>
                            </a>
                                </div>
                                <h4 class="text-paragraph-medium u-grey-light">
                                    <a href="<?php echo get_permalink(); ?>" aria-label="Vai alla scheda <?php echo the_title(); ?>" title="Vai alla scheda <?php echo the_title(); ?>"><?php echo the_title(); ?></a>
                                </h4>
                                <p class="m-0 u-grey-light text-paragraph-card">
                                    <?php echo $description; ?>
                                </p>
                            </div>
                            <div class="card-image card-image-rounded card-bg-image" style='background-image: url("<?php echo $img; ?>");'></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-12 col-lg-3 offset-lg-9">
            <button 
                type="button" 
                class="btn btn-primary text-button w-100"
                onclick="location.href='<?php echo dci_get_template_page_url('page-templates/amministrazione.php'); ?>'"
                aria-label = "Vai alla pagina tutta l'amministrazione"
                title = "Vai alla pagina tutta l'amministrazione"
            >
                Tutta l’amministrazione
            </button>
            </div>
        </div>
        </div>
    </div>
</section>