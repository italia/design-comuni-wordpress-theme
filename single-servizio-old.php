<?php
/**
 * Servizio_old template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $uo_id, $with_border, $pc_id, $documento;

get_header();
?>

    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            $stato = dci_get_meta("stato");
            $motivo_stato = dci_get_meta("motivo_stato");
            $sottotitolo = dci_get_meta("sottotitolo");
            $descrizione_breve = dci_get_meta("descrizione_breve");
            $destinatari = dci_get_wysiwyg_field("a_chi_e_rivolto");
            $come_fare = dci_get_wysiwyg_field("come_fare");
            $canale_fisico_text = dci_get_meta("canale_fisico_text");
            $canale_fisico_uffici = dci_get_meta("canale_fisico_uffici");            
            $cosa_serve = dci_get_wysiwyg_field("cosa_serve_introduzione");
            $costi = dci_get_wysiwyg_field("costi");
            $vincoli = dci_get_wysiwyg_field("vincoli");
            $tempi = dci_get_wysiwyg_field("tempi_text");
            $casi_particolari = dci_get_wysiwyg_field("casi_particolari");
            $contatti = dci_get_meta("punti_contatto");    
            $documenti = dci_get_meta("documenti");  
            $more_info = dci_get_wysiwyg_field("ulteriori_informazioni");

            
            $descrizione = dci_get_wysiwyg_field("descrizione_estesa");
            $copertura_geografica = dci_get_meta("copertura_geografica");
            $cosa_serve_list = dci_get_meta("cosa_serve_list");
            $output = dci_get_meta("output");
            $fasi_scadenze = dci_get_meta("fasi_scadenze");
            $costi = dci_get_wysiwyg_field("costi");
            $canale_digitale = dci_get_meta("canale_digitale");
            $canale_fisico_prenotazione = dci_get_meta("canale_fisico_prenotazione");
            $canale_fisico_id = dci_get_meta("canale_fisico");
            $canale_fisico = get_post($canale_fisico_id); 
            $condizioni_servizio = dci_get_meta("condizioni_servizio");
            $contatti_ids = dci_get_meta("punti_contatto");
            ?>
            <p class="WIP">WIP</p>
            <div class="container px-4 my-4">
                <div class="row">
                    <div class="col px-lg-4">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 px-lg-4 py-lg-2">
                        <h1><?php the_title(); ?></h1>
                        <p>
                            <?php echo $descrizione_breve; ?>
                        </p>
                        <?php if ($stato == 'false') { ?>
                            <div class="alert alert-warning my-md-4 my-lg-4">
                                <?php echo $motivo_stato; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <?php get_template_part('template-parts/single/actions'); ?>
                    </div>
                </div>
            </div>
            <?php #get_template_part('template-parts/single/image-large'); ?>
            <div class="container">
                <div class="row border-top row-column-border row-column-menu-left border-light">
                    <aside class="col-lg-4">
                        <div class="d-none d-lg-block sticky-wrapper navbar-wrapper">
                            <nav class="navbar it-navscroll-wrapper it-top-navscroll navbar-expand-lg">
                            <button
                                class="custom-navbar-toggler text-uppercase"
                                type="button"
                                aria-controls="navbarNav"
                                aria-expanded="false"
                                aria-label="Toggle navigation"
                                data-bs-target="#navbarNav"
                            >
                                <span class="it-list"></span>Indice della pagina
                            </button>
                            <div class="navbar-collapsable" id="navbarNav">
                                <div class="overlay"></div>
                                <div class="close-div visually-hidden">
                                <button class="btn close-menu" type="button">
                                    <span class="it-close"></span>Chiudi
                                </button>
                                </div>
                                <a class="it-back-button" href="#"
                                ><svg class="icon icon-sm icon-primary align-top">
                                    <use
                                    xlink:href="#it-chevron-left"
                                    ></use>
                                </svg>
                                <span>Torna indietro</span></a
                                >
                                <div class="menu-wrapper">
                                <div class="link-list-wrapper menu-link-list">
                                    <h3 class="no_toc border-light">Indice della pagina</h3>
                                    <ul class="link-list">
                                    <?php if( $descrizione ) { ?>
                                    <li class="nav-item active">
                                        <a class="nav-link active" href="#cos-e" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Cos'è</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( $destinatari ) { ?>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="#a-chi-si-rivolge" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>A chi si rivolge</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="#accedi-al-servizio" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Accedi al servizio</span></a
                                        >
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="#cosa-serve" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Cosa serve</span></a
                                        >
                                    </li>
                                    <?php if( $costi || $vincoli) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#costi-e-vincoli" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Costi e vincoli</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( $tempi ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tempi-e-scadenze" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Tempi e scadenze</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( $casi_particolari ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#casi-particolari" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Casi particolari</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( is_array($contatti) && count($contatti) ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#contatti" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Contatti</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( is_array($documenti) && count($documenti) ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#documenti" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Documenti</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( $more_info ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ulteriori-informazioni" aria-label="Vai alla sezione _______" title="Vai alla sezione _________ "
                                        ><span>Ulteriori informazioni</span></a
                                        >
                                    </li>
                                    <?php }?>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </nav>
                        </div>
                    </aside>
                    <section class="col-lg-8 it-page-sections-container border-light">
                    <article id="cos-e" class="it-page-section anchor-offset">
                        <h4>Cos'è?</h4>
                        <p class="text-serif">
                            <?php echo $descrizione; ?>
                        </p>
                    </article>
                    <article id="a-chi-si-rivolge" class="it-page-section anchor-offset">
                        <h4>A chi si rivolge</h4>
                        <?php echo $destinatari; ?>
                    </article>
                    <article id="accedi-al-servizio" class="it-page-section anchor-offset">
                        <h4>Accedi al servizio</h4>
                        <?php echo $come_fare; ?>
                    </article>
                    <article id="accesso-uffici">
                        <h5 class="card-title">Accesso agli uffici</h5>
                        <p class="font-serif">
                            <?php echo $canale_fisico_text; ?>
                        </p>
                        <?php foreach ($canale_fisico_uffici as $uo_id) {
                            $with_border = true;
                            get_template_part("template-parts/unita-organizzativa/card-full");
                        } ?>
                    </article>
                    <article id="cosa-serve" class="it-page-section anchor-offset"> 
                        <h4>Cosa serve</h4>
                        <div class="callout">
                            <div class="callout-title">
                            <svg class="icon">
                                <use xlink:href="#it-info-circle"></use>
                            </svg>
                        </div>
                            <?php echo $cosa_serve; ?>
                        </div>
                    </article>
                    <?php if( $costi || $vincoli) { ?>
                    <article id="costi-e-vincoli" class="it-page-section anchor-offset mt-5">
                        <h4>Costi e vincoli</h4>
                        <?php echo $costi; ?>
                        <?php echo $vincoli; ?>                        
                    </article>
                    <?php };
                    if( $tempi) { ?>
                    <article id="tempi-e-scadenze" class="it-page-section anchor-offset">
                        <h4>Tempi e scadenze</h4>
                        <?php echo $tempi; ?>                        
                    </article>
                    <?php } ?>
                    <?php if( $casi_particolari) { ?>
                    <article id="casi-particolari" class="it-page-section anchor-offset">   
                        <h4>Casi particolari</h4>
                        <?php echo $casi_particolari; ?>    
                    </article>
                    <?php } ?>
                    <?php if( is_array($contatti) && count($contatti) ) { ?>
                    <article id="contatti" class="it-page-section anchor-offset">
                        <h4>Contatti</h4>
                        <div class="card-wrapper rounded shadow-sm h-auto my-5">
                            <?php foreach ($contatti as $pc_id) {
                                get_template_part("template-parts/punto-contatto/card");
                            } ?>
                        </div>
                    </article>
                    <?php } ?>
                    <?php if( is_array($documenti) && count($documenti) ) { ?>
                    <article id="documenti" class="it-page-section anchor-offset mt-5">
                        <h4>Documenti</h4>
                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-2">
                            <?php foreach ($documenti as $doc_id) { 
                                $documento = get_post($doc_id);
                                get_template_part("template-parts/documento/card");
                            } ?>
                        </div>
                    </article>
                    <?php } ?>
                    <?php if( $more_info ) { ?>
                    <article id="ulteriori-informazioni" class="it-page-section anchor-offset mt-5">
                        <h4>Ulteriori informazioni</h4>
                        <div class="callout">
                            <div class="callout-title">
                                <svg class="icon">
                                    <use xlink:href="#it-info-circle"></use>
                                </svg>
                            </div>
                            <?php echo $more_info; ?>
                        </div>
                    </article>
                    <?php } ?>
                    <?php get_template_part('template-parts/single/page_bottom'); ?>
                    </section>
                </div>
            </div>
            <?php get_template_part('template-parts/single/more-posts'); ?>


        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();
