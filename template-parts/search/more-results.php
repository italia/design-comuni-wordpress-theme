
<?php 
global $the_query, $load_posts, $wp_the_query, $load_card_type, $additional_filter;

if (!$the_query) $the_query = $wp_query;
if (!$load_posts) $load_posts = 10;

$query_params = json_encode($_GET);
$additional_filter = json_encode($additional_filter);
console_log($additional_filter,'$additional_filter');

$query = $the_query->query;
$post_types = $query['post_type'];
if ( !$post_types ) $post_types = dci_get_sercheable_tipologie();

$post_types = json_encode( $post_types );

$query_params = '?post_count='.$the_query->post_count.'&load_posts='.$load_posts.'&search='.$_GET['search'].'&post_types='.$post_types.'&load_card_type='.$load_card_type.'&query_params='.$query_params.'&additional_filter='.$additional_filter;

if($the_query->post_count < $the_query->found_posts) {
?> 
<div class="d-flex justify-content-center mt-4" id="load-more-btn">
    <button type="button" class="btn btn-outline-primary pt-15 pb-15 pl-90 pr-90 mb-30 mb-lg-50 full-mb text-button" aria-label="Carica altri risultati" onclick='handleOnClick(`<?php echo $query_params; ?>`)'>
    <span class="">Carica altri risultati</span>
    </button>
</div>
<p class="text-center text-paragraph-regular-medium mt-4 mb-0 d-none" id="no-more-results">
    Nessun altro risultato
</p>
<?php } else { ?>
<p class="text-center text-paragraph-regular-medium mt-4 mb-0" id="no-more-results">
    Nessun altro risultato
</p>
<?php } ?>

<!-- Pagination -->
<!-- <nav class="pagination-wrapper" aria-label="Navigazione della pagina">
    <?php #echo dci_bootstrap_pagination(); ?>
</nav> -->
