<?php

$container_class = "bg-gray-light";
$tipologie_notizie = dci_get_option("tipologie_notizie", "notizie");

$args = array('post_type' => 'notizia_comunicato',
				'posts_per_page' => 9,
				'tax_query' => array(
					array(
						'taxonomy' => 'notizia',
						'field' => 'term_id',
						'terms' => $tipologie_notizie,
					),
				),
);
$posts = get_posts($args);
?>

<section class="section <?php echo $container_class; ?> py-5">
	<div class="container">
		<h2>Gallerie</h2>
		<div class="owl-carousel carousel-theme carousel-large">
			<?php
			foreach ($posts as $post){ ?>
			<div class="item">
				<?php get_template_part("template-parts/single/card", "vertical-thumb"); ?>
			</div>
			<?php } ?>

		</div><!-- /carousel-large -->
	</div><!-- /container -->
</section><!-- /section -->