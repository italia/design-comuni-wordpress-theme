<?php

/**
 * Servizio template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 * Developer : Campanile Domenico Giacomo (dcampanile@nextimelabs.com)
 */
global $uo_id, $file_url, $hide_arguments;

get_header();
?>
<main>
  <?php
  while (have_posts()) :
    the_post();
    $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

    $prefix = "_dci_persona_pubblica_";
    $nome = dci_get_meta("nome");
    $cognome = dci_get_meta("cognome");
    $competenze = dci_get_meta("competenze");
    $descrizione_breve = dci_get_meta("descrizione_breve");
    $deleghe = dci_get_wysiwyg_field("deleghe");
    $descrizione = dci_get_wysiwyg_field("descrizione_estesa");
    $organizzazioni = dci_get_meta("organizzazioni", $prefix, $post->ID);


    $curriculum_vitae = dci_get_meta("curriculum_vitae", $prefix, $post->ID);
    $curriculum_vitae_id = dci_get_wysiwyg_field("curriculum_vitae_id");

    $incarichi = dci_get_meta("incarichi");
    $incarico = dci_get_meta("incarichi")[0];

    $more_info = dci_get_wysiwyg_field("ulteriori_informazioni");
    $punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);

    $responsabile_di = dci_get_wysiwyg_field("responsabile_di");
    $foto = dci_get_wysiwyg_field("foto");
    $foto_id = dci_get_wysiwyg_field("foto_id");
    $imageData = base64_encode(file_get_contents($foto));

    function convertToPlain($text)
    {
      $text = str_replace(array("\r", "\n"), '', $text);
      $text = str_replace('"', '\"', $text);
      $text = str_replace('&nbsp;', ' ', $text);

      return trim(strip_tags($text));
    };
  ?>
    <script type="application/ld+json" data-element="metatag">
      {
        "name": "<?= $post->post_title; ?>",

        "audience": {
          "name": "<?= convertToPlain($destinatari); ?>"
        },
        "availableChannel": {
          "serviceLocation": {
            "name": "<?= $ufficio->post_title; ?>",
            "address": {
              "streetAddress": "<?= $indirizzo; ?>",
              "postalCode": "<?= $cap; ?>",
              "addressLocality": "<?= $quartiere; ?>"
            }
          }
        }
      }
    </script>
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
          <div class="cmp-heading pb-3 pb-lg-4">
            <div class="row">
              <div class="col-lg-8">

                <div class="titolo-sezione">
                  <h2> <?php echo $nome ?> <?php echo $cognome ?></h2>
                  <h4> <?php echo get_the_title($incarico); ?></h4>
                </div>

              </div>
              <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0">
                <?php
                $hide_arguments = true;
                get_template_part('template-parts/single/actions');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php get_template_part('template-parts/single/foto-large'); ?>

    <div class="container">
      <div class="row justify-content-center">
        <hr class="d-none d-lg-block mt-2" />
      </div>
    </div>

    <div class="container">
      <div class="row row-column-menu-left mt-4 mt-lg-80 pb-lg-80 pb-40">
        <div class="col-12 col-lg-3 mb-4 border-col">
          <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" data-bs-navscroll>
              <div class="navbar-custom" id="navbarNavProgress">
                <div class="menu-wrapper">
                  <div class="link-list-wrapper">
                    <div class="accordion">
                      <div class="accordion-item">
                        <span class="accordion-header" id="accordion-title-one">
                          <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                            INDICE DELLA PAGINA
                            <svg class="icon icon-xs right">
                              <use href="#it-expand"></use>
                            </svg>
                          </button>
                        </span>
                        <div class="progress">
                          <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                          <div class="accordion-body">
                            <ul class="link-list" data-element="page-index">

                              <li class="nav-item">
                                <a class="nav-link" href="#ruolo">
                                  <span class="title-medium">Ruolo</span>
                                </a>
                              </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#contacts">
                                    <span class="title-medium">Contatti</span>
                                  </a>
                                </li>

                              <li class="nav-item">
                                <a class="nav-link" href="#documents">
                                  <span class="title-medium">Documenti</span>
                                </a>
                              </li>

            <?php if ($more_info) {  ?>

                                <li class="nav-item">
                                  <a class="nav-link" href="#more-info">
                                    <span class="title-medium">Ulteriori informazioni</span>
                                  </a>
                                </li>
              <?php } ?>


                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
          </div>
        </div>
        <div class="col-12 col-lg-8 offset-lg-1">
          <div class="it-page-sections-container">
            <section class="it-page-section mb-30">
              <h2 class="title-xxlarge mb-3" id="ruolo">Ruolo</h2>
              <div class="richtext-wrapper lora">
                <?php echo $descrizione_breve ?>
              </div>
              <br></br>

              <p ><b>Deleghe</b></p>
              <div class="richtext-wrapper lora">
                <?php echo $deleghe ?>
              </div>
              <br></br>

              <?php if (is_array($organizzazioni) && count($organizzazioni)) { ?>
                <p><b>Fa parte di</b></p>
                <?php foreach ($organizzazioni as $uo_id) {
                  get_template_part("template-parts/unita-organizzativa/card-full");
                } ?>
              <?php } ?>

              <br></br>

              <?php if ($responsabile_di) { ?>
                <p><b>Responsabile di</b></p>
                <?php
                get_template_part("template-parts/unita-organizzativa/card-full", $responsabile_di);
                ?>
              <?php } ?>
            </section>
            <br></br>

            <section class="it-page-section">
              <?php if (is_array($punti_contatto) && count($punti_contatto)) { ?>
                <h4 id="contacts">Contatti</h4>
                <?php foreach ($punti_contatto as $pc_id) {
                  get_template_part('template-parts/single/punto-contatto');
                } ?>
              <?php } ?>
            </section>
            <br></br>

            <section class="it-page-section mb-30">
              <h2 class="title-xxlarge mb-3" id="documents">Documenti</h2>

<div class="cmp-icon-link">
    <a class="list-item icon-left d-inline-block" href="<?php echo $curriculum_vitae; ?>" aria-label="Curriculum">
    <span class="list-item-title-icon-wrapper">
        <svg class="icon icon-primary icon-sm me-1" aria-hidden="true">
        <use href="#it-clip"></use>
        </svg>
        <span class="list-item t-primary">Curriculum</span>
    </span>
    </a>
</div>


              <br></br>

              <p ><b>Altre cariche e incarichi</b></p>

              <?php if (is_array($incarichi) && count($incarichi)) { ?>
                <div class="col-12 col-sm-4">
                  <?php get_template_part("template-parts/single/incarico"); ?>
                </div>
              <?php } ?>


            </section>


            <?php if ($more_info) {  ?>
              <section class="it-page-section mb-30">
                <h2 class="title-xxlarge mb-3" id="more-info">Ulteriori informazioni</h2>
                <h3 class="mb-3 subtitle-medium">Graduatorie di accesso</h3>
                <div class="richtext-wrapper lora">
                  <?php echo $more_info ?>
                </div>
              </section>
            <?php }  ?>



          </div>
        </div>
      </div>
    </div>
    </div>
    <?php get_template_part("template-parts/common/valuta-servizio"); ?>
    <?php get_template_part('template-parts/single/more-posts', 'carousel'); ?>
    <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

  <?php
  endwhile; // End of the loop.
  ?>
</main>
<?php
get_footer();
