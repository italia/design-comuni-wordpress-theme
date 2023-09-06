<?php
/**
 * Evento template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $show_calendar, $gallery, $video, $trascrizione, $luogo, $pc_id, $uo_id, $appuntamento, $inline;

get_header();
?>

<main>
  <?php
  while ( have_posts() ) :
    the_post();
    $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

    $prefix= '_dci_evento_';
    $descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
    //dates
    $start_timestamp = dci_get_meta("data_orario_inizio", $prefix, $post->ID);
    $start_date = date_i18n('d F Y', date($start_timestamp));
    $start_date_arr = explode('-', date_i18n('d-M-Y-H-i', date($start_timestamp)));
    $end_timestamp = dci_get_meta("data_orario_fine", $prefix, $post->ID);
    $end_date = date_i18n('d F Y', date($end_timestamp));
    $end_date_arr = explode('-', date_i18n('d-M-Y-H-i', date($end_timestamp)));
    $descrizione = dci_get_wysiwyg_field("descrizione_completa", $prefix, $post->ID);
    $destinatari = dci_get_wysiwyg_field("a_chi_e_rivolto", $prefix, $post->ID);
    //media
    $gallery = dci_get_meta("gallery", $prefix, $post->ID);
    $video = dci_get_meta("video", $prefix, $post->ID);
    $trascrizione = dci_get_meta("trascrizione", $prefix, $post->ID);
    $persone = dci_get_meta("persone", $prefix, $post->ID);
    $luogo_evento_id = dci_get_meta("luogo_evento", $prefix, $post->ID);
    if ($luogo_evento_id) $luogo_evento = get_post($luogo_evento_id);
    $costi = dci_get_meta( 'costi' );            
    $allegati = dci_get_meta("allegati", $prefix, $post->ID);
    $punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);
    $organizzatori = dci_get_meta("organizzatore", $prefix, $post->ID);
    $appuntamenti = dci_get_eventi_figli();
    $patrocinato = dci_get_meta("patrocinato", $prefix, $post->ID);
    $sponsor = dci_get_meta("sponsor", $prefix, $post->ID);     
    $more_info = dci_get_wysiwyg_field("ulteriori_informazioni", $prefix, $post->ID);
    ?>

    <div class="container px-4 my-4" id="main-container">
      <div class="row">
        <div class="col px-lg-4">
            <?php get_template_part("template-parts/common/breadcrumb"); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 px-lg-4 py-lg-2">
          <h1 data-audio><?php the_title(); ?></h1>
          <?php if ($start_timestamp && $end_timestamp) { ?>
          <h2 class="h4 py-2" data-audio>dal <?php echo $start_date; ?> al <?php echo $end_date; ?></h2>
          <?php } ?>
          <p data-audio>
            <?php echo $descrizione_breve; ?>
          </p>
        </div>
        <div class="col-lg-3 offset-lg-1">
          <?php
              $inline = true;
              get_template_part('template-parts/single/actions');
          ?>
        </div>
      </div>
    </div>

    <?php get_template_part('template-parts/single/image-large'); ?>
  
    <div class="container">
      <div class="row border-top row-column-border row-column-menu-left border-light">
        <aside class="col-lg-4">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina" data-bs-navscroll>
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                        <button
                                            class="accordion-button pb-10 px-3 text-uppercase"
                                            type="button"
                                            aria-controls="collapse-one"
                                            aria-expanded="true"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-one"
                                        >Indice della pagina
                                            <svg class="icon icon-sm icon-primary align-top">
                                                <use xlink:href="#it-expand"></use>
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
                                                    <a class="nav-link" href="#cos-e">
                                                    <span class="title-medium">Cos'è</span>
                                                    </a>
                                                    </li>
                                                <?php if( $destinatari) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#destinatari">
                                                    <span class="title-medium">A chi è rivolto</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>  
                                                <?php if( $luogo_evento) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#luogo">
                                                    <span class="title-medium">Luogo</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($start_timestamp && $end_timestamp) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#date-e-orari">
                                                    <span class="title-medium">Date e orari</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if( is_array($costi) && count($costi) ) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#costi">
                                                    <span class="title-medium">Costi</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if( $allegati ) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#allegati">
                                                    <span class="title-medium">Allegati</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="#contatti">
                                                <span class="title-medium">Contatti</span>
                                                </a>
                                                </li>
                                                <?php } ?>
                                                <?php if( is_array($appuntamenti) && count($appuntamenti) ) { ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="#appuntamenti">
                                                <span class="title-medium">Appuntamenti</span>
                                                </a>
                                                </li>
                                                <?php } ?>
                                                <?php if ( (is_array($patrocinato) && count($patrocinato)) || 
                                                    (is_array($sponsor) && count($sponsor)) ) {  ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="#ulteriori-informazioni">
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
        </aside>

        <section class="col-lg-8 it-page-sections-container border-light">
          <article id="cos-e" class="it-page-section mb-5" data-audio>
              <h2 class="mb-3">Cos'è</h2>
              <div class="richtext-wrapper font-serif">
                  <?php echo $descrizione; ?>
              </div>
              <?php if(is_array($persone) && count($persone)) {?>
              <div class="pt-3 mb-4">
                <h3 class="h4">Parteciperanno</h3>
                <?php get_template_part("template-parts/single/persone"); ?>
              </div>
              <?php  } ?>
              <?php if (is_array($gallery) && count($gallery)) {
                  get_template_part("template-parts/single/gallery");
              } ?>
              <?php if ($video) {
                  get_template_part("template-parts/single/video");
              } ?>
          </article>

          <?php if($destinatari) {?>
          <article id="destinatari" class="it-page-section mb-5">
            <h2 class="mb-3">A chi è rivolto</h2>
            <p><?php echo $destinatari; ?></p>
          </article>
          <?php  } ?>

          <?php if($luogo_evento) {?>
          <article id="luogo" class="it-page-section mb-5">
            <h2 class="mb-3">Luogo</h2>
            <?php
                $luogo = $luogo_evento;
                get_template_part("template-parts/single/luogo");
            ?>
          </article>
          <?php } ?>

          <?php if ($start_timestamp && $end_timestamp) { ?>
          <article id="date-e-orari" class="it-page-section mb-5">
              <h2 class="mb-3">Date e orari</h2>
              <div class="point-list-wrapper my-4">
                <div class="point-list">
                    <h3 class="point-list-aside point-list-primary fw-normal">
                        <span class="point-date font-monospace"><?php echo $start_date_arr[0]; ?></span>
                        <span class="point-month font-monospace"><?php echo $start_date_arr[1]; ?></span>
                    </h3>
                  <div class="point-list-content">
                      <div class="card card-teaser shadow rounded">
                          <div class="card-body">
                              <h3 class="card-title h5 m-0">
                              <?php echo $start_date_arr[3].':'.$start_date_arr[4]; ?> - Inizio evento
                              </h3>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="point-list">
                  <h3 class="point-list-aside point-list-primary fw-normal">
                      <div class="point-date font-monospace"><?php echo $end_date_arr[0]; ?></div>
                      <div class="point-month font-monospace"><?php echo $end_date_arr[1]; ?></div>
                  </h3>
                  <div class="point-list-content">
                      <div class="card card-teaser shadow rounded">
                          <div class="card-body">
                              <h3 class="card-title h5 m-0">
                              <?php echo $end_date_arr[3]; ?>:<?php echo $end_date_arr[4]; ?> - Fine evento
                              </h3>
                          </div>
                      </div>
                  </div>
              </div>
              </div>
              <?php
              $data_inizio = date_i18n("Ymd\THi00", date($start_timestamp));
              $data_fine = date_i18n("Ymd\THi00", date($end_timestamp));
              $luogo = $luogo_evento->post_title;
              ?>
              <div class="mt-5">
                  <a target="_blank" href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo urlencode(get_the_title()); ?>&dates=<?php echo $data_inizio; ?>/<?php echo $data_fine; ?>&details=<?php echo urlencode($descrizione_breve); ?>:+<?php echo urlencode(get_permalink()); ?>&location=<?php echo urlencode($luogo); ?>" class="btn btn-outline-primary btn-icon">
                      <svg class="icon icon-primary" aria-hidden="true">
                      <use xlink:href="#it-plus-circle"></use>
                      </svg>
                      <span>Aggiungi al calendario</span>
                  </a>
              </div>
          </article>
          <?php } ?>

          <?php if( is_array($costi) && count($costi) ) { ?>
          <article id="costi" class="it-page-section mb-5">
              <h2 class="mb-3">Costi</h2>
              <?php foreach ($costi as $costo) { ?>
              <div class="card no-after border-start mt-3">
                  <div class="card-body">
                      <h5>
                      <span>
                          <?php echo $costo['titolo_costo']; ?>
                      </span>
                      <p class="card-title big-heading">
                          <?php echo $costo['prezzo_costo']; ?>
                      </p>
                      </h5>
                      <p class="mt-4">
                          <?php echo $costo['descrizione_costo']; ?>
                      </p>
                  </div>
              </div>
          <?php } ?>
          </article>
          <?php } ?>

          <?php if( $allegati ) {
              $doc = get_post( attachment_url_to_postid($allegati) );
          ?>
          <article id="allegati" class="it-page-section mb-5">
              <h2 class="mb-3">Allegati</h2>
              <div class="card card-teaser shadow mt-3 rounded">
                  <div class="card-body">
                  <h3 class="card-title h5 m-0">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#it-clip"></use>
                    </svg>
                      <a class="text-decoration-none" href="<?php echo $allegati; ?>" title="Scarica la locandina <?php echo $doc->post_title; ?>" aria-label="Scarica la locandina <?php echo $doc->post_title; ?>"><?php echo $doc->post_title; ?></a>
                  </h3>
                  </div>
              </div>
          </article>
          <?php } ?>

          <?php if( is_array($appuntamenti) && count($appuntamenti) ) { ?>
          <article id="appuntamenti" class="it-page-section mb-5">
              <h2 class="mb-3">Appuntamenti</h2>
              <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                  <?php foreach ($appuntamenti as $appuntamento) {
                      get_template_part('template-parts/single/appuntamento');
                  } ?>
              </div>
          </article>
          <?php }?>

          <article id="contatti" class="it-page-section mb-5">
          <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
            <h2 class="mb-3">Contatti</h2>
            <?php foreach ($punti_contatto as $pc_id) {
                get_template_part('template-parts/single/punto-contatto');
            } ?>
          <?php } ?>
          <?php if( is_array($organizzatori) && count($organizzatori) ) { ?>
            <h4 class="h5 mt-4">Con il supporto di:</h4>
            <?php foreach ($organizzatori as $uo_id) {
                get_template_part("template-parts/unita-organizzativa/card-full");
            } ?>
          <?php } ?>
          </article>
          
          <article id="ulteriori-informazioni" class="it-page-section mb-5">
          <?php 
              if ( (is_array($patrocinato) && count($patrocinato)) || 
              (is_array($sponsor) && count($sponsor)) ) { ?>
            <h3 class="mb-3">Ulteriori informazioni</h3>
          <?php
              if ( is_array($patrocinato) && count($patrocinato) ) {
                  echo '<h4 class="h5">Patrocinato da:</h4>';
                  echo '<div class="link-list-wrapper mb-3"><ul class="link-list">';
                  foreach ($patrocinato as $item) { ?>
                      <li><a class="list-item px-0" href="<?php echo $item['_dci_evento_url']; ?>" target="_blank"><span><?php echo $item['_dci_evento_nome']; ?></span></a>
                      </li>
                  <?php }
                  echo '</ul></div>';
              }
              if ( is_array($sponsor) && count($sponsor) ) {
                  echo '<h4 class="h5">Sponsor:</h4>';
                  echo '<div class="link-list-wrapper"><ul class="link-list">';
                  foreach ($sponsor as $item) { ?>
                      <li><a class="list-item px-0" href="<?php echo $item['_dci_evento_url']; ?>" target="_blank"><span><?php echo $item['_dci_evento_nome']; ?></span></a>
                      </li>
                  <?php }
                  echo '</ul></div>';
              }}
          ?>
          <?php if ($more_info) { ?>
              <div class="mt-5">
                  <div class="callout">
                      <div class="callout-title">
                          <svg class="icon">
                          <use xlink:href="#it-info-circle"></use>
                          </svg>
                      </div>
                      <?php echo $more_info; ?>
                  </div>
              </div>
          <?php } ?>
          </article>
          <?php get_template_part('template-parts/single/page_bottom'); ?>
          </section>
      </div>
    </div>
    <?php get_template_part("template-parts/common/valuta-servizio"); ?>
    
    <!-- <?php get_template_part('template-parts/single/more-posts', 'carousel'); ?> -->

  <?php
  endwhile; // End of the loop.
  ?>
</main>

<?php
get_footer();
