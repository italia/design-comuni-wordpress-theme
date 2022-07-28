<?php
    $argomenti = dci_get_terms_options('argomenti');
    $arr_ids = array_keys((array)$argomenti);

    $term_children = $arr_ids;

    $per_page = 9;
    $paged = get_query_var('paged');
    $total_pages = ceil(count($term_children) / $per_page);

    $current_page = ($paged ? $paged : 1);
    $offset = (($current_page - 1) * $per_page);

    $term_children = array_slice($term_children, $offset, $per_page);    
?>

<section id="tutti-gli-argomenti">
    <div class="section">
        <div class="section-content">
        <div class="row">
            <div class="col"><h3>Tutti gli argomenti</h3></div>
        </div>
        <div class="row mt-lg-4">
            <div class="col">
                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
                    <?php 
                        foreach ($term_children as $arg_id) {
                        $argomento = get_term_by('id', $arg_id, 'argomenti');
                        $icon = dci_get_term_meta('icona', "dci_term_", $argomento->term_id);
                    ?>
                        <div class="card card-teaser rounded shadow align-items-center">
                            <svg class="icon">
                                <use xlink:href="#<?php echo $icon ? $icon : 'it-info-circle'?>"></use>
                            </svg>
                            <div class="card-body">
                                <h5 class="card-title mb-0">
                                    <a href="<?php echo get_term_link( $argomento->term_id ); ?>">
                                        <?php echo $argomento->name; ?>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if ($total_pages > 1) { ?>
        <div class="row mt-lg-4">
            <div class="col">
            <nav
                class="pagination-wrapper justify-content-center"
            >
                <ul class="pagination">
                <?php if ($current_page != 1) { ?>
                <li class="page-item">
                    <a class="page-link" href="?paged=<?php echo $current_page - 1; ?>#tutti-gli-argomenti">
                        <svg class="icon icon-primary">
                            <use xlink:href="#it-chevron-left"></use>
                        </svg>
                        <span class="visually-hidden">Pagina precedente</span>
                    </a>
                </li>
                <?php } ?>
                <?php for ($i=1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item">
                        <a class="page-link" href="?paged=<?php echo $i; ?>#tutti-gli-argomenti" <?php echo $i == $current_page? 'aria-current="page"' : '' ?>><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <?php if ($current_page != $total_pages) { ?>
                <li class="page-item">
                    <a class="page-link" href="?paged=<?php echo $current_page + 1; ?>#tutti-gli-argomenti">
                        <span class="visually-hidden">Pagina successiva</span>
                        <svg class="icon icon-primary">
                            <use xlink:href="#it-chevron-right"></use>
                        </svg>
                    </a>
                </li>
                <?php } ?>
                </ul>
            </nav>
            </div>
        </div>
        <?php } ?>
        </div>
    </div>
</section>