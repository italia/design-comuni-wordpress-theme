<?php
/*
 * Generic Page Template
 *
 * @package Design_Comuni_Italia
 */
global $post;
get_header();

?>
    <main>
        <?php
        while ( have_posts() ) :
            the_post();
            $description = dci_get_meta('descrizione','_dci_page_',$post->ID);
            ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
                        <div class="cmp-hero">
                            <section class="it-hero-wrapper bg-white align-items-start">
                                <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                                    <h1 class="text-black title-xxxlarge mb-2" data-element="page-name">
                                        <?php the_title()?>
                                    </h1>
                                    <p class="text-black titillium text-paragraph">
                                        <?php echo $description; ?>
                                    </p>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="container ">
                    <article class="article-wrapper">

                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php
                                the_content();
                                ?>
                                <div class="callout note">
                                    <div class="callout-inner">
                                        <div class="callout-title">
                                            <svg class="icon"><use href="#it-info-circle"></use></svg>
                                            <span class="visually-hidden">Attenzione</span> 
                                            <span class="text">Attenzione</span>
                                        </div>
                                        <p><strong>Questo è un sito demo e il template di questa pagina non è ancora disponibile.</strong></p>
                                        <p>Controlla se è disponibile il <a href="https://www.figma.com/file/FHlE0r9lhfvDR0SgkDRmVi/Comuni---Modello-sito-e-servizi?type=design&node-id=1-1310&mode=design&t=YdmJ4xaUeMkCzJQc-0">layout su Figma</a>, il <a href="https://italia.github.io/design-comuni-pagine-statiche/">template HTML</a> tra le risorse del modello o consulta il <a href="https://designers.italia.it/files/resources/modelli/comuni/adotta-il-modello-di-sito-comunale/definisci-architettura-e-contenuti/Architettura-informazione-sito-Comuni.ods">documento di architettura (OSD 65kb)</a> per costruire il template in autonomia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php get_template_part( "template-parts/single/bottom" ); ?>
                            </div><!-- /col-lg-9 -->
                        </div><!-- /row -->

                    </article>
                </div>

            </div>
            <?php get_template_part("template-parts/common/valuta-servizio"); ?>
            
        <?php
        endwhile; // End of the loop.
        ?>
    </main>
<?php
get_footer();



