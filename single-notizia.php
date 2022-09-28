<?php
/**
 * Notizia template file
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

            $prefix= '_dci_notizia_';    
            $descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
            $data_pubblicazione_arr = dci_get_data_pubblicazione_arr("data_pubblicazione", $prefix, $post->ID);
            $date = date_i18n('d F Y', mktime(0, 0, 0, $data_pubblicazione_arr[1], $data_pubblicazione_arr[0], $data_pubblicazione_arr[2]));
            $persone = dci_get_meta("persone", $prefix, $post->ID);
            $descrizione = dci_get_wysiwyg_field("testo_completo", $prefix, $post->ID);
            $documenti = dci_get_meta("documenti", $prefix, $post->ID);
            $a_cura_di = dci_get_meta("a_cura_di", $prefix, $post->ID);    
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
                        <h2 class="visually-hidden">Dettagli della notizia</h2>
                        <p>
                            <?php echo $descrizione_breve; ?>
                        </p>
                        <div class="row mt-5 mb-4">
                            <div class="col-6">
                                <small>Data:</small>
                                <p class="fw-semibold font-monospace">
                                    <?php echo $date; ?>
                                </p>
                            </div>
                            <div class="col-6">
                                <small>Tempo di lettura:</small>
                                <p class="fw-semibold" id="readingTime"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <?php 
                        $inline = true;
                        get_template_part('template-parts/single/actions'); 
                        ?>
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
                                        <a class="nav-link active" href="#descrizione"><span>Descrizione</span></a
                                        >
                                    </li>
                                    <?php if( is_array($documenti) && count($documenti) ) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#documenti"><span>Documenti</span></a
                                        >
                                    </li>
                                    <?php } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#a-cura-di"><span>A cura di</span></a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#ulteriori-informazioni"><span>Ulteriori informazioni</span></a
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
                    <article id="descrizione" class="it-page-section anchor-offset">
                        <h4>Descrizione</h4>
                        <div class="richtext-wrapper lora">
                            <?php echo $descrizione; ?>
                        </div>
                    </article>
                    <?php if( is_array($documenti) && count($documenti) ) { ?>
                    <article id="documenti" class="it-page-section anchor-offset mt-5">
                        <h4>Documenti</h4>
                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                            <?php foreach ($documenti as $doc_id) { 
                                $documento = get_post($doc_id);
                            ?>
                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                <svg class="icon" aria-hidden="true">
                                <use
                                    xlink:href="#it-clip"
                                ></use>
                                </svg>
                                <div class="card-body">
                                <h5 class="card-title">
                                    <a class="text-decoration-none" href="<?php echo get_permalink($doc_id); ?>" aria-label="Scarica il documento <?php echo $documento->post_title; ?>" title="Scarica il documento <?php echo $documento->post_title; ?>">
                                        <?php echo $documento->post_title; ?>
                                    </a>
                                </h5>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </article>
                    <?php } ?>
                    <article id="a-cura-di" class="it-page-section anchor-offset mt-5">
                        <h4>A cura di</h4>
                        <div class="row">
                        <div class="col-12 col-sm-8">
                            <h6><small>Questa pagina è gestita da</small></h6>
                            <?php foreach ($a_cura_di as $uo_id) {
                                $with_border = true;
                                get_template_part("template-parts/unita-organizzativa/card");
                            } ?>
                        </div>
                        <div class="col-12 col-sm-4">
                            <h6><small>Persone</small></h6>
                            <?php 
                            if(is_array($persone) && count($persone)) {
                                get_template_part("template-parts/single/persone"); 
                            } ?>
                        </div>
                        </div>
                    </article>
                    <article
                        id="ulteriori-informazioni"
                        class="it-page-section anchor-offset mt-5"
                    >
                        <h4 class="mb-3">Ulteriori informazioni</h4>
                    </article>
                    <?php get_template_part('template-parts/single/page_bottom'); ?>
                    </section>
                </div>
            </div>


        <?php
        endwhile; // End of the loop.
        ?>
    </main>
    <script>
        const descText = document.querySelector('#descrizione')?.innerText;
        const wordsNumber = descText.split(' ').length

        document.querySelector('#readingTime').innerHTML = `${Math.ceil(wordsNumber / 200)} min`;
    </script>
<?php
get_footer();

