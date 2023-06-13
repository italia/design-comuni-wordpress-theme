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
                                        <p><strong>Il template di questa pagina non è ancora disponibile.</strong></p>
                                        <p>Nel frattempo, puoi controllare se è disponibile la <a href="https://italia.github.io/design-comuni-pagine-statiche/">versione statica</a> oppure il <a href="https://www.figma.com/file/FHlE0r9lhfvDR0SgkDRmVi/%5BComuni%5D-Modello-sito-e-servizi?type=design&node-id=1%3A1310&t=T24nHc1gRJzlJ7GH-1">layout hi-fi</a> su Figma.</p>
                                        <p><a href="https://docs.google.com/spreadsheets/d/1D4KbaA__xO9x_iBm08KvZASjrrFLYLKX/edit#gid=335720294">Consulta il documento di architettura dell'informazione</a> per costruire il template in autonomia.</p>
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



