<?php
/**
 * The template for displaying archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#archive
 *
 * @package Design_Comuni_Italia
 */
global $obj, $argomento, $with_border, $uo_id;

$argomento = get_term_by('id', $obj->term_id, 'argomenti');
$img = dci_get_term_meta('immagine', "dci_term_", $argomento->term_id);
$aree_appartenenza = dci_get_term_meta('area_appartenenza', "dci_term_", $argomento->term_id);
$assessorati_riferimento = dci_get_term_meta('assessorato_riferimento', "dci_term_", $argomento->term_id);

get_header();
?>
<main>
    <div class="it-hero-wrapper it-wrapped-container">
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
          <div class="col-12 px-lg-5">
            <div
              class="it-hero-card it-hero-bottom-overlapping px-2 px-md-5 py-2 py-md-5 rounded"
            >
  
                <div class="row">
                  <div class="col">
                    <?php get_template_part("template-parts/common/breadcrumb"); ?>
                  </div>
                </div>
                <div class="row sport-wrapper">
                  <div class="col-lg-6">
                    <h1 class="mb-3 mb-lg-4 title-xxlarge">
                      <?php echo $argomento->name; ?>
                    </h1>
                    <p class="u-main-black text-paragraph-regular-medium">
                        <?php echo $argomento->description; ?>
                    </p>
                  </div>
                  <div class="col-lg-4 offset-lg-2">
                    <div class="card-wrapper card-column">
                    <?php 
                        if ((is_array($aree_appartenenza) && count($aree_appartenenza)) || (is_array($assessorati_riferimento) && count($assessorati_riferimento))) { ?>
                    <p class="description-small">
                      Questo argomento è gestito da:
                    </p>
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
