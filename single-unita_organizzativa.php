<?php

/**
 * Unità Organizzativa template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 * Developer : Giovanni Cozzolino
 */
global $uo_id, $file_url, $hide_arguments, $luogo;

get_header();
?>
    <main>
		<?php
		while (have_posts()) :
			the_post();
			$user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

			$prefix = "_dci_unita_organizzativa_";

			$immagine = dci_get_meta("immagine", $prefix, $post->ID);
			$descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
			$competenze = dci_get_meta("competenze", $prefix, $post->ID);
			$tipi_organizzazione = get_the_terms($post, 'tipi_unita_organizzativa');
			$tipo_organizzazione = array_column($tipi_organizzazione, 'name') ?? null;
			$unita_organizzativa_genitore = dci_get_meta("unita_organizzativa_genitore", $prefix, $post->ID);
			$responsabili = dci_get_meta("responsabile", $prefix, $post->ID);

			$argomenti = get_the_terms($post, 'argomenti');

			$assessore_riferimento = dci_get_meta("assessore_riferimento", $prefix, $post->ID);
			$persone = dci_get_meta("persone_struttura", $prefix, $post->ID);

			$servizi = dci_get_meta("elenco_servizi_offerti", $prefix, $post->ID);
			$sede_principale_id = dci_get_meta("sede_principale", $prefix, $post->ID);
			if ($sede_principale_id) $sede_principale = get_post($sede_principale_id);
			$altre_sedi = dci_get_meta("altre_sedi", $prefix, $post->ID);
			$punti_contatto = dci_get_meta("contatti", $prefix, $post->ID);
			$allegati = dci_get_meta("allegati", $prefix, $post->ID);

			$more_info = dci_get_wysiwyg_field("ulteriori_informazioni");

			?>

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
                                        <h1> <?php the_title(); ?></h1>
                                    </div>
                                    <p class="subtitle-small mb-3" data-element="service-description">
										<?php echo $descrizione_breve ?>
                                    </p>
                                    <button type="button" class="btn btn-outline-primary t-primary bg-white mobile-full" onclick="location.href='<?php echo dci_get_template_page_url('page-templates/prenota-appuntamento.php'); ?>';">
                                        <span class="">Prenota appuntamento</span>
                                    </button>
                                </div>
                                <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0">
									<?php
									$hide_arguments = true;
									get_template_part('template-parts/single/actions');
									?>
									<?php if (is_array($argomenti) && count($argomenti)) { ?>
                                        <h6><small>Argomenti</small></h6>
										<?php get_template_part("template-parts/single/argomenti"); ?>
									<?php } ?>
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
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina" data-bs-navscroll>
                                <div class="navbar-custom" id="navbarNavProgress">
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                <span class="accordion-header" id="accordion-title-one">
                                                    <button class="accordion-button pb-10 px-3 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                        Indice della pagina
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
																<?php if ($competenze) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#competenze">
                                                                            <span class="title-medium">Competenze</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($unita_organizzativa_genitore) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#area">
                                                                            <span class="title-medium">Area di riferimento</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($responsabili) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#responsabile">
                                                                            <span class="title-medium">Responsabile</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($persone) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#persone">
                                                                            <span class="title-medium">Persone</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($servizi && is_array($servizi) && count($servizi) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#servizi">
                                                                            <span class="title-medium">Servizi offerti</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#sede-principale">
                                                                        <span class="title-medium">Sede principale</span>
                                                                    </a>
                                                                </li>
																<?php if ($altre_sedi && is_array($altre_sedi) && count($altre_sedi) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#altre-sedi">
                                                                            <span class="title-medium">Altre sedi</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#contatti">
                                                                            <span class="title-medium">Contatti</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($allegati && is_array($allegati) && count($allegati) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#allegati">
                                                                            <span class="title-medium">Documenti</span>
                                                                        </a>
                                                                    </li>
																<?php } ?>
																<?php if ($more_info) { ?>
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
                            <section id="competenze" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Competenze</h3>
                                <div class="richtext-wrapper lora">
									<?php echo $competenze ?>
                                </div>
                            </section>
                            <section id="tipo-uo" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Tipologia di organizzazione</h3>
                                <div class="richtext-wrapper lora">
									<?php foreach ($tipo_organizzazione as $tipo) {
										echo ucfirst($tipo);
									} ?>
                                </div>
                            </section>


							<?php if ($unita_organizzativa_genitore) { ?>
                                <section id="area" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Area di riferimento</h3>
                                    <div class="richtext-wrapper lora">
										<?php foreach ($unita_organizzativa_genitore as $uo_id) {
											$with_border = true;
											get_template_part("template-parts/unita-organizzativa/card");
										} ?>
                                    </div>
                                </section>
							<?php } ?>


							<?php if ($responsabili &&  is_array($responsabili) && count($responsabili)) { ?>
                                <section id="responsabile" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Responsabile</h3>
                                    <div class="richtext-wrapper lora">
                                        <div class="row g-2">
											<?php foreach ($responsabili as $persona_id) { ?>
                                                <div class="col-lg-6 col-md-12">
													<?php get_template_part("template-parts/persona/card-vertical-thumb-uo"); ?>
                                                </div>
											<?php } ?>
                                        </div>
                                    </div>
                                </section>
							<?php } ?>

							<?php if (is_array($persone) && count($persone)) { ?>
                                <section id="persone" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Persone</h3>
                                    <div class="richtext-wrapper lora">
                                        Tutte le persone che fanno parte di questo ufficio:
                                        <div class="row g-2">
											<?php foreach ($persone as $persona_id) { ?>
                                                <div class="col-lg-6 col-md-12">
													<?php get_template_part("template-parts/persona/card-vertical-thumb-uo"); ?>
                                                </div>
											<?php } ?>
                                        </div>
                                    </div>
                                </section>
							<?php } ?>

							<?php if ($servizi &&  is_array($servizi) && count($servizi)) { ?>
                                <section id="servizi" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Servizi collegati</h3>
                                    <div class="row g-2">
										<?php foreach ($servizi as $servizio_id) { ?>
                                            <div class="col-lg-6 col-md-12">
												<?php
												$servizio = get_post($servizio_id);
												$with_map = false;
												get_template_part("template-parts/servizio/card");?>
                                            </div>
										<?php } ?>
                                    </div>
                                </section>
							<?php } ?>

                            <section id="sede-principale" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Sede principale</h3>
								<?php
								$post = $sede_principale;
								$with_border = false;
								get_template_part("template-parts/luogo/card-ico");
								?>
                            </section>

							<?php if ($altre_sedi && is_array($altre_sedi) && count($altre_sedi)) { ?>
                                <section id="altre-sedi" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Altre sedi</h3>
									<?php foreach ($altre_sedi as $sede_id) {
										$post = get_post($sede_id);
										$with_border = false;
										get_template_part("template-parts/luogo/card-ico");
									} ?>
                                </section>
							<?php  } ?>


							<?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                                <section id="contatti" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Contatti</h3>
                                    <div class="row">
										<?php foreach ($punti_contatto as $pc_id) { ?>
                                            <div class="col-xl-6 col-lg-8 col-md-12 ">
												<?php
												$with_border = true;
												get_template_part("template-parts/punto-contatto/card"); ?>
                                            </div>
										<?php  } ?>
                                    </div>
                                </section>
							<?php } ?>

							<?php if ($allegati && is_array($allegati) && count($allegati) > 0) { ?>
                                <section id="allegati" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Documenti</h3>
                                    <div class="row">
										<?php foreach ($allegati as $allegato_id) { ?>
                                            <div class="col-md-6 col-sm-12 ">
												<?php
												$documento = get_post($allegato_id);
												$with_border = true;
												get_template_part("template-parts/documento/card"); ?>
                                            </div>
										<?php  } ?>
                                    </div>
                                </section>
							<?php } ?>

							<?php if ($more_info) {  ?>
                                <section id="more-info" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Ulteriori informazioni</h3>
                                    <div class="richtext-wrapper lora">
										<?php echo $more_info ?>
                                    </div>
                                </section>
							<?php }  ?>

							<?php get_template_part('template-parts/single/page_bottom', "simple"); ?>
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
