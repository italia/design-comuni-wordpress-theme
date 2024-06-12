<?php
    global $post, $posts;
	// Per selezionare i contenuti in evidenza tramite flag
	// $luoghi = dci_get_highlighted_posts(['luogo'], 6);

	//Per selezionare i contenuti in evidenza tramite configurazione
	$luoghi = dci_get_option('luoghi_evidenziati','luoghi');

	$url_luoghi = get_permalink( get_page_by_title('Luoghi') );
	if (is_array($luoghi) && count($luoghi)) {
?>

<div class="container py-5">
	<h2 class="title-xxlarge mb-4">Luoghi in evidenza</h2>
	<div class="row g-4">
		<?php
			foreach ($luoghi as $luogo_id) {
				$post = get_post($luogo_id);
				get_template_part("template-parts/luogo/card-full");
			}
		?>
	</div>
</div>
<?php } ?>