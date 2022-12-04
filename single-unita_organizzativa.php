<?php

/**
 * Unità Organizzativa template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 * Developer : Giovanni Cozzolino
 */
global $uo_id, $file_url, $hide_arguments;

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
        $unita_organizzativa_genitore = dci_get_meta("unita_organizzativa_genitore", $prefix, $post->ID);
        $responsabili = dci_get_meta("responsabile", $prefix, $post->ID);

        $argomenti = get_the_terms($post, 'argomenti');
        $tipo_organizzazione = null;

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
                                    <h2> <?php the_title(); ?></h2>
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
                                                            <?php if ($assessore_riferimento || $persone) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#amministrazione">
                                                                        <span class="title-medium">Amministrazione</span>
                                                                    </a>
                                                                </li>
                                                            <?php } ?>
                                                            <?php if ($unita_organizzativa_genitore || $responsabili) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#struttura">
                                                                        <span class="title-medium">Struttura</span>
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
                                                            <?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#contatti">
                                                                        <span class="title-medium">Sedi e contatti</span>
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
                        <section class="it-page-section mb-30">
                            <h2 class="title-xxlarge mb-3" id="competenze">Competenze</h2>
                            <div class="richtext-wrapper lora">
                                <?php echo $competenze ?>
                            </div>
                        </section>
                        <?php if ($assessore_riferimento) { ?>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="amministrazione">Amministrazione</h2>
                                <?php if ($assessore_riferimento) { ?>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <?php $persona_id = $assessore_riferimento;
                                            get_template_part("template-parts/persona/card-vertical-thumb"); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <article id="a-cura-di" class="it-page-section anchor-offset mt-5">
                                    <h4>A cura di</h4>
                                    <div class="row">
                                        <?php if ($unita_organizzativa_genitore) { ?>
                                            <div class="col-12 col-sm-8">
                                                <h6><small>Questa pagina è gestita da</small></h6>
                                                <?php foreach ($unita_organizzativa_genitore as $uo_id) {
                                                    $with_border = true;
                                                    get_template_part("template-parts/unita-organizzativa/card");
                                                } ?>
                                            </div>
                                        <?php } ?>
                                        <div class="col-12 col-sm-4">
                                            <?php if (is_array($persone) && count($persone)) { ?>
                                                <h6><small>Persone</small></h6>
                                                <?php get_template_part("template-parts/single/persone"); ?>
                                            <?php } ?>
                                            <?php if (is_array($argomenti) && count($argomenti)) { ?>
                                                <h6><small>Argomenti</small></h6>
                                                <?php get_template_part("template-parts/single/argomenti"); ?>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </article>
                            </section>
                        <?php } ?>
                        <?php if (($responsabili &&  is_array($responsabili) && count($responsabili)) ||
                            ($unita_organizzativa_genitore &&  is_array($unita_organizzativa_genitore) && count($unita_organizzativa_genitore))
                        ) { ?>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="struttura">Struttura</h2>
                                <?php if ($responsabili &&  is_array($responsabili) && count($responsabili)) {
                                    $persone = $responsabili;
                                ?>
                                    <h4>Responsabili</h4>
                                    <?php get_template_part("template-parts/single/persone"); ?>
                                <?php } ?>
                                <?php if ($unita_organizzativa_genitore &&  is_array($unita_organizzativa_genitore) && count($unita_organizzativa_genitore)) {  ?>
                                    <h4>Dipende da</h4>
                                    <?php foreach ($unita_organizzativa_genitore as $uo_id) { ?>
                                        <a class="text-decoration-none" href="<?php echo get_permalink($uo_id); ?>">
                                            <div class="chip chip-simple chip-primary">
                                                <span class="chip-label"><?php echo get_the_title($uo_id); ?></span>
                                            </div>
                                        </a>
                                <?php }
                                } ?>
                            </section>
                        <?php } ?>
                        <?php if ($servizi &&  is_array($servizi) && count($servizi)) { ?>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="servizi">Servizi disponibili</h2>
                                <div class="row">
                                    <div class="col-12 col-sm-8">
                                        <?php foreach ($servizi as $servizio_id) {
                                            $servizio = get_post($servizio_id);
                                            $with_border = true;
                                            get_template_part("template-parts/servizio/card");
                                        } ?>
                                    </div>
                                </div>
                            </section>
                        <?php } ?>
                        <?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                            <section id="contatti" class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3">Sedi e contatti</h2>
                                <h3>Sede principale</h3>
                                <?php
                                $luogo = $sede_principale;
                                $with_map = true;
                                get_template_part("template-parts/single/luogo");
                                ?>
                                <?php if ($altre_sedi && is_array($altre_sedi) && count($altre_sedi)) {
                                ?>
                                    <h3>Altre sedi</h3>
                                    <?php foreach ($altre_sedi as $sede_id) {
                                        $luogo = get_post($sede_id);
                                        $with_map = true;
                                        get_template_part("template-parts/single/luogo");
                                    } ?>
                                <?php
                                }
                                ?>
                                <h3>Contatti</h3>
                                <div class="row">
                                    <?php foreach ($punti_contatto as $pc_id) { ?>
                                        <div class="col-md-6 col-sm-12 ">
                                            <?php
                                            $with_border = true;
                                            get_template_part("template-parts/unita-organizzativa/card-appuntamento"); ?>
                                        </div>
                                    <?php  } ?>
                                </div>
                            </section>
                        <?php } ?>
                        <?php if ($allegati && is_array($allegati) && count($allegati) > 0) { ?>
                            <section id="allegati" class="it-page-section mb-30">
                                <h2>Documenti</h2>
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
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="more-info">Ulteriori informazioni</h2>
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
