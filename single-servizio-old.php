<?php
/**
 * Servizio template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Scuole_Italia
 */

get_header();
?>


    <main>
        <?php
        while ( have_posts() ) :
            the_post();

            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            // prefix: _dci_servizio_
            $stato = dci_get_meta("stato");
            $motivo_stato = dci_get_meta("motivo_stato");
            $sottotitolo = dci_get_meta("sottotitolo");
            $descrizione_breve = dci_get_meta("descrizione_breve");
            $destinatari = dci_get_meta("a_chi_e_rivolto");
            $destinatari_intro = dci_get_meta("destinatari_introduzione");
            $destinatari_list = dci_get_meta("destinatari_list");
            $descrizione = dci_get_meta("descrizione_estesa");
            $copertura_geografica = dci_get_meta("copertura_geografica");
            $come_fare = dci_get_meta("come_fare");
            $cosa_serve_intro = dci_get_meta("cosa_serve_introduzione");
            $cosa_serve_list = dci_get_meta("cosa_serve_list");
            $output = dci_get_meta("output");
            $fasi_scadenze = dci_get_meta("fasi_scadenze");
            $costi = dci_get_meta("costi");
            $canale_digitale = dci_get_meta("canale_digitale");
            $canale_fisico_prenotazione = dci_get_meta("canale_fisico_prenotazione");
            $canale_fisico_id = dci_get_meta("canale_fisico");
            $canale_fisico = get_post($canale_fisico_id); 
            $more_info = dci_get_meta("ulteriori_informazioni");
            $condizioni_servizio = dci_get_meta("condizioni_servizio");
            $contatti_ids = dci_get_meta("punti_contatto");     
            $contatti = array();
            
            foreach ($contatti_ids as $contatto) {
                $item = get_post($contatto);
                $contatti[] = $item;
            }       
            ?>
            <div class="container" id="scrollDemo">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>

                        <div class="cmp-heading">
                            <h1 class="title-xxxlarge">
                                <?php the_title(); ?>
                            </h1>
                            <?php if ( $stato == 'true' ) {?>
                            <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
                                <div class="cmp-tag">
                                <a class="cmp-tag__tag title-xsmall u-main-green" href="#">Servizio attivo</a>
                                </div>
                            </div>
                            <?php } else {?>
                            <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
                                <div class="cmp-tag">
                                <a class="cmp-tag__tag title-xsmall u-main-green" href="#">Servizio non attivo</a>
                                </div>
                                <div>MOTIVO: <?php echo $motivo_stato ?></div>
                            </div>
                            <?php } ?>
                            <p class="subtitle-small">
                                <?php echo $sottotitolo ?>
                            </p>
                            <div class="mt-25 mb-10">
                                <button type="button" class="btn btn-primary text-button">
                                Richiesta di iscrizione online
                                </button>
                            </div>
                            <!-- <p class="mb-30 d-md-none">
                            Termine presentazione:
                            <span><strong>entro 10 giorni</strong></span>
                            </p> -->
                        </div>
                    </div>
                    <hr/>
                    <div class="row mt-lg-50">
                        <div class="col-12 col-lg-4 d-lg-flex mb-4">
                            <div class="col-12 col-lg-10">
                                <div class="cmp-navscroll">
                                    <nav class="inline-menu">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list">
                                            <li>
                                            <a 
                                                class="list-item large medium right-icon p-0 text-decoration-none"
                                                href="#collapseOne"
                                                data-bs-toggle="collapse"
                                                aria-expanded="true"
                                                aria-controls="collapseOne"
                                                data-focus-mouse="true"
                                                >
                                                <span class="list-item-title-icon-wrapper pb-10 px-3">
                                                    <span  id="accordion-title" class="title-xsmall-semi-bold">
                                                        INDICE DELLA PAGINA
                                                    </span>
                                                    <svg class="icon icon-xs icon-primary right">
                                                        <use href="#it-expand"></use>
                                                    </svg>
                                                </span>
                                                <div class="progress bg-light">
                                                    <div
                                                    id="progress-bar"
                                                    class="progress-bar"
                                                    role="progressbar"
                                                    aria-label="Progress bar dell'indice della pagina"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    ></div></div
                                                ></a>
                                                <ul class="link-sublist collapse show" id="collapseOne">
                                                    <?php if ($destinatari || is_array($destinatari_list)) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-destinatari"
                                                            ><span>A chi è rivolto</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $descrizione ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-descrizione"
                                                            ><span>Descrizione</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $copertura_geografica ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-copertura_geografica"
                                                            ><span>Copertura geografica</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $come_fare ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-come_fare"
                                                            ><span>Come fare</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( is_array($cosa_serve_list) ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-cosa_serve"
                                                            ><span>Cosa serve</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( is_array($output) ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-output"
                                                            ><span>Cosa si ottiene</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( is_array($fasi_scadenze) ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-fasi_scadenze"
                                                            ><span>Tempi e scadenze</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $costi ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-costi"
                                                            ><span>Costi</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $canale_digitale || $canale_fisico || $canale_fisico_prenotazione ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-prenota"
                                                            ><span>Accedi al servizio</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $more_info ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-more_info"
                                                            ><span>Ulteriori informazioni</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( $condizioni_servizio ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-condizioni_servizio"
                                                            ><span>Condizioni di servizio</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    <?php if ( is_array($contatti) ) { ?>
                                                        <li>
                                                            <a class="list-item" href="#art-par-contatti"
                                                            ><span>Contatti</span></a
                                                            >
                                                        </li>
                                                    <?php } ?>
                                                    
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 offset-lg-1">
                            <div class="cmp-card w-100" >
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-destinatari">A chi è rivolto</h2>
                                    </div>
                                    <div class="subtitle-small mb-4">
                                        <?php echo $destinatari ?>
                                    </div>
                                    </div>
                                    <div class="card-body p-0">
                                    <p class="lora">
                                        <?php echo $destinatari_intro ?>
                                        <ul class="lora">
                                            <?php foreach ($destinatari_list as $destinatario) { ?>
                                                <li><?php echo $destinatario ?></li>
                                            <?php } ?>
                                        </ul>
                                    </p>
                                    </div>
                                </div>
                            </div> <!-- A chi è rivolto -->
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge" id="art-par-descrizione">Descrizione</h2>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                    <p class="lora">
                                        <?php echo $descrizione ?>
                                    </p>
                                    </div>
                                </div>
                            </div> <!-- Descrizione -->
                            <?php if ( $copertura_geografica ) { ?>
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-copertura_geografica">Copertura geografica</h2>
                                    </div>
                                    </div>
                                    <div class="card-body p-0">
                                    <p class="lora">
                                        <?php echo $copertura_geografica ?>
                                    </p>
                                    </div>
                                </div>
                            </div><!-- Copertura geografica -->
                            <?php } ?>
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-come_fare">Come fare</h2>
                                    </div>
                                    <div class="subtitle-small mb-4"></div>
                                    </div>
                                    <div class="card-body p-0">
                                    <p class="text-paragraph lora">
                                        <?php echo $come_fare ?>
                                    </p>
                                    </div>
                                </div>
                            </div> <!-- Come fare -->
                            <div class="cmp-card w-100">
                                <div class="card has-bkg-grey p-3">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-cosa_serve">Cosa serve</h2>
                                    </div>
                                    <div class="subtitle-small mb-4"></div>
                                    </div>
                                    <div class="card-body p-0">
                                    <div class="cmp-ul-list">
                                        <div class="link-list-heading">
                                        <strong><?php echo $cosa_serve_intro ?></strong>
                                        </div>
                                        <ul class="link-list lora">
                                            <?php foreach ($cosa_serve_list as $cosa_serve_item) { ?>
                                                <li><span><?php echo $cosa_serve_item ?></span></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    </div>
                                </div>
                            </div> <!-- A cosa serve -->
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-output">Cosa si ottiene</h2>
                                    </div>
                                    <div class="subtitle-small mb-4"></div>
                                    </div>
                                    <div class="card-body p-0">
                                    <p class="text-paragraph lora">
                                        <?php echo $output ?>
                                    </p>
                                    </div>
                                </div>
                            </div> <!-- Cosa si ottiene -->
                            <div class="cmp-timeline">
                                <h2 class="title-xxlarge mb-3">Tempi e scadenze</h2>
                                <p class="text-paragraph mb-3">
                                    Le graduatorie verranno aggiornate ogni mese con nuove
                                    assegnazioni e trasferimenti in base ai posti disponibili.
                                </p>
                                <div class="calendar-vertical mb-5">
                                <?php foreach ($fasi_scadenze as $fase) {                                         
                                    $arrdata =  explode("-", $fase["data_fase"]);
                                    $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10)); // March
                                    ?>
                                    <div class="calendar-date">
                                        <div class="calendar-date-day">
                                            <small><?php echo $arrdata[2]; ?></small>
                                            <span class="title-xxlarge-regular"><?php echo $arrdata[0];; ?></span>
                                            <small><?php echo $monthName; ?></small>
                                        </div>
                                        <div class="calendar-date-description rounded">
                                            <div class="calendar-date-description-content">
                                            <h3 class="text-purplelight title-medium-2 mb-0">
                                                <?php echo $fase["titolo_fase"]; ?>
                                            </h3>
                                            </div>
                                        </div> 
                                    </div>
                                <?php } ?>
                            </div> <!-- Tempi e scadenze -->
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge" id="art-par-costi">Quanto costa</h2>
                                        </div>
                                        <div class="subtitle-small mb-4"></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <p class="text-paragraph lora">
                                            <?php echo $costi ?>
                                        </p>
                                    </div>
                                </div>
                            </div> <!-- Cosa si ottiene -->
                            <div class="cmp-card w-100">
                                <div class="card has-bkg-grey p-3">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge" id="art-par-prenota">Accedi al servizio</h2>
                                        </div>
                                        <div class="subtitle-small mb-4">
                                            Puoi presentare la richiesta di iscrizione online,
                                            attraverso il servizio digitale Invio richiesta di
                                            iscrizione, oppure, su appuntamento, presso gli uffici Asili
                                            nido.
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <button type="button" class="btn btn-primary w-100" onclick="window.open('<?php echo $canale_digitale ?>', '_blank').focus();">
                                            Richiesta di iscrizione online
                                        </button>
                                        <p class="text-paragraph mt-25 mb-25">
                                        Oppure, puoi prenotare un appuntamento e presso gli uffici.
                                        </p>
                                        <button
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#"
                                            class="btn btn-primary w-100 btn-outline-primary t-primary"
                                            onclick="window.open('<?php echo $canale_fisico_prenotazione ?>', '_blank').focus();"
                                        >
                                            <span>Prenota appuntamento</span>
                                        </button>
                                    </div>
                                </div>
                            </div> <!-- Accedi al servizio -->
                            <?php if ( $more_info ) { ?>
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-more_info">Ulteriori informazioni</h2>
                                    </div>
                                    <div class="subtitle-small mb-4"></div>
                                    </div>
                                    <div class="card-body p-0">
                                    <p class="text-paragraph lora">
                                        <?php echo $more_info ?>
                                    </p>
                                    </div>
                                </div>
                            </div><!-- Ulteriori informazioni -->
                            <?php } ?>
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge" id="art-par-condizioni_servizio">Condizioni di servizio</h2>
                                        </div>
                                        <div class="subtitle-small mb-4">
                                            Scarica e leggi il seguente file per conoscere i terminin e
                                            le condizioni del servizio
                                        </div>
                                        <div class="card-body p-0">
                                        <a class="list-item icon-left mb-30 d-inline-block" href="<?php echo $condizioni_servizio ?>"
                                            ><span class="list-item-title-icon-wrapper"
                                            ><svg class="icon icon-primary">
                                                <use href="#it-clip"></use>
                                            </svg>
                                            <span class="list-item-title text-primary"
                                                >Termini e condizioni di servizio</span
                                            ></span
                                            ></a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- Condizioni di servizio -->
                            <div class="cmp-card w-100">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge" id="art-par-contatti">Contatti</h2>
                                    </div>
                                    <div class="subtitle-small mb-4"></div>
                                    </div>
                                    <?php foreach ($contatti as $punto_contatto) {
                                        get_template_part("template-parts/punto-contatto/card-old");
                                    }?>
                                </div>
                            </div> <!-- Contatti -->
                            <?php 
                            $with_page_bottom = true;
                            get_template_part("template-parts/common/badges-argomenti"); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?php get_template_part("template-parts/common/valuta-servizio"); ?>
            <?php get_template_part("template-parts/single/related"); ?>
            <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

        <?php
        endwhile; // End of the loop.
        ?>
    </main>
    <?php get_template_part("template-parts/common/evaluate-scrollbar"); ?>
<?php
get_footer();
