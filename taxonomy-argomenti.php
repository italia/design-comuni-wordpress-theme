<?php
/**
 * Archivio Tassonomia Argomento
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-taxonomies
 * @link https://italia.github.io/design-comuni-pagine-statiche/sito/argomento.html
 *
 * @package Design_Comuni_Italia
 */

global $argomento, $with_border, $uo_id, $custom_class;

$argomento = get_queried_object();
$img = dci_get_term_meta('immagine', "dci_term_", $argomento->term_id);
$aree_appartenenza = dci_get_term_meta('area_appartenenza', "dci_term_", $argomento->term_id);
$assessorati_riferimento = dci_get_term_meta('assessorato_riferimento', "dci_term_", $argomento->term_id);

get_header();
?>
<main>
    <div class="it-hero-wrapper it-wrapped-container" id="main-container">
      <?php if ($img) { ?>
      <div class="img-responsive-wrapper">
        <div class="img-responsive">
          <div class="img-wrapper">
            <?php dci_get_img($img); ?>
          </div>
        </div>
      </div>
      <?php } ?>
      <div class="container">
        <div class="row">
          <div class="col-12 px-0 px-lg-2">
            <div
              class="it-hero-card it-hero-bottom-overlapping rounded hero-p pb-lg-80 drop-shadow <?php echo ($img? '' : 'mt-0'); ?>"
            >
  
                <div class="row justify-content-center">
                  <div class="col-12 col-lg-10">
                    <?php 
                      $custom_class = 'mt-0';
                      get_template_part("template-parts/common/breadcrumb"); 
                    ?>
                  </div>
                </div>
                <div class="row sport-wrapper justify-content-between mt-lg-2">
                  <div class="col-12 col-lg-5 offset-lg-1">
                    <h1 class="mb-3 mb-lg-4 title-xxlarge">
                      <?php echo $argomento->name; ?>
                    </h1>
                    <h2 class="visually-hidden" id="news-details">Dettagli dell'argomento</h2>
                    <p class="u-main-black text-paragraph-regular-medium mb-60">
                        <?php echo $argomento->description; ?>
                    </p>
                  </div>
                  <div class="col-12 col-lg-5 me-lg-5">
                    <div class="card-wrapper card-column">
                    <?php 
                        if ((is_array($aree_appartenenza) && count($aree_appartenenza)) || (is_array($assessorati_riferimento) && count($assessorati_riferimento))) { ?>
                    <h3 class="title-xsmall-semi-bold">Questo argomento è gestito da:</h3>
                    <?php } ?>
                    <?php 
                        if (is_array($aree_appartenenza) && count($aree_appartenenza)) {
                            foreach ($aree_appartenenza as $uo_id) {
                              $with_border = true;
                              get_template_part("template-parts/unita-organizzativa/card");
                            }
                        };
                        if (is_array($assessorati_riferimento) && count($assessorati_riferimento)) {
                            foreach ($assessorati_riferimento as $uo_id) {
                              $with_border = true;
                              get_template_part("template-parts/unita-organizzativa/card");
                            }
                        } 
                      ?>
                    </div>
                  </div>
                </div>
  
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php get_template_part("template-parts/argomento/novita-detail"); ?>
    <?php get_template_part("template-parts/argomento/amministrazione-detail"); ?>
    <?php get_template_part("template-parts/argomento/servizi-detail"); ?>
    <?php get_template_part("template-parts/argomento/documenti-detail"); ?>
    <?php get_template_part("template-parts/common/valuta-servizio"); ?>
    <?php get_template_part("template-parts/common/assistenza-contatti"); ?>
</main>
<?php
get_footer();
