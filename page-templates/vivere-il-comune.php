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
			
			$img = dci_get_option('immagine', 'vivi');
			$didascalia = dci_get_option('didascalia', 'vivi');
			?>
			<?php get_template_part("template-parts/hero/hero"); ?>
			<section class="hero-img mb-20 mb-lg-50">
				<section class="it-hero-wrapper it-hero-small-size cmp-hero-img-small">
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



