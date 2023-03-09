<?php

$tipologie = dci_get_sercheable_tipologie();

$argomenti = dci_get_terms_options('argomenti');
$arr_ids = array_keys((array)$argomenti);

$post_types = array();
if(isset($_GET["post_types"]))
    $post_types = $_GET["post_types"];

$post_terms = array();
if(isset($_GET["post_terms"]))
    $post_terms = $_GET["post_terms"];

?>

<div
class="modal it-dialog-scrollable fade categories-modal"
tabindex="-1"
role="dialog"
id="modal-categories"
aria-labelledby="modalrightTitle"
>
    <div class="modal-dialog modal-dialog-right" role="document">
        <div class="modal-content">
            <div class="modal-header py-3 mb-4">
                <h2 class="modal-title h5 no_toc" id="modalrightTitle">
                    <?php echo $wp_query->found_posts; ?> Risultati
                </h2>
                <button type="button" onclick="location.href='?s=<?php echo get_search_query(); ?>'">
                Rimuovi tutti i filtri
                </button>
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend class="h6 text-uppercase category-list__title">
                        Tipologie
                    </legend>
                    <div class="categoy-list pb-4">
                        <ul>
                            <?php 
                                foreach ($tipologie as $type_slug) {
                                    $tipologia = get_term_by('slug', $type_slug);
                            ?>
                            <li>
                                <div class="form-check">
                                    <div class="checkbox-body border-light py-3">
                                    <input
                                        type="checkbox"
                                        name="post_types[]"
                                        <?php if(in_array($type_slug, $post_types)) echo " checked "; ?>
                                        id="mobile-<?php echo $type_slug; ?>" 
                                        value="<?php echo $type_slug; ?>" 
                                        onclick="handleQueryParams('postTypes', '<?php echo $type_slug; ?>')"
                                    />
                                    <label
                                        for="mobile-<?php echo $type_slug; ?>" 
                                        class="subtitle-small_semi-bold mb-0 category-list__list"
                                        ><?php echo COMUNI_TIPOLOGIE[$type_slug]['plural_name']; ?>
                                        </label
                                    >
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="h6 text-uppercase category-list__title">
                        Argomenti
                    </legend>
                    <div class="categoy-list pb-4">
                        <ul>
                            <?php 
                                foreach ($arr_ids as $arg_id) {
                                $argomento = get_term_by('id', $arg_id, 'argomenti');
                                $slug = $argomento->slug;
                            ?>
                            <li>
                                <div class="form-check">
                                    <div class="checkbox-body border-light py-3">
                                        <input 
                                            type="checkbox" 
                                            id="mobile-<?php echo $arg_id; ?>" 
                                            name="post_terms[]" 
                                            value="<?php echo $arg_id; ?>"
                                            <?php if(in_array($arg_id, $post_terms)) echo " checked "; ?>
                                            onclick="handleQueryParams('postTerms', '<?php echo $arg_id; ?>')"
                                        />
                                        <label 
                                            for="mobile-<?php echo $arg_id; ?>" 
                                            class="subtitle-small_semi-bold mb-0 category-list__list"
                                        >
                                            <?php echo $argomento->name; ?>
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </fieldset>
            </div>
            <div class="modal-footer mt-3">
                <button
                class="btn btn-primary w-100"
                type="button"
                data-bs-dismiss="modal"
                aria-label="Filtra e chiudi finestra modale"
                onclick="goToResults()"
                >
                Vai ai risultati
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const postTypes = [];
    const postTerms = [];

    for (const param of urlSearchParams) {
        if (param[0] === 'post_types[]') postTypes.push(param[1]);
        if (param[0] === 'post_terms[]') postTerms.push(param[1]);
    }

    const queryParams = {postTypes,postTerms};

    const handleQueryParams = (key, value) => {
        if (queryParams[key]?.includes(value)) queryParams[key] = queryParams[key]?.filter(v => v !== value);
        else queryParams[key]?.push(value);
    };

    const goToResults = () => {
        let newQuery = '?s=<?php echo get_search_query(); ?>';
        for (const type of queryParams?.postTypes) {
            newQuery += `&post_types[]=${type}`;
        }
        for (const term of queryParams?.postTerms) {
            newQuery += `&post_terms[]=${term}`;
        }

        window.location.href = newQuery;
    }

    
</script>