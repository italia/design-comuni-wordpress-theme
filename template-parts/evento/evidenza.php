<?php
    global $post, $posts;
	// Per selezionare i contenuti in evidenza tramite flag

	//Per selezionare i contenuti in evidenza tramite configurazione
	$eventi = dci_get_option('eventi_evidenziati','eventi');

	$url_eventi = get_permalink( get_page_by_title('Eventi') );
	if (is_array($eventi) && count($eventi)) {
?>

<div class="container py-5">
	<h2 class="title-xxlarge mb-4">Eventi in evidenza</h2>
	<div class="row g-4">
		<?php
			foreach ($eventi as $eventi_id) {
				$post = get_post($eventi_id);
				get_template_part("template-parts/evento/card-full");
			}
		?>
	</div>
</div>
<?php } ?>