<?php
/* Template Name: Domande frequenti
 *
 * Domande frequenti template file
 *
 * @package Design_Comuni_Italia
 */
global $the_query, $load_posts, $load_card_type, $label, $label_no_more, $classes;

$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 20;
$load_posts = 10;
$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$args = array(
    's' => $query,
    'posts_per_page' => $max_posts,
    'post_type'      => 'domanda_frequente',
    'orderby'        => 'post_title',
    'order'          => 'ASC'
);
$the_query = new WP_Query( $args );
$faqs = $the_query->posts;

$description = dci_get_meta('descrizione','_dci_page_',$post->ID);

get_header();
?>
   <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <?php get_template_part("template-parts/common/breadcrumb"); ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-hero">
                        <section class="it-hero-wrapper bg-white align-items-start">
                            <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                                <h1 class="text-black hero-title" data-element="page-name">
                                    Domande frequenti
                                </h1>
                                <p class="titillium hero-text">
                                    <?php echo $description; ?>
                                </p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <form>
            <button type="submit" class="d-none"></button>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2 px-sm-3 mt-2">
                        <div class="cmp-input-search">
                            <div class="form-group autocomplete-wrapper">
                                <div class="input-group">
                                <label for="autocomplete-three" class="visually-hidden">
                                    Cerca nel sito
                                </label>
                                <input 
                                type="search" 
                                class="autocomplete form-control" 
                                placeholder="Cerca" 
                                id="autocomplete-three" 
                                name="search"
                                value="<?php echo $query; ?>"
                                data-bs-autocomplete="[]">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-3">
                                        Invio
                                    </button>
                                </div>
                                <span class="autocomplete-icon" aria-hidden="true">
                                <svg class="icon icon-sm"><use href="#it-search"></use></svg>
                                </div>
                                </span>              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2 px-0 px-sm-3">
                        <div class="cmp-accordion faq">
                            <div class="accordion" id="accordion-faq">    
                                <?php 
                                    $i = 0;
                                    foreach ($faqs as $post) {
                                        ++$i;
                                        get_template_part("template-parts/domanda-frequente/item");
                                    }
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 offset-lg-2 px-4 mt-40 mb-40 ">
                        <?php
                            $load_card_type = "domanda-frequente";
                            $label = "Carica altre domande";
                            $label_no_more = "Nessuna altra domanda";
                            $classes = "btn btn-outline-primary w-100 title-medium-bold";
                            get_template_part("template-parts/search/more-results");
                        ?>
                    </div>
                </div>       
            </div>     
        </form>

        <?php wp_reset_query(); ?>
        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>
      </main>
<?php
get_footer();
