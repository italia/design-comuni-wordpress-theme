<?php
global $post, $struttura, $c, $locations, $with_border;
$card_title = $post->post_title;
$id = 0;
// controllo se è un parent, in caso recupero i dati del genitore
if($post->post_parent == 0){
	$id = $post->ID;
	$posizione_gps = dci_get_meta("posizione_gps", '_dci_luogo_', $post->ID);
	$indirizzo = dci_get_meta("indirizzo", '', $post->ID);
    $orari = dci_get_meta("orario_pubblico", '', $post->ID);
	$img = dci_get_meta('immagine', '', $post->ID);
}else{
	$parent = get_post($post->post_parent);
	$id = $parent->ID;
	$posizione_gps = dci_get_meta("posizione_gps", "_dci_luogo_", $post->post_parent);
	$indirizzo = dci_get_meta("indirizzo", "", $post->post_parent);
	$orari = dci_get_meta("orario_pubblico", '', $post->post_parent);
	$img = dci_get_meta('immagine', '', $post->post_parent);
}

/*$locations[$posizione_gps['lat']."|".$posizione_gps['lng']][] = [
    'title' => $card_title,
    'lat' => $posizione_gps['lat'],
    'lng' => $posizione_gps['lng'],
    'indirizzo' => $indirizzo,
    'permalink' => get_permalink($post)
];*/

$locations[$id][] = [
	'title' => $card_title,
	'lat' => $posizione_gps['lat'],
	'lng' => $posizione_gps['lng'],
	'indirizzo' => $indirizzo,
	'permalink' => get_permalink($post)
];

if($with_border) {
	?>

    <div class="card card-teaser card-teaser-info rounded shadow-sm p-3 m-1">
        <div class="card-body pe-3">
            <p class="card-title text-paragraph-regular-medium-semi mb-3">
                <a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>" data-element="service-area">
					<?php echo $post->post_title; ?>
                </a>
            </p>
            <div class="card-text">
				<?php
					echo '<p class="u-main-black">'.$indirizzo.'</p>';
				?>
				<?php
					echo '<p class="u-main-black">'.$orari.'</p>';
				?>
            </div>
        </div>
		<?php if ($img) { ?>
            <div class="avatar size-xl">
				<?php dci_get_img($img); ?>
            </div>
		<?php } ?>
    </div>
<?php } else { ?>
    <div class="card card-teaser border rounded shadow p-4">
        <div class="card-body pe-3">
            <h4 class="u-main-black mb-1 title-small-semi-bold-medium">
                <a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>">
					<?php echo $post->post_title; ?>
                </a>
            </h4>
            <div class="card-text">
				<?php
					echo '<p>'.$indirizzo.'</p>';
				?>
				<?php
					echo '<p class="u-main-black">'.$orari.'</p>';
				?>
            </div>
        </div>
		<?php if ($img) { ?>
            <div class="avatar size-xl">
				<?php dci_get_img($img); ?>
            </div>
		<?php } ?>
    </div>
<?php }
$with_border = false;
?>