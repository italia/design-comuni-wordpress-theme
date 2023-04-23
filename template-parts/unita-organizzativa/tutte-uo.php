<?php
global $the_query, $load_posts, $load_card_type, $tax_query;


$query = $_GET['search'] ?? null;

switch ($post->post_name){
	case 'aree-amministrative': $tipo_uo = 'area'; $descrizione = 'tutte le aree'; $max_posts = $_GET['max_posts'] ?? null;  $load_posts = null; break;
	case 'uffici': $tipo_uo = 'ufficio'; $descrizione = 'tutti gli uffici';  $max_posts = $_GET['max_posts'] ?? 10;  $load_posts = 10; break;
    case 'organi-di-governo': $tipo_uo = 'struttura politica'; $descrizione = 'tutti gli organi di governo';  $max_posts = $_GET['max_posts'] ?? 10;  $load_posts = 10; break;
}

$query = isset($_GET['search']) ? $_GET['search'] : null;
$tax_query = array(
	array (
		'taxonomy' => 'tipi_unita_organizzativa',
		'field' => 'slug',
		'terms' => $tipo_uo
	));
$args = array(
	's'         => $query,
	'post_type' => 'unita_organizzativa',
	'post_status' => 'publish',
	'orderby'        => 'post_title',
	'order'          => 'ASC',
	'tax_query' => $tax_query
);

$the_query = new WP_Query( $args );
$posts = $the_query->posts;

//    usort($posts, function($a, $b) {
//        return dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $b->ID) - dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $a->ID);
//    });
$posts = array_slice($posts, 0, $max_posts);

$args = array(
	's'                 => $query,
	'posts_per_page'    => $max_posts,
	'post_type' => 'unita_organizzativa',
	'post_status' => 'publish',
	'orderby'        => 'post_title',
	'order'          => 'ASC',
	'tax_query' => $tax_query
);

$the_query = new WP_Query( $args );


// Per selezionare i contenuti in evidenza tramite flag
// $post_types = dci_get_post_types_grouped('servizi');
// $servizi_evidenza = dci_get_highlighted_posts( $post_types, 10);

//Per selezionare i contenuti in evidenza tramite configurazione
//$servizi_evidenza = dci_get_option('servizi_evidenziati','servizi');
?>

<div class="bg-grey-card py-3">
    <form role="search" id="search-form" method="get" class="search-form">
        <button type="submit" class="d-none"></button>
        <div class="container">
            <h2 class="title-xxlarge mb-4 mt-5 mb-lg-10">
                Esplora <?= $descrizione ?>
            </h2>
            <div class="cmp-input-search">
                <div class="form-group autocomplete-wrapper mb-2 mb-lg-4">
                    <div class="input-group">
                        <label for="autocomplete-two" class="visually-hidden">Cerca una parola chiave</label>
                        <input
                                type="search"
                                class="autocomplete form-control"
                                placeholder="Cerca una parola chiave"
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
                        <span class="autocomplete-icon" aria-hidden="true">
                            <svg class="icon icon-sm icon-primary" role="img" aria-labelledby="autocomplete-label">
                            <use href="#it-search"></use></svg>
                        </span>
                    </div>
                </div>
                <p id="autocomplete-label" class="mb-4">
                    <strong><?php echo $the_query->found_posts; ?> </strong>risultati in ordine alfabetico
                </p>
            </div>
            <div  class="row g-2" id="load-more">
				<?php
				foreach ($posts as $post) {
					$load_card_type = 'unita-organizzativa';
					get_template_part( 'template-parts/unita-organizzativa/cards-list' );
				}
				?>
            </div>
			<?php
			get_template_part("template-parts/search/more-results");
			?>
        </div>
    </form>
</div>