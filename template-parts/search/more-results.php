
<?php 
global $the_query, $load_posts, $wp_the_query, $load_card_type, $additional_filter,  $label, $label_no_more, $classes;

if (!$the_query) $the_query = $wp_query;
if (!$load_posts) $load_posts = 10;

//set default labels & classes
if (!$label) $label = 'Carica altri risultati';
if (!$label_no_more) $label_no_more = 'Nessun altro risultato';
if (!$classes) $classes = 'btn btn-outline-primary pt-15 pb-15 pl-90 pr-90 mb-30 mb-lg-50 full-mb text-button';

$query_params = json_encode($_GET);
$additional_filter = json_encode($additional_filter);

$query = $the_query->query;
$post_types = isset($query['post_type']) ? $query['post_type'] : null;
if ( !$post_types ) $post_types = dci_get_sercheable_tipologie();

$post_types = json_encode( $post_types );

$query_search = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$query_params = '?post_count='.$the_query->post_count.'&load_posts='.$load_posts.'&search='.$query_search.'&post_types='.$post_types.'&load_card_type='.$load_card_type.'&query_params='.$query_params.'&additional_filter='.$additional_filter;

if($the_query->post_count < $the_query->found_posts) {
?> 
<div class="d-flex justify-content-center mt-4" id="load-more-btn">
    <?php if(get_parent_template() === 'servizi.php') {
        ?><button type="button"
            class="<?php echo $classes; ?>" onclick='handleOnClick(`<?php echo $query_params; ?>`)'
            data-element="load-other-cards"
        >
    <?php } else {
        ?><button type="button"
            class="<?php echo $classes; ?>" onclick='handleOnClick(`<?php echo $query_params; ?>`)'
        >
    <?php } ?>

    <span class=""><?php echo $label; ?></span>
    </button> 
</div>
<p class="text-center text-paragraph-regular-medium mt-4 mb-0 d-none" id="no-more-results">
    <?php echo $label_no_more; ?>
</p>
<?php } else { ?>
<p class="text-center text-paragraph-regular-medium mt-4 mb-0" id="no-more-results">
    <?php echo $label_no_more; ?>
</p>
<?php } ?>

<!-- Pagination -->
<!-- <nav class="pagination-wrapper" aria-label="Navigazione della pagina">
    <?php #echo dci_bootstrap_pagination(); ?>
</nav> -->
