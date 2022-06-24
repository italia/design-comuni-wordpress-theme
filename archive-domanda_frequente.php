<?php
/**
 * The template for displaying archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Design_Comuni_Italia
 */
global $the_query, $load_posts;

$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 20;
$load_posts = 10;
$args = array(
    's' => $_GET['search'],
    'posts_per_page' => $max_posts,
    'post_type'      => 'domanda_frequente',
    'orderby'        => 'post_title',
    'order'          => 'ASC'
);
$the_query = new WP_Query( $args );
$faqs = $the_query->posts;

get_header();
?>
   <main>
        <form>
            <button type="submit" class="d-none"></button>
            <div class="container" id="main-container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Domande frequenti</h1>              
                        <p class="subtitle-small">Elenco di risposte alle domande più frequenti raccolte dalle richieste di assistenza dei cittadini.</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-2 px-sm-3 mt-2">
                        <div class="cmp-input-search">
                            <div class="form-group autocomplete-wrapper">
                                <label for="autocomplete-three" class="visually-hidden">
                                    Cerca nel sito
                                </label>
                                <input 
                                type="search" 
                                class="autocomplete" 
                                placeholder="Cerca" 
                                id="autocomplete-three" 
                                name="search"
                                value="<?php echo $_GET['search']; ?>"
                                data-bs-autocomplete="[]">
                                <span class="autocomplete-icon" aria-hidden="true">
                                <svg class="icon icon-sm"><use href="#it-search"></use></svg>
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
                            <div class="accordion" id="">    
                                <?php 
                                    $i = 0;
                                    foreach ($faqs as $post) {
                                        ++$i;;                      
                                        $description = dci_get_meta('risposta');      
                                ?>
                                    <div class="accordion-item">
                                        <div class="accordion-header" id="headingfaq-<?php echo $i; ?>">
                                            <button class="accordion-button collapsed title-snall-semi-bold py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefaq-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapsefaq-<?php echo $i; ?>" aria-label="Approfondisci Come posso pagare una multa?">
                                                <div class="button-wrapper">
                                                <?php echo $post->post_title; ?>
                                                <div class="icon-wrapper">
                                                    <svg class="icon icon-xs me-1 icon-primary">
                                                    <use href="#" xlink:href="#"></use>
                                                    </svg>
                                                </div>
                                                </div>
                                            </button>
                                        </div>                    
                                        <div id="collapsefaq-<?php echo $i; ?>" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExamplefaq-1" role="region" aria-labelledby="headingfaq-<?php echo $i; ?>">
                                            <div class="accordion-body">                    
                                                <p class="mb-3">
                                                    <?php echo $description; ?>
                                                </p>
                                            </div>                            
                                        </div>
                                    </div>                            
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 offset-lg-2 px-4">
                        <?php 
                        if ($the_query->found_posts > $max_posts ) { 
                            $new_posts = intval($max_posts) + $load_posts; 
                        ?>
                            <button 
                                type="submit" 
                                data-bs-toggle="modal" 
                                data-bs-target="#" 
                                aria-label="Carica altre domande da consultare" 
                                class="btn btn-outline-primary w-100 mt-40 mb-40 title-medium-bold"
                                name="max_posts" 
                                value="<?php echo $new_posts; ?>"
                            >
                                <span class="">Carica altre domande</span>
                            </button>
                    <?php } else { ?>
                        <p class="text-center text-paragraph-regular-medium mt-40 mb-40">
                            Nessuna altra domanda
                        </p>
                    <?php } ?>
                    </div>
                </div>       
            </div>     
        </form>

        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>
      </main>
<?php
get_footer();
