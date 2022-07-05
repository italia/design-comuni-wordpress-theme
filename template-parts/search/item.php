<?php
global $post;

$descrizione = dci_get_meta('descrizione_breve');
?>

<div class="cmp-card-latest-messages mb-3 mb-30" data-bs-toggle="modal" data-bs-target="#" id="">
	<div class="card drop-shadow px-4 pt-4 pb-4 rounded">
		<div class="card-header border-0 p-0">
			<a 
			class="title-xsmall-bold mb-2 category text-uppercase" 
			href="<?php echo get_permalink( get_page_by_path( dci_get_group($post->post_type) ) ); ?>" 
			title="<?php echo dci_get_group_name($post->post_type); ?>"
			aria-label="Vai alla pagina <?php echo dci_get_group_name($post->post_type); ?>"
			>
			<?php echo dci_get_group_name($post->post_type); ?>
			</a>
		</div>
		<div class="card-body p-0 my-2">
			<h3 class="green-title-big t-primary mb-8">
				<a href="<?php echo get_permalink(); ?>" aria-label="Vai alla pagina <?php echo the_title(); ?>" title="Vai alla pagina <?php echo the_title(); ?>" data-element="service-link"><?php echo the_title(); ?></a>
			</h3>
			<p class="text-paragraph">
				<?php echo $descrizione; ?>
			</p>
		</div>
	</div>
</div>