<?php
/* Template Name: Gli eventi
 *
 * I eventi template file
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
			
			$img = dci_get_option('immagine', 'eventi');
			$didascalia = dci_get_option('didascalia', 'eventi');
		
			$args = array(
				'posts_per_page' => -1,
				'post_type' => 'evento',
				'post_status'    => 'publish'
			);
			$schede_eventi = get_posts($args);

		?>
		<?php 
			$with_shadow = true;
			get_template_part("template-parts/hero/hero"); 
		?>
			
		<?php if( $img ) { ?>
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
		<?php } ?>
		
		<?php get_template_part("template-parts/evento/evidenza"); ?>
		<?php get_template_part("template-parts/luogo/tutti-eventi"); ?>
		<?php get_template_part("template-parts/common/valuta-servizio"); ?>
		<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



