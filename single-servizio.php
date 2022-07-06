<?php
/**
 * Servizio template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */
global $uo_id;

get_header();
?>


    <main>
        <?php
        while ( have_posts() ) :
            the_post();

            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            // prefix: _dci_servizio_
            $stato = dci_get_meta("stato");
            // $motivo_stato = dci_get_meta("motivo_stato");
            $sottotitolo = dci_get_meta("sottotitolo");
            $descrizione_breve = dci_get_meta("descrizione_breve");
            $destinatari = dci_get_meta("a_chi_e_rivolto");
            // $destinatari_intro = dci_get_meta("destinatari_introduzione");
            // $destinatari_list = dci_get_meta("destinatari_list");
            $descrizione = dci_get_meta("descrizione_estesa");
            // $copertura_geografica = dci_get_meta("copertura_geografica");
            $come_fare = dci_get_meta("come_fare");
            $cosa_serve_intro = dci_get_meta("cosa_serve_introduzione");
            $cosa_serve_list = dci_get_meta("cosa_serve_list");
            $output = dci_get_meta("output");
            $fasi_scadenze = dci_get_meta("fasi");
            $costi = dci_get_meta("costi");
            //canali di prenotazione
            $canale_digitale_text = dci_get_meta("canale_digitale_text");
            $canale_digitale_label = dci_get_meta("canale_digitale_label");
            $canale_digitale_link = dci_get_meta("canale_digitale_link");
            $canale_fisico_text = dci_get_meta("canale_fisico_text");
            $canale_fisico_uffici = dci_get_meta("canale_fisico_uffici");

            $more_info = dci_get_meta("ulteriori_informazioni");
            $condizioni_servizio = dci_get_meta("condizioni_servizio");
            $contatti_ids = dci_get_meta("punti_contatto");     
            $contatti = array();            
            foreach ($contatti_ids as $contatto) {
                $item = get_post($contatto);
                $contatti[] = $item;
            }       
            $uo_id = intval(dci_get_meta("unita_responsabile"));
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
                                    <h1 class="title-xxxlarge" data-element="service-title">
                                        <?php the_title(); ?>
                                    </h1>
                                    <?php if ( $stato == 'true' ) {?>
                                        <div class="d-flex flex-wrap cmp-heading__tag">
                                            <div class="cmp-tag">
                                            <span class="cmp-tag__tag title-xsmall text-decoration-none text-button" data-element="service-status">Servizio attivo</span>
                                            </div>
                                        </div>
                                    <?php } else {?>
                                        <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
                                            <div class="cmp-tag">
                                            <span class="cmp-tag__tag title-xsmall text-decoration-none text-button" data-element="service-status">Servizio non attivo</span>
                                            </div>
                                            <!-- <div><?php #echo $motivo_stato; ?></div> -->
                                        </div>
                                    <?php } ?>
                                    <p class="subtitle-small mb-3" data-element="service-description">
                                        <?php echo $sottotitolo ?>
                                    </p>
                                    <a href="<?php echo $canale_digitale_link; ?>" aria-label="Vai alla pagina <?php echo $canale_digitale_label; ?> " class="btn btn-primary mobile-full mb-4">
                                        <span><?php echo $canale_digitale_label; ?></span>
                                    </a>
                                </div>
                                <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0">
                                    <?php get_template_part('template-parts/single/actions'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-none d-lg-block mt-2"/>
                </div>
            </div>
            <div class="container">
                <div class="row mt-4 mt-lg-80 pb-lg-80 pb-40">
                    <div class="col-12 col-lg-3 mb-4 border-col">
                        <aside class="cmp-navscroll sticky-top" aria-labelledby="accordion-title">
                        <div class="inline-menu">
                            <div class="link-list-wrapper">
                            <ul class="link-list">
                                <li>
                                    <a class="list-item large medium right-icon p-0 text-decoration-none" href="#collapseOne" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapseOne" data-focus-mouse="true" aria-label="Apri e chiudi il menù INDICE DELLA PAGINA" title="Apri e chiudi il menù INDICE DELLA PAGINA">
                                        <span class="list-item-title-icon-wrapper pb-10 px-3">
                                        <span id="accordion-title" class="title-xsmall-semi-bold">INDICE DELLA PAGINA</span>
                                        <svg class="icon icon-xs right">
                                            <use href="#it-expand"></use>
                                        </svg>
                                        </span>
                                        <!-- Progress Bar -->
                                        <div class="progress bg-light">
                                        <div class="progress-bar" role="progressbar" aria-label="Progress bar dell'indice della pagina" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </a>
                                    <ul class="link-sublist collapse show" id="collapseOne" data-element="page-index">
                                    <?php if ($destinatari ) { ?>
                                        <li>
                                            <a class="list-item" href="#who-needs" aria-label="Vai alla sezione A chi è rivolto" title="Vai alla sezione A chi è rivolto"
                                            ><span class="title-medium">A chi è rivolto</span></a
                                            >
                                        </li>
                                        <?php } ?>
                                        <?php if ( $descrizione ) { ?>
                                            <li>
                                                <a class="list-item" href="#description" aria-label="Vai alla sezione Descrizione" title="Vai alla sezione Descrizione">
                                                <span class="title-medium">Descrizione</span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $come_fare ) { ?>
                                            <li>
                                            <a class="list-item" href="#how-to" aria-label="Vai alla sezione Come fare" title="Vai alla sezione Come fare">
                                                <span class="title-medium">Come fare</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( is_array($cosa_serve_list) ) { ?>
                                            <li>
                                            <a class="list-item" href="#needed" aria-label="Vai alla sezione Cosa serve" title="Vai alla sezione Cosa serve">
                                                <span class="title-medium">Cosa serve</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $output ) { ?>
                                            <li>
                                            <a class="list-item" href="#obtain" aria-label="Vai alla sezione Cosa si ottiene" title="Vai alla sezione Cosa si ottiene">
                                                <span class="title-medium">Cosa si ottiene</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( is_array($fasi_scadenze) && count($fasi_scadenze)) { ?>
                                            <li>
                                            <a class="list-item" href="#deadlines" aria-label="Vai alla sezione Tempi e scadenze" title="Vai alla sezione Tempi e scadenze">
                                                <span class="title-medium">Tempi e scadenze</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $costi ) { ?>
                                            <li>
                                            <a class="list-item" href="#costs" aria-label="Vai alla sezione Quanto costa" title="Vai alla sezione Quanto costa">
                                                <span class="title-medium">Quanto costa</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $canale_digitale || ( is_array($canale_fisico_uffici) && count($canale_fisico_uffici)) ) { ?>
                                            <li>
                                            <a class="list-item" href="#submit-request" aria-label="Vai alla sezione Presenta la domanda" title="Vai alla sezione Presenta la domanda">
                                                <span class="title-medium">Presenta la domanda</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $more_info ) { ?>
                                            <li>
                                            <a class="list-item" href="#more-info" aria-label="Vai alla sezione Ulteriori informazioni" title="Vai alla sezione Ulteriori informazioni">
                                                <span class="title-medium">Ulteriori informazioni</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                            </div>
                        </div>
                        </aside>      
                    </div>
                    <div class="col-12 col-lg-8 offset-lg-1">
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="who-needs">A chi è rivolto</h2>
                            <?php echo $destinatari ?>
                        </section>
                        <?php if ($descrizione) { ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="description">Descrizione</h2>
                            <p class="text-paragraph lora"><?php echo $descrizione ?></p>
                        </section>
                        <?php } ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="how-to">Come fare</h2>
                            <p class="text-paragraph lora"> 
                                <?php echo $come_fare ?>
                            </p>
                        </section>
                        <section class="mb-30 has-bg-grey p-3">
                            <h2 class="title-xxlarge mb-3" id="needed">Cosa serve</h2>
                            <div class="richtext-wrapper lora">
                                <?php echo $cosa_serve_intro ?>
                                <ul >
                                    <?php foreach ($cosa_serve_list as $cosa_serve_item) { ?>
                                        <li><span><?php echo $cosa_serve_item ?></span></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </section>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="obtain">Cosa si ottiene</h2>
                            <p class="text-paragraph lora"><?php echo $output ?></p>
                        </section>
                        <?php if ( is_array($fasi_scadenze) && count($fasi_scadenze) ) { ?>
                        <section class="mb-30">
                            <div class="cmp-timeline">
                                <h2 class="title-xxlarge mb-3" id="deadlines">Tempi e scadenze</h2>
                                <p class="text-paragraph mb-3 lora">Le graduatorie verranno aggiornate ogni mese con nuove assegnazioni e trasferimenti in base ai posti disponibili.</p>
                                <div class="calendar-vertical mb-3">
                                    <?php foreach ($fasi_scadenze as $fase_id) {        
                                        $fase = get_post($fase_id);              
                                        $data = dci_get_meta('data_fase', '_dci_fase_', $fase_id);
                                        $arrdata =  explode("-", $data);
                                        $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10)); // March
                                        ?>
                                        <div class="calendar-date">
                                            <div class="calendar-date-day">
                                                <small class="calendar-date-day__year"><?php echo $arrdata[2]; ?></small>
                                                <span class="title-xxlarge-regular d-flex justify-content-center"><?php echo $arrdata[0]; ?></span>
                                                <small class="calendar-date-day__month"><?php echo $monthName; ?></small>
                                            </div>
                                            <div class="calendar-date-description rounded">
                                                <div class="calendar-date-description-content">
                                                    <h3 class="title-medium-2 mb-0">
                                                        <?php echo $fase->post_title; ?>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>                            
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                        <?php if ( $costi ) { ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="costs">Quanto costa</h2>
                            <div class="richtext-wrapper lora"><?php echo $costi ?></div>
                        </section>
                        <?php } ?>
                        <section class="mb-30 has-bg-grey p-4">
                            <h2 class="title-xxlarge mb-3" id="submit-request">Dove presentare la domanda</h2>
                            <p class="text-paragraph lora mb-4"><?php echo $canale_digitale_text; ?></p>
                            
                            <a href="<?php echo $canale_digitale_link; ?>" aria-label="Vai alla pagina <?php echo $canale_digitale_label; ?> " class="btn btn-primary mobile-full mb-4">
                                <span><?php echo $canale_digitale_label; ?></span>
                            </a>
                            <p class="text-paragraph lora mb-4"><?php echo $canale_fisico_text; ?></p>
                            <?php foreach ($canale_fisico_uffici as $uo_id) { 
                                $ufficio = get_post($uo_id);    
                            ?>
                            <p class="text-paragraph t-primary mb-4">
                                <a href="<?php echo get_permalink($ufficio); ?>" aria-label="Vai a Pranota appuntamento presso <?php echo $ufficio->post_title; ?>" title="Vai a Pranota appuntamento presso <?php echo $ufficio->post_title; ?>"><?php echo $ufficio->post_title; ?> [prenota]</a>
                            </p>
                            <?php } ?>
                        </section>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="more-info">Ulteriori informazioni</h2>
                            <h3 class="mb-3 subtitle-medium" id="more-info">Graduatorie di accesso</h3>
                            <p class="text-paragraph lora">
                                <?php echo $more_info ?>
                            </p>
                        </section>
                        <section class="it-page-section">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h6><small class="fw-semibold">Questa pagina è gestita da</small></h6>
                                    <div class="card-wrapper rounded h-auto mt-10">
                                        <?php 
                                            $with_border = true;
                                            get_template_part("template-parts/unita-organizzativa/card"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h6><small>Argomenti:</small></h6>
                                    <?php foreach ( $argomenti as $item ) { ?>
                                        <a 
                                        class="chip-label text-white" 
                                        href="<?php echo get_term_link($item); ?>" 
                                        title="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
                                        aria-label="<?php _e("Vai all'argomento", "design_comuni_italia"); ?>: <?php echo $item->name; ?>"
                                        >
                                            <div class="chip chip-simple bg-success">
                                                <span class="chip-label text-white"><?php echo $item->name; ?></span>
                                            </div>                
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
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
