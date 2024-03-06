<?php
/**
 * Documento pubblico template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $uo_id, $inline;

get_header();
?>

    <main>
        <?php 
        while ( have_posts() ) :
            the_post();
            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            //$prefix= '_dci_documento_pubblico_';			
            $identificativo = dci_get_meta("identificativo");
            $numero_protocollo = dci_get_meta("numero_protocollo");
            $data_protocollo = dci_get_meta("data_protocollo");			
            $tipo_documento = wp_get_post_terms( $post->ID, array( 'tipi_documento', 'tipi_doc_albo_pretorio' ) );
            $descrizione_breve = dci_get_meta("descrizione_breve");
            $url_documento = dci_get_meta("url_documento");
            $file_documento = dci_get_meta("file_documento");
            $descrizione = dci_get_wysiwyg_field("descrizione_estesa");
            $ufficio_responsabile = dci_get_meta("ufficio_responsabile");
            $autori = dci_get_meta("autori");
            $formati = dci_get_wysiwyg_field("formati");
            $licenza = wp_get_post_terms( $post->ID, array( 'licenze' ) );
            $servizi = dci_get_meta("servizi");
            $data_inizio = dci_get_meta("data_inizio");
            $data_fine = dci_get_meta("data_fine");
            $dataset = dci_get_meta("dataset");
            $more_info = dci_get_wysiwyg_field("ulteriori_informazioni");
            $riferimenti_normativi = dci_get_wysiwyg_field("riferimenti_normativi"); 			
            $documenti_collegati = dci_get_meta("documenti_collegati");
            ?>
            <div class="container" id="main-container">
                <div class="row">
                    <div class="col px-lg-4">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 px-lg-4 py-lg-2">
                        <h1><?php the_title(); ?></h1>
                        <h2 class="visually-hidden">Dettagli del documento</h2>
                        <?php if($numero_protocollo) { ?>
                            <h4>Protocollo <?= $numero_protocollo ?> del <?= $data_protocollo ?></h4>
                        <?php } ?>
                        <p>
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
            </div><!-- ./main-container -->

            <div class="container">
                <div class="row border-top border-light row-column-border row-column-menu-left">
                    <aside class="col-lg-3">
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
                                                        >INDICE DELLA PAGINA
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
                                                                <?php if( $descrizione) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#descrizione">
                                                                        <span class="title-medium">Descrizione</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $url_documento || $file_documento ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#documento">
                                                                        <span class="title-medium">Documento</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#ufficio_responsabile">
                                                                        <span class="title-medium">Ufficio responsabile</span>
                                                                    </a>
                                                                </li>

                                                                <?php if( $autori) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#autore">
                                                                        <span class="title-medium">Autore/i</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#formati_disponibili">
                                                                        <span class="title-medium">Formati disponibili</span>
                                                                    </a>
                                                                </li>

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#licenza_distribuzione">
                                                                        <span class="title-medium">Licenza di distribuzione</span>
                                                                    </a>
                                                                </li>																

                                                                <?php if( $servizi && count($servizi) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#servizi">
                                                                        <span class="title-medium">Servizi collegati</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $data_inizio) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#data_inizio">
                                                                        <span class="title-medium">Data inizio</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $data_fine) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#data_fine">
                                                                        <span class="title-medium">Data fine</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $dataset && count($dataset) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dataset">
                                                                        <span class="title-medium">Dataset</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $more_info) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#ulteriori_informazioni">
                                                                        <span class="title-medium">Ulteriori informazioni</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $riferimenti_normativi) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#riferimenti_normativi">
                                                                        <span class="title-medium">Riferimenti normativi</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( is_array($documenti_collegati) && count($documenti_collegati) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#documenti_collegati">
                                                                        <span class="title-medium">Documenti collegati</span>
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

                    <div class="col-12 col-lg-9">
                        <div class="it-page-sections-container">
                            <?php if( $descrizione) { ?>
                            <section id="descrizione" class="it-page-section mb-5">
                                <h4>Descrizione</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $descrizione; ?>
							                  </div>
                            </section>
                            <?php } ?>

                            <?php if( $url_documento || $file_documento ) { ?>
                            <section id="documento" class="it-page-section mb-5">
                                <h4>Documento</h4>
                                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                <?php
                                    if ( $file_documento ) {
                                        $documento_id = attachment_url_to_postid($file_documento);
                                        $documento = get_post($documento_id);
                                        ?>
                                        <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                            <svg class="icon" aria-hidden="true">
                                                <use
                                                    xlink:href="#it-clip"
                                                ></use>
                                            </svg>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a class="text-decoration-none" href="<?php echo $file_documento; ?>" aria-label="Scarica il documento <?php echo $documento->post_title; ?>" title="Scarica il documento <?php echo $documento->post_title; ?>">
                                                        <?php echo $documento->post_title; ?> (<?php echo getFileSizeAndFormat($file_documento);?>)
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    <?php }

                                    if ( $url_documento ) { ?>
                                        <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                            <svg class="icon" aria-hidden="true">
                                                <use
                                                    xlink:href="#it-clip"
                                                ></use>
                                            </svg>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a class="text-decoration-none" href="<?php echo $url_documento; ?>" aria-label="Scarica il documento" title="Scarica il documento">
                                                        Scarica il documento
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div><!-- ./card-wrapper -->
                            </section>
                            <?php } ?>

                            <section id="ufficio_responsabile" class="it-page-section mb-5">
                                <h4>Ufficio responsabile</h4>
                                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                    <?php foreach ($ufficio_responsabile as $uo_id) {
                                        $with_border = true;
                                        get_template_part("template-parts/unita-organizzativa/card");
                                    } ?>
                                </div>
                            </section>

                            <?php if ($autori &&  is_array($autori) && count($autori)) { ?>
                            <section id="autore" class="it-page-section mb-5">
                                <h4>Autore/i</h4>
                                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                    <?php foreach ($autori as $persona_id) { ?>
                                        <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                            <?php get_template_part("template-parts/persona/card"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                            <?php } ?>

                            <?php if ($formati) { ?>
                            <section id="formati_disponibili" class="it-page-section mb-5">
                                <h4>Formati disponibili</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $formati ?>		
                                </div>
                            </section>
                            <?php } ?>

                            <?php if ($licenza) { ?>
                            <section id="licenza_distribuzione" class="it-page-section mb-5">
                                <h4>Licenza distribuzione</h4>
                                <div class="richtext-wrapper lora">
                                    <?php foreach($licenza as $tipo) { 
                                        echo $tipo->name;
                                    } ?>
                                </div>
                            </section>
                            <?php } ?>

                            <?php if ($servizi && is_array($servizi) && count($servizi)>0 ) { ?>
                            <section id="servizi" class="it-page-section mb-5">
                                <h4>Servizi collegati</h4>
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

                            <?php if ($data_inizio) { ?>
                            <section id="data_inizio" class="it-page-section mb-5">
                                <h4>Data inizio</h4>
                                <div class="richtext-wrapper lora">
                                    <?php
                                        echo date_i18n('j F Y', strtotime($data_inizio));
                                    ?>
                                </div>
                            </section>
                            <?php } ?>

                            <?php if ($data_fine) { ?>
                            <section id="data_fine" class="it-page-section mb-5">
                                <h4>Data fine</h4>
                                <div class="richtext-wrapper lora">
                                    <?php
                                        echo date_i18n('j F Y', strtotime($data_fine));
                                    ?>
                                </div>
                            </section>
                            <?php } ?>

                            <?php if ( $more_info ) {  ?>
                            <section id="ulteriori_informazioni" class="it-page-section mb-5">
                                <h4>Ulteriori informazioni</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $more_info ?>
                                </div>
                            </section>
                            <?php }  ?>

                            <?php if ( $riferimenti_normativi ) { ?>
                            <section id="riferimenti_normativi" class="it-page-section mb-5">
                                <h4>Riferimenti normativi</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $riferimenti_normativi ?>
                                </div>
                            </section>
                            <?php } ?>

                            <?php if( is_array($documenti_collegati) && count($documenti_collegati) ) { ?>
                            <section id="documenti_collegati" class="it-page-section mb-5">
                                <h4>Documenti collegati</h4>
                                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                    <?php foreach ($documenti_collegati as $all_url) {
                                        $all_id = attachment_url_to_postid($all_url);
                                        $documento = get_post($all_id);
                                        $with_border = true;
                                        get_template_part("template-parts/documento/card");
                                    } ?>
                                </div>
                            </section>
                            <?php } ?>
                        </div><!-- /it-page-sections-container -->

                        <div>
                            <?php get_template_part('template-parts/single/page_bottom'); ?>
                        </div>

										</div><!-- ./col-12 col-9 -->

                </div><!-- ./row border-top border-light row-column-border row-column-menu-left -->
            </div><!-- ./container -->

            <?php get_template_part("template-parts/common/valuta-servizio"); ?>
            <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

        <?php
        endwhile; // End of the loop.
        ?>
    </main>
    <script>
        const descText = document.querySelector('#descrizione')?.closest('article').innerText;
        const wordsNumber = descText.split(' ').length
        document.querySelector('#readingTime').innerHTML = `${Math.ceil(wordsNumber / 200)} min`;
    </script>
<?php
get_footer();
