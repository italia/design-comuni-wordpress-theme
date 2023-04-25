<?php
global $post_id, $luoghi, $c, $locations, $with_map;

$post = get_post( $post_id );
$post_id = null;

$id = 0;
// controllo se è un parent, in caso recupero i dati del genitore
if($post->post_parent == 0){
	$id = $post->ID;
	$posizione_gps = dci_get_meta("posizione_gps", '_dci_luogo_', $post->ID);
	$indirizzo = dci_get_meta("indirizzo", '_dci_luogo_', $post->ID);
	$descrizione = dci_get_meta("descrizione_breve", '_dci_luogo_', $post->ID);
    $orari = dci_get_meta("orario_pubblico", '_dci_luogo_', $post->ID);
	$img = dci_get_meta('immagine', '_dci_luogo_', $post->ID);
}else{
	$parent = get_post($post->post_parent);
	$id = $parent->ID;
	$posizione_gps = dci_get_meta("posizione_gps", '_dci_luogo_', $post->post_parent);
	$indirizzo = dci_get_meta("indirizzo", '_dci_luogo_', $post->post_parent);
	$descrizione = dci_get_meta("descrizione_breve", '_dci_luogo_', $post->post_parent);
	$orari = dci_get_meta("orario_pubblico", '_dci_luogo_', $post->post_parent);
	$img = dci_get_meta('immagine', '_dci_luogo_', $post->post_parent);
}

$other_contacts = array(
	'linkedin',
	'pec',
	'skype',
	'telegram',
	'twitter',
	'whatsapp'
);

/*$locations[$posizione_gps['lat']."|".$posizione_gps['lng']][] = [
    'title' => $post->post_title,
    'lat' => $posizione_gps['lat'],
    'lng' => $posizione_gps['lng'],
    'indirizzo' => $indirizzo,
    'permalink' => get_permalink($post)
];*/

$locations[$id][] = [
	'title' => $post->post_title,
	'lat' => $posizione_gps['lat'],
	'lng' => $posizione_gps['lng'],
	'indirizzo' => $indirizzo,
	'permalink' => get_permalink($post)
];

?>

<div class="card card-teaser shadow mt-3 rounded">
	<svg class="icon" aria-hidden="true">
		<use xlink:href="#it-pin"></use>
	</svg>
	<div class="card-body">
		<div class="row">
			<div class="col">
				<h3 class="card-title h5">
					<a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>">
						<?php echo $post->post_title; ?>
					</a>
				</h3>
				<div class="card-text">
					<?php echo '<p class="u-main-black">'.$descrizione.'</p>'; ?>
					<?php echo '<p class="u-main-black">Indirizzo: '.$indirizzo.'</p>'; ?>
					<?php echo '<p class="u-main-black">Orari: '.$orari.'</p>'; ?>
				</div>
			</div>
			<?php if ($img) { ?>
				<div class="col-auto">
					<div class="avatar size-xl">
						<?php dci_get_img($img); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php 
if ($with_map ?? null) {
	$luoghi = array($post);
    get_template_part("template-parts/luogo/map"); 
}
    
?>