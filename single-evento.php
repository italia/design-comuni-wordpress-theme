<?php
/**
 * Evento template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $show_calendar, $gallery, $video, $trascrizione, $luogo, $pc_id, $uo_id, $appuntamento, $inline;

get_header();
?>

    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            $prefix= '_dci_evento_';    
            $descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
            //dates
            $start_timestamp = dci_get_meta("data_orario_inizio", $prefix, $post->ID);
            $start_date = date_i18n('d F Y', date($start_timestamp));
            $start_date_arr = explode('-', date_i18n('d-M-Y-H-i', date($start_timestamp)));
            $end_timestamp = dci_get_meta("data_orario_fine", $prefix, $post->ID);
            $end_date = date_i18n('d F Y', date($end_timestamp));
            $end_date_arr = explode('-', date_i18n('d-M-Y-H-i', date($end_timestamp)));
            $descrizione = dci_get_meta("descrizione_completa", $prefix, $post->ID);
            //media
            $gallery = dci_get_meta("gallery", $prefix, $post->ID);
            $video = dci_get_meta("video", $prefix, $post->ID);
            $trascrizione = dci_get_meta("trascrizione", $prefix, $post->ID);
            $persone = dci_get_meta("persone", $prefix, $post->ID);
            $luogo_evento = get_post(dci_get_meta("luogo_evento", $prefix, $post->ID));
            $costi = dci_get_meta( 'costi' );            
            $documenti = dci_get_meta("allegati", $prefix, $post->ID);
            $punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);
            $organizzatori = dci_get_meta("organizzatore", $prefix, $post->ID);
            $appuntamenti = dci_get_eventi_figli();
            $patrocinato = dci_get_meta("patrocinato", $prefix, $post->ID);
            $sponsor = dci_get_meta("sponsor", $prefix, $post->ID);     
            $more_info = dci_get_meta("ulteriori_informazioni", $prefix, $post->ID);
            ?>
            <div class="container px-4 my-4" id="main-container">
                <div class="row">
                    <div class="col px-lg-4">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 px-lg-4 py-lg-2">
                        <h1><?php the_title(); ?></h1>
                        <?php if ($start_timestamp && $end_timestamp) { ?>
                            <h2 class="h4 py-2">dal <?php echo $start_date; ?> al <?php echo $end_date; ?></h2>
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
                        <div class="mt-5">
                            <a target="_blank" href="https://calendar.google.com/calendar/r" class="btn btn-outline-primary btn-icon" aria-label="vai al calendario eventi" title="vai al calendario eventi">
                                <svg class="icon icon-primary" aria-hidden="true">
                                <use xlink:href="#it-calendar"></use>
                                </svg>
                                <span>Vai al calendario eventi</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_template_part('template-parts/single/image-large'); ?>
            <div class="container">
                <div class="row border-top row-column-border row-column-menu-left border-light">
                    <aside class="col-lg-4">
                        <div class="d-none d-lg-block sticky-wrapper navbar-wrapper">
                            <nav class="navbar it-navscroll-wrapper it-top-navscroll navbar-expand-lg">
                            <button
                                class="custom-navbar-toggler"
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
                                    <li class="nav-item active">
                                        <a class="nav-link active" href="#cos-e"  aria-label="Vai alla sezione Cos'è " title="Vai alla sezione Cos'è "
                                        ><span>Cos'è</span></a
                                        >
                                    </li>
                                    <?php if( $luogo_evento) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#luogo" aria-label="Vai alla sezione Luogo " title="Vai alla sezione Luogo "
                                        ><span>Luogo</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if ($start_timestamp && $end_timestamp) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#date-e-orari" aria-label="Vai alla sezione Date e orari " title="Vai alla sezione Date e orari "
                                        ><span>Date e orari</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( is_array($costi) && count($costi) ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#costi" aria-label="Vai alla sezione Costi " title="Vai alla sezione Costi "
                                        ><span>Costi</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( $documenti ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#documenti" aria-label="Vai alla sezione Documenti " title="Vai alla sezione Documenti "
                                        ><span>Documenti</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#contatti" aria-label="Vai alla sezione Contatti " title="Vai alla sezione Contatti "
                                        ><span>Contatti</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <?php if( is_array($appuntamenti) && count($appuntamenti) ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#appuntamenti" aria-label="Vai alla sezione Appuntamenti " title="Vai alla sezione Appuntamenti "
                                        ><span>Appuntamenti</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ulteriori-informazioni" aria-label="Vai alla sezione Ulteriori informazioni " title="Vai alla sezione Ulteriori informazioni "
                                        ><span>Ulteriori informazioni</span></a
                                        >
                                    </li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            </nav>
                        </div>
                    </aside>
                    <section class="col-lg-8 it-page-sections-container border-light">
                    <article id="cos-e" class="it-page-section anchor-offset">
                        <h4>Cos'è</h4>
                        <p class="font-serif">
                            <?php echo $descrizione; ?>
                        </p>
                    </article>
                    <?php if (is_array($gallery) && count($gallery)) { 
                        get_template_part("template-parts/single/gallery");
                    } ?>
                    <?php if ($video) { 
                        get_template_part("template-parts/single/video");
                    } ?>
                    <?php if(is_array($persone) && count($persone)) {?>
                        <div class="pt-3 pb-5">
                            <h5 class="h6 font-serif fw-bold">Parteciperanno:</h5>
                            <?php get_template_part("template-parts/single/persone"); ?>                            
                        </div>
                    <?php  } ?>
                    <?php if($luogo_evento) {?>
                        <article id="luogo" class="it-page-section anchor-offset">
                            <h4>Luogo</h4>
                            <?php 
                                $luogo = $luogo_evento;
                                get_template_part("template-parts/single/luogo"); 
                            ?>
                        </article>
                    <?php } ?>
                    <?php if ($start_timestamp && $end_timestamp) { ?>
                    <article id="date-e-orari" class="it-page-section anchor-offset">
                        <h4>Date e orari</h4>
                        <div class="point-list-wrapper my-4">
                            <div class="point-list">
                                <div class="point-list-aside point-list-primary">
                                    <div class="point-date font-monospace"><?php echo $start_date_arr[0]; ?></div>
                                    <div class="point-month font-monospace"><?php echo $start_date_arr[1]; ?></div>
                                </div>
                            <div class="point-list-content">
                                <div class="card card-teaser shadow rounded">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                        <?php echo $start_date_arr[3].':'.$start_date_arr[4]; ?> - Inizio evento
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="point-list">
                            <div class="point-list-aside point-list-primary">
                                <div class="point-date font-monospace"><?php echo $end_date_arr[0]; ?></div>
                                <div class="point-month font-monospace"><?php echo $end_date_arr[1]; ?></div>
                            </div>
                            <div class="point-list-content">
                                <div class="card card-teaser shadow rounded">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                        <?php echo $end_date_arr[3]; ?>:<?php echo $end_date_arr[4]; ?> - Fine evento
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <p class="font-serif">
                            Per informazioni sul programma dettagliato degli appuntamenti religiosi e civili, consultare il programma
                            nella sezione documenti.
                        </p>
                        <?php                     
                        $data_inizio = date_i18n("Ymd\THi00", date($start_timestamp));
                        $data_fine = date_i18n("Ymd\THi00", date($end_timestamp));
                        $luogo = $luogo_evento->post_title;
                        ?>
                        <div class="mt-5">
                            <a target="_blank" href="https://calendar.google.com/calendar/r/eventedit?text=<?php echo urlencode(get_the_title()); ?>&dates=<?php echo $data_inizio; ?>/<?php echo $data_fine; ?>&details=<?php echo urlencode($descrizione_breve); ?>:+<?php echo urlencode(get_permalink()); ?>&location=<?php echo urlencode($luogo); ?>" class="btn btn-outline-primary btn-icon" aria-label="aggiungi al calendario" title="Aggiungi al calendario">
                                <svg class="icon icon-primary" aria-hidden="true">
                                <use xlink:href="#it-plus-circle"></use>
                                </svg>
                                <span>Aggiungi al calendario</span>
                            </a>
                        </div>
                    </article>
                    <?php } ?>
                    <?php if( is_array($costi) && count($costi) ) { ?>
                    <article id="costi" class="it-page-section anchor-offset mt-5">
                        <h4>Costi</h4>
                        <?php foreach ($costi as $costo) { ?>                            
                        <div class="card no-after border-start mt-3">
                            <div class="card-body">
                                <h5>
                                <span class="category-top">
                                    <?php echo $costo['titolo_costo']; ?>
                                </span>
                                <p class="card-title big-heading">
                                    <?php echo $costo['prezzo_costo']; ?>
                                </p>
                                </h5>
                                <p class="mt-4">
                                    <?php echo $costo['descrizione_costo']; ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    </article>
                    <?php } ?>
                    <?php if( $documenti ) { 
                        $doc = get_post( attachment_url_to_postid($documenti) );
                    ?>
                    <article id="documenti" class="it-page-section anchor-offset mt-5">
                        <h4>Documenti</h4>
                        <div class="card card-teaser shadow mt-3 rounded">
                            <svg class="icon" aria-hidden="true">
                            <use xlink:href="#it-clip"></use>
                            </svg>
                            <div class="card-body">
                            <h5 class="card-title">
                                <a class="text-decoration-none" href="<?php echo $documenti; ?>" title="Vai alla locandina <?php echo $doc->post_title; ?>" aria-label="vai alla locandina <?php echo $doc->post_title; ?>"><?php echo $doc->post_title; ?></a>
                            </h5>
                            </div>
                        </div>
                    </article>
                    <?php } ?>
                     <article id="contatti" class="it-page-section anchor-offset mt-5">
                        <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
                            <h4>Contatti</h4>
                            <?php foreach ($punti_contatto as $pc_id) {
                                get_template_part('template-parts/single/punto-contatto'); 
                            } ?>
                        <?php } ?>
                        <?php if( is_array($organizzatori) && count($organizzatori) ) { ?>
                            <h5 class="mt-4">Con il supporto di:</h5>
                            <?php foreach ($organizzatori as $uo_id) {
                                get_template_part("template-parts/unita-organizzativa/card-full");
                            } ?>
                        <?php } ?>
                    </article>
                    <?php if( is_array($appuntamenti) && count($appuntamenti) ) { ?>
                    <article id="appuntamenti" class="it-page-section anchor-offset mt-5">
                        <h4>Appuntamenti</h4>
                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                            <?php foreach ($appuntamenti as $appuntamento) {
                                get_template_part('template-parts/single/appuntamento');
                            } ?>
                        </div>
                    </article>
                    <?php }?>
                    <article id="ulteriori-informazioni" class="it-page-section anchor-offset mt-5">
                    <h4 class="mb-3">Ulteriori informazioni</h4>
                    <?php 
                        if ( is_array($patrocinato) && count($patrocinato) ) {
                            echo '<strong>Patrocinato da:</strong>';
                            echo '<div class="link-list-wrapper"><ul class="link-list">';
                            foreach ($patrocinato as $item) { ?>
                                <li><a class="list-item px-0" href="<?php echo $item['_dci_evento_url']; ?>" title="vai alla pagina <?php echo $item['_dci_evento_nome']; ?>" aria-label="vai alla pagina <?php echo $item['_dci_evento_nome']; ?>" target="_blank"><span><?php echo $item['_dci_evento_nome']; ?></span></a>
                                </li>
                            <?php }
                            echo '</ul></div>';
                        }
                        if ( is_array($sponsor) && count($sponsor) ) {
                            echo '<strong>Sponsor:</strong>';
                            echo '<div class="link-list-wrapper"><ul class="link-list">';
                            foreach ($sponsor as $item) { ?>
                                <li><a class="list-item px-0" href="<?php echo $item['_dci_evento_url']; ?>" title="vai alla pagina <?php echo $item['_dci_evento_nome']; ?>" aria-label="vai alla pagina <?php echo $item['_dci_evento_nome']; ?>" target="_blank"><span><?php echo $item['_dci_evento_nome']; ?></span></a>
                                </li>
                            <?php }
                            echo '</ul></div>';
                        }
                    ?>
                    <?php get_template_part('template-parts/single/recensione'); ?>
                    <?php if ($more_info) { ?>
                        <div class="mt-5">
                            <div class="callout">
                                <div class="callout-title">
                                    <svg class="icon">
                                    <use xlink:href="#it-info-circle"></use>
                                    </svg>
                                </div>
                                <?php echo $more_info; ?>
                            </div>
                        </div>
                    <?php } ?>
                    </article>
                    <?php get_template_part('template-parts/single/page_bottom'); ?>
                    </section>
                </div>
            </div>
            <?php get_template_part('template-parts/single/more-posts', 'carousel'); ?>

        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();
