<?php
/* Template Name: Vivere il comune
 *
 * Vivere il comune template file
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
			$img = dci_get_option('immagine', 'vivi');
			$didascalia = dci_get_option('didascalia', 'vivi');
			?>
			<div class="container" id="main-container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10">
						<?php get_template_part("template-parts/common/breadcrumb"); ?>
						<div class="cmp-hero">
							<section class="it-hero-wrapper bg-white align-items-start">
								<div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
								<h1 class="text-black title-xxxlarge mb-2">
									Vivere il comune
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
			<section class="hero-img mb-20 mb-lg-50">
				<section class="it-hero-wrapper it-hero-small-size cmp-hero-img-small" aria-label="In evidenza">
					<div class="img-responsive-wrapper">
						<div class="img-responsive">
							<div class="img-wrapper">
								<?php dci_get_img($img); ?>
							</div>
						</div>
					</div>
				</section>
				<p class="title-xsmall cmp-hero-img-small__description">
					<?php echo $didascalia; ?>
				</p>
			</section>
			<?php get_template_part("template-parts/vivere-comune/eventi"); ?>
			<?php get_template_part("template-parts/vivere-comune/luoghi"); ?>
			<?php get_template_part("template-parts/common/valuta-servizio"); ?>
			<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



