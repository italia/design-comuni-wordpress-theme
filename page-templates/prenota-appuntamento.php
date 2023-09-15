<?php
/* Template Name: Prenota appuntamento
 *
 * Prenota appuntamento template file
 *
 * @package Design_Comuni_Italia
 */
global $post;

function dci_enqueue_dci_booking_script()  {
    wp_enqueue_script( 'dci-booking', get_template_directory_uri() . '/assets/js/booking.js', array(), false, true);
    wp_localize_script('dci-booking', "url", [get_template_directory_uri() . '/assets/json/calendar.json']);
    wp_localize_script('dci-booking', "urlConfirm", [admin_url( 'admin-ajax.php' )]);
}
add_action( 'wp_enqueue_scripts', 'dci_enqueue_dci_booking_script' );

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
            <div id="form-steps">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10">
                            <div class="cmp-hero">
                                <section class="it-hero-wrapper bg-white align-items-start">
                                    <div class="it-hero-text-wrapper pt-0 ps-0 pb-3 pb-lg-4">
                                        <h1 class="text-black hero-title" data-element="page-name">
                                            Prenotazione appuntamento
                                        </h1>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <?php get_template_part("template-parts/prenotazione/tabs"); ?>
                <div class="container">
                    <div class="row">
                        <?php get_template_part("template-parts/prenotazione/index"); ?>
                        <div class="col-12 col-lg-8 offset-lg-1 section-wrapper">
                            <div class="steppers-content" aria-live="polite">
                                <?php get_template_part("template-parts/prenotazione/content"); ?>
                                <?php get_template_part("template-parts/prenotazione/buttons-bar"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="final-step" class="d-none">
                <?php get_template_part("template-parts/prenotazione/final-step"); ?>
			    <?php get_template_part("template-parts/common/valuta-servizio"); ?>
            </div>


			<?php get_template_part("template-parts/common/assistenza-contatti"); ?>

		<?php
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



