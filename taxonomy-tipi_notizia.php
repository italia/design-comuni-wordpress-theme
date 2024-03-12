<?php
/**
 * Archivi tassonomia Tipi Notizia
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-taxonomies
 * @link https://italia.github.io/design-comuni-pagine-statiche/sito/lista-risorse.html
 *
 * @package Design_Comuni_Italia
 */

get_header();
?>

<main>
	<div class="container" id="main-container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<?php get_template_part("template-parts/common/breadcrumb"); ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row justify-content-center row-shadow">
			<div class="col-12 col-lg-10">
				<div class="cmp-hero">
					<section class="it-hero-wrapper bg-white align-items-start">
						<div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
							<h1 class="text-black" data-element="page-name"><?php echo single_term_title( '', false ); ?></h1>
							<?php the_archive_description('<div class="hero-text"> <p>','</p> </div>'); ?>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>

	<div class="bg-grey-card py-5">
		<div class="container">

			<?php if ( have_posts() ) : ?>
			<div class="row g-4">
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/' . 'novita/cards-list' ); ?>

				<?php endwhile; ?>
			</div>

			<div class="row my-4">
				<nav class="pagination-wrapper justify-content-center col-12" aria-label="Navigazione pagine">
					<?php echo dci_bootstrap_pagination(); ?>
				</nav>
			</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

		</div>
	</div>

	<?php get_template_part("template-parts/common/valuta-servizio"); ?>
	<?php get_template_part("template-parts/common/assistenza-contatti"); ?>

</main>

<?php
get_footer();