<?php
/* Template Name: Servizi
 *
 * Servizi template file
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
								<h1 class="text-black title-xxxlarge mb-2">
									Servizi
								</h1>
								<p class="text-black titillium text-paragraph">
									<?php echo $description; ?>
								</p>
								</div>
							</section>
						</div>
					</div>
				</div>	
			</div>
			<?php get_template_part("template-parts/servizio/tutti-servizi"); ?>
			<?php get_template_part("template-parts/servizio/categorie"); ?>
			<?php get_template_part("template-parts/common/valuta-servizio"); ?>
			<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



