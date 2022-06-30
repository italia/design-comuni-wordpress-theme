<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <?php get_template_part("template-parts/common/breadcrumb"); ?>
                    <div class="cmp-hero">
                        <section class="it-hero-wrapper bg-white align-items-start">
                            <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                                <h1 class="text-black title-xxxlarge mb-2"><?php esc_html_e( '404', 'design_comuni_italia' ); ?></h1>
                                <h2><?php esc_html_e( 'Pagina non trovata', 'design_comuni_italia' ); ?></h2>
                                <p class="text-black titillium text-paragraph"><?php _e( 'Oops! La pagina che cerchi non è stata trovata,<br> <a href="javascript:history.back();" title="Torna alla pagina precedente">torna indietro</a> o utilizza il menu per continuare la navigazione.', 'design_comuni_italia' ); ?></p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </main>

<?php
get_footer();


