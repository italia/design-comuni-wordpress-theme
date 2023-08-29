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
            $destinatari = dci_get_wysiwyg_field("a_chi_e_rivolto");
            // $destinatari_intro = dci_get_meta("destinatari_introduzione");
            // $destinatari_list = dci_get_meta("destinatari_list");
            $descrizione = dci_get_wysiwyg_field("descrizione_estesa");
            $come_fare = dci_get_wysiwyg_field("come_fare");
            $cosa_serve_intro = dci_get_wysiwyg_field("cosa_serve_introduzione");
            $cosa_serve_list = dci_get_meta("cosa_serve_list");
            $output = dci_get_wysiwyg_field("output");
            $fasi_scadenze_intro = dci_get_wysiwyg_field("tempi_text");
            $fasi_group_simple_scadenze = dci_get_meta("scadenze");
            $fasi_scadenze = dci_get_meta("fasi");
            $costi = dci_get_wysiwyg_field("costi");
            //canali di prenotazione
            $canale_digitale_text = dci_get_meta("canale_digitale_text");
            $canale_digitale_label = dci_get_meta("canale_digitale_label");
            $canale_digitale_link = dci_get_meta("canale_digitale_link");
            $canale_fisico_text = dci_get_meta("canale_fisico_text");
            $canale_fisico_uffici = dci_get_meta("canale_fisico_uffici");

            $more_info = dci_get_wysiwyg_field("ulteriori_informazioni");
            $condizioni_servizio = dci_get_meta("condizioni_servizio");     
            $uo_id = intval(dci_get_meta("unita_responsabile"));
            $argomenti = get_the_terms($post, 'argomenti');

            // valori per metatag
            $categorie = get_the_terms($post, 'categorie_servizio');
            $categoria_servizio = $categorie[0]->name;
            $ipa = dci_get_meta('codice_ente_erogatore');
            $copertura_geografica = dci_get_wysiwyg_field("copertura_geografica");
            if ($canale_fisico_uffici[0]??null) {
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
                    "@context": "http://schema.org",
                    "@type": "GovernmentService",
                    "name": <?php echo json_encode($post->post_title); ?>,
                    "serviceType": <?php echo json_encode($categoria_servizio); ?>,
                    "serviceOperator": {
                        "@type": "GovernmentOrganization",
                        "name": <?php echo json_encode($ipa); ?>
                    },
                    <?php if ( !empty($copertura_geografica) ) : ?>
                    "areaServed": {
                        "@type": "AdministrativeArea",
                        "name": "<?php echo convertToPlain($copertura_geografica); ?>"
                    },
                    <?php endif; ?>
                    "audience": {
                        "@type": "Audience",
                        "audienceType": "<?php echo convertToPlain($destinatari); ?>"
                    },
                    "availableChannel": {
                        "@type": "ServiceChannel",
                        "name": "Dove rivolgersi"
                        <?php if ( !empty($canale_digitale_link) ) : ?>
                        ,"serviceUrl": <?php echo json_encode($canale_digitale_link); ?>
                        <?php endif; ?>
                        <?php if ( !empty($ufficio) ) : ?>
                        ,"serviceLocation": {
                            "name": <?php echo json_encode($ufficio->post_title); ?>,
                            "address": {
                                "streetAddress": <?php echo json_encode($indirizzo); ?>,
                                "postalCode": <?php echo json_encode((string)$cap); ?>
                                <?php if ( !empty($quartiere) ) : ?>,
                                "addressLocality": <?php echo json_encode($quartiere); ?>
                                <?php endif; ?>
                            }
                        }
                        <?php endif; ?>
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
                                    <ul class="d-flex flex-wrap gap-1 my-3">
                                        <li>
                                            <div class="chip chip-simple <?php echo $stato == 'true'? 'chip-success' : 'chip-danger'; ?>" data-element="service-status">
                                                <span class="chip-label">
                                                <?php if ( $stato == 'true' ) {
                                                    echo 'Servizio attivo';
                                                } else echo 'Servizio non attivo'
                                                ?>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                    <p class="subtitle-small mb-3" data-element="service-description">
                                        <?php echo $descrizione_breve ?>
                                    </p>
                                    <?php if ($canale_digitale_link) { ?>
                                    <button type="button" class="btn btn-primary fw-bold" onclick="location.href='<?php echo $canale_digitale_link; ?>';">
                                        <span class=""><?php echo $canale_digitale_label; ?></span>
                                    </button>
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
                                                                <?php if ($destinatari ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#who-needs">
                                                                        <span class="title-medium">A chi è rivolto</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( $descrizione ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#description">
                                                                        <span class="title-medium">Descrizione</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( $come_fare ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#how-to">
                                                                        <span class="title-medium">Come fare</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( is_array($cosa_serve_list) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#needed">
                                                                        <span class="title-medium">Cosa serve</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( $output ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#obtain">
                                                                        <span class="title-medium">Cosa si ottiene</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( !empty($fasi_scadenze_intro) || (is_array($fasi_scadenze) && count($fasi_scadenze)) || (is_array($fasi_group_simple_scadenze) && count($fasi_group_simple_scadenze)) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#deadlines">
                                                                        <span class="title-medium">Tempi e scadenze</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( $costi ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#costs">
                                                                        <span class="title-medium">Quanto costa</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#submit-request">
                                                                        <span class="title-medium">Accedi al servizio</span>
                                                                    </a>
                                                                </li>
                                                                <?php if ( $more_info ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#more-info">
                                                                        <span class="title-medium">Ulteriori informazioni</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( $condizioni_servizio ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#conditions">
                                                                        <span class="title-medium">Condizioni di servizio</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if ( $uo_id ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#contacts">
                                                                        <span class="title-medium">Contatti</span>
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
                                <h2 class="title-xxlarge mb-3" id="who-needs">A chi è rivolto</h2>
                                <div class="richtext-wrapper lora" data-element="service-addressed">
                                    <?php echo $destinatari ?>
                                </div>
                            </section>
                            <?php if ($descrizione) { ?>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="description">Descrizione</h2>
                                <div class="richtext-wrapper lora" data-element="service-extended-description"><?php echo $descrizione ?></div>
                            </section>
                            <?php } ?>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="how-to">Come fare</h2>
                                <div class="richtext-wrapper lora" data-element="service-how-to">
                                    <?php echo $come_fare ?>
                                </div>
                            </section>
                            <section class="it-page-section mb-30 has-bg-grey p-3">
                                <h2 class="title-xxlarge mb-3" id="needed">Cosa serve</h2>
                                <div class="richtext-wrapper lora" data-element="service-needed">
                                    <?php echo $cosa_serve_intro ?>
                                    <ul >
                                        <?php foreach ($cosa_serve_list as $cosa_serve_item) { ?>
                                            <li><span><?php echo $cosa_serve_item ?></span></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </section>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="obtain">Cosa si ottiene</h2>
                                <div class="richtext-wrapper lora" data-element="service-achieved"><?php echo $output ?></div>
                            </section>
                            <?php if ( !empty($fasi_scadenze_intro) || (is_array($fasi_scadenze) && count($fasi_scadenze)) || (is_array($fasi_group_simple_scadenze) && count($fasi_group_simple_scadenze)) ) { ?>
                            <section class="it-page-section mb-30">
                                <div class="cmp-timeline">
                                    <h2 class="title-xxlarge mb-3" id="deadlines">Tempi e scadenze</h2>
                                    <div class="richtext-wrapper lora" data-element="service-calendar-text">
                                        <?php echo $fasi_scadenze_intro; ?>
                                    </div>
                                    <?php if ((is_array($fasi_group_simple_scadenze) && count($fasi_group_simple_scadenze)) || (is_array($fasi_scadenze) && count($fasi_scadenze))) { ?>
                                        <div class="calendar-vertical mb-3" data-element="service-calendar-list">
                                            <?php if (!empty($fasi_group_simple_scadenze)) foreach ($fasi_group_simple_scadenze as $fase) {
                                                ?>
                                                <div class="calendar-date">
                                                    <?php if (empty($fase['giorni'])) {
                                                        $fase['giorni'] = "";
                                                    } ?>
                                                    <div class="calendar-date-day">
                                                        <span class="title-xxlarge-regular d-flex justify-content-center"><?php echo  $fase['giorni']; ?></span>
                                                        <small class="calendar-date-day__month"><?php echo ($fase['giorni'] != "")?'giorni': ''; ?></small>
                                                    </div>
                                                    <?php if (!empty($fase['titolo']) || !empty($fase['descrizione'])) { ?>
                                                        <div class="calendar-date-description rounded">
                                                            <div class="calendar-date-description-content">
                                                                <?php if (!empty($fase['titolo'])) { ?>
                                                                    <h3 class="title-medium-2 mb-0">
                                                                        <?php echo  $fase['titolo']; ?>
                                                                    </h3>
                                                                <?php }?>
                                                                <?php if (!empty($fase['descrizione'])) { ?>
                                                                    <p class="info-text mt-1 mb-0"><?php echo $fase['descrizione']; ?></p>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    <?php }?>                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($fasi_scadenze)) foreach ($fasi_scadenze as $fase_id) {
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
                                                            <?php if (!empty(dci_get_meta('desc_fase','_dci_fase_', $fase->ID))) { ?>
                                                                <p class="info-text mt-1 mb-0"><?php echo dci_get_meta('desc_fase','_dci_fase_', $fase->ID); ?></p>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                            <?php } ?>
                            <?php if ( $costi ) { ?>
                            <section class="it-page-section mb-30">
                                <h2 class="title-xxlarge mb-3" id="costs">Quanto costa</h2>
                                <div class="richtext-wrapper lora" data-element="service-cost"><?php echo $costi ?></div>
                            </section>
                            <?php } ?>
                            <section class="it-page-section mb-30 has-bg-grey p-4">
                                <h2 class="mb-3" id="submit-request">Accedi al servizio</h2>
                                <?php if ($canale_digitale_link) { ?>
                                <p class="text-paragraph lora mb-4" data-element="service-generic-access"><?php echo $canale_digitale_text; ?></p>
                                <button type="button" class="btn btn-primary mobile-full" onclick="location.href='<?php echo $canale_digitale_link; ?>';" data-element="service-online-access">
                                    <span class=""><?php echo $canale_digitale_label; ?></span>
                                </button>
                                <?php } ?>
                                <p class="text-paragraph lora mt-4" data-element="service-generic-access"><?php echo $canale_fisico_text; ?></p>
                                <button type="button" class="btn btn-outline-primary t-primary bg-white mobile-full" onclick="location.href='<?php echo dci_get_template_page_url('page-templates/prenota-appuntamento.php'); ?>';" data-element="service-booking-access">
                                    <span class="">Prenota appuntamento</span>
                                </button>
                            </section>
                            <?php if ( $more_info ) {  ?>
                            <section class="it-page-section mb-30">
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
                            <section class="it-page-section mb-30">
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
                                        <ul class="d-flex flex-wrap gap-2 mt-10 mb-30">
                                            <?php foreach ( $argomenti as $item ) { ?>
                                                <li>
                                                    <a href="<?php echo get_term_link($item); ?>" class="chip chip-simple" data-element="service-topic">
                                                        <span class="chip-label">
                                                            <?php echo $item->name; ?>
                                                        </span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <?php get_template_part('template-parts/single/page_bottom',"simple"); ?>
                                    </div>
                                </div>
                            </section>
                        </div>
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
