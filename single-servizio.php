<?php
/**
 * Servizio template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */
global $uo_id, $file_url, $hide_arguments;

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
            $come_fare = dci_get_meta("come_fare");
            $cosa_serve_intro = dci_get_meta("cosa_serve_introduzione");
            $cosa_serve_list = dci_get_meta("cosa_serve_list");
            $output = dci_get_meta("output");
            $fasi_scadenze_intro = dci_get_meta("tempi_text");
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
            $uo_id = intval(dci_get_meta("unita_responsabile"));
            $argomenti = get_the_terms($post, 'argomenti');

            // valori per metatag
            $categorie = get_the_terms($post, 'categorie_servizio');
            $categoria_servizio = $categorie[0]->name;
            $ipa = dci_get_meta('codice_ente_erogatore');
            $copertura_geografica = dci_get_meta("copertura_geografica");
            if ($canale_fisico_uffici[0]) {
                $ufficio = get_post($canale_fisico_uffici[0]);
                $luogo_id = dci_get_meta('sede_principale', '_dci_unita_organizzativa_', $ufficio->ID);
                $indirizzo = dci_get_meta('indirizzo', '_dci_luogo_', $luogo_id);
                $quartiere = dci_get_meta('quartiere', '_dci_luogo_', $luogo_id);
                $cap = dci_get_meta('cap', '_dci_luogo_', $luogo_id);
            }
            function convertToPlain($text) {
                $text = str_replace(array("\r", "\n"), '', $text);
                $text = str_replace('"', '\"', $text);
                $text = str_replace('&nbsp;', ' ', $text);

                return trim(strip_tags($text));
            };
            ?>
            <script type="application/ld+json" data-element="metatag">
                {
                    "name": "<?= $post->post_title; ?>",
                    "serviceType": "<?= $categoria_servizio; ?>",
                    "serviceOperator": {
                        "name": "<?= $ipa; ?>"
                    },
                    "areaServed": {
                        "name": "<?= convertToPlain($copertura_geografica); ?>"
                    },
                    "audience": {
                        "name": "<?= convertToPlain($destinatari); ?>"
                    },
                    "availableChannel": {
                        "serviceUrl": "<?= $canale_digitale_link; ?>",
                        "serviceLocation": {
                            "name": "<?= $ufficio->post_title; ?>",
                            "address": {
                            "streetAddress": "<?= $indirizzo; ?>",
                            "postalCode": "<?= $cap; ?>",
                            "addressLocality": "<?= $quartiere; ?>",
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
                                    <h1 class="title-xxxlarge" data-element="service-title">
                                        <?php the_title(); ?>
                                    </h1>
                                    <?php if ( $stato == 'true' ) {?>
                                        <div class="d-flex flex-wrap cmp-heading__tag">
                                            <div class="cmp-tag">
                                            <span class="cmp-tag__tag title-xsmall" data-element="service-status">Servizio attivo</span>
                                            </div>
                                        </div>
                                    <?php } else {?>
                                        <div class="d-flex flex-wrap gap-2 cmp-heading__tag">
                                            <div class="cmp-tag">
                                            <span class="cmp-tag__tag title-xsmall" data-element="service-status">Servizio non attivo</span>
                                            </div>
                                            <!-- <div><?php #echo $motivo_stato; ?></div> -->
                                        </div>
                                    <?php } ?>
                                    <p class="subtitle-small mb-3" data-element="service-description">
                                        <?php echo $descrizione_breve ?>
                                    </p>
                                    <?php if ($canale_digitale_link) { ?>
                                    <a href="<?php echo $canale_digitale_link; ?>" aria-label="Vai alla pagina <?php echo $canale_digitale_label; ?> " class="btn btn-primary mobile-full mb-4">
                                        <span><?php echo $canale_digitale_label; ?></span>
                                    </a>
                                    <?php } ?>
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
                                        <li>
                                        <a class="list-item" href="#submit-request" aria-label="Vai alla sezione Accedi al servizio" title="Vai alla sezione Accedi al servizio">
                                            <span class="title-medium">Accedi al servizio</span>
                                        </a>
                                        </li>
                                        <?php if ( $more_info ) { ?>
                                            <li>
                                            <a class="list-item" href="#more-info" aria-label="Vai alla sezione Ulteriori informazioni" title="Vai alla sezione Ulteriori informazioni">
                                                <span class="title-medium">Ulteriori informazioni</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $condizioni_servizio ) { ?>
                                            <li>
                                            <a class="list-item" href="#conditions" aria-label="Vai alla sezione Condizioni di servizio" title="Vai alla sezione Condizioni di servizio">
                                                <span class="title-medium">Condizioni di servizio</span>
                                            </a>
                                            </li>
                                        <?php } ?>
                                        <?php if ( $uo_id ) { ?>
                                            <li>
                                            <a class="list-item" href="#contacts" aria-label="Vai alla sezione Contatti" title="Vai alla sezione Contatti">
                                                <span class="title-medium">Contatti</span>
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
                            <div class="richtext-wrapper lora">
                                <?php echo $destinatari ?>
                            </div>
                        </section>
                        <?php if ($descrizione) { ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="description">Descrizione</h2>
                            <div class="richtext-wrapper lora"><?php echo $descrizione ?></div>
                        </section>
                        <?php } ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="how-to">Come fare</h2>
                            <div class="richtext-wrapper lora"> 
                                <?php echo $come_fare ?>
                            </div>
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
                            <div class="richtext-wrapper lora"><?php echo $output ?></div>
                        </section>
                        <?php if ( is_array($fasi_scadenze) && count($fasi_scadenze) ) { ?>
                        <section class="mb-30">
                            <div class="cmp-timeline">
                                <h2 class="title-xxlarge mb-3" id="deadlines">Tempi e scadenze</h2>
                                <p class="text-paragraph mb-3 lora">
                                    <?php echo $fasi_scadenze_intro; ?>
                                </p>
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
                            <h2 class="mb-3" id="submit-request">Accedi al servizio</h2>
                            <?php if ($canale_digitale_link) { ?>
                            <p class="text-paragraph lora mb-4">Puoi richiedere l’iscrizione alla Scuola dell’infanzia direttamente online
                                tramite identità digitale.</p>
                            <a href='<?php echo $canale_digitale_link; ?>' target="_blank" class="btn btn-primary mobile-full"  aria-label="Richiedi iscrizione online"><span>Richiedi iscrizione online</span></a>
                            <?php } ?>
                            <p class="text-paragraph lora mt-4">Puoi prenotare un appuntamento e presentarti presso gli uffici.
                            </p>
                            <a href='<?php echo dci_get_template_page_url('page-templates/prenota-appuntamento.php');?>' class="btn btn-outline-primary t-primary bg-white mobile-full"  aria-label="Vai alla pagina prenota appuntamento"><span>Prenota appuntamento</span></a>
                        </section>
                        <?php if ( $more_info ) {  ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="more-info">Ulteriori informazioni</h2>
                            <h3 class="mb-3 subtitle-medium">Graduatorie di accesso</h3>
                            <div class="richtext-wrapper lora">
                                <?php echo $more_info ?>
                            </div>
                        </section>
                        <?php }  ?>
                        <?php if ( $condizioni_servizio ) { 
                            $file_url = $condizioni_servizio;
                        ?>
                        <section class="mb-30">
                            <h2 class="title-xxlarge mb-3" id="conditions">Condizioni di servizio</h2>
                            <div class="richtext-wrapper lora">Per conoscere i dettagli di
                                scadenze, requisiti e altre informazioni importanti, leggi i termini e le condizioni di servizio.
                            </div>
                            <?php get_template_part("template-parts/single/attachment"); ?>
                        </section>
                        <?php } ?>

                        <section class="it-page-section">
                            <h2 class="mb-3" id="contacts">Contatti</h2>
                            <div class="row">
                                <div class="col-12 col-md-8 col-lg-6 mb-30">
                                    <div class="card-wrapper rounded h-auto mt-10">
                                        <?php 
                                            $with_border = true;
                                            get_template_part("template-parts/unita-organizzativa/card"); 
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mb-30">
                                    <span class="text-paragraph-small">Argomenti:</span>
                                    <div class="d-flex flex-wrap gap-2 mt-10 mb-30">
                                        <?php foreach ( $argomenti as $item ) { ?>
                                            <div class="cmp-tag">
                                                <a class="chip chip-simple t-primary bg-tag" aria-label="Visualizza tutti gli argomenti <?php echo $item->name; ?>" title="Visualizza tutti gli argomenti <?php echo $item->name; ?>" href="<?php echo get_term_link($item); ?>" data-element="service-topic">
                                                <span class="chip-label"><?php echo $item->name; ?></span>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php get_template_part('template-parts/single/page_bottom',"simple"); ?>
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
