<?php
/**
 * Archivio Tassonomia Categorie Servizio
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-taxonomies
 * @link https://italia.github.io/design-comuni-pagine-statiche/sito/servizi-categoria.html
 *
 * @package Design_Comuni_Italia
 */

global $the_query, $load_posts, $load_card_type, $servizio, $additional_filter, $title, $description, $data_element, $hide_categories;

$obj = get_queried_object();
$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
$load_posts = 3;
$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$args = array(
    's' => $query,
    'posts_per_page' => $max_posts,
    'post_type'      => 'servizio',
    'categorie_servizio' => $obj->slug,
    'orderby'        => 'post_title',
    'order'          => 'ASC'
);
$the_query = new WP_Query( $args );
$servizi = $the_query->posts;

$additional_filter = array();
$additional_filter['categorie_servizio'] = $obj->slug;

$amministrazione = dci_get_related_unita_amministrative();
$bandi = dci_get_related_bandi();

get_header();
?>
 <main>
    <?php 
      $title = $obj->name;
      $description = $obj->description;
      $data_element = 'data-element="page-name"';
      get_template_part("template-parts/hero/hero"); 
    ?>
  
    <div class="bg-grey-card">
      <form role="search" id="search-form" method="get" class="search-form">
          <button type="submit" class="d-none"></button>
          <div class="container">
            <div class="row ">
              <h2 class="visually-hidden">Esplora tutti i servizi</h2>
              <div class="col-12 col-lg-8 pt-30 pt-lg-50 pb-lg-50">
                <div class="cmp-input-search">
                  <div class="form-group autocomplete-wrapper mb-2 mb-lg-4">
                  <div class="input-group">
                  <label for="autocomplete-two" class="visually-hidden">Cerca una parola chiave</label>
                  <input type="search" 
                    class="autocomplete form-control" 
                    placeholder="Cerca una parola chiave"
                    id="autocomplete-two"
                    name="search"
                    value="<?php echo $query; ?>"
                    data-bs-autocomplete="[]">
                  <div class="input-group-append">
                      <button class="btn btn-primary" type="submit" id="button-3">
                          Invio
                      </button>
                  </div>
                  <span class="autocomplete-icon" aria-hidden="true">
                    <svg class="icon icon-sm icon-primary" role="img" aria-labelledby="autocomplete-label"><use href="#it-search"></use></svg>
                  </span>
                  </div>
                  </div>
                  <p id="autocomplete-label" class="mb-4"><strong><?php echo $the_query->found_posts; ?> </strong>servizi trovati in ordine alfabetico</p>
                </div>
                <div id="load-more">
                    <?php foreach ($servizi as $servizio) { 
                        $load_card_type = "categoria_servizio";
                        $hide_categories = true;
                        get_template_part("template-parts/servizio/card");    
                    } ?>
                </div>
                <?php get_template_part("template-parts/search/more-results"); ?>
              </div>
              
              <?php if ( is_array($amministrazione) && count($amministrazione) ) { ?>
                <div class="col-12 col-lg-4 pt-50 pb-30 pt-lg-5 ps-lg-5">
                  <div class="link-list-wrap">
                    <h2 class="title-xsmall-semi-bold"><span>UFFICI</span></h2>
                    <ul class="link-list t-primary">
                      <?php foreach ($amministrazione as $item) { ?>
                        <li class="mb-3 mt-3">
                          <a class="list-item ps-0 title-medium underline" href="<?php echo $item['link']; ?>">
                            <span><?php echo $item['title']; ?></span>
                          </a>
                        </li>
                      <?php } ?>                      
                      <li>
                        <a class="list-item ps-0 text-button-xs-bold d-flex align-items-center text-decoration-none" href="<?php echo get_permalink( get_page_by_path( 'amministrazione' ) ); ?>">
                          <span class="mr-10">VAI ALL’AREA AMMINISTRATIVA</span>
                          <svg class="icon icon-xs icon-primary">
                            <use href="#it-arrow-right"></use>
                          </svg>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
      </form>
    </div>
                        
    <?php if ( is_array($bandi) && count($bandi) ) { ?>
      <div class="container">
        <h2 class="title-xxlarge mt-40 mb-40 mt-lg-60 mb-lg-40">Bandi</h2>
        <div class="row flex-wrap justify-content-between gy-4 gy-lg-5 gx-lg-5 pb-3 pb-lg-60 align-items-stretch">
          <div class="col-12 col-lg-4">
            <?php foreach ($bandi as $item) { ?>
              <div class="cmp-card-simple card-wrapper pb-0">
                <div class="card shadow rounded">
                  <div class="card-body">
                    <a class="text-decoration-none" href="<?php echo $item['link']; ?>">
                      <h3 class="card-title t-primary title-xlarge">
                        <?php echo $item['titolo']; ?>
                      </h3>
                    </a>
                    <p class="titillium text-paragraph "><?php echo $item['description']; ?></p>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
      </div>  
    <?php } ?>
    
    <?php echo get_template_part( 'template-parts/common/valuta-servizio'); ?>
    <?php echo get_template_part( 'template-parts/common/assistenza-contatti'); ?>
  </main>
<?php
get_footer();
