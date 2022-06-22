<?php
    global $the_query, $load_posts;

    $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
    $load_posts = 3;
    $args = array(
        's' => $_GET['search'],
        'posts_per_page' => $max_posts,
        'post_type'      => 'servizio',
        'orderby'        => 'post_title',
        'order'          => 'ASC'
    );
    $the_query = new WP_Query( $args );

    $servizi = $the_query->posts;

    if (is_array($servizi) && count($servizi)) {
        // Per selezionare i contenuti in evidenza tramite flag
        // $post_types = dci_get_post_types_grouped('servizi');
        // $servizi_evidenza = dci_get_highlighted_posts( $post_types, 10);

        //Per selezionare i contenuti in evidenza tramite configurazione
        $servizi_evidenza = dci_get_option('servizi_evidenziati','servizi');
?>

<div class="bg-grey-card">
    <form role="search" id="search-form" method="get" class="search-form">
        <button type="submit" class="d-none"></button>
        <div class="container">
            <div class="row">
            <div class="col-12">
                <h2 class="title-xxlarge mb-4 mt-5 mb-lg-10">
                Esplora tutti i servizi
                </h2>
            </div>
            <div class="col-12 col-lg-8 pt-lg-50 pb-lg-50">
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper mb-0">
                        <label for="autocomplete-two" class="visually-hidden"
                        >Cerca una parola chiave</label
                        >
                        <input
                        type="search"
                        class="autocomplete"
                        placeholder="Cerca una parola chiave"
                        id="autocomplete-two"
                        name="search"
                        value="<?php echo $_GET['search']; ?>"
                        data-bs-autocomplete="[]"
                        />
                        <span class="autocomplete-icon" aria-hidden="true"
                        ><svg
                            class="icon icon-sm icon-primary"
                            role="img"
                            aria-labelledby="autocomplete-label"
                        >
                            <use
                            href="#it-search"
                            ></use></svg></span>
                        <p id="autocomplete-label" class="mt-2 mt-lg-3 mb-4">
                        <strong><?php echo $the_query->found_posts; ?> </strong>servizi trovati in ordine alfabetico
                        </p>
                    </div>
                </div>
                <?php foreach ($servizi as $servizio) { 
                    $prefix = '_dci_servizio_';
                    $categorie = get_the_terms($servizio->ID, 'categorie_servizio');
                    $descrizione_breve = dci_get_meta('descrizione_breve', $prefix, $servizio->ID);
                ?>
                <div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#" id="">
                    <div class="card drop-shadow px-4 pt-4 pb-4 rounded">
                        <div class="card-header border-0 p-0">
                            <?php if (is_array($categorie) && count($categorie)) {
                                $count = 1;
                                foreach ($categorie as $categoria) {
                                    echo $count == 1 ? '' : ' - ';
                                    echo '<a class="title-xsmall-bold mb-2 category text-uppercase" href="'.get_term_link($categoria->term_id).'" title="'.$categoria->name.'" aria-label="'.$categoria->name.'">';
                                    echo $categoria->name ;                                    
                                    echo '</a>';
                                    ++$count;
                                }
                            }                        
                            ?>
                        </div>
                        <div class="card-body p-0 my-2">
                        <h3 class="green-title-big t-primary mb-8">
                            <a href="<?php echo get_permalink($servizio->ID); ?>" aria-label="Vai al servizio <?php echo $servizio->post_title; ?>" title="Vai al servizio <?php echo $servizio->post_title; ?>"><?php echo $servizio->post_title; ?></a>
                        </h3>
                        <p class="text-paragraph">
                            <?php echo $descrizione_breve; ?>
                        </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php get_template_part("template-parts/search/more-results"); ?>
            </div>
            <?php if (is_array($servizi_evidenza) && count($servizi_evidenza)) { ?>
            <div class="col-12 col-lg-4 pt-30 pt-lg-5 ps-lg-5 order-first order-md-last">
                <div class="link-list-wrap">
                    <div class="title-xsmall-semi-bold">
                        <span>SERVIZI IN EVIDENZA</span>
                    </div>
                    <ul class="link-list t-primary">
                        <?php foreach ($servizi_evidenza as $servizio_id) { 
                            $post = get_post($servizio_id);    
                        ?>
                        <li class="mb-3 mt-3">
                            <a class="list-item ps-0 title-medium underline" href="<?php echo get_permalink($post->ID); ?>" aria-label="Vai al servizio <?php echo $post->post_title; ?>" title="Vai al servizio <?php echo $servizio->post_title; ?>">
                                <span><?php echo $post->post_title; ?></span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </form>
</div>
<?php } ?>