<?php
global $post_id, $hide_categories;
$post = get_post( $post_id );

$prefix = '_dci_servizio_';
$categorie = get_the_terms( $post->ID, 'categorie_servizio' );
$descrizione_breve = dci_get_meta( 'descrizione_breve', $prefix, $post->ID );

if ( $post->post_status == "publish" ) { ?>
	<div class="card card-teaser shadow mt-3 rounded">
		<svg class="icon" aria-hidden="true">
			<use xlink:href="#it-star-outline"></use>
		</svg>
		<div class="card-body">
			<h3 class="card-title h5">
				<a class="text-decoration-none" href="<?php echo get_permalink( $post->ID ); ?>">
					<?php echo $post->post_title; ?>
				</a>
			</h3>
			<div class="card-text">
				<p class="u-main-black">
					<?php echo $descrizione_breve; ?>
				</p>
			</div>
			<?php if ( ! $hide_categories ) { ?>
				<span class="visually-hidden">Categorie servizio:</span>
				<div class="u-main-black">
					<?php if ( is_array( $categorie ) && count( $categorie ) ) {
						$count = 1;
						foreach ( $categorie as $categoria ) {
							echo $count == 1 ? '' : ' - ';
							echo '<a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="' . get_term_link( $categoria->term_id ) . '">';
							echo $categoria->name;
							echo '</a>';
							++$count;
						}
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>

<?php } ?>