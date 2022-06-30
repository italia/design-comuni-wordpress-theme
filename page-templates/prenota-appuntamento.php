<?php
/* Template Name: prenota-appuntamento
 *
 * Prenota appuntamento template file
 *
 * @package Design_Scuole_Italia
 */
global $post;
get_header();

?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
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
                            <h1><?php echo the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <?php get_template_part("template-parts/prenotazione/tabs"); ?>
            <div class="container">
                <div class="row">
                    <?php get_template_part("template-parts/prenotazione/index"); ?>
                    <?php get_template_part("template-parts/prenotazione/content"); ?>
                </div>
            </div>


			<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



