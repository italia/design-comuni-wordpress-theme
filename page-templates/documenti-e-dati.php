<?php
/* Template Name: documenti-e-dati
 *
 * Documenti template file
 *
 * @package Design_Comuni_Italia
 */
global $post;
$search_url = esc_url( home_url( '/' ));

$tipi_documento = get_terms( array(
    'taxonomy' => 'tipi_documento',
    'hide_empty' => false,
) );

get_header();

?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			
			$description = dci_get_meta('descrizione','_dci_page_',$post->ID);
			?>
			<div class="container px-4" id="main-container">
			  <div class="row justify-content-center w-100 row-shadow">
				<div class="col-12 col-lg-10">
					<?php get_template_part("template-parts/common/breadcrumb"); ?>		  
					<div class="cmp-hero">
						<section class="it-hero-wrapper bg-white align-items-start">
							<div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
								<h1 class="text-black title-xxxlarge mb-2">Documenti e Dati</h1>
								<p class="text-black titillium text-paragraph">
									<?php echo $description; ?>
								</p>
							</div>
						</section>
					</div>
				</div>
			  </div>
			</div>
			<?php get_template_part("template-parts/documento/evidenza"); ?>
			<?php get_template_part("template-parts/documento/tutti-documenti"); ?>
			<?php get_template_part("template-parts/documento/categorie"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();
