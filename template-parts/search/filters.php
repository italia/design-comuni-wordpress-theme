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

<div class="col-lg-3 d-none d-lg-block scroll-filter-wrapper">
    <h2 class="visually-hidden" id="filter">filtri da applicare</h2>
    <fieldset>
        <legend class="h6 text-uppercase category-list__title">Tipologie</legend>
        <div class="categoy-list pb-4">
            <ul>
                <?php 
                    foreach ($tipologie as $type_slug) {
                        $tipologia = get_term_by('slug', $type_slug);

                        if ( isset( COMUNI_TIPOLOGIE[$type_slug] ) && isset( COMUNI_TIPOLOGIE[$type_slug]['plural_name'] ) ) {
                            $plural_name = COMUNI_TIPOLOGIE[$type_slug]['plural_name'];
                        } else if ( post_type_exists( $type_slug ) ) {
                            $plural_name = get_post_type_object( $type_slug )->labels->name;
                        }
                ?>
                <li>
                    <div class="form-check">
                        <div class="checkbox-body border-light py-3">
                        <input
                            type="checkbox"
                            name="post_types[]"
                            <?php if(in_array($type_slug, $post_types)) echo " checked "; ?>
                            onChange="this.form.submit()"                            
                            id="<?php echo $type_slug; ?>" 
                            value="<?php echo $type_slug; ?>" 
                        />
                        <label
                            for="<?php echo $type_slug; ?>" 
                            class="subtitle-small_semi-bold mb-0 category-list__list"
                            ><?php echo $plural_name; ?> 
                        </label>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </fieldset>    
    <fieldset>
        <legend class="h6 text-uppercase category-list__title">Argomenti</legend>
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
                                id="<?php echo $arg_id; ?>" 
                                name="post_terms[]" 
                                value="<?php echo $arg_id; ?>"
                                <?php if(in_array($arg_id, $post_terms)) echo " checked "; ?>
                                onChange="this.form.submit()"
                            />
                            <label 
                                for="<?php echo $arg_id; ?>" 
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
