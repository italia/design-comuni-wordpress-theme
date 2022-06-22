<?php
global $post;

$img = dci_get_meta('immagine', '_dci_evento_',$post->ID);
$descrizione = dci_get_meta('descrizione_breve', '_dci_evento_',$post->ID);
$timestamp = dci_get_meta('data_orario_inizio', '_dci_evento_',$post->ID);
$arrdata = explode('-', date_i18n("j-F-Y", $timestamp));
?>
<div class="col-12 col-sm-6 col-lg-4">
	<article class="card-wrapper card-space">
		<div class="card card-bg card-img rounded shadow">
		<div class="img-responsive-wrapper">
			<div class="img-responsive img-responsive-panoramic">
			<figure class="img-wrapper">
				<?php dci_get_img($img); ?>
			</figure>
			<div
				class="card-calendar d-flex flex-column justify-content-center"
			>
				<span class="card-date"><?php echo $arrdata[0]; ?></span>
				<span class="card-day"><?php echo $arrdata[1]; ?></span>
			</div>
			</div>
		</div>
		<div class="card-body p-4">
			<h5 class="card-title"><?php echo $post->post_title ?></h5>
			<p class="card-text">
				<?php echo $descrizione; ?>
			</p>
			<a class="read-more" href="<?php echo get_permalink($post->ID); ?>"
			><span class="text">Leggi di più</span>
			<svg class="icon">
				<use xlink:href="#it-arrow-right"></use>
			</svg></a>
		</div>
		</div>
	</article>
</div>
