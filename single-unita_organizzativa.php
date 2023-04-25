<?php

/**
 * Unità Organizzativa template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 * Developer : Giovanni Cozzolino
 */
global $file_url, $hide_arguments;

get_header();
?>
<main>
    <?php
    while (have_posts()):
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
        $assessore_riferimento = dci_get_meta("assessore_riferimento", $prefix, $post->ID);
        $persone = dci_get_meta("persone_struttura", $prefix, $post->ID);

        $servizi = dci_get_meta("elenco_servizi_offerti", $prefix, $post->ID);
        $sede_principale_id = dci_get_meta("sede_principale", $prefix, $post->ID);
        $altre_sedi = dci_get_meta("altre_sedi", $prefix, $post->ID);
        $punti_contatto = dci_get_meta("contatti", $prefix, $post->ID);
        $allegati = dci_get_meta("allegati", $prefix, $post->ID);
        $more_info = dci_get_wysiwyg_field("ulteriori_informazioni");
        $argomenti = get_the_terms($post, 'argomenti');

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
                                    <h1>
                                        <?php the_title(); ?>
                                    </h1>
                                </div>
                                <p class="subtitle-small mb-3" data-element="service-description">
                                    <?php echo $descrizione_breve ?>
                                </p>
                                <button type="button" class="btn btn-outline-primary t-primary bg-white mobile-full"
                                    onclick="location.href='<?php echo dci_get_template_page_url('page-templates/prenota-appuntamento.php'); ?>';">
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
                        <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina"
                            data-bs-navscroll>
                            <div class="navbar-custom" id="navbarNavProgress">
                                <div class="menu-wrapper">
                                    <div class="link-list-wrapper">
                                        <div class="accordion">
                                            <div class="accordion-item">
                                                <span class="accordion-header" id="accordion-title-one">
                                                    <button class="accordion-button pb-10 px-3 text-uppercase" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-one"
                                                        aria-expanded="true" aria-controls="collapse-one">
                                                        Indice della pagina
                                                        <svg class="icon icon-xs right">
                                                            <use href="#it-expand"></use>
                                                        </svg>
                                                    </button>
                                                </span>
                                                <div class="progress">
                                                    <div class="progress-bar it-navscroll-progressbar" role="progressbar"
                                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div id="collapse-one" class="accordion-collapse collapse show"
                                                    role="region" aria-labelledby="accordion-title-one">
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
                        <section class="it-page-section mb-30" id="competenze">
                            <h2 class="mb-3">Competenze</h2>
                            <div class="richtext-wrapper lora" data-element="uo-competenze">
                                <?php echo $competenze ?>
                            </div>
                        </section>

                        <section class="it-page-section mb-30" id="tipo-uo">
                            <h2 class="mb-3">Tipologia di organizzazione</h2>
                            <div class="richtext-wrapper lora" data-element="uo-tipo">
                                <?php foreach ($tipo_organizzazione as $tipo) {
                                    echo ucfirst($tipo);
                                } ?>
                            </div>
                        </section>

                        <?php if ($unita_organizzativa_genitore) { ?>
                            <section class="it-page-section mb-30" id="area">
                                <h2 class="mb-3">Area di riferimento</h2>
                                <div class="richtext-wrapper" data-element="uo-area">
                                    <?php foreach ($unita_organizzativa_genitore as $post_id) { ?>
                                        <div class="col-lg-6 col-md-12">
                                            <?php get_template_part("template-parts/unita-organizzativa/card-full-ico"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <?php if ($responsabili && is_array($responsabili) && count($responsabili)) { ?>
                            <section class="it-page-section mb-30" id="responsabile">
                                <h2 class="mb-3">Responsabile</h2>
                                <div class="richtext-wrapper" data-element="uo-responsabile">
                                    <?php foreach ($responsabili as $post_id) { ?>
                                        <div class="col-lg-6 col-md-12">
                                            <?php get_template_part("template-parts/persona/card-ico"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <?php if (is_array($persone) && count($persone)) { ?>
                            <section class="it-page-section mb-30" id="persone">
                                <h2 class="mb-3">Persone</h2>
                                <div class="richtext-wrapper" data-element="uo-persone">
                                    Tutte le persone che fanno parte di questo ufficio:
                                    <?php foreach ($persone as $post_id) { ?>
                                        <div class="col-lg-6 col-md-12">
                                            <?php get_template_part("template-parts/persona/card-ico"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <?php if ($servizi && is_array($servizi) && count($servizi)) { ?>
                            <section class="it-page-section mb-30" id="servizi">
                                <h2 class="mb-3">Servizi collegati</h2>
                                <div class="richtext-wrapper" data-element="uo-servizi">
                                    <?php foreach ($servizi as $post_id) { ?>
                                        <div class="col-lg-6 col-md-12">
                                            <?php get_template_part("template-parts/servizio/card-ico"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <section class="it-page-section mb-30" id="sede-principale">
                            <h2 class="mb-3">Sede principale</h2>
                            <div class="richtext-wrapper" data-element="uo-sede-principale">
                                <div class="col-lg-6 col-md-12">
                                    <?php 
                                    $post_id = $sede_principale_id;
                                    get_template_part("template-parts/luogo/card-ico"); ?>
                                </div>
                            </div>
                        </section>

                        <?php if ($altre_sedi && is_array($altre_sedi) && count($altre_sedi)) { ?>
                            <section class="it-page-section mb-30" id="altre-sedi">
                                <h2 class="mb-3">Altre sedi</h2>
                                <div class="richtext-wrapper" data-element="uo-altre-sedi">
                                    <?php foreach ($altre_sedi as $post_id) { ?>
                                        <div class="col-lg-6 col-md-12">
                                            <?php get_template_part("template-parts/luogo/card-ico"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                            <section class="it-page-section mb-30" id="contatti">
                                <h2 class="mb-3">Contatti</h2>
                                <div class="richtext-wrapper" data-element="uo-contatti">
                                    <?php foreach ($punti_contatto as $post_id) { ?>
                                        <div class="col-lg-6 col-md-12">
                                            <?php get_template_part("template-parts/punto-contatto/card-ico"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <?php if ($allegati && is_array($allegati) && count($allegati) > 0) { ?>
                            <section class="it-page-section mb-30" id="allegati">
                                <h2 class="mb-3">Documenti</h2>
                                <div class="richtext-wrapper" data-element="uo-allegati">
                                    <?php foreach ($allegati as $allegato_id) { ?>
                                        <div class="col-xl-6 col-lg-8 col-md-12 ">
                                            <?php
                                            $documento = get_post($allegato_id);
                                            $with_border = true;
                                            get_template_part("template-parts/documento/card"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                        <?php } ?>

                        <?php if ($more_info) { ?>
                            <section class="it-page-section mb-30" id="more-info">
                                <h2 class="mb-3">Ulteriori informazioni</h2>
                                <div class="richtext-wrapper lora">
                                    <?php echo $more_info ?>
                                </div>
                            </section>
                        <?php } ?>


                        <?php if ($argomenti && is_array($argomenti) && count($argomenti) > 0) { ?>
                            <div class="col-12 mb-30">
                                <span class="text-paragraph-small">Argomenti:</span>
                                <?php get_template_part("template-parts/single/argomenti"); ?>
                            </div>
                        <?php } ?>

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