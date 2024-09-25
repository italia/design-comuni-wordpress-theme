<?php
/**
 * Luogo template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>

<main>
  <?php
  while ( have_posts() ) :
    the_post();
    $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

    $prefix= '_dci_luogo_';
	$nome_alternativo = dci_get_meta("nome_alternativo", $prefix, $post->ID);
    $descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
	$descrizione_estesa = dci_get_meta("descrizione_estesa", $prefix, $post->ID);
	$luoghi_collegati = dci_get_meta("luoghi_collegati", $prefix, $post->ID);
	$servizi = dci_get_meta("servizi", $prefix, $post->ID);
	$modalita_accesso = dci_get_meta("modalita_accesso", $prefix, $post->ID);
	$indirizzo = dci_get_meta("indirizzo", $prefix, $post->ID);
    $luogo = $post->ID;
	$orario_pubblico = dci_get_meta("orario_pubblico", $prefix, $post->ID);
	$punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);
	$struttura_responsabile = dci_get_meta("struttura_responsabile", $prefix, $post->ID);
	$ulteriori_informazioni = dci_get_wysiwyg_field("ulteriori_informazioni", $prefix, $post->ID); 
    
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
          <?php if ($nome_alternativo) { ?>
          <h2 class="h4 py-2" data-audio><?php echo $nome_alternativo; ?></h2>
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
                                                    <a class="nav-link" href="#descrizione-estesa">
                                                    <span>Descrizione</span>
                                                    </a>
                                                    </li>
                                                <?php if( $luoghi_collegati) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#luoghi-collegati">
                                                    <span>Luoghi collegati</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>  
                                                <?php if( $servizi) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#servizi">
                                                    <span>Servizi</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if ($modalita_accesso) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#modalita-accesso">
                                                    <span>Modalità di accesso</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if($indirizzo) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#indirizzo">
                                                    <span>Indirizzo</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if( $orario_pubblico ) { ?>
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#orario-pubblico">
                                                    <span>Orari per il pubblico</span>
                                                    </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="#contatti">
                                                <span>Contatti</span>
                                                </a>
                                                </li>
                                                <?php } ?>
                                                <?php if( is_array($struttura_responsabile) && count($struttura_responsabile) ) { ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="#struttura-responsabile">
                                                <span>Struttura responsabile</span>
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
              <h2 class="mb-3">Descrizione</h2>
              <div class="richtext-wrapper font-serif">
                  <?php echo $descrizione_estesa; ?>
              </div>
          </article>
			
          <?php if(is_array($luoghi_collegati) && count($luoghi_collegati)) {?>
          <article id="luoghi-collegati" class="it-page-section mb-5">
              <h2 class="mb-3">Luoghi collegati</h2>
				<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
				<?php foreach ($luoghi_collegati as $luogo_id) {
						$with_border=false;
						get_template_part("template-parts/luogo/card-light");
					}?>
			    </div>
		  </article>
          <?php } ?>
          

          <?php if($servizi) {?>
          <article id="servizi" class="it-page-section mb-5">
            <h2 class="mb-3">Servizi</h2>
            <div class="richtext-wrapper font-serif">
				<?php echo $servizi; ?>
			</div>
          </article>
          <?php  } ?>

          <?php if($modalita_accesso) {?>
          <article id="modalita-accesso" class="it-page-section mb-5">
            <h2 class="mb-3">Modalità di accesso</h2>
            <div class="richtext-wrapper font-serif">
				<?php echo $modalita_accesso; ?>
			</div>
          </article>
          <?php } ?>

          <?php if($indirizzo) {?>
          <article id="indirizzo" class="it-page-section mb-5">
            <h2 class="mb-3">Indirizzo</h2>
			<?php 
				$luoghi = array($luogo);
				get_template_part("template-parts/luogo/map"); 
			?>
            <div class="richtext-wrapper font-serif mt-3">
				<?php echo $indirizzo; ?>
			</div>
          </article>
          <?php } ?>	

          <?php if($orario_pubblico) {?>
          <article id="orario-pubblico" class="it-page-section mb-5">
            <h2 class="mb-3">Orario per il pubblico</h2>
            <div class="richtext-wrapper font-serif">
				<?php echo $orario_pubblico; ?>
			</div>
          </article>
          <?php } ?>

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
			
          <?php if($struttura_responsabile) {?>
          <article id="struttura-responsabile" class="it-page-section mb-5">
            <h2 class="mb-3">Struttura responsabile</h2>
			<div class="row">
				<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
					<?php foreach ($struttura_responsabile as $uo_id) {
						$with_border = true;
						get_template_part("template-parts/unita-organizzativa/card");
					} ?>
				</div>
			</div>
          </article>
          <?php } ?>
			
          <?php if($ulteriori_informazioni) {?>
          <article id="ulteriori-informazioni" class="it-page-section mb-5">
            <h2 class="mb-3">Ulteriori informazioni</h2>
            <p><?php echo $ulteriori_informazioni; ?></p>
          </article>
 		  <?php } ?>
			  
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
