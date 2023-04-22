<?php
global $the_query, $load_posts, $load_card_type, $tipo_documento;

$max_posts = $_GET['max_posts'] ?? 50;
$load_posts = 50;
$query = $_GET['search'] ?? '';



$orderBy = 'data_modifica';
$order = 'DESC';

if ($tipo_documento ?? null) {
    if ($tipo_documento->taxonomy == 'documento_pubblico' || $tipo_documento->taxonomy == 'documento') {
        $orderBy = 'data_protocollo';
    }
    $args = array(
        's'              => $query,
        'posts_per_page' => $max_posts,
        'post_type'      => array('documento_pubblico', 'documento', 'dataset'),
        'orderby'        => $orderBy,
        'order'          => $order,
        'tax_query' => array(
            array (
                'taxonomy' => $tipo_documento->taxonomy,
                'field' => 'term_id',
                'terms' => $tipo_documento->term_id,
            )
        ),
    );
} else {
    $args = array(
        's'              => $query,
        'posts_per_page' => $max_posts,
        'post_type'      => array( 'documento_pubblico', 'documento', 'dataset' ),
        'orderby'        => $orderBy,
        'order'          => $order,
    );
}
$the_query = new WP_Query( $args );

$posts = $the_query->posts;
?>


<div class="bg-grey-card py-5">
    <form role="search" id="search-form" method="get" class="search-form">
    <button type="submit" class="d-none"></button>
        <div class="container">
            <h2 class="title-xxlarge mb-4">
                Esplora i documenti
            </h2>
            <div>
                <div class="cmp-input-search">
                    <div class="form-group autocomplete-wrapper mb-0">
                        <div class="input-group">
                        <label for="autocomplete-two" class="visually-hidden"
                        >Cerca</label
                        >
                        <input
                        type="search"
                        class="autocomplete form-control"
                        placeholder="Cerca per parola chiave"
                        id="autocomplete-two"
                        name="search"
                        value="<?php echo $query; ?>"
                        data-bs-autocomplete="[]"
                        />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-3">
                                Invio
                            </button>
                        </div>
                        <span class="autocomplete-icon" aria-hidden="true"
                        ><svg
                            class="icon icon-sm icon-primary"
                            role="img"
                            aria-labelledby="autocomplete-label"
                        >
                            <use
                            href="#it-search"
                            ></use></svg></span>
                        </div>
                        <p
                        id="autocomplete-label"
                        class="u-grey-light text-paragraph-card mt-2 mb-4 mt-lg-3 mb-lg-40"
                        >
                        <?php echo $the_query->found_posts; ?> documenti trovati in ordine cronologico decrescente
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4" id="load-more">
                <?php 
                    $load_card_type = 'documento';
                    foreach ($posts as $post) {get_template_part('template-parts/documento/cards-list');
                }?>
            </div>
            <?php get_template_part("template-parts/search/more-results"); ?>
        </div>
    </form>
</div>