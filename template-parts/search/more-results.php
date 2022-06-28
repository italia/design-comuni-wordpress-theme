
<?php 
global $the_query, $load_posts;

if (!$the_query) $the_query = $wp_query;
if (!$load_posts) $load_posts = 10;

$max_posts = $the_query->post_count;
if ($the_query->found_posts > $max_posts ) { 
    $new_posts = intval($max_posts) + $load_posts;    
?> 
<div class="d-flex justify-content-center mt-4">
    <button type="submit" class="btn btn-outline-primary pt-15 pb-15 pl-90 pr-90 mb-30 mb-lg-50 full-mb text-button" name="max_posts" value="<?php echo $new_posts; ?>" aria-label="Carica altri risultati">
    <span class="">Carica altri risultati</span>
    </button>
</div>
<?php } else { ?>
    <p class="text-center text-paragraph-regular-medium mt-4 mb-0">
        Nessun altro risultato
    </p>
<?php } 
$the_query = null;
?>

<!-- Pagination -->
<!-- <nav class="pagination-wrapper" aria-label="Navigazione della pagina">
    <?php #echo dci_bootstrap_pagination(); ?>
</nav> -->