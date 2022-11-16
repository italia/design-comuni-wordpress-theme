<?php
global $count, $scheda;
// Per mostrare la notizia più recente
// $args = array('post_type' => 'notizia',
// 				'posts_per_page' => 1,
//         'orderby' => 'date',
//         'order' => 'DESC'
// );
// $posts = get_posts($args);
// $post = array_shift($posts);

$post_id = dci_get_option('notizia_evidenziata','homepage', true )[0] ?? null;
if($post_id) $post = get_post($post_id);

$img = dci_get_meta("immagine", '_dci_notizia_', $post->ID);
$arrdata = dci_get_data_pubblicazione_arr("data_pubblicazione", '_dci_notizia_', $post->ID);
$monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
$descrizione_breve = dci_get_meta("descrizione_breve", '_dci_notizia_', $post->ID);
$argomenti = dci_get_meta("argomenti", '_dci_notizia_', $post->ID);

$scheda1 = dci_get_option('schede_evidenziate_1','homepage', true )[0] ?? null;
$scheda2 = dci_get_option('schede_evidenziate_2','homepage', true )[0] ?? null;
$scheda3 = dci_get_option('schede_evidenziate_3','homepage', true )[0] ?? null;
$schede = array($scheda1,$scheda2,$scheda3 );


?>
<!-- Tag section is opened in home.php -->
  <div class="container">
    <?php if ($post_id) { ?>
    <div class="row">
      <div class="col-lg-5 order-2 order-lg-1">
        <div class="card mb-1">
          <div class="card-body pb-5">
            <div class="category-top">
              <svg class="icon icon-sm" aria-hidden="true">
                <use xlink:href="#it-calendar"></use>
              </svg>
              <span class="title-xsmall-semi-bold fw-semibold"><?php echo $post->post_type ?></span>
              <?php if(is_array($arrdata) && count($arrdata)) { ?>
              <span class="data fw-normal"><?php echo $arrdata[0].' '.$monthName.' '.$arrdata[2]; ?></span>
              <?php } ?>
            </div>
            <a href="<?php echo get_permalink($post->ID); ?>" class="text-decoration-none">
              <h3 class="h4 card-title title-xlarge">
                <?php echo $post->post_title ?>
              </h3>
            </a>
            <p class="mb-4 subtitle-small pt-3 lora">
              <?php echo $descrizione_breve ?>
            </p>
            <?php get_template_part("template-parts/common/badges-argomenti"); ?>
            <a
              class="read-more pb-3"
              href="<?php echo dci_get_template_page_url("page-templates/novita.php"); ?>"
            >
              <span class="text">Tutte le novità</span>
              <svg class="icon">
                <use xlink:href="#it-arrow-right"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1 order-1 order-lg-2 px-0 px-lg-2">
        <?php if ($img) { 
          dci_get_img($img, 'img-fluid');
        } ?>
      </div>
    </div>
    <?php } else { ?>
      <div style="height: 34px;"></div>
    <?php } ?>
  </div>
</section>
<section id="calendario">
  <div class="section section-muted pb-90 pb-lg-50 px-lg-5 pt-0">
    <div class="container">
      <div class="row mb-2">
        <div class="card-wrapper px-0 card-overlapping card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
        <?php $count=1;
        foreach ($schede as $scheda) {
          if ($scheda) 
            get_template_part("template-parts/home/scheda-evidenza");
          ++$count;
        } ?>
        </div>
      </div>
    </div>
<!-- Tag section is closed in home.php -->
